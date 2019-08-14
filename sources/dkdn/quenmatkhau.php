<?php if(!defined('_source')) die("Error");
		
		
		
		$title_bar .= "Quên mật khẩu";
		if(!empty($_POST)){
			$d->reset();
			$sql_user = "select * from #_member where email='".$_POST['email']."'";
			$d->query($sql_user);
			$row_user = $d->fetch_array();
		
		    $ramdomkey=ChuoiNgauNhien(12);
			$email  = $_POST['email'];
			$data['password'] = md5($ramdomkey);
            $d->setTable('member');
			$d->setWhere('email', $email);
			
			
		include_once "phpmailer/class.phpmailer.php";
		//Khởi tạo đối tượng
		$mail = new PHPMailer();
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
		$mail->Host       = $config_ip;     // Thiết lập thông tin của SMPT
		$mail->Username   = $config_email; // SMTP account username
		$mail->Password   = $config_pass;            // SMTP account password
		
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($config_email,$row_setting["ten_$lang"]);
			
		//Thiết lập thông tin người nhận
		$mail->AddAddress($email,$row_user["ten"]);
		$mail->AddAddress($row_setting['email'],$row_setting["ten_$lang"]);
		
		//Thiết lập email nhận email hồi đáp
		//nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($row_setting['email'],$row_setting["ten_$lang"]);

		/*=====================================
		 * THIET LAP NOI DUNG EMAIL
 		*=====================================*/

		//Thiết lập tiêu đề
		$mail->Subject    = "Khôi Phục Mật Khẩu Tài Khoản ".$row_setting["ten_vi"]."  ";
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";	
			$body = '<table>';
			$body .= '
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th colspan="2">Khôi phục mật khẩu của bạn từ website <a href="http://'.$config_url.'/">'.$row_setting["ten_vi"].'</a></th>
				</tr>
				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>
				<tr>
					<th>Tên Đăng Nhập :</th><td>'.$row_user['email'].'</td>
				</tr>
				<tr>
					<th>Password :</th><td>'.$ramdomkey.'</td>
				</tr>
			';
			$body .= '</table>';
			$mail->Body = $body;
            
			
			if($d->update($data) && $mail->Send())
				transfer("Bạn đã lấy lại mật khẩu thành công<br/>Hãy đăng nhập Email của bạn để lấy mật khẩu <br />Xin cảm ơn", "index.html");
    		else
    			transfer("Xin lỗi quý khách.<br>Hệ thống bị lỗi, xin quý khách thử lại.", "quen-mat-khau.html");	
		}	
?>