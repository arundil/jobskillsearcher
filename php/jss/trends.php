<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>--JobSkillSearcher--</title>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script language="JavaScript" src="media/javascript/jstemplate1.js"
	type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="media/css/estilos.css">
<?php

$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("JSSdb3", $conexion);   
$search = $_GET['q'];

$consulta = "SELECT * FROM words,wlist,jannouncement WHERE (words.id = wlist.wid AND jannouncement.id = wlist.jid AND  word = '$search')";

$resconsulta = mysql_query($consulta,$conexion) or die(mysql_error());
$col = mysql_num_rows($resconsulta);

?>


</head>

<body>
	<div id=container>
		<div id="header">
			<div id=logo>
				<h1>JobSkillSearcher</h1>
				<h3>Easy way to find skills you need for your future job</h3>
			</div>
			<div id=searcher>
				<form action="#" method="GET">
					<label for="s1">Search!</label> <input type="text" name="q"
						id="s1" />
					<button type="submit">GO!</button>
				</form>
			</div>
						<div id="error">					
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
    				 		$error ='Please, write a word in the text-box and them click GO!   ';
    					else
    				 		$error = 'The word does not exist or is not registered even in the database';
    					$flagerror = true;
    				}
    				//muestra el error en la página web
					echo $error;	 
    				
					$row2 = mysql_fetch_assoc($resconsulta2);
    				

 					 mysql_close($conexion);
    				
    				
    			
    		
					
			?>
			</div>
 		<div class="nofloat"></div>
		</div>	
		
		<div id=content>
		
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
			<div id=search>
				<div id= "menu_paginado">
					<?php echo "<a href= 'results.php?q=".$search."'>Look word results</a>";?>
				</div>
					<?php
				 if (!$error)
				 	echo "<h2>".$row2['word']." :</h2><h4>This word appears in ".$globalcount." advertisements</h4>"; 
				 else
				 	echo "<h2>No results found :</h2>" 
				 	?>
			</div>
			
			<div id="contenidoprincipal">
				
				 <div id="chart">
				 </div>
			</div>
		</div>
			<div id="footer">
				<div id=options>
					<a href="">Contact us</a> <a href="">Help</a>
			</div>
		</div>
	</div>
</body>
</html>