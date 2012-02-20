<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>--JobSkillSearcher--</title>
<link type="image/x-icon" href="media/img/logoweb.png" rel="shortcut icon"/>
<link media="screen" rel="stylesheet" type="text/css" href="media/css/estilos.css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script language="JavaScript" src="media/javascript/jstemplate1.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery-1.2.3.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.easing.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.lavalamp.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/ajax.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.blockUI.js" type="text/javascript"></script>
   
    <script type="text/javascript">
        $(function() {
            $("#nav").lavaLamp({
                fx: "backout",
                speed: 700,
                click: function(event, menuItem) {
                    return false;
                }
            });
        });
    </script>
<script type="text/javascript">
function ajaxFunction() {
  var xmlHttp;
  
  try {
   
    xmlHttp=new XMLHttpRequest();
    return xmlHttp;
  } catch (e) {
    
    try {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      return xmlHttp;
    } catch (e) {
      
	  try {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        return xmlHttp;
      } catch (e) {
        alert("Tu navegador no soporta AJAX!");
        return false;
      }}}
}

function sendData(_page,capa) {
    var ajax;
    ajax = ajaxFunction();
    ajax.open("POST", _pagina, true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function() {
		if (ajax.readyState==1){
			document.getElementById(capa).innerHTML = " Wait,pelase ...";
			     }
		if (ajax.readyState == 4) {
		   
                document.getElementById(capa).innerHTML=ajax.responseText; 
		     }}
			 
	ajax.send(null);
} 

</script>


</head>

<body>
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="/jss"> <img src="media/img/title_beta.png"> </a>
			</div>
			<div id=searcher>
				<form action="" method="GET">
					<label for="s1">Search!</label> <input type="text" name="q" id="txtSearch" autocomplete="on" onkeyup="" on alt="Search Criteria">
					<button id="go"type="submit">GO!</button>
					<div id="search_suggest" style="display:none" ></div>
				</form>
			</div>
			<div class="nofloat"></div>
		</div>						
<?php

header('Content-Type: text/html; charset=iso-8859-1');
//$timestart = explode (' ', microtime());
//$noofwords = 0;
$error = "";
$flagerror = false;
$search = $_GET['q'];
$cuenta=0;

$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("JSSdb3", $conexion); 

$consulta = "SELECT * FROM words WHERE (word='$search');";
$resconsulta = mysql_query($consulta,$conexion) or die(mysql_error());
$col = mysql_num_rows($resconsulta);

if (!$col>0){
	
	if ($search == "")
		header('Location:error404.php');
	else
		header('Location: error404.php');
	
	$flagerror = true;
}

$row = mysql_fetch_assoc($resconsulta);
$wordid = $row['id'];

if (!$flagerror && $col>0){
	$querydim = "SELECT * FROM wlist WHERE wid=$wordid; ";
	$cadena="";
	
	$resquerydim= mysql_query($querydim, $conexion) or die(mysql_error());
	$rowquerydim = mysql_num_rows($resquerydim);
	
	while ($row2 = mysql_fetch_assoc($resquerydim)){
		$jid = $row2['jid'];
		if ($cadena == "")
			$cadena=$cadena . "jid=$jid";
		else
			$cadena=$cadena ." OR jid=$jid" ;
	}
	
	
	$queEmp = "SELECT word, type, count(word) as lkm FROM wlist LEFT JOIN words ON wlist.wid=words.id 
		WHERE ($cadena) AND type!=3 AND type!=0 AND type!=701 GROUP BY word ORDER BY lkm DESC, word;";
	
	
	//echo "$queEmp";  
	
	$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
	$totEmp = mysql_num_rows($resEmp);
	
	$query3 = "SELECT * FROM hjh_term_group; ";
	$resquery3 = mysql_query($query3, $conexion) or die(mysql_error());
	$totquery3 = mysql_num_rows($resquery3);
	
	// insert into log
	//$query4 = "INSERT INTO searchlog VALUES ('$term', $noofjids, $noofwords, '$totaltime', NULL, '$ip');";
	
	//if ( !$result = mysql_query($query4, $connection) ) {
	//	die('Could not execute the query: ' . mysql_error($connection));
	//}
	
	// echo "$query";
	
	mysql_close($conexion);
	
	
}


$listMain = array("5001","5002","5006","5007","5008","5009","5013","5024","5023","5036","5037","5038","5040","5041","5042","5043","5069");
$listKnow = array("5025","5026","5030","5032");
$listPers = array("5003","5027","5028","5029","5031","5033","5034","5035","5039");
$listOths = array("5004","5005","5010","5054","5055","5056","5057","5058","5059","5060","5061","5062","5063","5064","5066","5067","5068");

// Aqui estan los tipos de palabras que deben contener a otras 
$listcodes = array();
if ($totquery3 >0){
	while ( $rowquery3 = mysql_fetch_assoc($resquery3) ) {
		$listcodes[$rowquery3['id']]= $rowquery3['name'];			
		
	}
}


//DO liST

$list1 = array();
$list2 = array();
$list3 = array();
$list4 = array();

if ($totEmp> 0) {
	while ($rowEmp = mysql_fetch_assoc($resEmp)) {
//		echo $rowEmp['type'];
//		echo "<a href= '?q=".$rowEmp['word']."'<strong>".$rowEmp['word']. "</strong></a>";
//		echo " (<label>".$rowEmp['lkm']."</label> results)";
//		echo "<p>";
		
		if (in_array($rowEmp['type'],$listMain)){
			if (array_key_exists($rowEmp['type'],$list1)){
				$aux=$list1[$rowEmp['type']];
				array_push($aux,$rowEmp['word']." (<label>".$rowEmp['lkm']."</label> results)");
				$list1[$rowEmp['type']]=$aux;
			}
			else {
				$aux = array($rowEmp['word']." (<label>".$rowEmp['lkm']."</label> results)");
				$list1[$rowEmp['type']]=$aux;
			}
		}
		if (in_array($rowEmp['type'],$listKnow)){
			if (array_key_exists($rowEmp['type'],$list2)){
				$aux=$list2[$rowEmp['type']];
				array_push($aux,$rowEmp['word']." (<label>".$rowEmp['lkm']."</label>  results)");
				$list2[$rowEmp['type']]=$aux;
			}
			else {
				$aux = array($rowEmp['word']." (<label>".$rowEmp['lkm']."</label>  results)");
				$list2[$rowEmp['type']]=$aux;
			}
		}
		if (in_array($rowEmp['type'],$listPers)){
			if (array_key_exists($rowEmp['type'],$list3)){
				$aux=$list3[$rowEmp['type']];
				array_push($aux,$rowEmp['word']." (<label>".$rowEmp['lkm']."</label>  results)");
				$list3[$rowEmp['type']]=$aux;
			}
			else {
				$aux = array($rowEmp['word']." (<label>".$rowEmp['lkm']."</label>  results)");
				$list3[$rowEmp['type']]=$aux;
			}
		}
		if (in_array($rowEmp['type'],$listOths)){
			if (array_key_exists($rowEmp['type'],$list4)){
				$aux=$list4[$rowEmp['type']];
				array_push($aux,$rowEmp['word']." (<label>".$rowEmp['lkm']."</label> results)");
				$list4[$rowEmp['type']]=$aux;
			}
			else {
				$aux = array($rowEmp['word']." (<label>".$rowEmp['lkm']."</label>  results)");
				$list4[$rowEmp['type']]=$aux;
			}
		}
	}
}

?>  		

		<div id="boxsearch">
			<div id="search">

				<?php
				
				 if (!$error)
				 	echo "<div id='number'>This word appears in ".$row['count']. " advertisements</div><div id='word'>".utf8_decode($row['word'])." </div>"; 
				 else
				 	echo "<h2>No results found :</h2>" 
				 
				 ?>
				 	
			</div>
		</div>
		
		<div id="tabs">
			<ul>
				<li>
					<?php echo "<a href= 'results.php?q=".$search."' id='tab1'><span>Look word results<span/></a>";?>
					
					</a>
				</li>
				<li>
					<a title="Link 2" href="#">
					<?php echo "<a href= 'trends.php?q=".$search."' id='tab2'><span>Look word trend<span/></a>";?>
					</a>
				</li>
			</ul>
		</div>
		
		<br>
		<div id="contnav">
		<ul class="lavaLampWithImage" id="nav">
    		<li class="current"><a href="#">Main skills required</a>
    		<ul id="main" class="children">
					<?
					$keys1=array_keys($list1);
					for ($i=0; $i<count($keys1); $i ++){
						$cad = substr($keys1[$i],2,3);
						$elem = $listcodes[intval($cad)];	
						echo "<li><a href=\"#\" onclick=\"show('".utf8_decode($elem)."');\">".utf8_decode($elem)."</a></li>";
					}
					?>
          
      		</ul>
      		</li>
    		<li><a href="#">Knowledge</a>
    		<ul id="know" class="children">
					<?
					$keys2=array_keys($list2);
					for ($i=0; $i<count($keys2); $i ++){
						$cad = substr($keys2[$i],2,3);
						$elem = $listcodes[intval($cad)];
						echo "<li><a href=\"#\" onclick=\"show('".utf8_decode($elem)."');\">".utf8_decode($elem)."</a></li>";
					}
					?>
					</ul>
			</li>
    		<li><a href="#">Personal Skills</a>
    		<ul id="pers" class="children">
					<?
					$keys3=array_keys($list3);
					for ($i=0; $i<count($keys3); $i ++){
						$cad = substr($keys3[$i],2,3);
						$elem = $listcodes[intval($cad)];	
						echo "<li><a href=\"#\" onclick=\"show('".utf8_decode($elem)."');\">".utf8_decode($elem)."</a></li>";
					}
					?>
					</ul>
			</li>
    		<li><a href="#">Other Information</a>
    		<ul id="oths" class="children">
    				<?
					$keys4=array_keys($list4);
					for ($i=0; $i<count($keys4); $i ++){
						$cad = substr($keys4[$i],2,3);
						$elem = $listcodes[intval($cad)];	
						echo "<li><a href=\"#\" onclick=\"show('".utf8_decode($elem)."');\">".utf8_decode($elem)."</a></li>";
					}
					?>
    		
    			</ul>
    		</li>
		</ul>
		</div>

		<div id="content">		
		 <div id= "main_content">
			<div id="chart_div"></div>
		</div>
		 		
		 <div id="minimenu">
			<?php
			
			for ($i=0; $i<count($list1); $i++){
				$cad = substr($keys1[$i],2,3);
				echo "<div id='".$listcodes[intval($cad)]."' class='body_menu' style= display:none><div class='title'>".$listcodes[intval($cad)]."</div></br>";
				$line = $list1[$keys1[$i]];
				for ($j=0; $j<count($line);$j++){
					$pos= strpos($line[$j]," ");
					$str1=substr($line[$j],0,$pos);
					$str2= substr($line[$j],$pos+1,strlen($line[$j]));
					
					echo "<div ><a href=\"?q=".$str1."\">".utf8_decode($str1)."</a> ".$str2."</br></div>";
				}
				echo "</div>";
			}
			
				for ($i=0; $i<count($list2); $i++){
				$cad = substr($keys2[$i],2,3);
				echo "<div id='".$listcodes[intval($cad)]."' class='body_menu' style= display:none><div class='title'>".$listcodes[intval($cad)]."</div></br>";
				$line = $list2[$keys2[$i]];
				for ($j=0; $j<count($line);$j++){
					$pos= strpos($line[$j]," ");
					$str1=substr($line[$j],0,$pos);
					$str2= substr($line[$j],$pos+1,strlen($line[$j]));
					
					echo "<div ><a href=\"?q=".$str1."\">".utf8_decode($str1)."</a> ".$str2."</br></div>";
				}
				echo "</br></div>";
			}
			
				for ($i=0; $i<count($list3); $i++){
				$cad = substr($keys3[$i],2,3);
				echo "<div id='".$listcodes[intval($cad)]."' class='body_menu' style= display:none><div class='title'>".$listcodes[intval($cad)]."</div></br>";
				$line = $list3[$keys3[$i]];
				for ($j=0; $j<count($line);$j++){
					$pos= strpos($line[$j]," ");
					$str1=substr($line[$j],0,$pos);
					$str2= substr($line[$j],$pos+1,strlen($line[$j]));
					
					echo "<div ><a href=\"?q=".$str1."\">".utf8_decode($str1)."</a> ".$str2."</br></div>";
				}
				echo "</br></div>";
			}
			
				for ($i=0; $i<count($list4); $i++){
				$cad = substr($keys4[$i],2,3);
				echo "<div id='".$listcodes[intval($cad)]."' class='body_menu' style= display:none><div class='title'>".$listcodes[intval($cad)]."</div></br>";
				$line = $list4[$keys4[$i]];
				for ($j=0; $j<count($line);$j++){
					$pos= strpos($line[$j]," ");
					$str1=substr($line[$j],0,$pos);
					$str2= substr($line[$j],$pos+1,strlen($line[$j]));
					
					echo "<div ><a href=\"?q=".$str1."\">".utf8_decode($str1)."</a> ".$str2."</br></div>";
				}
				echo "</br></div>";
			}
			
			?>
			
			</div>
	
		</div>  
		
		<div id="footer">
			<div id="options">
				This is the footer of the web page
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="media/javascript/jquerydocument.js"></script>
	
	<div id= "menssage" style="display: none;" >
		<h2><img src="media/img/101-5.gif" /> Searching...<h2>
	</div>
</body>

</html>