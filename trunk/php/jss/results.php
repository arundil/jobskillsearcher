<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>--JobSkillSearcher--</title>

<link media="screen" rel="stylesheet" type="text/css" href="media/css/estilos.css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script language="JavaScript" src="media/javascript/jstemplate1.js" type="text/javascript"></script>
<script type="text/javascript" src="media/javascript/jquery.js"></script>
<script language="JavaScript" src="media/javascript/jquery-1.2.3.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.easing.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.lavalamp.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $("#1, #2, #3").lavaLamp({
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
    <?php
    
     //Classes
     
    class ArrayList {
    var $arreglo ;
     
            function ArrayList() {
                    $this->arreglo = array();
            }
     
            function addItem($pos,$item){
                    $this->arreglo[$pos] = $item ;
            }
     
            function toString(){
                    $cadena = "";
                    foreach ($this->arreglo as $item) {
                       $cadena .= $item."\n";
                    }
                    return $cadena;
            }
     
            function delete($item){
                    unset($this->arreglo[$item]);
            }
     
            function item($item){
                    return $this->arreglo[$item];
            }
     
            function size(){
                    $size = 0;
                    foreach ($this->arreglo as $item) {
                       $size++;
                    }
                    return $size;
            }
    }
    //Functions
    
    function contains ($list, $element){
   		$i =0;
   		$is_contained = false;
   		
   		for($i=0;$i<=count($list)-1; $i++) {
   			if($list[$i]==$element){
   				$is_contained = true;
  				break;
   			}
   		}
   		return $is_contained;
  	}
     
    ?>
	<div id="container">
		<div id="header">
			<div id=logo>
				<h1> JobSkillSearcher </h1>
				<h3>Easy way to find skills you need for your future job</h3>
			</div>
			<div id=searcher>
				<form action="" method="GET">
					<label for="s1">Search!</label> <input type="text" name="q"
						id="s1" >
					<button type="submit">GO!</button>
				</form>
			</div>
			<div id="error">					
					<?
					header('Content-Type: text/html; charset=iso-8859-1');
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
    				 		header('Location:error404.php');
    					else
							header('Location: error404.php');
							
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
					
			 </div>
			 
			<div class="nofloat"></div>
			
		</div>
		
		<div id="boxsearch">
			<div id="search">

				<?php
				
				 if (!$error)
				 	echo "<h3>".$row['word']." :</h3><h5>This word appears in (??) advertisements</h5>"; 
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
		<ul class="lavaLampWithImage" id="1">
    		<li class="current"><a href="#">Main skills required</a></li>
    		<li><a href="#">Knowledge</a></li>
    		<li><a href="#">Personal Skills</a></li>
    		<li><a href="#">Other Information</a></li>
		</ul>

<br><br><br>
		<div id="content">		
			
		  <div id="datahidden" style="display:NONE">
    		<?
    		
    		$listMain = array("5001","5002","5006","5007","5008","5009","5013","5024","5023","5036","5037","5038","5040","5041","5042","5043","5069");
    		$listKnow = array("5025","5026","5030","5032");
    		$listPers = array("5003","5027","5028","5029","5031","5033","5034","5035","5039");
    		$listOths = array("5004","5005","5010","5054","5055","5056","5057","5058","5059","5060","5061","5062","5063","5064","5066","5067","5068");
    		
    		$list1= new ArrayList();
    		$list2= new ArrayList();
    		$list3= new ArrayList();
    		$list4= new ArrayList();
    		$cuenta=0;
    		
    		//Palabras sin agrupar!!!!
    		    if ($totEmp> 0) {
       				while ($rowEmp = mysql_fetch_assoc($resEmp)) {
       					echo $rowEmp['type'];
          				echo "<a href= '?q=".$rowEmp['word']."'<strong>".$rowEmp['word']. "</strong></a>";
          				echo " (<label>".$rowEmp['lkm']."</label> results)";
          				echo "<p>";
          				if (trim(strtolower($rowEmp['word'])) == trim(strtolower($_GET['q']))){
          					$cuenta = $rowEmp['lkm'];
          				}
          				
          				if (contains($listMain,$rowEmp['type'])){
          					//añadir palabra
          				}
       				}
    			}
    		?>
		  </div>
		  
    		<div id="datahiddentype" style="display:''">
    		<?
    		// Aqui estan los tipos de palabras que deben contener a otras 
			$listcodes = new ArrayList();
    			if ($totquery3 >0){
    				while ( $rowquery3 = mysql_fetch_assoc($resquery3) ) {
						$listcodes->addItem($rowquery3['id'], $rowquery3['name']);			
						//echo "<h4><input type='image' src='media/img/rigthT.gif' width='20' height='20' class='button' name='sho' onClick='show(\"".$rowquery3['id']."\");' />";
						//echo "<input type='image' src='media/img/downT.gif' width='20' height='20' class='button' name='rem' onClick='remove(\"".$rowquery3['id']."\");' style=\"display:'';\" />";
						 
					}
    			}
    		?>
    		</div>
    		
    		<?php
    		
    		
    		
    		
    		
    		echo contains($listMain,"5030");
    		?>
    		

			
			<div id="menu">
			<div id = "menu4">
				<div class="title">Main skills required</div>
					<div id="list1" class="body_menu">
					<ul id="main">
					<?
					
					for ($i=0; $i<count($listMain); $i ++){
						$cad = substr($listMain[$i],2,3);
						$elem = $listcodes->item(intval($cad));	
						echo "<li><ul>".utf8_decode($elem)."</ul></li>";
					}
					?>
					</ul>
					</div>
				</div>
				
				<div id = "menu2">
				<div class="title">Knowledge</div>
					<div id="list2" class="body_menu">
					<ul id="know">
					<?
					
					for ($i=0; $i<count($listKnow); $i ++){
						$cad = substr($listKnow[$i],2,3);
						$elem = $listcodes->item(intval($cad));	
						echo "<li>".$elem."</li>";
					}
					?>
					</ul>
					</div>
				</div>
				
				<div id = "menu3">
				<div class="title">Personal Skills</div>
					<div id="list3" class="body_menu">
					<ul id="pers">
					<?
					
					for ($i=0; $i<count($listPers); $i ++){
						$cad = substr($listPers[$i],2,3);
						$elem = $listcodes->item(intval($cad));	
						echo "<li>".$elem."</li>";
					}
					?>
					</ul>
					</div>
				</div>
				
				<div id = "menu4">
					<div class="title">Other Information</div>
					<div id="list4" class="body_menu">
					<ul id="oths">
					<?
					
					for ($i=0; $i<count($listOths); $i ++){
						$cad = substr($listOths[$i],2,3);
						$elem = $listcodes->item(intval($cad));	
						echo "<li>".$elem."</li>";
					}
					?>
					</div>
				</div>

			</div>
			
			<div id="main_content">
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>

<p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>

<p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
    		
					<script type="text/javascript">
			
						//hazlista();
				
					</script>
			
			
			</div>


		</div>  
		
		<div id="footer">
			<div id=options>
				<a href="">Contact us</a> <a href="">Help</a>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="media/javascript/jquerydocument.js"></script>



</body>

</html>