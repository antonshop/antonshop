function active(){
	var Tween = {
			Quart: {
				easeIn: function(t,b,c,d){
					return c*(t/=d)*t*t*t + b;
				},
				easeOut: function(t,b,c,d){
					return -c * ((t=t/d-1)*t*t*t - 1) + b;
				},
				easeInOut: function(t,b,c,d){
					if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
					return -c/2 * ((t-=2)*t*t*t - 2) + b;
				}
			}
	}
	//t: current time（当前时间）；b: beginning value（初始值/当前位置）；c: change in value（变化量/移动量=到到达的位置-初始位置）；d: duration（持续时间）。

	var div=document.getElementById("getout");
	//var xtable=div.getElementsByTagName("table")[0];
	var xtable=document.getElementById("mm");
	var number=document.getElementById("number").getElementsByTagName("a");
	var p=0;
	var time;
	var f=0;
	var pand=true;
		function run(){
			var d=30;//多少步完成；
			var w=document.getElementById("getout").clientWidth;//显示窗口的宽度；
			var t=0;//初始步；
			var b=p;
			var c=f*w-b;
			function runr(){
				var n= Math.ceil(Tween.Quart.easeOut(t,b,c,d));
				xtable.style.left =-n + "px";
				 if(t<d){t++;p=n; time=setTimeout(runr, 50);}
				 else{
				 t=0;p=n;//随时把n的值传出去，因为每次运动中b值不能改变所以不能直接b=n;
				 clearTimeout(time);}
			 }		
			 function runn(){
				if (typeof(time)!="undefined"){clearTimeout(time);}
				runr()
			}
			runn()
		}

	function tabchange(){
			for(var i=0;i<number.length;i++){
			//addEventHandler(number[i],"mouseover",function (){change(this);});
			number[i].onmouseover=function(){change(this);}
		}
	}
	function change(oa){

		for(i=0;i<number.length;i++){
			number[i].className="";
			if (oa==number[i]){	
					var i=i;
					 f=i;//传递数组下标改变c参数的值
					 run();
					oa.className="first";	
				}
		}	
	}
	tabchange();//执行函数tabchange
	function change1(){
		run();
		for(i=0;i<number.length;i++){
			number[i].className="";
			}
		number[f].className="first";
		}
	function panduan(){ 
		div.onmouseover=function(){pand=false;clearInterval(time1);}
		div.onmouseout=function(){pand=true;time1=setInterval(panduan,3000);}
		if(pand){
			f++;
			if(f>number.length-1){f=0;}
			change1();
		}
	}
	var time1=setInterval(panduan,3000);
}

active();
