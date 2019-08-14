<link href="magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="css/tab.css" type="text/css" rel="stylesheet" />



<!--End Jquery tabs-->

<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
<div class="box_container">
	<div class="wap_pro">

        <div class="zoom_slick">
         	<div class="slick2">
                <a data-zoom-id="Zoom-detail" id="Zoom-detail" class="MagicZoom" href="<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['photo'];else echo 'images/noimage.gif';?>" title="<?=$row_detail['ten']?>"><img class='cloudzoom' src="<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['photo'];else echo 'images/noimage.gif';?>" /></a>

                <?php $count=count($hinhthem); if($count>0) {?>
                <?php for($j=0,$count_hinhthem=count($hinhthem);$j<$count_hinhthem;$j++){?>
                	<a data-zoom-id="Zoom-detail" id="Zoom-detail" class="MagicZoom" href="<?php if($hinhthem[$j]['photo']!=NULL) echo _upload_hinhthem_l.$hinhthem[$j]['photo']; else echo 'images/noimage.gif';?>" title="<?=$row_detail['ten']?>" ><img src="<?php if($hinhthem[$j]['photo']!=NULL) echo _upload_hinhthem_l.$hinhthem[$j]['photo']; else echo 'images/noimage.gif';?>" /></a>
                <?php }} ?>
            </div><!--.slick-->


         	<?php $count=count($hinhthem); if($count>0) {?>
            <div class="slick">
                <p><img src="timthumb.php?src=<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['photo'];else echo 'images/noimage.gif';?>&h=80&w=100&zc=1&q=100" /></p>
                <?php for($j=0,$count_hinhthem=count($hinhthem);$j<$count_hinhthem;$j++){?>
                	<p><img src="<?php if($hinhthem[$j]['thumb']!=NULL) echo _upload_hinhthem_l.$hinhthem[$j]['thumb']; else echo 'images/noimage.gif';?>" /></p>
                <?php } ?>
            </div><!--.slick-->
            <?php } ?>
        </div><!--.zoom_slick-->

        <ul class="product_info">
                <li class="ten"><?=$row_detail['ten']?></li>
                 <?php if($row_detail['masp'] != '') { ?><li><b><?=_masanpham?>:</b> <?=$row_detail['masp']?></span></li><?php } ?>
                 <?php /*?><?php if($row_detail['giakm'] != 0) { ?><li class="giakm"><?=_giakm?>: <?=number_format($row_detail['giakm'],0, ',', '.').' <sup>đ</sup>';?></li><?php } ?><?php */?>
                 <li class="gia"><?=_gia?>: <?php if($row_detail['gia'] != 0)echo number_format($row_detail['gia'],0, ',', '.').' <sup>đ</sup>';else echo 'Liên hệ'; ?></li>

                 <?php
				 	$colors = getColorByProductId($row_detail['id'],$lang);
					if(count($colors) > 0){
				 ?>
                 	<li><p><?=_chonmau?>:</p>
                    	<?php
							foreach($colors as $k=>$v){
							echo '<div class="wrap-color">
									<div class="color_item" title="'.$v['ten'].'" data-id="'.$v['id_color'].'" style="background:#'.$v['bg_color'].';">
									</div>
								  </div>';
							}
						echo '<div class="clear"></div>';
						?>
                    </li>
                 <?php }?>
                    <?php
				 	$sizes = getSizeByProductId($row_detail['id']);
					if(count($sizes) > 0){
				 ?>
                 	<li><p><?=_chonsize?>:</p>
                    	<?php
							foreach($sizes as $k=>$v){
							echo '<div class="wrap-size">
										<div class="size_item" title="'.$v['ten'].'" data-id="'.$v['id_size'].'">'.$v['ten'].'</div>
								 </div>';
							}
						echo '<div class="clear"></div>';
						?>
                    </li>
                 <?php }?>
                 <li>
                 	<div class="product-qty">
                 		<div class="show"><label><?=_dathang?>:</label></div>
                        <div>
                        	<div class="controls">
                            	<button class="fa fa-minus"></button>
                                <input type="text" value="1" readonly id="qty" />
                                <button class="fa fa-plus is-up"></button>
                                <div class="clear"></div>
                            </div>
                            <div class="cart"><button class="add-cart" id="add-cart" data-id="<?=$row_detail['id']?>" data-name="<?=$row_detail['ten']?>">Thêm vào giỏ <i class="fa fa-cart-plus"></i></button>  </div>
                        </div>
                    </div>
                 </li>
                 <li><b><?=_luotxem?>:</b> <span><?=$row_detail['luotxem']?></span></li>
                 <?php if($row_detail['mota'] != '') { ?><li><?=$row_detail['mota']?></li><?php } ?>
                 <?php /*?><li><a class="dathang"><?=_dathang?></a></li><?php */?>
                 <li><div class="addthis_native_toolbox"></div></li>
        </ul>
        <div class="clear"></div>
  </div><!--.wap_pro-->

        <div id="tabs">
            <ul id="ultabs">
                <li data-vitri="0"><?=_thongtinsanpham?></li>
                <li data-vitri="1"><?=_binhluan?></li>
            </ul>
            <div style="clear:both"></div>

            <div id="content_tabs">
                <div class="tab">
                    <?=$row_detail['noidung']?>

                     <?php if(!empty($tags_sp)) { ?>
                        <div class="tukhoa">
                            <div id="tags">
                                    <span>Tags:</span>
									<?php foreach($tags_sp as $k=>$tags_sp_item) { ?>
                                       <a href="tags/<?=changeTitle($tags_sp_item['ten'])?>/<?=$tags_sp_item['id']?>" title="<?=$tags_sp_item['ten']?>"><?=$tags_sp_item['ten']?></a>
                                    <?php } ?>
                                <div class="clear"></div>
                            </div>
                        </div>
                	<?php } ?>

                </div>

                <div class="tab">
                    <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-width="100%"></div>
                </div>
            </div><!---END #content_tabs-->
        </div><!---END #tabs-->
<div class="clear"></div>
</div><!--.box_containerlienhe-->

<?php if(count($product)>0) { ?>
<div class="tieude_giua"><div><?=_sanphamcungloai?></div><span></span></div>
<div class="wap_item">
<?php for($i=0,$count_product=count($product);$i<$count_product;$i++){

	//if($product[$i]['giakm']!=0&&$product[$i]['gia']!=0)
	//$phantram[$i] = 100 - (($product[$i]['giakm']  / $product[$i]['gia'])* 100 );

?>
    <div class="item">
    		<?php /*?><?php if($product[$i]['giakm']!=0 && $product[$i]['gia']!=0){?>
    		<a class="sale"><? if(round($phantram[$i])!=0) echo round($phantram[$i]);else echo '0';?>%</a>
            <?php }?><?php */?>

            <p class="sp_img"><a href="san-pham/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>">
            <img src="<?php if($product[$i]['thumb']!=NULL) echo _upload_sanpham_l.$product[$i]['thumb']; else echo 'images/noimage.png';?>" alt="<?=$product[$i]['ten']?>" /></a></p>
            <h3 class="sp_name"><a href="san-pham/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>"><?=$product[$i]['ten']?></a></h3>
            <p class="sp_gia">
            	<?php if($product[$i]['giakm']!=0 && $product[$i]['gia']!=0){?>
            	<span class="giakm"><?php if($product[$i]['giakm']!=0)echo number_format($product[$i]['giakm'],0, ',', '.').' <sup>đ</sup>';?> </span>
            	<span class="giamoi <?php if($product[$i]['giakm']==0)echo 'motgia'?>"><?=number_format($product[$i]['gia'],0, ',', '.').' <sup>đ</sup>'; ?></span>
                <?php }else{?>
                <span class="giamoi motgia">Giá: <?php if($product[$i]['gia']!=0) echo number_format($product[$i]['gia'],0, ',', '.').' <sup>đ</sup>'; else echo 'Liên hệ'; ?></span>
                <?php }?>
            </p>
    </div><!---END .item-->
<?php } ?>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div><!---END .wap_item-->
<?php } ?>
