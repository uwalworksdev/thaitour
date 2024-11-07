<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<section class="section_vehicle_1">
    <div class="banner_vehicle">
        <div class="body_inner">
            <div class="swiper_container_ticket swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="img_box img_box_14">
                            <picture>
                                <source media="(min-width: 850px)" srcset="<?= base_url('/uploads/products/car_banner.png') ?>">
                                <img class="img_box__img" src="<?= base_url('/uploads/products/car_banner.png') ?>" alt="">
                            </picture>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="img_box img_box_14">
                            <picture>
                                <source media="(min-width: 850px)" srcset="<?= base_url('/uploads/products/car_banner.png') ?>">
                                <img class="img_box__img" src="<?= base_url('/uploads/products/car_banner.png') ?>" alt="">
                            </picture>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next-vehicle"><img src="/uploads/icons/next_s.png" alt=""></div>
                <div class="swiper-button-prev-vehicle"><img src="/uploads/icons/prev_s.png" alt=""></div>
            </div>
        </div>
    </div>
</section>
<section class="section_vehicle_2">
    <div class="body_inner">
        <div class="section_vehicle_2__wrap">
            <section class="section_vehicle_2_1">
                <div class="section_vehicle_2_1__head">
                    <div class="section_vehicle_2_1__head__ttl vehicle_ttl">
                        간편 차량예약 <span>출발 지역 -> 최종 도착 지역을 선택해주세요</span>
                    </div>
                    <div class="section_vehicle_2_1__head__icon">
                        <a href="#!">
                            <img src="/images/ico/ico_warning.svg" alt="">
                            주의사항
                        </a>
                    </div>
                </div>
                <div class="section_vehicle_2_1__body">
                    <div class="place_chosen">
                        <div class="place_chosen__start bg_gray">
                            <img src="/images/ico/ico_place.svg" alt="">
                            출발지역
                        </div>
                        <div class="place_chosen__icon">
                            <img src="/images/ico/ico_transfer.svg" alt="">
                        </div>
                        <div class="place_chosen__end bg_gray">
                            <img src="/images/ico/ico_place.svg" alt="">
                            도착지역
                        </div>
                        <div class="place_chosen__date bg_gray">
                            <img src="/images/ico/ico_calendar_1.png" alt="">
                            미팅날짜 : 06.21(토)
                        </div>
                        <div></div>
                        <div class="place_chosen__people bg_gray">
                            <img src="/images/ico/ico_person_1.png" alt="">
                            성인 1명, 소아 1명
                        </div>
                    </div>
                    <a href="#!" class="view_map_btn">
                        <picture>
                            <source media="(max-width: 850px)" srcset="/images/sub/btn_view_map_m.png">
                            <img src="/images/sub/btn_view_map.png" alt="view_map">
                        </picture>
                    </a>
                </div>
            </section>
            <section class="section_vehicle_2_2">
                <div class="section_vehicle_2_2__head">
                    <div class="section_vehicle_2_2__head__ttl vehicle_ttl">
                        상품선택 <span>상품 선택후 아래 세부항목을 선택해주세요.</span>
                        <img style="vertical-align: middle;margin-left: 3px" src="/images/ico/ico_question.png" alt="">
                    </div>
                    <ul class="section_vehicle_2_2__head__tabs">
                        <li class="section_vehicle_2_2__head__tabs__item active">
                            <a href="#!">공항픽업</a>
                        </li>
                        <li class="section_vehicle_2_2__head__tabs__item">
                            <a href="#!">공항샌딩</a>
                        </li>
                        <li class="section_vehicle_2_2__head__tabs__item">
                            <a href="#!">일일렌탈</a>
                        </li>
                        <li class="section_vehicle_2_2__head__tabs__item">
                            <a href="#!">편도이동</a>
                        </li>
                    </ul>
                    <div class="section_vehicle_2_2__airport">
                        <span>
                            <input checked type="radio" id="airport1" name="airport" value="airport">
                            <label for="airport1">공항1</label>
                        </span>
                        <span>
                            <input type="radio" id="airport2" name="airport" value="airport">
                            <label for="airport2">공항2</label>
                        </span>
                    </div>
                </div>
            </section>
            <section class="section_vehicle_2_3">
                <div class="section_vehicle_2_3__head">
                    <div class="section_vehicle_2_3__head__ttl vehicle_ttl">
                        차량선택 <span>차량의 종류와 대수를 선택해주세요</span>
                    </div>
                </div>
                <table class="vehicle_list">
                    <colgroup>
                        <col width="277px">
                        <col width="480px">
                        <col width="320">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>
                                <div class="vehicle_image">
                                    <div class="img_box img_box_15">
                                        <img src="/uploads/products/vehicle_1.png" alt="">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="vehicle_info">
                                    <h4 class="vehicle_info__name">
                                        프리미엄세단 (도요타 알티스, 캠리 등 준중형 세단) <br>
                                        좌석 3개 (어른3 / 어린이 1)
                                    </h4>
                                    <table>
                                        <colgroup>
                                            <col width="10%">
                                            <col width="30%">
                                            <col width="10%">
                                            <col width="10%">
                                            <col width="40%">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td class=""><img src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">가방 20kg 3개</td>
                                                <td class="vehicle_info__item">또는</td>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">가방 20kg 1개 + 24kg 1개</td>
                                            </tr>
                                            <tr>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_bat.png" alt=""></td>
                                                <td class="vehicle_info__item">골프백 3개</td>
                                                <td class="vehicle_info__item">또는</td>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_bat.png" alt=""><img
                                                        src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">골프백 2개+가방 20kg</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div class="vehicle_price">
                                    43,758<span>원 (1,100바트)</span>
                                </div>
                                <div class="vehicle_options">
                                    <label class="vehicle_options__label__vehicle_cnt" for="vehicle_cnt">차량수량</label>
                                    <select name="" id="vehicle_cnt" class="vehicle_options__select">
                                        <option value="">1</option>
                                    </select>
                                    <input type="checkbox" id="vehicle_prd1" name="">
                                    <label class="vehicle_options__label__vehicle_prd" for="vehicle_prd1">상품담기</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="vehicle_image">
                                    <div class="img_box img_box_15">
                                        <img src="/uploads/products/vehicle_2.png" alt="">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="vehicle_info">
                                    <h4 class="vehicle_info__name">
                                        프리미엄세단 (도요타 알티스, 캠리 등 준중형 세단) <br>
                                        좌석 3개 (어른3 / 어린이 1)
                                    </h4>
                                    <table>
                                        <colgroup>
                                            <col width="10%">
                                            <col width="30%">
                                            <col width="10%">
                                            <col width="10%">
                                            <col width="40%">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td class=""><img src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">가방 20kg 3개</td>
                                                <td class="vehicle_info__item">또는</td>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">가방 20kg 1개 + 24kg 1개</td>
                                            </tr>
                                            <tr>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_bat.png" alt=""></td>
                                                <td class="vehicle_info__item">골프백 3개</td>
                                                <td class="vehicle_info__item">또는</td>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_bat.png" alt=""><img
                                                        src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">골프백 2개+가방 20kg</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div class="vehicle_price">
                                    43,758<span>원 (1,100바트)</span>
                                </div>
                                <div class="vehicle_options">
                                    <label class="vehicle_options__label__vehicle_cnt" for="vehicle_cnt">차량수량</label>
                                    <select name="" id="vehicle_cnt" class="vehicle_options__select">
                                        <option value="">1</option>
                                    </select>
                                    <input type="checkbox" id="vehicle_prd2" name="">
                                    <label class="vehicle_options__label__vehicle_prd" for="vehicle_prd2">상품담기</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="vehicle_image">
                                    <div class="img_box img_box_15">
                                        <img src="/uploads/products/vehicle_3.png" alt="">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="vehicle_info">
                                    <h4 class="vehicle_info__name">
                                        프리미엄세단 (도요타 알티스, 캠리 등 준중형 세단) <br>
                                        좌석 3개 (어른3 / 어린이 1)
                                    </h4>
                                    <table>
                                        <colgroup>
                                            <col width="10%">
                                            <col width="30%">
                                            <col width="10%">
                                            <col width="10%">
                                            <col width="40%">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <td class=""><img src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">가방 20kg 3개</td>
                                                <td class="vehicle_info__item">또는</td>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">가방 20kg 1개 + 24kg 1개</td>
                                            </tr>
                                            <tr>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_bat.png" alt=""></td>
                                                <td class="vehicle_info__item">골프백 3개</td>
                                                <td class="vehicle_info__item">또는</td>
                                                <td class="vehicle_info__item"><img src="/images/ico/ico_bat.png" alt=""><img
                                                        src="/images/ico/ico_baggage.png" alt=""></td>
                                                <td class="vehicle_info__item">골프백 2개+가방 20kg</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div class="vehicle_price">
                                    43,758<span>원 (1,100바트)</span>
                                </div>
                                <div class="vehicle_options">
                                    <label class="vehicle_options__label__vehicle_cnt" for="vehicle_cnt">차량수량</label>
                                    <select name="" id="vehicle_cnt" class="vehicle_options__select">
                                        <option value="">1</option>
                                    </select>
                                    <input type="checkbox" id="vehicle_prd3" name="">
                                    <label class="vehicle_options__label__vehicle_prd" for="vehicle_prd3">상품담기</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="section_vehicle_2_4">
                <div class="section_vehicle_2_4__head">
                    <div class="section_vehicle_2_4__head__ttl">
                        취소 규정 : 결제후 06월26일 18시(한국시간) 이전에 취소하시면 무료취소가 가능합니다.
                        <a class="vehicle_ttl__link" href="#!">본 예약건 취소규정 자세히 보기</a>
                    </div>
                </div>
                <div class="vehicle_synthetic">
                    <div>
                        <p class="vehicle_synthetic__ttl">선택상품</p>
                        <p class="vehicle_synthetic__txt">차량 3대</p>
                    </div>
                    <div>
                        <p class="vehicle_synthetic__ttl">차량가격</p>
                        <div class="vehicle_all_price">43,758<span>원 (1,100바트)</span></div>
                        </div>
                    <div class="vehicle_minus">
                        <span class="minus_ico"></span>
                    </div>
                    <div>
                        <p class="vehicle_synthetic__ttl">할인</p>
                        <div class="vehicle_all_price">43,758<span>원 (1,100바트)</span></div>
                    </div>
                    <div class="vehicle_equal">
                        <span class="equal_ico"></span>
                    </div>
                    <div>
                        <p class="vehicle_synthetic__ttl">결제예정금액</p>
                        <div class="vehicle_price">43,758<span>원 (1,100바트)</span></div>
                    </div>
                    <div class="vehicle_coupon">
                        <button class="coupon_btn">쿠폰선택</button>
                        <button class="point_btn">포인트사용</button>
                    </div>
                </div>
                <div class="section_vehicle_2_4__foot">
                    예약시 기재하신 미팅장소에서 목적지까지의 단순 편도 차량입니다. <br> 샌딩 지역이 예약하신 상품의 지역이 아닌 곳은 추
                </div>
            </section>
            <section class="section_vehicle_2_5">
                <div class="section_vehicle_2_5__head">
                    <div class="section_vehicle_2_5__head__ttl vehicle_ttl">
                        포함/불포함사항
                    </div>
                </div>
                <div class="section_vehicle_2_5__body">
                    <div class="include_box chk_info">
                        <p class="sub_label"> <i></i> 포함사항</p>
                        <div class="txt_box">
                            <p>- 국제선 항공요금 및 각종 TAX 및 유류할증료 (항공불포함 제외)</p>
                            <p>&nbsp; <font color="red">비지니스 이용을 원하실 경우 담당자에게 문의해주세요.</font>
                            </p>
                            <p>- 전일정 4성급 호텔 및 식사 (불포함 표기 식사 제외)</p>
                            <p>&nbsp; <font color="red">호텔 업그레이드를 원하시는 경우 담당자에게 문의해주세요.</font>
                            </p>
                            <p>- 전일정 전용차량 및 입장료 (자유일정 제외)<br>- 여행자 보험&nbsp;</p>
                            <p>
                                <font color="black">&nbsp;</font>
                            </p>
                        </div>
                    </div>
                    <div class="no_include_box chk_info">
                        <p class="sub_label"> <i></i> 불포함사항</p>
                        <div class="txt_box">
                            <p>- 더투어랩는 가이드 팁 대신 책 (신간) 을 받습니다.</p>
                            <p>&nbsp; 장르 상관없이 1인당 책 1권만 가지고 오시면 되며, 호주 내 한인 도서관에 기증됩니다.</p>
                            <p>- 불포함 표기 식사 및 자유일정</p>
                            <p>
                                <font color="black">- 호주 ETA 비자 : AustralianETA 모바일 앱을 통해 직접 신청</font>
                            </p>
                            <p>- 기타 개인 경비 (물값, 자유시간 시 개인비용 등)</p>
                            <p>※ 호주 화폐로 준비해주시기 바랍니다.</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section_vehicle_2_6">
                <div class="section_vehicle_2_6__head">
                    <div class="section_vehicle_2_6__head__ttl vehicle_ttl">
                        공지사항
                    </div>
                </div>
                <div class="section_vehicle_2_6__body">
                    <ul>
                        <li>승용차는 최대 성인 3인 혹은 성인 2인 + 아동 1인까지만 가능합니다. 만약 성인 3인 + 아동 1인인 경우 SUV 혹은 승합차로 이용하셔야 합니다.</li>
                        <li>승용차의 트렁크에는 가스통이 있어 짐이 많을 경우 좁을 수 있으니 소인을 포함하여 인원이 3 ~ 4분이면 짐의 양도 고려하셔야 합니다.</li>
                        <li>별도로 카시트는 준비되지 않습니다.</li>
                        <li>에어비엔비등으로 예약한 일반 숙소, 풀빌라등의 경우 정확한 건물명, 주소, 호스트의 태국 현지 연락처를 기재하셔야 합니다.</li>
                        <li>
                            예약시 기재한 일정 외에 미리 알리지 않은 일정을 당일 추가시 비용이 추가가 되며 기사님의 스케쥴에 따라 이용이 어려울 수도 있으니
                            미리 게시판을 통하여 문의하시기 바랍니다.
                        </li>
                        <li>차량내 흡연, 음주, 안전벨트 미착용등의 위반시 5,000바트 이상의 벌금이 부과되니 주의해 주세요.</li>
                        <li>고급차량(알파드,벤츠)등은 10시간 렌탈로 요청 가능하며, 일일렌탈 12시간으로 예약신청 후 10시간으로 렌탈요청시 견적서 다시 보내드립니다.</li>
                        <li>프리미엄 세단은 벤츠 E클래스 또는 BMW5 시리즈 등 동급으로 배정 됩니다.</li>
                        <li>럭셔리 세단은 벤츠 S클래스 또는 BMW7 시리즈 등 동급으로 배정됩니다.</li>
                    </ul>
                </div>
            </section>
            <section class="section_vehicle_2_7">
                <div class="section_vehicle_2_7__head">
                    <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                        예약자 정보입력
                    </div>
                </div>
                <div class="section_vehicle_2_7__body">
                    <form action="" method="post">
                        <table>
                            <colgroup class="only_web">
                                <col width="150px" >
                                <col width="*" >
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>미팅 시간</th>
                                    <td>
                                        <div class="meeting_time">
                                            <span class="meeting_time__date">2024-06-28(금)</span>
                                            <select name="" id="hours">
                                                <option value="">00</option>
                                            </select>
                                            <label for="hours">시</label>
                                            <select name="" id="minutes">
                                                <option value="">00</option>
                                            </select>
                                            <label for="minutes">분</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        출발지 <br> (픽업호텔)
                                    </th>
                                    <td>
                                        <div class="departure">
                                            <span>방콕</span>
                                            <input type="text" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                        </div>
                                        <div class="departure__note">
                                            - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                            - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                            - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        목적지 <br> (픽업호텔)
                                    </th>
                                    <td>
                                        <div class="destination">
                                            <span>방콕</span>
                                            <input type="text" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>기타요철</th>
                                    <td>
                                        <textarea name="" id="" class="other_irregularities"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>전화번호*</th>
                                    <td>
                                        <div class="phone_number">
                                            <select name="" id="">
                                                <option value="010">010</option>
                                            </select>
                                            <input type="text">
                                            <input type="text">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>이메일*</th>
                                    <td>
                                        <div class="contact_email">
                                            <input type="text">
                                            <span>@</span>
                                            <input type="text">
                                            <select name="" id="">
                                                <option value="">gmail.com</option>
                                                <option value="">naver.com</option>
                                                <option value="">kakao.com</option>
                                                <option value="">hanmail.com</option>
                                                <option value="">nate.com</option>
                                                <option value="">yahoo.com</option>
                                                <option value="">hotmail.com</option>
                                                <option value="">chol.com</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="section_vehicle_2_7__btn_wrap">
                        <button class="btn_add_cart" onclick="window.location.href='/cart/item-list/123'">
                            장바구니담기
                        </button>
                        <button class="btn_submit" onclick="window.location.href='/product/completed-order'">
                            상품 예약하기
                        </button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<script>
    var swiper = new Swiper('.swiper_container_ticket', {
        slidesPerView: 1,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        spaceBetween: 22,
        navigation: {
            nextEl: '.swiper-button-next-vehicle',
            prevEl: '.swiper-button-prev-vehicle',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        on: {
            init: function () {
                updateSlideCounter(this);
            },
            slideChange: function () {
                updateSlideCounter(this);
            }
        }
    });
    function updateSlideCounter(swiper) {
        var currentIndex = swiper.realIndex + 1;
        var totalSlides = swiper.slides.length
        // document.querySelector('.main_current_slide').innerText = currentIndex;
        // document.querySelector('.main_total_slide').innerText = totalSlides;
    }
    document.getElementById('autoplay-button').addEventListener('click', function () {
        var playButton = document.getElementById('play-button');
        var pauseButton = document.getElementById('pause-button');
        if (swiper.autoplay.running) {
            swiper.autoplay.stop();
            playButton.style.display = 'block';
            pauseButton.style.display = 'none';
        } else {
            swiper.autoplay.start();
            playButton.style.display = 'none';
            pauseButton.style.display = 'block';
        }
    });
</script>


<?php $this->endSection(); ?>