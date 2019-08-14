<?php
if(!isAjaxRequest()){
	echo '<link href="css/cart.css" type="text/css" rel="stylesheet" />';

if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
	else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=intval($_REQUEST['product'.$pid]);
			if($q>0 && $q<=99999){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 99999';
			}
		}
	}
?>

<div class="wapper">
<div class="row">
<div class="col-md-6 col-sm-12 col-xs-12">
<div class="shop">
<div class=""><p class="title_foot">Giỏ hàng</p><span></span></div>
<div class="box_containerlienhe">
	<div class="content" id="box-shopcart" style="width:100%">
    <?php }?>
			<form name="form1" method="post" onsubmit="return false;">
				 <table id="giohang" class="table table-bordered " style="margin-top:10px;background:rgba(239, 239, 239, 0.47);">
    	   <?php
			if(is_array($_SESSION['cart'])){
            	echo '<thead style="background:rgba(239, 239, 239, 0.47);"><th align="center" class="hidden-xs"></th><th>'._pname.'</th><th align="center">'._price.'</th><th align="center">'._quantity.'</th><th align="center" class="hidden-xs">'._total_price.'</th><th align="center">'._congcu.'</th></thead>';
				foreach($_SESSION['cart'] as $k=>$v){
					$pid=$v['productid'];
					$code  =$k;
					$color = $v['color'];
                    $size = $v['size'];
					$q=$v['qty'];
					$pmasp=get_code($pid);
					$pname=get_product_name($pid,$lang);
					 $info=getProductInfo($pid);
					 //dump($info);
					$image = _upload_sanpham_l.$info['photo'];
					if($q==0) continue;
			?>
            <tr><td width="10%" align="center" class="hidden-xs"><a target="_blank"  href="san-pham/<?= $info['tenkhongdau'] ?>-<?= $info['id'] ?>.html"><img src="timthumb.php?src=<?= $image ?>&w=300&h=300&zc=2&q=100" class='img-responsive' /></a></td>
           <td width="20%"><a class="name" target="_blank" href="san-pham/<?= $info['tenkhongdau'] ?>-<?= $info['id'] ?>.html"><?= $pname ?></a>
           <?php
			if ($color) {
				$colors = getColorByProductId($pid);
				echo '<div class="product-option"><label>'._mausac.': </label>&nbsp;';
				echo '<select onchange="updateCart();" name="color[' . $code . ']">';
				foreach ($colors as $k2 => $v2) {
					echo '<option '.(($v2['id_color'] == $color) ? 'selected' : '').' value="' . $v2['id_color'] . '">' . $v2['ten'] . '</option>';
				}
				echo '</select>';

				echo '<div class="clear"></div></div>';
			}
			if ($size) {
				$sizes = getSizeByProductId($pid);
				echo '<div class="product-option"><label>'.Size.': </label>&nbsp;';
				echo '<select onchange="updateCart();" name="size[' . $code . ']">';
				foreach ($sizes as $k2 => $v2) {
					echo '<option '.(($v2['id_size'] == $size) ? 'selected' : '').' value="' . $v2['id_size'] . '">' . $v2['ten'] . '</option>';
				}
				echo '</select>';

				echo '<div class="clear"></div></div>';
			}
			?>

           </td>
            <td width="10%" align="center">
                            <?php
                            if ($info['giakm'] > 0) {
                                echo '<div class="price-old">' . number_format($info['gia'],0, ',', '.').'</div>';
								 echo '<div class="price-real">' .number_format($info['giakm'],0, ',', '.').' </div>';
                            }else{
                            echo '<div class="price-real">' .number_format($info['gia'],0, ',', '.').'</div>';
							}
                            ?>
           </td>
           <td width="10%" align="center"><input onchange="updateCart();" type="number" name="product[<?=$code?>]" value="<?=$q?>" maxlength="3" min="1" max="999" size="2" style="text-align:center; border:1px solid #F0F0F0" />&nbsp;
           <p class="visible-xs" style="display:none;font-size:15px;"><?= number_format(get_price($pid) * $q, 0, ',', '.') ?></p>
           </td>
            <td width="18%" align="center" class="price-total hidden-xs"><?= number_format(get_price($pid) * $q, 0, ',', '.') ?></td>
             <td width="10%" align="center">
                           <a href="javascript:updateCart()" data-toggle="tooltip" title="Cập nhật"><i class='glyphicon glyphicon-refresh'></i></a>
                            &nbsp;&nbsp;
                           <a href="javascript:deleteCart('<?= $k ?>')" data-toggle="tooltip" title="Xóa"><i class="glyphicon glyphicon-trash"></i></a>

                        </td>
           </tr>

            <?
				}
			?>
            <tr><td colspan="6" style="padding:0">
                            <h3 class="all-cart-price"><?=_total_price?>: <?= number_format(get_order_total(), 0, ',', '.') ?>&nbsp;VNĐ</h3>
                        </td></tr>
                    <tr>
                        <td colspan="6" align="right">

                    <button class="btn button" type="button" onclick="window.history.back();"><i class="fa fa-shopping-bag"></i>&nbsp;<?=_muatiep?></button>
                     <button class="btn button" type="button" onclick="clearCart()"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;<?= _xoatatca ?></button>

                        </td>
                    </tr>

			<?
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>Không có sản phẩm!</td>";
			}
		?>
        </table>
  </form>
  <?php if(!isAjaxRequest()){ ?>
         </div>
</div>
</div>
</div>

<div class="col-md-6 col-sm-12 col-xs-12">

<div class="box_containerlienhe shop">

	<div class="content ">

	<div class="cus-info">
     <form method="post" name="frm_order" id="frm_order" class="form-horizontal from-thanhtoan" action="" enctype="multipart/form-data" role="form">
	<div class="">
		<div class="bill_form">
         <div class=""><p class="title_foot"><?=_thongtinthanhtoan?></p><span></span></div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"><?=_fullname?><span>*</span></label>
				<div class="col-sm-10">
					<input class="t form-control" name="hoten" id="hoten" type="text" value="" />

				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label"><?=_phone?><span>*</span></label>
				<div class="col-sm-10">
					<input class="t form-control" name="dienthoai" id="dienthoai" type="text" value="" />

				</div>
			</div>
			<div class="form-group">
            	<label for="inputEmail3" class="col-sm-2 control-label"><?=_tinhthanhpho?><span>*</span></label>
                <div class="col-sm-10">
                <div class="w51">
                <select name="thanhpho" id="thanhpho" class="sl form-control">
                	<option value=""><?=_tinhthanhpho?></option>
                    <?php foreach($thanhpho as $k){ ?>
                    	<option value="<?=$k['id']?>"><?=$k['ten']?></option>
                    <?php }?>
                </select>
                </div>
                 <div class="w51 margin">
                <select name="quan" id="quan" class="sl form-control">
                	<option value=""><?=_quanhuyen?></option>
                </select>
                </div>
                </div>
            </div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label" ><?=_address?><span>*</span></label>
				<div class="col-sm-10">
					<input class="t form-control" name="diachi"  id="diachi" type="text" value="" />

				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">E-Mail<span>*</span></label>
				<div class="col-sm-10">
					<input class="t form-control" name="email" id="email" type="email" value="" />

				</div>
			</div>
            <div class="form-group">
				<label class="col-sm-2 control-label">Ghi chú<span>*</span></label>
				<div class="col-sm-10">
					<textarea name="noidung"  class="form-control ax" style="resize:none" cols="50" rows="4" ></textarea>

				</div>
			</div>
		</div>
	<div class='clearfix'></div>
	</div>
	<hr />
	</div>
	<div class="clear"></div>
<div class="clearfix"></div>
   <div style="text-align: right;">
        <button title='tiếp tục' class="btn xbtn" type="button" onclick="check();"  value="" style="cursor:pointer;"/><?=_xacnhanthanhtoan?> <i class="fa fa-sign-in"></i></button>
    </div>
		</form>

 </div>

 </div>
  </div></div>
</div>

<?php }?>
