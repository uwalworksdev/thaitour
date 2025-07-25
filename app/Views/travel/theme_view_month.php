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
                        <a href="<?=$theme["url"]?>" target="_blank">
                            
                            <div class="wi_box">
                                <?php
                                    if(!empty($product_list[0]["ufile1"]) && is_file(ROOTPATH . "/public/data/product/" . $product_list[0]["ufile1"])) {
                                ?>
                                    <div class="room_img"><img src="/data/product/<?=$product_list[0]["ufile1"]?>" alt="<?=$product_list[0]["rfile1"]?>"></div>
                                <?php
                                    }
                                ?>
                                <div class="wi_title">
                                    <div class="point_badge">객실</div><?= $product_list[0]["theme_name"] ?>
                                </div>
                                <div class="wi_con">
                                    <?=viewSQ(nl2br($product_list[0]["recommend"]))?>
                                </div>
                                <div class="sub_txtbox">
                                    <?php
                                        if(!empty($product_list[0]["details"])) {  
                                    ?>
                                    <div class="desc">
                                        <p class="ttl">객실 별 사이즈</p>
                                        <?=viewSQ(nl2br($product_list[0]["details"]))?>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if(!empty($product_list[0]["ufile2"]) && is_file(ROOTPATH . "/public/data/product/" . $product_list[0]["ufile2"])) {
                                    ?>
                                        <div class="sub_txtbox_img"><img src="/data/product/<?=$product_list[0]["ufile2"]?>" alt="<?=$product_list[0]["rfile2"]?>"></div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="wi_box">
                                <?php
                                    if(!empty($product_list[1]["ufile1"]) && is_file(ROOTPATH . "/public/data/product/" . $product_list[1]["ufile1"])) {
                                ?>
                                    <div class="room_img"><img src="/data/product/<?=$product_list[1]["ufile1"]?>" alt="<?=$product_list[1]["rfile1"]?>"></div>
                                <?php
                                    }
                                ?>
                                <div class="wi_title">
                                    <div class="point_badge">위치</div><?= $product_list[1]["theme_name"] ?>
                                </div>
                                <div class="wi_con">
                                   <?=viewSQ(nl2br($product_list[1]["recommend"]))?>
                                </div>
                            </div>
                            <div class="wi_box">
                                <?php
                                    if(!empty($product_list[2]["ufile1"]) && is_file(ROOTPATH . "/public/data/product/" . $product_list[2]["ufile1"])) {
                                ?>
                                    <div class="room_img"><img src="/data/product/<?=$product_list[2]["ufile1"]?>" alt="<?=$product_list[2]["rfile1"]?>"></div>
                                <?php
                                    }
                                ?>
                                <div class="wi_title">
                                    <div class="point_badge">시설</div><?= $product_list[2]["theme_name"] ?>
                                </div>
                                <div class="wi_con">
                                    <?=viewSQ(nl2br($product_list[2]["recommend"]))?>
                                </div>
                                <div class="sub_txtbox">
                                    <div class="desc">
                                        <?=viewSQ(nl2br($product_list[2]["details"]))?>
                                    </div>
                                    <?php
                                        if(!empty($product_list[2]["ufile2"]) && is_file(ROOTPATH . "/public/data/product/" . $product_list[2]["ufile2"])) {
                                    ?>
                                        <div class="sub_txtbox_img"><img src="/data/product/<?=$product_list[2]["ufile2"]?>" alt="<?=$product_list[2]["rfile2"]?>"></div>
                                    <?php
                                        }
                                    ?>
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
        <div class="view_relate">
                <div class="comment_box">
                    <div class="comment_box-top">
                        <div class="comment_box-count">
                            <span>댓글</span>
                            <span id="comment_count">(0)</span>
                        </div>
                        <?php
                            if(isset(session()->get("member")['idx'])){
                        ?>
                            <form name="com_form" id="com_form" method="post" onsubmit="return false">
                                <input type="hidden" name="r_code" id="r_code" value="<?= $infographic['code'] ?>">
                                <input type="hidden" name="r_idx" id="r_idx" value="<?= $infographic['bbs_idx'] ?>">
                                <input type="hidden" name="tbc_idx" id="tbc_idx" value="">
                                <div class="comment_box-input flex">
                                    <textarea style="resize:none" name="comment" class="bs-input" id="contents"
                                        placeholder="댓글을 입력해주세요."></textarea>
                                    <button type="button" onclick="fn_comment(<?=session('member.idx')?>);"
                                        class="btn btn-point btn-lg comment_btn">등록</button>
                                </div>
                            </form>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="comment_box-details comment" id="comment_list">

                    </div>
                </div>
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

<script src="/js/comment.js"></script>

<?php $this->endSection(); ?>