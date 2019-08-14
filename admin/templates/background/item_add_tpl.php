<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=slider&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Hình ảnh</span></a></li>
                        <li class="current"><a href="#" onclick="return false;">Sửa hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=background&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Sửa hình ảnh</h6>
		</div>		
        <?php
			if($_REQUEST['type']!='banner')
				$config['lang'] = array(''=>'Tiếng Việt');	
		?>
        <ul class="tabs">
        	<?php foreach ($config['lang'] as $key => $value) { ?>
           		<li><a href="#content_lang_<?=$key?>"><?=$value?></a></li>
           <?php } ?>
       </ul>

		<?php foreach ($config['lang'] as $key => $value) {?>
        <div id="content_lang_<?=$key?>" class="tab_content">	
             <div class="formRow">           
                <label>Hình ảnh hiện tại: </label>      
                <div class="formRight">          
                <img src="<?=_upload_hinhanh.$item['photo'.$key]?>"  alt="NO PHOTO" style="max-width:100%; max-height:200px;" />
                <br />
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="formRow">
                <label>Upload hình ảnh:</label>
                <div class="formRight">
                    <input type="file" id="file" name="file<?=$key?>" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                    <?php if($_REQUEST['type']=='banner') { ?><span class="size_img">Chiều rộng <b>1000px</b> Chiều cao: <b>150px</b></span><?php } ?>
                    <?php if($_REQUEST['type']=='pupop') { ?><span class="size_img">Chiều rộng <b>800px</b> Chiều cao: <b>auto</b></span><?php } ?>
                </div>
                <div class="clear"></div>
             </div> 
        </div><!-- End content <?=$key?> -->
        <?php } ?>
        <?php if($_REQUEST['type']!='banner' && $_REQUEST['type']!='logo' && $_REQUEST['type']!='khu-vuc' && $_REQUEST['type']!='condau') { ?>
        <div class="formRow">
            <label>Link liên kết: </label>
            <div class="formRight">
                <input type="text" id="price" name="link" value="<?=@$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
        <?php }?>
        <?php if($_REQUEST['type']!='khu-vuc'){ ?>
        <div class="formRow">
              <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
              <div class="formRight">           
                <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                <label for="check1">Hiển thị</label>           
              </div>
              <div class="clear"></div>
        </div>
        <?php }?>

			<div class="formRow">
			<div class="formRight">
            <input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>     
		
	</div>
   
</form>   
