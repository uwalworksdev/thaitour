<?php $this->extend('inc/layout_index'); ?>
<?php $setting = homeSetInfo(); ?>
<?php $this->section('content'); ?>
    <style>
        .tours-detail .container-calendar.tour {
            padding-top: 0;
            border-top: unset;
            gap: 40px;
        }

        .tours-detail .steps-type {
            display: flex;
            align-items: center;
            gap: 100px;
            margin-bottom: 110px;
            padding-left: 120px;
            margin-top: 50px;
        }

        .sec2-item-card .calendar_header {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
            cursor: pointer;
        }

        .sec2-item-card .calendar_header .desc_product {
            font-size: 22px;
            font-weight: 600;
        }

        .sec2-item-card .calendar_header .desc_product .desc_product_sub {
            font-size: 16px;
            font-weight: 400;
            color: #757575;
            margin-top: 15px;
            display: flex;
            justify-content: start;
            align-items: start;
            gap: 20px;
            margin-bottom: 20px;
        }

        .sec2-item-card .calendar_header .desc_product .desc_product_sub p {

        }

        .sec2-item-card .calendar_header .desc_product .desc_product_sub ul {
            display: flex;
            justify-content: start;
            align-items: start;
            gap: 10px;
            flex-direction: column;
        }

        .sec2-item-card .calendar_header .desc_product .desc_product_sub li {

        }

        .sec2-item-card .calendar_header .box_price {
            font-size: 16px;
            color: #757575;
        }

        .sec2-item-card .calendar_header .box_price i {
            color: #000;
            font-size: 22px;
            font-weight: 600;
            margin-left: 10px;
        }

        .sec2-item-card .calendar_header .box_price .btn_oder {
            text-align: right;
        }

        .sec2-item-card .calendar_header .box_price .btn_oder button {
            padding: 7px 25px;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            margin-top: 16px;
            width: 100%;
            height: 40px;
            background-color: #2a459f;
        }

        .sec2-item-card .desc_top {
            font-size: 17px;
            color: #757575;
            padding: 50px 0;
            text-align: center;
            line-height: 1.4;
            background-color: #fafafa;
            border-radius: 13px;
            margin-bottom: 50px;
        }

        .calendar_text_head {
            text-align: center;
            font-size: 20px;
            font-weight: 500;
        }

        .calendar_note {
            display: flex;
            gap: 40px;
            margin-top: 30px;
            font-size: 15px;
            font-weight: 500;
        }

        .calendar_note_cannot {
            padding-left: 20px;
            position: relative;
        }

        .calendar_note_cannot::before {
            content: "";
            position: absolute;
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #e31d1d;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .calendar_note_maybe {
            padding-left: 20px;
            position: relative;
        }

        .calendar_note_maybe::before {
            content: "";
            position: absolute;
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #2a459f;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        table.book_tbl {
            width: 100%;
            margin: 0 auto;
            margin-bottom: 50px;
        }

        table.book_tbl tr {
            border-top: 2px solid #dbdbdb;
            border-bottom: 2px solid #dbdbdb;
        }

        table.book_tbl th,
        table.book_tbl td {
            font-weight: 400;
            text-align: left;
            padding: 14px 10px 14px 13px !important;
            position: static;
            /* border: 1px solid #dcdcdc */
        }

        table.book_tbl th {
            /* border-top: 1px solid #dcdcdc;
            border-right: 1px solid #dcdcdc;
            border-left: 1px solid #dcdcdc; */
            background-color: #f5f7f9 !important
        }

        table.book_tbl td {
            background: #fff;
            text-align: left;
            /* border: 1px solid #dcdcdc */
        }

        table.book_tbl td.label_flex label {
            display: flex;
            gap: 5px;
            align-items: center;
            margin-right: 20px;
            float: left
        }

        table.book_tbl .list {
            display: block;
            overflow: hidden
        }

        table.book_tbl .list li {
            float: left;
            margin-right: 20px;
            line-height: 16px
        }

        table.book_tbl .list li input {
            width: 14px;
            height: 14px;
            vertical-align: top;
            margin-right: 3px
        }

        table.book_tbl textarea.memo {
            width: 95%;
            padding: 5px
        }

        table.book_tbl span.ti_schedule {
            background: #93aac6;
            border: 1px solid #7a91ac;
            padding: 3px 10px;
            color: #fff
        }

        table.book_tbl .list_golf_mem .conts {
            display: flex;
            border: none;
            align-items: center;
            width: 100%
        }

        table.book_tbl .list_golf_mem .conts li {
            padding: 0
        }

        table.book_tbl .list_golf_mem .conts select {
            height: 30px;
            width: 50px;
            margin-right: 10px
        }

        table.book_result {
            width: 100%;
            margin-top: 20px
        }

        table.book_result th {
            background: #7d7d7d;
            color: #fff
        }

        table.book_result th,
        table.book_result td {
            text-align: center;
            padding: 10px 0;
            line-height: 16px;
            border: 0
        }

        table.book_result td {
            background: #fff
        }

        table.book_result b {
            color: #fb7622
        }

        .fl {
            float: left;
        }

        .mt5 {
            margin-top: 5px;
        }


        .content-sub-hotel-detail .section6 .title-sec6 {
            font-size: 24px;
            margin: 64px 0 32px;
        }

        .content-sub-hotel-detail .section6 .card-list-recommemded .recommemded-item {
            width: unset
        }

        .title_sec2 {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .calendar_container_tongle {
            padding-top: 50px;
            border-top: 1px solid #dbdbdb;
            position: relative;

        }

        .calendar_container_tongle .close_btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .tours-detail .section2 .sec2-item-card:last-child {
            padding-bottom: 30px;
        }

        .calendar_submit {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .calendar_submit button {
            padding: 10px 26px;
            border: 10px;
            color: #fff;
            font-size: 22px;
            font-weight: 400;
            background-color: #2a459f;
            border-radius: 8px;
            width: 250px;
            height: 66px;
        }


    </style>


    <div class="content-sub-hotel-detail tours-detail">
        <div class="body_inner">
            <form name="frm" id="frm" action="#" class="">
                <input type="hidden" name="product_idx" value="<?= $guide['product_idx'] ?>">

                <div class="section1">
                    <div class="title-container">
                        <h2><?= $guide['product_name'] ?></h2>
                        <div class="only_web">
                            <div class="list-icon">
                                <img src="/uploads/icons/print_icon.png" alt="print_icon">
                                <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                                <img src="/uploads/icons/share_icon.png" alt="share_icon">
                            </div>
                        </div>
                    </div>
                    <div class="location-container">
                        <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                        <span><?= $guide['product_country'] ?></span>
                    </div>
                    <div class="above-cus-content">
                        <div class="rating-container">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                            <span><strong> <?= $guide['review_average'] ?></strong></span>
                            <span>생생리뷰 <strong>(<?= $guide['total_review'] ?>)</strong></span>
                        </div>
                        <div class="list-icon only_mo">
                            <img src="/uploads/icons/print_icon.png" alt="print_icon">
                            <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                            <img src="/uploads/icons/share_icon.png" alt="share_icon">
                        </div>
                    </div>
                    <?php
                    $i3 = 0;
                    for ($t = 1; $t < 8; $t++) {
                        if (!empty($guide['ufile' . $t]) && $guide['ufile' . $t] != '') {
                            $i3++;
                        }
                    }
                    ?>
                    <div class="hotel-image-container">
                        <div class="hotel-image-container-1" style="">
                            <img class="imageDetailMain_"
                                 onclick="img_pops('<?= $guide['product_idx'] ?>')"
                                 src="/uploads/guides/<?= $guide['ufile1'] ?>"
                                 alt="<?= $guide['product_name'] ?>"
                                 onerror="this.src='/images/share/noimg.png'">
                        </div>
                        <div class="grid_2_2">
                            <?php for ($j = 2; $j < 5; $j++) { ?>
                                <img onclick="img_pops('<?= $guide['product_idx'] ?>')"
                                     class="grid_2_2_size imageDetailSup_"
                                     src="/uploads/guides/<?= $guide['ufile' . $j] ?>"
                                     alt="<?= $guide['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                            <?php } ?>
                            <div class="grid_2_2_sub" onclick="img_pops('<?= $guide['product_idx'] ?>')"
                                 style="position: relative; cursor: pointer;">
                                <img class="custom_button imageDetailSup_"
                                     src="/uploads/guides/<?= $guide['ufile5'] ?>"
                                     alt="<?= $guide['product_name'] ?>"
                                     onerror="this.src='/images/share/noimg.png'">
                                <div class="button-show-detail-image">
                                    <img class="only_web" src="/uploads/icons/image_detail_icon.png"
                                         alt="image_detail_icon">
                                    <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png"
                                         alt="image_detail_icon_m">
                                    <span>사진 모두 보기</span>
                                    <span>(<?= $i3 ?>장)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sub-header-hotel-detail">
                        <div class="main nav-list">
                            <a class="active short_link" onclick="scrollToEl('product_info')" data-target="product_info"
                               href="#!">가격/상품정보</a>
                            <a class="short_link" onclick="scrollToEl('product_des')" data-target="product_des"
                               href="#!">생생리뷰</a>
                            <a class="short_link" onclick="scrollToEl('section8')" href="#!">상품Q&A</a>
                        </div>
                    </div>

                </div>
                <div class="section2" id="product_info">
                    <h4 class="title_sec2">가격/상품정보</h4>
                    <?php foreach ($options as $option): ?>
                        <div class="sec2-item-card tour_calendar">

                            <div class="calendar_header">
                                <div class="desc_product">
                                    <div class="" data-price="<?= $option['o_sale_price'] ?>"><?= $option['o_name'] ?></div>
                                    <div class="desc_product_sub">
                                        <p> 옵션포함:</p>
                                        <ul>
                                            <?php foreach ($option['sup_options'] as $item): ?>
                                                <li class="" data-price="<?= $item['s_price'] ?>">- <?= $item['s_name'] ?> </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="desc_product_sub">예약기능여부 : <span
                                                style="color : #2a459f "><?= $option['o_availability'] ?></span>
                                    </div>
                                </div>

                                <div class="box_price">
                                    <p>
                                        <?= number_format($option['o_sale_price']) ?>바트
                                        <i><?= number_format($option['o_sale_price'] * $setting['baht_thai']) ?></i>원
                                    </p>
                                    <div class="btn_oder">
                                        <button type="button">선택</button>
                                    </div>
                                </div>
                            </div>

                            <div class="calendar_container_tongle" style="display : none">

                                <div class="close_btn">
                                    <img src="/images/ico/close_ic.png" alt="">
                                </div>
                                <table class="book_tbl">
                                    <colgroup>
                                        <col style="width:15%">
                                        <col style="width:18%">
                                        <col style="width:15%">
                                        <col style="width:15%">
                                        <col style="width:18%">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <th>종료 후 내리실 곳</th>
                                        <td colspan="1">
                                            <input type="hidden" id="checkInType_43199" value="M">
                                            <div class="custom_input fl mr5" style="width:150px">
                                                <div class="val_wrap">
                                                    <input type="text" id="checkInDate_43199" class="hasDatepicker"
                                                           data-group="true" placeholder="체크인" readonly="readonly"
                                                           value="2024-12-18(수)" size="13">
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="fl mr5" style="width:80px ; margin-left: 10px">
                                                <div class="selectricWrapper selectric-selectric">
                                                    <div class="selectricHideSelect"><select id="lstDays_43199"
                                                                                             class="selectric"
                                                                                             onchange="selctPerDayForCar_43199(this.value);">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            <option value="25">25</option>
                                                            <option value="26">26</option>
                                                            <option value="27">27</option>
                                                            <option value="28">28</option>
                                                            <option value="29">29</option>
                                                            <option value="30">30</option>
                                                            <option value="31">31</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="line-height: 50px; margin-left: 10px;" class="fl">일</div>
                                        </td>
                                        <th>가이드 종료일</th>
                                        <td>
                                            <div class="custom_input fl mr5" style="width:150px">
                                                <div class="val_wrap">
                                                    <input type="text" id="checkOutDate_43199" class="hasDatepicker"
                                                           data-group="true" placeholder="체크아웃" readonly="readonly"
                                                           value="2024-12-18(수)" size="13">
                                                    <input type="hidden" name="ck_checkOutDate"
                                                           id="checkOutDate_43199_Alt"
                                                           value="2024-12-18">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="roomPeople_43199_1">
                                        <th style="display:none">객실수</th>
                                        <td style="display:none">
                                            <select name="roomCount" id="roomCount_43199" class="selectric"
                                                    onchange="setRooms_43199(this.value)">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                        <th>카카오톡 아이디</th>
                                        <td colspan="5">
                                            <div class="fl mr5" style="width:90px">
                                                <select name="ck_adultCount[]" id="adultCount_43199_1"
                                                        class="selectric">
                                                    <option value="1">1 명</option>
                                                    <option value="2">2 명</option>
                                                    <option value="3">3 명</option>
                                                    <option value="4">4 명</option>
                                                    <option value="5">5 명</option>
                                                    <option value="6">6 명</option>
                                                    <option value="7">7 명</option>
                                                    <option value="8">8 명</option>
                                                    <option value="9">9 명</option>
                                                    <option value="10">10 명</option>
                                                    <option value="11">11 명</option>
                                                    <option value="12">12 명</option>
                                                    <option value="13">13 명</option>
                                                    <option value="14">14 명</option>
                                                    <option value="15">15 명</option>
                                                    <option value="16">16 명</option>
                                                    <option value="17">17 명</option>
                                                    <option value="18">18 명</option>
                                                    <option value="19">19 명</option>
                                                    <option value="20">20 명</option>
                                                    <option value="21">21 명</option>
                                                    <option value="22">22 명</option>
                                                    <option value="23">23 명</option>
                                                    <option value="24">24 명</option>
                                                    <option value="25">25 명</option>
                                                    <option value="26">26 명</option>
                                                    <option value="27">27 명</option>
                                                    <option value="28">28 명</option>
                                                    <option value="29">29 명</option>
                                                    <option value="30">30 명</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="display: none">
                                        <th></th>
                                        <td colspan="5">
                                            <input type="checkbox" name="ck_options_id[]" id="options_43199_111835"
                                                   value="111835:Y" checked=""><label for="options_43199_111835">korean-speaking
                                                thai guide(Clients 1-8 Persons) BKK,PTY,PKT</label>
                                        </td>
                                    </tr>
                                    <tr style="display: none;">
                                        <th>픽업차량 추가</th>
                                        <td colspan="5">
                                            <!--<input type="checkbox" onclick="$('.golfcar_cont').toggle();" />--> 픽업
                                            차량을
                                            원하시는 분께서는 선택해주세요.
                                            <!-- 체크박스 체크시 나오는 부분-->
                                            <div class="golfcar_cont">
                                                <ul>
                                                    <li><input type="checkbox" name="ck_options_id[]"
                                                               id="options_43199_111844" value="111844:Y" checked="">승합차일일렌탈(기사님포함/유류비,톨비별도)
                                                        <select id="carAmount_43199_" class="selectric"
                                                                onclick="addAmount_43199('43199_111844', this.value);">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                        </select>대 /
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- //체크박스 체크시 나오는 부분 -->
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>


                                <div class="calendar_text_head">2023년 7월 ~ 2023년 7월</div>
                                <div class="container-calendar tour">
                                    <div class="calendar-left">
                                        <div class="calendar-container">
                                            <div class="calendar-header">
                                                <div id="prev-month" class="btn-action-calendar">
                                                    <img src="/uploads/icons/tour-left_icon.png" alt="tour-left_icon">
                                                </div>
                                                <span id="month-year">2024년 12월</span>
                                                <div id="next-month" class="btn-action-calendar">
                                                    <img src="/uploads/icons/tour-right_icon.png" alt="tour-right_icon">
                                                </div>
                                            </div>
                                            <div class="calendar-body">
                                                <div class="calendar-weekdays">
                                                    <div class="text-red-cus">일</div>
                                                    <div>월</div>
                                                    <div>화</div>
                                                    <div>수</div>
                                                    <div>목</div>
                                                    <div>금</div>
                                                    <div class="text-blue-cus">토</div>
                                                </div>
                                                <div class="calendar-days">
                                                    <div class="day disabled">01<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">02<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">03<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">04<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">05<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">06<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">07<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">08<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">09<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">10<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">11<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">12<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">13<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">14<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">15<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">16<p>예약마감</p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            17
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day disabled">18<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">19<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">20<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">21<p>예약마감</p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            22
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            23
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            24
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day disabled">25<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">26<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">27<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">28<p>예약마감</p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            29
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            30
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            31
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="calendar-left">
                                        <div class="calendar-container">
                                            <div class="calendar-header">
                                                <div id="prev-month" class="btn-action-calendar">
                                                    <img src="/uploads/icons/tour-left_icon.png" alt="tour-left_icon">
                                                </div>
                                                <span id="month-year">2024년 12월</span>
                                                <div id="next-month" class="btn-action-calendar">
                                                    <img src="/uploads/icons/tour-right_icon.png" alt="tour-right_icon">
                                                </div>
                                            </div>
                                            <div class="calendar-body">
                                                <div class="calendar-weekdays">
                                                    <div class="text-red-cus">일</div>
                                                    <div>월</div>
                                                    <div>화</div>
                                                    <div>수</div>
                                                    <div>목</div>
                                                    <div>금</div>
                                                    <div class="text-blue-cus">토</div>
                                                </div>
                                                <div class="calendar-days">
                                                    <div class="day disabled">01<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">02<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">03<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">04<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">05<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">06<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">07<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">08<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">09<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">10<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">11<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">12<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">13<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">14<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">15<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">16<p>예약마감</p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            17
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day disabled">18<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">19<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">20<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">21<p>예약마감</p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            22
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            23
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            24
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day disabled">25<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">26<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">27<p>예약마감</p>
                                                    </div>
                                                    <div class="day disabled">28<p>예약마감</p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            29
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            30
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                    <div class="day selectable">
                                                        <p class="selectable-day">
                                                            31
                                                        </p>
                                                        <p class="price1">0만원</p>
                                                        <p class="price2">(11바트)</p>
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="calendar_note">
                                    <p class="calendar_note_cannot"> 예약마감</p>
                                    <p class="calendar_note_maybe"> 특별요금</p>
                                </div>

                                <div class="calendar_submit">
                                    <button type="button">견적/예약하기</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>

            <script>
                $(".calendar_header").click(function () {
                    $('.tour_calendar').removeClass('active')
                    $(".calendar_container_tongle").hide()
                    $(this).next().show().parent().addClass('active')
                })
                $(".calendar_container_tongle .close_btn").click(function () {
                    $(this).parent().hide()
                })
            </script>

            <h2 class="title-sec3" id="product_des">
                상품설명
            </h2>
            <div class="des-type">
                <?= viewSQ($guide['product_info']) ?>
            </div>

            <h2 class="title-sec2">
                더투어랩 이용방법
            </h2>
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

            <?php echo view("/product/inc/review_product", ['product' => $guide]); ?>


            <div class="custom-golf-detail">
                <div class="section6" id="section8">
                    <h2 class="title-sec6">상품문의(FAQ)</h2>

                    <div class="qa-section">
                        <div class="custom-area-text">
                            <label class="custom-label" for="qa-comment">
                                <textarea name="qa-comment" id="qa-comment"
                                          class="custom-main-input-style textarea autoExpand"
                                          placeholder="상품에 대해 궁금한 점을 물어보세요."></textarea>
                            </label>
                            <div type="submit" class="qa-submit-btn">등록</div>
                        </div>

                        <ul class="qa-list">
                            <li class="">
                                <div class="qa-item qa_item_">
                                    <div class="qa-question">
                                        <span class="qa-number">124</span>
                                        <span class="qa-tag normal-style">답변대기중</span>
                                        <div class="con-cus-mo-qa">
                                            <p class="qa-text">티켓은 어떻게 예약할 수 있나요?</p>
                                            <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                        </div>
                                    </div>
                                    <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                </div>
                            </li>
                            <li class="">
                                <div class="qa-item qa_item_">
                                    <div class="qa-question">
                                        <span class="qa-number">123</span>
                                        <span class="qa-tag">답변완료</span>
                                        <div class="con-cus-mo-qa">
                                            <p class="qa-text">결제 시점은 언제인가요?</p>
                                            <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                        </div>
                                    </div>
                                    <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                </div>
                                <div class="additional-info d_none additional_info_">
                                    <span class="load-more">더투어랩</span>
                                    <p>조인투어로 전환 시 정해진 미팅장소에서 가이드님과 만나실 수 있습니다.<br>아유타야는 넓기 때문에 다른 장소에서 미팅은 어려운 점
                                        예약 시
                                        참고해주시기
                                        바랍니다.
                                    </p>
                                    <p class="mt-36">만약 투어 종료 후 개별 이동을 원하시면 당일 가이드님께 말씀해주시면 됩니다.</p>
                                </div>
                            </li>
                            <li class="">
                                <div class="qa-item qa_item_">
                                    <div class="qa-question">
                                        <span class="qa-number">122</span>
                                        <span class="qa-tag normal-style">답변대기중</span>
                                        <div class="con-cus-mo-qa">
                                            <p class="qa-text">2월23일 성인 8명, 어린이 2명으로 예약하면 10명인데요. 통로역 근처인 저희 호텔로
                                                외주실수...</p>
                                            <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                        </div>
                                    </div>
                                    <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                </div>
                            </li>
                            <li class="">
                                <div class="qa-item qa_item_">
                                    <div class="qa-question">
                                        <span class="qa-number">121</span>
                                        <span class="qa-tag normal-style">답변대기중</span>
                                        <div class="con-cus-mo-qa">
                                            <p class="qa-text">오늘 투어인데 아유타야에 있어서요. 혹시 아유타야에서 도중에 만나서 일정만 소화하고
                                                아유타야에서...</p>
                                            <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                        </div>
                                    </div>
                                    <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                </div>
                            </li>
                            <li class="">
                                <div class="qa-item qa_item_">
                                    <div class="qa-question">
                                        <span class="qa-number">120</span>
                                        <span class="qa-tag">답변완료</span>
                                        <div class="con-cus-mo-qa">
                                            <p class="qa-text">입금 했습니다. 아직 확정 전이라고 떠서 확인부탁드려요.</p>
                                            <div class="qa-meta text-gray only_mo">2024.07.24 09:39</div>
                                        </div>
                                    </div>
                                    <div class="qa-meta text-gray only_web">2024.07.24 09:39</div>
                                </div>
                                <div class="additional-info d_none additional_info_">
                                    <span class="load-more">더투어랩</span>
                                    <p>조인투어로 전환 시 정해진 미팅장소에서 가이드님과 만나실 수 있습니다.<br>아유타야는 넓기 때문에 다른 장소에서 미팅은 어려운 점
                                        예약 시
                                        참고해주시기
                                        바랍니다.
                                    </p>
                                    <p class="mt-36">만약 투어 종료 후 개별 이동을 원하시면 당일 가이드님께 말씀해주시면 됩니다.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <style>
                        .d_none {
                            display: none;
                            transition: all 0.3s ease;
                        }
                    </style>
                    <script>
                        $('.qa_item_').on('click keypress', function (e) {
                            if (e.type === 'click' || e.key === 'Enter') {
                                $('.additional_info_').addClass('d_none').attr('aria-hidden', 'true');
                                if ($(this).next('.additional-info').hasClass('d_none')) {
                                    $(this).attr('aria-expanded', 'true').next().removeClass('d_none').attr('aria-hidden', 'false');
                                } else {
                                    $(this).attr('aria-expanded', 'false').next().addClass('d_none').attr('aria-hidden', 'true');
                                }
                            }
                        });
                    </script>

                    <div class="pagination">
                        <a href="#" class="page-link">
                            <img class="only_web" src="/uploads/icons/arrow_prev_step.png" alt="arrow_prev_step">
                            <img class="only_mo" src="/uploads/icons/arrow_prev_step_mo.png" alt="arrow_prev_step_mo">
                        </a>
                        <a href="#" class="page-link cus-padding mr">
                            <img class="only_web" src="/uploads/icons/arrow_prev_all.png" alt="arrow_prev_all">
                            <img class="only_mo" src="/uploads/icons/arrow_prev_all_mo.png" alt="arrow_prev_all_mo">
                        </a>
                        <a href="#" class="page-link active">1</a>
                        <a href="#" class="page-link">2</a>
                        <a href="#" class="page-link">3</a>
                        <a href="#" class="page-link cus-padding ml">
                            <img class="only_web" src="/uploads/icons/arrow_next_all.png" alt="arrow_next_step">
                            <img class="only_mo" src="/uploads/icons/arrow_next_all_mo.png" alt="arrow_next_step_mo">
                        </a>
                        <a href="#" class="page-link">
                            <img class="only_web" src="/uploads/icons/arrow_next_step.png" alt="arrow_next_step">
                            <img class="only_mo" src="/uploads/icons/arrow_next_step_mo.png" alt="arrow_next_step">
                        </a>
                    </div>
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
                <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close"></a>
            </div>
        </div>

        <script>
            function closePopup() {
                $(".popup_wrap").hide();
                $(".dim").hide();
            }

            $("#policy_show").on("click", function () {
                $(".policy_pop, .policy_pop .dim").show();
            });

            function scrollToEl(elID) {
                $('html, body').animate({
                    scrollTop: $('#' + elID).offset().top - 250
                }, 'slow');
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

            $('.list-icon img[alt="heart_icon"]').click(function () {
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

            function sel_moption(code_idx) {
                let url = `/product/sel_moption`;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "product_idx": '2066',
                        "code_idx": code_idx
                    },
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        $("#sel_option").html(data);
                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
            }

            function sel_option(code_idx) {
                let url = `/product/sel_option`;
                let idx = code_idx.split("|")[0];

                let moption = $("#moption").val();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "idx": idx,
                        "moption": moption
                    },
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        let parent_name = data.parent_name;

                        let option_name = data.option_name;
                        let option_price = data.option_price;
                        let idx = data.idx;
                        let option_tot = data.option_tot ?? 0;
                        let option_cnt = data.option_cnt;

                        let htm_ = `<div class="schedule cus-count-input flex_b_c" id="schedule_${idx}" data-idx="${idx}" style="margin-top: 20px">
                                                        <div class="wrap-text">
                                                            <span>${parent_name}</span>
                                                            <p>${option_name}</p>
                                                        </div>
                                                        <div class="wrap-btn opt_count_box count_box flex__c">
                                                            <button type="button" onclick="minusQty(this);" class="minus_btn" id="minusAdult"></button>
                                                            <input style="text-align: center; display: block; width: 56px" data-price="${option_price}" readonly type="text" class="input-qty input_qty"
                                                                        name="option_qty[]" id="input_qty" value="1">
                                                            <button type="button" onclick="plusQty(this);" class="plus_btn" id="addAdult"></button>
                                                        </div>
                                                    </div>

                                                <div class="" style="display: none">
                                                        <input type="hidden" name="option_name[]" value="${option_name}">
                                                        <input type="hidden" name="option_idx[]" value="${idx}">
                                                        <input type="hidden" name="option_tot[]" value="${option_tot}">
                                                        <input type="hidden" name="option_price[]" value="${option_price}">
                                                        <input type="hidden" name="option_cnt[]" value="${option_cnt}">
                                                </div>
                                            </li>`;

                        let sel_option_ = $('#schedule_' + idx);
                        if (!sel_option_.length > 0) {
                            $("#option_list_").append(htm_);
                        }
                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
                updateProductOption();
            }

            function minusQty(el) {
                let inp = $(el).parent().find('input.input_qty');
                let num = inp.val();
                if (Number(num) > 1) {
                    num = Number(num) - 1;
                    inp.val(num);
                } else {
                    if (confirm('선택 항목을 지우시겠습니까?')) {
                        $(el).closest('.schedule').remove();
                    }
                }
                updateProductOption();
            }

            function plusQty(el) {
                let inp = $(el).parent().find('input.input_qty');
                let num = inp.val();
                num = Number(num) + 1;
                inp.val(num);
                updateProductOption();
            }

            var selectedOption = [];
            var selectedTourIds = [];
            var totalCost = 0;
            var selectedTourQuantities = {};

            function updateProductOption() {
                selectedOption = [];
                totalCost = 0;
                selectedTourQuantities = {};
                $('input.input_qty').each(function () {
                    let qty = parseInt($(this).val());
                    let price = parseFloat($(this).data('price'));
                    let optionName = $(this).closest('.schedule').find('p').text();
                    let idx = $(this).closest('.schedule').data('idx');

                    if (qty > 0) {
                        let totalPrice = qty * price;
                        totalCost += totalPrice;
                        if (!selectedTourIds.includes(idx)) {
                            selectedTourIds.push(idx);
                        }
                        selectedTourQuantities[idx] = qty;
                        selectedOption.push(`<div class='flex_op flex'>${optionName} <p class='product_option_pay'>${totalPrice.toLocaleString()}원</p></div>`);
                    }
                });

                if (selectedOption.length > 0) {
                    $('#product_options').html(
                        selectedOption.join('<br>')
                    );
                } else {
                    $('#product_options').html("선택된 옵션이 없습니다.");
                }
            }


            let currentToursIdx = null;
            const allContainers = document.querySelectorAll('.calendar-right .quantity-container-fa');
            const sec2Items = document.querySelectorAll('.sec2-item-card');

            allContainers.forEach(container => {
                container.style.display = 'none';
            });

            const firstContainer = document.querySelector('.calendar-right .quantity-container-fa');
            if (firstContainer) {
                const dataTourIndex = firstContainer.getAttribute('data-tour-index');
                if (dataTourIndex) {
                    firstContainer.style.display = 'block';
                    currentToursIdx = dataTourIndex;
                }
            }

            if (sec2Items.length > 0) {
                sec2Items[0].classList.add('active');
            }

            document.querySelectorAll('.btn-ct-3').forEach((button) => {
                button.addEventListener('click', function () {
                    const tourIndex = this.getAttribute('data-tour-index');

                    sec2Items.forEach(sec2Item => {
                        sec2Item.classList.remove('active');
                    });

                    const selectedSec2Item = document.querySelector(`.section2 .sec2-item-card[data-tour-index="${tourIndex}"]`);
                    if (selectedSec2Item) {
                        selectedSec2Item.classList.add('active');
                    }


                    document.querySelectorAll('.calendar-right .quantity-container-fa').forEach(container => {
                        container.style.display = 'none';
                    });

                    const selectedContainer = document.querySelector(`.calendar-right .quantity-container-fa[data-tour-index="${tourIndex}"]`);
                    if (selectedContainer) {
                        selectedContainer.style.display = 'block';
                        currentToursIdx = selectedContainer.getAttribute('data-tour-index');
                    }
                });
            });

            var adultQuantity = 1;
            var childQuantity = 0;
            var babyQuantity = 0;

            var adultTotalPrice = 0;
            var childTotalPrice = 0;
            var babyTotalPrice = 0;

            function updateTotalPeopleDisplay() {
                var totalPeople = adultQuantity + childQuantity + babyQuantity;
                var numText = `${totalPeople}명 (성인: ${adultQuantity}, 아이: ${childQuantity}, 아기: ${babyQuantity})`;
                $('.num_people').text(numText);
            }

            $('.quantity-container').each(function () {
                var $container = $(this);
                var $quantityDisplay = $container.find('.quantity');
                var $increaseBtn = $container.find('.increase');
                var $decreaseBtn = $container.find('.decrease');
                var pricePerUnit = parseFloat($container.find('.price').data('price'));
                var priceBahtPerUnit = parseFloat($container.find('.currency').data('price-baht'));

                var quantity = parseInt($quantityDisplay.text());
                var $price = $container.find('.price');
                var $currency = $container.find('.currency');

                if ($container.find('.des').text().includes('성인') && quantity === 0) {
                    quantity = 1;
                    adultQuantity = quantity;
                    adultTotalPrice = adultQuantity * pricePerUnit;
                    $quantityDisplay.text(quantity);
                    $decreaseBtn.removeAttr('disabled');
                }

                updatePrice();

                $increaseBtn.click(function () {
                    quantity++;
                    $quantityDisplay.text(quantity);
                    $decreaseBtn.removeAttr('disabled');
                    updateQuantity($container, quantity);
                    updatePrice();
                });

                $decreaseBtn.click(function () {
                    if (quantity > 0) {
                        quantity--;
                        $quantityDisplay.text(quantity);
                    }
                    if (quantity === 0) {
                        $decreaseBtn.attr('disabled', true);
                    }
                    updateQuantity($container, quantity);
                    updatePrice();
                });

                function updateQuantity($container, quantity) {
                    if ($container.find('.des').text().includes('성인')) {
                        adultQuantity = quantity;
                        adultTotalPrice = adultQuantity * pricePerUnit;
                    } else if ($container.find('.des').text().includes('아동')) {
                        childQuantity = quantity;
                        childTotalPrice = childQuantity * pricePerUnit;
                    } else if ($container.find('.des').text().includes('유아')) {
                        babyQuantity = quantity;
                        babyTotalPrice = babyQuantity * pricePerUnit;
                    }
                    updateTotalPeopleDisplay();
                }

                function updatePrice() {
                    var totalPrice = quantity * pricePerUnit;
                    var totalPriceBaht = quantity * priceBahtPerUnit;

                    $price.text(number_format(totalPrice) + '원');
                    $currency.text(number_format(totalPriceBaht) + ' 바트');
                }
            });

            function number_format(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            updateTotalPeopleDisplay();

            const $calendarDays = $('.calendar-days');
            const $monthYear = $('#month-year');
            const $prevMonthBtn = $('#prev-month');
            const $nextMonthBtn = $('#next-month');
            const $selectedDayElement = $('.days');

            let s_date = null;
            let e_date = null;
            let productPrice = null;
            let productPriceBaht = null;
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            let selectedDate = null;
            let validDays = []

            const setTourDatesAndPrice = (startDate, endDate, price, priceBaht, validDaysParam) => {
                s_date = new Date(startDate);
                e_date = new Date(endDate);
                productPrice = price;
                productPriceBaht = priceBaht;
                validDays = validDaysParam;
                renderCalendar(validDays);
            };

            const initializeDefaultTour = () => {
                const firstTourDateElement = $('.sec2-date-main').first();
                const tourStartDate = firstTourDateElement.data('start-date');
                const tourEndDate = firstTourDateElement.data('end-date');

                const firstTourCard = $('.sec2-item-card').first();
                const tourPriceText = firstTourCard.find('.ps-right').text().trim().replace(/,/g, '');
                adultTotalPrice = parseFloat(tourPriceText);
                const tourPrices = parseFloat(tourPriceText) / 10000;
                const tourPrice = parseFloat(tourPrices.toFixed(1));

                const tourPriceTextBath = firstTourCard.find('.ps-left').text().trim().replace(/,/g, '');
                const tourPriceBaht = parseFloat(tourPriceTextBath);

                const validDays = firstTourCard.find('.btn-ct-3').data('valid-days').split(',').map(Number);
                setTourDatesAndPrice(tourStartDate, tourEndDate, tourPrice, tourPriceBaht, validDays);
            };

            const renderCalendar = (validDays) => {
                $calendarDays.empty();

                const month = currentDate.getMonth();
                const year = currentDate.getFullYear();

                const today = new Date();
                today.setHours(0, 0, 0, 0);

                const currentMonthDate = new Date(year, month, today.getDate());
                currentMonthDate.setHours(0, 0, 0, 0);

                const monthNames = ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"];
                $monthYear.text(`${year}년 ${monthNames[month]}`);

                const firstDay = new Date(year, month, 1).getDay();
                const lastDate = new Date(year, month + 1, 0).getDate();

                for (let i = 0; i < firstDay; i++) {
                    $('<div/>').appendTo($calendarDays);
                }

                for (let day = 1; day <= lastDate; day++) {
                    const dayString = day.toString().padStart(2, '0');
                    const $dayDiv = $('<div/>').text(dayString).addClass('day');
                    let date = new Date(year, month, day);

                    date = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                    const isWithinDateRange = date >= s_date && date <= e_date;
                    const isValidDay = validDays.includes(date.getDay());
                    const isPastDate = date < today;

                    if (isPastDate) {
                        $dayDiv.addClass('disabled').append(`<p>예약마감</p>`);
                    } else if (!isWithinDateRange || !isValidDay) {
                        $dayDiv.addClass('disabled').append("<p>예약마감</p>");
                    } else {
                        $dayDiv.addClass('selectable').html(`
                                    <p class="selectable-day">
                                        ${dayString}
                                        <p class="price1">${number_format(productPrice)}만원</p>
                                        <p class="price2">(${number_format(productPriceBaht)}바트)</p>
                                    </p>
                                `);

                        $dayDiv.click(() => {
                            $('.day').removeClass('active');
                            $dayDiv.addClass('active');
                            selectedDate = date;

                            const formattedDate = formatSelectedDate(date);
                            $('.days_choose').text(formattedDate);
                            $('.calendar_txt').text(formattedDate);
                            $('#order_date').val(formattedDate);
                        });
                    }

                    $dayDiv.appendTo($calendarDays);
                }
            };

            function formatSelectedDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const dayOfWeek = ["일", "월", "화", "수", "목", "금", "토"][date.getDay()];
                return `${year}.${month}.${day}(${dayOfWeek})`;
            }

            $('.btn-ct-3').click(function () {
                const tourCard = $(this).closest('.sec2-item-card');
                const tourDateElement = tourCard.prevAll('.sec2-date-main').first();
                const tourStartDate = tourDateElement.data('start-date');
                const tourEndDate = tourDateElement.data('end-date');

                const tourPriceText = tourCard.find('.ps-right').text().trim().replace(/,/g, '');
                adultTotalPrice = parseFloat(tourPriceText);
                const tourPrices = parseFloat(tourPriceText) / 10000;
                const tourPrice = parseFloat(tourPrices.toFixed(1));

                const tourPriceTextBaht = tourCard.find('.ps-left').text().trim().replace(/,/g, '');
                const tourPriceBaht = parseFloat(tourPriceTextBaht);

                const validDaysParam = $(this).data('valid-days').split(',').map(Number);
                setTourDatesAndPrice(tourStartDate, tourEndDate, tourPrice, tourPriceBaht, validDaysParam);
                $('html, body').animate({
                    scrollTop: $('#tour_calendar').offset().top
                }, 500);
            });

            $prevMonthBtn.click(() => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                currentDate.setDate(1);
                renderCalendar(validDays);
            });

            $nextMonthBtn.click(() => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                currentDate.setDate(1);
                renderCalendar(validDays);
            });

            const getValidDaysForMonth = (date) => {

                return validDays;
            };

            function checkDateSelected() {
                if (!selectedDate) {
                    alert('달력 선택해주세요!');
                    return false;
                }
                return true;
            }

            function handleSubmit() {
                const frm = document.frm;

                showOrHideLoginItem();
                return false;

                if (checkDateSelected()) {
                    var selectedDateText = $('#days_choose').text();
                    var dateParts = selectedDateText.split('(')[0].trim();
                    var formattedDate = dateParts.replace(/\./g, '-');
                    var adultCnt = adultQuantity;
                    var childCnt = childQuantity;
                    var babyCnt = babyQuantity;
                    var adultTotalPrices = adultTotalPrice;
                    var childTotalPrices = childTotalPrice;
                    var babyTotalPrices = babyTotalPrice;
                    const selectedTourCard = $('.sec2-item-card.active');
                    var priceOptionTotal = totalCost;
                    var last_price = adultTotalPrices + childTotalPrices + babyTotalPrices + priceOptionTotal;
                    var selectedTime = $('.select-time-c').val();
                    if (!selectedTime) {
                        selectedTime = $('.select-time-c option:first').val();
                    }
                    const idxWithQuantities = selectedTourIds.map(idx => `${idx}:${selectedTourQuantities[idx]}`).join(',');


                    //$('#order_date').val(formattedDate);
                    $('#people_adult_cnt').val(adultCnt);
                    $('#people_kids_cnt').val(childCnt);
                    $('#people_baby_cnt').val(babyCnt);
                    $('#people_adult_price').val(adultTotalPrices);
                    $('#people_kids_price').val(childTotalPrices);
                    $('#people_baby_price').val(babyTotalPrices);
                    $('#tours_idx').val(currentToursIdx);
                    $('#idx').val(idxWithQuantities);
                    $('#time_line').val(selectedTime);
                    $('.time_lines').text(selectedTime);
                    $("#total_price_popup").text(number_format(last_price) + " 바트");
                    $("#total_price").val(last_price);
                    $("#total_pay").text(number_format(last_price) + " 바트");
                    console.log(selectedTourIds.join(','));
                    console.log(currentToursIdx);
                    console.log(adultTotalPrices);
                    console.log(selectedTime);
                    console.log(priceOptionTotal);
                    var productIdx = document.querySelector('input[name="product_idx"]').value;
                    $("#frm").submit();
                }
            }

            function setCouponArea(isAcceptBtn = false) {
                const couponActive = $(".item-price-popup.active");
                let total_price = $("#total_price").val() || 0;
                let total_price_baht = $("#total_price_baht").val() || 0;
                const idx = couponActive.data("idx") || 0;
                const discount = couponActive.data("discount") || 0;
                let discount_baht = couponActive.data("discount_baht") || 0;
                const type = couponActive.data("type") || 0;

                let discount_price = 0;
                let discount_price_baht = 0;
                if (type === "D") {
                    discount_price = discount;
                    discount_price_baht = discount_baht;
                } else if (type === "P") {
                    discount_price = Math.round(total_price * discount / 100);
                    discount_price_baht = Math.round(total_price_baht * discount / 100);
                }

                total_price -= discount_price;
                total_price_baht -= discount_price_baht;

                $(".discount").text(number_format(discount_price) + "원");
                $("#last_price_popup").text(number_format(total_price));

                if (isAcceptBtn) {
                    $("#final_discount").val(discount_price);
                    $(".final_discount").val(number_format(discount_price));
                    $("#final_discount_baht").text(number_format(discount_price_baht));
                    $("#use_coupon_idx").val(idx);
                }

                return {
                    discount_price,
                    discount_price_baht
                };
            }

            function calculatePrice() {
                var last_price = adultTotalPrices + childTotalPrices + babyTotalPrices + priceOptionTotal;
                const discount_price = $("#final_discount").text().replace(/[^0-9]/g, '');
                const discount_price_baht = $("#final_discount_baht").text().replace(/[^0-9]/g, '');

                last_price -= discount_price;

                $("#last_price").text(number_format(last_price));
            }

            $(".item-price-popup").click(function () {
                $(this).addClass("active").siblings().removeClass("active");
                setCouponArea();
            })

            $(".btn_accept_coupon").click(function () {
                setCouponArea(true);
                calculatePrice();
                $("#popup_coupon").css('display', 'none');
            })

            initializeDefaultTour();


            function showCouponPop() {
                $("#popup_coupon").css('display', 'flex');
            }

            const $closePopupBtn = $('.close-btn');
            $closePopupBtn.on('click', function () {
                $("#popup_coupon").css('display', 'none');
            });


            $('.btn_back').click(function () {
                $('.sec2-item-card, .section2 .title-sec2, .section2 .sec2-date-main, .section2 .sec2-date-sub').show();
                $('.section1').show();
                $('.sec2-item-card.order-form-page, .sec2-item-card.card-left2').hide();
            });
        </script>
        <script>
            jQuery(document).ready(function () {
                var dim = $('#dim');
                var popup = $('#popupRoom');
                var closedBtn = $('#popupRoom .closed_btn');

                var popup2 = $('#popup_img');
                var closedBtn2 = $('#popup_img .closed_btn');

                /* closed btn*/
                closedBtn.click(function () {
                    popup.hide();
                    dim.fadeOut();
                    $('.multiple-items').slick('unslick'); // slick 삭제
                    return false;
                });

                closedBtn2.click(function () {
                    popup2.hide();
                    dim.fadeOut();
                    $('.multiple-items').slick('unslick'); // slick 삭제
                    return false;
                });
            });

            function img_pops(idx) {
                var dim = $('#dim');
                var popup = $('#popup_img');

                popup.show();
                dim.fadeIn();

                $('.multiple-items').slick({
                    slidesToShow: 1,
                    initialSlide: 0,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    dots: true,
                    focusOnSelect: true
                });
            }
        </script>
        <script>
            $(".phone").on("input", function () {
                $(this).val($(this).val().replace(/[^0-9]/g, ""));
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

            function handleEmail(email) {
                if (email == '1') {
                    $("#email_2").val('').prop('readonly', false).focus();
                } else {
                    $("#email_2").val(email).prop('readonly', true);
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const links = document.querySelectorAll('.short_link');

                links.forEach(link => {
                    link.addEventListener('click', function () {
                        links.forEach(link => link.classList.remove('active'));
                        this.classList.add('active');
                    });
                });
            });
        </script>
    </div>
<?php $this->endSection(); ?>