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
	chrome.tabs.executeScript(null,{code:"$('input[@name=body]').val('123')"});
	
	/*chrome.tabs.getAllInWindow(null, function(all) {
		for (var i = 0; i < all.length; i++) {
			for(var j=0;j<localStorage.length;j++){
				chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+localStorage.key(j).substr(3)+"')[0].value='"+decodeURIComponent(localStorage.getItem(localStorage.key(j)))+"'"});
			}
		}
	});*/
	/*for(var i=0;i<localStorage.length;i++){
		if(localStorage.key(i).substr(0,3) == 'an_'){
			chrome.tabs.executeScript(null,{code:"document.getElementsByName('"+localStorage.key(i).substr(3)+"')[0].value='"+localStorage.getItem(localStorage.key(i))+"'"});
		}
	}*/
}

function writeOption(id, key, data){
	
	var codetxt = '';
	if(data.type == 'id'){
		codetxt = "$('#"+ key +"').val('"+ data.value +"')";
	}else if(data.type == 'name'){
		codetxt = "document.getElementsByName('"+key+"')[0].value = '"+ data.value + "'";//"$('input[@name="+ key +"]').val('"+ data.value +"')";
	}
	chrome.tabs.executeScript(id,{code:""+codetxt+""});
	
}

function focuscode(key, data){
	if(data.type == 'id'){
		return "$('#"+ data.value +"').focus()";
	}else if(data.type == 'name'){
		return "document.getElementsByName('"+data.value+"')[0].focus()";
	}
}

function submitcode(key, data){
	if(data.type == 'id'){
		return "$('#"+ data.value +"').submit()";
	}else if(data.type == 'name'){
		return "document.getElementsByName('"+data.value+"')[0].submit()";
	}
}

function writeAllForm(){
	chrome.tabs.getAllInWindow(null, function(all) {
		var key = '';
		var submittxt = '';
		var focustxt = '';
		var data = '';
		for (var i = 0; i < all.length; i++) {
			for(var j=0;j<localStorage.length;j++){
				if(localStorage.key(j).substr(0,3) == prefix){
					data = JSON.parse(decodeURIComponent(localStorage.getItem(localStorage.key(j))).replace(/\n/g,"<br>"));
					key = localStorage.key(j).substr(3);
					if(key == 'FOCUS'){
						var focustxt = focuscode(key, data);
					}else if(key == 'SUBMIT'){
						var submittxt = submitcode(key, data);
					}
					/* 替换空格，encode */
					//ls_value = localStorage.getItem(localStorage.key(j));
					//alert(localStorage.key(j).substr(3)+"**"+localStorage.getItem(localStorage.key(j)));
					writeOption(all[i].id, localStorage.key(j).substr(3), data);
					//chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+ keyname +"')[0].value='"+ls_value+"'"});
				}
			}
			if(focustxt != ''){
				chrome.tabs.executeScript(all[i].id,{code:""+focustxt+""});
				focustxt = '';
			}
			if(submittxt != ''){
				chrome.tabs.executeScript(all[i].id,{code:""+submittxt+""});
				submittxt = '';
			}
			/*if(localStorage.key(j).substr(3) == "submitType"){
				//alert(localStorage.getItem(prefix + "submitType"));
			}*/
			/*if(keyname != "undefined"){
				chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+keyname+"')[0].focus()"});
				chrome.tabs.executeScript(all[i].id,{code:"document.getElementsByName('"+keyname+"')[0].parentNode.submit()"});
			}*/
		}
	});
}