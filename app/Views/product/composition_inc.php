<div class="price-right-c">
    <div class="view_nav" id="sticky" style="position: sticky; top: 30px;">
        <div class="scroll_box">

            <div class="cho_nav">
                <p class="date_label">
                    <i></i> <span>출발일 <span id="select_date">2024-10-30</span></span>
                </p>

                <p class="label item_label">예약인원을 확인해주세요.</p>

                <ul class="select_peo">
                    <li class="flex_b_c cus-count-input">
                        <div class="payment">
                            <p class="ped_label">성인 </p>
                            <p class="money adult">
                                <span id="adult_msg">담당자에게 문의해주세요</span>
                                <!-- <strong>0</strong> 원 -->
                            </p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <button type="button" class="minus_btn" id="minusAdult"></button>
                            <input type="text" class="input-qty" name="qty" id="adultQty" value="2"
                                   readonly="">
                            <button type="button" class="plus_btn" id="addAdult"></button>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="item_option">
                <!-- opt_list -->
                <div class="opt_list">
                    <strong class="label">옵션선택</strong>

                    <div class="opt_select_wrap">
                        <!-- opt_select -->
                        <div class="opt_select disabled">
                            <!--button type="button" class="now_txt "><em>선택</em> <i></i></button-->
                            <select name="moption" id="moption" onchange="sel_moption(this.value);">
                                <option value="">선택</option>

                                1
                                <option value="3">1111</option>
                            </select>
                        </div>
                        <!-- // opt_select // -->
                        <!-- opt_select -->
                        <div class="opt_select disabled sel_option" id="sel_option">
                            <!--button type="button" class="now_txt"><em>선택</em> <i></i></button-->
                            <select name="option" id="option" onchange="sel_option(this.value);">";
                                <option value="">옵션 선택</option>
                            </select>
                        </div>
                        <!-- // opt_select // -->
                    </div>


                    <!-- opt_result_wrap -->
                    <div class="opt_result_wrap option_item" id="option_item">
                    </div>
                    <!-- //opt_result_wrap -->

                </div>
                <!-- // opt_list -->
            </div>
        </div>


        <div class="total_paymemt payment">
            <!--p class="ped_label">총 예약금액</p-->
            <p class="money"><span
                    style="margin-right:50px;"><strong>합계</strong></span><strong><span
                        id="total_sum" class="total_sum">0</span> 원</strong></p>
        </div>
        <h3 class="title-r label">약관동의</h3>
        <div class="item-info-check-first">
            <span>전체동의</span>
            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
        </div>
        <div class="item-info-check">
            <span>이용약관 동의(필수)</span>
            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
        </div>
        <div class="item-info-check">
            <span>개인정보 처리방침(필수)</span>
            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
        </div>
        <div class="item-info-check">
                            <span>개인정보 제3자 제공 및 국외 이전 동의(필수)
                            </span>
            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
        </div>
        <div class="item-info-check">
            <span>여행안전수칙 동의(필수)</span>
            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
        </div>
        <div class="nav_btn_wrap">
            <a href="/product-spa/product-booking/8386">
                <button type="button" class="btn-point" onclick="order_it();">상품 예약하기</button>
            </a>
            <div class="flex">
                <button type="button" class="btn-default"
                        onclick="location='/inquiry/inquiry_write.php?product_idx=1219'">상담 문의하기
                </button>

                <!-- delete  -->
                <!-- <button type="button" class="btn-default wish_btn "
        onclick="javascript:wish_it('1219')"><i></i></button> -->

            </div>
        </div>
    </div>
</div>