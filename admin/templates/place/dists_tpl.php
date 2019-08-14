<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=place&act=man_dist"><span>Quận huyện</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá mục này?'))
		{
			location.href = l;	
		}
	}	
	function ChangeAction(str){
		if(confirm("Bạn có chắc chắn?"))
		{
			document.f.action = str;
			document.f.submit();
		}
	}		
function select_onchange()
	{
		var a=document.getElementById("id_cat");
		window.location ="index.php?com=place&act=man&id_cat="+a.value;	
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
		window.location ="index.php?com=place&act=man_dist&key="+a;	
		return true;
	}
function select_onchange()
	{				
		var a=document.getElementById("id_city");
		window.location ="index.php?com=place&act=man_dist&id_city="+a.value;	
		return true;
	}					
</script>
<script>
$(document).ready(function() {
	$(".set_fee").click(function(event) {
		var cmd=$(this).attr('rel');
		var shipping_fee=$("#phivanchuyen").val();
		if(shipping_fee==''){
			  alert ("Nhập phí vận chuyển."); return false;
		}
		var listid="";
		if(cmd=='set_filter'){
			$("input[name='iddel[]']").each(function(){
				if (this.checked) listid = listid+","+this.value;
		    	})
			listid=listid.substr(1);	 //alert(listid);
			if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
		}
		$.ajax({
            url:'ajax/set_fee.php',
            type: "POST",
            dataType: 'html',
            data: {cmd:cmd,listid:listid,shipping_fee:shipping_fee},
            success: function(res){
                if(res==1){
                    alert ("Áp dụng thành công");
                    location.reload();
                }else{
 					alert ("Có lỗi xảy ra. Vui lòng thử lại !");
                }
            }
        });
	});
});
</script>
<?php 
function get_main_city()
	{
		$sql="select * from  table_place_city order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_city" name="id_city" onchange="select_onchange()" class="main_select">
			<option value="">Tỉnh/Thành Phố</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_city"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="Thêm" onclick="location.href='index.php?com=place&act=add_dist'" />
        <input type="button" class="blueB" value="Xoá" onclick="ChangeAction('index.php?com=place&act=man_dist&multi=del');return false;" />
    </div>  
	<?php if($config['phi']==2){ ?>
        <input name="phivanchuyen" onkeypress="return OnlyNumber(event)" id="phivanchuyen" type="text" placeholder="Nhập phí vận chuyển" />
        <a href="javascript:void(0)" class="set_fee" rel="set_all">Áp dụng toàn bộ</a>
        <a href="javascript:void(0)" class="set_fee" rel="set_filter">Áp dụng mục đang chọn</a>    
    <?php }?>
</div>



<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách các quận huyện hiện tại</h6>
	<div class="timkiem">
	    <input type="text" name="key" class="key" value="" placeholder="Nhập từ khóa tìm kiếm ">
	    <button type="button" class="blueB" onclick="timkiem();" value="">Tìm kiếm</button>
    </div>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
        <td class="tb_data_small"><a href="#" class="tipS" style="margin: 5px;">Thứ tự</a></td>       
         <td width="200"><?=get_main_city();?></td>
         <td class="sortCol"><div>Tên<span></span></div></td>
          <?php if($config['phi']==2){ ?>
        	<td width="100">Phí vận chuyển</td>     
        	<?php }?>
        <td class="tb_data_small">Ẩn/Hiện</td>
         <td width="200">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="iddel[]" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
             <input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_GET['com']?>_dist" data-val3="stt" onblur="stt(this)" type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText update_stt" original-title="Nhập số thứ tự bài viết" rel="<?=$items[$i]['id']?>" />
        </td> 
      <td align="center">
        <?php
        $sql_danhmuc="select ten from table_place_city where id='".$items[$i]['id_city']."'";
        $result=mysql_query($sql_danhmuc);
        $item_danhmuc =mysql_fetch_array($result);
        echo @$item_danhmuc['ten']
      ?>      
        </td> 
        <td class="title_name_data">
            <a href="index.php?com=place&act=edit_dist&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ten']?></a>
        </td>
       <?php if($config['phi']==2){ ?>
       	<td align="center" ><?=number_format($items[$i]['phivanchuyen'],0, ',', '.')?> vnđ</td>
       <?php }?>
        <td align="center">
           <a data-val2="table_<?=$_GET['com']?>_dist" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
       
        <td class="actBtns">
            <a href="index.php?com=place&act=edit_dist&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="" onclick="CheckDelete('index.php?com=place&act=delete_dist&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>               