<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<style>
    .swiper-container-ticket {
        position: relative;
        overflow: hidden;
    }

    .swiper-button-next,
    .swiper-button-prev {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 10px;
        border-radius: 50%;
    }

    .swiper-button-next-ticket {
        z-index: 999;
        right: 0px;
        position: absolute;
        top: 40%;
    }

    .swiper-button-prev-ticket {
        z-index: 999;
        position: absolute;
        top: 40%;
        left: 0px;
    }

    .cursor-pointer-con img {
        cursor: pointer;
    }

    .btn-gr-ticket {
        max-width: 81%;
        overflow: hidden;
        height: 55px;
    }

    .btn-gr-ticket.full_ {
        flex-wrap: wrap;
        height: auto;
    }

    .select_tool {
        padding: 8px 16px 8px 16px;
        border: 1px solid #dbdbdb;
        border-radius: 32px;
    }

    .btnShowAll {
        padding-right: 32px;
    }

    .btnShowAll {
        background: url(/images/ico/down_icon.png) no-repeat right 50% #fff;
        background-size: 16px 8px;
    }

    .btnShowAll.open_ {
        background: url(/images/ico/up_icon.png) no-repeat right 50% #fff;
        background-size: 16px 8px;
    }
</style>
<section>
    <div class="body_inner guide-employee-page">
        <div class="banner-ticket">
            <div class="swiper-container-ticket">
                <div class="swiper-wrapper cursor-pointer-con">

                    <?php foreach ($products as $product) { ?>
                        <?php

                        $code_gubun = $product['product_code_1'];

                        $url = '#!';

                        if ($code_gubun == '1317') {
                            $url = '/ticket/ticket-detail/';
                        } elseif ($code_gubun == '1320') {
                            $url = '/product-restaurant/restaurant-detail/';
                        } elseif ($code_gubun == '1325') {
                            $url = '/product-spa/spa-details/';
                        }

                        ?>
                        <div class="swiper-slide"
                            onclick="location.href='<?= $url . $product['product_idx'] ?>'">
                            <div class="img_box_re">
                                <?php
                                if ($product["ufile1"] != "") {
                                ?>
                                    <img class="only_web"
                                        src="<?= base_url('/data/product/') . $product['ufile1'] ?>" alt="">
                                    <img class="only_mo img_box_re_img"
                                        src="<?= base_url('/data/product/') . $product['ufile1'] ?>" alt="">
                                <?php } else {
                                ?>
                                    <img class="only_web"
                                        src="/data/product/noimg.png" alt="">
                                    <img class="only_mo img_box_re_img"
                                        src="/data/product/noimg.png" alt="">
                                <?php }
                                ?>
                                <?php if ($product['product_type'] === "MD 추천") { ?>
                                    <img src="/uploads/icons/tag-p.png" alt="" class="tag-red only_web">
                                    <img src="/uploads/icons/tag-p-m.png" alt="" class="tag-red only_mo">
                                <?php } elseif ($product['product_type'] === "가성비 추천") { ?>
                                    <img src="/uploads/icons/tag-red.png" alt="" class="tag-red only_web">
                                    <img src="/uploads/icons/tag-red-m.png" alt="" class="tag-red only_mo">
                                <?php } elseif ($product['product_type'] === "핫딜 추천") { ?>
                                    <img src="/uploads/icons/tag-g.png" alt="" class="tag-red only_web">
                                    <img src="/uploads/icons/tag-g-m.png" alt="" class="tag-red only_mo">
                                <?php } ?>
                                <p class="text_img_box_re">
                                    <?= $product['product_name'] ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Add more slides as needed -->
                </div>
                <!-- Add Pagination -->
                <!-- <div class="swiper-pagination"></div> -->
                <!-- Add Navigation -->
                <div class="swiper-button-next-ticket only_web"><img src="/uploads/icons/next_s.png" alt=""></div>
                <div class="swiper-button-prev-ticket only_web"><img src="/uploads/icons/prev_s.png" alt=""></div>
            </div>


        </div>
        <div class="swiper-main-tools">
            <div class="play_pause" id="autoplay-button">
                <svg id="pause-button" class="pause" width="6" height="10" viewBox="0 0 6 10" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="2" height="10" fill="#757575" />
                    <rect x="4" width="2" height="10" fill="#757575" />
                </svg>
                <svg id="play-button" style="display: none;" class="play" width="8" height="10" viewBox="0 0 8 10"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.71975 4.48357L0.935104 0.11106C0.532604 -0.105726 0.0715332 -0.0832222 0.0715332 0.694992V9.305C0.0715332 10.0164 0.566176 10.1286 0.935104 9.88894L7.71975 5.51642C7.99904 5.23106 7.99904 4.76893 7.71975 4.48357Z"
                        fill="#757575" />
                </svg>
            </div>
            <div class="swiper-pagination-main">
                <span class="main_current_slide">1</span>&nbsp;/&nbsp;<span class="main_total_slide"></span>
                <!-- get total slide from database -->
            </div>
        </div>

        <h3 class="title-gp">
            몽키트래블 가이드를 소개합니다
        </h3>
        <div class="list-pic">
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>
            <div class="pic-item">
                <div class="pic-con">
                    <img src="/images/sub/guide_employee_01.png" alt="guide_employee_01">
                </div>
                <div class="right-text-des">
                    <h3 class="title-rtd">만나서 반가워요~</h3>
                    <div class="list-text-item">
                        <span>닉네임 : <span class="text-semibold">뚝따</span></span>
                        <span>나이 : <span class="text-semibold">49세</span></span>
                        <span>경력 : <span class="text-semibold">20년</span></span>
                        <span>경력 : <span class="text-semibold">한국어</span></span>
                    </div>
                    <div class="button-lp">28개의 리뷰 더보기 +</div>
                </div>
            </div>

        </div>
        <div class="prd_list_pagination" id="cl_list_pg_">
            <div class="prd_list_pagination__btn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.00001 10C2.00001 10.2589 1.89465 10.5073 1.70712 10.6904C1.51958 10.8735 1.26523 10.9764 1.00001 10.9764C0.734797 10.9764 0.480443 10.8735 0.292907 10.6904C0.105371 10.5073 1.41207e-05 10.2589 1.41207e-05 10C-0.00315467 8.16016 0.527064 6.35702 1.52937 4.79904C2.53167 3.24106 3.96513 1.99188 5.66401 1.1959C7.36289 0.399924 9.25782 0.08967 11.1297 0.301007C13.0016 0.512343 14.774 1.23664 16.242 2.39016V0.976372C16.242 0.717422 16.3473 0.469078 16.5349 0.285973C16.7224 0.102868 16.9768 0 17.242 0C17.5072 0 17.7616 0.102868 17.9491 0.285973C18.1366 0.469078 18.242 0.717422 18.242 0.976372V4.88186C18.242 5.14081 18.1366 5.38915 17.9491 5.57226C17.7616 5.75536 17.5072 5.85823 17.242 5.85823H13.242C12.9768 5.85823 12.7224 5.75536 12.5349 5.57226C12.3474 5.38915 12.242 5.14081 12.242 4.88186C12.242 4.62291 12.3474 4.37457 12.5349 4.19146C12.7224 4.00835 12.9768 3.90549 13.242 3.90549H14.985C13.8101 2.98468 12.3923 2.40715 10.8955 2.23961C9.39874 2.07207 7.88392 2.32136 6.52606 2.95867C5.16819 3.59599 4.02267 4.59534 3.22179 5.84129C2.42091 7.08725 1.99734 8.52899 2.00001 10ZM19 9.02363C18.7348 9.02363 18.4804 9.1265 18.2929 9.3096C18.1053 9.49271 18 9.74105 18 10C18.0027 11.471 17.5791 12.9127 16.7782 14.1587C15.9773 15.4047 14.8318 16.404 13.4739 17.0413C12.1161 17.6786 10.6013 17.9279 9.10446 17.7604C7.60766 17.5928 6.18993 17.0153 5.01501 16.0945H6.75701C7.02222 16.0945 7.27657 15.9916 7.46411 15.8085C7.65165 15.6254 7.757 15.3771 7.757 15.1181C7.757 14.8592 7.65165 14.6108 7.46411 14.4277C7.27657 14.2446 7.02222 14.1418 6.75701 14.1418H2.75701C2.49179 14.1418 2.23744 14.2446 2.0499 14.4277C1.86237 14.6108 1.75701 14.8592 1.75701 15.1181V19.0236C1.75701 19.2826 1.86237 19.5309 2.0499 19.714C2.23744 19.8971 2.49179 20 2.75701 20C3.02223 20 3.27658 19.8971 3.46412 19.714C3.65165 19.5309 3.75701 19.2826 3.75701 19.0236V17.6098C5.22511 18.7633 6.99756 19.4875 8.86946 19.6987C10.7414 19.91 12.6363 19.5998 14.3352 18.8038C16.0341 18.0079 17.4676 16.7588 18.4701 15.2009C19.4725 13.6429 20.0029 11.8398 20 10C20 9.74105 19.8946 9.49271 19.7071 9.3096C19.5196 9.1265 19.2652 9.02363 19 9.02363Z" fill="b   lack"></path>
                </svg>
                <span class="prd_list_pagination__btn__text">다음상품</span>
                <div class="prd_list_pagination__btn__pages">
                    <span class="prd_list_pagination__btn__current">1</span>
                    /
                    <span class="prd_list_pagination__btn__total">6</span>
                </div>
            </div>
        </div>
        <div class="box-description">
            <h3 class="title-bd">가이드 서비스 비용 및 예약</h3>
            <ul>
                <li>- 정식으로 라이센스를 가진 태국인 가이드 서비스는 자유여행에 아직 경험이 없으신 분들을 위해 원하시는 일정을 가이드와 협의하여 현지비용으로 관광을 하실 수 있는 서비스입니다.</li>
                <li>- 노옵션/노쇼핑/현지 비용으로 안내해드립니다.</li>
                <li>- 가이드만 예약 원하실 경우 차량렌탈과 함께 예약하지 않으실 경우 가이드 예약이 불가능 합니다.</li>
                <li>- 가이드 1일요금의 한화(원)기준 요금은 환율에 따라 수시로 변동 될 수 있습니다.</li>
                <li>- 한국어 가능한 태국인 가이드는 방콕, 파타야, 후아힌 등 지역을 제외하면 예약이 어려우니 예약 전에 문의 부탁드립니다.</li>
            </ul>
            <h3 class="title-bd  mt-46">가이드 서비스 비용 및 예약</h3>
            <ul>
                <li>- 몽키트래블의 태국인 한국어 가이드 / 태국인 영어가이드는 가이드 라이센스가 있는 전문 가이드입니다.</li>
                <li>- 가이드는 10시간/1일 기준이고, 10시간 넘을시는 시간당 200바트/1시간을 가이드에게 직접 주시면 됩니다.</li>
                <li>- 지방에 숙박하시는 경우, 숙박비 1박에 500바트씩을 가이드분께 직접 지불해주시면 됩니다</li>
                <li>- 가이드 팁은 불포함 사항입니다.</li>
            </ul>
        </div>


    </div>

</section>
<script>
    $('#cl_list_pg_').click(function() {
        $(this).remove();
        $('#list-ticket-grid').addClass('open_')
    })

    $('#search_product_name').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            searchSpa();
        }
    });

    $(document).ready(function() {
        let is_show = false;
        let item = $('#btn-gr-ticket');
        let w = item.width();

        let m_item = $('.ticket-tool');
        let wf = m_item.width();
        wf = wf * 80 / 100;
        if (w > wf) {
            is_show = true
        }

        showCode(is_show);
    })

    function showCode(is) {
        let select_tool = $('#select_tool');
        if (is) {
            select_tool.css('display', 'block')
        } else {
            select_tool.css('display', 'none')
        }
    }

    $('.btnShowAll').click(function() {
        $(this).toggleClass('open_')
        $('#btn-gr-ticket').toggleClass('full_')
    })
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
            init: function() {
                updateSlideCounter(this);
            },
            slideChange: function() {
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

    document.getElementById('autoplay-button').addEventListener('click', function() {
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