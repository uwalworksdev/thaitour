<div class="tbl_rate2 clearfix mb10">
    <div class="rate_box fl">
        <ul class="eval1 clearfix pb0">
            <li class="avg ltsno"><strong><?= $reviewCars['average'] ?></strong><b>/5</b></li>
            <li>
                <div class="rating  ltsno">
                    <?php
                    $average = $reviewCars['average'];
                    $fullStars = floor($average);
                    $halfStar = ($average - $fullStars >= 0.1) ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;

                    for ($i = 0; $i < $fullStars; $i++) {
                        echo '<img src="/img/ico/star_yellow_full.png" alt="">';
                    }

                    if ($halfStar) {
                        echo '<img src="/img/ico/star_yellow_half.png" alt="">';
                    }
                    ?>

                </div>
            </li>
            <li><span>총 <strong><span
                                class=" ltsno"><?= number_format($reviewCars['count']) ?></span></strong>명 참여</span>
            </li>
        </ul>
    </div>
    <?php foreach ($reviewCars['codeReviewCars'] as $key => $value): ?>
        <div class="totoal_av">
            <p><span class="rating_avscore"><?= $value['average'] ?></span></p>
            <p><span class="rating_avstxt"><?= $value['code_name'] ?></span></p>
        </div>
    <?php endforeach; ?>
</div>

<div class="review_list" id="review_list">
    <div class="tbl_top_wrap">
        <p class="count">전체 <span><?= number_format($reviewCars['count']) ?>개</span>
        </p>
    </div>
    <table class="tbl_list tbl_st3 ssrvtbl_list">
        <colgroup>
            <col style="">
            <col style="width:23%">
        </colgroup>
        <tbody>
        <?php foreach ($reviewCars['reviews'] as $key => $review): ?>
            <tr>
                <td class="cont al position ">
                    <p class="ssrv_txt">
                        <?= $review['title'] ?>
                    </p>
                    <div>
                        <span class="ssrvid f_11 review_date_created_" style="color: #999;"><?= $review['r_date'] ?></span>
                    </div>
                </td>
                <td>
                    <div class="ssrv_ratebox">
                        <div class="rate ac">
                            <span class="avno1">
                                <?php for($j = 0; $j < $review['number_stars']; $j++) {
                                  echo '<img src="/img/ico/star_yellow_full.png" alt="">';
                                } ?>
                            </span>
                            <span class="block f_11" style="color: #999;">평균 고객평점</span>
                        </div>
                        <div class="mt10">
                            <?php foreach ($reviewCars['codeReviewCars'] as $key2 => $value2): ?>
                                <?php
                                $review_type_arr = explode('|', $review['review_type']);
                                ?>
                                <?php if (in_array($value2['code_no'], $review_type_arr)): ?>
                                    <?php
                                        $percent = $review['number_stars']/5 * 100;
                                    ?>
                                    <div class="ssrv_av f_11">
                                        <p><?= htmlspecialchars($value2['code_name']) ?></p>
                                        <p>
                                            <span class="rate_bar">
                                                <span class="rate_bar_inner" style="width:<?= $percent ?>%;"></span>
                                            </span>
                                        </p>
                                        <p><span class="avno">5</span></p>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('.review_date_created_').each(function (index) {
            let dateString = $(this).text();
            let koreaTime = new Date(dateString);
            let daysOfWeekKorean = ["일", "월", "화", "수", "목", "금", "토"];
            let dayOfWeekKorean = daysOfWeekKorean[koreaTime.getDay()];

            let hours = koreaTime.getHours().toString().padStart(2, '0');
            let minutes = koreaTime.getMinutes().toString().padStart(2, '0');
            let seconds = koreaTime.getSeconds().toString().padStart(2, '0');

            let formattedDate = `${koreaTime.getFullYear()}-${String(koreaTime.getMonth() + 1).padStart(2, '0')}-${String(koreaTime.getDate()).padStart(2, '0')} ${hours}:${minutes}:${seconds}(${dayOfWeekKorean})`;

            $(this).text(formattedDate);
        })
    })
</script>