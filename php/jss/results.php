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
					<label for="s1">Search!</label> <input type="text" name="searcher"
						id="s1" />
					<button type="submit">GO!</button>
				</form>
			</div>
			<div class="nofloat"></div>
		</div>
		<div id=content>
			<div id=search>
				<h2>Programmer:</h2>
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
			$conexion = mysql_connect("localhost", "root", "");
    		mysql_select_db("JSSbd2", $conexion); 
    		
    		
    		$queEmp = "SELECT word, type, count(word) as lkm FROM wlist LEFT JOIN words ON wlist.wid=words.id 
    		WHERE (1=0 OR jid=646 OR jid=711 OR jid=712 OR jid=745 OR jid=762 OR jid=763 OR jid=1007 
   			OR jid=1008 OR jid=1135 OR jid=1559 OR jid=1879 OR jid=2884 OR jid=2887 OR jid=2952 OR 
    		jid=2955 OR jid=3138 OR jid=3139 OR jid=3143 OR jid=3151 OR jid=3161 OR jid=3162 OR jid=3892 OR 
    		jid=4944 OR jid=4946 OR jid=4972 OR jid=5204 OR jid=5217 OR jid=5218 OR jid=5222 OR jid=5440 OR
     		jid=5679 OR jid=5706 OR jid=5707 OR jid=5709 OR jid=5776 OR jid=5900 OR jid=6396 OR jid=6408 OR 
     		jid=6412 OR jid=6478 OR jid=6582 OR jid=6617 OR jid=6768 OR jid=6813 OR jid=6815 OR jid=6974 OR 
     		jid=7283 OR jid=7802 ) AND type!=3 AND type!=0 AND type!=701 GROUP BY word ORDER BY lkm DESC, word;";
    		
    		$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
    		$totEmp = mysql_num_rows($resEmp);
    		
    		if ($totEmp> 0) {
       			while ($rowEmp = mysql_fetch_assoc($resEmp)) {
          			echo "<strong> Word:".$rowEmp['word']."</strong>";
          			echo "(: ".$rowEmp['lkm'].")";
          			echo "Type: ".$rowEmp['type']."<br>";
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