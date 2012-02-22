<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>--JobSkillSearcher--</title>
<link type="image/x-icon" href="media/img/logoweb.png" rel="shortcut icon"/>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script language="JavaScript" src="media/javascript/jstrends.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery-1.2.3.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.easing.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.lavalamp.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.blockUI.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="media/css/estilos.css">
<script type="text/javascript">
  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/m5AFqBSLPJi05pRDrjhgow.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
</script>


<?php

$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("JSSdb3", $conexion);   
$search = $_GET['q'];

$consulta = "SELECT word,date,count(date) as lkm FROM words,wlist,jannouncement WHERE (words.id = wlist.wid AND jannouncement.id = wlist.jid AND  word ='$search') GROUP BY date;";

$resconsulta = mysql_query($consulta,$conexion) or die(mysql_error());
$col = mysql_num_rows($resconsulta);


// algorith to calculate the trend by week

function semanaISO($fecha){
     
   $fechaaux = array();
   $fechaaux   = explode("-",$fecha); //Dividimos el string de fecha en trozos (dia,mes,año)
   $ano   =   intval($fechaaux[0]);
   $mes   =   intval($fechaaux[1]);
   $dia   =   intval($fechaaux[2]);
      
      
   if ($mes==1 || $mes==2){
      //Cálculos si el mes es Enero o Febrero
      $a   =   $ano-1;
      $b   =   floor($a/4)-floor($a/100)+floor($a/400);
      $c   =   floor(($a-1)/4)-floor(($a-1)/100)+floor(($a-1)/400);
      $s   =   $b-$c;
      $e   =   0;
      $f   =   $dia-1+(31*($mes-1));
   } else {
      //Calculos para los meses entre marzo y Diciembre
      $a   =   $ano;
      $b   =   floor($a/4)-floor($a/100)+floor($a/400);
      $c   =   floor(($a-1)/4)-floor(($a-1)/100)+floor(($a-1)/400);
      $s   =   $b-$c;
      $e   =   $s+1;
      $f   =   $dia+floor(((153*($mes-3))+2)/5)+58+$s;
      
     
   }
   //Adicionalmente sumándole 1 a la variable $f se obtiene numero ordinal del dia de la fecha ingresada con referencia al año actual.

   //Estos cálculos se aplican a cualquier mes
   $g   =   ($a+$b)%7;
   $d   =   ($f+$g-$e)%7; //Adicionalmente esta variable nos indica el dia de la semana 0=Lunes, ... , 6=Domingo.
   $n   =   $f+3-$d;
   
   if ($n<0){
      //Si la variable n es menor a 0 se trata de una semana perteneciente al año anterior
      $semana   =   53-floor(($g-$s)/5);
      $ano      =   $ano-1; 
   } else if ($n>(364+$s)) {
      //Si n es mayor a 364 + $s entonces la fecha corresponde a la primera semana del año siguiente.
      $semana   = 1;
      $ano   =   $ano+1;
   } else {
      //En cualquier otro caso es una semana del año actual.
      $semana   =   floor($n/7)+1;
   };
   
   return $semana."-".$ano; //La función retorna una cadena de texto indicando la semana y el año correspondiente a la fecha ingresada   
};

?>
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

</head>

<body>
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="/jss"> <img src="media/img/title_beta.png"> </a>
			</div>
			<div id=searcher>
				<form action="" method="GET">
					<label for="s1">Search!</label> <input type="text" name="q"
						id="s1" >
					<button id="go" type="submit">GO!</button>
				</form>
			</div>
			<div class="nofloat"></div>
		</div>						
					<?
					//$timestart = explode (' ', microtime());
  					//$noofwords = 0;
					$error = "";
					$flagerror = false;
					
					$consulta2 = "SELECT * FROM words WHERE (word = '$search')";
					
					$resconsulta2 = mysql_query($consulta2,$conexion) or die(mysql_error());
    				$col2 = mysql_num_rows($resconsulta2);
    		
    				if (!$col2>0){
	
					if ($search == "")
						header('Location:error404.php');
					else
						header('Location: error404.php');
	
						$flagerror = true;
					}
    				//muestra el error en la página web
					echo $error;	 
    				
					$row2 = mysql_fetch_assoc($resconsulta2);
    				

 					 mysql_close($conexion);

					
			?>
			
	<div id="boxsearch">
			<div id="search">

				<?php
				
				 if (!$error)
				 	echo "<div id='number'>This word appears in ".$row2['count']. " advertisements</div><div id='word'>".utf8_decode($row2['word'])." </div>"; 
				 else
				 	echo "<h2>No results found :</h2>" 
				 
				 ?>
				 	
			</div>
		</div>
		
		<div id="tabs">
			<ul>
				<li >
					<?php echo "<a href= 'results.php?q=".$search."' id='tab1'><span>Look word results<span/></a>";?>
					
					</a>
				</li>
				<li id="tab2">
					<a title="Link 2" href="#">
					<?php echo "<a href= 'trends.php?q=".$search."' id='tab2'><span>Look word trend<span/></a>";?>
					</a>
				</li>
			</ul>
		</div>
		
		<br>
		<div id="contnav">
		<ul class="lavaLampWithImage" id="nav">
    		<li class="current"><a href="#">Period of time</a>
    		<ul id="m1" class="children">
    			<li><a href="#" onclick="google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',0));actual=0;">whole time</a></li>
    			<li><a href="#" onclick="google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',30));actual=30;"> Last 30 days </a></li>
    			<li><a href="#" onclick="google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',90));actual=90;"> Last 3 months </a></li>
    			<li><a href="#" onclick="google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',180));actual=180;">Last 6 months </a></li>
    			<li><a href="#" onclick="google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',365));actual=180;">1 year </a></li>
    			<li><a href="#" onclick="google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',730));actual=180;">2 years </a></li>
    		</ul>
    		</li>
    		
    		<li><a href="#">Charts</a>
    		<ul id="m2" class="children">
    			<li><a href="#" onclick="realdata=false; google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',actual));">Trends</a></li>
    			<li><a href="#" onclick="realdata=true; google.setOnLoadCallback(drawChartTrends('<?echo $row2['word']?>',actual));">Trends & Data </a></li>
    		<ul>
    		</li>
		</ul>
		</div>
		<div id="content">
		
				<div id="hiddendata" style="display:none">
				<?
				
				 if ($col > 0) {
				 	$row = mysql_fetch_assoc($resconsulta);
				 	/*$week = semanaISO($row['date']);
				 	$count = intval($row['lkm']);*/ 
				 	$dateSaved=date_create($row['date']);
				 	
				 	echo "<div id='".$row['date']."' title='".$row['lkm']."'>".$row['date']." ".$row['lkm']."</br></div>";
				 	 				 	
					while ($row = mysql_fetch_assoc($resconsulta)){
						/*if ($week==semanaISO($row['date'])) {

						$count= $count + intval($row['lkm']);
						}else{
						echo "<div id='".$week."' title='".$count."'>".$count." ".$week."</br></div>";
							$week=semanaISO($row['date']);
							$count = intval($row['lkm']); 						
						}*/
						
						$datefeched=date_create($row['date']);
						
					
						date_add($dateSaved, date_interval_create_from_date_string('1 day'));
						
						echo "[saved]".date_format($dateSaved,'Y-m-d')." [feched]".date_format($datefeched,'Y-m-d');
						
						while($dateSaved != $datefeched){
							echo "<div id='".date_format($dateSaved,'Y-m-d')."' title='0'>".date_format($dateSaved,'Y-m-d')." 0</br></div>";
							date_add($dateSaved, date_interval_create_from_date_string('1 day'));
						}
							echo "<div id='".date_format($datefeched,'Y-m-d')."' title='".$row['lkm']."'>".date_format($datefeched,'Y-m-d')." ".$row['lkm']."</br></div>";
						
					}
					
				 }
				 
			
				?>
				 </div>	
						
			<div id="contenidoprincipal">
				
				 <div id="chart">
				 </div>
			</div>
		</div>
			<div id="footer">
			<a href="http://www2.it.lut.fi/">
			<div id="textfooter">Department of Information Technology</div></a>
			<div id="logo_foot"><img src="media/img/lutLogo_en.png"></div>
			</div>
		</div>
	</div>
	<div id= "menssage" style="display: none;" >
		<h2><img src="media/img/101-5.gif" /> Searching...<h2>
	</div>
	<script type="text/javascript" src="media/javascript/jquerydocument.js"></script>
	</body>
</html>