

<h3>Upload file</h3>
<form name="frm" method="post" action="index.php?com=uploadfile&act=save" enctype="multipart/form-data" class="nhaplieu">
    
	<b>File upload:</b> <input type="file" name="file" /><br /><br /><strong><span style="color:red;">Hỗ trợ các đuôi file:</span> &nbsp;&nbsp;<?=_format_duoitatca?></strong><br /></span>
    
    <span style="color:red; font-size:13px; margin-top:10px; display:block;">*Chú ý: file sẽ được upload nằm ở thư mục gốc của website (cùng cấp với trang index.php)</span><br />

	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=uploadfile&act=capnhat'" class="btn" />
</form>