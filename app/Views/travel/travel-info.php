<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<div class="container travel_info">
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
                <span class="font-bold">여행정보</span>

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
        <h2>여행정보</h2>
        <div class="list_tab_head">
            <div class="tab on"><a href="">전체</a></div>
            <?php
                foreach($code_list as $code){
            ?>
                <div class="tab"><a href=""><?=$code["code_name"]?></a></div>
            <?php } ?>
        </div>

        <div class="head_list_product">
            <p class="total_text">총 상품 <span><?=$nTotalCount?></span></p>
            <select name="search_mode" id="search_mode">
                <option value="subject">제목</option>
                <option value="contents">내용</option>
                <option value="writer">작성자</option>
            </select>
            <div class="input_search_box">
                <input type="text" name="search_word" id="search_word">
                <img src="/img/sub/search-ic-01.png" alt="search-ic">
            </div>
        </div>

        <div class="list_product">
            <div class="item">
                <div class="img">
                    <img src="/img/sub/info1.png" alt="">
                </div>
                <div class="text">
                    <span class="tit">기타 정보</span>
                    <p class="name">[태국/쇼핑] 300원짜리 볶음면? 한국인들이 안 사서 정리한 찐 현지인 추천 태국 쇼핑리스트</p>
                    <div class="desc">
                        <div class="desc_inner">
                            안녕하세요, 몽키트래블입니다 🐵 혹시 아직도 태국 여행 다녀오실 때 건망고, 과일비누 같은 유명템만 사오시나요~? 물론 오랫동안
                            사랑받아온 기념품도 좋지만 색다르고 재미있는 것들을 찾고 계신다면 꼭 끝까지 봐주세요. 몽키트래블 방콕 사무실 직원들이 말아주는
                            찐 현지인 추천 태국 쇼핑리스트! - 🔽 현지인 태국 기념품 추천 영상 자세히보기 🔽 상...
                        </div>
                    </div>
                    <div class="info">
                        <span class="date">2025-01-08(수)</span>
                        <span class="author">더투어랩-스마일</span>
                        <span class="view">조회수 39</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img">
                    <img src="/img/sub/info2.png" alt="">
                </div>
                <div class="text">
                    <span class="tit">기타 정보</span>
                    <p class="name">[태국/정보] 2025년 연휴달력, 여행가기 좋은 날은 언제? 한국/태국 공휴일 총 정리!</p>
                    <div class="desc">
                        <div class="desc_inner">
                            안녕하세요, 몽키트래블입니다 🐵 2025년 역대급 황금연휴 소식에 벌써부터 두근두근 설레는데요. 내년 태국여행을 계획하는
                            분들을 위해 2025년 한국/태국 공휴일과 함께 태국 축제 일정, 왕궁 휴관일, 주류 판매 금지일 등 여행 꿀팁을 한눈에 정리했습니다
                            🗓️ 긴 연휴를 활용해 특별한 태국 여행을 떠나고 싶다면 꼭 참고해주세요~ ※ 왕궁 휴관일정은 변동 안녕하세요, 몽키트래블입니다 🐵 2025년 역대급 황금연휴 소식에 벌써부터 두근두근 설레는데요. 내년 태국여행을 계획하는
                            분들을 위해 2025년 한국/태국 공휴일과 함께 태국 축제 일정, 왕궁 휴관일, 주류 판매 금지일 등 여행 꿀팁을 한눈에 정리했습니다
                            🗓️ 긴 연휴를 활용해 특별한 태국 여행을 떠나고 싶다면 꼭 참고해주세요~ ※ 왕궁 휴관일정은 변동...
                        </div>
                    </div>
                    <div class="info">
                        <span class="date">2025-01-08(수)</span>
                        <span class="author">더투어랩-스마일</span>
                        <span class="view">조회수 39</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img">
                    <img src="/img/sub/info3.png" alt="">
                </div>
                <div class="text">
                    <span class="tit">기타 정보</span>
                    <p class="name">[차량정보] 몽키트래블 렌탈차량에는 짐을 몇개나 실을 수 있을까요?</p>
                    <div class="desc">
                        <div class="desc_inner">
                            안녕하세요. 몽키-윤랑 입니다!몽키트래블에서는 다양한 차량 렌탈 상품을 판매하고 있는데요, 오늘은 각 차량 트렁크에 짐을
                            얼마나 실을 수 있는지 소개해 드릴려고 해요!실험을 위해 몽키 직원분들이 직접 캐리어와 골프백을 가져오는 수고를 해주었답니다.
                            짝짝!승용차, SUV, 승합차, 알파드 차량 사진과 함께 간단히 설명 드릴게요.승용차 승용차 종류는 대...
                        </div>
                    </div>
                    <div class="info">
                        <span class="date">2025-01-08(수)</span>
                        <span class="author">더투어랩-스마일</span>
                        <span class="view">조회수 39</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img">
                    <img src="/img/sub/info4.png" alt="">
                </div>
                <div class="text">
                    <span class="tit">기타 정보</span>
                    <p class="name">[태국/쇼핑] 300원짜리 볶음면? 한국인들이 안 사서 정리한 찐 현지인 추천 태국 쇼핑리스트</p>
                    <div class="desc">
                       <div class="desc_inner">
                            타일랜드 플러스(ThailandPlus) 모바일 어플리케이션 설치안내 한국의 자가격리 앱과 같이 태국정부도 관광객의 위치 등을
                            파악하는 용도로 타일랜드플러스 (ThailandPlus) 라는 앱을 활용하고 있습니다.태국 도착 후에 설치할수도 있으나 현지 인터넷
                            사정 또는 데이터 로밍 등을 고려하여 미리 설치해 두시면 더욱 더 빠르게 입국 절차를 마치실 수...
                       </div>
                    </div>
                    <div class="info">
                        <span class="date">2025-01-08(수)</span>
                        <span class="author">더투어랩-스마일</span>
                        <span class="view">조회수 39</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img">
                    <img src="/img/sub/info5.png" alt="">
                </div>
                <div class="text">
                    <span class="tit">기타 정보</span>
                    <p class="name">[태국/쇼핑] 300원짜리 볶음면? 한국인들이 안 사서 정리한 찐 현지인 추천 태국 쇼핑리스트</p>
                    <div class="desc">
                       <div class="desc_inner">
                            안녕하세요, 몽키트래블입니다 🐵 혹시 아직도 태국 여행 다녀오실 때 건망고, 과일비누 같은 유명템만 사오시나요~? 물론 오랫동안
                            사랑받아온 기념품도 좋지만 색다르고 재미있는 것들을 찾고 계신다면 꼭 끝까지 봐주세요. 몽키트래블 방콕 사무실 직원들이 말아주는
                            찐 현지인 추천 태국 쇼핑리스트! - 🔽 현지인 태국 기념품 추천 영상 자세히보기 🔽 상...
                       </div>
                    </div>
                    <div class="info">
                        <span class="date">2025-01-08(수)</span>
                        <span class="author">더투어랩-스마일</span>
                        <span class="view">조회수 39</span>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?category=". $category ."&search_mode=". $search_mode ."&search_word=". $search_word ."&pg=")
        ?>
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