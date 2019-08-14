<?php
	include ("ajax_config.php");

	$id = (int)$_REQUEST['id'];	

	$d->reset();
	$sql_quan="select id,ten from #_place_dist where hienthi=1 and id_city='$id' order by stt,id asc";
	$d->query($sql_quan);
	$quan=$d->result_array();

?>
	<option value=""><?=_quanhuyen?></option>
<?php for($i = 0, $count_quan = count($quan); $i < $count_quan; $i++){ ?>
    <option value="<?=$quan[$i]['id']?>"><?=$quan[$i]['ten']?></option>
<?php } ?>
