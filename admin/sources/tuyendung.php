<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
	$urlcu .= (isset($_REQUEST['curPage'])) ? "&curPage=".addslashes($_REQUEST['curPage']) : "";
	$duongdan=$_SERVER['HTTP_REFERER'];

//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "tuyendung/items";
		break;
	case "add":
		$template = "tuyendung/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "tuyendung/item_add";
		break;
	case "save":
		save_item();
		break;
	case "savestt":
		savestt_item();
		break;
	case "delete":
		delete_item();
		break;		
//===========================================================	
	case "man_cat":
		get_cats();
		$template = "tuyendung/cats";
		break;
	case "add_cat":
		$template = "tuyendung/cat_add";
		break;
	case "edit_cat":
		get_cat();
		$template = "tuyendung/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "savestt_cat":
		savestt_cat();
		break;
	case "delete_cat":
		delete_cat();
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
		$sql_sp = "SELECT id,noibat FROM table_tuyendung where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$noibat=$cats[0]['noibat'];
		if($noibat==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_tuyendung SET noibat=1 WHERE id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_tuyendung SET noibat=0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");	
		}	
	}
	//===========================================================
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = @$_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_tuyendung where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_tuyendung SET hienthi=1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_tuyendung SET hienthi=0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");	
		}	
	}
	//===========================================================
	
	$sql = "select * from #_tuyendung where id<>0 ";
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
	$url = "index.php?com=tuyendung&act=man&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage'];
	$maxR = 20;
	$maxP = 4;
	$paging = paging($items, $url, $curPage, $maxR, $maxP);
	$items = $paging['source'];
}
//===========================================================
function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $duongdan);
	
	$sql = "select * from #_tuyendung where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d;
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);		
		if($photo = upload_image("file", _format_duoihinh ,_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_tintuc,$file_name,2);	
			$d->setTable('tuyendung');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
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
		
		$data['tenen'] = $_POST['tenen'];
		$data['motaen'] = $_POST['motaen'];
		$data['noidungen'] = $_POST['noidungen'];
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$d->setTable('tuyendung');
		$d->setWhere('id', $id);
		if($d->update($data))			
				redirect("index.php?com=tuyendung&act=man&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $duongdan);
	}else{
		
		if($photo = upload_image("file", _format_duoihinh ,_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_tintuc,$file_name,2);		
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
		
		$data['tenen'] = $_POST['tenen'];
		$data['motaen'] = $_POST['motaen'];
		$data['noidungen'] = $_POST['noidungen'];
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$d->setTable('tuyendung');
		if($d->insert($data))
			redirect("index.php?com=tuyendung&act=man&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']);
		else
			transfer("Lưu dữ liệu bị lỗi", $duongdan);
	}
}
//===========================================================
function savestt_item(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	
	for($i=0; $i<20; $i++)
	{
		$id = $_POST['sttan'.$i];
		if($id!='')
		{
			$data['stt'] = $_POST['stt'.$i];
			$d->reset();
			$d->setTable('tuyendung');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", $duongdan);	
		}
	}
	redirect("index.php?com=tuyendung&act=man&id_item=".$_REQUEST['id_item']."&curPage=".$_REQUEST['curPage']);
}
//===========================================================
function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_tuyendung where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
			}
			$sql = "delete from #_tuyendung where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=tuyendung&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tuyendung&act=man");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_tuyendung where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
			}
			$sql = "delete from #_tuyendung where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=tuyendung&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=tuyendung&act=man");
}

//===========================================================
function get_cats(){
	global $d, $items, $paging;
	
	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_tuyendung_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
		$sqlUPDATE_ORDER = "UPDATE table_tuyendung_item SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
		$sqlUPDATE_ORDER = "UPDATE table_tuyendung_item SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	//===========================================================
	if($_REQUEST['noibat']!='')
	{
		$id_up = $_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_tuyendung_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$noibat=$cats[0]['noibat'];
	if($noibat==0)
	{
		$sqlUPDATE_ORDER = "UPDATE table_tuyendung_item SET noibat =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
		$sqlUPDATE_ORDER = "UPDATE table_tuyendung_item SET noibat =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	
	$sql = "select * from #_tuyendung_item where id<>0 ";
	if($_REQUEST['key']!='')
	{
		$sql.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$sql.=" order by stt,id desc";	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=tuyendung&act=man_cat";
	$maxR=20;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

//===========================================================
function get_cat(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $duongdan);
	
	$sql = "select * from #_tuyendung_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $duongdan);
	$item = $d->fetch_array();
}
//===========================================================
function save_cat(){
	global $d;
	$file_name_item=$_FILES['file']['name'].fns_Rand_digit(0,9,4);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		$id =  themdau($_POST['id']);		
		if($photo = upload_image("file", _format_duoihinh ,_upload_tintuc,$file_name)){
			$data['photo'] = $photo;	
			$d->setTable('tuyendung_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tintuc.$row['photo']);
			}
		}
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];	
		$data['noidung'] = $_POST['noidung'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;		
		$data['ngaysua'] = time();	
		
		$data['tenen'] = $_POST['tenen'];
		$data['noidungen'] = $_POST['noidungen'];
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$d->setTable('tuyendung_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=tuyendung&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", $duongdan);
	}else{
		if($photo = upload_image("file", _format_duoihinh ,_upload_tintuc,$file_name)){
			$data['photo'] = $photo;
		}
		$data['ten'] = $_POST['ten'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['noidung'] = $_POST['noidung'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;			
		$data['ngaytao'] =time();	
		
		$data['tenen'] = $_POST['tenen'];
		$data['noidungen'] = $_POST['noidungen'];
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$d->setTable('tuyendung_item');
		if($d->insert($data))
			redirect("index.php?com=tuyendung&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Lưu dữ liệu bị lỗi", $duongdan);
	}
}
//===========================================================
function savestt_cat(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	
	for($i=0; $i<20; $i++)
	{
		$id = $_POST['sttan'.$i];
		if($id!='')
		{
			$data['stt'] = $_POST['stt'.$i];
			$d->reset();
			$d->setTable('tuyendung_item');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", $duongdan);	
		}
	}
	redirect("index.php?com=tuyendung&act=man_cat&curPage=".$_REQUEST['curPage']);
}
//===========================================================

function delete_cat(){
	global $d;
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();		
		//Xóa danh mục
		$sql = "delete from #_tuyendung_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0)
		{
			while($row = $d->fetch_array())
			{
				delete_file(_upload_tintuc.$row['photo']);
			}
			$sql = "delete from #_tuyendung_item where id='".$id."'";
			$d->query($sql);
		}
		
		//Xóa sản phẩm thuộc loại đó
		$sql = "select id,thumb,photo from #_tuyendung where id_item='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0)
		{
			while($row = $d->fetch_array())
			{
				delete_file(_upload_tintuc.$row['photo']);
				delete_file(_upload_tintuc.$row['thumb']);
			}
			$sql = "delete from #_tuyendung where id_item='".$id."'";
			$d->query($sql);
		}

		if($d->query($sql))
			redirect("index.php?com=tuyendung&act=man_cat&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Xóa dữ liệu bị lỗi", $duongdan);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();							
				
				$sql = "delete from #_tuyendung_item where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_tintuc.$row['photo']);
					}
					$sql = "delete from #_tuyendung_item where id='".$id."'";
					$d->query($sql);
				}
				
				$sql = "select id,thumb,photo from #_tuyendung where id_item='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_tintuc.$row['photo']);
						delete_file(_upload_tintuc.$row['thumb']);
					}
					$sql = "delete from #_tuyendung where id_item='".$id."'";
					$d->query($sql);
				}

		} 
		redirect("index.php?com=tuyendung&act=man_cat&curPage=".$_REQUEST['curPage']."");
		}
		else transfer("Không nhận được dữ liệu", $duongdan);
}
?>


