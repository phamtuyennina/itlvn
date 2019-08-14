<h3 class="tieude_giua"><?=$title_cat?></h3>
<div class="wap_item">
	<?php for($i=0,$count_product = count($product);$i<$count_product;$i++) { ?>
        <div class="item">
            <a href="<?=$lang?>/san-pham/<?=$product[$i]['id']?>/<?=$product[$i]['tenkhongdau']?>.html"><img src="<?php if($product[$i]['thumb']!=NULL)echo _upload_sanpham_l.$product[$i]['thumb'];else echo 'images/noimage.png' ?>" onmouseover="doTooltip(event, '<?=_upload_sanpham_l.$product[$i]['photo']?>')" onmouseout="hideTip()"  /><h3><?=$product[$i]['ten'.$lang]?></h3></a>
        </div><!---END .item-->
    <?php if(($i+1)%3==0)echo '<div class="clear"></div>' ?>
    <?php } ?> 
    <div class="clear"></div>
    <div class="phantrang" ><?=$paging['paging']?></div>
</div><!---END .wap_item-->
