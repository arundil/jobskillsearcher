<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>--JobSkillSearcher--</title>

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
 mysql_close($conexion);
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
 		<div class="nofloat"></div>
		</div>	
		
		<div id=content>	
			<div id=search>
				<div id= "menu_paginado">
					<?php echo "<a href= 'results.php?q=".$search."'>Look word results</a>";?>
				</div>
			</div>
			<div id=contenidoprincipal>
				MAIN CONTENT</br>
				<?
				 if ($col > 0) {
					while ($row = mysql_fetch_assoc($resconsulta)){
    		  			echo $row['word']." ".$row['date']."</BR>";
						}
				 }
				?>
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