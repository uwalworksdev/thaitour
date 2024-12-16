<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <div class="content-sub-product-hotel cart-item-list">
        <div class="body_inner">
            <div class="sub-hotel-navigation-container">
                <div class="navigation-container-prev">
                    <img class="only_web" src="/uploads/icons/icon_home.png" alt="icon_home">
                    <img class="only_mo cus-size-home" src="/uploads/icons/icon_home_mo.png" alt="icon_home">
                    <img class="only_web" src="/uploads/icons/arrow_right.png" alt="arrow_right">
                    <img class="only_mo cus-size-arrow" src="/uploads/icons/arrow_right_mo.png" alt="arrow_right">
                    <span>장바구니</span>
                </div>
            </div>
            <h3 class="title-cart">장바구니</h3>
            <div class="cart-item-list-container">
                <div class="cart-left">
                    <div class="header-cart">
                        <div class="checkbox-group form-group">
                            <input type="checkbox" id="check_all">
                            <label class="text-gray" for="check_all">전체선택</label>
                        </div>
                        <span>삭제</span>
                    </div>
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group only_web">
                            <input type="checkbox" id="group_golf" >
                            <label class="font-bold" for="group_golf">골프 :<span class="text-red"> <?=$golf_cnt?></span>
                            </label>
                        </div>
                        <div class="checkbox-group-2 form-group only_mo">
                            <input type="checkbox" id="group_golf_mo">
                            <label class="font-bold" for="group_1_mo">골프 :<span class="text-red"> <?=$golf_cnt?></span>
                            </label>
                        </div>
                        <table class="table-container only_web">
                            <thead>
                            <tr class="table-header">
                                <th>
                                    <span>상품</span>
                                </th>
                                <th>금액</th>
                                <th>옵션금액</th>
                                <th>결제예정금액</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php $currentOrderIdx = null;?>
							<?php foreach ($golf_result as $item): ?>
                            <tr>
					            <?php if ($currentOrderIdx !== $item['order_idx']) : ?>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <!--p class="product-desc text-gray"><?=$item['option_name']?></p-->
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_1_item1" class="chkGolf">
                                            <label for="group_1_item1"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
								<?php 
									$currentOrderIdx = $item['order_idx'];
								  endif; 
								?>
							<tr>
                                <td><?=$item['option_name']?> / <?=$item['option_cnt']?> EA / <?=number_format($item['option_tot'])?> 원</td> 
                                <td class="price" colspan="3"></td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="table-container custom-mo only_mo">
						    <?php foreach ($result as $item): ?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/uploads/sub/cart_test_img_01_mo.png" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_1_mo_item_1" checked>
                                            <label class="font-bold" for="group_1_mo_item_1"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            샹그릴라 호텔 방콕 (차오프라야 강)
                                        </h3>
                                        <div class="time-date-p">
                                            2024.08.10(토)
                                        </div>
                                        <p class="des-p">
                                            디럭스 연박 프로모션 더블(2룸) /조식포함 성인 4 / 아동 2
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span>1,467,360 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">할인금액</span>
                                        <span>0원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span>1,230,000 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="cart-left only_mo">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_2_mo" checked>
                            <label class="font-bold" for="group_2_mo">투어 :<span class="text-red"> <?=$tour_cnt?></span>
                            </label>
                        </div>
                        <table class="table-container only_web">
                            <thead>
                            <tr class="table-header">
                                <th>
                                    <span>상품...</span>
                                </th>
                                <th>금액</th>
                                <th>옵션금액</th>
                                <th>결제예정금액</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/uploads/sub/cart_test_img_03.png" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name">샹그릴라 호텔 방콕 (차오프라야 강)</div>
                                            <div class="product-date">2024.08.10(토)</div>
                                            <p class="product-desc text-gray">디럭스 연박 프로모션 더블(2룸) /조식포함<br>
                                                성인 4 / 아동 2</p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_2_mo_item1">
                                            <label for="group_2_mo_item1"></label>
                                        </div>
                                    </div>
                                </td>
                                <td class="price">1,467,360 원</td>
                                <td class="discount">0 원</td>
                                <td class="total">1,230,000 원</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="table-container custom-mo only_mo">
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/uploads/sub/cart_test_img_03_mo.png" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_2_mo_item2" checked>
                                            <label class="font-bold" for="group_2_mo_item2"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            샹그릴라 호텔 방콕 (차오프라야 강)
                                        </h3>
                                        <div class="time-date-p">
                                            2024.08.10(토)
                                        </div>
                                        <p class="des-p">
                                            디럭스 연박 프로모션 더블(2룸) /조식포함 성인 4 / 아동 2
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span>1,467,360 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">할인금액</span>
                                        <span>0원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span>1,230,000 원</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart-right" id="cart-right" style="display:none;">
                    <h3 class="title-cr">선택상품 : 3건</h3>
                    <div class="item-info-cr">
                        <span>예상 합계금액</span>
                        <span>1,506,360 원</span>
                    </div>
                    <div class="item-info-cr">
                        <span>할일금액</span>
                        <span>0 원</span>
                    </div>
                    <div class="item-info-total-cr">
                        <span>총 결제금액 </span>
                        <span>1,085400원</span>
                    </div>
                    <p class="info-description-p">
                        · 상품을 장바구니에 넣은 것만으로는 가능여부<br>
                        확인이나 예약이 되지 않으며 고객님의<br>
                        장바구니에 담긴 내용은 관리자도 알 수 없습니다.<br>
                        · 예약을 접수해주시면<br>
                        "마이페이지 → 나의 예약현황" 메뉴에서<br>
                        확인하실 수 있습니다.
                    </p>
                    <button type="button" onclick="fn_checkout();" class="btn-cart">예약하기</button>
                </div>
            </div>
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_tours">
                            <label class="font-bold" for="group_tours">투어 :<span class="text-red"> <?=$tours_cnt?></span>
                            </label>
                        </div>
                        <table class="table-container">
                            <thead>
                            <tr class="table-header">
                                <th>
                                    <span>상품</span>
                                </th>
                                <th>금액</th>
                                <th>옵션금액</th>
                                <th>결제예정금액</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php $currentOrderIdx = null;?>
							<?php $i = 0; ?>
							<?php foreach ($tours_result as $item): ?>
							<?php $i++;?>
                            <tr>
					            <?php if ($currentOrderIdx !== $item['order_idx']) : ?>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <!--p class="product-desc text-gray"><?=$item['option_name']?></p-->
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_2_item<?=$i?>" class="chkTours">
                                            <label for="group_2_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
								<?php 
									$currentOrderIdx = $item['order_idx'];
								  endif; 
								?>
							<tr>
                                <td><?=$item['option_name']?> / <?=$item['option_cnt']?> EA / <?=number_format($item['option_tot'])?> 원</td> 
                                <td class="price" colspan="3"></td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

			<!-- 스파 START -->
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_spa">
                            <label class="font-bold" for="group_spa">스파 :<span class="text-red"> <?=$spa_cnt?></span>
                            </label>
                        </div>
                        <table class="table-container">
                            <thead>
                            <tr class="table-header">
                                <th>
                                    <span>상품</span>
                                </th>
                                <th>금액</th>
                                <th>옵션금액</th>
                                <th>결제예정금액</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php $currentOrderIdx = null;?>
							<?php $i = 0; ?>
							<?php foreach ($spa_result as $item): ?>
							<?php $i++; ?>
                            <tr>
					            <?php if ($currentOrderIdx !== $item['order_idx']) : ?>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <!--p class="product-desc text-gray"><?=$item['option_name']?></p-->
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_3_item<?=$i?>" class="chkspa">
                                            <label for="group_3_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
								<?php 
									$currentOrderIdx = $item['order_idx'];
								  endif; 
								?>
							<tr>
                                <td><?=$item['option_name']?> / <?=$item['option_cnt']?> EA / <?=number_format($item['option_tot'])?> 원</td> 
                                <td class="price" colspan="3"></td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<!-- 스파 END -->


			<!-- 쇼ㆍ입장권 START -->
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_ticket">
                            <label class="font-bold" for="group_ticket">쇼ㆍ입장권 :<span class="text-red"> <?=$ticket_cnt?></span>
                            </label>
                        </div>
                        <table class="table-container">
                            <thead>
                            <tr class="table-header">
                                <th>
                                    <span>상품</span>
                                </th>
                                <th>금액</th>
                                <th>옵션금액</th>
                                <th>결제예정금액</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php $currentOrderIdx = null;?>
							<?php $i = 0; ?>
							<?php foreach ($ticket_result as $item): ?>
							<?php $i++; ?>
                            <tr>
					            <?php if ($currentOrderIdx !== $item['order_idx']) : ?>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <!--p class="product-desc text-gray"><?=$item['option_name']?></p-->
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_4_item<?=$i?>" class="chkTicket">
                                            <label for="group_4_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
								<?php 
									$currentOrderIdx = $item['order_idx'];
								  endif; 
								?>
							<tr>
                                <td><?=$item['option_name']?> / <?=$item['option_cnt']?> EA / <?=number_format($item['option_tot'])?> 원</td> 
                                <td class="price" colspan="3"></td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<!-- 쇼ㆍ입장권 END -->

        </div>
    </div>

	<script>
		$("#group_golf").on("change", function() {
			if ($(this).prop("checked")) {
				alert("골프 체크박스가 체크되었습니다.");
			} else {
				alert("골프 체크박스가 체크되지 않았습니다.");
			}
		});
	</script>

    <script>
        $(document).ready(function () {

            // Check or uncheck all checkboxes when "check_all" is clicked
            $('#check_all').on('change', function () {
                var isChecked = $(this).is(':checked');

                // Check/uncheck all checkboxes within both desktop and mobile groups
                $('.checkbox-group-2 input[type="checkbox"], .form-group-2 input[type="checkbox"]').prop('checked', isChecked);
                $('input[id^="group_1_mo_item"]').prop('checked', isChecked); // For mobile items
            });

            // Check or uncheck all items within a desktop group when the group checkbox is clicked
            $('input[id^="group_"]').on('change', function () {
                var groupId = $(this).attr('id');
                var isChecked = $(this).is(':checked');

                // Check/uncheck all items within the specific desktop group
                $('input[id^="' + groupId + '_item"]').prop('checked', isChecked);
            });

            // Check or uncheck all items within a mobile group when the mobile group checkbox is clicked
            $('input[id^="group_1_mo"]').on('change', function () {
                var isChecked = $(this).is(':checked');

                // Check/uncheck all items within the specific mobile group
                $('input[id^="group_1_mo_item"]').prop('checked', isChecked);
            });

            // Logic to uncheck "check_all" if any individual group or item is unchecked (both desktop and mobile)
            $('input[type="checkbox"]').on('change', function () {
                if (!$(this).is(':checked')) {
                    $('#check_all').prop('checked', false);
                }

                // If all desktop and mobile groups and items are checked, check "check_all"
                var totalCheckboxes = $('.checkbox-group-2 input[type="checkbox"]').length +
                    $('.form-group-2 input[type="checkbox"]').length +
                    $('input[id^="group_1_mo_item"]').length;
                var totalChecked = $('.checkbox-group-2 input[type="checkbox"]:checked').length +
                    $('.form-group-2 input[type="checkbox"]:checked').length +
                    $('input[id^="group_1_mo_item"]:checked').length;

                if (totalChecked === totalCheckboxes) {
                    $('#check_all').prop('checked', true);
                }
            });

            // Default: Check all group items when the group checkbox is checked by default on page load (for both desktop and mobile)
            $('input[id^="group_"], input[id^="group_1_mo"]').each(function () {
                var groupId = $(this).attr('id');
                var isChecked = $(this).is(':checked');

                if (isChecked) {
                    // Automatically check the associated group items if the group checkbox is checked by default
                    $('input[id^="' + groupId + '_item"]').prop('checked', true);
                }
            });
        });

        function fn_checkout() {
            window.location.href = `/checkout/show`;
        }
    </script>
<?php $this->endSection(); ?>