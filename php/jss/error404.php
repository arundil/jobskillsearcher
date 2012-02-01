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
				<a href="index.php" ><h1>JobSkillSearcher</h1></a>
				<h3>Easy way to find skills you need for your future job</h3>
			</div>
			<div id=searcher>
				<form action="results.php" method="GET">
					<label for="s1">Search!</label> <input type="text" name="q"
						id="s1" />
					<button type="submit">GO!</button>
				</form>
			</div>
 		<div class="nofloat"></div>
		</div>	
		
		<div id=content>
			<div id="main_content_error">
			<h1>The word does not exist or is not yet registered in the database, please try again</h1>
			</div>
			<div id="img_error">
			<img src="media/img/error-404.jpg" alt="Not found" />
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