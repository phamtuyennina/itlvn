<?php 
    $d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau,ngaytao,mota$lang as mota,photo from #_news where type='tin-tuc' and hienthi=1 order by ngaytao  desc limit 0,8";
    $d->query($sql);
    $tinmoi = $d->result_array();
?>
<div class="breadcrumb">
    <div class="container">
        <?=$bread->display();?>
    </div>
</div>
<div class="section-content article-detail-content news-detail-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="section-header">
                    <div class="article-date-time">
                        <p class="day-time"><?=date('d',$tintuc_detail['ngaytao'])?></p>
                        <p class="month-year-time">
                            <span class="month-time"><?=date('m',$tintuc_detail['ngaytao'])?></span>/<span class="year-time"><?=date('y',$tintuc_detail['ngaytao'])?></span>
                        </p>
                    </div>
                    <h2 class="section-title"><?=$title_cat?></h2>
                    <div class="article-social-nav">
                        <div class="social-group-action">
                           <div class="addthis_native_toolbox"></div>
                        </div>
                    </div>
                </div>
                <div class="section-content">
                    <?=$tintuc_detail['noidung']?> 
                </div>
                <div class="article-comment-block">
                    <div class="addthis_native_toolbox"></div>    
                    <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-width="100%"></div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 right-sidebar">
                <?php if(!empty($tinmoi)){?>
                <h2 class="form-title"><?=_tinmoinhat?></h2>
                <div class="tutorials-list-slide">
                    <ul class="block-list">
                        <?php $i=0; foreach ($tinmoi as $k => $v) {$i++;?>
                        <li class="item news-detail clearfix">
                            <div class="item-img">
                                <a href="tin-tuc/<?=$v['tenkhongdau']?>.html">
                                    <img src="thumb/80x80x1x90/<?=_upload_tintuc_l.$v['photo']?>" onError="this.src='http://placehold.it/80x80';" alt="<?=$v['ten']?>">
                                </a>
                            </div>
                            <div class="item-info">
                                <a class="item-title" href="tin-tuc/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
                                <p class="date-time"><?=date('d/m/Y',$v['ngaytao'])?></p>
                                <p class="item-description"><?=catchuoi(trim(strip_tags($v['mota'])),80)?></p>
                            </div>
                        </li>   
                        <?php if($i%4==0 && $k<count($tinmoi)-1){echo '</ul><ul class="block-list">';$i=0;}}?>
                    </ul>
                </div>
                <?php }?>

                <?php if(!empty($tintuc)){?>
                    <div class="sesicon_lq">
                <h2 class="form-title"><?=_tinlienquan?></h2>
                <div class="tutorials-list-slide">
                    <ul class="block-list">
                        <?php $i=0; foreach ($tintuc as $k => $v) {$i++;?>
                        <li class="item news-detail clearfix">
                            <div class="item-img">
                                <a href="tin-tuc/<?=$v['tenkhongdau']?>.html">
                                    <img src="thumb/80x80x1x90/<?=_upload_tintuc_l.$v['photo']?>" onError="this.src='http://placehold.it/80x80';" alt="<?=$v['ten']?>">
                                </a>
                            </div>
                            <div class="item-info">
                                <a class="item-title" href="tin-tuc/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
                                <p class="date-time"><?=date('d/m/Y',$v['ngaytao'])?></p>
                                <p class="item-description"><?=catchuoi(trim(strip_tags($v['mota'])),80)?></p>
                            </div>
                        </li>   
                        <?php if($i%4==0 && $k<count($tintuc)-1){echo '</ul><ul class="block-list">';$i=0;}}?>
                    </ul>
                </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>

