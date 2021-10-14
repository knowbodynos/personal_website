<html>
<head>
</head>
<body>
<?php
    require_once __DIR__ . "/vendor/autoload.php";
    $client = new MongoDB\Client("mongodb://frontend:password@172.31.6.126:27017/ToricCY");
    $collection = $client->ToricCY->POLY;
    $cursor = $collection->find(['H11' => 1]);
    foreach ($cursor as $document) {
        echo $document['POLYID'], "\n";
    }
?>
</body>
</html>