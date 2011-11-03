
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