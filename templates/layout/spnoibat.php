<?php
	
	$d->reset();
	$sql="select id,ten,tenkhongdau,thumb from #_product where hienthi=1 and noibat=1 order by stt,id desc limit 0,12";
	$d->query($sql);
	$doitac=$d->result_array();

?>

<!--jcau-->    
    <link rel="stylesheet" type="text/css" href="css/jcarousel.css" media="screen" />
    <script type="text/javascript" src="js/jquery.jcarousel.js"></script><!--jquery chạy hình ngan từng nhít một-->
    <script type="text/javascript">
		jQuery(document).ready(function() {
    	jQuery('#mycarousel').jcarousel({<!--thẻ ul id="mycarousel" sẽ được thực thi-->
    	wrap: 'circular',
		auto:4,
		scroll: 1
   	 	});    
	});
	</script>
<!--jcau-->  

<ul id="mycarousel" class="jcarousel-skin-tango" style="overflow:hidden;">
    <?php for($i=0,$count_doitac=count($doitac);$i<$count_doitac;$i++){ ?>
       <li>
        <a href="<?=$doitac[$i]['tenkhongdau']?>.html" title="<?=$doitac[$i]['ten']?>"><img src="<?=_upload_sanpham_l.$doitac[$i]['thumb']?>" alt="<?=$doitac[$i]['mota']?>" /></a>
        <a href="<?=$doitac[$i]['tenkhongdau']?>.html" title="<?=$doitac[$i]['ten']?>"><h4><?=$doitac[$i]['ten']?></h4></a>
      </li> 
     <?php } ?>
</ul>