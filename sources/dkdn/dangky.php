<?php  
if(!defined('_source')) die("Error");
		$title_tcat = _dangkythanhvien;
		$title_bar .= _dangkythanhvien;
		
		if($_SESSION['loginw']['thanhvien']!=''){
			redirect("index.html");
		}

		$vl =  $_SESSION['login']['id_tv'];
		

		if(isset($_POST) && $_POST['email']){
		
		if($_POST['txtCaptcha'] != $_SESSION['security_code']) {
		   transfer("Mã xác nhận không chính xác", "dang-ky.html");
		} else {
			
			$reguser = $_POST['email'];
			$sql_reguser = "select * from #_user where email='$reguser'";
			$d->query($sql_reguser);
			$usercheck = $d->result_array();
			$count_usercheck = count($usercheck);
			if ($count_usercheck > 0)
			{
				transfer("Email đăng ký đã tồn tại", "dang-ky.html");
			}
			else 
			{
	
			$data['password'] = md5($_POST['password']);
			$data['email'] = $_POST['email'];
			$data['ten'] = $_POST['ten'];
			$data['dienthoai'] = $_POST['dienthoai'];
			$data['gioitinh'] = $_POST['sex'];
			$data['diachi'] = $_POST['diachi'];
			$data['active'] = "0";
			$data['com'] = "regular";
			$data['ngaytao'] = time();

			
	
			//Lưu ngày sinh
			$ngaysinh = $_POST['ngaysinh'];
			$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
			if (count($Ngay_arr)==3) {
				$ngay = $Ngay_arr[0]; //17
				$thang = $Ngay_arr[1]; //11
				$nam = $Ngay_arr[2]; //2010
				if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
			}	
			
			$ngaysinh = strtotime($ngaysinh);
			$data['ngaysinh']=$ngaysinh;
			$randomkey = ChuoiNgauNhien(32);
			$data['randomkey'] = $randomkey;
			$d->setTable('user');
		
			include_once "sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); // Gọi đến class xử lý SMTP
			$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
			$mail->Host       = $ip_host;     // Thiết lập thông tin của SMPT
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;            // SMTP account password
			
			
			//Thiet lap thong tin nguoi gui va email nguoi gui
			$mail->SetFrom($mail_host,$company["ten"]);
			
			//Thiết lập thông tin người nhận
			$mail->AddAddress($_POST["email"],$_POST["ten"]);
			//Thiết lập email nhận email hồi đáp
			//nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($company['email'],$company["ten"]);
	
			/*=====================================
			 * THIET LAP NOI DUNG EMAIL
			*=====================================*/
	
			//Thiết lập tiêu đề
			$mail->Subject    = "Xác nhận tài khoản ".$company["ten"]." ";
			$mail->IsHTML(true);
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";	
	
				$body = '<table style="text-align:left;">';
				$body .= '
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">'.$company["ten"].'</td>
					</tr>
					<tr>
						<td colspan="2">Cảm ơn bạn đã đăng ký thành viên trên '.$company["ten"].' Để tài khoản thành viên có hiệu lực: </td>
					</tr>
					<tr>
						<td colspan="2"><a href="http://'.$config_url.'/kich-hoat-mail/'.$randomkey.'.html">Click vào đây để xác nhận tài khoản</a></td>
					</tr>
					<tr>
						<td><b style="width:100px; float:left;">Username :</b> <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a></td>
					</tr>
					<tr>
						<td> <b style="width:100px; float:left;">Password :</b>'.$_POST['password'].'</td>
					</tr>
					<tr>
						<td colspan="2">Nếu không phải bạn đã đăng ký tài khoản thì vui lòng bỏ qua E-mail này.</td>
					</tr>
					<tr>
						<td colspan="2">Cảm ơn bạn đã sử dụng dịch vụ của '.$company["ten"].'</td>
					</tr>
					<tr>
						<td colspan="2">Mọi thắc mắc hoặc quan tâm, vui lòng gửi E-mail về tài khoản:</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b>'.$company["ten"].'</b></td>
					</tr>
					<tr>
						<td colspan="2">Địa chỉ : '.$company["diachi"].'</td>
					</tr>
					<tr>
						<td colspan="2">Điện thoại : '.$company["dienthoai"].' Email : '.$company["email"].' website : http://'.$config_url.'</td>
					</tr>
					<tr>
						<td colspan="2">Lưu ý: Đây chỉ là thư thông báo!!!</td>
	
					</tr>
					';
				$body .= '</table>';
				
				
				
				$mail->Body = $body;
				
			if($mail->Send()) {
				$d->insert($data);
				transfer("Chúc mừng bạn đã đăng ký thành công", "dang-nhap.html");
			} else
				transfer("Có lỗi xảy ra khi đăng ký. Vui lòng thử lại", "dang-ky.html");
			}
		}
    }
?>