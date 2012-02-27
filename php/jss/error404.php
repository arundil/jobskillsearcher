<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>--JobSkillSearcher--</title>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script language="JavaScript" src="media/javascript/jstemplate1.js"
	type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery-1.2.3.min.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/jquery.blockUI.js" type="text/javascript"></script>
<script language="JavaScript" src="media/javascript/ajax.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="media/css/estilos.css">

<script type="text/javascript">

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

<script type="text/javascript">
  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/m5AFqBSLPJi05pRDrjhgow.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
</script>

</head>

<body>
	<div id="container">
		<div id="header">
			<div id="logo">
				<a href="/jss"> <img src="media/img/title_beta.png"> </a>
			</div>
			<div id=searcher>
				<form action="results.php" accept-charset="utf-8" method="GET">
					<label for="txtSearch">Search!</label> <input type="text" name="q" id="txtSearch" autocomplete="off" onkeyup="searchSuggest();" alt="Search Criteria" >
					<button id="go"type="submit">GO!</button>
					<div id="search_suggest2" style="display:none" ></div>
				</form>
			</div>
			<div class="nofloat"></div>
		</div>	
		
		<div id="content">
			<div id="img_error">
			<img src="media/img/error-404.jpg" alt="Not found" />
			</div>
			<div id="main_content_error">
			<h1>The word does not exist or is not yet registered in the database, please try again</h1>
			</div>
		</div>
		
			<div id="footer">
			<div id="contact"><a href="/jss/contact.html" target="_blank" onClick="window.open(this.href, this.target, 'width=300,height=400'); return false;">About the Idea & the Website</a></div>
			<a href="http://www2.it.lut.fi/">
			<div id="textfooter">Department of Information Technology</div></a>
			<div id="logo_foot"><img src="media/img/lutLogo_en.png"></div>
		</div>
		</div>
	</div>
	
	<div id= "menssage" style="display: none;" >
		<h2><img src="media/img/101-5.gif" /> Searching...<h2>
	</div>
	
</body>
</html>