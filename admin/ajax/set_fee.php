<?php
	include ("ajax_config.php");

	if(checkPermission()==false){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}

	$cmd=$_POST['cmd'];
	$getlist=$_POST['listid'];
	$shipping_fee=(int)$_POST['shipping_fee'];
	global $config;
	if($cmd=='set_filter'){
		$listid = explode(",",$getlist);
	}else if($cmd=='set_all'){
		$d->reset();
		if($config['phi']==1){
			$sql = "select id from table_place_city";
		}
		elseif($config['phi']==2){$sql = "select id from table_place_dist";}
		$d->query($sql);
		$items = $d->result_array();
		$listid =array();
		foreach ($items as $key => $value) {
			$listid[$key]=$value['id'];
		}
	}

	for ($i=0 ; $i<count($listid) ; $i++){
		$d->reset();
		if($config['phi']==1){
			$sql = "update table_place_city SET phivanchuyen='".$shipping_fee."' where id='".$listid[$i]."'";
		}elseif($config['phi']==2){
			$sql = "update table_place_dist SET phivanchuyen='".$shipping_fee."' where id='".$listid[$i]."'";
		}
		$d->query($sql);
	}
	echo 1;
?>
