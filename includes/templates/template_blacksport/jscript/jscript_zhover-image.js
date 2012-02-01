$(function(){
	// zen button hover
	$("#productAdditionalImages .additionalImages a").hover(function(){
		$(this).find("img").stop().animate({opacity:0.7}, "fast") 
	}, function(){
		$(this).find("img").stop().animate({opacity:1}, "fast")
	});
});


