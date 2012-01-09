//Global Var's!

var listMain = ["5001","5002","5006","5007","5008","5009","5013","5024","5023","5036","5037","5038","5040","5041","5042","5043","5069"];
var listKnow = ["5025","5026","5030","5032"];
var listPers = ["5003","5027","5028","5029","5031","5033","5034","5035","5039"];
var listOths = ["5004","5005","5010","5054","5055","5056","5057","5058","5059","5060","5061","5062","5063","5064","5065","5066","5067","5068"];

var flag = false;

window.onload = function fistpresentation (){
	var list1 = document.getElementById("list1");
	var elemlist1= list1.getElementsByTagName("div");
	var elementopen=elemlist1[0].id;
	var cadena=(elementopen[elementopen.length-2])+(elementopen[elementopen.length-1]);
	if (cadena[0]==0)
		show(cadena[1]);
	else
		show(cadena);
	flag=true;
}


function show (element){
	var get_main_content = document.getElementById("main_content");
	
	if (flag){
	var element_main_content = get_main_content.getElementsByTagName("div");
	var elementremove= element_main_content[0].id;
	var cadena=(elementremove[elementremove.length-2])+(elementremove[elementremove.length-1]);
	if (cadena[0]==0)
		remove(cadena[1]);
	else
		remove(cadena);
	flag=false;
	}

	var cad="";
	if (element<10){
		cad="type500"+element;
	}
	else{
		cad="type50"+element;
	}
	var div = document.getElementById(cad);	
	var elements = div.getElementsByTagName("div");
	var buttons = div.getElementsByTagName("input");
	var chart_div= document.createElement("div");
	chart_div.id="chart_div"+cad;
	get_main_content.appendChild(chart_div);
	var i=0;
	for (i=0 ; i<=elements.length-1 ;i++){
		elements[i].style.display='';
	}
	buttons[0].style.display="none";
	buttons[1].style.display=""; 
		
	google.setOnLoadCallback(drawChart(chart_div.id));
	
	flag=true;
	
}

function remove (element){
	var cad="";
	if (element<10){
		cad="type500"+element;
	}
	else{
		cad="type50"+element;
	}
	var div = document.getElementById(cad);
	var elements = div.getElementsByTagName("div");
	var buttons = div.getElementsByTagName("input");
	var get_main_content = document.getElementById("main_content");
	var get_div_toRemove = document.getElementById("chart_div"+cad);
	var i=0;
	for (i=0 ; i<=elements.length-1 ;i++){
		elements[i].style.display='none';
	}
	buttons[0].style.display="";
	buttons[1].style.display="none"; 
	
	get_main_content.removeChild(get_div_toRemove);
	flag=false;
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

function hazlista(){
	var div = document.getElementById("datahidden");
	var arraylist= new Array();
	var divtofill1 = document.getElementById("list1");
	var divtofill2 = document.getElementById("list2");
	var divtofill3 = document.getElementById("list3");
	var divtofill4 = document.getElementById("list4");
	var words = div.getElementsByTagName("div");
	var index;
	var cadena="";
	
	
	
	//alert(cadena);
	
	for (index=0; index<=words.length-1; index++){
		if (contains(arraylist, words[index].id)){
			var olddiv;
			
			if (contains(listMain, words[index].id)){
				olddiv = document.getElementById("type"+words[index].id);
				olddiv.appendChild(words[index]);
				divtofill1.appendChild(olddiv);
			}else if (contains(listKnow, words[index].id)){
				olddiv = document.getElementById("type"+words[index].id);
				olddiv.appendChild(words[index]);
				divtofill2.appendChild(olddiv);
			}else if (contains(listPers, words[index].id)){
				olddiv = document.getElementById("type"+words[index].id);
				olddiv.appendChild(words[index]);
				divtofill3.appendChild(olddiv);
			}else if (contains(listOths, words[index].id)){
				olddiv = document.getElementById("type"+words[index].id);
				olddiv.appendChild(words[index]);
				divtofill4.appendChild(olddiv);
			}
		}
		else{
			if (!arraylist[0])
				arraylist[0]=words[index].id;
			else
				arraylist[arraylist.length]=words[index].id;
			
			var temp = words[index];
			
//			alert("NEW TEMP : "+temp.id);
			var newdiv= getTypeById(temp.id);
			
			if (contains(listMain, temp.id)){
				newdiv.id = "type"+temp.id;
				newdiv.appendChild(temp);
				divtofill1.appendChild(newdiv);
			}else if (contains(listKnow, temp.id)){
				newdiv.id = "type"+temp.id;
				newdiv.appendChild(temp);
				divtofill2.appendChild(newdiv);
			}else if (contains(listPers, temp.id)){
				newdiv.id = "type"+temp.id;
				newdiv.appendChild(temp);
				divtofill3.appendChild(newdiv);
			}else if (contains(listOths, temp.id)){
				newdiv.id = "type"+temp.id;
				newdiv.appendChild(temp);
				divtofill4.appendChild(newdiv);
			}
			//alert("Vista de Array List: "+arraylist);
		}

	}
}
//Api google

google.load('visualization', '1.0', {'packages':['corechart']});


function drawChart(chart_div) {

    // Create the data table.
    var data = new google.visualization.DataTable();
    
    var cad= document.getElementById(chart_div.substring(chart_div.length-8,chart_div.length));
    var dataincad = cad.getElementsByTagName('div');
    var k=0;
    
    data.addColumn('string', 'Word');
    data.addColumn('number', 'Nº of times this word is mentioned in the advs. which contains the word searched');
    
   var array= [];
   var labels;
   for (k=0; k<=dataincad.length-1; k++){
		labels= dataincad[k].getElementsByTagName('LABEL');
	   	array[array.length]=[dataincad[k].firstChild.firstChild.textContent,parseInt(labels[0].textContent)];
   }
   data.addRows(array);


    // Set chart options
    var options = {'title':cad.title,
                   'width':600,
                   'height':400,
                   'colors':['black']};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById(chart_div));
    chart.draw(data, options);
  
}

google.load("visualization", "1", {packages:["corechart"]});

google.setOnLoadCallback(drawChartTrends);

function drawChartTrends() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'days');
    data.addColumn('number', 'Nº advertisment per day');
    data.addRows([
      ['2004', 1000],
      ['2005', 1170],
      ['2006', 660],
      ['2007', 1030]
    ]);

    var options = {
      width: 580, height: 260,
      title: 'Trends of this word',
      vAxis: {title: 'Nº Advertisments',  titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart'));
    chart.draw(data, options);    
  }


