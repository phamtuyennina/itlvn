<?php
	$d->reset();
	$sql_product_danhmuc="select ten$lang as ten,tenkhongdau,id from #_product_danhmuc where hienthi=1 order by stt,id desc";
	$d->query($sql_product_danhmuc);
	$product_danhmuc=$d->result_array();
?>


<div class="wapper">
<ul>	
    <li><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>" href="index.html"><?=_trangchu?></a></li>
    <li class="line"></li>
    <li><a class="<?php if($_REQUEST['com'] == 'gioi-thieu') echo 'active'; ?>" href="gioi-thieu.html"><?=_gioithieu?></a></li>
    <li class="line"></li>
    <li><a class="<?php if($_REQUEST['com'] == 'san-pham') echo 'active'; ?>" href="san-pham.html"><?=_sanpham?></a>
    	<ul>
			<?php for($i = 0;$i<count($product_danhmuc); $i++){ 
			
				$d->reset();
				$sql_product_list="select ten$lang as ten,tenkhongdau,id from #_product_list where hienthi=1 and id_danhmuc='".$product_danhmuc[$i]['id']."' order by stt,id desc";
				$d->query($sql_product_list);
				$product_list=$d->result_array();			
			?>
            <li><a href="san-pham/<?=$product_danhmuc[$i]['tenkhongdau']?>-<?=$product_danhmuc[$i]['id']?>"><?=$product_danhmuc[$i]['ten']?></a>
                
                <?php if(count($product_list)>0){?>
                <ul>
					
                     <?php for($j = 0;$j < count($product_list); $j++){ 
					 
					$d->reset();
					$sql_product_list="select ten$lang as ten,tenkhongdau,id from #_product_cat where hienthi=1 and id_list='".$product_list[$j]['id']."' order by stt,id desc";
					$d->query($sql_product_list);
					$product_cat=$d->result_array();
					 
					 ?>
                            <li><a href="san-pham/<?=$product_list[$j]['tenkhongdau']?>-<?=$product_list[$j]['id']?>/"><?=$product_list[$j]['ten']?></a>
                            
                            <?php if(count($product_cat)>0){?>
                            <ul>                            
								<?php for($k = 0;$k < count($product_cat); $k++){ ?>
                                    <li><a href="san-pham/<?=$product_cat[$k]['tenkhongdau']?>-<?=$product_cat[$k]['id']?>.htm"><?=$product_cat[$k]['ten']?></a></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                                
                            </li>
                     <?php } ?>
                 </ul>
                 <?php } ?>
                </li>
                <?php } ?>
            </ul>	
    </li>
    <li class="line"></li>
    <li><a class="<?php if($_REQUEST['com'] == 'tin-tuc') echo 'active'; ?>" href="tin-tuc.html"><?=_tintuc?></a></li>
    <li class="line"></li>
    <li><a class="<?php if($_REQUEST['com'] == 'dich-vu') echo 'active'; ?>" href="dich-vu.html"><?=_dichvu?></a></li>
    <li class="line"></li>
    <li><a class="<?php if($_REQUEST['com'] == 'video') echo 'active'; ?>" href="video.html">Video</a></li>
    <li class="line"></li>
    <li><a class="<?php if($_REQUEST['com'] == 'lien-he') echo 'active'; ?>" href="lien-he.html"><?=_lienhe?></a></li>
</ul>
<div id="search">
    <input type="text" name="keyword" id="keyword" onKeyPress="doEnter(event,'keyword');" value="<?=_nhaptukhoatimkiem?>..."  onclick="if(this.value=='<?=_nhaptukhoatimkiem?>...'){this.value=''}" onblur="if(this.value==''){this.value='<?=_nhaptukhoatimkiem?>...'}">
    <i class="fa fa-search" aria-hidden="true" onclick="onSearch(event,'keyword');"></i>
</div><!---END #search-->

</div>