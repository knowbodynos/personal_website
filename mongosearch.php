<html>
<head prefix="og: http://ogp.me/ns#">
<meta property="og:title" content="Toric CY Search Results">
<meta property="og:url" content="http://www.rossealtman.com/db.php">
<meta property="og:description" content="Results from searching the Toric Calabi-Yau 3-fold database.">
<meta property="og:image" content="http://www.rossealtman.com/imgs/swirl.png">
<link rel="stylesheet" type="text/css" href="stylemongo.css">
<link rel="shortcut icon" href="imgs/swirl.ico">
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="flot/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="flot/jquery.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="flot/jquery.flot.coordinate.js"></script>
<script language="javascript" type="text/javascript" src="zeroclipboard/dist/ZeroClipboard.js"></script>
<!--<script type="text/javascript" src="downloadify/js/swfobject.js"></script>-->
<!--<script type="text/javascript" src="downloadify/js/downloadify.min.js"></script>-->
<!--<script type="text/javascript" src="sorttable/sorttable.js"></script>-->
<script src="codemirror/lib/codemirror.js"></script>
<link rel="stylesheet" href="codemirror/lib/codemirror.css">
<script src="codemirror/mode/sql/sql.js"></script>
<link rel="stylesheet" href="codemirror/addon/hint/show-hint.css" />
<script src="codemirror/addon/hint/show-hint.js"></script>
<script src="codemirror/addon/hint/sql-hint.js"></script>
<link rel="stylesheet" href="codemirror/theme/mdn-like.css">
<script language="javascript" type="text/javascript" src="raphaeljs/raphael-min.js" charset="utf-8"></script>
<script language="javascript" type="text/javascript" src="raphaeljs/flowchart.js" charset="utf-8"></script>
<link rel="stylesheet" href="tablesorter/css/theme.rea.css">
<script type="text/javascript" src="jquery/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="tablesorter/js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="tablesorter/js/jquery.tablesorter.widgets.js"></script>
<link rel="stylesheet" href="tablesorter/addons/pager/jquery.tablesorter.pager.css">
<script src="tablesorter/js/widgets/widget-pager.js"></script>
<script src="tablesorter/sort.js"></script>
<title>Toric CY Search Results</title>
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
    <li><a href="index.html"><span>Basic Query</span></a></li>
    <li class="current"><a href="mongosearch.php"><span>Advanced Query</span></a></li>
</ol>
</div>
</div>
<div id="wrapper">
<div id="innerwrap">
<div class="trow">
<div id="holder" style="display:none;"></div>

<div id="mongowrapper">
<form id="mongoinform" action="" method="get">
<div id="mongobox">
<textarea id="mongocode" name="mongocode" height=150><?php if(isset($_GET['mongocode'])){echo $_GET['mongocode'];} ?></textarea>
<br>
<div class="text">
(Query in JSON Format &nbsp; | &nbsp; Enter: Submit Query)
</div>
&nbsp;&nbsp;
<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onclick="toggle_visibility('holder');" <?php if(empty($_GET)){echo ' checked="checked" ';}else{if(!empty($_GET['onoffswitch'])){echo 'checked="unchecked" ';}} ?>>
    <?php if(!empty($_GET)){if(empty($_GET['onoffswitch'])){echo "<script>document.getElementById('holder').style.display='block';</script>";}} ?>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>

<br><br><br>
</div>
<div id="instrbox">

<div id="propcolwrapper">
<div class="propcol">
<ul>
<p>Select Polytope Properties:</p>
<li><input type="checkbox" class="polyprops" name="polyprops[0]" value="POLYID" title="Polytope ID #" <?php echo empty($_GET['polyprops'][0]) ? '' : ' checked="checked" '; ?>>Polytope ID #</li>
<li><input type="checkbox" class="polyprops" name="polyprops[1]" value="POLYN" title="Polytope #" <?php echo empty($_GET['polyprops'][1]) ? '' : ' checked="checked" '; ?>>Polytope #</li>
<li><input type="checkbox" class="polyprops" name="polyprops[2]" value="H11" title="H11" <?php echo empty($_GET['polyprops'][2]) ? '' : ' checked="checked" '; ?>>H11</li>
<li><input type="checkbox" class="polyprops" name="polyprops[3]" value="H21" title="H21" <?php echo empty($_GET['polyprops'][3]) ? '' : ' checked="checked" '; ?>>H21</li>
<li><input type="checkbox" class="polyprops" name="polyprops[4]" value="EULER" title="Euler #" <?php echo empty($_GET['polyprops'][4]) ? '' : ' checked="checked" '; ?>>Euler #</li>
<li><input type="checkbox" class="polyprops" name="polyprops[5]" value="FAV" title="Favorable?" <?php echo empty($_GET['polyprops'][5]) ? '' : ' checked="checked" '; ?>>Favorable?</li>
<li><input type="checkbox" class="polyprops" name="polyprops[6]" value="NNVERTS" title="# of Newton Polytope Vertices" <?php echo empty($_GET['polyprops'][6]) ? '' : ' checked="checked" '; ?>># of Newton Polytope Vertices</li>
<li><input type="checkbox" class="polyprops" name="polyprops[7]" value="NNPOINTS" title="# of Newton Polytope Points" <?php echo empty($_GET['polyprops'][7]) ? '' : ' checked="checked" '; ?>># of Newton Polytope Points</li>
<li><input type="checkbox" class="polyprops" name="polyprops[8]" value="NVERTS" title="Newton Polytope Vertex Matrix" <?php echo empty($_GET['polyprops'][8]) ? '' : ' checked="checked" '; ?>>Newton Polytope Vertex Matrix</li>
<li><input type="checkbox" class="polyprops" name="polyprops[9]" value="NDVERTS" title="# of Dual Polytope Vertices" <?php echo empty($_GET['polyprops'][9]) ? '' : ' checked="checked" '; ?>># of Dual Polytope Vertices</li>
<li><input type="checkbox" class="polyprops" name="polyprops[10]" value="NDPOINTS" title="# of Dual Polytope Points" <?php echo empty($_GET['polyprops'][10]) ? '' : ' checked="checked" '; ?>># of Dual Polytope Points</li>
<li><input type="checkbox" class="polyprops" name="polyprops[11]" value="DVERTS" title="Dual Polytope Vertex Matrix" <?php echo empty($_GET['polyprops'][11]) ? '' : ' checked="checked" '; ?>>Dual Polytope Vertex Matrix</li>
<li><input type="checkbox" class="polyprops" name="polyprops[12]" value="DRESVERTS" title="Dual Polytope Resolved Vertex Matrix" <?php echo empty($_GET['polyprops'][12]) ? '' : ' checked="checked" '; ?>>Dual Polytope Resolved Vertex Matrix</li>
<li><input type="checkbox" class="polyprops" name="polyprops[13]" value="CWS" title="Weight Matrix" <?php echo empty($_GET['polyprops'][13]) ? '' : ' checked="checked" '; ?>>Weight Matrix</li>
<li><input type="checkbox" class="polyprops" name="polyprops[14]" value="RESCWS" title="Resolved Weight Matrix" <?php echo empty($_GET['polyprops'][14]) ? '' : ' checked="checked" '; ?>>Resolved Weight Matrix</li>
<li><input type="checkbox" class="polyprops" name="polyprops[15]" value="DTOJ" title="Toric to Basis Divisor Transformation Matrix" <?php echo empty($_GET['polyprops'][15]) ? '' : ' checked="checked" '; ?>>Toric to Basis Divisor Transformation Matrix</li>
<li><input type="checkbox" class="polyprops" name="polyprops[16]" value="BASIS" title="Basis from Toric Divisors" <?php echo empty($_GET['polyprops'][16]) ? '' : ' checked="checked" '; ?>>Basis from Toric Divisors</li>
<li><input type="checkbox" class="polyprops" name="polyprops[17]" value="JTOD" title="Basis to Toric Divisor Transformation Matrix" <?php echo empty($_GET['polyprops'][17]) ? '' : ' checked="checked" '; ?>>Basis to Toric Divisor Transformation Matrix</li>
<li><input type="checkbox" class="polyprops" name="polyprops[18]" value="INVBASIS" title="Toric from Basis Divisors" <?php echo empty($_GET['polyprops'][18]) ? '' : ' checked="checked" '; ?>>Toric from Basis Divisors</li>
<li><input type="checkbox" class="polyprops" name="polyprops[19]" value="FUNDGP" title="Fundamental Group" <?php echo empty($_GET['polyprops'][19]) ? '' : ' checked="checked" '; ?>>Fundamental Group</li>
<li><input type="checkbox" class="polyprops" name="polyprops[20]" value="NGEOMS" title="# of Geometries (within polytope)" <?php echo empty($_GET['polyprops'][20]) ? '' : ' checked="checked" '; ?>># of Geometries (within polytope)</li>
<li><input type="checkbox" class="polyprops" name="polyprops[21]" value="NALLTRIANGS" title="# of Triangulations (within polytope)" <?php echo empty($_GET['polyprops'][21]) ? '' : ' checked="checked" '; ?>># of Triangulations (within polytope)</li>
</ul>
</div>

<div class="propcol">
<ul>
<p>Select CY Geometry Properties:</p>
<li><input type="checkbox" class="geomprops" name="geomprops[0]" value="GEOMN" title="Geometry # (within polytope)" <?php echo empty($_GET['geomprops'][0]) ? '' : ' checked="checked" '; ?>>Geometry # (within polytope)</li>
<li><input type="checkbox" class="geomprops" name="geomprops[1]" value="NTRIANGS" title="# of Triangulations (within geometry)" <?php echo empty($_GET['geomprops'][1]) ? '' : ' checked="checked" '; ?>># of Triangulations (within geometry)</li>
<li><input type="checkbox" class="geomprops" name="geomprops[2]" value="CHERN2XJ" title="CY 2nd Chern Class (Basis)" <?php echo empty($_GET['geomprops'][2]) ? '' : ' checked="checked" '; ?>>CY 2nd Chern Class (Basis)</li>
<li><input type="checkbox" class="geomprops" name="geomprops[3]" value="CHERN2XNUMS" title="CY 2nd Chern Numbers" <?php echo empty($_GET['geomprops'][3]) ? '' : ' checked="checked" '; ?>>CY 2nd Chern Numbers</li>
<li><input type="checkbox" class="geomprops" name="geomprops[4]" value="IPOLYXJ" title="CY Intersection Polynomial (Basis)" <?php echo empty($_GET['geomprops'][4]) ? '' : ' checked="checked" '; ?>>CY Intersection Polynomial (Basis)</li>
<li><input type="checkbox" class="geomprops" name="geomprops[5]" value="ITENSXJ" title="CY Intersection Tensor (Basis)" <?php echo empty($_GET['geomprops'][5]) ? '' : ' checked="checked" '; ?>>CY Intersection Tensor (Basis)</li>
<li><input type="checkbox" class="geomprops" name="geomprops[6]" value="MORIMAT" title="CY Mori Cone Matrix" <?php echo empty($_GET['geomprops'][6]) ? '' : ' checked="checked" '; ?>>CY Mori Cone Matrix</li>
<li><input type="checkbox" class="geomprops" name="geomprops[7]" value="KAHLERMAT" title="CY Kahler Cone Matrix" <?php echo empty($_GET['geomprops'][7]) ? '' : ' checked="checked" '; ?>>CY Kahler Cone Matrix</li>
<li><input type="checkbox" class="geomprops" name="geomprops[8]" value="TORICSWISSCHEESE" title="Toric Swiss Cheese Solutions" <?php echo empty($_GET['geomprops'][8]) ? '' : ' checked="checked" '; ?>>Toric Swiss Cheese Solutions</li>
<li><input type="checkbox" class="geomprops" name="geomprops[9]" value="EXPLICITSWISSCHEESE" title="Explicit Swiss Cheese Solutions" <?php echo empty($_GET['geomprops'][9]) ? '' : ' checked="checked" '; ?>>Explicit Swiss Cheese Solutions</li>
</ul>
</div>

<div class="propcol">
    <ul>
    <p>Select Triangulation-Specific Properties:</p>
        <li><input type="checkbox" class="triangprops" name="triangprops[0]" value="TRIANGN" title="Triangulation # (within geometry)" <?php echo empty($_GET['triangprops'][0]) ? '' : ' checked="checked" '; ?>>Triangulation # (within geometry)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[1]" value="ALLTRIANGN" title="Triangulation # (within polytope)" <?php echo empty($_GET['triangprops'][1]) ? '' : ' checked="checked" '; ?>>Triangulation # (within polytope)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[2]" value="TRIANG" title="Triangulation" <?php echo empty($_GET['triangprops'][2]) ? '' : ' checked="checked" '; ?>>Triangulation</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[3]" value="SRIDEAL" title="Stanley-Reisner Ideal" <?php echo empty($_GET['triangprops'][3]) ? '' : ' checked="checked" '; ?>>Stanley-Reisner Ideal</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[4]" value="CHERNAD" title="Ambient Chern Classes (Toric)" <?php echo empty($_GET['triangprops'][4]) ? '' : ' checked="checked" '; ?>>Ambient Chern Classes (Toric)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[5]" value="CHERNAD" title="Ambient Chern Classes (Basis)" <?php echo empty($_GET['triangprops'][5]) ? '' : ' checked="checked" '; ?>>Ambient Chern Classes (Basis)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[6]" value="CHERN2XD" title="CY 2nd Chern Class (Toric)" <?php echo empty($_GET['triangprops'][6]) ? '' : ' checked="checked" '; ?>>CY 2nd Chern Class (Toric)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[7]" value="CHERN3XD" title="CY 3rd Chern Class (Toric)" <?php echo empty($_GET['triangprops'][7]) ? '' : ' checked="checked" '; ?>>CY 3rd Chern Class (Toric)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[8]" value="CHERN3XJ" title="CY 3rd Chern Class (Basis)" <?php echo empty($_GET['triangprops'][8]) ? '' : ' checked="checked" '; ?>>CY 3rd Chern Class (Basis)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[9]" value="IPOLYAD" title="Ambient Intersection Polynomial (Toric)" <?php echo empty($_GET['triangprops'][9]) ? '' : ' checked="checked" '; ?>>Ambient Intersection Polynomial (Toric)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[10]" value="ITENSAD" title="Ambient Intersection Tensor (Toric)" <?php echo empty($_GET['triangprops'][10]) ? '' : ' checked="checked" '; ?>>Ambient Intersection Tensor (Toric)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[11]" value="IPOLYAJ" title="Ambient Intersection Polynomial (Basis)" <?php echo empty($_GET['triangprops'][11]) ? '' : ' checked="checked" '; ?>>Ambient Intersection Polynomial (Basis)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[12]" value="ITENSAJ" title="Ambient Intersection Tensor (Basis)" <?php echo empty($_GET['triangprops'][12]) ? '' : ' checked="checked" '; ?>>Ambient Intersection Tensor (Basis)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[13]" value="IPOLYXD" title="CY Intersection Polynomial (Toric)" <?php echo empty($_GET['triangprops'][13]) ? '' : ' checked="checked" '; ?>>CY Intersection Polynomial (Toric)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[14]" value="ITENSXD" title="CY Intersection Tensor (Toric)" <?php echo empty($_GET['triangprops'][14]) ? '' : ' checked="checked" '; ?>>CY Intersection Tensor (Toric)</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[15]" value="MORIMATP" title="Phase Mori Cone Matrix" <?php echo empty($_GET['triangprops'][15]) ? '' : ' checked="checked" '; ?>>Phase Mori Cone Matrix</li>
        <li><input type="checkbox" class="triangprops" name="triangprops[16]" value="KAHLERMATP" title="Phase Kahler Cone Matrix" <?php echo empty($_GET['triangprops'][16]) ? '' : ' checked="checked" '; ?>>Phase Kahler Cone Matrix</li>
    </ul>
</div>

<div id="extracol">
<div class="extra">
<!--<input type="checkbox" name="count" value="true" onclick="document.getElementById('limit').disabled=this.checked;" <?php echo empty($_GET['count']) ? '' : ' checked="checked" '; ?>>Count Only-->
Count Only:&nbsp;&nbsp;
<select name="count" id="count" onchange="counttoggle(this.value)">
<option value="NONE" <?php if($_GET['count']=='NONE' or empty($_GET)){echo "selected='selected'";}?>>--</option>
<option value="POLY" <?php if($_GET['count']=='POLY'){echo "selected='selected'";}?>>Polytopes</option>
<option value="GEOM" <?php if($_GET['count']=='GEOM'){echo "selected='selected'";}?>>Geometries</option>
<option value="TRIANG" <?php if($_GET['count']=='TRIANG'){echo "selected='selected'";}?>>Triangulations</option>
</select>
</div>
<!--<div class="extra">
Sort by:&nbsp;&nbsp;
<select name="sortby" id="sortby">
<option value="POLYID" <?php //if($_GET['sortby']=='POLYID' or empty($_GET)){echo "selected='selected'";}?>>Polytope ID #</option>
<option value="POLYN" <?php //if($_GET['sortby']=='POLYN'){echo "selected='selected'";}?>>Polytope #</option>
<option value="H11" <?php //if($_GET['sortby']=='H11'){echo "selected='selected'";}?>>H11</option>
<option value="H21" <?php //if($_GET['sortby']=='H21'){echo "selected='selected'";}?>>H21</option>
<option value="EULER" <?php //if($_GET['sortby']=='EULER'){echo "selected='selected'";}?>>Euler #</option>
<option value="FAV" <?php //if($_GET['sortby']=='FAV'){echo "selected='selected'";}?>>Favorable?</option>
<option value="NNVERTS" <?php //if($_GET['sortby']=='NNVERTS'){echo "selected='selected'";}?>># of Newton Polytope Vertices</option>
<option value="NNPOINTS" <?php //if($_GET['sortby']=='NNPOINTS'){echo "selected='selected'";}?>># of Newton Polytope Points</option>
<option value="NDVERTS" <?php //if($_GET['sortby']=='NDVERTS'){echo "selected='selected'";}?>># of Dual Polytope Vertices</option>
<option value="NDPOINTS" <?php //if($_GET['sortby']=='NDPOINTS'){echo "selected='selected'";}?>># of Dual Polytope Points</option>
<option value="FUNDGP" <?php //if($_GET['sortby']=='FUNDGP'){echo "selected='selected'";}?>>Fundamental Group</option>
<option value="NGEOMS" <?php //if($_GET['sortby']=='NGEOMS'){echo "selected='selected'";}?>># of Geometries (within polytope)</option>
<option value="NALLTRIANGS" <?php //if($_GET['sortby']=='NALLTRIANGS'){echo "selected='selected'";}?>># of Triangulations (within polytope)</option>
<option value="GEOMN" <?php //if($_GET['sortby']=='GEOMN'){echo "selected='selected'";}?>>Geometry # (within polytope)</option>
<option value="NTRIANGS" <?php //if($_GET['sortby']=='NTRIANGS'){echo "selected='selected'";}?>># of Triangulations (within geometry)</option>
<option value="TRIANGN" <?php //if($_GET['sortby']=='TRIANGN'){echo "selected='selected'";}?>>Triangulation # (within geometry)</option>
<option value="ALLTRIANGN" <?php //if($_GET['sortby']=='ALLTRIANGN'){echo "selected='selected'";}?>>Triangulation # (within polytope)</option>
</select>
<br><br>
<input type="checkbox" name="reverse" id="reverse" value="reversed">Reverse
<select name="orient" id="orient">
<option value="1" <?php //if($_GET['orient']=='1' or empty($_GET)){echo "selected='selected'";}?>>ASC</option>
<option value="-1" <?php //if($_GET['orient']=='-1'){echo "selected='selected'";}?>>DESC</option>
</select>
</div>-->
<div class="extra">
Match: &nbsp;<input type="text" id="limit" name="limit" value=<?php if(isset($_GET['limit'])){echo $_GET['limit'];}else{echo "0";} ?>>&nbsp;
<select name="matches" id="matches">
<option value="POLY" <?php if($_GET['matches']=='POLY' or empty($_GET)){echo "selected='selected'";}?>>Polytopes</option>
<option value="GEOM" <?php if($_GET['matches']=='GEOM'){echo "selected='selected'";}?>>Geometries</option>
<option value="TRIANG" <?php if($_GET['matches']=='TRIANG'){echo "selected='selected'";}?>>Triangulations</option>
</select>
<br>
<p>(0 = Unconstrained)</p>
<br>
</div>
<br>
<div class="dbsubmit"><input type="submit" name="submit" value="Search!"></div>
<!--<div class="dbsubmit"><input type="submit" name="save" value="Save to File!"></div>-->
</div>
</div>

</div>
<!--<input type="submit" style="visibility: hidden;" />-->
</form>
</div>
<br><br><br>

<?php if(isset($_GET['mongocode']) and isset($_GET['submit'])){ ?>
<div id="buttons">
<button id="copy-button" class="export">Copy table to clipboard.</button>
<br><br>
<div id="savewrap">
<button id="save-button" onclick="tableToCSV()" class="export">Save table to file.</button>
<!--<p id="downloadify"></p>-->
</div>
</div>
<?php } ?>
</div>
<br>
<div class="trow">
<div id="main">
<br><br>
<?php
if(isset($_GET['mongocode']) and isset($_GET['submit'])){
	try {
//         MongoCursor::$timeout = -1;
//         $m = new MongoClient("mongodb://frontend:password@168.235.102.185:27017/ToricCY");
// 		$db = $m->selectDB("ToricCY");
// 		$polycoll = $db->selectCollection("POLY");
//         $geomcoll = $db->selectCollection("GEOM");
//         $triangcoll = $db->selectCollection("TRIANG");
//         $swisscheesecoll = $db->selectCollection("SWISSCHEESE");
        require_once __DIR__ . "/vendor/autoload.php";
        $m = new MongoDB\Client("mongodb://frontend:password@168.235.102.185:27017/ToricCY");
        $db = $m->ToricCY;
        $polycoll = $db->POLY;
        $geomcoll = $db->GEOM;
        $triangcoll = $db->TRIANG;
        $swisscheesecoll = $db->SWISSCHEESE;

        $limit=intval($_GET['limit']);
        $limit=($limit==0 ? -1 : $limit);
        $matches=$_GET['matches'];
        $count=$_GET['count'];
        $mongo=$_GET['mongocode'];

        $moddict=array("POLY"=>"Polytopes","GEOM"=>"Geometries","TRIANG"=>"Triangulations");

        $polydict=array("POLYID"=>"Polytope ID #","POLYN"=>"Polytope # (within H11)","H11"=>"H11","H21"=>"H21","EULER"=>"Euler #","FAV"=>"Favorable?","NGEOMS"=>"# of Geometries (within polytope)","NALLTRIANGS"=>"# of Triangulations (within polytope)","FUNDGP"=>"Fundamental Group","NNVERTS"=>"# of Newton Polytope Vertices","NNPOINTS"=>"# of Newton Polytope Points","NVERTS"=>"Newton Polytope Vertex Matrix","NDVERTS"=>"# of Dual Polytope Vertices","NDPOINTS"=>"# of Dual Polytope Points","DVERTS"=>"Dual Polytope Vertex Matrix","DRESVERTS"=>"Dual Polytope Resolved Vertex Matrix","CWS"=>"Weight Matrix","RESCWS"=>"Resolved Weight Matrix","DTOJ"=>"Toric to Basis Divisor Transformation Matrix","BASIS"=>"Basis from Toric Divisors","JTOD"=>"Basis to Toric Divisor Transformation Matrix","INVBASIS"=>"Toric from Basis Divisors");
        $geomdict=array("GEOMN"=>"Geometry # (within polytope)","NTRIANGS"=>"# of Triangulations (within geometry)","IPOLYXJ"=>"CY Intersection Polynomial (Basis)","ITENSXJ"=>"CY Intersection Tensor (Basis)","CHERN2XJ"=>"CY 2nd Chern Class (Basis)","CHERN2XNUMS"=>"CY 2nd Chern Numbers","MORIMAT"=>"CY Mori Cone Matrix","KAHLERMAT"=>"CY Kahler Cone Matrix","SWISSCHEESE"=>"Swiss Cheese Solutions");
        $triangdict=array("TRIANGN"=>"Triangulation # (within geometry)","ALLTRIANGN"=>"Triangulation # (within polytope)","TRIANG"=>"Triangulation","SRIDEAL"=>"Stanley-Reisner Ideal","CHERNAD"=>"Ambient Chern Classes (Toric)","CHERNAJ"=>"Ambient Chern Classes (Basis)","CHERN2XD"=>"CY 2nd Chern Class (Toric)","CHERN3XD"=>"CY 3rd Chern Class (Toric)","CHERN3XJ"=>"CY 3rd Chern Class (Basis)","IPOLYAD"=>"Ambient Intersection Polynomial (Toric)","ITENSAD"=>"Ambient Intersection Tensor (Toric)","IPOLYAJ"=>"Ambient Intersection Polynomial (Basis)","ITENSAJ"=>"Ambient Intersection Tensor (Basis)","IPOLYXD"=>"CY Intersection Polynomial (Toric)","ITENSXD"=>"CY Intersection Tensor (Toric)","MORIMATP"=>"Phase Mori Cone Matrix","KAHLERMATP"=>"Phase Kahler Cone Matrix");
        $toricswisscheesedict=array("NLARGE"=>"# of Large Cycles","RMAT2CYCLE"=>"2-Cycle Rotation Matrix","RMAT4CYCLE"=>"4-Cycle Rotation Matrix","INTBASIS2CYCLE"=>"2-Cycle Z-Basis?","INTBASIS4CYCLE"=>"4-Cycle Z-Basis?","HOM"=>"Homogeneity Condition Satisfied?");
        $explicitswisscheesedict=array("RMAT2CYCLE"=>"Diagonal 2-Cycle Rotation Matrix","DIAGCOEFFS"=>"Diagonal Volume Coefficients");

        $mongosearch=json_decode($mongo,true);
        if (empty($mongosearch)) {
            $mongosearch=array();
        }

        $polymongosearch=array();
        $geommongosearch=array();
        $triangmongosearch=array();
        $swisscheesemongosearch=array();
        foreach ($mongosearch as $key=>$val) {
            $keysplit=explode('.',$key);
            $k=$keysplit[0];
            if (array_key_exists($k,$polydict)) {
                $polymongosearch[$key]=$val;
            } elseif (array_key_exists($k,$geomdict)) {
                $geommongosearch[$key]=$val;
            } elseif (array_key_exists($k,$triangdict)) {
                $triangmongosearch[$key]=$val;
            } elseif (array_key_exists($k,array_merge($toricswisscheesedict,$explicitswisscheesedict))) {
                $swisscheesemongosearch[$key]=$val;
            }
        }
        
        $polyprops=(isset($_GET['polyprops']) ? $_GET['polyprops'] : array());
        $polyones=array_fill(0,sizeof($polyprops),1);
        $polymongoprops=array_combine($polyprops,$polyones);

        $geomprops=(isset($_GET['geomprops']) ? $_GET['geomprops'] : array());

        $toricswisscheeseprops=in_array("TORICSWISSCHEESE",$geomprops) ? array_keys($toricswisscheesedict) : array();
        $toricswisscheeseones=array_fill(0,sizeof($toricswisscheesedict),1);

        $explicitswisscheeseprops=in_array("EXPLICITSWISSCHEESE",$geomprops) ? array_keys($explicitswisscheesedict) : array();
        $explicitswisscheeseones=array_fill(0,sizeof($explicitswisscheesedict),1);
        
        $swisscheesemongoprops=array_combine(array_keys($toricswisscheesedict),$toricswisscheeseones);
        $swisscheesemongoprops['EXPLICIT']=1;

        $geomprops=array_diff($geomprops,array('TORICSWISSCHEESE','EXPLICITSWISSCHEESE'));
        $geomones=array_fill(0,sizeof($geomprops),1);
        $geommongoprops=array_combine($geomprops,$geomones);

        $triangprops=(isset($_GET['triangprops']) ? $_GET['triangprops'] : array());
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
        echo json_encode($polymongosearch, JSON_PRETTY_PRINT);
        echo json_encode($geommongosearch, JSON_PRETTY_PRINT);
        echo json_encode($triangmongosearch, JSON_PRETTY_PRINT);

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
                $swisscheesecurs=$swisscheesecoll->find(array_merge($swisscheesemongosearch,array('POLYID'=>$polydoc['POLYID'],'GEOMN'=>$geomdoc['GEOMN'])),$swisscheesemongoprops)->toArray();
//                 if (empty($swisscheesemongosearch) and !$swisscheesecurs->hasNext()) {
//                     $swisscheesecurs=array(array());
//                 }
                if (empty($swisscheesecurs)) {
                    $swisscheesecurs=array(array());
                }
                $triangcurs=$triangcoll->find(array_merge($triangmongosearch,array('POLYID'=>$polydoc['POLYID'],'GEOMN'=>$geomdoc['GEOMN'])),$triangmongoprops)->toArray();
                $swisscheesecount=1;
//                 echo json_encode($swisscheesedoc, JSON_PRETTY_PRINT);
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
                            $geomprinted=true;
                            $polyprinted=true;
                        }
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

var client = new ZeroClipboard( $('#copy-button') );
client.on( 'ready', function(event) {
    
    client.on( 'copy', function(event) {
        var lst=listify();
        event.clipboardData.setData('text/plain', lst);
    } );
    
    client.on( 'aftercopy', function(event) {
        alert('Table copied to clipboard.');
    } );
} );
client.on( 'error', function(event) {
    alert('ZeroClipboard error of type \"' + event.name + '\": ' + event.message );
    ZeroClipboard.destroy();
} );
</script>

<script type="text/javascript">
var saveButton = $("#save-button");

var saveButtonWidth = saveButton.outerWidth();
var saveButtonHeight = saveButton.outerHeight();

Downloadify.create('downloadify',{
    filename: function(){
        return 'cytable.txt';
    },
    data: listify(),
    onComplete: function(){
        alert('Table saved to file.');
    },
    onError: function(){ 
        alert('Error: Table cannot be saved.'); 
    },
    transparent: true,
    swf: 'downloadify/media/downloadify.swf',
    downloadImage: 'downloadify/images/transparent.png',
    width: saveButtonWidth,
    height: saveButtonHeight,
    transparent:true,
    append: false
});

var saveWrap = $('#savewrap');
saveWrap.css( { 'width': saveButtonWidth, 'height': saveButtonHeight, 'position': 'relative', 'margin-top':-25} );
var saveWrapPosition = saveWrap.position();
saveWrap.mouseover(function(){saveButton.css({'cursor':'text'});});
saveWrap.mousedown(function(){saveButton.css({'background':'linear-gradient(to bottom right, #737373, #ABAAA9)'});});
saveWrap.mouseout(function(){saveButton.css({'background':'linear-gradient(to bottom right, #ABAAA9, #737373)'});});

var flashObject = $('#downloadify');
flashObject.css( { 'width': saveButtonWidth, 'height': saveButtonHeight, 'position':'relative', 'top':saveWrapPosition.top, 'left':saveWrapPosition.left, 'z-index': 2} );
flashObject.mouseover(function(){saveButton.css({'cursor':'text'});});
flashObject.mousedown(function(){saveButton.css({'background':'linear-gradient(to bottom right, #737373, #ABAAA9)'});});
flashObject.mouseout(function(){saveButton.css({'background':'linear-gradient(to bottom right, #ABAAA9, #737373)'});});

saveButton.css( { 'position':'absolute', 'top':saveWrapPosition.top, 'left':saveWrapPosition.left, 'z-index': 1 } );
</script>

<script type="text/javascript">

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


<!--<script type="text/javascript">
window.onload = function() { 
    sorttable.init();
    var myTH = document.getElementsByTagName("th")[0];
    sorttable.innerSortFunction.apply(myTH, []);
};
</script>-->

<script type="text/javascript">
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
</script>

<?php } ?>

<script>
  var editor = CodeMirror.fromTextArea(document.getElementById("mongocode"), {
     mode: "application/json",
     lineNumbers: false,
     tabMode: "indent",
     matchBrackets: true,
     cursorHeight: 0.5,
     theme: "mdn-like",
     autofocus: true,
     extraKeys: {"Ctrl-Space": "autocomplete", "Enter": function(cm) {
          document.getElementById("mongoinform").submit();
        }},
     searchMode: 'inline',
     showCursorWhenSelecting: true,
     onCursorActivity: function () {
       editor.setLineClass(hlLine, null);
       hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
     }
   });
  editor.setSize(null, 100);

   var hlLine = editor.setLineClass(0, "activeline");
</script>

<script type="text/javascript">
   function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
   }

   function counttoggle(value) {
        document.getElementById('limit').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('limit').onclick = function() { return false; };
        document.getElementById('matches').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('matches').onclick = function() { return false; };

        //document.getElementById('polymatchby').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('geommatchby').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('triangmatchby').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('reverse').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('polyorient').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('geomorient').disabled = (value != 'NONE') ? true : false;
        //document.getElementById('triangorient').disabled = (value != 'NONE') ? true : false;
        var polyelems=document.getElementsByClassName('polyprops');
        var geomelems=document.getElementsByClassName('geomprops');
        var triangelems=document.getElementsByClassName('triangprops');
        for(var i=0;i<polyelems.length;i++) {
            polyelems[i].disabled = (value != 'NONE') ? true : false;
            /*if(polyelems[i].hasAttribute('onclick')) {
                polyelems[i].onclick = function() { return true; };
            } else {
                polyelems[i].onclick = function() { return false; };
            }*/
        }
        for(var i=0;i<geomelems.length;i++) {
            geomelems[i].disabled = (value != 'NONE') ? true : false;
            /*if(geomelems[i].hasAttribute('onclick')) {
                geomelems[i].removeAttribute('onclick');
            } else {
                geomelems[i].onclick = function() { return false; };
            }*/
        }
        for(var i=0;i<triangelems.length;i++) {
            triangelems[i].disabled = (value != 'NONE') ? true : false;
            /*if(triangelems[i].hasAttribute('onclick')) {
                triangelems[i].removeAttribute('onclick');
            } else {
                triangelems[i].onclick = function() { return false; };
            }*/
        }
    }

    counttoggle(document.getElementById('count').value);
</script>

<script>
$(function(){
  $('#navcontainer').css({ height: $(window).innerHeight() });
  $(window).resize(function(){
    $('#navcontainer').css({ height: $(window).innerHeight() });
  });
});
</script>

<!--<script type="text/javascript">
function getContent(){
    document.getElementById("sqltext").value = document.getElementById("mongobox").innerHTML;
}

$('#mongobox').keydown(function (event) {
    var keypressed = event.keyCode || event.which;
    if (keypressed == 13) {
        $(this).closest('form').submit();
    }
});
</script>-->

</body>
</html>
