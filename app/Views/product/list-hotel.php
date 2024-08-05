<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<div class="content-sub-product-hotel">
    <div class="body_inner">
        <div class="sub-hotel-navigation-container">
            <div class="navigation-container-prev">
                <img src="/uploads/icons/icon_home.png" alt="icon_home">
                <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                <span>호텔</span>
            </div>
            <div class="navigation-container-next">
                <img src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
                <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                <span>방콕</span>
            </div>
            <div class="navigation-container-next">
                <img src="/uploads/icons/ball_dot_icon.png" alt="ball_dot_icon">
            </div>
        </div>
        <div class="sub-hotel-container">
            <div class="category-left">
                <h1 class="title">방콕</h1>
                <div class="category-left-list">
                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>세부지역</span>
                            <img src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
                        </div>
                        <div class="tab_box_area_">
                            <ul class="tab_box_show_">
                                <li class="tab_box_element_ p--20 border tab_active_" rel="tab1">전체</li>
                                <li class="tab_box_element_ p--20 border " rel="tab2">스쿰빗(아속-프롬퐁)</li>
                                <li class="tab_box_element_ p--20 border " rel="tab3">짜오프라야강가</li>
                                <li class="tab_box_element_ p--20 border " rel="tab4">실롬/사톤</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">시암</li>
                                <li class="tab_box_element_ p--20 border " rel="tab6">스쿰빗(통로-에까미이)</li>
                                <li class="tab_box_element_ p--20 border " rel="tab7">랑수언/위타유</li>
                                <li class="tab_box_element_ p--20 border " rel="tab8">스쿰빗(나나-플런칫)</li>
                                <li class="tab_box_element_ p--20 border " rel="tab9">카오산/왕궁/차이나타운</li>
                                <li class="tab_box_element_ p--20 border " rel="tab10">라차다</li>
                                <li class="tab_box_element_ p--20 border " rel="tab11">수완나품 공항주변</li>
                                <li class="tab_box_element_ p--20 border " rel="tab12">람캄행</li>
                                <li class="tab_box_element_ p--20 border " rel="tab13">스쿰빛(프라카농-온눗)</li>
                                <li class="tab_box_element_ p--20 border " rel="tab14">논타부리</li>
                                <li class="tab_box_element_ p--20 border " rel="tab15">빠뚜남/펫부리</li>
                                <li class="tab_box_element_ p--20 border " rel="tab16">아눗싸와리-짜뚜짝</li>
                            </ul>
                        </div>
                    </div>
                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>호텔타입</span>
                            <img src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
                        </div>
                        <div class="tab_box_area_">
                            <ul class="tab_box_show_">
                                <li class="tab_box_element_ p--20 border tab_active_" rel="tab1">전체</li>
                                <li class="tab_box_element_ p--20 border " rel="tab2">호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab3">레지던스</li>
                                <li class="tab_box_element_ p--20 border " rel="tab4">리조트</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">풀빌라</li>
                            </ul>
                        </div>
                    </div>
                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>호텔등급</span>
                            <img src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
                        </div>
                        <div class="tab_box_area_">
                            <ul class="tab_box_show_">
                                <li class="tab_box_element_ p--20 border tab_active_" rel="tab1">전체</li>
                                <li class="tab_box_element_ p--20 border " rel="tab2">5성급</li>
                                <li class="tab_box_element_ p--20 border " rel="tab3">4성급</li>
                                <li class="tab_box_element_ p--20 border " rel="tab4">3성급</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">2성급</li>
                            </ul>
                        </div>
                    </div>
                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>1박 평균가격</span>
                            <img src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
                        </div>
                        <span><strong>원</strong class="text-primary"> · 바트</span>

                        <div class="slider-container">
                            <div class="slider-background"></div>
                            <div class="slider-track" id="slider-track"></div>
                            <input type="range" min="0" max="100" value="25" class="slider" id="slider-min">
                            <input type="range" min="0" max="100" value="75" class="slider" id="slider-max">
                        </div>
                        <span>10,000원 ~ 500,000원 이상</span>
                    </div>
                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>프로모션</span>
                            <img src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
                        </div>
                        <div class="tab_box_area_">
                            <ul class="tab_box_show_">
                                <li class="tab_box_element_ p--20 border " rel="tab1">무료숙박(1+1,2+1등)</li>
                                <li class="tab_box_element_ p--20 border " rel="tab2">특별패키지</li>
                                <li class="tab_box_element_ p--20 border " rel="tab3">룸업그레이드</li>
                                <li class="tab_box_element_ p--20 border " rel="tab4">공항픽업 무료</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">레이트 체크아웃 무료</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">얼리버드 할인</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">엑스트라베드 무료</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">아동 엑스트라베드 무료</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">아동조식 무료</li>
                            </ul>
                        </div>
                    </div>
                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>테마</span>
                            <img src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
                        </div>
                        <div class="tab_box_area_">
                            <ul class="tab_box_show_">
                                <li class="tab_box_element_ p--20 border " rel="tab1">체크인 후 24시간 이용 가능</li>
                                <li class="tab_box_element_ p--20 border " rel="tab2">인피니티 풀이 있는 호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab3">쇼핑몰과 연결 되어있는 호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab4">풀억세스룸이 있는 호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">워터 슬라이드가 있는 호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">루프탑바가 있는 호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">가성비 5성급 호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">BTS(지상철)과 연결된 호텔</li>
                                <li class="tab_box_element_ p--20 border " rel="tab5">펫프렌들리 호텔</li>
                            </ul>
                        </div>
                    </div>
                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>침실수</span>
                            <img src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
                        </div>
                        <div class="tab_box_area_">
                            <ul class="tab_box_show_">
                                <li class="tab_box_element_ p--20 border " rel="tab1">2 베드룸(성인 4~5인)</li>
                                <li class="tab_box_element_ p--20 border " rel="tab2">3 베드룸~(성인6인~)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <div class="form_element_">
                    <div class="date-container">
                        <label for="checkin" class="label">체크인/아웃</label>
                        <div class="date-sub-container">
                            <div class="date-wrapper">
                                <input type="text" id="checkin" name="checkin" class="date" value="2024/07/09">
                                <span class="suffix">(화)</span>
                            </div>
                            <span class="arrow">→</span>
                            <div class="date-wrapper">
                                <input type="text" id="checkout" name="checkout" class="date" value="2024/07/10">
                                <span class="suffix">(수)</span>
                            </div>
                        </div>
                    </div>
                    <div class="form_input_">
                        <input type="text" id="input_hotel" class="input_custom_" placeholder="호텔명(미입력시 전체)">
                    </div>
                    <button class="btn_search_">
                        검색
                    </button>
                </div>
                <div class="filter-container">
                    <div class="">
                        <div class="filter-content">
                            <img src="/uploads/icons/filter_icon.png" alt="filter_icon">
                            <span>필터</span>
                        </div>
                        <div class="list-tag">
                            <div class="tag-item">
                                <span>전체</span>
                                <img src="/uploads/icons/close_icon.png" alt="close_icon">
                            </div>
                            <div class="tag-item">
                                <span>오전</span>
                                <img src="/uploads/icons/close_icon.png" alt="close_icon">
                            </div>
                            <div class="tag-item">
                                <span>18홀</span>
                                <img src="/uploads/icons/close_icon.png" alt="close_icon">
                            </div>
                        </div>
                    </div>
                    <button>전체삭제</button>
                </div>
                <div class="below-filter-content">
                    <div class="total_number">
                        <p>총 상품 <span>70</span></p>
                    </div>
                    <div class="two-way-arrow-content">
                        <a href="#" class="">
                            <img src="/uploads/icons/2-way_arrow.png" alt="2-way_arrow">
                            <span class="text-primary">추천순</span>
                        </a>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_1.png" alt="sub_hotel_1">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>아난타라 시암 방콕 호텔</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span class="text-primary">생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>스쿰빛(야속-프로퐁)</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>그랜드 디럭스 스튜디오 - 트윈침대</h2>
                                <p>침대: 더블침대 1개 또는 싱글침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <span>연박 프로모션</span> "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">236,100</span>원 ~ <span
                                        class="sub">6,000바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_2.png" alt="sub_hotel_2">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>아난타라 시암 방콕 호텔</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>시암</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>트윈룸 : 도시전망</h2>
                                <p>싱글침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <span>연박 프로모션</span> "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_3.png" alt="sub_hotel_3">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>두앙따완 호텔 치앙마이</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>시암</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>수페리어룸 : 마운틴뷰</h2>
                                <p>더블 침대 1개 또는 싱글 침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <p><span>연박 프로모션</span> "아동조식 무료 / 아동 엑스트라베드 제공 (보장 / 2박 이상시 무료 바우처
                                    <p class="item-pd">"2박 이상시 아동조식 무료 / 2박 이상시 아동 엑스트라베드 제공 (가능 여...</p>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_4.png" alt="sub_hotel_4">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>애스콧 엠바시 사톤</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>시암</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>수페리어룸 : 마운틴뷰</h2>
                                <p>더블 침대 1개 또는 싱글 침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <span>연박 프로모션</span> "2박 이상시 레이트 체크아웃 (보장) / 18시 / 단독 프로모션"
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_5.png" alt="sub_hotel_5">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>더 살릴 호텔 리버사이드 방콕</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>짜오프라야강가</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>수페리어 트윈룸</h2>
                                <p>침대: 더블침대 1개 또는 싱글침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <span>연박 프로모션</span> "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">236,100</span>원 ~ <span
                                        class="sub">6,000바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_6.png" alt="sub_hotel_6">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>킴튼 말라이 방콕</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>랑수언/위타유</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>트윈룸 : 도시전망</h2>
                                <p>싱글침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <span>연박 프로모션</span> "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_7.png" alt="sub_hotel_7">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>힐튼 방콕 그랑데 아속 (구-풀만 방콕 그랑데 스쿰빗)</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>스쿰빗(아속-프롬퐁)</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>수페리어룸 : 마운틴뷰</h2>
                                <p>더블 침대 1개 또는 싱글 침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <p><span>연박 프로모션</span> "아동조식 무료 / 아동 엑스트라베드 제공 (보장 / 2박 이상시 무료 바우처
                                    <p class="item-pd">"2박 이상시 아동조식 무료 / 2박 이상시 아동 엑스트라베드 제공 (가능 여...</p>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_8.png" alt="sub_hotel_8">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>신돈 켐핀스키 호텔 방콕</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>랑수언/위타유</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>수페리어룸 : 마운틴뷰</h2>
                                <p>더블 침대 1개 또는 싱글 침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <span>연박 프로모션</span> "3박 이상시 룸 업그레이드 (가능 여부에 따라)"
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_9.png" alt="sub_hotel_8">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>하얏트 리젠시 방콕 스쿰빗</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>스쿰빗(나나-플런칫)</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>수페리어룸 : 마운틴뷰</h2>
                                <p>더블 침대 1개 또는 싱글 침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <p><span>연박 프로모션</span> "아동조식 무료 / 아동 엑스트라베드 제공 (보장 / 2박 이상시 무료 바우처
                                    <p class="item-pd">"2박 이상시 아동조식 무료 / 2박 이상시 아동 엑스트라베드 제공 (가능 여...</p>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-card-item-container">
                    <div class="product-card-item-left">
                        <a href="/product-hotel/hotel-detail/1324">
                            <img src="/uploads/sub/sub_hotel_10.png" alt="sub_hotel_8">
                        </a>
                    </div>
                    <div class="product-card-item-right">
                        <div class="title-container">
                            <a href="/product-hotel/hotel-detail/1324">
                                <h2>비 호텔 방콕 엠 갤러리</h2>
                            </a>
                            <div class="star-container">
                                <div class="">
                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                    <span>4.7</span>
                                </div>
                                <div class="star-content">
                                    <span>생생리뷰 <strong>(0)</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="sub-title">
                            <span>방콕</span>
                            <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                            <span>빠뚜남/펫부리</span>
                        </div>
                        <div class="list-item-info">
                            <div class="item-info">
                                <h2>추천 포인트</h2>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ p--20 border" rel="tab1">조식</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab2">피트니스 센터</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab3">주차</li>
                                        <li class="tab_box_element_ p--20 border" rel="tab4">무료 WI-FI</li>
                                </div>
                            </div>
                            <div class="item-info">
                                <h2>수페리어룸 : 마운틴뷰</h2>
                                <p>더블 침대 1개 또는 싱글 침대 2개</p>
                            </div>
                            <div class="item-info">
                                <h2>프로모션</h2>
                                <div class="item-info-label">
                                    <span>연박 프로모션</span> 2박 이상시 레이트 체크아웃 (보장) / 18시 / 단독 프로모션"
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="item-price-info"><span class="main">253,248</span>원 ~ <span
                                        class="sub">6,400바트~</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination">
                    <a href="#" class="page-link">≪</a>
                    <a href="#" class="page-link" style="margin-right: 24px;">
                        <
                            <a href="#" class="page-link active">1</a>
                            <a href="#" class="page-link">2</a>
                            <a href="#" class="page-link">3</a>
                            <a href="#" class="page-link" style="margin-left: 24px;">></a>
                            <a href="#" class="page-link">≫</a>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('/');
        }

        // Thiết lập datetimepicker cho các input
        $("#checkin, #checkout").datepicker({
            dateFormat: 'yy/mm/dd',
            onSelect: function(dateText, inst) {
                var date = $(this).datepicker('getDate');
                $(this).val(formatDate(date));
            }
        });

        // Đặt giá trị ban đầu cho các input
        $('#checkin').val(formatDate('2024/07/09'));
        $('#checkout').val(formatDate('2024/07/10'));
        console.log("TEST");
    });


    const sliderMin = document.getElementById('slider-min');
    const sliderMax = document.getElementById('slider-max');
    const sliderTrack = document.getElementById('slider-track');

    function updateSliderTrack() {
        const min = parseFloat(sliderMin.value);
        const max = parseFloat(sliderMax.value);

        if (min > max) {
            [sliderMin.value, sliderMax.value] = [sliderMax.value, sliderMin.value];
        }

        const percentMin = (sliderMin.value - sliderMin.min) / (sliderMin.max - sliderMin.min) * 100;
        const percentMax = (sliderMax.value - sliderMax.min) / (sliderMax.max - sliderMax.min) * 100;

        sliderTrack.style.left = percentMin + '%';
        sliderTrack.style.width = (percentMax - percentMin) + '%';
    }

    sliderMin.addEventListener('input', updateSliderTrack);
    sliderMax.addEventListener('input', updateSliderTrack);

    window.addEventListener('DOMContentLoaded', updateSliderTrack);
    </script>

    <?php $this->endSection(); ?>