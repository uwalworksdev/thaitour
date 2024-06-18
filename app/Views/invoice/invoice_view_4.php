<!-- 자유여행 or 골프여행 -->
<div class="invoice_table">
            <h2>상품정보</h2>
            <table>
                <colgroup>
                    <col width="10%">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <td class="subject">상품구분</td>
                        <td class="content"><?=$code_name_1?> > <?=$code_name_2?> > <?=$code_name_3?></td>
                    </tr>
                    <tr>
                        <td class="subject">상품명</td>
                        <td class="content"><?=$product_name?></td>
                    </tr>
                    <tr>
                        <td class="subject">예약날짜</td>
                        <td class="content"><?=date("Y.m.d", strtotime($order_r_date))?> (<?=yoil_convert($order_r_date)?>)</td>
                    </tr>
                    <tr>
                        <td class="subject">여행인원</td>
                        <td class="content">
                            <span class="num">성인: <span><?=$people_adult_cnt?></span></span>
                            <span class="num">소아: <span><?=$people_kids_cnt?></span></span>
                            <span class="num">유아: <span><?=$people_baby_cnt?></span></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice_table">
            <h2>상세 예약정보</h2>
            <table>
                <colgroup>
                    <col width="10%">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <td class="subject">필수</td>
                        <td class="content">
                            <div class="product_detail">블루마운틴 (시닉월드 불포함) 성인: $<span><?=number_format($tour_price / _US_DOLLAR, 0)?></span> x <span><?=$people_adult_cnt?></span></div>
                            <div class="product_detail">블루마운틴 (시닉월드 불포함) 소아: $<span><?=number_format($tour_price_kids / _US_DOLLAR, 0)?></span> x <span><?=$people_kids_cnt?></span></div>
                            <div class="product_detail">블루마운틴 (시닉월드 불포함) 유아: $<span><?=number_format($tour_price_baby / _US_DOLLAR, 0)?></span> x <span><?=$people_baby_cnt?></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">옵션1</td>
                        <td class="content">비빔밥 중식 : $<span>10</span> x <span>4</span></td>
                    </tr>
                    <tr>
                        <td class="subject">옵션2</td>
                        <td class="content">동물원 입장권 : $<span>10</span> x <span>4</span></td>
                    </tr>
                    <tr>
                        <td class="subject">쿠폰할인</td>
                        <td class="content">
                            <?=number_format($used_coupon_money + $used_mileage_money)?>원
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">총결제금액</td>
                        <td class="content">
                            <span><?=number_format($order_confirm_price)?></span> 원 ($<span><?=number_format($order_confirm_price / _US_DOLLAR, 0)?></span>)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice_table">
            <h2>예약자정보</h2>
            <table>
                <colgroup>
                    <col width="15%">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <td class="subject">한글명</td>
                        <td class="content"><?=$order_user_name?></td>
                    </tr>
                    <!-- <tr>
                        <td class="subject">영문명</td>
                        <td class="content"></td>
                    </tr> -->
                    <tr>
                        <td class="subject">한국전화번호</td>
                        <td class="content"><?=$order_user_mobile?></td>
                    </tr>
                    <tr>
                        <td class="subject">현지비상 전화번호</td>
                        <td class="content">
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">카카오톡 ID</td>
                        <td class="content"></td>
                    </tr>
                    <tr>
                        <td class="subject">이메일</td>
                        <td class="content"><?=$order_user_email?></td>
                    </tr>
                    <tr>
                        <td class="subject">호주/해외 전화번호</td>
                        <td class="content">
                            <?=$local_phone?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">숙소</td>
                        <td class="content">
                            <?=$addr1?> <?=$addr2?>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">기타 요청사항</td>
                        <td class="content"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text_red">
            <p>※ 예약에 대한 부가설명이 필요하신 경우나 요청사항이 있으실 경우 작성 바랍니다.</p>
            <p>※ 고객님의 요청이 전달되나 현지 사정에 따라 반영되지 않을 수도 있습니다.</p>
        </div>