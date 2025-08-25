<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<div class="content-sub-hotel-detail tours-detail custom-golf-detail">
    <div class="body_inner">
        <div class="section1">
            <div class="title-container">
                <h2><?= viewSQ($product['product_name']) ?> <span style="margin-left: 15px;"><?= viewSQ($product['product_name_en']) ?></span></h2>
                <div class="list-icon">
                    <!-- <img src="/uploads/icons/print_icon.png" alt="print_icon"> -->
                    <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                    <img src="/uploads/icons/share_icon.png" alt="share_icon">
                </div>
            </div>
            <ul class="tour_type_group">
                <?php
                    foreach($product["arr_tour_group"] ?? [] as $t_group){
                ?>
                    <li class="type_title type_title_1" style="background-color: <?= $t_group["color"] ?? "#000000"?>;"><?= $t_group["code_name"]?></li>
                <?php
                    }
                ?>
                <?php
                if (!empty(trim($product["company_name"])) || !empty(trim($product["company_contact"])) || !empty(trim($product["company_url"])) || !isContentEmpty(viewSQ($product["company_notes"]))) {
                ?>
                    <li class="view_info_company"><a href="javaScript:showInfoCompany()">판매자 정보</a></li>
                <?php
                }
                ?>
            </ul>
            <div class="location-container">
                <!-- <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                    <span><?= $product['addrs'] ?></span> -->
                <div class="location_conts">
                    <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon">
                    <span class="text-gray"> <?= $product['addrs'] ?> </span>
                </div>

                <div class="location_conts">
                    <img src="/uploads/icons/location_blue_icon.png" alt="location_blue_icon" class="ic_green">
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($product['addrs']) ?>" target="_blank" class="">
                        지도에서 보기
                    </a>
                </div>
                 <div class="list-icon">
                    <!-- <img src="/uploads/icons/print_icon.png" alt="print_icon"> -->
                    <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
                    <img src="/uploads/icons/share_icon.png" alt="share_icon">
                </div>
            </div>

            <div class="above-cus-content">
                <div class="rating-container">
                    <img src="/uploads/icons/star_icon.png" alt="star_icon.png">
                    <span><strong> <?= $product['review_average'] ?></strong></span>
                    <span>생생리뷰 <strong>(<?= $product['total_review'] ?>)</strong></span>
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
                <!-- <div class="list-icon only_mo">
            <img src="/uploads/icons/print_icon.png" alt="print_icon">
            <img src="/uploads/icons/heart_icon.png" alt="heart_icon">
            <img src="/uploads/icons/share_icon.png" alt="share_icon">
        </div> -->
            </div>
            <?php
            if (!empty($img_names[0])) {
                $i3 = 1;
            } else {
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
                    <!-- <img class="grid_2_2_size" src="<?= $imgs[2] ?>" alt="<?= $img_names[2] ?>" style="<?= $imgs[2] == '' ? 'visibility: hidden' : '' ?>">
                        <img class="grid_2_2_size" src="<?= $imgs[3] ?>" alt="<?= $img_names[3] ?>" style="<?= $imgs[3] == '' ? 'visibility: hidden' : '' ?>"> -->
                    <div class="grid_2_2_sub" style="position: relative; cursor: pointer;" onclick="img_pops('<?= $product['product_idx'] ?>')">
                        <img class="custom_button" src="/data/product/<?= $img_list[$j - 2]['ufile'] ?>" alt="<?= $img_list[$j - 2]['rfile'] ?>"
                            onerror="this.src='/images/share/noimg.png'">
                        <div class="button-show-detail-image">
                            <img class="only_web" src="/uploads/icons/image_detail_icon.png" alt="image_detail_icon">
                            <img class="only_mo" src="/uploads/icons/image_detail_icon_m.png" alt="image_detail_icon_m">
                            <span>사진 모두 보기</span>
                            <span>(<?= $i3 ?>장)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-header-hotel-detail">
                <div class="main">
                    <a class="short_link" data-target="product_info"
                        href="/product-tours/item_view/<?= $product['product_idx'] ?>#product_info">상품예약</a>
                    <a class="short_link" data-target="product_des"
                        href="/product-tours/item_view/<?= $product['product_idx'] ?>#product_des">상품설명</a>
                    <a class="short_link"
                        href="/product-tours/location_info/<?= $product['product_idx'] ?>#section2">위치정보</a>
                    <a class="short_link " href="/product-tours/location_info/<?= $product['product_idx'] ?>#section6">생생리뷰(<?= $product['total_review'] ?>개)</a>
                    <a class="short_link active" href="/product-tours/location_info/<?= $product['product_idx'] ?>#qna">상품Q&A(<?= $product_qna["nTotalCount"] ?? 0 ?>)</a>
                </div>
            </div>
        </div>
        <div class="section2" id="section2">
            <h3 class="title-size-24">위치정보</h3>
            <div id="map" style="width: 100%; height: 225px;"></div>
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
                <span class="text-gray"><?= $product['addrs'] ?></span>
            </div>

            <?php echo view("/product/inc/review_product"); ?>

            <h2 class="title-sec6" id="qna"><span>상품 Q&A</span>(<?= $product_qna["nTotalCount"] ?? 0 ?>)</h2>
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
                                    <span class="qa-number"><?= $num_qna--; ?></span>
                                    <span class="qa-tag <?php if ($qna_status == "N") {
                                                            echo "normal-style";
                                                        } ?>"><?= $qna_text ?></span>
                                    <div class="con-cus-mo-qa">
                                        <p class="qa-text"><?= $qna["title"] ?></p>
                                    </div>
                                    <div class="qa-meta text-gray only_mo"><?= $qna["r_date"] ?></div>
                                </div>
                                <div class="qa-meta text-gray only_web"><?= $qna["r_date"] ?></div>
                            </div>
                            <?php
                            if ($qna_status == "Y") {
                            ?>
                                <div class="additional-info">
                                    <span class="load-more">더투어랩</span>
                                    <?= nl2br($qna["reply_content"]) ?>
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
                            product_gubun: "tour",
                            product_idx: <?= $product['product_idx'] ?? 0 ?>
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

                $('.list-icon img[alt="heart_icon"]').click(function() {
                    if ($(this).attr('src') === '/uploads/icons/heart_icon.png') {
                        $(this).attr('src', '/uploads/icons/heart_on_icon.png');
                    } else {
                        $(this).attr('src', '/uploads/icons/heart_icon.png');
                    }
                });

                $('.quantity-container').each(function() {
                    var $container = $(this);
                    var $quantityDisplay = $container.find('.quantity');
                    var $increaseBtn = $container.find('.increase');
                    var $decreaseBtn = $container.find('.decrease');
                    var quantity = 0;

                    $increaseBtn.click(function() {
                        quantity++;
                        $quantityDisplay.text(quantity);
                        $decreaseBtn.removeAttr('disabled');
                    });

                    $decreaseBtn.click(function() {
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

                jQuery(document).ready(function() {
                    var dim = $('#dim');
                    var popup = $('#popupRoom');
                    var closedBtn = $('#popupRoom .closed_btn');

                    var popup2 = $('#popup_img');
                    var closedBtn2 = $('#popup_img .closed_btn');

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


                });

                document.addEventListener('DOMContentLoaded', function() {
                    const links = document.querySelectorAll('.short_link');

                    links.forEach(link => {
                        link.addEventListener('click', function() {
                            links.forEach(link => link.classList.remove('active'));
                            this.classList.add('active');
                        });
                    });
                });
            </script>

            <?php $this->endSection(); ?>