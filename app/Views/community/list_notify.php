<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
<section class="customer-notify-page customer-center-page">
    <div class="inner">
        <div class="main-container">
            <div class="side-bar only_web">
                <h2 class="title-side-bar">고객센터</h2>
                <div class="list-item-bar">
                    <div class="itembar">
                        <a href="/community/customer_center">자주 찾는 질문</a>
                    </div>
                    <div class="itembar active"><a href="/community/customer_center/list_notify">태국뉴스 및 공지사항</a></div>
                    <div class="itembar"><a href="/qna/list">1 : 1 게시판</a></div>
                    <div class="itembar"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                </div>
            </div>
            <div class="gnb_menu only_mo">
                <h1 class="gnb_title">고객센터</h1>
                <button type="button" class="now_tab_text only_mo">예약내역</button>
                <ul class="gnb_menu_list flex">
                    <li class="">
                        <div class="menu_level_1 flex_b_c"><a href="/community/customer_center">자주 찾는 질문</a></div>
                    </li>
                    <li class="on">
                        <div class="menu_level_1 flex_b_c"><a href="/community/customer_center/list_notify">태국뉴스 및 공지사항</a></div>
                    </li>
                    <li class="">
                        <div class="menu_level_1 flex_b_c"><a href="/qna/list">1 : 1 게시판</a></div>
                    </li>
                    <li class="">
                        <div class="menu_level_1 flex_b_c"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                    </li>

                </ul>
            </div>
            <div class="con-right">
                <div class="menu">
                    <div class="menu-header">
                        <h3 class="title-menu title-menu-line-bot">
                            태국뉴스 및 공지사항
                        </h3>
                    </div>
                    <?php
                    foreach ($notice as $row) {
                    ?>
                        <div class="item-no" data-url="/community/customer_center/notify?bbs_idx=<?= $row["bbs_idx"] ?>">
                            <h3 class="item-title">
                                <?= $row["notice_yn"] == "Y" ? "<span class='notice'>[공지]</span>" : "" ?>
                                <?= $row["subject"] ?>
                            </h3>
                            <div class="item-date"><?= date("Y.m.d", strtotime($row["r_date"])) ?></div>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">2024년 8월 국제선 대한항공/아시아나항공 유류할증료 안내</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">[당첨자 발표] '잘 만든 패키지여행을 만났다' 캠페인 영상 공유 이벤트 당첨자 공지</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">[안내] MS클라우드 장애로 인한 일부 항공사의 수속 지연 관련</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">더 풍성한 여행일정 만드는 방법, 플래너</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">24년 6월 5일 방송 이벤트 당첨자 안내(댓글,구매인증,객실업그레이드,2인조식)</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">24년 6월 3일 방송 이벤트 당첨자 안내(사전알림/소통왕/댓글 참여)</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">[공지] 24년 6월, 신용카드 ARS/온라인 무이자 할부 혜택 관련 안내 (항공권 제외)</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title"> 24년 5월 29일 방송 이벤트 당첨자 안내(사전알림/소통왕/구매인증)</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">2024년 8월 국제선 대한항공/아시아나항공 유류할증료 안내</h3>
                        <div class="item-date">2024.07.26</div>
                    </div>
                    <div class="item-no" data-url="/community/customer_center/notify">
                        <h3 class="item-title">2024년 8월 국제선 대한항공/아시아나항공 유류할증료 안내</h3>
                        <div class="item-date">2024.07.26</div>
                    </div> -->
                    <?php
                    echo ipagelistingSub($pg, $total_page, $scale, current_url() . "?pg=")
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const items = document.querySelectorAll('.item-tag');

    items.forEach((item, index) => {
        item.addEventListener('click', function() {
            items.forEach(i => i.classList.remove('active'));

            this.classList.add('active');

            const img = this.querySelector('img');
            if (img) {
                img.src = `/images/community/customer_icon_0${index + 1}_active.png`;
            }

            items.forEach((i, idx) => {
                if (i !== this) {
                    const nonActiveImg = i.querySelector('img');
                    if (nonActiveImg) {
                        nonActiveImg.src = `/images/community/customer_icon_0${idx + 1}.png`;
                    }
                }
            });
        });
    });


    const item_no = document.querySelectorAll('.item-no');

    item_no.forEach(item => {
        item.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            } else {
                alert("No URL provided!");
            }
        });
    });

    function go_list() {
        window.history.back();
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {

        if ($(window).width() <= 850) {
            snbActive();
        }

        function snbActive() {
            $('.now_tab_text').on('click', function() {
                if ($(this).hasClass('active') == true) {
                    $(this).removeClass('active');
                    $('.gnb_menu_list').stop().slideUp();
                } else {
                    $(this).addClass('active');
                    $('.gnb_menu_list').stop().slideDown();
                }
            })
            $('.menu_level_1 > div').on('click', function(e) {
                if ($(this).next('.menu_level_2').length > 0) {
                    e.preventDefault();
                    $(this).next('.menu_level_2').stop().slideToggle();
                } else {
                    $('.gnb_menu_list').stop().slideUp();
                    $('.now_tab_text').removeClass('active');
                }
            });
            let nowTxt = $('.gnb_menu .gnb_menu_list li.on .menu_level_1 a').text();
            $('.gnb_menu .now_tab_text').text(nowTxt);

        }

        $(".gnb_menu_list > li .menu_level_1 .show").on("click", function() {
            $(this).siblings(".btn_togle").toggleClass("up");
            $(this).closest(".menu_level_1").siblings(".menu_level_2").slideToggle(100, function() {

            });
        });
        $(".gnb_menu_list > li .menu_level_1 .btn_togle").on("click", function() {
            $(this).toggleClass("up");
            $(this).closest(".menu_level_1").siblings(".menu_level_2").slideToggle(100, function() {

            });
        });

        $(".gnb_menu_list > li.on").each(function() {
            $(this).find('.menu_level_1 .btn_togle').removeClass("up");
            $(this).find('.menu_level_2').css('display', 'flex');

        });
    })
</script>
<?php $this->endSection(); ?>