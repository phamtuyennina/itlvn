<link href="media/multi_upload/uploadfilemulti.css" rel="stylesheet">
<script src="media/multi_upload/jquery-1.8.0.min.js"></script>
<script src="media/multi_upload/jquery.fileuploadmulti.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var settings = {
			url: "upload.php",
			method: "POST",
			allowedTypes:"jpg,png,gif",
			fileName: "myfile",
			multiple: true,
			onSuccess:function(files,data,xhr)
			{
				$("#status").html("<font color='green'>Upload thành công</font>");		
			},
			afterUploadAll:function()
			{
				alert("Tất cả các file đã được upload");
			},
			onError: function(files,status,errMsg)
			{		
				$("#status").html("<font color='red'>Upload lỗi</font>");
			}
		}
		$("#mulitplefileuploader").uploadFile(settings);	
	});
</script>

<h3>Upload file</h3>
<form name="frm" method="post" action="index.php?com=multi_upload&act=save" enctype="multipart/form-data" class="nhaplieu">
    
    <strong>&nbsp;&nbsp;<?=_format_duoihinh_l?></strong>
	<div id="mulitplefileuploader">Chọn File</div>
    <span style="color:red; font-size:13px; margin-top:10px; display:block;">*Chú ý: file sẽ được upload nằm ở thư mục upload của website (cùng cấp với trang index.php)</span><br />
	<div id="status"></div>
	
</form>