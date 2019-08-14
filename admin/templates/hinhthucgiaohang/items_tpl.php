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
		if (hoi==true) document.location = "index.php?com=hinhthucgiaohang&act=delete&listid=" + listid;
	});
	});
	
	function select_onchange()
	{	
		var a=document.getElementById("id_item");
		window.location ="index.php?com=hinhthucgiaohang&act=man&id_item="+a.value;	
		return true;
	}
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{				
		var a = document.getElementById("key");
		window.location ="index.php?com=hinhthucgiaohang&act=man&key="+a.value;	
		return true;
	}
</script>


<h3>Quản lý hình thức giao hàng&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tên: <input type="text" id="key" name="key" placeholder="Nhập từ khóa..." value="<?=$_REQUEST['key']?>" /><input type="button" value="Tìm" onclick="timkiem();" /> </h3>
<a href="index.php?com=hinhthucgiaohang&act=add"><img src="media/images/add.jpg" border="0"  /></a><br />

<table class="blue_table">
	<tr>
		<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th width="5%" style="width:6%;">Stt</th>
       
        <th style="width:30%;">Tên</th>

	  	<th width="9%" style="width:6%;">Hiển thị</th>
		<th width="9%" style="width:6%;">Sửa</th>
		<th width="9%" style="width:6%;">Xóa</th>
	</tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        
        <td style="width:6%;" align="center"><?=$items[$i]['stt']?></td>

       
		<td style="width:30%;" align="center"><a href="index.php?com=hinhthucgiaohang&act=edit&id=<?=$items[$i]['id']?><?php if($items[$i]['id_item']!=0) echo'&id_item='. $items[$i]['id_item'];?>&hienthi=<?=$items[$i]['id']?>" style="text-decoration:none;"><?=$items[$i]['ten']?></a></td>

        
		<td style="width:6%;">
			<?php if(@$items[$i]['hienthi']==1) { ?>
            <a href="index.php?com=hinhthucgiaohang&act=man<?php if($_REQUEST['id_item']!='') echo'&id_item='. $_REQUEST['id_item'];?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png"  border="0"/></a>
            <? } else { ?>
            <a href="index.php?com=hinhthucgiaohang&act=man<?php if($_REQUEST['id_item']!='') echo'&id_item='. $_REQUEST['id_item'];?>&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png" border="0" /></a>
            <?php } ?>        
        </td>
        
		<td style="width:6%;" align="center"><a href="index.php?com=hinhthucgiaohang&act=edit&id=<?=$items[$i]['id']?><?php if($items[$i]['id_item']!=0) echo'&id_item='. $items[$i]['id_item'];?>&hienthi=<?=$items[$i]['id']?>"><img src="media/images/edit.png"  border="0"/></a></td>
        
		<td style="width:6%;"><a href="index.php?com=hinhthucgiaohang&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa <?=$items[$i]['ten']?>')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
        
	</tr>
	<?php	}?>
</table>

<a href="index.php?com=hinhthucgiaohang&act=add"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>