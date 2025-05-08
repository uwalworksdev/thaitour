<a href="/product-tours/item_view/<?= $item['product_idx'] ?>" class="sub_tour_section5_item">
    <div class="img_box img_box_10">
        <img src="<?= getImage("/data/product/{$item['ufile1']}") ?>" alt="<?= $item['rfile1'] ?>">
    </div>
    <div class="prd_name">
        <?= viewSQ($item['product_name']) ?>
    </div>
    <div class="prd_keywords">
    <!-- <?php
            $keywords = explode(',', $item['keyword']);
            $keywords = array_filter($keywords);
            foreach ($keywords as $row) : ?>
                <span>#<?= viewSQ($row) ?></span>
        <?php endforeach; ?> -->
        <span><?=nl2br($item['description'])?></span>
    </div>
    <div class="prd_info">
        <div class="prd_info__left">
            <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
            <span class="star_avg"><?= $item['review_average'] ?></span>
        </div>
        <span style="color: #eeeeee; line-height: 10px;overflow: hidden">|</span>
        <div class="prd_info__right">
            <span class="prd_info__right__ttl">리얼리뷰</span>
            <span class="new_review_cnt">(<?= $item['total_review'] ?>)</span>
        </div>
    </div>
    <div class="prd_price_ko">
        <?= number_format($item['tour_price_won']) ?> <span> 원 ~</span> <span class="prd_price_thai">
            <?= number_format($item['tour_price']) ?>
            <span>바트</span></span>
    </div>
</a>