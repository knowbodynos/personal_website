import os
import pandas as pd
import motor.motor_asyncio as motor
import pymongo.database
from pymongo import MongoClient
from json_normalize import json_normalize
from typing import Optional

from fastapi import FastAPI
from fastapi.responses import StreamingResponse
from pydantic import BaseSettings, BaseModel

import mappings


class DataModelIn(BaseModel):
    query: Optional[dict] = None
    projection: Optional[dict] = None
    offset: int = 0
    limit: int = 100


class Settings(BaseSettings):
    username: str = os.getenv('MONGO_USERNAME', None)
    password: str = os.getenv('MONGO_PASSWORD', None)
    host: str = os.getenv('MONGO_HOSTNAME', None)
    port: int = int(os.getenv('MONGO_PORT', 0))
    authSource: str = os.getenv('MONGO_DB', None)


settings = Settings()
app = FastAPI()


class Database(pymongo.database.Database):#motor.AsyncIOMotorDatabase):
    def __init__(self, settings: Settings):
        client = MongoClient(**vars(settings))
        # async_client = motor.AsyncIOMotorClient(**vars(settings))
        super().__init__(client, settings.authSource)
        self._indexes = list(client[settings.authSource]['INDEXES'].aggregate([
            {'$group': {'_id': '$TIER', 'index': {'$first': '$TIERID'}, 'keys': {'$push': '$INDEX'}}},
            {'$sort': {'index': 1}}
        ]))
        for i in range(len(self._indexes)):
            self._indexes[i]['keys'].append('H11')

    def find(self,
             target_collection: str,
             query: Optional[dict] = None,
             projection: Optional[dict] = None,
             offset: int = 0,
             limit: int = 100):
        coll_index = next((x['index'] - 1 for x in self._indexes if x['_id']==target_collection), 0)
        # while True:
        coll_obj = self._indexes[coll_index]
        if not query:
            query = {}
        coll_query = {k: v for k, v in query.items()
                      if (k in getattr(mappings, coll_obj['_id'])) or (k in coll_obj['keys'])}
        result = self[coll_obj['_id']].find(coll_query, {'_id': 0},
                                            skip=offset,
                                            limit=limit)#.to_list(length=None)
        if result.count(with_limit_and_skip=True) == 0:
            return []
        frame = pd.DataFrame(result).set_index(coll_obj['keys'])
        for coll_obj in reversed(self._indexes[:coll_index]):
            if set(coll_obj['keys']).issubset(set(frame.index.names)):
                coll_query = {k: v for k, v in query.items()
                              if k in getattr(mappings, coll_obj['_id'])}
                coll_query.update({x: {'$in': frame.index.get_level_values(x).to_list()}
                                   for x in frame.index.names if x in coll_obj['keys']})
                result = self[coll_obj['_id']].find(coll_query, {'_id': 0})#.to_list(length=None)
                # frame = frame.reset_index()
                next_frame = pd.DataFrame(result).set_index(coll_obj['keys'])
                frame = frame.merge(next_frame, left_index=True, right_index=True)
                # shared_index = list(set(frame.columns) & set(next_frame.columns))
                # print(coll_obj['_id'])
                # print(frame.columns)
                # print(next_frame.columns)
                # print(coll_query)
                # print('')
                # frame = frame.merge(next_frame, left_on=shared_index, right_on=shared_index)
                # frame = frame.set_index(coll_obj['keys'])
        frame = frame.reset_index()
        if projection:
            frame = frame.drop(columns=[x for x in frame.columns
                                        if not ((x in projection) and projection[x])])
        # yield frame.to_json(orient='records')
        # yield frame.to_html(notebook=True)
        # yield pd.DataFrame.from_records([json_normalize(x) for x in frame.to_dict(orient='records')]).to_json(orient='records')
        # offset += limit
        # return list(frame.to_dict(orient='records'))#.values())
        # records = json_normalize(frame.to_dict(orient='records'))
        # return pd.DataFrame.from_records(records).to_csv(index=False, header=(not offset))
        return frame.to_csv(index=False, header=(not offset))


@app.post("/{target}/find")
def target_find(target: str, data: DataModelIn):
    db = Database(settings)
    return db.find(target, data.query, data.projection, data.offset, data.limit)
