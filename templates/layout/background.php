<?php
	
	$d->reset();
	$sql="select * from #_anhnen where type='background' limit 0,1";
	$d->query($sql);
	$background=$d->fetch_array();

?>

		<?php
			$str_background='style="';
			
		 if($background['photo']=='')
			{ $str_background.='background:#'.$background['color'];}
			else{
				$str_background.='background:url('._upload_hinhanh_l.$background['photo'].') #'.$background['color'].' ;';
				if($background['fix']==1){
					$str_background.='background-position:fixed;';
				}else{
					$str_background.='background-position:'.$background['position_x'].' '.$background['position_y'].';';
					$str_background.='background-size:'.$background['bgsize'].';';
					$str_background.='background-repeat:'.$background['trangthai'].';';
				}
				
			}
			$str_background.='"';
			echo $str_background;
		 ?>