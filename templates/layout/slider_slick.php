<?php
	$d->reset();
	$sql_slider = "select ten$lang as ten,link,photo from #_slider where hienthi=1 and type='slider' order by stt,id desc";
	$d->query($sql_slider);
	$slider=$d->result_array();
?>
<div id="slider_slick">
	<?php  for($i=0,$count_slider=count($slider);$i<$count_slider;$i++){ ?>
        <?php if($slider[$i]['link']!='')echo '<a href="'.$slider[$i]['link'].'" target="_blank">' ?>	
<img src="timthumb.php?src=<?=_upload_hinhanh_l.$slider[$i]['photo']?>&h=657&w=1356&zc=1&q=100" title="<?=$slider[$i]['ten']?>"/>
		<?php if($slider[$i]['link']!='')echo '</a>' ?>
    <?php } ?>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#slider_slick').slick({
		  	lazyLoad: 'progressive',
			pauseOnHover:true,//Rê chuột vào đúng lại
        	infinite: true,
			accessibility:true,
		  	slidesToShow: 1,    //Số item hiển thị
		  	slidesToScroll: 1, //Số item cuộn khi chạy
		  	autoplay:true,  //Tự động chạy			
			autoplaySpeed:3000,  //Tốc độ chạy giữa 2 ảnh
			speed:3000,//tốc độ hiệu ứng chuyển ảnh
			arrows:true, //Hiển thị mũi tên
			centerMode:false,  //item nằm giữa
			dots:false,  //Hiển thị dấu chấm
			draggable:true,  //Kích hoạt tính năng kéo chuột
			//fade: true,   //Hiệu ứng fade
			mobileFirst:true,
      });
	});
 </script>



