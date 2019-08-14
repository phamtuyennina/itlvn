<?php
function get_main_city($id=0)
    {
        $sql="select * from table_place_city order by id";
        $stmt=mysql_query($sql);
        $str='
            <select id="id_city" name="id_city" class="main_font">
            <option value="0">Chọn tỉnh thành</option>            
            ';
        while ($row=@mysql_fetch_array($stmt)) 
        {
            if($row["id"]==(int)$id)
                $selected="selected";
            else 
                $selected="";
            $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';            
        }
        $str.='</select>';
        return $str;
    }
    
    ?>
<script type="text/javascript">
$(document).ready(function(){   
       
        $("#id_city").change(function(){
            var id=$(this).val();
            $("#id_dist").load("ajax/get_place_dis.php?id="+ id);
        });
    
    })
<?php if($act=='edit_ward') { ?>
$(document).ready(function() {
    
    var id_city=<?=$item['id_city']?>;
    
    $("#id_dist").load("ajax/get_place_dis.php?id="+ id_city,null, SetCity);
    
});

function SetCity(){  
    $("#id_dist").val(<?=$item['id_dist']?>); 
}
<?php } ?>

</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=place&act=mam_ward"><span>Phường xã</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=place&act=save_ward&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>
		<div class="formRow">
			<label>Tỉnh thành</label>
			<div class="formRight">
            	<div class="selector">
				<?=get_main_city(@$item['id_city'])?>
                </div>
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
            <label>Quận huyện</label>
            <div class="formRight">
                <div class="selector">
               <select name="id_dist" id="id_dist">       
        <option value="0"> Chọn Quận huyện </option>       
      </select>
                </div>
            </div>
            <div class="clear"></div>
        </div>
		<div class="formRow">
			<label>Tên</label>
			<div class="formRight">
                <input type="text" name="name" title="Nhập tên phường xã" id="name" class="tipS validate[required]" value="<?=@$item['ten']?>" />
			</div>
			<div class="clear"></div>
		</div>		        
             
      
    
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
	<div class="formRow">
            <div class="formRight">
                <input type="hidden" name="id" id="id_this_place" value="<?=@$item['id']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>	
	</div>
   
	
</form>   