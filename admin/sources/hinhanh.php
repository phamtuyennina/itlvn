<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$duongdan=$_SERVER['HTTP_REFERER'];

switch($act){
	case "man_photo":
		get_photos();
		$template = "hinhanh/photos";
		break;
		
	case "add_photo":		
		$template = "hinhanh/photo_add";
		break;
		
	case "edit_photo":
		get_photo();
		$template = "hinhanh/photo_edit";
		break;
		
	case "save_photo":
		save_photo();
		break;
		
	case "savestt_photo":
		savestt_photo();
		break;
		
	case "delete_photo":
		delete_photo();
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

function get_photos(){	
	global $d, $items, $paging;
	
	if(@$_REQUEST['noibat']!='')
	{
		$id_up = @$_REQUEST['noibat'];
		$sql_sp = "SELECT id,noibat FROM table_hinhanh where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$noibat=$cats[0]['noibat'];
		if($noibat==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhanh SET noibat =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhanh SET noibat =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");	
		}	
	}
		
	if(@$_REQUEST['hienthi']!='')
	{
		$id_up = @$_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_hinhanh where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhanh SET hienthi =1 WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
			$sqlUPDATE_ORDER = "UPDATE table_hinhanh SET hienthi =0  WHERE  id = ".$id_up."";
			$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	
		}	
	}
	
	$sql = "select * from #_hinhanh where id_hinhanh='".$_REQUEST['id_hinhanh']."' and type='".$_REQUEST['type']."'";
	if($_REQUEST['key']!='')
	{
	$sql.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."";
	$maxR=10;
	$maxP=4;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];

}

function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
	$d->setTable('hinhanh');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			$file_name=$_FILES['file']['name'];
			if($photo = upload_image("file", _format_duoihinh, _upload_hinhthem,$file_name)){
				$data['photo'] = $photo;
				if($_REQUEST['type']=='sanpham'){
					$data['thumb'] = create_thumb($data['photo'], 100, 100, _upload_hinhthem,$file_name,1);	}
					
				$d->setTable('hinhanh');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhthem.$row['photo']);
					delete_file(_upload_hinhthem.$row['thumb']);
				}
			}
			
			$data['id_hinhanh'] = $_REQUEST['id_hinhanh'];
			$data['type'] = $_REQUEST['type'];
						
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];	
			$data['ten'] = $_POST['ten'];
			$data['mota'] = $_POST['mota'];	
			$data['tenen'] = $_POST['tenen'];
		    $data['motaen'] = $_POST['motaen'];
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;

			$d->reset();
			$d->setTable('hinhanh');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
			redirect("index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
			
	}
	{ 			
		for($i=0; $i<3; $i++){
				$file_name=$_FILES['file'.$i]['name'];
				if($data['photo'] = upload_image("file".$i, _format_duoihinh, _upload_hinhthem,$file_name))
					{		
						if($_REQUEST['type']=='sanpham'){
						$data['thumb'] = create_thumb($data['photo'], 100, 100, _upload_hinhthem,$file_name,1);	}					
						$data['id_hinhanh'] = $_REQUEST['id_hinhanh'];
						$data['type'] = $_REQUEST['type'];
						$data['stt'] = $_POST['stt'.$i];
						$data['ten'] = $_POST['ten'.$i];	
						$data['link'] = $_POST['link'.$i];	
						$data['mota'] = $_POST['mota'.$i];	
						$data['tenen'] = $_POST['tenen'.$i];
						$data['motaen'] = $_POST['motaen'.$i];										
						$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;	
						$data['noibat'] = isset($_POST['noibat'.$i]) ? 1 : 0;																	
						$d->setTable('hinhanh');
						if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
					}
			}
			redirect("index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
	}
}
//===========================================================
function savestt_photo(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $duongdan);
	
	for($i=0; $i<10; $i++)
	{
		$id = $_POST['sttan'.$i];
		
		if($id!='')
		{
			$data['stt'] = $_POST['stt'.$i];
			$d->reset();
			$d->setTable('hinhanh');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", $duongdan);	
		}
	}
	
	redirect("index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
}

function delete_photo(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('hinhanh');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
		$row = $d->fetch_array();
		delete_file(_upload_hinhthem.$row['photo']);
		if($d->delete())
			redirect("index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_hinhanh where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhthem.$row['photo']);
			}
			$sql = "delete from #_hinhanh where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");} else transfer("Không nhận được dữ liệu", "index.php?com=hinhanh&act=man_photo&id_hinhanh=".$_REQUEST['id_hinhanh']."&type=".$_REQUEST['type']."");
}

?>

	
