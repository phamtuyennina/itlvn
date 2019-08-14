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
		if (hoi==true) document.location = "index.php?com=hinhanh&act=delete_photo&listid="+listid+"&id_hinhanh=<?=$_REQUEST['id_hinhanh']?>&type=<?=$_REQUEST['type']?>";
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
		window.location ="index.php?com=hinhanh&act=man_photo&key="+a+"&id_hinhanh=<?=$_REQUEST['id_hinhanh']?>&type=<?=$_REQUEST['type']?>";	
		return true;
	}
</script>

<h3>Quản lý hình ảnh</h3>
<a href="index.php?com=hinhanh&act=add_photo<?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="media/images/add.jpg" border="0"  /></a>

<table class="blue_table">
	<tr>
		<th style="width:5%"><input type="checkbox" name="chonhet" id="chonhet" /></th>
        <th style="width:6%;">Stt</th>
        <th style="width:30%;">
        	<input type="text" class="key" name="key" value="Tên..." /><input type="button" value="Tìm" onclick="timkiem();" class="tim" />
        </th>      
		<th style="width:30%;">Hình ảnh</th>   
        <th style="width:6%;" class="none">Nỗi bật</th>
        <th style="width:6%;">Hiển thị</th>  
		<th style="width:5%;">Sửa</th>
        <th style="width:5%;">Xóa</th>
	</tr>
    <form name="frm" method="post" action="index.php?com=hinhanh&act=savestt_photo<?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='.$_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?><?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?>" enctype="multipart/form-data" class="nhaplieu">
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr>
		<td style="width:5%;"><input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>
        <td style="width:6%;">
        	<input type="text" value="<?=$items[$i]['stt']?>" name="stt<?=$i?>" class="stt" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" /><input type="hidden" value="<?=$items[$i]['id']?>" name="sttan<?=$i?>" />
		</td>
        <td style="width:30%;"><a href="index.php?com=hinhanh&act=edit_photo&id=<?=$items[$i]['id']?>"><?=$items[$i]['ten']?></a></td>
		
        <td style="width:30%;">
       		<a href="index.php?com=hinhanh&act=edit_photo&id=<?=$items[$i]['id']?>"><img src="<?=_upload_hinhthem.$items[$i]['photo']?>" height="50" /></a>
        </td>   
        
        <td style="width:5%;" class="none">
			<?php if(@$items[$i]['noibat']==1) { ?>        
            <a href="index.php?com=hinhanh&act=man_photo&noibat=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?><?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="media/images/noibat_1.png" border="0" /></a>
            <? } else { ?>
             <a href="index.php?com=hinhanh&act=man_photo&noibat=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?><?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="media/images/noibat_0.png"  border="0"/></a>
             <?php } ?>      
        </td>
        
        <td style="width:5%;">
			<?php if(@$items[$i]['hienthi']==1) { ?>        
            <a href="index.php?com=hinhanh&act=man_photo&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?><?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="media/images/active_1.png" border="0" /></a>
            <? } else { ?>
             <a href="index.php?com=hinhanh&act=man_photo&hienthi=<?=$items[$i]['id']?><?php if($_REQUEST['curPage']!='') echo'&curPage='. $_REQUEST['curPage'];?><?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="media/images/active_0.png"  border="0"/></a>
             <?php } ?>      
        </td>
            		
		<td style="width:5%;"><a href="index.php?com=hinhanh&act=edit_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="media/images/edit.png" border="0" /></a></td>
        <td style="width:5%;"><a href="index.php?com=hinhanh&act=delete_photo&id=<?=$items[$i]['id']?><?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Xác nhận xóa <?=$items[$i]['ten']?>')) return false;"><img src="media/images/delete.png" border="0" /></a></td>
	</tr>
    
	<?php	}?>
    </form>
</table>
<a href="index.php?com=hinhanh&act=add_photo<?php if($_REQUEST['id_hinhanh']!='') echo'&id_hinhanh='. $_REQUEST['id_hinhanh'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><img src="media/images/add.jpg" border="0"  /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="xoahet"><img src="media/images/delete.jpg" border="0"  /></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="javascript:document.frm.submit()"><img src="media/images/luu.jpg" /></a>

<div class="paging"><?=$paging['paging']?></div>