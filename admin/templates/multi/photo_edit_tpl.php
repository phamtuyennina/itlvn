<h3>Cập nhật hình ảnh</h3>

<form name="frm" method="post" action="index.php?com=multi&act=save_photo&id=<?=$_REQUEST['id'];?><?php if($_REQUEST['id_multi']!='') echo'&id_multi='. $_REQUEST['id_multi'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" enctype="multipart/form-data" class="nhaplieu">
    <b>Hình hiện tại:</b><img src="<?=_upload_hinhthem.$item['photo']?>" height="100px" /><br />
    
	<b>Hình ảnh </b> <input type="file" name="file" /> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Width:650px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Height:450px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=_format_duoihinh_l?></strong><br /><br />
    
    <b>Tên + Alt hình ảnh</b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /><br />	
       
	<b><label>Số thứ tự &nbsp;<input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></label></b>
	
    <b class="none"><label>Nỗi bật <input type="checkbox" name="noibat" <?=($item['noibat']==1)?'checked="checked"':''?>></label></b> 
        
	<b><label>Hiển thị <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></label></b><br />
	
	<input type="hidden" name="id" value="<?=$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=multi&act=man_photo'" class="btn" />
</form>