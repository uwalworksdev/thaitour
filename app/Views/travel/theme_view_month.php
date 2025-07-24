<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<div id="sub_container">
    <div class="inner">
        <div class="ac">
            <!--common/content/user/contents/theme/ev_th_250703.tpl start -->
            <div class="theme-section theme-product-review">
                <?php
                    if ($theme["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $theme["ufile1"])) {
                        $img = "/data/product/" . $theme["ufile1"];
                    } else {
                        $img = "/data/product/noimg.png";
                    }
                ?>
                <div class="theme_top theme_head01" style="background: url('<?=base_url($img)?>') no-repeat;background-size: cover;background-position-y: center;">
                    <div class="theme_headline">
                        <h3 class="f_white"><?=$theme["subtitle"]?></h3>
                        <h1 class="f_white"><?=$theme["title"]?></h1>
                    </div>
                </div>
                <div class="theme_content theme_cont" style="display: block;">
                    <div class="theme_intro_text">
                        <?=viewSQ($theme["recommend_text"])?>
                    </div>
                    <div class="week_wrap">
                        <a href="/user/product/product_info.php?product_id=1076747007" target="_blank">
                            <div class="wi_box">
                                <div class="room_img"><img src="https://i.travelapi.com/lodging/16000000/15950000/15947300/15947276/77df88cc_z.jpg" alt="모데나 바이 프레이저 방콕"></div>
                                <div class="wi_title">
                                    <div class="point_badge">객실</div>꼭 필요한 것만 세련되게 <span class="left_space">실속파에게 제격</span>
                                </div>
                                <div class="wi_con">
                                    총 238개의 객실은 군더더기 없는 레이아웃과 포근한 컬러톤으로 설계돼, 가볍게 머물거나 장기 투숙하기에 모두 적합합니다. <br>
                                    천장까지 닿는 통유리창 너머로 도심과 공원을 내다보며 여유로운 시간을 보낼 수 있고, 일부 객실에는 전자레인지·간이 키친·세탁기 등 장기 숙박자를 위한 편의 시설이 갖춰져 있어요.
                                    심플하지만 호텔다운 세련미는 유지되어, 실용성과 편안함을 모두 갖춘 공간이에요.
                                </div>
                                <div class="sub_txtbox">
                                    <dl class="">
                                        <dt>객실 별 사이즈</dt>
                                        <dd>디럭스 : 28㎡</dd>
                                        <dd>이그제큐티브 : 28㎡</dd>
                                        <dd>스튜디오 이그제큐티브 : 50㎡</dd>
                                        <dd>스튜디오 프리미어 : 55㎡</dd>
                                    </dl>
                                    <div class="sub_txtbox_img"><img src="https://i.travelapi.com/lodging/16000000/15950000/15947300/15947276/fdeb134a_z.jpg" alt="모데나 바이 프레이저 방콕"></div>
                                </div>
                            </div>
                            <div class="wi_box">
                                <div class="room_img"><img src="https://i.travelapi.com/lodging/16000000/15950000/15947300/15947276/ccdfd715_z.jpg" alt="모데나 바이 프레이저 방콕"></div>
                                <div class="wi_title">
                                    <div class="point_badge">위치</div>시내 이동도 쉬운 <span class="left_space">조용한 거점</span>
                                </div>
                                <div class="wi_con">
                                    MRT 퀸 시리킷 국립컨벤션센터역 1번 출구 바로 앞에 위치해 있어, MRT(지하철) 라인을 따라 여행하기에 최적의 위치 입니다. 아속, 실롬 지역과 차이나타운 등 주요 명소도 MRT 한 번이면 충분해요. <br>
                                    주변에는 벤자키티 공원, FYI 센터, 메드파크 병원 등 다양한 인프라가 밀집해 있어 비즈니스와 일상 모두를 편리하게 누릴 수 있는 환경입니다. </div>
                            </div>
                            <div class="wi_box">
                                <div class="room_img"><img src="https://i.travelapi.com/lodging/16000000/15950000/15947300/15947276/03c0a2f4_z.jpg" alt="모데나 바이 프레이저 방콕"></div>
                                <div class="wi_title">
                                    <div class="point_badge">시설</div>작지만 알차게 갖춘 <span class="left_space">실속형 구성</span>
                                </div>
                                <div class="wi_con">
                                    모데나 바이 프레이저 방콕은 실용적인 고객을 위한 최적의 시설을 갖추고 있어요.<br>
                                    조식 레스토랑 'Bistro@M restaurant'는 깔끔하고 정갈한 메뉴로 아침을 시작할 수 있으며, 1층 카페 공간은 조용한 미팅이나 노트북 작업 장소로 적당합니다. 피트니스 센터는 유산소와 웨이트 기구가 골고루 마련되어 있고, 사우나 및 스팀룸도 함께 운영돼요.
                                    <br>그 외에도 셀프 세탁실, 일부 객실 내 세탁기, 회의실, 무료 주차 공간 등도 준비돼 있어 출장객과 장기 숙박자 모두에게 유용한 환경입니다.
                                </div>
                                <div class="sub_txtbox">
                                    <dl class="">
                                        <dd>레스토랑 (Bistro@M restaurant) 조식 06:30 ~ 10:30 / 점심 11:30 ~ 15:00</dd>
                                        <dd>커피 &amp; 사이다 바 (Coffee &amp; Cider Bar) 07:00 ~ 20:00</dd>
                                        <dd>피트니스 센터 24시간 오픈</dd>
                                    </dl>
                                    <div class="sub_txtbox_img"><img src="https://i.travelapi.com/lodging/16000000/15950000/15947300/15947276/w11984h7500x0y0-23871b47_z.jpg" alt="모데나 바이 프레이저 방콕"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- <a href="/user/event/ev_auction.php?event_auction_id=96" target="_blank">
                        <div class="theme_bottom_box">
                            <div class="theme_bottom_imgbox">
                                <img src="https://i.travelapi.com/lodging/1000000/20000/10300/10244/534350d7_z.jpg" alt="몽키트래블 최저가 경매 107탄">
                            </div>
                            <div class="theme_bottom_content">
                                <div class="auction_header">
                                    <div class="auction_tit">
                                        <div class="auction_titbox">
                                            <span class="auction_tit_top">몽키트래블 매거진 자선 경매 이벤트</span>
                                            <span class="auction_tit_mid">최저가를 맞춰라</span>
                                        </div>
                                        <div class="auction_anibox">
                                            <span class="auction_ani">
                                                <img src="https://thai.monkeytravel.com/globals/common/kr/img/event/ev_auction/wingleft.gif?v=1" class="wingleft" alt="몽키트래블 최저가 경매">
                                                <img src="https://thai.monkeytravel.com/globals/common/kr/img/event/ev_auction/wingright.gif?v=1" class="wingright" alt="몽키트래블 최저가 경매">
                                                <img src="https://thai.monkeytravel.com/globals/common/kr/img/event/ev_auction/auctionmonkey.gif" class="auctionmonkey" alt="몽키트래블 최저가 경매">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <b> 몽키트래블 최저가 경매 107탄! <br>모데나 바이 프레이저 방콕</b><br>
                                    <b style="color: #ed0c8c;font-weight: 700;text-decoration: underline;">이벤트 종료</b>
                                    <p class="auction_txt">디럭스룸 2박 (2인 조식 포함) / 1장 <br>
                                        사용 가능 기간 : 2025년 6월 15일 ~ 2025년 10월 31일 </p>
                                </div>
                            </div>
                        </div>
                    </a> -->
                </div>
                <!-- <p class="mt40">
                    몽키트래블 태국 <a href="http://pf.kakao.com/_Vtezu" target="_blank"><b class="kakao_ch">카카오 채널</b></a>을 추가하시면 매월 이달의 추천 호텔과 최저가 경매 이벤트 및 각종 혜택 알림을 받으실 수 있어요.
                </p> -->
    
                <div class="hoteltheme_main" style="border-top:1px solid #f7f7f7;padding-top:35px">
                    <div class="head">
                        <h2>테마별 인기상품</h2>
                        <a href="/travel-tips/theme_main">더보기 +</a>
                    </div>
                    <div class="hotplace">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($hotel_theme_list as $row) {
                                    if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $row["ufile1"])) {
                                        $img = "/data/product/" . $row["ufile1"];
                                    } else {
                                        $img = "/data/product/noimg.png";
                                    }
                                ?>
                                    <div class="loc_banner swiper-slide">
                                        <a class="">
                                            <img src="<?= $img ?>" alt="<?= $row["rfile1"] ?>">
                                            <div class="card" onclick="location.href='/travel-tips/theme_view?theme_idx=<?= $row['idx'] ?>'">
                                                <span>
                                                    <?php
                                                    if ($row["type"] == "month") {
                                                        echo "이달의 호텔";
                                                    } else {
                                                        echo str_replace(',', 'ㆍ', $row["category_name"]);
                                                    }
                                                    ?>
                                                </span>
                                                <strong><?= $row["title"] ?></strong>
                                                <p><?= $row["subtitle"] ?></p>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cr_comment_list position">
            <h4 class="f_orange f_16">2025 몽키트래블 월간 추천 호텔</h4>
            <form name="frmCmt" id="frmCmt" action="/user/event/write_comment_ok.php" method="post">
                <input type="hidden" name="board_comment/board_id" id="board_id" value="250703">
                <input type="hidden" name="board_comment/listOrder" id="listOrder">
                <input type="hidden" name="board_comment/id" id="comment_id">
                <input type="hidden" name="code" id="code" value="notice">
                <input type="hidden" name="mode" id="mode" value="add">
                <input type="hidden" name="mfcode" value="MjU3fDExOTA=">
                <input type="hidden" name="page" value="">
                <div id="comment_wrap" class="mb30">
                    <input type="hidden" name="prefix" value="">
                    <div class="comment_input mt15">
                        <textarea name="board_comment/contentText" class="focusing fl" id="cbody" placeholder="내용을 입력해 주세요" rows="5"></textarea>
                        <input class="custom_btn2 b_orange_2 b_p3032 fl" onclick="commentsave();" type="button" value="입력">
                    </div>
                </div>
            </form>
            <table class="tbl_st18">
                <colgroup>
                    <col style="width:10%">
                    <col style="width:24px">
                    <col>
                    <col style="width:24px">
                    <col style="width:10%">
                </colgroup>
                <thead></thead>
                <tbody>
                </tbody>
            </table>
            <!-- start : common/element/user/pagination.tpl -->
            <div class="paginate"></div> <!-- end : common/element/user/pagination.tpl -->
        </div>
    </div>
    <!--common/element/user/event/event_comment.tpl end -->
</div>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        slidesPerGroup: 1,
        loopFillGroupWithBlank: true,
        spaceBetween: 20,
        loop: true,
        // autoplay: {
        //     delay: 3000,
        //     disableOnInteraction: false,
        // },
        pagination: {
            el: ".swiper-pagination",
            clickable: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            850: {
                slidesPerView: 3,
                slidesPerGroup: 3,
            }
        },
    });
    $(function() {
        $('.theme_content').eq(0).show();
        $('.theme_top li').on('click', function(e) {
            e.preventDefault();
            var idx = $(this).index();
            $('.theme_content').hide();
            $('.theme_content').eq(idx).show();
            $('.theme_top li').removeClass('on');
            $(this).addClass('on');
        });
    });
</script>

<?php $this->endSection(); ?>