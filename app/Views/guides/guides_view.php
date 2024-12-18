<?php $this->extend('inc/layout_index'); ?>
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
    }

    .sec2-item-card .calendar_header .desc_product {
        font-size: 22px;
        font-weight: 600;
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
        border: 1px solid #aaa;
        color: #000;
        font-size: 16px;
        font-weight: 600;
        margin-top: 16px;
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
        margin-top: 50px;
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
    }
</style>


<div class="content-sub-hotel-detail tours-detail">
    <div class="body_inner">
        <form name="frm" id="frm" action="/product-tours/confirm-info" class="">
            <input type="hidden" name="product_idx" value="2066">
            <input type="hidden" name="order_date" id="order_date" value="">
            <input type="hidden" name="tours_idx" id="tours_idx" value="">
            <input type="hidden" name="idx" id="idx" value="">
            <input type="hidden" id="total_price" value="">
            <input type="hidden" id="total_price_baht" value="">
            <input type="hidden" name="people_adult_cnt" id="people_adult_cnt" value="">
            <input type="hidden" name="people_kids_cnt" id="people_kids_cnt" value="">
            <input type="hidden" name="people_baby_cnt" id="people_baby_cnt" value="">
            <input type="hidden" name="people_adult_price" id="people_adult_price" value="">
            <input type="hidden" name="people_kids_price" id="people_kids_price" value="">
            <input type="hidden" name="people_baby_price" id="people_baby_price" value="">
            <input type="hidden" name="time_line" id="time_line" value="">
            <input type="hidden" name="total_pay" id="total_pay" value="">
            <input type="hidden" name="use_coupon_idx" id="use_coupon_idx" value="">
            <input type="hidden" name="final_discount" id="final_discount" value="">
            <div class="section1">
                <div class="title-container">
                    <h2>1211</h2>
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
                    <span></span>
                </div>
                <div class="above-cus-content">
                    <div class="rating-container">
                        <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                        <span><strong> 0</strong></span>
                        <span>생생리뷰 <strong>(0)</strong></span>
                    </div>
                    <div class="list-icon only_mo">
                        <img src="/uploads/icons/print_icon.png" alt="print_icon">
                        <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                        <img src="/uploads/icons/share_icon.png" alt="share_icon">
                    </div>
                </div>
                <div class="hotel-image-container">
                    <div class="hotel-image-container-1" style="">
                        <img src="/data/product/1733993002_e34dba6edaba5ddd1e1b.jpg" alt="돈므앙국제공항.jpg">
                    </div>
                    <div class="grid_2_2">
                        <img class="grid_2_2_size" src="/images/product/noimg.png" alt="" style="">
                        <img class="grid_2_2_size" src="/images/product/noimg.png" alt="" style="">
                        <img class="grid_2_2_size" src="/images/product/noimg.png" alt="" style="">
                        <div class="grid_2_2_sub" style="position: relative; cursor: pointer;" onclick="img_pops('2066')">
                            <img class="custom_button" src="/images/product/noimg.png" alt="">
                            <div class="button-show-detail-image" style="">
                                <img class="only_web" src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                                <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png" alt="image_detail_icon_m">
                                <span>사진 모두 보기</span>
                                <span>(2장)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sub-header-hotel-detail">
                    <div class="main">

                        <a class="active short_link" data-target="product_info" href="#!">가격/상품정보</a>
                        <a class="short_link" data-target="product_des" href="#!">생생리뷰</a>
                        <a class="short_link" href="#!">상품Q&A</a>
                    </div>
                </div>

            </div>
            <div class="section2" id="product_info">
                <h4 class="title_sec2">가격/상품정보</h4>
                <div class="sec2-item-card tour_calendar" id="tour_calendar">

                    <div class="calendar_header">
                        <div class="desc_product">
                            <p>승합차(기사님포함/일일렌탈/기름값,톨비불포함) + 한국어가능 태국인가이드</p>
                        </div>

                        <div class="box_price">
                            <p>5,100바트<i>225,216</i>원</p>
                            <div class="btn_oder"><button type="button">예약</button></div>
                        </div>
                    </div>

                    <div class="calendar_container_tongle">


                        <div class="desc_top">
                            <p>자동으로 견적서 발송되는 경우 기본요금으로 안내됩니다.<br>
                                예상 일정을 정확히 남겨주세요.(일정이 없는 경우 예약 확정에 시간 소요)</p>
                        </div>


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
                        <table class="book_tbl">
                            <colgroup>
                                <col style="width:15%">
                                <col style="width:10%">
                                <col style="width:15%">
                                <col style="width:25%">
                                <col style="width:15%">
                                <col>
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>종료 후 내리실 곳</th>
                                    <td colspan="3">
                                        <input type="hidden" id="checkInType_43199" value="M">
                                        <div class="custom_input fl mr5" style="width:150px">
                                            <div class="val_wrap">
                                                <input type="text" id="checkInDate_43199" class="hasDatepicker" data-group="true" placeholder="체크인" readonly="readonly" value="2024-12-18(수)" size="13">
                                            </div>
                                        </div>
                                        <div class="fl mr5" style="width:80px ; margin-left: 10px">
                                            <div class="selectricWrapper selectric-selectric">
                                                <div class="selectricHideSelect"><select id="lstDays_43199" class="selectric" onchange="selctPerDayForCar_43199(this.value);">
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
                                                <input type="text" id="checkOutDate_43199" class="hasDatepicker" data-group="true" placeholder="체크아웃" readonly="readonly" value="2024-12-18(수)" size="13">
                                                <input type="hidden" name="ck_checkOutDate" id="checkOutDate_43199_Alt" value="2024-12-18">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="roomPeople_43199_1">
                                    <th style="display:none">객실수</th>
                                    <td style="display:none">
                                        <select name="roomCount" id="roomCount_43199" class="selectric" onchange="setRooms_43199(this.value)">
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
                                            <select name="ck_adultCount[]" id="adultCount_43199_1" class="selectric">
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
                                        <!--
<div class="fl mr5" style="width:60px">
<select name="ck_childCount[]" id="childCount_43199_1" onchange="allowchild_43199(1, this.value);" class="selectric" >
<option value="0">아동 0</option>
<option value="1">아동 1</option>
<option value="2">아동 2</option>
<option value="3">아동 3</option>
<option value="4">아동 4</option>
<option value="5">아동 5</option>
<option value="6">아동 6</option>
<option value="7">아동 7</option>
<option value="8">아동 8</option>
<option value="9">아동 9</option>
<option value="10">아동 10</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge1_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge2_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge3_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge4_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge5_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge6_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge7_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge8_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge9_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
<div class="fl mr5" style="width:90px">
<select name="ck_childAge_room1[]" id="childAge10_43199_1" class="selectric" style="display: none" disabled="true">
<option value="">아동나이선택</option>
<option value="1">아동나이 1</option>
<option value="2">아동나이 2</option>
<option value="3">아동나이 3</option>
<option value="4">아동나이 4</option>
<option value="5">아동나이 5</option>
<option value="6">아동나이 6</option>
<option value="7">아동나이 7</option>
<option value="8">아동나이 8</option>
<option value="9">아동나이 9</option>
<option value="10">아동나이 10</option>
<option value="11">아동나이 11</option>
<option value="12">아동나이 12</option>
</select>
</div>
-->
                                    </td>
                                </tr>
                                <tr style="display: none">
                                    <th></th>
                                    <td colspan="5">
                                        <input type="checkbox" name="ck_options_id[]" id="options_43199_111835" value="111835:Y" checked=""><label for="options_43199_111835">korean-speaking thai guide(Clients 1-8 Persons) BKK,PTY,PKT</label>
                                    </td>
                                </tr>
                                <tr style="display: none;">
                                    <th>픽업차량 추가</th>
                                    <td colspan="5"><!--<input type="checkbox" onclick="$('.golfcar_cont').toggle();" />--> 픽업 차량을 원하시는 분께서는 선택해주세요.
                                        <!-- 체크박스 체크시 나오는 부분-->
                                        <div class="golfcar_cont">
                                            <ul>
                                                <li><input type="checkbox" name="ck_options_id[]" id="options_43199_111844" value="111844:Y" checked="">승합차일일렌탈(기사님포함/유류비,톨비별도)
                                                    <select id="carAmount_43199_" class="selectric" onclick="addAmount_43199('43199_111844', this.value);">
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
                    </div>
                </div>
            </div>
        </form>

        <h2 class="title-sec3" id="product_des">
            상품설명
        </h2>
        <div class="des-type">
            <div class="cont" itemprop="description"> <!-- detail_info.tpl:25 informationHtml -->
                <div class="prdinfo_wrap">
                    <p><span style="font-size:14px;">가이드와&nbsp;차량이 묶인 상품이지만&nbsp;가이드는&nbsp;안내만 하며, 차량은 9인승으로 기사님이&nbsp;운전합니다.</span></p>
                    <p><span style="font-size:14px;">가이드는&nbsp;10시간&nbsp;차량은 12시간 이용 기준으로 시간 초과 시 1시간당 각각&nbsp;<strong>200바트</strong>씩 직접 지불해 주시면 됩니다.</span></p>
                    <p><span style="font-size:14px;">(차량과 가이드는 시작 및 종료를 같이 하는 것이&nbsp;원칙)</span></p>
                    <p><span style="font-size:14px;">일정은 마음대로 설계 가능하나 추가 비용은 아래 설명에서 확인해 주세요.</span></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p><span style="color:#252525"><strong>1. 불포함 요금</strong></span></p>
                    <p>유류비&nbsp;<span style="color:#2a459f;"><strong>1km 당 5바트</strong></span><span style="color:null;">로 투어 종료 후 기사님께&nbsp;직접 지불</span></p>
                    <p><span style="color:null;">&nbsp;-&nbsp;투어 시작과 종료 시 차량 km 수 확인</span></p>
                    <p>톨비, 주차비 등은 그때 그때 지불</p>
                    <p>가이드 및 기사님 팁</p>
                    <p>&nbsp;</p>
                    <p><strong style="color:#252525">2. 추가 요금</strong></p>
                    <p>가이드 10시간, 차량 12시간 기준으로 시간&nbsp;초과 시 각각 시간당 200바트 직접 지불</p>
                    <p>차량과 가이드는 시작 및 종료를 같이 하는 것이&nbsp;원칙이나&nbsp;상품 이용 중 가이드를 먼저 돌려보낼 경우 차비 300바트 직접 지불</p>
                    <p>출발 지역 외&nbsp;다른 지역에서 숙박 시&nbsp;가이드 및 기사&nbsp;숙박비 각&nbsp;<span style="color:#2a459f;"><strong>1일 800바트/500바트부터</strong></span></p>
                    <p>출발지(도시)와 목적지(도시)가&nbsp;다른 경우 귀가 <strong><span style="color:#2a459f;">기름값 500바트</span></strong>, 가이드 <strong><span style="color:#2a459f;">교통비 300바트</span></strong> 별도(지역에 따라 금액 다를 수 있음)</p>
                    <p>예) 방콕&nbsp;출발 -&gt;&nbsp;파타야&nbsp;종료 시&nbsp;방콕 복귀&nbsp;기름값 및 가이드 교통비 <span style="color:null;">총&nbsp;800바트</span></p>
                    <p>&nbsp;</p>
                    <p>※&nbsp;미팅시간 무관 자정 이후에는 추가비용이 발생됩니다. (1시간당 200바트)</p>
                    <p>- 다음날 가이드님 일정이 있을 수 있어 반드시 사전 협의가 필요합니다.&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>※ 추가&nbsp;금액은 견적서에 포함되지 않은 기본요금으로 견적서 자동 발송됩니다.(숙박비 및 귀가 교통비 불포함)</p>
                    <p>※ 예약 신청 후 1:1 게시판으로 정확한 일정 남겨주시면 견적서 다시 보내드리며, 그렇지 않을 경우 확정 추후 추가 요금 안내됩니다.</p>
                    <p><span style="color:null;">※ 일정을 명확하게 적지 않으실 경우 차질이 생길 수 있으며, 예약 확정에 시간이 소요될 수 있습니다.</span></p>
                    <p><span style="color:null;">※ </span>이용일 당일 비가오더라도 스케줄대로 진행되며, 우천으로 인해 취소/환불/일자 변경 불가합니다.</p>
                </div><!-- informationHtml end -->
            </div>



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

        <div class="section6" id="section6">
            <h2 class="title-sec6"><span>생생리뷰</span>(1)</h2>
            <div class="rating-content">
                <div class="rating-left">
                    <img src="/uploads/icons/start_big_icon.png" alt="start_big_icon">
                    <strong>3/5</strong>
                </div>
                <span class="rating-right text-gray">1개 고객기준</span>
            </div>
            <!-- <div class="list-label-tag">
                <div class="label-tag-item">
                    <img class="square" src="/data/code/1729571645_fb53d1d73b0b13dcf6c2.png" alt="청결">
                    <div class="label-tag-item-text">
                        <strong>청결</strong>
                        <p><strong>0</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/data/code/1729571657_b1cb8c4fb89a788c1351.png" alt="시설">
                    <div class="label-tag-item-text">
                        <strong>시설</strong>
                        <p><strong>3.0</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/data/code/1729571664_f42ea530f35c89161075.png" alt="위치">
                    <div class="label-tag-item-text">
                        <strong>위치</strong>
                        <p><strong>0</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/data/code/1729571671_ae94a9dbd753c419c162.png" alt="직원친절도">
                    <div class="label-tag-item-text">
                        <strong>직원친절도</strong>
                        <p><strong>3.0</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/data/code/1729571681_6b866f4a413112dac498.png" alt="가성비">
                    <div class="label-tag-item-text">
                        <strong>가성비</strong>
                        <p><strong>3.0</strong> 최고좋음</p>
                    </div>
                </div>
                <div class="label-tag-item">
                    <img class="square" src="/data/code/1729571686_6eb5cc9b65925faeb2d7.png" alt="편안함">
                    <div class="label-tag-item-text">
                        <strong>편안함</strong>
                        <p><strong>0</strong> 최고좋음</p>
                    </div>
                </div>
            </div> -->
            <h2 class="sub-title-sec6">BEST 생생리뷰</h2>
            <div class="card-list-flex">
                <div class="card-list-recommemded">
                    <div class="recommemded-item" data-id="899">
                        <div class="container-head" style="cursor: pointer;" onclick="goDetail('899');">
                            <img src="/images/profile/avatar.png" alt="avatar_user_1">
                            <div class="name">
                                <span>woras******</span>
                                <p>2024.08.09</p>
                            </div>
                        </div>
                        <h2 style="cursor: pointer;" onclick="goDetail('899');">깨끗하고 편안하며 BTS chidlom과 가깝습니다.</h2>
                        <div class="custom_paragraph">
                            <p>아침조식.. 가짓수는 좀 있으나 모든음식과 음료의 수준은
                                수준이하. 과일쥬스는 과일향 첨가한 물같고. 일본김밥은
                                밥이 떡 같고 빵도 질감이 너무 떨어지고. 무엇보다 모든 돼지
                                고기요리에서 냄새가 심하게 나서 3일머무는동안 힘들었음</p>
                        </div>
                        <button type="button" onclick="goList();">
                            더보기
                        </button>
                    </div>

                    <div class="recommemded-item" data-id="899">
                        <div class="container-head" style="cursor: pointer;" onclick="goDetail('899');">
                            <img src="/images/profile/avatar.png" alt="avatar_user_1">
                            <div class="name">
                                <span>woras******</span>
                                <p>2024.08.09</p>
                            </div>
                        </div>
                        <h2 style="cursor: pointer;" onclick="goDetail('899');">깨끗하고 편안하며 BTS chidlom과 가깝습니다.</h2>
                        <div class="custom_paragraph">
                            <p>아침조식.. 가짓수는 좀 있으나 모든음식과 음료의 수준은
                                수준이하. 과일쥬스는 과일향 첨가한 물같고. 일본김밥은
                                밥이 떡 같고 빵도 질감이 너무 떨어지고. 무엇보다 모든 돼지
                                고기요리에서 냄새가 심하게 나서 3일머무는동안 힘들었음</p>
                        </div>
                        <button type="button" onclick="goList();">
                            더보기
                        </button>
                    </div>
                    <div class="recommemded-item" data-id="899">
                        <div class="container-head" style="cursor: pointer;" onclick="goDetail('899');">
                            <img src="/images/profile/avatar.png" alt="avatar_user_1">
                            <div class="name">
                                <span>woras******</span>
                                <p>2024.08.09</p>
                            </div>
                        </div>
                        <h2 style="cursor: pointer;" onclick="goDetail('899');">깨끗하고 편안하며 BTS chidlom과 가깝습니다.</h2>
                        <div class="custom_paragraph">
                            <p>아침조식.. 가짓수는 좀 있으나 모든음식과 음료의 수준은
                                수준이하. 과일쥬스는 과일향 첨가한 물같고. 일본김밥은
                                밥이 떡 같고 빵도 질감이 너무 떨어지고. 무엇보다 모든 돼지
                                고기요리에서 냄새가 심하게 나서 3일머무는동안 힘들었음</p>
                        </div>
                        <button type="button" onclick="goList();">
                            더보기
                        </button>
                    </div>
                </div>

            </div>

            <script>
                function goList() {
                    window.location.href = '/review/review_list';
                }

                function goDetail(idx) {
                    window.location.href = '/review/review_detail?idx=' + idx;
                }
            </script>
        </div>


        <div class="custom-golf-detail">
            <div class="section6" id="section8">
                <h2 class="title-sec6">상품문의(FAQ)</h2>

                <div class="qa-section">
                    <div class="custom-area-text">
                        <label class="custom-label" for="qa-comment">
                            <textarea name="qa-comment" id="qa-comment" class="custom-main-input-style textarea autoExpand" placeholder="상품에 대해 궁금한 점을 물어보세요."></textarea>
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
                    $('.qa_item_').on('click keypress', function(e) {
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
                    <li><img src="/data/product/1733993002_e34dba6edaba5ddd1e1b.jpg" alt=""></li>
                    <li><img src="/images/product/noimg.png" alt=""></li>
                    <li><img src="/images/product/noimg.png" alt=""></li>
                    <li><img src="/images/product/noimg.png" alt=""></li>
                    <li><img src="/images/product/noimg.png" alt=""></li>
                    <li><img src="/images/product/noimg.png" alt=""></li>
                    <li><img src="/images/product/noimg.png" alt=""></li>
                </ul>
            </div>
            <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close"></a>
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
                            <div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; color: rgb(85, 85, 85); font-family: Pretendard; font-size: 16px; letter-spacing: -0.64px; line-height: 26px; background-color: rgb(255, 255, 255);">
                                <div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; letter-spacing: -0.64px; line-height: 26px;">
                                    <div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; letter-spacing: -0.64px; line-height: 26px;">
                                        <div class="policy_top" style="box-sizing: border-box; margin: 30px 0px 0px; padding: 0px; border: 0px; letter-spacing: -0.64px; line-height: 26px;">몽키에서는 마음대로 예약하세요~~ test&nbsp;<br style="box-sizing: border-box; font-family: sans-serif;">호텔,골프,투어,차량..취소/변경수수료가 전~혀 없어요.<br style="box-sizing: border-box; font-family: sans-serif;">단,호텔이나 업체에서 매기는 수수료는 어쩔 수 없지만 최대한 가볍게 해드려요~~</div>
                                        <div class="policy_center" style="box-sizing: border-box; margin: 40px 0px 0px; padding: 0px; border: 0px; color: rgb(37, 37, 37); font-family: " noto="" sans="" kr";="" letter-spacing:="" -0.64px;="" display:="" flex;"="">
                                            <div class="left" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: inherit; font-family: inherit; font-size: inherit; letter-spacing: -0.04em; width: 391px;">
                                                <p style="box-sizing: border-box; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">24년 11월 10일(일) 18시 이전:</p>
                                                <p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">24년 11월 10일(일) 18시 ~ 24년 11월 11일(일) 18시:</p>
                                                <p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">24년 11월 10일(일) 18시 이후 쥐소 또는 노쇼(No Show):</p>
                                            </div>
                                            <div class="right" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: inherit; font-family: inherit; font-size: inherit; letter-spacing: -0.04em; width: 391px;">
                                                <p style="box-sizing: border-box; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">취소/변경 수수류 전혀 없이&nbsp;<span class="color" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: rgb(255, 136, 39); font-family: inherit; font-size: inherit; letter-spacing: -0.04em;">취소/변경 가능</span></p>
                                                <p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">결제하신 금액의&nbsp;<span class="color" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: rgb(255, 136, 39); font-family: inherit; font-size: inherit; letter-spacing: -0.04em;">50% 요금이 자지</span>로 발생</p>
                                                <p style="box-sizing: border-box; margin-top: 10px; border: 0px; color: rgb(34, 34, 34); font-family: Pretendard; letter-spacing: -0.04em; line-height: 26px;">결제하신 금액&nbsp;<span class="color" style="box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; color: rgb(255, 136, 39); font-family: inherit; font-size: inherit; letter-spacing: -0.04em;">전액이 자지</span>로 발생</p>
                                            </div>
                                        </div>
                                        <div class="policy_bottom" style="box-sizing: border-box; margin: 40px 0px 0px; padding: 0px; border: 0px; color: rgb(172, 172, 172); letter-spacing: -0.64px; line-height: 26px;">* 정확한 저리를 위해서 쥐소변경온 전화로는 눌가하고, 반드시 사이트에 글로 남겨주셔야 합니다.<br style="box-sizing: border-box; font-family: sans-serif;">* 위의 취소요청 시간은 한국시간을 기준으로 됩니다.<br style="box-sizing: border-box; font-family: sans-serif;">* 노 쇼(No-Show): 여악올 했지만 쥐소 연락 없이 예약장소에 나타나지 않는 경우를 말합니다.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dim"></div>
        </div>

        <div id="popup_coupon" class="popup" data-price="">
            <div class="popup-content">
                <img src="/images/ico/close_icon_popup.png" alt="close_icon" class="close-btn">
                <h2 class="title-popup">적용가능한 쿠폰 확인</h2>
                <div class="order-popup">
                    <p class="count-info">사용 가능 쿠폰 <span>0장</span></p>
                    <div class="description-above">
                        <div class="item-price-popup item-price-popup--button active" data-idx="" data-type="" data-discount="0" data-discount_baht="0">
                            <span>적용안함</span>
                        </div>
                    </div>
                    <div class="line-gray"></div>
                    <div class="footer-popup">
                        <div class="des-above">
                            <div class="item">
                                <span class="text-gray">총 주문금액</span>
                                <span class="text-gray total_price" id="total_price_popup" data-price="">0원</span>
                            </div>
                            <div class="item">
                                <span class="text-gray">할인금액</span>
                                <span class="text-gray discount" data-price="">0원</span>
                            </div>
                        </div>
                        <div class="des-below">
                            <div class="price-below">
                                <span>최종결제금액</span>
                                <p class="price-popup">
                                    <span id="last_price_popup">0</span><span class="text-gray">원</span>
                                </p>
                            </div>
                        </div>
                        <button type="button" class="btn_accept_popup btn_accept_coupon">
                            쿠폰적용
                        </button>
                    </div>
                </div>
            </div>
        </div>

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
                    success: function(data, textStatus) {
                        $("#sel_option").html(data);
                    },
                    error: function(request, status, error) {
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
                    success: function(data, textStatus) {
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
                    error: function(request, status, error) {
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
                $('input.input_qty').each(function() {
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
                button.addEventListener('click', function() {
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

            $('.quantity-container').each(function() {
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

                $increaseBtn.click(function() {
                    quantity++;
                    $quantityDisplay.text(quantity);
                    $decreaseBtn.removeAttr('disabled');
                    updateQuantity($container, quantity);
                    updatePrice();
                });

                $decreaseBtn.click(function() {
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

            // var selectedTourIds = [];
            // $('input[type="checkbox"]').change(function() {
            //     updateOptionText();
            // });

            // selectedPrice = [];

            // function updateOptionText() {
            //     var selectedOptions = [];
            //     selectedTourIds = [];
            //     selectedPrice = [];

            //     $('input[type="checkbox"]:checked').each(function() {
            //         var optionContainer = $(this).closest('.form-group');
            //         var optionName = optionContainer.find('label').text();
            //         var optionPrice = parseFloat(optionContainer.find('.price').text().replace('원', '').replace(',', ''));
            //         var optionBaht = parseFloat(optionContainer.find('.currency').text().replace('바트', '').replace(',', ''));

            //         var tourIdx = $(this).attr('id');

            //         selectedTourIds.push(tourIdx); 
            //         selectedOptions.push(`${optionName} ${number_format(optionPrice)}원 (${number_format(optionBaht)}바트)`);
            //         selectedPrice.push(optionPrice);
            //     });

            //     var optionText = selectedOptions.length > 0 ? selectedOptions.join(' + ') : "선택된 옵션이 없습니다.";
            //     $('td.option').text(optionText);

            // }

            function number_format(number) {
                return number.toLocaleString('ko-KR');
            }

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

            $('.btn-ct-3').click(function() {
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

            // $('.primary-btn-calendar.tour').click(function() {
            //     if (checkDateSelected()) {
            //         $('.sec2-item-card, .section2 .title-sec2, .section2 .sec2-date-main, .section2 .sec2-date-sub').hide();
            //         $('.section1').hide();
            //         $('.sec2-item-card.order-form-page, .sec2-item-card.card-left2').show();

            //         var selectedDateText = $('#days_choose').text();
            //         var dateParts = selectedDateText.split('(')[0].trim();
            //         var formattedDate = dateParts.replace(/\./g, '-');
            //         var adultCnt = adultQuantity;
            //         var childCnt = childQuantity;
            //         var babyCnt = babyQuantity;
            //         var adultTotalPrices = adultTotalPrice;
            //         var childTotalPrices = childTotalPrice;
            //         var babyTotalPrices = babyTotalPrice;
            //         var priceOptionTotal = totalCost;
            //         var last_price = adultTotalPrices + childTotalPrices + babyTotalPrices + priceOptionTotal;
            //         var selectedTime = $('.select-time-c').val();
            //         if (!selectedTime) {
            //             selectedTime = $('.select-time-c option:first').val();
            //         }
            //         const idxWithQuantities = selectedTourIds.map(idx => `${idx}:${selectedTourQuantities[idx]}`).join(',');


            //     }
            // });

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

            $(".item-price-popup").click(function() {
                $(this).addClass("active").siblings().removeClass("active");
                setCouponArea();
            })

            $(".btn_accept_coupon").click(function() {
                setCouponArea(true);
                calculatePrice();
                $("#popup_coupon").css('display', 'none');
            })

            initializeDefaultTour();


            function showCouponPop() {
                $("#popup_coupon").css('display', 'flex');
            }

            const $closePopupBtn = $('.close-btn');
            $closePopupBtn.on('click', function() {
                $("#popup_coupon").css('display', 'none');
            });


            $('.btn_back').click(function() {
                $('.sec2-item-card, .section2 .title-sec2, .section2 .sec2-date-main, .section2 .sec2-date-sub').show();
                $('.section1').show();
                $('.sec2-item-card.order-form-page, .sec2-item-card.card-left2').hide();
            });
        </script>
        <script>
            jQuery(document).ready(function() {


                var dim = $('#dim');
                var popup = $('#popupRoom');
                var closedBtn = $('#popupRoom .closed_btn');

                var popup2 = $('#popup_img');
                var closedBtn2 = $('#popup_img .closed_btn');

                /* closed btn*/
                closedBtn.click(function() {
                    popup.hide();
                    dim.fadeOut();
                    $('.multiple-items').slick('unslick'); // slick 삭제
                    return false;
                });

                closedBtn2.click(function() {
                    popup2.hide();
                    dim.fadeOut();
                    $('.multiple-items').slick('unslick'); // slick 삭제
                    return false;
                });

                // $(".short_link").on('click', function(evt) {
                //     evt.preventDefault();
                //     var target = $(this).data('target');
                //     // $(window).scrollTop($('#' + target).offset().top - 100, 300);
                //     $('html, body').animate({
                //         scrollTop: $('#' + target).offset().top - 100
                //     }, 'slow');
                //     return false;
                // });

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
            // document.addEventListener('DOMContentLoaded', function() {
            //     const allContainers = document.querySelectorAll('.calendar-right .quantity-container-fa');
            //     const sec2Items = document.querySelectorAll('.sec2-item-card');

            //     allContainers.forEach(container => {
            //         container.style.display = 'none';
            //     });

            //     const firstContainer = document.querySelector('.calendar-right .quantity-container-fa');
            //     if (firstContainer) {
            //         firstContainer.style.display = 'block';
            //         const initialToursIdx = firstContainer.getAttribute('data-tour-index');
            //         console.log("Initial tours_idx:", initialToursIdx);
            //     }

            //     if (sec2Items.length > 0) {
            //         sec2Items[0].classList.add('active');
            //     }

            //     document.querySelectorAll('.btn-ct-3').forEach((button) => {
            //         button.addEventListener('click', function() {
            //             const tourIndex = this.getAttribute('data-tour-index');

            //             sec2Items.forEach(sec2Item => {
            //                 sec2Item.classList.remove('active');
            //             });

            //             const selectedSec2Item = document.querySelector(`.section2 .sec2-item-card[data-tour-index="${tourIndex}"]`);
            //             if (selectedSec2Item) {
            //                 selectedSec2Item.classList.add('active');
            //             }


            //             document.querySelectorAll('.calendar-right .quantity-container-fa').forEach(container => {
            //                 container.style.display = 'none';
            //             });

            //             const selectedContainer = document.querySelector(`.calendar-right .quantity-container-fa[data-tour-index="${tourIndex}"]`);
            //             if (selectedContainer) {
            //                 selectedContainer.style.display = 'block';
            //                 const toursIdx = selectedContainer.getAttribute('data-tour-index');
            //                 console.log("tours_idx:", toursIdx);
            //             }
            //         });
            //     });
            // });

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

        <!-- DEBUG-VIEW START 3 APPPATH\Views\inc\sidebar_inc.php -->
        <div class="side-bar-inc">
            <div class="card-side-bar">
                <div class="side-bar-above side_bar_swipper swiper-container swiper-initialized swiper-horizontal swiper-backface-hidden">
                    <h3 class="title-side-bar">최근본상품</h3>
                    <div class="img-container swiper-wrapper" id="swiper-wrapper-9139b9469c0931cf" aria-live="polite">
                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 10" data-swiper-slide-index="0" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img1">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img2">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img3">
                        </div>
                        <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 10" data-swiper-slide-index="1" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img4">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img5">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img6">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="3 / 10" data-swiper-slide-index="2" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="4 / 10" data-swiper-slide-index="3" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="5 / 10" data-swiper-slide-index="4" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="6 / 10" data-swiper-slide-index="5" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="7 / 10" data-swiper-slide-index="6" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="8 / 10" data-swiper-slide-index="7" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="9 / 10" data-swiper-slide-index="8" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                        <div class="swiper-slide" role="group" aria-label="10 / 10" data-swiper-slide-index="9" style="width: 68px; margin-right: 20px;">
                            <img class="img-sidebar" src="/images/main/sidebar_img2.png" alt="sidebar_img7">
                            <img class="img-sidebar" src="/images/main/sidebar_img3.png" alt="sidebar_img8">
                            <img class="img-sidebar" src="/images/main/sidebar_img1.png" alt="sidebar_img9">
                        </div>
                    </div>
                    <p class="pagination_sidebar">
                        <span class="current-slide">1</span>/<span class="total-slides">10</span>
                    </p>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div class="side-bar-below">
                    <div class="left side_bar_swipper_btn_prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-9139b9469c0931cf">
                        <img src="/images/main/arrow_prev_icon.png" alt="arrow_prev_icon">
                    </div>
                    <div class="right side_bar_swipper_btn_next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-9139b9469c0931cf">
                        <img src="/images/main/arrow_next_icon.png" alt="arrow_next_icon">
                    </div>
                </div>
            </div>
            <div class="icon-wrap-social">
                <div class="robot-container" onclick="go_link_fn_inc();">
                    <img src="/images/ico/robot_icon.png" alt="Scroll to Top">
                </div>
                <div class="scroll-to-top visible">
                    <img src="/images/ico/arrow_up_icon.png" alt="Scroll to Top">
                </div>
            </div>
        </div>
        <script>
            function go_link_fn_inc() {
                window.open("https://channel.io/ko", "_blank");
            }

            $(document).ready(function() {
                const $scrollTopBtn = $('.scroll-to-top');

                $(window).scroll(function() {
                    if ($(this).scrollTop() > 100) {
                        $scrollTopBtn.addClass('visible');
                    } else {
                        $scrollTopBtn.removeClass('visible');
                    }
                });

                $scrollTopBtn.on('click', function() {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                });

                const totalSlides = 10;

                const swiper3 = new Swiper(".side_bar_swipper", {
                    loop: true,
                    slidesPerView: 1,
                    spaceBetween: 20,
                    pagination: {
                        pagination: false,
                    },
                    navigation: {
                        prevEl: ".side_bar_swipper_btn_prev",
                        nextEl: ".side_bar_swipper_btn_next",
                    },
                    on: {
                        init: function(swiper) {
                            updatePagination(swiper.realIndex);
                        },
                        slideChange: function(swiper) {
                            updatePagination(swiper.realIndex);
                        },
                    },
                });

                function updatePagination(index) {
                    const currentSlide = index + 1;
                    $('.pagination_sidebar .current-slide').text(currentSlide);
                    $('.pagination_sidebar span.total-slides').text(totalSlides);
                }

            });
        </script>
        <!-- DEBUG-VIEW ENDED 3 APPPATH\Views\inc\sidebar_inc.php -->
        <!-- DEBUG-VIEW START 4 APPPATH\Views\inc\popup_login.php -->
        <style>
            .popup_ {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background-color: rgba(0, 0, 0, 0.2);
                display: none;
                align-items: center;
                justify-content: center;
            }

            .popup_.show_ {
                display: flex;
            }

            .popup_area_ {
                height: auto;
                max-height: 90vh;
                overflow: auto;
                background-color: #FFFFFF;
                width: 100%;
                min-width: 600px;
                max-width: 40vw;
                padding: 10px 40px 50px;
                ;
                font-size: 14px;
                border: 2px solid #333333;
            }

            .popup_top_ {
                width: 100%;
                height: 50px;
                background-color: #FFFFFF;
                display: flex;
                align-items: center;
                justify-content: space-between;
                font-size: 18px;
                font-weight: bold;
                border-bottom: 1px solid #dbdbdb;
            }

            .popup_content_ {
                margin-top: 20px;
            }

            .popup_bottom_ {
                margin-top: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 20px;
                padding-top: 20px;
                width: 100%;
                border-top: 1px solid #dbdbdb;
            }

            .popup_bottom_ button {
                display: inline-block;
                width: 100px;
                height: 40px;
                border: 1px solid rgb(204, 204, 204);
            }

            .sup_button {
                background-color: white;
                color: black;
                border: 1px solid #dbdbdb;
                padding: 16px 20px;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 12px;
                width: 100%;
                font-size: 18px;
            }

            .item_login_ {
                display: none;
            }

            .item_login_.show_ {
                display: block;
            }

            .box_login {
                margin-top: 20px;
                padding: 20px;
                background-color: rgba(255, 255, 255, 0.35);
                border: 1px solid #dbdbdb;
                border-radius: 20px;
            }

            .box_login h4 {
                font-size: 20px;
                margin-top: 30px;
                /*margin-bottom: 10px;*/
            }

            .input_group_ {
                margin: 0 0 10px 0;
            }

            .label_inp_ {
                margin-top: 20px;
                margin-bottom: 5px;
                font-size: 18px;
            }

            .layout_input_ input {
                font-size: 16px;
            }

            .box_login p {
                font-size: 16px;
                margin: 20px 0;
            }

            .nomember_wrap {
                margin-top: 40px;
            }

            .login_wrap .memx_login p {
                margin-top: 10px;
            }

            .nomember_wrap .btn_nomember,
            .btnNoLogin {
                width: 100%;
                border-radius: 10px;
                padding: 13px 0;
                font-size: 18px;
                font-weight: 500;
                border: 2px solid #474747;
                background: #fff;
            }

            .nomember_wrap a {
                width: 100%;
                font-size: 18px;
                cursor: pointer;
                border: 1px solid #000;
                margin-top: 10px;
                background: #fff;
                border-radius: 10px;
                padding: 16px 0;
                display: flex;
                justify-content: center;
                box-sizing: border-box;
                font-weight: 500;
            }

            #btnLoginMain01,
            #btnLogin01 {
                display: none;
            }

            #btnLogin02 {
                /*display: none;*/
            }

            #btnLoginSupMain {
                display: none;
                background-color: white !important;
                ;
                color: black !important;
                ;
                border: 1px solid #dbdbdb !important;
            }

            #btnLoginMain {
                display: none;
            }

            #inputMainGroup {
                display: none;
            }

            #btnLogin01.show_,
            #btnLoginMain01.show_ {
                display: block;
            }

            #btnLogin02.show_ {
                display: block;
            }

            #btnLoginSupMain.show_ {
                display: block;
            }

            #btnLoginMain.show_ {
                display: block;
            }

            #inputMainGroup.show_ {
                display: block;
            }
        </style>

        <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
        <script type="text/javascript" src="/js/kakao.js"></script>

        <div class="popup_" id="popupLogin_">
            <div class="popup_area_">
                <div class="popup_top_">
                    <p>
                        로그인 또는 회원가입
                    </p>
                    <p>
                        <button type="button" class="btn_close_" onclick="showOrHideLoginItem();">
                            <img src="/images/ico/close_icon_popup.png" alt="" style="width: 20px; height: 20px">
                        </button>
                    </p>
                </div>
                <div class="popup_content_">
                    <main class="sub login member pt100">
                        <div class="inner_620">

                            <div class="flex_c_c logo_box">
                                <picture>
                                    <source media="(max-width: 768px)" srcset="/images/sub/logo_w.png">
                                    <img src="/images/sub/logo_w.png" alt="더투어랩 로고">
                                </picture>
                            </div>
                            <!--                    <div class="login_tab">-->
                            <!--                        <button type="button" class="on">회원 로그인</button>-->
                            <!--                        <button type="button">비회원 예약확인</button>-->
                            <!--                    </div>-->

                            <section class="login_cont">

                                <!-- 회원 -->
                                <div class="login_box on">
                                    <form action="/member/login_check" method="post" name="loginForm2" id="loginFrm2" class="login_form01">
                                        <input type="hidden" name="mode" id="mode" value="true">
                                        <input type="hidden" name="sType" id="sType" value="login">
                                        <input type="hidden" name="sns_key" id="sns_key" value="">
                                        <input type="hidden" name="user_name" id="user_name" value="">
                                        <input type="hidden" name="userEmail" id="userEmail" value="">
                                        <input type="hidden" name="gubun" id="gubun" value="">
                                        <input type="hidden" name="returnUrl" id="returnUrl" value="">

                                        <div class="input-group show_" id="inputMainGroup">
                                            <div class="input-row">
                                                <input type="text" name="user_id" class="bs-input" onkeyup="press_it2()" placeholder="아이디를 입력하세요." value="">
                                            </div>
                                            <div class="input-row">
                                                <input type="password" name="user_pw" class="bs-input" onkeyup="press_it2(event)" placeholder="비밀번호를 입력하세요.">
                                            </div>
                                            <div class="input-row save_id flex_b_c">
                                                <div class="bs-input-check">
                                                </div>
                                                <div class="btn_link">
                                                    <a href="/member/login_find_id">아이디/비밀번호 찾기</a>
                                                    <a href="/member/join_choice"><span>회원가입</span></a>
                                                </div><!-- .btn_link -->
                                            </div>

                                        </div>


                                        <div class="btn-wrap">
                                            <button type="button" id="btnLoginMain" class="show_ btn btn-lg btn-point" onclick="login_it2();">
                                                로그인
                                            </button>

                                            <button type="button" id="btnLoginSupMain" class="btn btn-lg btn-point" onclick="openLogin();">
                                                로그인
                                            </button>

                                        </div>

                                        <div class="item_login_" style="margin-top: 20px; margin-bottom: 20px" id="loginNoAreaMember">
                                            <!--                                <div class="box_login">-->
                                            <!--                                    <h4>비회원 예약 조회 및 로그인</h4>-->
                                            <!--                                    <form name="frmLogin_nomember" method="post" action="#">-->
                                            <!--                                        <div class="input_group_">-->
                                            <!--                                            <label class="label_inp_">이메일 주소</label>-->
                                            <!--                                            <div class="layout_input_">-->
                                            <!--                                                <input type="text" name="member/email" data-validate="required,email"-->
                                            <!--                                                       title="예약시 입력한 이메일 주소" placeholder="예약시 입력한 이메일 주소를 입력해 주세요">-->
                                            <!--                                            </div>-->
                                            <!--                                            <label class="label_inp_">예약번호</label>-->
                                            <!--                                            <div class="layout_input_">-->
                                            <!--                                                <input type="text" name="grpno" id="grpno" maxlength="50"-->
                                            <!--                                                       data-validate="required,minlength[4]" title="9자리 숫자"-->
                                            <!--                                                       placeholder="9자리 숫자로 된 예약번호를 입력해 주세요">-->
                                            <!--                                            </div>-->
                                            <!--                                        </div>-->
                                            <!--                                        <p>※ 비회원 로그인 후 추가 예약이 가능해요.</p>-->
                                            <!--                                        <div class="btn_login">-->
                                            <!--                                            <button type="button" class="btnNoLogin" onclick="login_nomember_login();">-->
                                            <!--                                                로그인-->
                                            <!--                                            </button>-->
                                            <!--                                        </div>-->
                                            <!--                                    </form>-->
                                            <!--                                </div>-->
                                            <!---->
                                            <!--                                <div class="nomember_wrap">-->
                                            <!--                                    <p>비회원은 포인트 적립, 크레이지 세일 예약, 이벤트 참여, 쿠폰 사용이 불가능해요.</p>-->
                                            <!--                                    <a href="#" onclick="submitNoMember();" class="btn_nomember">비회원으로 예약하기</a>-->
                                            <!--                                </div>-->
                                            <div class="input-group">

                                                <div class="input-row">
                                                    <input type="text" name="order_no" id="order_no" class="bs-input" placeholder="예약번호를 입력하세요.">
                                                </div>
                                                <div class="input-row">
                                                    <input type="text" name="order_user_name" id="order_user_name" class="bs-input" placeholder="이름을 입력하세요.">
                                                </div>
                                                <div class="input-row">
                                                    <div class="tel_row">
                                                        <select name="order_user_mobile1" id="order_user_mobile1" class="bs-select">
                                                            <option value="010">010</option>
                                                            <option value="011">011</option>
                                                            <option value="016">016</option>
                                                            <option value="017">017</option>
                                                            <option value="018">018</option>
                                                            <option value="019">019</option>
                                                        </select>
                                                        <span>-</span>
                                                        <input type="tel" name="order_user_mobile2" id="order_user_mobile2" class="bs-input">
                                                        <span>-</span>
                                                        <input type="tel" name="order_user_mobile3" id="order_user_mobile3" class="bs-input">
                                                    </div>
                                                </div>

                                            </div>

                                            <form id="check_pass_form" name="check_pass_form" method="post">
                                                <input type="hidden" value="" name="check_pass" id="check_pass_input">
                                            </form>
                                        </div>
                                    </form>

                                    <div class="btn-wrap">
                                        <button type="button" class="show_ sup_button" onclick="openSupLogin(this);" id="btnLogin01">
                                            비회원 예약확인
                                        </button>

                                        <button type="button" class="btn btn-lg btn-point" id="btnLoginMain01" onclick="go_result2();">
                                            비회원 예약확인
                                        </button>

                                        <button type="button" class="sup_button" id="btnLogin02">
                                            비회원 예약하기
                                        </button>
                                    </div>


                                    <div class="sns_login_ttl">
                                        <span>SNS 로그인</span>
                                    </div>

                                    <script>
                                        // jQuery click event
                                        $("#btnLogin02").click(function() {

                                            $.ajax({
                                                url: "/ajax/memberSession",
                                                type: "POST",
                                                data: {},
                                                dataType: "json",
                                                success: function(res) {
                                                    var message = res.message;
                                                    //alert(message);
                                                    location.reload();
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error(xhr.responseText); // 서버 응답 내용 확인
                                                    alert('Error: ' + error);
                                                }
                                            });
                                        });
                                    </script>

                                    <script>
                                        //네이버 로그인
                                        function fnNaverLogin2() {
                                            location.href = 'https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fmember%2Flogin_naver&state=b4ed7a3e894112a5e45c4befa418c6edlog';
                                        }
                                    </script>

                                    <div class="another_login">
                                        <button type="button" class="another_btn naver" onclick="fnNaverLogin2();">
                                            네이버로그인
                                        </button>
                                        <button type="button" class="another_btn kakao" onclick="loginWithKakao()">
                                            카카오로그인
                                        </button>
                                        <button type="button" id="customBtn" class="another_btn google" onclick="location.href='https://accounts.google.com/o/oauth2/v2/auth?client_id=453994188031-gfbrsmekigdkn78g2r4voi28rrns7nr1.apps.googleusercontent.com&amp;redirect_uri=http%3A%2F%2Flocalhost%3A8080%2Fmember%2Fgoogle_login&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&amp;response_type=code&amp;state=OK'">
                                            구글로그인
                                        </button>
                                    </div>

                                </div>
                                <!-- // 회원 // -->
                            </section>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <script>
            function showOrHideLoginItem() {
                $("#popupLogin_").toggleClass('show_');
                let current_url = window.location.href;
                $('#returnUrl').val(current_url)
            }

            function openLogin() {
                handleLogin();
            }

            function handleLogin() {
                $("#inputMainGroup").addClass('show_');
                $("#btnLoginMain").addClass('show_');
                $("#btnLogin01").addClass('show_');
                $("#loginNoAreaMember").removeClass('show_');
                $("#btnLoginSupMain").removeClass('show_');
                $("#btnLoginMain01").removeClass('show_');
            }

            function handleSupLogin() {
                $("#inputMainGroup").removeClass('show_');
                $("#btnLoginMain").removeClass('show_');
                $("#btnLogin01").removeClass('show_');
                $("#loginNoAreaMember").addClass('show_');
                $("#btnLoginSupMain").addClass('show_');
                $("#btnLoginMain01").addClass('show_');
            }

            function openSupLogin(el) {
                let loginNoAreaMember = $("#loginNoAreaMember");
                if (loginNoAreaMember.hasClass('show_')) {
                    handleLogin();
                } else {
                    handleSupLogin();
                }
            }

            function submitNoMember() {

            }

            function login_nomember_login() {

            }

            function login_it2() {
                if (loginForm2.user_id.value == false) {
                    loginForm2.user_id.focus();
                    alert("아이디을 바르게 입력하셔야 합니다.");
                    return;
                }

                if (loginForm2.user_pw.value == "") {
                    loginForm2.user_pw.focus();
                    alert("패스워드를 입력하셔야 합니다.");
                    return;
                }

                $("#loginFrm2").submit();
            }

            function press_it2() {
                if (event.keyCode == 13) {
                    login_it2();
                }
            }

            function go_result2() {
                if ($("#order_no").val() == "") {
                    $("#order_no").focus();
                    alert("예약번호를 입력하셔야 합니다.");
                    return;
                }

                if ($("#order_user_name").val() == "") {
                    $("#order_user_name").focus();
                    alert("이름을 입력하셔야 합니다.");
                    return;
                }

                if ($("#order_user_mobile2").val() == "") {
                    $("#order_user_mobile2").focus();
                    alert("전화번호를 입력하셔야 합니다.");
                    return;
                }

                if ($("#order_user_mobile3").val() == "") {
                    $("#order_user_mobile3").focus();
                    alert("전화번호를 입력하셔야 합니다.");
                    return;
                }

                var order_no = $("#order_no").val();
                var url = "";

                // Điều kiện để kiểm tra tiền tố và chọn file PHP phù hợp
                if (order_no.startsWith("S")) {
                    url = "/ajax/ajax.order_inq.php";
                } else if (order_no.startsWith("R")) {
                    url = "/ajax/id_checking.php";
                } else {
                    alert("예약번호가 일치하지 않습니다.");
                    return;
                }

                var message = "";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "order_no": $("#order_no").val(),
                        "order_user_name": $("#order_user_name").val(),
                        "order_user_mobile1": $("#order_user_mobile1").val(),
                        "order_user_mobile2": $("#order_user_mobile2").val(),
                        "order_user_mobile3": $("#order_user_mobile3").val(),
                        "pass_check": "Y",
                    },
                    dataType: "json",
                    async: false,
                    cache: false,
                    success: function(data, textStatus) {
                        message = data.message;
                        if (message == "0") {
                            alert('예약정보를 확인하세요');
                            $("#order_no").focus();

                        } else {
                            if (order_no.startsWith("S")) {
                                $("#resulrForm").submit();
                            } else if (order_no.startsWith("R")) {
                                $("#check_pass_form").attr('action', '/mypage/custom_travel_view?idx=' + data.idx)
                                $("#check_pass_input").val('Y')
                                $("#check_pass_form").submit()
                            } else {
                                alert("예약번호가 일치하지 않습니다.");
                            }

                        }
                    },
                    error: function(request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });

            }
        </script>
        <!-- DEBUG-VIEW ENDED 4 APPPATH\Views\inc\popup_login.php -->
    </div>
</div>
<?php $this->endSection(); ?>