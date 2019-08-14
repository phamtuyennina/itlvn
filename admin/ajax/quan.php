<?php
include ("ajax_config.php");

if(checkPermission()==false){
	header('Content-Type: text/html; charset=utf-8');
	die("Bạn Không có quyền vào đây !");
}


	$id = $_REQUEST['id'];
	$mdh = $_REQUEST['mdh'];


	$d->reset();
	$sql_phivanchuyen="select phivanchuyen from #_place_dist where id='$id' order by stt,id desc";
	$d->query($sql_phivanchuyen);
	$phivanchuyen=$d->fetch_array();

	$return['phiship']=number_format($phivanchuyen['phivanchuyen'],0, ',', '.').'&nbsp;vnđ';
	$return['phiship2']=$phivanchuyen['phivanchuyen'];

	$d->reset();
	$sql="select tonggia from table_donhang where madonhang='".$mdh."'";
	$d->query($sql);
	$tonggia1=$d->fetch_array();
	$tt=$tonggia1['tonggia'];

	$tong=$tonggia1['tonggia']+$phivanchuyen['phiship'];

	$return['tonggia']=number_format($tong,0, ',', '.').' vnđ';
	$return['tonggia2']=$tong;

	echo json_encode($return);
?>
