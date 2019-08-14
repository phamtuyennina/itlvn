<?php
/*
	if(isset($_FILES['hinhanh']))
	{
		$p = new myupload;
		
		$p->path = dirname($_SERVER['SCRIPT_FILENAME'])."/images/";
		$p->file = $_FILES['hinhanh'];
		#$p->new_name = 'aaaa';
		#$p->overwrite = true;
		$filename = $p->do_upload();
		#var_dump($filename);
		
		$p->new_width = 50;
		$p->new_height = 50;
		#$p->path = dirname($_SERVER['SCRIPT_FILENAME'])."/images/";
		#$p->name = "thai.jpg";
		#$p->new_name = 'aaaa';
		var_dump($p->do_thumb($filename));
	}
	*/
///////////////////////////////////////////////////////////////
class myupload
{
	var $path;	

	var $file;
	var $name;		
	var $tmp_name;
	var $size;
	var $error;
	var $type;
	
	var $overwrite		= FALSE;
	
	var $new_name;		//filename
	var $new_width;
	var $new_height;
	
	#var $allowedtypes = array ("image/jpeg","image/pjpeg","image/png","image/gif");
	var $allowedtypes = "jpg, gif, png";


//////////////////////////////////

	function do_upload(){
		if(!isset($this->file))
			return false;
		
		$this->set_file($this->file);
	
		if(!isset($this->tmp_name))
			return false;
		
		if($this->error)
			return false;
		
#		if(!$this->check_allow())
#			return false;
			
		$this->name = $this->set_name($this->path, $this->name);
		
		if(!$this->name)
			return false;
			
		if (!copy($this->tmp_name, $this->path.$this->name))	{
			if ( !move_uploaded_file($this->tmp_name, $this->path.$this->name))	{
				return false;
			}
		}
		
		return $this->name;
	}
	
#---------------------------------------------------------------------------------	
#	[name] => location_map.jpg
#	[type] => image/jpeg
#	[tmp_name] => C:\Program Files\xampp\tmp\php2D2.tmp
#	[error] => 0
#	[size] => 41458
#---------------------------------------------------------------------------------
	function set_file($file){
		foreach($file as $k=>$v)
			$this->$k = $v;
	}
	
#---------------------------------------------------------------------------------	

	function set_path($s){
		$this->path = $s;
	}
	
#---------------------------------------------------------------------------------	

	function set_new_name($s){
		$this->new_name = $s;
	}
	
#---------------------------------------------------------------------------------	

	function check_allow(){
		return in_array($this->type, $this->allowedtypes);
	}
	
#---------------------------------------------------------------------------------	

	function set_name($path, $name){
		$name = strtolower($name);
		#$info = pathinfo($this->name);
		#$ext = '.'.$info['extension'];
		#$filename = $info['basename'];
		$ext = end(explode(".", $this->name));
		$filename = basename($this->name, '.'.$ext);
		
		if(!strstr($this->allowedtypes, $ext))
			return false;
		
		if(isset($this->new_name)){
			$filename = $this->new_name;
			unset($this->new_name);
		}
		
		if (!file_exists($path.$filename.'.'.$ext))
			return $filename.'.'.$ext;
		
		if($this->overwrite)
			return $filename.'.'.$ext;
		
		$new_filename = false;
		for ($i = 1; $i < 1000; $i++)	{			
			if (!file_exists($this->path.$filename.$i.'.'.$ext)){
				$new_filename = $filename.$i.'.'.$ext;
				break;
			}
		}
		
		return $new_filename;
	}
	
#---------------------------------------------------------------------------------	

	function dump($arr, $f = 0){
		echo "<pre>";
		if($f)
			var_dump($arr);
		else
			print_r($arr);
		echo "<pre>";	
	}
#---------------------------------------------------------------------------------
#	set: $path , $name, $new_width, $new_height, $thumb_name
#---------------------------------------------------------------------------------		
	
	function do_thumb($name = ""){	
		if($name!="")
			$this->name = $name;
		
		if(!file_exists($this->path.$this->name))
			return false;
		
		$thumb_name = $this->set_name($this->path, $this->name);
		$thefile = $this->path.$this->name;
		
		if ($cursize = getimagesize ($thefile)) {					
			$newsize = $this->setWidthHeight($cursize[0], $cursize[1], $this->new_width, $this->new_height);
			$info = pathinfo ($thefile);
			$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);
			
			$types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
						'gif' => array('imagecreatefromgif', 'imagegif'),
						'png' => array('imagecreatefrompng', 'imagepng'));
			$func = $types[$info['extension']][0];
			$src = $func($thefile); 
			imagecopyresampled($dst, $src, 0, 0, 0, 0,$newsize[0], $newsize[1],$cursize[0], $cursize[1]);
			$func = $types[$info['extension']][1];
			return $func($dst, $this->path.$thumb_name) ? $thumb_name : false;
		}
	}
	
	function setWidthHeight($width, $height, $maxWidth, $maxHeight)
	{
		$ret = array($width, $height);
		$ratio = $width / $height;
		if ($width > $maxWidth || $height > $maxHeight) {
			$ret[0] = $maxWidth;
			$ret[1] = $ret[0] / $ratio;
			if ($ret[1] > $maxHeight) {
				$ret[1] = $maxHeight;
				$ret[0] = $ret[1] * $ratio;
			}
		}
		return $ret;
	}
	
	function remove($name){
		if(file_exists($this->path.$name))
			return unlink($this->path.$name);
		return false;
	}
}
?>