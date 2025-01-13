<div class="section driver_list" id="">
    <ul class="supplier_infobox">
        <?php foreach ($drivers as $driver): ?>
            <li class="position h-380">
                <!-- 생생리뷰더보기 팝업  2018-10-17 수정 [25450]-->
                <div class="supplierinfo">
                                        <span class="thumb03">
                                            <img src="/uploads/drivers/<?= $driver['avatar'] ?>"
                                                 alt="">
                                        </span>
                    <span class="thumb02">
                                            <img src="/uploads/drivers/<?= $driver['vehicle_image'] ?>"
                                                 alt="">
                                        </span>
                    <div class="carType_info">
                                                <span class="ic_driver">
                                            <img src="/data/code/<?= $driver['code']['ufile1'] ?>"
                                                 title="<?= $driver['code']['code_name'] ?>">
                                            </span>
                        <span class="uppercase"><?= $driver['vehicle_name'] ?></span>
                    </div>
                    <div class="driver_namebox">
                        <div class="boxcircle"><b>닉네임</b>
                            <p class="f_nilegreen"><?= $driver['special_name'] ?></p>
                            (경력 <?= $driver['exp'] ?>)
                        </div>
                    </div>
                    <div class="drv_ssrvlist">
                        <div class="supplier_rate2 clearfix">
                            <div class="rate_box fl pl10">
                                <ul class="eval1 clearfix pb0">
                                    <!--  <li>평균 고객평점평균 고객평점 </li> -->
                                    <li class="total_avscore"><span
                                                class=""><?= $driver['review_average'] ?></span><span
                                                class="totalpoint">/5</span></li>
                                </ul>
                            </div>
                            <?php foreach ($driver['code_reviews'] as $code_review): ?>
                                <div class="ssdr_av">
                                    <p><?= $code_review['code_name'] ?>(<?= $code_review['count'] ?>)</p>
                                    <p>
                                        <span class="ssdr_av_point"><?= $code_review['average'] ?></span>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="ssrv_morelist">
                            <p class="ssrv_more">
                                <span><b><?= number_format($driver['main_count']) ?></b>개의 생생한 회원 리뷰가 있어요. ( 평균 고객평점: <?= $driver['review_average'] ?>)</span> <span
                                        class="ssrv_more_btn" data-idx="<?= $driver['d_idx'] ?>">생생리뷰더보기</span>
                            </p>
                            <ul>
                                <?php foreach ($driver['lastReviews'] as $main_review): ?>
                                    <li>
                                        <?= viewSQ($main_review['title']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="prd_list_pagination" id="cl_list_pg_">
    <div class="prd_list_pagination__btn">
        <svg width="20" height="20" viewBox="0 0 20 20" fill=""
             xmlns="http://www.w3.org/2000/svg">
            <path d="M2.00001 10C2.00001 10.2589 1.89465 10.5073 1.70712 10.6904C1.51958 10.8735 1.26523 10.9764 1.00001 10.9764C0.734797 10.9764 0.480443 10.8735 0.292907 10.6904C0.105371 10.5073 1.41207e-05 10.2589 1.41207e-05 10C-0.00315467 8.16016 0.527064 6.35702 1.52937 4.79904C2.53167 3.24106 3.96513 1.99188 5.66401 1.1959C7.36289 0.399924 9.25782 0.08967 11.1297 0.301007C13.0016 0.512343 14.774 1.23664 16.242 2.39016V0.976372C16.242 0.717422 16.3473 0.469078 16.5349 0.285973C16.7224 0.102868 16.9768 0 17.242 0C17.5072 0 17.7616 0.102868 17.9491 0.285973C18.1366 0.469078 18.242 0.717422 18.242 0.976372V4.88186C18.242 5.14081 18.1366 5.38915 17.9491 5.57226C17.7616 5.75536 17.5072 5.85823 17.242 5.85823H13.242C12.9768 5.85823 12.7224 5.75536 12.5349 5.57226C12.3474 5.38915 12.242 5.14081 12.242 4.88186C12.242 4.62291 12.3474 4.37457 12.5349 4.19146C12.7224 4.00835 12.9768 3.90549 13.242 3.90549H14.985C13.8101 2.98468 12.3923 2.40715 10.8955 2.23961C9.39874 2.07207 7.88392 2.32136 6.52606 2.95867C5.16819 3.59599 4.02267 4.59534 3.22179 5.84129C2.42091 7.08725 1.99734 8.52899 2.00001 10ZM19 9.02363C18.7348 9.02363 18.4804 9.1265 18.2929 9.3096C18.1053 9.49271 18 9.74105 18 10C18.0027 11.471 17.5791 12.9127 16.7782 14.1587C15.9773 15.4047 14.8318 16.404 13.4739 17.0413C12.1161 17.6786 10.6013 17.9279 9.10446 17.7604C7.60766 17.5928 6.18993 17.0153 5.01501 16.0945H6.75701C7.02222 16.0945 7.27657 15.9916 7.46411 15.8085C7.65165 15.6254 7.757 15.3771 7.757 15.1181C7.757 14.8592 7.65165 14.6108 7.46411 14.4277C7.27657 14.2446 7.02222 14.1418 6.75701 14.1418H2.75701C2.49179 14.1418 2.23744 14.2446 2.0499 14.4277C1.86237 14.6108 1.75701 14.8592 1.75701 15.1181V19.0236C1.75701 19.2826 1.86237 19.5309 2.0499 19.714C2.23744 19.8971 2.49179 20 2.75701 20C3.02223 20 3.27658 19.8971 3.46412 19.714C3.65165 19.5309 3.75701 19.2826 3.75701 19.0236V17.6098C5.22511 18.7633 6.99756 19.4875 8.86946 19.6987C10.7414 19.91 12.6363 19.5998 14.3352 18.8038C16.0341 18.0079 17.4676 16.7588 18.4701 15.2009C19.4725 13.6429 20.0029 11.8398 20 10C20 9.74105 19.8946 9.49271 19.7071 9.3096C19.5196 9.1265 19.2652 9.02363 19 9.02363Z"
                  fill="b   lack"></path>
        </svg>
        <span class="prd_list_pagination__btn__text">다음상품</span>
        <div class="prd_list_pagination__btn__pages">
            <span class="prd_list_pagination__btn__current">1</span>
            /
            <span class="prd_list_pagination__btn__total"><?= $len2 ?></span>
        </div>
    </div>
</div>
<style>
    .popupReview_ {
        width: 100vw;
        height: 100vh;
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999;
    }

    .popupReview_.open_ {
        display: flex;
    }

    .popupReview_ .popup_content_ {
        background: white;
        padding: 50px 30px 1px 30px;
        box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
        width: 580px;
        height: auto;
        max-height: 680px;
        min-height: 150px;
        overflow: hidden;
        overflow-y: auto;
        position: relative;
    }

    .popupReview_ .popup_content_::-webkit-scrollbar {
        width: 4px;
        background-color: #F5F5F5;
    }

    .popupReview_ .popup_content_::-webkit-scrollbar-thumb {
        background-color: #cccccc;
    }

    .popupReview_ .popup_content_ .popup_close_btn_ {
        position: absolute;
        top: 20px;
        right: 30px;
        cursor: pointer;
    }

    .popupReview_ .popup_content_ .title_pc_ {
        font-size: 18px;
        line-height: 1.222;
        padding-bottom: 30px;
        border-bottom: 1px solid rgb(37, 37, 37);
    }

    .popupReview_ .popup_content_ .des_pc_ {
        font-size: 16px;
        color: rgb(69, 69, 69);
        line-height: 1.875;
        padding-top: 30px;
        border-top: 1px solid rgb(219, 219, 219);
    }

    .popupReview_ .popup_content_ .last_des_pc_ {
        font-size: 16px;
        line-height: 1.875;
        color: rgb(117, 117, 117);
        margin-top: 16px;
        margin-bottom: 30px;
        display: flex;
        justify-content: flex-end;
    }
</style>
<div class="popupReview_" id="popupReview">
    <div class="popup_content_" id="popupReviewContent">
        <img src="/images/ico/employee_popup_close.png" class="popup_close_btn_" alt="close icon">
        <h3 class="title_pc_">뚝따 가이드님의 생생 리뷰 <span class="text-primary" id="countReview">28</span>개</h3>
        <div class="popup_content_list_" id="">

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.ssrv_more_btn').on('click', function () {
            let idx = $(this).data('idx');
            loadReview(idx);
            $('#popupReview').addClass('open_');
        });

        $('.popup_close_btn_').on('click', function () {
            $('#popupReview').removeClass('open_');
            $('.popup_content_list_').empty();
        });
    });

    async function loadReview(idx) {
        let url = '<?= route_to('api.driver.getDriverReviews') ?>?idx=' + idx;

        $.ajax({
            url: url,
            type: "GET",
            async: false,
            success: function (res) {
                let count = res.data.reviewCount;

                $('#countReview').html(count);

                if (res.data && Array.isArray(res.data.reviews)) {
                    let reviews = res.data.reviews;
                    let html = '';

                    for (let i = 0; i < reviews.length; i++) {
                        let review = reviews[i];

                        let date_formatted = convertDate(review.r_date);

                        html += ` <p class="des_pc_ review_desc_">
                                            ${review.contents}
                                        </p>
                                        <p class="last_des_pc_ review_date_">
                                            ${date_formatted}
                                        </p>`;
                    }

                    $('.popup_content_list_').empty().append(html);
                }

                convertReview();
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function convertReview() {
        $('.review_desc_').each(function () {
            $(this).html($(this).text());
        })
    }

    function convertDate(dateString) {
        let koreaTime = new Date(dateString);
        let daysOfWeekKorean = ["일", "월", "화", "수", "목", "금", "토"];
        let dayOfWeekKorean = daysOfWeekKorean[koreaTime.getDay()];

        let hours = koreaTime.getHours().toString().padStart(2, '0');
        let minutes = koreaTime.getMinutes().toString().padStart(2, '0');
        let seconds = koreaTime.getSeconds().toString().padStart(2, '0');

        let formattedDate = `${koreaTime.getFullYear()}-${String(koreaTime.getMonth() + 1).padStart(2, '0')}-${String(koreaTime.getDate()).padStart(2, '0')} ${hours}:${minutes}:${seconds}(${dayOfWeekKorean})`;
        console.log(formattedDate);
        return formattedDate;
    }
</script>