<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){	
	case "man":		
		$template = "export/item_add";
		break;
	case "save":
		save();
		break;
	default:
		$template = "index";
}
#====================================
function save(){
	global $d;	
	
	$id_cat = $_POST['my-select'];
	if($id_cat!=''){
		$array_idcat=implode(",",$id_cat);	
		$dk_idcat = "where id IN ($array_idcat)";
	}
	
	// Bat dau export excel
	/** PHPExcel */
include 'PHPExcel.php';
/** PHPExcel_Writer_Excel */
include 'PHPExcel/Writer/Excel5.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A1:K1' );
$objPHPExcel->getActiveSheet()->getRowDimension( '1' )->setRowHeight( 42 );
$objPHPExcel->getActiveSheet()->getStyle( 'A1' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ff8602' ),'name' => 'Tahoma', 'bold' => true, 'italic' => false, 'size' => 18 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getColumnDimension( 'A' )->setWidth( 8 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'B' )->setWidth( 20 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'C' )->setWidth( 12 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'D' )->setWidth( 25 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'E' )->setWidth( 20 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'F' )->setWidth( 22 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'G' )->setWidth( 35 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'H' )->setWidth( 15 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'I' )->setWidth( 12 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'J' )->setWidth( 15 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'K' )->setWidth( 12 );
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);
   
$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A1', 'DANH SÁCH ĐƠN HÀNG '.date('d/m/Y', time()));
$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A2', 'STT' )->setCellValue( 'B2', 'Tên người nhận' )->setCellValue( 'C2', 'Điện thoại' )->setCellValue( 'D2', 'Địa chỉ' )->setCellValue( 'E2', 'Quận/Huyện' )->setCellValue( 'F2', 'Tỉnh/Thành phố' )->setCellValue( 'G2', 'Đơn hàng' )->setCellValue( 'H2', 'Phí v.chuyển' )->setCellValue( 'I2', 'Tổng giá' )->setCellValue( 'J2', 'Mã đơn hàng' )->setCellValue( 'K2', 'Ngày đi' );


 $objPHPExcel->getActiveSheet()->getStyle( 'A2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
 
   $objPHPExcel->getActiveSheet()->getStyle( 'B2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
   
   $objPHPExcel->getActiveSheet()->getStyle( 'C2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
   
    $objPHPExcel->getActiveSheet()->getStyle( 'D2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
	
	$objPHPExcel->getActiveSheet()->getStyle( 'E2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
	
	$objPHPExcel->getActiveSheet()->getStyle( 'F2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
	
	$objPHPExcel->getActiveSheet()->getStyle( 'G2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
		
	$objPHPExcel->getActiveSheet()->getStyle( 'H2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
	
	$objPHPExcel->getActiveSheet()->getStyle( 'I2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
	
	$objPHPExcel->getActiveSheet()->getStyle( 'J2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
	
	$objPHPExcel->getActiveSheet()->getStyle( 'K2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'ffffff' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'ff8602'))));
	

	//End
	$vitri = 3;	
	$sql = "select * from #_donhang where export=1";
	if (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		$sql.=" and (";
		for ($k=0 ; $k<count($listid) ; $k++)
		{
			$idTin=$listid[$k]; 
			$id =  themdau($idTin);	
			$sql.=" (id=".$id.")";
			if($k+1 < count($listid))
			{
				$sql.=" or ";
			}	
			else
			{
				$sql.=")";
			}		
		} 
	}	
	
	if((int)$_REQUEST['tinhtrang']!='')
	{
		$sql.=" and tinhtrang=".(int)$_REQUEST['tinhtrang']."";
	}
	if($_REQUEST['hinhthucgiaohang']!='' and $_REQUEST['hinhthucgiaohang']!=0)
	{
		$sql.=" and htgh=".(int)$_REQUEST['hinhthucgiaohang']."";
	}
	if($_REQUEST['ngaytao']!='')
	{
		$sql.=" and ngaytao='".$_REQUEST['ngaytao']."'";
	}	
	if($_REQUEST['ngayin']!='')
	{
		$sql.=" and ngayin='".$_REQUEST['ngayin']."'";
	}
	if($_REQUEST['ngaydi']!='')
	{
		$sql.=" and ngaydi='".$_REQUEST['ngaydi']."'";
	}	
	$sql.=" order by id desc";	
	
	$d->query($sql);
	$donhang = $d->result_array();	
	for($i = 0, $count_donhang = count($donhang); $i < $count_donhang; $i ++) { 
		
		//Xử lý các bảng liên kết của đơn hàng
		$sql = "SELECT ten,phivanchuyen,id_item FROM table_thanhpho where id='".$donhang[$i]['quan']."' limit 0,1";
		$d->query($sql);
		$quan = $d->fetch_array();
		
	
		
		
		
		$sql = "SELECT ten FROM table_thanhpho_item where id='".$donhang[$i]['thanhpho']."' limit 0,1";
		$d->query($sql);
		$thanhpho = $d->fetch_array();
		
		$sql = "SELECT * FROM table_chitietdonhang where madonhang='".$donhang[$i]['madonhang']."' order by id desc";
		$d->query($sql);
		$chitietdonhang = $d->result_array();
		
		$thongtindonhang = '';
		$tonggia = 0;
		$soluongchiphi = 0;
		for($j = 0, $count_chitietdonhang = count($chitietdonhang); $j < $count_chitietdonhang; $j ++)
		{
			$thongtindonhang .= $chitietdonhang[$j]['ten'].'('.$chitietdonhang[$j]['size'].')'.' x '.$chitietdonhang[$j]['soluong'].' = '.number_format($chitietdonhang[$j]['soluong']*$chitietdonhang[$j]['gia'],0, ',', '.');
			if($j+1 < $count_chitietdonhang)
			{
				$thongtindonhang .= ' + ';
			}
			$tonggia +=  $chitietdonhang[$j]['soluong'] * $chitietdonhang[$j]['gia'];
			$tonggia3 +=  $chitietdonhang[$j]['soluong'] * $chitietdonhang[$j]['gia'];
			$soluongchiphi += $chitietdonhang[$j]['soluong'];
		}
		
		$tonggia += $quan['phivanchuyen']; 
		
		if($quan['id_item']!=6)
		{
			$phivanchuyen5 = $donhang[$i]['phithem'] + $quan['phivanchuyen'] + ($soluongchiphi*5000-5000);					
			$tonggia5 = $donhang[$i]['phithem'] + $tonggia + ($soluongchiphi*5000-5000);			
		} 
		else 
		{
			$phivanchuyen5 = $donhang[$i]['phithem'] + $quan['phivanchuyen'];			
			$tonggia5 = $donhang[$i]['phithem'] + $tonggia;		
		}

	$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A'.$vitri,$i+1 )->setCellValue( 'B'.$vitri,$donhang[$i]['madonhang'].'-'.$donhang[$i]['hoten'])->setCellValue( 'C'.$vitri, $donhang[$i]['dienthoai'])->setCellValue( 'D'.$vitri, $donhang[$i]['diachi'] )->setCellValue( 'E'.$vitri, $quan['ten'] )->setCellValue( 'F'.$vitri, $thanhpho['ten'])
	->setCellValue( 'G'.$vitri,$thongtindonhang)->setCellValue( 'H'.$vitri,$phivanchuyen5)->setCellValue( 'I'.$vitri, $tonggia5)->setCellValue( 'J'.$vitri, $donhang[$i]['madonhang'] )->setCellValue( 'K'.$vitri, $donhang[$i]['ngaydi'] );
		
		$objPHPExcel->getActiveSheet()->getStyle( 'D'.$vitri )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '990000' )), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );
		$objPHPExcel->getActiveSheet()->getStyle('D'.$vitri)->getNumberFormat()->setFormatCode("#,##0 _€");
	$vitri++;	
	}

	
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('SucaShop');

		
// Save Excel 2007 file
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));

//Redirect output to a client’s web browser (Excel5)
      header( 'Content-Type: application/vnd.ms-excel' );
      header( 'Content-Disposition: attachment;filename="SucaShop_'.date('dmY').'.xls"' );
      header( 'Cache-Control: max-age=0' );

      $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
      $objWriter->save( 'php://output' );		
	
}
?>
