function js_active(){
	var strike=document.getElementById("strike");
	var memu=document.getElementById("memu");
	function show(){
		memu.style.display=memu.style.display=="block"?"none":"block";//运算符意思是display是block的时候执行none  如果不是的话执行block；
	}
	document.onclick = function(e){
		e = e || window.event;
		var target = e.srcElement || e.target;
		if(target.tagName.toLowerCase()!='a'){//if中的条件是点击页面中标签名不是a的执行下面的display：none;
			memu.style.display="none";
		}
	}
	strike.onclick=function(){show();}
	strike.onmouseover=function(){memu.style.display="block";}
}

//////////////////////////////////////////////
function jq_tab(){
	(function($){
		$(document).ready(function(){
			$(".nav .nav_li").mouseover(function(){
				$(this).addClass("change");
				$($(".nav .nav_a")[$(".nav .nav_li").index(this)]).css("color","#efefef");
				$($(".nav .li_one")[$(".nav .nav_li").index(this)]).show();
			})
			$(".nav .nav_li").mouseout(function(){
				$(this).removeClass("change");
				$($(".nav .nav_a")[$(".nav .nav_li").index(this)]).css("color","#737373");
				$($(".nav .li_one")[$(".nav .nav_li").index(this)]).hide();
			})
		})
	})(jQuery);	
}
///////////////////////////////////////
function cate_tab(){
	(function($){
		$(document).ready(function(){
			$(".cate_con .li_tit").mouseover(function(){
				$(this).addClass("cate_change");
				$($(".cate_con .li_a")[$(".cate_con .li_tit").index(this)]).addClass("a_change");
				$($(".cate_con .cate_ol")[$(".cate_con .li_tit").index(this)]).show();
			})
			$(".cate_con .li_tit").mouseout(function(){
				$(this).removeClass("cate_change");
				$($(".cate_con .li_a")[$(".cate_con .li_tit").index(this)]).removeClass("a_change");
				$($(".cate_con .cate_ol")[$(".cate_con .li_tit").index(this)]).hide();
			})
		})
	})(jQuery);
}

///////////////////////////////
function sub_change(){
	var sear=document.getElementById("search_sub");
	sear.onmouseover=function(){
		sear.className="sub_cheng";
	}
	sear.onmouseout=function(){
		sear.className="sub";
	}
}
//////////////////////////////////////
function fd_change(){
	var sear=document.getElementById("fd_submit");
	sear.onmouseover=function(){
		sear.className="fd_enter";
	}
	sear.onmouseout=function(){
		sear.className="fd_sub";
	}
}
window.onload=function(){js_active();jq_tab();cate_tab();sub_change();fd_change();}