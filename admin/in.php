<?php
	session_start();
	error_reporting(E_ALL & ~E_NOTICE & ~8192);
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$login_name = 'SUCASHOP';
	
	$d = new database($config['database']);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/DTD/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Đơn hàng SUCASHOP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="media/css/style.css" rel="stylesheet" type="text/css" />

</head>

<style>
	@page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }

        body 
        {
            background-color:#FFFFFF; 
            border: solid 1px black ;
            margin: 0px;  /* the margin on the content before printing */
       }
</style>

<body>
<?php

	$sql = "select * from #_donhang where tinhtrang=2 order by id desc";
	$d->query($sql);
	$items=$d->result_array();
	
	$sql_company = "select * from #_hotline limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();
	
	if(isset($_REQUEST['in']))
	{
		$sql = "UPDATE table_donhang SET tinhtrang=3,ngayin='".date('d').'/'.date('m').'/'.date('Y')."',gioin='".date('h').':'.date('i')."' where tinhtrang=2";	
		mysql_query($sql);
	}
	
	
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#in').click(function(){
			$('#in').css({'display':'none'});
		});
    });
	function select_onchange()
	{	
		window.location ="in.php?in";	
		window.print();
	}
</script>


<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?>  

<input type="button" id="print_button"  value="IN ĐƠN HÀNG" onclick="this.style.display ='none'; select_onchange()" />

<div id="wrapper" style="width:97%; margin:auto;">	
<div style="clear:both;"></div>
	
    <?php for($i=0, $count=count($items); $i<$count; $i++){?>
    <?php if(($i)%3==0 or $i==0) echo '<div class="cao">'; ?>
    <div class="thongtin_donhang">
	<div class="thongtin">
        <div class="sucashop" style="position:relative;">
            <ul>
            	<li style="font-size:23px; position:absolute; right:10px; border:2px solid #000; border-radius:100%; width:40px; height:40px; line-height:40px; text-align:center;"><?=$i+1?></li>
                <li><?=$company['ten']?></li>
                <li>ĐC: <?=$company['diachi']?></li>
                <li>ĐIỆN THOẠI: <?=$company['dienthoai']?></li>
            </ul>
        </div>
        
        <div class="khachhang">
            <ul>
                <li>NHẬN: <?=$items[$i]['hoten']?>-<?=$items[$i]['madonhang']?></li>
                <li>ĐC: <?=$items[$i]['diachi']?></li>
                <li>ĐIỆN THOẠI: <?=$items[$i]['dienthoai']?></li>
            </ul>
        </div>
    </div>
    <div style="clear:both;"></div>
    
    <div class="donhang">
    	<?php
				$d->reset();
				$sql_chitietdonhang = "select * from #_chitietdonhang where hienthi=1 and madonhang='".$items[$i]['madonhang']."' order by stt,id desc";
				$d->query($sql_chitietdonhang);
				$chitietdonhang = $d->result_array();
				
				$soluongchiphi = 0;
				$tongtiendonhang = 0;
				$thongtindonhang = '';
				for($j=1, $count_chitietdonhang = count($chitietdonhang); $j<=$count_chitietdonhang; $j++){
					$soluongchiphi += $chitietdonhang[$j-1]['soluong'];
					$tongtiendonhang = $tongtiendonhang + ($chitietdonhang[$j-1]['gia']*$chitietdonhang[$j-1]['soluong']);
					
					$thongtindonhang .= $j.'. '.$chitietdonhang[$j-1]['ten'].'('.$chitietdonhang[$j-1]['size'].')'.' x '.$chitietdonhang[$j-1]['soluong'].' cái = '.number_format($chitietdonhang[$j-1]['soluong']*$chitietdonhang[$j-1]['gia'],0, ',', '.').' vnđ';
					if($j < $count_chitietdonhang)
					{
						$thongtindonhang .= ' </br> ';
					}
				}
				
				$sql_phivanchuyen="select phivanchuyen,id_item from #_thanhpho where id='".$items[$i]['quan']."' limit 0,1";
				$d->query($sql_phivanchuyen);
				$phivanchuyen=$d->fetch_array();

				echo $thongtindonhang;
			?>
            </br>
            Tổng tiền sản phẩm: <?=number_format($tongtiendonhang,0, ',', '.')?>&nbsp;vnđ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phí vận chuyển: 
            
             <?php
				if($phivanchuyen['id_item']!=6)
				{
			?>
				<?=number_format($items[$i]['phithem'] + $phivanchuyen['phivanchuyen'] + ($soluongchiphi*5000-5000),0, ',', '.').'&nbsp;vnđ';?>
			<?php } else { ?>
				<?=number_format($items[$i]['phithem'] + $phivanchuyen['phivanchuyen'],0, ',', '.')?>&nbsp;vnđ
			<?php } ?>

            
    </div>
    
    <div class="trian">
    	<ul>
        	<?php
				$d->reset();
				$sql_hinhthucgiaohang = "select ten from #_hinhthucgiaohang where id='".$items[$i]['htgh']."' limit 0,1";
				$d->query($sql_hinhthucgiaohang);
				$hinhthucgiaohang = $d->fetch_array();
			?>
        	<li>+ Ngày giao hàng: <?=date('d/m/Y', time())?> <b>(<?=$hinhthucgiaohang['ten']?>)</b></li>
    		<li>+ Khách hàng yên tâm nhận hàng, <b>Sucashop.com</b> hỗ trợ khách hàng đổi sang sản phẩm khác nếu không vừa ý.</li>
        	<li>+ Yêu cầu <b>BƯU ĐIỆN: </b>Nếu không phát được vui lòng liên lạc người gửi, không được tự ý chuyển hoàn.</li>
        </ul>
    </div>
    
    <div class="tongtien">
    	<h4>TỔNG TIỀN THU HỘ (COD): 
        <?php
				if($phivanchuyen['id_item']!=6)
				{
			?>
				<?=number_format($items[$i]['phithem'] + $tongtiendonhang + $phivanchuyen['phivanchuyen'] + ($soluongchiphi*5000-5000),0, ',', '.')?>&nbsp;vnđ
			<?php } else { ?>              
                <?=number_format($items[$i]['phithem'] + $tongtiendonhang  + $phivanchuyen['phivanchuyen'],0, ',', '.')?>&nbsp;vnđ
			<?php } ?>


		
        </h4>
        <div class="mavach">
        	<?php $imge="http://".$config_url."/admin/Barcode39/bar.php?text=".$items[$i]['madonhang']."";?>
            <div style="float:left;"><img src="<?=$imge?>" /></div>
        </div>
        <div style="clear:both;"></div>
    </div>
   
    </div>
    <?php if(($i-2)%3==0) echo '</div>'; ?>
    <?php } ?>  
</div>
<?php } ?>   

</body>
</html>
