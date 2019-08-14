<?php
include ("ajax_config.php");

if(checkPermission()==false){
	header('Content-Type: text/html; charset=utf-8');
	die("Bạn Không có quyền vào đây !");
}


	if (isset($_POST["level"])) {
		 $level = $_POST["level"];
		 $table = $_POST["table"];
		$id=$_POST["id"];
		 $type = $_POST["type"];
		switch ($level) {
			case '0':{
				$id_temp= "id_list";
				break;
			}
			case '1':{
				$id_temp= "id_cat";
				break;
			}
			case '2':{
				$id_temp= "id_item";
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}

		echo $sql="select * from ".$table." where $id_temp=".$id." and type='".$type."'  order by stt ";
		$stmt=mysql_query($sql);
		$str='
			<option>Chọn danh mục</option>
			';
		while ($row=@mysql_fetch_array($stmt))
		{
			if($row["id"]==(int)@$id_select)
				$selected="selected";
			else
				$selected="";

			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';
		}
		echo  $str;


	}
?>
