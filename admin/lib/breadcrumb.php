<?php
class breadcrumb{
	public $link;
	
	public function add($name,$link){
		
		$this->link[] = array("name"=>$name,"link"=>$link);
		
	}
	public function display(){
		$str = '<div id="inner">';
		foreach($this->link as $k=>$v){
			$str.="<a class='transitionAll' href='".$v['link']."'>".$v['name']."</a><i class='fa fa-caret-right'></i>";
		}
		$str.="</div>";
		return $str;
	
	}
}