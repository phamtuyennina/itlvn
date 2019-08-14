<?php
include ("ajax_config.php");

if(checkPermission()==false){
	header('Content-Type: text/html; charset=utf-8');
	die("Bạn Không có quyền vào đây !");
}

	$links=$_POST['links'];

?>
<link rel="stylesheet" type="text/css" href="zoom/cloud-zoom.css" />
	<a href="<?=$links?>" class="group2 cloud-zoom" rev="group1" rel="zoomHeight:300, zoomWidth:445, adjustX: 10, adjustY:-4, position:'body'" ><img src="<?=$links?>" alt="hình ảnh" width="350" /></a>

<script type="text/javascript" src="zoom/cloud-zoom.1.0.2.js"></script>
