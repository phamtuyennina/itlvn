<script type="text/javascript">
	$(document).ready(function() {
	$("#chonhet").click(function(){
		var status=this.checked;
		$("input[name='chon']").each(function(){this.checked=status;})
	});
	
	$("#xoahet").click(function(){
		var listid="";
		$("input[name='chon']").each(function(){
			if (this.checked) 
				listid = listid+","+this.value;
			})
			listid=listid.substr(1);	 //alert(listid);
			if (listid=="") 
			{ 
				alert("Bạn chưa chọn mục nào"); 
				return false;
			}
			hoi = confirm("Bạn có chắc chắn muốn xóa?");
			if (hoi==true) document.location = "index.php?com=thanhpho&act=delete_cat&listid=" + listid;
		});
	});
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();
		if(a=='Tên...') a='';			
		window.location ="index.php?com=thanhpho&act=man_cat&key="+a;	
		return true;
	}
</script>

<h3>Quản lý Tỉnh / Thành phố</h3>
<a href="index.php?com=thanhpho&act=add_cat"><img src="media/images/add.jpg" border="0"  /></a>
<table class="blue_table">
	<tr> 
    	<th style="width:5%" align="center"><input type="checkbox" name="chonhet" id="chonhet" /></th>
		<th style="width:5%;">Stt</th>
		<th style="width:50%;"><input type="text" class="key" name="key" value="Tên..." /><input type="button" value="Tìm" onclick="timkiem();" class="tim" /></th>
		<th style="width:10%;">Hiển thị</th>
		<th style="width:5%;">Sửa</th>
		<th style="width:5%;">Xóa</th>
	</tr>
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr bgcolor="<?php if($i%2==1)echo '#F3F3F3' ?>">
		<td style="width:5%;" align="center"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        
		<td style="width:5%;"><?=$items[$i]['stt']?></td>
        
		<td style="width:50%;"><a href="index.php?com=thanhpho&act=edit_cat&id=<?=$items[$i]['id']?>&curPage=<?=$_REQUEST['curPage']?>" style="text-decoration:none;"><?=$items[$i]['ten']?> </a></td>

        <td style="width:10%;">               		
			<?php  if(@$items[$i]['hienthi']==1) { ?>
                <a href="index.php?com=thanhpho&act=man_cat&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_1.png"  border="0"/></a>
            <? } else { ?>
             <a href="index.php?com=thanhpho&act=man_cat&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?>"><img src="media/images/active_0.png" border="0" /></a>
             <?php } ?>        
        </td>

        
		<td style="width:5%;"><a href="index.php?com=thanhpho&act=edit_cat&id=<?=$items[$i]['id']?>"><img src="media/images/edit.png" border="0" /></a></td>
        
		<td style="width:5%;"><a href="index.php?com=thanhpho&act=delete_cat&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa <?=$items[$i]['ten']?>')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
	<?php	}?>
</table>
<a href="index.php?com=thanhpho&act=add_cat"><img src="media/images/add.jpg" border="0"  /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>

<div class="paging"><?=$paging['paging']?></div>