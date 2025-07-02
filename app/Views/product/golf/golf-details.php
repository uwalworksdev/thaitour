<?php $this->extend('inc/layout_index'); ?>
<?php $setting = homeSetInfo(); ?>
<?php $this->section('content'); ?>

<style>
    @media screen and (max-width: 850px) {
       .btn-s-wrap-pc {
            display: none !important;
       }     
    }
</style>

<script>
$(document).ready(function() {
			var dataTabValue = '<?=$hole_cnt_arr[0]?>';
			// console.log('홀- '+dataTabValue);
			// console.log('caddie fee- '+$("#caddie_fee_sel").val());
			
			if($("#caddie_fee_sel").val() == "Y") {
			   $("#vehicle_5").val('3'); // value가 "2"인 옵션 선택
			   //$("#vehicle_5").prop('disabled', true);
			}   
	
});
</script>

<script>
    function showHideCaddy() {

        if($("#o_caddy_due").val() == "Y") {
            //$('#vehicle_5').val($("#people_adult_cnt").val()).prop('disabled', true);
            $("#vehicle_5").val('1');

            $("#caddy_yes").css("display", "flex");	
            $("#caddy_no").hide();	
        } else {

            if($("#o_caddy_cont").val() == "Y") {
                $("#vehicle_5").val('');
                $("#caddy_no").show();	
                $("#caddy_yes").hide();	
            } else {   
                
                $("#vehicle_5").val('1');
                $("#caddy_yes").css("display", "flex");		
                $("#caddy_no").hide();	
            }
        } 	
        
        if($("#o_cart_due").val() == "Y") {
            $("#cart_yes").css("display", "flex");	
            $("#cart_no").hide();	
        } else {	
            if($("#o_cart_cont").val() == "Y") {
                $("#vehicle_4").val('');
                $("#cart_no").show();	
                $("#cart_yes").hide();	
            } else {   
                $("#vehicle_4").val('');
                $("#cart_yes").css("display", "flex");	
                $("#cart_no").hide();	
            }
        }
    }

    $(document).ready(function() {
        // 페이지 어디든 클릭 시 실행
        $(document).on('click', function(event) {
            // showHideCaddy();
            calculatePrice();			
        });
    });
</script>
<style>
    .customer-form-page .form-group.time-group {
        flex-wrap: wrap;
    }
</style>
    <form>
		<input type="hidden" name="selDate" id="selDate" value="<?= $selDate ?>">
		<input type="hidden" name="selPrice" id="selPrice" value="<?= $selPrice ?>">
    </form>
    <div class="content-sub-hotel-detail custom-golf-detail">
    <div class="body_inner">
        <div>
            <form name="frm" id="frm" action="/product-golf/customer-form" class="section1">
                <input type="hidden" name="product_idx" id="product_idx" value="<?= $product['product_idx'] ?>">
                <input type="hidden" name="product_code_1" id="product_code_1" value="<?= $product['product_code_1'] ?>">
                <input type="hidden" name="product_code_2" id="product_code_2" value="<?= $product['product_code_2'] ?>">
                <input type="hidden" name="product_code_3" value="">
                <input type="hidden" name="product_code_4" value=""> 
                <input type="hidden" name="order_status" id="order_status" value="B">

                <input type="hidden" name="order_date" id="order_date" value="">
                <input type="hidden" name="option_idx" id="option_idx" value="<?=$idx?>">
                <input type="hidden" name="o_cart_due" id="o_cart_due" value="<?=$golf_price['o_cart_due']?>">
                <input type="hidden" name="o_caddy_due" id="o_caddy_due" value="<?=$golf_price['o_caddy_due']?>">
                <input type="hidden" name="o_cart_cont" id="o_cart_cont" value="<?=$o_cart_cont?>">
                <input type="hidden" name="o_caddy_cont" id="o_caddy_cont" value="<?=$o_caddy_cont?>">
                <input type="hidden" name="caddie_fee_sel" id="caddie_fee_sel" value="<?=$product['caddie_fee_sel']?>">

                <input type="hidden" name="use_coupon_idx" id="use_coupon_idx" value="">
                <input type="hidden" id="total_price" value="">
                <input type="hidden" id="total_price_baht" value="">
                <input type="hidden" name="hole_cnt" id="hole_cnt" value="">
                <input type="hidden" name="hour" id="hour" value="">  <!-- 주간, 오후, 야갼 -->
                <input type="hidden" name="teeoff_hour" id="teeoff_hour" value="">
                <input type="hidden" name="teeoff_min" id="teeoff_min" value="">
                <input type="hidden" name="vehicle_time_hour" id="vehicle_time_hour" value="">
                <input type="hidden" name="vehicle_time_minute" id="vehicle_time_minute" value="">
                <input type="hidden" name="number_staff" id="number_staff" value="">
                <input type="hidden" name="number_luggage" id="number_luggage" value="">
                <input type="hidden" name="departure_point" id="departure_point" value="">
                <input type="hidden" name="custom_req" id="custom_req" value="">

                <!--
                <?php foreach ($golf_price as $price) { ?>
                    <input type="hidden" name="firstDate"  value="<?= $price['goods_date'] ?>">
                    <input type="hidden" name="firstPrice" value="<?= $price['price'] ?>">
                    <input type="hidden" name="afternoon_yn" value="<?= $price['o_afternoon_yn'] ?>">
                    <input type="hidden" name="night_yn" value="<?= $price['o_night_yn'] ?>">
                <?php } ?>
                -->
				
                <div class="title-container">
                    <h2><?= viewSQ($product['product_name']) ?> <span style="margin-left: 15px;"><?= viewSQ($product['product_name_en']) ?></span></h2>
                    <div class="list-icon">
                        <?php
                            $icon_suffix = $product['liked'] ? 'on_icon' : 'icon';
                        ?>
                        <!-- <img src="/uploads/icons/print_icon.png" alt="print_icon" class="only_web">
                        <img src="/uploads/icons/print_icon_mo.png" alt="print_icon_mo" class="only_mo"> -->
                        <img src="/uploads/icons/heart_<?= $icon_suffix ?>.png" alt="heart_icon" class="only_web" onclick="wish_it('<?= $product['product_idx'] ?>')">
                        <img src="/uploads/icons/heart_icon_mo.png" alt="heart_icon_mo" class="only_mo" onclick="wish_it('<?= $product['product_idx'] ?>')">
                        <img src="/uploads/icons/share_icon.png" alt="share_icon" class="only_web" onclick="showListShare()">
                        <img src="/uploads/icons/share_icon_mo.png" alt="share_icon_mo" class="only_mo">
                        <div class="list_share">
                        <a href="#!" class="item kakao btn_share_kakao" >
                            <img src="/images/btn/ic_kakao.png" alt="">
                        </a>
                        <a href="#!" class="item link_" onclick="copyUrl()">
                            <img src="/images/btn/share_link_icon1.png" alt="">
                        </a>
                    </div>
                    </div>
                </div>
                <div class="location-container">
                    <!-- <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                    <span><?= $product['addrs'] ?></span> -->
                    <div class="location_conts">
                        <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                        <span class="text-gray"> <?= $product['addrs'] ?> </span>
                    </div>

                    <div class="location_conts">
                        <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon" class="ic_green">
                        <a href="https://www.google.com/maps/search/?api=1&query=<?=urlencode($product['addrs'])?>" target="_blank" class="">
                            지도에서 보기
                        </a>
                    </div>
                    <div class="list-icon">
                        <!-- <img src="/uploads/icons/print_icon.png" alt="print_icon" class="only_web">
                        <img src="/uploads/icons/print_icon_mo.png" alt="print_icon_mo" class="only_mo"> -->
                        <?php
                            $icon_suffix = $product['liked'] ? 'on_icon' : 'icon';
                        ?>
                        <img src="/uploads/icons/heart_icon.png" alt="heart_icon" class="only_web" onclick="wish_it('<?= $product['product_idx'] ?>')">
                        <img src="/uploads/icons/heart_<?= $icon_suffix ?>_mo.png" alt="heart_icon_mo" class="only_mo" onclick="wish_it('<?= $product['product_idx'] ?>')">
                        <img src="/uploads/icons/share_icon.png" alt="share_icon" class="only_web">
                        <img src="/uploads/icons/share_icon_mo.png" alt="share_icon_mo" class="only_mo" onclick="showListShare()">
                        <div class="list_share">
                            <a href="#!" class="item kakao btn_share_kakao" >
                                <img src="/images/btn/ic_kakao.png" alt="">
                            </a>
                            <a href="#!" class="item link_" onclick="copyUrl()">
                                <img src="/images/btn/share_link_icon1.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="rating-container">
                    <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                    <span><strong><?= $product['review_average'] ?></strong></span>
                    <span>리얼리뷰 <strong>(<?= $product['total_review'] ?>)</strong></span>
                    <?php
                    $_arr = explode("|", $product['mbti']);

                    $code_n0 = [];

                    foreach ($mcodes as $mcode) {
                        if (in_array($mcode['code_no'], $_arr)) {
                            $code_n0[] = $mcode['code_name'];
                        }
                    }
                    ?>

                    <span>추천 MBTI: <?= implode(', ', $code_n0) ?></span>
                </div>
                <?php
                    if(!empty($img_names[0])) {
                        $i3 = 1;
                    }else{
                        $i3 = 0;
                    }
                    $i3 += count($img_list);
                ?>
                <div class="hotel-image-container">
                    <div class="hotel-image-container-1" style="<?= $imgs[0] == '' ? 'visibility: hidden' : '' ?>">
                        <img src="<?= $imgs[0] ?>" alt="<?= $img_names[0] ?>" 
                            onerror="this.src='/images/share/noimg.png'"
                            onclick="img_pops('<?= $product['product_idx'] ?>')">
                    </div>
                    <div class="grid_2_2">
                        <?php 

                           $is_mobile = preg_match('/(android|iphone|ipad|ipod|mobile)/i', $_SERVER['HTTP_USER_AGENT']);
                            $loop_limit = $is_mobile ? 1 : 3;
                            for ($j = 2; $j < 2 + $loop_limit; $j++) {
                        ?>
                        <img class="grid_2_2_size" src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>" alt="<?= $img_list[$j - 2]['rfile'] ?>"
                            onerror="this.src='/images/share/noimg.png'"
                            onclick="img_pops('<?= $product['product_idx'] ?>')">
                        <?php } ?>
                        <!-- <img class="grid_2_2_size" src="<?= $imgs[2] ?>" alt="<?= $img_names[2] ?>"
                             style="<?= $imgs[2] == '' ? 'visibility: hidden' : '' ?>">
                        <img class="grid_2_2_size" src="<?= $imgs[3] ?>" alt="<?= $img_names[3] ?>"
                             style="<?= $imgs[3] == '' ? 'visibility: hidden' : '' ?>"> -->
                        <div class="grid_2_2_sub"
                             style="position: relative; cursor: pointer;"
                             onclick="img_pops('<?= $product['product_idx'] ?>')">
                            <img class="custom_button" src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>" alt="<?= $img_list[$j - 2]['rfile'] ?>"
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
                    <div class="main">
                        <a class="short_link active" data-target="product_info" href="#product_info">상품 정보</a>
                        <a class="short_link" data-target="pickup" href="#pickup">상품예약</a>
                        <a class="short_link" data-target="product_des" href="#product_des">상품설명</a>
                        <a class="short_link" data-target="location" href="#location">위치정보</a>
                        <a class="short_link" data-target="section6" href="#section6">리얼리뷰(<?= $product['total_review'] ?>
                            개)</a>
                        <a class="short_link" data-target="qna" href="#qna">상품 Q&A(<?=$product_qna["nTotalCount"] ?? 0?>)</a>
                    </div>
                    <div class="btn-container">
                        <a class="w-100" href="#!" data-target="#booking_area" onclick="handleShowBookingArea(this)">
                            <button type="button">
                                상품예약
                            </button>
                        </a>
                    </div>
                </div>

                <h3 id="pickup" class="title-size-24 text-parent">상품 예약<span>날짜 · 홀수 ·인원 ·시간대를 먼저 선택해 주세요.</span></h3>
                <div class="calendar">
                    <div class="year">
                        <div class="btn_year_new">
                            <img src="/uploads/icons/year_prev_icon.png" alt="year_prev_icon" srcset="" id="prev_icon"
                                 class="only_web">
                            <img src="/uploads/icons/year_prev_icon_mo.png" alt="year_prev_icon" srcset="" id="prev_icon_mo"
                                 class="only_mo">
                        </div>
                        <span><span id="year"></span>년 <span id="month"></span>월</span>
                        <div class="btn_year_new">
                            <img src="/uploads/icons/year_next_icon.png" alt="next_icon" srcset="" id="next_icon"
                                 class="only_web">
                            <img src="/uploads/icons/year_next_icon_mo.png" alt="next_icon" srcset="" id="next_icon_mo"
                                 class="only_mo">
                        </div>
                    </div>
                    <div class="dates">
                        <div class="swiper-button-next swiper-button swiper-button-custom">
                            <img src="/uploads/icons/next_day_icon.png" alt="year_next_icon" class="only_web">
                        </div>
                        <div class="swiper-button-prev swiper-button swiper-button-custom">
                            <img src="/uploads/icons/prev_day_icon.png" alt="prev_day_icon" class="only_web">
                        </div>
                        <div class="swiper-button-prev swiper-button swiper-button-custom only_mo">
                            <img src="/uploads/icons/prev_day_icon_mo.png" alt="prev_day_icon">
                        </div>
                        <div class="swiper-button-next swiper-button swiper-button-custom only_mo">
                            <img src="/uploads/icons/next_day_icon_mo.png" alt="next_day_icon">
                        </div>
                        <div class="calendar-swiper-container swiper-container">
                            <div class="calendar-swiper-wrapper swiper-wrapper"></div>
                        </div>
                    </div>
                </div>
                <div class="tag-con-below-calendar">
                    <div class="flex flex-col-mo" style="justify-content: space-between">
                        <div class="item-tag">
                            <span class="label">홀수</span>
                            <div class="tag-list">
							    <?php if (!empty($hole_cnt_arr)) { ?>
                                <?php foreach ($hole_cnt_arr as $hole) : ?>
                                    <span class="tag tag-js" data-tab="<?= $hole ?>"><?= $hole ?>홀</span>
                                <?php endforeach; ?>
								<?php } else { ?>
								<span style="color:red;">홀 미등록</span>	
								<?php } ?> 
                            </div>
                        </div>
                        <div class="item-tag new">
                            <div class="flex__c item-tag-select">
                                <span class="label first">인원</span>
                                <select class="select_custom_ active_ cus-width" onchange="changePeople()"
                                        name="people_adult_cnt" id="people_adult_cnt">
                                    <option value="">선택해주세요.</option>
                                    <?php
                                    $min = floatval($product['minium_people_cnt']);
                                    $max = floatval($product['total_people_cnt']);
                                    for ($i = $min; $i <= $max; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '인</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="flex__c item-tag-select">
                                <span class="label">티오프 시간 선택</span>
                                <div class="body-box flex">
                                    <select class="box flex_1" id="hoursDay" onchange="">
                                        <option value="">선택</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
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
                                    </select>
                                    <select class="box flex_1" id="minuteDay" onchange="">
                                        <option value="">선택</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
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
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                        <option value="46">46</option>
                                        <option value="47">47</option>
                                        <option value="48">48</option>
                                        <option value="49">49</option>
                                        <option value="50">50</option>
                                        <option value="51">51</option>
                                        <option value="52">52</option>
                                        <option value="53">53</option>
                                        <option value="54">54</option>
                                        <option value="55">55</option>
                                        <option value="56">56</option>
                                        <option value="57">57</option>
                                        <option value="58">58</option>
                                        <option value="59">59</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-selecter flex_b_c">
                        <div class="ic_item">
                            <div class="title first">주/야간 선택</div>
							<?php if (!empty($hole_cnt_arr)) { ?>
                            <div class="body-box flex">
                                <div class="box day_option day_option_first flex_1 active" data-type="day">
                                    <p>주간</p>
                                </div>
                                <div class="box day_option day_option_third flex_1" data-type="afternoon">
                                    <p>오후</p>
                                </div>
                                <div class="box day_option day_option_second flex_1" data-type="night">
                                    <p>야간</p>
                                </div>
                            </div>
							<?php } ?>
                        </div>
                        <div class="ic_item">
                            <div class="flex__c" style="width: 50%;">
                                <div class="item-select" id="cart_no" style="display:none">
                                    <p>카트비는 그린피에 포함입니다.</p>	   
                                </div>
                                <div class="item-select" id="cart_yes" style="display:none; align-items: center; width: 100%;">
                                    <span class="label first">카트</span>
                                    <input type="hidden" name="vehicle_idx[]" value="4">
                                    <select id="vehicle_4" data-name="카트" data-idx="<?=$idx?>" data-price="<?=$cart_price?>" data-price_baht="<?=$cart_price_baht?>" class="vehicle_select select_custom_ active_ cus-width" name="vehicle_cnt[]">
                                        <option value="">선택해주세요.</option>
                                        <option value="1">1대</option>
                                        <option value="2">2대</option>
                                        <option value="3">3대</option>
                                        <option value="4">4대</option>
                                        <option value="5">5대</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex__c" style="width: 50%;">
                                <div class="item-select" id="caddy_no" style="display:none">
                                    <p>캐디피는 그린피에 포함입니다.</p>	   
                                </div>
                                <div class="item-select second" id="caddy_yes" style="display:none; align-items: center; width: 100%;">
                                    <span class="label">캐디피</span>
                                    <input type="hidden" name="vehicle_idx[]" value="5">
                                    <select id="vehicle_5" data-name="캐디피" data-idx="<?=$idx?>" data-price="<?=$caddie_fee?>" data-price_baht="<?=$caddie_fee_baht?>" class="vehicle_select select_custom_ active_ cus-width" name="vehicle_cnt[]">
                                        <option value="">선택해주세요.</option>
                                        <option value="1">1명</option>
                                        <option value="2">2명</option>
                                        <option value="3">3명</option>
                                        <option value="4">4명</option>
                                        <option value="5">5명</option>
                                        <option value="6">6명</option>
                                        <option value="7">7명</option>
                                        <option value="8">8명</option>
                                        <option value="9">9명</option>
                                        <option value="10">10명</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-selecter">
                        <div class="titles">선택옵션</div>
                        <div class="select-more-body flex__c">
                            <?php $seq = 1; ?>
                            <?php foreach ($result_opt as $option) : ?>
                                <div class="item">
                                    <div class="item_left flex__c">
                                        <span class="tit">추가옵션<?= $seq++; ?></span>
                                        <p class="content"
                                           rel="<?= $option['goods_name'] ?>"><?= $option['goods_name'] ?></p>
                                    </div>
                                    <div class="item_right flex__c">
                                        <span class="pri"
                                              rel="<?= (int)($option['goods_price1_1'] * $baht_thai) ?>">￦<?= number_format($option['goods_price1_1'] * $baht_thai) ?></span>
                                        <input type="hidden" name="opt_idx[]" value="<?= $option['idx'] ?>">
                                        <input type="hidden" name="opt_name[]"   value="<?= $option['goods_name'] ?>">
                                        <input type="hidden" name="opt_name_en[]"   value="<?= $option['goods_name_eng'] ?>">

                                        <select data-name="<?= $option['goods_name'] ?>"
                                                data-price="<?= (int)($option['goods_price1_1'] * $baht_thai) ?>"
                                                data-price_baht="<?= $option['goods_price1_1'] ?>"
                                                class="option_select select_custom_ active_ cus-width"
                                                name="option_cnt[]" onchange="calculatePrice();">
                                            <option value="0">선택</option>
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
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!--div class="item">
                                <div class="item_left flex__c">
                                    <span class="tit">추가선택2</span>
                                    <p class="content" rel="1인객실사용료 (싱글차지) / 박당 (+80,000원)">1인객실사용료 (싱글차지) / 박당 (+80,000원)</p>
                                </div>
                                <div class="item_right flex__c">
                                    <span class="pri" rel="80000">￦80,000</span>
                                    <select name="sel_cnt[]" id="" onchange="writePrice()">
                                        <option value="0">선택</option>
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
                                                                        </select>
                                </div>
                            </div-->
                        </div>
                    </div>
                    <div class="tag-list">
                        <?php foreach ($hour_arr as $hour) : ?>
                            <span class="tag tag-js2" data-tab="<?= $hour ?>"><?= $hour ?>시</span>
                            <!--span class="tag tag-js2" data-tab="06">06시</span>
                            <span class="tag tag-js2" data-tab="07">07시</span>
                            <span class="tag tag-js2" data-tab="08">08시</span>
                            <span class="tag tag-js2" data-tab="09">09시</span>
                            <span class="tag tag-js2" data-tab="10">10시</span>
                            <span class="tag tag-js2" data-tab="11">11시</span>
                            <span class="tag tag-js2" data-tab="12">12시</span>
                            <span class="tag tag-js2" data-tab="13">13시</span>
                            <span class="tag tag-js2" data-tab="14">14시</span>
                            <span class="tag tag-js2" data-tab="15">14시</span>
                            <span class="tag tag-js2" data-tab="16">16시</span-->
                        <?php endforeach; ?>
                    </div>
                </div>

        </div>
        <div class="date-text-2" style="display:none;">
            <div class="result_select">
                <p class="final_date"></p> /
                <p class="final_hole">0</p><span>홀수</span> /
                <!--p class="final_hour">00</p><span>시</span> /-->
                <p class="final_people_cnt">0</p><span>인</span>
            </div>
            <p>※ 아래 요금은 1인당 가격입니다.</p>
        </div>
        <div class="card-content" id="final_option_list" style="display:none;"></div>
        <div class="section1-sub">
            <h3 class="title-size-24 text-parent">골프장 왕복 픽업 차량 및 캐디피<span>※선택 옵션입니다. 추가 원하시면 선택해 주세요.</span></h3>
        </div>
        <!--div class="list-select-element">
            <?php foreach ($golfVehicles as $value) : ?>
                <div class="item-select">
                    <span class="label"><?= $value['code_name'] ?></span>
                    <input type="hidden" name="vehicle_idx[]" value="<?= $value['code_idx'] ?>">
                    <select
                            data-name="<?= $value['code_name'] ?>"
                            data-price="<?= $value['price'] ?>"
                            data-price_baht="<?= $value['price_baht'] ?>"
                            class="vehicle_select select_custom_ active_ cus-width"
                            name="vehicle_cnt[]">
                        <option value="">선택해주세요.</option>
                        <?php for ($i = $value['min_cnt']; $i <= $value['max_cnt']; $i++) : ?>
                            <option value="<?= $i ?>"><?= $i ?>개</option>
                        <?php endfor; ?>
                    </select>
                </div>
            <?php endforeach; ?>
        </div-->
		
          <div class="list-select-element tour">
		       <div class="item-select">
                    <span class="label" style="width: unset;">승용차</span>
                    <input type="hidden" name="vehicle_idx[]" value="1">
					<select id="trip_type1" name="trip_type1" style="width:80px; flex: 0 0 auto;" data-idx="<?=$idx?>" data-car="1" onchange="trip_change(this);">
					    <option value="0">왕복</option>
					    <option value="1">편도</option>
					</select>
                    <select id="vehicle_1" data-name="승용차" data-idx="<?=$idx?>" data-price="<?=$vehicle_price1?>" data-price_baht="<?=$vehicle_price1_baht?>" class="vehicle_select select_custom_ active_ cus-width" name="vehicle_cnt[]">
                        <option value="">선택해주세요.</option>
						<option value="1">1대</option>
						<option value="2">2대</option>
						<option value="3">3대</option>
						<option value="4">4대</option>
						<option value="5">5대</option>
                    </select>
                </div>
                <div class="item-select">
                    <span class="label" style="width: unset;">SUV</span>
                    <input type="hidden" name="vehicle_idx[]" value="3">
					<select id="trip_type3" name="trip_type3" style="width:80px; flex: 0 0 auto;" data-idx="<?=$idx?>" data-car="3" onchange="trip_change(this);">
					    <option value="0">왕복</option>
					    <option value="1">편도</option>
					</select>
                    <select id="vehicle_3" data-name="SUV" data-idx="<?=$idx?>" data-price="<?=$vehicle_price3?>" data-price_baht="<?=$vehicle_price3_baht?>" class="vehicle_select select_custom_ active_ cus-width" name="vehicle_cnt[]">
                        <option value="">선택해주세요.</option>
						<option value="1">1대</option>
						<option value="2">2대</option>
						<option value="3">3대</option>
						<option value="4">4대</option>
						<option value="5">5대</option>
				</select>
                </div>
            	<div class="item-select">
                    <span class="label" style="width: unset;">밴 (승합차) </span>
                    <input type="hidden" name="vehicle_idx[]" value="2">
					<select id="trip_type2" name="trip_type2" style="width:80px; flex: 0 0 auto;" data-idx="<?=$idx?>" data-car="2" onchange="trip_change(this);">
					    <option value="0">왕복</option>
					    <option value="1">편도</option>
					</select>
                    <select id="vehicle_2" data-name="밴(승합차)" data-idx="<?=$idx?>" data-price="<?=$vehicle_price2?>" data-price_baht="<?=$vehicle_price2_baht?>" class="vehicle_select select_custom_ active_ cus-width" name="vehicle_cnt[]">
                        <option value="">선택해주세요.</option>
								<option value="1">1대</option>
								<option value="2">2대</option>
								<option value="3">3대</option>
								<option value="4">4대</option>
								<option value="5">5대</option>
								<option value="6">6대</option>
								<option value="7">7대</option>
						</select>
                </div>  
        </div>
        <div class="section-wrap-s">
           <h3 class="tit-left"><?= viewSQ($product['product_name']) ?></h3>
           <div class="btn-s-wrap btn-s-wrap-pc">
                <button class="btn-price-content default-button" type="button" onclick="redirect_contact()">문의하기</button>

                <?php if ($product['product_status'] == 'sale'): ?>
                    <button class="btn-price-content" type="button" onclick="handleSubmit('W')">예약하기</button>
                <?php endif; ?>
                <button class="btn-price-content btn-add-cart" type="button" onclick="handleSubmit('B')">장바구니</button>
           </div>                 
        </div>
        <div class="section2-sub">
            <div class="left-main">
                <p>
                    <span class="l-label">일정</span>
                    <span class="l-label2 final_date"></span>
                </p>
                <p>
                    <span class="l-label">홀수</span>
                    <span class="l-label2"><em class="final_hole">0</em>홀</span>
                </p>
                <p>
                    <span class="l-label">티오프시간</span>
                    <span class="l-label2"><em class="final_hour"   id="final_hour">00</em>시 
					                       <em class="final_minute" id="final_minute">00</em>분</span>
                </p>
                <p>
                    <span class="l-label">인원</span>
                    <span class="l-label2"><em class="final_people_cnt">0</em>인</span>
                </p>
                <!--button class="btn-price-content-normal" type="button"
                        onclick="showCouponPop()">쿠폰적용
                </button-->
                <!--button class="btn-price-content-normal" type="button" onclick="cartAdd()">장바구니 담기</button-->
            </div>
            <div class="right-main" id="booking_area">
                <div class="item-right">
                    <div class="list-text">
                        <p><span class="text-gray">그린피 : </span><em id="final_option_price">0</em> 원
                            (1인 <em id="final_option_price_baht">0</em>바트 X <em class="final_people_cnt">0</em>인)</p>
                        <p style="display:none;"><span class="text-gray">캐디피 : </span><em id="final_caddy_fee">그린피에
                                포함</em></p>
                        <p style="display:none;"><span class="text-gray">카트피 : </span><em id="final_cart_pie_fee">그린피에
                                포함</em></p>
                    </div>
                    <span class="price-text text-gray"><em id="total_final_option_price">0</em> 원 (<em
                                id="total_final_option_price_baht">0</em>바트)</span>
                </div>
                <div class="vehicle_list_result" id="vehicle_list_result"></div>
                <div class="option_list_result" id="option_list_result"></div>
                <!--div class="item-right cus-border">
                    <p><span class="">쿠폰 적용</span></p>
                    <span class="price-text">- <em id="final_discount">0</em>원 (<em
                                id="final_discount_baht">0</em>원)</span>
                </div-->
                <div class="item-last-right">
                    <p>합계</p>
                    <p class="price-text"><em id="last_price">0</em><span> 원(<em id="last_price_baht">0</em>바트)</span>
                    </p>
                </div>
            </div>
        </div>
        </form>
        <h3 class="title-size-24" id="product_info">상품 정보</h3>
        <table class="golf-table" style="table-layout: fixed;">
            <colgroup>
                <col width="16%">
                <col width="*">
                <col width="16%">
                <col width="*">
                <col width="16%">
                <col width="*">
            </colgroup>
            <thead>
            <tr>
                <th>더투어랩 평가 등급</th>
                <th>
                    <div class="rating-list">
                        <?php if ($info['star_level'] > 0) { ?><img src="/uploads/icons/star_icon.png"
                                                                    alt="star_icon"><?php } ?>
                        <?php if ($info['star_level'] > 1) { ?><img src="/uploads/icons/star_icon.png"
                                                                    alt="star_icon"><?php } ?>
                        <?php if ($info['star_level'] > 2) { ?><img src="/uploads/icons/star_icon.png"
                                                                    alt="star_icon"><?php } ?>
                        <?php if ($info['star_level'] > 3) { ?><img src="/uploads/icons/star_icon.png"
                                                                    alt="star_icon"><?php } ?>
                        <?php if ($info['star_level'] > 4) { ?><img src="/uploads/icons/star_icon.png"
                                                                    alt="star_icon"><?php } ?>
                    </div>
                </th>
                <th>총홀수</th>
                <th><?= $info['holes_number'] ?></th>
                <th>휴무일</th>
                <th><?= $info['holidays'] ?></th>
            </tr>
            </thead>
            <tbody class="text-gray">
            <tr>
                <td>시내에서 거리 및 이동기간</td>
                <td><?= $info['distance_from_center'] ?></td>
                <td>공항에서 거리 및 이동시간</td>
                <td><?= $info['distance_from_airport'] ?></td>
                <td>팀당 라운딩 인원</td>
                <td><?= $info['num_of_players'] ?></td>
            </tr>
            <tr>
                <td>전동카트</td>
                <td colspan="5"><?= $info['electric_car'] ?></td>
            </tr>
            <tr>
                <td>갤러리피</td>
                <td colspan="5"><?= $info['caddy'] ?></td>
            </tr>
            <tr>
                <td>장비렌탈</td>
                <td colspan="5"><?= $info['equipment_rent'] ?></td>
            </tr>
            <!-- <tr>
                <td>스포츠데이</td>
                <td colspan="5"><?= $info['sports_day'] ?></td>
            </tr> -->
            </tbody>
        </table>

        <h3 class="title-size-24" id="product_des">상품설명</h3>
        <div class="container-big-text">
            <?= viewSQ($product['tour_info']) ?>
        </div>

        <div class="content-custom-table">
            <div class="content-item">
                <span class="label">코스정보</span>
                <div class="description">
                    <?= viewSQ($product['tour_detail']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    시설정보
                </span>
                <div class="description">
                    <?= viewSQ($product['information']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    위치정보
                </span>
                <div class="description">
                    <?= viewSQ($product['code_services']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    캐디팁
                </span>
                <div class="description">
                    <?= viewSQ($product['note_news']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    1~2인 라운드 규정
                </span>
                <div class="description">
                    <?= viewSQ($product['product_contents']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    골프텔 정보
                </span>
                <div class="description">
                    <?= viewSQ($product['product_able']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    티오프 시간
                </span>
                <div class="description">
                    <?= viewSQ($product['meeting_guide']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    복장규정
                </span>
                <div class="description">
                    <?= viewSQ($product['product_more']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    레인체크 규정
                </span>
                <div class="description">
                    <?= viewSQ($product['departure_area']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    어린이 정책
                </span>
                <div class="description">
                    <?= viewSQ($product['product_confirm']) ?>
                </div>
            </div>
            <div class="content-item">
                <span class="label">
                    중요 공지사항
                </span>
                <div class="description">
                    <?= viewSQ($product['notice_comment']) ?>
                </div>
            </div>
        </div>

        <!-- <h3 class="title-size-24" id="product_des">유의사항</h3>
        <div class="container-big-text">
            <?= viewSQ($product['note_news']) ?>
        </div> -->
        <h3 class="title-size-24" id="location">위치정보</h3>
        <div id="map" style="width: 100%; height: 225px;"></div>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
        <script>
            var lat = '<?= $product['latitude'] ?>' || 13.7563;
            var lng = '<?= $product['longitude'] ?>' || 100.5018;
            var map = L.map('map').setView([lat, lng], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'The Tour Lab'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map)
        </script>
        <div class="location-container">
            <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
            <span class="text-gray"><?= $product['addrs'] ?></span>
        </div>
            
        <?php echo view("/product/inc/review_product"); ?>

        <div class="section6" id="golf_qna_wrap">
            <h2 class="title-sec6" id="qna"><span>상품 Q&A</span>(<?=$product_qna["nTotalCount"] ?? 0?>)</h2>
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
                            if (empty($product_qna["items"])) {
                        ?>
                            <li class="qa-item no-data">게시글 없습니다</li>
                        <?php
                            } else {
                                foreach($product_qna["items"] as $qna){
                            if(!empty(trim($qna["reply_content"]))){
                                $qna_status = "Y";
                                $qna_text = "답변완료";
                            }else{
                                $qna_status = "N";
                                $qna_text = "문의접수";
                            }
                    ?>
                        <li class="qa-item">
                            <div class="qa-wrap">
                                <div class="qa-question">
                                    <span class="qa-number"><?=$num_qna--;?></span>
                                    <span class="qa-tag <?php if($qna_status == "N"){ echo "normal-style"; }?>"><?=$qna_text?></span>
                                    <div class="con-cus-mo-qa">
                                        <p class="qa-text"><?=$qna["title"]?></p>
                                    </div>
                                    <div class="qa-meta text-gray only_mo"><?=$qna["r_date"]?></div>
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
                        } }
                    ?>
                </ul>
            </div>
            <?php 
                echo ipagelistingSub($product_qna["pg"], $product_qna["nPage"], $product_qna["g_list_rows"], current_url() . "?pg_qna=", '', 'golf_qna_wrap')
            ?>
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
                        echo "<li><img src='/data/product/" . $img["ufile"] . "' alt='". $img["rfile"] ."' /></li>";
                    }
                } ?>
            </ul>
        </div>
        <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close"/></a>
    </div>
    <div id="popup_coupon" class="popup" data-price="">
        <div class="popup-content">
            <img src="/images/ico/close_icon_popup.png" alt="close_icon" class="close-btn"></img>
            <h2 class="title-popup">적용가능한 쿠폰 확인</h2>
            <div class="order-popup">
                <?php
                $nums_coupon = count($coupons);
                ?>
                <p class="count-info">사용 가능 쿠폰 <span><?= $nums_coupon ?>장</span></p>
                <div class="description-above">
                    <?php
                    foreach ($coupons as $coupon) {
                        if ($coupon["dc_type"] == "P") {
                            $discount = $coupon["coupon_pe"] . "%";
                            $dis = $coupon["coupon_pe"];
                        } else if ($coupon["dc_type"] == "D") {
                            $discount = number_format($coupon["coupon_price"]) . "원";
                            $dis = $coupon["coupon_price"];
                        } else {
                            $discount = "회원등급에 따름";
                            $dis = 0;
                        }
                        ?>
                        <div class="item-price-popup" style="cursor: pointer;"
                             data-idx="<?= $coupon["c_idx"] ?>" data-type="<?= $coupon["dc_type"] ?>"
                             data-discount="<?= $dis ?>" data-discount_baht="<?= $coupon["coupon_price_baht"] ?>">
                            <div class="img-container">
                                <img src="/images/sub/popup_cash_icon.png" alt="popup_cash_icon">
                            </div>
                            <div class="text-con">
                                <span class="item_coupon_name"><?= $coupon["coupon_name"] ?></span>
                                <span class="text-gray"><?= $discount ?> 할인쿠폰</span>
                            </div>
                            <span class="date-sub">~<?= date("Y.m.d", strtotime($coupon["enddate"])) ?></span>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="item-price-popup item-price-popup--button active"
                         data-idx="" data-type="" data-discount="0" data-discount_baht="0">
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
                                <span id="last_price_popup">0</span><span
                                        class="text-gray">원</span>
                            </p>
                        </div>
                    </div>
                    <!--button type="button" class="btn_accept_popup btn_accept_coupon">
                        쿠폰적용
                    </button-->
                    <button type="button" class="btn_accept_popup btn_accept_coupon">
                        장바구니 담기
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="popup_wrap place_pop cart_info_pop">
        <div class="pop_box">
            <button type="button" class="close" onclick="closePopup()"></button>
            <div class="pop_body">
                <div class="padding">
                    <div class="popup_place__head">
                        <div class="popup_place__head__ttl">
                            <h2>별도 요청</h2>
                        </div>
                    </div>
                    <div class="popup_place__body customer-form-page" style="background-color: unset;">
                        <div class="form-container">
                            <div class="vehicle_wrap_info">
                                <h3 class="form-title title-sub-c">골프장 왕복 픽업 차량 승용차: <span class="number_vehicle"></span>대</h3>
                                <div class="flex__c wrap-golf-info">
                                    <div class="con-form-select form-group mb-30">
                                        <label for="car-time-hour">차량 미팅 시간</label>
                                        <div class="form-group time-group">
                                            <div class="form-group-second">
                                                <select id="car-time-hour" name="popup_vehicle_time_hour" class="select-width golf-select">
                                                    <?php for ($i = 6; $i <= 19; $i++) { ?>
                                                        <option value="<?= sprintf("%02d", $i) ?>"><?= sprintf("%02d", $i) ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span>시</span>
                                            </div>
                                            <div class="form-group-second">
                                                <select id="car-time-minute" name="popup_vehicle_time_minute" class="select-width golf-select">
                                                    <?php for ($i = 0; $i < 60; $i++) { ?>
                                                        <option value="<?= sprintf("%02d", $i) ?>"><?= sprintf("%02d", $i) ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span>분</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="con-form-select form-group mb-30">
                                        <label for="popup_number_staff">인원</label>
                                        <div class="form-group ip-group time-group">
                                            <input type="text" id="popup_number_staff">
                                        </div>
                                    </div>
                                    <div class="con-form-select form-group mb-30">
                                        <label for="popup_number_luggage">짐갯수</label>
                                        <div class="form-group ip-group time-group">
                                            <input type="text" id="popup_number_luggage">
                                        </div>
                                    </div>
                                </div> 
    
                                <div class="form-group mb-30">
                                    <label for="pickup-location">출발지(필요호텔)</label>
                                    <input class="mb-10" type="text" id="pickup-location"
                                            style="width: 100%;"
                                            placeholder="호텔명을 영어로 적어주세요(주소불가)"/>
                                    <span class="text-gray">※일반주택은 정확한 건물명, 주소, 태국어 가능한 호스트의 태국 전화번호를 남겨줴요.</span>
                                </div>
                            </div>

                            <div class="form-group cus-form-group">
                                <label for="extra-requests">기타요청</label>
                                <textarea id="extra-requests"
                                            placeholder="예약업무를 주로 현지인 직원들이 처리하므로 여기에는 가급적 영어로 요청사항을 적어주시기 바랍니다. 중요한 요청 및 한글 요청 사항은 1:1게시판에 따로 남겨주셔야 정상적으로 처리가 가능합니다."></textarea>
                            </div>
                        </div>

                        <div class="flex_c_c">
                            <button type="button" class="btn_add_cart">
                                장바구니 담기
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dim"></div>
    </div>
    <script>
        function redirect_contact() {
            <?php
                if (empty(session()->get("member")["id"])) {
            ?>
                // alert("주문하시려면 로그인해주세요!");
                showOrHideLoginItem();
                return false;
            <?php
                }
            ?>

            window.location.href = '/contact/write';
        }
        $(".btn_add_cart").on("click", function () {
            $("#vehicle_time_hour").val($("#car-time-hour").val());
            $("#vehicle_time_minute").val($("#car-time-minute").val());
            $("#number_staff").val($("#popup_number_staff").val());
            $("#number_luggage").val($("#popup_number_luggage").val());
            $("#departure_point").val($("#pickup-location").val());
            $("#custom_req").val($("#extra-requests").val());

            $("#frm").attr('method', 'post');
            $("#frm").attr('action', '/product-golf/customer-form-ok');
			$("#frm").submit();
        });

        function closePopup() {
            $(".popup_wrap").hide();
        }
    </script>
	<script>
	function trip_change(selectElement) {
		var type        = selectElement.value;       // 선택된 값 (0=왕복, 1=편도)
		var idx         = selectElement.dataset.idx; // data-idx 값 가져오기 (dataset API 사용)
		var car         = selectElement.dataset.car; // data-car 값 가져오기 (dataset API 사용)
		var product_idx = document.getElementById("product_idx").value; // 상품 ID 가져오기
		var goods_name  = document.querySelector(".tag-js.active")?.dataset.tab || ""; // 선택된 홀 개수 가져오기

		// console.log("선택된 차량: " + car + ", 선택된 타입: " + type);

		$.ajax({
			url: "/ajax/ajax_trip_change",
			type: "POST",
			data: {
				"idx"        : idx,
				"type"       : type,
				"car"        : car,
				"product_idx": product_idx,
				"goods_name" : goods_name
			},
			dataType: "json",
			async: true, // 비동기 요청으로 변경
			cache: false,
			success: function (data) {
				// console.log("AJAX 응답:", data);
				if (data.status === "success") {
					
					// #vehicle_2 요소에 data-price와 data-price_baht 값 업데이트
					$('#vehicle_'+car).data('price', data.price_won);
					$('#vehicle_'+car).data('price_baht', data.price_bath);
					
					// 필요하면, HTML 속성 업데이트도 할 수 있음
					$('#vehicle_'+car).attr('data-price', data.price_won);
					$('#vehicle_'+car).attr('data-price_baht', data.price_bath);
					setListVehicle();
		
				} else {
					alert("데이터를 불러오는 데 실패했습니다.");
				}
			},
			error: function (request, status, error) {
				console.error("AJAX 요청 실패:", request, status, error);
				alert("서버 오류가 발생했습니다. 관리자에게 문의하세요.");
			}
		});
	}
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
                    product_gubun: "golf",
                    product_idx: <?= $product['product_idx'] ?? 0 ?>
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
        $('.day_option_first').click(function () {
            $(".day_option_first").addClass("active");
            $(".day_option_second").removeClass("active");
            $(".day_option_third").removeClass("active");
            getOptions();
        });

        $('.day_option_second').click(function () {
            $(".day_option_second").addClass("active");
            $(".day_option_first").removeClass("active");
            $(".day_option_third").removeClass("active");
            getOptions();
        });

        $('.day_option_third').click(function () {
            $(".day_option_third").addClass("active");
            $(".day_option_first").removeClass("active");
            $(".day_option_second").removeClass("active");
            getOptions();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#hoursDay').change(function () {
                const selectedValue = $(this).val(); // 선택된 값
                $("#final_hour").text(selectedValue);
                $("#teeoff_hour").val(selectedValue);
            });
            $('#minuteDay').change(function () {
                const selectedValue = $(this).val(); // 선택된 값
                $("#final_minute").text(selectedValue);
                $("#teeoff_min").val(selectedValue);
            });
        });
    </script>

     <script>
        function wish_it(product_idx) {

                const isLoggedIn = <?= session()->has('member') ? 'true' : 'false' ?>;

                if (!isLoggedIn) {
                    alert("로그인 하셔야 합니다.");
                    location.href = "/member/login?returnUrl=<?= urlencode($_SERVER['REQUEST_URI']) ?>";
                } else {

                var message = "";
                $.ajax({

                    url: "/product/like",
                    type: "POST",
                    data: {
                        "product_idx": product_idx
                    },
                    dataType: "json",
                    async: false,
                    cache: false,
                    success: function(data, textStatus) {
                        message = data.message;
                        alert(message);
                        location.reload();
                    },
                    error: function(request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
            }
        }
    </script>


    <script>
        function handleShowBookingArea(elm) {
            const target = $(elm).data('target');
            $(window).scrollTop($(target).offset().top - 100, 'slow');
        }

        $(function () {
            $(".tag-js").eq(0).trigger("click");
            $(".tag-js2").eq(0).trigger("click");
            $("#people_adult_cnt").find("option").eq(1).prop("selected", true);
            $("#people_adult_cnt").trigger("change");
        })

        function setGolfOption() {
            let total_option_price      = 0;
            let total_option_price_baht = 0;
            let cnt                     = 0;

            $("#option_list_result").html("");

			let html = `<div class="item-right">
							<p><span class="text-gray">추가옵션 - </span>[name] x [cnt]대</p>
							<span class="price-text text-gray">[price] 원 ([price_baht]바트)</span>
						</div>`;
            const html2 = $(".option_select").filter(function () {
                return $(this).val() !== "";
            }).map(function () {
                const p_name = $(this).data('name');
                cnt = $(this).val() || 0;
                const price = Math.round($(this).data('price') * cnt);
                const price_baht = Math.round($(this).data('price_baht') * cnt);

                total_option_price += price;
                total_option_price_baht += price_baht;

                if(cnt > 0) {
					return html.replace("[name]", p_name)
						.replace("[cnt]", cnt)
						.replace("[price]", number_format(price))
						.replace("[price_baht]", number_format(price_baht));
			    }	

			}).get().join('');

            if (total_option_price > 0) $("#option_list_result").html(html2);

            return {
                total_option_price,
                total_option_price_baht
            };

        }

        function setListVehicle() {
            let total_vehicle_price = 0;

            let total_vehicle_price_baht = 0;
            let html = `<div class="item-right">
                            <p><span class="text-gray"></span>[name] x [cnt](EA)</p>
                            <span class="price-text text-gray">[price] 원 ([price_baht]바트)</span>
                        </div>`;

            let o_cart_due = $("#o_cart_due").val();
            let o_caddy_due = $("#o_caddy_due").val();
            let o_cart_cont = $("#o_cart_cont").val();
            let o_caddy_cont = $("#o_caddy_cont").val();


            const html2 = $(".vehicle_select").filter(function () {
                return $(this).val() !== "" && $(this).val() !== "0";
            }).map(function () {
                const p_name = $(this).data('name');
                const cnt = $(this).val() || 0;
                const price = parseInt($(this).attr('data-price') * cnt);
                const price_baht = parseInt($(this).attr('data-price_baht') * cnt);
                total_vehicle_price += price;
                total_vehicle_price_baht += price_baht;
                return html.replace("[name]", p_name)
                    .replace("[cnt]", cnt)
                    .replace("[price]", number_format(price))
                    .replace("[price_baht]", number_format(price_baht));
            }).get().join('');
            $("#vehicle_list_result").html(html2);

            return {
                total_vehicle_price,
                total_vehicle_price_baht
            };
        }

        function setOptionArea() {
            const optionActive = $("#final_option_list .card-item.active_2");
            const price = optionActive.data("option_price") || 0;
            const caddy_fee = optionActive.data("caddy_fee") || "그린피에 포함";
            const cart_pie_fee = optionActive.data("cart_pie_fee") || "그린피에 포함";
            const price_baht = optionActive.data("option_price_baht") || 0;
            const people_cnt = $("#people_adult_cnt").val() || 0;
            const final_price = parseInt(price * people_cnt);
            const final_price_baht = parseInt(price_baht * people_cnt);
            const minute = optionActive.data("minute") || "00";

            //$("#option_idx").val(optionActive.data("idx"));
            $("#final_option_price").text(number_format(price));
            $("#final_caddy_fee").text(caddy_fee);
            $("#final_cart_pie_fee").text(cart_pie_fee);
            $("#final_option_price_baht").text(number_format(price_baht));
            $(".final_people_cnt").text(number_format(people_cnt));
            $("#total_final_option_price").text(number_format(final_price));
            $("#total_final_option_price_baht").text(number_format(final_price_baht));
            //$(".final_minute").text(minute);

            return {
                final_price,
                final_price_baht
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
                $("#final_discount").text(number_format(discount_price));
                $("#final_discount_baht").text(number_format(discount_price_baht));
                $("#use_coupon_idx").val(idx);
            }

            return {
                discount_price,
                discount_price_baht
            };
        }

        function calculatePrice() {

            const vehiclePrice = setListVehicle();

            const optionPrice  = setOptionArea();
            const optionPrice1 = setGolfOption();                        

            let last_price      = vehiclePrice.total_vehicle_price + optionPrice.final_price + optionPrice1.total_option_price;
            let last_price_baht = vehiclePrice.total_vehicle_price_baht + optionPrice.final_price_baht + optionPrice1.total_option_price_baht;

            $("#total_price_popup").text(number_format(last_price) + "원");
            $("#total_price").val(last_price);
            $("#total_price_baht").val(last_price_baht);

            const discount_price = $("#final_discount").text().replace(/[^0-9]/g, '');
            const discount_price_baht = $("#final_discount_baht").text().replace(/[^0-9]/g, '');

            last_price -= discount_price;
            last_price_baht -= discount_price_baht;

            $("#last_price").text(number_format(last_price));
            $("#last_price_baht").text(number_format(last_price_baht));
        }

        function selectOption(obj) {
            $('#final_option_list .card-item').removeClass('active_2');
            $(obj).addClass('active_2');
            calculatePrice();
        }

        function getOptions() {
            const golf_date = $("#order_date").val();
            const hole_cnt  = $('.tag-js.active').data('tab') + '홀';
            const hour = $('.day_option.active').data('type');

			$("#hole_cnt").val(hole_cnt);
            $("#hour").val(hour);
            //alert(golf_date+' - '+hole_cnt+' - '+hour);
            if (!hole_cnt || !hour) {
                return false;
            }
            $.ajax({
                type: "GET",
                url: "/product-golf/option-price/<?= $product['product_idx'] ?>",
                data: {
                    golf_date,
                    hole_cnt,
                    hour,
                },
                success: function (data) {
                    $('#final_option_list').html(data);
                    
                    $("#final_option_list .card-item").eq(0).trigger("click");
                    
					var idx                 = $(".card-item").data('idx');
                    var day_yn              = $(".card-item").data('o_day_yn');
                    var night_yn            = $(".card-item").data('o_night_yn');
                    var afternoon_yn        = $(".card-item").data('o_afternoon_yn');
					var vehicle_price1_won  = $(".card-item").data('vehicle_price1_won');
					var vehicle_price2_won  = $(".card-item").data('vehicle_price2_won');
					var vehicle_price3_won  = $(".card-item").data('vehicle_price3_won');
					var vehicle_price1_baht = $(".card-item").data('vehicle_price1_baht');
					var vehicle_price2_baht = $(".card-item").data('vehicle_price2_baht');
					var vehicle_price3_baht = $(".card-item").data('vehicle_price3_baht');
					
                    $("#option_idx").val( $(".card-item").data('idx') );

                    const $trip_type1 = $("#trip_type1");
                    const $trip_type2 = $("#trip_type2");
                    const $trip_type3 = $("#trip_type3");
					
					const $select_1   = $("#vehicle_1");
					const $select_2   = $("#vehicle_2");
					const $select_3   = $("#vehicle_3");

					$trip_type1.attr("data-idx",       $(".card-item").data('idx'));
					$trip_type2.attr("data-idx",       $(".card-item").data('idx'));
					$trip_type3.attr("data-idx",       $(".card-item").data('idx'));

					// 원하는 data-* 속성들을 이동
					$select_1.attr("data-idx",         $(".card-item").data('idx'));
					$select_1.attr("data-price",       $(".card-item").data('vehicle_price1_won'));
					$select_1.attr("data-price_baht",  $(".card-item").data('vehicle_price1_baht'));
					
					$select_2.attr("data-idx",         $(".card-item").data('idx'));
					$select_2.attr("data-price",       $(".card-item").data('vehicle_price2_won'));
					$select_2.attr("data-price_baht",  $(".card-item").data('vehicle_price2_baht'));
					
					$select_3.attr("data-idx",         $(".card-item").data('idx'));
					$select_3.attr("data-price",       $(".card-item").data('vehicle_price3_won'));
					$select_3.attr("data-price_baht",  $(".card-item").data('vehicle_price3_baht'));

                    $("#o_cart_due").val( $(".card-item").data('o_cart_due') );
                    $("#o_caddy_due").val( $(".card-item").data('o_caddy_due') );
                    $("#o_cart_cont").val( $(".card-item").data('o_cart_cont') );
                    $("#o_caddy_cont").val( $(".card-item").data('o_caddy_cont') );
                    

					if (day_yn == "Y") {
                        $(".day_option_first").show();
                    } else { 
                        $(".day_option_first").hide();
                    }
					
					if (night_yn == "Y") {
                        $(".day_option_second").show();
                    } else { 
                        $(".day_option_second").hide();
                    }
					
					if (afternoon_yn == "Y") {
                        $(".day_option_third").show();
                    } else {  
                        $(".day_option_third").hide();
					}
					
                    //    $(".day_option_first").addClass('active');
                    //    $(".day_option_second").removeClass('active');
                    //    $(".day_option_second").hide();
                    //}

                    if (hour == "day") {
                        $("#time_type").text('주간');
                    } else if (hour == "afternoon") {
                        $("#time_type").text('오후');
                    } else {
                        $("#time_type").text('야간');
                    }

                    showHideCaddy();

                    calculatePrice();
                }
            })
        }

        function changePeople() {
			
			$("#vehicle_5").val($("#people_adult_cnt").val()); // value가 "2"인 옵션 선택	
            calculatePrice();
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


        function showCouponPop() {
            $("#popup_coupon").css('display', 'flex');
        }


        function handleSubmit(type) {
			
            <?php
            if (empty(session()->get("member")["id"])) {
            ?>
            showOrHideLoginItem();
            return false;
            <?php
            }
            ?>

			<?php 
			if (empty($hole_cnt_arr)) { 
			?>
                alert('홀 미등록 상품입니다. 다른 상품을 선택하세요.');
                return false;
			<?php	
            }
            ?>
				
			if ($("#order_date").val() == "") {
                alert('에약일자를 선탹하세요.');
                return false;
            }

            if ($("#people_adult_cnt").val() < 1) {
                alert('인원을 선택하세요.');
                $("#people_adult_cnt").focus();
                return false;
            }

			if($("#o_cart_due").val() == "Y" && ($("#vehicle_4").val() == null || $("#vehicle_4").val() == "" || $("#vehicle_4").val() == "0")) {
                alert('본홀은 카트의무예약 홀입니다 카트를 선택해주세요.');
                $("#vehicle_4").focus();
                return false;
            }

            if(type == 'B'){
                let num_1 = Number($("#vehicle_1").val() ?? 0);
                let num_2 = Number($("#vehicle_2").val() ?? 0);
                let num_3 = Number($("#vehicle_3").val() ?? 0);
                
                if((num_1 + num_2 + num_3) > 0){
                    $(".cart_info_pop .number_vehicle").text(num_1 + num_2 + num_3);
                    $(".cart_info_pop .vehicle_wrap_info").show();
                }else{
                    $(".cart_info_pop .vehicle_wrap_info").hide();
                }

                $(".cart_info_pop").show();
            }else{
                $("#frm").submit();
            }

        }

        $(".vehicle_select").change(function () {
            calculatePrice();
        })

        function cartAdd() {
            alert('장바구니 담기');
        }


        function formatDate(date, separate = "-") {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}${separate}${month}${separate}${day}`;
        }

        function getDatesInRange(start, end) {
            let dates = [];
            let current = new Date(start);
            while (current <= end) {
                dates.push(new Date(current));
                current.setDate(current.getDate() + 1);
            }
            return dates;
        }

        function isDateInRange(date, s, e) {
            return date >= s && date <= e;
        }

        function getAvailableDates(s_date, e_date, deadline_date_arr) {
            let result = [];
            const allDates = getDatesInRange(s_date, e_date);

            allDates.forEach(date => {
                let isBlocked = deadline_date_arr.some(deadline =>
                    isDateInRange(date, deadline.s_date, deadline.e_date)
                );
                if (!isBlocked) {
                    result.push(formatDate(date));
                }
            });

            return result.join("|");
        }

        jQuery(document).ready(function () {
            var dim = $('#dim');
            var popup = $('#popupRoom');
            var closedBtn = $('#popupRoom .closed_btn');

            var popup2 = $('#popup_img');
            var closedBtn2 = $('#popup_img .closed_btn');

            var order_date = $("#order_date").val();
            var temp = order_date.split("-");


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

            $(".short_link").on('click', function (evt) {
                evt.preventDefault();
                var target = $(this).data('target');
                // $(window).scrollTop($('#' + target).offset().top - 100, 300);
                $('html, body').animate({
                    scrollTop: $('#' + target).offset().top - 100
                }, 'slow');
                return false;
            });

        });
        $('.tag-list .tag-js').on('click', function () {
            $('.tag-list .tag-js').removeClass('active');
            $(".final_hole").text($(this).data('tab'));
            $(this).addClass('active');
 			
			var goods_name = $(this).data('tab') + '홀';
 			
			$.ajax({
				url: "/ajax/get_golf_option",
				type: "POST",
				data: {
					product_idx : $('input[name="product_idx"]').val(),
					goods_name  : goods_name
				},
				dataType: "json",
				success: function (res) {
					/*	
					alert(res.vehicle_price1_ba);
					alert(res.vehicle_price1);
					alert(res.vehicle_price2_ba);
					alert(res.vehicle_price2);
					alert(res.vehicle_price3_ba);
					alert(res.vehicle_price3);
					alert(res.cart_price_ba);
					alert(res.cart_price);
					alert(res.caddie_fee_ba); 
					alert(res.caddie_fee); 
					*/

					// 요소 선택
					$("#option_idx").val(res.option_idx);
					$("#o_cart_due").val(res.o_cart_due); 	
					$("#o_caddy_due").val(res.o_caddy_due);	
					$("#o_cart_cont").val(res.o_cart_cont); 	
					$("#o_caddy_cont").val(res.o_caddy_cont); 			 
					
					// 요소 선택
					var $selectElement = $('#vehicle_1');
					// 동적으로 data 속성 변경
					$selectElement.attr('data-price', res.vehicle_price1);
					$selectElement.attr('data-price_baht', res.vehicle_price1_ba);					
					
					// 요소 선택
					var $selectElement = $('#vehicle_2');
					// 동적으로 data 속성 변경
					$selectElement.attr('data-price', res.vehicle_price2);
					$selectElement.attr('data-price_baht', res.vehicle_price2_ba);					
					
					// 요소 선택
					var $selectElement = $('#vehicle_3');
					// 동적으로 data 속성 변경
					$selectElement.attr('data-price', res.vehicle_price3);
					$selectElement.attr('data-price_baht', res.vehicle_price3_ba);					
					
					// 요소 선택
					var $selectElement = $('#vehicle_4');
					// 동적으로 data 속성 변경
					$selectElement.attr('data-price', res.cart_price);
					$selectElement.attr('data-price_baht', res.cart_price_ba);					
					
					// 요소 선택
					var $selectElement = $('#vehicle_5');
					// 동적으로 data 속성 변경
					$selectElement.attr('data-price', res.caddie_fee);
					$selectElement.attr('data-price_baht', res.caddie_fee_ba);	                                        
                    

				}
			})
			/* 	
			$("#vehicle_1").val(""); // 기본값으로 리셋
			$("#vehicle_2").val(""); // 기본값으로 리셋
			$("#vehicle_3").val(""); // 기본값으로 리셋
			$("#vehicle_4").val(""); // 기본값으로 리셋
			$("#vehicle_5").val(""); // 기본값으로 리셋
            */
            getOptions();
            calculatePrice();
        });

        $('.tag-list .tag-js2').on('click', function () {
            $('.tag-list .tag-js2').removeClass('active');
            $(".final_hour").text($(this).data('tab'));
            $(this).addClass('active');
            getOptions();
        });

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

        // Get the popup, open button, close button elements
        const $closePopupBtn = $('.close-btn');

        // $('.list-icon img[alt="heart_icon"]').click(function () {
        //     if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
        //         $(this).attr('src', '/uploads/icons/heart_on_icon.png');
        //     } else {
        //         $(this).attr('src', '/uploads/icons/heart_icon.png');
        //     }
        // });

        // Close the popup when the "Close" button or the "x" is clicked
        $closePopupBtn.on('click', function () {
            $("#popup_coupon").css('display', 'none');
        });

        const s_date = new Date('<?= $info['s_date'] ?>');
        const e_date = new Date('<?= $info['e_date'] ?>');
        const deadline_date = '<?= $info['deadline_date'] ?>';
        const deadline_date_arr = deadline_date.split(',').map(function (date) {
            const [s_date, e_date] = date.split('~').map(x => x.trim());
            return {
                s_date: new Date(s_date),
                e_date: new Date(e_date)
            };
        });

        //var sel_Date = getAvailableDates(s_date, e_date, deadline_date_arr);
        var sel_Date = $("#selDate").val();
        //console.log('sel_Date:', sel_Date); // 단순 메시지 출력(sel_Date); 마감일자 확인
        const arrDate = sel_Date.split("|");
        const arrPrice = arrDate.map(x => '<?= round($product['product_price_won'] / 10000, 1) ?>');

        function getMonthDatesWithWeekdays(month, year) {
            const monthDatesWithWeekdays = [];
            const daysInMonth = new Date(year, month, 0).getDate();

            for (let day = 1; day <= daysInMonth; day++) {
                const date = new Date(year, month - 1, day);
                const weekday = date.getDay();

                const dateInfo = {
                    dayOfMonth: day,
                    weekday: weekday
                };

                monthDatesWithWeekdays.push(dateInfo);
            }

            return monthDatesWithWeekdays;
        }

        let currentDate = new Date();
        let currentMonth = currentDate.getMonth() + 1;
        let currentYear = currentDate.getFullYear();

        const today = new Date();

        let swiper01 = new Swiper('.calendar-swiper-container', {
            slidesPerView: 22,
            spaceBetween: 2,
            loop: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            observer: true,
            observeParents: true,
        });

        function sel_date(day, date = null) {
            if (date) {
                const newDay = new Date(date).getDay();
                $(".final_date").text(`${date.replaceAll("-", ".")} (${daysOfWeek[newDay]})`);
                $("#order_date").val(date);
                $("#final_option_list").empty();
                showHideCaddy();
                getOptions();

            }
            $('.day a').removeClass("on");
            $('.day a').eq(day - 1).addClass("on");
        }

        function setSlide(currentMonth, currentYear) {

            const currentDay = `0${currentDate.getDate()}`.slice(-2);
            let to_Day = currentYear + '-' + currentMonth + '-' + currentDay;

            if (currentYear != null && !isNaN(currentYear)) {
                $("#year").text(currentYear);
            }
            $("#month").text(currentMonth);
            swiper01.destroy();
            const daysInCurrentMonth = getMonthDatesWithWeekdays(currentMonth, currentYear);
            $(".calendar-swiper-wrapper").empty();

            daysInCurrentMonth.forEach(e => {

                var selPrice = $("#selPrice").val();
				//alert(selPrice);
				var Price = selPrice.split("|");
                var calDate = currentYear + '-' + currentMonth + '-' + `0${e.dayOfMonth}`.slice(-2);

                var idx = -1;

                if (arrDate.includes(calDate) && new Date(calDate).getTime() > today.getTime()) {
                    idx = arrDate.indexOf(calDate);
                }

                if (idx == -1) {
                    var selAmt = "-";
                } else {
                    var selAmt = parseInt(Price[idx]/10000) + '만';
                }

                const href = selAmt !== "-" ? `javascript:sel_date(${e.dayOfMonth}, "${calDate}");` : "javascript:void(0);";

                const active = selAmt !== "-" ? "on" : "";

                $(".calendar-swiper-wrapper").append(`
                <div class="swiper-slide">
                    <div style="color:${e.weekday === 6 || e.weekday === 0 ? "red" : "black"}">${daysOfWeek[e.weekday]}</div>
                    <div class="day ${active}" day_${e.dayOfMonth}">
                        <a href='${href}' data-date="${calDate}">
                            ${e.dayOfMonth}
                        </a>
                        <p class="txt">${selAmt}</p>
                    </div>
                </div>
            `);
            });

            swiper01 = new Swiper('.calendar-swiper-container', {
                slidesPerView: 22,
                spaceBetween: 2,
                // slidesPerGroup: 13,
                loop: false,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                observer: true,
                observeParents: true,
                breakpoints: {
                    850: {
                        slidesPerView: 22,
                        spaceBetween: 2,
                    },
                    350: {
                        slidesPerView: 5,
                        spaceBetween: 2,
                    }
                },
            });

            swiper01.slideTo(currentDay - 2);
        }

        setSlide(`0${currentMonth}`.slice(-2), currentYear);

        let initDate = $(".calendar-swiper-wrapper").find(".day.on a").eq(0).attr("data-date");
		if (typeof initDate === 'undefined') initDate = "";
        //const initDate = $("#firstDate").val();
        $(".calendar-swiper-wrapper").find(".day.on a").eq(0).addClass("on");
		if(initDate) $(".final_date").text(formatDate(new Date(initDate), "."));
        $("#order_date").val(formatDate(new Date(initDate), "-"));

        function nextMonth() {
            var yy = $("#year").text();
            var mm = $("#month").text();
            if (mm.length < 2) {
                mm = "0" + mm;
                $("#month").text(mm);
            }

            var dd = "1";

            currentDate.setMonth(currentDate.getMonth() + 1);
            currentDate.setDate(1);
            currentMonth = currentDate.getMonth() + 1;
            currentYear = currentDate.getFullYear();

            setSlide(`0${currentMonth}`.slice(-2), currentYear)
        }

        function prevMonth() {
            var yy = $("#year").text();
            var mm = $("#month").text();
            if (mm.length < 2) {
                mm = "0" + mm;
                $("#month").text(mm);
            }
            currentDate.setMonth(currentDate.getMonth() - 1);
            currentDate.setDate(1);
            currentMonth = currentDate.getMonth() + 1;
            currentYear = currentDate.getFullYear();
            setSlide(`0${currentMonth}`.slice(-2), currentYear)
        }

        $("#prev_icon").on("click", prevMonth)
        $("#next_icon").on("click", nextMonth)
        $("#prev_icon_mo").on("click", prevMonth)
        $("#next_icon_mo").on("click", nextMonth)

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
        function getCookie(name) {
            let cookies = document.cookie.split('; ');
            for (let i = 0; i < cookies.length; i++) {
                let parts = cookies[i].split('=');
                if (parts[0] === name) {
                    return decodeURIComponent(parts[1]);
                }
            }
            return null;
        }

        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        const product = {
            name: "<?= addslashes($product['product_name']) ?>",
            link: "<?= '/product-golf/golf-detail/' . $product['product_idx']?>",
            image: "<?= '/data/product/' . $product['ufile1'] ?>",
            ...(<?= isset($img_list[0]['ufile']) && $img_list[0]['ufile'] ? 'true' : 'false' ?> && { image2: "<?= '/data/product/' . $img_list[0]['ufile'] ?>" })
        };

        let viewedProducts = getCookie('viewedProducts');
        if (viewedProducts) {
            viewedProducts = JSON.parse(viewedProducts);
        } else {
            viewedProducts = [];
        }

        if (!viewedProducts.some(p => p.name === product.name)) {
            viewedProducts.push(product);
            if (viewedProducts.length > 10) {
                viewedProducts.shift();
            }
            setCookie('viewedProducts', JSON.stringify(viewedProducts), 1);
        }
    </script>
    <script>
        function showListShare () {
            $(".list_share").toggleClass("on");
        }

        $('.btn_share_kakao').on('click', function () {
            let img_url = 'https://thetourlab.com/uploads/setting/<?= $setting['favico'] ?>?>'
            const currentUrl = window.location.href;

            Kakao.Share.sendDefault({
                objectType: 'feed',
                content: {
                    title: document.querySelector("meta[name='Title']").content,
                    description: document.querySelector("meta[name='Description']").content,
                    imageUrl: img_url,
                    link: {
                        mobileWebUrl: currentUrl,
                        webUrl: currentUrl
                    }
                },
                buttons: [
                    {
                        title: 'View Page',
                        link: {
                            mobileWebUrl: currentUrl,
                            webUrl: currentUrl
                        }
                    }
                ]
            });
        });
        function copyUrl() {
            var dummy = document.createElement('input'),
                text = window.location.href;

            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);

            alert('URL이 복사되었습니다.')
        }
    </script>
<?php $this->endSection(); ?>