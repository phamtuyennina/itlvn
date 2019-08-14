<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$id=$_REQUEST['id'];
switch($act){

	case "man":
		get_items();
		$template = "donhang/items";
		break;
	case "add":		
		$template = "donhang/item_add";
		break;
	case "edit":		
		get_item();
		$template = "donhang/item_add";
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

#====================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_items(){
	global $d, $items, $paging;
	
	$thongtin = $_REQUEST['thongtin'];
		$where=" where id<> 0 "; 
	if($_GET["ngaybd"]!=''){
	$ngaybatdau = $_GET["ngaybd"];		
	$Ngay_arr = explode("/",$ngaybatdau); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày sinh<br>";} else $ngaybatdau=$nam."-".$thang."-".$ngay;
	}	
		$where.=" and ngaytao>=".strtotime($ngaybatdau)." ";
	}

	if($_GET["ngaykt"]!=''){
	$ngayketthuc = $_GET["ngaykt"];		
	$Ngay_arr = explode("/",$ngayketthuc); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày sinh<br>";} else $ngayketthuc=$nam."-".$thang."-".$ngay;
	}	
		$where.=" and ngaytao<=".strtotime($ngayketthuc)." ";
		
	}

	
	if($_GET["keyword"]!=''){
		$where.=" and (madonhang like '%".$_GET["keyword"]."%' or hoten like '%".$_GET["keyword"]."%' )  ";
	}
	//sotien
	if($_GET["sotien"]!='' && $_GET["sotien"]>0){
		$sql="select giatu,giaden from #_giasearch where id='".$_GET["sotien"]."'";
		$d->query($sql);
		$giatim=$d->fetch_array();
		if($giatim!=null){
			$where.=" and tonggia>=".$giatim['giatu']." and tonggia<=".$giatim['giaden']." ";			
		}
	}
	//httt
	if($_GET["httt"]!='' && $_GET["httt"] > 0){
		$where.=" and httt=".$_GET["httt"]." ";
	}
	//tinhtrang
	if($_GET["tinhtrang"]!='' && $_GET["tinhtrang"]>0){
		$where.=" and tinhtrang=".$_GET["tinhtrang"]." ";
	}

	$sql = "select * from #_donhang $where";	
	
	$sql.=" order by id desc";
	
	$d->query($sql);
	
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=order&act=man&tinhtrang=".$_GET['tinhtrang']."&ngaytao=".$_GET['ngaytao']."&ngayin=".$_REQUEST['ngayin']."&hinhthucgiaohang=".$_GET['hinhthucgiaohang'];
	$maxR=20;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item,$diemthuong;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
	
	$sql = "select * from #_donhang where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=order&act=man");
	$item = $d->fetch_array();	

}

function save_item(){
	global $d;
	
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
		
	if($id){
		//dump($_POST);
		$id =  themdau($_POST['id']);				
		$data['ghichu'] = $_POST['ghichu'];
		
		$data['tinhtrang'] = $_POST['id_tinhtrang'];
		$data['hoten'] = magic_quote($_POST['hoten']);
		$data['ghichu'] = magic_quote($_POST['ghichu']);
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = magic_quote($_POST['diachi']);
		$data['email'] = magic_quote($_POST['email']);
		$data['httt'] = magic_quote($_POST['httt']);
		$data['noidung'] = magic_quote($_POST['noidung']);
		$data['thanhpho'] = $_POST['thanhpho_item'];
		$data['quan'] = $_POST['thanhpho'];
		$data['htgh'] = $_POST['hinhthucgiaohang'];
		$data['phithem'] = $_POST['phithem'];
		$data['tonggia']=$_POST['tongtienctt_'];			
		$d->setTable('donhang');
		$d->setWhere('id', $id);
		if($d->update($data)){
			$count=count($_POST['idsp']);
			$daxoa=count($_POST['daxoa']);
			for($i=0;$i<$daxoa;$i++){
				$d->reset();
				$d->setTable('chitietdonhang');
				$d->setWhere('id', $_POST['daxoa'][$i]);
				$d->delete();
			}
			for($i=0;$i<$count;$i++)
			{
				$data2['soluong']=$_POST['soluong'][$i];
				$data2['tonggia']=$_POST['giasp'][$i];
				$data2['size']=isset($_POST['size'][$i]) ? $_POST['size'][$i] : "";
				$data2['mausac']=isset($_POST['color'][$i]) ? $_POST['color'][$i] : "";
				$data2['id']=$_POST['idsp'][$i];
				
				$d->reset();
				$d->setTable('chitietdonhang');
				$d->setWhere('id', $_POST['idsp'][$i]);
				$d->update($data2);
				
			}
			redirect("index.php?com=order&act=man&curPage=".$_REQUEST['curPage']."");
		}else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=order&act=man");
	}else{
			
				
		$data['ghichu'] = $_POST['ghichu'];
		$data['tinhtrang'] = $_POST['id_tinhtrang'];
		$data['hoten'] = magic_quote($_POST['hoten']);
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = magic_quote($_POST['diachi']);
		$data['email'] = magic_quote($_POST['email']);
		$data['httt'] = magic_quote($_POST['httt']);
		$data['noidung'] = magic_quote($_POST['noidung']);
		$data['thanhpho'] = $_POST['thanhpho_item'];
		$data['quan'] = $_POST['thanhpho'];
		$data['phuong'] = $_POST['phuong'];
		$data['htgh'] = $_POST['hinhthucgiaohang'];
		$data['phithem'] = $_POST['phithem'];
		
		$d->setTable('donhang');
		if($d->insert($data))
			redirect("index.php?com=order&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=order&act=man");
	}
}

function delete_item(){
	global $d;
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		$d->reset();
		
		$sql2 = "select madonhang from #_donhang where id='".$id."' limit 0,1";
		$d->query($sql2);
		$laymadonhang = $d->fetch_array();
				
		$sql = "delete from #_donhang where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			{					
				$sql3 = "delete from #_chitietdonhang where madonhang='".$laymadonhang['madonhang']."'";
				$d->query($sql3);
				redirect("index.php?com=order&act=man");
				
			}
			
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=order&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();	
			
			$sql2 = "select madonhang from #_donhang where id='".$id."' limit 0,1";
			$d->query($sql2);
			$laymadonhang = $d->fetch_array();
			
			$sql3 = "delete from #_chitietdonhang where madonhang='".$laymadonhang['madonhang']."'";
			$d->query($sql3);
														
			$sql = "delete from #_donhang where id='".$id."'";
			$d->query($sql);				
		} 
		redirect("index.php?com=order&act=man");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
}
?>