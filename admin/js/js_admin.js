var baseurl = '';
function addCommas(e){e+="";x=e.split(".");x1=x[0];x2="";x2=x.length>1?"."+x[1]:"";var t=/(\d+)(\d{3})/;while(t.test(x1)){x1=x1.replace(t,"$1"+"."+"$2")}return x1+x2}
function loadloai(div,id)
{
	$.ajax({
		type:"POST",
		url:"ajax/refresh.php",
		data:{id:id},
		success: function(data){
			$('.'+div).html(data);
			$("#"+id).chosen();
		}
	})
}
$(document).ready(function(e) {	
	// check hien gio post tin trong tin tuc
	$("input[name=active_future]").click(function(e) {
		var inputActive = $("input[name=active]");
		var labelActive= $("label[for=active]");
		if($(this).is(':checked'))		{
			
			inputActive.attr('checked',false);
			inputActive.prepend('span').trigger('click');
			inputActive.attr('disabled',true);
			labelActive.addClass('disabled');
			$('#chose_date_time').fadeIn(300);
		}
		else{
			
			inputActive.attr('checked',true);
			inputActive.prepend('span').trigger('click');
			inputActive.attr('disabled',false);
			labelActive.removeClass('disabled');
			$('#chose_date_time').fadeOut(300);
		}
	});
	// check dung banner flash hay anh	
	$('input[name=useflash]').click(function(){
		if($(this).is(':checked')){
			$('#upload_flash').show(400);
			$('#upload_banner').hide(400);
		}
		else{
			$('#upload_banner').show(400);
			$('#upload_flash').hide(400);
		}
	});
	// check chon kieu widget va hien thi khung nhap lieu cho phu hop
	$('select[name="comp"]').change(function(){
  		var vl = $(this).find('option:selected').val();
		if(vl==7){
			$('.html_content').show();
		}
		else{
			$('.html_content').hide();
		}
		if(vl==1){
			$('.cattype').show();
		}
		else{
			$('.cattype').hide();
		}
		if(vl==2){
			$('.producttype').show();
		}
		else{
			$('.producttype').hide();
		}
		if(vl==3){
			$('.articletype').show();
		}
		else{
			$('.articletype').hide();
		}
		if(vl==4){
			$('.facebook').show();
		}
		else{
			$('.facebook').hide();
		}
		if(vl==9){
			$('.searchtype').show();
		}
		else{
			$('.searchtype').hide();
		}
		if(vl==2 || vl==3){
			$('.numberQuery').show();
		}
		else{
			$('.numberQuery').hide();
		}
	})
	// tag tin tuc
	$('span#tag_on_article a').click(function(){		
		var parent_ =$(this).parent('span');
		var uni_tag = LayMa(parent_.find('span').text());
		var get_id = $('#id_this_articles').val();
		jQuery.ajax({
			type: 'POST',
			url: baseurl + '/ajax.php?do=articles&act=tags',
			data: {
				'uni_tag':uni_tag, 
				'id':get_id
			},
			success: function(data) {
				parent_.remove();			
			}
		});
		return false;
	})
	// tag san pham
	$('span#tag_on_products a').click(function(){		
		var parent_ =$(this).parent('span');
		var uni_tag = LayMa(parent_.find('span').text());
		var get_id = $('#id_this_product').val();
		jQuery.ajax({
			type: 'POST',
			url: baseurl + 'ajax.php?do=products&act=tags',
			data: {
				'uni_tag':uni_tag, 
				'id':get_id
			},
			success: function(data) {
				parent_.remove();			
			}
		});
		return false;
	})
});
// cap nhat so thu tu trong template/admin/ file list.ctp
function updateNumber(table, id)
{
	var num = jQuery('#number'+id).val();
	
	$('#ajaxloader'+id).css('display', 'block');
	jQuery.ajax({
		type: 'POST',
		url: baseurl + 'ajax.php?do=number&act=update',
		data: {'table':table, 'id':id, 'num':num},
		success: function(data) {
			$('#ajaxloader'+id).css('display', 'none');
			jQuery('#number'+id).val(num)
		}
	});
}

$(document).ready(function(e) {
	// click de chuyen doi giua khung dang nhap va khung quen mat khau cua admin
	$(".forgot-pwd").click(function () {
		$("#loginForm").hide();
		$("#forgotForm").show();
		return false;
	});
	$(".back-login").click(function () {
		$("#loginForm").show();
		$("#forgotForm").hide();
		return false;
	});
	// kiem tra login bang ajax
	jQuery('.logMeIn').click(function() {
		var email = jQuery('#username').val();
		var pass = jQuery('#pass').val();

		if (email && pass)
		{
			$('.ajaxloader').css('display', 'block');
			jQuery.ajax({
				type: 'POST',
				url: baseurl + 'ajax.php?do=admin&act=login',
				data: {'pass':pass, 'email':email},
				success: function(data) {
					var myObject = eval('(' + data + ')');
					$('.ajaxloader').css('display', 'none');
					
					if (myObject['page'])
					{
						window.location=myObject['page'];
						//location.reload();
					}
					else if (myObject['mess'])
					{
						jQuery('#loginError').css('display', 'block');
						jQuery('#loginError').html(myObject['mess']);
					}
				}
			});
		}
		else {
			return true;
		}
		return false;
    });
	// logout bang ajax
	jQuery('#userLogout').click(function() {
		jQuery.ajax({
			type: 'POST',
			url: baseurl + '/ajax.php?do=admin&act=logout',
			success: function(data) {
				document.location = 'admin.php';
			}
		});
		return false;
    });
	// goi email quen mat khau
	jQuery('.sendEmail').click(function() {
		var email = jQuery('#email').val();

		if (email)
		{
			$('.ajaxloader').css('display', 'block');
			jQuery.ajax({
				type: 'POST',
				url: baseurl + '/ajax.php?do=admin&act=forgotpass',
				data: {'email':email},
				success: function(data) {
					$('.ajaxloader').css('display', 'none');
					var myObject = eval('(' + data + ')');
					jQuery('#echoMessage').css('display', 'block');
					jQuery('#echoMessage').html(myObject['mess']);
				}
			});
		}
		else {
			return true;
		}
		return false;
    });
	// them custom field trong san pham
	jQuery('#addField').click(function() {
		var name_vn = jQuery('#cname_vn').val();
		var value_vn = jQuery('#cvalue_vn').val();
		var name_en = jQuery('#cname_en').val();
		var value_en = jQuery('#cvalue_en').val();
		var alias = jQuery('#alias_custom').val();

		if (name_vn && value_vn)
		{
			$('.ajaxloader').css('display', 'block');
			jQuery.ajax({
				type: 'POST',
				url: baseurl + '/ajax.php?do=customfield&act=add',
				data: {'name_vn':name_vn, 'value_vn':value_vn, 'name_en':name_en, 'value_en':value_en, 'alias':alias},
				success: function(data) {
					$('.ajaxloader').css('display', 'none');
					$('#nofield').css('display', 'none');
					$('#tableField').append(data);
					jQuery('#cname_vn').val('');
					jQuery('#cvalue_vn').val('');
					jQuery('#cname_en').val('');
					jQuery('#cvalue_en').val('');
				}
			});
		}
		return false;
    });
	// them module keo tha trong salepage
	jQuery('#addModule').click(function() {
		var name = jQuery('#sname').val();
		var cid = jQuery('#cid').val();

		if (name)
		{
			jQuery.ajax({
				type: 'POST',
				url: baseurl + '/ajax.php?do=salepage&act=add',
				data: {'name':name, 'cid':cid},
				success: function(data) {
					$('#nomodule').css('display', 'none');
					$('#sortable').append(data);
					jQuery('#sname').val('');
				}
			});
		}
		return false;
    });
});
// cap nhat thong tin custom field
function updateField(id)
{
    var name_vn = $('#name_vn' + id).val();
    var value_vn = $('#value_vn' + id).val();
    var name_en = $('#name_en' + id).val();
    var value_en = $('#value_en' + id).val();

	if (name_vn && value_vn)
	{
		$('#ajaxloader'+id).css('display', 'block');
		jQuery.ajax({
			type:'POST',
			url:baseurl + '/ajax.php?do=customfield&act=update',
			data: {'name_vn':name_vn, 'value_vn':value_vn, 'name_en':name_en, 'value_en':value_en, 'id':id},
			success:function (data) {
				$('#ajaxloader'+id).css('display', 'none');
			}
		});
	}
	return false;
}
// xoa custom field
function deleteField(id, proid)
{
	$('#ajaxloader'+id).css('display', 'block');
	jQuery.ajax({
		type:'POST',
		url:baseurl + '/ajax.php?do=customfield&act=delete',
		data: {'id':id, 'proid':proid},
		success:function (data) {
			$('#ajaxloader'+id).css('display', 'none');
			$('#tableField #row'+id).html('');
		}
	});
}
// dien du lieu cua custom field co san vao trong khung nhap du lieu khi nguoi dung chon
function fillValue(name)
{
	$('.ajaxloader').css('display', 'block');
	jQuery.ajax({
		type:'POST',
		url:baseurl + '/ajax.php?do=customfield&act=fill',
		data: {'name':name},
		success:function (data) {
			$('.ajaxloader').css('display', 'none');
			var myObject = eval('(' + data + ')');
			$('#cname_vn').val(myObject['name_vn']);
			$('#cvalue_vn').val(myObject['value_vn']);
			$('#cname_en').val(myObject['name_en']);
			$('#cvalue_en').val(myObject['value_en']);
			$('#alias_custom').val(myObject['alias']);
		}
	});
}
// xoa module keo tha salepage
function deleteModule(id)
{
	jQuery.ajax({
		type:'POST',
		url:baseurl + '/ajax.php?do=salepage&act=delete',
		data: {'id':id},
		success:function (data) {
			$('#sortable #row'+id).html('');
		}
	});
}

function LayMa(tag){

	var uni_tag = StripTag_ad(tag).toLowerCase();
	return uni_tag;
}

function StripTag_ad(str) {
	  str= str.toLowerCase();
	  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
	  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
	  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
	  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
	  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
	  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
	  str= str.replace(/đ/g,"d");
	  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");
	/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
	  str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
		str= str.replace(/-+,/g,",");
		str= str.replace(/,+-/g,",");
	  str= str.replace(/^\-+|\-+$/g,"");
		//cắt bỏ ký tự - ở đầu và cuối chuỗi
	  return str;
} 