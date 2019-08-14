<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=com&act=man"><span>Liên kết website</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=com&act=save" method="post" enctype="multipart/form-data">
	

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		



		<ul class="tabs">
           
           <li>
               <a href="#info">Thông tin chung</a>
           </li>
          
       </ul>

       <!-- begin: info -->
       <div id="info" class="tab_content">
       		
	        <div class="formRow">
				<label>Tên</label>
				<div class="formRight">
	                <input type="text" name="ten" title="Nhập tên" id="link" class="tipS" value="<?=@$item['ten']?>" />
				</div>
				<div class="clear"></div>
			</div>
            
            <div class="formRow">
				<label>Com</label>
				<div class="formRight">
	                <input type="text" name="ten_com" title="Nhập com" class="tipS" value="<?=@$item['com']?>" />
				</div>
				<div class="clear"></div>
			</div>
            
            <div class="formRow">
				<label>Act</label>
				<div class="formRight">
	                <input type="text" name="ten_act" title="Nhập act" id="act" class="tipS " value="<?=@$item['act']?>" />
				</div>
				<div class="clear"></div>
			</div>
            
            <div class="formRow">
				<label>Type</label>
				<div class="formRight">
	                <input type="text" name="type" title="Nhập type" id="link" class="tipS " value="<?=@$item['type']?>" />
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

		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

