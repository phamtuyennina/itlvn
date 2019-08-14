<?php
 	error_reporting(0);
	$d->reset();
	$sql_banner = "select photo from #_background where type='logo' limit 0,1";
	$d->query($sql_banner);
	$row_logo = $d->fetch_array();

  $d->reset();
  $sql = "select id,ten$lang as ten,tenkhongdau,photo,ngaytao,mota$lang as mota from #_news where type='tin-tuc' and hienthi=1 order by ngaytao desc limit 0,5";
  $d->query($sql);
  $tinmoi1 = $d->result_array(); 

    $d->reset();
    $sql = "select id,ten$lang as ten,tenkhongdau,photo from #_news_danhmuc where type='giai-phap-kinh-doanh' and hienthi=1 order by stt,id desc limit 0,1";
    $d->query($sql);
    $giaiphap_danhmuc = $d->result_array();   	
?>
<div class="top-header">
	<div class="container">
		<div class="col-md-5 sponsor-news-block">
			<div class="sponsor-news-notifi-wrap">
		        <span class="sponsor-news-notifi"><?=count($tinmoi1)?></span>
		    </div>
    		<div class="sponsor-news-inner"> 
                <?php foreach ($tinmoi1 as $key => $v) {?>
                <div class="spon">
                    <p>
                        <a href="tin-tuc/<?=$v['tenkhongdau']?>.html" target="_blank"><?=$v['ten']?></a>
                    </p>
                </div>

                <?php }?>
            </div>
		</div>
		<ul class="nav navbar-nav lang-nav">
            <li class="<?php if($lang=='en'){echo 'active';} ?>">
                <a href="index.php?com=ngonngu&lang=en" title="English">
                    <span>EN</span>
                </a>
            </li>
            <li class="<?php if($lang==''){echo 'active';} ?>">
                <a href="index.php?com=ngonngu&lang=" title="Việt Nam">
                    <span>VN</span>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-nav top-menu">
            <li class="top-menu-item home-item">
                <a href=""><?=_trangchu?></a>
            </li>
            <li class="top-menu-item career-item">
                <a href="tuyen-dung.html"><?=_cohoinghenghiep?></a>
            </li>
            <li class="top-menu-item contact-item">
                <a href="line-he.html"><?=_lienhe?></a>
            </li>
        </ul>
	</div>
</div>
<nav class="navbar main-header">
    <div class="container">
        <button class="menu-mobile-toggle" type="button" title="MENU">
            <span class="line line-top"></span>
            <span class="line line-middle"></span>
            <span class="line line-bottom"></span>
        </button>
        <h1 class="navbar-header logo">
            <a class="navbar-brand" href="">
                <img src="<?=_upload_hinhanh_l.$row_logo['photo']?>" alt="<?=$company['ten']?>">
            </a>
        </h1>
      	<div class="menu">
            <ul class="nav navbar-nav main-menu" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="treeview <?php if($com=='gioi-thieu'){echo 'active';} ?>">
    				<a itemprop="item" href="gioi-thieu.html">
        				<span itemprop="name"><?=_gioithieu?></span>
    				</a>
        			<meta itemprop="position" content="2">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="treeview <?php if($com=='giai-phap-kinh-doanh'){echo 'active';} ?>">
				    <a itemprop="item" id="link_menu_business_solution" href="giai-phap-kinh-doanh/<?=$giaiphap_danhmuc[0]['tenkhongdau']?>">
				        <span itemprop="name"><?=_giaiphapkinhdoanh?></span>
				    </a>
				    <meta itemprop="position" content="2">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="treeview <?php if($com=='khu-vuc'){echo 'active';} ?>">
				    <a itemprop="item" href="khu-vuc.html">
				        <span itemprop="name"><?=_khuvuc?></span>
				    </a>
				    <meta itemprop="position" content="2">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="treeview <?php if($case=='khach-hang'){echo 'active';} ?>">
				    <a itemprop="item" href="yeu-cau-dich-vu.html">
				        <span itemprop="name"><?=_khachhang?></span>
				    </a>
				    <meta itemprop="position" content="2">
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="treeview <?php if($com=='tin-tuc'){echo 'active';} ?>">
				    <a itemprop="item" href="tin-tuc.html">
				        <span itemprop="name"><?=_tintuctruyenthong?></span>
				    </a>
				    <meta itemprop="position" content="2">
				</li>
            </ul>
        </div>
    </div>
</nav>