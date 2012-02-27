<?php

/*
	This is the back-end PHP file for the AJAX Suggest Tutorial
	
	You may use this code in your own projects as long as this 
	copyright is left	in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	For the rest of the code visit http://www.DynamicAJAX.com
	
	Copyright 2006 Ryan Smith / 345 Technical / 345 Group.	
*/

//Send some headers to keep the user's browser from caching the response.
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("JSSdb3", $conexion); 

///Make sure that a value was sent.
if (isset($_GET['q']) && $_GET['q'] != '') {
	
	$search = addslashes($_GET['q']);
	
	$consulta = "SELECT word as suggest, count as popularity FROM words WHERE word like('" .
                $search . "%') ORDER BY popularity DESC, word LIMIT 16;";
	$resconsulta = mysql_query($consulta,$conexion) or die(mysql_error());
	$col = mysql_num_rows($resconsulta);
	if ($col>0){
	while ($row = mysql_fetch_assoc($resconsulta)){
		echo mb_strtolower($row['suggest'],'utf-8')."\n";
		}
	}
    /* $suggest_query = db_query("SELECT word as suggest, count as popularity FROM words WHERE word like('" .
                $search . "%') ORDER BY popularity DESC, word LIMIT 16");*/



//     while($suggest = db_fetch_array($suggest_query)) {
//		echo $suggest['suggest'] . "\n";
//     }
     mysql_close($conexion);
}
?>