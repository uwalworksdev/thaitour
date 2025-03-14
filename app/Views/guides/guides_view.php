<?php $this->extend('inc/layout_index'); ?>
<?php $setting = homeSetInfo(); ?>
<?php $this->section('content'); ?>
    <link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker_custom.css"/>
    <script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
    <script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw3G5DUAOaV9CFr3Pft_X-949-64zXaBg&libraries=geometry"
            async defer></script>
    <style>
        .tours-detail .container-calendar {
            display: block;
        }

        .tours-detail .container-calendar.tour {
            padding-top: 0;
            border-top: unset;
            gap: 40px;
            height: auto;
        }

        .tours-detail .container-calendar.tour.open_ {
            min-height: 500px;
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
            align-items: center;
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
            display: none;
        }

        .calendar_text_head.open_ {
            display: block;
        }

        .calendar_note {
            display: flex;
            gap: 40px;
            margin-top: 45px;
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
            background-color: #cccccc;
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

        .daterange_guilde_detail {
            visibility: hidden;
        }

        /* Custom datepicker and dateranger */
        .daterangepicker {
            width: 1140px;
            left: 0px !important;
            /* left: calc((100% - 1140px) / 2); */
            /* height: auto; */
            /* display: block !important; */
            /* position: static !important; */
        }
        .daterangepicker .drp-calendar.left {
            padding: 20px 0 20px 20px;
        }
        .daterangepicker .calendar-table td .custom-info {
            width: 74px;
            height: 77px;
            font-size: 18px;
            gap: 6px;
        }

        .daterangepicker .calendar-table td .custom-info .allow-text {
            font-size: 14px;
            padding: 8px;
        }

        .daterangepicker .calendar-table td .custom-info .sold-out-text {
            font-size: 14px;
            padding: 5px;
        }

        .daterangepicker .calendar-table table thead tr:nth-child(2) th {
            font-size: 18px;
            padding: 15px 10px;
        }

        .daterangepicker th.month {
            font-size: 18px;
            padding-bottom: 15px;
        }

        .daterangepicker .calendar-table td::after {
            display: none;
        }

        /*.drp-buttons .cancelBtn,*/
        /*.drp-buttons .applyBtn {*/
        /*    display: none;*/
        /*}*/
        .item-info-check {
            padding: 15px;
        }

        .title-second {
            font-size: 18px;
        }
        
        .title-second {
            margin-bottom: 20px;
        }

        .item_check_term_all_, .item_check_term_ {
            background: url(/uploads/icons/form_check_icon.png) no-repeat calc(100% - 15px) 50% #f3f5f7;
            background-size: 23px 15px;
        }

        .item-info-check:hover {
            background-color: #fff;
            cursor: pointer;
        }

        .item_check_term_all_.checked_, .item_check_term_.checked_ {
            background: url(/images/ico/check_2.png) no-repeat  calc(100% - 15px) 50% #f3f5f7;
            background-size: 23px 15px;
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
                        if(!empty($guide['ufile1'])) {
                            $i3 = 1;
                        }else{
                            $i3 = 0;
                        }
                        $i3 += count($img_list);
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
                                     src="/uploads/guides/<?= $img_list[$j - 2]['ufile'] ?>"
                                     alt="<?= $guide['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                            <?php } ?>
                            <div class="grid_2_2_sub" onclick="img_pops('<?= $guide['product_idx'] ?>')"
                                 style="position: relative; cursor: pointer;">
                                <img class="custom_button imageDetailSup_"
                                     src="/uploads/guides/<?= $img_list[$j - 2]['ufile'] ?>"
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
                    <?php foreach ($options as $key => $option): ?>
                        <div class="sec2-item-card tour_calendar">
                            <?php
                            $price_ = $option['o_sale_price'];
                            ?>
                            <div class="calendar_header" data-key="<?= $key ?>"
                                 data-num="<?= $option['o_idx'] ?>">
                                <div class="desc_product">
                                    <div class=""
                                         data-price="<?= $option['o_sale_price'] ?>"><?= $option['o_name'] ?></div>
                                    <div class="desc_product_sub">
                                        <p> 옵션포함:</p>
                                        <ul>
                                            <?php foreach ($option['sup_options'] as $item): ?>
                                                <li class="" data-price="<?= $item['s_price'] ?>">
                                                    - <?= $item['s_name'] ?> </li>

                                                <?php
                                                $price_ += $item['s_price'];
                                                ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="desc_product_sub">예약기능여부 : <span
                                                style="color : #2a459f "><?= $option['o_availability'] ?></span>
                                    </div>
                                </div>

                                <div class="box_price">
                                    <p>
                                        <?= number_format($price_) ?>바트
                                        <i><?= number_format($price_ * $setting['baht_thai']) ?></i>원
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
                                        <th>가이드 시작일</th>
                                        <td colspan="1">
                                            <div class="custom_input fl mr5" style="width:150px">
                                                <div class="val_wrap">
                                                    <input name="checkin_date" type="text" data-key="<?= $key ?>"
                                                           data-num="<?= $option['o_idx'] ?>"
                                                           id="checkInDate<?= $option['o_idx'] ?>" class="hasDateranger"
                                                           data-group="true" placeholder="체크인" readonly="readonly"
                                                           value="" size="13">
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="fl mr5" style="width:80px ; margin-left: 10px">
                                                <div class="selectricWrapper selectric-selectric">
                                                    <div class="selectricHideSelect">
                                                        <select name="count_day" data-o_idx="<?= $option['o_idx'] ?>" id="countDay<?= $option['o_idx'] ?>"
                                                                class="selectric count_day">
                                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                            <?php } ?>
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
                                                    <input name="checkout_date" type="text"
                                                           id="checkOutDate<?= $option['o_idx'] ?>"
                                                           class="hasDateranger" data-key="<?= $key ?>"
                                                           data-num="<?= $option['o_idx'] ?>"
                                                           data-group="true" placeholder="체크아웃" readonly="readonly"
                                                           value="" size="13">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="">
                                        <th>총인원</th>
                                        <td colspan="5">
                                            <div class="fl mr5" style="width:90px">
                                                <select name="people_cnt" id="people<?= $option['o_idx'] ?>"
                                                        class="selectric">
                                                    <?php for ($i = 1; $i <= $option['o_people_cnt']; $i++) { ?>
                                                        <option value="<?= $i ?>"><?= $i ?> 명</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="calendar_text_head" id="calendar_text_head<?= $option['o_idx'] ?>">
                                    <span id="day_start_txt<?= $option['o_idx'] ?>">2023년 7월</span> ~ <span
                                            id="day_end_txt<?= $option['o_idx'] ?>">2023년 7월</span>
                                </div>
                                <div class="container-calendar tour" id="calendar_tab_<?= $option['o_idx'] ?>">
                                    <input style="height: 10px" type="text"
                                           id="daterange_guilde_detail<?= $option['o_idx'] ?>"
                                           class="daterange_guilde_detail"/>
                                </div>
                                <div class="calendar_note">
                                    <p class="calendar_note_cannot"> 예약마감</p>
                                    <p class="calendar_note_maybe"> 예약가능</p>
                                </div>

                                <div class="policy_wrap">
                                    <h3 class="title-second">약관동의</h3>
                                    <div class="item-info-check item_check_term_all_">
                                        <label for="fullagreement">전체동의</label>
                                        <input type="hidden" value="N" id="fullagreement">
                                    </div>
                                    <div class="item-info-check item_check_term_">
                                        <label for="">이용약관 동의(필수)</label>
                                        <input type="hidden" value="N" id="terms">
                                    </div>
                                    <div class="item-info-check item_check_term_">
                                        <label for="">개인정보 처리방침(필수)</label>
                                        <input type="hidden" value="N" id="policy">
                                    </div>
                                    <div class="item-info-check item_check_term_">
                                        <label for="">개인정보 처리방침(필수)</label>
                                        <input type="hidden" value="N" id="information">
                                    </div>
                                    <div class="item-info-check item_check_term_">
                                        <label for="guidelines">여행안전수칙 동의(필수)</label>
                                        <input type="hidden" value="N" id="guidelines">
                                    </div>
                                </div>

                                <div class="calendar_submit">
                                    <button type="button" onclick="processBooking('<?= $option['o_idx'] ?>')">견적/예약하기
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>

            <?php
            $reject_dates = [];
            $arr_date_ = explode('||||', $guide['deadline_time']);
            foreach ($arr_date_ as $itemDate) {
                if ($itemDate != "" && $itemDate) {
                    $arr_date_s_ = explode('||', $itemDate);

                    $start_date = new DateTime($arr_date_s_[0]);
                    $end_date = new DateTime($arr_date_s_[1]);
                    $end_date->modify('+1 day');

                    $interval = new DateInterval('P1D');
                    $daterange = new DatePeriod($start_date, $interval, $end_date);

                    foreach ($daterange as $date) {
                        $reject_dates[] = $date->format('Y-m-d');
                    }
                }
            }

            $available_dates = [];
            $arr_date_ = explode('||', $guide['available_period']);
            $start_date = new DateTime($arr_date_[0]);
            $end_date = new DateTime($arr_date_[1]);
            $end_date->modify('+1 day');

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($start_date, $interval, $end_date);

            foreach ($daterange as $date) {
                $available_dates[] = $date->format('Y-m-d');
            }
            ?>

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
                    <h2 class="title-sec6">상품문의(<?=$product_qna["nTotalCount"]?>)</h2>

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
                        <?php
                            $num_qna = $product_qna["num"];
                            foreach($product_qna["items"] as $qna){
                                if(!empty(trim($qna["reply_content"]))){
                                    $qna_status = "Y";
                                    $qna_text = "답변대기중";
                                }else{
                                    $qna_status = "N";
                                    $qna_text = "답변완료";
                                }
                        ?>
                            <li class="qa-item">
                                <div class="qa-wrap">
                                    <div class="qa-question">
                                        <span class="qa-number"><?=$num_qna--;?></span>
                                        <span class="qa-tag <?php if($qna_status == "N"){ echo "normal-style"; }?>"><?=$qna_text?></span>
                                        <div class="con-cus-mo-qa">
                                            <p class="qa-text"><?=$qna["title"]?></p>
                                            <div class="qa-meta text-gray only_mo"><?=$qna["r_date"]?></div>
                                        </div>
                                    </div>
                                    <div class="qa-meta text-gray only_web"><?=$qna["r_date"]?></div>
                                </div>
                                <?php
                                    if($qna_status == "Y"){
                                ?>
                                    <div class="additional-info">
                                        <span class="load-more">더투어랩</span>
                                        <?=nl2br($qna["reply_content"])?>
                                    </div>
                                <?php } ?>
                            </li>
                        <?php
                            }
                        ?>
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

                    <?php 
                        echo ipagelistingSub($product_qna["pg"], $product_qna["nPage"], $product_qna["g_list_rows"], current_url() . "?pg_qna=", '', 'golf_qna_wrap')
                    ?>
                </div>
            </div>
        </div>
        <div id="dim"></div>
        <div id="popup_img" class="on">
            <strong id="pop_roomName"></strong>
            <div>
                <ul class="multiple-items">
                <?php 
                    if(!empty($img_names[0])){
                        echo "<li><img src='" . $imgs[0] . "' alt='". $img_names[0] ."' /></li>";  
                    }
                ?>
                <?php foreach ($img_list as $img) {
                    if(!empty($img["ufile"])){
                        echo "<li><img src='/uploads/guides/" . $img["ufile"] . "' alt='". $img["rfile"] ."' /></li>";
                    }
                } ?>
                </ul>
            </div>
            <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close"></a>
        </div>
    </div>

    <script>
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
    </script>

    <script>
        $(".qa-item .qa-wrap").on("click", function () {
            if($(this).closest(".qa-item").find(".additional-info").length > 0){
                if($(this).closest(".qa-item").find(".additional-info").css("display") == "none"){
                    $(this).closest(".qa-item").find(".additional-info").css("display", "block");
                }else{
                    $(this).closest(".qa-item").find(".additional-info").css("display", "none");
                }
            }
        })

        $(".qa-submit-btn").on("click", function () {
            let title = $("#qa-comment").val();
            <?php
                if(empty(session()->get("member")["id"])) {
            ?>  
                // alert("로그인해주세요");
                // return;      
                showOrHideLoginItem();
                return false;
            <?php
                }
            ?>

            if(!title){
                alert("상품에 대해 궁금한 점을 입력해 주세요!");
                return false;
            }

            $.ajax({
                url: "/product_qna/insert",
                type: "POST",
                data: { 
                    title: title,
                    product_gubun: "guide",
                    product_idx: <?= $guide["product_idx"] ?? 0 ?>
                },
                error: function(request, status, error) {
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                },
                success: function(data, status, request) {
                    message = data.message;
                    alert(message);
                    if(data.result == true){
                        location.reload();
                    }
                }
            });
        });
    </script>

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
        $(document).ready(function () {
            $(".calendar_header").each(function () {
                init_daterange($(this).data('num'));
            })
            $(".calendar_header").click(function () {
                $('.tour_calendar').removeClass('active');
                $('.item_check_term_').removeClass('checked_');
                $('.item_check_term_all_').removeClass('checked_');
                $('.item_check_term_').val('N');
                $('.item_check_term_all_').val('N');
                $(".calendar_container_tongle").hide();
                $(this).next().show().parent().addClass('active');
                openDateRanger(this);
            });

            $(".calendar_container_tongle .close_btn").click(function () {
                $(this).parent().hide()
            });

            $('.hasDateranger').click(function () {
                openDateRanger(this);
            })

            function openDateRanger(el) {
                /* Get idx of option */
                let num_idx = $(el).data('num');

                /*
                Add style for option idx
                */
                $('.calendar_text_head').removeClass('open_')
                $('#calendar_text_head' + num_idx).addClass('open_')
                $('.container-calendar.tour').removeClass('open_')
                $('#calendar_tab_' + num_idx).addClass('open_')
                $('#daterange_guilde_detail' + num_idx).data('daterangepicker').setStartDate('2024-12-30');
                $('#daterange_guilde_detail' + num_idx).data('daterangepicker').show();
            }

            function get1() {
                console.log("get1");
                
            }

            function init_daterange(idx) {
                const enabled_dates = splitStartDate();
                const reject_days = splitEndDate();

                const daterangepickerElement = '#daterange_guilde_detail' + idx;
                const calendarTabElement = '#calendar_tab_' + idx;

                $(daterangepickerElement).daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD',
                        separator: ' ~ ',
                        applyLabel: '적용',
                        cancelLabel: '취소',
                        fromLabel: '시작일',
                        toLabel: '종료일',
                        customRangeLabel: '사용자 정의',
                        daysOfWeek: ['일', '월', '화', '수', '목', '금', '토'],
                        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                        firstDay: 0
                    },
                    isInvalidDate: function (date) {
                        const formattedDate = date.format('YYYY-MM-DD');
                        return !enabled_dates.includes(formattedDate);
                    },
                    linkedCalendars: true,
                    alwaysShowCalendars: true,
                    parentEl: calendarTabElement,
                    minDate: moment().add(1, 'days'),
                    opens: "center",
                    autoApply: true
                }, function (start, end) {

                    $('#checkInDate' + idx).val(start.format('YYYY-MM-DD'));
                    $('#checkOutDate' + idx).val(end.format('YYYY-MM-DD'));

                }).on('show.daterangepicker', function (ev, picker) {
                    $(picker.container).find("td.available").off("click").click(function () {
                        var a = $(this).attr("data-title"),
                        i = a.substr(1, 1),
                        s = a.substr(3, 1),
                        n = $(this).parents(".drp-calendar").hasClass("left")
                        ? picker.leftCalendar.calendar[i][s]
                        : picker.rightCalendar.calendar[i][s];
                        const countDay = $("#countDay" + idx).val();
                        picker.setStartDate(n);
                        picker.setEndDate(n.add(Number(countDay), "days"));
                        picker.clickApply();
                    })
                }).on('hide.daterangepicker', function (ev, picker) {
                    $(`${calendarTabElement} .daterangepicker`).show();
                    setTimeout(function () {
                        $(daterangepickerElement).data('daterangepicker').show();
                    })
                });

                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        if (mutation.type === 'childList' && $(mutation.target).hasClass('calendar-table')) {
                            $(mutation.target)
                                .find('td.off.disabled')
                                .each(function () {
                                    const $cell = $(this);
                                    const text = $cell.text().trim();
                                    if (!$cell.find('.custom-info').length) {
                                        $cell.html(`<div class="custom-info">
                                <span>${text}</span>
                                <span class="label sold-out-text">예약마감</span>
                                </div>`);
                                    }
                                });
                            $(mutation.target)
                                .find('td.available')
                                .each(function () {
                                    const $cell = $(this);
                                    const text = $cell.text().trim();
                                    if (!$cell.find('.custom-info').length) {
                                        $cell.html(`<div class="custom-info">
                                <span>${text}</span>
                                <span class="label allow-text">0만원</span>
                                </div>`);
                                    }
                                });

                            const filteredRows = $("tr").filter(function () {
                                const tds = $(this).find("td");
                                return tds.length > 0 && tds.toArray().every(td => $(td).hasClass("ends"));
                            }).remove();
                        }
                    });
                });

                observer.observe(document.querySelector(`${calendarTabElement} .daterangepicker`), {
                    childList: true,
                    subtree: true,
                });
            }

            function splitEndDate() {
                let rj = `<?= implode(',', $reject_dates) ?>`;
                return rj.split(',');
            }

            function splitStartDate() {
                let rj = `<?= implode(',', $available_dates) ?>`;
                return rj.split(',');
            }
        });

        $('.count_day').on('change', function () {
            let count_day = $(this).val();
            const o_idx = $(this).attr('data-o_idx');
            let start_day = $('#checkInDate' + o_idx).val();

            if (start_day) {
                let startDate = moment(start_day);
                let endDate = startDate.add(Number(count_day), 'days');

                $('#daterange_guilde_detail' + o_idx).data('daterangepicker').setEndDate(endDate);
                $('#daterange_guilde_detail' + o_idx).data('daterangepicker').clickApply();
            }

        })
    </script>
    <script>
        function processBooking(o_idx) {
            <?php if (empty(session()->get("member")["id"])) { ?>
            showOrHideLoginItem();
            return false;
            <?php } ?>

            let url = '<?= route_to('api.guide.processBooking') ?>';

            let formData = new FormData();

            let start_day = $('#checkInDate' + o_idx).val();
            let end_day = $('#checkOutDate' + o_idx).val();
            let people_cnt = $('#people' + o_idx).val();

            if (!start_day || !end_day) {
                alert('달력 선택해주세요!');
                return;
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

            formData.append('start_day', start_day);
            formData.append('end_day', end_day);

            formData.append('people_cnt', people_cnt);

            formData.append('o_idx', o_idx);
            formData.append('product_idx', '<?= $guide['product_idx'] ?>');

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $("#ajax_loader").addClass("display-none");
                    console.log("Success:", response);
                    window.location.href = '/guide_booking';
                },
                error: function (request, status, error) {
                    console.error("Error:", request, status, error);
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").removeClass("display-none");
                }
            });
        }
    </script>
<?php $this->endSection(); ?>