<?php  if(!defined('_source')) die("Error");

	$id =  addslashes($_GET['id']);
	//dump($id);
	if(isset($id))
	{
		$d->reset();
		$sql = "select id_pro from #_protag where id_tag='".$id."'";
		$d->query($sql);
		$tag_detail = $d->result_array();		
		
		$d->reset();
		$sql = "select ten from #_tags where id='".$id."'";
		$d->query($sql);
		$name_tag = $d->fetch_array();

		$title_cat = $name_tag['ten'];	
		$title_bar = $name_tag['ten'];
	
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_product where id IN (select id_pro from #_protag where id_tag='".$id."') order by stt asc,ngaytao desc";
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
		$sql = "select * from #_product where id IN (select id_pro from #_protag where id_tag='".$id."') order by stt asc,ngaytao desc";
		$d->query($sql);
		$product = $d->result_array();
		$url_link = getCurrentPageURL();
	
	}
		

?>