<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
	var tenct='<?=$company['ten']?>';
	var nhaptukhoatimkiem='<?=_nhaptukhoatimkiem?>...';
	var chuanhaptukhoa='<?=_chuanhaptukhoa?>';
	var nhapemailcuaban='<?=_nhapemailcuaban?>...';
	var nhapemail='<?=_nhapemail?>';
	var emailkhonghople='<?=_emailkhonghople?>';
	var nhaphoten='<?=_nhaphoten?>';
	var nhapdiachi='<?=_nhapdiachi?>';
	var nhapsodienthoai='<?=_nhapsodienthoai?>';
	var emailkhonghople='<?=_emailkhonghople?>';
	var nhapchude='<?=_nhapchude?>';
	var nhapnoidung='<?=_nhapnoidung?>';
	var sitekey='<?=$config['sitekey']?>';
</script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js" ></script>
<script type="text/javascript" src="js/my_script.js"></script>
<script type="text/javascript" src="js/giohang.js"></script>
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>
<?php if($source=='index'){?>
<script type="text/javascript" src="js/engine1/wowslider.js"></script>
<script type="text/javascript" src="js/engine1/script.js"></script>
<?php }?>
<script src="js/lazyload.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script src="magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$config['sitekey']?>"></script>
<script src="js/main.js" type="text/javascript" ></script>
<script type="application/ld+json">
{
"@context" : "http://schema.org",  
"@type" : "WebSite",  
"name" : "<?=$company['ten']?>",  
"url" : "http://<?=$config_url?>/", 
"potentialAction" : {    
"@type" : "SearchAction",    
"target" : "http://<?=$config_url?>/tiem-kiem&keyword={search_term}",    
"query-input" : "required name=search_term"  }            
}
}
</script>


<?php if($source='gio-hang'){ ?>
	<script type="text/javascript">
	 $(document).ready(function(e) {
		 <?php if($config['phi']==1){ ?>
		 $('#thanhpho').change(function(e) {
			 NProgress.start();
			 $.ajax({
				 url:"ajax/update-ship.html",
				 data:{id:$(this).val()},
				 type:"post",
				 dataType:"json",
				 success:function(data){
					 $(".total_cart_max .all-price .price").html(data.price);
					 $(".total_cart_max .all-ship .price").html(data.ship);
					 $(".total_cart_max .all-price-all .price").html(data.all);
					 NProgress.done();
				 }
			 })
		 });
		 <?php } elseif($config['phi']==2){?>
		 $('#quan').change(function(e) {
						 NProgress.start();
			 $.ajax({
				 url:"ajax/update-ship.html",
				 data:{id:$(this).val()},
				 type:"post",
				 dataType:"json",
				 success:function(data){
					 $(".total_cart_max .all-price .price").html(data.price);
					 $(".total_cart_max .all-ship .price").html(data.ship);
					 $(".total_cart_max .all-price-all .price").html(data.all);
					 NProgress.done();

				 }
			 })
				 });
		 <?php }?>
		 });

	function validEmail(obj) {
	 var s = obj.value;
	 for (var i=0; i<s.length; i++)
		 if (s.charAt(i)==" "){
			 return false;
		 }
	 var elem, elem1;
	 elem=s.split("@");
	 if (elem.length!=2)	return false;
	 if (elem[0].length==0 || elem[1].length==0)return false;
	 if (elem[1].indexOf(".")==-1)	return false;
	 elem1=elem[1].split(".");
	 for (var i=0; i<elem1.length; i++)
		 if (elem1[i].length==0)return false;
	 return true;
	}//Kiem tra dang email
	function IsNumeric(sText)
	{
	 var ValidChars = "0123456789";
	 var IsNumber=true;
	 var Char;
	 for (i = 0; i < sText.length && IsNumber == true; i++)
	 {
		 Char = sText.charAt(i);
		 if (ValidChars.indexOf(Char) == -1)
		 {
			 IsNumber = false;
		 }
	 }
	 return IsNumber;
	}//Kiem tra dang so

	function check()
		 {
			 var frm = document.frm_order;
			 if(frm.hoten.value=='')
			 {
				 alert( "<?=_nhaphoten?>." );
				 frm.hoten.focus();
				 return false;
			 }
			 if(frm.dienthoai.value=='')
			 {
				 alert( "<?=_nhapsodienthoai?>." );
				 frm.dienthoai.focus();
				 return false;
			 }

			 sodienthoai = frm.dienthoai.value.length;

			 if((sodienthoai==11 && (frm.dienthoai.value.substr(0,2)==01)) || (sodienthoai==10 && (frm.dienthoai.value.substr(0,2)==09)))
			 {

			 }
			 else
			 {
				 alert("<?=_nhapsodienthoai?>" );
					 frm.dienthoai.focus();
					 return false;
			 }

			 if(frm.thanhpho.value=='')
			 {
				 alert( "<?=_chonthanhpho?>." );
				 frm.thanhpho.focus();
				 return false;
			 }

			 if(frm.quan.value=='')
			 {
				 alert( "<?=_chonquanhuyen?>." );
				 frm.quan.focus();
				 return false;
			 }

			 if(frm.diachi.value=='')
			 {
				 alert( "<?=_nhapdiachi?>." );
				 frm.diachi.focus();
				 return false;
			 }
			 if(isEmpty($('#email').val(), "<?=_emailkhonghople?>"))
			 {
				 $('#email').focus();
				 return false;
			 }
			 if(isEmail($('#email').val(), "<?=_emailkhonghople?>"))
			 {
				 $('#email').focus();
				 return false;
			 }
			 frm.submit();
		 }
	</script>
<?php }?>
