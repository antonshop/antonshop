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

function init_form(){
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
FR : Efface vos pr閒閞ences (format)
EN : Delete options
*/
function reset_options(){
	delete(localStorage["format"]);
	init_form();
}

/*
FR : Sauvegarde les pr閒閞ences
EN : Store options into localStorage
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
	
	init_form();
}

$("#addtextinput").click(function(){
	var inputsum = $("#options input").length;
	var num = inputsum / 2;
	var addinfo = '<input type="text" id="optionname' + num + '" size="10"><input type="text" id="optionvalue' + num + '"><br>';
	$("#options").append(addinfo);
});

$("#addarea").click(function(){
	var inputsum = $("#options input").length;
	var num = inputsum / 2;
	var addinfo = '<input type="text" id="optionname' + num + '" size="10"><textarea id="optionvalue' + num + '"></textarea><input type="hidden" "><br>';
	$("#options").append(addinfo);
});

$("#inputsum").click(function(){
	var inputsum = $("#options input").length;
	var num = inputsum / 2;	
	alert(num);
});

function save_addoptions(){
	var inputsum = $("#options input").length;
	var num = inputsum / 2;
	for(var i=0; i<num; i++){
		localStorage["an_" + $("#optionname" + i).val()] = $("#optionvalue" + i).val();
	}
	
}
for(var i=0;i<localStorage.length;i++){
	//alert(localStorage.key(i).substr(0,3));
	//var option_info = '';
	if(localStorage.key(i).substr(0,3) == 'an_'){
		$("#options").append('<input type="text" id="optionname' + i + '" size="10" value='+localStorage.key(i).substr(3)+'><input type="text" id="optionvalue' + i + '" value='+localStorage.getItem(localStorage.key(i))+'><br>');
	}
}

$("#clear").click(function(){
	localStorage.clear();
})

window.onload = function(){
	init_form();
}










