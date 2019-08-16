<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=slider&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Hình ảnh</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=slider&act=save_photo&id_slider=<?=$_REQUEST['id_slider']?>&type=<?=$_REQUEST['type']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" method="post" enctype="multipart/form-data">
	
    <div class="widget">
         <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6>Thêm Hình Ảnh</h6>
        </div>
       <ul class="tabs">
           
           <li>
               <a href="#info">Thông tin chung</a>
           </li>
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>


       </ul>
 	
       <div id="info" class="tab_content">
           <?php for($i=0; $i<3; $i++){?>
          <div class="formRow <?php if($_REQUEST['type']=='brochure'){ecjo 'none';} ?>">
            <label>Link liên kết:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="link<?=$i?>" value=""  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
		<div class="formRow">
			<label>Upload <?=$i+1?>:</label>
			<div class="formRight">
            					<input type="file" id="file" name="file<?=$i?>" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                <div class="note">  <?php if($_REQUEST['type']=='slider')echo 'Width:1000px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Height:400px '; ?>   
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php 
                    $a=$_REQUEST['type'];
                    if($a!='brochure'){$b=_format_duoihinh_l;}else{$b=_format_duoitailieu;}
                ?>
                 <?=$b?> </div>
			</div>
			<div class="clear"></div>
		</div>
        
        <?php if($_REQUEST['type']=='letruot') { ?> 
        <div class="formRow">           
            <label>Vị trí: </label>      
            <div class="formRight">          
                <select id="vitri" name="vitri<?=$i?>" class="main_select">
                	<option value="left" <?php if($item['vitri']=='left') echo 'selected="selected"' ?>>Bên trái</option>			
                	<option value="right" <?php if($item['vitri']=='right') echo 'selected="selected"' ?>>Bên phải</option>	
                </select>
            <br />
            </div>
            
            <div class="clear"></div>
		</div>
        <?php } ?>
        
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">           
            <input type="checkbox" name="hienthi<?=$i?>" id="check1" value="1" checked="checked" />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="1" name="stt<?=$i?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
                
        
<?php }?>
       </div>
       
       <!-- End info -->
       
       
		<?php foreach ($config['lang'] as $key => $value) {
        ?>
        
        <div id="content_lang_<?=$key?>" class="tab_content">     
         <?php for($i=0; $i<3; $i++){?>
            <div class="formRow">   
            <label>Tên hình ảnh <?=$i+1?>:</label>
            <div class="formRight">
                <input type="text" name="ten<?=$key?><?=$i?>" title="Nhập tên hình ảnh <?=$i+1?>" id="ten<?=$key?><?=$i?>" class="tipS" value="" />
            </div>
            <div class="clear"></div>
            </div>
        <?php }?>
        </div><!-- End content <?=$key?> -->
        
        <?php } ?>


	<div class="formRow">
			<div class="formRight">
            	<input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>	
	</div>
   
	
</form>   
