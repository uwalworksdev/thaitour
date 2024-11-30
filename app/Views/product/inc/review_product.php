<div class="section6" id="section6">
    <h2 class="title-sec6"><span>생생리뷰</span>(<?= $product['total_review'] ?? 0 ?>)</h2>
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