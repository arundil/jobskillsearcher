
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

function contains (list, element){
	var i = 0;
	var contains = false;
	for (i=0; i<=list.length-1; i++){
		if (list[i]==element){
			contains=true;
			break;
		}
	}
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


function hazlista(){
	var div = document.getElementById("datahidden");
	var divtype = document.getElementById("datahiddentype");
	var arraylist= new Array();
	var divtofill1 = document.getElementById("list1");
	var divtofill2 = document.getElementById("list2");
	var divtofill3 = document.getElementById("list3");
	var divtofill4 = document.getElementById("list4");
	var words = div.getElementsByTagName("div");
	var index;
	var cadena="";
	
	var listMain = ["5001","5002","5006","5007","5008","5009","5013","5024","5023","5036","5037","5038","5040","5041","5042","5043","5069"];
	var listKnow = ["5025","5026","5030","5032"];
	var listPers = ["5003","5027","5028","5029","5031","5033","5034","5035","5039"];
	var listOths = ["5004","5005","5010","5054","5055","5056","5057","5058","5059","5060","5061","5062","5063","5064","5065","5066","5067","5068"];
	
	cadena=(words[0].id[words[0].id.length-2])+(words[0].id[words[0].id.length-1]);
	
	//alert(cadena);
	for (index=0; index<=words.length-1; index++){
		if (contains(arraylist, words[index].id)){
			var olddiv;
			if (contains(listMain, words[index].id)){
				olddiv = document.getElementById("type"+words[index].id);
				olddiv.appendChild(words[index]);
				divtofill1.appendChild(olddiv);
			}
			if (contains(listKnow, words[index].id)){
				divtofill2.appendChild(words[index]);
			}
			if (contains(listPers, words[index].id)){
				divtofill3.appendChild(words[index]);
			}
			if (contains(listOths, words[index].id)){
				divtofill4.appendChild(words[index]);
			}
		}
		else{
			if (!arraylist[0])
				arraylist[0]=words[index].id;
			else
				arraylist[arraylist.length+1]=words[index].id;
			
			var newdiv = document.createElement("div");
			var temp = words[index];
			alert("NEW TEMP : "+temp.id);
			
			if (contains(listMain, words[index].id)){
				newdiv.id = "type"+temp.id;
				newdiv.innerHTML+="<h3>"+temp.id+"</h3>";
				newdiv.appendChild(temp);
				//aqui está el fallo a ver como lo arreglamos
				divtofill1.appendChild(newdiv);
				alert("lis1"+temp.id);
			}
			if (contains(listKnow, temp)){
				divtofill2.innerHTML+="<h3>"+words[index].id+"</h3>";
				divtofill2.appendChild(words[index]);
				alert("lis2"+temp.id);
			}
			if (contains(listPers, temp)){
				divtofill3.innerHTML+="<h3>"+words[index].id+"</h3>";
				divtofill3.appendChild(words[index]);
				alert("lis3"+temp.id);
			}
			if (contains(listOths, temp)){
				divtofill4.innerHTML+="<h3>"+words[index].id+"</h3>";
				divtofill4.appendChild(words[index]);
				alert("lis4"+temp.id);
			}
			//alert("Vista de Array List"+arraylist);
		}

	}
}
