<div class="tieude_giua"><?=$title_cat?></div>
<div class="wap_item">
<?php for($i=0,$count_product=count($product);$i<$count_product;$i++){	?>
    <div class="item">
            <p class="sp_img"><a href="<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>">
            <img src="<?php if($product[$i]['thumb']!=NULL) echo _upload_sanpham_l.$product[$i]['thumb']; else echo 'images/noimage.png';?>" alt="<?=$product[$i]['ten']?>" /></a></p>
            <h3><a href="<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten']?>"><?=$product[$i]['ten']?></a></h3>
            <p class="gia">Giá: <span><?php if($product[$i]['gia'] != 0)echo number_format($product[$i]['gia'],0, ',', '.').' VNĐ';else echo 'Liên hệ'; ?></span></p>
    </div><!---END .item-->
<?php } ?>
<div class="clear"></div>
<div class="phantrang" ><?=$paging['paging']?></div>
</div><!---END .wap_item-->