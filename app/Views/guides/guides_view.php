<?php $this->extend('inc/layout_index'); ?>
<?php $setting = homeSetInfo(); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" type="text/css" href="/css/contents/reservation.css"/>

<link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker_custom.css"/>
<link rel="stylesheet" type="text/css" href="/css/contents/guide.css"/>
<link rel="stylesheet" href="/css/tour/spa.css">

<script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
<script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw3G5DUAOaV9CFr3Pft_X-949-64zXaBg&libraries=geometry"
        async defer></script>


    <div class="content-sub-hotel-detail tours-detail">
        <div class="body_inner">
            <form name="frm" id="frm" action="#" class="">
                <input type="hidden" name="product_idx" value="<?= $guide['product_idx'] ?>">

                <div class="section1">
                    <div class="title-container">
                        <h2><?= $guide['product_name'] ?></h2>
                        <div class="only_web">
                            <div class="list-icon">
                                <!-- <img src="/uploads/icons/print_icon.png" alt="print_icon"> -->
                                <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                                <img src="/uploads/icons/share_icon.png" alt="share_icon">
                            </div>
                        </div>
                    </div>
                    <div class="above-cus-content">
                        <div class="rating-container">
                            <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                            <span><strong> <?= $guide['review_average'] ?></strong></span>
                            <span>리얼리뷰 <strong>(<?= $guide['total_review'] ?>)</strong></span>
                            <span></span>
                        </div>
                        <div class="list-icon only_mo">
                            <!-- <img src="/uploads/icons/print_icon.png" alt="print_icon"> -->
                            <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                            <img src="/uploads/icons/share_icon.png" alt="share_icon">
                        </div>
                    </div>
                    <?php
                        if(!empty($guide['ufile1'])) {
                            $i3 = 1;
                        }else{
                            $i3 = 0;
                        }
                        $i3 += count($img_list);
                    ?>
                    <div class="hotel-image-container">
                        <div class="hotel-image-container-1" style="">
                            <img class="imageDetailMain_"
                                 onclick="img_pops('<?= $guide['product_idx'] ?>')"
                                 src="/uploads/guides/<?= $guide['ufile1'] ?>"
                                 alt="<?= $guide['product_name'] ?>"
                                 onerror="this.src='/images/share/noimg.png'">
                        </div>
                        <div class="grid_2_2">


                            <?php 
                                $is_mobile = preg_match('/(android|iphone|ipad|ipod|mobile)/i', $_SERVER['HTTP_USER_AGENT']);
                                $loop_limit = $is_mobile ? 1 : 3;
                                for ($j = 2; $j < 2 + $loop_limit; $j++) {
                            ?>
                                <img onclick="img_pops('<?= $guide['product_idx'] ?>')"
                                     class="grid_2_2_size imageDetailSup_"
                                     src="/uploads/guides/<?= $img_list[$j - 2]['ufile'] ?>"
                                     alt="<?= $guide['product_name'] ?>" onerror="this.src='/images/share/noimg.png'">
                            <?php } ?>
                            <div class="grid_2_2_sub" onclick="img_pops('<?= $guide['product_idx'] ?>')"
                                 style="position: relative; cursor: pointer;">
                                <img class="custom_button imageDetailSup_"
                                     src="/uploads/guides/<?= $img_list[$j - 2]['ufile'] ?>"
                                     alt="<?= $guide['product_name'] ?>"
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
                        <div class="main nav-list">
                            <a class="short_link active" onclick="scrollToEl('product_info')" data-target="product_info"
                               href="#!">가격/상품정보</a>
                            <a class="short_link" onclick="scrollToEl('product_des')" data-target="product_des"
                               href="#!">리얼리뷰</a>
                            <a class="short_link" onclick="scrollToEl('section8')" href="#!">상품Q&A(<?=$product_qna["nTotalCount"] ?? 0?>)</a>
                        </div>
                    </div>

                </div>
                <div class="section2" id="product_info">
                    <h4 class="title_sec2">가격/상품정보</h4>
                    <?php $i = 0; ?>
                    <?php foreach ($options as $key => $option): ?>
                        <div class="sec2-item-card tour_calendar <?php echo $i == 0 ? "active" : "" ?>">
                            <?php
                            $price_ = $option['o_sale_price'];
                            ?>
                            <div class="calendar_header" data-key="<?= $key ?>"
                                 data-num="<?= $option['o_idx'] ?>">
                                <div class="desc_product">
                                    <div class=""
                                         data-price="<?= $option['o_sale_price'] ?>"><?= $option['o_name'] ?></div>
                                    <div class="desc_product_sub">
                                        <p> 옵션포함:</p>
                                        <ul>
                                            <?php foreach ($option['sup_options'] as $item): ?>
                                                <li class="" data-price="<?= $item['s_price'] ?>">
                                                    - <?= $item['s_name'] ?> </li>

                                                <?php
                                                $price_ += $item['s_price'];
                                                ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="desc_product_sub">예약기능여부 : <span
                                                style="color : #2a459f "><?= $option['o_availability'] ?></span>
                                    </div>
                                </div>

                                <div class="box_price">
                                    <p>
                                        <?= number_format($price_) ?>바트
                                        <i><?= number_format($price_ * $setting['baht_thai']) ?></i>원
                                    </p>
                                    <div class="btn_oder">
                                        <button type="button">선택</button>
                                    </div>
                                </div>
                            </div>

                            <div class="calendar_container_tongle" style="display : none">
                                <div class="close_btn">
                                    <img src="/images/ico/close_ic.png" alt="">
                                </div>
                                <table class="book_tbl">
                                    <colgroup>
                                        <col style="width:15%">
                                        <col style="width:18%">
                                        <col style="width:15%">
                                        <col style="width:15%">
                                        <col style="width:18%">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <th>가이드 시작일</th>
                                        <td colspan="1" class="checkin">
                                            <div class="custom_input fl mr5" style="width:150px">
                                                <div class="val_wrap">
                                                    <input name="checkin_date" type="text" data-key="<?= $key ?>"
                                                           data-num="<?= $option['o_idx'] ?>"
                                                           id="checkInDate<?= $option['o_idx'] ?>" class="hasDateranger"
                                                           data-group="true" placeholder="체크인" readonly="readonly"
                                                           value="" size="13">
                                                </div>
                                            </div>

                                        </td>
                                        <td class="count_date">
                                            <div class="fl mr5" style="width:80px ; margin-left: 10px">
                                                <div class="selectricWrapper selectric-selectric">
                                                    <div class="selectricHideSelect">
                                                        <select name="count_day" data-o_idx="<?= $option['o_idx'] ?>" id="countDay<?= $option['o_idx'] ?>"
                                                                class="selectric count_day">
                                                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="line-height: 50px; margin-left: 10px;" class="">일</div>
                                        </td>
                                        <th>가이드 종료일</th>
                                        <td class="checkout">
                                            <div class="custom_input fl mr5" style="width:150px">
                                                <div class="val_wrap">
                                                    <input name="checkout_date" type="text"
                                                           id="checkOutDate<?= $option['o_idx'] ?>"
                                                           class="hasDateranger" data-key="<?= $key ?>"
                                                           data-num="<?= $option['o_idx'] ?>"
                                                           data-group="true" placeholder="체크아웃" readonly="readonly"
                                                           value="" size="13">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr id="">
                                        <th>총인원</th>
                                        <td colspan="5" class="people">
                                            <div class="fl mr5" style="width:90px">
                                                <select name="people_cnt" id="people<?= $option['o_idx'] ?>"
                                                        class="selectric">
                                                    <?php for ($i = 1; $i <= $option['o_people_cnt']; $i++) { ?>
                                                        <option value="<?= $i ?>"><?= $i ?> 명</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="calendar_text_head" id="calendar_text_head<?= $option['o_idx'] ?>">
                                    <span id="day_start_txt<?= $option['o_idx'] ?>">2023년 7월</span> ~ <span
                                            id="day_end_txt<?= $option['o_idx'] ?>">2023년 7월</span>
                                </div>
                                <div class="container-calendar tour" id="calendar_tab_<?= $option['o_idx'] ?>">
                                    <input style="height: 10px" type="text"
                                           id="daterange_guilde_detail<?= $option['o_idx'] ?>"
                                           class="daterange_guilde_detail"/>
                                </div>
                                <div class="calendar_note">
                                    <p class="calendar_note_cannot"> 예약마감</p>
                                    <p class="calendar_note_maybe"> 예약가능</p>
                                </div>

                                <div class="policy_wrap">
                                    <h3 class="title-second">약관동의</h3>
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
                                        <label for="">개인정보 처리방침(필수)</label>
                                        <button type="button" data-type="3" class="view-policy">[보기]</button>
                                        <input type="hidden" value="N" id="information">
                                    </div>
                                    <div class="item-info-check item_check_term_">
                                        <label for="guidelines">여행안전수칙 동의(필수)</label>
                                        <button type="button" data-type="4" class="view-policy">[보기]</button>
                                        <input type="hidden" value="N" id="guidelines">
                                    </div>
                                </div>

                                <div class="calendar_submit">
                                    <button type="button" onclick="processBooking('<?= $option['o_idx'] ?>', 'W')">예약하기</button>
                                    <button type="button" class="btn-cart" onclick="processBooking('<?= $option['o_idx'] ?>', 'B')">장바구니</button>
                                </div>
                            </div>
                        </div>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </form>

            <?php
                // $reject_dates = [];
                // $arr_date_ = explode('||||', $guide['deadline_time']);
                // foreach ($arr_date_ as $itemDate) {
                //     if ($itemDate != "" && $itemDate) {
                //         $arr_date_s_ = explode('||', $itemDate);

                //         $start_date = new DateTime($arr_date_s_[0]);
                //         $end_date = new DateTime($arr_date_s_[1]);
                //         $end_date->modify('+1 day');

                //         $interval = new DateInterval('P1D');
                //         $daterange = new DatePeriod($start_date, $interval, $end_date);

                //         foreach ($daterange as $date) {
                //             $reject_dates[] = $date->format('Y-m-d');
                //         }
                //     }
                // }

                // $available_dates = [];
                // $arr_date_ = explode('||', $guide['available_period']);
                // $start_date = new DateTime($arr_date_[0]);
                // $end_date = new DateTime($arr_date_[1]);
                // $end_date->modify('+1 day');

                // $interval = new DateInterval('P1D');
                // $daterange = new DatePeriod($start_date, $interval, $end_date);

                // foreach ($daterange as $date) {
                //     $available_dates[] = $date->format('Y-m-d');
                // }
            ?>

            <h2 class="title-sec3" id="product_des">
                상품설명
            </h2>
            <div class="des-type">
                <?= viewSQ($guide['product_info']) ?>
            </div>

            <h2 class="title-sec2">
                더투어랩 이용방법
            </h2>
            <div class="steps-type">
                <div class="step-type">
                    <div class="con-step">
                        <img src="/uploads/sub/step_img1.png" alt="step_img1">
                    </div>
                    <span class="step-label">예약신청</span>
                    <span class="number-step">1</span>
                    <div class="cus-step-note">
                        <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                        <span class="txt-step-note">기능유무조회</span>
                    </div>
                </div>
                <div class="step-type">
                    <div class="con-step">
                        <img src="/uploads/sub/step_img2.png" alt="step_img2">
                    </div>
                    <span class="step-label">예약신청</span>
                    <span class="number-step">2</span>
                    <div class="cus-step-note">
                        <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                        <span class="txt-step-note">결제</span>
                    </div>
                </div>

                <div class="step-type">
                    <div class="con-step">
                        <img src="/uploads/sub/step_img3.png" alt="step_img2">
                    </div>
                    <span class="step-label">예약신청</span>
                    <span class="number-step">3</span>
                    <div class="cus-step-note">
                        <img src="/uploads/icons/detail_step_icon.png" alt="detail_step_icon">
                        <span class="txt-step-note">확정 후</span>
                    </div>
                </div>
                <div class="step-type">
                    <div class="con-step">
                        <img src="/uploads/sub/step_img4.png" alt="step_img2">
                    </div>
                    <span class="step-label">예약신청</span>
                    <span class="number-step">4</span>
                </div>
            </div>

            <?php echo view("/product/inc/review_product", ['product' => $guide]); ?>

            <div class="custom-golf-detail">
                <div class="section6" id="section8">
                    <h2 class="title-sec6">상품 Q&A(<?=$product_qna["nTotalCount"] ?? 0?>)</h2>

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

                    <?php 
                        echo ipagelistingSub($product_qna["pg"], $product_qna["nPage"], $product_qna["g_list_rows"], current_url() . "?pg_qna=", '', 'golf_qna_wrap')
                    ?>
                </div>
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
                        echo "<li><img src='/uploads/guides/" . $img["ufile"] . "' alt='". $img["rfile"] ."' /></li>";
                    }
                } ?>
                </ul>
            </div>
            <a class="closed_btn" href="javaScript:void(0)"><img src="/images/ico/close_ico_w.png" alt="close"></a>
        </div>
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
                        <div class="form_guide_schedule form_booking_spa_ ">
                            
                        </div> 
                        <div class="form-group cus-form-group memo">
                            <label for="extra-requests">기타요청</label>
                            <textarea id="extra-requests"
                                        placeholder="여기에 요청 사항을 입력하세요(선택사항)"></textarea>
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
        $(".btn_add_cart").on("click", function () {
            $("#custom_req").val($("#extra-requests").val());

            $("#frm").attr('method', 'post');
            // $("#frm").attr('action', '/product-golf/customer-form-ok');
			// $("#frm").submit();
        });

        function closePopup() {
            $(".popup_wrap").hide();
        }
    </script>
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
    </script>

    <script>
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
                    product_gubun: "guide",
                    product_idx: <?= $guide["product_idx"] ?? 0 ?>
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
        function closePopup() {
            $(".popup_wrap").hide();
            // $(".dim").hide();
        }

        $("#policy_show").on("click", function () {
            $(".policy_pop, .policy_pop .dim").show();
        });

        function scrollToEl(elID) {
            $('html, body').animate({
                scrollTop: $('#' + elID).offset().top - 250
            }, 'slow');
        }

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
        $(document).ready(function () {
            $(".calendar_header").each(function () {
                init_daterange($(this).data('num'));
            });

            let current_idx =  $('.calendar_header:first').data('num');
            let current_people_cnt = Number($('#people' + current_idx).val() ?? 1);

            let today = new Date();
            const date_now = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
            
            today.setDate(today.getDate() + current_people_cnt - 1);
            const tomorrow = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

            $('#checkInDate' + current_idx).val(date_now);
            $('#checkOutDate' + current_idx).val(tomorrow);

            $('.tour_calendar').removeClass('active');
            $('.item_check_term_').removeClass('checked_');
            $('.item_check_term_all_').removeClass('checked_');
            $('.item_check_term_').val('N');
            $('.item_check_term_all_').val('N');
            $(".calendar_container_tongle").hide();
            $('.calendar_header:first').next().show().parent().addClass('active');
            openDateRanger('.calendar_header:first');
            
            $(".calendar_header").click(function () {
                $('.tour_calendar').removeClass('active');
                $('.item_check_term_').removeClass('checked_');
                $('.item_check_term_all_').removeClass('checked_');
                $('.item_check_term_').val('N');
                $('.item_check_term_all_').val('N');
                $(".calendar_container_tongle").hide();
                $(this).next().show().parent().addClass('active');
                openDateRanger(this);
            });

            $(".calendar_container_tongle .close_btn").click(function () {
                $(this).parent().hide()
            });

            $('.hasDateranger').click(function () {
                openDateRanger(this);
            })

            function openDateRanger(el) {
                let num_idx = $(el).data('num');

                $('.calendar_text_head').removeClass('open_')
                $('#calendar_text_head' + num_idx).addClass('open_')
                $('.container-calendar.tour').removeClass('open_')
                $('#calendar_tab_' + num_idx).addClass('open_')
                $('#daterange_guilde_detail' + num_idx).data('daterangepicker').setStartDate('2024-12-30');
                $('#daterange_guilde_detail' + num_idx).data('daterangepicker').show();
            }

            function init_daterange(idx) {

                const daterangepickerElement = '#daterange_guilde_detail' + idx;
                const calendarTabElement = '#calendar_tab_' + idx;

                $(daterangepickerElement).daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD',
                        separator: ' ~ ',
                        applyLabel: '적용',
                        cancelLabel: '취소',
                        fromLabel: '시작일',
                        toLabel: '종료일',
                        customRangeLabel: '사용자 정의',
                        daysOfWeek: ['일', '월', '화', '수', '목', '금', '토'],
                        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                        firstDay: 0
                    },
                    linkedCalendars: true,
                    alwaysShowCalendars: true,
                    parentEl: calendarTabElement,
                    minDate: moment(), //moment().add(1, 'days')
                    opens: "center",
                    autoApply: true
                }, function (start, end) {

                    $('#checkInDate' + idx).val(start.format('YYYY-MM-DD'));
                    $('#checkOutDate' + idx).val(end.format('YYYY-MM-DD'));

                }).on('show.daterangepicker', function (ev, picker) {
                    $(picker.container).find("td.available").off("click").click(function () {
                        var a = $(this).attr("data-title"),
                        i = a.substr(1, 1),
                        s = a.substr(3, 1),
                        n = $(this).parents(".drp-calendar").hasClass("left")
                        ? picker.leftCalendar.calendar[i][s]
                        : picker.rightCalendar.calendar[i][s];
                        const countDay = Number($("#countDay" + idx).val() - 1);
                        picker.setStartDate(n);
                        picker.setEndDate(n.add(Number(countDay), "days"));
                        picker.clickApply();
                    })
                }).on('hide.daterangepicker', function (ev, picker) {
                    $(`${calendarTabElement} .daterangepicker`).show();
                    setTimeout(function () {
                        $(daterangepickerElement).data('daterangepicker').show();
                    })
                });

                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        if (mutation.type === 'childList' && $(mutation.target).hasClass('calendar-table')) {
                            $(mutation.target)
                                .find('td.off.disabled')
                                .each(function () {
                                    const $cell = $(this);
                                    const text = $cell.text().trim();
                                    if (!$cell.find('.custom-info').length) {
                                        $cell.html(`<div class="custom-info">
                                <span>${text}</span>
                                <span class="label sold-out-text">예약마감</span>
                                </div>`);
                                    }
                                });
                            $(mutation.target)
                                .find('td.available')
                                .each(function () {
                                    const $cell = $(this);
                                    const text = $cell.text().trim();
                                    if (!$cell.find('.custom-info').length) {
                                        $cell.html(`<div class="custom-info">
                                <span>${text}</span>
                                <span class="label allow-text">0만원</span>
                                </div>`);
                                    }
                                });

                            const filteredRows = $("tr").filter(function () {
                                const tds = $(this).find("td");
                                return tds.length > 0 && tds.toArray().every(td => $(td).hasClass("ends"));
                            }).remove();
                        }
                    });
                });

                observer.observe(document.querySelector(`${calendarTabElement} .daterangepicker`), {
                    childList: true,
                    subtree: true,
                });
            }

            // function splitEndDate() {
            //     let rj = `<?= implode(',', $reject_dates) ?>`;
            //     return rj.split(',');
            // }

            // function splitStartDate() {
            //     let rj = `<?= implode(',', $available_dates) ?>`;
            //     return rj.split(',');
            // }
        });

        $('.count_day').on('change', function () {
            let count_day = $(this).val();
            const o_idx = $(this).attr('data-o_idx');
            let start_day = $('#checkInDate' + o_idx).val();

            if (start_day) {
                let startDate = moment(start_day);
                let endDate = startDate.add(Number(count_day), 'days');

                $('#daterange_guilde_detail' + o_idx).data('daterangepicker').setEndDate(endDate);
                $('#daterange_guilde_detail' + o_idx).data('daterangepicker').clickApply();
            }

        })
    </script>
    <script>
        function processBooking(o_idx, status) {
            <?php if (empty(session()->get("member")["id"])) { ?>
            showOrHideLoginItem();
            return false;
            <?php } ?>

            let url = '<?= route_to('api.guide.processBooking') ?>';

            let formData = new FormData();

            let start_day = $('#checkInDate' + o_idx).val();
            let end_day = $('#checkOutDate' + o_idx).val();
            let people_cnt = $('#people' + o_idx).val();

            if (!start_day || !end_day) {
                alert('달력 선택해주세요!');
                return;
            }

            formData.append('start_day', start_day);
            formData.append('end_day', end_day);
            formData.append('end_day', end_day);

            formData.append('people_cnt', people_cnt);

            formData.append('o_idx', o_idx);
            formData.append('product_idx', '<?= $guide['product_idx'] ?>');

            if(status == 'W'){

                let fullagreement = $("#fullagreement").val().trim();
                let terms = $("#terms").val().trim();
                let policy = $("#policy").val().trim();
                let information = $("#information").val().trim();
                let guidelines = $("#guidelines").val().trim();

                if ([fullagreement, terms, policy, information, guidelines].includes("N")) {
                    alert("모든 약관에 동의해야 합니다.");
                    return false;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $("#ajax_loader").addClass("display-none");
                        console.log("Success:", response);
                        window.location.href = '/guide_booking';
                    },
                    error: function (request, status, error) {
                        console.error("Error:", request, status, error);
                        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        $("#ajax_loader").removeClass("display-none");
                    }
                });
            }else {
                let html = ``;
                for(let i = 1; i <= Number(people_cnt); i++){
                    html += `
                        <div class="day_wrap_sect">
                            <div class="day_activity_ w_100 d_flex justify_content_between align_items_center">
                                <h3 class="title-sub-c">
                                    ${i} 일차 일정을 입력해주세요
                                </h3>
                                <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu open_"
                                        alt="arrow_up" style="">
                            </div>
                            <div class="form-container show_ mt--30">
                                <div class="con-form">
                                    <div class="parent-form-group mb--25">
                                        <div class="form-group">
                                            <label for="first-a-name-1">가이드미팅시간</label>
                                            <div class="d_flex justify_content_between align_items_center gap_10">
                                                <div class="fl mr5">
                                                    <select class="selectric"
                                                            name="guideMeetingHour[]"
                                                            id="guideMeetingHour${i}">
                                                        <option value="00" selected="selected">00 AM
                                                        </option>
                                                        <option value="01">01 AM</option>
                                                        <option value="02">02 AM</option>
                                                        <option value="03">03 AM</option>
                                                        <option value="04">04 AM</option>
                                                        <option value="05">05 AM</option>
                                                        <option value="06">06 AM</option>
                                                        <option value="07">07 AM</option>
                                                        <option value="08">08 AM</option>
                                                        <option value="09">09 AM</option>
                                                        <option value="10">10 AM</option>
                                                        <option value="11">11 AM</option>
                                                        <option value="12">12 PM</option>
                                                        <option value="13">13 PM</option>
                                                        <option value="14">14 PM</option>
                                                        <option value="15">15 PM</option>
                                                        <option value="16">16 PM</option>
                                                        <option value="17">17 PM</option>
                                                        <option value="18">18 PM</option>
                                                        <option value="19">19 PM</option>
                                                        <option value="20">20 PM</option>
                                                        <option value="21">21 PM</option>
                                                        <option value="22">22 PM</option>
                                                        <option value="23">23 PM</option>
                                                    </select>
                                                </div>
                                                <span class="p_txt01 mr10">시</span>
                                                <div class="fl mr5">
                                                    <select class="selectric"
                                                            name="guideMeetingMin[]"
                                                            id="guideMeetingMin${i}">
                                                        <option value="00" selected="selected">00</option>
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="30">30</option>
                                                        <option value="40">40</option>
                                                        <option value="50">50</option>
                                                    </select>
                                                </div>
                                                <span class="p_txt01 mr10">분</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group w_100 mb--25">
                                        <label for="guideMeetingPlace${i}">미팅 장소</label>
                                        <input type="text" id="guideMeetingPlace${i}" class="w_100"
                                                name="guideMeetingPlace[]" style="width: 100%;"
                                                placeholder="영어로 작성해주세요.">
                                    </div>
                                    <div class="form-group w_100 mb--25">
                                        <label for="guideSchedule${i}">예상일정</label>
                                        <textarea name="guideSchedule[]"
                                                    class="w_100" id="guideSchedule${i}"
                                                    style="padding: 5px; height: 100px"></textarea>
                                    </div>
                                    <div class="form-group w_100 mb--25">
                                        <label for="requestMemo${i}">기타 요청</label>
                                        <textarea class="w_100" name="requestMemo[]"
                                                    style="padding: 5px; height: 100px"
                                                    id="requestMemo${i}"
                                                    placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }

                $(".form_guide_schedule").html(html);
                $(".cart_info_pop").show();
            }

        }
    </script>
    <script>
          $('.short_link').on('click', function() {
            $('.short_link').removeClass('active');
            $(this).addClass('active');
        });
    </script>
<?php $this->endSection(); ?>