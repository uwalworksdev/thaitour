<a href="/product-golf/golf-detail/<?= $item['product_idx'] ?>" class="sub_tour_section5_item">
    <div class="img_box img_box_10">
        <img src="<?= getImage("/data/product/{$item['ufile1']}") ?>" alt="<?= $item['rfile1'] ?>">
    </div>
    <div class="prd_name">
        <?= viewSQ($item['product_name']) ?>
    </div>
    <div class="prd_desc">
        <p class="prd_keywords"><?= nl2br($item['description']) ?></p>
    </div>
    <div class="prd_price_ko">
        <?= number_format($item['product_price_won']) ?> <span> 원 ~</span> <span class="prd_price_thai">
            <?= number_format($item['product_price']) ?>
            <span>바트</span></span>
    </div>
</a>