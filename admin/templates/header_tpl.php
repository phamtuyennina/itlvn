<?php

      $d->reset();
      $sql = "SELECT COUNT(*) as num FROM #_donhang where tinhtrang=1 ";
      $d->query($sql);
      $row_giohang = $d->fetch_array();

      $tong_count = $row_giohang['num'];
?>
<div class="wrapper">
        <div class="welcome"><a href="#" title=""><img src="images/icon10.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login']['name']?>!</span></div>
        <div class="userNav">
            <ul>
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
                
                <li class="ddnew2 none"><a title="" class="hien_menu"><img src="images/icons/topnav/profile.png" alt="" /><span>Thành viên</span><span class="numberTop"></span></a>
                    <ul class="menu_header">
                       <li><a href="index.php?com=user&act=admin_edit" title=""><span>Thông tin tài khoản</span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=dangky" title=""><span>Đăng ký</span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=dangnhap" title=""><span>Đăng nhập</span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=quenmatkhau" title=""><span>Quên mật khẩu</span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=thaydoithongtin" title=""><span>Thay đổi thông tin</span></a></li>
                        <li><a href="index.php?com=user&act=man" title=""><span>Quản lý thành viên</span></a></li>
                    </ul>
                </li>
                
                <li class="ddnew"><a title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Thông báo</span><span class="numberTop"><?=$tong_count?></span></a>
                    <ul class="userMessage">
                       <li><a href="index.php?com=order&act=man" title="" class="sInbox"><span>Đơn hàng</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_giohang['num']?></span></a></li>

                    </ul>
                </li>
                <li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
                <li class="none"><a href="../admin/sitemap.php" title="" target="_blank"><span>Cập nhật sitemap</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>


