<div class="logo"> <a href="#" target="_blank" onclick="return false;"> <img src="images/logo.png"  alt="" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
  <li class="dash" id="menu1"><a class=" active" title="" href="index.php"><span>Trang chủ</span></a></li>

  <li class="categories_li product_li <?php if($_GET['com']=='product' || $_GET['com']=='order' || $_GET['com']=='excel') echo ' activemenu' ?>" id="menu2"><a href="" title="" class="exp"><span>Sản phẩm</span><strong></strong></a>
   <ul class="sub">     
     	<?php phanquyen_menu('Màu sắc','product','man_color','sanpham'); ?>
        <?php phanquyen_menu('Size','product','man_size','sanpham'); ?>
     	<?php phanquyen_menu('Quản lý danh mục 1','product','man_danhmuc','sanpham'); ?>
        <?php phanquyen_menu('Quản lý danh mục 2','product','man_list','sanpham'); ?>
        <?php phanquyen_menu('Quản lý danh mục 3','product','man_cat','sanpham'); ?>
        <?php phanquyen_menu('Quản lý danh mục 4','product','man_item','sanpham'); ?>
        <?php phanquyen_menu('Quản lý sản phẩm','product','man','sanpham'); ?>
        <?php phanquyen_menu('Quản lý đơn hàng','order','man',''); ?>
     
    </ul>
  </li>

  <li class="categories_li news_li <?php if($_GET['com']=='news' && $_GET['type']=='giai-phap-kinh-doanh') echo ' activemenu' ?>" id="menu_tt1"><a href="" title="" class="exp"><span>Giải pháp kinh doanh</span><strong></strong></a>
        <ul class="sub">  
            <?php phanquyen_menu('Danh mục cấp 1','news','man_danhmuc','giai-phap-kinh-doanh'); ?>
            <?php phanquyen_menu('Quản lý giải pháp kinh doanh','news','man','giai-phap-kinh-doanh'); ?>         
        </ul>
  </li>

  <li class="categories_li news_li <?php if(($_GET['com']=='news' or $_GET['com']=='about') && $_GET['type']=='khu-vuc') echo ' activemenu' ?>" id="menu_tt1"><a href="" title="" class="exp"><span>Khu vực</span><strong></strong></a>
        <ul class="sub">  
            <?php phanquyen_menu('Mô tả khu vực','about','capnhat','khu-vuc'); ?>
            <?php phanquyen_menu('Quản lý khu vực','news','man','khu-vuc'); ?>         
        </ul>
  </li>

	 <li class="categories_li news_li <?php if($_GET['com']=='news' or $_GET['com']=='vnexpress') echo ' activemenu' ?>" id="menu_tt"><a href="" title="" class="exp"><span>Tin tức</span><strong></strong></a>
        <ul class="sub">  
            <?php phanquyen_menu('Danh mục cấp 1','news','man_danhmuc','tintuc'); ?>
            <?php phanquyen_menu('Danh mục cấp 2','news','man_list','tintuc'); ?>
            <?php phanquyen_menu('Danh mục cấp 3','news','man_cat','tintuc'); ?>
            <?php phanquyen_menu('Quản lý tin tức','news','man','tintuc'); ?>         
			<?php phanquyen_menu('Lấy tin từ Vnexpress','vnexpress','man',''); ?>       
        </ul>
    </li>
      
      
      <li class="categories_li newsletter_li <?php if($_GET['com']=='newsletter') echo ' activemenu' ?>" id="menu_nt"><a href="" title="" class="exp"><span>Đăng ký nhận tin</span><strong></strong></a>
      	<ul class="sub">
            <?php phanquyen_menu('Quản lý Đăng ký nhận tin','newsletter','man',''); ?>     
        </ul>
      </li>
   
      <li class="categories_li gallery_li <?php if($_GET['com']=='background' || $_GET['com']=='anhnen' || $_GET['com']=='slider' || $_GET['com']=='letruot') echo ' activemenu' ?>" id="menu_qc"><a href="" title="" class="exp"><span>Banner - Quảng cáo</span><strong></strong></a>
      
           <ul class="sub">
     		    <?php phanquyen_menu('Cập nhật logo','background','capnhat','logo'); ?>
            <?php phanquyen_menu('Quản lý slider','slider','man_photo','slider'); ?>
            <?php phanquyen_menu('Banner menu Khu vực','background','capnhat','khu-vuc'); ?>
            <?php phanquyen_menu('Banner menu yêu cầu dịch vụ','background','capnhat','yeu-cau-dich-vu'); ?>
            <?php phanquyen_menu('Banner menu hướng dẫn hỏi đáp','background','capnhat','huong-dan-hoi-dap'); ?>
            <?php phanquyen_menu('Banner menu phản hồi khách hàng','background','capnhat','phan-hoi-khach-hang'); ?>
     </ul>
     
      </li>

     <li class="categories_li user_li <?php if($_GET['com']=='phanquyen' || $_GET['com']=='com') echo ' activemenu' ?>" id="menu_pq"><a href="" title="" class="exp"><span>Phân quyền</span><strong></strong></a>
  <ul class="sub">
	<ul class="sub">
  		<?php phanquyen_menu('Quản lý nhóm thành viên','phanquyen','man',''); ?>
        <?php phanquyen_menu('Quản lý thành viên','user','man',''); ?>
        <?php phanquyen_menu('Quản lý com','com','man',''); ?>
    </ul>
    </ul>
  </li>

     <li class="categories_li about_li <?php if($_GET['com']=='about' || $_GET['com']=='video') echo ' activemenu' ?>" id="menu_t"><a href="" title="" class="exp"><span>Trang tĩnh</span><strong></strong></a>
    <ul class="sub">
        <?php phanquyen_menu('Giới thiệu','about','capnhat','about'); ?>
        <?php phanquyen_menu('Cập nhật liên hệ','about','capnhat','lienhe'); ?>
        <?php phanquyen_menu('Cập nhật footer','about','capnhat','footer'); ?>
        </ul>
  </li>
   <li class="categories_li place_li <?php if($_GET['com']=='place') echo ' activemenu' ?>" id="menu_pl"><a href="" title="" class="exp"><span>Địa điểm</span><strong></strong></a>
      <ul class="sub">
     		<?php phanquyen_menu('Quản lý Tỉnh thành','place','man_city',''); ?>
            <?php phanquyen_menu('Quản lý Quận huyện','place','man_dist',''); ?>
            <?php phanquyen_menu('Quản lý Phường xã','place','man_ward',''); ?>
            <?php phanquyen_menu('Quản lý Đường','place','man_street',''); ?>
        </ul>
      </li> 
     <li class="categories_li setting_li <?php if($_GET['com']=='lkweb' || $_GET['com']=='yahoo' || $_GET['com']=='company' || $_GET['com']=='meta' || $_GET['com']=='user' || $_GET['com']=='video') echo ' activemenu' ?>" id="menu_cp"><a href="" title="" class="exp"><span>Nội dung khác</span><strong></strong></a>
  	<ul class="sub">
        <?php phanquyen_menu('Quản lý liên kết web','lkweb','man',''); ?>
    	<?php phanquyen_menu('Video','video','man',''); ?>
        <?php phanquyen_menu('Quản lý hỗ trợ trực tuyến','yahoo','man',''); ?>
        <?php phanquyen_menu('Cập nhật thông tin công ty','company','capnhat',''); ?>
         <li<?php if($_GET['act']=='admin_edit') echo ' class="this"' ?>><a href="index.php?com=user&act=admin_edit">Quản lý Tài Khoản</a></li>
    </ul>
  </li>
</ul>



