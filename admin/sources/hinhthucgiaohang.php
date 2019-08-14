<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "hinhthucgiaohang/items";
		break;
	case "add":
		$template = "hinhthucgiaohang/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "hinhthucgiaohang/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	default:
		$template = "index";
}

//===========================================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

//===========================================================
function get_items(){
	global $d, $items, $paging;
	
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = @$_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_hinhthucgiaohang where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$noibat=$cats[0]['noibat'];
		if($noibat==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhthucgiaohang SET noibat =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhthucgiaohang SET noibat =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	
		}	
	}
	#********************************************************************************#
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = @$_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_hinhthucgiaohang where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhthucgiaohang SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhthucgiaohang SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	
		}	
	}
	#********************************************************************************#
	
	$sql = "select * from #_hinhthucgiaohang where id<>0 ";
	if($_REQUEST['id_item']!='')
	{
		$sql.=" and id_item = '".$_REQUEST['id_item']."'";
	}
	if($_REQUEST['key']!='')
	{
		$sql.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=hinhthucgiaohang&act=man&id_item=".$_GET['id_item'];
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}
//===========================================================
function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=hinhthucgiaohang&act=man");
	
	$sql = "select * from #_hinhthucgiaohang where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=hinhthucgiaohang&act=man");
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=hinhthucgiaohang&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);		
		if($photo = upload_image("file", _format_duoihinh ,_upload_tintuc,$file_name)){
			$data['photo'] = $photo;	
			$d->setTable('hinhthucgiaohang');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
			}
		}
		$data['id_item'] = (int)$_POST['id_item'];
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['mota'] = $_POST['mota'];
		$data['noidung'] = $_POST['noidung'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$d->setTable('hinhthucgiaohang');
		$d->setWhere('id', $id);
		if($d->update($data))
				redirect("index.php?com=hinhthucgiaohang&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=hinhthucgiaohang&act=man");
	}else{
		
		if($photo = upload_image("file", _format_duoihinh ,_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
		
		}
		$data['id_item'] = (int)$_POST['id_item'];
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['mota'] = $_POST['mota'];
		$data['noidung'] = $_POST['noidung'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$d->setTable('hinhthucgiaohang');
		if($d->insert($data))
			redirect("index.php?com=hinhthucgiaohang&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=hinhthucgiaohang&act=man");
	}
}
//===========================================================
function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_hinhthucgiaohang where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				
			}
			$sql = "delete from #_hinhthucgiaohang where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=hinhthucgiaohang&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=hinhthucgiaohang&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_hinhthucgiaohang where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
			}
			$sql = "delete from #_hinhthucgiaohang where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=hinhthucgiaohang&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=hinhthucgiaohang&act=man");
}

?>


