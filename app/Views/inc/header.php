<?php
    $setting = homeSetInfo();

    $db = \Config\Database::connect();
    $m_idx = $_SESSION['member']['mIdx'];

    $count_alarm = 0;
    if($m_idx){
        $sql_alarm = "SELECT COUNT(*) AS total FROM tbl_alarm where m_idx = '$m_idx' and status = '0'";
        $query = $db->query($sql_alarm);
        $count_alarm = $query->getRow()->total;
    }
?>
<header id="header" class="only_web">
    <div class="inner flex_header_top">
        <div>
            <!-- <div class="custom-select-lang">
                <select id="language-select" style="width: 130px;">
                    <option value="kr">KR 한국어</option>
                    <option value="en">English</option>
                </select>
            </div> -->
            <div class="language_box">
                <div class="lang_selected show_dropdown">
                    <span>KOR</span>
                    <img src="/images/ico/down-arrow-select.png" alt="">
                </div>
                <ul class="dropdown">
                    <li class="lang_item">
                        KOR
                    </li>
                    <li class="lang_item">
                        ENG
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <ul class="flex_header_top">
               <li>
                 <?php if (session("member")): ?>
                    <p class="count_like"><strong style="color: #17469E"><?=$_SESSION['member']['name']?></strong>님 안녕하세요!</p>
                <?php endif?>
               </li>
                <li>
                    <?php if (session("member")): ?>
                        <a href="/member/logout" class="text-grey">로그아웃</a>
                    <?php else: ?>
                        <a href="/member/login" class="text-grey">로그인</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if (session("member")): ?>
                        <a href="/mypage/alarm" class="text-grey flex__c">알림<span class="count_like" style="color: red;">(<?=$count_alarm?>)</span></a>
                    <?php else: ?>
                        <a href="/member/join_choice" class="text-grey">회원가입</a>
                    <?php endif; ?>
                </li>
                <li><a href="/community/main" class="text-grey">고객센터</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <?php
    $tab_ = $tab_active ?? 8;
    switch ($tab_) {
        case 1:
            $tab_1 = 'on';
            break;
        case 2:
            $tab_2 = 'on';
            break;
        case 3:
            $tab_3 = 'on';
            break;
        case 4:
            $tab_4 = 'on';
            break;
        case 5:
            $tab_5 = 'on';
            break;
        case 6:
            $tab_6 = 'on';
            break;
        case 7:
            $tab_7 = 'on';
            break;
        case 8:
            $tab_8 = 'on';
            break;
        default:
            $tab_8 = 'on';
            $tab_active = 1;
            break;
    }

    $productModel = new \App\Models\ProductModel();

    // 검색어
    $searchTxtRecommend  = $productModel->getKeyWordAll();

    ?>
    <div id="header_tools">
        <div class="inner flex_header_top">
            <div class="flex_header_top spe_new">
                <a href="/"><img class="logo_img" src="/uploads/setting/<?= $setting['logos']?>" alt=""></a>
                <div class="search-container">
                    <div class="main-search-container" id="main-search-container">
                        <input type="text" class="search-input" id="search_input_pc__header" placeholder="검색어를 입력해 주세요"
                            autocomplete="off">
                        <i class="fa fa-search search-icon" id="search_icon_pc"></i>
                        <ul class="search_words_list" id="search_words_list_pc">
                            <!-- <?php foreach ($searchTxtRecommend as $item): ?>
                                <li><a href="/product_search?search_name=<?= $item ?>">#<?= $item ?></a></li>
                            <?php endforeach; ?> -->
                        </ul>
                    </div>
                    <div class="btn_show_select">
                        <button>상세검색</button>
                    </div>
                    <!-- <div class="custom_select_rounded"> -->
                        <!--                        <a class="text_custom_" href="#">상세검색</a>-->
                        <!-- <select class="select_custom_ active_" name="" id="search_cate_pc__header">
                            <option value="">전체</option>
                            <option value="hotel">호텔</option> -->
                            <!-- <option value="golf">골프</option> -->
                            <!-- <option value="tour">투어</option> -->
                            <!-- <option value="spa">스파</option> -->
                            <!-- <option value="show_ticket">쇼ㆍ입장권</option> -->
                            <!-- <option value="restaurant">레스토랑</option> -->
                            <!-- <option value="vehicle">차량</option> -->
                        <!-- </select> -->
                    <!-- </div> -->
                </div>
            </div>

            <div>
                <div class="icon-menu">
                    <a href="/mypage/reservation_list" class="icon-menu-item">
                        <img src="/images/ico/icon_calen.png" alt="">
                        <p style="margin-top:5px;">예약확인</p>
                    </a>
                    <!-- <a href="/magazines/list" class="icon-menu-item">
                        <img src="/images/ico/icon_note.png" alt="">
                        <p>매거진</p>
                    </a> -->

                    
                    <!-- <a href="<?= (session("member.idx") ? "/mypage/fav_list" : "#!") ?>" class="icon-menu-item">
                        <img src="/images/ico/icon_heart.png" alt="">
                        <p>찜</p>
                    </a> -->
                    <a href="/cart/item-list/123" class="icon-menu-item icon-menu-cart">
                        <img src="/images/ico/icon_cart.png" alt="">
                        <p style="margin-top:3px;">장바구니</p>
                        <span class="cart_count"><?=getCartCount();?></span>
                    </a>
					
					<?php if(session('member.id')) { ?>
                        <a href="#!" class="icon-menu-item icon_my_page">
                            <img src="/images/ico/icon_user_mypage_thin.png" alt="">
                            <p style="margin-top:3px;">마이페이지</p>
                            <ul class="list_item">
                                <li class="item_link" onclick="location.href='/mypage/alarm'">알림</li>
                                <li class="item_link" onclick="location.href='/mypage/reservation_list'">예약확인/결재</li>
                                <li class="item_link" onclick="location.href='/mypage/fav_list'">관심상품</li>
                                <li class="item_link" onclick="location.href='/contact/main'">일반문의</li>
                                <li class="item_link" onclick="location.href='/mypage/consultation'">1:1여행문의</li>
                                <li class="item_link" onclick="location.href='/mypage/discount'">쿠폰함</li>
                                <li class="item_link" onclick="location.href='/mypage/info_option'">내정보수정</li>
                            </ul>
                        </a>
					<?php } else { ?>
                        <a href="#!" class="icon-menu-item icon_my_page">
                            <img src="/images/ico/icon_user_mypage_thin.png" alt="">
                            <p style="margin-top:3px;">마이페이지</p>
                            <ul class="list_item">
                                <li class="item_link" onclick="location.href='/mypage/alarm'">알림</li>
                                <li class="item_link" onclick="location.href='/mypage/reservation_list'">예약확인/결제</li>
                                <li class="item_link" onclick="location.href='/mypage/fav_list'">관심상품</li>
                                <li class="item_link" onclick="location.href='/contact/main'">일반문의</li>
                                <li class="item_link" onclick="location.href='/mypage/consultation'">1:1여행문의</li>
                                <li class="item_link" onclick="location.href='/mypage/discount'">쿠폰함</li>
                                <li class="item_link" onclick="location.href='/mypage/info_option'">내정보수정</li>
                            </ul>
                        </a>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="">
            <div class="inner flex_header_top ">
                <div style="width: 100%;">
                    <ul class="flex_header_top flex_header_top_content_list">
                        <!--                    <li><a class="-->
                        <?php //echo isset($tab_1) ? 'active_' : '' 
                        ?><!--" href="/product-hotel/1324">호텔</a></li>-->
                        <!--                    <li><a class="-->
                        <?php //echo isset($tab_2) ? 'active_' : '' 
                        ?><!--" href="/product-golf/1325/1">골프</a></li>-->
                        <!--                    <li><a class="-->
                        <?php //echo isset($tab_3) ? 'active_' : '' 
                        ?><!--" href="/product-tours/1325/1">투어</a></li>-->
                        <!--                    <li><a class="-->
                        <?php //echo isset($tab_4) ? 'active_' : '' 
                        ?><!--" href="/product-spa/1320/1">스파</a></li>-->
                        <!--                    <li><a class="-->
                        <?php //echo isset($tab_5) ? 'active_' : '' 
                        ?><!--" href="/show-ticket">쇼ㆍ입장권</a></li>-->
                        <!--                    <li><a class="-->
                        <?php //echo isset($tab_6) ? 'active_' : '' 
                        ?><!--" href="/product-restaurant/1320/1">레스토랑</a></li>-->
                        <!--                    <li><a class="-->
                        <?php //echo isset($tab_7) ? 'active_' : '' 
                        ?><!--" href="/vehicle-guide">차량ㆍ가이드</a></li>-->
                        <?php echo getHeaderTab(); ?>
                        <li class="new"><a class="" data-key="micepage" href="/mice-page">인센티브</a></li>
                        <li class="new"><a class="" data-key="travel_insurance" target="_blank" href = "https://tourlab.toursafe.co.kr/main/main.php" class="link_top">여행자 보험</a></li>
                        <li class="">
                            <a class="" data-key="_community" href="/travel-tips" class="link_top">커뮤니티</a>
                            <div class="sub_nav_menu">
                                <a href="/review/review_list" class="sub_item">
                                    <p>여행후기 </p>
                                </a>
                                <a href="/event/event_list" class="sub_item">
                                    <p>이벤트</p>
                                </a><a href="/magazines/list" class="sub_item">
                                    <p>매거진</p>
                                </a><a href="/time_sale/list" class="sub_item">
                                    <p>타임세일</p>
                                </a><a href="/travel-tips" class="sub_item">
                                    <p>여행꿀팁 </p>
                                </a>
                                </a><a href="/coupon/list" class="sub_item">
                                    <p>여행 쿠폰 </p>
                                </a>
                                <a href="/promotion" class="sub_item">
                                    <p>프로모션</p>
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- <div>
                    <ul class="flex_header_top">
                        <li><a href="/travel_insurance" class="link_top">여행자 보험</a></li>
                        <li><a href="/event/event_list" class="link_top">이벤트</a></li>
                        <li><a href="/coupon/list" class="link_top">여행 쿠폰</a></li>
                        <li><a href="/community/customer_center/list_notify" class="link_top">태국뉴스</a></li>
                        <li><a href="/review/review_list" class="link_top">여행후기</a></li>
                    </ul>
                </div> -->

            </div>
            <!-- <div class="inner flex_header_top ">
                <div>
                    <ul class="flex_header_top flex_header_top_content_list">
                        <li><a class="<?php echo isset($tab_1) ? 'active_' : '' ?>" href="/product-hotel/1324">호텔</a></li>
                        <li><a class="<?php echo isset($tab_2) ? 'active_' : '' ?>" href="/product-golf/1325/1">골프</a></li>
                        <li><a class="<?php echo isset($tab_3) ? 'active_' : '' ?>" href="/product-restaurant/1324">투어</a></li>
                        <li><a class="<?php echo isset($tab_4) ? 'active_' : '' ?>" href="/product-spa/1320/1">스파</a></li>
                        <li><a class="<?php echo isset($tab_5) ? 'active_' : '' ?>" href="/show-ticket">쇼ㆍ입장권</a></li>
                        <li><a class="<?php echo isset($tab_6) ? 'active_' : '' ?>" href="/product-tours/1320/1">레스토랑</a></li>
                        <li><a class="<?php echo isset($tab_7) ? 'active_' : '' ?>" href="/vehicle-guide">차량ㆍ가이드</a></li>
                    </ul>
                </div>

                <button class="header_top_btn"></button>
            </div> -->
        </div>
    </div>

    <!-- popup_hotel_header -->
    <?php include "popup_wraper_header.php"?>
</header>
<div class="header_replace"></div>
<header id="header_mobile" class="only_mo inner_header_m">
    <div class="header_mobile__wrap">
        <div class="body_inner flex_header_top  pb-24">
            <div class="language_box">
                <div class="lang_selected show_dropdown">
                    <span>KOR</span>
                    <img src="/images/ico/down-arrow-select.png" alt="">
                </div>
                <ul class="dropdown">
                    <li class="lang_item">
                        KOR
                    </li>
                    <li class="lang_item">
                        ENG
                    </li>
                </ul>
            </div>
            <div class="header_logo_wrap flex__c">
                <!-- <?php
                    $userAgent = $_SERVER['HTTP_USER_AGENT'];
                    $uri = service('uri');
                    $path = $uri->getPath(); 
                    $path = trim($path, '/');
    
                    $mainPaths = ['', 'home', 'index', 'main'];
                    $isMobile = stripos($userAgent, 'iPhone') !== false || stripos($userAgent, 'Android') !== false;
                    if ($isMobile && !in_array($path, $mainPaths)) {
                ?>
                    <a href="javascript:history.back();">
                        <img class="header_logo_m header_logo_m_sub" src="<?= base_url('/assets/img/arrow_back.png') ?>" alt="">
                    </a>
                <?php
                    }
                ?> -->
                
                <a class="flex_header_top_item" href="/">
                    
                    <!-- <img class="header_logo_m" src="<?= base_url('/images/sub/logo_header_m.png') ?>" alt=""> -->
                    <img class="header_logo_m" src="/uploads/setting/<?= $setting['logos']?>" alt="">
                </a>
            </div>
            <div class="flex_header_top flex_header_top_item">
                <div class="burger icon-menu-cart" onclick="window.location.href='/cart/item-list/123'">
                    <img src="<?= base_url('/uploads/icons/icon-cart-m.png') ?>" alt="">
                    <span class="cart_count"><?=getCartCount();?></span>
                </div>
                <div class="burger" id="search-mobile">
                    <img src="<?= base_url('/uploads/icons/search-icon-m.png') ?>" alt="">
                </div>
                <!-- <div class="hamburger" id="hamburger">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div> -->
            </div>
        </div>
        <div class="menu_mobile" id="menu_mobile">
            <div class="body_inner">
                <ul class="menu_mobile__head">
                    <li>
                        <?php if (session("member")): ?>
                            <a href="/member/logout" class="text-grey">로그아웃</a>
                        <?php else: ?>
                            <a href="/member/login" class="text-grey">로그인</a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (session("member")): ?>
                            <a href="/mypage/alarm" class="text-grey flex__c">마이페이지<span class="count_like" style="color: red;">(0)</span></a>
                        <?php else: ?>
                            <a href="/member/join_choice" class="text-grey">회원가입</a>
                        <?php endif; ?>
                    </li>
                    <li><a href="/community/main" class="text-grey">고객센터</a></li>
                </ul>
                <ul class="menu_mobile__tools">
                    <li>

                        <a href="/event/event_list" class="text-grey">
                            <img style="width:4.6rem; height:3.9rem" src="/images/ico/ico_order_list.svg" alt="">
                            주문목록</a>
                    </li>
                    <li>
                        <a href="/event/event_list" class="text-grey">
                            <img style="width:3.6rem; height:4.4rem" src="/images/ico/ico_book_1.svg" alt="">
                            찜한상품</a>
                    </li>
                    <li>
                        <a href="/event/event_list" class="text-grey">
                            <img style="width:4.5rem; height:4.2rem" src="/images/ico/ico_heart_1.svg" alt="">
                            고객센터</a>
                    </li>
                    <li>
                        <a href="/event/event_list" class="text-grey">
                            <img style="width:4.8rem; height:4.3rem" src="/images/ico/ico_cart_1.svg" alt="">
                            상담문의</a>
                    </li>
                </ul>
                <ul class="menu_mobile__list">
                    <?php echo getHeaderTab(); ?>
                </ul>
            </div>
        </div>
        <div class="popup_search_mo" id="popup_search_mo">
            <div class="header_ps">
                <h3 class="title-ps">검색</h3>
                <img id="icon-close-ps" src="/uploads/icons/icon-close-ps.png" alt="icon-close-ps">
            </div>
            <div class="input-form-ps">
                <input type="text" class="search-input-m search-input-ps">
                <img src="<?= base_url('/uploads/icons/search-icon-m.png') ?>" alt="">
            </div>
            <div class="text-c-ps">
                <label for="인기검색어">인기검색어</label>
                <span>골프여행, </span><span>호캉스, </span><span>알뜰여행, </span><span>땡처리여행</span>
            </div>
            <section class="main_hot">
                <div class="body_inner">
                    <div class="main_hot__head">
                        <div class="main_hot__head__left">
                            <div class="main_hot__head_ttl">
                                지금 가장 많이 찾는 상품
                            </div>
                            <div class="main_hot__head__place only_web_flex">
                                <div class="place_item">방콕</div>
                                <div class="place_item">파타야</div>
                                <div class="place_item">푸켓</div>
                                <div class="place_item active">치앙마이</div>
                            </div>
                        </div>
                        <div class="main_hot__head__right">
                            <div class="hot_product_menu_swiper_pagination"></div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="hot_product_list hot_product_menu_swiper swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="hot_product_list__item">
                                        <div class="img_box img_box_2">
                                            <img src="/uploads/main/main_hot_5.png" alt="main">
                                        </div>
                                        <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                        <div class="prd_price_ko">236,100 <span>원</span></div>
                                        <div class="prd_price_thai">6,000 <span>원</span></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="hot_product_list__item">
                                        <div class="img_box img_box_2">
                                            <img src="/uploads/main/main_hot_6.png" alt="main">
                                        </div>
                                        <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                        <div class="prd_price_ko">236,100 <span>원</span></div>
                                        <div class="prd_price_thai">6,000 <span>원</span></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="hot_product_list__item">
                                        <div class="img_box img_box_2">
                                            <img src="/uploads/main/main_hot_7.png" alt="main">
                                        </div>
                                        <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                        <div class="prd_price_ko">236,100 <span>원</span></div>
                                        <div class="prd_price_thai">6,000 <span>원</span></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="hot_product_list__item">
                                        <div class="img_box img_box_2">
                                            <img src="/uploads/main/main_hot_8.png" alt="main">
                                        </div>
                                        <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                        <div class="prd_price_ko">236,100 <span>원</span></div>
                                        <div class="prd_price_thai">6,000 <span>원</span></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="hot_product_list__item">
                                        <div class="img_box img_box_2">
                                            <img src="/uploads/main/main_hot_6.png" alt="main">
                                        </div>
                                        <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                        <div class="prd_price_ko">236,100 <span>원</span></div>
                                        <div class="prd_price_thai">6,000 <span>원</span></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="hot_product_list__item">
                                        <div class="img_box img_box_2">
                                            <img src="/uploads/main/main_hot_7.png" alt="main">
                                        </div>
                                        <div class="prd_name">샹그릴라 호텔 방콕 (짜오프라야강가)</div>
                                        <div class="prd_price_ko">236,100 <span>원</span></div>
                                        <div class="prd_price_thai">6,000 <span>원</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-prev-main-2 swiper-button-main-2 hot_product_list_swiper_2_btn_prev">
                            <img src="/images/ico/ico_prev_slide.svg" alt="">
                        </div>
                        <div class="swiper-button-next-main-2 swiper-button-main-2 hot_product_list_swiper_2_btn_next">
                            <img src="/images/ico/ico_next_slide.svg" alt="">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="nav-container">
        <div class="scroll-con">
            <!-- <span class="nav-item"><a class="<?php echo isset($tab_8) ? 'active_' : '' ?>" href="/">홈</a></span> -->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_1) ? 'active_' : '' 
            ?><!--" href="/product-hotel/1324">호텔</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_2) ? 'active_' : '' 
            ?><!--" href="/product-golf/1325/1">골프</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_3) ? 'active_' : '' 
            ?><!--" href="/product-tours/1325/1">투어</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_4) ? 'active_' : '' 
            ?><!--" href="/product-spa/1320/1">스파</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_5) ? 'active_' : '' 
            ?><!--" href="/show-ticket">쇼ㆍ입장권</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_6) ? 'active_' : '' 
            ?><!--" href="/product-restaurant/1320/1">레스토랑</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_7) ? 'active_' : '' 
            ?><!--" href="/vehicle-guide/1324">차량ㆍ가이드</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_9) ? 'active_' : '' 
            ?><!--" href="/center/insurance">여행자 보험</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_10) ? 'active_' : '' 
            ?><!--" href="/event/event_list">이벤트</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_11) ? 'active_' : '' 
            ?><!--" href="/mypage/discount">여행 쿠폰</a></span>-->
            <!--            <span class="nav-item"><a class="-->
            <?php //echo isset($tab_12) ? 'active_' : '' 
            ?><!--" href="/community/main">태국뉴스</a></span>-->
            <?php echo getHeaderTabMobile(); ?>
            <span class=""><a href="/mice-page" >인센티브</a></span>
            <span class=""><a href="https://tourlab.toursafe.co.kr/main/main.php">여행자 보험</a></span>
            <span class=""><a href="/travel-tips">커뮤니티</a></span>
        </div>
    </div>
    <div class="search_m_header only_web">
        <div class="search-container-m">
            <input type="text" class="search-input-m" placeholder="검색어를 입력해 주세요">
            <img class="fa fa-search search-icon-m" src="/uploads/icons/icon-search-m.png" alt="">
        </div>
    </div>
    <div class="flex_header_mo_bot only_web">
        <div>
            <p class="font-26">상세검색</p>
        </div>
        <div>
            <select class="select_header_m on" name="" id="">
                <option value="">호텔</option>
            </select>
        </div>
        <div>
            <select class="select_header_m" name="" id="">
                <option value="">투어</option>
            </select>
        </div>
        <div class="select_header_m_no_arr">
            <button class="font-26">차량</button>
        </div>
    </div>
    <div class="flex_header_mo_bots mtb font-26 only_web">
        <a href="#">여행자 보험 </a>
        <a href="#">이벤트</a>
        <a href="#">여행 쿠폰</a>
        <a href="#">태국뉴스</a>
        <a href="#">여행후기</a>
    </div>
</header>
<div class="only_mo">
    <!-- <div class="quick-header-footer">
        <div class="nav-item nav-item-js">
            <img class="nav-pic" src="/images/ico/quick-header-footer_1.png" alt="quick-header-footer_1">
            <span class="nav-text text-grey">전체메뉴</span>
        </div>
        <div class="nav-item" onclick="location.href='/mypage/alarm'">
            <img class="nav-pic" src="/images/ico/quick-header-footer_2.png" alt="quick-header-footer_2">
            <span class="nav-text text-grey flex__c">마이페이지<i class="count_like" style="color: red;">(0)</i></span>
        </div>
        <div class="nav-item">
            <div class="nav-con-cus" onclick="ChannelIO('show');">
                <img src="/uploads/setting/<?= $setting['logos_consult']?>" alt="quick-header-footer_3">
            </div>
            <span class="nav-text text-grey">실시간문의</span>
        </div>
        <div class="nav-item" onclick="location.href='/mypage/reservation_list'">
            <img class="nav-pic" src="/images/ico/quick-header-footer_4.png" alt="quick-header-footer_4">
            <span class="nav-text text-grey">예약확인</span>
        </div>
        <div class="nav-item" onclick="location.href='/mypage/fav_list'">
            <img class="nav-pic" src="/images/ico/quick-header-footer_5.png" alt="quick-header-footer_5">
            <span class="nav-text text-grey">찜</span>
        </div>
    </div> -->
    <?php
        if(strpos(current_url(), '/product-hotel/hotel-detail') !== false 
            || strpos(current_url(), '/product-golf/golf-detail') !== false
            || strpos(current_url(), '/product-tours/item_view') !== false
            || strpos(current_url(), '/product-spa/spa-details') !== false
            || strpos(current_url(), '/vehicle-guide') !== false
            || strpos(current_url(), '/guide_view') !== false) {
    ?>
        <div class="quick-header-order">
            <img src="/assets/img/qna_logo.png" alt="">  
            <button class="btn btn-cart">장바구니</button>
            <button class="btn btn-order">예약하기</button>            
        </div>
    <?php
        }
    ?>
    <div class="quick-header-footer">
        <div class="nav-item nav-item-js">
            <img class="nav-pic" src="/images/ico/quick-header-footer_1.png" alt="quick-header-footer_1">
            <!-- <span class="nav-text text-grey">전체메뉴</span> -->
        </div>
        <div class="nav-item" onclick="location.href='/'">
            <img class="nav-pic" src="/images/ico/home.png" alt="quick-header-footer_2">
            <span class="nav-text text-grey flex__c">홈</span>
        </div>
        <div class="nav-item" onclick="location.href='/mypage/reservation_list'">
            <img class="nav-pic" src="/images/ico/quick-header-footer_4.png" alt="quick-header-footer_2">
            <span class="nav-text text-grey flex__c">예약확인/결제</span>
        </div>
        <div class="nav-item" onclick="location.href='/member/login'">
            <img class="nav-pic" src="/images/ico/quick-header-footer_2.png" alt="quick-header-footer_2">
            <span class="nav-text text-grey flex__c">로그인</span>
        </div>
        <div class="nav-item" onclick="location.href='/travel-tips'">
            <img class="nav-pic" src="/images/ico/customer-center.png" alt="quick-header-footer_5">
            <span class="nav-text text-grey">고객센터</span>
        </div>
        <div class="icon-wrap-social">
            <div class="info_chat">
                <a class="btn_close" href="javascript:;">close</a>
                <div class="msg">태국여행,<br><em>무엇이든 물어보세요!!</em></div>
            </div>
            <div class="robot-container" onclick="ChannelIO('show');">
                <img src="/uploads/setting/<?= $setting['logos_consult'] ?>" alt="Chat now">
            </div>
             <?php
                    $userAgent = $_SERVER['HTTP_USER_AGENT'];
                    $uri = service('uri');
                    $path = $uri->getPath(); 
                    $path = trim($path, '/');
    
                    $mainPaths = ['', 'home', 'index', 'main'];
                    $isMobile = stripos($userAgent, 'iPhone') !== false || stripos($userAgent, 'Android') !== false;
                    if ($isMobile && !in_array($path, $mainPaths)) {
                ?>
                    <a class="back_btn" href="javascript:history.back();">
                        <img class="header_logo_m header_logo_m_sub" src="<?= base_url('/assets/img/arrow_back.png') ?>" alt="">
                    </a>
                <?php
                    }
                ?>
        </div>
    </div>
    <nav id="mobile_menu" style="display: none;">
        <div class="scroll-menu-mo">
            <ul class="m_my">
                <?php if (session("member")): ?>
                    <li>
                        <a href="/member/logout" class="text-grey">로그아웃</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/member/login" class="text-grey">로그인</a>
                    </li>
                <?php endif; ?>

                <?php if (session("member")): ?>
                    <li>
                        <a href="/mypage/alarm" class="text-grey flex__c">마이페이지<span class="count_like" style="color: red;">(0)</span></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/member/join_choice" class="text-grey">회원가입</a>
                    </li>
                <?php endif; ?>
                <li class="">
                    <a href="/community/main" class="hd_link03">고객센터</a>
                </li>
            </ul>


            <!-- list menu_mobi -->
            <ul class="gnb_menu">
                <?php echo getHeaderTabMo(); ?>
                <li class="gnb_menu_item">
                    <div class="menu_level_1 flex_b_c">
                        <div class="menu_flex flex">
                            <i></i>
                            <a href="/mice-page">인센티브</a>
                        </div>
                    </div>
                </li>
                <li class="gnb_menu_item">
                    <div class="menu_level_1 flex_b_c">
                        <div class="menu_flex flex">
                            <i></i>
                            <a href="https://tourlab.toursafe.co.kr/main/main.php" target="_blank">여행자 보험</a>
                        </div>
                    </div>
                </li>
                <li class="gnb_menu_item">
                    <div class="menu_level_1 flex_b_c">
                        <div class="menu_flex flex">
                            <i></i>
                            <a href="/travel-tips">커뮤니티</a>
                        </div>
                        <img src="/images/ico/gnb_select_ico_m.png" alt="" class="btn_toggle">
                    </div>
                    <div class="menu_level_2 flex_b_c">
                        <a href="/review/review_list"><p>여행후기 </p></a>
                        <a href="/event/event_list"><p>이벤트</p></a>
                        <a href="/magazines/list"><p>매거진</p></a>
                        <a href="/time_sale/list"><p>타임세일</p></a>
                        <a href="/travel-tips"><p>여행꿀팁 </p></a>
                        <a href="/coupon/list"><p>여행 쿠폰 </p></a>
                        <a href="/promotion"><p>프로모션</p></a>
                    </div>
                </li>
                



<!-- old -->
                <!-- <li class="gnb_menu_item">
                    <a href="#">여행자 보험</a>
                </li>
                <li class="gnb_menu_item">
                    <a href="/event/event_list">이벤트</a>
                </li>
                <li class="gnb_menu_item">
                    <a href="/coupon/list">여행 쿠폰</a>
                </li>
                <li class="gnb_menu_item">
                    <a href="/community/customer_center/list_notify">태국뉴스</a>
                </li>
                <li class="gnb_menu_item">
                    <a href="/review/review_list">여행후기</a>
                </li> -->
            </ul>
        </div>
    </nav>
</div>
<!-- <div id="iframeContainer">
    <iframe id="myIframe" src="" frameborder="0"></iframe>
</div> -->

<script>

    $(".btn_show_select").click(function () {
        $(this).addClass("active")
        $(".popup_wraper").addClass("show")

    })

    $(".popup_wraper .btn_close_popup").click(function () {
        $('.popup_wraper').removeClass("show");
        $(".btn_show_select").removeClass("active")
    })

</script>

<script>
    $(".gnb_menu_item .menu_level_1 img").click(function () {
        $(this).toggleClass("up");
        var menu = $(this).closest(".menu_level_1").siblings(".menu_level_2");

        if (menu.hasClass("show")) {
            menu.removeClass("show");
        } else {
            menu.addClass("show");
        }
    })
</script>



<script>
    // $("#hamburger").click(function() {
    //     $(this).toggleClass("change");
    //     if ($(this).hasClass("change")) {
    //         $("#menu_mobile").show();
    //     } else {
    //         $("#menu_mobile").hide();
    //     }
    // });

    // $("#search_input_pc__header").focus(function() {
    //     $("#search_words_list_pc").slideDown(200);
    // })

    // $(document).click(function(e) {
    //     var container = $("#main-search-container");
    //     if (!container[0].contains(e.target)) {
    //         $("#search_words_list_pc").slideUp(200);
    //     }
    // })

    function containsEnglish(str) {
        return /[A-Za-z]/.test(str);
    }

    let debounceTimeout;
    $("#search_input_pc__header").keyup(function(event) {
        var search_name = $(this).val().trim();

        if(search_name == "") {
            $("#search_words_list_pc").hide();
        }else{

            clearTimeout(debounceTimeout);

            debounceTimeout = setTimeout(function() {
                $.ajax({
                    url: "/api/products/get_search_products",
                    type: "GET",
                    data: "search_name=" + search_name,
                    error: function (request, status, error) {
                        alert("code : " + request.status + "\r\nmessage : " + request.responseText);
                    },
                    success: function (response, status, request) {
                        let products = response;

                        if (products.length > 0) {
                            let html = ``;
                            let url = '';

                            products.forEach(product => {
                                if (product["product_code_1"] == "1303") {
                                    url = '/product-hotel/hotel-detail/' + product["product_idx"];
                                } else if (product["product_code_1"] == "1302") {
                                    url = '/product-golf/golf-detail/' + product["product_idx"];
                                } else if (product["product_code_1"] == "1301") {
                                    url = '/product-tours/item_view/' + product["product_idx"];
                                } else if (product["product_code_1"] == "1325") {
                                    url = '/product-spa/spa-details/' + product["product_idx"];
                                } else if (product["product_code_1"] == "1317") {
                                    url = '/ticket/ticket-detail/' + product["product_idx"];
                                } else if (product["product_code_1"] == "1320") {
                                    url = '/product-restaurant/restaurant-detail/' + product["product_idx"];
                                }

                                if(containsEnglish(search_name)) {
                                    html += `<li><a href="${url}">${product["product_name_en"]}</a></li>`;
                                }else{
                                    html += `<li><a href="${url}">${product["product_name"]}</a></li>`;
                                }

                            });

                            $("#search_words_list_pc").html(html);
                            $("#search_words_list_pc").show();
                        } else {
                            $("#search_words_list_pc").hide();
                        }
                        return;
                    }
                });
            }, 100);

        }

        if (event.keyCode == 13) {
            if(search_name.trim() == ""){
                alert("검색어를 입력해 주세요.");
                return false;
            }
            location.href = "/product_search?search_name=" + search_name;
        }
    })

    $("#search-mobile").click(function() {
        $("#popup_search_mo").show();
    });

    $("#icon-close-ps").click(function() {
        $("#popup_search_mo").hide();
    });

    $(document).ready(function() {
        $('#language-select').select2({
            templateResult: formatState,
            templateSelection: formatState,
            minimumResultsForSearch: Infinity
        });

        $('#language-select-rounded').select2({
            minimumResultsForSearch: Infinity
        });

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "/images/ico";
            var $state = $(
                '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '_icon.png" class="img-flag" /> ' + state.text + '</span>'
            );
            return $state;
        };
    });
    $(document).ready(function() {
        $('#language-select2').select2({
            templateResult: formatState,
            templateSelection: formatState,
            minimumResultsForSearch: Infinity
        });

        $('#language-select-rounded').select2({
            minimumResultsForSearch: Infinity
        });

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "/images/ico";
            var $state = $(
                '<span class="select_res_header"><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '_icon.png" class="img-flag" /> ' + state.text + '</span>'
            );
            return $state;
        };
    });
    document.addEventListener('DOMContentLoaded', () => {
        const burger = document.querySelector('.burger');
        const nav = document.querySelector('.nav-links');

        burger.addEventListener('click', () => {
            nav.classList.toggle('nav-active');
            burger.classList.toggle('toggle');
        });
    });
    $(document).ready(function() {
        var lastScrollTop = $(window).scrollTop();
        var topPart = $('#header_tools');

        // $(window).scroll(function(event) {
        //     var st = $(this).scrollTop();

        //     if (st > lastScrollTop) {
        //         if (!topPart.hasClass('hidden_w')) {
        //             topPart.slideUp(300, function() {
        //                 topPart.addClass('hidden_w');
        //                 $("#header").css("padding-bottom", "0px");
        //             });
        //             $(".header_replace").css({
        //                 height: "56px"
        //             });
        //         }
        //     } else {
        //         if (topPart.hasClass('hidden_w')) {
        //             topPart.slideDown(300, function() {
        //                 topPart.removeClass('hidden_w');
        //                 $("#header").css("padding-bottom", "10px");
        //             });
        //             $(".header_replace").css({
        //                 height: "214px"
        //             });
        //         }
        //     }

        //     lastScrollTop = st;
        // });

        $("#search_icon_pc").click(function() {
            var search_name = $("#search_input_pc__header").val() ?? "";

            if(search_name.trim() == ""){
                alert("검색어를 입력해 주세요.");
                return false;
            }
            var search_cate = $("#search_cate_pc__header").val() ?? "";
            location.href = "/product_search?search_name=" + search_name + "&search_cate=" + search_cate;
        });

    });

    const swiperHeaderMenu = new Swiper(".hot_product_menu_swiper", {
        loop: true,
        breakpoints: {
            851: {
                slidesPerView: 4,
            },
        },
        slidesPerView: 2,
        spaceBetween: 20,
        pagination: {
            el: ".hot_product_menu_swiper_pagination",
        },
    });

    const links = document.querySelectorAll('.link_top');
    links.forEach(button => {
        button.addEventListener('click', () => {
            links.forEach(btn => btn.classList.remove('active_'));
            button.classList.add('active_)');
        });
    });

    $(document).ready(function() {
        $('.nav-item-js').on('click', function() {

            const $popup = $('#mobile_menu');
            if ($popup.is(':visible')) {
                $popup.slideUp();
            } else {
                $popup.slideDown();
            }
        });


        $(document).on('click', function(e) {
            if (!$(e.target).closest('.nav-item-js, #mobile_menu').length) {
                $('#mobile_menu').slideUp();
            }
        });
    });

    // function openInIframe(url) {
    //     var iframe = document.getElementById('myIframe');
    //     iframe.src = url; 
    // }
</script>

<script>
    function goBack() {
        console.log("Referrer:", document.referrer);
        console.log("Current:", window.location.href);
        if (document.referrer && document.referrer.indexOf(location.hostname) !== -1) {
            window.history.back();
        } else {
            window.location.href = "<?= base_url('/') ?>";
        }
    }
    function stopEventPropagation(e) {
        event.stopPropagation()
    }

    $(".show_dropdown").click(function () {
        $(".dropdown").toggle();
    })

    $(".lang_item").click(function () {
        $lang = $(this).text();
        $(".lang_selected").find("span").text($lang);
        $(".dropdown").hide();
    })
</script>