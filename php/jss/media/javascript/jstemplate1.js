
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

function hazlista(){
	var div = document.getElementById("datahidden");
	var divtofill1 = document.getElementById("list1");
	var divtofill2 = document.getElementById("list2");
	var divtofill3 = document.getElementById("list3");
	var divtofill4 = document.getElementById("list4");
	var object = div.getElementsByTagName("div");
	var index;
	var cadena1="";
	cadena=(object[0].id[object[0].id.length-2])+(object[0].id[object[0].id.length-1]);
	alert(cadena);
	for (index=0; index<=object.length; index++){
		if (object[index].id == "5001")
			divtofill1.appendChild(object[index]);
		if (object[index].id == "5025")
			divtofill2.appendChild(object[index]);
		if (object[index].id == "5003")
			divtofill3.appendChild(object[index]);
		if (object[index].id == "5004")
			divtofill4.appendChild(object[index]);
	}	
}
