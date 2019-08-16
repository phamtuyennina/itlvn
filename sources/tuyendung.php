
<?php  if(!defined('_source')) die("Error");

	#Chi tiết bài viết
	$sql = "select ten$lang as ten,noidung$lang as noidung,title,keywords,description,ngaytao from #_about where type='".$type."' and hienthi=1 limit 0,1";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();

	#Thông tin seo web
	//$title_cat = 'Giới thiệu';
	//$title_cat = $tintuc_detail['ten'];
	$title = $tintuc_detail['title'];
	$keywords = $tintuc_detail['keywords'];
	$description = $tintuc_detail['description'];

	#Thông tin share facebook
	$images_facebook = "http://".$config_url._upload_hinhanh_l.$tintuc_detail['photo'];
	$title_facebook = $tintuc_detail['ten'];
	$description_facebook = trim(strip_tags($tintuc_detail['mota']));
?>
