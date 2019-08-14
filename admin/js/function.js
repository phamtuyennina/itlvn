// JavaScript Document
$(document).ready(function(e) {
    $('#validate textarea[name="des"]').keyup(function(){
		var num_vn = $(this).val().length;
		$('input[name="des_char"]').val(num_vn);
	})		    
});

function CreateTitleSEO(){
	var f = document.getElementById("validate");
	
	name = f.name.value;
	//name_en = f.name_en.value;
	
	f.title.value = name;
	//f.title_en.value = name_en;
	
	f.keyword.value = name.toLowerCase() + ", " + StripVi(name).toLowerCase();
	//f.keyword_en.value = name_en.toLowerCase();
	
	f.des.value = f.short.value;
	//f.des_en.value = f.short_en.value;

	//f.unique_key.value = StripVi2(f.name.value).toLowerCase();
	//f.unique_key_en.value = StripVi2(f.name_en.value).toLowerCase();
	
	f.des_char.value = f.short.value.length;
	//f.des_en_char.value = f.short_en.value.length;
}

function CreateTitleSEOWidthTag(){
	var f = document.getElementById("validate");
	
	name = f.name.value;
	//name_en = f.name_en.value;
	
	f.title_vn.value = name;
	//f.title_en.value = name_en;
	
	if (f.tags.value)
		f.keyword_vn.value = f.keyword_en.value = f.tags.value;
	else
	{
		f.keyword_vn.value = name.toLowerCase() + ", " + StripVi(name).toLowerCase();
		//f.keyword_en.value = name_en.toLowerCase();
	}
	
	f.des_vn.value = f.short_vn.value;
	//f.des_en.value = f.short_en.value;

	f.unique_key_vn.value = StripVi2(f.name.value).toLowerCase();
	//f.unique_key_en.value = StripVi2(f.name_en.value).toLowerCase();
	
	f.des_vn_char.value = f.short_vn.value.length;
	//f.des_en_char.value = f.short_en.value.length;
}

function StripVi(str) {
  str= str.toLowerCase();
  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
  str= str.replace(/đ/g,"d");
  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'||\"|\&|\#|\[|\]|~|$|_/g,"");
	/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
  str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
  str= str.replace(/^\-+|\-+$/g,"");
	//cắt bỏ ký tự - ở đầu và cuối chuỗi
  return str;
  } 
function StripVi2(str) {
  str= str.toLowerCase();
  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
  str= str.replace(/đ/g,"d");
  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\`|\&|\#|\[|\]|~|\$|_/g,"-");
/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
  str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
  str= str.replace(/^\-+|\-+$/g,"");
	//cắt bỏ ký tự - ở đầu và cuối chuỗi
  return str;
  }
function OnlyNumber(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 47 && charCode < 58)
	return true;

 return false;
}
 function StripTag(str) {
	  str= str.toLowerCase();
	  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
	  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
	  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
	  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
	  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
	  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
	  str= str.replace(/đ/g,"d");
	  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|\.|\:|\;|\'| |\"|\`|\&|\#|\[|\]|~|$|_/g,"-");
	/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
	  str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
		str= str.replace(/-+,/g,",");
		str= str.replace(/,+-/g,",");
	  str= str.replace(/^\-+|\-+$/g,"");
		//cắt bỏ ký tự - ở đầu và cuối chuỗi
	  return str;
} 