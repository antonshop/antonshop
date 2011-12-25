var prefix = 'an_';

function copyToClipboard(str){
	var obj=document.getElementById("tempurl");
	if( obj ){
		obj.value = str;
		obj.select();
		document.execCommand("copy", false, null);
	}
}

function copy_html(tabs){
	var s = '';
	for (var i=0; i < tabs.length; i++) {
		s += '<a href="'+tabs[i].url+'">'+tabs[i].url+"</a><br/>";
		s = s + "\n";
	}
	return s;
}

function copy_text(tabs){
	var s = '';
	for (var i=0; i < tabs.length; i++) {
		s += tabs[i].url;
		s = s + "\n";
	}
	return s;
}

function copyallwindows() {
	var defaut = 'text';
	var format = localStorage["format"];
	if(!format){
		tmp = defaut;
	}
	win = chrome.windows.getCurrent(function(win) {
		chrome.tabs.getAllInWindow(win.id, function(tabs) {
			if(format == 'html')
				var s = copy_html(tabs);
			else
				var s = copy_text(tabs);
			
			copyToClipboard(s);
			//window.close();
		})
	});
}

$("#createUrl").click(function(){
	
	list = $("#tempurl").val().split("\n");
	for(var i=0;i<list.length;i++){
		chrome.tabs.create( { 
			url:list[i],
			index:(chrome.tabs.index),
			selected:false } 
		);
	}
	window.close();
	
});
$("#copyUrl").click(function(){
	var defaut = 'text';
	var format = localStorage["format"];
	if(!format){
		tmp = defaut;
	}
	
	win = chrome.windows.getCurrent(function(win) {
		chrome.tabs.getAllInWindow(win.id, function(tabs) {
			
			if(format == 'html')
				var s = copy_html(tabs);
			else
				var s = copy_text(tabs);
			
			copyToClipboard(s);
			window.close();
		})
	});
});

function change_color() {
  chrome.tabs.executeScript(null,
      {code:"document.body.style.backgroundColor='#ccc'"});
  window.close();
}

$("#write").click(function(){
	writeForm();
  	//window.close();
});

$("#submit").click(function(){
	for(var i=0;i<localStorage.length;i++){
		if(localStorage.key(i).substr(0,3) == prefix){
			var child_name = localStorage.key(i).substr(3);
			break;
		}
	}
	
	/*chrome.tabs.executeScript(null,{code:"$('form').submit()"});*/
	if(child_name != "undefined"){
		chrome.tabs.executeScript(null,{code:"document.getElementsByName('"+localStorage.key(i).substr(3)+"')[0].parentNode.submit()"});
	}
});

function submitForm(child_name,key){
	
}

$("#writeAllTabs").click(function(){
	writeAllForm();
});

function writeForm(){
	chrome.tabs.getAllInWindow(null, function(all) {
		for (var i = 0; i < all.length; i++) {
			for(var j=0;j<localStorage.length;j++){
				chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+localStorage.key(j).substr(3)+"')[0].value='"+decodeURIComponent(localStorage.getItem(localStorage.key(j)))+"'"});
			}
		}
	});
	/*for(var i=0;i<localStorage.length;i++){
		if(localStorage.key(i).substr(0,3) == 'an_'){
			chrome.tabs.executeScript(null,{code:"document.getElementsByName('"+localStorage.key(i).substr(3)+"')[0].value='"+localStorage.getItem(localStorage.key(i))+"'"});
		}
	}*/
}

function writeAllForm(){
	chrome.tabs.getAllInWindow(null, function(all) {
		var keyname = null;
		var ls_value = '';
		for (var i = 0; i < all.length; i++) {
			for(var j=0;j<localStorage.length;j++){
				if(localStorage.key(j).substr(0,3) == prefix){
					keyname = localStorage.key(j).substr(3);
					/* 替换空格，encode */
					ls_value = encodeURIComponent(localStorage.getItem(localStorage.key(j)).replace(/\n/g,"<br>"));
					chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+ keyname +"')[0].value='"+ls_value+"'"});
				}
			}
			/*if(localStorage.key(j).substr(3) == "submitType"){
				//alert(localStorage.getItem(prefix + "submitType"));
			}*/
			if(keyname != "undefined"){
				chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+keyname+"')[0].focus()"});
				chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+keyname+"')[0].parentNode.submit()"});
			}/**/
		}
	});
}