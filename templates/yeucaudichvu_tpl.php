<?php
	$d->reset();
	$sql = "select photo from #_background where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_bf = $d->fetch_array();

    $d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau,photo from #_news_danhmuc where type='giai-phap-kinh-doanh' and hienthi=1 order by stt,id desc";
    $d->query($sql);
    $giaiphap_danhmuc = $d->result_array();   	
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
<section class="section-block customer-section">
    <div class="container">
        <div class="section-content">
        <form action="" class="frm-booking-step1" method="post" novalidate="novalidate">
          <div class="wrap-form inquiry-booking-form select-services-form">
              <h2 class="form-title"><?=_luachondichvu?></h2>
              <div class="row">
                  <div class="col-xs-12 col-sm-4">
                      <div class="form-group">
                          <label class="control-label"><?=_dichvu?></label>
                          <div class="select-box">
                              <select class="form-control" id="bu_id" name="bu_id">
                                <option value=""><?=_dichvu?></option>
								<?php foreach ($giaiphap_danhmuc as $key => $v) {?>
								<option value="<?=$v['id']?>"><?=$v['ten']?></option>
								<?php }?>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-4">
                      <div class="form-group">
                          <label class="control-label"><?=_diachiemal?></label>
                          <input class="form-control" placeholder="Ex: example@gmail.com" type="input" name="customer_email">
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-4">
                      <div class="form-group">
                          <label class="control-label"><?=_sodienthoai?></label>
                          <input class="form-control" placeholder="Ex: 0900.000.3456" type="input" name="customer_phone">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-8">
                      <div class="form-group">
                          <label class="control-label"><?=_mota?></label>
                          <textarea class="form-control" id="description" name="description" placeholder="<?=_nhapthongtinmotavekienhang?>"></textarea>
                      </div>
                  </div>
                  <input type="hidden" name="recaptcha_response" id="recaptcha_yeucaudichvu">
                  <div class="col-xs-12 col-sm-4">
                      <div class="form-group">
                          <button class="btn btn-default btn-send" type="button" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">
                              <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                              <span><?=_gui?></span>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
        </form>
        </div>
    </div>
</section>