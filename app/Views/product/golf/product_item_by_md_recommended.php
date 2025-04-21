<a href="/product-golf/golf-detail/<?= $item['product_idx'] ?>" class="sub_tour_section5_item swiper-slide">
    <div class="img_box img_box_10">
        <img src="<?= getImage("/data/product/{$item['ufile1']}") ?>" alt="<?= $item['rfile1'] ?>" loading="lazy">
    </div>
    <div class="prd_keywords">
        <?php foreach ($item['codeTree'] as $key => $value) { ?>
            <span class="prd_keywords_cus_span"><?= $value['code_name'] ?>
                <?php if ($key < count($item['codeTree']) - 1) { ?>
                    <img src="/images/ico/arrow_right_icon.png" alt="arrow_right_icon">
                <?php } ?>
            </span>
        <?php } ?>
    </div>
    <div class="prd_name">
        <?= viewSQ($item['product_name']) ?>
    </div>
    <div class="prd_desc">
        <p class="prd_keywords"><?= nl2br($item['description']) ?></p>
    </div>
    <div class="prd_info">
        <div class="prd_info__left">
            <img class="ico_star" src="/images/ico/star_yellow_icon.png" alt="star_yellow_icon.png">
            <span class="star_avg"><?= $item['review_average'] ?></span>
        </div>
        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
        <div class="prd_info__right">
            <span class="prd_info__right__ttl">생생리뷰</span>
            <span class="new_review_cnt">(<?= $item['total_review'] ?>)</span>
        </div>
    </div>
    <div class="prd_price_ko">
        <?= number_format($item['product_price_won']) ?> <span> 원 ~</span> <span class="prd_price_ko_sub">
            <?= number_format($item['product_price']) ?>
            <span>바트</span></span>
    </div>
</a>