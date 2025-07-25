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
                    style="background: url('<?= base_url($img) ?>') 
                                no-repeat;background-size: cover;background-position-y: center;">
                    <div class="theme_headline">
                        <h3 class="f_white"><?= $theme["subtitle"] ?></h3>
                        <h1 class="f_white"><?= $theme["title"] ?></h1>
                    </div>
                    <div class="theme_tab01 theme_tab">
                        <ul>
                            <?php
                            $i = 0;
                            foreach ($area_list as $frow) {
                            ?>
                                <li class="thememenu <?= ($i == 0) ? "on" : ""  ?>"><span><?= $frow["category_name"] ?></span></li>
                            <?php
                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="stfcomment" style="text-align: center;">
                    <?= viewSQ($theme["recommend_text"]) ?>
                </div>
                <?php
                $count = 0;
                foreach ($area_list as $frow) {
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
                                <a href="/product-hotel/hotel-detail/<?= $prow['product_idx'] ?>" target="_blank">
                                    <p class="theme_no"><span>TOP<b><?= $prow['step'] ?></b></span></p>
                                    <?php if ($step % 2 != 0): ?>
                                        <div class="box_top box_topleft">
                                            <div class="imgbox radius_right"><img src="<?= $img_1 ?>" alt="<?= $prow['rfile4'] ?>" style="top: 0"></div>
                                            <div class="txtbox">
                                                <div class="rating">
                                                    <span style="width:100%;"></span>
                                                </div>
                                                <h3 style="display: flex;align-items: center;"><?= $prow['theme_name'] ?></h3>
                                                <p class="txt"><?= viewSQ($prow['recommend']) ?></p>
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
                                                <h3 style="display: flex;align-items: center;"><?= $prow['theme_name'] ?></h3>
                                                <p class="txt"><?= viewSQ($prow['recommend']) ?></p>
                                                <div class="btnbox">
                                                    <span class="detailbtn">상품 상세보기</span>
                                                </div>
                                            </div>
                                            <div class="imgbox radius_left"><img src="<?= $img_1 ?>" alt="<?= $prow['rfile4'] ?>" style="top: 0"></div>
                                        </div>
                                    <?php endif; ?>
                                    <!-- <div class="box_top <?= ($step % 2 != 0) ? "box_topleft" : "" ?>">
                                    <div class="imgbox <?= ($step % 2 != 0) ? "radius_right" : "radius_left" ?>"><img src="<?= $img_1 ?>" alt="<?= $prow['rfile4'] ?>" style="top: 0"></div>
                                    <div class="txtbox">
                                        <div class="rating">
                                            <span style="width:100%;"></span>
                                        </div>
                                        <h3 style="display: flex;align-items: center;"><?= $prow['theme_name'] ?></h3>
                                        <p class="txt"><?= viewSQ($prow['recommend']) ?></p>
                                        <div class="btnbox">
                                            <span class="detailbtn">상품 상세보기</span>
                                        </div>
                                    </div>
                                </div> -->
                                    <div class="imgbox_bot">
                                        <span><img src="<?= $img_2 ?>" alt="<?= $prow['rfile2'] ?>"></span>
                                        <span><img src="<?= $img_3 ?>" alt="<?= $prow['rfile3'] ?>"></span>
                                        <span><img src="<?= $img_4 ?>" alt="<?= $prow['rfile4'] ?>"></span>
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
            <div class="view_relate">
                <div class="comment_box">
                    <div class="comment_box-top">
                        <div class="comment_box-count">
                            <span>댓글</span>
                            <span id="comment_count">(0)</span>
                        </div>
                        <?php
                        if (isset(session()->get("member")['idx'])) {
                        ?>
                            <form name="com_form" id="com_form" method="post" onsubmit="return false">
                                <input type="hidden" name="r_code" id="r_code" value="theme">
                                <input type="hidden" name="r_idx" id="r_idx" value="<?= $theme['idx'] ?>">
                                <div class="comment_box-input flex">
                                    <textarea style="resize:none" name="comment" class="bs-input" id="contents"
                                        placeholder="댓글을 입력해주세요."></textarea>
                                    <button type="button" onclick="fn_comment(<?= session('member.idx') ?>);"
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

<script>
    const r_code = "theme";
    const r_idx = '<?= $theme['idx'] ?>';
</script>

<script src="/js/comment.js"></script>

<?php $this->endSection(); ?>