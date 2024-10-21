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
            <div class="container-card">
                <div class="">
                    <div class="card-left">
                        <h3 class="title-main-c">
                            투숙객 정보
                        </h3>
                        <p class="title-sub-below">투숙객 이름은 체크인 시 제시할 유효한 신분증 이름과 정확히 일치해야 합니다.</p>
                        <h3 class="title-sub-c mt-30">인원1</h3>
                        <div class="form-container" data-group="group1">
                            <div class="con-form mb-40">
                                <div class="parent-form-group">
                                    <div class="form-group">
                                        <label for="first-name-1">영문 이름(First Name) *</label>
                                        <input type="text" id="first-name-1" placeholder="영어로 작성해주세요." />
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name-1">영문 성(Last Name) *</label>
                                        <input type="text" id="last-name-1" placeholder="영어로 작성해주세요." />
                                    </div>
                                </div>

                                <div class="button-action-con">
                                    <div class="conn-icon add-item" data-group="group1">
                                        <img src="/uploads/icons/add_item_icon.png" alt="add_item_icon">
                                        <span>투숙객 추가</span>
                                    </div>
                                    <div class="conn-icon remove-item" data-group="group1">
                                        <img src="/uploads/icons/remove-item_icon.png" alt="remove_item_icon">
                                        <span>투숙객 삭제</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="title-sub-c">인원2</h3>
                        <div class="form-container" data-group="group2">
                            <div class="con-form cus-border-bottom">
                                <div class="parent-form-group">
                                    <div class="form-group">
                                        <label for="first-name-2">영문 이름(First Name) *</label>
                                        <input type="text" id="first-name-2" placeholder="영어로 작성해주세요." />
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name-2">영문 성(Last Name) *</label>
                                        <input type="text" id="last-name-2" placeholder="영어로 작성해주세요." />
                                    </div>
                                </div>

                                <div class="button-action-con">
                                    <div class="conn-icon add-item" data-group="group2">
                                        <img src="/uploads/icons/add_item_icon.png" alt="add_item_icon">
                                        <span>투숙객 추가</span>
                                    </div>
                                    <div class="conn-icon remove-item" data-group="group2">
                                        <img src="/uploads/icons/remove-item_icon.png" alt="remove_item_icon">
                                        <span>투숙객 삭제</span>
                                    </div>
                                </div>
                            </div>

                            <h3 class="form-title title-sub-c">상세정보 입력</h3>
                            <div class="form-group form-cus-select mb-30">
                                <label for="passport-name2">이메일 주소*</label>
                                <div class="cus-select-group">
                                    <input type="text" id="" placeholder="이메일">
                                    <span>@</span>
                                    <select id="" class="select-width">
                                        <option value="01">선택해주세요.</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group mb-30">
                                <label for="pickup-location">휴대폰번호</label>
                                <input class="mb-10 w-375" type="text" id="pickup-location"
                                    placeholder="번호를 입력해주세요." />
                            </div>
                        </div>

                    </div>
                    <div class="card-left2">
                        <h3 class="title-main-c">
                            별도 요청
                        </h3>
                        <p class="title-sub-below">숙소는 최선을 다해 요청 사항을 제공해 드릴 수 있도록 최선을 다하겠습니다. 다만, 사정에 따라 제공 여부가 보장되지 않을 수 있습니다.</p>
                        <div class="form-group cus-form-group">
                            <textarea id="extra-requests" placeholder="여기에 요청 사항을 입력하세요(선택사항)"></textarea>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="card-right">
                        <img src="/uploads/sub/reservation-form.png" alt="reservation-form.png">
                        <div class="below-right">
                            <h3 class="title-r">더 콰르티어 호텔 프롬퐁 / 통로 방콕 바이컴패스 호스피탈리티</h3>
                            <p class="title-sub-r text-gray">413 Soi Sukhumvit 49, Watthana 10110,방콕, 태국</p>
                        </div>
                    </div>
                    <div class="card-right2">
                        <h3 class="title-r">
                            요금정보
                        </h3>
                        <div class="item-info-r">
                            <span>객실 9개 X 1박</span>
                            <span class="font-bold">1,085400원</span>
                        </div>
                        <div class="item-info-r item-info-r-border-b">
                            <span>세금&서비스비용</span>
                            <span class="font-bold">102,600원</span>
                        </div>
                        <div class="item-info-r font-bold-cus">
                            <span>합계</span>
                            <span>1,085400원</span>
                        </div>
                        <p class="below-des-price">
                            · 체크인하시려면 3일 전에 숙소로 연락해 주세요<br>· 선택하신 객실 유형의 체크인 시간은 14:00~24:00 사이,
                            체크아웃 시간은 06:00~12:00입니다.<br>· 온수 (지정시간 제공)
                        </p>
                        <h3 class="title-r">약관동의</h3>
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
                            <span>개인정보 처리방침(필수)</span>
                            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">
                        </div>
                        <button class="btn-order" onclick="location.href='/product/completed-order'">예약하기</button>
                    </div>
                </div>
            </div>
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

            var guestCounter = {
                group1: 1,
                group2: 1
            };

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
                    <label for="first-name-${group}-${guestCounter[group]}">영문 이름(First Name) *</label>
                    <input type="text" id="first-name-${group}-${guestCounter[group]}" placeholder="영어로 작성해주세요." />
                </div>
                <div class="form-group">
                    <label for="last-name-${group}-${guestCounter[group]}">영문 성(Last Name) *</label>
                    <input type="text" id="last-name-${group}-${guestCounter[group]}" placeholder="영어로 작성해주세요." />
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
        });
    </script>

    <?php $this->endSection(); ?>