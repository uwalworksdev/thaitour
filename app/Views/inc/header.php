<header id="header">
    <div class="inner flex_header_top">
        <div>
        <div class="custom-select-lang">
            <select id="language-select" style="width: 130px;">
                <option value="kr">KR 한국어</option>
                <option value="en">English</option>
                <!-- Add more options here -->
            </select>
        </div>
        </div>
        <div>
            <ul class="flex_header_top">
                <li>
                    <?php if (session("member")) : ?>
                        <a href="/member/logout" class="text-grey">로그아엇</a>
                    <?php else : ?>
                        <a href="/member/login" class="text-grey">로그인</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if (session("member")) : ?>
                        <a href="/mypage/details" class="text-grey">마이페이지</a>
                    <?php else : ?>
                        <a href="/member/join_choice" class="text-grey">회원가입</a>
                    <?php endif; ?>
                </li>
                <li><a href="/community/main" class="text-grey">고객센터</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="inner flex_header_top">
        <div class="flex_header_top">
            <a href="/"><img src="/images/sub/logo_w.png" alt=""></a>
            <div class="search-container">
            <input type="text" class="search-input" placeholder="검색어를 입력해 주세요">
            <i class="fa fa-search search-icon"></i>
            <div class="custom-select-rounded">
                <select id="language-select-rounded" style="width: 100%;">
                    <option value="kr">상세검색 호텔</option>
                    <!-- Add more options here -->
                </select>
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
                <a href="<?=(session("member.idx") ? "/mypage/fav_list" : "#!")?>" class="icon-menu-item">
                    <img src="/images/ico/icon_heart.png" alt="">
                    <p>찜</p>
                </a>
                <a href="#" class="icon-menu-item">
                    <img src="/images/ico/icon_cart.png" alt="">
                    <p style="margin-top:3px;">장바구니</p>
                </a>
            </div>
        </div>

    </div>
    <div>
        <div class="inner flex_header_top">
            <div>
                <ul class="flex_header_top">
                    <li><a href="/product-list/1324">호텔</a></li>
                    <li><a href="/product-golf/1325/1">골프</a></li>
                    <li><a href="/product-tours/1317/1">투어</a></li>
                    <li><a href="/product-spa/1320/1">스파</a></li>
                    <li><a href="/show-ticket">쇼ㆍ입장권</a></li>
                    <li><a href="">레스토랑</a></li>
                    <li><a href="/vehicle-guide">차량ㆍ가이드</a></li>
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
    </div>


</header>

<script>
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
</script>