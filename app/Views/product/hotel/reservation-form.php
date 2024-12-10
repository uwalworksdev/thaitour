<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <style>
        .item-info-check-first.click {
            background-color: #686868;
            margin-bottom: 16px;
            color: #fff;
        }

        .item-info-check-first {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 14px;
            border-radius: 6px;
            background-color: #f3f3f3;
            margin-bottom: 20px;
        }

        .item-info-check-first img {
            width: 25px;
            height: 17px;
        }

        .item-info-check img {
            width: 25px;
            height: 17px;
        }

        .item-info-check {
            display: flex;
            justify-content: space-between;
            border-radius: 6px;
            padding: 16px 14px;
            margin: 0 !important;
            font-size: 15px;
        }

        .item_check_term_all_,
        .item_check_term_ {
            background: url(/uploads/icons/form_check_icon.png) no-repeat right 50% #fff;
            background-size: 23px 15px;
        }

        .item_check_term_all_.checked_,
        .item_check_term_.checked_ {
            background: url(/images/ico/check_2.png) no-repeat right 50% #fff;
            background-size: 23px 15px;
        }

        .item_check_term_all_ label,
        .item_check_term_ label {
            font-size: 16px;
            line-height: 1.3;
        }

        .item-info-check:hover {
            background-color: #f3f3f3;
            cursor: pointer;
        }

        .summary-tb {
            font-size: 16px;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        .summary-tb2 {
            font-size: 16px;
            text-decoration: underline;
            color: #0000cc;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .customer-form-page .container-card .card-left2 {
            margin-bottom: 50px;
        }

        .card_left_end_ {
            margin-bottom: 190px;
        }

        .customer-form-page .container-card .card-right2 {
            height: auto;
        }

        .book_cont {
            /*height: 0px;*/
            /*overflow: hidden;*/
        }

        .book_cont.full_ {
            /*height: auto;*/
            /*overflow: auto;*/
        }

        #product_info_card_ {
            display: none;
        }

        #product_info_card_.full_ {
            display: block;
        }

        .book_cont table.book_tbl {
            width: 100%;
            margin: 0 auto;
        }

        .book_cont table.book_tbl th,
        .book_cont table.book_tbl td {
            font-weight: 400;
            text-align: left;
            padding: 15px 20px;
            position: static;
            border: 1px solid #dcdcdc;
        }

        .book_cont table.book_tbl th {
            border-top: 1px solid #dcdcdc;
            border-right: 1px solid #dcdcdc;
            border-left: 1px solid #dcdcdc;
            background-color: #f5f7f9 !important;
        }

        .section_hotelbook + .popup_box .tbl_request th {
            border: 1px solid #dcdcdc;
            font-weight: 400;
            padding: 7px 0 7px 10px;
            background: #f5f7f9;
            font-size: 18px;
        }

        .book_cont table.book_tbl td {
            background: #fff;
            text-align: left;
            border: 1px solid #dcdcdc;
            line-height: 28px;
            font-size: 16px;
        }

        .book_cont table.book_tbl textarea.memo {
            width: 95%;
            padding: 5px;
            height: 120px;
        }

        .section_hotelbook + .popup_box .tbl_request td {
            border: 1px solid #dcdcdc;
        }

        .box_gr02 {
            font-size: 15px;
            margin-top: 30px;
            border: 1px solid #e2e2e2;
            background: #f6f6f6;
            text-align: center;
            padding: 20px 0;
        }

        .explain_point {
            margin: 20px 35px;
            font-size: 13px;
            text-align: left;
        }

        .explain_point h5 {
            font-size: 18px;
            color: #777;
            padding-bottom: 10px;
            font-weight: 500;
        }

        .txt_me01 {
            color: #7d7d7d;
            font-size: 16px;
        }

        .explain_point ul {
            margin: 20px 0 0 10px;
            line-height: 28px;
        }

        .notice_ty01 li {
            list-style-type: disc;
            text-indent: 0 !important;
        }

        .f_14.f_gray {
            font-size: 14px;
            color: #888;
            line-height: 18px;
        }

        .f_14.f_red {
            font-size: 14px;
            color: #db1717;
            line-height: 18px;
        }

        .list_type02 {
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
        }

        .list_type02 .pubcheck {
            margin-top: 10px;
            padding-right: 30px;
        }

        .txt_me01,
        .product_information_ {
            height: 400px;
            overflow: auto;
        }

        .txt_me01::-webkit-scrollbar,
        .product_information_::-webkit-scrollbar {
            width: 4px;
            background-color: #F5F5F5;
            /*display: none;*/
        }

        .txt_me01::-webkit-scrollbar-thumb,
        .product_information_::-webkit-scrollbar-thumb {
            background-color: #cccccc;
        }

        .card_relative_ {
            position: relative;
            margin-bottom: 50px;
        }

        .btn_unreadmore_,
        .btn_readmore_ {
            position: absolute;
            bottom: -32px;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px 15px;
            border: 1px solid #dbdbdb;
            background-color: #FFFFFF;
            max-width: 150px;
            z-index: 5;
            /*margin-bottom: 20px;*/
            border-radius: 20px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
            cursor: pointer;
        }
    </style>
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
                                    <label for="order_user_name">한국이름</label>
                                    <input type="text" id="order_user_name" name="order_user_name" required=""
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
                                    <input type="text" id="order_user_first_name_en" name="order_user_first_name_en"
                                           required="" data-label="영문 이름" placeholder="영어로 작성해주세요.">
                                </div>
                                <div class="form-group">
                                    <label for="order_user_last_name_en">영문 성(Last Name) *</label>
                                    <input type="text" id="order_user_last_name_en" name="order_user_last_name_en"
                                           required="" data-label="영문 성" placeholder="영어로 작성해주세요.">
                                </div>
                            </div>
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

                            <div class="btn_readmore_">
                                <p>상세보기 열기</p>
                                <img src="/images/svg/chevron-double-down.svg" alt="">
                            </div>
                        </div>

                        <div class="card-left card_relative_" id="product_info_card_">
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
                                            디럭스룸
                                            &nbsp;&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>식사</th>
                                        <td>
                                            조식포함
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>체크인/체크아웃</th>
                                        <td>2024-12-17(화)
                                            ~ 2024-12-18(수)
                                            (1박)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>객실수/총인원</th>
                                        <td>1 룸 / 성인 2
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>포함사항</th>
                                        <td class="info_ra">
                                            무료 아침 식사, 무료 셀프 주차, 무료 WiFi
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>침대구성</th>
                                        <td class="info_ra">
                                            싱글침대 2개 또는 킹사이즈침대 1개
                                            <br>
                                            <span class="f_14 f_red">※ 베드타입은 보장사항이 아닌 요청사항이며, 체크인시 호텔에서 확인해주시기 바랍니다.</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>중요안내</th>
                                        <td class="info_ra">
                                            <div class="product_information_">
                                                <div>
                                                    <b>체크인 안내</b>
                                                    <p class="s_tit">체크인 15:00 / 체크아웃 정오</p>
                                                    <ul>
                                                        <li>추가 인원에 대한 요금이 부과될 수 있으며, 이는 숙박 시설 정책에 따라 다릅니다.</li>
                                                        <li>체크인 시 부대 비용 발생에 대비해 정부에서 발급한 사진이 부착된 신분증과 신용카드, 직불카드 또는 현금으로
                                                            보증금이
                                                            필요할 수 있습니다.
                                                        </li>
                                                        <li>특별 요청 사항은 체크인 시 이용 상황에 따라 제공 여부가 달라질 수 있으며 추가 요금이 부과될 수
                                                            있습니다.
                                                            또한,
                                                            반드시 보장되지는 않습니다.
                                                        </li>
                                                        <li>이 숙박 시설에서 사용 가능한 결제 수단은 신용카드, 현금입니다.</li>
                                                        <li>장기 임대를 환영합니다.</li>
                                                        <li>이 숙박 시설은 안전을 위해 소화기 구급상자 등을 갖추고 있습니다.</li>
                                                    </ul>
                                                    <br>
                                                    이 숙박 시설은 공항에서 교통편을 제공합니다(별도의 요금이 적용될 수 있음). 픽업 서비스를 이용하려면 예약 확인 메일에
                                                    나와
                                                    있는
                                                    연락처 정보로 도착 48시간 전 숙박 시설에 연락하여 도착 세부 사항을 알려주시기 바랍니다. 도착 시 프런트 데스크 직원이
                                                    도와드립니다.
                                                </div>
                                                <div>
                                                    <b>요금</b>
                                                    <p class="f_gray">※ 숙박 시설에서 다음 요금을 결제하셔야 합니다.</p>
                                                    <dl>
                                                        <dt>[필수]</dt>
                                                        <dd></dd>
                                                        <dt>[선택]</dt>
                                                        <dd>
                                                            <ul>
                                                                <li>뷔페아침 식사 요금: 성인 THB 1047, 어린이 THB 524(대략적인 금액)</li>
                                                                <li>공항 셔틀 요금: 차량 1대당 THB 3500(편도, 정원 2명)</li>
                                                                <li>추가 요금 지불 시 이른 체크인 가능(객실 이용 상황에 따라 다름)</li>
                                                                <li>간이 침대 이용 요금: 1일 기준, THB 2000.0</li>
                                                            </ul>
                                                            <p>위 목록에 명시되지 않은 다른 항목이 있을 수 있습니다. 요금 및 보증금은 세전 금액일 수 있으며
                                                                변경될 수
                                                                있습니다. </p></dd>
                                                    </dl>
                                                </div>
                                                <div>
                                                    <b>출발 전 알아둘 사항</b>
                                                    <ul>
                                                        <li>스파 트리트먼트의 경우 사전 예약이 필요합니다. 예약 확인 메일에 나와 있는 연락처 정보로 도착 전에 호텔에
                                                            연락하여
                                                            예약하실 수 있습니다.
                                                        </li>
                                                        <li>만 3 세 이하 아동 1명은 부모 또는 보호자와 같은 객실에서 침구를 추가하지 않고 이용할 경우 무료로
                                                            숙박할 수
                                                            있습니다.
                                                        </li>
                                                        <li>이 숙박 시설은 장애인 안내 동물을 비롯한 모든 반려동물의 출입을 금지하고 있습니다.</li>
                                                    </ul>
                                                </div>
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
                                            <ul class="notice_ty01 mt0">
                                                <li class="mb10">
                                                    <b>예약</b>
                                                    장바구니 담기가 불가능하며, 한 번에 한 개의 상품만 예약이 가능합니다.<br>
                                                    업무시간과 관계없이 결제 후 즉시 예약이 확정되어 예약확정서 출력이 가능합니다.<br>
                                                    투숙자의 영문 이름은 여권 상의 이름으로 정확히 기재해 주세요. 영문 이름 미일치 시 투숙이 거부될 수 있습니다.<br>
                                                    요청사항은 호텔로 직접 전달되지만 요청사항 반영여부는 체크인 시 확인 가능하며 사전 확정은 불가능합니다.<br>
                                                    객실배정에 대한 모든 권한은 호텔에 있습니다. 드물기는 하지만 더블/트윈을 선택한 경우에도 체크인 시 객실 상황에 따라
                                                    원하시는 베드 타입으로 배정이 되지 않을 수 있습니다.
                                                </li>
                                                <li class="mb10">
                                                    <b>결제​</b>
                                                    예약과 동시에 결제가 완료되어야 하고, 20분 내 미결제 시 자동 취소됩니다.<br>
                                                    결제수단은 실시간 계좌이체, 신용카드, 간편결제, 휴대폰결제만 가능하며 결제 확인 시간이 소요되는 무통장입금/가상계좌
                                                    입금은 불가능합니다.
                                                </li>
                                                <li class="mb10">
                                                    <b>예약 변경 / 취소</b>
                                                    예약 변경은 불가능하며, 변경을 원하시는 경우 예약취소 후 다시 예약해 주세요.<br>
                                                    환불 불가 상품은 예약 확정 후 취소/변경이 불가능하니 신중하게 선택해 주세요.<br>
                                                    취소 시간 기준은 한국 시간을 기준으로 합니다.
                                                </li>
                                                <li class="mb10">
                                                    <b>동반 인원 / 아동</b>
                                                    예약한 인원을 초과할 경우 체크인 시 추가요금이 발생하거나 투숙이 거부될 수 있습니다.<br>
                                                    아동 동반 시 반드시 아동을 포함 예약을 진행해야 하며, 아동 미포함 예약할 경우 체크인 시 추가 요금이 발생하거나 투숙이
                                                    거부될 수 있습니다.<br>
                                                    조식 포함이라도 아동 조식은 포함되어 있지 않습니다. 호텔 규정에 따라 아동 조식 비용은 체크인 시 별도로 지불하셔야
                                                    합니다.
                                                </li>
                                                <li class="mb10">
                                                    <b>호텔 정보</b>
                                                    호텔 관련 정보는 제휴사에서 제공(호텔에서 입력)받은 것으로 호텔 직원의 실수 등의 이유로 간혹 내용이 부정확하기도
                                                    합니다. 감안해 주시고 호텔 정보가 실제와 달라도 이에 따른 보상은 불가합니다.
                                                </li>
                                            </ul>
                                            <!-- end : common/element/user/product/hotel/explain/explain_point_EAN.tpl -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="btn_unreadmore_">
                                <p>상세보기 닫기</p>
                                <img src="/images/svg/chevron-double-up.svg" alt="">
                            </div>
                        </div>

                        <script>
                            let down_src_ = '/images/svg/chevron-double-down.svg';
                            let up_src_ = '/images/svg/chevron-double-up.svg';

                            let ttl_open_ = '상세보기 열기';
                            let ttl_close_ = '상세보기 닫기';

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
                                <span>객실 <?= $number_room ?>개 X <?= $number_day ?>박</span>
                                <span class="font-bold"><?= number_format($last_price) ?> 원</span>
                            </div>
                            <div class="item-info-r item-info-r-border-b">
                                <span>세금&서비스비용</span>
                                <span class="font-bold"><?= number_format($extra_cost) ?> 원</span>
                            </div>
                            <div class="item-info-r font-bold-cus">
                                <span>합계</span>
                                <span><?= number_format($order_price) ?> 원</span>
                            </div>
                            <p class="below-des-price">
                                · 체크인하시려면 3일 전에 숙소로 연락해 주세요<br>· 선택하신 객실 유형의 체크인 시간은 14:00~24:00 사이,
                                체크아웃 시간은 06:00~12:00입니다.<br>· 온수 (지정시간 제공)
                            </p>
                            <p class="summary-tb">*취소규정: 결제 후 취소하시려면 결제하신 금액의 50% 요금이 부과됩니다.</p>
                            <p class="summary-tb2" id="policy_show">본 예약건 취소규정 자세히보기</p>
                            <h3 class="title-r">약관동의</h3>
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
                            <button type="button" class="btn-order">예약하기</button>
                            <button type="button" class="btn-default cart">장바구니</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="product_idx" id="product_idx" value="<?= $hotel["product_idx"] ?>">
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
                        <?= viewSQ(getPolicy(19)) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>
    <script>
        $(document).ready(function () {

            $("#save_id").click(function () {
                if ($(this).is(":checked")) {
                    $("#order_user_name").val(`<?=session("member.name")?>`);
                    const email = `<?=session("member.email")?>`;
                    const emailArr = email.split("@");
                    $("#email_1").val(emailArr[0] ?? "");
                    $("#email_2").val(emailArr[1] ?? "");
                    const phone = `<?=session("member.phone")?>`;
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

            $(".btn-order").click(function () {
                const frm = document.order_frm;
                let formData = new FormData(frm);

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
                    data: $("#order_frm").serialize(),
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
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
    </script>
<?php $this->endSection(); ?>