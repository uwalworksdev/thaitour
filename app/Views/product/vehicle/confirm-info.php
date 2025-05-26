<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<?php $setting = homeSetInfo(); ?>
<link rel="stylesheet" href="/css/tour/spa.css">
<link rel="stylesheet" href="/css/tour/booking_spa.css">
<?php
    $arr_days = ['일', '월', '화', '수', '목', '금', '토'];
?>

<style>
    #flight_code {
        display: none;
        margin-top: 10px;
        width: 200px;
    }
</style>
<div class="customer-form-page">
    <div class="navigation-section">
        <div class="body_inner">
            <div class="content-main">
                <div class="item-n">
                    <span class="number-n">
                        1
                    </span>
                    <span class="label-n">상품선택</span>
                    <img src="/uploads/icons/arrow_right_nav.png" alt="">
                </div>
                <div class="item-n">
                    <span class="number-n">
                        2
                    </span>
                    <span class="label-n">예약정보</span>
                    <img src="/uploads/icons/arrow_right_nav.png" alt="">
                </div>
                <div class="item-n inactive">
                    <span class="number-n">
                        3
                    </span>
                    <span class="label-n">결제</span>
                </div>
            </div>
        </div>
    </div>
    <div class="main-section">
        <div class="body_inner">
            <form action="/vehicle-guide/vehicle-order" name="frmCar" id="frmCar" method="post">
                <input type="hidden" name="code_no" id="code_no" value="<?= $code_no ?>">
                <input type="hidden" name="cp_idx" id="cp_idx" value="<?= $cp_idx ?>">
                <input type="hidden" name="product_cnt" id="product_cnt" value="<?= $product_cnt ?>">
                <input type="hidden" name="ca_depth_idx" id="ca_depth_idx" value="<?= $ca_depth_idx ?>">
                <input type="hidden" name="departure_area" id="departure_area" value="<?= $departure_area ?>">
                <input type="hidden" name="destination_area" id="destination_area" value="<?= $destination_area ?>">
                <input type="hidden" name="meeting_date" id="meeting_date" value="<?= $meeting_date ?>">
                <input type="hidden" name="return_date" id="return_date" value="<?= $return_date ?>">
                <input type="hidden" name="adult_cnt" id="adult_cnt" value="<?= $adult_cnt ?>">
                <input type="hidden" name="child_cnt" id="child_cnt" value="<?= $child_cnt ?>">
                <input type="hidden" name="inital_price" id="inital_price" value="<?= $inital_price ?>">
                <input type="hidden" name="order_price" id="order_price" value="<?= $order_price ?>">
                <input type="hidden" name="order_status" id="order_status" value="W">
                <div class="container-card">
                    <div class="form_booking_spa_">
                        <div class="card-left2">
                            <div class="flex" style="gap: 20px">
                                <h3 class="title-main-c">
                                    예약확정서 정보 입력
                                </h3>
                                <div class="bs-input-check">
                                    <input type="checkbox" id="save_id" name="save_id" value="Y">
                                    <label for="save_id"> 회원정보와 동일</label>
                                </div>
                            </div>
                            <h3 class="title-sub-c">예약확정서 이름</h3>
                            <div class="con-form mb-40">
                                <div class="form-group">
                                    <label for="order_user_name">한국이름</label>
                                    <input type="text" id="order_user_name" name="order_user_name" class="ip_only_ko" required=""
                                           data-label="한국이름" placeholder="한국이름 작성해주세요.">
                                </div>
                                <div class="form-group" style="width: 50%">
                                    <label for="gender1">성별(남성/여성)*</label>
                                    <select name="companion_gender" id="gender1" style="width: 100%" required=""
                                            data-label="성별"
                                            class="select-width">
                                        <option value="M">남성</option>
                                        <option value="F">여성</option>
                                    </select>
                                </div>
                            </div>
                            <div class="con-form mb-40">
                                <div class="form-group">
                                    <label for="order_user_first_name_en">영문 이름(First Name) *</label>
                                    <input type="text" id="order_user_first_name_en" class="ip_only_en" name="order_user_first_name_en"
                                           required="" data-label="영문 이름" placeholder="영어로 작성해주세요.">
                                </div>
                                <div class="form-group">
                                    <label for="order_user_last_name_en">영문 성(Last Name) *</label>
                                    <input type="text" id="order_user_last_name_en" class="ip_only_en" name="order_user_last_name_en"
                                           required="" data-label="영문 성" placeholder="영어로 작성해주세요.">
                                </div>
                            </div>
                            <script>
                                $(".ip_only_ko").on("input", function () {
                                    let koreanText = $(this).val().replace(/[^가-힣ㄱ-ㅎㅏ-ㅣ\s]/g, ""); 
                                    $(this).val(koreanText);
                                });
                            </script>
							
							<div class="con-form mb-40">
								<div class="form-group">
									<label for="order_passport_number">여권번호 *</label>
									<input type="text" id="order_passport_number" class="" name="order_passport_number"
										   required="" data-label="여권번호" placeholder="여권번호.">
								</div>
								<div class="form-group">
									<label for="order_passport_expiry_date">여권만기일 *</label>
									<input type="text" id="order_passport_expiry_date" class="date_form" name="order_passport_expiry_date"
										   required="" data-label="여권만기일" placeholder="여권만기일" readonly>
								</div>
							</div>
							<div class="con-form mb-40">
								<div class="form-group">
									<label for="order_birth_date">생년월일 *</label>
									<input type="text" id="order_birth_date" class="date_form_birth" name="order_birth_date"
										   required="" data-label="생년월일" placeholder="생년월일" readonly>
								</div>
							</div>
							<!-- 2025/02/10 추가부분 E: -->
					
                            <h3 class="title-sub-c">연락처</h3>
                            <div class="form-group form-cus-select">
                                <label for="passport-name2">이메일 주소*</label>
                                <div class="cus-select-group">
                                    <input type="text" id="email_1" name="email_1" required="" data-label="이메일"
                                           placeholder="이메일">
                                    <span>@</span>
                                    <div class="email-group">
                                        <input type="text" name="email_2" id="email_2" required="" data-label="이메일"
                                               placeholder="" readonly="">
                                        <select id="" class="select-width" onchange="handleEmail(this.value)">
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
                                            <option value="1">직접입력</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="phone_wrap mb-30">
                                <div class="phone_wrap_item form-group">
                                    <p>
                                        <input type="radio" id="test1" name="radio_phone" value="kor" checked="">
                                        <label for="test1">한국번호*</label>
                                    </p>
                                    <div class="form-group form-group-cus-4input">
                                        <input name="phone_1" maxlength="3" class="phone_kor phone" type="text"
                                               id="phone_1" required="" data-label="한국번호">
                                        <span> - </span>
                                        <input name="phone_2" maxlength="4" class="phone_kor phone" type="text"
                                               id="phone_2" required="" data-label="한국번호">
                                        <span> - </span>
                                        <input name="phone_3" maxlength="4" class="phone_kor phone" type="text"
                                               id="phone_3" required="" data-label="한국번호">
                                    </div>
                                </div>
                                <div class="phone_wrap_item form-group">
                                    <p>
                                        <input type="radio" id="test2" name="radio_phone" value="thai">
                                        <label for="test2">태국번호 *</label>
                                    </p>
                                    <div class="form-group">
                                        <input name="phone_thai" maxlength="10" class="phone_thai phone" type="text"
                                               id="phone_thai" disabled="" required="" data-label="한국번호">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mo_mt-30">
                                <label for="passport-name2">여행시 현지 연락처</label>
                                <div class="form-group-flex" style="display: flex; align-items: center; gap: 20px">
                                    <select id="car-time-hour" class="select-width" style="width: 200px">
                                        <option value="01">TH</option>
                                    </select>
                                    <input name="local_phone" class="phone" maxlength="10" type="text" id="local_phone"
                                           placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="card-left2 card_left_bottom_ order-form-page">
                            <h3 class="title-main-c">
                                필수 입력사항
                            </h3>
                            <div class="section_vehicle_2_7__body">
                                <?php
                                    if($type_code_no == "5401"){
                                ?>
                                <div class="section_vehicle_table">
                                    <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                                        가는 편
                                    </div>
                                    <table>
                                        <colgroup>
                                            <col width="150px">
                                            <col width="*">
                                            <col width="150px">
                                            <col width="*">
                                        </colgroup>
                                        <tbody> 
                                            <input type="hidden" name="departure_name[]" class="s_departure_name" value="">
                                            <tr>
                                                <th>항공편 명</th>
                                                <td colspan="3">
                                                    <select id="flight_arr" onchange="change_flight(this)">
                                                    </select>
                                                    <input type="text" name="airline_code[]" class="s_airline_code" id="flight_code" placeholder="예) KE 657">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>항공 도착 날짜</th>
                                                <td colspan="3">
                                                    <div class="datepicker_wrap" style="width: 250px;">
                                                        <input type="text" name="date_trip[]" class="date_form_trip s_date_trip" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>항공 도착 시간</th>
                                                <td colspan="3">
                                                    <div class="meeting_time">
                                                        <select name="hours[]" class="s_hours" id="hours">
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
                                                        <select name="minutes[]" class="s_minutes" id="minutes">
                                                            <?php
                                                            for ($i = 0; $i < 60; $i += 5) {
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
                                                    목적지
                                                </th>
                                                <td colspan="3">
                                                    <div class="destination">
                                                        <span class="destination_name"></span>
                                                        <input type="text" name="destination_name[]" class="s_destination_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
                                                    </div>
                                                    <div class="departure__note">
                                                        - 일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요. <br>
                                                        - 예약 시 선택하신 지역과 입력하신 장소가 다른 경우, 바우처 발송 후에도 추가 요금이 발생할 수 있습니다. <br>
                                                        - 윈저파크, 아티타야 등 대부분의 방콕 골프텔은 방콕 외곽 지역에 속합니다.
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>기타요청</th>
                                                <td colspan="3">
                                                    <textarea name="order_memo[]" id="order_memo" class="other_irregularities s_order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                    if($text_category_5401 == "왕복"){
                                ?>
                                    <div class="section_vehicle_table">
                                        <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                                            오는 편
                                        </div>
                                        <table>
                                            <colgroup>
                                                <col width="150px">
                                                <col width="*">
                                                <col width="150px">
                                                <col width="*">
                                            </colgroup>
                                            <tbody>
                                                <input type="hidden" class="e_destination_name" name="destination_name[]" value="">
                                                <tr>
                                                    <th>차량 미팅 날짜</th>
                                                    <td colspan="3">
                                                        <div class="datepicker_wrap" style="width: 250px;">
                                                            <input type="text" name="date_trip[]" class="date_form e_date_trip" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>미팅 시간</th>
                                                    <td colspan="3">
                                                        <div class="meeting_time">
                                                            <select name="hours[]" class="e_hours" id="hours">
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
                                                            <select name="minutes[]" class="e_minutes" id="minutes">
                                                                <?php
                                                                for ($i = 0; $i < 60; $i += 5) {
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
                                                        미팅 장소
                                                    </th>
                                                    <td colspan="3">
                                                        <div class="departure">
                                                            <span class="departure_name"></span>
                                                            <input type="text" name="departure_name[]" class="e_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
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
                                                        항공편 명
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" name="airline_code[]" class="e_airline_code" placeholder="예) KE658">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>기타요청</th>
                                                    <td colspan="3">
                                                        <textarea name="order_memo[]" id="order_memo" class="other_irregularities e_order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                                    </td>
                                                </tr>     
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    }else if($type_code_no == "5402"){
                                ?>
                                    <div class="section_vehicle_table">
                                        <table>
                                            <colgroup>
                                                <col width="150px">
                                                <col width="*">
                                                <col width="150px">
                                                <col width="*">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <th>차량 미팅 날짜</th>
                                                    <td colspan="3">
                                                        <div class="datepicker_wrap" style="width: 250px;">
                                                            <input type="text" name="date_trip[]" class="date_form s_date_trip" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>미팅 시간</th>
                                                    <td colspan="3">
                                                        <div class="meeting_time">
                                                            <select name="hours[]" class="s_hours" id="hours">
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
                                                            <select name="minutes[]" class="s_minutes" id="minutes">
                                                                <?php
                                                                for ($i = 0; $i < 60; $i += 5) {
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
                                                        미팅 장소
                                                    </th>
                                                    <td colspan="3">
                                                        <div class="departure">
                                                            <span class="departure_name"></span>
                                                            <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
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
                                                        항공편 명
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" name="airline_code[]" class="s_airline_code" placeholder="예) KE658">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>기타 요청</th>
                                                    <td colspan="3">
                                                        <textarea name="order_memo[]" class="other_irregularities s_order_memo" id="order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                                    </td>
                                                </tr>     
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                    }else if($type_code_no == "5403"){

                                        if ($meeting_date && $return_date) {
                                            $startDate = new DateTime($meeting_date);
                                            $endDate   = new DateTime($return_date);

                                            $interval = $startDate->diff($endDate);
                                            $differenceInDays = $interval->days + 1;

                                            $currentDate = clone $startDate;

                                            for ($i = 1; $currentDate <= $endDate; $i++) {
                                                $day = $arr_days[$currentDate->format('w')];
                                ?>
                                    <div class="section_vehicle_table">
                                        <div class="section_vehicle_2_7__head__ttl vehicle_ttl">
                                            <span class="schedule_ttl"><?=$i?> 일차</span> 일정을 입력해주세요
                                        </div>
                                        <table>
                                            <colgroup>
                                                <col width="150px">
                                                <col width="*">
                                                <col width="150px">
                                                <col width="*">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <th>차량 출발시간</th>
                                                    <td colspan="3">
                                                        <div class="meeting_time">
                                                            <input type="hidden" name="date_trip[]" class="s_date_trip" value="<?=$currentDate->format('Y-m-d')?>">
                                                            <span class="meeting_time__date"><?=$currentDate->format('Y-m-d') . "(" . $day . ")"?></span>
                                                            <select name="hours[]" class="s_hours" id="hours">
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
                                                            <select name="minutes[]" class="s_minutes" id="minutes">
                                                                <?php
                                                                for ($i = 0; $i < 60; $i += 5) {
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
                                                        출발지
                                                    </th>
                                                    <td colspan="3">
                                                        <div class="departure">
                                                            <span class="departure_name"></span>
                                                            <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
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
                                                        이동루트
                                                    </th>
                                                    <td colspan="3">
                                                        <textarea name="schedule_content[]" placeholder="가급적 영어로 적어주세요. 사전에 고지되지 않은 코스를 추가하실 때에는 추가 요금이 발생할 수 있으니 가급적 일정을 상세히 적어 주시기 바랍니다." class="other_irregularities schedule_content s_schedule_content"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>기타요청</th>
                                                    <td colspan="3">
                                                        <textarea name="order_memo[]" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다." class="other_irregularities order_memo s_order_memo"></textarea>
                                                    </td>
                                                </tr>     
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                                $currentDate->modify('+1 day');
                                            } 
                                        }
                                    }else if($type_code_no == "5404"){
                                        $currentDate = new DateTime($meeting_date);
                                        $day = $arr_days[$currentDate->format('w')];
                                ?>
                                    <div class="section_vehicle_table">
                                        <table>
                                            <colgroup>
                                                <col width="150px">
                                                <col width="*">
                                                <col width="150px">
                                                <col width="*">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <th>차량 출발시간</th>
                                                    <td colspan="3">
                                                        <div class="meeting_time">
                                                            <input type="hidden" name="date_trip[]" class="s_date_trip" value="<?=$currentDate->format('Y-m-d')?>">
                                                            <span class="meeting_time__date"><?=$currentDate->format('Y-m-d') . "(" . $day . ")"?></span>
                                                            <select name="hours[]" class="s_hours" id="hours">
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
                                                            <select name="minutes[]" class="s_minutes" id="minutes">
                                                                <?php
                                                                for ($i = 0; $i < 60; $i += 5) {
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
                                                        출발지(픽업호텔)
                                                    </th>
                                                    <td colspan="3">
                                                        <div class="departure">
                                                            <span class="departure_name"></span>
                                                            <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
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
                                                        경유지
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" name="rest_name[]" class="s_rest_name" placeholder="가급적 영어로 적어주세요.">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        목적지
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" name="destination_name[]" class="s_destination_name" placeholder="가급적 영어로 적어주세요.">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>기타요청</th>
                                                    <td colspan="3">
                                                        <textarea name="order_memo[]" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다." class="other_irregularities order_memo s_order_memo"></textarea>
                                                    </td>
                                                </tr>     
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                    }else if($type_code_no == "5405") {
                                        $currentDate = new DateTime($meeting_date);
                                        $day = $arr_days[$currentDate->format('w')];
                                ?>
                                <div class="section_vehicle_table">
                                    <table>
                                        <colgroup>
                                            <col width="150px">
                                            <col width="*">
                                            <col width="150px">
                                            <col width="*">
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <th>차량 출발시간</th>
                                                <td colspan="3">
                                                    <div class="meeting_time">
                                                        <input type="hidden" name="date_trip[]" class="s_date_trip" value="<?=$currentDate->format('Y-m-d')?>">
                                                        <span class="meeting_time__date"><?=$currentDate->format('Y-m-d') . "(" . $day . ")"?></span>
                                                        <select name="hours[]" class="s_hours" id="hours">
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
                                                        <select name="minutes[]" class="s_minutes" id="minutes">
                                                            <?php
                                                            for ($i = 0; $i < 60; $i += 5) {
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
                                                    출발지(픽업호텔)
                                                </th>
                                                <td colspan="3">
                                                    <div class="departure">
                                                        <span class="departure_name"></span>
                                                        <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
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
                                                    경유지
                                                </th>
                                                <td colspan="3">
                                                    <input type="text" name="rest_name[]" class="s_rest_name" placeholder="가급적 영어로 적어주세요.">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    목적지
                                                </th>
                                                <td colspan="3">
                                                    <input type="text" name="destination_name[]" class="s_destination_name" placeholder="가급적 영어로 적어주세요.">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>기타요청</th>
                                                <td colspan="3">
                                                    <textarea name="order_memo[]" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다." class="other_irregularities order_memo s_order_memo"></textarea>
                                                </td>
                                            </tr>     
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                    }else {
                                        $currentDate = new DateTime($meeting_date);
                                        $day = $arr_days[$currentDate->format('w')];
                                ?>
                                    <div class="section_vehicle_table">
                                        <table>
                                            <colgroup>
                                                <col width="150px">
                                                <col width="*">
                                                <col width="150px">
                                                <col width="*">
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <th>미팅 시간</th>
                                                    <td colspan="3">
                                                        <div class="meeting_time">
                                                            <input type="hidden" name="date_trip[]" class="s_date_trip" value="<?=$currentDate->format('Y-m-d')?>">
                                                            <span class="meeting_time__date"><?=$currentDate->format('Y-m-d') . "(" . $day . ")"?></span>
                                                            <select name="hours[]" class="s_hours" id="hours">
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
                                                            <select name="minutes[]" class="s_minutes" id="minutes">
                                                                <?php
                                                                for ($i = 0; $i < 60; $i += 5) {
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
                                                        출발지(픽업호텔)
                                                    </th>
                                                    <td colspan="3">
                                                        <div class="departure">
                                                            <span class="departure_name"></span>
                                                            <input type="text" name="departure_name[]" class="s_departure_name" placeholder="호텔명을 영어로 적어주세요(주소불가)">
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
                                                        목적지(골프장명)
                                                    </th>
                                                    <td colspan="3">
                                                        <input type="text" name="destination_name[]" class="s_destination_name" placeholder="가급적 영어로 적어주세요.">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>기타 요청</th>
                                                    <td colspan="3">
                                                        <textarea name="order_memo[]" class="other_irregularities order_memo s_order_memo" placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1 게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                                                    </td>
                                                </tr>     
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card-right">
                            <img src="/data/product/<?= $product['ufile1'] ?>" alt="customer-form.png">
                            <div class="below-right">
                                <h3 class="title-r"><?= $product['product_name'] ?></h3>
                                <p class="title-sub-r text-gray">
                                    <?= $product['addrs'] ?>
                                </p>
                                <div class="item-info" style="gap: 10px;">
                                    <div>
                                        <span>출발지역: </span>
                                        <span><?= $text_destination_name ?></span>
                                    </div>
                                    /
                                    <div>
                                        <span>도착지역: </span>
                                        <span><?= $text_departure_name ?></span>
                                    </div>
                                </div>
                                <div class="item-info" style="gap: 10px;">
                                    <span><?=$category_text_list?></span>
                                </div>

                                <div class="item-info" style="gap: 10px;">
                                    <span>성인 <?=$adult_cnt?>명,  소아 <?=$child_cnt?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-right2 spa-detail">
                            <!-- <h3 class="title-r">
                                여행인원 및 예약금액
                            </h3>
                            <div class="list_schedule_">          
                                <div class="schedule schedule_booking">
                                    <p style="font-weight: bold; width: 100%;"><?= $category_text_list ?></p>
                                    <div class="schedule_wrap" style="width: 100%;">
                                        <div class="wrap-text" style="width: 100%;">
                                            <p>성인 x <?= $people_adult_cnt ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span style="text-wrap: nowrap"><?= number_format($people_adult_price) ?></span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                    <div class="schedule_wrap" style="width: 100%;">
                                        <div class="wrap-text" style="width: 100%;">
                                            <p>아동 x <?= $people_kids_cnt ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span style="text-wrap: nowrap"><?= number_format($people_kids_price) ?></span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                    <div class="schedule_wrap" style="width: 100%;">
                                        <div class="wrap-text" style="width: 100%;">
                                            <p>유아 x <?= $people_baby_cnt ?></p>
                                        </div>
                                        <div class="wrap-btn">
                                            <span style="text-wrap: nowrap"><?= number_format($people_baby_price) ?></span>
                                            <span> 원</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="schedule last" id="option_list_<?=$op_info_idx[$key]?>">
                                    <p class="schedule_ttl" style="margin-top: 0;">옵션</p>    
                                    <?php foreach ($tour_option as $index => $option): ?>
                                        <div class="schedule_option" id="schedule_<?= $index ?>" style="width: 100%;">
                                            <div class="wrap-text">
                                                <p><?= $option['option_name'] ?> x <?= $option['qty'] ?></p>
                                            </div>
                                            <span><?= number_format($option_price[$index]) ?> 원</span>                            
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div> -->

                            <div class="item-info-r font-bold-cus" style="color: rgba(255,0,0,0.75); display: none">
                                <span>쿠폰 </span>
                                <span>- <span class="discountPrice">0</span> 원</span>
                            </div>
                            <div class="item-info-r font-bold-cus" style="color: rgba(255,0,0,0.75); display: none">
                                <span>포인트 </span>
                                <span>- <span class="pointPrice">0</span> 원</span>
                            </div>
                            <div class="item-info-r font-bold-cus">
                                <span>합계</span>
                                <span><span class="textTotalPrice lastPrice"><?= number_format($order_price) ?></span> 원</span>
                            </div>
                            <p class="below-des-price">
                                · 견적서를 받으신 후 결제해 주시면 결제 확인 후 해당
                                업체에 확정 요청을 합니다. 즉시 확정 상품은 결제해
                                주시면 확정 처리됩니다.
                            </p>
                            <div class="below-title-image">
                                <img class="only_web" src="/uploads/icons/block_icon.png" alt="block_icon">
                                <img class="only_mo" src="/uploads/icons/block_icon_mo.png" alt="block_icon">
                                <span>취소규정</span>
                            </div>
                            <p class="below-sub-des">
                                취소규정: 결제 후 취소하시려면 결제하신 금액의 50% 요금이 부과됩니다.
                            </p>
                            <p class="cus-label-r info_link" id="policy_show" style="cursor: pointer" data-product-idx="<?= $product['product_code_1'] ?>">본 예약건 취소규정</p>
        
                            <div class="terms-wrap" style="width: 100%;">
                                <h3 class="title-second">약관동의</h3>
                                <div class="item-info-check item_check_term_all_">
                                    <label for="fullagreement">전체동의</label>
                                    <input type="hidden" value="N" id="fullagreement">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="">이용약관 동의(필수)</label>
                                    <button type="button" data-type="1" class="view-policy">[보기]</button>
                                    <input type="hidden" value="N" id="terms">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="">개인정보 처리방침(필수)</label>
                                    <button type="button" data-type="2" class="view-policy">[보기]</button>
                                    <input type="hidden" value="N" id="policy">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="">개인정보 제3자 제공 및 국외 이전 동의(필수)</label>
                                    <button type="button" data-type="3" class="view-policy">[보기]</button>
                                    <input type="hidden" value="N" id="information">
                                </div>
                                <div class="item-info-check item_check_term_">
                                    <label for="guidelines">여행안전수칙 동의(필수)</label>
                                    <button type="button" data-type="4" class="view-policy">[보기]</button>
                                    <input type="hidden" value="N" id="guidelines">
                                </div>
                            </div>

                            <?php if($prod['direct_payment'] == "Y") { ?>
							<span style="color:red;">※ 예약확정 상품입니다.</span>
                            <button class="btn-order btnOrder" onclick="handlePayment('B');" type="button">결제하기</button>
							<?php } else { ?>
                            <button class="btn-order btnOrder" onclick="handleSubmit('W');" type="button">예약하기</button>
							<?php } ?>
                            <button class="btn-cancel btnOrder" onclick="handleSubmit('B');" type="button">장바구니 담기</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="popup_img" class="on">
    <strong id="pop_roomName"></strong>
    <div>
        <ul class="multiple-items">
            <?php foreach ($imgs as $img) {
                echo "<li><img src='" . $img . "' alt='' /></li>";
            } ?>
        </ul>
    </div>
    <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close" /></a>
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
                    <!-- <?= viewSQ(getPolicy(19)) ?> -->
                    <div id="policyContent"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<div class="popup_wrap place_pop reservation_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>약관동의</h2>
                    </div>
                </div>
                <div class="popup_place__body">
                    <div id="policyContent"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<iframe src="" id="hiddenFrame" name="hiddenFrame" style="display: none;" frameborder="0"></iframe>

<script>
    $(document).ready(function() {
        getFlight();

        <?php
            if($type_code_no == "5401") {
        ?>        
            $(".date_form_trip").val('<?=$meeting_date?>');

            let currentDate = new Date('<?=$meeting_date?>');

            currentDate.setDate(currentDate.getDate() + 1);

            let nextDate = currentDate.toISOString().split('T')[0];

            $(".date_form_trip").datepicker({
                dateFormat: "yy-mm-dd",
                showOn: "both",
                // buttonImage: "/images/ico/date_ico.png",
                // buttonImageOnly: true,
                minDate: new Date('<?=$meeting_date?>'),
                maxDate: new Date(nextDate)
            });
        <?php
            }
        ?>

        $(".date_form").val('<?=$meeting_date?>');
        $(".date_form").datepicker({
            dateFormat: "yy-mm-dd",
            showOn: "both",
            buttonImage: "/images/ico/date_ico.png",
            buttonImageOnly: true,
            minDate: new Date('<?=$meeting_date?>')
        });
    });

    function getFlight() {
        $.ajax({
            url: '/ajax/get_flight',
            type: "GET",
            data: {
                ca_idx : <?=$ca_idx_5401?>
            },
            error: function(request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            },
            success: function(response, textStatus) {
                let data = response.flight_list;

                let html = `<option value="">항공편 명을 선택해주세요.</option>`;

                for (let i = 0; i < data.length; i++) {

                    html += `<option value="${data[i].code_flight}" data-id="${data[i].cf_idx}" data-depature_time="${data[i].f_depature_time}" data-destination_time="${data[i].f_destination_time}">
                            ${data[i].airline_name} ${data[i].code_flight}(${data[i].f_depature_name} ${data[i].f_depature_time} - ${data[i].f_destination_name} ${data[i].f_destination_time})
                            </option>`;
                }

                html += `<option value="other">직접입력</option>`;

                $("#flight_arr").html(html);

            }
        });
    }

    function change_flight(el) {
        let value = $(el).val();
        let selected_meeting_date = $("#meeting_date").val();
        let currentDate = new Date(selected_meeting_date);

        $("#flight_code").val("");

        if (value == "other") {
            $("#flight_code").show();
        } else {
            $("#flight_code").hide();
            $("#flight_code").val(value);

            let depature_time = $(el).find("option:selected").data("depature_time");
            let destination_time = $(el).find("option:selected").data("destination_time");


            if (depature_time && destination_time) {
                let time_arr = destination_time.split(":");

                let hour = time_arr[0].trim();
                let minute = time_arr[1].trim();

                if (hour && minute) {
                    $(el).closest("table").find("#hours").val(hour);
                    $(el).closest("table").find("#minutes").val(minute);
                }

                if (isNextDay(depature_time, destination_time)) {
                    alert("차량 미팅 날짜는 새벽입니다. 미팅날짜는 공항출발다음날로 지정됩니다.");
                    currentDate.setDate(currentDate.getDate() + 1);
                }
                $(el).closest("table").find("input[name='date_trip[]']").val(currentDate.toISOString().split('T')[0]);
            }


        }

    }

    $(".view-policy").on("click", function(event) {
        event.stopPropagation();
        let type = $(this).data("type");
        if (type == 1) {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[1]["policy_contents"]) ?>`);
        } else if (type == 2) {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[0]["policy_contents"]) ?>`);
        } else if (type == 3) {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[2]["policy_contents"]) ?>`);
        } else {
            $(".reservation_pop #policyContent").html(`<?= viewSQ($reservaion_policy[3]["policy_contents"]) ?>`);
        }

        let title = $(this).closest(".item-info-check").find("label").text().trim();

        $(".reservation_pop .popup_place__head__ttl h2").text(title);
        $(".reservation_pop").show();
    });

    $('.item_check_term_').click(function() {
        $(this).toggleClass('checked_');
        let input = $(this).find('input');
        input.val($(this).hasClass('checked_') ? 'Y' : 'N');

        checkOrUncheckAll();
    });

    function checkOrUncheckAll() {
        let allChecked = true;

        $('.item_check_term_').each(function() {
            let input = $(this).find('input');
            if (input.val() !== 'Y') {
                allChecked = false;
                return false;
            }
        });

        let allCheckbox = $('.item_check_term_all_');
        let allInput = allCheckbox.find('input');
        allCheckbox.toggleClass('checked_', allChecked);
        allInput.val(allChecked ? 'Y' : 'N');
    }

    $('.item_check_term_all_').click(function() {
        $(this).toggleClass('checked_');
        let allChecked = $(this).hasClass('checked_');
        let value = allChecked ? 'Y' : 'N';
        $(this).find('input').val(value);

        $('.item_check_term_').each(function() {
            $(this).toggleClass('checked_', allChecked);
            $(this).find('input').val(value);
        });
    });
</script>

<script>
    $("#policy_show").on("click", function() {
        let productIdx = $(this).data("product-idx");

        $.ajax({
            url: "/mypage/getPolicyContents/" + productIdx,
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#policyContent").html(response.policy_contents);
                    $(".policy_pop, .policy_pop .dim").show();
                } else {
                    $("#policyContent").html("<p>" + response.message + "</p>");
                    $(".policy_pop, .policy_pop .dim").show();
                }
            },
            error: function() {
                $(".policy_pop, .policy_pop .dim").show();
            }
        });
    });

    function closePopup() {
        $(".popup_wrap").hide();
    }
</script>

<script>
    let swiper = new Swiper(".swiper_product_list_", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: ".swiper_product_list_pagination_",
            clickable: true,
        },
        breakpoints: {
            850: {
                slidesPerView: 4,
                spaceBetween: 10,
            }
        }
    });

    $('.list-icon img[alt="heart_icon"]').click(function() {
        if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
            $(this).attr('src', '/uploads/icons/heart_on_icon.png');
        } else {
            $(this).attr('src', '/uploads/icons/heart_icon.png');
        }
    });

    const swiper_content = new Swiper(".swiper-container_tour_content", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 100,
        pagination: {
            el: ".swiper-tour_content-pagination",
        },
    });

    function number_format(number) {
        return number.toLocaleString('ko-KR');
    }

    function handlePayment(status) {

        $("#order_status").val(status);

        if (status == "B") {
            if ($("#order_user_name").val() === "") {
                alert("한국이름을 입력해주세요.");
                $("#order_user_name").focus();
                return false;
            }
            if ($("#order_user_first_name_en").val() === "") {
                alert("영문 이름(First Name)을 입력해주세요.");
                $("#order_user_first_name_en").focus();
                return false;
            }

            if ($("#order_user_last_name_en").val() === "") {
                alert("영문 성(Last Name)을 입력해주세요.");
                $("#order_user_last_name_en").focus();
                return false;
            }

            if ($("#email_1").val() === "" || $("#email_2").val() === "") {
                alert("이메일 주소를 입력해주세요.");
                $("#email_1").focus();
                return false;
            }

            if ($("input[name='radio_phone']:checked").val() === "kor") {
                if ($("#phone_1").val() === "" || $("#phone_2").val() === "" || $("#phone_3").val() === "") {
                    alert("한국번호를 입력해주세요.");
                    return false;
                }
            } else if ($("input[name='radio_phone']:checked").val() === "thai") {
                if ($("#phone_thai").val() === "") {
                    alert("태국번호를 입력해주세요.");
                    return false;
                }
            }
        }

        $('#order_frm').attr('action', '/product-tours/tours-payment-ok');
        $("#order_frm").submit();
    }

    function handleSubmit(status) {

        $("#order_status").val(status);

        if (status == "W") {
            if ($("#order_user_name").val() === "") {
                alert("한국이름을 입력해주세요.");
                $("#order_user_name").focus();
                return false;
            }
            if ($("#order_user_first_name_en").val() === "") {
                alert("영문 이름(First Name)을 입력해주세요.");
                $("#order_user_first_name_en").focus();
                return false;
            }

            if ($("#order_user_last_name_en").val() === "") {
                alert("영문 성(Last Name)을 입력해주세요.");
                $("#order_user_last_name_en").focus();
                return false;
            }

            if ($("#order_passport_number").val() === "") {
                alert("여권번호를 입력해주세요!");
                $("#order_passport_number").focus();
                return false;
            }

            if ($("#order_passport_expiry_date").val() === "") {
                alert("여권만기일을 입력해주세요!");
                $("#order_passport_expiry_date").focus();
                return false;
            }

            if ($("#order_birth_date").val() === "") {
                alert("생년월일을 입력해주세요!");
                $("#order_birth_date").focus()
                return false;
            }

            if ($("#email_1").val() === "" || $("#email_2").val() === "") {
                alert("이메일 주소를 입력해주세요.");
                $("#email_1").focus();
                return false;
            }

            if ($("input[name='radio_phone']:checked").val() === "kor") {
                if ($("#phone_1").val() === "" || $("#phone_2").val() === "" || $("#phone_3").val() === "") {
                    alert("한국번호를 입력해주세요.");
                    return false;
                }
            } else if ($("input[name='radio_phone']:checked").val() === "thai") {
                if ($("#phone_thai").val() === "") {
                    alert("태국번호를 입력해주세요.");
                    return false;
                }
            }

            let fullagreement = $("#fullagreement").val().trim();
            let terms = $("#terms").val().trim();
            let policy = $("#policy").val().trim();
            let information = $("#information").val().trim();
            let guidelines = $("#guidelines").val().trim();

            if ([fullagreement, terms, policy, information, guidelines].includes("N")) {
                alert("모든 약관에 동의해야 합니다.");
                return false;
            }

        }

        if (status == "B") {

            <?php
                if($type_code_no == "5401"){    
            ?>
                if($(".s_destination_name").val() == "") {
                    alert("목적지 입력해주세요!");
                    $(this).focus();
                    return false;
                }

                if($(".e_departure_name").val() == "") {
                    alert("미팅 장소 입력해주세요!");
                    $(this).focus();
                    return false;
                }
            <?php
                } else {
            ?>
                if($(".s_departure_name").val() == "") {
                    alert("미팅 장소 입력해주세요!");
                    $(this).focus();
                    return false;
                }

                if($(".s_destination_name").val() == "") {
                    alert("목적지 입력해주세요!");
                    $(this).focus();
                    return false;
                }
            <?php
                }
            ?>

            if($(".s_airline_code").val() == "") {
                alert("항공편 명 선택해주세요!");
                return false;
            }

            if($(".s_date_trip").val() == "") {
                alert("항공 도착 날짜 선택해주세요!");
                return false;
            }

            if($(".s_hours").val() == "") {
                alert("항공 도착 시간 선택해주세요!");
                return false;
            }

            if($(".s_minutes").val() == "") {
                alert("항공 도착 시간 선택해주세요!");
                return false;
            }

            if($(".s_schedule_content").val() == "") {
                alert("이동루트 선택해주세요!");
                $(this).focus();
                return false;
            }

            if($(".s_rest_name").val() == "") {
                alert("경유지 선택해주세요!");
                $(this).focus();
                return false;
            }

            if($(".s_order_memo").val() == "") {
                alert("기타요청 입력해주세요!");
                $(this).focus();
                return false;
            }

            if($(".e_date_trip").val() == "") {
                alert("차량 미팅 날짜 선택해주세요!");
                return false;
            }

            if($(".e_hours").val() == "") {
                alert("미팅 시간 선택해주세요!");
                return false;
            }

            if($(".e_hours").val() == "") {
                alert("미팅 시간 선택해주세요!");
                return false;
            }

            if($(".s_minutes").val() == "") {
                alert("항공 도착 시간 선택해주세요!");
                return false;
            }

            if($(".e_departure_name").val() == "") {
                alert("미팅 장소 입력해주세요!");
                $(this).focus();
                return false;
            }

            if($(".e_airline_code").val() == "") {
                alert("항공편 명 선택해주세요!");
                return false;
            }

            if($(".e_order_memo").val() == "") {
                alert("기타요청 입력해주세요!");
                $(this).focus();
                return false;
            }
        }

       $.ajax({
            url: "/vehicle-guide/vehicle-order",
            type: "POST",
            data: $("#frmCar").serialize(),
            error: function(request, status, error) {
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            success: function(response, status, request) {
                if (response.result == true) {
                    alert(response.message);
                    window.location.href = '/product/completed-order';
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>

<script>
    jQuery(document).ready(function() {

        $("#save_id").click(function() {
            if ($(this).is(":checked")) {
                $("#order_user_name").val(`<?= session("member.name") ?>`);
                const email = `<?= session("member.email") ?>`;
                const emailArr = email.split("@");
                $("#email_1").val(emailArr[0] ?? "");
                $("#email_2").val(emailArr[1] ?? "");
                const phone = `<?= session("member.phone") ?>`;
                const phoneArr = phone.split("-");
                $("#phone_1").val(phoneArr[0] ?? "");
                $("#phone_2").val(phoneArr[1] ?? "");
                $("#phone_3").val(phoneArr[2] ?? "");

                $("#gender1").val(`<?= session("member.gender") ?>`);
                $("#order_user_first_name_en").val(`<?= session("member.first_name_en") ?>`);
                $("#order_user_last_name_en").val(`<?= session("member.last_name_en") ?>`);
                $("#order_passport_number").val(`<?= session("member.passport_number") ?>`);
                $("#order_passport_expiry_date").val(`<?= session("member.passport_expiry_date") ?>`);
                $("#order_birth_date").val(`<?= session("member.birthday") ?>`);
            } else {
                $("#order_user_name").val("");
                $("#email_1").val("");
                $("#email_2").val("");
                $("#phone_1").val("");
                $("#phone_2").val("");
                $("#phone_3").val("");

                $("#gender1").val("");
                $("#order_user_first_name_en").val("");
                $("#order_user_last_name_en").val("");
                $("#order_passport_number").val("");
                $("#order_passport_expiry_date").val("");
                $("#order_birth_date").val("");
            }
        });
    });

    $(".phone").on("input", function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
    });

    $("input[name='radio_phone'").change(function() {
        if ($(this).val() == 'kor') {
            $(".phone_kor").attr("disabled", false).eq(0).focus();
            $(".phone_thai").attr("disabled", true);
        } else {
            $(".phone_thai").attr("disabled", false).focus();
            $(".phone_kor").attr("disabled", true);
        }
    })

    function handleEmail(email) {
        if (email == '1') {
            $("#email_2").val('').prop('readonly', false).focus();
        } else {
            $("#email_2").val(email).prop('readonly', true);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.short_link');

        links.forEach(link => {
            link.addEventListener('click', function() {
                links.forEach(link => link.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>

<?php $this->endSection(); ?>