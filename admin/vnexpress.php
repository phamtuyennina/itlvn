<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	
	$noidung = $_POST['noidung'];
	$ten= $_POST['tieude'];
	$ngaytao = $_POST['ngaydang'];
	$mota = $_POST['mota'];
	$hienthi = 1;

	$sql = "INSERT INTO  table_vnexpress (noidung,ten,ngaytao,mota,hienthi) VALUES ('$noidung','$ten','$ngaytao','$mota','$hienthi')";
	mysql_query($sql);
	
?>