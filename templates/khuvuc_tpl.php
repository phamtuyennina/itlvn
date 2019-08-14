<?php
	$d->reset();
	$sql = "select photo from #_background where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();

  $d->reset();
  $sql = "select id,ten$lang as ten,tenkhongdau,photo,noidung$lang as noidung from #_news where type='".$type."' and hienthi=1 order by stt,id desc";
  $d->query($sql);
  $list_khuvuc = $d->result_array();

	$d->reset();
	$sql = "select noidung$lang as noidung,ten$lang as ten from #_about where type='".$type."' limit 0,1";
	$d->query($sql);
	$about_contact = $d->fetch_array();  
?>
<div class="banner_z">
	<div class="business-banner">
		<img src="<?=_upload_hinhanh_l.$row_bf['photo']?>" alt="<?=$title_cat?>">
		<h1 class="banner-title-new container"><?=$title_cat?></h1>
	</div>
</div>
<div class="main-content-container">
	<div class="office-map-section">
		<div class="container">
			<div class="section-header">
	            <h2 class="section-title"><?=$about_contact['ten']?></h2>
	        </div>
	        <div class="section-content"><?=$about_contact['noidung']?></div>
		</div>
	</div>
	<div>
	<?php foreach ($list_khuvuc as $key => $v) {?>
	<div class="location-section1">
		<div class="container">
			<div class="col-md-7 <?php if($key%2!=0){echo 'col-md-push-5';} ?>">
				<div class="location-img-div">
	                <img src="<?=_upload_tintuc_l.$v['photo']?>" alt="<?=$v['ten']?>">
	            </div>
			</div>
			<div class="<?php if($key%2!=0){echo 'col-md-pull-7';} ?> col-md-5 article-item ">
                <h3 class="article-item-title"><?=$v['ten']?></h3>
                <div class="short-info"><?=$v['noidung']?></div>
            </div>
		</div>
	</div>
	<?php }?>
	</div>
</div>