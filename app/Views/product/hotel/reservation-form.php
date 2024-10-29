<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
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
                        <div class="card-left">
                            <h3 class="title-main-c">
                                투숙객 정보
                            </h3>
                            <p class="title-sub-below">투숙객 이름은 체크인 시 제시할 유효한 신분증 이름과 정확히 일치해야 합니다.</p>
                            <?php
                                $number_room = intval($number_room);
                                for($i = 1; $i <= $number_room; $i++){
                            ?>
                                <h3 class="title-sub-c mt-30">객실<?=$i?></h3>
                                <div class="form-container" data-group="group<?=$i?>">
                                    <div class="con-form mb-40">
                                        <div class="parent-form-group">
                                            <div class="form-group">
                                                <input type="hidden" name="order_num_room[]" value="group<?=$i?>"/>
                                                <label for="first-name-1">영문 이름(First Name) *</label>
                                                <input type="text" id="first-name-1" name="order_first_name[]" placeholder="영어로 작성해주세요." />
                                            </div>
                                            <div class="form-group">
                                                <label for="last-name-1">영문 성(Last Name) *</label>
                                                <input type="text" id="last-name-1" name="order_last_name[]" placeholder="영어로 작성해주세요." />
                                            </div>
                                        </div>
    
                                        <div class="button-action-con">
                                            <div class="conn-icon add-item" data-group="group<?=$i?>">
                                                <img class="only_web" src="/uploads/icons/add_item_icon.png" alt="add_item_icon">
                                                <img class="only_mo" src="/uploads/icons/add_item_icon_mo.png" alt="add_item_icon">
                                                <span>투숙객 추가</span>
                                            </div>
                                            <div class="conn-icon remove-item" data-group="group<?=$i?>">
                                                <img class="only_web" src="/uploads/icons/remove-item_icon.png" alt="remove_item_icon">
                                                <img class="only_mo" src="/uploads/icons/remove-item_icon_mo.png" alt="add_item_icon">
                                                <span>투숙객 삭제</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
    
                        </div>
                        <div class="card-left2">
                            <h3 class="title-main-c">
                                별도 요청
                            </h3>
                            <p class="title-sub-below">숙소는 최선을 다해 요청 사항을 제공해 드릴 수 있도록 최선을 다하겠습니다. 다만, 사정에 따라 제공 여부가 보장되지 않을 수 있습니다.</p>
                            <div class="form-group cus-form-group">
                                <textarea id="extra-requests" name="order_memo" placeholder="여기에 요청 사항을 입력하세요(선택사항)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card-right">
                            <?php
                                if(!empty($hotel['ufile1'])){
                                    $img = "/data/hotel/" . $hotel['ufile1'];
                                }else{
                                    $img = "";
                                }
                            ?>
                            <img src="<?=$img?>" alt="<?=$hotel['rfile1']?>">
                            <div class="below-right">
                                <h3 class="title-r"><?=$hotel["product_name"]?></h3>
                                <p class="title-sub-r text-gray"><?=$hotel["addrs"]?></p>
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
                                <span>객실 <?=$number_room?>개 X <?=$number_day?>박</span>
                                <span class="font-bold"><?=number_format($last_price)?>원</span>
                            </div>
                            <div class="item-info-r item-info-r-border-b">
                                <span>세금&서비스비용</span>
                                <span class="font-bold"><?=number_format($extra_cost)?>원</span>
                            </div>
                            <div class="item-info-r font-bold-cus">
                                <span>합계</span>
                                <span><?=number_format($order_price)?>원</span>
                            </div>
                            <p class="below-des-price">
                                · 체크인하시려면 3일 전에 숙소로 연락해 주세요<br>· 선택하신 객실 유형의 체크인 시간은 14:00~24:00 사이,
                                체크아웃 시간은 06:00~12:00입니다.<br>· 온수 (지정시간 제공)
                            </p>
                            <h3 class="title-r">약관동의</h3>
                            <div class="item-info-check-first item-clause-all">
                                <span>전체동의</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="item-info-check item-clause-item">
                                <span>이용약관 동의(필수)</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="item-info-check item-clause-item">
                                <span>개인정보 처리방침(필수)</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <div class="item-info-check item-clause-item">
                                <span>개인정보 처리방침(필수)</span>
                                <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                            </div>
                            <button type="button" class="btn-order">예약하기</button>
                            <!-- onclick="location.href='/product/completed-order'" -->
                        </div>
                    </div>
                </div>
                <input type="hidden" name="product_idx" id="product_idx" value="<?=$hotel["product_idx"]?>">
                <input type="hidden" name="room_op_idx" id="room_op_idx" value="<?=$room_op_idx?>">
                <input type="hidden" name="use_coupon_idx" id="use_coupon_idx" value="<?=$use_coupon_idx?>">
                <input type="hidden" name="used_coupon_money" id="used_coupon_money" value="<?=$used_coupon_money?>">
                <input type="hidden" name="last_price" id="last_price" value="<?=$last_price?>">
                <input type="hidden" name="order_price" id="order_price" value="<?=$order_price?>">
                <input type="hidden" name="number_room" id="number_room" value="<?=$number_room?>">
                <input type="hidden" name="number_day" id="number_day" value="<?=$number_day?>">
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
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
                onSelect: function(dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    $(this).val(formatDate(date));
                }
            });

            $('#checkin').val(formatDate('2024/07/09'));
            $('#checkout').val(formatDate('2024/07/10'));

            $('.tab_box_element_').on('click', function() {

                $('.tab_box_element_').removeClass('tab_active_');

                $(this).addClass('tab_active_');

                const tabId = $(this).attr('rel');
                $('.tab_content').hide();
                $('#' + tabId).show();
            });

            // add, remove element
            var guestCounter = {};

            $(".form-container").each(function(){
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
            $('.add-item').on('click', function() {
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
            $('.remove-item').on('click', function() {
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

            $(".item-clause-all").click(function() {
                if ($(this).hasClass("click")) {
                    $(this).removeClass("click");
                    $('.item-clause-item').each(function() {
                        $(this).removeClass("acti");
                        $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                    })
                } else {
                    $(this).addClass("click");
                    $('.item-clause-item').each(function() {
                        $(this).addClass("acti");
                        $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
                    })
                }
            });

            $(".item-clause-item").click(function() {
                if ($(this).hasClass("acti")) {
                    $(this).removeClass("acti");
                    $(this).find("img").attr("src", "/uploads/icons/form_check_icon.png");
                } else {
                    $(this).addClass("acti");
                    $(this).find("img").attr("src", "/images/btn/clause-check-black.png");
                }

                var allHaveActi = true;

                $('.item-clause-item').each(function() {
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

            $(".btn-order").click(function() {
                const frm = document.order_frm;
                let formData = new FormData(frm);
                if (!($(".item-clause-all").hasClass("click"))) {
                    alert("이용약관 동의(필수)를 선택하십시오.");
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
                        if(response.result == true){
                            alert(response.message);
                            window.location.href = '/product/completed-order';
                        }else{
                            alert(response.message);
                        }
                    }
                });

            });

            
        });
    </script>

    <?php $this->endSection(); ?>