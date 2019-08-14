<?php
	
	$d->reset();
	$sql="select id,ten$lang as ten,link,photo from #_slider where hienthi=1 and type='doitac' order by stt,id desc";
	$d->query($sql);
	$doitac=$d->result_array();

?>
<script src="js/hiei.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript">
marqueeInit({
	uniqueid: 'mycrawler2',
	style: {
	
		'width': '100% !important'
	},
	inc: 5, //speed - pixel increment for each iteration of this marquee's movement
	mouse: 'cursor driven', //mouseover behavior ('pause' 'cursor driven' or false)
	moveatleast:1,
	neutral: 150,
	savedirection: true,
	random: true
});
</script>    

<div class="wap_1200">
<div id="doitac">	
<div class="marquee" id="mycrawler2">
	<?php for($i=0;$i<count($doitac);$i++){ ?>
    	<a href="<?=$doitac[$i]['link']?>" title="<?=$doitac[$i]['link']?>" target="_blank"><img src="<?=_upload_hinhanh_l.$doitac[$i]['photo']?>" alt="<?php if($doitac[$i]['ten']!='') echo $doitac[$i]['ten'];else echo $company['ten']?>" /></a>
    <?php } ?>
</div>
</div>
</div>
