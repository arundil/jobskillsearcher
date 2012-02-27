<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>

<?php

$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("JSSdb3", $conexion); 

$consulta = "SELECT * FROM baseword;";
$resconsulta = mysql_query($consulta,$conexion) or die(mysql_error());
$col = mysql_num_rows($resconsulta);

if ($col >0){	
	while($fila = mysql_fetch_assoc($resconsulta)){
		echo $fila['id']."<br>";

	}
}
?>


</body>
</html>

