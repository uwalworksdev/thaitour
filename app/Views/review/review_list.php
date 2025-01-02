<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
    <div id="container" class="sub list_container ">
        <section class="evaluate_section">
            <div class="inner">
                <a href="<?= $visual['url'] ?>" id="myLink">
                    <div class="sub_visual"
                         style="background-image: url(/images/mypage/review_bg.png);"></div>
                </a>
                <div class="sect_ttl_box">
                    <h2>Best 여행후기</h2>
                </div>
                <div class="evaluate_slider relative">
                    <div class="loading-container" id="loading-container">
                        <div class="spinner"></div>
                        <div class="loading-text">Loading...</div>
                    </div>

                    <div class="tour_slider preload" id="evaluate_slider">
                        <?php
                        foreach ($best_review as $key => $value) {
                            $img_url = "";

                            if (!$img_url and $value['ufile1']) {
                                $img_url = "/uploads/review/" . $value['ufile1'];
                            }

                            $pattern = '/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i';

                            if (preg_match($pattern, $value['contents'], $matches)) {
                                $img_url = $matches[1];
                            }

                            if (!$img_url) {
                                if ($value['product_img']) {
                                    $img_url = "/uploads/review/" . $value['product_img'];
                                }
                            }

                            if (!$img_url) {
                                $img_url = "/images/product/noimg.png";
                            }

                            ?>
                            <div class="slider_box">
                                <a href="./review_detail?idx=<?= $value['idx'] ?>">
                                    <div class="card">
                                        <div class="card_top" style="border: 1px solid #dbdbdb;">
                                            <img loading="lazy" src="<?= $img_url ?>" alt="">
                                            <div class="card_best">
                                                <span>BEST</span>
                                                <span><?= ($key + 1) ?></span>
                                            </div>
                                        </div>
                                        <div class="card_desc">
                                            <span><?= strAsterisk(sqlSecretConver($value["user_name"], 'decode')) ?></span>
                                            <h3><?= $value['title'] ?></h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                        <!-- </div> -->

                    </div>
                    <div class="swiper-slide-btn only_web preload" id="evaluate_button_slider">
                        <div class="swiper-button-prev" id="main-prev" tabindex="0" role="button"
                             aria-label="Previous slide"></div>
                        <div class="swiper-button-next" id="main-next" tabindex="0" role="button"
                             aria-label="Next slide">
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section class="evaluate_section_2">
            <div class="inner">
                <div class="sect_ttl_box">
                    <h2>여행후기</h2>
                    <div class="common_tab_wrap flex_b_c">
                        <ul class="common_tab flex_c_c">
                            <li class="<?= $category != "best" ? "active" : "" ?>"><a href="./review_list">전체</a></li>
                            <li class="<?= $category == "best" ? "active" : "" ?>"><a
                                        href="./review_list?category=best">Best후기모음</a></li>
                        </ul>
                        <form name="search" id="search">
                            <div class="evaluate_search flex">
                                <select name="search_category" class="evaluate_filter_selection">
                                    <option value="title" <?php if ($search_category == "title")
                                        echo "selected"; ?>>제목
                                    </option>
                                    <option value="contents" <?php if ($search_category == "contents")
                                        echo "selected"; ?>>내용
                                    </option>
                                    <option value="user_name" <?php if ($search_category == "user_name")
                                        echo "selected"; ?>>글쓴이
                                    </option>
                                </select>
                                <input type="text" name="s_txt" value="<?= $s_txt ?>">
                                <button class="search_button" type="button" onclick="search_it()">검색</button>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="bs_table">
                    <colgroup>
                        <col width="80px">
                        <col width="110px">
                        <col width="*">
                        <col width="140px">
                        <col width="110px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>NO</th>
                        <th>구분</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>등록일<?= $total_cnt ?>.<?= $page ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $now = strtotime(date("Y-m-d H:i:s"));

                    if ($total_cnt == 0) {
                        ?>
                        <tr>
                            <td colspan=5 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                        </tr>
                        <?php
                    }
                    foreach ($review_list as $value) {
                        $time = strtotime($value['r_date']);
                        $diff_time = $now - $time;
                        $is_new = $diff_time < (24 * 60 * 60) ? "<i></i>" : "";
                        $check_best = $value['r_date'] === "Y" ? "<img src='/images/ico/best_w.png'>" : "";
                        $row_class = $value['is_best'] === "Y" ? "bold-row" : "";

                        ?>
                        <tr>
                            <td class="num <?= $row_class ?>"><span><?= $no ?></span></td>
                            <td class=" <?= $row_class ?>">
                                <span><?= $value['travel_type'] == '1324' ? $value['travel_type_name2'] : $value['travel_type_name'] ?></span>
                            </td>
                            <td class="subject <?= $row_class ?>"><a href="./review_detail?idx=<?= $value['idx'] ?>">
                                    <?= $value['is_best'] === "Y" ? "<img src='/images/ico/best_w.png'>" : "" ?>
                                    <?= $value['title'] ?><span class="red">(<?= $value['cmt_cnt'] ?>)</span></a>
                                <!-- <?= $is_new ?> -->
                            </td>
                            <td class="name"><?= sqlSecretConver($value["user_name"], 'decode') ?></td>
                            <td class="date"><?= date("Y.m.d", strtotime($value['r_date'])) ?></td>
                        </tr>
                        <?php $no--;
                    } ?>
                    </tbody>
                </table>
                <div class="paging_wrap">
                    <?php echo ipageListing2($page, $total_page, $total_cnt, $currentUri . "?category=$category&search_category=" . $search_category . "&s_txt=" . $s_txt . "&page=", $deviceType) ?>
                    <a href="./review_write" class="btn btn-point btn-lg contact_btn">글쓰기</a>
                </div>
            </div>

        </section>
    </div>

    <script type="text/javascript">

        window.addEventListener('load', function () {
            var container = document.getElementById('evaluate_slider');
            if (container) {
                container.classList.remove('preload');
            }

            var container2 = document.getElementById('evaluate_button_slider');
            if (container2) {
                container2.classList.remove('preload'); // Sửa container thành container2
            }

            var loadingContainer = document.getElementById("loading-container");
            if (loadingContainer) { // Kiểm tra xem loadingContainer đã được tìm thấy chưa
                loadingContainer.style.display = "none";
            }
        });

        $(function () {
            $('.tour_slider').slick({
                lazyLoad: 'ondemand',
                autoplay: true,
                arrows: true,
                dots: false,
                infinite: false,
                slidesToScroll: 1,
                slidesToShow: 3,
                prevArrow: $('#main-prev'),
                nextArrow: $('#main-next'),
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                    {
                        breakpoint: 850,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            variableWidth: true
                        }
                    }
                ]
            });
        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myLink = document.getElementById("myLink");

            if (myLink.getAttribute("href") === "") {
                myLink.addEventListener("click", function (event) {
                    event.preventDefault();
                });
            }
        });

        function search_it() {
            var frm = document.search;
            frm.submit();
        }
    </script>

    <script>
        $(document).ready(function () {
            function adjustPaginationStyle() {
                if ($(window).width() <= 1000) {
                    $('.page').css({
                        'display': 'grid',
                        'grid-template-columns': '1fr 1fr 1fr 1fr 1fr 1fr 1fr',
                        'gap': '5px',
                        'text-align': 'center'
                    });
                    $('.common_tab').css({
                        'display': 'flex'
                    })

                } else {
                    $('.page').removeAttr('style');
                }
            }

            adjustPaginationStyle();

            $(window).resize(adjustPaginationStyle);
        });

    </script>

<?php $this->endSection(); ?>