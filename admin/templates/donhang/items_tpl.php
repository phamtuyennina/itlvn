<script type="text/javascript">
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
	if (hoi==true) document.location = "index.php?com=order&act=delete&listid=" + listid;
});

$("#exporthet").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("Bạn chưa chọn đơn hàng nào"); return false;}
	hoi= confirm("Bạn có chắc chắn muốn export?");
	if (hoi==true) document.location = "index.php?com=export&act=save&listid=" + listid;
});
});
</script>

<script language="javascript">	
  $(function() {
	$( "#ngaytao" ).datepicker({
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true,
		dayNamesMin: [ "T2", "T3", "T4", "T5", "T6", "T7", "CN" ],
		monthNamesShort: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
		yearRange: "1900:now"
	});
	
	$( "#ngayin" ).datepicker({
		dateFormat: "dd/mm/yy",
		changeMonth: true,
		changeYear: true,
		dayNamesMin: [ "T2", "T3", "T4", "T5", "T6", "T7", "CN" ],
		monthNamesShort: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
		yearRange: "1900:now"
	});
  });
		
	function select_onchange()
	{				
		var a = document.getElementById("tinhtrang");		
		var b = document.getElementById("ngaytao");
		var c = document.getElementById("hinhthucgiaohang");
		var d = document.getElementById("thongtin");
		window.location ="index.php?com=order&act=man&tinhtrang="+a.value+"&ngaytao="+b.value+"&hinhthucgiaohang="+c.value+"&thongtin="+d.value;
		return true;
	}
	
	function select_onchange2()
	{				
		var a = document.getElementById("tinhtrang");
		var b = document.getElementById("ngaytao");
		var c = document.getElementById("hinhthucgiaohang");
		var d = document.getElementById("thongtin");
		window.location ="index.php?com=order&act=man&tinhtrang="+a.value+"&ngaytao="+b.value+"&hinhthucgiaohang="+c.value+"&thongtin="+d.value;
		return true;
	}
		
	function loctheongay()
	{			
		var a = document.getElementById("tinhtrang");
		var b = document.getElementById("ngaytao");
		var c = document.getElementById("hinhthucgiaohang");
		var d = document.getElementById("thongtin");
		window.location ="index.php?com=order&act=man&tinhtrang="+a.value+"&ngaytao="+b.value+"&hinhthucgiaohang="+c.value+"&thongtin="+d.value;
		return true;
	}
	
	function loctheongay2()
	{			
		var a = document.getElementById("tinhtrang");
		var b = document.getElementById("ngaytao");
		var c = document.getElementById("hinhthucgiaohang");
		var d = document.getElementById("thongtin");
		window.location ="index.php?com=order&act=man&tinhtrang="+a.value+"&ngaytao="+b.value+"&hinhthucgiaohang="+c.value+"&thongtin="+d.value;
		return true;
	}
	
	function thongtin()
	{			
		var a = document.getElementById("tinhtrang");
		var b = document.getElementById("ngaytao");
		var c = document.getElementById("hinhthucgiaohang");
		var d = document.getElementById("thongtin");
		window.location ="index.php?com=order&act=man&tinhtrang="+a.value+"&ngaytao="+b.value+"&hinhthucgiaohang="+c.value+"&thongtin="+d.value;
		return true;
	}
</script>
<?php
function tinhtrang($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_tinhtrang" name="id_tinhtrang" class="main_font">					
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	
?>
<?php	

	$sql="select * from #_tinhtrang";
	$d->query($sql);
	$result_tinhtrang=$d->result_array();
	
	$sql="select * from #_hinhthucgiaohang";
	$d->query($sql);
	$result_hinhthucgiaohang=$d->result_array();

?>


<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=order&act=man"><span>Đơn hàng</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Tất cả</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<script src="js/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".datetimepicker").datetimepicker({
      yearOffset:222,
      lang:'ch',
      timepicker:false,
      format:'m/d/Y',
      formatDate:'Y/m/d',
      minDate:'-1970/01/02', // yesterday is minimum date
      maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
  });
</script>
<div class="widget">
  <div class="titlee" style="padding-bottom:5px;">

     <div class="timkiem" >
    <form name="search" action="index.php" method="GET" class="form giohang_ser">
      <input name="com" value="order" type="hidden"  />
      <input name="act" value="man" type="hidden" />
      <input name="p" value="<?=($_GET['p']=='')?'1':$_GET['p']?>" type="hidden" />

      <input class="form_or" name="keyword" placeholder="Nhập từ khóa.." value="<?=$_GET['keyword']?>" type="text" />
      <input class="form_or" name="ngaybd" id="datefm" type="text" value="<?=$_GET['ngaybd']?>" placeholder="Từ ngày.."/>
      <input class="form_or" name="ngaykt" id="dateto" type="text" value="<?=$_GET['ngaykt']?>" placeholder="Đến ngày.." />

      <select name="sotien">
      <option value="0">Chọn giá</option>
        <?php 
          $sql="select id,ten from #_giasearch order by id";
          $d->query($sql);
          $giasearch = $d->result_array();
          for ($i=0,$count=count($giasearch); $i < $count; $i++) { 
        ?>
          <option value="<?=$giasearch[$i]["id"]?>" <?php if($giasearch[$i]["id"]==$_GET['sotien']) echo "selected='selected'";?> >
            <?=$giasearch[$i]["ten"]?>
          </option>
        <?php }?>
      </select>
      <select name="httt" class="none">
      <option value="0">Hình thức thanh toán</option>
        <?php 
          $sql="select id,ten from #_httt order by id";
          $d->query($sql);
          $httt_sr = $d->result_array();
          for ($i=0,$count=count($httt_sr); $i < $count; $i++) { 
        ?>
          <option value="<?=$httt_sr[$i]["id"]?>" <?php if($httt_sr[$i]["id"]==$_GET['httt']) echo "selected='selected'";?>>
            <?=$httt_sr[$i]["ten"]?>
          </option>
        <?php }?>
      </select>
      <select name="tinhtrang">
      <option value="0">Tình trạng</option>
        <?php 
          $sql="select id,trangthai from #_tinhtrang order by id";
          $d->query($sql);
          $tinhtrang_sr = $d->result_array();
          for ($i=0,$count=count($tinhtrang_sr); $i < $count; $i++) { 
        ?>
          <option value="<?=$tinhtrang_sr[$i]["id"]?>" <?php if($tinhtrang_sr[$i]["id"]==$_GET['tinhtrang']) echo "selected='selected'";?> >
            <?=$tinhtrang_sr[$i]["trangthai"]?>
          </option>
        <?php }?>
      </select>
      <input type="submit" class="blueB" value="Tìm kiếm" style="width:100px; margin:0px 0px 0px 10px;"  />
    </form>
    <div class="clear"></div>
    </div><!--end tim kiem-->
  </div>
</div>
<script language="javascript">
	function CheckDelete(l){
		if(confirm('Bạn có chắc muốn xoá đơn hàng này?'))
		{
			location.href = l;	
		}
	}	
	
					
</script>
<form name="f" id="f" method="post">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	
        <input type="button" class="blueB" value="Xoá" id="xoahet" />
    </div>  

</div>

<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Danh sách đơn hàng</h6>
  </div>
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td>
       <td class="sortCol" width="120"><div>Mã đơn hàng<span></span></div></td>     
        <td class="sortCol"><div>Họ tên<span></span></div></td>
        <td class="sortCol" width="150"><div>Ngày đặt<span></span></div></td>
        <td width="150">Số tiền</td>
        <td width="150">Tình trạng</td>
        <td width="150">Thao tác</td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=$paging['paging']?>     </div></td>
      </tr>
    </tfoot>
    <tbody>
         <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center">
            <?=$items[$i]['madonhang']?>
        </td> 
        <td>
               <?=$items[$i]['hoten']?>
                </td>
                <td align="center">
               <?=date('d/m/Y',$items[$i]['ngaytao'])?>
                </td>
      
        <td align="center">
         <?php
					$d->reset();
					$sql_chitietdonhang = "select tonggia from #_chitietdonhang where madonhang='".$items[$i]['madonhang']."' order by stt,id desc";
					$d->query($sql_chitietdonhang);
					$chitietdonhang = $d->result_array();
					$tongtiendonhang = 0;
				?>
                 <?php for($j=0, $count_chitietdonhang=count($chitietdonhang); $j<$count_chitietdonhang; $j++){
				$tongtiendonhang = $tongtiendonhang + $chitietdonhang[$j]['tonggia'];	

 } ?>
                 <?php 
					if($config['phi']==1){
						$d->reset();
						$sql_phivanchuyen="select phivanchuyen from #_place_city where id='".$items[$i]['thanhpho']."' order by stt,id desc";
						$d->query($sql_phivanchuyen);
						$phivanchuyen=$d->fetch_array();
						$phivc=$phivanchuyen['phivanchuyen'];
					}elseif($config['phi']==2)
					{
						$d->reset();
						$sql_phivanchuyen="select phivanchuyen from #_place_dist where id='".$items[$i]['quan']."' order by stt,id desc";
						$d->query($sql_phivanchuyen);
						$phivanchuyen=$d->fetch_array();
						$phivc=$phivanchuyen['phivanchuyen'];
					}
					else{$phivc=0;}
					
					$tongtiendonhang=$tongtiendonhang+$phivc;	
				 ?>
                 <?=number_format($tongtiendonhang,0, ',', '.')?>&nbsp;vnđ
        </td>
       
        <td align="center">
           <?php 
		   		$sql="select trangthai from #_tinhtrang where id= '".$items[$i]['tinhtrang']."' ";
				$d->query($sql);
				$result=$d->fetch_array();
				echo $result['trangthai'];
		   ?>
        </td>
       
        <td class="actBtns">
          
            <a href="index.php?com=order&act=edit&id=<?=$items[$i]['id']?>&thanhpho_item=<?=$items[$i]['thanhpho']?>&thanhpho=<?=$items[$i]['quan']?>&phuong=<?=$items[$i]['phuong']?>&httt=<?=$items[$i]['httt']?>" title="" class="smallButton tipS" original-title="Xem và sửa đơn hàng"><img src="./images/icons/dark/preview.png" alt=""></a>
            <a href="" onclick="CheckDelete('index.php?com=order&act=delete&id=<?=$items[$i]['id']?>'); return false;" title="" class="smallButton tipS" original-title="Xóa đơn hàng"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
                </tbody>
  </table>
</div>
</form>               


<script type="text/javascript">
function onSearch(evt) {	
		var datefm = document.getElementById("datefm").value;	
		var dateto = document.getElementById("dateto").value;
		var status = document.getElementById("id_tinhtrang").value;		
		//var encoded = Base64.encode(keyword);
		location.href = "index.php?com=order&act=man&datefm="+datefm+"&dateto="+dateto+"&status="+status;
		loadPage(document.location);
			
}
$(document).ready(function(){						
	var dates = $( "#datefm, #dateto" ).datepicker({
			defaultDate: "+1w",
			dateFormat: 'dd/mm/yy',
			changeMonth: true,			
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				var option = this.id == "datefm" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
        
		});
		
</script>
