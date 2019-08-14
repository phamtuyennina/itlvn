<?php  if(!defined('_source')) die("Error");
	
	if(isset($_GET['keyword'])){
		$tukhoa =  $_GET['keyword'];
		$tukhoa = trim(strip_tags($tukhoa));    	
		if (get_magic_quotes_gpc()==false) {
			$tukhoa = mysql_real_escape_string($tukhoa);    			
		}								

		$where = " (ten$lang LIKE '%$tukhoa%' or masp LIKE '%$tukhoa%') and type='".$type."' and hienthi=1 order by stt,id desc";
		
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
	}	
?>