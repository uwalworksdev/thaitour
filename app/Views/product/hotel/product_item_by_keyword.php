<?php
if (is_file(ROOTPATH . "/public/data/product/" . $item['ufile1'])) {
    $src = "/data/product/" . $item['ufile1'];
} else {
    $src = "/images/product/noimg.png";
}
?>
<a href="/product-hotel/hotel-detail/<?= $item['product_idx'] ?>" class="sub_hotel_section7_product_item swiper-slide">
    <div class="img_box img_box_12">
        <img src="<?= $src ?>" alt="">
    </div>
    <div class="sub_hotel_section7_product_item__name"><?= viewSQ($item['product_name']) ?></div>
    <div class="prd_price_ko">
        <?php 
		
			$arr   = product_price($item["product_idx"]);
			$price = explode("|", $arr);
			$item['product_price_won'] = $price[0];
			$item['product_price']     = $price[1];
		
            if($item['is_won_bath'] == "W" || $item['is_won_bath'] == "B"){
                if($item['is_won_bath'] == "W"){
        ?>
            <?= number_format($item['product_price_won']) ?> <span> 원</span> 
        <?php
                }else if($item['is_won_bath'] == "B"){
        ?>   
            <?= number_format($item['product_price']) ?> <span> 바트</span>    
        <?php
                }
            }else{
        ?>   
            <?= number_format($item['product_price_won']) ?> <span> 원 ~</span> <span class="prd_price_thai">
            <?= number_format($item['product_price']) ?>
            <span>바트</span></span>
        <?php
            }
        ?>
    </div>
    <p class="mt--10"><?= $item['level_name'] ?></p>
</a>