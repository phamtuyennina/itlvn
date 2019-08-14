<div class="banner_z">
	<div class="business-banner">
		<img src="<?=_upload_tintuc_l.$title_new['banner']?>" alt="<?=$title_new['ten']?>">
		<h1 class="banner-title-new container"><?=$title_cat_danhmuc?></h1>
	</div>
</div>
<div class="sub-menu-nav sub-menu-nav-secondary">
	<nav class="navbar navbar-tab-style business-navbar">
		<ul class="nav navbar-nav">
			<?php foreach ($giaiphap_l as $v) {?>
			<li class="<?php if($id_danhmuc_active==$v['id']){echo 'active';} ?>">
				<a href="giai-phap-kinh-doanh/<?=$v['tenkhongdau']?>"><?=$v['ten']?></a>
			</li>
			<?php }?>
		</ul>
	</nav>
</div>
<div class="main-content-container">
	<div class="container">
		<div class="row">
			<div class="sidebar-nav col-sm-3">
				<ul class="list-group">
					<?php foreach ($baiviet1 as $k => $v) {?>
					<li class="list-group-item <?php if($key_active==$v['tenkhongdau']){echo 'active';} ?>">
						<a href="giai-phap-kinh-doanh/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			<div class="col-sm-9 main-content business-section">
				<div class="section-content">
					<?=$noidung?>
				</div>
			</div>
		</div>
	</div>
</div>