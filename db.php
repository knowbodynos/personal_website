<html>
<head prefix="og: http://ogp.me/ns#">
<meta property="og:title" content="Toric CY Search Results">
<meta property="og:url" content="http://www.rossealtman.com/db.php">
<meta property="og:description" content="Results from searching the Toric Calabi-Yau 3-fold database.">
<meta property="og:image" content="http://www.rossealtman.com/imgs/swirl.png">
<link rel="stylesheet" type="text/css" href="styledb.css">
<link rel="shortcut icon" href="imgs/swirl.ico">
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.coordinate.js"></script>
<!--<script type="text/javascript" src="downloadify/js/swfobject.js"></script>-->
<!--<script type="text/javascript" src="downloadify/js/downloadify.min.js"></script>-->
<!--<script type="text/javascript" src="sorttable/sorttable.js"></script>-->
<link rel="stylesheet" href="tablesorter/css/theme.rea.css">
<script type="text/javascript" src="jquery/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="tablesorter/js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="tablesorter/js/jquery.tablesorter.widgets.js"></script>
<link rel="stylesheet" href="tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script src="tablesorter/js/widgets/widget-pager.js"></script>
<script src="tablesorter/sort.js"></script>

<title>Toric CY Search Results</title>

<script type="text/javascript">
function listify() {
    var x = document.getElementById("disptable1").rows;
    var lst='{';
    var temp='';
    for(i=0;i<x.length;i++) {
        var y=x[i].cells;
        var patt=/^[,{}]*$/g;
        rowlst='{';
        for(j=0;j<y.length;j++) {
            temp=(y[j].textContent || y[j].innerText);
            //if(y[j].nodeName=="TH") {
            //    temp='\"'+temp+'\"';
            //}
            if(y[j].nodeName!="TH") {
                rowlst+=temp;
                if(j<y.length-1) {
                    rowlst+=',';
                }
            }
        }
        rowlst+='}';
        if(!patt.test(rowlst)) {
            lst+=rowlst;
            if(i<x.length-1) {
                lst+=',';
            }
        }
    }
    lst+='}';
    return lst;
}

//Copy to clipboard
function copyToClipboard(id) {
    var body = document.body, range, sel;
    var el = document.getElementById(id);
    if (document.createRange && window.getSelection) {
        range = document.createRange();
        sel = window.getSelection();
        sel.removeAllRanges();
        try {
            range.selectNodeContents(el);
            sel.addRange(range);
    } catch (e) {
            range.selectNode(el);
            sel.addRange(range);
        }
    } else if (body.createTextRange) {
        range = body.createTextRange();
        range.moveToElementText(el);
        range.select();
    }
    document.execCommand("Copy");
}

//Download table to CSV
function tableToCSV() {

// Variable to store the final csv data
var csv_data = [];

// Get each row data
var rows = document.getElementsByTagName('tr');
for (var i = 0; i < rows.length; i++) {

    // Get each column data
    var cols = rows[i].querySelectorAll('td,th');

    // Stores each csv row data
    var csvrow = [];
    for (var j = 0; j < cols.length; j++) {

        // Get the text data of each cell of
        // a row and push it to csvrow
        csvrow.push(cols[j].innerText);
    }

    // Combine each column value with comma
    csv_data.push(csvrow.join(","));
}
// combine each row data with new line character
csv_data = csv_data.join('\n');

/* We will use this function later to download
the data in a csv file downloadCSVFile(csv_data);
*/
downloadCSVFile(csv_data);
}

function downloadCSVFile(csv_data) {

// Create CSV file object and feed our
// csv_data into it
CSVFile = new Blob([csv_data], { type: "text/csv" });

// Create to temporary link to initiate
// download process
var temp_link = document.createElement('a');

// Download csv file
temp_link.download = "toriccy.csv";
var url = window.URL.createObjectURL(CSVFile);
temp_link.href = url;

// This link should not be displayed
temp_link.style.display = "none";
document.body.appendChild(temp_link);

// Automatically click the link to trigger download
temp_link.click();
document.body.removeChild(temp_link);
}



function SortColCond(x,y) {
    if (isNaN(x) && isNaN(y)) {
        return (x>y)-(x<y);
    } else {
        var nx=Number(x);
        var ny=Number(y);
        return (nx>ny)-(nx<ny);
    }
}

function Swap(rowData,a,b) {
    var classname=$(b).attr('class').split(/\s+/)[0];
    var depRows=new Array();
    for (var i=0;i<rowData.length;i++) {
        if ($(rowData[i]).hasClass(classname)) {
            depRows.push(rowData[i]);
        }
    }
    for (var p=0;p<depRows.length;p++) {
        a.parentNode.insertBefore(depRows[p],a);
    }
}

function SwapInds(pos,indices) {
    var temp=new Array();
    for (var i=0;i<indices.length;i++) {
        if (i!=pos) {
            if (i==pos-1) {
                temp.push(indices[pos]);
            }
            temp.push(indices[i]);
        }
    }
    return temp;
}

function optimizedGnomeSort(rowData,ind,dir) {
    var pos=1;
    var last=0;
    
    var indepRowData=new Array();
    var indices=new Array();
    var j=0;
    for (var i=0;i<rowData.length;i++) {
        if ($(rowData[i]).hasClass('indep')) {
            indepRowData.push(rowData[i]);
            indices.push(j);
            j++;
        }
    }
    
    while (pos<indepRowData.length) {
        var x=(indepRowData[indices[pos-1]].cells[ind].textContent || indepRowData[indices[pos-1]].cells[ind].innerText);
        var y=(indepRowData[indices[pos]].cells[ind].textContent || indepRowData[indices[pos]].cells[ind].innerText);
        if (SortColCond(x,y)==dir) {
            Swap(rowData,indepRowData[indices[pos-1]],indepRowData[indices[pos]]);
            indices=SwapInds(pos,indices);
            if (pos>1) {
                if (last==0) {
                    last=pos;
                }
                pos--;
            } else {
                pos++;
            }
        } else {
            if (last!=0) {
                pos=last;
                last=0;
            }
            pos++;
        }
    }
}

var heads=$(".thead");
var headids = heads.map(function() { return "#"+this.id; }).get();

var tableData=document.getElementById('disptable');
var rowData=tableData.getElementsByTagName('tr');

$(headids.join()).click(function(){
    var ind=headids.indexOf("#"+this.id);
    
    if ($(this).find('.arrowdown').length>0) {
        var newHTML=(this.textContent || this.innerText)+"<img src=\"imgs/arrow_up.png\" class=\"arrowup\">";
        this.innerHTML=newHTML;
        
        optimizedGnomeSort(rowData,ind,-1);
        
    } else if ($(this).find('.arrowup').length>0) {
        var newHTML=(this.textContent || this.innerText)+"<img src=\"imgs/arrow_down.png\" class=\"arrowdown\">";
        this.innerHTML=newHTML;
        
        optimizedGnomeSort(rowData,ind,1);
        
    } else if ($(this).find('.arrowup').length==0 && $(this).find('.arrowdown').length==0) {
        for (var j=0;j<heads.length;j++) {
            heads[j].innerHTML=(heads[j].textContent || heads[j].innerText);
        }
        var newHTML=(this.textContent || this.innerText)+"<img src=\"imgs/arrow_down.png\" class=\"arrowdown\">";
        this.innerHTML=newHTML;
        
        optimizedGnomeSort(rowData,ind,1);
        
    }
});

$(function(){
  $('#navcontainer').css({ height: $(window).innerHeight() });
  $(window).resize(function(){
    $('#navcontainer').css({ height: $(window).innerHeight() });
  });
});
</script>
</head>
<body>
<div id="head">
<a href="index.html"><img src="imgs/logo.png" title="Toric CY Database" height="150"></a>
<a id="cy" title="Return to Portal" href="http://www.rossealtman.com/toriccy"><img height="150px" style="PADDING-TOP: 5px" alt="Return to Portal" src="imgs/DBLINK.png"/></a>
</div>

<div id="navcontainer">
<ul id="nav">
<li><a href="index.html">Search Database</a></li>
<li><a href="https://app.box.com/s/ch4w5gy1wv9dv11ptf314u7ovj2x4vig">Download Database</a></li>
<!--        <li><a href="contact.html">Contact Info</a></li>-->
</ul>
</div>
<div id="title"><h1>Toric Calabi-Yau Database</h1></div>
<div id="info">This database is based on: <a href="https://arxiv.org/abs/1411.1418">arXiv:1411.1418</a>, <a href="https://arxiv.org/abs/1706.09070">arXiv:1706.09070</a>, and most recently <a href="https://arxiv.org/abs/2111.03078">arXiv:2111.03078</a>. Please cite us!
<br>
Contact <a href="mailto:ross@rossealtman.com?Subject=Toric%20Calabi-Yau%20Threefold%20Database">Ross Altman</a> with questions.
<br>
Constructed with support from the National Science Foundation under grant NSF/CCF-1048082, EAGER: CiC: A String Cartography.
</div>
<div id="tocwrap1">
<div id="tocwrap2">
<ol id="toc">
    <li class="current"><a href="index.html"><span>Basic Query</span></a></li>
    <li><a href="mongosearch.php"><span>Advanced Query</span></a></li>
</ol>
</div>
</div>
<div id="wrapper">
<div id="innerwrap">
<div class="trow">
<div id="buttons">
<button id="copy-button" onclick="copyToClipboard('disptable1')" class="export">Copy table to clipboard.</button>
<br><br>
<div id="savewrap">
<button id="save-button" onclick="tableToCSV()" class="export">Save table to file.</button>
<!--<p id="downloadify"></p>-->
</div>
</div>
</div>
<br>
<div class="trow">
<div id="main">
<br><br>
<?php
try {
    require_once __DIR__ . "/vendor/autoload.php";
    $m = new MongoDB\Client("mongodb://frontend:password@168.235.102.185:27017/ToricCY");
    $db = $m->ToricCY;
    $polycoll = $db->POLY;
    $geomcoll = $db->GEOM;
    $triangcoll = $db->TRIANG;
    $swisscheesecoll = $db->SWISSCHEESE;

    $limit=intval($_POST['limit']);
    $limit=($limit==0 ? -1 : $limit);
    $matches=$_POST['matches'];
    $count=$_POST['count'];

    $moddict=array("POLY"=>"Polytopes","GEOM"=>"Geometries","TRIANG"=>"Triangulations");

    $polydict=array("POLYID"=>"Polytope ID #","POLYN"=>"Polytope # (within H11)","H11"=>"H11","H21"=>"H21","EULER"=>"Euler #","FAV"=>"Favorable?","NGEOMS"=>"# of Geometries (within polytope)","NALLTRIANGS"=>"# of Triangulations (within polytope)","FUNDGP"=>"Fundamental Group","NNVERTS"=>"# of Newton Polytope Vertices","NNPOINTS"=>"# of Newton Polytope Points","NVERTS"=>"Newton Polytope Vertex Matrix","NDVERTS"=>"# of Dual Polytope Vertices","NDPOINTS"=>"# of Dual Polytope Points","DVERTS"=>"Dual Polytope Vertex Matrix","DRESVERTS"=>"Dual Polytope Resolved Vertex Matrix","CWS"=>"Weight Matrix","RESCWS"=>"Resolved Weight Matrix","DTOJ"=>"Toric to Basis Divisor Transformation Matrix","BASIS"=>"Basis from Toric Divisors","JTOD"=>"Basis to Toric Divisor Transformation Matrix","INVBASIS"=>"Toric from Basis Divisors");
    $polykeys=array(array("POLYID"),array("POLYN"),array("H11"),array("H21"),array("EULER"),array("FAV"),array("NGEOMS"),array("NALLTRIANGS"),array("FUNDGP"),array("NNVERTS"),array("NNPOINTS"),array("NVERTS"),array("NDVERTS"),array("NDPOINTS"),array("DVERTS","DRESVERTS"),array("CWS","RESCWS"));
    $polyvals=array($_POST['POLYID'],$_POST['POLYN'],$_POST['H11'],$_POST['H21'],$_POST['EULER'],$_POST['FAV'],$_POST['NGEOMS'],$_POST['NALLTRIANGS'],$_POST['FUNDGP'],$_POST['NNVERTS'],$_POST['NNPOINTS'],$_POST['NVERTS'],$_POST['NDVERTS'],$_POST['NDPOINTS'],$_POST['DVERTS'],$_POST['CWS']);
    if (isset($polyvals[2])) {
        if ($polyvals[2]>6) {
            throw new Exception("Cases with H11>6 have not yet been added.");
        }
    }
    $andarray=array();
    for ($i=0;$i<sizeof($polykeys);$i++) {
        if ($polyvals[$i] !== "") {
            $orarray=array();
            for ($j=0;$j<sizeof($polykeys[$i]);$j++) {
                if (in_array($polykeys[$i][$j],array('CWS','RESCWS','NVERTS','DVERTS','DRESVERTS')) and strpos($polyvals[$i],"}},") !== false) {
                    $valrange=array();
                    $temp=explode("}},",$polyvals[$i]);
                    foreach ($temp as $t) {
                        array_push($valrange,$t."}}");
                    }
                } else if (in_array($polykeys[$i][$j],array('FAV'))) {
                    $temp=($polyvals[$i] === 'true' ? TRUE : FALSE);
                    $valrange=array($temp);
                } else if (strpos($polyvals[$i],"}") == false) {
                    $valrange=explode(",",$polyvals[$i]);
                } else {
                    $valrange=array($polyvals[$i]);
                }
                if (in_array($polykeys[$i][$j],array('POLYID','H11','H21','EULER','NNVERTS','NNPOINTS','NDVERTS','NDPOINTS','POLYN','FUNDGP','NGEOMS','NALLTRIANGS'))) {
                    for ($k=0;$k<sizeof($valrange);$k++) {
                        $valrange[$k]=(int) $valrange[$k];
                    }
                }
                array_push($orarray,array($polykeys[$i][$j]=>array('$in'=>$valrange)));
            }
            array_push($andarray,array('$or'=>$orarray));
        }
    }
    if (sizeof($andarray)==0) {
        $polymongosearch=array();
    } else {
        $polymongosearch=array('$and'=>$andarray);
    }

    $geomdict=array("GEOMN"=>"Geometry # (within polytope)","NTRIANGS"=>"# of Triangulations (within geometry)","IPOLYXJ"=>"CY Intersection Polynomial (Basis)","ITENSXJ"=>"CY Intersection Tensor (Basis)","CHERN2XJ"=>"CY 2nd Chern Class (Basis)","CHERN2XNUMS"=>"CY 2nd Chern Numbers","MORIMAT"=>"CY Mori Cone Matrix","KAHLERMAT"=>"CY Kahler Cone Matrix","SWISSCHEESE"=>"Swiss Cheese Solutions");
    $geomkeys=array(array('GEOMN'),array('NTRIANGS'),array('IPOLYXJ','ITENSXJ'),array('CHERN2XNUMS'));
    $geomvals=array($_POST['GEOMN'],$_POST['NTRIANGS'],$_POST['ITENSXJ'],$_POST['CHERN2XNUMS']);
    $andarray=array();
    for ($i=0;$i<sizeof($geomkeys);$i++) {
        if ($geomvals[$i] !== "") {
            $orarray=array();
            for ($j=0;$j<sizeof($geomkeys[$i]);$j++) {
                if (in_array($geomkeys[$i][$j],array('CHERN2XNUMS')) and strpos($geomvals[$i],"},") !== false) {
                    $valrange=array();
                    $temp=explode("},",$geomvals[$i]);
                    foreach ($temp as $t) {
                        array_push($valrange,$t."}");
                    }
                } else if (in_array($geomkeys[$i][$j],array('IPOLYXJ','ITENSXJ')) and strpos($geomvals[$i],"}}},") !== false) {
                    $valrange=array();
                    $temp=explode("}}},",$geomvals[$i]);
                    foreach ($temp as $t) {
                        array_push($valrange,$t."}}}");
                    }
                } else if (strpos($geomvals[$i],"}") == false) {
                    $valrange=explode(",",$geomvals[$i]);
                } else {
                    $valrange=array($geomvals[$i]);
                }
                if (in_array($geomkeys[$i][$j],array('GEOMN','NTRIANGS'))) {
                    for ($k=0;$k<sizeof($valrange);$k++) {
                        $valrange[$k]=(int) $valrange[$k];
                    }
                }
                array_push($orarray,array($geomkeys[$i][$j]=>array('$in'=>$valrange)));
            }
            array_push($andarray,array('$or'=>$orarray));
        }
    }
    if (sizeof($andarray)==0) {
        $geommongosearch=array();
    } else {
        $geommongosearch=array('$and'=>$andarray);
    }

    $triangdict=array("TRIANGN"=>"Triangulation # (within geometry)","ALLTRIANGN"=>"Triangulation # (within polytope)","TRIANG"=>"Triangulation","SRIDEAL"=>"Stanley-Reisner Ideal","CHERNAD"=>"Ambient Chern Classes (Toric)","CHERNAJ"=>"Ambient Chern Classes (Basis)","CHERN2XD"=>"CY 2nd Chern Class (Toric)","CHERN3XD"=>"CY 3rd Chern Class (Toric)","CHERN3XJ"=>"CY 3rd Chern Class (Basis)","IPOLYAD"=>"Ambient Intersection Polynomial (Toric)","ITENSAD"=>"Ambient Intersection Tensor (Toric)","IPOLYAJ"=>"Ambient Intersection Polynomial (Basis)","ITENSAJ"=>"Ambient Intersection Tensor (Basis)","IPOLYXD"=>"CY Intersection Polynomial (Toric)","ITENSXD"=>"CY Intersection Tensor (Toric)","MORIMATP"=>"Phase Mori Cone Matrix","KAHLERMATP"=>"Phase Kahler Cone Matrix");
    $triangkeys=array(array("TRIANGN"),array("ALLTRIANGN"));
    $triangvals=array($_POST['TRIANGN'],$_POST['ALLTRIANGN']);
    $andarray=array();
    for ($i=0;$i<sizeof($triangkeys);$i++) {
        if ($triangvals[$i] !== "") {
            $orarray=array();
            for ($j=0;$j<sizeof($triangkeys[$i]);$j++) {
                if (strpos($triangvals[$i],"}") == false) {
                    $valrange=explode(",",$triangvals[$i]);
                } else {
                    $valrange=array($triangvals[$i]);
                }
                if (in_array($triangkeys[$i][$j],array('TRIANGN','ALLTRIANGN'))) {
                    for ($k=0;$k<sizeof($valrange);$k++) {
                        $valrange[$k]=(int) $valrange[$k];
                    }
                }
                array_push($orarray,array($triangkeys[$i][$j]=>array('$in'=>$valrange)));
            }
            array_push($andarray,array('$or'=>$orarray));
        }
    }
    if (sizeof($andarray)==0) {
        $triangmongosearch=array();
    } else {
        $triangmongosearch=array('$and'=>$andarray);
    }

    $toricswisscheesedict=array("NLARGE"=>"# of Large Cycles","RMAT2CYCLE"=>"2-Cycle Rotation Matrix","RMAT4CYCLE"=>"4-Cycle Rotation Matrix","INTBASIS2CYCLE"=>"2-Cycle Z-Basis?","INTBASIS4CYCLE"=>"4-Cycle Z-Basis?","HOM"=>"Homogeneity Condition Satisfied?");
    $explicitswisscheesedict=array("RMAT2CYCLE"=>"Diagonal 2-Cycle Rotation Matrix","DIAGCOEFFS"=>"Diagonal Volume Coefficients");

    $polyprops=(isset($_POST['polyprops']) ? $_POST['polyprops'] : array());
    $polyones=array_fill(0,sizeof($polyprops),1);
    $polymongoprops=array_combine($polyprops,$polyones);

    $geomprops=(isset($_POST['geomprops']) ? $_POST['geomprops'] : array());

    $toricswisscheeseprops=in_array("TORICSWISSCHEESE",$geomprops) ? array_keys($toricswisscheesedict) : array();
    $toricswisscheeseones=array_fill(0,sizeof($toricswisscheesedict),1);

    $explicitswisscheeseprops=in_array("EXPLICITSWISSCHEESE",$geomprops) ? array_keys($explicitswisscheesedict) : array();
    $explicitswisscheeseones=array_fill(0,sizeof($explicitswisscheesedict),1);
    
    $swisscheesemongoprops=array_combine(array_keys($toricswisscheesedict),$toricswisscheeseones);
    $swisscheesemongoprops['EXPLICIT']=1;

    $geomprops=array_diff($geomprops,array('TORICSWISSCHEESE','EXPLICITSWISSCHEESE'));
    $geomones=array_fill(0,sizeof($geomprops),1);
    $geommongoprops=array_combine($geomprops,$geomones);

    $triangprops=(isset($_POST['triangprops']) ? $_POST['triangprops'] : array());
    $triangones=array_fill(0,sizeof($triangprops),1);
    $triangmongoprops=array_combine($triangprops,$triangones);

    if ($count=="NONE") {
        print("<table id=\"disptable1\" class=\"tablesorter\">\n<thead>\n<tr>");

        if (isset($polyprops) and (sizeof($polyprops)>0)) {
            print("<th colspan=\"".sizeof($polyprops)."\">Polytope Fields</th>");
        }
        if (isset($geomprops) and (sizeof($geomprops)>0)) {
            print("<th colspan=\"".sizeof($geomprops)."\">Geometry Fields</th>");
        }
        if (isset($toricswisscheeseprops) and (sizeof($toricswisscheeseprops)>0)) {
            print("<th colspan=\"".sizeof($toricswisscheeseprops)."\">Toric Swiss Cheese Fields</th>");
        }
        if (isset($explicitswisscheeseprops) and (sizeof($explicitswisscheeseprops)>0)) {
            print("<th colspan=\"".sizeof($explicitswisscheeseprops)."\">Explicit Swiss Cheese Fields</th>");
        }
        if (isset($triangprops) and (sizeof($triangprops)>0)) {
            print("<th colspan=\"".sizeof($triangprops)."\">Triangulation Fields</th>");
        }
        print("</tr>\n<tr>");

        if (isset($polyprops)) {
            foreach ($polyprops as $prop) {
                print("<th>".$polydict[$prop]."</th>");
            }
        }
        if (isset($geomprops)) {
            foreach ($geomprops as $prop) {
                print("<th>".$geomdict[$prop]."</th>");
            }
        }
        if (isset($toricswisscheeseprops)) {
            foreach ($toricswisscheeseprops as $prop) {
                print("<th>".$toricswisscheesedict[$prop]."</th>");
            }
        }
        if (isset($explicitswisscheeseprops)) {
            foreach ($explicitswisscheeseprops as $prop) {
                print("<th>".$explicitswisscheesedict[$prop]."</th>");
            }
        }
        if (isset($triangprops)) {
            foreach ($triangprops as $prop) {
                print("<th>".$triangdict[$prop]."</th>");
            }
        }
    }
    print("</tr>\n</thead>\n<tbody>\n");

    $rowcount=1;
    $collcount=1;
    $geomstop=false;
    $triangstop=false;
    $plotvals=array();
    $polycurs=$polycoll->find($polymongosearch,array_merge($polymongoprops,array('POLYID'=>1,'H11'=>1,'H21'=>1,'EULER'=>1)))->toArray();
    foreach ($polycurs as $polydoc) {
        $polyprinted=false;
        array_push($plotvals,array("POLYID"=>$polydoc['POLYID'],"H11"=>$polydoc['H11'],"H21"=>$polydoc['H21'],"EULER"=>$polydoc['EULER']));
        $geomcurs=$geomcoll->find(array_merge($geommongosearch,array('POLYID'=>$polydoc['POLYID'])),array_merge($geommongoprops,array('GEOMN'=>1)))->toArray();
        foreach ($geomcurs as $geomdoc) {
            $geomprinted=false;
            $swisscheesecurs=$swisscheesecoll->find(array('POLYID'=>$polydoc['POLYID'],'GEOMN'=>$geomdoc['GEOMN']),$swisscheesemongoprops)->toArray();
            // $it = new IteratorIterator($swisscheesecurs);
            // $it->rewind();
            if (empty($swisscheesecurs)) {
                $swisscheesecurs=array(array());
            }
            // if (!$swisscheesecurs->hasNext()) {
            //     $swisscheesecurs=array(array());
            // }
            $triangcurs=$triangcoll->find(array_merge($triangmongosearch,array('POLYID'=>$polydoc['POLYID'],'GEOMN'=>$geomdoc['GEOMN'])),$triangmongoprops)->toArray();
            $swisscheesecount=1;
            foreach ($swisscheesecurs as $swisscheesedoc) {
                foreach ($triangcurs as $triangdoc) {

                    if ($count=="NONE") {
                        print("<tr class=\"row".$rowcount."\">");
                        if (isset($polyprops)) {
                            foreach ($polyprops as $prop) {
                                print("<th>".$polydoc[$prop]."</th>");
                            }
                        }
                        if (isset($geomprops)) {
                            foreach ($geomprops as $prop) {
                                print("<th>".$geomdoc[$prop]."</th>");
                            }
                        }
                        if (isset($toricswisscheeseprops)) {
                            foreach ($toricswisscheeseprops as $prop) {
                                print("<th>".$swisscheesedoc[$prop]."</th>");
                            }
                        }
                        if (isset($explicitswisscheeseprops)) {
                            foreach ($explicitswisscheeseprops as $prop) {
                                if (array_key_exists("EXPLICIT",$swisscheesedoc)) {
                                    print("<th>".$swisscheesedoc['EXPLICIT'][$prop]."</th>");
                                } else {
                                    print("<th></th>");
                                }
                            }
                        }
                        if (isset($triangprops)) {
                            foreach ($triangprops as $prop) {
                                print("<th>".$triangdoc[$prop]."</th>");
                            }
                        }
                        print("</tr>\n");
                    }
                    $geomprinted=true;
                    $polyprinted=true;
                    $rowcount++;
                    if ($count=='TRIANG' or ($count=='NONE' and $matches=='TRIANG')) {
                        if ($collcount==$limit) {
                            $triangstop=true;
                            break;
                        }
                        if ($swisscheesecount==1) {
                            $collcount++;
                        }
                    }
                }
                $swisscheesecount++;
            }
            if ($count=='GEOM' or ($count=='NONE' and $matches=='GEOM')) {
                if ($collcount==$limit) {
                    $geomstop=true;
                    break;
                }
                if ($geomprinted) {
                    $collcount++;
                }
            } elseif ($triangstop) {
                $geomstop=true;
                break;
            }
        }
        if ($count=='POLY' or ($count=='NONE' and $matches=='POLY')) {
            if ($collcount==$limit) {
                break;
            }
            if ($polyprinted) {
                $collcount++;
            }
        } elseif ($geomstop) {
            break;
        }
    }

    $collcount--;
    
    if ($count!='NONE') {
        print "<table id=\"disptable1\" class=\"tablesorter\">\n<thead>\n<tr><th>Count ".$moddict[$count]."</th></tr>\n</thead>\n<tbody>\n<tr><td>".$collcount."</td></tr>";
    }
    print("\n</tbody>\n</table>");

    $idarr=array();
    $max=0;
    $datastr="[";
    $last=0;
    $i=0;
    foreach ($plotvals as $p) {
        $temp=abs((int)$p['EULER']);
        if ($temp>$max) {$max=$temp;}
        $datasum=(string)((int)$p['H11'])+((int)$p['H21']);
        if ($idarr[$p['EULER'].",".$datasum]=="") {
            $idarr[$p['EULER'].",".$datasum]=$p['POLYID'];
        } else
        {
            if ($p['POLYID']!==$last) {
                $idarr[$p['EULER'].",".$datasum].=", ".$p['POLYID'];
            }
        }
        $datastr .= "[".$p['EULER'].",".$datasum."]";
        if ($i<sizeof($plotvals)-1) {
            $datastr .= ",";
        }
        $last=$p['POLYID'];
        $i++;
    }
    $datastr .= "]";

    //print("<br><br>".json_encode($polymongosearch));
    //print("<br><br>".json_encode($geommongosearch));
    //print("<br><br>".json_encode($triangmongosearch));
    print("<br><br><br><div id=\"chart1\" style=\"height:400px;width:97%;margin-left:3%;\"></div>
    <script id=\"source\" language=\"javascript\" type=\"text/javascript\">
    $(document).ready(function(){
      var options = {series:{hoverable:true,
       clickable:true,
       highlightColor:'#7D4100',
       color:'#E68A00',
       lines:{show:false},
       shadowSize:5,
       points:{show:true,
         radius:5,
         fill:true,
         fillColor:'#E68A00'}},
         grid:{color:'#FFF',
         hoverable:true,
         clickable:true,
         backgroundcolor:null},
         xaxis:{tickDecimals:0,
          min:-$max,
          max:$max,
          font:{size:12,
            weight: 'bold',
            color: '#807E7E'}},
            yaxis:{min:0,font:{size: 12,
              weight:'bold',
              color:'#807E7E'}},
              coordinate:{type:'rectangular'}};
              var plot = $.plot('#chart1',[".$datastr."],options);
              $(\"#chart1\").append(\"<div id='xaxis' style='position:absolute;width:100%;text-align:center;bottom:-30px;color:#FFF;font-size:x-large'>Euler # or 2(h11-h21)</div>\");
              $(\"#chart1\").append(\"<div id='yaxis' style='position:absolute;height:100%;left:130px;text-align:center;color:#FFF;font-size:x-large;transform:rotate(270deg);-webkit-transform:rotate(270deg);-moz-transform:rotate(270deg);'>h11+h21</div>\");
              var jidarr=".json_encode($idarr).";
              $(\"#chart1\").bind(\"plothover\",function(event, pos, item) {
                $('.annote').remove();
                if(item) {
                  var o = plot.pointOffset({ x: pos.x, y: pos.y});
                  var jid=jidarr[item.datapoint];
                  $(\"#chart1\").append(\"<div class='annote' style='position:absolute;left:\"+(o.left-(5*Math.ceil(item.datapoint.toString().length/2))-10)+\"px;top:\" + (o.top-35) + \"px;color:#E68A00;font-size:medium'>(\"+item.datapoint+\")</div>\");
                  $(\"#chart1\").append(\"<div class='annote' style='position:absolute;text-align:center;left:\"+(o.left-(5*Math.ceil(jid.toString().length/2)))+\"px;top:\" + (o.top-55) + \"px;color:#E68A00;font-size:medium'>\"+jid+\"</div>\");
                }
              });
  $(\"#chart1\").bind(\"plotclick\",function(event, pos, item) {
    $('.annote').remove();
    var table=document.getElementById(\"disptable1\");
    var rows=table.getElementsByTagName(\"tr\");
    for(i=0;i<rows.length;i++) {
      rows[i].style.backgroundColor=\"\";
      rows[i].style.color=\"\";
    }
    if(item) {
      var jid=jidarr[item.datapoint];
      var jidsplit=jid.toString().split(\", \");
      var x;
      for(x in jidsplit) {
        rows=document.getElementsByClassName(\"row\"+jidsplit[x].toString());
        for(i=0;i<rows.length;i++) {
          rows[i].style.backgroundColor=\"#807E7E\";
          rows[i].style.color=\"#FFFFFF\";
        }
      }
    }
  });
  });
  </script>");

    $m->close();
} catch(Exception $e) {
    echo 'Exception: '.$e->getMessage();
}
?>
</div>
</div>
</div>
</div>
</body>
</html>