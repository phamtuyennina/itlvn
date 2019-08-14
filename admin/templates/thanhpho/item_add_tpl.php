<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
        elements : "mota,noidung",
		theme : "advanced",
		convert_urls : false,
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,imagemanager,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
height:"350px",
    width:"100%",
	remove_script_host : false,

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<?php
function get_main_item()
	{
		$sql_huyen="select * from table_thanhpho_item order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item"">
			<option value="0">Chọn danh mục</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
function get_htgh()
	{
		$sql_huyen="select * from table_hinhthucgiaohang where hienthi=1 order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="htgh" name="htgh" class="main_font" onchange="select_onchange2()">
			<option>Chọn loại giao hàng</option>	
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["htgh"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<?php if ($_REQUEST['act']=='edit') { ?> <h3>Sửa quận/huyện</h3> <?php }else{ ?><h3>Thêm quận/huyện</h3><?php } ?>
<form name="frm" method="post" action="index.php?com=thanhpho&act=save" enctype="multipart/form-data" class="nhaplieu">
	 
    <b>Chọn danh mục:</b><?=get_main_item();?><br /><br />
    <b>Chọn loại giao hàng:</b><?=get_htgh();?><br /><br />
    <!--<?php if (@$_REQUEST['act']=='edit') { ?>
		<b>Hình hiện tại:</b><img src="<?=_upload_tintuc.$item['photo']?>" alt="NO PHOTO"  width="150px"/><br />
	<?php }?><br />
    
	<b>Hình ảnh:</b> <input type="file" name="file" /><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Width:160px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Height:120px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=_format_duoihinh_l?></strong><br /><br />-->
    
	<b>Tiêu đề</b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /><br />
    
    <b>Phí vận chuyển</b> <input type="text" name="phivanchuyen" value="<?=@$item['phivanchuyen']?>" class="input" /><br /><br />
    	
	<!--<b>Mô tả</b><br/>
	<div><textarea name="mota" id="mota"><?=$item['mota']?></textarea></div><br/>
    
	
	<b>Nội dung</b><br/>
	<div><textarea name="noidung" id="noidung"><?=$item['noidung']?></textarea></div><br/>
    
    <b>Title website</b> <input type="text" name="title" value="<?=@$item['title']?>" class="input" />&nbsp;&nbsp; Độ dài từ 10-70 ký tự<br /><br />
     
    <b>Keywords</b><br/>
	<div><textarea name="keywords" id="keywords" style="width:400px; height:80px;"><?=$item['keywords']?></textarea>&nbsp;&nbsp; Các từ hay cụm từ liên quan</div><br/>

    <b>Description</b><br/>
	<div><textarea name="description" id="description" style="width:400px; height:80px;"><?=$item['description']?></textarea>&nbsp;&nbsp; Độ dài từ 60-170 ký tự (Quan trọng)</div><br/>-->
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br><br/>
	
    <!--<b>Nỗi bật</b> <input type="checkbox" name="noibat" <?=($item['noibat']==1)?'checked="checked"':''?>><br />-->
        
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
		
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=thanhpho&act=man'" class="btn" />
</form>