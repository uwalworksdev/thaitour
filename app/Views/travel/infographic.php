<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<link rel="stylesheet" href="/css/magazines/magazines.css">

<div class="container travel_info infographic">
    <div class="inner">
        <div class="sub-hotel-navigation-container">
            <div class="navigation-container-prev">
                <img class="icon_home" src="/uploads/icons/icon_home.png" alt="icon_home">
                <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
                <span id="depth_1_tool_title_">여행꿀팁</span>

                <!-- <div class="depth_1_tools_" id="depth_1_tools_">
                    <ul class="depth_1_tool_list_" id="depth_1_tool_list_">
                        <li class="depth_1_item_ " data-code="1303" data-href="/product-hotel/list-hotel?s_code_no=130301">
                            <p class="">호텔</p>
                        </li>
                        <li class="depth_1_item_ " data-code="1302" data-href="/product-golf/list-golf/130201">
                            <p class="">골프</p>
                        </li>
                        <li class="depth_1_item_ active_" data-code="1301" data-href="/product-tours/tours-list/130101">
                            <p class="">투어</p>
                        </li>
                    </ul>
                </div> -->
            </div>
            <div class="navigation-container-next">
                <img class="ball_dot_icon icon_open_depth_01 icon_open_depth_" data-depth="depth_1_tools_" src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
                <img class="bread_arrow_right" src="/uploads/icons/bread_arrow_right.png" alt="bread_arrow_right">
                <span class="font-bold">인포그래픽</span>

                <!-- <div class="depth_2_tools_ active_" id="depth_2_tools_">
                    <ul class="depth_2_tool_list_" id="depth_2_tool_list_">
                        <li class="depth_2_item_ " data-code="130101"><a href="/product-tours/tours-list/130101" class="">방콕 </a></li>
                        <li class="depth_2_item_ " data-code="130102"><a href="/product-tours/tours-list/130102" class="">파타야 </a></li>
                        <li class="depth_2_item_ " data-code="130103"><a href="/product-tours/tours-list/130103" class="">푸켓 </a></li>
                        <li class="depth_2_item_ active_" data-code="130104"><a href="/product-tours/tours-list/130104" class="">치앙마이 </a></li>
                        <li class="depth_2_item_ " data-code="130105"><a href="/product-tours/tours-list/130105" class="">끄라비 </a></li>
                        <li class="depth_2_item_ " data-code="130106"><a href="/product-tours/tours-list/130106" class="">카오락 </a></li>
                        <li class="depth_2_item_ " data-code="130107"><a href="/product-tours/tours-list/130107" class="">후아힌</a></li>
                        <li class="depth_2_item_ " data-code="130108"><a href="/product-tours/tours-list/130108" class="">칸차나부리</a></li>
                        <li class="depth_2_item_ " data-code="130109"><a href="/product-tours/tours-list/130109" class="">꼬창</a></li>
                        <li class="depth_2_item_ " data-code="130110"><a href="/product-tours/tours-list/130110" class="">아유타야</a></li>
                        <li class="depth_2_item_ " data-code="130111"><a href="/product-tours/tours-list/130111" class="">치앙라이</a></li>
                        <li class="depth_2_item_ " data-code="130112"><a href="/product-tours/tours-list/130112" class="">기타지역</a></li>
                        <li class="depth_2_item_ " data-code="130113"><a href="/product-tours/tours-list/130113" class="">투어 패키지</a></li>
                    </ul>
                </div> -->
            </div>
            <div class="navigation-container-next">
                <img class="ball_dot_icon icon_open_depth_02 icon_open_depth_" data-depth="depth_2_tools_" src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
            </div>
        </div>
        <h2>인포그래픽</h2>
        <div class="list_tab_head">
            <div class="tab <?php if(empty($category)){ echo "on"; }?>"><a href="<?=current_url()?>?search_mode=<?=$search_mode?>&search_word=<?=$search_word?>">전체</a></div>
            <?php
                foreach($code_list as $code){
            ?>
                <div class="tab <?php if($category == $code["code_idx"]){ echo "on"; }?>"><a href="<?=current_url()?>?category=<?=$code["code_idx"]?>&search_mode=<?=$search_mode?>&search_word=<?=$search_word?>"><?=$code["code_name"]?></a></div>
            <?php } ?>
        </div>

        <form action="" name="frmSearch" method="get">
            <div class="head_list_product">
                <p class="total_text">총 상품 <span><?=$nTotalCount?></span></p>
                <input type="hidden" name="category" value="<?= $category ?>">
                <select name="search_mode" id="search_mode">
                    <option value="subject" <?php if($search_mode == "subject"){ echo "selected"; }?>>제목</option>
                    <option value="contents" <?php if($search_mode == "contents"){ echo "selected"; }?>>내용</option>
                    <option value="writer" <?php if($search_mode == "writer"){ echo "selected"; }?>>작성자</option>
                </select>
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

        <div class="list_infographic">
            <?php
                foreach($rows as $row) {
                    if(!empty($row["ufile1"])){
                        $img_infographic = "/data/bbs/" . $row["ufile1"];
                    }
            ?>
                <div class="item">
                    <a href="/travel-tips/infographic/view?code=<?=$row["code"]?>&bbs_idx=<?=$row["bbs_idx"]?>">
                        <img src="<?=$img_infographic?>" alt="<?=$row["rfile1"]?>">
                        <p><?=$row["subject"]?></p>
                    </a>
                </div>
            <?php
                }
            ?>
        </div>
        <?php 
            echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?category=". $category ."&search_mode=". $search_mode ."&search_word=". $search_word ."&pg=")
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