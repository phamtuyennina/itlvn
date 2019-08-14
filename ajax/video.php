<?php 

	include ("ajax_config.php");
	
	$d->reset();
	$sql_video = "select id,ten$lang as ten,link from #_video where hienthi=1 order by stt,id desc";
	$d->query($sql_video);
	$video = $d->result_array();
	
?>
<script type="text/javascript">
	$(document).ready(function(e) {
        $('#clickvideo').change(function(){
			var src = 'http://www.youtube.com/embed/'+$(this).val();
			$('.left_video iframe').attr('src',src);
		});
    });
</script>

<div class="video_popup left_video">
	<iframe title="<?=$video[0]['ten']?>" width="100%" src="http://www.youtube.com/embed/<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video[0]['link'], $matches);echo $matches[1];?>" frameborder="0" allowfullscreen></iframe></div>
<select id="clickvideo">
    <?php for($i=0,$count_video=count($video);$i<$count_video;$i++){?>
    <?php
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video[$i]['link'], $matches);
        $id_video =	$matches[1];
    ?>
        <option value="<?=$id_video?>"><?=$video[$i]['ten']?></option>
    <?php } ?>
</select>
