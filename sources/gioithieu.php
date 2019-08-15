<?php  if(!defined('_source')) die("Error");
	@$id =   trim(strip_tags(addslashes($_GET['id'])));
	if($id!=''){
		$d->reset();
		$sql = "select ten$lang as ten,id,mota$lang as mota,noidung$lang as noidung,title,keywords,description,photo,id_danhmuc,id_list,id_cat,tenkhongdau from #_news where tenkhongdau='".$id."' limit 0,1";
		$d->query($sql);
		$tintuc_detail = $d->fetch_array();
		if(empty($tintuc_detail['id'])){
			redirect("//".$config_url."/404.php");
		}
		$title_cat = $tintuc_detail['ten'];
		$title = $tintuc_detail['title'];
		$keywords = $tintuc_detail['keywords'];
		$description = $tintuc_detail['description'];

		$images_facebook = "http://".$config_url._upload_tintuc_l.$tintuc_detail['photo'];
		$title_facebook = $tintuc_detail['ten'];
		$description_facebook = trim(strip_tags($tintuc_detail['mota']));

		$noidung=$tintuc_detail['noidung'];
		$key_active=$tintuc_detail['tenkhongdau'];

		$d->reset();
	    $sql = "select id,ten$lang as ten,tenkhongdau,photo from #_news_danhmuc where type='giai-phap-kinh-doanh' and hienthi=1 order by stt,id desc";
	    $d->query($sql);
	    $giaiphap_l = $d->result_array();

	    $d->reset();
		$sql = "select ten$lang as ten,id,mota$lang as mota,tenkhongdau from #_news where type='".$type."' order by id,stt asc";
		$d->query($sql);
		$baiviet1 = $d->result_array();

	}