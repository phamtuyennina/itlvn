<?php if(!defined('_source')) die("Error");
		$title_tcat = "Cập nhật tài khoản";
		$title_bar= "Cập nhật tài khoản";		
		
		
		if($_SESSION['loginw']['thanhvien']==''){
			transfer("Bạn phải đăng nhập mới được vào đây.", "http://$config_url/dang-nhap.html");
		}
		
		
		$vl =  addslashes($_SESSION['login']['id_tv']); 
		
		//Diem tich luy
		$d->reset();
		$sql = "select * from #_user where id='".$vl."'";
		$d->query($sql);
		$dtl = $d->fetch_array();
		
		
		$d->reset();
		$sql = "select * from #_user where email='".$_POST['email']."'";
		$d->query($sql);
		$row = $d->fetch_array();
		
		if($_POST['email']){
			
			if($_POST['txtCaptcha'] != $_SESSION['security_code']) {
			   transfer("Mã xác nhận không chính xác. Vui lòng thử lại.", "tai-khoan.html");
			} else {
				
				$data['password'] = md5($_POST['password']);
				$data['ten'] = $_POST['ten'];
				$data['dienthoai'] = $_POST['dienthoai'];
				$data['sex'] = $_POST['sex'];
				$data['diachi'] = $_POST['diachi'];
				
				//dump($_POST);
				$d->setTable('user');
				$d->setWhere('id', $row["id"]);
				
				if($d->update($data)) {
					$_SESSION['login']['thanhvien'] = $username;
					$_SESSION['login']['ten'] = $row['ten'];
					$_SESSION['login']['diachi'] = $row['diachi'];
					$_SESSION['login']['email'] = $row['email'];
					$_SESSION['login']['sex'] = $row['sex'];
					$_SESSION['login']['dienthoai'] = $row['dienthoai'];
					$_SESSION['login']['id_tv'] = $row['id'];
					
					transfer("Cập nhật tài khoản thành công", "index.html");
					
				} else {
					transfer("Có lỗi xảy ra khi đăng ký. Vui lòng thử lại.", "tai-khoan.html");
				}
				
			}
		}


	
?>