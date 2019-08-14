<?php
    $d->reset();
    $sql_slider = "select ten$lang as ten,link,photo,mota$lang as mota from #_slider where hienthi=1 and type='slider' order by stt,id desc";
    $d->query($sql_slider);
    $slider=$d->result_array();
?>
<link href="js/engine1/style.css" type="text/css" rel="stylesheet" />

<div class="w_slider">
    <div id="wowslider-container1">
        <div class="ws_images">
            <ul>
                <?php foreach($slider as $k => $v){ ?>
                <li>
                    <a href="<?=$v['link']?>">
                        <img src="<?=_upload_hinhanh_l.$v['photo']?>" alt="<?=$v['ten']?>" title="" />
                    </a>
                </li>
                <?php }?>
            </ul>
       </div>
        <div class="ws_bullets"><div>
        <?php foreach($slider as $v){ ?>
            <a href="#" title="hinhc"><span><img src="thumb/85x48x1x90/<?=_upload_hinhanh_l.$v['photo']?>" alt="<?=$v['ten']?>"  /><?=$k?></span></a>
            <?php }?>
        </div></div>
        <div class="ws_shadow"></div>
    </div>
</div>