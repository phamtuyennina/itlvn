<?php	
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './admin/lib/');
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	header("Content-Type: application/xml; charset=utf-8"); 
	echo '<?xml version="1.0" encoding="UTF-8"?>'; 
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'; 
	 
	function urlElement($url, $pri,$mod) {
	echo '<url>'; 
	echo '<loc>'.$url.'</loc>'; 
	echo '<changefreq>weekly</changefreq>';
	echo '<lastmod>'.$mod.'</lastmod>';
	echo '<priority>'.$pri.'</priority>';
	echo '</url>';
	}
	$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
	urlElement($protocol.$config_url,'1.0',date(c));
	
	$arrcom = array("gioi-thieu","dich-vu","bang-gia","tin-tuc","tu-van","lien-he");

	foreach ($arrcom as $k => $v) {
		urlElement($protocol.$config_url.'/'.$v.'.html','1.0',date(c));
	}

	$arrcom_article = array("tin-tuc","dich-vu","tu-van","chinh-sach-quy-dinh","kien-thuc-nha-khoa","hinh-anh-that-te");
	$arrcom_type = array("tintuc","dichvu","tuvan","quydinh","kienthuc","hinhanh");

	for($m = 0, $count_tintuc = count($arrcom_article); $m < $count_tintuc; $m++){
		$d->reset();
		$sql = "select id,ten$lang as ten,tenkhongdau,ngaytao from #_news where type='".$arrcom_type[$m]."'";		
		$d->query($sql);
		$tintuc = $d->result_array();
		
		foreach($tintuc as $v){
			urlElement($protocol.$config_url.'/'.$arrcom_article[$m].'/'.$v['tenkhongdau'].'.html','0.8',date(c,$tintuc[$k]['ngaytao']));
		}
	}
	echo '</urlset>'; 

?>
