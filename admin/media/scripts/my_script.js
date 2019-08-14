// JavaScript Document

function docheck(status,from_){
	if(typeof document.frm.chkid == 'undefined') return;
	var alen=document.frm.elements.length;						//alert(alen);
	alen=(alen>el_num)?document.frm.chkid.length:0;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			document.frm.chkid[i].checked=status;
	}else
	{
			document.frm.chkid.checked=status;
	}
	if(from_>0)
		document.frm.chkall.checked=status;
}

function docheckone(){
	var alen=document.frm.elements.length;
	var isChecked=true;
	alen=(alen>el_num)?document.frm.chkid.length:0;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			if(document.frm.chkid[i].checked==false)
				isChecked=false;
	}else
	{
		if(document.frm.chkid.checked==false)
			isChecked=false;
	}				
	document.frm.chkall.checked=isChecked;
}

function calculate(){
	var strchon='';
	var alen=document.frm.elements.length;				
	alen=(alen>el_num)?document.frm.chkid.length:0;
	if (alen>0)
	{
		for(var i=0; i<alen; i++)
			if(document.frm.chkid[i].checked==true)
				strchon += "," + document.frm.chkid[i].value;
	}else
	{
		if(document.frm.chkid.checked==true)
			strchon = document.frm.chkid.value;
	}
	return strchon;
}


/*
|------------------FCK--------------------------------------------
*/

//var sBasePath_FCK = document.location.href.substring(0,document.location.href.indexOf('anhduong'))+'FCKeditor/' ;
//include(document.location.href.substring(0,document.location.href.indexOf('anhduong'))+"FCKeditor/fckeditor.js");

/*
var sBasePath_FCK = document.location.href.substring(0,document.location.href.indexOf('admin'))+'FCKeditor/' ;
include(document.location.href.substring(0,document.location.href.indexOf('admin'))+"FCKeditor/fckeditor.js");
*/
/*
var sBasePath_FCK = document.location.href.substring(0,document.location.href.indexOf('admin'))+'FCKeditor/' ;
inc("../FCKeditor/fckeditor.js");
*/
/*--------------- FCK ------------------------*/

function fck_create(name, height, width, toolbarSet){
	var fck = new FCKeditor(name, width, height, toolbarSet ) ; 
	fck.BasePath	= sBasePath_FCK ;
	fck.ReplaceTextarea() ;
	return fck;
}

function fck_get(editor_name){
	var oEditor = FCKeditorAPI.GetInstance(editor_name) ;
	if (oEditor.EditorDocument.body.innerHTML) {
		// Uncomment the following line for a proper XHTML return
		// return oEditor.GetXHTML();
		return oEditor.EditorDocument.body.innerHTML;
	}
	else return '';
}

function fck_reset(editor_name){
	var oEditor = FCKeditorAPI.GetInstance(editor_name) ;
	oEditor.EditorDocument.body.innerHTML='';
}

function fck_set(editor_name, value){
	var oEditor = FCKeditorAPI.GetInstance(editor_name) ;
	oEditor.EditorDocument.body.innerHTML = value;
}
/*---------------------------------------------*/

function include(filepath){
	var head = document.getElementsByTagName('head').item(0);
	script = document.createElement('script');
	script.src = filepath;
	script.type = 'text/javascript';
	head.appendChild(script)
}
/*
|------------------------------------------------------------------
*/

function isEmpty(str,text){
	//var el = document.getElementById(id);
	
	if (str != "")
		while (str.charAt(0) == " ")
			str = str.substr(1, str.length);
	if(str != "") return false;
	if(typeof(text) != 'undefined')	alert(text);
	
	return true;
}

function isNumber(el, text){
	//var el = document.getElementById(id);
	var str = "0123456789";
	for(var j=0; j < el.value.length; j++){
		if(str.indexOf(el.value.charAt(j))==-1){
			if( typeof(text) != 'undefined' )
				alert(text);
			el.value = '';
			el.focus();	
			return false;
		}
	}
	return true;
}

function isPhone(el, text){
	var str = "0123456789. ()-";
	var result = true;
	for(var j=0; j < el.value.length; j++){
		if(str.indexOf(el.value.charAt(j))==-1){
			result = false;
			break;
		}
	}
	if(el.value.length < 7) result = false;
	if(!result){	
		el.focus();
		if(typeof(text)!='undefined')	alert(text);
	}
	return result;
}

function check_email(email)
{
	emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
	return emailRegExp.test(email);
}

function isEmail(el, text){
	//var el = document.getElementById(id);
	emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
	if(!emailRegExp.test(el.value)){
		if(typeof(text)!='undefined')	alert(text);
		el.focus();
		return false;
	}
	return true;
}

function isEmail_2(s){   
  if (s=="") return true;//false;
  if(s.indexOf(" ")>0) return false;
  if(s.indexOf("@")==-1) return false;
  var i = 1;
  var sLength = s.length;
  if (s.indexOf(".")==-1) return false;
  if (s.indexOf("..")!=-1) return false;
  if (s.indexOf("@")!=s.lastIndexOf("@")) return false;
  if (s.lastIndexOf(".")==s.length-1) return false;
  var str="abcdefghikjlmnopqrstuvwxyz-@._"; 
  for(var j=0;j<s.length;j++)
	if(str.indexOf(s.charAt(j))==-1)
		return false;
  return true;
}

function compare(value_1, value_2){
	if(value_1 < value_2)
		return -1;
	if(value_1 > value_2)
		return 1;
	return 0;
}
//---------------------------------------------------------
function create_option(index, value, text)
{
	var select = document.getElementsByTagName('select').item(index);
	option = document.createElement('option');
	option.value = value;
	option.innerHTML = text;
	select.appendChild(option);
}
//----------------------------------------------------- showtime
function showtime(id, lang) {
	var navName = navigator.appName;
	//alert("navName = "+navName);
	//var bVer = parseInt(navigator.appVersion);
	//alert("appVer = "+bVer);
	//return
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
	var timeValue = ((hours >12) ? hours -12 :hours);
	timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
	timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
	timeValue += (hours >= 12) ? " PM, " : " AM, ";
	
	if( typeof(lang)!='undefined' && lang == 'vi' )
	{
		switch (now.getDay())
		{
			case 1 : timeValue += 'Chủ Nhật';break;
			case 2 : timeValue += 'Thứ Hai';break;
			case 3 : timeValue += 'Thứ Ba';break;
			case 4 : timeValue += 'Thứ Tư';break;
			case 5 : timeValue += 'Thứ Năm';break;
			case 6 : timeValue += 'Thứ Sáu';break;
			case 7 : timeValue += 'Thứ Bảy';break;
		}
		
		timeValue += ' &nbsp;'+now.getDate();
		if( now.getMonth()>9 ) timeValue += ' - '+now.getMonth();
		else timeValue += ' - 0'+now.getMonth();
		timeValue += ' - '+(now.getYear()+1900);
		
	}else
	{
		switch (now.getDay())
		{
			case 1 : timeValue += 'Sunday';break;
			case 2 : timeValue += 'Monday';break;
			case 3 : timeValue += 'Tuesday';break;
			case 4 : timeValue += 'Wednesday';break;
			case 5 : timeValue += 'Thursday';break;
			case 6 : timeValue += 'Friday';break;
			case 7 : timeValue += 'Saturday';break;
		}
		
		if( now.getMonth()>9 ) timeValue += ' &nbsp;'+now.getMonth();
		else timeValue += ' &nbsp;0'+now.getMonth();
		timeValue += ' - '+now.getDate();
		if(navName == 'Netscape')
			timeValue += ' - '+(now.getYear()+1900);
		else
			timeValue += ' - '+(now.getYear());
	}
	
	document.getElementById(id).innerHTML = timeValue;
	timerID = setTimeout("showtime('"+id+"','"+lang+"')",1000);
}
