<?php 
  $d->reset();
  $sql_tinmoi = "select id,ten$lang as ten,tenkhongdau,photo,mota$lang as mota,ngaytao from #_news where type='tin-tuc' and hienthi=1 order by ngaytao desc limit 0,4";
  $d->query($sql_tinmoi);
  $tinmoi = $d->result_array();


   $d->reset();
  $sql_tinmoi = "select id,ten$lang as ten,tenkhongdau,photo,mota$lang as mota,ngaytao from #_news where type='tin-tuc' and noibat=1 and hienthi=1 order by id,stt desc limit 0,4";
  $d->query($sql_tinmoi);
  $tinmoi_nb = $d->result_array();

  $d->reset();
  $sql = "select id,ten$lang as ten,tenkhongdau from #_news_danhmuc where type='tin-tuc' and hienthi=1 order by id,stt desc";
  $d->query($sql);
  $list_dm_tin = $d->result_array();  
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
	 				<div class="news-media-section-layout">
	 					<div class="section-content">
	 						<div class="row m-r-0">
	 							<div class="col-md-9 left-child">
                                    <div class="article-item news-style">
			                            <div class="article-item-inner">
			                                <div class="img-wrap">
			                                    <a href="tin-tuc/<?=$tinmoi_nb[0]['tenkhongdau']?>.html">
			                                        <img onError="this.src='http://placehold.it/630x465';" src="thumb/630x465x1x90/<?=_upload_tintuc_l.$tinmoi_nb[0]['photo']?>" alt="<?=$tinmoi_nb[0]['ten']?>">
			                                    </a>
			                                    <div class="article-date-time">
			                                        <p>
			                                            <i class="fa fa-calendar" aria-hidden="true"></i> <span><?=_tintuc?>, <?=date('M d, Y',$tinmoi_nb[0]['ngaytao'])?></span>
			                                        </p>
			                                    </div>
			                                </div>
			                                
			                                <div class="article-item-detail">
			                                    <h3 class="article-item-title">
			                                        <a href="tin-tuc/<?=$tinmoi_nb[0]['tenkhongdau']?>.html"><?=$tinmoi_nb[0]['ten']?></a>
			                                    </h3>
			                                    <p class="short-info"><?=catchuoi(trim(strip_tags($tinmoi_nb[0]['mota'])),250)?></p>
			                                </div>
			                            </div>
			                        </div>
	 						</div>
	 						<div class="col-md-3 right-child">
	 							<?php foreach ($tinmoi_nb as $k => $v) {if($k==0){continue;}?>
								<article class="article-item media-style">
                                    <div class="article-item-inner newshot">
                                        <div>
                                            <a href="<?=$com?>/<?=$v['tenkhongdau']?>.html">
                                                <img onError="this.src='http://placehold.it/185x117';" src="thumb/185x117x1x90/<?=_upload_tintuc_l.$v['photo']?>" alt="<?=$v['ten']?>">
                                            </a>
                                        </div>
                                        <div class="article-item-detail">                                                   
                                            <h3 class="article-item-title">
                                                <a href="<?=$com?>/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
                                            </h3>
                                        </div>
                                    </div>
                                </article>
	 							<?php }?>
	 						</div>
	 					</div>
	 					<?php foreach ($list_dm_tin as $k => $v) {
	 						  $d->reset();
							  $sql = "select id,ten$lang as ten,tenkhongdau,photo,mota$lang as mota,ngaytao from #_news where type='tin-tuc' and hienthi=1 and id_danhmuc=".$v['id']." order by ngaytao desc limit 0,4";
							  $d->query($sql);
							  $tinmoi1 = $d->result_array();
	 					?>
						<div class="corporate-news">
							<div class="row m-r-0">
								<div class="section-header">
                                    <h2 class="section-title section-title_list" id=""><?=$v['ten']?></h2>
                                </div>
                                <div class="section-content">
                                	<div class="news-article-slide">
                                		<div class="row">
                                			<?php foreach ($tinmoi1 as $k1 => $v1) {?>
											<div class="col-md-3 col-sm-3 col-xs-6">
	                                            <div class="article-item media-style">
	                                                <div class="article-item-inner news">
	                                                    <div>
	                                                        <a href="<?=$com?>/<?=$v1['tenkhongdau']?>.html">
	                                                            <img onError="this.src='http://placehold.it/420x265';" src="thumb/420x265x1x90/<?=_upload_tintuc_l.$v1['photo']?>" alt="<?=$v1['ten']?>">
	                                                        </a>
	                                                    </div>
	                                                    <div class="article-item-detail">                                                       
	                                                        <h3 class="article-item-title">
	                                                            <a href="<?=$com?>/<?=$v1['tenkhongdau']?>.html"><?=$v1['ten']?></a>
	                                                        </h3>
	                                                    </div>
	                                                </div>
	                                            </div>
                                            </div>
                                			<?php }?>
                                		</div>
                                	</div>
                                </div>
							</div>
							<div class="row news-all m-r-0">
                                <div class="col-md-12 text-right">
                                    <a href="tin-tuc/<?=$v['tenkhongdau']?>" class="read-more"><?=_xemthem?> »</a>
                                </div>
                            </div>
						</div>
	 					<?php }?>
	 					<div class="corporate-news">
	 						<div class="row m-r-0">
	 							<div class="section-header">
                                    <h2 class="section-title section-title_list" id=""><?=_tinmoinhat?></h2>
                                </div>
                                <div class="section-content">
                                	<div class="row">
	                                	<div class="slick_news-content">
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
	 			</div>
	 			
	 		</div>
	 		<div class="col-xs-12 col-md-3 sidebar-block"><?php include _template."layout/right_news.php";?></div>
	 	</div>
	 </div>
</div>