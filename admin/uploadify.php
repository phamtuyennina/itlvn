<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";
	
	$d = new database($config['database']);
	function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
	
	$table = $_POST['table'];
	$id_multi = (int)$_POST['id_multi'];
	$type = $_POST['type'];
	$url = $_POST['url'];
	$width = (int)$_POST['width'];
	$height = (int)$_POST['height'];

	if (!empty($_FILES)) 
	{
		global $d;	
		$file_name = $_FILES['Filedata']['name'];
		
		if($photo = upload_image("Filedata", _format_duoihinh, $url,$file_name))
		{
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], $width, $height, $url,$file_name,2);
			$data['id_multi'] = $id_multi;
			$data['type'] = $type;
			$data['stt'] = '1';
			$data['hienthi'] = '1';
	
			$d->setTable($table);
			$d->insert($data);
		}
	}
?>