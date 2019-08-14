<style>
/****************************************/ 
#footerSlideContainer {
    bottom: -3px;
    position: fixed;
    right: 0;
    width: 300px;
    z-index: 1000;
}
#footerSlideButton {
    background: url("images/hotro.png") no-repeat scroll left top transparent;
    border: medium none;
    cursor: pointer;
    height: 51px;
    position: absolute;
    right: 0;
    top: -46px;
    width: 194px;
}
#footerSlideContent {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: none repeat scroll 0 0 #EFEFEF;
    border-color: #006795 -moz-use-text-color #006795 #006795;
    border-image: none;
    border-style: solid none solid solid;
    border-width: 5px medium medium 5px;
    bottom: -5px;
    color: #CCCCCC;
    font-family: DejaVuSansBook,Sans-Serif;
    font-size: 0.8em;
    height: 0;
    position: relative;
    width: 100%;
	overflow:hidden;
}
#footerSlideContent h3 {
    color: #9AC941;
    font-size: 36px;
    margin: 10px 0;
}
#footerSlideContent ul {
    color: #EE8D40;
    line-height: 2em;
    list-style-type: none;
}
#footerSlideText {
    color: #065F92;
    font-size: 11px;
    padding: 10px 5px 5px;
    text-shadow: 1px 1px #FFFFFF;
}
#footerSlideText .note {
    color: red;
    left: 20px;
    position: relative;
}
#footerSlideText .line {
    background: url("media/images/icon/line.gif") repeat-x scroll center top transparent;
    height: 2px;
    margin: 12px auto;
    width: 95%;
}
#footerSlideText .titles {
    color: #006795;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
}
#footerSlideText ul {
    list-style: none outside none;
    margin: 10px 0 0 20px;
    padding: 0;
    width: 244px;
}
#footerSlideText ul li {
    background: none repeat scroll 0 0 transparent;
    color: #006795;
    font-size: 12px;
    font-weight: bold;
    list-style: none outside none;
    margin-top: 8px;
    padding: 0;
	position:relative;
}
#footerSlideText ul li .left {
    display: inline-block;
    width: 165px;
	position:relative;
}
#footerSlideText ul li .right {
    display: inline-block;
    width: auto;
	color:#F00;
	float:right;
	position:absolute;
	top:4px;
	right:-17px;
}
.SkypeButton_Chat{
	float:left;
	margin-right:5px;
	margin-top:10px;
}
.SkypeButton_Chat p{
	margin:0px;
	padding:0px;
}
.SkypeButton_Chat img{
	vertical-align:middle !important;
	margin:0px !important;
}
</style>

<script>
	$(document).ready(function(e) {
        var d=false;
		$("#footerSlideButton").click(function(){
			if(d==false){
				$("#footerSlideContent").animate({height:"300px"});
				$(this).css("backgroundPosition","bottom left");
				d=true;
			}else{
				$("#footerSlideContent").animate({height:"0px"});
				$(this).css("backgroundPosition","top left");
				d=false;
			}
		});
    });
</script>
<?php

	$sql_yahoo="select dienthoai,yahoo,ten from #_hotline";
	$d->query($sql_yahoo);
	$yahoo=$d->fetch_array();

?>

<div id="footerSlideContainer">      
    <div id="footerSlideButton" style="background-position: left top;"></div>      
    <div id="footerSlideContent" style="height: 0px;">        
    	<div id="footerSlideText" style="display: block;">
        	<span class="titles">Hỗ trợ trực tuyến</span>
			<ul>
            	                <li><span class="left">
					<div id="SkypeButton_Chat_Ms Diễm_1" class="SkypeButton_Chat">
						<script type="text/javascript">
                        Skype.ui({
                          "name": "chat",
                          "element": "SkypeButton_Chat_Ms Diễm_1",
                          "participants": ["Ms Diễm"],
                          "imageSize": 16
                        });
                       </script>
					</div>
                    <a rel="nofollow" href="ymsgr:sendIM?<?=$yahoo['yahoo']?>" title="<?=$yahoo['ten']?>"><img src="http://opi.yahoo.com/online?u=<?=$yahoo['yahoo']?>&m=g&t=7" width="30" title="<?=$yahoo['ten']?>" alt="<?=$yahoo['ten']?>" /> </a><b style="float:right;"><?=$yahoo['ten']?></b></span><span class="right"><?=$yahoo['dienthoai']?></span></li>
                   				
  				
			</ul>
			<div class="line" style="margin-bottom:5px;"></div>
            	<style>
					#lienhe_khung input[type='text']{
						height:20px;
						line-height:20px;
						width:280px;
					}
					#lienhe_khung textarea{
						height:80px;
						width:280px;
						margin-top:5px;
						border:1px solid #CCC;
					}
					#btnSendmail{
						height:19px;
						width:80px;
						border:1px solid #066999;
						background:url(media/images/nen_button.png) repeat-x;
						text-align:center;
						line-height:17px;
						float:left;
						font-size:11px;
						margin-left:200px;
						margin-top:5px;
						cursor:pointer;
						color:#FFF;
					}
					#btnSendmail:hover{
						text-decoration:underline;
					}
				</style>
            <div id='lienhe_khung'>
            	<script>
					$(document).ready(function(e) {
                        $("#email_gui_footer").submit(function(e) {
                            if($("#txtEmail").val()==""){
								alert("Email không được để trống!");
								$("#txtEmail").focus();
								return false;	
							}
							if($("#txtDienthoai").val()==""){
								alert("Số điện thoại không được để trống!");
								$("#txtDienthoai").focus();
								return false;	
							}
							if($("#textNoidung").val()==""){
								alert("Nội dung không được để trống!");
								$("#textNoidung").focus();
								return false;	
							}
                        });
                    });
				</script>
            	<form action="" name="email_gui_footer" id='email_gui_footer' method="post">
                	<input type="text" name="txtEmail" id='txtEmail' placeholder="Email" size="30" />
                    <input type="text" name="txtDienthoai" id='txtDienthoai' placeholder="Số điện thoại" size="30" />
                    <textarea name="textNoidung" id='textNoidung' cols="30" rows="5" placeholder="Vui lòng nhập nội dung yêu cầu hoặc ý kiến"></textarea>
                    <input type="submit" name="btnSendmail" id='btnSendmail' value="Gửi" style="background:#36F;" />
                </form>
                <div class="clear"></div>
            </div>
		</div>
    </div>    
</div> 
