<link rel="stylesheet" type="text/css" href="/css/tour/spa.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw3G5DUAOaV9CFr3Pft_X-949-64zXaBg&libraries=geometry"
        async defer></script>
<style>
    .content-sub-hotel-detail .section3 {
        margin-top: 0px;
    }
</style>
<div class="content-sub-hotel-detail tours-detail spa-detail">
    <div class="body_inner">
        <div class="section1">
            <div class="title-container">
                <h2><?= $data_['product_name'] ?><span style="margin-left: 15px;"><?= viewSQ($data_['product_name_en']) ?></span></h2>
                <!-- <div class="only_web"> -->

                <div class="list-icon">
                    <img src="/uploads/icons/print_icon.png" alt="print_icon">
                    <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                    <img src="/uploads/icons/share_icon.png" alt="share_icon">
                </div>
                <!-- </div> -->
            </div>
            <?php 
                if(!empty(trim($data_["company_name"])) || !empty(trim($data_["company_contact"])) || !empty(trim($data_["company_url"])) || !isContentEmpty(viewSQ($product["company_notes"]))){
            ?>
                <ul class="tour_type_group">
                    <li class="view_info_company"><a href="javaScript:showInfoCompany()">판매자 정보</a></li>
                </ul>
            <?php 
                }
            ?>
            <div class="location-container">
                <!-- <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                <span><?= $data_['addrs'] ?></span> -->
                <div class="location_conts">
                    <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                    <span class="text-gray"> <?= $data_['addrs'] ?> </span>
                </div>

                <div class="location_conts">
                    <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon" class="ic_green">
                    <a href="https://www.google.com/maps/search/?api=1&query=<?=urlencode($data_['addrs'])?>" target="_blank" class="">
                        지도에서 보기
                    </a>
                </div>
            </div>
            <div class="above-cus-content">
                <div class="rating-container">
                    <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                    <span><strong> <?= $data_['review_average'] ?></strong></span>
                    <span>생생리뷰 <strong>(<?= $data_['total_review'] ?>)</strong></span>

                    <?php
                    $_arr = explode("|", $data_['mbti']);

                    $code_n0 = [];

                    foreach ($mcodes as $mcode) {
                        if (in_array($mcode['code_no'], $_arr)) {
                            $code_n0[] = $mcode['code_name'];
                        }
                    }
                    ?>

                    <span>추천 MBTI: <?= implode(', ', $code_n0) ?></span>
                </div>
                <!-- <div class="list-icon only_mo">
                    <img src="/uploads/icons/print_icon.png" alt="print_icon">
                    <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                    <img src="/uploads/icons/share_icon.png" alt="share_icon">
                </div> -->
            </div>
            <?php
                if(!empty($data_['ufile1'])) {
                    $i3 = 1;
                }else{
                    $i3 = 0;
                }
                $i3 += count($img_list);
            ?>

            <div class="hotel-image-container">
                <div class="hotel-image-container-1">
                    <img class="imageDetailMain_"
                         onclick="img_pops('<?= $data_['product_idx'] ?>')"
                         src="/data/product/<?= $data_['ufile1'] ?>"
                         alt="<?= $data_['product_name'] ?>"
                         onerror="this.src='/images/share/noimg.png'">
                </div>
                <div class="grid_2_2">
                    <?php for ($j = 2; $j < 5; $j++) { ?>
                        <img onclick="img_pops('<?= $data_['product_idx'] ?>')"
                             class="grid_2_2_size imageDetailSup_"
                             src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>"
                             alt="<?= $data_['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                    <?php } ?>
                    <div class="grid_2_2_sub" onclick="img_pops('<?= $data_['product_idx'] ?>')"
                         style="position: relative; cursor: pointer;">
                        <img class="custom_button imageDetailSup_"
                             src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>"
                             alt="<?= $data_['product_name'] ?>"
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
        </div>
        <div class="_wrap-info-payment">
            <div class="_wrap-info">

                <div class="calendar-con">
                    <?php echo view("/product/reservation_inc.php"); ?>
                </div>
                <div class="sub-header-hotel-detail">
                    <div class="main nav-list">
                        <p class="nav-item active" onclick="scrollToEl('section2')" style="cursor: pointer">상품선택</p>
                        <p class="nav-item" onclick="scrollToEl('section3')" style="cursor: pointer">상품설명</p>
                        <!-- <p class="nav-item" onclick="scrollToEl('section5')" style="cursor: pointer">스파정책</p> -->
                        <p class="nav-item" onclick="scrollToEl('section6')" style="cursor: pointer">
                            생생리뷰(<?= $data_['total_review'] ?>)</p>
                        <p class="nav-item" onclick="scrollToEl('section8')" style="cursor: pointer">상품문의(FAQ)</p>
                    </div>
                </div>

                <div class="section2" id="section2">
                    <h2 class="title-sec2" style="margin-bottom: 20px;">
                        상품선택
                    </h2>
                    <div style="display: flex; justify-content: flex-end;">
                        <p class="open_time">운영시간: <?= $data_['time_line'] ?></p>
                    </div>

                    <table class="price-table" id="price_table_" style="margin-bottom:30px;">
                        <colgroup>
                            <col width="*">
                            <col width="28%">
                            <col width="28%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th colspan="3">적용일자 : <span id="day_select_">...</span></th>
                        </tr>
                        <tr>
                            <th>상품타입</th>
                            <th>성인(만 13세이상)</th>
                            <th>아동(만 5세~12세)</th>
                        </tr>
                        </thead>
                        <tbody id="price_body_">

                        <tr>
                            <td colspan="3">
                                날짜 선택해주세요!
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="section9">
                    <h2 class="title-sec9">
                        예약시간
                    </h2>
                    <div class="meeting_time">
                        <select name="hours[]" id="hours">
                            <?php
                            for ($i = 0; $i < 24; $i++) {
                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                            ?>
                                <option value="<?= $hour ?>"><?= $hour ?></option>
                                <?php
                            }
                                ?>
                        </select>
                        <label for="hours">시</label>
                        <select name="minutes[]" id="minutes">
                            <?php
                            for ($i = 0; $i < 60; $i += 1) {
                                $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                            ?>
                                <option value="<?= $minute ?>"><?= $minute ?></option>
                                <?php
                            }
                                ?>
                        </select>
                        <label for="minutes">분</label>
                    </div>
                    <!-- <select class="select-time-c" id="select_time_line">
                        <?php foreach ($data_["timeSegments"] as $time): ?>
                            <option value="<?= htmlspecialchars($time); ?>">
                                <?= htmlspecialchars($time); ?>
                            </option>
                        <?php endforeach; ?>
                    </select> -->
                </div>

                <div class="section3" id="section3">
                    <h2 class="title-sec3">
                        상품설명
                    </h2>

                    <h2 class="title-sec2" style="margin-bottom: 10px">
                        상품정보
                    </h2>

                    <?php if($data_['tour_info']) {?>
                        <div class="container-big-text">
                                <?= viewSQ($data_['tour_info']) ?>
                        </div>
                    <?php }?>
                </div>

                <?php if($data_['product_confirm']) { ?>
                <div class="section3" style="margin-top: 0;">
                    <h2 class="title-sec2">
                        미팅/픽업장소 안내
                    </h2>

                    <div class="container-big-text">
                            <?= viewSQ($data_['product_confirm']) ?>
                    </div>
                </div>
                <?php } ?>

                <?php if($data_['product_period']) { ?>
                <div class="section3" style="margin-top: 0;">
                    <h2 class="title-sec2">
                        운영시간
                    </h2>

                    <div class="container-big-text">
                            <?= viewSQ($data_['product_period']) ?>
                    </div>
                </div>
                <?php } ?>

                <div class="section3" style="margin-top: 0;">
                    <h2 class="title-sec2">
                        포함/불포함 사항
                    </h2>

                    <div class="container-big-text">
                        <div>
                            <div class="tit-blue-type-2">
                                <span class="tit-blue">포함사항</span>
                            </div>
                            <div class="des-type">
                                <?= viewSQ($data_['product_able'])?>
                            </div>
                            <div class="tit-blue-type-2">
                                <span class="tit-blue">불포함 사항</span>
                            </div>
                            <div class="des-type">
                                <?= viewSQ($data_['product_unable'])?>
                            </div>
                        </div>

                        <?php if($data_['etc_comment'] && $data_['etc_comment'] != "&lt;p&gt;&nbsp;&lt;/p&gt;") {?>
                            <div class="section3" style="margin-top: 0;">
                                <h2 class="title-sec2">
                                    좌석안내
                                </h2>

                                <div class="container-big-text">
                                        <?= viewSQ($data_['etc_comment']) ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($data_['special_benefit'] && $data_['special_benefit'] != "&lt;p&gt;&nbsp;&lt;/p&gt;") {?>
                            <div class="section3" style="margin-top: 0;">
                                <h2 class="title-sec2">
                                    임산부 & 어린이 정책
                                </h2>

                                <div class="container-big-text">
                                        <?= viewSQ($data_['special_benefit']) ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div>
                            <h2 class="title-sec2">
                                추가정보 및 참고사항
                            </h2>
                            <div class="des-type">
                                <?= viewSQ($data_['mobile_able'])?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if($data_['notice_comment'] && $data_['notice_comment'] != "&lt;p&gt;&nbsp;&lt;/p&gt;") {?>
                <div class="section3" style="margin-top: 0;">
                    <h2 class="title-sec2">
                        유의사항
                    </h2>

                    <div class="container-big-text">
                            <?= viewSQ($data_['notice_comment']) ?>
                    </div>
                </div>
                <?php } ?>

                <div class="section4" id="section4">
                    <h2 class="title-sec4">
                        위치안내
                    </h2>

                    <div class="section4_map" id="section4_map" style="">

                    </div>
                </div>
                <script>
                    const latitude = Number(`<?= $data_['latitude'] ?>`);
                    const longitude = Number(`<?= $data_['longitude'] ?>`);

                    function initMap() {
                        const location = {lat: latitude, lng: longitude};
                        const map = new google.maps.Map(document.getElementById("section4_map"), {
                            zoom: 16,
                            center: location,
                        });

                        new google.maps.Marker({
                            position: location,
                            map: map,
                        });
                    }

                    window.onload = initMap;
                </script>

                <?php
                $product_more = $data_['product_more'];
                $breakfast_data_arr2 = [];
                if ($product_more) {
                    $productMoreData = explode('$$$$', $product_more);
                    $meet_out_time = $productMoreData[0];
                    $children_policy = $productMoreData[1];
                    $baby_beds = $productMoreData[2];
                    $deposit_regulations = $productMoreData[3];
                    $pets = $productMoreData[4];
                    $age_restriction = $productMoreData[5];
                    $smoking_policy = $productMoreData[6];
                    $breakfast = $productMoreData[7];
                    $breakfast_data = $productMoreData[8];

                    $breakfast_data_arr = explode('||||', $breakfast_data);
                    $breakfast_data_arr = array_filter($breakfast_data_arr);


                    foreach ($breakfast_data_arr as $dataBreakfast) {
                        $dataBreakfastArr = explode('::::', $dataBreakfast);
                        $breakfast_data_arr2[$dataBreakfastArr[0]] = $dataBreakfastArr[1];
                    }
                }
                ?>

                <div class="section5" id="section5" style="display: none">
                    <h1 class="title-sec5">스파정책</h1>
                    <div class="content-container-sec5">
                        <div class="content-item">
                        <span class="label">서비스 정책
                        </span>
                            <div class="description">
                                <p><?= nl2br($meet_out_time ?? '') ?></p>
                            </div>
                        </div>
                        <div class="content-item">
                        <span class="label">
                            결제 정책
                        </span>
                            <div class="description">
                                <p><?= nl2br($children_policy ?? '') ?></p>
                            </div>
                        </div>
                        <div class="content-item">
                        <span class="label">
                            할인 정책
                        </span>
                            <div class="description">
                                <p><?= nl2br($baby_beds ?? '') ?></p>
                            </div>
                        </div>
                        <div class="content-item">
                        <span class="label">
                            개인청보 보안 정책
                        </span>
                            <div class="description">
                                <p><?= nl2br($breakfast ?? '') ?></p>
                            </div>
                        </div>
                        <div class="content-item">
                        <span class="label">
                            보증금 규정
                        </span>
                            <div class="description">
                                <p> <?= nl2br($deposit_regulations ?? '') ?> </p>
                            </div>
                        </div>
                        <div class="content-item">
                        <span class="label">
                            반려동물
                        </span>
                            <div class="description">
                                <p> <?= nl2br($pets ?? '') ?> </p>
                            </div>
                        </div>
                        <div class="content-item">
                        <span class="label">
                            연령 제한
                        </span>
                            <div class="description">
                                <p> <?= nl2br($age_restriction ?? '') ?> </p>
                            </div>
                        </div>
                        <div class="content-item">
                        <span class="label">
                            흡연 정책
                        </span>
                            <div class="description">
                                <p> <?= nl2br($smoking_policy ?? '') ?> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo view("/product/inc/review_product", ['product' => $data_]); ?>

                <div class="custom-golf-detail">
                    <div class="section6" id="section8">
                        <h2 class="title-sec6">상품문의(<?=$product_qna["nTotalCount"]?>)</h2>

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
                                foreach($product_qna["items"] as $qna){
                                    if(!empty(trim($qna["reply_content"]))){
                                        $qna_status = "Y";
                                        $qna_text = "답변대기중";
                                    }else{
                                        $qna_status = "N";
                                        $qna_text = "답변완료";
                                    }
                            ?>
                                <li class="qa-item">
                                    <div class="qa-wrap">
                                        <div class="qa-question">
                                            <span class="qa-number"><?=$num_qna--;?></span>
                                            <span class="qa-tag <?php if($qna_status == "N"){ echo "normal-style"; }?>"><?=$qna_text?></span>
                                            <div class="con-cus-mo-qa">
                                                <p class="qa-text"><?=$qna["title"]?></p>
                                                <div class="qa-meta text-gray only_mo"><?=$qna["r_date"]?></div>
                                            </div>
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
                                }
                            ?>
                            </ul>
                        </div>

                        <?php 
                            echo ipagelistingSub($product_qna["pg"], $product_qna["nPage"], $product_qna["g_list_rows"], current_url() . "?pg_qna=", '', 'golf_qna_wrap')
                        ?>
                    </div>
                </div>
                <style>
                    .d_none {
                        display: none;
                        transition: all 0.3s ease;
                    }
                </style>
                <script>
                    $('.qa_item_').on('click keypress', function (e) {
                        if (e.type === 'click' || e.key === 'Enter') {
                            $('.additional_info_').addClass('d_none').attr('aria-hidden', 'true');
                            if ($(this).next('.additional-info').hasClass('d_none')) {
                                $(this).attr('aria-expanded', 'true').next().removeClass('d_none').attr('aria-hidden', 'false');
                            } else {
                                $(this).attr('aria-expanded', 'false').next().addClass('d_none').attr('aria-hidden', 'true');
                            }
                        }
                    });
                </script>
            </div>

            <div class="vertical-line"></div>

            <div class="_wrap-payment">
                <?php echo view("/product/composition_inc.php"); ?>
            </div>
        </div>
    </div>
</div>

<div class="popup_wrap benefit_pop info_company" style="display: none;">
    <div class="pop_box">
        <button type="button" class="close" onclick="closeInfoCompany()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>업체 정보</h2>
                    </div>
                </div>
                <div class="popup_place__body">
                    <div class="content_info">
                        <?php if (!empty($data_["company_name"])){ ?>
                            <p class="name">ㆍ업체명 : <span><?= $data_["company_name"] ?></span></p>
                        <?php
                            }    
                        ?>
                        <?php if (!empty($data_["company_contact"])){ ?>
                            <p class="contact">ㆍ연락처 : <?= $data_["company_contact"] ?></p>
                        <?php 
                            } 
                        ?>
                        <?php if (!empty($data_["company_url"])){ ?>
                            <p class="url">ㆍ홈페이지 : <?= $data_["company_url"] ?></p>
                        <?php 
                            } 
                        ?>
                    </div>
                    <div class="content_notes">
                        <?= viewSQ($data_["company_notes"])?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<script>
    function showInfoCompany() {
        $(".info_company").show();
    }

    function closeInfoCompany() {
        $(".info_company").hide();
    }

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
                product_gubun: "<?= $product_gubun ?? "" ?>",
                product_idx: <?= $data_['product_idx'] ?? 0 ?>
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

    $('.list-icon img[alt="heart_icon"]').click(function () {
        if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
            $(this).attr('src', '/uploads/icons/heart_on_icon.png');
        } else {
            $(this).attr('src', '/uploads/icons/heart_icon.png');
        }
    });

    $('.quantity-container').each(function () {
        var $container = $(this);
        var $quantityDisplay = $container.find('.quantity');
        var $increaseBtn = $container.find('.increase');
        var $decreaseBtn = $container.find('.decrease');
        var quantity = 0;

        $increaseBtn.click(function () {
            quantity++;
            $quantityDisplay.text(quantity);
            $decreaseBtn.removeAttr('disabled');
        });

        $decreaseBtn.click(function () {
            if (quantity > 0) {
                quantity--;
                $quantityDisplay.text(quantity);
            }
            if (quantity === 0) {
                $decreaseBtn.attr('disabled', true);
            }
        });
    });

    const swiper_content = new Swiper(".swiper-container_tour_content", {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 100,
        pagination: {
            el: ".swiper-tour_content-pagination",
        },
    });

    function getPriceLabel(status) {
        if (status === "예약가능") return '<span class="label allow-text">예약가능</span>';
        if (status === "예약마감") return '<span class="label sold-out-text">예약마감</span>';
        return '<span></span>';
    }

    // 버튼이 동적으로 생성된 경우에도 클릭 이벤트 적용
    // $(document).on('click', '.allowBtn', function () {
    // let order_no = $("#order_no").val();
    // console.log(order_no);
    // $.ajax({
    //
    //     url: "/ajax/ajax.order_delete.php",
    //     type: "POST",
    //     data: {
    //         "order_no": order_no
    //     },
    //     dataType: "json",
    //     async: false,
    //     cache: false,
    //     success: function (data, textStatus) {
    //         console.log(data)
    //     },
    //     error: function (request, status, error) {
    //         alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
    //     }
    // });
    // });


    var arr_data_option = [];

    $(document).on('click', '.allowDate', function () {
        $('.sel_date').removeClass('active_');
        $(this).addClass('active_');
        let day_ = $(this).data('date');
        //alert(day_);
        spaCharge(day_);
        var activeData = $('.day.allowDate.sel_date.active_').data('date');
        $("#select_date").text(activeData);

    });

    async function spaCharge(day_) {
        await LoadingPage();
        $('#day_').val(day_)
        $('#day_select_').text(day_);
        await loadDay(day_);
        //alert('111111111');
    }

    function getYoil(day) {
        const yoilArray = ['yoil_0', 'yoil_1', 'yoil_2', 'yoil_3', 'yoil_4', 'yoil_5', 'yoil_6'];
        const date = new Date(day);
        const dayIndex = date.getUTCDay();
        return yoilArray[dayIndex];
    }

    function loadDay(day_) {

        let url = `<?= route_to('api.spa_.get_spa_options') ?>?product_idx=<?= $data_['product_idx'] ?>&date=${day_}`;
        $.ajax({
            url: url,
            type: "GET",
            async: false,
            error: function (request, status, error) {
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                LoadingPage();
            },
            success: function (data, status, request) { 
                $("#list_people_option").html(
                    `<li class="">
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
                    </li>`
                );  

                $("#total_sum").text("0");
                renderData(data);
                LoadingPage();
            }
        });
    }

    function nl2br(str) {
        return str.replace(/\n/g, "<br>");
    }

    function renderData(data) {
        let html = ``;
        for (let i = 0; i < data.length; i++) {
            let item_ = data[i];
            
            html += 
                `<tr class="spa_option_detail" data-idx="${item_.idx}" data-count="${item_.count_options}" data-info_idx="${item_.info_idx}" data-op_name="${item_.spas_subject}">
                    <td>
                        <p style="margin-bottom: 5px; font-weight: bold;">${item_.info_name}</p>
                        ${item_.spas_subject}`;
            if(item_.is_explain == 'Y') {
                html += `<div class="area-tooltip">
                            <a onclick="$('#tipcon_${item_.spas_idx}').toggle();">설명</a>
                            <div class="layer_info" id="tipcon_${item_.spas_idx}" style="display: none;">
                                <a onclick="$('#tipcon_${item_.spas_idx}').hide();" class="btn_close">
                                    <span class="btn_close_s"></span>
                                </a>                
                                <p>${nl2br(item_.spas_explain)}</p>
                            </div>
                        </div>`;
            }
            html +=        
                    `</td>
                    <td>
                        <div class="d_flex align_items_center justify_content_between gap-10 price_sl_">
                            <div class="price" style="display: flex; justify-content: start; align-items: start; flex-direction: column; gap: 5px;">
                                <span class="text_primary">${convertNum(item_.goods_price1_won)} 원</span>
                                <span style="">(${convertNum(item_.goods_price1)} 바트)</span>
                            </div>
                            <p class="" style="display: flex; align-items: center; gap: 5px">
                                <input type="text" value="0" name="mem_cnt2[]" data-price="${item_.goods_price1_won}" class="price_in qty_adults_select_" size="4"
                                        data-type="adults" onkeyup="chkNum(this)">
                                <span>명</span>
                            </p>
                        </div>
                    </td>
                    <td>
                        <div class="d_flex align_items_center justify_content_between gap-10 price_sl_">
                            <div class="price" style="display: flex; justify-content: start; align-items: start; flex-direction: column; gap: 5px;">
                                <span class="text_primary">${convertNum(item_.goods_price2_won)} 원</span>
                                <span style="">(${convertNum(item_.goods_price2)} 바트)</span>
                            </div>
                            <p class="" style="display: flex; align-items: center; gap: 5px">
                                <input type="text" value="0" name="mem_cnt2[]" data-price="${item_.goods_price2_won}" class="price_in qty_children_select_" size="4"
                                        data-type="kids" onkeyup="chkNum(this)">
                                <span>명</span>
                            </p>
                        </div>
                    </td>
                </tr>`;
        }

        if (data.length === 0) {
            html = `<tr>
                        <td colspan="3">
                            날짜 선택해주세요!
                        </td>
                    </tr>`;
        }

        $('#price_body_').html(html);
    }

    function chkNum(el) {
        let val = $(el).val();

        if (!$.isNumeric(val)) {
            val = val.replace(/\D/g, '');

            $(el).val(val);
        }

        showTotalPrice();

        renderItemPrice(el);
    }

    function minusInput(el) {
        let input = $(el).parent().find('input');
        let idx = $(el).closest(".cus-count-input").data('idx');
        let info_idx = $(el).closest(".cus-count-input").data('info_idx');
        
        if (parseInt(input.val()) > 1) {
            let foundItem = arr_data_option[info_idx].find(item => parseInt(item.idx) === parseInt(idx));

            foundItem.cnt = parseInt(input.val()) - 1;
            input.val(parseInt(input.val()) - 1);
            calcTotalSup();
        } else {
            arr_data_option[info_idx] = arr_data_option[info_idx].filter(item => item.idx !== idx);
            removeData(el);
        }

    }

    function plusInput(el) {
        let input = $(el).parent().find('input');
        let idx = $(el).closest(".cus-count-input").data('idx');
        let info_idx = $(el).closest(".cus-count-input").data('info_idx');

        let foundItem = arr_data_option[info_idx].find(item => parseInt(item.idx) === parseInt(idx));

        foundItem.cnt = parseInt(input.val()) + 1;

        input.val(parseInt(input.val()) + 1);

        calcTotalSup();
    }

    function removeData(el) {
        let info_idx = $(el).closest(".cus-count-input").data('info_idx');        

        if (confirm('확실히 선택을 취소하고 싶습니다?')) {
            $("#sel_option_" + info_idx).find("select").val('');

            $(el).parent().parent().remove();
            calcTotalSup();
        }
    }

    function calcTotalSup() {
        let data = calcTotalPrice();
        let price_total = mainCalc(data.price_total.replaceAll(',', ''));
        $('#total_sum').text(price_total);
    }

    function renderOpPrice(data, info_idx){
        let parent_name = data.parent_name;
        
        let option_name = data.option_name;
        let option_price = data.option_price;
        let option_price_won = data.option_price_won;
        let idx = data.idx;
        let option_tot = data.option_tot ?? 0;
        let option_cnt = data.option_cnt;
        let cnt = data.cnt ?? 1;

        let htm_ = `<li id="sel_option_data_${idx}" data-idx="${idx}" data-info_idx="${info_idx}" class="flex_b_c cus-count-input" style="margin-top: 10px">
                        <div class="payment">
                            <p class="ped_label">${parent_name}</p>
                            <p class="money adult">
                                <span id="adult_msg">${option_name + " +" + option_price_won.toLocaleString('en-US') + "원" + "(" + Number(option_price).toLocaleString('en-US') + "바트" + ")"}</span>
                            </p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <button type="button" onclick="minusInput(this);" class="minus_btn"
                                    id="minusAdult"></button>
                            <input data-price="${option_price_won}" type="text" class="input-qty" name="option_qty[]" min="1" value="${cnt}"
                                readonly="">
                            <button type="button" onclick="plusInput(this);" class="plus_btn"
                                    id="addAdult"></button>
                        </div>

                        <div class="" style="display: none">
                            <input type="hidden" name="option_info_idx[]" value="${info_idx}">
                            <input type="hidden" name="option_name[]" value="${option_name}">
                            <input type="hidden" name="option_idx[]" value="${idx}">
                            <input type="hidden" name="option_tot[]" value="${option_tot}">
                            <input type="hidden" name="option_cnt[]" value="${option_cnt}">
                            <input type="hidden" name="option_price[]" value="${option_price_won}">
                        </div>
                    </li>`;
        

        let sel_option_ = $('#sel_option_data_' + idx);
        if (!sel_option_.length > 0) {
            
            $("#option_list_" + info_idx).append(htm_);
            calcTotalSup();
        }
    }

    function sel_moption(code_idx, info_idx) {
        let url = `<?= route_to('api.spa_.sel_moption') ?>`;

        $.ajax({
            url: url,
            type: "POST",
            data: {
                "product_idx": '<?= $data_['product_idx'] ?>',
                "code_idx": code_idx,
                "info_idx": info_idx
            },
            async: false,
            cache: false,
            success: function (data, textStatus) {
                $("#sel_option_" + info_idx).html(data);
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    function sel_option(code_idx, info_idx) {
        let url = `<?= route_to('api.spa_.sel_option') ?>`;
        let idx = code_idx.split("|")[0];

        let moption = $("#moption_" + info_idx).val();

        $.ajax({
            url: url,
            type: "POST",
            data: {
                "idx": idx,
                "moption": moption
            },
            async: false,
            cache: false,
            success: function (data, textStatus) {
                if (!arr_data_option[info_idx]) {
                    arr_data_option[info_idx] = [];
                }

                let exists = arr_data_option[info_idx].some(item => item.idx === idx);

                if (!exists) {
                    data.cnt = 1;
                    arr_data_option[info_idx].push(data);
                }
                
                renderOpPrice(data, info_idx);
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    function renderItemPrice(el) {
        let html = ``;
        let i = 0;
        let arr_info_idx = [];
        let tmp_info = [];

        $(".spa_option_detail").each(function() {
            
            i++;
            let idx = $(this).data('idx');
            let op_name = $(this).data('op_name');
            let info_idx = $(this).data('info_idx');
            let count = $(this).data('count');   
            
            if (!arr_info_idx[info_idx]) {
                arr_info_idx[info_idx] = 0;
            }

            arr_info_idx[info_idx]++;
            
            let adult_price = $(this).find(".qty_adults_select_").data('price');
            let adult_type = $(this).find(".qty_adults_select_").data('type');
            let adult_num = $(this).find(".qty_adults_select_").val();

            let child_price = $(this).find(".qty_children_select_").data('price');
            let child_type = $(this).find(".qty_children_select_").data('type');
            let child_num = $(this).find(".qty_children_select_").val();

            if(adult_num > 0 || child_num > 0){
                if(arr_info_idx[info_idx] == count){
                    html += `<li class="last" data-info_idx="${info_idx}">`;
                }else{
                    html += `<li data-info_idx="${info_idx}">`;
                }

                html += `<p style="font-weight: bold; margin-bottom: 10px;">${op_name}</p>`
                html += `<input type="hidden" name="op_name[]" value="${op_name}">`
                html += `<input type="hidden" name="op_info_idx[]" value="${info_idx}">`
            }

            if(adult_num > 0) {
                html += 
                `
                    <div class="flex_b_c cus-count-input cus-count-input-adult" id="children_adults_${idx}">
                        <div class="payment">
                            <p class="ped_label ped_label__booking">성인 ${i}</p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <input type="text" class="input-qty adultQty" name="adultQty[]" id="adultQty${idx}"
                                    value="${adult_num}" readonly="" style="padding: 0; width: 30px">
                            <span>명</span>
                            <input type="hidden" name="adultPrice[]" id="adultPrice${idx}" value="${adult_price}">
                        </div>
                    </div>
                `;
            }
            // else {
            //     html += `
            //         <div class="flex_b_c cus-count-input cus-count-input-adult" id="children_adults_${idx}">
            //             <div class="payment">
            //                 <p class="ped_label ped_label__booking">성인 ${i}</p>
            //             </div>
            //             <div class="opt_count_box count_box flex__c">
            //                 <input type="text" class="input-qty adultQty" name="adultQty[]" id="adultQty${idx}"
            //                         value="0" readonly="" style="padding: 0; width: 30px">
            //                 <span>명</span>
            //                 <input type="hidden" name="adultPrice[]" id="adultPrice${idx}">
            //             </div>
            //         </div>
            //     `;
            // }

            if(child_num > 0) {
                html +=
                `
                    <div class="flex_b_c cus-count-input cus-count-input-child" id="children_kids_${idx}">
                        <div class="payment">
                            <p class="ped_label ped_label__booking">아동 ${i}</p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <input type="text" class="input-qty childrenQty" name="childrenQty[]"
                                    id="childrenQty${idx}" value="${child_num}"
                                    readonly="" style="padding: 0; width: 30px">
                            <span>명</span>
                            <input type="hidden" name="childrenPrice[]" id="childrenPrice${idx}" value="${child_price}">
                        </div>
                    </div>
                `;
            }
            // else {
            //     html +=
            //     `
            //         <div class="flex_b_c cus-count-input cus-count-input-child" id="children_kids_${idx}">
            //             <div class="payment">
            //                 <p class="ped_label ped_label__booking">아동 ${i}</p>
            //             </div>
            //             <div class="opt_count_box count_box flex__c">
            //                 <input type="text" class="input-qty childrenQty" name="childrenQty[]"
            //                         id="childrenQty${idx}" value="0"
            //                         readonly="" style="padding: 0; width: 30px">
            //                 <span>명</span>
            //                 <input type="hidden" name="childrenPrice[]" id="childrenPrice${idx}" value="0">
            //             </div>
            //         </div>
            //     `;
            // }

            if(adult_num > 0 || child_num > 0) {
                html += `</li>`;
            }
        });

        
        $("#list_people_option").html(html);

        let check_num_people = false;

        $('.spa_option_detail').each(function() {
            let check_num_people = false;
            let current_info_idx = $(this).data('info_idx');

            if($(this).find(".qty_adults_select_").val() > 0 || $(this).find(".qty_children_select_").val() > 0){
                check_num_people = true;
            }

            if(check_num_people){

                $.ajax({
                    url: "<?= route_to('api.spa_.get_mOption') ?>",
                    type: "GET",
                    data: { 
                        info_idx: current_info_idx,
                        product_idx: "<?= $data_['product_idx'] ?>",
                    },
                    error: function(request, status, error) {
                        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    },
                    success: function(data, status, request) {

                        if(!tmp_info[current_info_idx]) {
                            tmp_info[current_info_idx] = current_info_idx
                            
                            let option_html = ``;
                            
                            option_html += `
                                <select name="moption" class="moption" id="moption_${current_info_idx}" onchange="sel_moption(this.value, ${current_info_idx});" data-info_idx="${current_info_idx}" style="margin-top: 20px">
                                    <option value="">옵션선택</option>`;
                            for (let i = 0; i < data.length; i++) {
                                option_html += `<option value="${data[i].code_idx}">${data[i].moption_name}</option>`;
                            }
    
                            option_html += `
                                </select>
                                <div class="opt_select disabled sel_option" id="sel_option_${current_info_idx}">
                                    <select name="option" id="option" onchange="sel_option(this.value, ${current_info_idx});">";
                                        <option value="">옵션 선택</option>
                                    </select>
                                </div>
                                <ul class="select_peo option_list_" id="option_list_${current_info_idx}" style="margin-top: 20px">
    
                                </ul>
                            `;
                            
                            $("#list_people_option").find('li[data-info_idx="' + current_info_idx + '"]').last().append(option_html);
    
                            for (let info_idx in arr_data_option) {
    
                                let dataList = arr_data_option[info_idx];
    
                                for (let i = 0; i < dataList.length; i++) {
                                    let data = dataList[i];
                                                                        
                                    renderOpPrice(data, info_idx);
                                }
                            }
                        }
                    }
                });
            }


        }); 
        
    }

    function calcTotalPrice() {
        let qty_children = 0;
        let qty_adults = 0;
        let price_total = 0;

        $('.qty_adults_select_').each(function () {
            let q = ($(this).val() &&  $(this).val() != '') ? $(this).val() : 0;
            
            let p = $(this).data('price');

            qty_adults += parseInt(q);
            let pT = parseInt(p) * parseInt(q)

            price_total += pT;
        })

        $('.qty_children_select_').each(function () {
            let q = ($(this).val() &&  $(this).val() != '') ? $(this).val() : 0;
            let p = $(this).data('price');

            qty_children += parseInt(q);
            let pT = parseInt(p) * parseInt(q)

            price_total += pT;
        })

        price_total = convertNum(price_total);

        return data = {
            qty_adults: qty_adults,
            qty_children: qty_children,
            price_total: price_total
        }
    }

    function showTotalPrice() {
        let data = calcTotalPrice();

        let qty_adults = data.qty_adults;
        let qty_children = data.qty_children;
        let price_total = data.price_total;

        renderTotalPrice(price_total, qty_adults, qty_children);
    }

    function renderTotalPrice(price_total, qty_adults, qty_children) {
        price_total = data.price_total.replaceAll(',', '');
        price_total = mainCalc(price_total);
        $('#total_sum').text(price_total);
        $('#adultQty').val(qty_adults);
        $('#childrenQty').val(qty_children);
    }

    function mainCalc(price_total) {
        let option_list_ = $("#option_list_").find('li.cus-count-input');

        let total_price = 0;
        $(".option_list_").each(function(){
            let option_list_ = $(this).find('li.cus-count-input');
            for (let i = 0; i < option_list_.length; i++) {
                let inp = $(option_list_[i]).find('input.input-qty');
                let price = inp.attr('data-price');
                let cnt = inp.val();
                total_price += parseInt(price) * parseInt(cnt);
            }
        });

        total_price += parseInt(price_total);

        $('#totalPrice').val(total_price);

        total_price = total_price.toLocaleString();
        return total_price;
    }
</script>

<div id="dim"></div>
<div id="popupRoom" class="on">
    <strong id="pop_roomName"></strong>
    <div>
        <ul class="multiple-items">
        </ul>
    </div>
    <a class="closed_btn" href=""><img src="/images/ico/close_ico_w.png" alt="close"/></a>
</div>

<div id="popup_img" class="on">
    <strong id="pop_roomName"></strong>
    <div>
        <ul class="multiple-items">
        </ul>
    </div>
    <a class="closed_btn" href=""><img src="/images/ico/close_ico_w.png" alt="close"/></a>
</div>
<script>
    /* hotel_view popup */
    jQuery(document).ready(function () {
        var dim = $('#dim');
        var popup = $('#popupRoom');
        var closedBtn = $('#popupRoom .closed_btn');

        var popup2 = $('#popup_img');
        var closedBtn2 = $('#popup_img .closed_btn');

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
    });

    function fn_pops(ridx, roomName) {
        var dim = $('#dim');
        var popup = $('#popupRoom');

        $("#pop_roomName").text(roomName);

        $.ajax({
            url: "/api/products/roomPhoto",
            type: "POST",
            data: 'ridx=' + ridx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            success: function (response, status, request) {
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

    function img_pops(idx) {
        var dim = $('#dim');
        var popup = $('#popup_img');

        $.ajax({
            url: "/api/products/hotelPhoto",
            type: "POST",
            data: 'idx=' + idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            success: function (response, status, request) {

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

    function scrollToEl(elID) {
        $('html, body').animate({
            scrollTop: $('#' + elID).offset().top - 230
        }, 'slow');
    }
</script>
