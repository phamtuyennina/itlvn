<p class="tieude">DANH MỤC SẢN PHẨM</p>
<ul>
    <?php for($i = 0, $count_product_danhmuc = count($product_danhmuc); $i < $count_product_danhmuc; $i++){ ?>
        <li><a href="<?=$product_danhmuc[$i]['tenkhongdau']?>-<?=$product_danhmuc[$i]['id']?>"><?=$product_danhmuc[$i]['ten']?></a></li>
    <?php } ?>
</ul>
   