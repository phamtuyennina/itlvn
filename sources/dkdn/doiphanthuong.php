<?php if(!defined('_source')) die("Error");
		$title_tcat = "Đổi phần thưởng";
		$title_bar .= "Đổi phần thưởng";		
		
		if($_SESSION['login']['thanhvien']==''){
			transfer("Bạn phải đăng nhập mới được vào đây.", "http://$config_url/dang-nhap.html");
		}
		
		$id_tv =  addslashes($_POST['id_tv']);
		
		$d->reset();
		$sql = "select id,ten_$lang, diemthuong from #_tieude where type='mucthuong' and hienthi=1 order by stt asc, id desc";
		$d->query($sql);
		$res_mucthuong = $d->result_array();
		
		$d->reset();
		$sql = "select * from #_member where id='".$id_tv."'";
		$d->query($sql);
		$res_user = $d->fetch_array();
		
		if($_POST['mucthuong'] == 0){
			
		} else {
			$d->reset();
			$sql = "select id,ten_$lang, diemthuong from #_tieude where type='mucthuong' and id='".$_POST['mucthuong']."' and hienthi=1 order by stt asc, id desc";
			$d->query($sql);
			$diemthuong = $d->fetch_array();
			
			if($diemthuong['diemthuong'] > $res_user["tichluy"]) {
				transfer("Bạn không đủ điểm để đổi phần thưởng", "doi-phan-thuong.html" );
			} else {
				$data['id_tv'] = $_POST['id_tv'];
				$data['id_mucthuong'] = $_POST['mucthuong'];
				$data['trangthai'] = 1;
				$data['hienthi'] = 1;
				$data['ngaytao'] = time();
				
				$d->setTable('thanhviennhanthuong');
	
				if($d->insert($data)) {
					transfer("Đổi phần thưởng thành công.", "index.html");
				} else {
					transfer(_coloixayra, "doi-phan-thuong.html");
				}	

			}
				

		}


	
?>