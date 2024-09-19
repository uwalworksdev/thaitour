<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<div class="content-sub-product-hotel cart-item-list">
    <div class="body_inner">
        <div class="sub-hotel-navigation-container">
            <div class="navigation-container-prev">
                <img src="/uploads/icons/icon_home.png" alt="icon_home">
                <img src="/uploads/icons/arrow_right.png" alt="arrow_right">
                <span>장바구니</span>
            </div>
        </div>
        <h3 class="title-cart">장바구니</h3>
        <div class="cart-item-list-container">
            <div class="cart-left">
                <div class="header-cart">
                    <div class="checkbox-group form-group">
                        <input type="checkbox" id="cart1_sub">
                        <label class="text-gray" for="cart1_sub">전체선택</label>
                    </div>
                    <span>삭제</span>
                </div>
                <div class="main-cart">
                    <div class="checkbox-group-2 form-group">
                        <input type="checkbox" id="cart2" checked>
                        <label class="font-bold" for="cart2">골프 :<span class="text-red"> 3</span>
                        </label>
                    </div>
                    <table class="table-container">
                        <thead>
                            <tr class="table-header">
                                <th>
                                    <div class="form-group-2 cus-checkbox-th">
                                        <input type="checkbox" id="table-checkbox">
                                        <label for="table-checkbox"></label>
                                    </div>
                                    <span>상품</span>
                                </th>
                                <th>금액</th>
                                <th>할인금액</th>
                                <th>결제예정금액</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/uploads/sub/cart_test_img_01.png" alt="cart_test_img_01">
                                        <div class="product-details">
                                            <div class="product-name">샹그릴라 호텔 방콕 (차오프라야 강)</div>
                                            <div class="product-date">2024.08.10(토)</div>
                                            <p class="product-desc text-gray">디럭스 연박 프로모션 더블(2룸) /조식포함<br>
                                            성인 4 / 아동 2</p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="table-checkbox1_">
                                            <label for="table-checkbox1_"></label>
                                        </div>
                                    </div>
                                </td>
                                <td class="price">1,467,360 원</td>
                                <td class="discount">0 원</td>
                                <td class="total">1,230,000 원</td>
                            </tr>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/uploads/sub/cart_test_img_02.png" alt="cart_test_img_02">
                                        <div class="product-details">
                                            <div class="product-name">아난타라 시암 방콕 호텔</div>
                                            <div class="product-date">2024.08.10(토)</div>
                                            <div class="product-desc text-gray">54홀 골프 패키지1(54 홀 라운딩 + 갤러리아12<br>
2인 1실 + 전일차량<br>
성인 4 / 아동 2</div>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="table-checkbox2">
                                            <label for="table-checkbox2"></label>
                                        </div>
                                    </div>
                                </td>
                                <td class="price">1,467,360 원</td>
                                <td class="discount">0 원</td>
                                <td class="total">1,230,000 원</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="cart-right">
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
                <button class="btn-cart">예약하기</button>
            </div>
        </div>
        <div class="cart-item-list-container mt-40">
            <div class="cart-left">
                <div class="header-cart">
                    <div class="checkbox-group form-group">
                        <input type="checkbox" id="cart1">
                        <label class="text-gray" for="cart1">전체선택</label>
                    </div>
                    <span>삭제</span>
                </div>
                <div class="main-cart">
                    <div class="checkbox-group-2 form-group">
                        <input type="checkbox" id="cart2_sub">
                        <label class="font-bold" for="cart2_sub">골프 :<span class="text-red"> 1</span>
                        </label>
                    </div>
                    <table class="table-container">
                        <thead>
                            <tr class="table-header">
                                <th>
                                    <div class="form-group-2 cus-checkbox-th">
                                        <input type="checkbox" id="table-checkbox_sub">
                                        <label for="table-checkbox_sub"></label>
                                    </div>
                                    <span>상품</span>
                                </th>
                                <th>금액</th>
                                <th>할인금액</th>
                                <th>결제예정금액</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="custom-td-product-info">
                                    <div class="product-info">
                                        <img src="/uploads/sub/cart_test_img_03.png" alt="cart_test_img_03">
                                        <div class="product-details">
                                            <div class="product-name">샹그릴라 호텔 방콕 (차오프라야 강)</div>
                                            <div class="product-date">2024.08.10(토)</div>
                                            <p class="product-desc text-gray">디럭스 연박 프로모션 더블(2룸) /조식포함<br>
                                            성인 4 / 아동 2</p>
                                        </div>
                                        <div class="form-group-2 cus-checkbox-td">
                                            <input type="checkbox" id="table-checkbox1">
                                            <label for="table-checkbox1"></label>
                                        </div>
                                    </div>
                                </td>
                                <td class="price">1,467,360 원</td>
                                <td class="discount">0 원</td>
                                <td class="total">1,230,000 원</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endSection(); ?>