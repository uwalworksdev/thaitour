<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/tour/guides.css">
    <style>
        
    </style>
    <section>
        <?php $len = count($products); ?>
        <div class="body_inner guide-employee-page">

            <div class="item_list_area">
                <ul class="item_list_hotel">
                    <?php foreach ($products as $key => $product): ?>
                        <li class="item_<?= $key ?>">
                            <div class="thm">
                                <a href="/guide_view?g_idx=<?= $product['product_idx'] ?>" class="gaec_product">
                                    <?php
                                    if ($product["ufile1"] != "") {
                                        ?>
                                        <img class="only_web" onerror="this.src='/images/share/noimg.png'"
                                             src="<?= base_url('/uploads/guides/') . $product['ufile1'] ?>" alt="">
                                        <img class="only_mo img_box_re_img"
                                             src="<?= base_url('/uploads/guides/') . $product['ufile1'] ?>" alt="">
                                    <?php } else {
                                        ?>
                                        <img class="only_web"
                                             src="/data/product/noimg.png" alt="">
                                        <img class="only_mo img_box_re_img"
                                             src="/data/product/noimg.png" alt="">
                                    <?php }
                                    ?>
                                </a>
                            </div>
                            <div class="cont">
                                <div>
                                    <div class="tit_head">
                                        <p>
                                            <a href="/guide_view?g_idx=<?= $product['product_idx'] ?>"
                                               class="gaec_product">
                                                <h2> <?= $product['product_name'] ?></h2>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="etc">
                                        <?php
                                        $product_code_list = $product['product_code_list'];
                                        $_product_code_arr = explode("|", $product_code_list);
                                        $_product_code_arr = array_filter($_product_code_arr);
                                        ?>
                                        <?php
                                        foreach ($_product_code_arr as $_tmp_code) {
                                            ?>
                                            <p> <?= get_cate_text($_tmp_code) ?></p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="exp">
                                        <div class="truncate_txt_">
                                            <?= viewSQ($product['product_info']) ?>
                                        </div>
                                    </div>
                                    <div class="price_all">
                                        <a href="/guide_view?g_idx=<?= $product['product_idx'] ?>"
                                           class="gaec_product">
                                            <strong><?= number_format($product['product_price_won']) ?>원</strong>
                                            (<?= number_format($product['product_price']) ?>바트)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php if ($len > 4): ?>
                <div class="prd_list_pagination" id="cl_item_list_area_">
                    <div class="prd_list_pagination__btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.00001 10C2.00001 10.2589 1.89465 10.5073 1.70712 10.6904C1.51958 10.8735 1.26523 10.9764 1.00001 10.9764C0.734797 10.9764 0.480443 10.8735 0.292907 10.6904C0.105371 10.5073 1.41207e-05 10.2589 1.41207e-05 10C-0.00315467 8.16016 0.527064 6.35702 1.52937 4.79904C2.53167 3.24106 3.96513 1.99188 5.66401 1.1959C7.36289 0.399924 9.25782 0.08967 11.1297 0.301007C13.0016 0.512343 14.774 1.23664 16.242 2.39016V0.976372C16.242 0.717422 16.3473 0.469078 16.5349 0.285973C16.7224 0.102868 16.9768 0 17.242 0C17.5072 0 17.7616 0.102868 17.9491 0.285973C18.1366 0.469078 18.242 0.717422 18.242 0.976372V4.88186C18.242 5.14081 18.1366 5.38915 17.9491 5.57226C17.7616 5.75536 17.5072 5.85823 17.242 5.85823H13.242C12.9768 5.85823 12.7224 5.75536 12.5349 5.57226C12.3474 5.38915 12.242 5.14081 12.242 4.88186C12.242 4.62291 12.3474 4.37457 12.5349 4.19146C12.7224 4.00835 12.9768 3.90549 13.242 3.90549H14.985C13.8101 2.98468 12.3923 2.40715 10.8955 2.23961C9.39874 2.07207 7.88392 2.32136 6.52606 2.95867C5.16819 3.59599 4.02267 4.59534 3.22179 5.84129C2.42091 7.08725 1.99734 8.52899 2.00001 10ZM19 9.02363C18.7348 9.02363 18.4804 9.1265 18.2929 9.3096C18.1053 9.49271 18 9.74105 18 10C18.0027 11.471 17.5791 12.9127 16.7782 14.1587C15.9773 15.4047 14.8318 16.404 13.4739 17.0413C12.1161 17.6786 10.6013 17.9279 9.10446 17.7604C7.60766 17.5928 6.18993 17.0153 5.01501 16.0945H6.75701C7.02222 16.0945 7.27657 15.9916 7.46411 15.8085C7.65165 15.6254 7.757 15.3771 7.757 15.1181C7.757 14.8592 7.65165 14.6108 7.46411 14.4277C7.27657 14.2446 7.02222 14.1418 6.75701 14.1418H2.75701C2.49179 14.1418 2.23744 14.2446 2.0499 14.4277C1.86237 14.6108 1.75701 14.8592 1.75701 15.1181V19.0236C1.75701 19.2826 1.86237 19.5309 2.0499 19.714C2.23744 19.8971 2.49179 20 2.75701 20C3.02223 20 3.27658 19.8971 3.46412 19.714C3.65165 19.5309 3.75701 19.2826 3.75701 19.0236V17.6098C5.22511 18.7633 6.99756 19.4875 8.86946 19.6987C10.7414 19.91 12.6363 19.5998 14.3352 18.8038C16.0341 18.0079 17.4676 16.7588 18.4701 15.2009C19.4725 13.6429 20.0029 11.8398 20 10C20 9.74105 19.8946 9.49271 19.7071 9.3096C19.5196 9.1265 19.2652 9.02363 19 9.02363Z"
                                  fill="b   lack"></path>
                        </svg>
                        <span class="prd_list_pagination__btn__text">다음상품</span>
                        <div class="prd_list_pagination__btn__pages">
                            <span class="prd_list_pagination__btn__current">1</span>
                            /
                            <span class="prd_list_pagination__btn__total"><?= $len ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <script>
                $(document).ready(function () {
                    const cnt = `<?= $len ?>`;

                    function updateCode(type) {
                        for (let i = cnt; i > 3; i--) {
                            if (type == 'S') {
                                $('.item_' + i).css('display', 'flex');
                            } else {
                                $('.item_' + i).css('display', 'none');
                            }
                        }
                    }

                    updateCode('H');

                    $('#cl_item_list_area_').click(function () {
                        updateCode('S');
                        $(this).css('display', 'none')
                    })
                })
            </script>

            <div class="car_intro">
                <table class="tbl_guide w_100">
                    <colgroup>
                        <col style="width:20%">
                        <col style="">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th>가이드<br> 서비스 비용 및 예약</th>
                        <td>
                            <?= viewSQ(getPolicy(21)) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>현지 가격 안내</th>
                        <td>
                            <?= viewSQ(getPolicy(22)) ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php $len2 = count($guides); ?>
            <h3 class="title-gp">
                더투아랩 가이드를 소개합니다
            </h3>
            <div class="list-pic <?= $len2 > 3 ? '' : 'full_' ?>" id="list_pic">
                <?php foreach ($guides as $guide): ?>
                    <div class="pic-item">
                        <div class="pic-con">
                            <?php if ($guide["ufile1"] != "") { ?>
                                <img src="<?= base_url('/uploads/guides/') . $guide['ufile1'] ?>"
                                     alt="guide_employee_01">
                            <?php } else {
                                ?>
                                <img src="/data/product/noimg.png" alt="guide_employee_01">
                            <?php } ?>

                        </div>
                        <div class="right-text-des">
                            <h3 class="title-rtd"><?= $guide['slogan'] ?></h3>
                            <div class="list-text-item">
                                <span>닉네임 : <span class="text-semibold"><?= $guide['special_name'] ?></span></span>
                                <span>나이 : <span class="text-semibold"><?= $guide['age'] ?>세</span></span>
                                <span>경력 : <span class="text-semibold"><?= $guide['exp'] ?>년</span></span>
                                <span>언어: <span class="text-semibold"><?= $guide['language'] ?></span></span>
                            </div>
                            <div class="button-lp" data-idx="<?= $guide['product_idx'] ?>"><?= $guide['countReviews'] ?>
                                개의 리뷰 더보기 +
                            </div>
                        </div>

                        <div class="popup_content_" id="popupReviewContent<?= $guide['product_idx'] ?>">
                            <img src="/images/ico/employee_popup_close.png" data-idx="<?= $guide['product_idx'] ?>"
                                 class="popup_close_btn_" alt="close icon">
                            <h3 class="title_pc_">뚝따 가이드님의 생생 리뷰 <span class="text-primary"
                                                                       id="countReview<?= $guide['product_idx'] ?>">28</span>개
                            </h3>
                            <div class="popup_content_list_" id="popup_content_list_<?= $guide['product_idx'] ?>">

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($len2 > 3): ?>
                <div class="prd_list_pagination" id="cl_list_pg_">
                    <div class="prd_list_pagination__btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="" xmlns="http://www.w3.org/2000/svg">
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
            <?php endif; ?>
        </div>
    </section>
    <style>
        .popup_content_ {
            z-index: 100;
            margin-top: 0;
            top: 0;
            left: 0;
            position: absolute;
            background: white;
            padding: 50px 30px 1px 30px;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1);
            width: 580px;
            height: auto;
            max-height: 680px;
            min-height: 150px;
            overflow: hidden;
            overflow-y: auto;
            display: none;
        }

        .popup_content_.show_ {
            display: block;
        }

        .popup_content_::-webkit-scrollbar {
            width: 4px;
            background-color: #F5F5F5;
        }

        .popup_content_::-webkit-scrollbar-thumb {
            background-color: #cccccc;
        }

        .popup_content_ .popup_close_btn_ {
            position: absolute;
            top: 20px;
            right: 30px;
            cursor: pointer;
        }

        .popup_content_ .title_pc_ {
            font-size: 18px;
            line-height: 1.222;
            padding-bottom: 30px;
            border-bottom: 1px solid rgb(37, 37, 37);
        }

        .popup_content_ .des_pc_ {
            font-size: 16px;
            color: rgb(69, 69, 69);
            line-height: 1.875;
            padding-top: 30px;
            border-top: 1px solid rgb(219, 219, 219);
        }

        .popup_content_ .last_des_pc_ {
            font-size: 16px;
            line-height: 1.875;
            color: rgb(117, 117, 117);
            margin-top: 16px;
            margin-bottom: 30px;
            display: flex;
            justify-content: flex-end;
        }
    </style>
    <script>
        $(document).ready(function () {
            <?php if ($len < 4): ?>
            $('.swiper-button-next-ticket').removeClass('only_web').css('display', 'none');
            $('.swiper-button-prev-ticket').removeClass('only_web').css('display', 'none');
            $('.swiper-main-tools').css('display', 'none');
            <?php endif; ?>

            $('.button-lp').on('click', function () {
                let idx = $(this).data('idx');
                loadReview(idx);
                $('#popupReviewContent' + idx).addClass('show_');
            });

            $('.popup_close_btn_').on('click', function () {
                let idx = $(this).data('idx');
                $('#popupReviewContent' + idx).removeClass('show_');
            });

            $('#cl_list_pg_').click(function () {
                $(this).css('display', 'none');
                $('#list_pic').addClass('full_');
            })
        });

        async function loadReview(idx) {
            let url = '<?= route_to('api.guide.getReviews') ?>?idx=' + idx;

            $.ajax({
                url: url,
                type: "GET",
                async: false,
                success: function (res) {
                    let count = res.data.reviewCount;

                    $('#countReview' + idx).html(count);

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

                        $('#popup_content_list_' + idx).empty().append(html);
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
    <script>
        let swiper = new Swiper('.swiper-container-ticket', {
            // Default setting
            // slidesPerView: 3,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            spaceBetween: 22,
            navigation: {
                nextEl: '.swiper-button-next-ticket',
                prevEl: '.swiper-button-prev-ticket',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            // Responsive breakpoints
            breakpoints: {
                // When window width is >= 850px
                850: {
                    slidesPerView: 3
                },
                // When window width is < 850px
                849: {
                    slidesPerView: 1
                }
            },
            on: {
                init: function () {
                    updateSlideCounter(this);
                },
                slideChange: function () {
                    updateSlideCounter(this);
                }
            }
        });

        function updateSlideCounter(swiper) {
            var currentIndex = swiper.realIndex + 1;
            var totalSlides = swiper.slides.length;
            document.querySelector('.main_current_slide').innerText = currentIndex;
            document.querySelector('.main_total_slide').innerText = totalSlides;
        }

        document.getElementById('autoplay-button').addEventListener('click', function () {
            var playButton = document.getElementById('play-button');
            var pauseButton = document.getElementById('pause-button');
            if (swiper.autoplay.running) {
                swiper.autoplay.stop();
                playButton.style.display = 'block';
                pauseButton.style.display = 'none';
            } else {
                swiper.autoplay.start();
                playButton.style.display = 'none';
                pauseButton.style.display = 'block';
            }
        });
    </script>

<?php $this->endSection(); ?>