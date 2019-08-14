<script type="text/javascript">
	$(document).ready(function(e) {
        $('.addtocard').click(function(){
			var id = $(this).attr('data-id');
			var soluong = $(this).attr('data-soluong');
			$.ajax({
				url:'test.php',
				type:'post',
				data:'id='+id+'&soluong='+soluong,
				async:true,
				success:function(result){
					$('#load_giohang').html(result);
				}
			});
			$('#load_giohang').fadeIn().delay(3000).fadeOut();
			return false;
		});
    });
</script>

<div id="load_giohang" style="background:#000; color:#fff; width:200px; height:50px; position:fixed; top:10px; right:10px; display:none;"></div><a href="#" class="addtocard" data-id="3">Load gio hang</a>