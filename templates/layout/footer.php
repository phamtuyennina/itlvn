<?php	

	$d->reset();
	$sql_contact = "select noidung$lang as noidung from #_about where type='footer' limit 0,1";
	$d->query($sql_contact);
	$company_contact = $d->fetch_array();

    $d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau,photo from #_news_danhmuc where type='giai-phap-kinh-doanh' and hienthi=1 order by stt,id desc";
    $d->query($sql);
    $giaiphap_danhmuc = $d->result_array();

    $d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau from #_news_danhmuc where type='tin-tuc' and hienthi=1 order by stt,id desc";
    $d->query($sql);
    $tintuc_danhmuc = $d->result_array(); 

    $d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau from #_news where type='gioi-thieu' and hienthi=1 order by stt,id desc";
    $d->query($sql);
    $gt_danhmuc = $d->result_array();        
?>
<section class="footer-links-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2" id="footer_column_1">
                <div class="footer-links-col">
                    <h4 class="list-title-item"><?=_gioithieu?></h4>
                    <ul class="list-group footer-links-list">
                         <?php foreach ($gt_danhmuc as $key => $v) {?>
                            <li>
                                <a href="gioi-thieu/<?=$v['tenkhongdau']?>.html"><?=$v['ten']?></a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2" id="footer_column_2">
                <div class="footer-links-col">
                    <h4 class="list-title-item">Giải pháp kinh doanh</h4>
                    <ul class="list-group footer-links-list">
                        <?php foreach ($giaiphap_danhmuc as $key => $v) {?>
                            <li>
                                <a href="giai-phap-kinh-doanh/<?=$v['tenkhongdau']?>"><?=$v['ten']?></a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2" id="footer_column_3">
                <div class="footer-links-col">
                <h4 class="list-title-item"><?=_cohoinghenghiep?></h4>
                <ul class="list-group footer-links-list">
                    <li>
                        <a href="/vn/career/working-environment.html#view">Môi trường làm việc</a>
                    </li>
                    <li>
                        <a href="/vn/career/why-join-itl.html#view">Gia nhập đội ngũ ITL</a>
                    </li>
                    <li>
                        <a href="/vn/career/graduates.html">Cơ hội</a>
                    </li>
                    <li>
                        <a href="/vn/career/job-openning.html#view">Thông tin tuyển dụng</a>
                    </li>
                </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2" id="footer_column_4">
                <div class="footer-links-col">
                    <h4 class="list-title-item"><?=_khachhang?></h4>
                    <ul class="list-group footer-links-list">
                        <li>
                            <a href="/vn/customers-desk/booking-inquiry.html"><?=_yeucaudichvu?></a>
                        </li>
                        <li>
                            <a href="#"><?=_tracuuvandon?></a>
                        </li>
                        <li>
                            <a href="huong-dan-hoi-dap.html"><?=_huongdanvahoidap?></a>
                        </li>
                        <li>
                            <a href="phan-hoi-khach-hang.html"><?=_phanhoikhachhang?></a>
                        </li>
                        <li>
                            <a href="lien-he.html"><?=_lienhe?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2" id="footer_column_5">
                <div class="footer-links-col">
                    <h4 class="list-title-item"><?=_tintuctruyenthong?></h4>
                    <ul class="list-group footer-links-list">
                        <?php foreach ($tintuc_danhmuc as $key => $v) {?>
                        <li>
                            <a href="tin-tuc/<?=$v['tenkhongdau']?>"><?=$v['ten']?></a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                <div class="footer-links-col">
                    <h4 class="list-title-item"><?=_ketnoivoichungtoi?></h4>
                    <ul class="nav navbar-nav social-group">
                        <li>
                            <a href="https://www.youtube.com/channel/UCKd91CMk5nS0-3sFWbpHpqw" target="_blank">
                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/IndoTransLogistics" target="_blank">
                                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/itlvn-corporation" target="_blank">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container footer-block">
        <nav class="footer-bottom-nav">
            <div class="col-md-1 footer-logo">
                <a href="">
                   <img src="<?=_upload_hinhanh_l.$row_logo['photo']?>" alt="<?=$company['ten']?>">
                </a>
            </div>
            <p class="copy-right">©2017 Indo Trans Logistics Corporation. All right reserved.</p>
            <ul class="nav navbar-nav social-group">
                <li>
                    <a href="#" target="_blank">

                    </a>
                </li>
                <li>
                    <a href="chinh-sach-bao-mat.html" target="_blank"><?=_chinhsachbaomat?></a>
                </li>
                <li>
                    <a href="dieu-khoan-su-dung.html" target="_blank"><?=_dieukhoansudung?></a>
                </li>
                
            </ul>
        </nav>
    </div>