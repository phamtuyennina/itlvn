<div class="goidienthoai">
<div id="footer1" style="z-index:1000;position: fixed;
  bottom: 0;
  width: 100%;
  left: 0;">
      <table style="width:100%;text-align:center;margin:auto;background: #358c00;
  border: 3px solid #e8e8e8;" cellpadding="0" cellspacing="0">
    <tbody>
          <tr>
        <td><a class="link_title blink_me" href="tel:<?=$company['dienthoai']?>"><img src="images/phone.png"> Gọi điện</a></td>
		<td height="40"><a class="link_title" target="_blank" href="sms:<?=$company['dienthoai']?>"><img src="images/tuvan.png"> SMS</a></td> 
    <td><a class="link_title" href="lien-he.html"><img src="images/chiduong.png">Chỉ Đường</a></td>
      </tr>
        </tbody>
  </table>
</div>
<style>
#footer1 img {
  width: 30%;
  max-width: 35px;
  vertical-align: middle;
}
#footer1 a {color:#fff;text-decoration:none;}
.blink_me {
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;

    -moz-animation-name: blinker;
    -moz-animation-duration: 1s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;

    animation-name: blinker;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@-moz-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

</style> 
</div>