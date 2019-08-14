<?php  if(!defined('_source')) die("Error");

	@$id_danhmuc =   trim(strip_tags(addslashes($_GET['id_danhmuc'])));
	@$id_list =   trim(strip_tags(addslashes($_GET['id_list'])));
	@$id_cat =   trim(strip_tags(addslashes($_GET['id_cat'])));
	@$id =   trim(strip_tags(addslashes($_GET['id'])));

	if($com=='tag')
	{
		$d->reset();
		$sql = "select id_pro from #_protag where id_tag='".$id_cat."'";
		$d->query($sql);
		$tag_detail = $d->result_array();

		$d->reset();
		$sql = "select ten from #_tags where id='".$id_cat."'";
		$d->query($sql);
		$name_tag = $d->fetch_array();

		$title_cat = $name_tag['ten'];
		$title = $name_tag['ten'];
		$com = 'tin-tuc';

		$where = " type='".$type."' and id IN (select id_pro from #_protag where id_tag='".$id_cat."') order by stt asc,ngaytao desc";
	}
	#Chi tiết tin tức
	elseif($id!='')
	{
		#Chi tiết tin tức
		$sql = "select ten$lang as ten,id,mota$lang as mota,noidung$lang as noidung,title,keywords,description,photo,id_danhmuc,id_list,id_cat from #_news where tenkhongdau='".$id."' limit 0,1";
		$d->query($sql);
		$tintuc_detail = $d->fetch_array();
		if(empty($tintuc_detail['id'])){
			redirect("//".$config_url."/404.php");
		}
		#Thông tin seo web
		$title_cat = $tintuc_detail['ten'];
		$title = $tintuc_detail['title'];
		$keywords = $tintuc_detail['keywords'];
		$description = $tintuc_detail['description'];

		#Thông tin share facebook
		$images_facebook = "http://".$config_url._upload_tintuc_l.$tintuc_detail['photo'];
		$title_facebook = $tintuc_detail['ten'];
		$description_facebook = trim(strip_tags($tintuc_detail['mota']));

		#Các hình khác của dự án
		$sql_hinhkhac = "select id,ten,thumb,photo from #_hinhanh where type='".$type."' and hienthi=1 and id_hinhanh='".$tintuc_detail['id']."' order by stt,id desc";
		$d->query($sql_hinhkhac);
		$hinhkhac = $d->result_array();

		#tags
		$d->reset();
    $sql_tags = "select id,ten from #_tags where  id IN (select id_tag from #_protag where id_pro=".$tintuc_detail['id'].") and type='".$type."' order by id desc";
    $d->query($sql_tags);
    $tags_sp = $d->result_array();

		#Các tin cũ hơn
		$where = " type='".$type."' and hienthi=1 and id<>'".$tintuc_detail['id']."' and id_danhmuc=".$tintuc_detail['id_danhmuc']." and id_list=".$tintuc_detail['id_list']." and id_cat=".$tintuc_detail['id_cat']." order by stt,id desc";
	}
	#Danh mục tin tức
	elseif($id_danhmuc!='')
	{
		$sql = "select id,ten$lang as ten,title,keywords,description from #_news_danhmuc where hienthi=1 and tenkhongdau='".$id_danhmuc."' limit 0,1";
		$d->query($sql);
		$title_new = $d->fetch_array();
		if(empty($title_new['id'])){
			redirect("//".$config_url."/404.php");
		}
		#Thông tin seo web
		$title_cat = $title_new['ten'];
		$title = $title_new['title'];
		$keywords = $title_new['keywords'];
		$description = $title_new['description'];

		#Điều kiện lấy danh mục
		$where = " type='".$type."' and id_danhmuc='".$title_new['id']."' and hienthi=1 order by stt,id desc";

	}
	elseif($id_list!='')
	{
		$sql = "select id,ten$lang as ten,title,keywords,description from #_news_list where hienthi=1 and tenkhongdau='".$id_list."' limit 0,1";
		$d->query($sql);
		$title_new = $d->fetch_array();
		if(empty($title_new['id'])){
			redirect("//".$config_url."/404.php");
		}
		#Thông tin seo web
		$title_cat = $title_new['ten'];
		$title = $title_new['title'];
		$keywords = $title_new['keywords'];
		$description = $title_new['description'];

		#Điều kiện lấy danh mục
		$where = " type='".$type."' and id_list='".$title_new['id']."' and hienthi=1 order by stt,id desc";

	}
	elseif($id_cat!='')
	{
		$sql = "select id,ten$lang as ten,title,keywords,description from #_news_cat where hienthi=1 and tenkhongdau='".$title_new['id']."' limit 0,1";
		$d->query($sql);
		$title_new = $d->fetch_array();
		if(empty($title_new['id'])){
			redirect("//".$config_url."/404.php");
		}
		#Thông tin seo web
		$title_cat = $title_new['ten'];
		$title = $title_new['title'];
		$keywords = $title_new['keywords'];
		$description = $title_new['description'];

		#Điều kiện lấy danh mục
		$where = " type='".$type."' and id_cat='".$id_cat."' and hienthi=1 order by stt,id desc";

	}
	#Tất cả Tin tức có type là $type
	else{
		$where = " type='".$type."' and hienthi=1 order by stt,id desc";
	}

	#Lấy tin tức và phân trang
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_news where $where";
	$d->query($sql);
	$dem = $d->fetch_array();

	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	if(!empty($id))
	{
		$pageSize = $company['soluong_tink'];//Số tin khác cho 1 trang
	}
	else
	{
		$pageSize = $company['soluong_tin'];//Số tin cho 1 trang
	}
	$offset = 5;//Số trang hiển thị
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;

	$d->reset();
	$sql = "select id,ten$lang as ten,tenkhongdau,mota$lang as mota,thumb,ngaytao from #_news where $where limit $bg,$pageSize";
	$d->query($sql);
	$tintuc = $d->result_array();
	$url_link = getCurrentPageURL();
?>
