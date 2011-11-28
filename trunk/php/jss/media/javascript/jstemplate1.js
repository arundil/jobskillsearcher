
function show (element,button1,button2,graph){
	var div = document.getElementById(element);
	var b1 = document.getElementById(button1);
	var b2 = document.getElementById(button2);
	var graph = document.getElementById(graph);
	b1.style.display='';
	b2.style.display='none';
	div.style.display='';
	graph.style.display="";
}

function remove (element,button1,button2,graph){
	var div = document.getElementById(element);
	var b1 = document.getElementById(button1);
	var b2 = document.getElementById(button2);
	var graph = document.getElementById(graph);
	b1.style.display='';
	b2.style.display='none';
	div.style.display='none';
	graph.style.display="none";
	
}

