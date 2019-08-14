<?php 
    $d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau,photo from #_news_danhmuc where type='giai-phap-kinh-doanh' and hienthi=1 order by stt,id desc";
    $d->query($sql);
    $giaiphap_danhmuc = $d->result_array();

  $d->reset();
  $sql = "select id,ten$lang as ten,tenkhongdau,photo,ngaytao,mota$lang as mota from #_news where type='tin-tuc' and hienthi=1 and noibat=1 order by stt,id desc";
  $d->query($sql);
  $tinmoi = $d->result_array();    
?>
<h1 hidden="true"><?=$company['ten']?></h1>

<div class="businesses-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Đối tác Logistics của bạn ở Việt Nam và Đông Dương</h2>
        </div>
        <div class="section-content" id="home_block_business_solutions">
            <div class="row">
                <?php foreach ($giaiphap_danhmuc as $key => $v) {?>
                <div class="col-sm-6 col-md-4 article-item business-style">
                    <div class="article-item-inner">
                        <div class="img-wrap">
                            <a href="giai-phap-kinh-doanh/<?=$v['tenkhongdau']?>">
                                <img src="thumb/380x275x1x90/<?=_upload_tintuc_l.$v['photo']?>" alt="<?=$v['ten']?>">
                            </a>
                        </div>
                        <div class="article-item-detail">
                            <h3 class="article-item-title"><?=$v['ten']?></h3>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="see-all-link">
                <a href="/business-solutions/aviation-services.html"><?=_xemtatca?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="news-section-layout news-section-2">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?=_tintucnoibat?></h2>
        </div>
        <div class="section-content">
            <div class="news-article-slide">
                <div class="row">
                    <div class="col-md-push-6 col-md-6 left-child">
                        <div class="article-item news-style">
                            <div class="article-item-inner">
                                <div class="img-wrap">
                                    <a href="tin-tuc/<?=$tinmoi[0]['tenkhongdau']?>.html">
                                        <img src="thumb/555x340x1x90/<?=_upload_tintuc_l.$tinmoi[0]['photo']?>" alt="<?=$tinmoi[0]['ten']?>">
                                    </a>
                                    <div class="article-date-time">
                                        <p>
                                            <i class="fa fa-calendar" aria-hidden="true"></i> <span><?=_tintuc?>, <?=date('M d, Y',$tinmoi[0]['ngaytao'])?></span>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="article-item-detail">
                                    <h3 class="article-item-title">
                                        <a href="tin-tuc/<?=$tinmoi[0]['tenkhongdau']?>.html"><?=$tinmoi[0]['ten']?></a>
                                    </h3>
                                    <p class="short-info"><?=catchuoi(trim(strip_tags($tinmoi[0]['mota'])),200)?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-pull-6 col-md-6 right-child">
                        <div class="slick_tintuc">
                            <?php foreach ($tinmoi as $k => $v) {if($k==0){continue;}?>
                            <div>
                                <div class="pad_tin clearfix">
                                    <a href="tin-tuc/<?=$v['tenkhongdau']?>.html">
                                        <img onError="this.src='http://placehold.it/140x110';" src="thumb/140x110x1x90/<?=_upload_tintuc_l.$v['photo']?>" alt="<?=$v['ten']?>">
                                    </a>
                                    <div class="info_tin">
                                        <h3>
                                            <a href="tin-tuc/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
                                        </h3>
                                        <div><?=catchuoi(trim(strip_tags($tinmoi[0]['mota'])),200)?></div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="clearfix">
                            <a class="see-all1" href="tin-tuc.html"><?=_xemthem?> <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>