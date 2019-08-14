<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');
	
	
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."pclzip.php";
	include_once _lib."class.database.php";	
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$login_name = 'NINACO';
	$d = new database($config['database']);
	
	$act = array();
	$id = $_POST['id'];	
	$com = $_POST['com'];	
	$act_cap = $_POST['act_cap'];
	$act[] = $_POST['man'];
	$act[] = $_POST['add'];
	$act[] = $_POST['edit'];
	$act[] = $_POST['delete2'];
	$type = $_POST['type'];
	if($_POST['add']!='' or $_POST['edit']!=''){
		if($act_cap==''){
			$act[] = 'save';
		}else{
			$act[] = str_replace("man","save",$act_cap);
		}
		
	}
	
	//Xử lý mảng act	
	$act = array_unique($act);
	//$key = array_search('', $act);
	//unset($act[$key]);
	$chuoi_act = implode(',',$act);
	
	//dump($act);
	
	if($com!='' && $id>0)
	{
		$d->reset();
		$sql = "select id from #_com_quyen where id_quyen='".$id."' and com='".$com."' and act_cap='".$act_cap."' and type='".$type."'";
		
		$d->query($sql);
		$check_quyen = $d->fetch_array();
		
		if(empty($check_quyen))
		{
			$d->reset();
			$data['id_quyen'] = $id;
			$data['com'] = $com;
			$data['type'] = $type;
			$data['act_cap'] = $act_cap;
			$data['act'] = $chuoi_act;
			$data['ngaytao'] = time();
		
			$d->setTable('com_quyen');
			if($d->insert($data))	
			{
				$return['thongbao'] = 1;
			}
		}
		else
		{
			$d->reset();
			$data['id_quyen'] = $id;
			$data['com'] = $com;
			$data['type'] = $type;
			$data['act_cap'] = $act_cap;
			$data['act'] = $chuoi_act;
			$data['ngaysua'] = time();
			
			//dump($check_quyen['id']);
			$d->setTable('com_quyen');
			$d->setWhere('id', $check_quyen['id']);
			
			if($d->update($data))	
			{
				$return['thongbao'] = 1;
			}	
		}
		echo json_encode($return);
	}

?>