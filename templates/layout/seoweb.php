<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="<?=_upload_hinhanh_l.$company['faviconthumb']?>" type="image/x-icon" />
<META NAME="ROBOTS" CONTENT="<?=$config['nobots']?>" />
<link rel="canonical" href="<?=getCurrentPageURL_CANO()?>" />
<meta name="author" content="<?=$company['ten']?>" />
<meta name="copyright" content="<?=$company['ten']?> [<?=$company['email']?>]" />
<title><?php if($title!='')echo $title;else echo $company['title'];?></title>
<meta name="keywords" content="<?php if($keywords!='')echo $keywords;else echo $company['keywords'];?>" />
<meta name="description" content="<?php if($description!='')echo $description;else echo $company['description'];?>" />
<meta name="DC.title" content="<?php if($title!='')echo $title;else echo $company['title'];?>" />
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="<?=$company['diachi']?>" />
<?php /*?><meta name="geo.position" content="<?=str_replace(',',':',$company['toado'])?>" />
<meta name="ICBM" content="<?=$company['toado']?>" /><?php */?>
<meta name="DC.identifier" content="http://<?=$config_url?>/" />
<meta property="og:image" content="<?php if($images_facebook!=''){echo $images_facebook;}else{echo $company['images'];}?>" />
<meta property="og:title" content="<?php if($title_facebook!=''){echo $title_facebook;}else{echo $company['title'];}?>" />
<meta property="og:url" content="<?=getCurrentPageURL();?>" />
<meta property="og:site_name" content="http://<?=$config_url?>/" />
<meta property="og:description" content="<?php if($description_facebook!=''){echo $description_facebook;}else{echo $company['description'];}?>" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="<?=$company['ten']?>" />
<?php if($source!='index') { ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51d3c996345f1d03" async="async"></script>
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-550a87e8683b580f" async="async"></script>-->
<?php } ?>


<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=605721246538980&autoLogAppEvents=1"></script>
<div id="fb-root"></div>