<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link type="image/x-icon" href="media/img/logoweb.png" rel="shortcut icon">
<link rel="stylesheet" type="text/css" href="media/css/estilos.css">
<script language="JavaScript" src="media/javascript/ajax.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery-1.2.3.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.blockUI.js" type="text/javascript"></script>

<script type="text/javascript">
var xmlhttp;
function GetXMLHttpObject()
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
return new XMLHttpRequest();
}
else
{// code for IE6, IE5
return new ActiveXObject("Microsoft.XMLHTTP");
}
}
function checksubmission(str) {
xmlhttp = GetXMLHttpObject();
if ( xmlhttp == null) {
alert("Your browser doesn't support this.");
return;
}
xmlhttp.onreadystatechange = facultyStatusChanged;
xmlhttp.open("GET","addsingleterm.php?id="+str,true);
xmlhttp.send();
document.getElementById(str).style.visibility="hidden";
}

function facultyStatusChanged()
{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
	document.getElementById("laboratory").innerHTML=xmlhttp.responseText;
	}
}

$(document).ajaxStop($.unblockUI); 

 $(document).ready(function() { 
	    $('#go').click(function() { 
	        $.blockUI({
	        	message: $('#menssage'), 
	       	       
	        css: { 
	            border: 'none', 
	            padding: '10px', 
	            backgroundColor: '#000', 
	            '-webkit-border-radius': '10px', 
	            '-moz-border-radius': '10px', 
	            opacity: .8, 
	            color: '#fff' }
	         }); 
	      
	    }); 
	});
	
</script>

<title>JobSkillSearcher</title>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="/jss"> <img src="media/img/title_beta.png" alt="Logo"> </a>
			</div>
			<div class="nofloat"></div>
		</div>

	<div id="maincontent">
		
		<form action="results.php" method="GET">
			<div id="mainsearch">
				<label for="txtSearch" style="font-size: 20px">Search!</label> 
				<input type="text" name='q' id="txtSearch" autocomplete="off" onkeyup="searchSuggest();" alt="Search Criteria" style="width: 500px; height: 30px; font-size: 20px">
				<input type="submit" id="go" value="Go!" style="height: 35px" >
					<div id="search_suggest" style="display:none" ></div>
			</div>
		</form>
	</div>
	</div>
	<div id= "menssage" style="display: none;" >
		<h2><img src="media/img/101-5.gif" /> Searching...<h2>
	</div>
</body>
</html>
