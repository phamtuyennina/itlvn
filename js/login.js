function finishAjax(parent, id, response) {
    $('#' + parent).hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
};
function finishAjax1(id, response) {
    $('#emailLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
};
function finishAjax1qmk(id, response) {
    $('#emailqmkLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
};
function finishAjax3(id, response) {
    $('#PWLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
};

function finishAjax3d(id, response) {
    $('#RegLoadingd').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
};
function finishAjax31(id, response) {
    $('#RegLoading1').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
};
<!--Kiểm tra liên hệ-->	
//kiểm tra hợp lệ tài khoản
$(document).ready(function(e) {
//TKQMK
 $('#taikhoanqmkLoading').hide();
    $('#taikhoan_qmk').blur(function () {
        $('#taikhoanqmkLoading').show();
        $.post("ajax/check.php", {
			act: "checkuser_qmk",
            username: $('#taikhoan_qmk').val()
        }, function (response) {
            $('#taikhoanqmkLoading').fadeOut();
			setTimeout("finishAjax('taikhoanqmkLoading','taikhoanqmkResult', '" + escape(response) + "')", 400);
        });
        return false;
    });
	//Kiem tra email
    $('#emailqmkLoading').hide();
    $('#email_qmk').blur(function () {
		
		$('#emailqmkLoading').show();
		$.post("ajax/check.php", {
			email: $('#email_qmk').val(),
			act:"checkemail_qmk",
		}, function (response) {
			$('#emailqmkResult').fadeOut();
			setTimeout("finishAjax1qmk('emailqmkResult', '" + escape(response) + "')", 400);
		});
		return false;
		
    });
/////////////
    $('#taikhoanLoading').hide();
    $('#taikhoan_dktv').blur(function () {
        $('#taikhoanLoading').show();
        $.post("ajax/check.php", {
			act: "checkuser_tv",
            username: $('#taikhoan_dktv').val()
        }, function (response) {
            $('#taikhoanResult').fadeOut();
			setTimeout("finishAjax('taikhoanLoading','taikhoanResult', '" + escape(response) + "')", 400);
        });
        return false;
    });
//Kiểm tra mật khẩu
	$('#matkhauLoading_tv').hide();
    $('#matkhau_dktv').keypress(function () {
		
        $('#matkhauLoading_tv').show();
        $.post("ajax/check.php", {
			act: "checkpass_tv",
            matkhau: $('#matkhau_dktv').val()
        }, function (response) {
            $('#matkhauResult_tv').fadeOut();
			setTimeout("finishAjax('matkhauLoading_tv','matkhauResult_tv', '" + escape(response) + "')", 400);
        });
        
    });
//Kiểm trả nhập lại mật khẩu
	$('#golaimatkhauLoading_tv').hide();
    $('#golaimatkhau_dktv').blur(function () {
        $('#golaimatkhauLoading_tv').show();
        $.post("ajax/check.php", {
			act: "checkrepass_tv",
			pass:$('#matkhau_dktv').val(),
            repass: $('#golaimatkhau_dktv').val()
        }, function (response) {
            $('#golaimatkhauResult_tv').fadeOut();
			setTimeout("finishAjax('golaimatkhauLoading_tv','golaimatkhauResult_tv', '" + escape(response) + "')", 400);
        });
        return false;
    });
//Kiem tra email
    $('#emailLoading').hide();
    $('#email_dktv').blur(function () {
		
		$('#emailLoading').show();
		$.post("ajax/check.php", {
			email: $('#email_dktv').val(),
			act:"checkemail",
		}, function (response) {
			$('#emailResult').fadeOut();
			setTimeout("finishAjax1('emailResult', '" + escape(response) + "')", 400);
		});
		return false;
		
    });
		
});
function check_dktv()
{
	var frm = document.formdktv;
	if (frm.taikhoan_dktv.value == '')
    {
        alert("Bạn chưa nhập tên tài khoản.");
        frm.taikhoan_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.matkhau_dktv.value == '')
    {
        alert("Bạn chưa nhập mật khẩu.");
        frm.matkhau_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.golaimatkhau_dktv.value == '')
    {
        alert("Nhập lại mật khẩu.");
        frm.golaimatkhau_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.email_dktv.value == '')
    {
        alert("Bạn chưa nhập email.");
        frm.email_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.ten_dktv.value == '')
    {
        alert("Nhập họ tên.");
        frm.ten_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.ten_dktv.value == '')
    {
        alert("Nhập họ tên.");
        frm.ten_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.ngaysinh_dktv.value == '')
    {
        alert("Chọn ngày sinh.");
        frm.ngaysinh_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.sodt_dktv.value == '')
    {
        alert("Nhập số điện thoại.");
        frm.sodt_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	if(isPhone($('#sodt_dktv').val(), "Số điện thoại không tồn tại"))
	{
		$('#sodt_dktv').focus();
		return false;
	}	
	if (frm.diachi_dktv.value == '')
    {
        alert("Nhập địa chỉ.");
        frm.diachi_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
		if (frm.capt_dktv.value == '')
    {
        alert("Nhập mã bảo vệ.");
        frm.capt_dktv.focus();
        $('#RegLoading').hide();
        return false;
    }
	var currentLocation = window.location;
    $.post("ajax/login.php", {
        username: $('#taikhoan_dktv').val(),
        matkhau: $('#matkhau_dktv').val(),
        golaimatkhau: $('#golaimatkhau_dktv').val(),
        ten: $('#ten_dktv').val(),
        sex: $('input[name="sex"]:checked').val(),
        ngaysinh: $('#ngaysinh_dktv').val(),
        email: $('#email_dktv').val(),
        sodt: $('#sodt_dktv').val(),
		diachi: $('#diachi_dktv').val(),
        capt: $('#capt_dktv').val(),
        act: 'reg'
    }, function (response) {
		$k=$.parseJSON(response);
        $('#RegResult').fadeOut();
        setTimeout("finishAjax3('RegResult', '" + escape($k.thongbao) + "')", 400);
		if($k.id==1){
			setTimeout(function(){
				location.href=currentLocation;
			}, 3000);
		}
		
    });
}
function finishAjax_login(id, response) {
    $('#LoginLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
;
function dologin(evt) {
    // IE					// Netscape/Firefox/Opera
    var key;
    if (evt.keyCode == 13 || evt.which == 13) {
        login_check();
    }
}

function check_qmk()
{
	var currentLocation = window.location;	
	var frm = document.frm_qmk;
	if (frm.taikhoan_qmk.value == '')
    {
        alert("Bạn chưa nhập tên tài khoản.");
        frm.taikhoan_qmk.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.email_qmk.value == '')
    {
        alert("Bạn chưa nhập email.");
        frm.email_qmk.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.capcha_qmk.value == '')
    {
        alert("Bạn chưa nhập mã bảo vệ.");
        frm.capcha_qmk.focus();
        $('#RegLoading').hide();
        return false;
    }
	 $('#RegLoading1').show();
	$.post("ajax/login.php", {
        username: $('#taikhoan_qmk').val(),
        email: $('#email_qmk').val(),
        capt: $('#capcha_qmk').val(),
        act: 'quenpass'
    }, 
	function (response) {
		$k=$.parseJSON(response);
        $('#RegResult1').fadeOut();
        setTimeout("finishAjax31('RegResult1', '" + escape($k.thongbao) + "')", 400);
		if($k.id==1){
			setTimeout(function(){
				location.href=currentLocation;
			}, 3000);
		}
		
    });
}
function login_check()
{
	var currentLocation = window.location;
    var frm = document.dangnhap;
    $('#LoginLoading').show();
    if (frm.login_username.value == '')
    {
        alert("Bạn chưa điền tên đăng nhập.");
        frm.login_username.focus();
        $('#LoginLoading').hide();
        return false;
    }
    if (frm.login_matkhau.value == '')
    {
        alert("Bạn chưa điền mật khẩu.");
        frm.login_matkhau.focus();
        $('#LoginLoading').hide();
        return false;
    }



    $.post("ajax/login.php", {
        username: $('#login_username').val(),
        matkhau: $('#login_matkhau').val(),
        act: 'login'
    }, function (response) {
		$k=$.parseJSON(response);
        $('#LoginResult').fadeOut();
        setTimeout("finishAjax_login('LoginResult', '" + escape($k.thongbao) + "')", 400);
		if($k.id==1){
				setTimeout(function(){
					location.href=currentLocation;
				}, 3000);
		}
    });
}
