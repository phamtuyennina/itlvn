<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "httt/items";
		break;
	case "add":
		$template = "httt/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "httt/item_add";
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
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by id desc";		
	
	$sql = "select * from #_httt where id<>0 $where";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=httt&act=man".$urlcu;
}
//===========================================================
function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=httt&act=man".$urlcu);
	
	$sql = "select * from #_httt where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=httt&act=man".$urlcu);
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d,$config,$urlcu;
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=httt&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		
		$data['ten'] = $_POST['ten'];
		$data['tenen'] = $_POST['tenen'];
		
		$d->setTable('httt');
		$d->setWhere('id', $id);
		if($d->update($data))
		{	
		mysql_query("DELETE FROM table_protag where id_pro = '$id'");
			if(trim($_POST['tag'])!=''){
			  $arrTags = explode(",", $_POST['tag']);
			  $type=$_POST['type'];
			  foreach ($arrTags as $tag)
			  {
				 $tag = trim($tag);
				 if($tag!=""){
				 //Lấy id của tag có tên là $tag, nếu ko có thì thêm mới
				 $d->reset();
				 $sql= "select id from table_tags where ten='".$tag."' and type='$type'";
				 $d->query($sql);
				 $kiemtratag = $d->result_array();
	  			 
				 if (count($kiemtratag)!=0)
				 {
					  $idTag = $kiemtratag[0]['id'];
				 }
				 else
				 {
					  mysql_query("insert into table_tags(ten,type) values ('$tag','$type')");
					  $idTag = mysql_insert_id();
				 }
			  
				  //Insert dữ liệu vào table Articles_Tags
				  mysql_query("insert into table_protag(id_pro,id_tag) values ($id, $idTag)");
				  }
			  }
			}
			
			redirect("index.php?com=httt&act=man".$urlcu);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=httt&act=man".$urlcu);
	}else{
		
		$data['ten'] = $_POST['ten'];
		$data['tenen'] = $_POST['tenen'];
		
		$d->setTable('httt');
		if($d->insert($data))
		{
				 $id=mysql_insert_id();
			 $type=$_POST['type'];
			mysql_query("DELETE FROM table_protag where id_pro = '$id'");
			if(trim($_POST['tag'])!=''){
			  $arrTags = explode(",", $_POST['tag']);
			  foreach ($arrTags as $tag)
			  {
				 $tag = trim($tag);
				 if($tag!=""){
				 //Lấy id của tag có tên là $tag, nếu ko có thì thêm mới
				 $d->reset();
				 $sql= "select id from table_tags where ten='".$tag."' and type='$type'";
				 $d->query($sql);
				 $kiemtratag = $d->result_array();
	  			 
				 if (count($kiemtratag)!=0)
				 {
					  $idTag = $kiemtratag[0]['id'];
				 }
				 else
				 {
					  mysql_query("insert into table_tags(ten,type) values ('$tag','$type')");
					  $idTag = mysql_insert_id();
				 }
			  
				  //Insert dữ liệu vào table Articles_Tags
				  mysql_query("insert into table_protag(id_pro,id_tag) values ($id, $idTag)");
				  }
			  }
			}
				 if (isset($_FILES['files'])) {
				 $arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
				 $arr_chuoi = str_replace('[','',$arr_chuoi);
				 $arr_chuoi = str_replace(']','',$arr_chuoi);
				 $arr_file_del = explode(',',$arr_chuoi);
	             for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){
						if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
						{
							//dump(in_array(($_FILES['files']['name'][$i]),$arr));
							$file['name'] = $_FILES['files']['name'][$i];
							$file['type'] = $_FILES['files']['type'][$i];
							$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
							$file['error'] = $_FILES['files']['error'][$i];
							$file['size'] = $_FILES['files']['size'][$i];
							$file_name = images_name($_FILES['files']['name'][$i]);
							$photo = upload_photos($file, _format_duoihinh, _upload_hinhthem,$file_name);
							$data1['photo'] = $photo;
							$data1['thumb'] = create_thumb($data1['photo'], 100, 100, _upload_hinhthem,$file_name,1);	
							$data1['stt'] = $_POST['stthinh'][$i];
							$data1['type'] = $_POST['type'];
							$data1['id_hinhanh'] = $id;
							$data1['hienthi'] = 1;
							$d->setTable('hinhanh');
							$d->insert($data1);
						}
					}
				}
	        }
			
			redirect("index.php?com=httt&act=man".$urlcu);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=httt&act=man".$urlcu);
	}
}
//===========================================================

function delete_item(){
	global $d,$urlcu;	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();
		$sql = "select * from #_httt where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
			}
			$sql = "delete from #_httt where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=httt&act=man&type=".$_GET['type']."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=httt&act=man".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_httt where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
			}
			$sql = "delete from #_httt where id='".$id."'";
			$d->query($sql);
		}
			
		} 
		redirect("index.php?com=httt&act=man".$urlcu);
	}
}



?>
