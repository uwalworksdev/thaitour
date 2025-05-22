<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <link rel="stylesheet" href="/assets/css/write.css">

    <script>
        $(function () {
            $.datepicker.regional['ko'] = {
                showButtonPanel: true,
                beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                },
                closeText: '닫기',
                prevText: '이전',
                nextText: '다음',
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                weekHeader: 'Wk',
                dateFormat: 'yy-mm-dd',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: true,
                changeMonth: true,
                changeYear: true,
                showMonthAfterYear: true,
                closeText: '닫기',  // 닫기 버튼 패널
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['ko']);

            $(".datepicker").datepicker({
                showButtonPanel: true
                , beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                }
                , dateFormat: 'yy-mm-dd'
                , showOn: "both"
                , yearRange: "c-100:c+10"
                , buttonImage: "/img/ico/date_ico.png"
                , buttonImageOnly: true
                , closeText: '닫기'
                , prevText: '이전'
                , nextText: '다음'
                // ,minDate: 1
                <?php if ($str_guide != "") { ?>
                , beforeShowDay: function (date) {

                    var day = date.getDay();
                    return [(<?=$str_guide?>)];

                }
                <?php } ?>


            });
            $('img.ui-datepicker-trigger').css({'cursor': 'pointer'});
            $('input.hasDatepicker').css({'cursor': 'pointer'});
            $(".datepicker").datepicker("option", "maxDate", "<?=$guide_e_date?>");
        });


    </script>

<?php

$gubun = $row["gubun"] ?? '';

$user_name_kor = sqlSecretConver($row["user_name_kor"] ?? '', 'decode');
$user_name_eng = sqlSecretConver($row["user_name_eng"] ?? '', 'decode');
$sex = $row["sex"] ?? '';
$user_phone = explode("-", sqlSecretConver($row["user_phone"] ?? '', 'decode'));
if (count($user_phone) > 0) {
    $user_phone1 = $user_phone[0];
    $user_phone2 = $user_phone[1];
    $user_phone3 = $user_phone[2];
} else {
    $user_phone1 = '';
    $user_phone2 = '';
    $user_phone3 = '';
}
$birthday = $row['birthday'] ?? '';

$user_email = sqlSecretConver($row["user_email"] ?? '', 'decode');

$hotel = $row["hotel"] ?? '';
$sel_hotel = $row["sel_hotel"] ?? '';
$travel_local = $row["travel_local"] ?? '';
$hope_air = $row["hope_air"] ?? '';
$hope_air_type = $row["hope_air_type"] ?? '';
$hope_air_class = $row["hope_air_class"] ?? '';
$travel_purpose = $row["travel_purpose"] ?? '';
$travel_type = $row["travel_type"] ?? '';
$air_yn = $row['air_yn'] ?? '';
$flight_schedule = $row['flight_schedule'] ?? '';

$departure_local = $row["departure_local"] ?? '';
$travel_person1 = $row["travel_person1"] ?? '';
$travel_person2 = $row["travel_person2"] ?? '';
$travel_person3 = $row["travel_person3"] ?? '';
$group_name_eng = $row["group_name_eng"] ?? '';
$prod_url = $row["prod_url"] ?? '';
$concept_name = $row["concept_name"] ?? '';
$departure_date = $row["departure_date"] ?? '';
$arrival_date = $row["arrival_date"] ?? '';
$hope_time = $row["hope_time"] ?? '';
$city_name_sel = $row["city_name_sel"] ?? '';
$city_name_txt = $row["city_name_txt"] ?? '';
$hotel = $row["hotel"] ?? '';
$pickup = $row["pickup"] ?? '';
$guide = $row["guide"] ?? '';
$one_charge = $row["one_charge"] ?? '';
$travel_contents = $row["travel_contents"] ?? '';
$path = $row["path"] ?? '';
$status = $row["status"] ?? '';
$ufile1 = $row["ufile1"] ?? '';
$rfile1 = $row["rfile1"] ?? '';
$r_date = $row["r_date"] ?? '';
$planned_travel_area = $row['planned_travel_area'] ?? '';
$visit_routes = $row['visit_routes'] ?? '';
$accom_other_master = $row['accom_other_master'] ?? '';
$other_requests = $row['other_requests'] ?? '';
$air_other_matters = $row['air_other_matters'] ?? '';
?>
    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }

        function send_it() {
            $("#user_phone").val($("#phone_1").val() + '-' + $("#phone_2").val() + '-' + $("#phone_3").val());
            $.ajax({
                url: "./write_ok.php",
                type: "POST",
                data: $("#frm").serialize(),
                success: () => {
                    window.location.reload();
                }
            })
        }
    </script>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li><a href="/AdmMaster/_inquiry/list.php" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li><a href="javascript:del_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                </li>
                            <?php } else { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <form name=frm id="frm" action="write_ok.php" method=post target="hiddenFrame">

                <input type=hidden name="idx" value='<?= $idx ?>'>

                <div id="contents">
                    <div class="listWrap_noline">


                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" id="table_form_online_quote"
                                   class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>현황</th>
                                    <td colspan="3">
                                        <select name="status">
                                            <option value="W" <?php if ($status == "W") {
                                                echo "selected";
                                            } ?>>상담접수
                                            </option>
                                            <option value="Y" <?php if ($status == "Y") {
                                                echo "selected";
                                            } ?>>상담완료
                                            </option>
                                            <option value="C" <?php if ($status == "C") {
                                                echo "selected";
                                            } ?>>상담취소
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>여행 인원</th>
                                    <td>
                                        <div class="quantily flex__c gap-2">
                                            <div class="option flex__c">
                                                <span>성인</span>
                                                <div>
                                                    <input value="<?= $travel_person1 ?>" style="width: 80px;"
                                                           type="text" name="travel_person1"
                                                           oninput="limitInput(this, 3)" maxlength="3"
                                                           id="travel_person1" placeholder="0">
                                                    <span>명</span>
                                                </div>
                                            </div>
                                            <div class="option flex__c">
                                                <span>어린이</span>
                                                <div>
                                                    <input value="<?= $travel_person2 ?>" style="width: 80px;"
                                                           type="text" name="travel_person2"
                                                           oninput="limitInput(this, 3)" maxlength="3"
                                                           id="travel_person2" placeholder="0">
                                                    <span>명</span>
                                                </div>
                                            </div>
                                            <div class="option flex__c">
                                                <span>유아</span>
                                                <div>
                                                    <input value="<?= $travel_person3 ?>" style="width: 80px;"
                                                           type="text" name="travel_person3"
                                                           oninput="limitInput(this, 3)" maxlength="3"
                                                           id="travel_person3" placeholder="0">
                                                    <span>명</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <th>여행자 성함</th>
                                    <td>
                                        <div class="tra_name flex">
                                            <input type="text" value="<?= $user_name_kor ?>" name="user_name_kor"
                                                   id="user_name_kor" placeholder="한글이름">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>생년월일</th>
                                    <td>
                                        <div class="flex__c gap-1">
                                            <input value="<?= $birthday ?>" type="text" name="birthday"
                                                   placeholder="0000-00-00" class="datepicker" readonly>
                                        </div>
                                    </td>
                                    <th>여권 영문명</th>
                                    <td>
                                        <div class="tra_name flex">
                                            <input type="text" value="<?= $user_name_eng ?>" name="user_name_eng"
                                                   id="user_name_eng" placeholder="영문이름"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>이메일</th>
                                    <td>
                                        <div class="email flex__c">
                                            <input type="text" name="user_email" id="user_email"
                                                   value="<?= $user_email ?>">
                                        </div>
                                    </td>
                                    <th>전화번호</th>
                                    <td>
                                        <div class="phone flex gap-1">
                                            <select id="phone_1" class="s_input" name="phone_1">
                                                <option value=""></option>
                                                <option <?php if ($user_phone1 == "010") echo "selected" ?> value="010"
                                                                                                            selected>010
                                                </option>
                                                <option <?php if ($user_phone1 == "011") echo "selected" ?> value="011">
                                                    011
                                                </option>
                                                <option <?php if ($user_phone1 == "013") echo "selected" ?> value="013">
                                                    013
                                                </option>
                                                <option <?php if ($user_phone1 == "016") echo "selected" ?> value="016">
                                                    016
                                                </option>
                                                <option <?php if ($user_phone1 == "017") echo "selected" ?> value="017">
                                                    017
                                                </option>
                                                <option <?php if ($user_phone1 == "018") echo "selected" ?> value="018">
                                                    018
                                                </option>
                                                <option <?php if ($user_phone1 == "019") echo "selected" ?> value="019">
                                                    019
                                                </option>
                                            </select>
                                            <input value="<?= $user_phone2 ?>" type="text" id="phone_2"
                                                   oninput="limitInput(this, 4)" class="s_input" name="phone_2"
                                                   maxlength="4" numberonly="true">
                                            <input value="<?= $user_phone3 ?>" type="text" id="phone_3"
                                                   oninput="limitInput(this, 4)" class="s_input" name="phone_3"
                                                   maxlength="4" numberonly="true">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table cellpadding="0" cellspacing="0" summary="" id="table_form_online_quote"
                                   class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>여행목적</th>
                                    <td>
                                        <div class="purpose flex">
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_purpose == "허니문") echo "checked" ?>
                                                       name="travel_purpose" value="허니문" id="pur_01">
                                                <label for="pur_01">허니문</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_purpose == "가족여행") echo "checked" ?>
                                                       name="travel_purpose" value="가족여행" id="pur_02">
                                                <label for="pur_02">가족여행</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_purpose == "친목여행") echo "checked" ?>
                                                       name="travel_purpose" value="친목여행" id="pur_03">
                                                <label for="pur_03">친목여행</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_purpose == "골프여행") echo "checked" ?>
                                                       name="travel_purpose" value="골프여행" id="pur_04">
                                                <label for="pur_04">골프여행</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_purpose == "단체여행") echo "checked" ?>
                                                       name="travel_purpose" value="단체여행" id="pur_05">
                                                <label for="pur_05">단체여행</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_purpose == "기타") echo "checked" ?>
                                                       name="travel_purpose" value="기타" id="pur_06">
                                                <label for="pur_06">기타</label>
                                            </div>
                                        </div>
                                    </td>
                                    <th>여행자 유형</th>
                                    <td>
                                        <div class="purpose type flex gap-2">
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_type == "가이드 일정") echo "checked" ?>
                                                       name="travel_type" value="가이드 일정" id="type_01">
                                                <label for="type_01">가이드 일정</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($travel_type == "가이드 + 자유일정") echo "checked" ?>
                                                       name="travel_type" value="가이드 + 자유일정" id="type_02">
                                                <label for="type_02">가이드 + 자유일정 </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>희망 출발일~ 귀국일</th>
                                    <td>
                                        <div class="depart flex__c gap-1">
                                            <div class="departure_date">
                                                <div class="flex__c gap-1">
                                                    <input type="text" value="<?= $departure_date ?>"
                                                           id="departure_date" name="departure_date"
                                                           placeholder="0000-00-00"
                                                           class="datepicker" readonly>
                                                </div>
                                            </div>
                                            <div>
                                                <span> ~ </span>
                                            </div>
                                            <div class="departure_date">
                                                <div class="flex__c gap-1"><input type="text"
                                                                                  value="<?= $arrival_date ?>"
                                                                                  id="arrival_date" name="arrival_date"
                                                                                  placeholder="0000-00-00"
                                                                                  class="datepicker" readonly></div>
                                            </div>
                                        </div>
                                    </td>
                                    <th>계획중인 여행지역</th>
                                    <td>
                                        <textarea name="planned_travel_area" id="planned_travel_area"
                                                  rows="8"><?= $planned_travel_area ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>1인당 예산</th>
                                    <td>
                                        <div class="person flex gap-2">
                                            <div class="radio_item">
                                                <input type="radio"
                                                       name="one_charge" <?php if ($one_charge == "100~200만원") echo "checked" ?>
                                                       value="100~200만원" id="per_01">
                                                <label for="per_01">100~200만원</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       name="one_charge" <?php if ($one_charge == "200~300만원") echo "checked" ?>
                                                       value="200~300만원" id="per_02">
                                                <label for="per_02">200~300만원</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       name="one_charge" <?php if ($one_charge == "300~400만원") echo "checked" ?>
                                                       value="300~400만원" id="per_03">
                                                <label for="per_03">300~400만원</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       name="one_charge" <?php if ($one_charge == "400~500만원") echo "checked" ?>
                                                       value="400~500만원" id="per_04">
                                                <label for="per_04">400~500만원</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       name="one_charge" <?php if ($one_charge == "500만원 이상 또는 무관") echo "checked" ?>
                                                       value="500만원 이상 또는 무관" id="per_05">
                                                <label for="per_05">500만원 이상 또는 무관</label>
                                            </div>
                                        </div>
                                    </td>
                                    <th>항공권 소지여부</th>
                                    <td>
                                        <div class="tick_ch flex gap-2">
                                            <div class="radio_item">
                                                <input type="radio"
                                                       value="Y" <?php if ($air_yn == "Y") echo "checked" ?>
                                                       name="air_yn" id="tic_01" checked>
                                                <label for="tic_01">소지하고 있습니다. </label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       value="N" <?php if ($air_yn == "N") echo "checked" ?>
                                                       name="air_yn" id="tic_02">
                                                <label for="tic_02">소지하고 있지 않습니다.</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>그 외 사항</th>
                                    <td>
                                        <textarea name="air_other_matters" id="air_other_matters"
                                                  rows="8"><?= $air_other_matters ?></textarea>
                                    </td>
                                    <th></th>
                                    <td>
                                        <div class="tic_form" style="<?= ($air_yn == "Y" ? "" : "display:none;") ?>">
                                            <div class="ticket_ttl">
                                                소지하신 항공스케쥴 (출도착 항공편명/날짜/시간/지역)
                                            </div>
                                            <div class="tick_area">
                                                <textarea name="flight_schedule" id="flight_schedule"
                                                          rows="8"><?= $flight_schedule ?></textarea>
                                            </div>
                                        </div>
                                        <div class="tic_form" style="<?= ($air_yn == "Y" ? "display:none;" : "") ?>">
                                            <div class="tic_choise flex gap-2">
                                                <div class="radio_item">
                                                    <input type="radio"
                                                           name="hope_air_type" <?php if ($hope_air_type == "직항") echo "checked" ?>
                                                           value="직항" id="choise_01">
                                                    <label for="choise_01">직항</label>
                                                </div>
                                                <div class="radio_item">
                                                    <input type="radio"
                                                           name="hope_air_type" <?php if ($hope_air_type == "경유") echo "checked" ?>
                                                           value="경유" id="choise_02">
                                                    <label for="choise_02">경유</label>
                                                </div>
                                                <div class="radio_item">
                                                    <input type="radio"
                                                           name="hope_air_type" <?php if ($hope_air_type == "무관") echo "checked" ?>
                                                           value="무관" id="choise_03">
                                                    <label for="choise_03">무관</label>
                                                </div>
                                            </div>
                                            <div class="ticket_ttl">
                                                좌석등급
                                            </div>
                                            <div class="tic_seat flex gap-2">
                                                <div class="radio_item">
                                                    <input type="radio"
                                                           name="hope_air_class" <?php if ($hope_air_class == "이코노미") echo "checked" ?>
                                                           value="이코노미" id="seat_01">
                                                    <label for="seat_01">이코노미</label>
                                                </div>
                                                <div class="radio_item">
                                                    <input type="radio"
                                                           name="hope_air_class" <?php if ($hope_air_class == "비즈니스") echo "checked" ?>
                                                           value="비즈니스" id="seat_02">
                                                    <label for="seat_02">비즈니스</label>
                                                </div>
                                                <div class="radio_item">
                                                    <input type="radio"
                                                           name="hope_air_class" <?php if ($hope_air_class == "퍼스트") echo "checked" ?>
                                                           value="퍼스트" id="seat_03">
                                                    <label for="seat_03">퍼스트</label>
                                                </div>
                                                <div class="radio_item">
                                                    <input type="radio"
                                                           name="hope_air_class" <?php if ($hope_air_class == "마일리지") echo "checked" ?>
                                                           value="마일리지 승급" id="seat_04">
                                                    <label for="seat_04">마일리지 승급</label>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>선호 숙소</th>
                                    <td>
                                        <div class="accom flex gap-2">
                                            <div class="radio_item">
                                                <input type="radio"
                                                       value="아파트먼트" <?php if ($sel_hotel == "아파트먼트") echo "checked" ?>
                                                       name="sel_hotel" id="accom_01">
                                                <label for="accom_01">아파트먼트</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       value="호텔" <?php if ($sel_hotel == "호텔") echo "checked" ?>
                                                       name="sel_hotel" id="accom_02">
                                                <label for="accom_02">호텔</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       value="리조트" <?php if ($sel_hotel == "리조트") echo "checked" ?>
                                                       name="sel_hotel" id="accom_03">
                                                <label for="accom_03">리조트</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       value="무관" <?php if ($sel_hotel == "무관") echo "checked" ?>
                                                       name="sel_hotel" id="accom_04">
                                                <label for="accom_04">무관</label>
                                            </div>
                                        </div>
                                    </td>
                                    <th>선호 등급</th>
                                    <td>
                                        <div class="level flex gap-2">
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($hotel == "3성급") echo "checked" ?>
                                                       name="hotel" value="3성급" id="level_01">
                                                <label for="level_01">3성급</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($hotel == "4성급") echo "checked" ?>
                                                       name="hotel" value="4성급" id="level_02">
                                                <label for="level_02">4성급</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($hotel == "5성급") echo "checked" ?>
                                                       name="hotel" value="5성급" id="level_03">
                                                <label for="level_03">5성급</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio" <?php if ($hotel == "필요없음") echo "checked" ?>
                                                       name="hotel" value="필요없음" id="level_04">
                                                <label for="level_04">필요없음</label>
                                            </div>
                                            <div class="radio_item">
                                                <input type="radio"
                                                       <?php if ($hotel == "기타") echo "checked" ?>name="hotel"
                                                       value="기타" id="level_05">
                                                <label for="level_05">기타</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>그 외 사항</th>
                                    <td><textarea name="accom_other_master" id=""
                                                  rows="8"><?= $accom_other_master ?></textarea></td>
                                    <th>기타 요청사항</th>
                                    <td><textarea name="other_requests" id="other_requests"
                                                  rows="8"><?= $other_requests ?></textarea></td>
                                </tr>
                                <tr>
                                    <th>방문경로</th>
                                    <td colspan="3">
                                        <?= $visit_routes ?>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                            <h2 style="font-size: 18px;">동반여행자 </h2>
                            <table cellpadding="0" cellspacing="0" summary="" id="table_form_online_quote"
                                   class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="30%"/>
                                    <col width="30%"/>
                                    <col width="30%"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>여행자 성함</th>
                                    <th>여권 영문명</th>
                                    <th>생년월일</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $nn = 1;
                                if ($result_mem) {
                                    foreach ($result_mem as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $nn ?></td>
                                            <td><?= sqlSecretConver($row['user_name_kor'], 'decode') ?></td>
                                            <td><?= sqlSecretConver($row['user_name_eng'], 'decode') ?></td>
                                            <td><?= $row['birthday'] ?></td>
                                        </tr>
                                        <?php
                                        $nn++;
                                    }
                                }
                                ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="user_phone" id="user_phone">

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">

                                <a href="/AdmMaster/_inquiry/list.php" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <a href="javascript:del_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- // contents -->
            </form>
            <div class="inner cmt_area">
                <form action="" id="frm" name="com_form" class="com_form">
                    <input type="hidden" name="code" id="code" value="inquiry">
                    <input type="hidden" name="r_code" id="r_code" value="inquiry">
                    <input type="hidden" name="r_idx" id="r_idx" value="<?= $idx ?>">
                    <div class="comment_box-input flex">
                        <textarea class="cmt_input" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
                        <button type="button" class="btn btn-point btn-lg comment_btn" onclick="fn_comment()">등록
                        </button>
                    </div>
                </form>
                <div id="comment_list"></div>
            </div>
        </div><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->
    <script>
        function change_it(str) {
            if (str == "O") {
                $(".cls_out").show();
            } else {
                $(".cls_out").hide();
            }
        }
        <?php if (isset($row["status"]) && $row["status"] == "O") { ?>
        change_it('<?=$row["status"]?>');
        <?php } ?>

        function del_it() {
            if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                hiddenFrame.location.href = "del.php?idx[]=<?=$idx?>&mode=view";
            }

        }
    </script>
    <script src="https://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script>

        $('.tick_ch input[type="radio"]').on('change', function () {
            var idx = $(this).parent().index();
            $('.tic_form').hide();
            $('.tic_form').eq(idx).show();
        })


        function limitInput(input, max) {
            input.value = input.value.replace(/[^0-9]/g, '');
            if (input.value.length > max) {
                input.value = input.value.slice(0, max);
            }
        }

        //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
        function execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function (data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                    var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                        extraRoadAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if (data.buildingName !== '' && data.apartment === 'Y') {
                        extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if (extraRoadAddr !== '') {
                        extraRoadAddr = ' (' + extraRoadAddr + ')';
                    }
                    // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                    if (fullRoadAddr !== '') {
                        fullRoadAddr += extraRoadAddr;
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('zip').value = data.zonecode; //5자리 새우편번호 사용
                    document.getElementById('addr1').value = fullRoadAddr;
                    document.getElementById('addr2').focus();
                }
            }).open();
        }

        function fn_comment() {

            <? if ($_SESSION[member][id] != "") { ?>
            if ($("#comment").val() == "") {
                alert("댓글을 입력해주세요.");
                return;
            }
            var queryString = $("form[name=com_form]").serialize();
            $.ajax({
                type: "POST",
                url: "/AdmMaster/_include/comment_proc.php",
                data: queryString,
                cache: false,
                success: function (ret) {
                    console.log(ret);
                    if (ret.trim() == "OK") {
                        fn_comment_list();
                        $("#comment").val("");
                    } else {
                        alert("등록 오류입니다." + ret);
                    }
                }
            });
            <? } else { ?>
            alert("로그인을 해주세요.");
            <? } ?>
        }

        function fn_comment_list() {

            $.ajax({
                type: "POST",
                url: "/AdmMaster/_include/comment_list.ajax.php",
                data: {
                    "r_code": "inquiry",
                    "r_idx": "<?=$idx?>"
                },
                cache: false,
                success: function (ret) {
                    $("#comment_list").html(ret);
                }
            });

        }

        fn_comment_list();
    </script>
    <script src="/AdmMaster/_include/comment.js"></script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>