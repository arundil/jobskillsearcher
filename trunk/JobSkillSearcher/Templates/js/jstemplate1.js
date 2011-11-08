
function show (element,button1,button2){
	var div = document.getElementById(element);
	var b1 = document.getElementById(button1);
	var b2 = document.getElementById(button2);
	b1.style.display='';
	b2.style.display='none';
	div.style.display='';
}

function remove (element,button1,button2){
	var div = document.getElementById(element);
	var b1 = document.getElementById(button1);
	var b2 = document.getElementById(button2);
	b1.style.display='';
	b2.style.display='none';
	div.style.display='none';
}

/* ===================
 * 	   GOOGLE API
 * ===================
 */

// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table, 
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

// Create the data table.
var data = new google.visualization.DataTable();
data.addColumn('string', 'Topping');
data.addColumn('number', 'Slices');
data.addRows([
  ['Programming', 27],
  ['Android', 12],
  ['Interface', 6], 
  ['Mobile', 6],
  ['Ohjelmointi', 5]
]);

// Set chart options
var options = {'title':'Programing Skills',
               'width':400,
               'height':300};

// Instantiate and draw our chart, passing in some options.
var chart = new google.visualization.PieChart(document.getElementById('chart_div1-1'));
chart.draw(data, options);
}



/* ===================
 * 	 amCharts API JS
 * ===================
 */

var chart;

var chartData = [{country:"USA", visits:4025, color:"#FF0F00"},
		{country:"China",visits:1882,color:"#FF6600"},
		{country:"Japan",visits:1809,color:"#FF9E01"},
		{country:"Germany",visits:1322,color:"#FCD202"},
		{country:"UK",visits:1122,color:"#F8FF01"},
		{country:"France",visits:1114,color:"#B0DE09"},
		{country:"India",visits:984,color:"#04D215"},
		{country:"Spain",visits:711,color:"#0D8ECF"}];


window.onload = function()
{
	chart = new AmCharts.AmSerialChart();
	chart.dataProvider = chartData;
	chart.categoryField = "country";
	chart.marginTop = 25;
	chart.marginBottom = 80;
	chart.marginLeft = 55;
	chart.marginRight = 25;
	chart.startDuration = 1;

	var graph = new AmCharts.AmGraph();
	graph.valueField = "visits";
	graph.colorField = "color";
	graph.balloonText="[[category]]: [[value]]";
	graph.type = "column";
	graph.lineAlpha = 0;
	graph.fillAlphas = 0.8;
	chart.addGraph(graph);

	var catAxis = chart.categoryAxis;
	catAxis.gridPosition = "start";
	catAxis.autoGridCount = true;

	chart.write("chartdiv2");
}
