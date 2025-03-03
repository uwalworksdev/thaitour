<?php
    $setting = homeSetInfo();
?>
<?php if (isset($notice_list_footer)) : ?>
    <section class="main_section_notice">
        <div class="body_inner">
            <div class="">
                <div class="main_section_notice__body only_web_flex">
                    <div class="notice__ttl">공지사항</div>
                    <div class="notice_list notice_swiper swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($notice_list_footer as $notice) : ?>
                                <div class="swiper-slide">
                                    <div class="notice_item">
                                        <div class="notice_item__left">
                                            <?php if ($notice['notice_yn'] == 'Y') : ?>
                                                <div class="notice_item__icon">공지</div>
                                            <?php endif; ?>
                                            <a href="/community/customer_center/notify?bbs_idx=<?= $notice['bbs_idx'] ?>"
                                               class="notice_item__title"><?= $notice['subject'] ?></a>
                                        </div>
                                        <div class="notice_item__date"><?= date("Y.m.d", strtotime($notice['r_date'])) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <a href="/community/customer_center/list_notify" class="main_section_notice__more">
                        <img class="ico_plus" src="/images/ico/ico_plus.svg" alt="">
                    </a>
                    <div class="swiper-button-box">
                        <button class="notice_swiper_btn_prev notice_swiper_btn">
                            <img src="/images/ico/ico_prev_slide.svg" alt="">
                        </button>
                        <button class="notice_swiper_btn_next notice_swiper_btn">
                            <img src="/images/ico/ico_next_slide.svg" alt="">
                        </button>
                    </div>
                </div>


                <div class="main_section_notice__body only_mo">

                    <div class="flex_mo_notice__body">
                        <div class="notice__ttl">공지사항</div>
                        <div class="swiper-button-box">
                            <button class="notice_swiper_btn_prev notice_swiper_btn">
                                <img class="ico_prev_slide" src="/images/ico/ico_prev_slide.svg" alt="">
                            </button>
                            <button class="notice_swiper_btn_next notice_swiper_btn">
                                <img class="ico_prev_slide" src="/images/ico/ico_next_slide.svg" alt="">
                            </button>
                        </div>
                    </div>


                    <div class="notice_list notice_swiper swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($notice_list_footer as $notice) : ?>
                                <div class="swiper-slide flex-center">
                                    <div class="notice_item">
                                        <div class="notice_item__left">
                                            <?php if ($notice['notice_yn'] == 'Y') : ?>
                                                <div class="notice_item__icon">공지</div>
                                            <?php endif; ?>
                                            <div class="notice_item__title"><?= $notice['subject'] ?></div>
                                        </div>
                                    </div>
                                    <div class="flex_mobile_notice_item">
                                        <div class="notice_item__date"><?= date("Y.m.d", strtotime($notice['r_date'])) ?></div>
                                        <div>
                                            <a href="/community/customer_center/list_notify"
                                               class="flex-center main_section_notice__more">
                                                <img class="ico_plus" src="/images/ico/ico_plus.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </section>
<?php endif; ?>
<footer id="footer">
    <div class="inner">
        <div>
            <ul class="flex_footer_top pl-10">
                <li><a href="">회사소개</a></li>
                <li><a href="/community/customer_center">자주묻는 질문</a></li>
                <li><a href="/center/reservation">예약변경 및 취소 정책 </a></li>
                <li><a href="/center/privacy">개인정보처리방침 </a></li>
                <li><a href="/center/tourterms">여행약관</a></li>
                <li><a href="/center/terms">이용약관</a></li>
                <li><a href="">여행사전용 윈윈트래블</a></li>
            </ul>
        </div>
        <hr>
        <div class="flex_footer_bot">
            <div class="footer_l">
                <div class="ft_logo">
                    <!-- <img src="/images/sub/logo_foorer.png" alt="" class="only_web">
                    <img src="/images/sub/logo_footer_m.png" alt="" class="only_mo"> -->
                    <img src="/uploads/setting/<?= $setting['logos_footer']?>" alt="">
                </div>
                <div class="add_footer">
                    <p>대표이사 : <?= $setting['com_owner']?> <br>
                        <?= $setting['addr1']?>, <?= $setting['addr2']?><br>
                        이메일 : <?= $setting['qna_email']?><br>
                        통신판매업 : <?= $setting['mallOrder']?><br>
                        한국 사업자번호 <?= $setting['comnum']?><br>
                        태국 사업자번호 <?= $setting['comnum_thai']?></p>
                </div>
                <div>
                    <div class="custom-select2">
                        <select id="language-select-2" style="width: 100%;">
                            <option value="kr">kr</option>
                            <!-- Add more options here -->
                        </select>
                    </div>
                </div>
                <div class="copy_f">
                    <p><?= $setting['copyright']?></p>
                </div>
            </div>
            <div class="footer_r">
                <div>
                    <ul class="footer_icon">
                        <li><a href=""><img class="only_web" src="/images/ico/ig_footer.png" alt=""> <img
                                        class="only_mo" src="/uploads/icons/ig_footer_m.png" alt=""></a></li>
                        <li><a href=""><img class="only_web" src="/images/ico/bl_footer.png" alt=""> <img
                                        class="only_mo" src="/uploads/icons/bl_footer_m.png" alt=""></a></li>
                        <li><a href=""><img class="only_web" src="/images/ico/n_footer.png" alt=""><img class="only_mo"
                                                                                                        src="/uploads/icons/n_footer_m.png"
                                                                                                        alt=""></a></li>
                        <li><a href=""><img class="only_web" src="/images/ico/ytb_footer.png" alt=""><img
                                        class="only_mo" src="/uploads/icons/ytb_footer_m.png" alt=""></a></li>


                    </ul>
                </div>
                <div class="lh-1-6">
                    <p class="text-w text-18">고객센터</p>
                    <p class="text-25">한국에서 걸 때 <span class="text-w"> <?= $setting['custom_service_phone_seoul']?></span> (시내통화요금) (호텔/골프/투어/차량 상담)</p>
                    <p class="text-25">태국에서 걸 때 <span class="text-w"> <?= $setting['custom_service_phone_thai']?></span> (방콕) 로밍폰, 태국 유심폰 <br
                                class="only_mo"> 모두 <?= $setting['custom_service_phone_thai2']?> 번호만 누르면 됩니다.
                    </p>
                    <p class="text-18 p_bot_f">업무시간 :</p>
                    <p class="text-25 no-w"><span class="text-w"><?= $setting['time_work']?></span>
                    </p>
                    <p class="text-25 no-w">긴급예약처리 - <span class="text-w"><?= $setting['time_reservation']?></span></p>
                </div>
                <div class="btn_cus_f">
                    <button class="btn_custom_f">실시간 채팅형 간단 문의</button>
                    <button class="btn_custom_f">1:1 게시판 상세 문의</button>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="/js/slider_option.js"></script>
<script>
    $(document).ready(function () {
        $('#language-select-2').select2({
            minimumResultsForSearch: Infinity
        });
        // $("img").on("error", function () {
        //     console.log("error_image");
        //     $(this).attr("src", `https://hihojoo.com/${$(this).attr("src")}`);
        // })
        var notice_swiper = new Swiper(".notice_swiper", {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 5,
            autoplay: false,
            speed: 2000,
            navigation: {
                nextEl: ".notice_swiper_btn_next",
                prevEl: ".notice_swiper_btn_prev",
            },
        });
    });
</script>
</body>

</html>