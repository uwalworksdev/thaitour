<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<?php
if (empty(session()->get("member")["mIdx"])) {
    alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>

<style>
    .box {
        text-align: center;
        font-size: 18px;
        cursor: pointer;
    }

    .hover-message {
        display: none;
        margin-top: 10px;
        color: red;
        font-weight: bold;
    }
</style>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new02.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community.css" rel="stylesheet" type="text/css" />

<section class="mypage_container" style="margin-bottom: 0;">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_1" => "on"]);
            ?>

            <div class="booklist_wrap">
                <div class="book_big_ttl">
                    <h2 class="flex">최근 예약 현황 <p>(3개월 기준)</p>
                    </h2>
                </div>
                <div class="book_num_order">
                    <div class="top flex_c_c">
                        <div class="num_order flex_c_c">
                            <p class="titles">
                                예약신청
                            </p>
                            <div class="desc">
                                <p>0</p>
                                <span>건</span>
                            </div>
                        </div>
                        <div class="num_order flex_c_c">
                            <img src="/images/mypage/right-arrow.png" alt="">
                        </div>
                        <div class="num_order flex_c_c">
                            <p class="titles">
                                결제대기중
                            </p>
                            <div class="desc">
                                <p>2</p>
                                <span>건</span>
                            </div>
                        </div>
                        <div class="num_order flex_c_c">
                            <img src="/images/mypage/right-arrow.png" alt="">
                        </div>
                        <div class="num_order flex_c_c">
                            <p class="titles">
                                예약확정중
                            </p>
                            <div class="desc">
                                <p>0</p>
                                <span>건</span>
                            </div>
                        </div>
                        <div class="num_order flex_c_c">
                            <img src="/images/mypage/right-arrow.png" alt="">
                        </div>
                        <div class="num_order flex_c_c">
                            <p class="titles">
                                예약확정
                            </p>
                            <div class="desc">
                                <p>0</p>
                                <span>건</span>
                            </div>
                        </div>
                        <div class="num_order flex_c_c">
                            <img src="/images/mypage/right-arrow.png" alt="">
                        </div>
                        <div class="num_order flex_c_c">
                            <p class="titles">
                                예약불가
                            </p>
                            <div class="desc">
                                <p>0</p>
                                <span>건</span>
                            </div>
                        </div>
                    </div>
                    <div class="process flex_c_c">
                        <p>취소처리중 <span>0</span> 건 </p>
                        <p>취소완료 <span>0</span> 건 </p>
                        <p>변경처리중 <span>0</span> 건 </p>
                        <p>실시간 예약상품 - 결제기한 만료 <span>0</span> 건 </p>
                    </div>
                </div>
                <div class="book_big_ttl flex_b">
                    <h2 class="flex">예약 현황</h2>
                    <p class="total only_mo">전체 <span><?= esc($nTotalCount) ?></span>건 </p>
                </div>
                <div class="result_book flex__c">
                    <p class="total only_web">전체 <span><?= esc($nTotalCount) ?></span>건 </p>
                    <div class="tab_box">
                        <ul class="flex">
                            <li class="on" data-menu="all">
                                <a href="#!">전체예약내역</a>
                            </li>
                            <li data-menu="progress">
                                <a href="#!">예약진행중</a>
                                <img src="/images/mypage/question_mark.png" alt="">
                            </li>
                            <li data-menu="confirmed">
                                <a href="#!">예약확정</a>
                                <img src="/images/mypage/question_mark.png" alt="">
                            </li>
                            <li data-menu="completed">
                                <a href="#!">이용완료</a>
                                <img src="/images/mypage/question_mark.png" alt="">
                            </li>
                            <li data-menu="canceled">
                                <a href="#!">취소내역</a>
                                <img src="/images/mypage/question_mark.png" alt="">
                            </li>
                        </ul>
                    </div>
                </div>

                <form name="search" id="search">
                    <input type="hidden" name="s_status" value="">
                    <input type="hidden" name="pg" value="">
                    <div class="search_form flex_b_c">
                        <div class="only_web">
                            <div class="select_search_wrap flex__c">
                                <select name="" id="">
                                    <option value="그룹별예약정렬">그룹별예약정렬</option>
                                    <option value="건별예약정렬">건별예약정렬</option>
                                </select>
                                <div class="input-row flex__c">
                                    <div class="datepick"><input type="text" name="checkInDate" id="checkInDate" onfocus="this.blur()"
                                            class="bs-input"></div>
                                    <div class="datepick"><input type="text" name="checkOutDate" id="checkOutDate" onfocus="this.blur()"
                                            class="bs-input"></div>
                                </div>
                                <select name="" id="">
                                    <option value="결제상태">결제상태</option>
                                    <option value="결제완료">결제완료</option>
                                    <option value="미결제">미결제</option>
                                </select>
                                <select name="" id="">
                                    <option value="상품종류">상품종류</option>
                                    <option value="호텔">호텔</option>
                                    <option value="골프">골프</option>
                                    <option value="투어">투어</option>
                                    <option value="차량">차량</option>
                                    <option value="가이드">가이드</option>
                                    <option value="항공권">항공권</option>
                                    <option value="에어텔">에어텔</option>
                                </select>
                                <select name="" id="">
                                    <option value="상품명">상품명</option>
                                    <option value="여행자 이름">여행자 이름</option>
                                    <option value="예약번호">예약번호</option>
                                    <option value="그룹번호">그룹번호</option>
                                </select>
                            </div>
                        </div>
                        <div class="popup_filter">
                            <div class="popups">
                                <button type="button" class="close" onclick="closePopups()"></button>
                                <div class="filter_content">
                                    <div class="filter_wrap">
                                        <div class="box_category">
                                            <h2 class="ttl">예약일</h2>
                                            <div class="category_list">
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_01" id="cate_01" data-name="" value="">
                                                    <label for="cate_01">그룹별예약정렬</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_01" id="cate_01_02" data-name="" value="">
                                                    <label for="cate_01_02">건별예약정렬</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box_category">
                                            <div class="box_date flex">
                                                <div class="datepick"><input type="text" name="checkInDate" id="checkInDate" onfocus="this.blur()"
                                                        class="bs-input"></div>
                                                <div class="datepick"><input type="text" name="checkOutDate" id="checkOutDate" onfocus="this.blur()"
                                                        class="bs-input"></div>
                                            </div>
                                        </div>
                                        <div class="box_category">
                                            <h2 class="ttl">결제상태</h2>
                                            <div class="category_list">
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_02" id="cate_02" data-name="" value="">
                                                    <label for="cate_02">결제상태</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_02" id="cate_02_02" data-name="" value="">
                                                    <label for="cate_02_02">결제완료</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box_category">
                                            <h2 class="ttl">상품종류</h2>
                                            <div class="category_list">
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_03" data-name="" value="">
                                                    <label for="cate_03">상품종류</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_04" data-name="" value="">
                                                    <label for="cate_04">호텔</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_05" data-name="" value="">
                                                    <label for="cate_05">골프</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_06" data-name="" value="">
                                                    <label for="cate_06">투어</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_07" data-name="" value="">
                                                    <label for="cate_07">차량</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_08" data-name="" value="">
                                                    <label for="cate_08">가이드</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_09" data-name="" value="">
                                                    <label for="cate_09">항공권</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_03" id="cate_10" data-name="" value="">
                                                    <label for="cate_10">에어텔</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box_category">
                                            <h2 class="ttl">상품</h2>
                                            <div class="category_list">
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_04" id="cate_11" data-name="" value="">
                                                    <label for="cate_11">상품명</label>
                                                </div>
                                                <div class="wrap_input">
                                                    <input type="radio" name="cate_04" id="cate_12" data-name="" value="">
                                                    <label for="cate_12">여행자 이름</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg"></div>
                        </div>
                        <div class="only_mo">
                            <div class="filter_ic">
                                <img src="/images/mypage/filter_ic.png" alt="">
                            </div>
                        </div>
                        <div class="details_search flex_e_c">
                            <input type="text" name="search_word" value="">
                            <button class="search_button" type="button" onclick="">검색</button>
                        </div>
                    </div>
                </form>

                <?php foreach ($groupCounts as $group) : ?>
                    <div class="booking_product" data-menu="all">
                        <div class="product_box">
                            <div class="book_group_wrap flex_b_c">
                                <div class="name_pro">
                                    <div class="bs-input-check">
                                        <input type="checkbox" id="grp<?= esc($group['group_no']) ?>" class="grpCheck" data-grp="<?= esc($group['group_no']) ?>" value="Y">
                                        <label for="grp<?= esc($group['group_no']) ?>"> <?= esc($group['group_no']) ?> (그룹번호) / 전체 <?= esc($group['group_count']) ?>건 </label>
                                    </div>
                                </div>
                                <div class="group_r flex__c">
                                    <div class="total">
                                        <p>그룹 총금액 <span>0</span></p>
                                    </div>
                                    <div onclick="openNewWindow()" class="group_print flex__c">
                                        <img src="/images/mypage/printer_ic.png" alt="" class="only_web">
                                        <img src="/images/mypage/printer_ic_m.png" alt="" class="only_mo">
                                        <p class="only_web">그룹 견적서</p>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function openNewWindow() {
                                    $(".estimate_popup_wrap").show();
                                    $(".estimate_popup_content .btn_close_popup").click(function() {
                                        $(".estimate_popup_wrap").hide();
                                    })
                                    // window.open("https://thetourlab.com/mypage/pop_estimate", "popupWindow", "width=720,height=840");
                                }
                            </script>

                            <?php
                            // $order_list에서 현재 그룹에 해당하는 행만 출력
                            $_deli_type = get_deli_type();
                            foreach ($order_list as $order) :
                                if ($order['group_no'] == $group['group_no']) :

                            ?>
                                    <div class="product_detail">
                                        <div class="info_product">
                                            <div class="bs-input-check">
                                                <?php if ($order['order_status'] == "X") echo '<input type="checkbox" id="product01_01" name="product01_01" class="sub' . esc($group['group_no']) . '" value="Y">'; ?>
                                                <label for="product01_01"> 예약일(예약번호): <?= esc($order['start_date']) ?>(<?= esc(dateToYoil($order['start_date'])) ?>) (<?= esc($order['order_no']) ?>) </label>
                                            </div>
                                            <a href="!#" class="product_tit">[<?= esc($order['code_name']) ?>] <?= esc($order['product_name']) ?> </a>
                                            <div class="info_payment flex__c">
                                                <div class="tag">
                                                    <p><?= esc($_deli_type[$order['order_status']]) ?></p>
                                                </div>
                                                <?php if ($order['order_status'] == "X") echo '<span>결제하시면 예약 확정이 진행돼요. </span>'; ?>
                                            </div>
                                            <div class="info_user flex">
                                                <?php
                                                if ($order['order_gubun'] == "hotel") {
                                                    echo "<p>" . esc($order['start_date']) . "(" . dateToYoil($order['start_date']) . ") ~ " . esc($order['end_date']) . "(" . dateToYoil($order['end_date']) . ")</p>";
                                                } else if ($order['order_gubun'] == "golf" || $order['order_gubun'] == "tour") {
                                                    echo "<p>" . esc($order['order_date']) . "</p>";
                                                } else if ($order['order_gubun'] == "spa" || $order['order_gubun'] == "ticket") {
                                                    echo "<p>" . esc($order['order_day']) . "(" . dateToYoil($order['order_day']) . ")</p>";
                                                }
                                                ?>

                                                <?php
                                                if ($order['order_gubun'] == "golf") {
                                                    echo "<p>18홀 오전</p>";
                                                    echo "<p>성인 " . $order['people_adult_cnt'] . "명</p>";
                                                }
                                                ?>
                                                <p><?= esc(number_format($order['order_price'])) ?>원 (<?= esc(number_format($order['order_price'] / $order['baht_thai'])) ?>바트)</p>
                                            </div>
                                            <div class="info_name">
                                                <p>여행자 이름: <?= esc($order["order_user_first_name_en"]); ?> <?= esc($order["order_user_last_name_en"]); ?></p>
                                            </div>
                                            <div class="note flex__c">
                                                <img src="/images/mypage/not-allowed.png" alt="">
                                                <p>취소 규정 : 결제후 <span>03월20일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다</p>
                                            </div>
                                            <div class="info_link">본 예약건 취소규정 자세히 보기</div>
                                        </div>
                                        <div class="info_price flex">
                                            <div class="info_total_price flex__c">
                                                <p class="pri_won"><?= esc(number_format($order['order_price'])) ?> <span>원</span></p>
                                                <p class="pri_bath">(<?= esc(number_format($order['order_price'] / $order['baht_thai'])) ?>바트)</p>
                                                <div class="btn_payment">
                                                    <p>결제하기</p>
                                                </div>
                                            </div>
                                            <div class="estimate_wrap flex box">
                                                <div class="info_estimate btn_info flex__c" data-idx="<?= $order['order_idx'] ?>" data-gubun="<?= $order['order_gubun'] ?>">
                                                    <img src="/images/mypage/document_ic.png" alt="">
                                                    <p>견적서</p>
                                                </div>

                                                <div class="info_reservation btn_info flex__c">
                                                    <p>예약정보</p>
                                                </div>
                                            </div>
                                            <div class="info_btn btn_info flex__c order_del box" data-idx="<?= $order['order_idx'] ?>">
                                                <img src="/images/mypage/delete_ic.png" alt="">
                                                <p>예약삭제</p>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                endif;
                            endforeach;
                        endforeach;
                        ?>

                        <div class="booking_product" data-menu="canceled">

                        </div>

                        <div class="customer-center-page">
                            <?php
                            echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?s_status=$s_status&search_word=$search_word&pg=")
                            ?>
                        </div>
                        <div class="p_box">
                            <div class="ord_info fl flex">
                                <p class="count_total">선택상품 : 총 <span class="f_nilegreen" id="totalCount">0</span>건</p>
                                <p class="price_total">총 결제금액 : <span class="f_orange"><strong id="totalAmount">0</strong>원</span></p>
                            </div>
                            <div class="fr">
                                <input type="button" class="custom_btn2 b_orange b_p1040" value="선택결제" onclick="">
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
</section>
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
    <div class="dim" style="justify-content: space-between;"></div>
</div>

<div class="estimate_popup_wrap">
    <div class="estimate_popup_content">
        <div class="btn_close_popup">
            <img src="/img/btn/btn_close_black_20x20.png" alt="">
        </div>
        <h1>더투어랩 여행견적서 </h1>
        <div class="sec1">
            <div class="left">
                <p class="ttl">TOTO Booking Co., Ltd. </p>
                <span>Sukhumvit 101 Bangjak </span>
                <span>Prakhanong Bangkok 10260 </span>
                <span>서비스/여행업 No. 101-86-79949 </span>
                <p class="day">견적일 : 2025년 03월 14일 </p>
                <p class="name">고객명 : 김평진 님 귀하 </p>
                <img src="/images/mypage/stem.jpg" class="img_stem">
            </div>
            <div class="right">
                <table>
                    <colgroup>
                        <col width="110px">
                        <col width="110px">
                        <col width="110px">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>호텔 </th>
                            <td>0건 </td>
                            <td>0원 </td>
                        </tr>
                        <tr>
                            <th>골프 </th>
                            <td>1건 </td>
                            <td>303,175원 </td>
                        </tr>
                        <tr>
                            <th>투어 </th>
                            <td>1건 </td>
                            <td>39,000원 </td>
                        </tr>
                        <tr>
                            <th>차량 </th>
                            <td>0건 </td>
                            <td>0원 </td>
                        </tr>
                        <tr>
                            <th>가이드 </th>
                            <td>0건 </td>
                            <td>0원 </td>
                        </tr>
                        <tr>
                            <th class="total">합계 </th>
                            <td class="total">2건 </td>
                            <td class="total">342,175원 </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="sec2">
            <table>
                <colgroup>
                    <col width="70px">
                    <col width="*">
                    <col width="110px">
                </colgroup>
                <tbody>
                    <tr>
                        <th>품목</th>
                        <th>상세</th>
                        <th>금액</th>
                    </tr>
                    <tr>
                        <td>골프 </td>
                        <td>
                            <p class="time">2025-03-28(금) | 로얄 방파인 골프 클럽 </p>
                            <p>18홀 오전 | 성인 2명 | 그린피 : 6,700바트 | 3,350바트 X 2명 </p>
                        </td>
                        <td>
                            <p>303,175원 </p>
                            <p>(6,700바트) </p>
                        </td>
                    </tr>
                    <tr>
                        <td>투어 </td>
                        <td>
                            <p class="time">2025-03-28(금) | (아속출발) 아유타야 선셋 리버크루즈 반일 투어 </p>
                            <p>[프로모션] 아유타야 오후 | 성인 1명 | 39,000원 X 1명 </p>
                        </td>
                        <td>
                            <p>39,000원 </p>
                        </td>
                    </tr>

            </table>
        </div>

        <div class="list_desc">
            <p>- 상기 견적은 고객님께서 직접 선택하신 상품으로 발행된 견적서입니다. </p>
            <p>- 견적서상 내용은 확정 예약시 상품의 예약가능여부/환을 등에 따라 금액 및 내용에 변동이 있을 수 있습니다. </p>
            <p>- 한국 : 국민은행 636101-01-301315 (주) 토토부킹 </p>
            <p>- 태국: Kasikorn Bank 895-2-19850-6 (Totobooking) </p>
        </div>
        <div class="send_mail">
            <input type="text" value="lifeess@naver.com ">
            <button>메일보내기 </button>
        </div>
        <div class="btns_download">
            <button>다운로드</button>
            <button>엑셀다운로드</button>
        </div>
    </div>
</div>

<style>

    .estimate_popup_wrap {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 99999;
        display: none;
    }

    .estimate_popup_content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 740px;
        height: 780px;
        padding: 34px;
        border-radius: 8px;
        background-color: #fff;
    }

    .estimate_popup_content  .btn_close_popup {
        position: absolute;
        top : 0;
        right: 0;
        padding: 20px;
        cursor: pointer;
    }

    .estimate_popup_wrap h1 {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px
    }

    .estimate_popup_wrap .sec1 {
        display: flex;
        /* gap: 30px; */
        justify-content: space-between;
    }

    .estimate_popup_wrap .sec1 .left {
        position: relative;
        width: 294px;
    }

    .estimate_popup_wrap .sec1 .left .img_stem {
        position: absolute;
        top: 12px;
        right: 5px;
        width: 60px;
    }

    .estimate_popup_wrap .sec1 .ttl {
        font-size: 16px;
        margin-bottom: 8px;
        color: #353535;
        font-weight: 600;
    }

    .estimate_popup_wrap .sec1 .left>span {
        font-size: 14px;
        color: #757575;
        margin-bottom: 5px;
        display: block;
    }

    .estimate_popup_wrap .sec1 .left .day,
    .estimate_popup_wrap .sec1 .left .name {
        font-size: 14px;
        color: #252525;
        padding: 10px 0;
        border-bottom: 1px solid #999
    }

    .estimate_popup_wrap table {
        border-collapse: collapse;
        width: 100%;
    }

    .estimate_popup_wrap td,
    .estimate_popup_wrap th {
        border: 1px solid #dbdbdb;
        padding: 6px;
        text-align: center;
        font-size: 14px;
        color: #252525
    }

    .estimate_popup_wrap th {
        background-color: #fafafa
    }

    .estimate_popup_wrap tr .total {
        color: rgb(250, 17, 17)
    }

    .estimate_popup_wrap .sec2 {
        margin-top: 40px
    }

    .estimate_popup_wrap .sec2 .time {
        font-size: 14px;
        font-weight: 600;
        text-align: left;
        margin-bottom: 4px;

    }

    .estimate_popup_wrap .sec2 .time+p {
        text-align: left;
        color: #757575;
        font-size: 12px
    }

    .estimate_popup_wrap .sec2 td {
        padding: 12px
    }

    .estimate_popup_wrap .list_desc {
        margin-top: 20px;
        margin-bottom: 34px;
    }

    .estimate_popup_wrap .list_desc p {
        font-size: 13px;
        color: #656565;
        line-height: 1.4;
    }

    .estimate_popup_wrap .send_mail {
        display: flex;
        align-items: center;
        gap : 8px;
        padding-top: 35px;
        border-top: 1px solid #dbdbdb;
    }

    .estimate_popup_wrap .send_mail input {
        flex: 1;
        padding: 0 10px;
        border: 1px solid #dbdbdb;
        outline: none;
        height: 45px;
        font-size: 14px;
        color : #555
    }

    .estimate_popup_wrap .send_mail button {
        font-size: 14px;
        font-weight: 700;
        color: #666;
        border: 1px solid #dbdbdb;
        height: 45px;
        padding: 10px 20px;
    }

    .estimate_popup_wrap .btns_download {
        display: flex;
        align-items: center;
        justify-content: center;
        gap : 4px;
        margin-top: 35px
    }

    .estimate_popup_wrap .btns_download button {
        font-size: 15px;
        font-weight: 700;
        padding: 16px 36px;
        background-color: #17469e;
        color: #fff;
        border: none;

    }
</style>
<script>
    $(document).ready(function() {
        // Handle the click event on the checkbox with class .grpCheck
        $('.grpCheck').click(function() {
            if ($(this).prop('checked')) {
                var grp = $(this).data('grp');
                $('.sub' + grp).prop('checked', true);
            } else {
                var grp = $(this).data('grp');
                $('.sub' + grp).prop('checked', false);
            }
        });
    });
</script>
<script>
    $(document).on('click', '.info_estimate', function() {

        var idx = $(this).data('idx');
        var gubun = $(this).data('gubun');
        let url = "";

        if (gubun == "hotel") url = "/invoice/hotel_01/" + idx;
        if (gubun == "tour") url = "/invoice/tour_01/" + idx;
        if (gubun == "spa") url = "/invoice/ticket_01/" + idx;
        if (gubun == "golf") url = "/invoice/golf_01/" + idx;
        if (gubun == "ticket") url = "/invoice/ticket_01/" + idx;

        window.open(url, "popupWindow", "width=1000,height=700,left=100,top=100");

        // $('.confirm_depart').show();
    });

    $(document).on('click', '.order_del', function() {

        var idx = $(this).data('idx');

        if (confirm("삭제하시겠습니까?\n삭제 후에는 복구가 불가능합니다.") == false) {
            return;
        }

        if (idx) {
            $.ajax({

                url: "/ajax/ajax_booking_delete",
                type: "POST",
                data: {

                    "idx": idx

                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    var message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function(request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }
    });
</script>

<script>
    $(".datepick input").datepicker({
        dateFormat: 'yy-mm-dd',
        showOn: "both",
        buttonImage: '/images/ico/datepicker_ico.png',
        showMonthAfterYear: true,
        buttonImageOnly: true,
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        changeMonth: true, // month 셀렉트박스 사용
        changeYear: true, // year 셀렉트박스 사용
        yearRange: 'c-100:c+0', // 년도 선택 셀렉트박스를 현재 년도에서 이전, 이후로 얼마의 범위를 표시할것인가.
    });

    $(".info_link").on("click", function() {
        $(".policy_pop, .policy_pop .dim").show();
    });

    function closePopup() {
        $(".popup_wrap").hide();
        $(".dim").hide();
    }

    $(".filter_ic").on("click", function() {
        $(".popup_filter").show();
    });

    function closePopups() {
        $(".popup_filter").hide();
    }

    $(window).on("scroll", function() {
        let pBox = $(".booklist_wrap .p_box");
        let footer = $("#footer");
        let pBoxHeight = pBox.outerHeight();
        let footerTop = footer.offset().top;
        let scrollTop = $(window).scrollTop();
        let windowHeight = $(window).height();

        if (scrollTop + windowHeight >= footerTop) {
            pBox.css({
                position: "relative",
                bottom: "unset"
            });
        } else {
            pBox.css({
                position: "fixed",
                bottom: "0"
            });
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function updateBookingDisplay() {
            const activeMenu = document.querySelector(".tab_box li.on");
            if (!activeMenu) return;

            const activeMenuType = activeMenu.getAttribute("data-menu");

            document.querySelectorAll(".booking_product").forEach(item => {
                item.style.display = "none";
            });

            document.querySelectorAll(`.booking_product[data-menu="${activeMenuType}"]`).forEach(item => {
                item.style.display = "block";
            });

            const pBox = document.querySelector(".p_box");
            if (activeMenuType === "all" || activeMenuType === "progress") {
                pBox.style.display = "flex";
            } else {
                pBox.style.display = "none";
            }
        }

        document.querySelectorAll(".tab_box li").forEach(item => {
            item.addEventListener("click", function() {
                document.querySelectorAll(".tab_box li").forEach(li => li.classList.remove("on"));

                this.classList.add("on");

                updateBookingDisplay();
            });
        });

        updateBookingDisplay();
    });
</script>
<?php $this->endSection(); ?>