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
	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
    $id_l = (isset($_REQUEST['id_list'])) ? addslashes($_REQUEST['id_list']) : "";
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	
	$d = new database($config['database']);
	
	$id_donhang=$_GET['id'];
	settype($id,'int');
	
	$d->reset();
	$sql="select * from #_donhang where id='$id_donhang'";
	$d->query($sql);
	$result_giohang=$d->fetch_array();
	

	
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
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A1:E1' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A3:C3' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A4:C4' );
$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A5:C5' );


$objPHPExcel->getActiveSheet()->getRowDimension( '1' )->setRowHeight( 42 );

$objPHPExcel->getActiveSheet()->getStyle( 'A1' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '000000' ),'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 16 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getColumnDimension( 'A' )->setWidth( 5 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'B' )->setWidth( 30 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'C' )->setWidth( 10 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'D' )->setWidth( 17 );
$objPHPExcel->getActiveSheet()->getColumnDimension( 'E' )->setWidth( 23 );

$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
      
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A1','THÔNG TIN ĐƠN HÀNG' );

	
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A3','Họ tên: '.$result_giohang['hoten'] );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A4','Điện thoại: '.$result_giohang['dienthoai'] );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A5','Địa chỉ: '.$result_giohang['diachi'] );

$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'D3','Mã đơn hàng:' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'D4','Ngày đặt:' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'D5','Tình trạng:' );

$madonhang=$result_giohang['madonhang'];

	

$objPHPExcel->getActiveSheet()
    ->setCellValueExplicit('E3', $madonhang, PHPExcel_Cell_DataType::TYPE_STRING);
	
	
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'E4',date('H:i d-m-Y',$result_giohang['ngaytao']));

$sql="select trangthai from #_tinhtrang where id= '".$result_giohang['trangthai']."' ";
$d->query($sql);
$result=$d->fetch_array();
$trangthai= $result['trangthai'];

$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'E5',$trangthai );


$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A7','STT' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'B7','Sản phẩm' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'C7','Số lượng' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'D7','Đơn giá' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'E7','Thành tiên' );

$objPHPExcel->getActiveSheet()->getStyle('A7:E7')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()->getStyle( 'A7:E7' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '000000' ), 'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 11 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true )));

$objPHPExcel->getActiveSheet()->getStyle( 'B7' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '000000' ), 'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 11 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true )));


$d->reset();
$sql="select * from #_chitietdonhang where id_donhang = '$id_donhang'";
$d->query($sql);
$items=$d->result_array();

$vitri=8;
for($i=0,$count=count($items);$i<$count;$i++) { 

$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( 'A'.$vitri, $i+1 )->setCellValue( 'B'.$vitri,$items[$i]['ten'] )->setCellValue( 'C'.$vitri, $items[$i]['soluong'])->setCellValue( 'D'.$vitri, number_format($items[$i]['gia'],0,",",".") )->setCellValue( 'E'.$vitri, number_format($items[$i]['gia']*$items[$i]['soluong'],0,",",".") );

$objPHPExcel->getActiveSheet()->getStyle( 'A'.$vitri.':E'.$vitri )->applyFromArray( array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getStyle( 'B'.$vitri )->applyFromArray( array( 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ) ) );

$objPHPExcel->getActiveSheet()->getStyle('A'.$vitri.':E'.$vitri)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$vitri++;	
}

$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A'.$vitri.':D'.$vitri );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A'.$vitri,'Tổng tiền' );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'E'.$vitri,number_format($result_giohang['tonggia'],0, ',', '.'));
$objPHPExcel->getActiveSheet()->getStyle( 'A'.$vitri.':E'.$vitri )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '000000' ), 'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 11 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true )));

	// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Thông tin đơn hàng');

		
// Save Excel 2007 file
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));

//Redirect output to a client’s web browser (Excel5)
      header( 'Content-Type: application/vnd.ms-excel' );
      header( 'Content-Disposition: attachment;filename="don-hang-'.$result_giohang['madonhang'].'-'.date('dmY').'.xls"' );
      header( 'Cache-Control: max-age=0' );

      $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
      $objWriter->save( 'php://output' );	
?>