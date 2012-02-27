var menu1= $("#menu1");
var menu2= $("#menu2");
var menu3= $("#menu3");
var menu4= $("#menu4");

$(this.document).ready(function(){
	menu1.mouseover(function(){
		$("#list1").css("display", "");
	});
	menu1.mouseout(function(){
		$("#list1").css("display", "none");
	});
})

$(this.document).ready(function(){
	menu2.mouseover(function(){
		$("#list2").css("display", "");
	});
	menu2.mouseout(function(){
		$("#list2").css("display", "none");
	});
})

$(this.document).ready(function(){
	menu3.mouseover(function(){
		$("#list3").css("display", "");
	});
	menu3.mouseout(function(){
		$("#list3").css("display", "none");
	});
})

$(this.document).ready(function(){
	menu4.mouseover(function(){
		$("#list4").css("display", "");
	});
	menu4.mouseout(function(){
		$("#list4").css("display", "none");
	});
})


function mainmenu(){
$(" #nav ul ").css({display: "none"}); // Opera Fix
$(" #nav li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});
}

 
 
 $(document).ready(function(){					
	mainmenu();
});

 
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
 
 $(document).ready(function() { 
	    $('#tab1').click(function() { 
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

 $(document).ready(function() { 
	    $('#tab2').click(function() { 
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
 
 $(document).ready(function() { 
	    $('.wait > a').click(function() { 
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