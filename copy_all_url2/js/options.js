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
	
	init_form();
}

$(".addoption").click(function(){
	
});

window.onload = function(){
	init_form();
}










