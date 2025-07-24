<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<div id="container" class="sub view_container">
    <section class="theme_sect monkey_theme">
        <div class="inner">
            <div class="theme-section">
                <?php
                    if ($theme["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $theme["ufile1"])) {
                        $img = "/data/product/" . $theme["ufile1"];
                    } else {
                        $img = "/data/product/noimg.png";
                    }
                ?>
                <div class="theme_top theme_head01"
                    style="background: url('<?=base_url($img)?>') 
                                no-repeat;background-size: cover;background-position-y: center;">
                    <div class="theme_headline">
                        <h3 class="f_white"><?=$theme["subtitle"]?></h3>
                        <h1 class="f_white"><?=$theme["title"]?></h1>
                    </div>
                    <div class="theme_tab01 theme_tab">
                        <ul>
                            <?php
                                $i = 0;
                                foreach($area_list as $frow){
                            ?>
                                <li class="thememenu <?= ($i == 0) ? "on" : ""  ?>"><span><?= $frow["category_name"] ?></span></li>
                            <?php
                                    $i++;
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <p class="stfcomment">
                    <?=viewSQ($theme["comment"])?>
                </p>
                <?php
                    $count = 0;
                    foreach($area_list as $frow){
                ?>
                <div class="theme_content theme_cont" style="display: <?= ($count == 0) ? "block" : "none" ?>;">
                    <?php
                        foreach ($frow["product_list"] as $prow) {
                            $step = (int)$prow['step'];
                            if ($prow["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $prow["ufile1"])) {
                                $img_1 = "/data/product/" . $prow['ufile1'];
                            } else {
                                $img_1 = "/data/product/noimg.png";
                            }

                            if ($prow["ufile2"] != "" && is_file(ROOTPATH . "/public/data/product/" . $prow["ufile2"])) {
                                $img_2 = "/data/product/" . $prow['ufile2'];
                            } else {
                                $img_2 = "/data/product/noimg.png";
                            }

                            if ($prow["ufile3"] != "" && is_file(ROOTPATH . "/public/data/product/" . $prow["ufile3"])) {
                                $img_3 = "/data/product/" . $prow['ufile3'];
                            } else {
                                $img_3 = "/data/product/noimg.png";
                            }

                            if ($prow["ufile4"] != "" && is_file(ROOTPATH . "/public/data/product/" . $prow["ufile4"])) {
                                $img_4 = "/data/product/" . $prow['ufile4'];
                            } else {
                                $img_4 = "/data/product/noimg.png";
                            }
                    ?>
                        <div class="theme_nbox">
                            <a href="/product-hotel/hotel-detail/<?=$prow['product_idx']?>" target="_blank">
                                <p class="theme_no"><span>TOP<b><?=$prow['step']?></b></span></p>
                                <?php if ($step % 2 != 0): ?>
                                    <div class="box_top box_topleft">
                                        <div class="imgbox radius_right"><img src="<?=$img_1?>" alt="<?=$prow['rfile4']?>" style="top: 0"></div>
                                        <div class="txtbox">
                                            <div class="rating">
                                                <span style="width:100%;"></span>
                                            </div>
                                            <h3 style="display: flex;align-items: center;"><?=$prow['theme_name']?></h3>
                                            <p class="txt"><?=viewSQ($prow['recommend'])?></p>
                                            <div class="btnbox">
                                                <span class="detailbtn">상품 상세보기</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="box_top">
                                        <div class="txtbox">
                                            <div class="rating">
                                                <span style="width:100%;"></span>
                                            </div>
                                            <h3 style="display: flex;align-items: center;"><?=$prow['theme_name']?></h3>
                                            <p class="txt"><?=viewSQ($prow['recommend'])?></p>
                                            <div class="btnbox">
                                                <span class="detailbtn">상품 상세보기</span>
                                            </div>
                                        </div>
                                        <div class="imgbox radius_left"><img src="<?=$img_1?>" alt="<?=$prow['rfile4']?>" style="top: 0"></div>
                                    </div>
                                <?php endif; ?>
                                <!-- <div class="box_top <?= ($step % 2 != 0) ? "box_topleft" : "" ?>">
                                    <div class="imgbox <?= ($step % 2 != 0) ? "radius_right" : "radius_left" ?>"><img src="<?=$img_1?>" alt="<?=$prow['rfile4']?>" style="top: 0"></div>
                                    <div class="txtbox">
                                        <div class="rating">
                                            <span style="width:100%;"></span>
                                        </div>
                                        <h3 style="display: flex;align-items: center;"><?=$prow['theme_name']?></h3>
                                        <p class="txt"><?=viewSQ($prow['recommend'])?></p>
                                        <div class="btnbox">
                                            <span class="detailbtn">상품 상세보기</span>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="imgbox_bot">
                                    <span><img src="<?=$img_2?>" alt="<?=$prow['rfile2']?>"></span>
                                    <span><img src="<?=$img_3?>" alt="<?=$prow['rfile3']?>"></span>
                                    <span><img src="<?=$img_4?>" alt="<?=$prow['rfile4']?>"></span>
                                </div>
                            </a>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <?php
                    $count++;
                    }
                ?>
                <div class="hoteltheme_main" style="border-top:1px solid #f7f7f7;padding-top:35px">
                    <div class="head">
                        <h2>테마별 인기상품</h2>
                        <a href="/travel-tips/theme_main">더보기 +</a>
                    </div>
                    <div class="hotplace">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <?php
                                    foreach($hotel_theme_list as $row) {
                                        if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $row["ufile1"])) {
                                            $img = "/data/product/" . $row["ufile1"];
                                        } else {
                                            $img = "/data/product/noimg.png";
                                        }         
                                ?>
                                    <div class="loc_banner swiper-slide">
                                        <a class="">
                                            <img src="<?=$img?>" alt="<?=$row["rfile1"]?>">
                                            <div class="card" onclick="location.href='#'">
                                                <span>방콕ㆍ파타야</span>
                                                <strong>수영장이 좋은 호텔편</strong>
                                                <p>더투어랩 테마별 인기 호텔 TOP 5!</p>
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
            <div class="cr_comment_list position">
                <h4 class="f_orange f_16">태국 내 로컬 호텔 체인</h4>
                <form name="frmCmt" id="frmCmt" action="/user/event/write_comment_ok.php" method="post">
                    <input type="hidden" name="board_comment/board_id" id="board_id" value="250529">
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
    </section>
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