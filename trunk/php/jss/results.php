<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>--JobSkillSearcher--</title>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script language="JavaScript" src="media/javascript/jstemplate1.js"
	type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="media/css/estilos.css">

</head>

<body>
	<div id=container>
		<div id="header">
			<div id=logo>
				<h1>JobSkillSearcher</h1>
				<h3>Easy way to find skills you need for your future job</h3>
			</div>
			<div id=searcher>
				<form action="" method="GET">
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
					$search = $_GET['q'];
					
					$conexion = mysql_connect("localhost", "root", "");
    				mysql_select_db("JSSdb3", $conexion); 
    				
					$consulta = "SELECT * FROM words WHERE (word = '$search')";
					
					$resconsulta = mysql_query($consulta,$conexion) or die(mysql_error());
    				$col = mysql_num_rows($resconsulta);
    		
    				if (!$col>0){
    					if ($search == "")
    				 		$error ='Please, write a word in the text-box and them click GO!   ';
    					else
    				 		$error = 'The word does not exist or is not registered even in the database';
    					$flagerror = true;
    				}
    				//muestra el error en la página web
					echo $error;	 
    				
    				
    				
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
    		 
					
			?>
			<div id="id"  ></div>
			 </div>
			<div class="nofloat"></div>
		</div>
		<div id=content>
			<div id="datahidden" style="display:none">
    		<?
    		$cuenta=0;
    		//Hacer filtro de calidad
    		    if ($totEmp> 0) {
       				while ($rowEmp = mysql_fetch_assoc($resEmp)) {
       					echo "<div id=".$rowEmp['type']." style=\"display:none;\" ><p>";
          				echo "<a href= '?q=".$rowEmp['word']."'<strong>".$rowEmp['word']. "</strong></a>";
          				echo " (<label>".$rowEmp['lkm']."</label> results)";
          				echo "</div><p>";
          				if (trim(strtolower($rowEmp['word'])) == trim(strtolower($_GET['q']))){
          					$cuenta = $rowEmp['lkm'];
          				}
       				}
    			}
    		?>
    		</div>
    		<div id="datahiddentype" style="display:none">
    		<?
    		
    			if ($totquery3 >0){
    				while ( $rowquery3 = mysql_fetch_assoc($resquery3) ) {
						echo "<div id='".$rowquery3['id']."' title='".$rowquery3['name']."'>";
						echo "<h4><input type='image' src='media/img/rigthT.gif' width='20' height='20' class='button' name='sho' onClick='show(\"".$rowquery3['id']."\");' />";
						echo "<input type='image' src='media/img/downT.gif' width='20' height='20' class='button' name='rem' onClick='remove(\"".$rowquery3['id']."\");' style=\"display:none;\" />";
						echo $rowquery3['name']."</h4></div>"; 
					}
    			}
    		?>
    		
    		</div>
			<div id=search>
			<div id= "menu_paginado">
			<?php echo "<a href= 'trends.php?q=".$search."'>Look word trend</a>";?>
			
			</div>

				<?php
				
				 if (!$error)
				 	echo "<h2>".$row['word']." :</h2><h4>This word appears in ".$cuenta." advertisements</h4>"; 
				 else
				 	echo "<h2>No results found :</h2>" 
				 
				 ?>
				 	
			</div>
			<div id=main_content>
			</div>
			<div id=menu>

				<div class="title">Main skills required</div>
				<div id="list1" class="body_menu">
				</div>

				<div class="title">Knowledge</div>
				<div id="list2" class="body_menu">
				
				</div>
				<div class="title">Personal Skills</div>
				<div id="list3" class="body_menu">
	
				</div>
				<div class="title">Other Information</div>
				<div id="list4" class="body_menu">
				
				</div>
					<script type="text/javascript">
			
						hazlista();
				
					</script>
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