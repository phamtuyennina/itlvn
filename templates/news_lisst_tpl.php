<?php 
  $d->reset();
  $sql_tinmoi = "select id,ten$lang as ten,tenkhongdau,photo,mota$lang as mota,ngaytao from #_news where type='tin-tuc' and hienthi=1 order by ngaytao desc limit 0,4";
  $d->query($sql_tinmoi);
  $tinmoi = $d->result_array();
?>
<div class="banner about-banner media-banner">
	<h1 hidden="true"><?=$title_cat?></h1>
	<div class="section-block news-media-section">
		<div class="section-update">
	 		<div class="container">
	 			<a class="news-update" href="<?=$com?>/<?=$tinmoi[0]['tenkhongdau']?>.html" title="<?=$tinmoi[0]['ten']?>">
		              <span class="news-update-icon"><?=_tinmoinhat?></span>
		              <span class="news-update-link"><?=$tinmoi[0]['ten']?></span>
		        </a>
	 		</div>
	 	</div>
	 	<div class="container">
	 		<div class="row">
	 			<div class="col-xs-12 col-md-9 corp-news-list-block">
	 				<div class="corporate-news">
 						<div class="row m-r-0">
 							<div class="section-header">
                                <h2 class="section-title section-title_list" id=""><?=$title_cat?></h2>
                            </div>
                            <div class="section-content">
                            	<div class="row">
                                	<div class="slick_news-content1">
                                	<?php foreach ($tinmoi as $key => $v) {?>
									<div class="col-xs-6">
										<div class="article-item-inner ">
	                                        <div>
	                                            <a href="<?=$com?>/<?=$v['tenkhongdau']?>.html">
	                                                <img onError="this.src='http://placehold.it/420x270';" src="thumb/420x270x1x90/<?=_upload_tintuc_l.$v['photo']?>" alt="<?=$v['ten']?>">
	                                            </a>
	                                        </div>
	                                        <div class="article-item-detail">                                                       
	                                            <h3 class="article-item-title">
	                                                <a href="<?=$com?>/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
	                                            </h3>
	                                            <p class="short-info infonewslast"> <?=catchuoi(trim(strip_tags($v['mota'])),150)?></p>
	                                        </div>
	                                    </div>
									</div>
                                	<?php }?>
                                	</div>
                            	</div>
                            </div>
 						</div>
 					</div>
	 			</div>
	 			<div class="col-xs-12 col-md-3 sidebar-block"><?php include _template."layout/right_news.php";?></div>
	 		</div>
	 	</div>
	</div>
</div>