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
                   chartArea:{left:100,top:20,width:"80%",height:"75%"},
                   colors :['black'],
                   legend: 'none'
                };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById("chart_div"));
    chart.draw(data, options);
  
}



//=========================================
//Jquery
//=========================================

//control de eventos  


