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
                <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
                <span class="font-bold"><?=$code_active_name?></span>
                <div class="depth_3_tools_" id="depth_3_tools_">
                    <ul class="depth_3_tool_list_" id="depth_3_tool_list_">
                        <?php
                            foreach($city_code_list as $code){
                        ?>
                            <li class="depth_3_item_ " data-code="<?=$code["code_no"]?>">
                                <a href="/travel-tips/theme_travel?city_code=<?=$code["code_no"]?>" class=""><?=$code["code_name"]?></a>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="navigation-container-next">
                <img class="ball_dot_icon icon_open_depth_03 icon_open_depth_" data-depth="depth_3_tools_"
                    src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
            </div>
        </div>
        <h2>더투어랩 테마여행</h2>
        <div class="list_tab_head">
            <div class="tab <?= empty($category_code) ? "on" : ""?>"><a href="/travel-tips/theme_travel?city_code=<?=$city_code?>">전체</a></div>
            <?php
            foreach ($category_code_list as $code) {
            ?>
                <div class="tab <?= $category_code == $code["code_no"] ? "on" : ""?>"><a href="/travel-tips/theme_travel?city_code=<?=$city_code?>&category_code=<?=$code["code_no"]?>"><?=$code["code_name"]?></a></div>
            <?php
            }
            ?>
            <!-- <div class="tab"><a href="#!">관광명소</a></div>
            <div class="tab"><a href="#!">할거리</a></div>
            <div class="tab"><a href="#!">음식</a></div>
            <div class="tab"><a href="#!">쇼핑</a></div>
            <div class="tab"><a href="#!">나이트라이프</a></div> -->
        </div>

        <form action="" name="frmSearch" method="get">
            <input type="hidden" name="city_code" value="<?=$city_code?>">
            <input type="hidden" name="category_code" value="<?=$category_code?>">

            <div class="head_list_product">
                <div class="wrap_select">
                    <select name="town_code" id="town_code" onchange="goSearch()">
                        <option value="" <?= empty($town_code) ? "selected" : ""?>>상세지역</option>
                        <?php
                            foreach($town_code_list as $code){     
                        ?>
                            <option value="<?=$code["code_no"]?>" <?= $town_code == $code["code_no"] ? "selected" : ""?>><?=$code["code_name"]?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <?php
                        if(!empty($category_code)){
                    ?>
                        <select name="subcategory_code" id="subcategory_code" onchange="goSearch()">
                            <option value="" <?= empty($subcategory_code) ? "selected" : ""?>>하위 카테고리</option>
                            <?php
                                foreach($subcategory_code_list as $code){     
                            ?>
                                <option value="<?=$code["code_no"]?>" <?= $subcategory_code == $code["code_no"] ? "selected" : ""?>><?=$code["code_name"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    <?php
                        }
                    ?>
                </div>
                <div class="input_search_box">
                    <input type="text" name="search_txt" id="search_txt" value="<?= $search_txt ?>">
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
            <?php
                foreach($local_guide_list["items"] as $local_guide){
                    if ($local_guide["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $local_guide["ufile1"])) {
                        $img = "/data/product/" . $local_guide["ufile1"];
                    } else {
                        $img = "/data/product/noimg.png";
                    }
            ?>
                <a href="/travel-tips/view_detail?lg_idx=<?=$local_guide["idx"]?>" class="item_box">
                    <div class="img">
                        <img src="<?=$img?>" alt="<?=$local_guide["rfile1"]?>">
                        <div class="text">
                            <span><?=viewSQ($local_guide["category_code_name"])?> </span>
                            <img src="/img/sub/arr-right-01.png" alt="">
                            <span> <?=viewSQ($local_guide["subcategory_code_name"])?></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="title">
                            <span><?=viewSQ($local_guide["city_code_name"])?> </span>
                            <img src="/img/sub/arr-right-01.png" alt="">
                            <span> <?=viewSQ($local_guide["town_code_name"])?></span>
                        </div>
                        <p class="name"><?=viewSQ($local_guide["product_name"])?></p>
                        <div class="vote">
                            <p class="star">
                                <img src="/img/sub/star-ic-13.png" alt="">
                                4.0
                            </p>
                            <span>이용자 리뷰 <i>(0)</i></span>
                        </div>
                    </div>
                </a>
            <?php } ?>
            <!-- <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a>
            <a href="/travel-tips/view_detail" class="item_box">
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
            </a> -->
        </div>
        <?php 
            echo ipagelistingSub($local_guide_list["pg"], $local_guide_list["nPage"], $local_guide_list["g_list_rows"], current_url() . "?city_code=". $city_code ."&category_code=". $category_code ."&town_code=". $town_code ."&subcategory_code=". $subcategory_code ."&search_txt=". $search_txt ."&pg=")
        ?>
    </div>
    <script>
        $(document).ready(function () {
            $('.icon_open_depth_').on('click', function (e) {
                e.stopPropagation();
                let depth = $(this).data("depth");
                $('#' + depth).toggleClass('active_');
            });

            $('.depth_1_item_').on('click', function () {
                let code = $(this).data("code");
                let href = $(this).data("href");
                let name = $(this).text();

                $('#depth_1_tool_title_').text(name);
                $('#path_1').text(name);

                $('.depth_1_item_').removeClass('active_');
                $(this).addClass('active_');
                $('#depth_1_tools_').removeClass('active_');

                window.location.href = href;
            });

            $(document).on('click', function (event) {
                const targets = ['#depth_1_tools_', '#depth_2_tools_', '#depth_3_tools_'];
                const triggers = ['.icon_open_depth_01', '.icon_open_depth_02', '.icon_open_depth_03'];

                targets.forEach((id, idx) => {
                    const $target = $(id);
                    const $trigger = $(triggers[idx]);

                    if (!$(event.target).closest(id).length && !$(event.target).closest(triggers[idx]).length) {
                        $target.removeClass('active_');
                    }
                });
            });

            $(document).on('click', '.depth_2_item_', function (e) {
                e.stopPropagation();
                let code = $(this).data("code");
                let name = $(this).text();

                $('#path_2').text(name);

                $('.depth_2_item_').removeClass('active_');
                $(this).addClass('active_');
                
            });
        });
    </script>
    <script>
        // $(document).ready(function() {
        //     $('.list_tab_head .tab').click(function() {
        //         $('.list_tab_head .tab').removeClass('on');
        //         $(this).addClass('on');
        //     });
        // });
    </script>

    <?php $this->endSection(); ?>