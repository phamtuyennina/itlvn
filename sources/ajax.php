<?php  if(!defined('_source')) die("Error");
	if(isAjaxRequest()){
	switch($_GET['act']){
		case 'update-ship':
			shipping();
			break;
		case 'add-cart':
			addCart();
			break;
		case 'update-cart':
			updateCart();
			break;
		case 'get-cart-num':
			echo get_total();
			break;
		case 'delete-cart':
			deleteCart($_POST['id']);
			break;
		case 'clear-cart':
			unset($_SESSION['cart']);
			break;

	}
	die;
	}
	die("<h2>ERROR</h2>");

function shipping(){
		$price = get_order_total();
		global $d, $row,$config;
		if($$config['phi']==1){
		$sql = "select phivanchuyen from table_place_city where id=".(int)$_POST['id']."";
		}else{
		$sql = "select phivanchuyen from table_place_dist where id=".(int)$_POST['id']."";
		}
		$d->query($sql);
		$row = $d->fetch_array();
		echo json_encode(array("ship"=>myformat($row['phivanchuyen']),"price"=>myformat($price),"all"=>myformat($price+$row['phivanchuyen']),false));
	}

function deleteCart($id){
	unset($_SESSION['cart'][$id]);
	echo json_encode(array("total"=>myformat(get_order_total()),"qty"=>get_total()));
	die;
}
function updateCart(){
	$color = (int)$_POST['color'];
	$size  = (int)$_POST['size'];
	$product = (int)$_POST['product'];
	foreach($product as $k=>$v){
		$_SESSION['cart'][$k]['qty'] = $v;
		$_SESSION['cart'][$k]['color'] = $color[$k];
		$_SESSION['cart'][$k]['size'] = $size[$k];
	}
	$tmp = array();
	foreach($_SESSION['cart'] as $k=>$v){
		md5($pid.$color.$size);
		$code = md5($v['productid'].$v['color'].$v['size']);

		if(isset($tmp[$code])){
			$tmp[$code]['qty'] = $tmp[$code]['qty']+$v['qty'];
		}else{
			$tmp[$code] = $v;
		}
	}
	$_SESSION['cart'] = $tmp;
}

function addCart(){
	$id = (int)$_POST['id'];
	$qty = (int)$_POST['qty'];
	$color = (int)$_POST['color'];
	$size = (int)$_POST['size'];
	addtocart($id,$qty,$color,$size);
	echo get_total();
}
