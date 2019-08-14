<?php
class my_email{
	var $to;
	var $sender;
	var $subject;
	var $content;
	var $header;
	
	function Email($a = array()){
		if( count($a)>0)
			$this->set($a);
	}
	
	function set($a = array()){
		foreach($a as $k=>$v)
				$this->$k = $v;
		
		
	}
	
	function send(){
		if(!isset($this->header)){
			$this->header  = "MIME-Version: 1.0\r\n";
			$this->header .= "Content-type: text/html; charset=utf-8 \r\n";
		}
		
		if(isset($this->sender)){
			$this->header .= "From: ".$this->sender."\r\n";
			#$headers .= "From: Birthday Reminder <nthaih@yahoo.com>\r\n";
			#$headers .= "Cc: birthdayarchive@example.com\r\n";
			#$headers .= "Bcc: birthdaycheck@example.com\r\n";
			#$headers .= "Cc: birthdayarchive@example.com\r\n";
		}
		
		return @mail($this->to, $this->subject, $this->content, $this->header);
	}
}

?>