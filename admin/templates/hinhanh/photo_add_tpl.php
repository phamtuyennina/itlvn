
<h3>Thêm hình ảnh</h3>

<form name="frm" method="post" action="index.php?com=hinhanh&act=save_photo&id_hinhanh=<?=$_REQUEST['id_hinhanh']?>&type=<?=$_REQUEST['type']?>" enctype="multipart/form-data" class="nhaplieu">		
  <?php for($i=0; $i<3; $i++){?>
	
	<b>Hình ảnh <?=$i+1?></b> <input type="file" name="file<?=$i?>" /><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Width:650px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Height:450px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=_format_duoihinh_l?></strong><br />	 <br />	       	
    
    <b>Tên (Việt Nam)</b> <input type="text" name="ten<?=$i?>" value="" class="input" /><br /><br />
    
    <b>Tên (English)</b> <input type="text" name="tenen<?=$i?>" value="" class="input" /><br /><br />		 
    
    <b><label>Số thứ tự &nbsp;<input type="text" name="stt<?=$i?>" value="1" style="width:30px"></label></b>
	
    <b class="none"><label>Nỗi bật <input type="checkbox" name="noibat<?=$i?>" ></label></b> 
        
	<b><label>Hiển thị <input type="checkbox" name="hienthi<?=$i?>" checked="checked" ></label></b><br /><br /><br /><hr />
<? }?>
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=hinhanh&act=man_photo'" class="btn" />
</form>