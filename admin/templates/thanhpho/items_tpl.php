<script language="javascript" type="text/javascript">

	$(document).ready(function() {
	$("#chonhet").click(function(){
		var status=this.checked;
		$("input[name='chon']").each(function(){this.checked=status;})
	});
	
	$("#xoahet").click(function(){
		var listid="";
		$("input[name='chon']").each(function(){
			if (this.checked) listid = listid+","+this.value;
			})
		listid=listid.substr(1);	 //alert(listid);
		if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
		hoi= confirm("Bạn có chắc chắn muốn xóa?");
		if (hoi==true) document.location = "index.php?com=thanhpho&act=delete&listid=" + listid;
	});
	});
	
	function select_onchange()
	{	
		var a=document.getElementById("id_item");
		window.location ="index.php?com=thanhpho&act=man&id_item="+a.value;	
		return true;
	}
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();
		if(a=='Tên...') a='';			
		window.location ="index.php?com=thanhpho&act=man&key="+a;	
		return true;
	}
</script>

<?php
	function get_main_item()
	{
		$sql_huyen="select * from table_thanhpho_item where hienthi=1 order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_item" name="id_item" onchange="select_onchange()" class="main_font">
			<option>Chọn danh mục</option>	
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
	function get_htgh()
	{
		$sql_huyen="select * from table_hinhthucgiaohang where hienthi=1 order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="htgh" name="htgh" class="main_font" onchange="select_onchange2()">
			<option>Chọn loại giao hàng</option>	
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["htgh"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<h3>Quản lý quận / huyện</h3>
<a href="index.php?com=thanhpho&act=add"><img src="media/images/add.jpg" border="0"  /></a><br />

<table class="blue_table">
	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
        <th style="width:20%;"><?=get_main_item();?></th>
        <th style="width:20%;"><input type="text" class="key" name="key" value="Tên..." /><input type="button" value="Tìm" onclick="timkiem();" class="tim" /></th>
        <th style="width:15%;">Phí vận chuyển</th>
         <th style="width:20%;">Loại giao hàng</th>
        <!--<th width="9%" style="width:6%;">Nỗi bật</th>-->
	  	<th width="9%" style="width:6%;">Hiển thị</th>
		<th width="9%" style="width:6%;">Sửa</th>
		<th width="9%" style="width:6%;">Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        
        <td style="width:6%;" align="center"><?=$items[$i]['stt']?></td>
        
        <td style="width:20%;">
			  <?php
				$sql = "select ten from table_thanhpho_item where id='".$items[$i]['id_item']."'";
				$result = mysql_query($sql);
				$danhmuc = mysql_fetch_array($result);
				echo @$danhmuc['ten']
			?>      
        </td>
       
      
       
		<td style="width:20%;" align="center"><a href="index.php?com=thanhpho&act=edit&id=<?=$items[$i]['id']?><?php if($items[$i]['id_item']!=0) echo'&id_item='. $items[$i]['id_item'];?>&hienthi=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten']?></a></td>
        
         <td style="width:15%;" align="center"><?=number_format($items[$i]['phivanchuyen'],0, ',', '.')?>&nbsp;vnđ</td>
         
         <td style="width:20%;">
			  <?php
				$sql = "select ten from table_hinhthucgiaohang where id='".$items[$i]['htgh']."'";
				$result = mysql_query($sql);
				$danhmuc = mysql_fetch_array($result);
				echo @$danhmuc['ten']
			?>      
        </td>
		
        <!--<td style="width:6%;">
			<?php if(@$items[$i]['noibat']==1) { ?>
            <a href="index.php?com=thanhpho&act=man<?php if($_REQUEST['id_item']!='') echo'&id_item='. $_REQUEST['id_item'];?>&noibat=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png"  border="0"/></a>
            <? } else { ?>
            <a href="index.php?com=thanhpho&act=man<?php if($_REQUEST['id_item']!='') echo'&id_item='. $_REQUEST['id_item'];?>&noibat=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png" border="0" /></a>
            <?php } ?>        
        </td>-->

        
		<td style="width:6%;">
			<?php if(@$items[$i]['hienthi']==1) { ?>
            <a href="index.php?com=thanhpho&act=man<?php if($_REQUEST['id_item']!='') echo'&id_item='. $_REQUEST['id_item'];?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png"  border="0"/></a>
            <? } else { ?>
            <a href="index.php?com=thanhpho&act=man<?php if($_REQUEST['id_item']!='') echo'&id_item='. $_REQUEST['id_item'];?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png" border="0" /></a>
            <?php } ?>        
        </td>
        
		<td style="width:6%;" align="center"><a href="index.php?com=thanhpho&act=edit&id=<?=$items[$i]['id']?><?php if($items[$i]['id_item']!=0) echo'&id_item='. $items[$i]['id_item'];?>&hienthi=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
        
		<td style="width:6%;"><a href="index.php?com=thanhpho&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa <?=$items[$i]['ten']?>')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
        
	</tr>
	<?php	}?>
</table>

<a href="index.php?com=thanhpho&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>