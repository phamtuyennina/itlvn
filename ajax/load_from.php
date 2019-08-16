<?php 

	include ("ajax_config.php");
	
	$d->reset();
	$sql = "select *,ten$lang as ten from #_news where id=".$_POST['id']."";
	$d->query($sql);
	$dulieu = $d->fetch_array();
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel"><?=$dulieu['ten']?></h4>
</div>
<div class="modal-body">
  <form action="index.php" method="post"  id="apply_cv" enctype="multipart/form-data" >
        <div class="wrap-form apply-form">
            <div class="row form-group">
                <label class="col-sm-4 control-label"><?=_tencuaban?></label>
                <div class="col-sm-8">
                    <input name="name" class="form-control" type="text">
                </div>
           	</div>
            <div class="row form-group">
                <label class="col-sm-4 control-label"><?=_gioitinhcuaban?></label>
                <div class="col-sm-8">
                    <div class="radio-row">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" checked value="Nữ" name="gender">
                                <span><?=_nu?></span>
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" value="Nam" name="gender">
                                <span><?=_nam1?></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-4 control-label"><?=_emailcuaban?></label>
                <div class="col-sm-8">
                    <input name="email" class="form-control" type="text">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-4 control-label"><?=_dienthoaicuaban?></label>
                <div class="col-sm-8">
                    <input name="phone" class="form-control"  type="text">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-4 control-label"><?=_ngaysinh?></label>
                <div class="col-sm-8">
                    <input name="birthday" class="form-control"  type="date">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-4 control-label"><?=_motabanthan?></label>
                <div class="col-sm-8">
                    <textarea name="message" class="form-control" rows="5"></textarea>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-4">
                    <label class="control-label">
                        <?=_tailenCV?></label>
                </div>
                <div class="col-sm-8">
                    <div class="upload-field-wrap">
                        <div class="upload-field">
                            <div style="cursor: pointer;" class="fake-field">
                                <span><?=_tailen?></span>
                            </div>
                            <input id="file_apply_cv" class="form-control real-field" name="file_cv" type="file">
                        </div>
                        <p class="note-label">
                            (File type: .doc, docx, pdf, ppt, pptx, rar, zip, 7z Max size: 5MB)
                        </p>
                    </div>
                    <p id="fake_cv" class="file-upload-name"></p>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="button" id="apply_now" class="btn btn-submit apply-submit-btn" onclick="PushData()" value="<?=_applynow?>">
                </div>
            </div>
        </div>
		<input type="hidden" name="id_cv" id="id_cv" value="<?=$dulieu['ten']?>">
	</form>
</div>
<script type="text/javascript">
	function PushData(){
		if(isEmpty($('#apply_cv input[name="name"]').val(), vuilongdienfull )){$('#apply_cv input[name="name"]').focus();return false;}
		if(isEmpty($('#apply_cv input[name="email"]').val(), vuilongdienfull)){$('#apply_cv input[name="email"]').focus();return false;}
		if(isEmail($('#apply_cv input[name="email"]').val(), vuilongdienfull)){$('#apply_cv input[name="email"]').focus();return false;}
		if(isEmpty($('#apply_cv input[name="phone"]').val(), vuilongdienfull)){$('#apply_cv input[name="phone"]').focus();return false;}
		if(isPhone($('#apply_cv input[name="phone"]').val(), vuilongdienfull)){$('#apply_cv input[name="phone"]').focus();return false;}
		if(isEmpty($('#apply_cv input[name="birthday"]').val(), vuilongdienfull)){$('#apply_cv input[name="birthday"]').focus();return false;}
		if(isEmpty($('#apply_cv textarea').val(), vuilongdienfull)){$('#apply_cv textarea').focus();return false;}
		$('#apply_cv').submit();
	}
</script>
<style type="text/css" media="screen">
.form-title {
  color: #011967;
  font-size: 30px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 20px;
}
.upload-field-wrap {
  width: 100%;
  float: left;
}
.upload-field-wrap .upload-field {
  float: left;
}
.upload-field-wrap .note-label {
  margin-left: 120px;
}
.upload-field {
  width: 112px;
  display: inline-block;
}
.upload-field:hover {
  cursor: pointer;
}
.fake-field {
  width: 100%;
  height: 36px;
  border: 1px solid #e1e1e1;
  border-radius: 5px;
}
.fake-field:before {
  content: '';
  width: 50px;
  height: 34px;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: auto auto;
  background-image: url('images/upload-icon.png');
  display: block;
  float: left;
}
.fake-field > span {
  line-height: 34px;
}
.real-field {
  position: absolute;
  top: 0;
  left: 15px;
  z-index: 9;
  opacity: 0;
}
.file-upload-name {
  width: 100%;
  color: #005ca1;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  padding-top: 10px;
}
.note-label {
  color: #818181;
  font-size: 12px;
  font-style: italic;
}	
</style>