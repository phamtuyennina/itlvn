<?php
	include ("ajax_config.php");

	if(checkPermission()==false){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}

	if(isset($_POST["id"])){
		echo $sql = "update ".$_POST["bang"]." SET ".$_POST["type"]."=".$_POST["value"]." WHERE  id = ".$_POST["id"]."";
		$data = mysql_query($sql) or die("Not query sql");
	}
?>
