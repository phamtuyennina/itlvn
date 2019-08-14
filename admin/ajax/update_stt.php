<?php
include ("ajax_config.php");

if(checkPermission()==false){
	header('Content-Type: text/html; charset=utf-8');
	die("Bạn Không có quyền vào đây !");
}
		$table = $_POST['table'];
		$id = $_POST['id'];
		$value = $_POST['value'];

		$data['stt'] = $value;
		$d->setTable($table);
		$d->setWhere('id', $id);
		$d->update($data);
?>
