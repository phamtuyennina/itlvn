<?php 
	$d->reset();
	$sql = "select photo from #_background where type='".$type1."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();

  $d->reset();
  $sql = "select id,ten$lang as ten,tenkhongdau from #_news_danhmuc where type='tuyen-dung' and hienthi=1 order by stt,id desc";
  $d->query($sql);
  $tuyendung_list = $d->result_array();	
?>
<section class="banner about-banner">
    <div>
        <img src="<?=_upload_hinhanh_l.$row_bf['photo']?>" alt="<?=$title_cat?>">
    </div>
</section>
<div class="main-content-container">
	<div class="container">
		<div class="row">
			<aside class="col-sm-3 sidebar-nav career-sidebar multigroup-is-tab">
				<ul class="list-group-wrap">
					<li id="view" class="list-group-block">
					    <p class="list-group-title"><?=_thongtinkhac?></p>
					    <ul class="list-group">
					    	<li class="list-group-item <?php if($com=='moi-truong-lam-viec'){echo 'active';} ?>">
		                        <a href="moi-truong-lam-viec.html"><?=_moitruonglamviec?></a>
		                    </li>
		                    <li class="list-group-item <?php if($com=='gia-nhap-doi-ngu'){echo 'active';} ?>">
		                        <a href="gia-nhap-doi-ngu.html"><?=_gianhapdoingu?></a>
		                    </li>
		                    <li class="list-group-item <?php if($com=='co-hoi-nghe-nghiep'){echo 'active';} ?>">
		                        <a href="co-hoi-nghe-nghiep.html"><?=_cohoinghenghiep?></a>
		                    </li>   
					    </ul>
					</li>
					<li>
						<p class="list-group-title"><?=_thongtintuyendung?></p>
						<ul class="list-group">
							<li class="list-group-item ">
					            <a href="tuyen-dung.html">
									<?=_tatca?><span class="count-job-all"> (<?=getcongviec(0)?>)</span>
								</a>
					        </li>
							<?php foreach ($tuyendung_list as $v) {?>
							<li class="list-group-item ">
					            <a href="tuyen-dung/<?=$v['tenkhongdau']?>">
									<?=$v['ten']?><span class="count-job-all"> (<?=getcongviec($v['id'])?>)</span>
								</a>
					        </li>
							<?php }?>
						</ul>
					</li>
				</ul>
			</aside>
			<div class="col-sm-9 main-content article-detail-section career-section">
				<div class="section-header">
                    <h1 class="section-title"><?=$title_cat?></h1>
                </div>
                <div class="section-content"><?=$tintuc_detail['noidung']?></div>
			</div>
		</div>
	</div>
</div>