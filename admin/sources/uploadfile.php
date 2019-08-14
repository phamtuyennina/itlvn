<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		$template = "uploadfile/item_add";
		break;
	case "save":
		save_gioithieu();
		break;
		
	default:
		$template = "index";
}
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}



function save_gioithieu(){
	global $d;
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=uploadfile&act=capnhat");
	
	if($file_name!='style.css' and $file_name!='index.php' and $file_name!='.htaccess')
	{
		delete_file('../'.$file_name);
		if($photo = upload_image("file", _format_duoitatca,'../',$file_name)){
				transfer("File được upload thành công", "index.php?com=uploadfile&act=capnhat");
			}
		else
		{
			transfer("Upload file bị lỗi", "index.php?com=uploadfile&act=capnhat");
		}
	}
	else
	{
		transfer("Không chấp nhận cùn tên với file chính của website", "index.php?com=uploadfile&act=capnhat");
	}
}

?>