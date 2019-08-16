<?php 
    $d->reset();
    $sql = "select ten$lang as ten,link,photo,mota$lang as mota from #_slider where hienthi=1 and type='brochure' order by stt,id desc";
    $d->query($sql);
    $slider=$d->result_array();
?>
<div class="section-sidebar brochure-download">
	<div class="section-header">
        <h2 class="section-title section-title_list" id=""><?=_taibrochure?></h2>
    </div>
    <div class="block gray-block pdf-block-list">
        <ul class="block-list">
        	<?php foreach ($slider as $v) {?>
			<li class="item">
                <a class="item-title" href="<?=_upload_hinhanh_l.$v['photo']?>" target="_blank">
                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i> <span><?=$v['ten']?></span>
                </a>
            </li>
        	<?php }?>
        </ul>
    </div>
</div>
<div class="section-sidebar live-video">
	<div class="section-header">
        <h2 class="section-title section-title_list" id="">VIDEO CLIPS</h2>
        <div id="video"></div>
    </div>
</div>