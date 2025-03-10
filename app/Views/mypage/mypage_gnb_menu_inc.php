<style>
    .hide {
        display: none;
    }

    .show {
        display: block;
    }
</style>
<?php $gubun = chk_member_col(session('member.id'), "gubun"); ?>


<div class="gnb_menu">
    <h1 class="gnb_title">마이페이지</h1>
    <button type="button" class="now_tab_text only_mo">
        예약내역
    </button>
    <ul class="gnb_menu_list flex">
        <li class="<?= $tab_1 ?>">
            <div class="menu_level_1 flex_b_c"><a href="../mypage/booklist">예약내역</a></div>
        </li>
        <li class="<?= $tab_6 ?>">
            <div class="menu_level_1 has_submenu flex_b_c">
                <a class="show">내가 남긴 문의</a>
                <img class="btn_togle up" src="/images/ico/gnb_menu_list_w.svg" alt="">
            </div>
            <div class="menu_level_2 flex" style="display:none">
                <!-- <a class="<?= $tab_6_1 ?>" href="../mypage/custom_travel">맞춤여행</a> -->
                <a class="<?= $tab_6_2 ?>" href="../mypage/contact">문의하기</a>
                <a class="<?= $tab_6_3 ?>" href="../mypage/consultation">1:1 여행상담</a>
            </div>
        </li>
        <li class="<?= $tab_2 ?>">
            <div class="menu_level_1 flex_b_c"><a href="../mypage/fav_list">찜한 상품</a></div>
        </li>
        <li class="<?= $tab_3 ?>">
            <div class="menu_level_1 flex_b_c"><a href="../mypage/travel_review">여행후기</a></div>
        </li>
        <li class="<?= $tab_4 ?>">
            <div class="menu_level_1 has_submenu flex_b_c">
                <a class="show">나의 혜택</a>
                <img class="btn_togle up" src="/images/ico/gnb_menu_list_w.svg" alt="">
            </div>
            <div class="menu_level_2 flex" style="display:none">
                <a class="<?= $tab_4_1 ?>" href="../mypage/point">포인트 사용 내역</a>
                <a class="<?= $tab_4_2 ?>" href="../mypage/coupon">쿠폰 사용 내역</a>
            </div>
        </li>
        <li class="<?= $tab_5 ?>">
            <div class="menu_level_1 has_submenu flex_b_c">
                <a class="show">쿠폰함</a>
                <img class="btn_togle up" src="/images/ico/gnb_menu_list_w.svg" alt="">
            </div>
            <div class="menu_level_2 flex" style="display:none">
                <a class="<?= $tab_5_1 ?>" href="../mypage/discount">사용 가능한 쿠폰</a>
                <a class="<?= $tab_5_2 ?>" href="../mypage/discount_owned">지난 쿠폰</a>
                <a class="<?= $tab_5_3 ?>" href="../mypage/discount_download">쿠폰 다운받기</a>
            </div>
        </li>
        <!-- <li class="<?= $tab_6 ?>">
            <div class="menu_level_1 flex_b_c"><a href="../mypage/contact">문의하기</a></div>
        </li>
        <li class="<?= $tab_7 ?>">
            <div class="menu_level_1 flex_b_c"><a href="../mypage/consultation">1:1 여행상담</a></div>
        </li> -->
        <!-- <li class="<?= $tab_8 ?>">
            <div class="menu_level_1 flex_b_c"><a href="../mypage/visa">나의 호주비자문의</a></div>
        </li> -->
		
		<?php if(session("member.level") != "99") { ?>
        <li class="<?= $tab_9 ?>">
            <div class="menu_level_1 has_submenu flex_b_c">
                <a class="show">정보수정</a>
                <img class="btn_togle up" src="/images/ico/gnb_menu_list_w.svg" alt="">
            </div>
            <div class="menu_level_2 flex" style="display:none">
                <a class="<?= $tab_9_1 ?>" href="../mypage/info_option">내 정보수정</a>
                <a class="<?= $tab_9_2 ?>" href="../mypage/user_mange">계좌정보</a>
                <?php if($gubun !== "kakao" && $gubun !== 'google') {       
                     echo '<a class="'. $tab_9_3 .'" href="../mypage/money">회원탈퇴</a>' ;
                }else{
                    echo "";
                }
            ?> 
 
            </div>
        </li>
		<?php } ?>

        <!-- <li>
            <div class="menu_level_1 flex_b_c"><a class="show_popup" href="#!">현금영수증 발급 안내</a></div>
        </li> -->
    </ul>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        if ($(window).width() <= 850) {
            snbActive();
        }

        function snbActive() {
            $('.now_tab_text').on('click', function() {
                if ($(this).hasClass('active') == true) {
                    $(this).removeClass('active')
                    $('.gnb_menu_list').stop().slideUp();
                } else {
                    $(this).addClass('active')
                    $('.gnb_menu_list').stop().slideDown();
                }

            })
            $('.menu_level_1 > div').on('click', function(e) {
                if ($(this).next('.menu_level_2').length > 0) {
                    e.preventDefault();
                    $(this).next('.menu_level_2').stop().slideToggle();
                } else {
                    $('.gnb_menu_list').stop().slideUp();
                    $('.now_tab_text').removeClass('active');
                }
            });


            // $('.gnb_menu .gnb_menu_list li.on a').on('click', function () {
            //     console.log(nowTxt);
            //     $('.gnb_menu .now_tab_text').text(nowTxt);
            // });

            let nowTxt = $('.gnb_menu .gnb_menu_list li.on .menu_level_1 a').text();
            console.log(nowTxt);

            $('.gnb_menu .now_tab_text').text(nowTxt);

        }



        $(".gnb_menu_list > li .menu_level_1 .show").on("click", function() {
            $(this).siblings(".btn_togle").toggleClass("up");
            $(this).closest(".menu_level_1").siblings(".menu_level_2").slideToggle(100, function() {
                // $(this).closest(".menu_level_1").siblings(".menu_level_2").find(".btn_collapse").removeClass("up");
            });
        });
        $(".gnb_menu_list > li .menu_level_1 .btn_togle").on("click", function() {
            $(this).toggleClass("up");
            $(this).closest(".menu_level_1").siblings(".menu_level_2").slideToggle(100, function() {
                // $(this).closest(".menu_level_1").siblings(".menu_level_2").find(".btn_collapse").removeClass("up");
            });
        });

        $(".gnb_menu_list > li.on").each(function() {
            $(this).find('.menu_level_1 .btn_togle').removeClass("up");
            $(this).find('.menu_level_2').css('display', 'flex');
            // $(this).find('.menu_level_1 .show').closest(".menu_level_1").siblings(".menu_level_2").css('display', 'flex');
        });
    })
</script>