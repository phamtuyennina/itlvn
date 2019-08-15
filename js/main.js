$(document).ready(function(e) {$('img').each(function(index, element) {if(!$(this).attr('alt') || $(this).attr('alt')==''){$(this).attr('alt',tenct);}});});
function doEnter(evt){var key;if(evt.keyCode == 13 || evt.which == 13){onSearch(evt);}}
function onSearch(evt) {var keyword = document.getElementById("keyword").value;if(keyword=='' || keyword==nhaptukhoatimkiem){alert(chuanhaptukhoa);}else{location.href = "tim-kiem.html&keyword="+keyword;loadPage(document.location);}}
function doEnter2(evt){var key;if(evt.keyCode == 13 || evt.which == 13){onSearch2(evt);}}
function onSearch2(evt) {var keyword2 = document.getElementById("keyword2").value;if(keyword2=='' || keyword2==nhaptukhoatimkiem){alert(chuanhaptukhoa);}else{location.href = "tim-kiem.html&keyword="+keyword2;loadPage(document.location);}}$(document).ready(function() { $("#menu ul li").hover(function(){$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(300); },function(){ $(this).find('ul:first').css({visibility: "hidden"});}); $("#menu ul li").hover(function(){$(this).find('>a').addClass('active2'); },function(){ $(this).find('>a').removeClass('active2'); }); });
$(function() {$('.hien_menu').click(function(){$('nav#menu_mobi').css({height: "auto"});});$('nav#menu_mobi').mmenu({extensions: [ 'effect-slide-menu', 'pageshadow' ],searchfield: true,counters : true,navbar : {title: 'Menu'},navbars: [{position: 'top',content: [ 'searchfield' ]}, {position : 'top',content : ['prev','title','close']}]});});
$('.click_ajax').click(function(){if(isEmpty($('#ten_lienhe').val(), nhaphoten )){$('#ten_lienhe').focus();return false;}if(isEmpty($('#diachi_lienhe').val(), nhapdiachi)){$('#diachi_lienhe').focus();return false;}if(isEmpty($('#dienthoai_lienhe').val(), nhapsodienthoai)){$('#dienthoai_lienhe').focus();return false;}if(isPhone($('#dienthoai_lienhe').val(), nhapsodienthoai)){$('#dienthoai_lienhe').focus();return false;}if(isEmpty($('#email_lienhe').val(), emailkhonghople)){$('#email_lienhe').focus();return false;}if(isEmail($('#email_lienhe').val(), emailkhonghople)){$('#email_lienhe').focus();return false;}if(isEmpty($('#tieude_lienhe').val(), nhapchude)){$('#tieude_lienhe').focus();return false;}if(isEmpty($('#noidung_lienhe').val(), nhapnoidung)){$('#noidung_lienhe').focus();return false;}document.frm.submit();});
function loadScripts(t, e, i) {
    for (var n = 0, s = 0; s < t.length; s++) {
        var a, o, r = t[s];
        i && (r += "?v=" + i), (a = document.createElement("script")).type = "text/javascript", a.src = r, a.onload = a.onreadystatechange = function() {
            this.readyState && "complete" != this.readyState || ++n == t.length && e()
        }, (o = document.getElementsByTagName("script")[0]).parentNode.insertBefore(a, o)
    }
}
$(document).ready(function(){
 $('.slick2').slick({
     slidesToShow: 1,
     slidesToScroll: 1,
     arrows: false,
     fade: true,
     autoplay:false,
     autoplaySpeed:5000,
     asNavFor: '.slick',
     adaptiveHeight: true
 });
 $('.slick').slick({
     slidesToShow: 4,
     slidesToScroll: 1,
     asNavFor: '.slick2',
     dots: false,
     centerMode: false,
     focusOnSelect: true
 });
  return false;
 });
$(document).ready(function(){
 $('#content_tabs .tab').hide();
 $('#content_tabs .tab:first').show();
 $('#ultabs li:first').addClass('active');

 $('#ultabs li').click(function(){
   var vitri = $(this).data('vitri');
   $('#ultabs li').removeClass('active');
   $(this).addClass('active');

   $('#content_tabs .tab').hide();
   $('#content_tabs .tab:eq("'+vitri+'")').show();
   return false;
 });
});
var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
});
$(document).on('click','.show_ajax li a',function(){
  vitri=$(this).attr('vitri');
  type=$(this).parents('.show_ajax').data('type');
  $root=$(this).parents('.show_ajax');
  if(vitri!='noactive'){
    loadtrang(vitri,type,$root);
    $('html, body').animate({scrollTop:$($root).parents('.wap_banchay').offset().top},500);
  }
}); 
var fired = false;
window.addEventListener("scroll", function(){
  if ((document.documentElement.scrollTop != 0 && fired === false) || (document.body.scrollTop != 0 && fired === false)) {
    $('.show_ajax').each(function(index, el) {
      loadtrang(0,$(this).data('type'),$(this));
    });
    if(!$('#video').hasClass('load_video'))
    {
      $('#video').addClass('load_video');
      $('.load_video').load( "ajax/video.php");
    }
    fired = true;
  }
}, true);

function loadtrang(vitri,type,$root){
  $.ajax({
    url:'ajax/loadsanpham.php',
    data:{vitri:vitri,type:type},
    type:'POST',
    async:true,
    success: function(res){           
      $($root).html(res);
      lazyLoadInstance.update();
    }         
  });       
}    
$(document).ready(function() {
  $('.collapse-toggle').click(function(e) {
        e.preventDefault();
        if (!$(this).closest('.collapse-toggle-nav').hasClass('show-collapse')) {
            $('.collapse-div').slideUp("slow");
            $('.collapse-toggle-nav').removeClass('show-collapse');
            $(this).closest('.collapse-toggle-nav').addClass('show-collapse');
            $(this).closest('.collapse-toggle-nav').find('.collapse-div').slideDown("slow");
        } else {
            $(this).closest('.collapse-toggle-nav').removeClass('show-collapse');
            $(this).closest('.collapse-toggle-nav').find('.collapse-div').slideUp("slow");
        }
    });
    
  if($('#recaptcha_response').length){
     grecaptcha.ready(function () {
        grecaptcha.execute(sitekey, { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
  }
  
  $('.slick_tintuc').slick({
      lazyLoad: 'ondemand',
      infinite: true,
      accessibility:true,
      vertical:true,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay:true,
      autoplaySpeed:3000,
      arrows:true,
      centerMode:false,
      dots:false,
      draggable:true,
      mobileFirst:true
  });
  $('.sponsor-news-inner').slick({
      autoplay: true,
      autoplaySpeed: 10000,
      dots: false,
      arrows: false,
      infinite: true,
      fade: true,
      cssEase: 'linear'
  });
  $('.slick_hinhanh').slick({
      lazyLoad: 'ondemand',
      infinite: true,
      accessibility:true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay:true,
      autoplaySpeed:3000,
      arrows:true,
      centerMode:false,
      dots:false,
      draggable:true,
      mobileFirst:true
  });
  $('.slick_news-content').slick({
      lazyLoad: 'ondemand',
      infinite: true,
      accessibility:true,
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay:true,
      autoplaySpeed:3000,
      arrows:true,
      centerMode:false,
      dots:false,
      draggable:true,
      mobileFirst:true
  });
  

});