<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>


<style>
    .section6 .qa_ques {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 12px;
        font-size: 18px;
        font-weight: 500;
        margin-top: 30px;
    }

    .comment_box {
        border-top: 1px solid #dbdbdb;
        border-bottom: 1px solid #dbdbdb;
        margin-top: 25px;
    }

    .comment_box .item {
        padding: 24px 50px 24px 20px;
    }

    .comment_box .item+.item {
        border-top: 1px solid #f1f1f1;
    }


    .comment_box .item .info {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 20px;
    }

    .comment_box .item .info .eval {
        margin-left: auto;
    }


    .comment_box .item .info .time {
        font-size: 18px;
        font-weight: 400;
        color: #bbb;
    }


    .comment_box .item .info .name {
        font-size: 18px;
        font-weight: 600;
    }

    .comment_box .item .content {
        font-size: 18px;
    }

    .view_detail {
        padding-bottom: 100px;
    }

    .custom-golf-detail .golf-table tbody td {
        white-space: wrap;
        line-height: 1.4;
        overflow-wrap: break-word;
    }

    .comment_box .item .info .eval {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .comment_box .item .info .eval span {
        margin-left: 3px;
    }


    @media screen and (max-width: 850px) {
        .section6 .qa_ques {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1.8rem;
            font-size: 2.8rem;
            font-weight: 500;
            margin-top: 3.8rem;
        }

        .section6 .qa_ques .list_star img {
            width: 2.8rem;
        }

        .comment_box {
            border-top: 1px solid #dbdbdb;
            border-bottom: 1px solid #dbdbdb;
            margin-top: 3rem;
        }

        .comment_box .item {
            padding: 3rem 0 3rem 3rem;
        }

        .comment_box .item .info {
            display: flex;
            align-items: center;
            gap: 3rem;
            margin-bottom: 2.8rem;
        }

        .comment_box .item .info .name {
            font-size: 2.8rem;
            font-weight: 600;
        }

        .comment_box .item .info .time {
            font-size: 2.8rem;
            font-weight: 400;
            color: #bbb;
        }

        .comment_box .item .content {
            font-size: 2.8rem;
        }

        .content-sub-hotel-detail .main {
            width: unset;
        }

        .view_detail {
            padding-bottom: 12rem;
        }

        .comment_box .item .info .eval {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0px;
        }

        .comment_box .item .info .eval span {
            margin-left: 0.7rem;
        }

        .content-sub-hotel-detail .location-container {
            gap: 0.8rem;
            display: flex;
            align-items: flex-start;
            flex-direction: row;
            margin-bottom: 2rem;
            margin-top: 1rem;
        }

        .comment_box .item .info .eval img {
            width: 2.5rem;
        }
    }
</style>
<?php
$r_code = "travel_view";
?>
<div class="content-sub-hotel-detail custom-golf-detail view_detail">
    <div class="body_inner">
        <div>
            <form name="frm" id="frm" action="/product-golf/customer-form" class="section1">
                <div class="title-container">
                    <h2><?= $local_detail["product_name"] ?><span style="margin-left: 15px;"><?= $local_detail["product_name_en"] ?></span></h2>
                    <div class="list-icon">
                        <img src="/uploads/icons/print_icon.png" alt="print_icon" class="only_web">
                        <img src="/uploads/icons/print_icon_mo.png" alt="print_icon_mo" class="only_mo">
                        <img src="/uploads/icons/heart_icon.png" alt="heart_icon" class="only_web">
                        <img src="/uploads/icons/heart_icon_mo.png" alt="heart_icon_mo" class="only_mo">
                        <img src="/uploads/icons/share_icon.png" alt="share_icon" class="only_web">
                        <img src="/uploads/icons/share_icon_mo.png" alt="share_icon_mo" class="only_mo">
                    </div>
                </div>
                <div class="location-container">
                    <div class="location_conts">
                        <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                        <span class="text-gray"> <?= $local_detail["addrs"] ?> </span>
                    </div>
                </div>
            </form>
        </div>
        <?php

        if (!empty($local_detail['ufile1'])) {
            $i3 = 1;
        } else {
            $i3 = 0;
        }
        $i3 += count($img_list);
        ?>

        <div class="rating-container">
            <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
            <span><strong>4.7</strong></span>
            <span>이용자 리뷰<strong>(1)</strong></span>
        </div>
        <div class="hotel-image-container">
            <div class="hotel-image-container-1" style="">
                <img class="imageDetailMain_"
                    src="/data/product/<?= $local_detail['ufile1'] ?>"
                    alt="<?= $local_detail['product_name'] ?>"
                    onerror="this.src='/images/share/noimg.png'"
                    onclick="img_pops('<?= $local_detail['idx'] ?>')">
                <!-- <img src="/img/sub/v_d_1.png" alt="" onerror="this.src='/images/share/noimg.png'" onclick="img_pops('1916')"> -->
            </div>
            <div class="grid_2_2">
                <?php
                // $is_mobile = preg_match('/(android|iphone|ipad|ipod|mobile)/i', $_SERVER['HTTP_USER_AGENT']);
                // $loop_limit = $is_mobile ? 1 : 3;
                for ($j = 2; $j < 5; $j++) {
                ?>
                    <img onclick="img_pops('<?= $local_detail['idx'] ?>')"
                        class="grid_2_2_size imageDetailSup_ responsive-img"
                        src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>"
                        alt="<?= $local_detail['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                <?php } ?>
                <div class="grid_2_2_sub only_web"
                    onclick="img_pops('<?= $local_detail['idx'] ?>')"
                    style="position: relative; cursor: pointer;">
                    <img class="custom_button imageDetailSup_"
                        src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>"
                        alt="<?= $local_detail['product_name'] ?>"
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
                <div class="grid_2_2_sub only_mo"
                    onclick="img_pops('<?= $local_detail['idx'] ?>')"
                    style="position: relative; cursor: pointer;">
                    <img class="custom_button imageDetailSup_"
                        src="/data/product/<?= $img_list[1]['ufile'] ?>"
                        alt="<?= $local_detail['product_name'] ?>"
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
                <a class="short_link active" data-target="product_info" href="#product_info">기본정보</a>
                <a class="short_link" data-target="location" href="#location">위치정보</a>
                <a class="short_link" data-target="qna" href="#qna">이용자 리뷰(1개)</a>
            </div>
            <!-- <div class="btn-container">
                <a class="w-100" href="#!" data-target="#booking_area" onclick="handleShowBookingArea(this)">
                    <button type="button">
                        상품예약
                    </button>
                </a>
            </div> -->
        </div>
        <h3 class="title-size-24" id="product_info">기본정보</h3>
        <table class="golf-table" style="table-layout: fixed;">
            <colgroup>
                <col width="200px">
                <col width="*">
            </colgroup>
            <tbody class="text-gray">
                <tr>
                    <td>지역</td>
                    <td><?= $city_name ?>><?= $town_name ?>
                    </td>
                </tr>
                <tr>
                    <td>전화번호</td>
                    <td><?= viewSQ($local_detail["contact"]) ?></td>
                </tr>
                <tr>
                    <td>주소</td>
                    <td><?= viewSQ($local_detail["addrs"]) ?></td>
                </tr>
                <tr>
                    <td>홈페이지</td>
                    <td><?= viewSQ($local_detail["url"]) ?></td>
                </tr>
                <tr>
                    <td>찾아가는 법</td>
                    <td><?= viewSQ($local_detail["routes"]) ?></td>
                </tr>
                <tr>
                    <td>영업시간</td>
                    <td><?= viewSQ($local_detail["time_line"]) ?></td>
                </tr>
                <tr>
                    <td>정보</td>
                    <td><?= viewSQ($local_detail["product_contents"]) ?></td>
                </tr>
            </tbody>
        </table>
        <h3 class="title-size-24" id="location">위치정보</h3>
        <div id="map" style="width: 100%; height: 250px; position: relative;" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
            <div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
                <div class="leaflet-pane leaflet-tile-pane">
                    <div class="leaflet-layer " style="z-index: 1; opacity: 1;">
                        <div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 17; transform: translate3d(-953px, -185px, 0px) scale(2);"></div>
                        <div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(-953px, -185px, 0px) scale(1);"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203969/120926.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1328px, 126px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203970/120926.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1584px, 126px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203969/120927.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1328px, 382px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203970/120927.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1584px, 382px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203968/120926.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1072px, 126px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203971/120926.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1840px, 126px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203968/120927.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1072px, 382px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203971/120927.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1840px, 382px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203967/120926.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(816px, 126px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203972/120926.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(2096px, 126px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203967/120927.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(816px, 382px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://tile.openstreetmap.org/18/203972/120927.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(2096px, 382px, 0px); opacity: 1;"></div>
                    </div>
                </div>
                <div class="leaflet-pane leaflet-shadow-pane"><img src="https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png" class="leaflet-marker-shadow leaflet-zoom-animated" alt="" style="margin-left: -12px; margin-top: -41px; width: 41px; height: 41px; transform: translate3d(247px, 265px, 0px);"></div>
                <div class="leaflet-pane leaflet-overlay-pane"></div>
                <div class="leaflet-pane leaflet-marker-pane"><img src="https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -12px; margin-top: -41px; width: 25px; height: 41px; transform: translate3d(247px, 265px, 0px); z-index: 265;"></div>
                <div class="leaflet-pane leaflet-tooltip-pane"></div>
                <div class="leaflet-pane leaflet-popup-pane"></div>
                <div class="leaflet-proxy leaflet-zoom-animated" style="transform: translate3d(5.22163e+07px, 3.09573e+07px, 0px) scale(131072);"></div>
            </div>
            <div class="leaflet-control-container">
                <div class="leaflet-top leaflet-left">
                    <div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in leaflet-disabled" href="#" title="Zoom in" role="button" aria-label="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button" aria-label="Zoom out">−</a></div>
                </div>
                <div class="leaflet-top leaflet-right"></div>
                <div class="leaflet-bottom leaflet-left"></div>
                <div class="leaflet-bottom leaflet-right">
                    <div class="leaflet-control-attribution leaflet-control"><a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | The Tour Lab</div>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
        <script>
            var lat = '<?= $local_detail["latitude"] ?>' || <?= $local_detail["latitude"] ?>;
            var lng = '<?= $local_detail["longitude"] ?>' || <?= $local_detail["longitude"] ?>;
            var map = L.map('map').setView([lat, lng], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'The Tour Lab'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map)
        </script>
        <div class="location-container">
            <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
            <span class="text-gray"> <?= viewSQ($local_detail["addrs"]) ?></span>
        </div>

        <!-- DEBUG-VIEW START 1 APPPATH/Views/product/inc/review_product.php -->

        <div class="section6" id="golf_qna_wrap">
            <h2 class="title-sec6" id="qna"><span>이용자 리뷰</span>(1)</h2>
            <div class="qa-section">
                <form action="" name="com_form" id="com_form" class="com_form">
                    <input type="hidden" name="r_idx" value="<?= $idx?>">
                    <input type="hidden" name="code" id="code" value="travel_view">
                    <input type="hidden" name="r_code" id="r_code" value="travel_view">
                    <div class="comment_box-input flex">
                        <textarea style="resize:none" class="bs-input" name="comment" id="comment"
                            placeholder="댓글을 입력해주세요."></textarea>
                        <button type="button" onclick="fn_comment(<?= session('member.idx') ?>)"
                            class="btn btn-point btn-lg comment_btn">등록
                        </button>
                    </div>
                </form>
            </div>

            <div class="qa_ques">
                <p>이곳이 어떠셨나요?</p>
                <div class="list_star">
                    <img src="/img/sub/star_ic_r.png" alt="">
                    <img src="/img/sub/star_ic_r.png" alt="">
                    <img src="/img/sub/star_ic_r.png" alt="">
                    <img src="/img/sub/star_ic_r.png" alt="">
                    <img src="/img/sub/star_ic_r.png" alt="">
                </div>
            </div>

            <div class="comment_box">
                <div class="item">
                    <div class="info">
                        <p class="name">woras******</p>
                        <p class="time">
                            <span class="day">2025.08.09</span>
                            <span class="hour">18:30</span>
                        </p>
                        <div class="eval">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <span>5.0</span>
                        </div>
                    </div>
                    <div class="content">
                        <p>이 장소는 훌륭해요</p>
                    </div>
                </div>
                <div class="item">
                    <div class="info">
                        <p class="name">woras******</p>
                        <p class="time">
                            <span class="day">2025.08.09</span>
                            <span class="hour">18:30</span>
                        </p>
                        <div class="eval">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                            <span>5.0</span>
                        </div>
                    </div>
                    <div class="content">
                        <p>이 장소는 훌륭해요</p>
                    </div>
                </div>
            </div>

            <div id="dim"></div>
            <div id="popup_img" class="on">
                <strong id="pop_roomName"></strong>
                <div>
                    <ul class="multiple-items">

                    </ul>
                </div>
                <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close"></a>
            </div>
            <div id="popup_coupon" class="popup" data-price="">
                <div class="popup-content">
                    <img src="/images/ico/close_icon_popup.png" alt="close_icon" class="close-btn">
                    <h2 class="title-popup">적용가능한 쿠폰 확인</h2>
                    <div class="order-popup">
                        <p class="count-info">사용 가능 쿠폰 <span>0장</span></p>
                        <div class="description-above">
                            <div class="item-price-popup item-price-popup--button active" data-idx="" data-type="" data-discount="0" data-discount_baht="0">
                                <span>적용안함</span>
                            </div>
                        </div>
                        <div class="line-gray"></div>
                        <div class="footer-popup">
                            <div class="des-above">
                                <div class="item">
                                    <span class="text-gray">총 주문금액</span>
                                    <span class="text-gray total_price" id="total_price_popup" data-price="">282,027원</span>
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
                                        <span id="last_price_popup">0</span><span class="text-gray">원</span>
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

            <script>
                function trip_change(selectElement) {
                    var type = selectElement.value; // 선택된 값 (0=왕복, 1=편도)
                    var idx = selectElement.dataset.idx; // data-idx 값 가져오기 (dataset API 사용)
                    var car = selectElement.dataset.car; // data-car 값 가져오기 (dataset API 사용)
                    var product_idx = document.getElementById("product_idx").value; // 상품 ID 가져오기
                    var goods_name = document.querySelector(".tag-js.active")?.dataset.tab || ""; // 선택된 홀 개수 가져오기

                    console.log("선택된 차량: " + car + ", 선택된 타입: " + type);

                    $.ajax({
                        url: "/ajax/ajax_trip_change",
                        type: "POST",
                        data: {
                            "idx": idx,
                            "type": type,
                            "car": car,
                            "product_idx": product_idx,
                            "goods_name": goods_name
                        },
                        dataType: "json",
                        async: true, // 비동기 요청으로 변경
                        cache: false,
                        success: function(data) {
                            console.log("AJAX 응답:", data);
                            if (data.status === "success") {

                                // #vehicle_2 요소에 data-price와 data-price_baht 값 업데이트
                                $('#vehicle_' + car).data('price', data.price_won);
                                $('#vehicle_' + car).data('price_baht', data.price_bath);

                                // 필요하면, HTML 속성 업데이트도 할 수 있음
                                $('#vehicle_' + car).attr('data-price', data.price_won);
                                $('#vehicle_' + car).attr('data-price_baht', data.price_bath);
                                setListVehicle();

                            } else {
                                alert("데이터를 불러오는 데 실패했습니다.");
                            }
                        },
                        error: function(request, status, error) {
                            console.error("AJAX 요청 실패:", request, status, error);
                            alert("서버 오류가 발생했습니다. 관리자에게 문의하세요.");
                        }
                    });
                }
            </script>


            <script>
                $(".qa-item .qa-wrap").on("click", function() {
                    if ($(this).closest(".qa-item").find(".additional-info").length > 0) {
                        if ($(this).closest(".qa-item").find(".additional-info").css("display") == "none") {
                            $(this).closest(".qa-item").find(".additional-info").css("display", "block");
                        } else {
                            $(this).closest(".qa-item").find(".additional-info").css("display", "none");
                        }
                    }
                })

                $(".qa-submit-btn").on("click", function() {
                    let title = $("#qa-comment").val();
                    <?php
                    if (empty(session()->get("member")["id"])) {
                    ?>
                        // alert("로그인해주세요");
                        // return;      
                        showOrHideLoginItem();
                        return false;
                    <?php
                    }
                    ?>

                    if (!title) {
                        alert("상품에 대해 궁금한 점을 입력해 주세요!");
                        return false;
                    }

                    $.ajax({
                        url: "/product_qna/insert",
                        type: "POST",
                        data: {
                            title: title,
                            product_gubun: "golf",
                            product_idx: 1916
                        },
                        error: function(request, status, error) {
                            alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        },
                        success: function(data, status, request) {
                            message = data.message;
                            alert(message);
                            if (data.result == true) {
                                location.reload();
                            }
                        }
                    });
                });
            </script>

            <script>
                $('.day_option_first').click(function() {
                    $(".day_option_first").addClass("active");
                    $(".day_option_second").removeClass("active");
                    $(".day_option_third").removeClass("active");
                    getOptions();
                });

                $('.day_option_second').click(function() {
                    $(".day_option_second").addClass("active");
                    $(".day_option_first").removeClass("active");
                    $(".day_option_third").removeClass("active");
                    getOptions();
                });

                $('.day_option_third').click(function() {
                    $(".day_option_third").addClass("active");
                    $(".day_option_first").removeClass("active");
                    $(".day_option_second").removeClass("active");
                    getOptions();
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#hoursDay').change(function() {
                        const selectedValue = $(this).val(); // 선택된 값
                        $("#final_hour").text(selectedValue);
                        $("#teeoff_hour").val(selectedValue);
                    });
                    $('#minuteDay').change(function() {
                        const selectedValue = $(this).val(); // 선택된 값
                        $("#final_minute").text(selectedValue);
                        $("#teeoff_min").val(selectedValue);
                    });
                });
            </script>

            <script>
                function handleShowBookingArea(elm) {
                    const target = $(elm).data('target');
                    $(window).scrollTop($(target).offset().top - 100, 'slow');
                }

                $(function() {
                    $(".tag-js").eq(0).trigger("click");
                    $(".tag-js2").eq(0).trigger("click");
                    $("#people_adult_cnt").find("option").eq(1).prop("selected", true);
                    $("#people_adult_cnt").trigger("change");
                })

                function setGolfOption() {
                    let total_option_price = 0;
                    let total_option_price_baht = 0;
                    let cnt = 0;
                    let html = `<div class="item-right">
                            <p><span class="text-gray">추가옵션 - </span>[name] x [cnt]대</p>
                            <span class="price-text text-gray">[price] 원 ([price_baht]바트)</span>
                        </div>`;

                    const html2 = $(".option_select").filter(function() {
                        return $(this).val() !== "";
                    }).map(function() {
                        const p_name = $(this).data('name');
                        cnt = $(this).val() || 0;
                        const price = Math.round($(this).data('price') * cnt);
                        const price_baht = Math.round($(this).data('price_baht') * cnt);

                        total_option_price += price;
                        total_option_price_baht += price_baht;

                        return html.replace("[name]", p_name)
                            .replace("[cnt]", cnt)
                            .replace("[price]", number_format(price))
                            .replace("[price_baht]", number_format(price_baht));
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

                    const html2 = $(".vehicle_select").filter(function() {
                        return $(this).val() !== "";
                    }).map(function() {
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

                    const optionPrice = setOptionArea();
                    const optionPrice1 = setGolfOption();

                    let last_price = vehiclePrice.total_vehicle_price + optionPrice.final_price + optionPrice1.total_option_price;
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
                    const hole_cnt = $('.tag-js.active').data('tab') + '홀';
                    const hour = $('.day_option.active').data('type');

                    $("#hole_cnt").val(hole_cnt);
                    $("#hour").val(hour);
                    //alert(golf_date+' - '+hole_cnt+' - '+hour);
                    if (!hole_cnt || !hour) {
                        return false;
                    }
                    $.ajax({
                        type: "GET",
                        url: "/product-golf/option-price/1916",
                        data: {
                            golf_date,
                            hole_cnt,
                            hour,
                        },
                        success: function(data) {
                            $('#final_option_list').html(data);
                            $("#final_option_list .card-item").eq(0).trigger("click");

                            var idx = $(".card-item").data('idx');
                            var day_yn = $(".card-item").data('o_day_yn');
                            var night_yn = $(".card-item").data('o_night_yn');
                            var afternoon_yn = $(".card-item").data('o_afternoon_yn');
                            var vehicle_price1_won = $(".card-item").data('vehicle_price1_won');
                            var vehicle_price2_won = $(".card-item").data('vehicle_price2_won');
                            var vehicle_price3_won = $(".card-item").data('vehicle_price3_won');
                            var vehicle_price1_baht = $(".card-item").data('vehicle_price1_baht');
                            var vehicle_price2_baht = $(".card-item").data('vehicle_price2_baht');
                            var vehicle_price3_baht = $(".card-item").data('vehicle_price3_baht');
                            console.log("fafafa");

                            $("#option_idx").val($(".card-item").data('idx'));

                            const $trip_type1 = $("#trip_type1");
                            const $trip_type2 = $("#trip_type2");
                            const $trip_type3 = $("#trip_type3");

                            const $select_1 = $("#vehicle_1");
                            const $select_2 = $("#vehicle_2");
                            const $select_3 = $("#vehicle_3");

                            $trip_type1.attr("data-idx", $(".card-item").data('idx'));
                            $trip_type2.attr("data-idx", $(".card-item").data('idx'));
                            $trip_type3.attr("data-idx", $(".card-item").data('idx'));

                            // 원하는 data-* 속성들을 이동
                            $select_1.attr("data-idx", $(".card-item").data('idx'));
                            $select_1.attr("data-price", $(".card-item").data('vehicle_price1_won'));
                            $select_1.attr("data-price_baht", $(".card-item").data('vehicle_price1_baht'));

                            $select_2.attr("data-idx", $(".card-item").data('idx'));
                            $select_2.attr("data-price", $(".card-item").data('vehicle_price2_won'));
                            $select_2.attr("data-price_baht", $(".card-item").data('vehicle_price2_baht'));

                            $select_3.attr("data-idx", $(".card-item").data('idx'));
                            $select_3.attr("data-price", $(".card-item").data('vehicle_price3_won'));
                            $select_3.attr("data-price_baht", $(".card-item").data('vehicle_price3_baht'));

                            $("#o_cart_due").val($(".card-item").data('o_cart_due'));
                            $("#o_caddy_due").val($(".card-item").data('o_caddy_due'));
                            $("#o_cart_cont").val($(".card-item").data('o_cart_cont'));
                            $("#o_caddy_cont").val($(".card-item").data('o_caddy_cont'));

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

                            calculatePrice();
                        }
                    })
                }

                function changePeople() {

                    $("#vehicle_5").val($("#people_adult_cnt").val()); // value가 "2"인 옵션 선택	
                    calculatePrice();
                }

                $(".item-price-popup").click(function() {
                    $(this).addClass("active").siblings().removeClass("active");
                    setCouponArea();
                })

                $(".btn_accept_coupon").click(function() {
                    setCouponArea(true);
                    calculatePrice();
                    $("#popup_coupon").css('display', 'none');
                })


                function showCouponPop() {
                    $("#popup_coupon").css('display', 'flex');
                }


                function handleSubmit() {

                    showOrHideLoginItem();
                    return false;

                    if ($("#order_date").val() == "") {
                        alert('에약일자를 선탹하세요.');
                        return false;
                    }

                    if ($("#people_adult_cnt").val() < 1) {
                        alert('인원을 선택하세요.');
                        $("#people_adult_cnt").focus();
                        return false;
                    }

                    if ($("#o_cart_due").val() == "Y" && ($("#vehicle_4").val() == null || $("#vehicle_4").val() == "" || $("#vehicle_4").val() == "0")) {
                        alert('본홀은 카트의무예약 홀입니다 카트를 선택해주세요.');
                        $("#vehicle_4").focus();
                        return false;
                    }

                    $("#frm").submit();
                }

                $(".vehicle_select").change(function() {
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

                jQuery(document).ready(function() {
                    var dim = $('#dim');
                    var popup = $('#popupRoom');
                    var closedBtn = $('#popupRoom .closed_btn');

                    var popup2 = $('#popup_img');
                    var closedBtn2 = $('#popup_img .closed_btn');

                    var order_date = $("#order_date").val();
                    var temp = order_date.split("-");

                    /* closed btn*/
                    closedBtn.click(function() {
                        popup.hide();
                        dim.fadeOut();
                        $('.multiple-items').slick('unslick'); // slick 삭제
                        return false;
                    });

                    closedBtn2.click(function() {
                        popup2.hide();
                        dim.fadeOut();
                        $('.multiple-items').slick('unslick'); // slick 삭제
                        return false;
                    });

                    $(".short_link").on('click', function(evt) {
                        evt.preventDefault();
                        var target = $(this).data('target');
                        // $(window).scrollTop($('#' + target).offset().top - 100, 300);
                        $('html, body').animate({
                            scrollTop: $('#' + target).offset().top - 100
                        }, 'slow');
                        return false;
                    });

                });
                $('.tag-list .tag-js').on('click', function() {
                    $('.tag-list .tag-js').removeClass('active');
                    $(".final_hole").text($(this).data('tab'));
                    $(this).addClass('active');

                    var goods_name = $(this).data('tab') + '홀';

                    $.ajax({
                        url: "/ajax/get_golf_option",
                        type: "POST",
                        data: {
                            product_idx: $('input[name="product_idx"]').val(),
                            goods_name: goods_name
                        },
                        dataType: "json",
                        success: function(res) {
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

                $('.tag-list .tag-js2').on('click', function() {
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

                $('.list-icon img[alt="heart_icon"]').click(function() {
                    if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
                        $(this).attr('src', '/uploads/icons/heart_on_icon.png');
                    } else {
                        $(this).attr('src', '/uploads/icons/heart_icon.png');
                    }
                });

                // Close the popup when the "Close" button or the "x" is clicked
                $closePopupBtn.on('click', function() {
                    $("#popup_coupon").css('display', 'none');
                });

                const s_date = new Date('2024-11-05');
                const e_date = new Date('2025-03-31');
                const deadline_date = '';
                const deadline_date_arr = deadline_date.split(',').map(function(date) {
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
                const arrPrice = arrDate.map(x => '76.3');

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
                            var selAmt = parseInt(Price[idx] / 10000) + '만';
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
                if (initDate) $(".final_date").text(formatDate(new Date(initDate), "."));
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

                    $.ajax({
                        url: "/api/products/localGuidePhoto",
                        type: "POST",
                        data: 'idx=' + idx,
                        error: function(request, status, error) {
                            //통신 에러 발생시 처리
                            alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        },
                        success: function(response, status, request) {

                            $(".multiple-items").html(response.data);

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

                            return false;

                        }
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
                    name: "니칸티 골프 클럽",
                    link: "/product-golf/golf-detail/1916",
                    image: "/data/product/1743415220_6ed423edbbaad1fde496.jpg",
                    ...(true && {
                        image2: "/data/product/1743415220_34f7289f0ffaad86acb3.jpg"
                    })
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
            <!-- DEBUG-VIEW START 4 APPPATH/Views/inc/sidebar_inc.php -->

            <div class="side-bar-inc">
                <div class="side-bar-inc-main">
                    <div class="top_cart flex_c_c">
                        <h3 class="title-side-bar">장바구니</h3>
                        <img src="/images/ico/select_ico_active.png" alt="" class="arrow-cart">
                    </div>
                    <div class="side-bar-cart">
                        <p>총 예상견적</p>
                        <h2><span class="paymentAmts">0</span>원</h2>
                        <div class="flex_c_c">
                            (<span class="paymentAmts_bath">0</span><span>바트)</span>
                        </div>
                    </div>
                    <div class="btn_area">
                        <a href="javascript:void(0);" class="b_yellow" onclick="">담은상품 보기</a>
                        <a href="javascript:void(0);" class="b_orange" onclick="fn_checkout_pop();">예약하기</a>
                        <div class="popup_review_cart">
                            <div class="popups news">
                                <div class="top flex_e_c">
                                    <button type="button" class="close"></button>
                                </div>
                                <div class="pop_contents">
                                    <h2 class="ttl">
                                        장바구니
                                    </h2>
                                    <div class="product_policy">
                                        <p>상품 예약시 카트에 상품이 담긴 시점이 아닌 예약시 환율기준에 따라 금액이 재계산되오니 착오가 없 으시길 바랍니다.</p>
                                        <p>즉시 확정 상품은 결제완료해주시면 바로 예약이 확정됩니다.</p>
                                        <p>30분내 회신 상품은 예약가능여부를 조치 후 견적서를 발송해드리오니, 예약현황페이지나 이메일로 말송된 견적서를 확인하신 후 결제해주시기 바랍니다</p>
                                    </div>
                                    <div class="review_porduct_btn">
                                        <button type="button" class="blue" onclick="fn_checkout_pop();">선택상품예약</button>
                                        <button type="button" id="deleteBtnPop">선택상품삭제</button>
                                    </div>
                                </div>
                            </div>
                            <form id="checkOut_pop" action="/checkout/show" method="post">
                                <input type="hidden" name="dataValue" id="dataValues" value="">
                            </form>
                        </div>
                    </div>
                    <div class="side-bar-slide flex_c_c">
                        <h3 class="title-side-bar">최근본상품</h3>
                        <img src="/uploads/icons/arrow_up_icon.png" alt="" class="arrow-slide">
                    </div>
                    <div class="card-side-bar">
                        <div class="side-bar-above side_bar_swipper swiper-container swiper-initialized swiper-horizontal swiper-backface-hidden">
                            <div class="img-container swiper-wrapper" id="swiper-wrapper-71836c9cb58e96100" aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 5" style="width: 103px; margin-right: 20px;">
                                    <a href="/product-golf/golf-detail/1916">
                                        <img class="img-sidebar" src="/data/product/1743415220_6ed423edbbaad1fde496.jpg" alt="니칸티 골프 클럽">
                                        <img class="img-sidebar" src="/data/product/1743415220_34f7289f0ffaad86acb3.jpg" alt="니칸티 골프 클럽">
                                    </a>
                                </div>
                                <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 5" style="width: 103px; margin-right: 20px;">
                                    <a href="/product-tours/item_view/1940">
                                        <img class="img-sidebar" src="/data/product/1730281184_6e6583e588cd40b26832.png" alt="엘리펀트 월드 생츄어리 &amp; 콰이강 다리 전일 투어">
                                        <img class="img-sidebar" src="/data/product/1730281184_a27101b3063509429ecd.png" alt="엘리펀트 월드 생츄어리 &amp; 콰이강 다리 전일 투어">
                                    </a>
                                </div>
                                <div class="swiper-slide" role="group" aria-label="3 / 5" style="width: 103px; margin-right: 20px;">
                                    <a href="/product-tours/item_view/2379">
                                        <img class="img-sidebar" src="/data/product/1730280801_45812399140ae8a916cc.png" alt="아유타야 방파인 &amp; 아트뮤지엄 오전 반일 투어(COPY)">

                                    </a>
                                </div>
                                <div class="swiper-slide" role="group" aria-label="4 / 5" style="width: 103px; margin-right: 20px;">
                                    <a href="/product-tours/item_view/2419">
                                        <img class="img-sidebar" src="/data/product/1743604809_e35b37f3ebc7d0f20361.jpg" alt="(아속출발) 아유타야 선셋 리버크루즈 반일 투어">
                                        <img class="img-sidebar" src="/data/product/1743604809_7c3a987ce21771818d09.jpg" alt="(아속출발) 아유타야 선셋 리버크루즈 반일 투어">
                                    </a>
                                </div>
                                <div class="swiper-slide" role="group" aria-label="5 / 5" style="width: 103px; margin-right: 20px;">
                                    <a href="/ticket/ticket-detail/1952">
                                        <img class="img-sidebar" src="/data/product/1730363010_d01f610315cfcdcc5e30.png" alt="[방콕시내→수완나품공항] 벨럭 캐리어 공항 배달서비스 Bellugg Luggage Delivery [Bangkok hotel → Suvarnabhum">
                                        <img class="img-sidebar" src="/data/product/1730363010_a626cc6a2350eecd3c4b.jpg" alt="[방콕시내→수완나품공항] 벨럭 캐리어 공항 배달서비스 Bellugg Luggage Delivery [Bangkok hotel → Suvarnabhum">
                                    </a>
                                </div>
                            </div>
                            <p class="pagination_sidebar" style="display: flex;">
                                <span class="current-slide">1</span>/<span class="total-slides">5</span>
                            </p>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                        <div class="side-bar-below">
                            <div class="left side_bar_swipper_btn_prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-71836c9cb58e96100" aria-disabled="true">
                                <img src="/images/main/arrow_prev_icon.png" alt="arrow_prev_icon">
                            </div>
                            <div class="right side_bar_swipper_btn_next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-71836c9cb58e96100" aria-disabled="false">
                                <img src="/images/main/arrow_next_icon.png" alt="arrow_next_icon">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="side-center-card">

                    <!-- <a class="banner-side-bar" href="#!">
            <img class="only_m" src="/data/bbs/20250417185716958.jpg"
                 alt="최저가 보장 배너">
            <img class="only_w" src="/data/bbs/20250417185716959.jpg"
                 alt="최저가 보장 배너">
        </a> -->
                    <a class="banner-side-bar" href="">
                        <img class="only_m" src="/data/bbs/20250302171707682.jpg" alt="최저가 보장 배너">
                        <img class="only_w" src="/data/bbs/20250302171707683.jpg" alt="최저가 보장 배너">
                    </a>
                    <a href="#!">
                        <img src="/data/bbs/" alt="" class="map_img_n only_m">
                        <img src="/data/bbs/" alt="" class="map_img_n only_w">
                    </a>
                </div>
            </div>
            <div class="side-bar-new">
                <!-- <a class="banner-side-bar" href="#!"><img src="../images/sub/ban_lowest.png" alt=""></a> -->
                <div class="icon-wrap-social">
                    <div class="info_chat">
                        <a class="btn_close" href="javascript:;">close</a>
                        <div class="msg">태국여행,<br><em>무엇이든 물어보세요!!</em></div>
                    </div>
                    <div class="robot-container" onclick="go_link_fn_inc();">
                        <!-- <img src="/images/sub/voi-sep-new.png" alt="Scroll to Top"> -->
                        <img src="/uploads/setting/20250228114706259.png" alt="Scroll to Top">
                    </div>
                    <div class="scroll-to-top">
                        <img src="/images/ico/arrow_up_icon.png" alt="Scroll to Top">
                    </div>
                </div>
            </div>
            <script>
                $(".btn_close").click(function() {
                    $(".info_chat").hide();
                });

                $(".arrow-slide").click(function() {
                    let card_slide_bar = $(this).closest(".side-bar-inc").find(".card-side-bar");

                    if (card_slide_bar.css('display') !== 'none') {
                        $(this).css('transform', 'rotate(180deg)');
                        card_slide_bar.slideUp(300);
                    } else {
                        $(this).css('transform', 'rotate(0)');
                        card_slide_bar.slideDown(300);
                    }
                });

                $(".arrow-cart").click(function() {
                    let cart_bar = $(this).closest(".side-bar-inc").find(".side-bar-cart");

                    if (cart_bar.css('display') !== 'none') {
                        $(this).css('transform', 'rotate(0)');
                        cart_bar.slideUp(300);
                    } else {
                        $(this).css('transform', 'rotate(180deg)');
                        cart_bar.slideDown(300);
                    }
                });

                function go_link_fn_inc() {
                    window.open("https://channel.io/ko", "_blank");
                }

                $(document).ready(function() {
                    const $scrollTopBtn = $('.scroll-to-top');
                    const $mainSale = $('.main_sale_banner');
                    const $sideBar = $('.side-bar-inc');

                    $(window).scroll(function() {

                        if ($(this).scrollTop() > 650) {
                            $sideBar.addClass('visible');
                            $mainSale.addClass('visible');
                        } else {
                            $sideBar.removeClass('visible');
                            $mainSale.removeClass('visible');
                        }

                        if ($(this).scrollTop() > 50) {
                            $scrollTopBtn.addClass('visible');
                            $sideBar.addClass('new');
                            // $mainSale.addClass('new');
                        } else {
                            $sideBar.removeClass('new');
                            // $mainSale.removeClass('new');
                            $scrollTopBtn.removeClass('visible');
                        }
                    });

                    $scrollTopBtn.on('click', function() {
                        $('html, body').animate({
                            scrollTop: 0
                        }, 500);
                    });

                    const swiper3 = new Swiper(".side_bar_swipper", {
                        loop: false,
                        slidesPerView: 1,
                        spaceBetween: 20,
                        navigation: {
                            prevEl: ".side_bar_swipper_btn_prev",
                            nextEl: ".side_bar_swipper_btn_next",
                        },
                        on: {
                            init: function(swiper) {
                                updatePagination(swiper.realIndex, swiper.slides.length);
                            },
                            slideChange: function(swiper) {
                                updatePagination(swiper.realIndex, swiper.slides.length);
                            },
                        },
                    });

                    function updatePagination(index, total) {
                        const currentSlide = index + 1;
                        document.querySelector('.pagination_sidebar .current-slide').textContent = currentSlide;
                        document.querySelector('.pagination_sidebar .total-slides').textContent = total || 0;
                    }

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

                    const viewedProducts = getCookie('viewedProducts');

                    if (viewedProducts) {
                        try {
                            const products = JSON.parse(viewedProducts);
                            const container = document.querySelector('.side-bar-above .swiper-wrapper');

                            if (products.length > 0) {
                                for (let i = products.length - 1; i >= 0; i--) {
                                    const product = products[i];
                                    const slide = document.createElement('div');
                                    slide.classList.add('swiper-slide');
                                    slide.innerHTML = `
                            <a href="${product.link}">
                                <img class="img-sidebar" src="${product.image}" alt="${product.name}">
                                ${product.image2 ? `<img class="img-sidebar" src="${product.image2}" alt="${product.name}">` : ''}
                            </a>
                        `;
                                    container.appendChild(slide);
                                }

                                document.querySelector('.pagination_sidebar').style.display = "flex";
                                updatePagination(0, products.length);
                                swiper3.update();
                            } else {
                                document.querySelector('.pagination_sidebar').style.display = "none";
                            }
                        } catch (error) {
                            console.error("fail cookie:", error);
                        }
                    } else {
                        document.querySelector('.pagination_sidebar').style.display = "none";
                    }

                });

                $('.b_yellow').on('click', function() {
                    $('.popup_review_cart').show();
                })

                $('.popup_review_cart .close').on('click', function() {
                    $('.popup_review_cart').hide();
                });
            </script>

            <script>
                $(document).ready(function() {

                    $(".checkbox_pop").prop("checked", true);

                    var dataValue = "";
                    $(".checkbox_pop:checked").each(function() {
                        if ($(this).data("values")) {
                            dataValue += $(this).data("values") + ',';
                        }
                    });

                    dataValue = dataValue.replace(/,+$/, "");
                    paymentShowPop(dataValue);

                    $(".checkbox_pop").on("change", function() {
                        var dataValue = "";
                        $(".checkbox_pop:checked").each(function() {
                            if ($(this).data("values")) {
                                dataValue += $(this).data("values") + ',';
                            }
                        });

                        dataValue = dataValue.replace(/,+$/, "");
                        paymentShowPop(dataValue);
                    });
                });

                function paymentShowPop(dataValue) {
                    if (dataValue) {
                        $("#dataValues").val(dataValue);

                        $.ajax({
                            url: "/ajax/cart_payment",
                            type: "POST",
                            data: {
                                "dataValue": dataValue
                            },
                            success: function(res) {
                                console.log(res);

                                if (res && res.message) {
                                    $("#paymentCnts").text(res.tot_cnt || '0');
                                    $(".paymentAmts").text(res.tot_amt || '0');
                                    $(".paymentAmts_bath").text(res.tot_bath || '0');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Error: ' + error);
                            }
                        });

                    } else {
                        $("#paymentCnts").text('0');
                        $(".paymentAmts").text('0');
                        $(".paymentAmts_bath").text('0');
                    }
                }

                function fn_checkout_pop() {
                    if ($("#dataValues").val() == "") {
                        alert('예약상품을 선택하세요.');
                        return false;
                    }

                    if ($("#checkOut_pop").length > 0) {
                        $("#checkOut_pop").submit();
                    }
                }

                $('#deleteBtnPop').click(function() {
                    let selected = [];

                    // 선택된 항목 수집
                    $('.checkbox_pop:checked').each(function() {
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
                        data: {
                            ids: selected
                        },
                        success: function(response) {
                            alert('삭제가 완료되었습니다.');
                            location.reload(); // 새로고침
                        },
                        error: function() {
                            alert('삭제 중 오류가 발생했습니다.');
                        }
                    });
                });
            </script>
            <!-- DEBUG-VIEW ENDED 4 APPPATH/Views/inc/sidebar_inc.php -->
        </div>
    </div>
</div>
    <script>
        function goBack() {
            window.history.back();
        }

        function del_it() {

            if (confirm("삭제 하시겠습니까? \n삭제후에는 복구가 불가능합니다.?")) {
                $.ajax({
                    url: "./review_delete",
                    type: "POST",
                    data: {idx: '<?= $idx ?>'},
                    success: (res) => {
                        if (res == "OK") {
                            alert("정상적으로 삭제되었습니다.");
                            window.location.href = "/review/review_list";
                        } else {
                            alert("오류가 발생하였습니다!!");
                        }
                    }
                })
            }
        }

        $(function () {
            $('input[name="comment"]').keydown(function () {
                if (event.keyCode === 13) {
                    event.target.value += "\n";
                }
            });
        });

        const r_code = "travel_view";
        const r_idx = "<?= $idx ?>";
    </script>
<script src="/js/comment.js"></script>

<?php $this->endSection(); ?>