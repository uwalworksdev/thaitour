<?php
    helper(['setting']);
    $setting = homeSetInfo();
    $baht_thai_header = (float)($setting['baht_thai'] ?? 0);
?>

<link rel="stylesheet" type="text/css" href="/css/contents/reservation.css"/>

<div class="price-right-c">
    <form name="frm" id="frm" method="post" action="<?= route_to('api.product.processBooking') ?>">
        <input type="hidden" name="feeVal" id="feeVal" value="">
        <input type="hidden" name="time_line" id="time_line" value="">
        <div class="" style="display: none">
            <input type="hidden" name="totalPrice" id="totalPrice" value="0">
        </div>
        <div class="view_nav" id="sticky" style="position: sticky; top: 30px;">
            <div class="scroll_box">
                <input type="hidden" id="day_" name="day_">
                <input type="hidden" id="product_idx" name="product_idx" value="<?= $data_['product_idx'] ?>">
                <div class="cho_nav">
                    <p class="date_label">
                        <i></i> <span>예약일 <span id="select_date"></span></span>
                    </p>

                    <p class="label item_label">예약인원을 확인해주세요.</p>

                    <ul class="select_peo" id="list_people_option">
                        <li class="">
                            <div class="flex_b_c cus-count-input cus-count-input-adult">
                                <div class="payment">
                                    <p class="ped_label ped_label__booking">성인 </p>
                                </div>
                                <div class="opt_count_box count_box flex__c">
                                    <input type="text" class="input-qty adultQty" name="adultQty[]" id="adultQty"
                                           value="0"
                                           readonly="" style="padding: 0; width: 30px">
                                    <span>명</span>
                                    <input type="hidden" name="adultPrice[]" id="adultPrice">
                                </div>
                            </div>

                            <div class="flex_b_c cus-count-input cus-count-input-child">
                                <div class="payment">
                                    <p class="ped_label ped_label__booking">아동</p>
                                </div>
                                <div class="opt_count_box count_box flex__c">
                                    <input type="text" class="input-qty childrenQty" name="childrenQty[]"
                                           id="childrenQty" value="0"
                                           readonly="" style="padding: 0; width: 30px">
                                    <span>명</span>
                                    <input type="hidden" name="childrenPrice[]" id="childrenPrice">
                                </div>
                            </div>

                        </li>

                        <!-- <li class="" id="list_number_child_">

                            <div class="flex_b_c cus-count-input">
                                <div class="payment">
                                    <p class="ped_label ped_label__booking">아동</p>
                                </div>
                                <div class="opt_count_box count_box flex__c">
                                    <input type="text" class="input-qty childrenQty" name="childrenQty[]"
                                           id="childrenQty" value="0"
                                           readonly="" style="padding: 0; width: 30px">
                                    <span>명</span>
                                    <input type="hidden" name="childrenPrice[]" id="childrenPrice">
                                </div>
                            </div>

                        </li> -->
                    </ul>

                    <!-- <div class="item_option" style="display: none">
                        <div class="opt_list">
                            <strong class="label">옵션선택</strong>

                            <div class="opt_select_wrap">
                                <div class="opt_select disabled">
                                    <select name="moption" id="moption" onchange="sel_moption(this.value);">
                                        <option value="">선택</option>
                                        <?php foreach ($moption as $op) { ?>
                                            <option value="<?= $op['code_idx'] ?>"><?= $op['moption_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="opt_select disabled sel_option" id="sel_option">
                                    <select name="option" id="option" onchange="sel_option(this.value);">";
                                        <option value="">옵션 선택</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="option_list_" id="option_list_" style="margin-top: 20px">
                        <ul class="select_peo option_list_" id="option_list_">

                        </ul>
                    </div> -->
                </div>

                <div class="total_paymemt payment">
                    <p class="money">
                        <span style="margin-right:50px;">
                            <strong>합계</strong>
                        </span>
                        <strong>
                            <span id="total_sum" class="total_sum">0</span> 원
                        </strong>
                    </p>
                </div>
                <h3 class="title-r label">약관동의</h3>
                <div class="item-info-check item_check_term_all_">
                    <label for="fullagreement">전체동의</label>
                    <input type="hidden" value="N" id="fullagreement">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="">이용약관 동의(필수)</label>
                    <button type="button" data-type="1" class="view-policy">[보기]</button>
                    <input type="hidden" value="N" id="terms">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="">개인정보 처리방침(필수)</label>
                    <button type="button" data-type="2" class="view-policy">[보기]</button>
                    <input type="hidden" value="N" id="policy">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="">개인정보 제3자 제공 및 국외 이전 동의(필수)</label>
                    <button type="button" data-type="3" class="view-policy">[보기]</button>
                    <input type="hidden" value="N" id="information">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="guidelines">여행안전수칙 동의(필수)</label>
                    <button type="button" data-type="4" class="view-policy">[보기]</button>
                    <input type="hidden" value="N" id="guidelines">
                </div>
                <div class="nav_btn_wrap">
                    <?php if ($data_['product_status'] == 'sale'): ?>
                        <div data-href="/product-spa/product-booking/8386">
                            <button type="button" class="btn-point" onclick="order_it();">상품 예약하기</button>
                        </div>
                    <?php endif; ?>
                    <!-- <div class="flex">
                        <button type="button" class="btn-default cart"
                                onclick="location='#'">장바구니에 담기
                        </button>
                    </div> -->
                    <div class="flex">
                        <button type="button" class="btn-default"
                                onclick="location='/qna/write'">상담 문의하기
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="popup_wrap place_pop reservation_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>약관동의</h2>
                    </div>
                </div>
                <div class="popup_place__body">
                    <div id="policyContent"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>
<script>
    $(".view-policy").on("click", function (event) {
        event.stopPropagation();
        let type = $(this).data("type");
        if(type == 1) {
            $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[1]["policy_contents"])?>`);
        }else if(type == 2) {
            $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[0]["policy_contents"])?>`);
        }else if(type == 3) {
            $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[2]["policy_contents"])?>`);
        }else {
            $(".reservation_pop #policyContent").html(`<?=viewSQ($reservaion_policy[3]["policy_contents"])?>`);
        }

        let title = $(this).closest(".item-info-check").find("label").text().trim();

        $(".reservation_pop .popup_place__head__ttl h2").text(title);
        $(".reservation_pop").show();
    });

    function closePopup() {
        $(".popup_wrap").hide();
        // $(".dim").hide();
    }

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

    

    function order_it() {
        $("#ajax_loader").removeClass("display-none");

        /* Collect values for validation */
        let fullagreement = $("#fullagreement").val().trim();
        let terms = $("#terms").val().trim();
        let policy = $("#policy").val().trim();
        let information = $("#information").val().trim();
        let guidelines = $("#guidelines").val().trim();
        let time_line = $("#hours").val() + ":" + $("#minutes").val();

        $("#time_line").val(time_line);

        /* Check for agreement validation */
        if ([fullagreement, terms, policy, information, guidelines].includes("N")) {
            alert("모든 약관에 동의해야 합니다.");
            return false;
        }

        // Check if day_ is provided
        let day_ = $('#day_').val().trim();
        if (day_ === "") {
            alert("등록 날짜를 선택하세요.");
            return false;
        }

        let $adultQty = 0;
        let $childrenQty = 0;

        $('.qty_adults_select_').each(function () {
            let itm = $(this).val().trim();
            $adultQty += Number(itm);
        })

        $('.qty_children_select_').each(function () {
            let itm = $(this).val().trim();
            $childrenQty += Number(itm);
        })

        if ($adultQty === 0 && $childrenQty === 0) {
            alert("성인 수를 입력해주세요.");
            return false;
        }

        <?php
            if (empty(session()->get("member")["id"])) {
        ?>
            showOrHideLoginItem();
            return false;
        <?php
            }
        ?>

        var feeVal = "";
		// 각각의 input 태그에 대해 data-* 값을 가져오기
		$('input[name="mem_cnt2[]"]').each(function () {
			// 현재 input 태그
			var $input = $(this);

			// data- 값들 가져오기
			var type    = $input.data('type');      // 성인, 아동구분
			var idx     = $input.closest(".spa_option_detail").data('idx');       // 상품 IDX
			var op_name = $input.closest(".spa_option_detail").data('op_name'); // 상품명
			var price   = $input.data('price');     // 금액
		    var cnt     = $input.val();             // 인원수
			
			if(cnt > 0) {
                if(feeVal == "") {
                    feeVal = type+':'+idx+':'+price+':'+op_name+':'+price+':'+cnt;
                } else {
                    feeVal += '|'+type+':'+idx+':'+price+':'+op_name+':'+price+':'+cnt;
                }
            }
		});


		let optionQty = $("input[name='option_qty[]']").map(function() {
			return $(this).val();
		}).get();

		let optionIdx = $("input[name='option_idx[]']").map(function() {
			return $(this).val();
		}).get();

		let optionName = $("input[name='option_name[]']").map(function() {
			return $(this).val();
		}).get();

		let optionPrice = $("input[name='option_price[]']").map(function() {
			return $(this).val();
		}).get();

		let optionTot = $("input[name='option_tot[]']").map(function() {
			return $(this).val();
		}).get();

		let optionCnt = $("input[name='option_cnt[]']").map(function() {
			return $(this).val();
		}).get();
 
		if(optionQty > 0) {
		   let bath = '<?=$baht_thai_header?>';	
		   let option_won  = optionPrice;	
		   let option_bath = parseInt(optionPrice / bath);	
		   feeVal += '|option:'+option_won+':'+option_bath+':'+optionPrice+':'+optionName+':'+optionPrice+':'+optionQty;
	    }
		
alert('feeVal- '+feeVal);

alert('optionQty- '+optionQty);
alert('idx- '+optionIdx);
alert('name- '+optionName);
alert('price- '+optionPrice);
alert('tot- '+optionTot);
alert('cnt- '+optionCnt);
		
		
		$("#feeVal").val(feeVal);

        /* Form submission setup */
        let url = '<?= route_to('api.product.processBooking') ?>';
        let formData = new FormData($('#frm')[0]);

        const currentUrl = window.location.href;
        const pathName = window.location.pathname;

        let array_restaurant = [
            '/product-restaurant/restaurant-detail',
        ]
        let array_ticket = [
            '/ticket/ticket-detail/',
        ]
        let array_spa = [
            '/product-spa/spa-details/',
        ]

        /* AJAX request */
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#ajax_loader").addClass("display-none");
                if (response.result) {
                    if (array_restaurant.some(route => pathName.startsWith(route))) {
                        window.location.href = '/product-restaurant/restaurant-booking';
                    }

                    if (array_spa.some(route => pathName.startsWith(route))) {
                        window.location.href = '/product-spa/product-booking';
                    }

                    if (array_ticket.some(route => pathName.startsWith(route))) {
                        window.location.href = '/ticket/ticket-booking';
                    }
                } else {
                    alert(response.message);
                    window.location.href = '/member/login';
                }
            },
            error: function (request, status, error) {
                console.error("Error:", request, status, error);
                alert("오류 발생: " + request.responseText || "알 수 없는 오류");
                $("#ajax_loader").removeClass("display-none");
            }
        });
    }

</script>