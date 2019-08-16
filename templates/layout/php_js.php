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
	var luachondichvu='<?=_luachondichvu?>';
	var vuilongdienfull='<?=_vuilongdienfull?>';
	var sitekey='<?=$config['sitekey']?>';
</script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js" ></script>
<script type="text/javascript" src="js/my_script.js"></script>
<script type="text/javascript" src="js/jquery.mmenu.min.all.js"></script>
<?php if($source=='index'){?>
<script type="text/javascript" src="js/engine1/wowslider.js"></script>
<script type="text/javascript" src="js/engine1/script.js"></script>
<?php }?>
<script src="js/lazyload.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$config['sitekey']?>"></script>
<script src="js/main.js" type="text/javascript" ></script>
<script type="text/javascript">
if($('#recaptcha_response').length){
	grecaptcha.ready(function () {
	    grecaptcha.execute(sitekey, { action: 'contact' }).then(function (token) {
	        var recaptchaResponse = document.getElementById('recaptchaResponse');
	        recaptchaResponse.value = token;
	    });
	});
}
if($('#recaptcha_yeucaudichvu').length){
	grecaptcha.ready(function () {
	    grecaptcha.execute(sitekey, { action: 'yeucaudichvu' }).then(function (token) {
	        var recaptchaResponse = document.getElementById('recaptcha_yeucaudichvu');
	        recaptchaResponse.value = token;
	    });
	});
}	
</script>

