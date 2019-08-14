<?php
	$d->reset();
	$sql_trai="select ten$lang as ten,link,photo from #_slider where type='letruot' and vitri='left' and hienthi=1 order by stt,id desc";
	$d->query($sql_trai);
	$letruot_trai=$d->result_array();
	
	$d->reset();
	$sql_phai="select ten$lang as ten,link,photo from #_slider where type='letruot' and vitri='right' and hienthi=1 order by stt,id desc";
	$d->query($sql_phai);
	$letruot_phai=$d->result_array();
?>
<div id="divAdLeft" style="DISPLAY: none; POSITION: absolute; TOP: 0px; z-index:100;">
 	<?php for($i=0,$count_letruot_trai=count($letruot_trai);$i<$count_letruot_trai;$i++){?>
    	<a href="<?=$letruot_trai[$i]['link']?>" title="<?=$letruot_trai[$i]['ten']?>" ><img src="<?=_upload_hinhanh_l.$letruot_trai[$i]['photo']?>" width="150px" /></a>
	<?php } ?>
</div>

<div id="divAdRight" style="DISPLAY: none; POSITION: absolute; TOP: 0px; z-index:100;">
	<?php for($i=0,$count_letruot_phai=count($letruot_phai);$i<$count_letruot_phai;$i++){ ?>
    	<a href="<?=$letruot_phai[$i]['link']?>" title="<?=$letruot_phai[$i]['ten']?>" ><img src="<?=_upload_hinhanh_l.$letruot_phai[$i]['photo']?>" width="150px" /></a>
    <?php } ?>
</div>

<script type="text/javascript">
	function FloatTopDiv()
	{
		startLX = ((document.body.clientWidth -MainContentW)/2)-LeftBannerW-LeftAdjust , startLY = TopAdjust+80;
		startRX = ((document.body.clientWidth -MainContentW)/2)+MainContentW+RightAdjust , startRY = TopAdjust+80;
		var d = document;
		function ml(id)
		{
			var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
			el.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
			el.x = startRX;
			el.y = startRY;
			return el;
		}
		function m2(id)
		{
			var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
			e2.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
			e2.x = startLX;
			e2.y = startLY;
			return e2;
		}
		window.stayTopLeft=function()
		{
			if (document.documentElement && document.documentElement.scrollTop)
				var pY =  document.documentElement.scrollTop;
			else if (document.body)
				var pY =  document.body.scrollTop;
			if (document.body.scrollTop > 30){startLY = 3;startRY = 3;} else {startLY = TopAdjust;startRY = TopAdjust;};
			ftlObj.y += (pY+startRY-ftlObj.y)/16;
			ftlObj.sP(ftlObj.x, ftlObj.y);
			ftlObj2.y += (pY+startLY-ftlObj2.y)/16;
			ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			setTimeout("stayTopLeft()", 1);
		}
		ftlObj = ml("divAdRight");
		ftlObj2 = m2("divAdLeft");
		stayTopLeft();
	}
	function ShowAdDiv()
	{
		var objAdDivRight = document.getElementById("divAdRight");
		var objAdDivLeft = document.getElementById("divAdLeft");       
		if (document.body.clientWidth < 1000)
		{
			objAdDivRight.style.display = "none";
			objAdDivLeft.style.display = "none";
		}
		else
		{
			objAdDivRight.style.display = "block";
			objAdDivLeft.style.display = "block";
			FloatTopDiv();
		}
	} 
</script>
<script type="text/javascript">
    document.write("<script type='text/javascript' language='javascript'>MainContentW = 1000;LeftBannerW = 150;RightBannerW = 150;LeftAdjust = 0;RightAdjust = 0;TopAdjust = 2;ShowAdDiv();window.onresize=ShowAdDiv;;<\/script>");
</script>