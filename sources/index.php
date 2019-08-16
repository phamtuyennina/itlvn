<?php  if(!defined('_source')) die("Error");

	$title_cat = 'Sản phẩm nỗi bật';
	
	$where = " type='sanpham' and hienthi=1 and noibat=1 order by stt,id desc";
	
	#Lấy sản phẩm và phân trang
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_product where $where";
	$d->query($sql);	
	$dem = $d->fetch_array();
	
	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	$pageSize = 12;//Số item cho 1 trang
	$offset = 5;//Số trang hiển thị				
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;		
	
	$d->reset();
	$sql = "select id,ten$lang as ten,tenkhongdau,thumb,photo,masp,gia,giakm from #_product where $where limit $bg,$pageSize";		
	$d->query($sql);
	$product = $d->result_array();	
	$url_link = getCurrentPageURL();

function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}	
	if($_POST['customer_email']){
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
 	 		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		    $recaptcha_secret = $config['secretkey'];
		    $recaptcha_response = $_POST['recaptcha_response'];

		    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		    $recaptcha = json_decode($recaptcha);
			if ($recaptcha->score >= 0.5 && $recaptcha->action=='yeucaudichvu') {
				$data['email']=(string)$_POST['customer_email'];
				$data['dichvu']=(string)$_POST['bu_id'];
				$data['dienthoai']=(string)$_POST['customer_phone'];
				$data['noidung']=(string)$_POST['description'];
				$data['type']='yeucaudichvu';
				$data['hienthi']=0;
				$d->setTable('lienhe');
				if($d->insert($data)){
					transfer(_guithongtinyeucaudichvuthanhcong, getCurrentPageURL());
				}else{
					transfer(_guithongtinyeucaudichvuthatbai, getCurrentPageURL());
				}
			}else{

			}
		}
	}
	if($_POST['id_cv']){
		$file_name = $_FILES['file_cv']['name'];
		$data['ten']=$_POST['name'];
		$data['dienthoai']=$_POST['phone'];
		$data['email']=$_POST['email'];
		$data['noidung']=$_POST['message'];
		$data['id_cv']=$_POST['id_cv'];
		$data['gioitinh']=$_POST['gender'];
		$data['sinhnhat']=$_POST['birthday'];
		if($file1 = upload_image("file_cv", _format_duoixemtailieu ,_upload_khac_l,$file_name)){
			$data['file'] = $file1;
		}
		
		include_once "phpMailer/class.phpmailer.php";	
		$mail = new PHPMailer();
		$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
		$mail->Host       = $ip_host;   // tên SMTP server
		$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
		$mail->Username   = $mail_host; // SMTP account username
		$mail->Password   = $pass_mail;  

		//Thiết lập thông tin người gửi và email người gửi
		$mail->SetFrom($mail_host,$_POST['name']);

		//Thiết lập thông tin người nhận và email người nhận
		$mail->AddAddress($company['email'], $company['ten']);
		
		//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($_POST['email'],$_POST['name']);

		//Thiết lập file đính kèm nếu có
		if(!empty($_FILES['file_cv']))
		{
			$mail->AddAttachment($_FILES['file_cv']['tmp_name'], $_FILES['file_cv']['name']);	
		}
		
		//Thiết lập tiêu đề email
		$mail->Subject    = "Email ứng tuyển từ - ".$_POST['name'];
		$mail->IsHTML(true);
		$mail->CharSet = "utf-8";	
		$body = '<table>';
		$body .= '
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th colspan="2">Thư ứng tuyển từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
			</tr>
			<tr>
				<th colspan="2">&nbsp;</th>
			</tr>
			<tr>
				<th>Họ tên :</th><td>'.$_POST['name'].'</td>
			</tr>
			<tr>
				<th>Điện thoại :</th><td>'.$_POST['phone'].'</td>
			</tr>
			<tr>
				<th>Email :</th><td>'.$_POST['email'].'</td>
			</tr>
			<tr>
				<th>Giới tính :</th><td>'.$_POST['gender'].'</td>
			</tr>
			<tr>
				<th>Ngày sinh :</th><td>'.$_POST['birthday'].'</td>
			</tr>
			<tr>
				<th>Công việc :</th><td>'.$_POST['id_cv'].'</td>
			</tr>
			
			<tr>
				<th>Mô tả :</th><td>'.$_POST['message'].'</td>
			</tr>';
		$body .= '</table>';
		$mail->Body = $body;
		dump($data);
	}
?>