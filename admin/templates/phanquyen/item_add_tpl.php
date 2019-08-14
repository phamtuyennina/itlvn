<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	   <li><a href="index.php?com=phanquyen&act=man"><span>Liên kết website</span></a></li>
               <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=phanquyen&act=save" method="post" enctype="multipart/form-data">
	

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
	                <input type="text" name="ten" title="Nhập ten" id="ten" class="tipS" value="<?=@$item['ten']?>" />
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
	
</form>
</div>


<script type="text/javascript">
	$(document).ready(function(e) {
        $('.tr_pquyen label input[name="all"]').click(function(){
			if($(this).is(':checked')){
				$(this).parents('.tr_pquyen').find('input[type="checkbox"]').prop('checked', true);
				$(this).parents('.tr_pquyen').find('.checker span').addClass('checked');
			}
			else
			{
				$(this).parents('.tr_pquyen').find('input[type="checkbox"]').prop('checked', false);
				$(this).parents('.tr_pquyen').find('.checker span').removeClass('checked');
			}
		});
		
		$('button.add-permission').click(function(){
			var root = $(this).parents('.tr_pquyen');
			
			var com = root.find('input[name="man"]').data('com');
			var type = root.find('input[name="man"]').data('type');
			var act_cap = root.find('input[name="man"]').data('act_cap');
			var man = '';
			
			var add = '';
			var edit = '';
			var delete2 = '';			
			
			if(root.find('input[name="man"]').prop('checked')){
				man = root.find('input[name="man"]').data('act');
			}
			if(root.find('input[name="add"]').prop('checked')){
				add = root.find('input[name="add"]').data('act');
			}
			if(root.find('input[name="edit"]').prop('checked')){
				edit = root.find('input[name="edit"]').data('act');
			}
			if(root.find('input[name="delete"]').prop('checked')){
				delete2 = root.find('input[name="delete"]').data('act');
			}

			$.ajax({
				url:'ajax_phanquyen.php',
				type:'post',
				dataType:'json',
				data:{id:'<?=$_GET['id']?>',com:com,type:type,man:man,add:add,edit:edit,delete2:delete2,act_cap:act_cap},
				success:function(kq){
					if(kq.thongbao==1)
					{
						alert('Xác nhận thành công');
					}
				}
			});
			
		});
    });
</script>
<div class="wrapper">
<div id="permission-draw"><div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable phanquyen" id="checkAll">
		<tr>
        	<th style="width:30px;">STT</th>
			<th>Chức năng quản trị</th>
			<th>Xem</th>
			<th>Thêm</th>
			<th>Sửa</th>
			<th>Xóa</th>
            <th>Tất cả</th>
			<th>Xác nhận</th>
		</tr>
        
        <?php for($i = 0; $i < count($item_com); $i++) { ?>
        <?php
			if($item_com[$i]['act']!='man' and $item_com[$i]['act']!='capnhat')
			{
				$data_act_man = $item_com[$i]['act'];
				$data_act_add = str_replace("man","add",$item_com[$i]['act']);
				$data_act_edit = str_replace("man","edit",$item_com[$i]['act']);
				$data_act_delete = str_replace("man","delete",$item_com[$i]['act']);
				$act_cap = str_replace("man","man",$item_com[$i]['act']);
			} 
			else if($item_com[$i]['act']=='capnhat')
			{
				$data_act_man = 'capnhat';
				$data_act_add = 'add';
				$data_act_edit = 'edit';
				$data_act_delete = 'delete';
				$act_cap = '';
			}
			else
			{
				$data_act_man = $item_com[$i]['act'];
				$data_act_add = str_replace("man","add",$item_com[$i]['act']);
				$data_act_edit = str_replace("man","edit",$item_com[$i]['act']);
				$data_act_delete = str_replace("man","delete",$item_com[$i]['act']);
				$act_cap = '';
			}
			$d->reset();
			$sql = "select act from #_com_quyen where id_quyen='".$_GET['id']."' and com='".$item_com[$i]['com']."' and act_cap='".$act_cap."' and type='".$item_com[$i]['type']."' limit 0,1";
			$d->query($sql);
			$check_quyen = $d->fetch_array();
			
			//dump($sql);			
		?>
        <tr class="tr_pquyen">
        	<td style="text-align:center;"><?=$i+1?></td>
            <td class="title_name_data"><?=$item_com[$i]['ten']?></td>
            <td><label><input name="man" type="checkbox" data-act="<?=$data_act_man?>" data-com="<?=$item_com[$i]['com']?>" data-type="<?=$item_com[$i]['type']?>" data-act_cap="<?=$act_cap?>" <?php if(in_array($data_act_man, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>
            <td><label><input name="add" type="checkbox" data-act="<?=$data_act_add?>" <?php if(in_array($data_act_add, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>
            <td><label><input name="edit" type="checkbox"  data-act="<?=$data_act_edit?>" <?php if(in_array($data_act_edit, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>
            <td><label><input name="delete" type="checkbox"  data-act="<?=$data_act_delete?>"<?php if(in_array($data_act_delete, explode(',',$check_quyen['act'])))echo 'checked="checked"' ?>></label></td>
            <td><label><input name="all" type="checkbox"></label></td>
            <td style="text-align:center;"><button class="button blueB add-permission"><i class="glyphicon glyphicon-upload"></i>Xác nhận</button></td>
         </tr>  
        <?php } ?>  
	</table>
</div>
<style>
#table-per input[type=checkbox]{
	position: relative; 
	top: 3px;
	margin-right: 10px;
}
</style>
</div>
</div>

