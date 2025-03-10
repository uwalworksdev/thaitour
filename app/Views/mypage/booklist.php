<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<?php
if (empty(session()->get("member")["mIdx"])) {
    alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive_new02.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage.css" rel="stylesheet" type="text/css"/>
<link href="/css/mypage/mypage_reponsive.css" rel="stylesheet" type="text/css"/>
<link href="/css/community/community.css" rel="stylesheet" type="text/css"/>

<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_1" => "on"]);
            ?>

            <div class="booklist_wrap">
                <div class="book_big_ttl">
                    <h2 class="flex">최근 예약 현황 <p>(3개월 기준)</p></h2>
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
                <div class="book_big_ttl">
                    <h2 class="flex">예약 현황</h2>
                </div>
                <div class="result_book flex__c">
                    <p class="total">전체 <span>47</span>개 </p>
                    <div class="tab_box">
                        <ul class="flex">
                            <li class="on">
                                <a href="#!">전체예약내역</a>
                            </li>
                            <li>
                                <a href="#!">예약진행중</a>
                                <img src="/images/mypage/question_mark.png" alt="">
                            </li>
                            <li>
                                <a href="#!">예약확정</a>
                                <img src="/images/mypage/question_mark.png" alt="">
                            </li>
                            <li>
                                <a href="#!">이용완료</a>
                                <img src="/images/mypage/question_mark.png" alt="">
                            </li>
                            <li>
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
                        <div class="details_search flex_e_c">
                            <input type="text" name="search_word" value="">
                            <button class="search_button" type="button" onclick="">검색</button>
                        </div>
                    </div>
                </form>

                <div class="booking_product">
                    <div class="product_box">
                        <div class="book_group_wrap flex_b_c">
                            <div class="name_pro">
                                <div class="bs-input-check">
                                    <input type="checkbox" id="product01" name="product01" value="Y">
                                    <label for="product01"> 4466924 (그룹번호) / 전체 2개 </label>
                                </div>
                            </div>
                            <div class="group_r flex__c">
                                <div class="total">
                                    <p>그룹 총금액 <span>0</span></p>
                                </div>
                                <div class="group_print flex__c">
                                    <img src="/images/mypage/printer_ic.png" alt="">
                                    <p>그룹 견적서</p>
                                </div>
                            </div>
                        </div>
                        <div class="product_detail">
                            <div class="info_product">
                                <div class="bs-input-check">
                                    <input type="checkbox" id="product01_01" name="product01_01" value="Y">
                                    <label for="product01_01"> 예약일(예약번호): 2025-03-10(월) (145-783-050) </label>
                                </div>
                                <h3 class="product_tit">[골프] 로얄 방파인 골프 클럽 </h3>
                                <div class="info_payment flex__c">
                                    <div class="tag">
                                        <p>결제대기중 </p>
                                    </div>
                                    <span>결제하시면 예약 확정이 진행돼요. </span>
                                </div>
                                <div class="info_user flex">
                                    <p>2025-03-28(금)</p>
                                    <p>18홀 오전</p>
                                    <p>성인 2명</p>
                                    <p>303,175원 (6,700바트)</p>
                                </div>
                                <div class="info_name">
                                    <p>여행자 이름: KIM PYOUNG JIN </p>
                                </div>
                                <div class="note flex__c">
                                    <img src="/images/mypage/not-allowed.png" alt="">
                                    <p>취소 규정 : 결제후 <span>03월20일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다</p>
                                </div>
                                <div class="info_link">본 예약건 취소규정 자세히 보기</div>
                            </div>
                            <div class="info_price flex">
                                <div class="info_total_price flex__c">
                                    <p class="pri_won">303,175 <span>원</span></p>
                                    <p class="pri_bath">(6,700바트)</p>
                                    <div class="btn_payment">
                                        <p>결제하기</p>
                                    </div>
                                </div>
                                <div class="info_estimate btn_info flex__c">
                                    <img src="/images/mypage/document_ic.png" alt="">
                                    <p>견적서</p>
                                </div>
                                <div class="info_btn btn_info flex__c">
                                    <img src="/images/mypage/delete_ic.png" alt="">
                                    <p>예약삭제</p>
                                </div>
                            </div>
                        </div>
                        <div class="product_detail">
                            <div class="info_product">
                                <div class="bs-input-check">
                                    <input type="checkbox" id="product01_02" name="product01_02" value="Y">
                                    <label for="product01_02"> 예약일(예약번호): 2025-03-10(월) (145-783-050) </label>
                                </div>
                                <h3 class="product_tit">[골프] 로얄 방파인 골프 클럽 </h3>
                                <div class="info_payment flex__c">
                                    <div class="tag">
                                        <p>결제대기중 </p>
                                    </div>
                                    <span>결제하시면 예약 확정이 진행돼요. </span>
                                </div>
                                <div class="info_user flex">
                                    <p>2025-03-28(금)</p>
                                    <p>18홀 오전</p>
                                    <p>성인 2명</p>
                                    <p>303,175원 (6,700바트)</p>
                                </div>
                                <div class="info_name">
                                    <p>여행자 이름: KIM PYOUNG JIN </p>
                                </div>
                                <div class="note flex__c">
                                    <img src="/images/mypage/not-allowed.png" alt="">
                                    <p>취소 규정 : 결제후 <span>03월20일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다</p>
                                </div>
                                <div class="info_link">본 예약건 취소규정 자세히 보기</div>
                            </div>
                            <div class="info_price flex">
                                <div class="info_total_price flex__c">
                                    <p class="pri_won">303,175 <span>원</span></p>
                                    <p class="pri_bath">(6,700바트)</p>
                                    <div class="btn_payment">
                                        <p>결제하기</p>
                                    </div>
                                </div>
                                <div class="info_estimate btn_info flex__c">
                                    <img src="/images/mypage/document_ic.png" alt="">
                                    <p>견적서</p>
                                </div>
                                <div class="info_btn btn_info flex__c">
                                    <img src="/images/mypage/delete_ic.png" alt="">
                                    <p>예약삭제</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_box">
                        <div class="book_group_wrap flex_b_c">
                            <div class="name_pro">
                                <div class="bs-input-check">
                                    <input type="checkbox" id="product01" name="product01" value="Y">
                                    <label for="product01"> 4466924 (그룹번호) / 전체 2개 </label>
                                </div>
                            </div>
                            <div class="group_r flex__c">
                                <div class="total">
                                    <p>그룹 총금액 <span>0</span></p>
                                </div>
                                <div class="group_print flex__c">
                                    <img src="/images/mypage/printer_ic.png" alt="">
                                    <p>그룹 견적서</p>
                                </div>
                            </div>
                        </div>
                        <div class="product_detail">
                            <div class="info_product">
                                <div class="bs-input-check">
                                    <input type="checkbox" id="product02_01" name="product02_01" value="Y">
                                    <label for="product02_01"> 예약일(예약번호): 2025-03-10(월) (145-783-050) </label>
                                </div>
                                <h3 class="product_tit">[골프] 로얄 방파인 골프 클럽 </h3>
                                <div class="info_payment flex__c">
                                    <div class="tag gray">
                                        <p>결제대기중 </p>
                                    </div>
                                    <span>결제하시면 예약 확정이 진행돼요. </span>
                                </div>
                                <div class="info_user flex">
                                    <p>2025-03-28(금)</p>
                                    <p>18홀 오전</p>
                                    <p>성인 2명</p>
                                    <p>303,175원 (6,700바트)</p>
                                </div>
                                <div class="info_name">
                                    <p>여행자 이름: KIM PYOUNG JIN </p>
                                </div>
                                <div class="note flex__c">
                                    <img src="/images/mypage/not-allowed.png" alt="">
                                    <p>취소 규정 : 결제후 <span>03월20일 18시(한국시간)</span> 이전에 취소하시면 무료취소가 가능합니다</p>
                                </div>
                                <div class="info_link">본 예약건 취소규정 자세히 보기</div>
                            </div>
                            <div class="info_price flex">
                                <div class="info_total_price flex__c">
                                    <p class="pri_won">303,175 <span>원</span></p>
                                    <p class="pri_bath">(6,700바트)</p>
                                    <div class="btn_payment">
                                        <p>결제하기</p>
                                    </div>
                                </div>
                                <div class="info_estimate btn_info flex__c">
                                    <img src="/images/mypage/document_ic.png" alt="">
                                    <p>견적서</p>
                                </div>
                                <div class="info_btn btn_info flex__c">
                                    <img src="/images/mypage/delete_ic.png" alt="">
                                    <p>예약삭제</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $pg = 1;
                    $nPage = 1;
                    $g_list_rows = 10;
                ?>
                <div class="customer-center-page">
                    <?php
                    echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?s_status=$s_status&search_word=$search_word&pg=")
                    ?>
                </div>
                <div class="p_box">
                    <div class="ord_info fl flex">
                    <p class="count_total">선택상품 : 총 <span class="f_nilegreen" id="totalCount">0</span>건</p>
                    <p class="price_total">총 결제금액  : <span class="f_orange"><strong id="totalAmount">0</strong>원</span></p>
                    </div>
                    <div class="fr">
                    <input type="button" class="custom_btn2 b_orange b_p1040" value="선택결제" onclick="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
</script>
<?php $this->endSection(); ?>
