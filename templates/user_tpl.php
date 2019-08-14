<script type="text/javascript">
	$(document).ready(function(){
		$("#reset_capcha").click(function() {
			$("#hinh_captcha").attr("src", "sources/captcha.php?"+Math.random());
			return false;
		});    
		
	});
</script>

<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
<div class="box_container">
   <div class="content">
         <div class="frm_lienhe">
        	<form method="post" name="frm" action="">
            	
                <div class="item_lienhe"><p><?=_tendangnhap?>:<span>*</span></p><input name="username" type="text" id="username" /></div>
                    
                <div class="item_lienhe"><p><?=_matkhau?>:<span>*</span></p><input name="password" type="password" id="password" /></div>
                
                <div class="item_lienhe"><p class="baove"><?=_mabaove?>:<span>*</span></p>
                    <img src="sources/captcha.php" id="hinh_captcha" style="float:left;">
                            <a href="#reset_capcha" id="reset_capcha" title="<?=_doimakhac?>"><img src="images/refresh.png" alt="reset_capcha" /></a><input style="width:100px;" name="capcha" type="text" id="capcha" /></div>
                            
                <div class="item_lienhe">
                        <input type="submit" value="<?=_dangky?>" class="click_ajax" />
                        <input type="button" value="<?=_nhaplai?>" onclick="document.frm.reset();" />
                    </div>
               </form>
            </div>          
   </div>
</div>