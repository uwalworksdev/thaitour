<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

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
            <div class="tab on">전체</div>
            <div class="tab">호텔</div>
            <div class="tab">골프</div>
            <div class="tab">투어</div>
        </div>

        <div class="head_list_product">
            <p class="total_text">총 상품 <span>10</span></p>
            <select name="" id="">
                <option value="">제목</option>
                <option value="">제목1</option>
                <option value="">제목2</option>
                <option value="">제목3</option>
            </select>
            <div class="input_search_box">
                <input type="text">
                <img src="/img/sub/search-ic-01.png" alt="search-ic">
            </div>
        </div>

        <div class="list_infographic">
            <div class="item">
                <img src="/img/sub/grap1.png" alt="">
                <p>2025 태국 공휴일 안내</p>
            </div>
            <div class="item">
                <img src="/img/sub/grap2.png" alt="">
                <p>차종별 좌석 배치와 짐 적재 </p>
            </div>
            <div class="item">
                <img src="/img/sub/grap3.png" alt="">
                <p>2025년 연휴 연차팁</p>
            </div>
            <div class="item">
                <img src="/img/sub/grap4.png" alt="">
                <p>태국의 술은 어떤 것이 있을까요? </p>
            </div>
            <div class="item">
                <img src="/img/sub/grap5.png" alt="">
                <p>태국어와 함께 하는 상황 별 태국...</p>
            </div>
            <div class="item">
                <img src="/img/sub/grap6.png" alt="">
                <p>한국어 통역이 가능한 병원 </p>
            </div>
            <div class="item">
                <img src="/img/sub/grap7.png" alt="">
                <p>태국어와 함께 하는 상황 별 태국 표현 ...</p>
            </div>
            <div class="item">
                <img src="/img/sub/grap8.png" alt="">
                <p>태국의 술은 어떤 것이 있을까요? </p>
            </div>
        </div>
        <div class="custom pagination">
            <a class="page-link" href="javascript:;" title="Go to first page">
                <img src="/images/community/pagination_prev.png" alt="pagination_prev">
            </a>
            <a class="page-link" style="margin-right: 20px;" href="javascript:;" title="Go to previous page">
                <img src="/images/community/pagination_prev_s.png" alt="pagination_prev">
            </a>
            <a class="page-link active" href="javascript:;" title="Go to page 1">
                <strong>1</strong>
            </a>
            <a class="page-link" href="javascript:;" title="Go to page 2">
                <strong>2</strong>
            </a>
            <a class="page-link" href="javascript:;" title="Go to page 3">
                <strong>3</strong>
            </a>
            <a class="page-link" style="margin-left: 20px;" href="javascript:;" title="Go to next page">
                <img src="/images/community/pagination_next_s.png" alt="pagination_next">
            </a>
            <a class="page-link" href="javascript:;" title="Go to last page">
                <img src="/images/community/pagination_next.png" alt="pagination_next">
            </a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.list_tab_head .tab').click(function() {
                $('.list_tab_head .tab').removeClass('on');
                $(this).addClass('on');
            });
        });
    </script>

    <?php $this->endSection(); ?>