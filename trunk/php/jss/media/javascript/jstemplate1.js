//Global Var's!
 
var listMain = ["5001","5002","5006","5007","5008","5009","5013","5024","5023","5036","5037","5038","5040","5041","5042","5043","5069"];
var listKnow = ["5025","5026","5030","5032"];
var listPers = ["5003","5027","5028","5029","5031","5033","5034","5035","5039"];
var listOths = ["5004","5005","5010","5054","5055","5056","5057","5058","5059","5060","5061","5062","5063","5064","5065","5066","5067","5068"];

var flag = null;

window.onload = function fistpresentation (){
	var list1 = document.getElementById("minimenu");
	var elemlist1= list1.getElementsByTagName("div");
	var elementopen=elemlist1[0].id;
	show(elementopen);
	flag=elementopen;
}

function show (element){
	if (flag!=null){
		remove(flag);
		flag=null;
	}
	
	var div = document.getElementById(element);	
	div.style.display='';
	
		//google.setOnLoadCallback(drawChart(chart_div.id));
	
	flag=element;
	google.setOnLoadCallback(drawChart(element));
}

function remove (element){
	var div = document.getElementById(element);	
	div.style.display= "none";
	flag=null;
}

function redirect(chain){
	var i=0;
	var url="";
	for (i=0; i<=chain.length-1; i++){
		if (chain[i]==" ")
			break;
		url= url+chain[i];
	}
	return url;
}

function contains (list, element){
	var i = 0;
	var contains = false;
	for (i=0; i<=list.length-1; i++){
		//alert(list[i]+" , "+element);
		if (list[i]==element){
			contains=true;
			break;
		}
	}
	//alert("Fin lista")
	//alert("la lista es: "+list+"\nEl elemento es: "+element+"\n Está contenido?"+contains);
	return contains;
}

function findElement (list, element) {
	var i = 0;
	var contains = null;
	for (i=0; i<=list.length; i++){
		if (list[i]==element){
			contains=list[i];
			break;
		}
	}
	return contains;
}

function getTypeById (identy) {
	var div2 = document.getElementById("datahiddentype");
	var divtype= div2.getElementsByTagName("div");
	var i=0;
	var type= "";
	var res;
	var cadena=(identy[identy.length-2])+(identy[identy.length-1]);
	if (cadena[0]==0)
		chain= cadena[1];
	else
		chain = cadena;
	for (i=0; i<=divtype.length-1; i++){
		
		if (divtype[i].id == chain ){
			res = divtype[i];
			break;
		}
	}
	return res;
}


//Api google

google.load('visualization', '1.0', {'packages':['corechart']});


function drawChart(element) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    var getdiv = document.getElementById(element);
    var getdivs= getdiv.getElementsByTagName("div");
    var k=0;
    
    data.addColumn('string', 'Word');
    data.addColumn('number', 'N. of times this word is mentioned in the advs. which contains the word searched');
    
   var array= [];
   
   var labels;
   var endbucle=9;
   if (getdivs.length-1 <10)
	   endbucle = getdivs.length-1
   
   for (k=1; k<=endbucle; k++){
		labels= getdivs[k].getElementsByTagName('LABEL');
	   	array[array.length]=[getdivs[k].firstChild.firstChild.textContent,parseInt(labels[0].textContent)];
   }
   data.addRows(array);


    // Set chart options
    var options = {title :element,
                   width :750,
                   height :500,
                   chartArea:{left:100,top:20,width:"85%",height:"75%"},
                   colors :['black']};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
    chart.draw(data, options);
  
}

google.load("visualization", "1", {packages:["corechart"]});

google.setOnLoadCallback(drawChartTrends);

function drawChartTrends() {
    var data = new google.visualization.DataTable();
    var div = document.getElementById ("hiddendata");
    var contentdiv = div.getElementsByTagName('div');
    
    data.addColumn('string', 'days');
    data.addColumn('number', 'Nº advs. per day');
    
    var array= [];
    
    for (k=0; k<=contentdiv.length-1; k++){
		var auxdate= contentdiv[k].id;
		var auxnumber= contentdiv[k].title;
	   	array[array.length]=[auxdate,parseInt(auxnumber)];
   }
    
    data.addRows(array);

    var options = {
      width: 300, height: 260,
      title: 'Trends of this word',
      vAxis: {title: 'Nº Advertisments',  titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart'));
    chart.draw(data, options);    
  }

//=========================================
//Jquery
//=========================================

//control de eventos  


