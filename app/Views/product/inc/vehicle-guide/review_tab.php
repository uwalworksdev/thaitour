<div class="tbl_rate2 clearfix mb10">
    <div class="rate_box fl">
        <ul class="eval1 clearfix pb0">
            <li class="avg ltsno"><strong><?= $reviewCars['average'] ?></strong><b>/5</b></li>
            <li>
                <div class="rating  ltsno">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="#17469E" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="#17469E" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="#17469E" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="#17469E" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="#17469E" class="bi bi-heart-half" viewBox="0 0 16 16">
                        <path d="M8 2.748v11.047c3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                    </svg>
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
                        <span class="ssrvid f_11" style="color: #999;"><?= $review['r_date'] ?>(토)</span>
                    </div>
                </td>
                <td>
                    <div class="ssrv_ratebox">
                        <div class="rate ac">
                            <span class="avno1"><?= $review['number_stars'] ?></span>
                            <span class="block f_11" style="color: #999;">평균 고객평점</span>
                        </div>
                        <div class="mt10">
                            <?php foreach ($reviewCars['codeReviewCars'] as $key2 => $value2): ?>
                                <?php
                                $review_type_arr = explode('|', $review['review_type']);
                                ?>
                                <div class="ssrv_av f_11">
                                    <p>기사친절</p>
                                    <p>
                                    <span class="rate_bar">
                                    <span class="rate_bar_inner" style="width:100%;"></span>
                                    </span>
                                    </p>
                                    <p><span class="avno">5</span></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>