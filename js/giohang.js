// JavaScript Document
var $t;
function updateCart(){

		NProgress.start();
		$("#main_content").animate({opacity:".9"});
		initAjax({
			url:"ajax/update-cart.html",
			data:$("#box-shopcart form").serialize(),
			success:function(data){
				refreshCart();
			}
		})


	}
	function refreshCart(){
		$.post("gio-hang.html",function(data){
			$("#box-shopcart").html(data);
			NProgress.done();
			$("#main_content").animate({opacity:1});
			updateCartNumber();

		})
	}
function deleteCart(id){
		if(confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")){
		NProgress.start();
		$("#main_content").animate({opacity:".9"});
		initAjax({
			url:"ajax/delete-cart.html",
			data:{id:id},
			success:function(data){
				refreshCart();
			}
		})
		}
	}
function clearCart(){
		if(confirm("Bạn muốn xóa toàn bộ giỏ hàng?")){
		NProgress.start();
		$("#main_content").animate({opacity:".9"});
		initAjax({
			url:"ajax/clear-cart.html",
			success:function(data){
				refreshCart();
			}
		})
		}
	}
function updateCartNumber(){
	$.post("ajax/get-cart-num.html",function(data){
		$(".num-cart").html(data);
	})
}
function doAddCart($name,$id,$qty,$color,$size){
	NProgress.start();
	initAjax({
		url:"ajax/add-cart.html",
		data:{id:$id,qty:$qty,color:$color,size:$size},
		success:function(data){
			$(".num-cart").html(data);
			showMsg("success","Thêm sản phẩm "+$name+" vào giỏ thành công");
			NProgress.done();
			//showCartMini();
		}
	})
return false;
}

function addCart(){
		$("#add-cart").click(function(){
		$color = 0;
		$size = 0;
		$id = $(this).data("id");
		$qty = parseInt($("#qty").val());
		if($(".wrap-color").length){
			if($(".wrap-color .color_item.active").length){
				$color = $(".wrap-color .color_item.active").data("id");
			}else{
				alert('Vui lòng chọn màu cho sản phẩm!');
				return false;
			}

		}
		if($(".wrap-size").length){
			if($(".wrap-size .size_item.active").length){
				$size = $(".wrap-size .size_item.active").data("id");
			}else{
				alert('Vui lòng chọn kích thước cho sản phẩm!');
				return false;
			}

		}

		doAddCart($(this).data("name"),$id,$qty,$color,$size);
		return false;
});
}
//Thông báo khi mua
function showMsg(type,msg){
		 Lobibox.notify(type, {
		size: 'mini',
		msg: msg,
		delay: 3000,
		showClass: 'zoomIn',        // Show animation class.
		hideClass: 'zoomOut',
		});
	}
//-------------
function hideCartMini(){
		$("#cart_mini").animate({right:"-100%"},1000);
}
function showCartMini(){
	$("#cart_loader .inner").css({"overflow":"hidden"});
	$.ajax({
		url:"ajax/giohangmini.php",
		dataType:'json',
		success:function(data){
			clearTimeout($t);
				$("#cart_mini .inner").html(data.data);
				$("#gio_hang_tong").html(data.total);
				$("#cart_mini").stop().animate({right:"0%"},1000);

				$t = setTimeout(function(){
					$("#cart_mini").stop().animate({right:"-100%"},1000);
				},3000);

		}
	})
}
function delorder_gh(id){
	if(confirm("Xác nhận xóa sản phẩm này?")){
	$.ajax({
		type:'post',
		url:"ajax/delete-cart.php",
		data:{id:id},
		dataType:"json",
		success:function(data){
				$("#"+id).animate({height:0,opacity:0},function(){
					$(this).remove();
					$("#gio_hang_tong").html(data.total);
					$('#soluongmua').html(data.sl);
					if(data.qty==0){
						$(".empty-cart").removeClass("hide");
						$(".cart-enter, p.total").hide();
					}

				})

		}
	})
	}
	return false;
}
function initAjax(options){
  var defaults = {
    url:      '',
    type:    'post',
	data:null,
    dataType:  'html',
    error:  function(e){console.log(e)},
	success:function(){return false;},
	beforeSend:function(){},
  };
  var options = $.extend({}, defaults, options);
	$.ajax({
		url:options.url,
		data:options.data,
		success:options.success,
		error:options.error,
		type:options.type,
		dataType:options.dataType,

	})
}
$().ready(function(){
	$(".trans-type input").click(function(){
		NProgress.start();
		$price = $(this).data("price");
		$.ajax({
			url:"ajax/update-transtype.html",
			data:{price:$price,id:$(this).val()},
			type:"post",
			dataType:"json",
			success:function(data){
				$(".total_cart_max .all-price .price").html(data.price);
				//$(".total_cart_max .all-ship .price").html(data.ship);
				$(".total_cart_max .all-price-all .price").html(data.all);
				NProgress.done();

			}
		})
	})
	$(".trans-type input").first().trigger("click");
	$('#thanhpho').change(function(e) {
		var loadajax = "ajax/quan.php?id="+$(this).val();
		setTimeout(function(){$('#quan').load(loadajax)},0);
	});
})
$().ready(function(){
		$("#cart_mini .close").click(function(){
			$("#cart_mini").animate({right:"-100%"},1000);
		})
});
$(document).ready(function(e) {
    addCart();
});
