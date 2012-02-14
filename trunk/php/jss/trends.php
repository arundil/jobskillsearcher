<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>--JobSkillSearcher--</title>
<link type="image/x-icon" href="media/img/logoweb.png" rel="shortcut icon"/>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script language="JavaScript" src="media/javascript/jstemplate1.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery-1.2.3.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.easing.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.lavalamp.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="media/css/estilos.css">
<?php

$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("JSSdb3", $conexion);   
$search = $_GET['q'];

$consulta = "SELECT * FROM words,wlist,jannouncement WHERE (words.id = wlist.wid AND jannouncement.id = wlist.jid AND  word = '$search')";

$resconsulta = mysql_query($consulta,$conexion) or die(mysql_error());
$col = mysql_num_rows($resconsulta);

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
					<button type="submit">GO!</button>
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
				<li>
					<?php echo "<a href= 'results.php?q=".$search."'><span>Look word results<span/></a>";?>
					
					</a>
				</li>
				<li>
					<a title="Link 2" href="#">
					<?php echo "<a href= 'trends.php?q=".$search."'><span>Look word trend<span/></a>";?>
					</a>
				</li>
			</ul>
		</div>
		
		<br>
		<div id="contnav">
		<ul class="lavaLampWithImage" id="nav">
    		<li class="current"><a href="#">Trends By Day</a>
    		
      		</li>
    		<li><a href="#">Trends by Month</a>
    		
			</li>
    		
		</ul>
		</div>
		<div id="content">
		
				<div id="hiddendata" style="display:none">
				<?
				 if ($col > 0) {
				 		$row = mysql_fetch_assoc($resconsulta);
						$count =0;
						$globalcount=1;
						$aux=$row['date'];
					while ($row = mysql_fetch_assoc($resconsulta)){
						
						if ($aux != $row['date'] ){
							$count = $count+1;
    		  				echo "<div id='".$row['date']."' title='".$count."'>".$row['date']." ".$count."</br></div>";
    		  				$count=0;
    		  				$aux=$row['date'];
						}
						else{
							$count = $count+1;					
						}
						$globalcount= $globalcount+1;
					}
					echo $globalcount;
				 }
				?>
				 </div>	
						
			<div id="contenidoprincipal">
				
				 <div id="chart">
				 </div>
			</div>
		</div>
			<div id="footer">
				<div id="options">
					This is the footer of the web page
			</div>
		</div>
	</div>
	<script type="text/javascript" src="media/javascript/jquerydocument.js"></script>
</body>
</html>