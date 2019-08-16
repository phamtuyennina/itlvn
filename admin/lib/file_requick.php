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

		case 'chinh-sach-bao-mat':
			$type = "chinh-sach-bat-mat";
			$title = _chinhsachbaomat;
			$title_cat = _chinhsachbaomat;
			$bread->add($title,$com.".html");		
			$source = "about";
			$template = "about";
			break;

		case 'co-hoi-nghe-nghiep':
			$type = "co-hoi-nghe-nghiep";
			$type1 = "tuyen-dung";
			$title = _cohoinghenghiep;
			$title_cat = _cohoinghenghiep;
			$bread->add($title,$com.".html");		
			$source = "tuyendung";
			$template = "tuyendung_about";
			break;

		case 'gia-nhap-doi-ngu':
			$type = "gia-nhap-doi-ngu";
			$type1 = "tuyen-dung";
			$title = _gianhapdoingu;
			$title_cat = _gianhapdoingu;
			$bread->add($title,$com.".html");		
			$source = "tuyendung";
			$template = "tuyendung_about";
			break;

		case 'moi-truong-lam-viec':
			$type = "moi-truong-lam-viec";
			$type1 = "tuyen-dung";
			$title = _moitruonglamviec;
			$title_cat = _moitruonglamviec;
			$bread->add($title,$com.".html");		
			$source = "tuyendung";
			$template = "tuyendung_about";
			break;

		case 'dieu-khoan-su-dung':
			$type = "dieu-khoan-su-dung";
			$title = _dieukhoansudung;
			$title_cat = _dieukhoansudung;
			$bread->add($title,$com.".html");		
			$source = "about";
			$template = "about";
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
			$title = _tintuctruyenthong;
			$title_cat = _tintuctruyenthong;
			$pageSize1=8;
			$bread->add($title,$com.".html");		
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
			$type = "tuyen-dung";
			$type1 = "tuyen-dung";
			$title = _tuyendung;
			$title_cat = _tuyendung;
			$pageSize1=20000;
			$source = "news";
			$template = isset($_GET['id']) ? "tuyendung_detail" : "tuyendung";
			break;
			
		case 'lien-he':
			$type = "lienhe";
			$title = _lienhe;
			$title_cat = _lienhe;
			$source = "contact";
			$template = "contact";
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