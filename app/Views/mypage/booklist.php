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
                                
                            </div>
                        </div>
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
