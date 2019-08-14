<div class="tieude_giua"><div><?=$title_cat?></div><span></span></div>
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