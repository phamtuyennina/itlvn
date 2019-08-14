<?php
include ("ajax_config.php");

if(checkPermission()==false){
	header('Content-Type: text/html; charset=utf-8');
	die("Bạn Không có quyền vào đây !");
}

	$id_cat=$_POST['id_cat'];
	$id_item=$_POST['id_item'];

	if(!is_array($id_cat)){
		$id_cat = json_decode($id_cat);
	}

	if(!is_array($id_item)){
		$id_item = json_decode($id_item);
	}


	$where .= " hienthi=1 ";
	if(count($id_cat)>0){
		if(in_array('all',$id_cat)){
		} else {
			$where .= "  and ( id_cat=".$id_cat[0];
			for($i=1;$i<count($id_cat);$i++){
				$where .= " or id_cat=".$id_cat[$i];
			}
			$where .= " ) ";
		}
	}

	$d->reset();
    $sql = "select id,ten from #_product_item where $where order by id desc";
    $d->query($sql);
    $row_item = $d->result_array();

?>
<?php for($i=0;$i<count($row_item);$i++){ ?>
<option value="<?=$row_item[$i]['id']?>"<?php if($id_item!=''){if(in_array($row_item[$i]['id'],$id_item)){?> selected="selected"<?php } } ?>> - <?=$row_item[$i]['ten']?></option>
<?php } ?>
