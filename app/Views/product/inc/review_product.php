<style>
    .header_review {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 64px 0 32px;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .content-sub-hotel-detail .section6 .title-sec6 {
        margin: 0 !important;
    }


    .write_new_review {
        gap: 20px;
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .write_new_review p.desc_ {
        font-size: 16px;
        font-weight: 600;
        font-family: 'Pretendard', sans-serif;
    }

    .write_new_review a.btnGoReviewPage {
        padding: 10px 20px;
        border-radius: 5px;
        background: #17469E;
        color: #fff;
        text-align: center;
        font-size: 16px;
        font-family: 'Pretendard', sans-serif;
        font-weight: 600;
    }

    @media screen and (max-width : 850px) {
        .write_new_review p.desc_ {
            font-size: 2.6rem;
            font-weight: 600;
            font-family: 'Pretendard', sans-serif;
        }

        .write_new_review a.btnGoReviewPage {
            padding: 1rem 2rem;
            border-radius: 5px;
            background: #17469E;
            color: #fff;
            text-align: center;
            font-size: 2.6rem;
            font-family: 'Pretendard', sans-serif;
            font-weight: 600;
        }
    }
</style>
<div class="section6" id="section6">
    <div class="header_review">
        <h2 class="title-sec6"><span>생생리뷰</span>(<?= $product['total_review'] ?? 0 ?>)</h2>
        <div class="write_new_review">
            <p class="desc_">생생리뷰를 작성해 주시면 200 포인트를 드립니다. 포인트는 이 상품을 예약했을 경우에만 적립됩니다.</p>
            <a class="btnGoReviewPage" href="/review/review_write?product_idx=<?= $product['product_idx'] ?>">쓰기</a>
        </div>
    </div>
    <div class="rating-content">
        <div class="rating-left">
            <img src="/uploads/icons/start_big_icon.png" alt="start_big_icon">
            <strong><?= $product['review_average'] ?? 0 ?>/5</strong>
        </div>
        <span class="rating-right text-gray"><?= $product['total_review'] ?? 0 ?>개 고객기준</span>
    </div>
    <div class="list-label-tag">
        <?php foreach ($reviewCategories as $reviewCategory) : ?>
            <div class="label-tag-item">
                <img class="square" src="/data/code/<?= $reviewCategory['ufile1'] ?>"
                     alt="<?= $reviewCategory['code_name'] ?>">
                <div class="label-tag-item-text">
                    <strong><?= $reviewCategory['code_name'] ?></strong>
                    <p><strong><?= $reviewCategory['average'] ?></strong> 최고좋음</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <h2 class="sub-title-sec6">BEST 생생리뷰</h2>
    <div class="card-list-flex">
        <div class="card-list-recommemded">
            <?php $i = 0;
            function maskString($str)
            {
                $start = substr($str, 0, 3);
                $masked = str_repeat('*', 3);
                return $start . $masked;
            }

            foreach ($reviews as $review) : ?>
                <?php if ($i < 3) : ?>
                    <div class="recommemded-item" data-id="<?= $review['idx'] ?>">
                        <div class="container-head" style="cursor: pointer;"
                             onclick="goDetail('<?= $review['idx'] ?>');">
                            <img src="<?= isset($review['avt']) && $review['avt'] ? '/data/user/' . $review['avt'] : '/images/profile/avatar.png' ?>"
                                 alt="avatar_user_1">
                            <div class="name">
                                <span><?= maskString(sqlSecretConver($review['user_name'] ?? '', 'decode')); ?></span>
                                <p><?= $formattedDate = (new DateTime($review['r_date']))->format('Y.m.d'); ?></p>
                            </div>
                        </div>
                        <h2 style="cursor: pointer;"
                            onclick="goDetail('<?= $review['idx'] ?>');"><?= $review['title']; ?></h2>
                        <div class="custom_paragraph">
                            <?= viewSQ($review['contents']); ?>
                        </div>
                        <button type="button" onclick="goList();">
                            더보기
                        </button>
                    </div>
                <?php endif;
                $i++; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function goList() {
            window.location.href = '/review/review_list';
        }

        function goDetail(idx) {
            window.location.href = '/review/review_detail?idx=' + idx;
        }
    </script>
</div>