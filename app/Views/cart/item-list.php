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
                        <span id="deleteBtn">삭제</span>

                    </div>

					<?php if($golf_cnt > 0) { ?>
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group only_web">
                            <input type="checkbox" id="group_golf" class="checkbox" data-value="">
                            <label class="font-bold" for="group_golf">골프 :<span class="text-red"> <?=$golf_cnt?></span>
                            </label>
                        </div>
                        <div class="checkbox-group-2 form-group only_mo">
                            <input type="checkbox" id="group_golf_mo" class="checkbox" data-value="">
                            <label class="font-bold" for="group_golf_mo">골프 :<span class="text-red"> <?=$golf_cnt?></span>
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
							<?php $i = 0;?>
							<?php foreach ($golf_result as $item): ?>
						    <?php $i++;?>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <p class="product-desc text-gray">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                            </p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_1_item<?=$i?>" class="chkGolf checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="group_1_item1"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="table-container custom-mo only_mo">
						    <?php $i = 0;?>
						    <?php foreach ($golf_result as $item): ?>
						    <?php $i++;?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_1_mo_item<?=$i?>" class="chkGolf checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label class="font-bold" for="group_1_mo_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            <?=$item['product_name']?>
                                        </h3>
                                        <div class="time-date-p">
                                            <?=$item['order_date']?>
                                        </div>
                                        <p class="des-p">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span><?=number_format($item['order_price']-$item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">옵션금액</span>
                                        <span><?=number_format($item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span><?=number_format($item['order_price'])?> 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
				<?php } ?>
                </div>

                <?php if($tours_cnt > 0) { ?>
                <div class="cart-left only_mo">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_tours_mo" class="checkbox" data-value="">
                            <label class="font-bold" for="group_tours_mo">투어 :<span class="text-red"> <?=$tours_cnt?></span>
                            </label>
                        </div>
                        <div class="table-container custom-mo only_mo">
						    <?php $i = 0;?>
						    <?php foreach ($tours_result as $item): ?>
						    <?php $i++;?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_2_mo_item<?=$i?>" class="chkTours checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label class="font-bold" for="group_2_mo_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            <?=$item['product_name']?>
                                        </h3>
                                        <div class="time-date-p">
                                            <?=$item['order_date']?>
                                        </div>
                                        <p class="des-p">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span><?=number_format($item['order_price']-$item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">옵션금액</span>
                                        <span><?=number_format($item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span><?=number_format($item['order_price'])?> 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- 호텔 S: -->
                <?php if($hotel_cnt > 0) { ?>
                <div class="cart-left only_mo">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_2_mo" class="checkbox" data-value="">
                            <label class="font-bold" for="group_2_mo">호텔 :<span class="text-red"> <?=$hotel_cnt?></span>
                            </label>
                        </div>
                        <div class="table-container custom-mo only_mo">
						    <?php $i = 0;?>
						    <?php foreach ($hotel_result as $item): ?>
							<?php $i++;?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_4_mo_item<?=$i?>" class="chkHotel checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label class="font-bold" for="group_4_mo_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            <?=$item['product_name']?>
                                        </h3>
                                        <div class="time-date-p">
                                            <?=$item['order_date']?>
                                        </div>
                                        <p class="des-p">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span><?=number_format($item['order_price']-$item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">옵션금액</span>
                                        <span><?=number_format($item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span><?=number_format($item['order_price'])?> 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>				
				<!-- 호텔 E; -->

                <!-- 스파 S: -->
                <?php if($spa_cnt > 0) { ?>
                <div class="cart-left only_mo">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_2_mo" class="checkbox" data-value="">
                            <label class="font-bold" for="group_2_mo">스파 :<span class="text-red"> <?=$hotel_cnt?></span>
                            </label>
                        </div>
                        <div class="table-container custom-mo only_mo">
						    <?php $i = 0;?>
						    <?php foreach ($spa_result as $item): ?>
							<?php $i++;?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_3_mo_item<?=$i?>" class="chkSpa checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label class="font-bold" for="group_3_mo_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            <?=$item['product_name']?>
                                        </h3>
                                        <div class="time-date-p">
                                            <?=$item['order_date']?>
                                        </div>
                                        <p class="des-p">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span><?=number_format($item['order_price']-$item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">옵션금액</span>
                                        <span><?=number_format($item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span><?=number_format($item['order_price'])?> 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>				
				<!-- 스파 E; -->

                <!-- 쇼ㆍ입장권 S: -->
                <?php if($ticket_cnt > 0) { ?>
                <div class="cart-left only_mo">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_ticket_mo" class="checkbox" data-value="">
                            <label class="font-bold" for="group_ticket_mo">쇼ㆍ입장권 :<span class="text-red"> <?=$ticket_cnt?></span>
                            </label>
                        </div>
                        <div class="table-container custom-mo only_mo">
						    <?php $i = 0;?>
						    <?php foreach ($ticket_result as $item): ?>
							<?php $i++;?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_5_mo_item<?=$i?>" class="chkTicket checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label class="font-bold" for="group_5_mo_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            <?=$item['product_name']?>
                                        </h3>
                                        <div class="time-date-p">
                                            <?=$item['order_date']?>
                                        </div>
                                        <p class="des-p">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span><?=number_format($item['order_price']-$item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">옵션금액</span>
                                        <span><?=number_format($item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span><?=number_format($item['order_price'])?> 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>				
				<!-- 쇼ㆍ입장권 E; -->


                <!-- 차량 S: -->
                <?php if($car_cnt > 0) { ?>
                <div class="cart-left only_mo">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_car_mo" class="checkbox" data-value="">
                            <label class="font-bold" for="group_car_mo">차량 :<span class="text-red"> <?=$car_cnt?></span>
                            </label>
                        </div>
                        <div class="table-container custom-mo only_mo">
						    <?php $i = 0;?>
						    <?php foreach ($car_result as $item): ?>
							<?php $i++;?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/data/cars/<?=$item['ufile1']?>" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_6_mo_item<?=$i?>" class="chkCar checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label class="font-bold" for="group_6_mo_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            <?=$item['product_name']?>
                                        </h3>
                                        <div class="time-date-p">
                                            <?=$item['order_date']?>
                                        </div>
                                        <p class="des-p">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span><?=number_format($item['order_price']-$item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">옵션금액</span>
                                        <span><?=number_format($item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span><?=number_format($item['order_price'])?> 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>				
				<!-- 차량 E; -->


                <!-- 가이드 S: -->
                <?php if($guides_cnt > 0) { ?>
                <div class="cart-left only_mo">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_guides_mo" class="checkbox" data-value="">
                            <label class="font-bold" for="group_guides_mo">가이드 :<span class="text-red"> <?=$guides_cnt?></span>
                            </label>
                        </div>
                        <div class="table-container custom-mo only_mo">
						    <?php $i = 0;?>
						    <?php foreach ($guides_result as $item): ?>
							<?php $i++;?>
                            <div class="item">
                                <div class="con-up">
                                    <div class="picture-con">
                                        <img src="/data/guides/<?=$item['ufile1']?>" alt="">
                                        <div class="checkbox-group-2 form-group form-table">
                                            <input type="checkbox" id="group_7_mo_item<?=$i?>" class="chkGuides checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label class="font-bold" for="group_7_mo_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                    <div class="text-right-p">
                                        <h3 class="title-p">
                                            <?=$item['product_name']?>
                                        </h3>
                                        <div class="time-date-p">
                                            <?=$item['order_date']?>
                                        </div>
                                        <p class="des-p">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                        </p>
                                    </div>
                                </div>
                                <div class="des-space-p">
                                    <div class="des-item">
                                        <span class="space-left">금액</span>
                                        <span><?=number_format($item['order_price']-$item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">옵션금액</span>
                                        <span><?=number_format($item['option_amt'])?> 원</span>
                                    </div>
                                    <div class="des-item">
                                        <span class="space-left">결제예정금액</span>
                                        <span><?=number_format($item['order_price'])?> 원</span>
                                    </div>
                                </div>
                            </div>
		                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>				
				<!-- 가이드 E; -->
				
                <div class="cart-right" id="cart-right" > 
                    <h3 class="title-cr">선택상품 : <span id="paymentCnt"></span> 건</h3>
                    <div class="item-info-cr">
                        <span>예상 합계금액</span>
                        <span><span class="paymentAmt"></span> 원</span>
                    </div>
                    <div class="item-info-cr">
                        <span></span>
                        <span></span>
                    </div>
                    <div class="item-info-total-cr">
                        <span>총 결제금액 </span>
                        <span><span class="paymentAmt"></span> 원</span>
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

            <?php if($tours_cnt > 0) { ?>
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_tours" class="checkbox" data-value="">
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
							<?php $i = 0; ?>
							<?php foreach ($tours_result as $item): ?>
							<?php $i++;?>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <p class="product-desc text-gray">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                            </p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_2_item<?=$i?>" class="chkTours checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="group_2_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>

			<!-- 호텔 START -->
            <?php if($hotel_cnt > 0) { ?>
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_hotel" class="checkbox" data-value="">
                            <label class="font-bold" for="group_hotel">호텔 :<span class="text-red"> <?=$hotel_cnt?></span>
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
							<?php $i = 0; ?>
							<?php foreach ($hotel_result as $item): ?>
							<?php $i++; ?>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <p class="product-desc text-gray">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                            </p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_4_item<?=$i?>" class="chkHotel checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="group_4_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<?php } ?>
			<!-- 호텔 END -->

			<!-- 스파 START -->
            <?php if($spa_cnt > 0) { ?>
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_spa" class="checkbox" data-value="">
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
							<?php $i = 0; ?>
							<?php foreach ($spa_result as $item): ?>
							<?php $i++; ?>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <p class="product-desc text-gray">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                            </p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_3_item<?=$i?>" class="chkSpa checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="group_3_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<?php } ?>
			<!-- 스파 END -->


			<!-- 쇼ㆍ입장권 START -->
            <?php if($ticket_cnt > 0) { ?>
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_ticket" class="checkbox" data-value="">
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
							<?php $i = 0; ?>
							<?php foreach ($ticket_result as $item): ?>
							<?php $i++; ?>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/product/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <p class="product-desc text-gray">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                            </p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_5_item<?=$i?>" class="chkTicket checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="group_5_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<?php } ?>
			<!-- 쇼ㆍ입장권 END -->



			<!-- 차량 START -->
            <?php if($car_cnt > 0) { ?>
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_car" class="checkbox" data-value="">
                            <label class="font-bold" for="group_car">차량 :<span class="text-red"> <?=$car_cnt?></span>
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
							<?php $i = 0; ?>
							<?php foreach ($car_result as $item): ?>
							<?php $i++; ?>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/cars/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <p class="product-desc text-gray">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                            </p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_6_item<?=$i?>" class="chkCar checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="group_6_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<?php } ?>
			<!-- 차량 END -->

			<!-- 가이드 START -->
            <?php if($guides_cnt > 0) { ?>
            <div class="cart-item-list-container mt-40 only_web">
                <div class="cart-left">
                    <div class="main-cart">
                        <div class="checkbox-group-2 form-group">
                            <input type="checkbox" id="group_guides" class="checkbox" data-value="">
                            <label class="font-bold" for="group_guides">가이드 :<span class="text-red"> <?=$guides_cnt?></span>
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
							<?php $i = 0; ?>
							<?php foreach ($guides_result as $item): ?>
							<?php $i++; ?>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/data/cars/<?=$item['ufile1']?>" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name"><?=$item['product_name']?></div>
                                            <div class="product-date"><?=$item['order_date']?></div>
                                            <p class="product-desc text-gray">
											<?php 
												if (!empty($item['options'])) {
													$options = explode('|', $item['options']);
													foreach ($options as $option) {
														$option_r = explode(":", esc($option));
														echo $option_r[0] ."/ ". $option_r[1] ." EA / ". number_format($option_r[2]) ." 원<br>";
													}
												}
											?>
                                            </p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="group_6_item<?=$i?>" class="chkCar checkbox" data-idx="<?=$item['order_idx']?>" data-value="<?=$item['order_no']?>">
                                            <label for="group_6_item<?=$i?>"></label>
                                        </div>
                                    </div>
                                <td class="price"><?=number_format($item['order_price']-$item['option_amt'])?> 원</td>
                                <td class="discount"><?=number_format($item['option_amt'])?> 원</td>
                                <td class="total"><?=number_format($item['order_price'])?> 원</td>
							</tr>
		                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<?php } ?>
			<!-- 가이드 END -->
			
        </div>
    </div>

    <form id="checkOut" action="/checkout/show" method="post">
	<input type="hidden" name="dataValue" id="dataValue" value="" >
	</form>

    <script>
        $(document).ready(function () {
            // 마우스를 올리면 커서가 포인터로 변경
            $('#deleteBtn').hover(
                function () {
                    $(this).css('cursor', 'pointer'); // 손가락 표시
                },
                function () {
                    $(this).css('cursor', 'default'); // 기본 커서로 복구
                }
            );
        });
    </script>

    <script>
        $(document).ready(function () {
            // 전체 선택 체크박스 이벤트
            $('#checkAll').click(function () {
                $('.checkItem').prop('checked', this.checked);
            });

            // 삭제 버튼 클릭 이벤트
            $('#deleteBtn').click(function () {
                let selected = [];

                // 선택된 항목 수집
                $('.checkbox:checked').each(function () {
                    selected.push($(this).data('idx'));
                });

                if (selected.length === 0) {
                    alert('삭제할 상품을 선택하세요.');
                    return;
                }

                // 확인 메시지
                if (!confirm('선택한 상품을 삭제하시겠습니까?')) {
                    return;
                }
 
                // AJAX 요청 (예시로 POST 방식 사용)
                $.ajax({
                    url: '/ajax/delete-carts', // 서버 URL
                    type: 'POST',
                    data: { ids: selected },
                    success: function (response) {
                        alert('삭제가 완료되었습니다.');
                        location.reload(); // 새로고침
                    },
                    error: function () {
                        alert('삭제 중 오류가 발생했습니다.');
                    }
                });
            });
        });
    </script>

    <script>
	function paymentShow(dataValue)
	{
		if(dataValue) {
            dataValue = dataValue.replace(/,+$/, "");
		    $("#dataValue").val(dataValue);

            $.ajax({
                url: "/ajax/cart_payment",
                type: "POST",
                data: {
                         "dataValue" : dataValue
                },
                success: function(res) {
                    var message = res.message;
                    var tot_amt = res.tot_amt;
                    var tot_cnt = res.tot_cnt;
					$("#paymentCnt").text(tot_cnt);
					$(".paymentAmt").text(tot_amt);
					//alert(message+' - '+tot_amt+' - '+tot_cnt);
    		        //$("#cart-right").show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // 서버 응답 내용 확인
                    alert('Error: ' + error);
                }
            });

        } else {
		   //$("#cart-right").hide();
		   $("#paymentCnt").text('0');
		   $(".paymentAmt").text('0');
        }
	}
	</script>

	<script>
		$("#group_golf, #group_golf_mo").on("change", function() {
			if ($(this).prop("checked")) {
				$(".chkGolf").prop("checked", true); // 다른 체크박스 모두 체크
				var dataValue = ""; 
				$(".checkbox:checked").each(function() {
					if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
				});
				paymentShow(dataValue);
			} else {
				$(".chkGolf").prop("checked", false);
				paymentShow(dataValue);
			}
		});

		$("#group_tours, #group_tours_mo").on("change", function() {
			if ($(this).prop("checked")) {
				$(".chkTours").prop("checked", true); // 다른 체크박스 모두 체크
				var dataValue = ""; 
				$(".checkbox:checked").each(function() {
					if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
				});
				paymentShow(dataValue);
			} else {
				$(".chkTours").prop("checked", false); // 다른 체크박스 모두 체크
				paymentShow(dataValue);
			}
		});

		$("#group_spa, #group_spa_mo").on("change", function() {
			if ($(this).prop("checked")) {
				$(".chkSpa").prop("checked", true); // 다른 체크박스 모두 체크
				var dataValue = ""; 
				$(".checkbox:checked").each(function() {
					if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
				});
				paymentShow(dataValue);
			} else {
				$(".chkSpa").prop("checked", false); // 다른 체크박스 모두 체크
				paymentShow(dataValue);
			}
		});

		$("#group_ticket, #group_ticket_mo").on("change", function() {
			if ($(this).prop("checked")) {
				$(".chkTicket").prop("checked", true); // 다른 체크박스 모두 체크
				var dataValue = ""; 
				$(".checkbox:checked").each(function() {
					if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
				});
				paymentShow(dataValue);
			} else {
				$(".chkTicket").prop("checked", false); // 다른 체크박스 모두 체크
				paymentShow(dataValue);
			}
		});

		$("#group_hotel, #group_hotel_mo").on("change", function() {
			if ($(this).prop("checked")) {
				$(".chkHotel").prop("checked", true); // 다른 체크박스 모두 체크
				var dataValue = ""; 
				$(".checkbox:checked").each(function() {
					if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
				});
				paymentShow(dataValue);
			} else {
				$(".chkHotel").prop("checked", false); // 다른 체크박스 모두 체크
				paymentShow(dataValue);
			}
		});

		$("#group_car, #group_car_mo").on("change", function() {
			if ($(this).prop("checked")) {
				$(".chkCar").prop("checked", true); // 다른 체크박스 모두 체크
				var dataValue = ""; 
				$(".checkbox:checked").each(function() {
					if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
				});
				paymentShow(dataValue);
			} else {
				$(".chkCar").prop("checked", false); // 다른 체크박스 모두 체크
				paymentShow(dataValue);
			}
		});

		$("#group_guides, #group_guides_mo").on("change", function() {
			if ($(this).prop("checked")) {
				$(".chkGuides").prop("checked", true); // 다른 체크박스 모두 체크
				var dataValue = ""; 
				$(".checkbox:checked").each(function() {
					if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
				});
				paymentShow(dataValue);
			} else {
				$(".chkGuides").prop("checked", false); // 다른 체크박스 모두 체크
				paymentShow(dataValue);
			}
		});
	</script>

	<script>
	$(document).ready(function () {
		$(".checkbox").on("change", function() {
			var dataValue = ""; 
			$(".checkbox:checked").each(function() {
				if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
			});
			paymentShow(dataValue);
		});
	});
	</script>

	<script>
        $(document).ready(function () {

            // Check or uncheck all checkboxes when "check_all" is clicked
            $('#check_all').on('change', function () {
				if ($(this).prop("checked")) {
					$(".checkbox").prop("checked", true); // 다른 체크박스 모두 체크
					var dataValue = ""; 
					$(".checkbox:checked").each(function() {
					    if($(this).data("value")) dataValue += $(this).data("value") +','; // 또는 $(this).attr("data-value");
					});
				    paymentShow(dataValue);
				} else {
					$(".checkbox").prop("checked", false);
				    paymentShow(dataValue);
				}
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
			$("#checkOut").submit();
            //window.location.href = `/checkout/show`;
        }
    </script>
<?php $this->endSection(); ?>