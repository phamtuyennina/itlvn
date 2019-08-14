<?php
	
	$d->reset();
	$sql_intro = "select photo from #_background where type='intro' limit 0,1";
	$d->query($sql_intro);
	$intro = $d->fetch_array();
			
?>

<a href=""><img src="<?=_upload_hinhanh_l.$intro['photo']?>" class="logo" /></a>
<img src="images/saolaplanh.png" class="start-animate intro_sang_header" alt="Sáng lấp lánh" />

