<div class="tieude_giua"><span><?=$title_cat?></span></div>
<div class="link_seo"><span><?=$linkseo?></span></div>
<div class="wap_item">
	<?php for($i=0,$count_product=count($product);$i<$count_product;$i++)
		{ 
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $product[$i]['link'], $matches);;
		$id_video =	$matches[1];
	?>
        <div class="item">
            <a class="xem_video" href="<?=$id_video?>" title="<?=$product[$i]['ten']?>">
            <img src="http://img.youtube.com/vi/<?=$id_video?>/0.jpg" alt="<?=$product[$i]['ten']?>" /></a>
            <h3><a class="xem_video" href="<?=$id_video?>" title="<?=$product[$i]['ten']?>"><?=$product[$i]['ten']?></a></h3>
        </div><!---END .item-->
    <?php } ?>
<div class="clear"></div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div><!---END .wap_item-->

<script type="text/javascript">
	$(document).ready(function(e) {
        $('a.xem_video').click(function(){
			var link_viveo = $(this).attr('href');
			$('body').append('<div class="login-popup"><div class="close-popup"></div><div class="video_popup"><iframe width="700px" height="400px" src="https://www.youtube.com/embed/'+link_viveo+'?rel=0" frameborder="0" allowfullscreen></iframe></div></div>');
			$('.login-popup').fadeIn(300);
						
			var chieucao = $('.login-popup').height() / 2;
			var chieurong = $('.login-popup').width() /2;
			$('.login-popup').css({'margin-top':-chieucao,'margin-left':-chieurong});
			$('body').append('<div id="baophu"></div>');
			$('#baophu').fadeIn(300);
			return false;
			
		});
		$('#baophu, .close-popup').live('click',function(){
			$('#baophu, .login-popup').fadeOut(300, function(){
				$('#baophu').remove();
				$('.login-popup').remove();
			});			
		});
    });
</script>