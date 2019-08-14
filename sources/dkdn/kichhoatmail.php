<?php if(!defined('_source')) die("Error");
		if($_SESSION['loginw']['thanhvien']!=''){
			redirect("http://".$config_url);
		}
		
		$randomkey = $_GET['capcha'];
		
		//exit();
		$sqlUPDATE_ORDER = "UPDATE table_user SET active=1 WHERE randomkey='$randomkey'";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		transfer("Kích hoạt tài khoản thành công", "http://".$config_url."/dang-nhap.html");
?>