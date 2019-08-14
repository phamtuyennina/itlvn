<?php
session_start();
@define('_source', '../sources/');
@define('_lib', '../lib/');
error_reporting(0);
include_once _lib . "config.php";
include_once _lib . "constant.php";
include_once _lib . "functions.php";
include_once _lib . "library.php";
include_once _lib . "class.database.php";
$d = new database($config['database']);
$id = $_REQUEST['id'];
?>
<select id="<?=$id?>" name="<?=$id?>" data-placeholder="Chọn danh mục" class="main_select select_danhmuc chzn-select">
	<option></option>	
</select>