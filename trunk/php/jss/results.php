<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>JobSkillSearcher -Template 1-</title>

<script language="JavaScript" src="media/javascript/jstemplate1.js"
	type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="media/css/estilos.css">


</script>
</head>
<body>
	<div id=container>
		<div id="header">
			<div id=logo>
				<h1>JobSkillSearcher</h1>
				<h3>Easy way to find skills you need for your future job</h3>
			</div>
			<div id=searcher>
				<form action="#" method="POST">
					<label for="s1">Search!</label> <input type="text" name="q"
						id="s1" />
					<button type="submit">GO!</button>
				</form>
			</div>
			<div id="error">					
					<?
					$error = "";
					$flagerror = false;
					$search = $_POST['q'];
					
					$conexion = mysql_connect("localhost", "root", "");
    				mysql_select_db("JSSbd2", $conexion); 
    				
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
					echo $error;	 
					?>
			 </div>
			<div class="nofloat"></div>
		</div>
		<div id=content>
			<div id=search>

				<h2><?php echo htmlspecialchars($_POST['q']); ?>:</h2>
			</div>
			<div id=menu>

				<div class="title">Main skills required</div>
				<div id="list1" class="body_menu">
					
				</div>

				<div class="title">Knowledge</div>
				<div id="list2" class="body_menu">
					
				</div>
				<div class="title">Personal Skills</div>
				<div id=" list3" class="body_menu">
					
				</div>
				<div class="title">Other Information</div>

				<div id="list4" class="body_menu">
					
				</div>
			</div>


			<div id=main_content>
				MAIN CONTENT</br>
			<? 
    		
    		$row = mysql_fetch_assoc($resconsulta);
			$wordid = $row['id'];
   			
   			echo "<h2> Palabra buscada: ".$row['word']."</h2>";
						
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
    			
    			
    			
    			if ($totEmp> 0) {
       				while ($rowEmp = mysql_fetch_assoc($resEmp)) {
          				echo "<strong> Word:".$rowEmp['word']."</strong>";
          				echo "( ".$rowEmp['lkm'].")";
          				echo "Type: ".$rowEmp['type']."<br>";
       				}
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