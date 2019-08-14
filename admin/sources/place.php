<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	//$urlcu .= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
	$urlcu .= (isset($_REQUEST['id_city'])) ? "&id_city=".addslashes($_REQUEST['id_city']) : "";
	$urlcu .= (isset($_REQUEST['id_dist'])) ? "&id_dist=".addslashes($_REQUEST['id_dist']) : "";
	$urlcu .= (isset($_REQUEST['id_ward'])) ? "&id_cat=".addslashes($_REQUEST['id_ward']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";


switch($act){
	case "man_city":
		get_citys();
		$template = "place/citys";
		break;
	case "add_city":		
		$template = "place/city_add";
		break;
	case "edit_city":		
		get_city();
		$template = "place/city_add";
		break;
	case "save_city":
		save_city();
		break;
	case "delete_city":
		delete_city();
		break;

	case "man_dist":
		get_dists();
		$template = "place/dists";
		break;
	case "add_dist":		
		$template = "place/dist_add";
		break;
	case "edit_dist":		
		get_dist();
		$template = "place/dist_add";
		break;
	case "save_dist":
		save_dist();
		break;
	case "delete_dist":
		delete_dist();
		break;	


	case "man_ward":
		get_wards();
		$template = "place/wards";
		break;
	case "add_ward":		
		$template = "place/ward_add";
		break;
	case "edit_ward":		
		get_ward();
		$template = "place/ward_add";
		break;
	case "save_ward":
		save_ward();
		break;
	case "delete_ward":
		delete_ward();
		break;	

	case "man_street":
		get_streets();
		$template = "place/streets";
		break;
	case "add_street":		
		$template = "place/street_add";
		break;
	case "edit_street":		
		get_street();
		$template = "place/street_add";
		break;
	case "save_street":
		save_street();
		break;
	case "delete_street":
		delete_street();
		break;	
	
	default:
		$template = "index";
}

#====================================
function get_citys(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$urlcu;	
		
	if($_REQUEST['key']!='')
	{
		$where.=" where tenkhongdau LIKE '%".changeTitle($_REQUEST['key'])."%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_city $where";
	
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_city $where order by id limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=place&act=man_city".$urlcu;		
	
}

function get_city(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_city".$urlcu);	
	$sql = "select * from #_place_city where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_city".$urlcu);
	$item = $d->fetch_array();	
	
}

function save_city(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_city".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['ten'] = $_POST['name'];			
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_city');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_city".$urlcu);
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_city".$urlcu);
	}else{
				
		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);		
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_city');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_city".$urlcu);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_city".$urlcu);
	}
}

function delete_city(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_city where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_city".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_city".$urlcu);
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_city".$urlcu);
}
#====================================
function get_dists(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$urlcu;
	
	$where .="where id <>0";
	if((int)$_REQUEST['id_city']!='')
	{
		$where.=" and id_city=".(int)$_REQUEST['id_city']."";
	}
	
	
	if($_REQUEST['key']!='')
	{
		$where.=" and tenkhongdau LIKE '%".changeTitle($_REQUEST['key'])."%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_dist $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_dist $where order by id  limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=place&act=man_dist".$urlcu;		
	
}

function get_dist(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_dist".$urlcu);	
	$sql = "select * from #_place_dist where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_dist".$urlcu);
	$item = $d->fetch_array();	
	
}

function save_dist(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_dist".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['ten'] = $_POST['name'];			
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_dist');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_dist".$urlcu);
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_dist".$urlcu);
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);		
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_dist');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_dist".$urlcu);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_dist".$urlcu);
	}
}

function delete_dist(){
	global $d,$urlcu;
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_dist where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_dist".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_dist".$urlcu);
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_dist".$urlcu);
}
#====================================
function get_wards(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$urlcu;
	$where .="where id <>0";
	if((int)$_REQUEST['id_city']!='')
	{
		$where.=" and id_city=".(int)$_REQUEST['id_city']."";
	}
	
	if((int)$_REQUEST['id_dist']!='')
	{
		$where.=" and id_dist=".(int)$_REQUEST['id_dist']."";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and tenkhongdau LIKE '%".changeTitle($_REQUEST['key'])."%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_ward $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_ward $where order by id limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=place&act=man_ward".$urlcu;		
	
}

function get_ward(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward".$urlcu);	
	$sql = "select * from #_place_ward where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_ward".$urlcu);
	$item = $d->fetch_array();	
	
}

function save_ward(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['id_dist'] = (int)$_POST['id_dist'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_ward');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_ward".$urlcu);
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_ward".$urlcu);
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];
		$data['id_dist'] = (int)$_POST['id_dist'];		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_ward');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_ward".$urlcu);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_ward".$urlcu);
	}
}

function delete_ward(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_ward where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_ward".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_ward".$urlcu);
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_ward".$urlcu);
}
#====================================
function get_streets(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$urlcu;
	$where .="where id <>0";
	if((int)$_REQUEST['id_city']!='')
	{
		$where.=" and id_city=".(int)$_REQUEST['id_city']."";
	}
	
	if((int)$_REQUEST['id_dist']!='')
	{
		$where.=" and id_dist=".(int)$_REQUEST['id_dist']."";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and tenkhongdau LIKE '%".changeTitle($_REQUEST['key'])."%'";
	}
	
	
	$sql= "SELECT count(id) AS numrows FROM #_place_street $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "SELECT * from #_place_street $where order by id limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=place&act=man_street".$urlcu;		
	
}

function get_street(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street".$urlcu);	
	$sql = "select * from #_place_street where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=place&act=man_street".$urlcu);
	$item = $d->fetch_array();	
	
}

function save_street(){
	global $d;	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);					
		$data['id_city'] = (int)$_POST['id_city'];	
		$data['id_dist'] = (int)$_POST['id_dist'];	
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);			
		$data['stt'] = $_POST['num'];			
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;		
		$data['ngaysua'] = time();
		$d->setTable('place_street');
		$d->setWhere('id', $id);
		if($d->update($data)){						
			redirect("index.php?com=place&act=man_street".$urlcu);
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=place&act=man_street".$urlcu);
	}else{
				
		$data['id_city'] = (int)$_POST['id_city'];
		$data['id_dist'] = (int)$_POST['id_dist'];		
		$data['ten'] = $_POST['name'];	
		$data['tenkhongdau'] = changeTitle($_POST['name']);	
		$data['stt'] = $_POST['num'];				
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('place_street');
		if($d->insert($data))
		{		
			
			redirect("index.php?com=place&act=man_street".$urlcu);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=place&act=man_street".$urlcu);
	}
}

function delete_street(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		
		$id =  themdau($_GET['id']);
		$d->reset();		
		$sql = "delete from #_place_street where id='".$id."'";
	
		

		if($d->query($sql))
			redirect("index.php?com=place&act=man_street".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=place&act=man_street".$urlcu);
	}else transfer("Không nhận được dữ liệu", "index.php?com=place&act=man_street".$urlcu);
}
?>