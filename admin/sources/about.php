<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_item();
		$template = "about/item_add";
		break;
		
	case "save":
		save_item();
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

function get_item(){
	global $d, $item;

	$sql = "select * from #_about where type='".$_REQUEST['type']."' limit 0,1";
	$d->query($sql);
	if($d->num_rows()==0)
	{
		$data['hienthi'] = '1';
		$data['ngaytao'] = time();
		$data['type'] = $_REQUEST['type'];
		
		$d->setTable('about');
		if($d->insert($data))
			transfer("Dữ liệu được khởi tạo","index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
		else
			transfer("Khởi tạo dữ liệu lỗi","index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
	}
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
	
	if($photo = upload_image("file", _format_duoihinh,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_hinhanh,$file_name,2);
			$d->setTable('about');			
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
				//delete_file(_upload_hinhanh.$row['thumb']);
			}
		}

	$data['tenkhongdau'] = changeTitle($_POST['ten']);
	$data['title'] = $_POST['title'];
	$data['keywords'] = $_POST['keywords'];
	$data['description'] = $_POST['description'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);			
		}
		
	$d->reset();
	$d->setTable('about');
	$d->setWhere('type', $_REQUEST['type']);
	if($d->update($data))
		transfer("Dữ liệu được cập nhật", "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
}

?>