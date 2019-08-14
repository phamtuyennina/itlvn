 <!-- Top fixed navigation -->
<div class="topNav">
    <div class="wrapper">
        <div class="userNav">
            <ul>
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

<!-- Main content wrapper -->
<div class="loginWrapper">
    <!--<div class="loginLogo"><img src="images/logo.png" alt="" /></div>-->
    <div class="widget" id="loginForm">
       
        <form action="index.php?com=user&act=login" id="validate" class="form" method="post">
            <fieldset>
                <div class="formRow">
                   
                    <div class="loginInput"><input type="text" name="username" class="validate[required]" id="username" placeholder="Nhập username" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="pass" placeholder="******" /></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <!--<div class="rememberMe"><a href="#" class="forgot-pwd">Bạn quên mật khẩu?</a></div>-->
                    <input type="submit" value="Đăng nhập" class="dredB logMeIn" />
                    <div class="clear"></div>
                </div>
                <div class="ajaxloader"><img src="images/loader.gif" alt="loader" /></div>
                <div id="loginError">
                </div>
            </fieldset>
        </form>
    </div>
    
    <div class="widget" id="forgotForm" style="display:none;">
        <div class="title"><img src="images/icons/dark/files.png" alt="" class="titleIcon" /><h6>Khôi phục mật khẩu</h6></div>
        <form action="" class="form" method="post" id="validate1">
            <fieldset>
                <div class="formRow">
                	<label for="login">Bạn hãy nhập email vào ô bên dưới:</label>
                    <div class="clear"></div>
                </div>
                
                <div class="formRow">
                    <label for="pass">Email:</label>
                    <div class="loginInput"><input type="text" id="email" class="validate[required,custom[email]]" name="email"></div>
                    <div class="clear"></div>
                </div>
                
                <div class="loginControl">
                    <div class="rememberMe"><a href="#" class="back-login">Quay lại khung đăng nhập</a></div>
                    <input type="submit" value="Gửi" class="dredB sendEmail" style="float:right;" />
                    <div class="clear"></div>
                </div>
                <div class="ajaxloader"><img src="images/loader.gif" alt="loader" /></div>
                <div id="echoMessage">
                </div>
            </fieldset>
        </form>
    </div>
</div>