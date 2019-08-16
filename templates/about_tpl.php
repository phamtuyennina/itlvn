<div class="breadcrumb">
    <div class="container">
        <?=$bread->display();?>
    </div>
</div>
<div class="section-content article-detail-content news-detail-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
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
          
        </div>
    </div>
</div>

