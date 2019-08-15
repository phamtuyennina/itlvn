
<?php
	$d->reset();
	$sql = "select photo from #_background where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();
 
	$d->reset();
	$sql = "select noidung$lang as noidung,ten$lang as ten from #_about where type='".$type."' limit 0,1";
	$d->query($sql);
	$about_contact = $d->fetch_array(); 

  $d->reset();
  $sql = "select id,ten$lang as ten,tenkhongdau,mota$lang as mota,chucvu$lang as chucvu,write_by$lang as write_by,photo from #_news where type='phan-hoi-khach-hang' and hienthi=1 order by stt,id desc";
  $d->query($sql);
  $phanhoikhachhang = $d->result_array();	  	
?>
<div class="banner_z">
	<div class="business-banner">
		<img src="<?=_upload_hinhanh_l.$row_bf['photo']?>" alt="<?=$title_cat?>">
		<h1 class="banner-title-new container"><?=$title_cat?></h1>
	</div>
</div '
<div class="sub-menu-nav sub-menu-nav-secondary">
	<nav class="navbar navbar-tab-style business-navbar customer-desk-navbar">
		<ul class="nav navbar-nav">
			<li class="<?php if($com=='yeu-cau-dich-vu'){echo 'active';} ?>"><a href="yeu-cau-dich-vu.html"><?=_yeucaudichvu?></a></li>
			<li class="<?php if($com=='tra-cuu-van-don'){echo 'active';} ?>"><a href="#"><?=_tracuuvandon?></a></li>
			<li class="<?php if($com=='huong-dan-hoi-dap'){echo 'active';} ?>"><a href="huong-dan-hoi-dap.html"><?=_huongdanhoidap?></a></li>
			<li class="<?php if($com=='phan-hoi-khach-hang'){echo 'active';} ?>"><a href="phan-hoi-khach-hang.html"><?=_phanhoikhachhang?></a></li>
			<li class="<?php if($com=='lien-he'){echo 'active';} ?>"><a href="lien-he.html"><?=_lienhe?></a></li>
		</ul>
	</nav>
</div>
<div class="section-block customer-feedbacks-section">
	<div class="container">
		<div class="section-content">
			<div class="feedback-head-block">
				<div class="feedback-head-block">
					<?=$about_contact['noidung']?>
				</div>
			</div>
			<div class="feedback-comment-block">
				<?php foreach ($phanhoikhachhang as $v) {?>
				<div class="feedback-block">
					<ul class="block-list comment-list-block">
						<li class="item comment-item">
							<div class="item-inner">
								<div class="col-sm-2 comment-item-img">
                                    <div class="img-wrap">
                                        <img src="thumb/150x150x1x90/<?=_upload_tintuc_l.$v['photo']?>" alt="<?=$v['ten']?>">
                                    </div>
                                </div>
                                <div class="col-sm-10 comment-content-block">
                                	<h4 class="comment-title"><?=$v['ten']?></h4>
                                	<p class="comment-content"><?=$v['mota']?></p>
                                	<p class="comment-author">
                                        <span class="author-text"><?=_boi?></span>
                                        <span class="author-name"><?=$v['write_by']?></span>
                                        <span class="author-symbol">-</span>
                                        <span class=""><?=$v['chucvu']?></span>
                                    </p>
                                </div>
							</div>
						</li>
					</ul>
				</div>
				
				<?php }?>
			</div>
		</div>
	</div>
</div>