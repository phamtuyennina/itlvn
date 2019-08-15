<?php
	$d->reset();
	$sql = "select photo from #_background where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();

	$d->reset();
	$sql = "select photo from #_background where type='bg-".$type."' limit 0,1";
	$d->query($sql);
	$row_bf1 = $d->fetch_array();	
  	
  $d->reset();
  $sql_tinmoi = "select id,ten$lang as ten,noidung$lang as noidung from #_news where type='huong-dan-hoi-dap' and hienthi=1 order by stt,id desc";
  $d->query($sql_tinmoi);
  $tinmoi = $d->result_array();
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
<div class="section-block customer-question-answer-section">
	<div class="container">
		<div class="section-header">
            <h2 class="form-title"><?=_cauhoithuonggap?></h2>
        </div>
        <div class="row">
        <div class="section-content">
        	<div class="col-sm-12 col-md-7 question-list-block">
        		<div class="panel-group-block accordion accordionBlock" id="question-itl">
        			<?php foreach ($tinmoi as $v) {?>
					<div class="panel accordion-item-panel collapse-toggle-nav">
                            <div class="panel-heading">
                            <a class="collapse-toggle" href="javascript:void(0)"><?=$v['ten']?></a>
                            </div>
                            <div class="panel-body collapse-div">
                                <div class="panel-body-inner">
          						<?=$v['noidung']?>
                                </div>
                            </div>
                        </div>
        			<?php }?>
        		</div>
        	</div>
        	<div class="col-sm-12 col-md-5 quick-guide-img-block">
                <img src="<?=_upload_hinhanh_l.$row_bf1['photo']?>" alt="<?=$company['ten']?>">
            </div>
        </div>
        </div>
	</div>
</div>