<?php
	session_start();
	$session=session_id();
	@define ( '_lib' , '../lib/');
	include_once _lib."config.php";
	include_once _lib."AntiSQLInjection.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	$d = new database($config['database']);
	include_once _lib."nina_firewall.php";
	$login_name = 'NINACO';
	if(checkPermission()==false){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}
?>
