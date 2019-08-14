

<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
<div class="box_container">
   <div class="content">
   		<div class="tt_lh">
        <?=$company_contact['noidung'];?>
		<div class="frm_lienhe">
        	<form method="post" name="frm" class="frm" action="lien-he.html" enctype="multipart/form-data">
            	<div class="loicapcha thongbao"></div>
            	<div class="item_lienhe"><p><?=_hovaten?>:<span>*</span></p><input name="ten_lienhe" type="text" id="ten_lienhe" /></div>

                <div class="item_lienhe"><p><?=_diachi?>:<span>*</span></p><input name="diachi_lienhe" type="text" id="diachi_lienhe" /></div>

                <div class="item_lienhe"><p><?=_dienthoai?>:<span>*</span></p><input name="dienthoai_lienhe" type="text" id="dienthoai_lienhe" /></div>

                <div class="item_lienhe"><p>Email:<span>*</span></p><input name="email_lienhe" type="text" id="email_lienhe" /></div>

                <div class="item_lienhe"><p><?=_chude?>:<span>*</span></p><input name="tieude_lienhe" type="text" id="tieude_lienhe" /></div>

                <div class="item_lienhe"><p><?=_noidung?>:<span>*</span></p><textarea name="noidung_lienhe" id="noidung_lienhe" rows="5"></textarea></div>

                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

                <div class="item_lienhe" >
                	<p>&nbsp;</p>
                	<input type="button" value="<?=_gui?>" class="click_ajax" />
                    <input type="button" value="<?=_nhaplai?>" onclick="document.frm.reset();" />
                </div>
            </form>
        </div><!--.frm_lienhe-->
        </div>

        <div class="bando">

           <div id="map_canvas"><?=$company['googlemap']?></div> 
        </div><!--.bando-->
        <div class="clear"></div>
   </div><!--.content-->
</div><!--.box_container-->
