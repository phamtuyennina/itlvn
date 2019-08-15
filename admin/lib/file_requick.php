<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);
	
	#Thông tin 
	$d->reset();
	$sql_company = "select lang_default from #_company limit 0,1";
	$d->query($sql_company);
	$company1= $d->fetch_array();
	
	#Gọi ngôn ngữ
	$lang_default = array("","en");
	if(!isset($_SESSION['lang']) or !in_array($_SESSION['lang'], $lang_default))
	{
		$_SESSION['lang'] = $company1['lang_default'];
	}
	$lang=$_SESSION['lang'];
	require_once _source."lang$lang.php";
	$d->reset();
	$sql_company = "select *,ten$lang as ten,diachi$lang as diachi from #_company limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();
		$d->reset();
	$sql = "select photo from #_about where type='about' limit 0,1";
	$d->query($sql);
	$about_1 = $d->fetch_array();
	$a=isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
	$company['images']=$a.$config_url.'/'._upload_hinhanh_l.$about_1['photo'];
	if (class_exists('breadcrumb')) {
		$bread = new breadcrumb();
		$bread->add(_trangchu,"index.html");		
	}
	switch($com)
	{
		case 'gioi-thieu':
			$type = "gioi-thieu";
			$title = _gioithieu;
			$title_cat = _gioithieu;
			$source = "gioithieu";
			$template = "gioithieu";
			break;
		case '':
		case 'index':
			$title = $company['title'];
			$title_cat = $company['title'];
			$source = "index";
			$template = "index";
			break;
			
		case 'ajax':
			$source = "ajax";
			break;		
		
		case 'tin-tuc':
			$type = "tin-tuc";
			$title = _tintuc;
			$title_cat = _tintuc;
			$source = "news";
			break;

		case 'giai-phap-kinh-doanh':
			$type = "giai-phap-kinh-doanh";
			$title = _giaiphapkinhdoanh;
			$title_cat = _giaiphapkinhdoanh;
			$source = "giaiphap";
			$template = "giaiphap";
			break;	

		case 'khu-vuc':
			$type = "khu-vuc";
			$title = _mangluoikhuvuc;
			$title_cat = _mangluoikhuvuc;
			$template = "khuvuc";
			break;	

		case 'yeu-cau-dich-vu':
			$type = "yeu-cau-dich-vu";
			$title = _yeucaudichvu;
			$title_cat = _yeucaudichvu;
			$template = "yeucaudichvu";
			$case='khach-hang';
			break;

		case 'huong-dan-hoi-dap':
			$type = "huong-dan-hoi-dap";
			$title = _huongdanhoidap;
			$title_cat = _huongdanhoidap;
			$template = "huongdan";
			$case='khach-hang';
			break;

		case 'phan-hoi-khach-hang':
			$type = "phan-hoi-khach-hang";
			$title = _phanhoikhachhang;
			$title_cat = _phanhoikhachhang;
			$template = "phanhoi";
			$case='khach-hang';
			break;		
			
		case 'dich-vu':
			$type = "dichvu";
			$title = _dichvu;
			$title_cat = _dichvu;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
			
		case 'tuyen-dung':
			$type = "tuyendung";
			$title = _tuyendung;
			$title_cat = _tuyendung;
			$source = "news";
			$template = isset($_GET['id']) ? "news_detail" : "news";
			break;
			
		case 'lien-he':
			$type = "lienhe";
			$title = _lienhe;
			$title_cat = _lienhe;
			$source = "contact";
			$template = "contact";
			break;

		case 'tim-kiem':
			$type = "sanpham";
			$title = _ketquatimkiem;
			$title_cat = _ketquatimkiem;
			$source = "search";
			$template = "product";
			break;
						
		case 'san-pham':
			$type = "sanpham";
			$title = _sanpham;
			$title_cat = _sanpham;
			$source = "product";
			$template = isset($_GET['id']) ? "product_detail" : "product";
			break;
			
		case 'video':
			$title = 'Video Clip';
			$title_cat = "Video Clip";
			$source = "video";
			$template = "video";
			break;
		
		case 'gio-hang':
			$type = "giohang";
			$title = _giohang;
			$title_cat = _giohang;
			$source = "giohang";
			$template = "giohang";
			break;	
			
		case 'thanh-toan':
			$type = "thanhtoan";
			$title = _thanhtoan;
			$title_cat = _thanhtoan;
			$source = "thanhtoan";
			$template = "thanhtoan";
			break;
			
		case 'dang-ky':
			$type = "dangky";
			$title = _dangky;
			$title_cat = _dangky;
			$source = "dangky";
			$template = "dangky";
			break;
	
		case 'dang-xuat':
			logout();
			break;
				
		case 'add-user':
			$source = "user";
			$template = "user";
			break;
			
		case 'ngonngu':
			if(isset($_GET['lang']))
			{
				switch($_GET['lang'])
					{
						case '':
							$_SESSION['lang'] = '';
							break;
						case 'en':
							$_SESSION['lang'] = 'en';
							break;
						default: 
							$_SESSION['lang'] = '';
							break;
					}
			}
			else{
				$_SESSION['lang'] = '';
			}
		redirect($_SERVER['HTTP_REFERER']);
		break;	
										
		default: 
			$source = "index";
			$template = "index";
			break;
	}
	/*if($_SERVER["REQUEST_URI"]=='/index.php'){
        header("location://".$config_url."/");
    }*/
	if($source!="") include _source.$source.".php";	
	if($_REQUEST['com']=='logout')
	{
		session_unregister($login_name);
		header("Location:index.php");
	}

	$arr_animate =array("bounce","flash","pulse","rubberBand","shake","swing","tada","wobble","jello","bounceIn","bounceInDown","bounceInLeft","bounceInRight","bounceInUp","bounceOut","bounceOutDown","bounceOutLeft","bounceOutRight","bounceOutUp","fadeIn","fadeInDown","fadeInDownBig","fadeInLeft","fadeInLeftBig","fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig","fadeOut","fadeOutDown","fadeOutDownBig","fadeOutLeft","fadeOutLeftBig","fadeOutRight","fadeOutRightBig","fadeOutUp","fadeOutUpBig","flip","flipInX","flipInY","flipOutX","flipOutY");	
?>