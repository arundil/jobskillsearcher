var realdata=false;
var actual=0;
google.load('visualization', '1', {'packages':['corechart']});

window.onload = function fistpresentation (){
	var div = document.getElementById ("word");
	google.setOnLoadCallback(drawChartTrends(div.textContent,0));
}


function average (array_data){
	var long= array_data.length;
	var result= [];
	var konst= 0;
	var i=0;
	var j=0;

	/*if (long<50)
		konst=5;
	else if (long<100)
		konst= 7;
	else if (long>100)
		konst= 10;*/

	konst=7;
	for (i=0; i<konst; i++){
		var average=0;
		for (j=0; j<=i; j++){
			average= average + parseInt(array_data[j]);
		}
		average= average/(i+1);
		result[i]=average;
	}

	for (i=konst; i<long; i++){
		var average =0;
		var index= 0;
		for (j=0; j<konst;j++){
			index= i-konst+j;
			average = average + parseInt(array_data[index])

		}
		average= average/konst;
		result[i]=average;
	}
	//alert(result+ "\n"+array_data);
	return result;
}



function drawChartTrends(word,time) {
	var data = new google.visualization.DataTable();
	var div = document.getElementById ("hiddendata");
	var contentdiv = div.getElementsByTagName('div');
	var k=0;
	var j=0;
	data.addColumn('date', 'days');
	if (realdata)
		data.addColumn('number', 'Nº advs');
	data.addColumn('number', 'Trend');


	var array= [];
	var array_average= [];
	var array_to_split=[];

	var long= (contentdiv.length-1)-time;
	var endbucle= contentdiv.length -1;	
	if (time ==0)
		long =0;

	if (long<0){
		long=0;
		endbucle = time;
	}
	
	for (k=long; k<=endbucle; k++){
		if (k<=contentdiv.length-1){
			var auxdate= contentdiv[k].id;
			var auxnumber= contentdiv[k].title;
			var cont =0;
			
			if(realdata){
				array[array.length]=[new Date(auxdate),parseInt(auxnumber)];
			}
			else
				array[array.length]=[new Date(auxdate)];
		}
		else{
			cont++;
			var fecha= new Date(auxdate);
			fecha.setDate(fecha.getDate()+cont);
			if(realdata){
				
				array[array.length]=[fecha,0];
			}
			else
				array[array.length]=[fecha];
		}

		if (k<=contentdiv.length-1){	
			array_average[array_average.length]= [parseInt(auxnumber)];
		}else{
			array_average[array_average.length]= 0;
		}

	}
	array_to_split = average(array_average);
	for (k=0;k<array.length;k++){
		if (realdata)
			array[k][2]=array_to_split[k];
		else
			array[k][1]=array_to_split[k];
	}

	data.addRows(array);

	if (!realdata){
		var options = {
				width: 1000, height: 500,
				title: "Trends of '"+word+"'",
				vAxis: {title: 'Amount of Advertisements',  titleTextStyle: {color: 'orange'}},
				legend: 'none',
		};
	}
	else{
		var options = {
				width: 1000, height: 500,
				title: "Trends of '"+word+"'",
				vAxis: {title: 'Amount of Advertisements',  titleTextStyle: {color: 'orange'}},
		};
	}

	var chart = new google.visualization.LineChart(document.getElementById('chart'));
	chart.draw(data, options);    
}
