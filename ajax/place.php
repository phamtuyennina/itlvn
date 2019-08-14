<?php
	include ("ajax_config.php");
	
	$act = magic_quote(trim(strip_tags($_POST['act'])));
	
	switch($act){
		case "dist":
			load_dist();
			break;
		default:
			break;
	}

function load_dist()
{
	$id_city = intval($_POST['id_city']);	
	$sql="select id,ten from table_place_dist where id_city='".$id_city."' and hienthi=1 order by stt,id desc";		
	$stmt = mysql_query($sql);
	$str='<option value="">'._chonquanhuyen.'</option>';
	while ($row=@mysql_fetch_array($stmt)) 
	{
		$str.='<option value='.$row["id"].'>'.$row["ten"].'</option>';			
	}
	echo $str;
}
?>   
