<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/travel/sub_travel.css" type="text/css">
<link rel="stylesheet" href="/css/travel/sub_travel_responsive.css" type="text/css">

<main>
    <section class="main_visual travel">
        <div class="inner">
            <div class="top">
                <h3>우리에게 딱 맞춰서 프라이빗하게!</h3>
                <p class="ttl"><span>호주</span> 단독 가이드 <br class="only_web">
                    맞춤여행</p>
            </div>
        </div>
    </section>

    <section class="travel_info">
        <div class="inner">
            <p class="top_ttl">
                여행자 기본정보
            </p>

            <form action="./inquiry_ok.php" id="reg_mem_fm" name="reg_mem_fm" enctype="multipart/form-data"
                method="post">
                <input type="hidden" name="user_id" value="<?= $_SESSION['member']['mIdx'] ?>">
                <table class="table_form">
                    <colgroup>
                        <col width="125px" />
                        <col width="*" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>여행 인원*</th>
                            <td>
                                <div class="quantily flex">
                                    <div class="option flex__c">
                                        <span>성인</span>
                                        <div>
                                            <input type="text" class="bs-input" name="travel_person1"
                                                oninput="limitInput(this, 3)" maxlength="3" id="travel_person1"
                                                placeholder="0">
                                            <span>명</span>
                                        </div>
                                    </div>
                                    <div class="option flex__c">
                                        <span>어린이</span>
                                        <div>
                                            <input type="text" class="bs-input" name="travel_person2"
                                                oninput="limitInput(this, 3)" maxlength="3" id="travel_person2"
                                                placeholder="0">
                                            <span>명</span>
                                        </div>
                                    </div>
                                    <div class="option flex__c">
                                        <span>유아</span>
                                        <div>
                                            <input type="text" class="bs-input" name="travel_person3"
                                                oninput="limitInput(this, 3)" maxlength="3" id="travel_person3"
                                                placeholder="0">
                                            <span>명</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="noti_red">
                                    ※ 어린이는 만 12세 미만,유아는 2세(24개월) 미만입니다.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>여행자 성함*</th>
                            <td>
                                <div class="tra_name flex">
                                    <input type="text" class="bs-input" name="user_name_kor" id="user_name_kor"
                                        placeholder="한글이름">
                                    <input type="text" class="bs-input" name="user_name_eng" id="user_name_eng"
                                        placeholder="영문이름">
                                </div>
                                <p class="noti_red">
                                    ※ 영문명은 반드시 여권과 동일해야 합니다
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>생년월일</th>
                            <td>
                                <div class="departure_date">
                                    <div class="flex__c">
                                        <input type="text" class="bs-input date_pic_y_chg" name="birthday"
                                            placeholder="0000-00-00" readonly>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>전화번호*</th>
                            <td>
                                <div class="phone flex">
                                    <select id="phone_1" class="bs-select" name="phone_1">
                                        <option value=""></option>
                                        <option value="010" selected>010</option>
                                        <option value="011">011</option>
                                        <option value="013">013</option>
                                        <option value="016">016</option>
                                        <option value="017">017</option>
                                        <option value="018">018</option>
                                        <option value="019">019</option>
                                    </select>
                                    <input type="tel" id="phone_2" oninput="limitInput(this, 4)" class="s_input"
                                        name="phone_2" maxlength="4" numberonly="true">
                                    <input type="tel" id="phone_3" oninput="limitInput(this, 4)" class="s_input"
                                        name="phone_3" maxlength="4" numberonly="true">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>이메일*</th>
                            <td>
                                <div class="email flex__c">
                                    <input type="text" class="bs-input" name="user_email1" id="user_email1" value="">
                                    <span>@</span>
                                    <input type="text" class="bs-input" id="user_email_2" name="user_email2">
                                    <select id="user_email_2_select" class="bs-select">
                                        <option value="">선택</option>
                                        <option value="naver.com">naver.com</option>
                                        <option value="hanmail.net">hanmail.net</option>
                                        <option value="hotmail.com">hotmail.com</option>
                                        <option value="nate.com">nate.com</option>
                                        <option value="yahoo.co.kr">yahoo.co.kr</option>
                                        <option value="empas.com">empas.com</option>
                                        <option value="dreamwiz.com">dreamwiz.com</option>
                                        <option value="freechal.com">freechal.com</option>
                                        <option value="lycos.co.kr">lycos.co.kr</option>
                                        <option value="korea.com">korea.com</option>
                                        <option value="gmail.com">gmail.com</option>
                                        <option value="hanmir.com">hanmir.com</option>
                                        <option value="paran.com">paran.com</option>
                                        <option value="custom">직접입력</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <script>
                    $("#user_email_2_select").on("change", (event) => {
                        if ($(event.target).val() === "custom") {
                            $(event.target).siblings('#user_email_2').attr("disabled", false);
                            $(event.target).siblings('#user_email_2').val("");
                        } else {
                            $(event.target).siblings('#user_email_2').val($(event.target).val())
                            $(event.target).siblings('#user_email_2').attr("disabled", true);
                        }
                    })
                </script>
                <button class="btn_add flex__c" type="button" id="btn_add_compa">
                    + 동반자 정보 추가
                </button>
                <div id="name_per_travel">

                </div>
                <p class="title">여행 정보</p>
                <table class="table_form info">
                    <colgroup>
                        <col width="170px" />
                        <col width="*" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>여행목적</th>
                            <td>
                                <div class="purpose flex">
                                    <div class="radio_item">
                                        <input type="radio" name="travel_purpose" value="허니문" id="pur_01">
                                        <label for="pur_01">허니문</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="travel_purpose" value="가족여행" id="pur_02">
                                        <label for="pur_02">가족여행</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="travel_purpose" value="친목여행" id="pur_03">
                                        <label for="pur_03">친목여행</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="travel_purpose" value="골프여행" id="pur_04">
                                        <label for="pur_04">골프여행</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="travel_purpose" value="단체여행" id="pur_05">
                                        <label for="pur_05">단체여행</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="travel_purpose" value="기타" id="pur_06">
                                        <label for="pur_06">기타</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>여행자 유형</th>
                            <td>
                                <div class="purpose type flex">
                                    <div class="radio_item">
                                        <input type="radio" name="travel_type" value="가이드 일정" id="type_01">
                                        <label for="type_01">가이드 일정</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="travel_type" value="가이드 + 자유일정" id="type_02">
                                        <label for="type_02">가이드 + 자유일정 </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>희망 출발일~ 귀국일</th>
                            <td>
                                <div class="depart flex__c">
                                    <div class="departure_date flex__c">
                                        <input type="text" class="bs-input date_pic_y_chg" id="departure_date"
                                            name="departure_date" placeholder="0000-00-00" class="date_pic" readonly>
                                    </div>
                                    <div>
                                        <span>~</span>
                                    </div>
                                    <div class="departure_date flex__c">
                                        <input type="text" class="bs-input date_pic_y_chg" id="arrival_date"
                                            name="arrival_date" placeholder="0000-00-00" class="date_pic" readonly>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>계획중인 여행지역</th>
                            <td>
                                <textarea class="bs-input" name="planned_travel_area" id="planned_travel_area"
                                    rows="8"></textarea>
                                <p class="noti_red">※ 예) 인천 - 시드니(2박) - 골드코스트(2박) - 인천</p>
                            </td>
                        </tr>
                        <tr>
                            <th>1인당 예산</th>
                            <td>
                                <div class="person flex">
                                    <div class="radio_item">
                                        <input type="radio" name="one_charge" value="100~200만원" id="per_01">
                                        <label for="per_01">100~200만원</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="one_charge" value="200~300만원" id="per_02">
                                        <label for="per_02">200~300만원</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="one_charge" value="300~400만원" id="per_03">
                                        <label for="per_03">300~400만원</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="one_charge" value="400~500만원" id="per_04">
                                        <label for="per_04">400~500만원</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="one_charge" value="500만원 이상 또는 무관" id="per_05">
                                        <label for="per_05">500만원 이상 또는 무관</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="title">항공권 정보</p>
                <table class="table_form flight">
                    <colgroup>
                        <col width="170px" />
                        <col width="*" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>
                                <div class="ticket">
                                    <p class="ticket_ttl">
                                        항공권 소지여부
                                    </p>
                                    <div class="tick_ch flex">
                                        <div class="radio_item">
                                            <input type="radio" value="Y" name="air_yn" id="tic_01" checked>
                                            <label for="tic_01">소지하고 있습니다. </label>
                                        </div>
                                        <div class="radio_item">
                                            <input type="radio" value="N" name="air_yn" id="tic_02">
                                            <label for="tic_02">소지하고 있지 않습니다.</label>
                                        </div>
                                    </div>
                                    <div class="tic_form on">
                                        <div class="ticket_ttl">
                                            소지하신 항공스케쥴 (출도착 항공편명/날짜/시간/지역)
                                        </div>
                                        <div class="tick_area">
                                            <textarea class="bs-input" name="flight_schedule" id="flight_schedule"
                                                rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="tic_form">
                                        <div class="ticket_ttl">
                                            소지하신 항공스케쥴 (출도착 항공편명/날짜/시간/지역)
                                        </div>
                                        <div class="tic_choise flex">
                                            <div class="radio_item">
                                                <input type="radio" name="hope_air_type" value="직항" id="choise_01">
                                                <label for="choise_01">직항</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" name="hope_air_type" value="경유" id="choise_02">
                                                <label for="choise_02">경유</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" name="hope_air_type" value="무관" id="choise_03">
                                                <label for="choise_03">무관</label>
                                            </div>
                                        </div>
                                        <div class="ticket_ttl">
                                            좌석등급
                                        </div>
                                        <div class="tic_seat flex">
                                            <div class="radio_item">
                                                <input type="radio" name="hope_air_class" value="이코노미" id="seat_01">
                                                <label for="seat_01">이코노미</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" name="hope_air_class" value="비즈니스" id="seat_02">
                                                <label for="seat_02">비즈니스</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" name="hope_air_class" value="퍼스트" id="seat_03">
                                                <label for="seat_03">퍼스트</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" name="hope_air_class" value="마일리지 승급" id="seat_04">
                                                <label for="seat_04">마일리지 승급</label>
                                            </div>
                                        </div>
                                        <p class="noti_red">
                                            ※ 마일리지 업그레이드는 가능하나 마일리지 좌석 구매는 항공사 직접 개별적으로 진행하셔야 합니다.
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <!-- <th>그 외 사항*</th> -->
                            <td>
                                <div class="matter flex">
                                    <div class="left flex__c">
                                        <p class="txt">그 외 사항</p>
                                    </div>
                                    <textarea class="bs-input" name="air_other_matters" id="air_other_matters"
                                        rows="8"></textarea>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="title">숙박 정보</p>
                <table class="table_form">
                    <colgroup>
                        <col width="170px" />
                        <col width="*" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>선호 숙소</th>
                            <td>
                                <div class="accom flex">
                                    <div class="radio_item">
                                        <input type="radio" value="아파트먼트" name="sel_hotel" id="accom_01">
                                        <label for="accom_01">아파트먼트</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" value="호텔" name="sel_hotel" id="accom_02">
                                        <label for="accom_02">호텔</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" value="리조트" name="sel_hotel" id="accom_03">
                                        <label for="accom_03">리조트</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" value="무관" name="sel_hotel" id="accom_04">
                                        <label for="accom_04">무관</label>
                                    </div>
                                </div>
                                <p class="noti_red">※ 백패커, 게스트하우스, 민박, 에어비앤비는 불가합니다.</p>
                            </td>
                        </tr>
                        <tr>
                            <th>선호 등급</th>
                            <td>
                                <div class="level flex">
                                    <div class="radio_item">
                                        <input type="radio" name="hotel" value="3성급" id="level_01">
                                        <label for="level_01">3성급</label>
                                    </div>


                                    <div class="radio_item">
                                        <input type="radio" name="hotel" value="4성급" id="level_02">
                                        <label for="level_02">4성급</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="hotel" value="5성급" id="level_03">
                                        <label for="level_03">5성급</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="hotel" value="필요없음" id="level_04">
                                        <label for="level_04">필요없음</label>
                                    </div>
                                    <div class="radio_item">
                                        <input type="radio" name="hotel" value="기타" id="level_05">
                                        <label for="level_05">기타</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>그 외 사항</th>
                            <td><textarea class="bs-input" name="accom_other_master" id="" rows="8"></textarea></td>
                        </tr>
                    </tbody>

                </table>

                <p class="title">기타사항</p>
                <table class="table_form">
                    <colgroup>
                        <col width="170px" />
                        <col width="*" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>기타 요청사항</th>
                            <td><textarea class="bs-input" name="other_requests" id="other_requests"
                                    rows="8"></textarea></td>
                        </tr>
                        <tr>
                            <th>방문경로</th>
                            <td>
                                <div class="visit flex">
                                    <div class="ch_visit agr_1">
                                        <input type="checkbox" id="agree1" class="agree" name="visit_route"
                                            value="네이버 검색">
                                        <label for="agree1">네이버 검색</label>
                                    </div>
                                    <div class="ch_visit agr_2">
                                        <input type="checkbox" id="agree2" class="agree" name="visit_route"
                                            value="구글 검색">
                                        <label for="agree2">구글 검색</label>
                                    </div>
                                    <div class="ch_visit agr_3">
                                        <input type="checkbox" id="agree3" class="agree" name="visit_route"
                                            value="다음 검색">
                                        <label for="agree3">다음 검색</label>
                                    </div>
                                    <div class="ch_visit agr_4">
                                        <input type="checkbox" id="agree4" class="agree" name="visit_route"
                                            value="페이스북">
                                        <label for="agree4">페이스북</label>
                                    </div>
                                    <div class="ch_visit agr_5">
                                        <input type="checkbox" id="agree5" class="agree" name="visit_route"
                                            value="인스타그램">
                                        <label for="agree5">인스타그램</label>
                                    </div>
                                    <div class="ch_visit agr_6">
                                        <input type="checkbox" id="agree6" class="agree" name="visit_route"
                                            value="배너 광고">
                                        <label for="agree6">배너 광고</label>
                                    </div>
                                    <div class="ch_visit agr_7">
                                        <input type="checkbox" id="agree7" class="agree" name="visit_route"
                                            value="하이호주 블로그">
                                        <label for="agree7">하이호주 블로그</label>
                                    </div>
                                    <div class="ch_visit agr_8">
                                        <input type="checkbox" id="agree8" class="agree" name="visit_route"
                                            value="뉴스기사">
                                        <label for="agree8">뉴스기사</label>
                                    </div>
                                    <div class="ch_visit agr_9">
                                        <input type="checkbox" id="agree9" class="agree" name="visit_route"
                                            value="지인소개">
                                        <label for="agree9">지인소개</label>
                                    </div>
                                    <div class="ch_visit agr_10">
                                        <input type="checkbox" id="agree10" class="agree" name="visit_route" value="기타">
                                        <label for="agree10">기타</label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?
                        if ($_SESSION["member"]["idx"] == "") {
                            ?>
                            <tr>
                                <th>비민번호</th>
                                <td>
                                    <div class="accom flex">
                                        <div class="radio_item">
                                            <input type="text" name="passwd" id="passwd">
                                        </div>
                                    </div>
                                    <p class="noti_red">※ 비밀번호 입력하지 않으면 고객님의 전화번호 마지막 4자리를 자동으로 입력합니다.</p>
                                </td>
                            </tr>
                        <?
                        }
                        ?>
                    </tbody>
                </table>
                <div class="flex_box_cap">

                <img src="" alt="captcha" id="cap_re" loading="lazy">
                <div class="spinner" id="spinner_load"></div>


                <input type="hidden" value="" id="hidden_captcha" />


                <button class="re_btn" type="button" onclick="reloadCaptcha()">
                    <img class="re_cap" src="../assets/img/reload.png" alt="">
                    <p>새로고침</p>
                </button>


                <div class="input-wrapper">
                    <input class="captcha_input" id="captcha_input" type="text" name="captcha">
                    <label for="captcha_input" class="placeholder-text">보안 문자 입력</label>
                </div>

                </div>
                <input type="hidden" name="visit_routes" id="visit_routes">
                <input type="hidden" name="user_email" id="user_email">
                <input type="hidden" name="user_phone" id="user_phone">
            </form>
           
            <div class="btn_submit flex__c c_flex_custom">
                <a href="/t-travel/item_list.php" type="button" class="btn" id="">목록보기</a>
                <button type="button" class="btn blue" id="btn_submit_inquiry">견적 요청하기</button>
            </div>
        </div>
    </section>
</main>

<script>
    var input = document.getElementById('captcha_input');
    var placeholder = document.querySelector('.placeholder-text');

    input.addEventListener('input', function () {
        if (input.value) {
            placeholder.classList.add('hide-placeholder');
        } else {
            placeholder.classList.remove('hide-placeholder');
        }
    });

    if (input.value) {
        placeholder.classList.add('hide-placeholder');
    }
</script>
<script>

    document.getElementById('cap_re').style.opacity = "0"
    function reloadCaptcha() {
        $.ajax({
            url: '/tools/generate_captcha',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                document.getElementById('cap_re').src = data.captcha_image;
                document.getElementById('hidden_captcha').value = data.captcha_value;
                document.getElementById('spinner_load').style.display = "none"
                document.getElementById('cap_re').style.opacity = "1"
            }
        })
    }

    reloadCaptcha(); 
</script>

<script type="text/javascript">


    const currentYear = (new Date()).getFullYear();
    const datePickerConfig = {
        closeText: '닫기',
        prevText: '이전달',
        nextText: '다음달',
        currentText: '오늘',
        monthNames: ['1월(JAN)', '2월(FEB)', '3월(MAR)', '4월(APR)', '5월(MAY)', '6월(JUN)',
            '7월(JUL)', '8월(AUG)', '9월(SEP)', '10월(OCT)', '11월(NOV)', '12월(DEC)'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월',
            '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        weekHeader: 'Wk',
        dateFormat: 'yy-mm-dd',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        showButtonPanel: true,
        showOn: 'button',
        buttonImageOnly: true,
        buttonImage: '/images/ico/datepicker_ico.png',
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:" + currentYear,
        yearSuffix: ''
    }

    $('.tick_ch input[type="radio"]').on('change', function () {
        var idx = $(this).parent().index();
        $('.ticket .tic_form').removeClass('on');
        $('.ticket .tic_form').eq(idx).addClass('on');
    })



    function limitInput(input, max) {
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value.length > max) {
            input.value = input.value.slice(0, max);
        }
    }

    function removePerson(element, length) {
        $(element).parent('.title').remove();
        $('.traveler' + length).remove();
    }

    function handleAddCompanion(event) {
        var total_per = 0;

        let per1 = Number($('#travel_person1').val());
        let per2 = Number($('#travel_person2').val());
        let per3 = Number($('#travel_person3').val());
        total_per = per1 + per2 + per3;
        // console.log(total_per);
        event.preventDefault();
        event.stopPropagation();

        const elements = $("#name_per_travel").find(".traveler");
        if (total_per != 0) {

            if (elements.length <= 0) {
                console.log(elements.length);
                const tableElement = `
                    <p class="title">
                        동반여행자  01
                        <i onclick="removePerson(this, 1)">삭제</i>
                    </p>
                    <table class="table_form traveler traveler1">
                        <colgroup>
                            <col width="125px" />
                            <col width="*" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>여행자 성함*</th>
                                <td>
                                    <div class="name_user flex">
                                        <input type="text" class="bs-input" name="user_name_kor_accom[]" class="user_name_kor_accom" placeholder="한글이름">
                                        <input type="text" class="bs-input" name="user_name_eng_accom[]" class="user_name_eng_accom" placeholder="영문이름">
                                    </div>
                                    <div class="noti_red">
                                        ※ 영문명은 반드시 여권과 동일해야 합니다
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>생년월일</th>
                                <td>
                                    <div class="departure_date">
                                        <div class="flex__c"><input type="text" class="bs-input date_pic_y_chg" name="birthday_accom[]" placeholder="0000-00-00"
                                                 readonly></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                `

                var scriptTag = document.createElement('script');
                const timeStamp = Date.now();
                scriptTag.innerHTML = `
                setTimeout(() => {
                    $("#datepicker1_${timeStamp}").datepicker(datePickerConfig).datepicker('widget').wrap('<div class="ll-skin-melon"/>');
                    $("#datepicker1_${timeStamp}").click(function() {
                    $(this).datepicker("show");
                    });
                }, 0);
                `;

                $('#name_per_travel').html(tableElement);

                const clonedElement = $("#name_per_travel").find(".traveler");
                clonedElement.find(".ui-datepicker-trigger").remove();
                clonedElement.find(".date_pic_y_chg").removeClass("hasDatepicker");

                clonedElement.find(".date_pic_y_chg").attr("id", `datepicker1_${timeStamp}`);

                clonedElement.after($(scriptTag));
            }
            else {
                console.log(elements.length);
                if (elements.length < total_per) {
                    const element = elements.last();
                    const clonedElement = element.clone();
                    clonedElement.removeClass();
                    clonedElement.addClass("traveler table_form");
                    clonedElement.addClass(`traveler${elements.length + 1}`);
                    clonedElement.find(".ui-datepicker-trigger").remove();
                    clonedElement.find("input.user_name_kor_accom").val('');
                    clonedElement.find("input.user_name_eng_accom").val('');
                    clonedElement.find("input.date_pic_y_chg").val('');
                    clonedElement.find(".date_pic_y_chg").removeClass("hasDatepicker");
                    clonedElement.find(".date_pic_y_chg").attr("id", `datepicker${elements.length + 1}`);

                    var scriptTag = document.createElement('script');

                    scriptTag.innerHTML = `
                    setTimeout(() => {
                        $("#datepicker${elements.length + 1}").datepicker(datePickerConfig).datepicker('widget').wrap('<div class="ll-skin-melon"/>');
                        $("#datepicker${elements.length + 1}").click(function() {
                        $(this).datepicker("show");
                        });
                    }, 0);
                    `;

                    element.after($(scriptTag));

                    element.after(clonedElement);
                    element.after(`
                        <p class="title" id="title${elements.length + 1}">
                            동반여행자  0${elements.length + 1}
                            <i onclick="removePerson(this, ${elements.length + 1})">삭제</i>
                        </p>
                    `);

                }
            }
        } else {
            alert("작성해주세요 여행 인원");
        }
    }



    document.getElementById("btn_add_compa").addEventListener("click", handleAddCompanion);
    $("#btn_submit_inquiry").on("click", function () {

        var total_per = 0;

        let per1 = Number($('#travel_person1').val());
        let per2 = Number($('#travel_person2').val());
        let per3 = Number($('#travel_person3').val());

        var captchaValue = $("#hidden_captcha").val();
        var userInputCaptcha = $("#captcha_input").val();
        total_per = per1 + per2 + per3;

        console.log(captchaValue, 'captchaValue')
        console.log(userInputCaptcha, 'userInputCaptcha')


        if ($("#travel_person1").val() == "" || Number($("#travel_person1").val()) == 0) {
            alert("이름을 입력해 해주세요.");
            $("#travel_person1").focus();
            return false;
        }


        if ($("#user_name_kor").val() == "") {
            alert("이름을 입력해 해주세요.");
            $("#user_name_kor").focus();
            return false;
        }

        if ($("#phone_1").val() == "") {
            alert("연락처를 입력해 해주세요.");
            $("#phone_1").focus();
            return false;
        }

        if ($("#phone_2").val() == "") {
            alert("연락처를 입력해 해주세요.");
            $("#phone_2").focus();
            return false;
        }

        if ($("#phone_3").val() == "") {
            alert("연락처를 입력해 해주세요.");
            $("#phone_3").focus();
            return false;
        }

        $("#user_phone").val($("#phone_1").val() + '-' + $("#phone_2").val() + '-' + $("#phone_3").val());

        if ($("#user_email1").val() == "") {
            alert("연락처를 입력해 해주세요.");
            $("#user_email1").focus();
            return false;
        }

        if ($("#user_email_2").val() == "") {
            alert("연락처를 입력해 해주세요.");
            $("#user_email_2").focus();
            return false;
        }

        if ($("#user_email1").val() && $("#user_email_2").val()) {
            $("#user_email").val($("#user_email1").val() + '@' + $("#user_email_2").val());
        }

        let user_name_kor_accom_missing = 0;

        for (let index = 1; index <= total_per; index++) {
            if ($(`.traveler${index}`).length > 0) {
                if ($(`.traveler${index} input.user_name_kor_accom`).val() == "") {
                    user_name_kor_accom_missing = index;
                    break;
                }
            }
        }

        if (user_name_kor_accom_missing) {
            alert("이름을 입력해 해주세요.");
            $(`.traveler${user_name_kor_accom_missing} input.user_name_kor_accom`).focus();
            return false;
        }
        if (userInputCaptcha !== captchaValue) {
            alert("보안문자 일치지않습니다.");
            $("#captcha_input").focus();
            reloadCaptcha();
            return false;
        }


        let selectedCheckboxes = [];

        $.each($("input[name='visit_route']:checked"), function () {
            selectedCheckboxes.push($(this).val());
        });

        $("input[name='visit_routes']").val(selectedCheckboxes.join(", "))

        $.ajax({
            url: "./inquiry_ok",
            type: "POST",
            data: $("#reg_mem_fm").serialize(),
            success: () => {
                alert("견적요청 신청되었습니다.");
                location.href = "/custom-travel/item_list";
            }
        })
    })
    $(document).ready(function () {
        $('.date_pic_y_chg').datepicker(datePickerConfig)
            .datepicker('widget').wrap('<div class="ll-skin-melon"/>');
        $(".date_pic_y_chg").click(function () {
            $(this).datepicker("show");
        });
    });


</script>
<?php $this->endSection(); ?>