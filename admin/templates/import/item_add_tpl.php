<script>
	$(document).ready(function(e) {
		$('#ok').click(function(){
			$('#load').css({visibility: "visible"});
		});    
    });
</script>
<?php
if(isset($_POST['ok'])){
		
		$sqlDelete = "Delete from table_import2";
		mysql_query($sqlDelete);
		
		$file_type=$_FILES['linkfile']['type'];
		
		if($file_type=="application/vnd.ms-excel" || $file_type=="application/x-ms-excel")
		{			
				$filename=$_FILES["linkfile"]["name"];
				
				move_uploaded_file($_FILES["linkfile"]["tmp_name"],$filename);
					
		
//include the following 2 files
require 'PHPExcel.php';
require_once 'PHPExcel/IOFactory.php';

$objPHPExcel = PHPExcel_IOFactory::load($filename);
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
$worksheetTitle = $worksheet->getTitle();
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

$nrColumns = ord($highestColumn) - 64;


for ($row = 1; $row <= $highestRow; ++ $row) {
		
		
		$cell = $worksheet->getCellByColumnAndRow(0, $row);
		$madonhang_ten = $cell->getValue();	
		$madonhang_ten2 = explode('-',$madonhang_ten);
		$madonhang = trim($madonhang_ten2[0]);
		$ten = trim($madonhang_ten2[1]);
		
		$cell = $worksheet->getCellByColumnAndRow(1, $row);
		$sotien = $cell->getValue();
		

		$d->reset();
		$sql_chitietdonhang = "select gia,soluong from #_chitietdonhang where madonhang='".$madonhang."' order by stt,id desc";
		$d->query($sql_chitietdonhang);
		$chitietdonhang = $d->result_array();
		$tongtiendonhang = 0;
		$soluongchiphi = 0;

		for($j=0, $count_chitietdonhang=count($chitietdonhang); $j<$count_chitietdonhang; $j++)
		{			
			$tongtiendonhang = $tongtiendonhang + ($chitietdonhang[$j]['gia']*$chitietdonhang[$j]['soluong']);
			$soluongchiphi += $chitietdonhang[$j]['soluong'];
		}
								
		
		$d->reset();
		$sql_ktra_madonhang="select madonhang,quan,thanhpho,phithem from table_donhang where madonhang='".$madonhang."'";
		$d->query($sql_ktra_madonhang);
		$ktra_madonhang=$d->result_array();
		
		$d->reset();
		$sql_phivanchuyen="select phivanchuyen,id_item from #_thanhpho where id='".$ktra_madonhang[0]['quan']."'limit 0,1";
		$d->query($sql_phivanchuyen);
		$phivanchuyen=$d->fetch_array();
   
		if($phivanchuyen['id_item']!=6)
		{	
	     	$sotiendung = $tongtiendonhang + $phivanchuyen['phivanchuyen'] + ($soluongchiphi*5000-5000)+$ktra_madonhang[0]['phithem'];
			
		} 
		else 
		{
			$sotiendung = $tongtiendonhang + $phivanchuyen['phivanchuyen']+$ktra_madonhang[0]['phithem'];
		}
			
		if(count($ktra_madonhang)!=0 and $sotien==$sotiendung)
		{
			$sql_lanxem = "UPDATE #_donhang SET tinhtrang=5,thuve='$sotien' WHERE madonhang ='".$madonhang."'";
			$d->query($sql_lanxem);
		}
		else
		{
			$sql_lanxem = "UPDATE #_donhang SET tinhtrang=6,thuve='$sotien' WHERE madonhang ='".$madonhang."'";
			$d->query($sql_lanxem);
			
			if($madonhang_ten!='')
			{			
				$sqlUpdate = "Insert into table_import2(madonhang,ten,sotien) values('$madonhang','$ten','$sotien')";
				if(!mysql_query($sqlUpdate)){ echo "Update lỗi".'<br/>';}
			}
		}
		}
		
}
echo "<b>Import thành công!</b>";
unlink($filename) or DIE("couldn't delete $dir$file<br />");
}else
		{
	?>
	<script language="javascript">
		alert("Không hỗ trợ kiểu file này");
	</script>
	<?php
	}
}
?>



<h3>Import bảng giá <span id="load" style="visibility: hidden;"><img border="0" src="media/images/ajax-loader.gif" align="absmiddle"></span> </h3>
<form name="form1" id="from1" action="" method="post" enctype="multipart/form-data" class="nhaplieu">
	
    <b>File: </b><input type="file" name="linkfile"  size="25" maxlength="255"  /> <strong>Loại : .xls (Ms.Excel 2003)</strong><br />
     <input type="submit" name="ok" id="ok" value="Upload" style="margin-left: 125px; margin-top: 10px;"/><br />
    
    
    <h2 style="margin:10px 0px;">Định dạng mẫu bảng exel <a href="index.php?com=import2&act=man" style="color:red; font-weight:bold; margin-left:94px; font-size:15px;">Kiểm tra</a></h2>
     <table id="chitiet" style="width:40%;" style="text-align:left;" class="blue_table">
     	<tr>                 	
            <th width="50%">Mã đơn hàng - Tên khách hàng</th>
            <th width="50%">Giá thu về</th>
            
        </tr>
    	<tr>                 	
            <td width="50%">12122014SC100-Châu Vũ Phương</td>
            <td width="50%">1500000</td>
            
        </tr>
        <tr>                 	
            <td width="50%">12122014SC101-Nguyễn Thị Mỹ Hạnh</td>
            <td width="50%">1500000</td>
        </tr>
        <tr>                 	
            <td width="50%">12122014SC102-Nguyễn Thị Kim Chi</td>
            <td width="50%">1500000</td>
        </tr>
        <tr>                 	
            <td width="50%">12122014SC103-Trần Tuấn Anh</td>
            <td width="50%">1500000</td>
        </tr>
        <tr>                 	
            <td width="50%">12122014SC104-Vũ Mạnh CƯờng</td>
            <td width="50%">300000</td>
        </tr>
    </table>
</form>