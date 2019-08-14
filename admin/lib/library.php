<?php
/* Defination of template_file Class
   Content : Load content of any file to browser
*/
	class  template_file
	{
		// define the properties
		var $content;
		var $error = 0;

	// define the methods
		function template_file($filename)
		{
			if (file_exists($filename))
			{
			$file = fopen($filename,"r");
			$this->content = fread($file,filesize($filename));
			$this->content=str_replace("%7B","{",$this->content);
			$this->content=str_replace("%7D","}",$this->content);
			}
			else
			{
			$this->error = 1;
			return;
			}
		}
	}         // end of template_file class
	
	class Template
	{
		#------------------------------------------------------------------------------
		#Load template
		var $strContent;
		var $error;
		
		function Template(){}
		function loadTemplate($filename)
		{
			$tpl_file="$filename";
			if (file_exists($filename))
			{
				$file = fopen($filename,"r");
				$this->strContent = fread($file,filesize($filename));
				$this->strContent=str_replace("%7B","{",$this->strContent);
				$this->strContent=str_replace("%7D","}",$this->strContent);
			}
			else
			{
				$this->error = 1;			
			}	
			
			if ($this->error)
			{
				echo ("Error: Template not found :$filename");
				exit;
			}
			else
			{	
			

				global $lang_id,$LANG_ENG;

				if($lang_id == $LANG_ENG)
					$this->strContent = str_replace("images/vie.gif","images/spacer.gif",$this->strContent);
				else
					$this->strContent = str_replace("images/eng.gif","images/spacer.gif",$this->strContent);

				$this->strContent = str_replace("../","",$this->strContent);
			}
			return $this->strContent;
		} 
		function transfer($msg,$page="index.php")
		{
		    
			$showtext = $msg;
			$page_transfer = $page;
			include("../tnl_includes/include/transfer_tpl.php");
			exit();
		}
		function dump($arr, $exit=1)
		 {
			echo "<pre>";	
				var_dump($arr);
			echo "<pre>";	
			if($exit)	exit();
         }
		function assign($find,$replace)
		{
			$this->strContent = str_replace($find,$replace,$this->strContent);
			return $this->strContent;
		}
		
		function assign_table($find,$replace,$strContent)
		{
			$strContent = str_replace($find,$replace,$strContent);
			return $strContent;
		}
	}
	
#-------------------------------------------------------------------------------------------
#Send Simple email
   function sendmail($mailto,$subject,$sender_name,$sender_email,$mailcontent)
   {
        
        ini_set("SMTP","localhost");
		
		$extra = "From: $sender_name <$sender_email>\nContent-Type:  text/html;charset=iso-8859-1\n Reply-To: Info Find A Home Sale <$sender_name>\n X-Priority: 1\n X-MSmail-Priority: High\n X-mailer: Find A Home mailer";
//		$extra .= "Content-Type:  text/html ";
		//echo $extra;
		//die();
        if(empty($mailto))
        {
          return FALSE;
        }
        if(mail($mailto,$subject,$mailcontent,$extra))
           return TRUE;
        else
           return FALSE;
   }
#-------------------------------------------------------------------------------------------
#Send email
   function sendmail_ext($mailto,$mailcc,$subject,$sender_name,$sender_email,$mailcontent)
   {
        $extra  = "From: $sender_name<$sender_email>\n";
		$extra .= "CC:  $mailcc\n";
		$extra .= "Content-Type:  text/html ";
        if(empty($mailto))
        {
          return FALSE;
        }
        if(mail($mailto,$subject,$mailcontent,$extra))
           return TRUE;
        else
           return FALSE;
   }
#-------------------------------------------------------------------------------------------
#Input : yyyy-mm-dd
#Out   : mm/dd/yyyy
   function displayDate_($str)
   {
	list($y,$m,$d)=split('[/.-]',$str);
	return date("m-d-Y",mktime(0,0,0,$m,$d,$y));
   }
#-------------------------------------------------------------------------------------------
#Display year got from mysql databse
#Input : yyyy-mm-dd
#Out   : dd/mm/yyyy
   function displayDate($str)
   {
		
		list($y,$m,$d)=split('[/.-]',$str);
		if(!checkdate($m,$d,$y))
        {
        	return date("d/m/Y");
        }
        return date("d/m/Y",mktime(0,0,0,$m,$d,$y));
   }
#------------------------------------------------------------------------------------------------
#Format input date of user to mysql server
#Input : mm/dd/yyyy
#Out   : yyyy-mm-dd

   function formatInputDate($str)
   {
		list($m,$d,$y)=split('[/.-]',$str);
        if(!checkdate($m,$d,$y))
        {
        	return date("Y-m-d");
        }else
		return "$y-$m-$d";
   }
#------------------------------------------------------------------------------------------------
#Format input date of user to mysql server
#Input : dd/mm/yyyy
#Out   : yyyy-mm-dd

   function formatInputDate1($str)
   {
		list($d,$m,$y)=split('[/.-]',$str);
        if(!checkdate($m,$d,$y))
        {
        	return date("Y-m-d");
        }else
		return "$y-$m-$d";
   }

 #------------------------------------------------------------------------------------------------
 #Description :remove string start with $strStart & end with $strEnd in strContent
	function removeString($strStart,$strEnd,$strContent)
	{
		$intStart=strpos($strContent,"$strStart",0);
		$intEnd=strpos($strContent,"$strEnd",0);
		if($intStart===false || $intEnd===false)
		{
			return $strContent;
		}
		$strHeader=substr($strContent,0,$intStart);
		$strRow=substr($strContent,$intStart+strlen($strStart),$intEnd-$intStart-strlen($strStart));
		$strFooter=substr($strContent,$intEnd+strlen($strEnd),strlen($strContent));
		return $strHeader.$strFooter;
	}
#------------------------------------------------------------------------------------------------
#Description :Split a string into array 

	function partitionString($strStart,$strEnd,$strContent)
	{
		$intStart=strpos($strContent,"$strStart",0);
		$intEnd=strpos($strContent,"$strEnd",0);
		if($intStart===false || $intStart===false)
		{
			$dat[0]=$strContent;
			$dat[1]="";
			$dat[2]="";
			return $dat;

		}
		$strHeader=substr($strContent,0,$intStart);
		$strRow=substr($strContent,$intStart+strlen($strStart),$intEnd-$intStart-strlen($strStart));
		$strFooter=substr($strContent,$intEnd+strlen($strEnd),strlen($strContent));
		$dat=array();
		$dat[0]=$strHeader;
		$dat[1]=$strRow;
		$dat[2]=$strFooter;
		return $dat;
	}
#-----------------------------------------------------------------------------------   
function getMaxDayOfMonth($month,$year)
{
	$d=31;
	while($d>0 && !checkdate($month,$d,$year))
		$d--;
		return $d;

}
#------------------------------------------------------------------------------------
#Replace special chars to display in textbox correctly
function toTextBox($str)
{
	$a=str_replace("\"","&quot;",$str);
	return $a;
}
#------------------------------------------------------------------------------------
#Display source	
function toHTML( $str) 
	{
	    return htmlspecialchars($str) ;
	} 
#------------------------------------------------------------------------------------
#Format String before putting  into the query
function toSql( $str ) 
	{
		$s_tmp= addslashes( $str) ;
		return $s_tmp ;
	} 
#------------------------------------------------------------------------------------
#Get extension of a filename
function getFileExt($file_name) {
		$pos= strrpos($file_name, ".") ;
		if($pos > 0)
			return substr($file_name, $pos) ;
		return "" ;
	} 
#------------------------------------------------------------------------------------
function formatInputStr($str)
{
	$str=stripslashes($str);
	$str=addslashes($str);
	return $str;
}
function html_links($str) {
          $str = eregi_replace("([^=\"'>])((f|ht)tp:\/\/[a-z0-9~#%@\&:=?\/\._-]+[a-z0-9~#%@\&=?\/_-]+)", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http
          $str = eregi_replace("([^=/\"'>])(www\.[a-z0-9~#%@\&:=?\/\._-]+[a-z0-9~#%@\&=?\/_-]+)", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www.
          $str = eregi_replace("([^=\"':>])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","\\1<a href=\"mailto:\\2\">\\2</a>", $str); // mail
          $str = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?\/\._-]+[a-z0-9~#%@\&=?\/_-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http
          $str = eregi_replace("^(www\.[a-z0-9~#%@\&:=?\/\._-]+[a-z0-9~#%@\&=?\/_-]+)", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www.
          $str = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a href=\"mailto:\\1\">\\1</a>", $str); // mail
          return $str;
}

#------------------------------------------------------------------------------------
#Display text in HTML format (replace \r\n by <br>"
 function formatOutput($s)
    {
    	$s=str_replace("\r\n","<br>\r\n",$s);
		$s=html_links($s);
        return $s;
    }
#------------------------------------------------------------------------------------
function formatOutputStr($str)
{
	$str = str_replace("\&quot;","",$str);
	$str = str_replace("&quot;","\\\"",$str);
	
	$str = str_replace("\r\n","",$str);
	return $str;
}
#------------------------------------------------------------------------------------
#Remove special chars
function getNormalStr($str)
	{
		$i=0;
		$strRe="";
		while($i<strlen($str))
		{
			$c=substr($str,$i,1);
			if(!ereg("^[a-zA-Z0-9_.-]", $c))
				$c="_";
			$strRe.=$c;
			$i++;
		}
		if($strRe=="" && strlen($str)>1)
			$strRe="conrua";
		return $strRe;
	}
#------------------------------------------------------------------------------
#Format string to JS format
	function formatJS($s)
	{
		$s=str_replace("\r\n","\\n",$s);	
		$s=str_replace("\"","\\\"",$s);		
		$s=str_replace("\r","\\n",$s);			
		$s=str_replace("\n","\\n",$s);				
		$s=str_replace("'","\\'",$s);				
		return $s;
	}
#------------------------------------------------------------------------------
#Get Unique ID
	function sys_get_unique_id()
	{
		return time();
	}
#------------------------------------------------------------------------------
#Process some special chars of post vars before saving to database
function processPostVar($notVar=array())
	{
		global  $HTTP_POST_VARS;
		reset($HTTP_POST_VARS);
		while (list($key, $val) = @each($HTTP_POST_VARS)) 
		{
			if(is_string($val))
				$GLOBALS[$key] = stripslashes($val);
			if(!in_array($key,$notVar) && is_string($val))
				{
				$val=stripslashes($val);
				$val=(str_replace("\"","&quot;",$val));
	   		    $GLOBALS[$key] = $val;
				}
		}
		reset($HTTP_POST_VARS);
	}

#------------------------------------------------------------------------------
#Thao.hh
#field_name is the name of field in the form we upload
#if upload is ok ,return the new file name
function upload_file($field_name,$default_dir,$filename="")
{
	global $HTTP_POST_FILES;
	reset($HTTP_POST_FILES);
	//die($HTTP_POST_FILES["$field_name"]["name"]);
	if(is_file(($HTTP_POST_FILES["$field_name"]["tmp_name"]))!="")
	{
		
		$new_name=getNormalStr($HTTP_POST_FILES["$field_name"]["name"]);
		$new_name=getUniqueFileName($default_dir,$new_name);
		$new_name=($filename=="")?$new_name:$filename;		
		
		if($new_name!="")
		{
			$des=$default_dir."/".$new_name;
			
				
			if(copy($HTTP_POST_FILES["$field_name"]["tmp_name"],$des))
			{
					
				return $new_name;
			}	
			
		}
	}
	return "";
}
#--------------------------------------------------------------------------
function getSizeImage($img){
		$MAX_WIDTH = 60;
		$MAX_HEIGHT = 40;

		if (is_file($img)){
			$sizeImg = getimagesize($img);			
			$height = ($sizeImg[1] > $MAX_HEIGHT) ? $MAX_HEIGHT : $sizeImg[1];
			$width = ($sizeImg[0] > $MAX_WIDTH) ? $MAX_WIDTH : $sizeImg[0];
			$strSize = " width=\"$width\" height=\"$height\" ";

			return $strSize;
		}
		else{
			return "";
		}		
	}
#--------------------------------------------------------------------------
	function getUniqueFileName($default_dir,$file_name)//filename includes file path
	{			
		$filepath=$default_dir."/".$file_name;

		if(!is_file($filepath))
			return $file_name;

		$pos=strpos($file_name,".");
		if(!$pos)
		{
			return $file_name;
		}
		$file_name_src=substr($file_name,0,$pos);
		$ext=substr($file_name,$pos);
		
		for($i=0;$i<500;$i++)
		{
			$new_file_name=$file_name_src."_".$i.$ext;
			$new_path=$default_dir."".$new_file_name;
			
			if(!is_file($new_path))
			{
				return $new_file_name;
			}
		}
		$new_file_name=$file_name."_".time().$ext;		

		return $new_file_name;
	}

#--------------------------------------------------------------------------
	function ScaleImage($image,$max_width)
	{
	    $res = getimagesize($image);
		$width = $res[0];
		$height = $res[1];
		if ($width > $max_width)
		{ 
			$scale = $max_width/$width;
	  		$height = (int)( $scale * $height);
			$width =  $max_width;
		}
		return "width=\"$width\" height = \"$height\"";
	}
#--------------------------------------------------------------------------
#Thao.hh
function get_page_list($total_page,$cur_page,$url,$lang_id=0)
{
	for($i=0;$i<$total_page && $total_page>1;$i++)
	{
		$pgx=$i+1;
		if($pgx!=$cur_page)
			$page_list.="<a href=\"$url$pgx\">$pgx</a> ";
		else
			$page_list.="<strong><font color=\"#000000\">[$pgx]</font></strong> ";
	}
	$page_list=($page_list=="")?"":"trang: $page_list" ;
	return $page_list;

}
#--------------------------------------------------------------------------
function get_lang()
{
	global $lang_id,$ses_lang_id;
	global $HTTP_SESSION_VARS;
	global $NUM_LANG;
	if($lang_id=="")
		$lang_id=$ses_lang_id;

	if($lang_id<0 || $lang_id>=$NUM_LANG || $lang_id=="")
		$lang_id=0;
	$ses_lang_id=$lang_id;
	$HTTP_SESSION_VARS["ses_lang_id"]=$lang_id;
	return $lang_id;
}
#--------------------------------------------------------------------------
function getMaxValue($table_name,$col_name)
{
	global $DB;
	$sql="select max($col_name) as xxx from $table_name";
	$stmt=new sutrix_query($DB,$sql);
	$row=$stmt->getrow();
	return (int)$row["xxx"];
}
#--------------------------------------------------------------------------

function get_public_lang()
{
	global $lang_id,$ck_lang_id,$NUM_LANG;
	if($lang_id=="")
		$lang_id=$ck_lang_id;

	if($lang_id=="")
		$lang_id=0;
	if($lang_id<0 || $lang_id>=$NUM_LANG)
		$lang_id=0;

	setcookie ("ck_lang_id", $lang_id,time()+3600*24*30); 
	return $lang_id;
}
#--------------------------------------------------------------------------
function  load_public_template($tpl_file,$lang_id)
{
	$lang_id=(int)$lang_id;
	$tpl_dir=($lang_id==1)?"tl_eng/":"tl_vie/";
	return loadTemplate($tpl_dir.$tpl_file);
}
#--------------------------------------------------------------------------
function loadTemplate1($tpl_file)
{
	$template = new template_file("$tpl_file");
	if ($template->error)
	{
		echo ("Error: Template not found :$tpl_file");
		exit;
	}
	else
	{	
		$strContent = $template->content;	

		global $ses_lang_id,$LANG_ENG;

		if($ses_lang_id == $LANG_ENG)
			$strContent = str_replace("images/vie.gif","images/spacer.gif",$strContent);
		else
			$strContent = str_replace("images/eng.gif","images/spacer.gif",$strContent);

	}
	return $strContent;
}

//------------------------------------------------------------
//Thang
//------------------------------------------------------------
function db_paging($url,$total_pages,$page)
{
 
 if($page > 1){ 
    //$pre="<img src='../images/b_back.gif' alt='Previous' width='11' height='15' border='0'>";
	$pre = "<<";
    $prev = ($page - 1); 
    $page_list="<a href=$url"."&page=$prev class=black_Text_Link>".$pre."</a></strong></font>&nbsp;"; 
  } 
  
  for($i = 1; $i <= $total_pages; $i++){ 
    if($page == $i)
	    { 
          $page_list.="<span class=black_Text_Link>[$i]&nbsp;</span>"; 
        } 
		else 
		{ 
          $page_list.="<a href=$url"."&page=$i class=black_Text_Link>$i</a>&nbsp;"; 
        } 
  } 

  if($page < $total_pages){ 
    //$nex = "<img src='../images/b_next.gif' alt='Next' width='11' height='15' border='0'>";
	$nex = ">>";
    $next = ($page + 1); 
    $page_list.="<a href=$url"."&page=$next class=black_Text_Link>".$nex."</a>"; 
  }  
  return $page_list; 
}

//----------------------------------------------------------------------------------
function dateToTimeStamp($date1)
{
	$a=split("/","$date1");
	return mktime(0,0,0,$a[1],$a[0],$a[2]);
}

//---------------------------------------------------------------------------------
function datetoDB($date)
{
	//yyyy-mm-dd
	$revertdate = explode("/",$date);
	$revertdate = $revertdate[2]."-".$revertdate[0]."-".$revertdate[1];
	return $revertdate;
}

function datetoPage($date)
{
		$revertdate = explode("-",$date);
		$revertdate = $revertdate[1]."/".$revertdate[2]."/".$revertdate[0];
		return $revertdate;
		
		
}  

//----------------------------------------------------------------------------------
function dbpaging($url,$total_pages,$page,$css)
{
	if($page > 1){ 
    //$pre="<img src='../images/b_back.gif' alt='Previous' width='11' height='15' border='0'>";
	$pre = "&laquo;  Previous";
    $prev = ($page - 1); 
    $page_list="<a href='$url"."&page=$prev' class='$css'>".$pre."</a></strong></font>&nbsp;"; 
  	} 
  
  	for($i = $page-5; $i <= $page+5; $i++){ 
    	if($page == $i && $i>0 && $i<=$total_pages)
	    { 
          $page_list.="<span class='$css'>[$i]&nbsp;</span>"; 
        } 
		else if($i>0 && $page!=$i  && $i<=$total_pages)
		{ 
          $page_list.="<a href='$url"."&page=$i' class='$css'>$i</a>&nbsp;"; 
        } 
  	}
 	 

  if($page < $total_pages){ 
    //$nex = "<img src='../images/b_next.gif' alt='Next' width='11' height='15' border='0'>";
	$nex = "Next &raquo; ";
    $next = ($page + 1); 
    $page_list.="<a href=$url"."&page=$next class='$css'>".$nex."</a>"; 
  }  
  return $page_list; 
}


//----------------------------------------------------------------------------------
function outputID($id,$forlen)
{
	$len = strlen($id);
	for($i=$len;$i<$forlen;$i++) 
	{
		$oid .= "0";
	}
	$oid .= $id;
	return $oid;
}

function inputID()
{
	return $id;
}

function outputDateTime($datetime)
{
	$datetime = explode(" ",$datetime);
	$d = explode("-",$datetime[0]);
	$datetime = $d[2]."/".$d[1]."/".$d[0];
	return $datetime; 
}


function outputDateTime1($datetime)
{
	$datetime = explode(" ",$datetime);
	$d = explode("-",$datetime[0]);
	$datetime = $d[1]."/".$d[2]."/".$d[0];
	return $datetime; 
}

function inputDateTime($datetime)
{
	
	if($datetime)
	{
		$datetime = explode("/",$datetime);		
		$date = $datetime[2]."-".$datetime[1]."-".$datetime[0];
	}
	else
	{
		$date = date("Y-m-d");
	}		
	$time = date("H:i:s");
	$datetime = $date." ".$time;
	return $datetime;	
}

function inputDateTime1($datetime)
{
	
	if($datetime)
	{
		$datetime = explode("/",$datetime);		
		$date = $datetime[2]."-".$datetime[1]."-".$datetime[0];
	}
	
	$datetime = $date;
	return $datetime;	
}
//----------------------------------------------------------------------------------
function compareDate($date1, $date2, $type=1)
{
if (!$type)
{
$date1 = displayDate1($date1);
$date2 = displayDate1($date2);
}
$n1 = dateToTimeStamp($date1);
$n2 = dateToTimeStamp($date2);

if ($n1 > $n2)
return 2;
else if ($n1 < $n2)
return 0;
else return 1;
}
//----------------------------------------------------------------------------------
function GetDataScroll()
{
	$scroll = new news_class();
	$num_rows = $scroll->get_list("", " order by date desc ");
	$arrContent = loadTemplate("data_scroll.txt");

	$scroll_data = "";
	$index = 0;
	for ($i=1; $i<=$num_rows; $i++)
	{
		$scroll->go_next();
		$scroll_data .= $arrContent."\r\n";
		$scroll_data  = str_replace("@order_id@", $index, $scroll_data);
		$scroll_data  = str_replace("@order_idx@", $index+1, $scroll_data);
		$scroll_data  = str_replace("@js_heading@", formatOutputStr($scroll->heading), $scroll_data);
		$scroll_data  = str_replace("@js_content@", formatOutputStr($scroll->content), $scroll_data);
		if ($i == $num_rows) $scroll_data  = str_replace("@height@", 0, $scroll_data);
		else $scroll_data  = str_replace("@height@", 10, $scroll_data);
		$index += 2;
	}

	return $scroll_data;
}

function checkIsParent($val, $source, $id){
	while(list($k, $v) = each($source)){
		if(isset($val[$v['ID']][$id]))
			return true;
	}
	return false;
}

function checkIsParent2($val, $id){
	while(list($k, $v) = each($val)){
		while(list($k1, $v1) = each($v)){
			if($k1 == $id)
				return true;
		}
	}
	return false;
}

function getAddress(){
	global $db;
	$sql = "select * from address order by Parent, Name";

	$stmt = new sutrix_query($db,$sql);
	$data = array();
	
	$data['country'] = array();
	$data['province'] = array();
	$data['district'] = array();
	$data['ward'] = array();
	$data['zone'] = array();
	$data['street'] = array();
	
	while($row = $stmt->getrow()){
		switch($row['Parent']){
			case 0:
				$data['country'][$row['ID']] = $row;
				break;
			default:			
				if(isset($data['country'][$row['Parent']]))
					$data['province'][$row['Parent']][$row['ID']] = $row;
				elseif(checkIsParent($data['province'], $data['country'], $row['Parent']))
					$data['district'][$row['Parent']][$row['ID']] = $row;
				elseif(checkIsParent2($data['district'], $row['Parent']))
					$data['ward'][$row['Parent']][$row['ID']] = $row;
				elseif(checkIsParent2($data['ward'], $row['Parent']))
					$data['zone'][$row['Parent']][$row['ID']] = $row;
				elseif(checkIsParent2($data['zone'], $row['Parent']))
					$data['street'][$row['Parent']][$row['ID']] = $row;
				break;
		}
	}
	return $data;
}

function strip_slashes (&$value) {
    if(!is_array($value)) {
        $value = stripslashes($value);
    } else {
        array_walk($value,'kng_strip_slashes');
    }
}

function clean_from_input(){
	$search	= array('|</?\s*SCRIPT.*?>|si',
					'|</?\s*FRAME.*?>|si',
					'|</?\s*OBJECT.*?>|si',
					'|</?\s*META.*?>|si',
					'|</?\s*APPLET.*?>|si',
					'|</?\s*LINK.*?>|si',
					'|</?\s*IFRAME.*?>|si',
					'|STYLE\s*=\s*"[^"]*"|si');

	$replace = array('');

	$resarray =	array();
	
	foreach (func_get_args() as $var) {
	    	
	    if (empty($var) || is_array($var)) {
	        return;
	    }
	    
	    if (isset($_REQUEST[$var])) {
            $ourvar = $_REQUEST[$var];
	    
            if (get_magic_quotes_gpc()) {
                strip_slashes($ourvar);
            }
	    } else if (isset($_FILES[$var])) {
        	$ourvar = $_FILES[$var];
	    } else {
	        $ourvar = null;
	    }	    
	    array_push($resarray, $ourvar);
	}

	if (func_num_args()	== 1) {
		return $resarray[0];
	} else {
		return $resarray;
	}
} 

function createRandomPassword($length) {

    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= $length) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}

function isOnlyNums ($str) {
	if (strlen(trim($str)) != 0) {
		if (preg_match ('/[^a-zA-Z0-9.]+/', $str) == 0) {
			if (preg_match ('/[^0-9.]+/', $str) == 0) {
				//echo 'ok num onnly';
				return true;
			} else {
				//echo 'therer few words';
				return false;
			}
		} else {
			//echo 'therer are some special chars.';
			return false;
		}
	} else {
	//	echo 'no str';
		return false;
	}
}

function rand_valid_code ($minlength, $maxlength, $useupper, $usespecial, $usenumbers)
{
$charset = "abcdefghijklmnopqrstuvwxyz";
if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
if ($usenumbers) $charset .= "0123456789";
if ($usespecial) $charset .= "~@#$%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
else $length = mt_rand ($minlength, $maxlength);
for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
return $key;
}

?>