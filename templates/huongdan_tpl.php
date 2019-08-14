<?php
	$d->reset();
	$sql = "select photo from #_background where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();
  	
?>
<div class="banner_z">
	<div class="business-banner">
		<img src="<?=_upload_hinhanh_l.$row_bf['photo']?>" alt="<?=$title_cat?>">
		<h1 class="banner-title-new container"><?=$title_cat?></h1>
	</div>
</div>
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