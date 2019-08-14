<?php
	
	$d->query("select * from #_user_permission where user_id = ".$_POST['id']);
	
	$list_array = array();
	foreach($d->result_array() as $k=>$v){
		$list_array[$v['per_id']] = $v;
	}
	
?>
<div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
		<thead>
		<tr>
			<td>Chức năng quản trị </td>
			<td>Xem</td>
			<td>Thêm</td>
			<td>Sửa</td>
			<td>Xóa</td>
			<td>Xác nhận</td>
		</tr>
		</thead>

		<tbody>
		<?php
			foreach($per as $k=>$v){
				$view = "";
				$add = "";
				$edit = "";
				$delete = "";
				$act = "";
				//check($list_array[$v['id']]);
				if(isset($list_array[$v['id']])){
					if($list_array[$v['id']]['has_delete']){
						$delete = "checked";
					}
					if($list_array[$v['id']]['has_edit']){
						$edit = "checked";
					}
					if($list_array[$v['id']]['has_add']){
						$add = "checked";
					}
					if($list_array[$v['id']]['has_man']){
						$view = "checked";
					}
					if($list_array[$v['id']]['has_act']){
						$act = "checked";
					}
					
				
				}
				
				echo '<tr><td class="title_name_data">'.$v['name'].'</td><td><label><input name="view" type="checkbox" '.$view.'></label></td><td><label><input name="add" type="checkbox" '.$add.'>'.$v['add_exec'].'</label></td><td><label><input name="edit" type="checkbox" '.$edit.'>'.$v['edit_exec'].'</label></td><td><label><input name="delete" type="checkbox" '.$delete.'>'.$v['delete_exec'].'</label></td><td><button class="button blueB add-permission" data-per="'.$v['id'].'"  data-user="'.$_POST['id'].'"><i class="glyphicon glyphicon-upload"></i>Xác nhận</button>';
				if($v["com_act"]=="product_man_list" && $list_array[$v['id']]['has_man'] && $v["level"]>0){
					echo '<a href="" class="load_list" data-type="'.$v["type"].'" data-level="'.$v["level"].'" data-id_per="'.$v['id'].'" data-id_group="'.$_POST['id'].'">phân quyền chi tiết</a>';
				}
				echo '</td></tr>';
			}
		?>
		</tbody>
	</table>
</div>
<style>
#table-per input[type=checkbox]{
position: relative; 
top: 3px;
margin-right: 10px;

}


</style>
<script>	
	$().ready(function(){
		$(".load_list").click(function(){
			$type=$(this).data("type");
			$level=$(this).data("level");
			$id_per=$(this).data("id_per");
			$id_group=$(this).data("id_group");
			$.ajax({
				url:"ajax/ajax.php",
				type:"POST",
				data:{act: "load_list",type: $type, level: $level, id_per: $id_per, id_group: $id_group},
				success:function(data){
					$.fancybox(data);
				}
			})
			return false;
			/* $.fancybox({
				href:base_url+"/add-cart/fill.html",
				type:"ajax",
				fitToView	: false,
				width		: '75%',
				height		: '40%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			}) */
		})
		$(".delete-permission").click(function(){
			that = $(this);
			$id = $(this).data("per");
			$.post(base_url+"/admin/index.php?com=phanquyen&act=delete_per",{id:$id},function(data){
				console.log(data);
				that.parent().parent().remove();
			})
		
		})
		$(".update-permission").click(function(){
			$id = $(this).data("per");
			$.post(base_url+"/admin/index.php?com=phanquyen&act=load_per",{id:$id},function(data){
				$json = $.parseJSON(data);
				$("#form-add-role input").eq(0).val($json.name);
				$("#form-add-role input").eq(1).val($json.com);
				$("#form-add-role input").eq(2).val($json.man_exec);
				$("#form-add-role input").eq(3).val($json.add_exec);
				$("#form-add-role input").eq(4).val($json.delete_exec);
				$("#form-add-role input").eq(5).val($json.edit_exec);
				$("#form-add-role input").eq(6).val($json.id_exec);
				$("#form-add-role input").eq(7).val($json.act_exec);
				$("#form-add-role input").eq(8).val($json.id);
				$("#btn-add").click();
				console.log($json);
				
			})
		
		})
		permission();
	
	
	
	})
	function chitiet(){
		$(".load_list").click(function(){
			$type=$(this).data("type");
			$level=$(this).data("level");
			$id_per=$(this).data("id_per");
			$id_group=$(this).data("id_group");
			$.ajax({
				url:"ajax/ajax.php",
				type:"POST",
				data:{act: "load_list",type: $type, level: $level, id_per: $id_per, id_group: $id_group},
				success:function(data){
					$.fancybox(data);
				}
			})
			return false;
		})
	}
	function permission(){
		$(".add-permission").click(function(){
			$obj=$(this);
			$id_per = $(this).data("per");
			$id_user = $(this).data("user");
			$parent = $(this).parent().parent();
			$view = ($parent.find("input[name=view]").is(":checked")) ? 1 : 0;
			$add = ($parent.find("input[name=add]").is(":checked")) ? 1 : 0 ;
			$edit = ($parent.find("input[name=edit]").is(":checked")) ? 1 : 0;
			$delete = ($parent.find("input[name=delete]").is(":checked")) ? 1 : 0;
			$act = ($parent.find("input[name=act]").is(":checked")) ? 1 : 0;
			$.ajax({
				url:base_url+"/admin/index.php?com=phanquyen&act=add_user_to_per",
				data:{id_per:$id_per,id_user:$id_user,view:$view,act_exec:$act,add:$add,edit:$edit,delete:$delete},
				type:"post",
				dataType:"json",
				success:function(data){
					console.log(data);
					if(data.stt){
						alert("Thành công!");
						if(data.rs_per.com_act=="product_man_list" && data.rs_per.level>0 && data.data.has_man==1){
							$.fn.exists = function(){return this.length>0;}
							if(!$($obj).parent("td").find(".load_list").exists()){
								$($obj).parent("td").append('<a href="" class="load_list" data-type="'+data.rs_per.type+'" data-level="'+data.rs_per.level+'" data-id_per="'+data.rs_per.id+'" data-id_group="'+data.data.user_id+'">phân quyền chi tiết</a>');
								chitiet();
							}
							
							//permission();
							return false;
						}else{
							$($obj).parent("td").find(".load_list").remove();
							//permission();
							return false;
						}
						
					}else{
						alert("Thất bại!");
					}
				
				
				
				
				}
			
			})

			return false;
		})
	}


</script>
