$(document).ready(function(){
						   $(".latest_img").fadeTo("slow", 0.3); // This sets the opacity of the thumbs to fade down to 30% when the page loads
						   $(".latest_img").hover(function(){
						   $(this).fadeTo("slow", 1.0); // This should set the opacity to 100% on hover
						   },function(){
						   $(this).fadeTo("slow", 0.3); // This should set the opacity back to 30% on mouseout
						   });
						   });

$(document).ready(function(){
						   $("#text p").fadeTo("slow", 0.3); // This sets the opacity of the thumbs to fade down to 30% when the page loads
						   $("#text p").hover(function(){
						   $(this).fadeTo("slow", 1.0); // This should set the opacity to 100% on hover
						   },function(){
						   $(this).fadeTo("slow", 0.3); // This should set the opacity back to 30% on mouseout
							   	});
						   });

$(document).ready(function(){
						   $("#div").fadeTo("slow", 0.3); // This sets the opacity of the thumbs to fade down to 30% when the page loads
						   $("#div").hover(function(){
						   $(this).fadeTo("slow", 1.0); // This should set the opacity to 100% on hover
						   },function(){
						   $(this).fadeTo("slow", 0.3); // This should set the opacity back to 30% on mouseout
							   	});
						   });