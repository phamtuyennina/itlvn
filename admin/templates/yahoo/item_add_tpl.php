<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=yahoo&act=man"><span>Hỗ trợ trực tuyến</span></a></li>
                        <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=yahoo&act=save<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
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


       <!-- begin: info -->
       <div id="info" class="tab_content">

	        <div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
	                <input type="text" name="dienthoai" title="Nhập số điện thoại" id="dienthoai" class="tipS validate[required]" value="<?=@$item['dienthoai']?>" />
				</div>
				<div class="clear"></div>
			</div>
	        <div class="formRow">
				<label>Email</label>
				<div class="formRight">
	                <input type="text" name="email" title="Nhập địa chỉ email" id="email" class="tipS validate[required]" value="<?=@$item['email']?>" />
				</div>
				<div class="clear"></div>
			</div>
	        <div class="formRow">
				<label>Yahoo</label>
				<div class="formRight">
	                <input type="text" name="yahoo" title="Nhập nick chat yahoo" id="yahoo" class="tipS validate[required]" value="<?=@$item['yahoo']?>" />
				</div>
				<div class="clear"></div>
			</div>
	        <div class="formRow">
				<label>Skype</label>
				<div class="formRight">
	                <input type="text" name="skype" title="Nhập nick chat skype" id="skype" class="tipS validate[required]" value="<?=@$item['skype']?>" />
				</div>
				<div class="clear"></div>
			</div>
			     
	        
			
	        <div class="formRow">
	          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
	          <div class="formRight">
	           
	            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
	            <label for="check1">Hiển thị</label>            
	          </div>
	          <div class="clear"></div>
	        </div>
	        <div class="formRow">
	            <label>Số thứ tự: </label>
	            <div class="formRight">
	                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
	            </div>
	            <div class="clear"></div>
	        </div>
       </div>
        <!-- end: info -->


		<?php foreach ($config['lang'] as $key => $value) {
        ?>

        <!-- begin: Content -->
       <div id="content_lang_<?=$key?>" class="tab_content">  
       		<div class="formRow">
	            <label>Tên</label>
	            <div class="formRight">
	                <input type="text" name="ten<?=$key?>" title="Nhập tên " id="ten<?=$key?>" class="tipS" value="<?=@$item['ten'.$key]?>" />
	            </div>
	            <div class="clear"></div>
	        </div>  
       </div>
       <!-- end: Content -->

       <?php } ?>
		
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
                <a href="index.php?com=yahoo&act=man<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

