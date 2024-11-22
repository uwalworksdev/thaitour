<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<section class="section_vehicle_1">
    <div class="banner_vehicle">
        <div class="body_inner">
            <div class="swiper_container_ticket swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($bannerTop as $banner) : ?>
                        <div class="swiper-slide">
                            <div class="img_box img_box_14">
                                <picture>
                                    <source media="(min-width: 851px)" srcset="/data/cate_banner/<?= $banner['ufile1'] ?>">
                                    <img class="img_box__img" src="/data/cate_banner/<?= $banner['ufile2'] ?>" alt="">
                                </picture>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                        <div class="place_chosen__start bg_gray" role="button" id="place_chosen__start">
                            <img src="/images/ico/ico_place.svg" alt="">
                            <span class="departure_name">출발지역</span>
                        </div>
                        <div class="place_chosen__icon">
                            <img src="/images/ico/ico_transfer.svg" alt="">
                        </div>
                        <div class="place_chosen__end bg_gray" role="button" id="place_chosen__end">
                            <img src="/images/ico/ico_place.svg" alt="">
                            <span class="destination_name">도착지역</span>
                        </div>
                        <label for="departure_date" class="place_chosen__date bg_gray" role="button" id="place_chosen__date">
                            <img src="/images/ico/ico_calendar_1.png" alt="">
                            미팅날짜 : <span id="departure_date_text">06.21(토)</span>
                            <input type="text" id="departure_date" class="datepicker">
                        </label>
                        <div></div>
                        <div class="place_chosen__people_wrap">
                            <div class="place_chosen__people bg_gray" role="button" id="place_chosen__people">
                                <img src="/images/ico/ico_person_1.png" alt="">
                                <p>성인 <span id="people_adult_cnt">1</span>명,&nbsp;&nbsp;소아 <span id="people_child_cnt">0</span>명</p>
                            </div>
                            <div class="place_chosen__people_pop">
                                <div class="pickup_amount">
                                    <div class="pickup_amount__ttl">소아</div>
                                    <div class="pickup_amount__numbox">
                                        <button class="btn_minus">
                                            <img src="/images/ico/ico_minus1.png" alt="">
                                        </button>
                                        <input type="text" class="pickup_amount__num" name="adult_cnt" value="1" min="0">
                                        <button class="btn_plus">
                                            <img src="/images/ico/ico_plus1.png" alt="">
                                        </button>
                                    </div>
                                </div>
                                <div class="pickup_amount">
                                    <div class="pickup_amount__ttl">성인</div>
                                    <div class="pickup_amount__numbox">
                                        <button class="btn_minus">
                                            <img src="/images/ico/ico_minus1.png" alt="">
                                        </button>
                                        <input type="text" class="pickup_amount__num" name="child_cnt" value="1" min="0">
                                        <button class="btn_plus">
                                            <img src="/images/ico/ico_plus1.png" alt="">
                                        </button>
                                    </div>
                                </div>
                                <button class="btn_pickup_people" id="btn_pickup_people">완료</button>
                            </div>
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
                        <?php 
                            $i = 1;
                            $first_code_no = 0;
                            foreach($codes as $code){
                                if($i === 1){
                                    $first_code_no = $code["code_no"];
                                }
                        ?>
                            <li class="section_vehicle_2_2__head__tabs__item <?php if($i === 1){ echo "active"; }?>" data-code="<?=$code["code_no"]?>">
                                <a href="#!"><?=$code["code_name"]?></a>
                            </li> 
                        <?php 
                            $i++;
                            } 
                        ?>
                        <!-- <li class="section_vehicle_2_2__head__tabs__item active">
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
                        </li> -->
                    </ul>
                    <div class="section_vehicle_2_2__airport">

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
                    <tbody id="product_vehicle_list">
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
                <table class="vehicle_list">
                    <colgroup>
                        <col width="277px">
                        <col width="480px">
                        <col width="320">
                    </colgroup>
                    <tbody id="product_vehicle_list_selected" style="display: none;">
                    </tbody>
                </table>
                <div class="vehicle_synthetic">
                    <div>
                        <p class="vehicle_synthetic__ttl">선택상품</p>
                        <p class="vehicle_synthetic__txt">차량 <i id="total_cnt">0</i>대</p>
                    </div>
                    <div>
                        <p class="vehicle_synthetic__ttl">차량가격</p>
                        <div class="vehicle_all_price"><i id="all_price">0</i><span>원 (<i id="all_price_baht">0</i>바트)</span></div>
                        </div>
                    <div class="vehicle_minus">
                        <span class="minus_ico"></span>
                    </div>
                    <div>
                        <p class="vehicle_synthetic__ttl">할인</p>
                        <div class="vehicle_all_price">0<span>원 (0바트)</span></div>
                    </div>
                    <div class="vehicle_equal">
                        <span class="equal_ico"></span>
                    </div>
                    <div>
                        <p class="vehicle_synthetic__ttl">결제예정금액</p>
                        <div class="vehicle_price"><i id="final_price">0</i><span>원 (<i id="final_price_baht">0</i>바트)</span></div>
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
                            <!-- <p>- 국제선 항공요금 및 각종 TAX 및 유류할증료 (항공불포함 제외)</p>
                            <p>&nbsp; <font color="red">비지니스 이용을 원하실 경우 담당자에게 문의해주세요.</font>
                            </p>
                            <p>- 전일정 4성급 호텔 및 식사 (불포함 표기 식사 제외)</p>
                            <p>&nbsp; <font color="red">호텔 업그레이드를 원하시는 경우 담당자에게 문의해주세요.</font>
                            </p>
                            <p>- 전일정 전용차량 및 입장료 (자유일정 제외)<br>- 여행자 보험&nbsp;</p>
                            <p>
                                <font color="black">&nbsp;</font>
                            </p> -->
                            <?=viewSQ(getPolicy(16))?>
                        </div>
                    </div>
                    <div class="no_include_box chk_info">
                        <p class="sub_label"> <i></i> 불포함사항</p>
                        <div class="txt_box">
                            <!-- <p>- 더투어랩는 가이드 팁 대신 책 (신간) 을 받습니다.</p>
                            <p>&nbsp; 장르 상관없이 1인당 책 1권만 가지고 오시면 되며, 호주 내 한인 도서관에 기증됩니다.</p>
                            <p>- 불포함 표기 식사 및 자유일정</p>
                            <p>
                                <font color="black">- 호주 ETA 비자 : AustralianETA 모바일 앱을 통해 직접 신청</font>
                            </p>
                            <p>- 기타 개인 경비 (물값, 자유시간 시 개인비용 등)</p>
                            <p>※ 호주 화폐로 준비해주시기 바랍니다.</p> -->
                            <?=viewSQ(getPolicy(17))?>

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
                    <!-- <ul>
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
                    </ul> -->
                    <?=viewSQ(getPolicy(18))?>
                </div>
            </section>
            <section class="section_vehicle_2_7">
                <div class="section_vehicle_2_7__head">
                    <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                        예약자 정보입력
                    </div>
                </div>
                <div class="section_vehicle_2_7__body">
                    <form action="/vehicle-guide/vehicle-order" name="frmCar" id="frmCar" method="post">
                        <input type="hidden" name="parent_code" id="parent_code" value="<?=$parent_code?>">
                        <input type="hidden" name="product_code" id="product_code" value="<?=$first_code_no?>">
                        <input type="hidden" name="product_arr" id="product_arr" value="">
                        <input type="hidden" name="product_cnt_arr" id="product_cnt_arr" value="">
                        <input type="hidden" name="departure_area" id="departure_area" value="">
                        <input type="hidden" name="destination_area" id="destination_area" value="">
                        <input type="hidden" name="meeting_date" id="meeting_date" value="">
                        <input type="hidden" name="adult_cnt" id="adult_cnt" value="">
                        <input type="hidden" name="child_cnt" id="child_cnt" value="">
                        <input type="hidden" name="inital_price" id="inital_price" value="">
                        <input type="hidden" name="order_price" id="order_price" value="">
                        <table>
                            <colgroup>
                                <col width="150px" >
                                <col width="*" >
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>미팅 시간</th>
                                    <td>
                                        <div class="meeting_time">
                                            <span class="meeting_time__date">2024-06-28(금)</span>
                                            <select name="hours" id="hours">
                                            <?php
                                                for ($i = 0; $i < 24; $i++) {
                                                    $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            ?>
                                                <option value="<?= $hour ?>"><?= $hour ?></option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                            <label for="hours">시</label>
                                            <select name="minutes" id="minutes">
                                            <?php
                                                for ($i = 0; $i < 60; $i++) {
                                                    $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            ?>
                                                <option value="<?= $minute ?>"><?= $minute ?></option>
                                            <?php
                                                }
                                            ?>
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
                                            <span class="departure_name"></span>
                                            <input type="text" name="departure_hotel" placeholder="호텔명을 영어로 적어주세요(주소불가)">
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
                                            <span class="destination_name"></span>
                                            <input type="text" name="destination_hotel" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>기타요철</th>
                                    <td>
                                        <textarea name="order_memo" id="order_memo" class="other_irregularities"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>전화번호*</th>
                                    <td>
                                        <div class="phone_number">
                                            <select name="phone1" id="phone1">
                                                <option value="010">010</option>
                                                <option value="011">011</option>
                                            </select>
                                            <input type="text" name="phone2" id="phone2" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="4">
                                            <input type="text" name="phone3" id="phone3" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="4">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>이메일*</th>
                                    <td>
                                        <div class="contact_email">
                                            <input type="text" name="email_name" id="email_name">
                                            <span>@</span>
                                            <input type="text" name="email_host" id="email_host" value="gmail.com" disabled>
                                            <select id="select_email">
                                                <option value="gmail.com">gmail.com</option>
                                                <option value="naver.com">naver.com</option>
                                                <option value="kakao.com">kakao.com</option>
                                                <option value="hanmail.com">hanmail.com</option>
                                                <option value="nate.com">nate.com</option>
                                                <option value="yahoo.com">yahoo.com</option>
                                                <option value="hotmail.com">hotmail.com</option>
                                                <option value="chol.com">chol.com</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="section_vehicle_2_7__btn_wrap">
                            <button class="btn_add_cart" onclick="window.location.href='/cart/item-list/123'">
                                장바구니담기
                            </button>
                            <!-- <button class="btn_submit" onclick="window.location.href='/product/completed-order'">
                                상품 예약하기
                            </button> -->
                            <button class="btn_submit" type="button">
                                상품 예약하기
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>
<section class="popup_section">
<div class="popup_wrap place_pop place_chosen__start_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>출발지역</h2>
                    </div>
                </div>
                <div class="popup_place__body">
                    <ul class="popup_place__list">
                        <?php foreach ($place_start_list as $key => $place) : ?>
                            <li data-code="<?=$place['code_no']?>"><span><?= $place['code_name'] ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>
<div class="popup_wrap place_pop place_chosen__end_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>도착지역</h2>
                    </div>
                </div>
                <div class="popup_place__body">
                    <ul class="popup_place__list">
                        <?php foreach ($place_end_list as $key => $place) : ?>
                            <li data-code="<?=$place['code_no']?>"><span><?= $place['code_name'] ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<div class="popup_wrap place_pop policy_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>취소 규정</h2>
                    </div>
                </div>
                <div class="popup_place__body">
                    <?=viewSQ(getPolicy(19))?>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

</section>

<script>
    $("#select_email").on("change", function() {
        let email_host = $(this).val();
        $("#email_host").val(email_host);
    });

    $(".place_chosen__start_pop .popup_place__list li").on("click", function(){
        let code = $(this).data("code");
        let place = $(this).find("span").text();
        $(this).find("span").addClass("active");
        $(this).siblings().find("span").removeClass("active");
        $("#departure_area").val(code);
        $(".departure_name").text(place);
        $(".place_chosen__start_pop").hide();
        handleFetch();
    });

    $(".place_chosen__end_pop .popup_place__list li").on("click", function(){
        let code = $(this).data("code");
        let place = $(this).find("span").text();
        $(this).find("span").addClass("active");
        $(this).siblings().find("span").removeClass("active");
        $("#destination_area").val(code);
        $(".destination_name").text(place);
        $(".place_chosen__end_pop").hide();
        handleFetch();
    });

    function renderPrdList(products, code_no) {
        let product_list = "";

        for(let i = 0; i < products.length; i++){
            let img = "";
            if(products[i]["ufile1"]){
                img = '/data/cars/' + products[i]["ufile1"];
            }else{
                img = '/data/product/noimg.png';
            }
            const options = products[i]["options"].map((option, index) => {
                let html = "";
                let icons = option.icons.map(icon => `<img src="/data/code/${icon}" alt="">`).join('');
                if(index % 2 == 0) {
                    html += `
                    <tr>
                        <td class="">${icons}</td>
                        <td class="vehicle_info__item">${option.c_op_name}</td>`;
                }
                if(index % 2 == 1) {
                    html += `
                        <td class="vehicle_info__item">또는</td>
                        <td class="">${icons}</td>
                        <td class="vehicle_info__item">${option.c_op_name}</td>
                    </tr>
                    `;
                }
                return html;
            }).join('');

            const minium_people_cnt = Number(products[i]["minium_people_cnt"]) ?? 0;
            const total_people_cnt = Number(products[i]["total_people_cnt"]) ?? 0;
            let vehicle_select =  $(`#product_vehicle_list_selected tr.product_${products[i]["cs_idx"]}`);

            const cnt_options = Array(total_people_cnt - minium_people_cnt + 1).fill(1).map((_, index) => {
                const cnt = minium_people_cnt + index;
                let selected = "";
                if(vehicle_select && vehicle_select.data("cnt") == cnt){
                    selected = "selected";
                }
                return `<option value="${cnt}" ${selected}>${cnt}대</option>`
            }).join('');

            const price_str = Math.round(products[i]["car_price"]);

            const price_baht_str = Math.round(products[i]["car_price_baht"]);

            let product_arr = $("#product_arr").val().split(",").filter(Boolean);

            product_list += 
            `<tr class="product_${products[i]["cs_idx"]}" data-price="${price_str}" data-price_baht="${price_baht_str}" data-code="${code_no}">
                <td>
                    <div class="vehicle_image">
                        <div class="img_box img_box_15">
                            <img src="${img}" alt="${products[i]["rfile1"]}">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="vehicle_info">
                        <h4 class="vehicle_info__name">
                            ${products[i]["product_name"]}
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
                                ${options}
                            </tbody>
                        </table>
                    </div>
                </td>
                <td>
                    <div class="vehicle_price">
                        ${price_str.toLocaleString('ko-KR')}<span>원 (${price_baht_str.toLocaleString('ko-KR')}바트)</span>
                    </div>
                    <div class="vehicle_options">
                        <label class="vehicle_options__label__vehicle_cnt" for="vehicle_cnt">차량수량</label>
                        <select name="" id="vehicle_cnt_${products[i]["cs_idx"]}" data-id="${products[i]["cs_idx"]}" class="vehicle_options__select vehicle_cnt" onchange="handleSelectNumber(this)">
                            ${cnt_options}
                        </select>
                        <input type="hidden" id="minium_people_cnt_${products[i]["cs_idx"]}" value="${minium_people_cnt}">
                        <input type="hidden" id="total_people_cnt_${products[i]["cs_idx"]}" value="${total_people_cnt}">
                        <input type="checkbox" id="vehicle_prd_${products[i]["cs_idx"]}" data-id="${products[i]["cs_idx"]}" name="" 
                            ${product_arr.includes(products[i]["cs_idx"]) ? "checked" : ""} onchange="handleSelectVehicle(this)">
                        <label class="vehicle_options__label__vehicle_prd" for="vehicle_prd_${products[i]["cs_idx"]}"></label>
                        <button>상품담기</button>
                    </div>
                </td>
            </tr>`;
        }

        $("#product_vehicle_list").html(product_list);
        
    }
    function handleFetch() {
        let child_code = $(".section_vehicle_2_2__airport input[type='radio']:checked").val();
        let code_no = $(".section_vehicle_2_2__head__tabs li.active").data("code");
        let departure_code = $("#departure_area").val();
        let destination_code = $("#destination_area").val();


        $.ajax({
            url: '/filter-child-vehicle',
            type: "POST",
            data: { departure_code, destination_code, child_code },
            async: false,
            cache: false,
            success: function (data, textStatus) {
                
                renderPrdList(data.products, code_no);
                $("#product_code").val(child_code);

            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }
    function filter() {
        let departure_code = $("#departure_area").val();
        let destination_code = $("#destination_area").val();
        let code_no = $(".section_vehicle_2_2__head__tabs li.active").data("code");

        $.ajax({
            url: '/filter-vehicle',
            type: "POST",
            data: { departure_code, destination_code, code_no },
            async: false,
            cache: false,
            success: function (data, textStatus) {

                let product_list = "";
                let code_list = "";
                let child_codes = data.child_codes;
                let products = data.products;

                for(let i = 0; i < child_codes.length; i++){
                    code_list += 
                    `
                        <span>
                            <input ${i == 0 ? 'checked' : ''} type="radio" id="airport${i}" name="airport" value="${child_codes[i]["code_no"]}">
                            <label for="airport${i}">${child_codes[i]["code_name"]}</label>
                        </span>
                    `;
                }

                $(".section_vehicle_2_2__airport").html(code_list);

                renderPrdList(products, code_no);

                $(".section_vehicle_2_2__airport input[type='radio']").on("change", handleFetch);

                let child_code = $(".section_vehicle_2_2__airport input[type='radio']:checked").val();
                $("#product_code").val(child_code);

            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    filter();

    function calculatePrice() {
        let totalPrice = 0;
        let totalPriceBaht = 0;
        let totalCnt = 0;
        let arr_cnt = [];
        $("#product_vehicle_list_selected > tr").each(function() {
            
            const price = Number($(this).data("price")) ?? 0;
            const price_baht = Number($(this).data("price_baht")) ?? 0;
            const cnt = Number($(this).data("cnt")) ?? 0;

            totalPrice += price * cnt;
            totalPriceBaht += price_baht * cnt;
            totalCnt += cnt;
            arr_cnt.push(cnt);
        });

        $("#inital_price").val(totalPrice);
        $("#order_price").val(totalPrice);
        $("#product_cnt_arr").val(arr_cnt.join(","));
        $("#total_cnt").text(totalCnt);
        $("#all_price").text(totalPrice.toLocaleString('ko-KR'));
        $("#all_price_baht").text(totalPriceBaht.toLocaleString('ko-KR'));
        $("#final_price").text(totalPrice.toLocaleString('ko-KR'));
        $("#final_price_baht").text(totalPriceBaht.toLocaleString('ko-KR'));
    }

    var previousValue;

    function handleSelectNumber(e){
        let id = $(e).data("id");
        let cnt = $(e).val();

        if(Number(cnt) === 0){
            alert("0보다 큰 수량을 선택하세요.");
            $(e).val(previousValue);
            return false;
        }

        previousValue = cnt;

        $(`#product_vehicle_list_selected tr.product_${id}`).data("cnt", cnt);
        calculatePrice();
    }

    function handleSelectVehicle(e) {

        let code_no = $("#product_code").val();
        let id = $(e).data("id");
        let current_code = $(`#product_vehicle_list tr.product_${id}`).data("code");

        const min_cnt = Number($(`#minium_people_cnt_${id}`).val());
        const max_cnt = Number($(`#total_people_cnt_${id}`).val());
        let cnt = Number($(`#product_vehicle_list tr.product_${id}`).find("select.vehicle_cnt").val());

        if(max_cnt - min_cnt <= 0) {
            alert("제품 수량이 충분하지 않습니다.");
            $(e).prop("checked", false);
            return false;
        }

        if(cnt === 0){
            alert("0보다 큰 수량을 선택하세요.");
            $(e).prop("checked", false);
            return false;
        }

        if(current_code != code_no && code_no){
            $("#product_arr").val("");
            $("#product_vehicle_list_selected").empty();
            $("#product_code").val(current_code);
        }

        let product_arr = $("#product_arr").val().split(",").filter(Boolean);

        if($(e).is(":checked")) {

            if(!product_arr.includes(id)){
                const $tr = $(`#product_vehicle_list tr.product_${id}`).clone();
                $tr.find(".vehicle_options").hide();
                $tr.find("button").attr("disabled", true);
                $tr.data("cnt", $(`#product_vehicle_list tr.product_${id}`).find("select.vehicle_cnt").val());
                $("#product_vehicle_list_selected").append($tr);
    
                product_arr.push(id);
            }
            
        } else {   
            console.log(product_arr);
            
            $(`#product_vehicle_list_selected .product_${id}`).remove();
            const index = product_arr.map(String).indexOf(String(id));
            if (index !== -1) {
                product_arr.splice(index, 1);
            }
            // product_arr.splice(product_arr.indexOf(id), 1);
        }
        $("#product_arr").val(product_arr.join(","));

        console.log(id);
        console.log(product_arr);

        calculatePrice();
    }

    $(".section_vehicle_2_2__head__tabs li").on("click", function() {
        $(this).addClass("active").siblings().removeClass("active");
        filter(); 
    });

    
    $(".section_vehicle_2_2__airport input[type='radio']").on("change", handleFetch);
</script>

<script>
    function closePopup() {
        $(".popup_wrap").hide();
        $(".dim").hide();
    }
    $("#place_chosen__start").on("click", function() {
        $(".place_chosen__start_pop, .place_chosen__start_pop .dim").show();
    });
    $("#place_chosen__end").on("click", function() {
        $(".place_chosen__end_pop, .place_chosen__end_pop .dim").show();
    });
    $(".vehicle_ttl__link").on("click", function() {
        $(".policy_pop, .policy_pop .dim").show();
    });
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function(dateText, inst) {
            var date = $(this).datepicker('getDate');
            const year = String(date.getFullYear()).slice(-2);
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const dayOfWeek = daysOfWeek[date.getDay()];

            $("#departure_date_text").text(`${year}.${month}.${day}(${dayOfWeek})`);
            $(".meeting_time__date").text(`${date.getFullYear()}-${month}-${day}(${dayOfWeek})`);
            $("#meeting_date").val(`${date.getFullYear()}-${month}-${day}`);
        }
    });
    $("#place_chosen__people").on("click", function() {
        $(".place_chosen__people_pop").toggle();
    });
    $(".btn_minus").on("click", function() {
        const val = Number($(this).parent().find("input").val()) || 1;
        if(val === 1) {
            $(this).attr("disabled", true);
        }
        if(val > 0) {
            $(this).parent().find("input").val(val - 1);
        }
    });
    $(".btn_plus").on("click", function() {
        const val = Number($(this).parent().find("input").val()) || 1;
        $(this).parent().find("input").val(val + 1);
        $(this).parent().find(".btn_minus").attr("disabled", false);
    });
    $("#btn_pickup_people").on("click", function() {
        $(".pickup_amount__num").each(function() {
            const name = $(this).attr("name");
            $("#people_" + name).text($(this).val());
            $("#" + name).val($(this).val());
        })
        $(".place_chosen__people_pop").hide();
    });

    $(".btn_submit").on("click", function() {

        <?php
            if (empty(session()->get("member")["id"])) {
        ?>
            alert("주문하시려면 로그인해주세요");
            return false;
        <?php
            }
        ?>

        var frm = document.frmCar;

        if(frm.departure_area.value == ""){
            alert("출발지역 선택해주세요!");
            return false;
        }

        if(frm.destination_area.value == ""){
            alert("출발지역 선택해주세요!");
            return false;
        }

        if(frm.departure_area.value == frm.destination_area.value) {
            alert("동일하지 않은 출발지와 도착지를 선택하세요.");
            return false;
        }

        if(!frm.adult_cnt.value) {
            alert("소아 선택해주세요!");
            return false;
        }

        if(frm.product_arr.value == ""){
            alert("제품을 선택해주세요!");
            return false;
        }

        if(frm.phone1.value == "" || frm.phone2.value == "" || frm.phone3.value == ""){
            alert("전화번호 입력해주세요!");
            return false;
        }

        if(frm.email_name.value == "" || frm.email_host.value == ""){
            alert("이메일 입력해주세요!");
            return false;
        }

        $.ajax({
            url: "/vehicle-guide/vehicle-order",
            type: "POST",
            data: $("#frmCar").serialize(),
            error: function (request, status, error) {
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            }
            , success: function (response, status, request) {
                if (response.result == true) {
                    alert(response.message);
                    window.location.href = '/product/completed-order';
                } else {
                    alert(response.message);
                }
            }
        });
        
    });
</script>

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
    document.getElementById('autoplay-button')?.addEventListener('click', function () {
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