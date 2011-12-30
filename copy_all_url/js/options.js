// 删除左右两端的空格
String.prototype.trim=function() {
	return this.replace(/(^\s*)|(\s*$)/g,'');
}
var Url = {
 
	// public method for url encoding
	encode : function (string) {
		return escape(this._utf8_encode(string));
	},
 
	// public method for url decoding
	decode : function (string) {
		return this._utf8_decode(unescape(string));
	},
 
	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}

/*
FR : Coche la case Texte (text) ou HTML (html)
EN : Checks the Text or HTML checkbox
*/
function cocher(option){
	var f_text = $("#f_text");
	var f_html = $("#f_html");
	
	if(option == 'html'){
		f_text.checked = false;
		f_html.checked = true;
	}
	else{
		f_html.checked = false;
		f_text.checked = true;
	}
}

function init_format(){
	var actuel = $("#actuel");
	var f_text = $("#f_text");
	var f_html = $("#f_html");
	var format = localStorage["format"];
	var defaut = 'text';
	
	actuel.innerHTML = '';
	actuel.innerHTML = format;
	
	if(!format){
		tmp = defaut;
	}
	else{
		tmp = format;
	}
	cocher(tmp);
}

/*
 * 重置选项
 */
function reset_options(){
	delete(localStorage["format"]);
	init_format();
}

/*
 * 保存选项
 */
function save_options(){
	var form_format;
	var f_text = $("#f_text");
	var f_html = $("#f_html");
	
	if(f_html.checked)
		form_format = 'html';
	else
		form_format = 'text';
	
	localStorage["format"] = form_format;
	save_addoptions();
}

/*
 * 添加选项（文本框）
 */
$("#addtextinput").click(function(){
	addOptions('input');
});


/*
 * 添加submit
 */
$("#addsubmit").click(function(){
	addOptions("submit");
});

/*
 * 添加focus
 */
$("#addfocus").click(function(){
	addOptions("focus");
});

/*
 * 添加form
 */
$("#addform").click(function(){
	addOptions("form");
});

/*
 * 添加选项
 */
function addOptions(type){
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);
	var addcontent = '';
	var typecontent = '<select id="type' + num + '"><option value="id" selected="selected">id</option><option value="name">name</option></select>';
	if(type == 'input'){
		addcontent += '<input type="text" id="optionname' + num + '">'+ typecontent +'<input size="10" type="text" id="optionvalue' + num + '"><br>';
	}else if(type == 'focus'){
		addcontent += '<input type="text" id="optionname' + num + '" value="FOCUS" readonly="readonly">'+ typecontent +'<input size="10" type="text" id="optionvalue' + num + '"><br>';
	}else if(type == 'form'){
		addcontent += '<input type="text" id="optionname' + num + '" value="FORM" readonly="readonly">'+ typecontent +'<input size="10" type="text" id="optionvalue' + num + '"><br>';
	}else if(type == 'submit'){
		addcontent += '<input type="text" id="optionname' + num + '" value="SUBMIT" readonly="readonly">'+ typecontent +'<input size="10" type="text" id="optionvalue' + num + '"><br>';
	}
	$("#options").append("<li>"+addcontent+"</li>");
}

/*
 * 删除选项
 */
function del_option(key){
	localStorage.removeItem("an_"+key);
	window.location.reload();
}

/*
 * 保存选项
 */
function save_addoptions(){
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);
	var ls_value = '';
	var optionObj = new Object();
	for(var i=0; i<num; i++){
		optionObj.value = $("#optionvalue" + i).val();
		optionObj.value = replacestr(optionObj.value);
		optionObj.type = $("#type" + i + " option:selected").val();
		if(($("#optionname" + i).val()).trim().length > 0 && optionObj.value.trim().length >0)
			localStorage["an_" + $("#optionname" + i).val()] = encodeURIComponent(JSON.stringify(optionObj));
	}
	window.location.reload();
}

/*
 * 初始化 选项
 */
function init_form(){
	var j=0;
	var optionObj = '';
	for(var i=0;i<localStorage.length;i++){
		if(localStorage.key(i).substr(0,3) == 'an_'){
			optionObj = JSON.parse(decodeURIComponent(localStorage.getItem(localStorage.key(i))));
			var addinfo = '<input type="text" id="optionname' + j + '" size="10" value='+localStorage.key(i).substr(3)+'>';
			addinfo += '<select id="type' + j + '"><option value="id">id</option><option value="name">name</option></select>';
			
			if(optionObj.value.length < 30)
				addinfo += '<input type="text" id="optionvalue' + j + '" size="58" value="">';
			else 
				addinfo += '<textarea cols="52" rows="5" id="optionvalue'  + j + '" value=""></textarea><input type="hidden">';
			addinfo += '<img src="images/del.gif" class="del_icon" onclick="del_option(\''+ localStorage.key(i).substr(3) +'\')"><br>';			
			$("#options").append("<li>"+addinfo+"</li>");
			$("#optionvalue"+j).val(optionObj.value);
			$("#type"+j).attr("value",optionObj.type);
			j++
		}
	}
}

/*
 * 替换特殊字符
 */
function replacestr(str){
	str = str.replace("'", "&rsquo;");
	return str;
}

/*
 * 清除所有选项
 */
$("#clear").click(function(){
	localStorage.clear();
	window.location.reload()
})

/*
 * 清除选定的选项
 */
function delete_options(key){
	localStorage.removeItem(key);
}


window.onload = function(){
	init_format();
	init_form();
}










