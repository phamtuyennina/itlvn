
<style type="text/css">
	
	p{font-family:"Times New Roman", Times, serif;margin-bottom:0px;margin:0px;}
	p.giua
	{
		text-align:center;
	}
	p.indam
	{
		font-weight:bold;
	}
	p.innghien
	{
		font-style:italic;
	}
	p.tieude
	{
		font-size:20px;
	}
	p.into{font-size:30px;}
	.bao
	{
		width:800px;
		margin:auto;
		border:2px solid #000;
	}
	tr.tr1 td{border-bottom:2px solid #000;}

	td.boder-nhe{border:1px solid #000 !important;}
	td.left{border-left:2px solid #000 !important;}
	td.top{border-top:2px solid #000 !important;}
	.boder > td{border-top:1px solid #000;border-right:1px solid #000}
	tr td{padding:0px !important;border:none}
	.none{border-right:0px !important;}
	.none1 td{border-bottom:1px solid #000 !important;}
</style>

<div class="bao">

    <table class="table" width="100%" cellpadding="0" cellspacing="0">
        <tr class="tr1">
            <td colspan="1" width="10%">
            <p class="giua">
                <img src="untitled.jpg" /></p>
            </td>
           <td colspan="3" width="60%">
               <p class="giua indam tieude">eToy.vn - Building Your Dreams</p>
               <p class="giua innghien">410/15B Cách Mạng Tháng 8, P.11 Q.3, HCM</p>
               <p class="giua innghien">Phone : 0909.525.595</p>
            </td>
            <td colspan="2" width="30%">
            	<p class="innghien indam">Date :</p>
                <p class="innghien indam">Email : tuan@etoy.vn</p>
                <p class="innghien indam">Website : eToy.vn</p>
            </td>
        </tr>
        <tr class="tr2">
        	<td colspan="5">
            	<p class="giua indam into">HÓA ĐƠN BÁN HÀNG</p>
            	<p class="giua">Liên 1 : cửa hàng</p>
            </td>
        </tr>
        <tr class="tr3">
        	<td colspan="4" width="60%"></td>
            <td class="boder-nhe" colspan="1" width="40%"><p class="giua">Số : HCM15080301</p></td>
        </tr>
        <tr>
        	<td colspan="1" width="10%"><p class="indam">Tên khách hàng :</p></td>
            <td colspan="4">aa</td>
        </tr>
        <tr>
        	<td colspan="1" width="10%"><p class="indam">Địa chỉ :</p></td>
            <td colspan="4">aa</td>
        </tr>
        <tr>
        	<td colspan="1" width="10%"><p class="indam">Điện thoại :</p></td>
            <td colspan="4">aa</td>
        </tr>
        <tr>
        	<td colspan="4"width="70%"></td>
            <td class="left top" colspan="1" width="30%"><p class="giua">Tiền tệ : VNĐ</p></td>
        </tr>
        <tr class="boder">
        	<td width="10%" class="top"><p class="giua"> STT</p> </td>
            <td width="40%" class="top"><p class="giua"> Tên Hàng</p> </td>
            <td width="10%" class="top"><p class="giua"> Số Lượng</p> </td>
            <td width="20%" class="top"><p class="giua"> Đơn Giá </p></td>
            <td width="20%" class="none"><p class="giua"> Thành Tiền</p> </td>
        </tr>
        <?php for($i=0;$i<4;$i++){ ?>
        <tr class="boder <?php if($i==3){echo 'none1';} ?>">
        	<td width="10%"> 1 </td>
            <td width="40%">Nến điện tử màu vàng  </td>
            <td width="10%"> 5 </td>
            <td width="20%"><p class="giua"> 30000</p> </td>
            <td width="20%" class="none"><p class="giua"> 150000</p> </td>
        </tr>
		<?php } ?>
        <tr>
        	<td colspan="3"></td>
            <td colspan="1">Tổng tiền hàng :</td>
            <td colspan="1"><p class="giua">150000</p></td>
        </tr>
        <tr>
        	<td colspan="3"></td>
            <td colspan="1">Chiết khấu :</td>
            <td colspan="1"><p class="giua">150000</p></td>
        </tr>
        <tr>
        	<td colspan="3"></td>
            <td colspan="1">Tổng cộng :</td>
            <td colspan="1"><p class="giua">150000</p></td>
        </tr>
        <tr><td colspan="5">Sản phẩm được bảo hành chất liệu trong vòng 6 tháng</td></tr>
        <tr>
        	<td colspan="1"><p class="giua">Người nhận</p></td>
            <td colspan="3"><p class="giua">Người giao hàng</p></td>
            <td colspan="1"><p class="giua">Chủ cửa hàng</p></td>
        </tr>
    </table>
 </div>
