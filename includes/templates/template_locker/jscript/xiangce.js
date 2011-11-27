function bili(objbig,holderWidth,holderHeight){
	w = objbig.getAttribute("w");
	h = objbig.getAttribute("h");
	var bili= w/h ;
	var holderbili=holderWidth/holderHeight;
	if(w <= holderWidth && h <= holderHeight && bili>holderbili){
		if(bili > 1){
		objbig.style.width=w+"px";
		}else if(bili <= 1){
			objbig.style.height=h+"px";
		}
	}
	else if(w <= holderWidth && h <= holderHeight && bili <= holderbili){
		objbig.style.height=h+"px";
	}

	else if(w <= holderWidth  && h > holderHeight){
		objbig.style.height=holderHeight+"px";
	}
	else if(w > holderWidth  && h <= holderHeight){
		objbig.style.width=holderWidth+"px";
	}
	else if(w > holderWidth  && h > holderHeight && bili>holderbili){
		if(bili > 1){
			objbig.style.width=holderWidth+"px";
		}else if(bili <= 1){
			objbig.style.height=holderHeight+"px";
		}
	}
	else if(w > holderWidth  && h > holderHeight && bili<=holderbili){
		objbig.style.height=holderHeight+"px";
	}
}

//var tanchu=document.getElementById("tanchu");
//var mask=document.getElementById("mask");
//var hid=document.getElementById("hidde");
//var close=document.getElementById("close");
var jersey=document.getElementById("jersey_one");
var change=document.getElementById("change");

function picture(){	
									/*js_one*/
	var lf=document.getElementById("lf_one");
	var rig=document.getElementById("rig_one");
	var fa_one=document.getElementById("father_one");
	var main_one=document.getElementById("two");
	var pic_one=document.getElementById("two").getElementsByTagName("img");
	var top_pic=document.getElementById("jersey_one").getElementsByTagName("img");
	var bigpic=document.getElementById("top_pic");
	var b=0;
	var imgwidth_one=60;
	//var one_width=document.getElementById("jersey_one").clientWidth;
	var one_width=279;
	//var one_height=document.getElementById("jersey_one").clientHeight;
	var one_height=249;

	for(var j=0;j<pic_one.length;j++){
		pic_one[j].onmouseover=function(){movee(this);}
	}
	function movee(obj){
		for(var j=0;j<pic_one.length;j++){
			if(obj==pic_one[j]){
				top_pic[j].className="top_pic"
				pic_one[j].className="special_img";
				b=j;//此处相对于tab切换来说不写也行，是为了下面其他特效的使用而定义的，是把数组的下标值赋给a;
				//alert(one_width);
				bili(top_pic[j],one_width,one_height);
			}
			else{
				pic_one[j].className="";
				top_pic[j].className="";
			}
		}
	}//tab切换；
	function reducee(){
		if(b<=0){}
		else{
			pic_one[b-1].className="special_img";
			pic_one[b].className="";
			top_pic[b-1].className="top_pic";
			top_pic[b].className="";
			bili(top_pic[b-1],one_width,one_height);
			b--;
			fa_one.scrollLeft=fa_one.scrollLeft-imgwidth_one;
			
		}

	}
	lf.onclick=function(){reducee();}//向左翻页
	function addd(){
		if(b>=pic_one.length-1){
			pic_one[b].className="";
			top_pic[b].className="";	
			b=0;
			fa_one.scrollLeft=0;
			top_pic[b].className="top_pic";
			pic_one[b].className="special_img";	
		}
		else{
			pic_one[b+1].className="special_img";
			pic_one[b].className="";
			top_pic[b+1].className="top_pic";
			top_pic[b].className="";
			bili(top_pic[b+1],one_width,one_height);
			b++;
			fa_one.scrollLeft=fa_one.scrollLeft+imgwidth_one;
			
		}
	}
	rig.onclick=function(){addd();}//向右翻页
	bili(bigpic,one_width,one_height);
}
picture();


jersey.onclick=function(){
	tanchu.style.display="block";
	mask.style.display="block";
	//hid.style.display="none";
	//var two_width=document.getElementById("lf_click").clientWidth;
	//var two_hieght=document.getElementById("lf_click").clientHeight;
	var two_width=800;
	var two_hieght=500;
	bili(change,two_width,two_hieght);
	bigpicture();
}
function bigpicture(){

											/*js_two*/

	var inputlf=document.getElementById("lf");
	var inputrig=document.getElementById("rig");
	var fa=document.getElementById("father");
	var main=document.getElementById("one");
	var pic=document.getElementById("one").getElementsByTagName("img");
	var lg_click=document.getElementById("lf_click");
	var lg_pic=document.getElementById("lf_click").getElementsByTagName("img");
	var lf_but=document.getElementById("lf_but");
	var rg_but=document.getElementById("rg_but");
	var a=0;
	var imgwidth=167;
	for(var j=0;j<pic.length;j++){
		pic[j].onmouseover=function(){move(this);}
	}
	function move(target){
		for(var i=0;i<pic.length;i++){
			if(target==pic[i]){
				tanchu.style.display="block";
				//var two_width=document.getElementById("lf_click").clientWidth;
				//var two_height=document.getElementById("lf_click").clientHeight;
				var two_width=800;
				var two_height=500;
				lg_pic[i].className="change_img";
				pic[i].className="special";
				bili(lg_pic[i],two_width,two_height);
				a=i;//此处相对于tab切换来说不写也行，是为了下面其他特效的使用而定义的，是把数组的下标值赋给a;
			}
			else{pic[i].className="";lg_pic[i].className="";}
		}
	}//tab切换；
	function reduce(){
		tanchu.style.display="block";
		//var two_width=document.getElementById("lf_click").clientWidth;
		//var two_height=document.getElementById("lf_click").clientHeight;
		var two_width=800;
		var two_height=500;
		if(a<=0){}
		else{
			pic[a-1].className="special";
			pic[a].className="";
			lg_pic[a-1].className="change_img";
			lg_pic[a].className="";
			bili(lg_pic[a-1],two_width,two_height);
			a--;
			fa.scrollLeft=fa.scrollLeft-imgwidth;
			
		}
	}
	inputlf.onclick=function(){reduce();}//向左翻页
	lf_but.onclick=function(){reduce();}
	lf_but.onmouseover=function(){lf_but.className="lf_but_color";}
	lf_but.onmouseout=function(){lf_but.className="lf_but";}	

	function add(){
		tanchu.style.display="block";
		//var two_width=document.getElementById("lf_click").clientWidth;
		//var two_height=document.getElementById("lf_click").clientHeight;
		var two_width=800;
		var two_height=500;
		if(a>=pic.length-1){
			pic[a].className="";
			lg_pic[a].className="";
			a=0;
			fa.scrollLeft=0;
			lg_pic[a].className="change_img";
			pic[a].className="special";
		}
		else{
			pic[a+1].className="special";
			pic[a].className="";
			lg_pic[a+1].className="change_img";
			lg_pic[a].className="";
			bili(lg_pic[a+1],two_width,two_height);
			a++;
			fa.scrollLeft=fa.scrollLeft+imgwidth;
			
		}
	}
	inputrig.onclick=function(){add();}//向右翻页
	rg_but.onclick=function(){add();}
	rg_but.onmouseover=function(){rg_but.className="rg_but_color";}
	rg_but.onmouseout=function(){rg_but.className="rg_but";}	
}


close.onclick=function(){
	tanchu.style.display="none";
	mask.style.display="none";
}
