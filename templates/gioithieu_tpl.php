<?php 
	$d->reset();
	$sql = "select photo from #_background where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();
?>
<div class="banner_z">
	<div class="business-banner">
		<img src="<?=_upload_hinhanh_l.$row_bf['photo']?>" alt="<?=$title_cat?>">
		<h1 class="banner-title-new container"><?=_gioithieu?></h1>
	</div>
</div>
<div class="sub-menu-nav sub-menu-nav-secondary">
	<nav class="navbar navbar-tab-style business-navbar">
		<ul class="nav navbar-nav">
			<?php foreach ($baiviet1 as $v) {?>
			<li class="<?php if($_GET['id']==$v['tenkhongdau']){echo 'active';} ?>">
				<a href="gioi-thieu/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
			</li>
			<?php }?>
		</ul>
	</nav>
</div>
<section class="section-block customer-section">
	<div class="container">
		<div class="row">
			<h2 class="form-title"><?=$title_cat?></h2>
			<div class="section-content">
				<?=$tintuc_detail['noidung']?>
			</div>
		</div>
	</div>
</section>