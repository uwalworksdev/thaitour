<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<?php $setting = homeSetInfo(); ?>

<style>
    @media screen and (max-width : 850px) {
        .tours-detail .section2 .title-main-c {
            font-size: 3rem;
            margin-bottom: 5rem;
        }

        .tours-detail .section2 .title-sub-c {
            font-size: 2.8rem;
            margin-bottom: 3rem;
        }

        .tours-detail .section2 .form-group input {
            padding: 0 0.9375em;
            height: 8.8rem;
            width: 100%;
            margin-bottom: unset;
            display: block;
            cursor: pointer;
        }

        .phone_wrap {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .tours-detail .sec2-item-card.card-left2 .form-group.spe .form-group-cus-4input {
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
            display: flex;
        }

        .tours-detail .section2 .form-group .email-group input {
            width: 20rem
        }

        .tours-detail .card-left2 .cus-select-group select {
            width: 30rem;
        }

        .tours-detail .section2 .top_order {
            flex-direction: column;
            gap: 3rem
        }

        .tours-detail .section2 .sec2-item-card .text_title h2 {
            font-size: 3.4rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .tours-detail .section2 .sec2-item-card .text_title h3 {
            font-size: 3.2rem;
            font-weight: 700;
            color: #454545;
            text-align: left;
        }

        .order-form-page .main-order-form-container h1 {
            font-size: 3.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .order-form-page .main-order-form-container p {
            font-size: 2.7rem;
        }

        .tours-detail .container-calendar {
            display: flex;
            margin-top: 20px;
            border-top: 1px solid rgb(216, 216, 216);
            padding-top: 0px;
            position: relative;
        }

        .order-form-page .main-order-form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: start;
            padding: 5rem 0;
            background-color: #fff;
            margin-bottom: 6rem;
            width: 100%;
        }

        .order-form-page .two-table-tb {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-direction: column;
            gap: 20px;
        }

        .order-form-page .info-table-order {
            width: 100%;
            border-collapse: collapse;
        }

        .order-form-page .info-table-order td {
            border: 1px solid #ddd;
            border-left: none;
            border-right: none;
            padding: 20px;
            font-size: 15px;
            line-height: 1.3;
        }

        .order-form-page .info-table-order td .flex.new {
            gap: 10px;
            flex-direction: column;

        }

        .order-form-page .info-table-order.info-table-cus-padding td input {
            height: 50px;
            width: 100%;
        }

        .order-form-page .two-table-tb .textarea-tb {
            width: 100%;
            height: 90px;
        }

        .tours-detail .section2 .sec2-item-card:last-child {
            padding-bottom: 20rem;
        }


        .order-form-page .container-below-tb {
            position: absolute;
            bottom: -6%;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tours-detail .primary-btn-calendar.tours {
            position: unset !important;
            transform: translateX(0);
            bottom: -12%;
            left: 0;
            width: 26rem;
            height: 8rem;
            border-radius: 6px;
            background-color: rgb(42, 69, 159);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin: 0;
        }

        .order-form-page .container-below-tb .primary-btn-sub {
            width: 26rem;
            height: 8rem;
            border-radius: 6px;
            background-color: white;
            border: 1px solid rgb(219, 219, 219);
            color: black;
            font-size: 18px;
        }

        .order-form-page .info-table-order th {
            background-color: #f5f7fa;
            width: 14rem;
        }
    }
</style>


<div class="content-sub-hotel-detail tours-detail">
    <div class="body_inner">
        <div class="section2" id="product_info">
            <form action="/product-tours/customer-form-ok" name="order_frm" id="order_frm" method="post">
                <input type="hidden" name="product_idx" value="<?= $product['product_idx'] ?>">
                <input type="hidden" name="product_code_1" value="<?= $product['product_code_1'] ?>">
                <input type="hidden" name="product_code_2" value="<?= $product['product_code_2'] ?>">
                <input type="hidden" name="product_code_3" value=".">
                <input type="hidden" name="product_code_4" value=".">
                <input type="hidden" name="order_date" id="order_date" value="<?= $order_date ?>">
                <input type="hidden" name="order_status" id="order_status" value="W">
                <input type="hidden" name="tours_idx" id="tours_idx" value="<?= $tours_idx ?>">
                <input type="hidden" name="idx" id="idx" value="<?= $idx ?>">
                <input type="hidden" name="total_price" id="total_price" value="<?= $total_price_product ?>">
                <input type="hidden" name="total_price_baht" id="total_price_baht" value="<?= $total_price_product_bath ?>">
                <input type="hidden" name="people_adult_cnt" id="people_adult_cnt" value="<?= $people_adult_cnt ?>">
                <input type="hidden" name="people_kids_cnt" id="people_kids_cnt" value="<?= $people_kids_cnt ?>">
                <input type="hidden" name="people_baby_cnt" id="people_baby_cnt" value="<?= $people_baby_cnt ?>">
                <input type="hidden" name="people_adult_price" id="people_adult_price" value="<?= $people_adult_price ?>">
                <input type="hidden" name="people_kids_price" id="people_kids_price" value="<?= $people_kids_price ?>">
                <input type="hidden" name="people_baby_price" id="people_baby_price" value="<?= $people_baby_price ?>">
                <input type="hidden" name="time_line" id="time_line" value="<?= $time_line ?>">
                <input type="hidden" name="use_coupon_idx" id="use_coupon_idx" value="">
                <input type="hidden" name="final_discount" id="final_discount" value="">
                <input type="hidden" name="moption" id="moption" value="<?= $moption ?>">
                <input type="hidden" name="option" id="option" value="<?= $option ?>">

                <div class="sec2-item-card card-left2">
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
                    <div class="form-group mb-30">
                        <label for="order_user_name">한국이름</label>
                        <input type="text" id="order_user_name" name="order_user_name" required data-label="한국이름" placeholder="한국이름 작성해주세요." />
                    </div>
                    <div class="con-form mb-40">
                        <div class="form-group">
                            <label for="order_user_first_name_en">영문 이름(First Name) *</label>
                            <input type="text" id="order_user_first_name_en" name="order_user_first_name_en" required data-label="영문 이름" placeholder="영어로 작성해주세요." />
                        </div>
                        <div class="form-group">
                            <label for="order_user_last_name_en">영문 성(Last Name) *</label>
                            <input type="text" id="order_user_last_name_en" name="order_user_last_name_en" required data-label="영문 성" placeholder="영어로 작성해주세요." />
                        </div>
                    </div>
                    <h3 class="title-sub-c">연락처</h3>
                    <div class="form-group form-cus-select">
                        <label for="passport-name2">이메일 주소*</label>
                        <div class="cus-select-group">
                            <input type="text" id="email_1" name="email_1" required data-label="이메일" placeholder="이메일" />
                            <span>@</span>
                            <div class="email-group">
                                <input type="text" name="email_2" id="email_2" required data-label="이메일" placeholder="" readonly>
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
                    <div class="phone_wrap">
                        <div class="phone_wrap_item form-group spe">
                            <p>
                                <input type="radio" id="test1" name="radio_phone" value="kor" checked>
                                <label for="test1">한국번호*</label>
                            </p>
                            <div class="form-group form-group-cus-4input">
                                <input name="phone_1" maxlength="3" class="phone_kor phone" type="text" id="phone_1" required data-label="한국번호" />
                                <span> - </span>
                                <input name="phone_2" maxlength="4" class="phone_kor phone" type="text" id="phone_2" required data-label="한국번호" />
                                <span> - </span>
                                <input name="phone_3" maxlength="4" class="phone_kor phone" type="text" id="phone_3" required data-label="한국번호" />
                            </div>
                        </div>
                        <div class="phone_wrap_item form-group">
                            <p>
                                <input type="radio" id="test2" name="radio_phone" value="thai">
                                <label for="test2">태국번호 *</label>
                            </p>
                            <div class="form-group">
                                <input name="phone_thai" maxlength="10" class="phone_thai phone" type="text" id="phone_thai" disabled required data-label="한국번호" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group mo_mt-30">
                        <label for="passport-name2">여행시 현지 연락처</label>
                        <div class="form-group-flex">
                            <select id="car-time-hour" class="select-width">
                                <option value="01">TH</option>
                            </select>
                            <input name="local_phone" class="phone" maxlength="10" type="text" id="local_phone" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="sec2-item-card order-form-page">
                    <div class="top_order flex">
                        <a class="btn_back flex__c" href="/product-tours/item_view/<?= $product['product_idx'] ?>">
                            <img src="/images/ico/arrow_up_icon.png" alt="">
                            <p>뒤로가기</p>
                        </a>
                        <div class="text_title">
                            <h2><?= viewSQ($product['product_name']) ?></h2>
                            <h3><?= viewSQ($tour['tours_subject']) ?></h3>
                        </div>
                    </div>
                    <div class="container-calendar">
                        <div class="main-order-form">
                            <div class="main-order-form-container">
                                <h1>선택하신 날짜에 즉시확정 예약이 가능합니다.</h1>
                                <p class="text-grey">예약 즉시 결제가 가능하며, 엄격하게 관련 예약정책이 발생됩니다.</p>
                            </div>

                            <h2 class="title-above-tb">예약정보</h2>
                            <div class="two-table-tb">
                                <table class="info-table-order">
                                    <tr>
                                        <th>이용일시</th>
                                        <td class="">
                                            <p class="days_choose" id="days_choose"><?= $order_date ?></p>
                                            <p class="time_lines" id="time_lines"><?= $time_line ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>상품명</th>
                                        <td class="name_product" id="name_product"><?= $product['product_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>선택옵션</th>
                                        <td>
                                            <div class="options" id="product_options">
                                                <?php foreach ($tour_option as $index => $option): ?>
                                                    <div class='flex_op flex'>
                                                        <?= $option['option_name'] ?>
                                                        <p class='product_option_pay'> <?= number_format($option_price[$index]) ?> 원</p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>총인원</th>
                                        <td>
                                            <div class="flex new">
                                                <div class="num_people" id="num_people">
                                                    <?= ($people_adult_cnt + $people_kids_cnt + $people_baby_cnt) . '명 (성인: ' . $people_adult_cnt . ', 소아: ' . $people_kids_cnt . ', 유아: ' . $people_baby_cnt . ')' ?>
                                                </div>
                                                <div class="total_price_product"><?= number_format($total_price_product) ?> 원</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>회원등급 할인</th>
                                        <td>없음</td>
                                    </tr>
                                    <tr>
                                        <th>총금액</th>
                                        <td>
                                            <div class="total_pay" id="total_pay">
                                                <?= number_format($final_price) ?> 원
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                            <th>쿠폰 적용</th>
                                            <td class="flex_cou">
                                                <div class="coupon">
                                                    <input type="text" name="coupon" value="" class="bs-input discount_spe final_discount" readonly="">
                                                </div>
                                                <button type="button" class="btn_coupon_shows flex_c_c" onclick="showCouponPop()">쿠푼적용</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>포인트 사용</th>
                                            <td class="flex_cou">
                                                <div class="coupon">
                                                    <input type="text" name="" id="" value="" class="bs-input discount_spe" readonly="">
                                                </div>
                                                <button type="button" class="btn_coupon_shows flex_c_c" onclick="">모두사용</button>
                                            </td>
                                        </tr> -->
                                </table>
                                <div class="">
                                    <table class="info-table-order info-table-cus-padding">
                                        <tr>
                                            <th>미팅장소</th>
                                            <td>
                                                <input type="text" placeholder="호텔명을 영어로 적어주세요(주소불가)" name="start_place" id="start_place">
                                                <span class="note">*일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨주세요.</span>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                                <th>미팅 시간</th>
                                                <td><input type="text" name="metting_time" id="metting_time"></td>
                                            </tr> -->
                                        <tr>
                                            <th>종료 후 내리실 곳</th>
                                            <td><input type="text" placeholder="종료 후 내리실 곳 항목은 필수입력입니다." name="end_place" id="end_place"></td>
                                        </tr>
                                        <tr>
                                            <th>카카오톡 아이디</th>
                                            <td>
                                                <input type="text" placeholder="카카오톡 아이디 항목은 선택 입력입니다." name="id_kakao" id="id_kakao">
                                                <span class="note">*입력하시면 투어진행업체에서 보다 원활하게 연락을 드릴 수 있습니다.</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>기타 요청</th>
                                            <td>
                                                <span class="lb-tb-cus">원하는 미팅 시간을 적어주세요(15:30분 이후)</span>
                                                <textarea class="textarea-tb" rows="5" placeholder="" name="description" id="description">
                                                </textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    <p class="summary-tb">*취소규정: 결제 후 취소하시려면 결제하신 금액의 50% 요금이 부과됩니다.</p>
                                    <p class="summary-tb2" id="policy_show">본 예약건 취소규정 자세히보기</p>
                                </div>
                            </div>
                        </div>
                        <div class="container-below-tb">
                            <?php if ($product['direct_payment'] == "Y") { ?>
                                <button type="button" class="primary-btn-calendar tours" onclick="handlePayment('B')">결제하기</button>
                            <?php } else { ?>
                                <button type="button" class="primary-btn-calendar tours" onclick="handleSubmit('W')">예약하기</button>
                            <?php } ?>
                            <button type="button" class="primary-btn-sub tours" onclick="handleSubmit('B')">장바구니에 담기</button>
                            <!--a href="" class="primary-btn-sub tours">장바구니에 담기</a-->
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <h2 class="title-sec3" id="product_des">
            상품설명
        </h2>
        <?php if ($product['tours_guide'] == 'Y' || $product['tours_ko'] == 'Y' || $product['tours_join'] == 'Y' || $product['tours_total_hour'] == 'Y') { ?>
            <h3 class="title-sec2">
                상품 포인트
            </h3>
            <div class="list-tag-item">
                <?php if ($product['tours_guide'] == 'Y') { ?>
                    <div class="tag-item">
                        <div class="picture">
                            <img src="/uploads/sub/tour_item_1.png" alt="tour_item_1">
                        </div>
                        <span class="label-tag">가이드 유</span>
                    </div>
                <?php }
                if ($product['tours_ko'] == 'Y') { ?>
                    <div class="tag-item">
                        <div class="picture">
                            <img src="/uploads/sub/tour_item_2.png" alt="tour_item_2">
                        </div>
                        <span class="label-tag">한국어</span>
                    </div>
                <?php }
                if ($product['tours_join'] == 'Y') { ?>
                    <div class="tag-item">
                        <div class="picture">
                            <img src="/uploads/sub/tour_item_3.png" alt="tour_item_3">
                        </div>
                        <span class="label-tag">조인투어</span>
                    </div>
                <?php }
                if ($product['tours_total_hour'] == 'Y') { ?>
                    <div class="tag-item">
                        <div class="picture">
                            <img src="/uploads/sub/tour_item_4.png" alt="tour_item_4">
                        </div>
                        <span class="label-tag">총 <?= $product['tours_hour'] ?>시간</span>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ($product['tour_info']) { ?>
            <div class="des-type">
                <?= viewSQ($product['tour_info']) ?>
            </div>
        <?php } ?>
        <?php if (!empty($imgs_tour)): ?>
            <h2 class="title-sec2 tit-swip-pic">
                투어 사진
            </h2>
            <div class="container-pic-slider">
                <div class="swiper-container_tour_content">
                    <div class="swiper-wrapper">
                        <?php foreach ($imgs_tour as $index => $img_tour): ?>
                            <div class="swiper-slide">
                                <img src="<?= $img_tour ?>" alt="tour_details_<?= $index + 1 ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-tour_content-pagination"></div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($product['product_confirm']) { ?>
            <h2 class="title-sec2">
                미팅/픽업장소 안내
            </h2>
            <div class="des-type-1">
                <p>
                    <?= viewSQ($product['product_confirm']) ?>
                </p>
            </div>
        <?php } ?>
        <?php if ($totalDays) { ?>
            <h2 class="title-sec2">
                투어 일정표
            </h2>
            <?php for ($dd = 1; $dd <= $totalDays; $dd++): ?>
                <?php
                $schedule = $schedules[$dd] ?? null;
                ?>
                <span class="tit-blue"><?= $schedule['detail_title'] ?></span>
                <ul class="timeline-con">
                    <?php
                    $groups = $subSchedules[$dd] ?? [];
                    foreach ($groups as $groupKey => $group):
                    ?>
                        <?php foreach ($group as $row_ds): ?>
                            <li class="timeline-item">
                                <span class="time-l"><?= viewSQ($row_ds['detail_hour']) ?></span>
                                <span class="des-l"><?= viewSQ($row_ds['detail_summary']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endfor; ?>
        <?php } ?>
        <h2 class="title-sec2">
            포함/불포함 사항
        </h2>
        <?php if ($product['product_able'] && $product['product_able'] != "&lt;p&gt;&nbsp;&lt;/p&gt;") { ?>
            <div class="tit-blue-type-2">
                <span class="tit-blue">포함사항</span>
            </div>
            <div class="des-type">
                <?= viewSQ($product['product_able']) ?>
            </div>
        <?php } ?>
        <?php if ($product['product_unable']) { ?>
            <div class="tit-blue-type-2">
                <span class="tit-blue">불포함 사항</span>
            </div>
            <div class="des-type">
                <?= viewSQ($product['product_unable']) ?>
            </div>
        <?php } ?>
        <?php if ($product['mobile_able']) { ?>
            <h2 class="title-sec2">
                추가정보 및 참고사항
            </h2>
            <div class="des-type">
                <?= viewSQ($product['mobile_able']) ?>
            </div>
        <?php } ?>
        <?php if ($product['special_benefit']) { ?>
            <h2 class="title-sec2">
                어린이정책
            </h2>
            <div class="des-type">
                <?= viewSQ($product['special_benefit']) ?>
            </div>
        <?php } ?>
        <?php if ($product['notice_comment']) { ?>
            <h2 class="title-sec2">
                유의사항
            </h2>
            <div class="des-type">
                <?= viewSQ($product['notice_comment']) ?>
            </div>
        <?php } ?>
        <?php if ($product['etc_comment']) { ?>
            <h2 class="title-sec2">
                더투어랩 이용방법
            </h2>
            <div class="des-type">
                <?= viewSQ($product['etc_comment']) ?>
            </div>
        <?php } ?>
        <div class="steps-type">
            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img1.png" alt="step_img1">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">1</span>
                <div class="cus-step-note">
                    <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                    <span class="txt-step-note">기능유무조회</span>
                </div>
            </div>
            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img2.png" alt="step_img2">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">2</span>
                <div class="cus-step-note">
                    <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                    <span class="txt-step-note">결제</span>
                </div>
            </div>

            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img3.png" alt="step_img2">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">3</span>
                <div class="cus-step-note">
                    <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                    <span class="txt-step-note">확정 후</span>
                </div>
            </div>
            <div class="step-type">
                <div class="con-step">
                    <img src="/uploads/sub/step_img4.png" alt="step_img2">
                </div>
                <span class="step-label">예약신청</span>
                <span class="number-step">4</span>
            </div>
        </div>
        <div id="dim"></div>
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
                            <?= viewSQ(getPolicy(19)) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dim"></div>
        </div>

        <iframe src="" id="hiddenFrame" name="hiddenFrame" style="display: none;" frameborder="0"></iframe>

        <script>
            function closePopup() {
                $(".popup_wrap").hide();
                $(".dim").hide();
            }

            $("#policy_show").on("click", function() {
                $(".policy_pop, .policy_pop .dim").show();
            });
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

                $("#order_frm").submit();
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
                    } else {
                        $("#order_user_name").val("");
                        $("#email_1").val("");
                        $("#email_2").val("");
                        $("#phone_1").val("");
                        $("#phone_2").val("");
                        $("#phone_3").val("");
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