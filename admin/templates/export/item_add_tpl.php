<?php
	/*
	include("excelwriter.inc.php");	
	$excel=new ExcelWriter('dstour.xls','utf-8');	
	if($excel==false)	
		echo $excel->error;
	$myArr=array("<b>maso</b>","<b>tieude</b>","<b>giaban</b>");
	$excel->writeLine($myArr);
	$conn = mysql_connect("localhost","root","root");
			mysql_select_db("thienminhphu",$conn);
			mysql_query("SET NAMES 'utf8'");
	$sql="SELECT * FROM table_product order by stt,maso desc";
	$sqlhs=mysql_query($sql) or die(mysql_error());
	while($rows=mysql_fetch_assoc($sqlhs)) {
		$myArr=array($rows['maso'],$rows['ten'],$rows['giaban']);
		$excel->writeLine($myArr);
	}

	$excel->close();
	echo "<a href='dstour.xls'>Download bang gia</a>";
	*/
?>

 <link href="multiselect/css/multi-select.css" media="screen" rel="stylesheet" type="text/css"> 
 <script src="multiselect/jquery.js" type="text/javascript"></script>
 <script src="multiselect/jquery-ui.js" type="text/javascript"></script>
 	
    <h3>Xuất danh sách thành viên</h3>   
<form name="frm" method="post" action="index.php?com=export&act=save&curPage=<?=$_REQUEST['curPage']?>" enctype="multipart/form-data" class="nhaplieu">

    <script src="multiselect/js/jquery.multi-select.js" type="text/javascript"></script>
     <script type="text/javascript">
	 	$('#my-select').multiSelect({
			selectableOptgroup: true,
			selectableHeader: "<div class='custom-header'>Chọn danh mục</div>",
			selectionHeader: "<div class='custom-header'>Danh mục đã chọn</div>"		 
	 });</script>
     <input type="submit" value="Xuất" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=export&act=man'" class="btn" />
</form>
    