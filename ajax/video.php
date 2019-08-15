<?php 

	include ("ajax_config.php");
	
	$d->reset();
	$sql_video = "select id,ten$lang as ten,link,ngaytao from #_video where hienthi=1 order by stt,id desc";
	$d->query($sql_video);
	$video = $d->result_array();
	
?>
<script type="text/javascript">

     $('body').on('click', 'a.link-other-video', function(event) {
        	var src = 'http://www.youtube.com/embed/'+$(this).data('video');
          $(".video_popup iframe").attr('src',src);
          $(".title-detail-video").text($(this).data('title'));

        });
</script>

<div class="video_popup left_video">
	<iframe title="<?=$video[0]['ten']?>" width="100%" src="http://www.youtube.com/embed/<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video[0]['link'], $matches);echo $matches[1];?>" frameborder="0" allowfullscreen></iframe>
</div>
<p class="title-detail-video"><?=$video[0]['ten']?></p>
<div class="lisst_video0">
	<ul class="block-list">
	<?php foreach ($video as $key => $v) {?>
		<li class="item itemvideo clearfix">
            <div class="video link-other-video">
                <a class="link-other-video" data-video="<?=getYoutubeIdFromUrl($v['link'])?>" data-title="<?=$v['ten']?>" href="javascript:void(0);"><img src="http://img.youtube.com/vi/<?=getYoutubeIdFromUrl($v['link'])?>/2.jpg"></a>
            </div>
            <div class="video-info">
              
                <a class="link-other-video" data-video="<?=getYoutubeIdFromUrl($v['link'])?>" href="javascript:void(0);"><?=$v['ten']?></a>
                <p><?=date('d/m/Y',$v['ngaytao'])?></p>
            </div>
        </li>
	<?php }?>
	</ul>
</div>
