<?php

class xml_parser
{
	var $vals;
	var $index;
	var $data = array();
	
	function xml_parser($file=''){
		if($file) $this->load($file);
	}
	
	function load($file){
		$content = @file_get_contents($file);	
		$xml_parser = xml_parser_create();
		
		xml_parse_into_struct($xml_parser, $content, $this->vals, $this->index);
		xml_parser_free($xml_parser);
	}
	
	function getBodyArray($num=20){
		$count = 0;
		foreach( $this->vals as $el){
			
			if($el['level']==4)
				$this->data[$count][strtolower($el['tag'])] = $el['value'];
			
			if(($el['tag']=='ITEM') && ($el['level']==3) && ($el['type']=='close'))
				$count++;
			
			if($count == $num) break;
		}
		
		return $this->data;
	}
}

/**
 * An open source application development framework for PHP5
 *
 * @author		Md. Kausar Alam (kausar_ss2003(at)yahoo.com)
 * @since		Version 1.0
 * file namw   feed.class.php 
 * @filesource
 */

// xmlGenerator class
class feedGenerator 
{

	//call constractor
	function feedGenerator($xml='')
	{
		$this->xmlDoc = new DOMDocument();
		if($xml) $this->load($xml);
	}
	
	function load($xml){
		$this->xmlDoc->load($xml);		
	}
	
   /*
	* get link/description/title
	* eleminate the unwnate char repalceing HTML char
	*/
	function replaceHTMLCharacter($str)
	{
		$str  = preg_replace('/&/',		'&amp;',	$str);
		$str  = preg_replace('/</',		'&lt;',		$str);
		$str  = preg_replace('/>/',		'&gt;',		$str);
		$str  = preg_replace('/\"/',	'&quot;',	$str);
		$str  = preg_replace('/\'/',	'&apos;',	$str);

		return $str;
	}
	
	// get header only
	function getHeader()
	{					
		$channel		= $this->xmlDoc->getElementsByTagName('channel')->item(0);
		 // get channel title 
		$channel_title  = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
		$item_title  	= $this->replaceHTMLCharacter($item_title);
		// get channel link
		$channel_link 	= $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
		$channel_link   = $this->replaceHTMLCharacter($channel_link);		
		// get channel description
		$channel_desc 	= $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
		$channel_desc   = $this->replaceHTMLCharacter($channel_desc);
		
		//return  header
		return '<?xml version="1.0" encoding="UTF-8" ?>
				 <rss xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">						
				 <channel>						
				 <title>'.$channel_title.'</title>
				 <description>'.$channel_desc.'</description>
				 <link>'.$channel_link.'</link>						
				<language>en-us</language>';
	
	}
	
	// main body of xml file here generate
	function getBody()
	{
		
		$strBody= "";					
		//get and output "<item>" elements
		$x= $this->xmlDoc->getElementsByTagName('item');
		//loop will continue untill out site's xml file has finished
		for ($i=0; $i<$x->length; $i++)
		 {
		     //get title
			 $item_title  = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
			 $item_title  = $this->replaceHTMLCharacter($item_title);			 
			 //get link
			 $item_link   = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;			 
			 $item_link   =  $this->replaceHTMLCharacter($item_link);			 
			 //get description
			 $item_desc   =  $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;			
			 $item_desc   =  $this->replaceHTMLCharacter($item_desc);
			 
			 $strBody= $strBody . '<item><title>'.$item_title.'</title>
									  <description>'.$item_desc.'</description>
									  <link>'.$item_link.'</link>
									  <guid isPermaLink="true">'.$item_link.'</guid>
									  </item>';
									  	
		 }
		 //return main body of xml file
		return $strBody;
	}
	//return footer
	function getFooter()
	{	
	 	 return "</channel></rss>";
	}
	
	//write all data in xml file
	function generateXMLFile()
	{
		$handle  = fopen("feed.xml", "w");
		fwrite($handle , $this->getHeader());
		fwrite($handle , $this->getBody());
		fwrite($handle , $this->getFooter());
		fclose($handle);
	}

#--------------------------------- thai

	function getBodyHtml($num=0)
	{
		$strBody= "";					
		//get and output "<item>" elements
		$x= $this->xmlDoc->getElementsByTagName('item');
		$num = ($num==0) ? $x->length : $num;
		//loop will continue untill out site's xml file has finished
		for ($i=0; $i<$num; $i++)
		 {
		   //get title
			 $item_title  = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
			 $item_title  = $this->replaceHTMLCharacter($item_title);			 
			 
			 //get link
			 $item_link   = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;			 
			 $item_link   =  $this->replaceHTMLCharacter($item_link);			 
			 
			 //get description
			 $item_desc   =  $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;			
			 $item_desc   =  $this->replaceHTMLCharacter($item_desc);
			 
			 $strBody= $strBody .'<div class="rss_box">';
			 $strBody= $strBody .'<div class=title><a target="_blank" href="'.$item_link.'">'.$item_title.'</a></div>';
			 $strBody= $strBody .'<div class="desc">'.$item_desc.'</div>';
			 #$strBody= $strBody .'<div> <a href="'.$item_link.'">'.$item_link.'</a></div>';
			 $strBody= $strBody .'</div>';
		 }
		 //return main body of xml file
		return $strBody;
	}

	function getBodyArray($num=0)
	{
		$arrBody= array();					
		//get and output "<item>" elements
		$x= $this->xmlDoc->getElementsByTagName('item');
		$num = ($num==0) ? $x->length : $num;
		//loop will continue untill out site's xml file has finished
		for ($i=0; $i<$num; $i++)
		 {
		   //get title
			 $item_title  = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
			 $arrBody[$i]['title']  = $this->replaceHTMLCharacter($item_title);			 
			
			 //get link
			 $item_link   = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;			 
			 $arrBody[$i]['link']   =  $this->replaceHTMLCharacter($item_link);			 
			 
			 //get description
			 $item_desc   =  $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;			
			 #$arrBody[$i]['description']   =  $this->replaceHTMLCharacter($item_desc);
			 $arrBody[$i]['description']   =  $item_desc;
		 }
		 //return main body of xml file
		return $arrBody;
	}


}// end of class
	
	//create object
	#$feedApp =new feedGenerator("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");	
	
	#$feedApp =new feedGenerator();
	#$feedApp->load("http://www.laodong.com.vn/Home/kinhte.rss");
	
	#$content =  $feedApp->getBodyHtml(2);
	#$content =  $feedApp->getBodyArray(2);
	
	//write on xml file
	#$feedApp->generateXMLFile();

	#header('location:feed.xml');
	#exit();
?> 