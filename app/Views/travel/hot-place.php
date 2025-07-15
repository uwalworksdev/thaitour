<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<div class="container hot_place">
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
                <span class="font-bold">핫 플레이스 </span>
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
                                <a href="/travel-tips/theme_travel?lp_idx=<?=$lp_idx?>&city_code=<?=$code["code_no"]?>" class=""><?=$code["code_name"]?></a>
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

        <div class="sec_banner">
            <div class="inner">
                <div class="wrap_banner">
                    <img class="only_web" src="/img/sub/hot-place-banner.png" alt="">
                    <img class="only_mo" src="/img/sub/hot-place-banner-m.jpg" alt="">
                    <div class="text_banner">
                        <span>태국 로컬시장 완벽 탐구!</span>
                        <p>전통시장부터 야시장까지~</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="input_search_box">
            <input type="text">
            <img class="only_web" src="/img/sub/search-ic-01.png" alt="search-ic">
            <img class="only_mo" src="/img/sub/search-ic-35.jpg" alt="search-ic">
        </div>
        <div class="list_place">
            <?php
                foreach($local_guide_list["items"] as $local_guide){
                    if ($local_guide["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $local_guide["ufile1"])) {
                        $img = "/data/product/" . $local_guide["ufile1"];
                    } else {
                        $img = "/data/product/noimg.png";
                    }
            ?>
            <a href="/travel-tips/view_detail" class="item">
                <div class="img">
                    <img src="<?=$img?>" alt="<?=$local_guide["rfile1"]?>">
                </div>
                <div class="text">
                    <div class="title">
                        <span><?=viewSQ($local_guide["city_code_name"])?> <img src="/img/sub/arr-right-01.png" alt=""> <?=viewSQ($local_guide["town_code_name"])?></span>
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                    </div>
                    <p class="name"><?=viewSQ($local_guide["product_name"])?></p>
                    <p class="desc"><?=viewSQ($local_guide["product_contents"])?></p>
                    <p class="comt"><i class="acc">꽇송이</i> 사람이 너무 많아서 공황 오는줄 꽇송이 사람이 너무 많아서 공황 오는줄</p>
                </div>
            </a>
            <?php
                }
            ?>
            <!-- <a href="/travel-tips/view_detail" class="item">
                <div class="img">
                    <img src="/img/sub/place1.png" alt="">
                </div>
                <div class="text">
                    <div class="title">
                        <span>방콕 <img src="/img/sub/arr-right-01.png" alt=""> 라차다</span>
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                    </div>
                    <p class="name">쩟페어 야시장</p>
                    <p class="desc">라차다 기찻길시장 2가 문을 닫은 후 새롭게 오픈 한 야시장
                        입니다. 깔끔하고 쾌적한 태국 야시장으로 거듭나서 현지인
                        뿐만 아니라 외국인에게도 아주 인기 많은 곳이에요.
                        거듭나서 현지인
                        뿐만 아니라 외국인에게도 아주 인기 많은 곳이에요.
                    </p>
                    <p class="comt"><i class="acc">꽇송이</i> 사람이 너무 많아서 공황 오는줄 꽇송이 사람이 너무 많아서 공황 오는줄</p>
                </div>
            </a>
            <a href="/travel-tips/view_detail" class="item">
                <div class="img">
                    <img src="/img/sub/place2.png" alt="">
                </div>
                <div class="text">
                    <div class="title">
                        <span>방콕 <img src="/img/sub/arr-right-01.png" alt=""> 라차다</span>
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                    </div>
                    <p class="name">더 원 라차다(구 딸랏롯파이2)</p>
                    <p class="desc">코로나 전까지 딸랏롯파이2로 유명했던 라차다의 야시장이에요.
                        코로나 이후, 깔끔하게 재단장 해서 재오픈 하였습니다. Jodd fair
                        야시장이 먼저 오픈을 하여 현재 가장 유명한 야시장이 되었지
                    </p>
                </div>
            </a>
            <a href="/travel-tips/view_detail" class="item">
                <div class="img">
                    <img src="/img/sub/place3.png" alt="">
                </div>
                <div class="text">
                    <div class="title">
                        <span>방콕 <img src="/img/sub/arr-right-01.png" alt=""> 라차다</span>
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                    </div>
                    <p class="name">짜뚜짝 주말시장</p>
                    <p class="desc">방콕 최대의 시장인 짜뚜짝 시장은 약 1.13 km²의 면적에 음식,
                        미술, 골동품, 패션 등 26 개 섹션, 약 1만 5천여 개의 상점이
                        입점해있습니다. 이곳은 하루 종일 둘러봐도 모자랄 정도로...
                    </p>
                    <p class="comt"><i class="acc">보물창고</i> 날씨가 엄청 덥긴했지만 한번쯤은 돌아다....</p>
                </div>
            </a>
            <a href="/travel-tips/view_detail" class="item">
                <div class="img">
                    <img src="/img/sub/place4.png" alt="">
                </div>
                <div class="text">
                    <div class="title">
                        <span>방콕 <img src="/img/sub/arr-right-01.png" alt=""> 라차다</span>
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                    </div>
                    <p class="name">쩟페어 야시장</p>
                    <p class="desc">라차다 기찻길시장 2가 문을 닫은 후 새롭게 오픈 한 야시장
                        입니다. 깔끔하고 쾌적한 태국 야시장으로 거듭나서 현지인
                        뿐만 아니라 외국인에게도 아주 인기 많은 곳이에요.
                    </p>
                    <p class="comt"><i class="acc">꽇송이</i> 사람이 너무 많아서 공황 오는줄 ㅜㅜ....</p>
                </div>
            </a>
            <a href="/travel-tips/view_detail" class="item">
                <div class="img">
                    <img src="/img/sub/place5.png" alt="">
                </div>
                <div class="text">
                    <div class="title">
                        <span>방콕 <img src="/img/sub/arr-right-01.png" alt=""> 라차다</span>
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                    </div>
                    <p class="name">쩟페어 야시장</p>
                    <p class="desc">라차다 기찻길시장 2가 문을 닫은 후 새롭게 오픈 한 야시장
                        입니다. 깔끔하고 쾌적한 태국 야시장으로 거듭나서 현지인
                        뿐만 아니라 외국인에게도 아주 인기 많은 곳이에요.
                    </p>
                    <p class="comt"><i class="acc">꽇송이</i> 사람이 너무 많아서 공황 오는줄 ㅜㅜ....</p>
                </div>
            </a>
            <a href="/travel-tips/view_detail" class="item">
                <div class="img">
                    <img src="/img/sub/place6.png" alt="">
                </div>
                <div class="text">
                    <div class="title">
                        <span>방콕 <img src="/img/sub/arr-right-01.png" alt=""> 라차다</span>
                        <p class="star">
                            <img src="/img/sub/star-ic-13.png" alt="">
                            4.0
                        </p>
                    </div>
                    <p class="name">쩟페어 야시장</p>
                    <p class="desc">라차다 기찻길시장 2가 문을 닫은 후 새롭게 오픈 한 야시장
                        입니다. 깔끔하고 쾌적한 태국 야시장으로 거듭나서 현지인
                        뿐만 아니라 외국인에게도 아주 인기 많은 곳이에요.
                    </p>
                    <p class="comt"><i class="acc">꽇송이</i> 사람이 너무 많아서 공황 오는줄 ㅜㅜ....</p>
                </div>
            </a> -->
            <?php 
                echo ipagelistingSub($local_guide_list["pg"], $local_guide_list["nPage"], $local_guide_list["g_list_rows"], current_url() . "?city_code=". $city_code ."&category_code=". $category_code ."&town_code=". $town_code ."&subcategory_code=". $subcategory_code ."&search_txt=". $search_txt ."&pg=")
            ?>
        </div>
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
    <?php $this->endSection(); ?>