<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<link rel="stylesheet" href="/css/magazines/magazines.css">

<div class="container travel_info theme_travel">
    <div class="inner">
        <div class="sub-hotel-navigation-container">
            <div class="navigation-container-prev">
                <img class="icon_home" src="/uploads/icons/icon_home.png" alt="icon_home">
                <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
                <span id="depth_1_tool_title_">여행꿀팁</span>
            </div>
            <div class="navigation-container-next">
                <img class="ball_dot_icon icon_open_depth_01 icon_open_depth_" data-depth="depth_1_tools_" src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
                <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
                <span class="font-bold">더투어랩 테마여행</span>
            </div>
            <div class="navigation-container-next">
                <img class="ball_dot_icon icon_open_depth_02 icon_open_depth_" data-depth="depth_2_tools_" src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
            </div>
        </div>
        <h2>더투어랩 테마여행</h2>
        <div class="list_tab_head">
            <div class="tab on"><a href="#!">전체</a></div>
            <div class="tab"><a href="#!">관광명소</a></div>
            <div class="tab"><a href="#!">할거리</a></div>
            <div class="tab"><a href="#!">음식</a></div>
            <div class="tab"><a href="#!">쇼핑</a></div>
            <div class="tab"><a href="#!">나이트라이프</a></div>
        </div>

        <form action="" name="frmSearch" method="get">
            <div class="head_list_product">
                <div class="wrap_select">
                    <select class="" name="search_mode" id="search_mode">
                        <option value="subject" <?php if ($search_mode == "subject") {
                                                    echo "selected";
                                                } ?>>제목</option>
                        <option value="contents" <?php if ($search_mode == "contents") {
                                                        echo "selected";
                                                    } ?>>내용</option>
                        <option value="writer" <?php if ($search_mode == "writer") {
                                                    echo "selected";
                                                } ?>>작성자</option>
                    </select>
                    <select class="" name="search_mode" id="search_mode">
                        <option value="subject" <?php if ($search_mode == "subject") {
                                                    echo "selected";
                                                } ?>>상세지역</option>
                        <option value="contents" <?php if ($search_mode == "contents") {
                                                        echo "selected";
                                                    } ?>>상세지역 2</option>
                        <option value="writer" <?php if ($search_mode == "writer") {
                                                    echo "selected";
                                                } ?>>상세지역 3</option>
                    </select>
                </div>
                <div class="input_search_box">
                    <input type="text" name="search_word" id="search_word" value="<?= $search_word ?>">
                    <img src="/img/sub/search-ic-01.png" style="cursor: pointer;" onclick="goSearch()" alt="search-ic">
                </div>
            </div>
        </form>

        <script>
            function goSearch() {
                let frm = document.frmSearch;
                frm.submit();
            }
        </script>

        <div class="list_product">
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-1.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-2.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-3.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-4.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-5.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-6.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-7.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="img">
                    <img src="/img/sub/theme-travel-8.png" alt="">
                    <div class="text">
                        <span>쇼핑 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span>백화점/쇼핑몰</span>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        <span>방콕 </span>
                        <img src="/img/sub/arr-right-01.png" alt="">
                        <span> 스쿰빗(아속-프롬퐁)</span>
                    </div>
                    <p class="name">터미널 21 아속</p>
                    <div class="vote">
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                        <span>이용자 리뷰 <i>(0)</i></span>
                    </div>
                </div>
            </div>
            
        </div>
        <?php
        echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?category=" . $category . "&search_mode=" . $search_mode . "&search_word=" . $search_word . "&pg=")
        ?>
    </div>

    <script>
        // $(document).ready(function() {
        //     $('.list_tab_head .tab').click(function() {
        //         $('.list_tab_head .tab').removeClass('on');
        //         $(this).addClass('on');
        //     });
        // });
    </script>

    <?php $this->endSection(); ?>