<header id="header" class="only_web">
    <div class="inner flex_header_top">
        <div>
            <div class="custom-select-lang">
                <select id="language-select" style="width: 130px;">
                    <option value="kr">KR 한국어</option>
                    <option value="en">English</option>
                </select>
            </div>
        </div>
        <div>
            <ul class="flex_header_top">
                <li>
                    <?php if (session("member")): ?>
                        <a href="/member/logout" class="text-grey">로그아웃</a>
                    <?php else: ?>
                        <a href="/member/login" class="text-grey">로그인</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if (session("member")): ?>
                        <a href="/mypage/details" class="text-grey">마이페이지</a>
                    <?php else: ?>
                        <a href="/member/join_choice" class="text-grey">회원가입</a>
                    <?php endif; ?>
                </li>
                <li><a href="/community/customer_center" class="text-grey">고객센터</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <?php
    $tab_ = $tab_active ?? 0;
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
        default:
            $tab_active = 1;
            break;
    }
    ?>
    <div class="inner flex_header_top">
        <div class="flex_header_top">
            <a href="/"><img src="/images/sub/logo_w.png" alt=""></a>
            <div class="search-container">
                <div class="main-search-container">
                    <input type="text" class="search-input" placeholder="검색어를 입력해 주세요">
                    <i class="fa fa-search search-icon"></i>
                </div>
                <div class="custom_select_rounded">
                    <a class="text_custom_" href="#">상세검색</a>
                    <select class="select_custom_ active_" name="" id="">
                        <option value="">호텔</option>
                    </select>
                    <select class="select_custom_" name="" id="">
                        <option value="">투어</option>
                    </select>
                    <a class="text_custom_v2_" href="/vehicle-guide">차량</a>
                </div>
            </div>
        </div>

        <div>
            <div class="icon-menu">
                <a href="#" class="icon-menu-item">
                    <img src="/images/ico/icon_calen.png" alt="">
                    <p style="margin-top:5px;">일정표</p>
                </a>
                <a href="#" class="icon-menu-item">
                    <img src="/images/ico/icon_note.png" alt="">
                    <p>매거진</p>
                </a>
                <a href="<?= (session("member.idx") ? "/mypage/fav_list" : "#!") ?>" class="icon-menu-item">
                    <img src="/images/ico/icon_heart.png" alt="">
                    <p>찜</p>
                </a>
                <a href="/cart/item-list/123" class="icon-menu-item">
                    <img src="/images/ico/icon_cart.png" alt="">
                    <p style="margin-top:3px;">장바구니</p>
                </a>
            </div>
        </div>

    </div>
    <div class="">
        <div class="inner flex_header_top ">
            <div>
                <ul class="flex_header_top flex_header_top_content_list">
                    <li><a class="<?php echo isset($tab_1) ? 'active_' : '' ?>" href="/product-hotel/1324">호텔</a></li>
                    <li><a class="<?php echo isset($tab_2) ? 'active_' : '' ?>" href="/product-golf/1325/1">골프</a></li>
                    <li><a class="<?php echo isset($tab_3) ? 'active_' : '' ?>" href="/product-tours/1325/1">투어</a></li>
                    <li><a class="<?php echo isset($tab_4) ? 'active_' : '' ?>" href="/product-spa/1320/1">스파</a></li>
                    <li><a class="<?php echo isset($tab_5) ? 'active_' : '' ?>" href="/show-ticket">쇼ㆍ입장권</a></li>
                    <li><a class="<?php echo isset($tab_6) ? 'active_' : '' ?>" href="/product-list/1320/1">레스토랑</a></li>
                    <li><a class="<?php echo isset($tab_7) ? 'active_' : '' ?>" href="/vehicle-guide">차량ㆍ가이드</a></li>
                </ul>
            </div>
            <div>
                <ul class="flex_header_top">
                    <li><a href="/center/insurance">여행자 보험</a></li>
                    <li><a href="/event/event_list">이벤트</a></li>
                    <li><a href="/mypage/discount">여행 쿠폰</a></li>
                    <li><a href="/community/main">태국뉴스</a></li>
                </ul>
            </div>

        </div>
        <!-- <div class="inner flex_header_top ">
            <div>
                <ul class="flex_header_top flex_header_top_content_list">
                    <li><a class="<?php echo isset($tab_1) ? 'active_' : '' ?>" href="/product-hotel/1324">호텔</a></li>
                    <li><a class="<?php echo isset($tab_2) ? 'active_' : '' ?>" href="/product-golf/1325/1">골프</a></li>
                    <li><a class="<?php echo isset($tab_3) ? 'active_' : '' ?>" href="/product-list/1324">투어</a></li>
                    <li><a class="<?php echo isset($tab_4) ? 'active_' : '' ?>" href="/product-spa/1320/1">스파</a></li>
                    <li><a class="<?php echo isset($tab_5) ? 'active_' : '' ?>" href="/show-ticket">쇼ㆍ입장권</a></li>
                    <li><a class="<?php echo isset($tab_6) ? 'active_' : '' ?>" href="/product-tours/1320/1">레스토랑</a></li>
                    <li><a class="<?php echo isset($tab_7) ? 'active_' : '' ?>" href="/vehicle-guide">차량ㆍ가이드</a></li>
                </ul>
            </div>

            <button class="header_top_btn"></button>
        </div> -->
    </div>
</header>
<header id="header_mobile" class="only_mo inner_header_m">
    <div class="header_mobile__wrap">
        <div class="body_inner flex_header_top pb-24">
            <div class="flex_header_top_item">
                <div class="custom-select-lang">
                    <select id="language-select2">
                        <option value="kr">KR 한국어</option>
                        <option value="en">English</option>
                    </select>
                </div>
            </div>
            <div class="flex_header_top_item">
                <img class="header_logo_m" src="<?= base_url('/images/sub/logo_header_m.png') ?>" alt="">
            </div>
            <div class="flex_header_top flex_header_top_item">
                <div class="burger">
                    <img src="<?= base_url('/uploads/icons/icon-user-m.png') ?>" alt="">
                </div>
                <div class="burger">
                    <img src="<?= base_url('/uploads/icons/icon-cart-m.png') ?>" alt="">
                </div>
                <div class="hamburger" id="hamburger">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div>
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
                            <a href="/mypage/details" class="text-grey">마이페이지</a>
                        <?php else: ?>
                            <a href="/member/join_choice" class="text-grey">회원가입</a>
                        <?php endif; ?>
                    </li>
                    <li><a href="/community/customer_center" class="text-grey">고객센터</a></li>
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
                    <li><a href="/product-hotel/1324">호텔</a></li>
                    <li><a href="/product-golf/1325/1">골프</a></li>
                    <li><a href="/product-tours/1324/1">투어</a></li>
                    <li><a href="/product-spa/1320/1">스파</a></li>
                    <li><a href="/show-ticket">쇼ㆍ입장권</a></li>
                    <li><a href="/product-list/1320/1">레스토랑</a></li>
                    <li><a href="/vehicle-guide">차량ㆍ가이드</a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="search_m_header">
        <div class="search-container-m">
            <input type="text" class="search-input-m" placeholder="검색어를 입력해 주세요">
            <img class="fa fa-search search-icon-m" src="/uploads/icons/icon-search-m.png" alt="">
        </div>
    </div>
    <div class="flex_header_mo_bot">
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
    <div class="flex_header_mo_bots mtb font-26">
        <a href="">여행자 보험 </a>
        <a href="">이벤트</a>
        <a href="">여행 쿠폰</a>
        <a href="">태국뉴스</a>
    </div>
</header>

<script>
    $("#hamburger").click(function () {
        $(this).toggleClass("change");
        if ($(this).hasClass("change")) {
            $("#menu_mobile").show();
        } else {
            $("#menu_mobile").hide();
        }
    });
    $(document).ready(function () {
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
    $(document).ready(function () {
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
</script>