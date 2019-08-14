
<?php if ($_REQUEST['act']=='edit') { ?> <h3>Sửa sản phẩm trong đơn hàng</h3> <?php }else{ ?><h3>Thêm sản phẩm vào đơn hàng</h3><?php } ?>
<form name="frm" method="post" action="index.php?com=chitietdonhang&act=save&id_donhang=<?=$_GET['id_donhang']?>&thanhpho_item=<?=$_GET['thanhpho_item']?>&thanhpho=<?=$_GET['thanhpho']?>" enctype="multipart/form-data" class="nhaplieu">
    
    <?php if($act=='edit') { ?> 
    <b>Mã đơn hàng</b> <input type="text" name="madonhang" value="<?=@$item['madonhang']?>" class="input" /><br /><br />
    <?php }else { ?>
    <b>Mã đơn hàng</b> <input type="text" name="madonhang" value="<?=$_GET['madonhang']?>" class="input" /><br /><br />
    <?php } ?>
    
	<b>Tên sản phẩm</b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /><br />
    
    <b>Size</b> <input type="text" name="size" value="<?=@$item['size']?>" class="input" /><br /><br />
    
    <b>Giá</b> <input type="text" name="gia" value="<?=@$item['gia']?>" class="input" /><br /><br />
    
    <b>Số lượng</b> <input type="text" name="soluong" value="<?=@$item['soluong']?>" class="input" /><br /><br />
    
    <!--<b>Tổng giá</b> <input type="text" name="tonggia" value="<?=@$item['tonggia']?>" class="input" /><br /><br />
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br><br/>  -->     
	<b>Hiển thị</b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
		
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="Lưu" class="btn" />
	<input type="button" value="Thoát" onclick="javascript:window.location='index.php?com=chitietdonhang&act=man'" class="btn" />
</form>