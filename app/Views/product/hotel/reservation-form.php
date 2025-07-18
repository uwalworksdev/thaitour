<?php $this->extend('inc/layout_index'); ?>
<?php
	$setting   = homeSetInfo();
	$baht_thai = $setting['baht_thai'];
	echo "baht_thai- ". $baht_thai;
?>
<?php $this->section('content'); ?>
<link rel="stylesheet" type="text/css" href="/css/contents/reservation.css"/>
    <div class="customer-form-page reservation-form-cus">
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
            <form action="product-hotel/reservation-form-insert" name="order_frm" id="order_frm" method="post">
                <input type="hidden" name="order_status" id="order_status" value="W">
                <input type="hidden" name="start_date" id="start_date" value="<?=$start_day?>">
                <input type="hidden" name="end_date"   id="end_date"   value="<?=$end_day?>">
				<input type="hidden" name="bed_type"   id="bed_type"   value="<?=$bed_type?>">
				<input type="hidden" name="bed_idx"    id="bed_idx"   value="<?=$bed_idx?>">
				
				<input type="hidden" name="price"      id="price"      value="<?=$price?>">
				<input type="hidden" name="price_won"  id="price_won"  value="<?=$price_won?>">
				<input type="hidden" name="room"       id="room"       value="<?=$room?>">
				<input type="hidden" name="room_type"  id="room_type"  value="<?=$room_type?>">
				<input type="hidden" name="rooms_idx"  id="rooms_idx"  value="<?=$rooms_idx?>">
				<input type="hidden" name="room_g_idx"  id="room_g_idx"  value="<?=$room_g_idx?>">

				<input type="hidden" name="date_price" id="date_price" value="<?=$date_price?>">				
				<input type="hidden" name="extra_won"  id="extra_won"  value="<?=$extra_won?>">				
				<input type="hidden" name="extra_bath" id="extra_bath" value="<?=$extra_bath?>">				
				<input type="hidden" name="breakfast"  id="breakfast"  value="<?=$breakfast?>">				
				<input type="hidden" name="adult"      id="adult"      value="<?=$adult?>">				
				<input type="hidden" name="kids"       id="kids"       value="<?=$kids?>">	
				<input type="hidden" name="total_last_price"  id="total_last_price" value="<?=$total_last_price?>">	
				<input type="hidden" name="extra_cost" id="extra_cost" value="<?=$extra_cost?>">				
				<input type="hidden" name="baht_thai"  id="baht_thai"  value="<?=$baht_thai?>">				
				
                <div class="container-card">
                    <div class="">
                        <div class="card-left2 card_relative_">
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
                                    <label for="order_user_name">한국이름 *</label>
                                    <input type="text" id="order_user_name" name="order_user_name" class="ip_only_ko" required=""
                                           data-label="한국이름" placeholder="한국이름 작성해주세요.">
                                </div>
                                <div class="form-group" style="width: 50%">
                                    <label for="gender1">성별(남성/여성) *</label>
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
                                    <input type="text" id="order_user_first_name_en" class="ip_only_en" name="order_user_first_name_en" data-label="영문 이름" placeholder="영어로 작성해주세요.">
                                </div>
                                <div class="form-group">
                                    <label for="order_user_last_name_en">영문 성(Last Name) *</label>
                                    <input type="text" id="order_user_last_name_en" class="ip_only_en" name="order_user_last_name_en" data-label="영문 성" placeholder="영어로 작성해주세요.">
                                </div>
                            </div>
							
							<!-- 2025/02/10 추가부분 S: -->
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
                                    <input type="text" id="order_birth_date" class="date_form" name="order_birth_date"
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

                            <!--div class="btn_readmore_">
                                <p>상세보기 열기</p>
                                <img src="/images/svg/chevron-double-down.svg" alt="">
                            </div-->
                        </div>

                        <div class="card-left card_relative_ full_" id="product_info_card_">
                            <div class="book_cont" id="book_cont">
                                <table class="book_tbl seperateRoom tbl_request" id=""
                                       style="border-bottom:0px;">
                                    <colgroup>
                                        <col width="25%">
                                        <col width="75%">
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <th>룸타입/프로모션</th>
                                        <td>
                                            <?= $room ?>[<?= $room_type ?>]
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>식사</th>
                                        <td>
                                            <?php
                                            if ($breakfast == 'N') {
                                                $meals = "없음";
                                            } else {
                                                $meals = "조식포함";
                                            }
                                            ?>
                                            <span><?= $meals ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>체크인/체크아웃</th>
                                        <td>
                                            <span id="start_day"><?=$start_day?></span>
                                            ~
                                            <span id="end_day"><?=$end_day?></span>
                                            (<?= $number_day ?>박)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>객실수/총인원</th>
                                        <td>
                                            <?=$number_room?> 룸 / 성인 <?= $adult?>명 아동 <?= $kids?>명
                                        </td>
                                    </tr>
                                    <!--tr>
                                        <th>포함사항</th>
                                        <td class="info_ra">
                                            <?php
                                            $codes = array_map(fn($code) => "<span>{$code['code_name']}</span>", $fresult4);
                                            echo implode(', ', $codes);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>침대구성</th>
                                        <td class="info_ra">
                                            <?=$bed_type?>
                                            <!--br>
                                            <span class="f_14 f_red">※ 베드타입은 보장사항이 아닌 요청사항이며, 체크인시 호텔에서 확인해주시기 바랍니다.</span-->
                                        <!--/td>
                                    </tr-->
									
									<?php if($extra_won > 0) { ?>
                                    <tr>
                                        <th>Extra 베드</th>
                                        <td class="info_ra">
                                            <?=$extra_won?>원 (<?=$extra_bath?>바트)
                                        </td>
                                    </tr>
									<?php } ?>
											
                                    <tr>
                                        <th>중요안내</th>
                                        <td class="info_ra">
                                            <div class="product_information_">
                                                <?= viewSQ($hotel["product_important_notice"]) ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <!--                                    <tr>-->
                                    <!--                                        <th>요청사항</th>-->
                                    <!--                                        <td>-->
                                    <!--                                            <ul class="list_type02">-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_loc_connect">-->
                                    <!--                                                    <input type="checkbox" name="loc_connect"-->
                                    <!--                                                           id="loc_connect" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="loc_connect">-->
                                    <!--                                                        커넥팅룸-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_loc_adjoin">-->
                                    <!--                                                    <input type="checkbox" name="loc_adjoin"-->
                                    <!--                                                           id="loc_adjoin" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="loc_adjoin">-->
                                    <!--                                                        인접한룸-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_loc_baby">-->
                                    <!--                                                    <input type="checkbox" name="loc_baby"-->
                                    <!--                                                           id="loc_baby" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="loc_baby">-->
                                    <!--                                                        아기침대-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_loc_high">-->
                                    <!--                                                    <input type="checkbox" name="loc_high"-->
                                    <!--                                                           id="loc_high" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="loc_high">-->
                                    <!--                                                        고층-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_loc_low">-->
                                    <!--                                                    <input type="checkbox" name="loc_low"-->
                                    <!--                                                           id="loc_low" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="loc_low">-->
                                    <!--                                                        저층-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_no_smoke">-->
                                    <!--                                                    <input type="checkbox" name="no_smoke"-->
                                    <!--                                                           id="no_smoke" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="no_smoke">-->
                                    <!--                                                        금연방-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_smoke">-->
                                    <!--                                                    <input type="checkbox" name="smoke"-->
                                    <!--                                                           id="smoke" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="smoke">-->
                                    <!--                                                        흡연방-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_honeymoon">-->
                                    <!--                                                    <input type="checkbox" name="honeymoon"-->
                                    <!--                                                           id="honeymoon" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="honeymoon">-->
                                    <!--                                                        허니문-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                                <li class="bs-input-check fl ml5 mb5" id="li_wheelchair">-->
                                    <!--                                                    <input type="checkbox" name="wheelchair"-->
                                    <!--                                                           id="wheelchair" value="Y">-->
                                    <!--                                                    <label class="pubcheck" for="wheelchair">-->
                                    <!--                                                        휠체어-->
                                    <!--                                                    </label>-->
                                    <!--                                                </li>-->
                                    <!--                                            </ul>-->
                                    <!--                                            <ul class="list_type02 f_14 f_gray">-->
                                    <!--                                                <li>※ 추가요청사항은 확정사항이 아닙니다. 체크인시 호텔에서 확인 해주시기 바랍니다.<br>-->
                                    <!--                                                    또한 흡연룸, 커넥팅룸 등이 없는 호텔은 요청사항을 체크하셔도 반영되지 않습니다.-->
                                    <!--                                                </li>-->
                                    <!--                                            </ul>-->
                                    <!--                                        </td>-->
                                    <!--                                    </tr>-->
                                    <!--                                    <tr>-->
                                    <!--                                        <th>-->
                                    <!--                                            <label for="requestMemo">기타 요청</label>-->
                                    <!--                                        </th>-->
                                    <!--                                        <td>-->
                                    <!--                                        <textarea class="memo" name="requestMemo" id="requestMemo" rows="10"-->
                                    <!--                                                  placeholder="호텔로 직접 전달되므로 반드시 영어로 기재해주세요."></textarea>-->
                                    <!--                                        </td>-->
                                    <!--                                    </tr>-->
                                    </tbody>
                                </table>

                                <div class="box_gr02">
                                    <div class="explain_point">
                                        <h5>유의사항</h5>
                                        <div class="txt_me01">
                                            <?= viewSQ($policy["policy_contents"]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--div class="btn_unreadmore_">
                                <p>상세보기 닫기</p>
                                <img src="/images/svg/chevron-double-up.svg" alt="">
                            </div-->
                        </div>

                        <script>
                            let down_src_ = '/images/svg/chevron-double-down.svg';
                            let up_src_ = '/images/svg/chevron-double-up.svg';

                            //let ttl_open_ = '상세보기 열기';
                            //let ttl_close_ = '상세보기 닫기';

                            $(document).ready(function () {
                                // $('.btn_readmore_').click(function () {
                                //     let book_cont = $('#book_cont');
                                //     book_cont.toggleClass('full_')
                                //     let ttl_readmore_ = $('#ttl_readmore_');
                                //     let image_readmore_ = $('#image_readmore_');
                                //     if (book_cont.hasClass('full_')) {
                                //         ttl_readmore_.text(ttl_close_)
                                //         image_readmore_.attr('src', up_src_)
                                //     } else {
                                //         ttl_readmore_.text(ttl_open_)
                                //         image_readmore_.attr('src', down_src_)
                                //     }
                                // })

                                $('.btn_readmore_').click(function () {
                                    $('#product_info_card_').addClass('full_');
                                    $(this).css('display', 'none');
                                    $('.btn_unreadmore_').css('display', 'flex');
                                })

                                $('.btn_unreadmore_').click(function () {
                                    $('#product_info_card_').removeClass('full_');
                                    $(this).css('display', 'none');
                                    $('.btn_readmore_').css('display', 'flex');
                                })
                            })
                        </script>

                        <div class="card-left2 card_left_end_">
                            <h3 class="title-main-c">
                                별도 요청
                            </h3>
                            <ul class="list_type02">
                                <?php foreach ($fcodes as $code): ?>
                                    <li class="bs-input-check fl ml5 mb5" id="li_inp_code_<?= $code['code_no'] ?>">
                                        <input type="checkbox" name="inp_code_additional_request"
                                               id="inp_code_<?= $code['code_no'] ?>" value="<?= $code['code_no'] ?>">
                                        <label class="pubcheck" for="inp_code_<?= $code['code_no'] ?>">
                                            <?= $code['code_name'] ?>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="list_type02 f_14 f_gray">
                                <li>※ 추가요청사항은 확정사항이 아닙니다. 체크인시 호텔에서 확인 해주시기 바랍니다.<br>
                                    또한 흡연룸, 커넥팅룸 등이 없는 호텔은 요청사항을 체크하셔도 반영되지 않습니다.
                                </li>
                            </ul>
                            <p class="title-sub-below">숙소는 최선을 다해 요청 사항을 제공해 드릴 수 있도록 최선을 다하겠습니다. 다만, 사정에 따라 제공 여부가 보장되지
                                않을 수 있습니다.</p>
                            <div class="form-group cus-form-group">
                                <textarea id="extra-requests" name="order_memo"
                                          placeholder="여기에 요청 사항을 입력하세요(선택사항)"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="card-right">
                            <?php
                            if (!empty($hotel['ufile1'])) {
                                $img = "/data/product/" . $hotel['ufile1'];
                            } else {
                                $img = "";
                            }
                            ?>
                            <img src="<?= $img ?>" alt="<?= $hotel['rfile1'] ?>">
                            <div class="below-right">
                                <h3 class="title-r"><?= $hotel["product_name"] ?></h3>
                                <p class="title-sub-r text-gray"><?= $hotel["addrs"] ?></p>
                            </div>
                        </div>
                        <div class="card-right2">
                            <h3 class="title-r">
                                요금정보
                            </h3>
                            <?php
                            $order_price = intval($last_price) + intval($extra_cost);
                            ?>
                            <div class="item-info-r">
                                <span>객실(<?=$bed_type?>) <?= $number_room ?>개 X <?= $number_day ?>박</span>
                                <?php
                                    if($room_data["secret_price"] == "Y"){
                                ?>      
                                    <span class="font-bold" style="color: red;">가격 공개 불가능합니다</span>
                                <?php
                                    }else{
                                ?>
                                    <span class="font-bold"><?= number_format($price_won) ?> 원</span>
                                <?php
                                    }
                                ?>
                            </div>
							<!--
                            <div class="item-info-r item-info-r-border-b">
                                <span>세금&서비스비용</span>
                                <?php
                                    if($room_data["secret_price"] == "Y"){
                                ?>      
                                    <span class="font-bold" style="color: red;">가격 공개 불가능합니다</span>
                                <?php
                                    }else{
                                ?>
                                <span class="font-bold"><?= number_format($extra_cost) ?> 원</span>
                                <?php
                                    }
                                ?>
                            </div>
							-->
							<?php if($extra_won > 0) { ?>
                            <div class="item-info-r item-info-r-border-b">
                                <span>Extra 베드</span>
                                <span class="font-bold"><?= number_format($extra_won) ?> 원</span>
                            </div>
							<?php } ?>
								
                            <div class="item-info-r font-bold-cus">
                                <span>합계</span>
                                <?php
                                    if($room_data["secret_price"] == "Y"){
                                ?>      
                                    <span class="font-bold" style="color: red;">가격 공개 불가능합니다</span>
                                <?php
                                    }else{
                                ?>
                                <span><?= number_format($order_price) ?> 원</span>
                                <?php } ?>
                            </div>
                            <p class="below-des-price">
                                · 체크인하시려면 3일 전에 숙소로 연락해 주세요<br>· 선택하신 객실 유형의 체크인 시간은 14:00~24:00 사이,
                                체크아웃 시간은 06:00~12:00입니다.<br>· 온수 (지정시간 제공)
                            </p>
                            <p class="summary-tb">*취소규정: 결제 후 취소하시려면 결제하신 금액의 50% 요금이 부과됩니다.</p>
                            <p class="summary-tb2" id="policy_show" data-product-idx="<?= $hotel['product_code_1'] ?>">본 예약건 취소규정 자세히보기</p>
                            <h3 class="title-r">약관동의</h3>
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
                                <label for="">여행안전수칙 동의(필수)</label>
                                <button type="button" data-type="4" class="view-policy">[보기]</button>
                                <input type="hidden" value="N" id="guidelines">
                            </div>
							<?php if($hotel['direct_payment'] == "Y") { ?>
							<span style="color:red;">※ 예약확정 상품입니다.</span>
                            <button type="button" class="btn-order" value="X">결제하기</button>
							<?php } else { ?>
                            <button type="button" class="btn-order" value="W">예약하기</button>
							<?php } ?>
                            <button type="button" class="btn-default cart btn-cart" value="B">장바구니</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="product_idx" id="product_idx" value="<?= $hotel["product_idx"] ?>">
                <input type="hidden" name="ho_idx" id="ho_idx" value="<?= $ho_idx ?>">
                <input type="hidden" name="room_op_idx" id="room_op_idx" value="<?= $room_op_idx ?>">
                <input type="hidden" name="use_coupon_idx" id="use_coupon_idx" value="<?= $use_coupon_idx ?>">
                <input type="hidden" name="use_op_type" id="use_op_type" value="<?= $use_op_type ?>">
                <input type="hidden" name="used_coupon_money" id="used_coupon_money" value="<?= $used_coupon_money ?>">
                <input type="hidden" name="room_op_price_sale" id="room_op_price_sale"
                       value="<?= $room_op_price_sale ?>">
                <input type="hidden" name="inital_price" id="inital_price" value="<?= $inital_price ?>">
                <input type="hidden" name="last_price" id="last_price" value="<?= $last_price ?>">
                <input type="hidden" name="order_price" id="order_price" value="<?= $order_price ?>">
                <input type="hidden" name="number_room" id="number_room" value="<?= $number_room ?>">
                <input type="hidden" name="number_day" id="number_day" value="<?= $number_day ?>">
                <input type="hidden" name="additional_request" id="additional_request" value="">
            </form>
        </div>
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
                         <div class="only_web">
                             <div id="policyContent"></div>
                         </div>
                        <div class="only_mo">
                             <div id="policyContent_m"></div>
                         </div>
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

    <script>
        $(".ip_only_ko").on("input", function () {
            let koreanText = $(this).val().replace(/[^가-힣ㄱ-ㅎㅏ-ㅣ\s]/g, ""); 
            $(this).val(koreanText);
        });

        // $(".ip_only_en").on("input", function () {
        //     // $(this).val($(this).val().replace(/[^a-zA-Z\s]/g, ""));
        //     let inputValue = $(this).val();
    
        //     if (/[가-힣]/.test(inputValue)) {
        //         alert("영문만 입력됩니다"); 
        //         $(this).val(inputValue.replace(/[가-힣]/g, ""));
        //     } else {
        //         $(this).val(inputValue.replace(/[^a-zA-Z\s]/g, "")); 
        //     }
        // });

        $(document).ready(function () {

            $("#save_id").click(function () {
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

            $(".view-policy").on("click", function (event) {
                event.stopPropagation();
                let type = $(this).data("type");
                if(type == 1) {
                    $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[1]["policy_contents"])?>`);
                }else if(type == 2) {
                    $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[0]["policy_contents"])?>`);
                }else if(type == 3) {
                    $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[2]["policy_contents"])?>`);
                }else {
                    $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[3]["policy_contents"])?>`);
                }

                let title = $(this).closest(".item-info-check").find("label").text().trim();

                $(".reservation_pop .popup_place__head__ttl h2").text(title);
                $(".reservation_pop").show();
            });

            $('.item_check_term_').click(function () {
                $(this).toggleClass('checked_');
                let input = $(this).find('input');
                input.val($(this).hasClass('checked_') ? 'Y' : 'N');

                checkOrUncheckAll();
            });

            function checkOrUncheckAll() {
                let allChecked = true;

                $('.item_check_term_').each(function () {
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

            $('.item_check_term_all_').click(function () {
                $(this).toggleClass('checked_');
                let allChecked = $(this).hasClass('checked_');
                let value = allChecked ? 'Y' : 'N';
                $(this).find('input').val(value);

                $('.item_check_term_').each(function () {
                    $(this).toggleClass('checked_', allChecked);
                    $(this).find('input').val(value);
                });
            });

            $(".phone").on("input", function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ""));
            });

            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('/');
            }

			$(".date_form").datepicker({
				dateFormat: "yy-mm-dd",
				showOn: "focus", 	
				//showOn: "both",
				//buttonImage: "/images/ico/date_ico.png",
				//buttonImageOnly: true
			});

			$("#checkin, #checkout").datepicker({
                dateFormat: 'yy/mm/dd',
                onSelect: function (dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    $(this).val(formatDate(date));
                }
            });

            $('#checkin').val(formatDate('2024/07/09'));
            $('#checkout').val(formatDate('2024/07/10'));


            $('.tab_box_element_').on('click', function () {

                $('.tab_box_element_').removeClass('tab_active_');


                $(this).addClass('tab_active_');


                const tabId = $(this).attr('rel');
                $('.tab_content').hide();
                $('#' + tabId).show();
            });

            $(".item-clause-all").click(function () {
                if ($(this).hasClass("click")) {
                    $(this).removeClass("click");
                    $('.item-clause-item').each(function () {
                        $(this).removeClass("acti");
                        $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                    })
                } else {
                    $(this).addClass("click");
                    $('.item-clause-item').each(function () {
                        $(this).addClass("acti");
                        $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
                    })
                }
            });

            $(".item-clause-item").click(function () {
                if ($(this).hasClass("acti")) {
                    $(this).removeClass("acti");
                    $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                } else {
                    $(this).addClass("acti");
                    $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
                }

                var allHaveActi = true;

                $('.item-clause-item').each(function () {
                    if (!$(this).hasClass('acti')) {
                        allHaveActi = false;
                        return false;
                    }
                });
                if (allHaveActi) {
                    $(".item-clause-all").addClass("click")
                } else {
                    $(".item-clause-all").removeClass("click")
                }
            });

            $("input[name='radio_phone'").change(function () {
                if ($(this).val() == 'kor') {
                    $(".phone_kor").attr("disabled", false).eq(0).focus();
                    $(".phone_thai").attr("disabled", true);
                } else {
                    $(".phone_thai").attr("disabled", false).focus();
                    $(".phone_kor").attr("disabled", true);
                }
            })
        });

        function handleEmail(email) {
            if (email == '1') {
                $("#email_2").val('').prop('readonly', false).focus();
            } else {
                $("#email_2").val(email).prop('readonly', true);
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('/');
            }

            $("#checkin, #checkout").datepicker({
                dateFormat: 'yy/mm/dd',
                onSelect: function (dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    $(this).val(formatDate(date));
                }
            });

            $('#checkin').val(formatDate('2024/07/09'));
            $('#checkout').val(formatDate('2024/07/10'));

            $('.tab_box_element_').on('click', function () {

                $('.tab_box_element_').removeClass('tab_active_');

                $(this).addClass('tab_active_');

                const tabId = $(this).attr('rel');
                $('.tab_content').hide();
                $('#' + tabId).show();
            });

            // add, remove element
            var guestCounter = {};

            $(".form-container").each(function () {
                let group = $(this).data("group");
                guestCounter[group] = 1;
            });

            // Function to update the visibility of the remove-item button
            function updateRemoveButtonVisibility(group) {
                if (guestCounter[group] > 1) {
                    $(`.remove-item[data-group="${group}"]`).show();
                } else {
                    $(`.remove-item[data-group="${group}"]`).hide();
                }
            }

            // Initially hide remove buttons
            $('.remove-item').hide();

            // Function to add new parent-form-group
            $('.add-item').on('click', function () {
                var group = $(this).data('group');
                guestCounter[group]++; // Increment guest counter for the specific group

                // Create a new parent-form-group for the specific group
                var newFormGroup = `
                    <div class="parent-form-group mt-30">
                        <div class="form-group">
                            <input type="hidden" name="order_num_room[]" value="${group}"/>

                            <label for="first-name-${group}-${guestCounter[group]}">영문 이름(First Name) *</label>
                            <input type="text" name="order_first_name[]" id="first-name-${group}-${guestCounter[group]}" placeholder="영어로 작성해주세요." />
                        </div>
                        <div class="form-group">
                            <label for="last-name-${group}-${guestCounter[group]}">영문 성(Last Name) *</label>
                            <input type="text" name="order_last_name[]" id="last-name-${group}-${guestCounter[group]}" placeholder="영어로 작성해주세요." />
                        </div>
                    </div>
                `;

                // Append the new form group right after the first parent-form-group in the correct group
                $(`.form-container[data-group="${group}"] .parent-form-group:first`).after(newFormGroup);

                // Update the remove button visibility
                updateRemoveButtonVisibility(group);
            });

            // Function to remove the last parent-form-group
            $('.remove-item').on('click', function () {
                var group = $(this).data('group');

                // Make sure there's more than one parent-form-group before removing
                if ($(`.form-container[data-group="${group}"] .parent-form-group`).length > 1) {
                    $(`.form-container[data-group="${group}"] .parent-form-group`).last().remove();
                    guestCounter[group]--; // Decrement guest counter for the specific group
                } else {
                    alert('최소한 한 명의 손님이 있어야 합니다.');
                }

                // Update the remove button visibility
                updateRemoveButtonVisibility(group);
            });

            $(".item-clause-all").click(function () {
                if ($(this).hasClass("click")) {
                    $(this).removeClass("click");
                    $('.item-clause-item').each(function () {
                        $(this).removeClass("acti");
                        $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                    })
                } else {
                    $(this).addClass("click");
                    $('.item-clause-item').each(function () {
                        $(this).addClass("acti");
                        $(this).find("img").attr("src", "/uploads/icons/form_check_icon_black.png");
                    })
                }
            });

            $(".item-clause-item").click(function () {
                if ($(this).hasClass("acti")) {
                    $(this).removeClass("acti");
                    $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                } else {
                    $(this).addClass("acti");
                    $(this).find("img").attr("src", "/uploads/icons/form_check_icon_black.png");
                }

                var allHaveActi = true;

                $('.item-clause-item').each(function () {
                    if (!$(this).hasClass('acti')) {
                        allHaveActi = false;
                        return false;
                    }
                });
                if (allHaveActi) {
                    $(".item-clause-all").addClass("click")
                } else {
                    $(".item-clause-all").removeClass("click")
                }
            });

            $(".btn-payment").click(function () {
				
                const frm = document.order_frm;
                let formData = new FormData($('#order_frm')[0]);

                if ($("#email_name").val() === "") {
                    alert("이메일 입력해주세요!");
                    return false;
                }

                if ($("#email_host").val() === "") {
                    alert("이메일 입력해주세요!");
                    return false;
                }

                if ($("#order_user_mobile").val() === "") {
                    alert("휴대폰번호 입력해주세요!");
                    return false;
                }

                /* Collect values for validation */
                let fullagreement = $("#fullagreement").val().trim();
                let terms = $("#terms").val().trim();
                let policy = $("#policy").val().trim();
                let information = $("#information").val().trim();

                /* Check for agreement validation */
                if ([fullagreement, terms, policy, information].includes("N")) {
                    alert("모든 약관에 동의해야 합니다.");
                    return false;
                }

                let additional_request = "";
                $("input[name=inp_code_additional_request]:checked").each(function () {
                    additional_request += $(this).val() + '|';
                })

                $('#additional_request').val(additional_request);

				//let frm = document.getElementById('order_frm'); // 또는 $('#order_frm')[0]
				$('#order_frm').attr('action', '/product-hotel/custhotel-payment-ok');
				frm.submit();

				
            });
			
            $(".btn-order, .btn-cart").click(function () {
                var $btn = $(this);
                if ($btn.prop("disabled")) return; 
                $btn.prop("disabled", true);


                var order_status = $(this).val();
                $("#order_status").val(order_status);
                const frm = document.order_frm;
                let formData = new FormData($('#order_frm')[0]);

                /* Collect values for validation */
                let fullagreement = $("#fullagreement").val().trim();
                let terms = $("#terms").val().trim();
                let policy = $("#policy").val().trim();
                let information = $("#information").val().trim();
                let guidelines = $("#guidelines").val().trim();

                if(order_status == "W") {
                    if ($("#order_user_name").val() === "") {
                        alert("한글명을 입력해주세요!");
                        $("#order_user_name").focus();
                        return false;
                    }

                    if ($("#order_user_first_name_en").val() === "") {
                        alert("영문명을 입력해주세요!");
                        $("#order_user_first_name_en").focus()
                        return false;
                    }
                    
                    if ($("#order_user_last_name_en").val() === "") {
                        alert("영문명을 입력해주세요!");
                        $("#order_user_last_name_en").focus()
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

                    /* Check for agreement validation */
                    if ([fullagreement, terms, policy, information, guidelines].includes("N")) {
                        alert("모든 약관에 동의해야 합니다.");
                        return false;
                    }
                }

                let additional_request = "";
                $("input[name=inp_code_additional_request]:checked").each(function () {
                    additional_request += $(this).val() + '|';
                })

                $('#additional_request').val(additional_request);

                formData.append('additional_request', additional_request);
                // var fieldBool = true;

                // $(".order_body .required").each(function() {
                //     if ($(this).val().trim() == "") {
                //         var label = $(this).attr("rel")?.trim() || "";
                //         alert("[" + label + "] 는 필수 값입니다.");
                //         $(this).focus();
                //         fieldBool = false;
                //         return false;
                //     }
                // });

                // if (fieldBool == false) {
                //     return false;
                // }

                $.ajax({
                    url: "/product-hotel/reservation-form-insert",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
                        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        $btn.prop("disabled", false);
                    },
                    success: function (response, status, request) {
                        if (response.result == true) {
                            alert(response.message);
							if($("#order_status").val() == "W") {
                               window.location.href = '/product/completed-order';
							} else {   
                               window.location.href = '/product/completed-cart';
							}   
                        } else {
                            alert(response.message);
                            $btn.prop("disabled", false);
                        }
                    }
                });

            });


        });

        function changeStartDate() {
            let date = `<?= $start_day ?>`;
            date = formatDateWithKoreanWeekday(date);
            $('#start_date').text(date);
        }

        function changeEndDate() {
            let date = `<?= $end_day ?>`;
            date = formatDateWithKoreanWeekday(date);
            $('#end_date').text(date);
        }

        document.addEventListener("DOMContentLoaded", function (event) {
            changeStartDate();
            changeEndDate();
        });
    </script>
    <!-- More fn -->
    <script>
        function formatDateWithKoreanWeekday(dateString) {
            const date = new Date(dateString);
            const options = {
                weekday: 'short'
            };
            const koreanWeekday = new Intl.DateTimeFormat('ko-KR', options).format(date);
            return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}(${koreanWeekday})`;
        }
    </script>
    <!-- Popup fn -->
    <script>
        function closePopup() {
            $(".popup_wrap").hide();
            // $(".dim").hide();
        }

        $(".popup_wrap .dim").on("click", function () {
            $(".popup_wrap").hide();
        });

        // $("#policy_show").on("click", function () {
        //     $(".policy_pop, .policy_pop .dim").show();
        // });

        $("#policy_show").on("click", function() {
            let productIdx = $(this).data("product-idx");

            $.ajax({
                url: "/mypage/getPolicyContents/" + productIdx,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $("#policyContent").html(response.policy_contents);
                        $("#policyContent_m").html(response.policy_contents_m);
                        $(".policy_pop, .policy_pop .dim").show();
                    } else {
                        $("#policyContent").html("<p>" + response.message + "</p>");
                        $("#policyContent_m").html("<p>" + response.message + "</p>");
                        $(".policy_pop, .policy_pop .dim").show();
                    }
                },
                error: function() {
                    $(".policy_pop, .policy_pop .dim").show();
                }
            });
        });
    </script>
<?php $this->endSection(); ?>