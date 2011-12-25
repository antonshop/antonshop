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
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);
	var addinfo = '<input type="text" id="optionname' + num + '" size="10"><input type="text" id="optionvalue' + num + '"><br>';
	$("#options").append(addinfo);
});

/*
 * 添加选项（文本域）
 */
$("#addarea").click(function(){
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);
	var addinfo = '<input type="text" id="optionname' + num + '" size="10"><textarea id="optionvalue' + num + '"></textarea><input type="hidden" "><br>';
	$("#options").append(addinfo);
});

$("#inputsum").click(function(){
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);	
});

function changeType(optionid){
	$("#"+optionid).val($('#submitoption option:selected').val());
}

/*
 * 添加submit
 */
$("#addsubmit").click(function(){
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);
	var addinfo = '<select id="submitoption" style="width:96px;" onchange="changeType(\'optionvalue'+num+'\')"><option value="id" selected="selected">id</option><option value="name">name</option></select><input type="hidden" id="optionname' + num + '" value="submittype"><input type="hidden" value="id" id="optionvalue' + num + '">';
	addinfo += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" value="submitvalue" id="optionname' + (num+1) + '"><input type="text" value="" id="optionvalue' + (num+1) + '">';
	$("#options").append(addinfo);
});

/*
 * 添加focus
 */
$("#addfocus").click(function(){
	addOptions("focus");
});

function addOptions(type){
	var addcontent = '';
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);
	if(type == 'focus'){
		addcontent = '<input type="text" id="optionname' + num + '" size="10"><input type="text" id="optionvalue' + num + '"><br>';
	}
	$("#options").append(addinfo);
}

/*
 * 保存选项
 */
function save_addoptions(){
	var inputsum = $("#options input").length;
	var num = Math.floor(inputsum / 2);
	var ls_value = '';
	for(var i=0; i<num; i++){
		/* encode */
		ls_value = encodeURIComponent($("#optionvalue" + i).val());
		if(($("#optionname" + i).val()).trim().length > 0 && ($("#optionvalue" + i).val()).trim().length >0)
			localStorage["an_" + $("#optionname" + i).val()] = ls_value;
	}
	window.location.reload()
}

/*
 * 初始化 选项
 */
function init_form(){
	var j=0;
	for(var i=0;i<localStorage.length;i++){
		if(localStorage.key(i).substr(0,3) == 'an_'){
			var addinfo = '<input type="text" id="optionname' + j + '" size="10" value='+localStorage.key(i).substr(3)+'>';
			if(localStorage.getItem(localStorage.key(i)).length < 30)
				addinfo += '<input type="text" id="optionvalue' + j + '" size="58" value=""><br>';
			else 
				addinfo += '<textarea cols="52" rows="5" id="optionvalue'  + j + '" value=""></textarea><input type="hidden"><br>';
			$("#options").append(addinfo);
			$("#optionvalue"+j).val(decodeURIComponent(localStorage.getItem(localStorage.key(i))));
			j++
		}
	}
	
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










