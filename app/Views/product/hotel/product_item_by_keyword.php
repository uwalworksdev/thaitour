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
        <?php if($item['is_view_only_won'] == "Y"){?>
            <?= number_format($item['product_price_won']) ?> <span> 원</span> 
        <?php
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