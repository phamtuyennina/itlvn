<script type="text/javascript">
$(document).ready(function(e) {
     $('.chon').change(function(e) {
			var dongy = this.checked;
			if(dongy != ''){
				$(this).parent().find("img").attr('src','media/images/objects_007.gif');
			} else { 
				$(this).parent().find("img").attr('src','media/images/khong.png');
			}
     });
	 $('#save_tin,#savee_tin').click(function(e) {
		$('.chon').each(function(index, element) {
           var dongy = this.checked;
		   if(dongy != ''){
			   var tieude = $(this).parent().parent().parent().parent('td').find("#tieude").val();
			   var mota = $(this).parent().parent().parent().parent('td').find("#mota").val();
			   var noidung = $(this).parent().parent().parent().parent('td').find("#noidung").val();
			   var ngaydang = $(this).parent().parent().parent().parent('td').find("#ngaydang").val();
			   $.ajax ({
					type: "POST",
					url: "vnexpress.php",
					data: {tieude:tieude,mota:mota,noidung:noidung,ngaydang:ngaydang},
					success: function(result) { 
						$('div#inline_content').html(result);	
						document.location.href="index.php?com=vnexpress&act=man";
					}
			   });
		   }
        });
		
        return false;
    });
});
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=vnexpress&act=man">Thêm Tin Tức Từ Vnexpress</a></li>
            <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<div class="widget">
<form name="frm" method="post" action="index.php?com=vnexpress&act=save" enctype="multipart/form-data" class="nhaplieu">
<?
 
function getdata($url, $start, $stop, $str_to_replace='', $str_replace='', $extra_data='')
{
$fd = "";
$start_pos = $end_pos = 0;
$url = fopen($url, "r");
while(true) {
if($end_pos > $start_pos) {
$result = substr($fd, $start_pos, $end_pos-$start_pos);
$result .= $stop;
break;
}
$data = fread($url, 8192);
if(strlen($data) == 0) break;
$fd .= $data;
if(!$start_pos) $start_pos = strpos($fd, $start);
if($start_pos) $end_pos = strpos(substr($fd, $start_pos), $stop) + $start_pos;
}
fclose($url);
 
$info=str_replace($str_to_replace, $str_replace, $extra_data.$result);
 
return $info;
}
?>

<ul class="tabs">          
    <li <?php if($_GET['mod']=='tin-moi-nhat' or $_GET['mod']=='')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=tin-moi-nhat'>Tin Mới Nhất</a></li>
    <li <?php if($_GET['mod']=='thoi-su')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=thoi-su'>Thời Sự</a></li>
    <li <?php if($_GET['mod']=='the-gioi')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=the-gioi'>Thế giới</a></li>
    <li <?php if($_GET['mod']=='kinh-doanh')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=kinh-doanh'>Doanh nghiệp</a></li>
    <li <?php if($_GET['mod']=='phap-luat')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=phap-luat'>Pháp Luật</a></li>
    <li <?php if($_GET['mod']=='khoa-hoc')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=khoa-hoc'>Khoa học</a></li>
    <li <?php if($_GET['mod']=='oto-xe-may')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=oto-xe-may'>Oto xe máy</a></li>
    <li <?php if($_GET['mod']=='cong-dong')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=cong-dong'>Cộng đồng</a></li>
    <li <?php if($_GET['mod']=='tam-su')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=tam-su'>Tâm sự</a></li>
    <li <?php if($_GET['mod']=='cuoi')echo 'class="activeTab"' ?>><a href='index.php?com=vnexpress&act=add&mod=cuoi'>Cười</a></li>
</ul>

<?
    $file='http://vnexpress.net/rss/tin-moi-nhat.rss';
    switch($_REQUEST['mod'])
    {
	case "tin-moi-nhat":
    $file='http://vnexpress.net/rss/tin-moi-nhat.rss';
    break;
	case "thoi-su":
    $file='http://vnexpress.net/rss/thoi-su.rss';
    break;
    case "the-gioi":
    $file='http://vnexpress.net/rss/the-gioi.rss';
    break;
    case "kinh-doanh":
    $file='http://kinhdoanh.vnexpress.net/rss/doanh-nghiep.rss';
    break;
    case 'phap-luat':
    $file='http://vnexpress.net/rss/phap-luat.rss';
    break;
    case 'khoa-hoc':
    $file="http://vnexpress.net/rss/khoa-hoc.rss";
    break;
    case 'oto-xe-may':
    $file='http://vnexpress.net/rss/oto-xe-may.rss';
    break;
	case 'cong-dong':
    $file='http://vnexpress.net/rss/cong-dong.rss';
    break;
	case 'tam-su':
    $file='http://vnexpress.net/rss/tam-su.rss';
    break;
	case 'cuoi':
    $file='http://vnexpress.net/rss/cuoi.rss';
    break;
    default:
    $file='http://kinhdoanh.vnexpress.net/rss/doanh-nghiep.rss';
    break;
    }
    $dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
    $dom->load($file);//muon lay rss tu trang nao thi ban khai bao day
    $items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items 
?>
<div class="formRow formRow2">
<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
	<tbody>
	<?php
		foreach($items as $item)//lap
		{
		$titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
		$title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles
		$descriptions=$item->getElementsByTagName('description');
		$des=$descriptions->item(0);
		$links=$item->getElementsByTagName('link');
		$link=$links->item(0);
		$pubDates=$item->getElementsByTagName('pubDate');
		$pubDate=$pubDates->item(0);
		
		$noidung = file_get_contents($link->nodeValue);
		$meno = explode('<div class="fck_detail width_common">',$noidung);
		$noidung = $meno[1];
		$meno = explode('</div>',$noidung);
		$noidung = $meno[0]; 
	?>
  <tr>
    <td style="color:#FF0000; font-weight:bold; text-decoration:none; text-align:left; padding:5px;">
    <a href="<? echo $link->nodeValue ;?>" style="text-decoration:none;" target="_blank" />
        <input type="checkbox" name="chon" class="chon" style="margin:0;" /><span style="margin-left:10px;"><? echo $title->nodeValue ?></span></a>
        
        <input name="ten" id="tieude" type="hidden" value="<? echo $title->nodeValue ?>" style="visibility:hidden" />
        <textarea name="mota" id="mota" style="visibility:hidden; position:absolute;" rows="1" cols="1" ><? echo $des->nodeValue ?></textarea>
        <textarea name="noidung" id="noidung" style="visibility:hidden; position:absolute;"  rows="1" cols="1"><?=$noidung?></textarea>
        <input name="ngaydang" id="ngaydang" type="hidden" value="<? echo $pubDate->nodeValue ?>" style="visibility:hidden"/>
    	<font face=arial size=2>
		<?php
			$url=$link->nodeValue;
			$start="<div id=\"content\">";
			$end="<div class=\"tag-parent\">";
			$img_search= "/Files";
			$img_show="http://vnexpress.net/Files";
			$extra='<META HTTP-EQUIV="Content-Type" Content="text-html; charset=UTF-8"><link href="/Resource/Common/default.css" rel="stylesheet" type="text/css">';
			echo getdata($url,$start,$end,$img_search,$img_show,$extra);
        ?>
        </font>
    </td>
  </tr>

  <? } ?>
  </tbody>
</table>
<div id="inline_content"></div>
    <div class="formRow">
        <input type="button" value="Lưu"  class="blueB" id="save_tin"/>
        <a href="index.php?com=vnexpress&act=man<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
    </form>
    </div>
</div>
</div>
