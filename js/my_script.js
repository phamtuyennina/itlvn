jQuery.fn.mousehold = function(timeout, f) {
	if (timeout && typeof timeout == 'function') {
		f = timeout;
		timeout = 100;
	}
	if (f && typeof f == 'function') {
		var timer = 0;
		var fireStep = 0;
		return this.each(function() {
			jQuery(this).mousedown(function() {
				fireStep = 1;
				var ctr = 0;
				var t = this;
				timer = setInterval(function() {
					ctr++;
					f.call(t, ctr);
					fireStep = 2;
				}, timeout);
			})

			clearMousehold = function() {
				clearInterval(timer);
				if (fireStep == 1) f.call(this, 1);
				fireStep = 0;
			}
			
			jQuery(this).mouseout(clearMousehold);
			jQuery(this).mouseup(clearMousehold);
		})
	}
}
function controlProductQty(){
	
	
	$("button.add-cart").unbind("click");
	$("button.add-cart").click(function(){
		p = $(this).parents(".product-qty");
		return false;	
	})
	
	$(".product-qty .controls button").unbind("mousehold");
	$(".product-qty .controls button").mousehold(function(){
		a = $(this);
		c = $(this).parent().find("input");
		v = parseInt(c.val());
		
		if(a.hasClass("is-up")){
			v++;
		}else{
		v--;
		}
		if(v <1 ){
			v=1;
		}
		
		c.val(v);
		
	})
}
$(document).ready(function() {
	controlProductQty();
   setTimeout(function(){
	   $("#pre-loader").fadeOut(1000);
   },400);
	
   $('body').append('<div id="toptop" title="Lên đầu trang">Back to Top</div>');
   $(window).scroll(function() {
		if($(window).scrollTop() != 0) {
			$('#toptop').fadeIn();
		} else {
			$('#toptop').fadeOut();
		}
   });
   
   $('#toptop').click(function() {
		$('html, body').animate({scrollTop:0},500);
   });
   

	
   $('#baophu, .close-popup').live('click',function(){
		$('#baophu, .login-popup').fadeOut(300, function(){
			$('#baophu').remove();
			$('.login-popup').remove();
		});			
	});
});
function isEmpty(str,text){
		if(str != "") return false;
		if(typeof(text) != 'undefined')	alert(text);		
		return true;
}
function isPhone(str,text){
	 if ((str.length == 11 && (str.substr(0, 2) == 01)) || (str.length == 11 && (str.substr(0, 2) == 02)) || (str.length == 10 && (str.substr(0, 2) == 09)) || (str.length == 10 && (str.substr(0, 2) == 08)) || (str.length == 10 && (str.substr(0, 2) == 07)) || (str.length == 10 && (str.substr(0, 2) == 03)) || (str.length == 10 && (str.substr(0, 2) == 05)))
		return false;
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isEmail(str, text){
	emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
	if(emailRegExp.test(str)){		
		return false;
	}
	if(typeof(text)!='undefined') alert(text);	
	return true;
}
function isSpace(str,text){
	for(var i=0; i < str.length; i++)
	{
		if((str.charAt(i)) == " ")
		{
			if(typeof(text)!='undefined') alert(text);
			return true;
			
		}
	}
	return false;
}
function isCharacters(str,text){ 
	if(str=='') return false;
	var searchReg = /^[a-zA-Z0-9-]+$/;
	if(searchReg.test(str)) {
		return false;
	}
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isRepassword(str,str2,text){
	if(str2=='') return false;
	if(str==str2) return false;
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function isCharacterlimit(str,text,intmin,intmax){
	if(str=='') return false;
	intmin = parseInt(intmin);
	intmax = parseInt(intmax);
	
	if(str.length>=intmin && str.length<=intmax)
	{
		return false;
	}
	if(typeof(text)!='undefined') alert(text);
	return true;
}
function add_popup(str){
	$('body').append('<div class="login-popup"><div class="close-popup"></div><div class="popup_thongbao"><p class="tieude_tb">Thông báo</p><p class="popup_kq">'+str+'</p></div></div>');
	$('.thongbao').html('');
	$('.login-popup').fadeIn(300);
	$('.login-popup').width($('.popup_thongbao').width()+'px')
	var chieurong = $('.login-popup').width() /2;
	$('.login-popup').css({width:$('.popup_thongbao').width()+'px','margin-left':-chieurong,top:-100+'px'});
	$('.login-popup').animate({top:100+'px'},500);
	$('body').append('<div id="baophu"></div>');
	$('#baophu').fadeIn(300);
	return false;
}

