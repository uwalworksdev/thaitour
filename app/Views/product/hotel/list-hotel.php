<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <div class="content-sub-product-hotel">
        <div class="body_inner">
            <?php echo view("/product/inc/navigation_container.php", ["parent_code" => 1303, "code_name" => $code_name, "code_no" => $code_no]); ?>
            <form name="frmSearch" id="frmSearch">
                <div class="sub-hotel-container">
                    <input type="hidden" name="search_product_category" id="search_product_category"
                           value="<?= $products["search_product_category"] ?>">
                    <input type="hidden" name="search_product_hotel" id="search_product_hotel"
                           value="<?= $products["search_product_hotel"] ?>">
                    <input type="hidden" name="search_product_rating" id="search_product_rating"
                           value="<?= $products["search_product_rating"] ?>">
                    <input type="hidden" name="search_product_promotion" id="search_product_promotion"
                           value="<?= $products["search_product_promotion"] ?>">
                    <input type="hidden" name="search_product_topic" id="search_product_topic"
                           value="<?= $products["search_product_topic"] ?>">
                    <input type="hidden" name="search_product_bedroom" id="search_product_bedroom"
                           value="<?= $products["search_product_bedroom"] ?>">
                    <input type="hidden" name="pg" id="pg" value="<?= $products["pg"] ?>">
                    <input type="hidden" name="price_type" id="price_type" value="<?= $products["price_type"] ?? "" ?>">
                    <input type="hidden" name="s_code_no" id="s_code_no" value="<?= $code_no ?>">
                    <!--                    <input type="hidden" name="day_start" id="day_start" value="-->
                    <?php //= $products["day_start"] ?><!--">-->
                    <!--                    <input type="hidden" name="day_end" id="day_end" value="-->
                    <?php //= $products["day_end"] ?><!--">-->

                    <div class="category-left only_web">
                        <div class="category-left-tit flex_b_c">
                            <h1 class="title"><?= $code_name ?></h1>
                            <div class="search-navigation flex">
                                <div class="navigation-container-next">
                                    <span class="font-bold"><?= $code_name ?></span>

                                    <div class="depth_2_tools_new_" id="depth_2_tools_new_">
                                        <ul class="depth_2_tool_list_new_" id="depth_2_tool_list_new_">
                                            <?php $parent_code = 1303 ?>
                                            <?php echo getHeaderTabSubChildNew($parent_code, $code_no); ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="navigation-container-next new">
                                    <img class="ball_dot_icon icon_open_depth_02_new icon_open_depth_new_"
                                         data-depth="depth_2_tools_new_"
                                         src="/uploads/icons/ball_dot_icon.png"
                                         alt="ball_dot_icon">
                                </div>
                            </div>
                        </div>
                        <div class="category-left-list">
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>세부지역</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ tab_box_js p--20 border
                                        <?php if (strpos($products["search_product_category"], "all") !== false
                                            || empty($products["search_product_category"])) {
                                            echo "tab_active_";
                                        } ?>"
                                            data-code="all" data-type="category">지역전체
                                        </li>
                                        <?php
                                        foreach ($codes as $code) {
                                            ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php if (strpos($products["search_product_category"], $code["code_no"]) !== false) {
                                                echo "tab_active_";
                                            } ?>"
                                                data-code="<?= $code["code_no"] ?>"
                                                data-type="category"><?= $code["code_name"] ?></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>숙박유형</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ tab_box_js p--20 border
                                        <?php if (strpos($products["search_product_hotel"], "all") !== false
                                            || empty($products["search_product_hotel"])) {
                                            echo "tab_active_";
                                        } ?>"
                                            data-code="all" data-type="hotel">유형전체
                                        </li>
                                        <?php
                                        foreach ($types_hotel as $code) {
                                            ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php if (strpos($products["search_product_hotel"], $code["code_no"]) !== false) {
                                                echo "tab_active_";
                                            } ?>"
                                                data-code="<?= $code["code_no"] ?>"
                                                data-type="hotel"><?= $code["code_name"] ?></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>호텔등급</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ tab_box_js p--20 border
                                        <?php if (strpos($products["search_product_rating"], "all") !== false
                                            || empty($products["search_product_rating"])) {
                                            echo "tab_active_";
                                        } ?>" data-code="all" data-type="rating">등급전체
                                        </li>
                                        <?php
                                        foreach ($ratings as $code) {
                                            ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php if (strpos($products["search_product_rating"], $code["code_no"]) !== false) {
                                                echo "tab_active_";
                                            } ?>"
                                                data-code="<?= $code["code_no"] ?>"
                                                data-type="rating"><?= $code["code_name"] ?></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
							<!-- 2025/02/13 가격검색 미노출 수정 -->
                            <!--div class="category-left-item">
                                <div class="subtitle">
                                    <span>1박 평균가격</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_ tab_price_area">
                                    <p class="tab-currency">
                                        <span class="currency active">원 · </span><span class="currency">원</span>
                                    </p>

                                    <div class="slider-container only_web">
                                        <div class="slider-background"></div>
                                        <div class="slider-track" id="slider-track"></div>
                                        <input type="range" min="0" max="<?= $products["total_price_max"] ?>"
                                               value="<?= $products["price_min"] ?>"
                                               name="price_min" class="slider" id="slider-min">
                                        <input type="range" min="0" max="<?= $products["total_price_max"] ?>"
                                               value="<?= $products["price_max"] ?>"
                                               name="price_max" class="slider" id="slider-max">
                                    </div>
                                    <div class="filter_price_wrap">
                                        <span class="price_range">
                                            <i class="price_min">0</i>원 ~ <i class="price_max">0</i>원 이상
                                        </span>
                                        <div class="filter">
                                            <button type="button"
                                                    class="btn_fil_price <?php if (empty($products["price_type"]) || $products["price_type"] == "W") {
                                                        echo "active";
                                                    } ?>" data-type="W">원
                                            </button>
                                            <button type="button"
                                                    class="btn_fil_price <?php if ($products["price_type"] == "B") {
                                                        echo "active";
                                                    } ?>" data-type="B">바트
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div-->
							
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>프로모션</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <?php
                                        foreach ($promotions as $code) {
                                            ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php if (strpos($products["search_product_promotion"], $code["code_no"]) !== false) {
                                                echo "tab_active_";
                                            } ?>"
                                                data-code="<?= $code["code_no"] ?>"
                                                data-type="promotion"><?= $code["code_name"] ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>테마</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <?php
                                        foreach ($topics as $code) {
                                            ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php if (strpos($products["search_product_topic"], $code["code_no"]) !== false) {
                                                echo "tab_active_";
                                            } ?>"
                                                data-code="<?= $code["code_no"] ?>"
                                                data-type="topic"><?= $code["code_name"] ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>침실수</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <?php
                                        foreach ($bedrooms as $code) {
                                            ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php if (strpos($products["search_product_bedroom"], $code["code_no"]) !== false) {
                                                echo "tab_active_";
                                            } ?>"
                                                data-code="<?= $code["code_no"] ?>"
                                                data-type="bedroom"><?= $code["code_name"] ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn_search_" onclick="search_it()">검색</button>
                    </div>

                    <div class="content-right">
                        <div class="form_element_">
                            <div class="date-container">
                                <label for="checkin" class="label text-gray pt-2">체크인/아웃</label>
                                <div class="date-sub-container">
                                    <div class="date-wrapper">
                                        <input type="text" id="checkin" name="day_start"
                                               placeholder="<?= date("Y-m-d") ?>" class="date"
                                               value="<?= $products["day_start"] ?>">
                                        <span class="suffix">(화)</span>
                                    </div>
                                    <span class="arrow">→</span>
                                    <div class="date-wrapper">
                                        <input type="text" id="checkout" name="day_end"
                                               placeholder="<?= date("Y-m-d") ?>" class="date"
                                               value="<?= $products["day_end"] ?>">
                                        <span class="suffix">(수)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form_input_" style="position: relative;">
                                <input type="text" id="input_hotel" name="keyword" class="input_custom_"
                                       value="<?= $products["keyword"] ?>" placeholder="호텔명(미입력시 전체)">
                                <ul class="search_words_list" id="search_words_hotel">
                                </ul>
                            </div>
                            <button type="button" onclick="search_it()" class="btn_search_">
                                검색
                            </button>
                            <div class="only_mo category-mo-cus">
                                <span class="title-cate">방콕</span>
                                <div class="img-div">
                                    <img src="/uploads/icons/hotel_filter_icon.png" alt="hotel_filter_icon">
                                </div>
                            </div>
                        </div>

                        <div class="filter-container">
                            <div class="">
                                <div class="filter-content">
                                    <img class="filter_icon" src="/uploads/icons/filter_icon.png" alt="filter_icon">
                                    <span>필터</span>
                                </div>
                                <div class="list-tag">
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn_search_" id="filter_product" onclick="search_it()">
                                    검색
                                </button>
                                <button type="button" id="delete_all">전체삭제</button>
                            </div>
                        </div>
                        <div class="below-filter-content">
                            <div class="total_number">
                                <p>총 상품 <span><?= $products["nTotalCount"] ?></span></p>
                            </div>
                            <!--                            <div class="two-way-arrow-content">-->
                            <!--                                <a href="#" class="">-->
                            <!--                                    <img class="two-way_arrow" src="/uploads/icons/2-way_arrow.png" alt="two-way_arrow">-->
                            <!--                                    <span class="text-primary">추천순</span>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                        </div>
                        <style>
                            .product-card-item-container .list_image_product {
                                display: flex;
                                justify-content: space-between;
                                flex-wrap: wrap;
                                align-items: start;
                                gap: 10px;
                                margin-top: 10px;
                            }

                            .product-card-item-container .list_image_product .product_image_ {
                                width: calc(50% - 5px);
                                height: 90px;
                            }

                            .product-card-item-container .list_image_product img {
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                            }
                        </style>
                        <?php
                        foreach ($products["items"] as $product) {
                            if (is_file(ROOTPATH . "/public/data/product/" . $product['ufile1'])) {
                                $src = "/data/product/" . $product['ufile1'];
                            } else {
                                $src = "/images/product/noimg.png";
                            }
							
                            ?>
                            <div class="product-card-item-container">
                                <div class="product-card-item-left">
                                    <a onclick="openPopupImage('<?= $product["product_idx"] ?>');" href="#!">
                                        <img src="<?= $src ?>" alt="sub_hotel_1">
                                    </a>

                                    <div class="list_image_product">
                                        <?php for ($i = 2; $i < 4; $i++) { ?>
                                            <?php
                                            $image = '';
                                            if (is_file(ROOTPATH . "/public/data/product/" . $product['ufile' . $i])) {
                                                $image = "/data/product/" . $product['ufile' . $i];
                                            } else {
                                                $image = "/images/product/noimg.png";
                                            }
                                            ?>
                                            <div onclick="openPopupImage('<?= $product["product_idx"] ?>');"
                                                 style="cursor: pointer" class="product_image_">
                                                <img src="<?= $image ?>" alt="">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="product-card-item-right">
                                    <div class="title-container">
                                        <a href="/product-hotel/hotel-detail/<?= $product["product_idx"] ?>">
                                            <h2><?= viewSQ($product['product_name']) ?></h2>
                                        </a>
                                        <div class="only_web">
                                            <div class="star-container">
                                                <div class="">
                                                    <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                                    <span><?= $product["review_average"] ?></span>
                                                </div>
                                                <div class="star-content">
                                                    <span class="text-primary">생생리뷰 <strong>(<?= $product["total_review"] ?>)</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d_flex align_items_center justify_content_between">
                                        <div class="sub-title">
                                            <?php
                                            $num = count($product['codeTree']);
                                            foreach ($product['codeTree'] as $key => $code):
                                                ?>
                                                <span><?= $code['code_name'] ?></span>
                                                <?php if ($key < $num - 1): ?>
                                                <img class="only_web" src="/uploads/icons/arrow_right.png"
                                                     alt="arrow_right">
                                                <img class="only_mo arrow_right_mo"
                                                     src="/uploads/icons/arrow_right_mo.png"
                                                     alt="arrow_right_mo">
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="level-content">
                                            <span class="text-primary"><?= $product['level_name'] ?></span>
                                        </div>
                                    </div>


                                    <div class="only_mo">
                                        <div class="star-container">
                                            <div class="star-left">
                                                <img src="/uploads/icons/star_icon_mo.png" alt="star_icon_mo">
                                                <span><?= $product["review_average"] ?></span>
                                            </div>
                                            <div class="star-content">
                                                <span class="text-primary">생생리뷰 <strong>(<?= $product["total_review"] ?>)</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-item-info">
                                        <div class="item-info-box">
                                            <div class="top flex_e_c">
                                                <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu_item"
                                                     alt="arrow_up" style="transform: rotate(180deg);">
                                            </div>
                                            <div class="item-info">
                                                <h2>추천 포인트</h2>
                                                <div class="tab_box_area_">
                                                    <ul class="tab_box_show_">
                                                        <?php foreach ($product['utilities'] as $row): ?>
                                                            <li class="tab_box_element_ p--20 border"><?= $row["code_name"] ?></li>
                                                        <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <h2><?= $product['room_name'] ?></h2>
                                                <p>침대: <?= $product['room_category'] ?></p>
                                            </div>
                                            <div class="item-info">
                                                <h2>프로모션</h2>
                                                <div class="item-info-label">
                                                    <span>연박 프로모션</span>
                                                    <?php
                                                    $cnt_promotions = count($product['promotions'] ?? []);
                                                    $count = 1;
                                                    ?>
                                                    "<?php foreach ($product['promotions'] as $row): ?>
                                                        <?= $row["code_name"] ?>
                                                        <?php if ($count < $cnt_promotions) {
                                                            echo ", ";
                                                        } ?>
                                                        <?php $count++; ?>
                                                    <?php
                                                    endforeach;
                                                    ?>"
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-price-info">
                                                <?php 
                                                    if($product['is_won_bath'] == "W" || $product['is_won_bath'] == "B"){
                                                        if($product['is_won_bath'] == "W"){
                                                ?>
                                                    <span class="main">
                                                        <?= number_format($product['product_price_won']) ?> </span>
                                                    <span class="text-gray"> 원 ~</span> 
                                                <?php
                                                        }else if($product['is_won_bath'] == "B"){
                                                ?>    
                                                    <span class="main">
                                                        <?= number_format($product['product_price']) ?> </span>
                                                    <span class="text-gray"> 바트 ~</span>    
                                                <?php
                                                        }
                                                    }else{
                                                ?>   
                                                    <span class="main">
                                                        <?= number_format($product['product_price_won']) ?> </span>
                                                    <span class="text-gray"> 원 ~</span>
                                                    <span class="sub text-gray"><?= number_format($product['product_price']) ?> 바트~</span>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        echo ipagelistingSub($products["pg"], $products["nPage"], $products["g_list_rows"], current_url() . "?code_no=" . $code_no . "&pg=")
                        ?>
                    </div>
                </div>
            </form>

            <script>
                function search_it() {
                    var frm = document.frmSearch;
                    frm.submit();
                }
            </script>
        </div>
        <section class="popup" style="display: none;">
            <div class="popup__content">
                <div class="header-con-p">
                    <h3 class="title-header">호텔 상세검색</h3>
                    <img class="close_popup" src="/uploads/icons/pop_close_icon.png" alt="close_icon">
                </div>
                <div class="popup_inner">
                    <div class="category-left-list">
                        <div class="category-left-item">
                            <div class="subtitle">
                                <span>세부지역</span>

                            </div>
                            <div class="tab_box_area_">
                                <ul class="tab_box_show_">
                                    <li class="tab_box_element_ tab_box_mo_js p--20 border
                                 <?php if (strpos($products["search_product_category"], "all") !== false
                                        || empty($products["search_product_category"])) {
                                        echo "tab_active_";
                                    } ?>" data-code="all" data-type="category">전체
                                    </li>
                                    <?php
                                    foreach ($codes as $code) {
                                        ?>
                                        <li class="tab_box_element_ tab_box_mo_js p--20 border <?php if (strpos($products["search_product_category"], $code["code_no"]) !== false) {
                                            echo "tab_active_";
                                        } ?>"
                                            data-code="<?= $code["code_no"] ?>"
                                            data-type="category"><?= $code["code_name"] ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="category-left-item">
                            <div class="subtitle">
                                <span>숙박유형</span>

                            </div>
                            <div class="tab_box_area_">
                                <ul class="tab_box_show_">
                                    <li class="tab_box_element_ tab_box_mo_js p--20 border
                                <?php if (strpos($products["search_product_hotel"], "all") !== false
                                        || empty($products["search_product_hotel"])) {
                                        echo "tab_active_";
                                    } ?>" data-code="all" data-type="hotel">전체
                                    </li>
                                    <?php
                                    foreach ($types_hotel as $code) {
                                        ?>
                                        <li class="tab_box_element_ tab_box_mo_js p--20 border
                                    <?php if (strpos($products["search_product_hotel"], $code["code_no"]) !== false) {
                                            echo "tab_active_";
                                        } ?>" data-code="<?= $code["code_no"] ?>"
                                            data-type="hotel"><?= $code["code_name"] ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="category-left-item">
                            <div class="subtitle">
                                <span>호텔등급</span>

                            </div>
                            <div class="tab_box_area_">
                                <ul class="tab_box_show_">
                                    <li class="tab_box_element_ tab_box_mo_js p--20 border
                                <?php if (strpos($products["search_product_rating"], "all") !== false
                                        || empty($products["search_product_rating"])) {
                                        echo "tab_active_";
                                    } ?>" data-code="all" data-type="rating">전체
                                    </li>
                                    <?php
                                    foreach ($ratings as $code) {
                                        ?>
                                        <li class="tab_box_element_ tab_box_mo_js p--20 border <?php if (strpos($products["search_product_rating"], $code["code_no"]) !== false) {
                                            echo "tab_active_";
                                        } ?>"
                                            data-code="<?= $code["code_no"] ?>"
                                            data-type="rating"><?= $code["code_name"] ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="category-left-item">
                            <div class="subtitle">
                                <span>1박 평균가격</span>

                            </div>
                            <div class="slider-container only_mo">
                                <div class="slider-background"></div>
                                <div class="slider-track" id="slider-track" style="left: 25%; width: 50%;"></div>
                                <input type="range" min="0" max="500000" value="<?= $products["price_min"] ?>"
                                       name="price_min" class="slider" id="slider-min">
                                <input type="range" min="0" max="500000" value="<?= $products["price_max"] ?>"
                                       name="price_max" class="slider" id="slider-max">
                            </div>
                            <div class="value-container">
                                <span><i class="price_min">10,000</i>원</span>
                                <span><i class="price_max">500,000</i>원 이상</span>
                            </div>
                            <!-- <p class="tab-currency">
                                <span class="currency active">원</span>
                                <span class="currency">바트</span>
                            </p> -->
                        </div>
                        <div class="category-left-item">
                            <div class="subtitle">
                                <span>프로모션</span>

                            </div>
                            <div class="tab_box_area_">
                                <ul class="tab_box_show_">
                                    <?php
                                    foreach ($promotions as $code) {
                                        ?>
                                        <li class="tab_box_element_ tab_box_mo_js p--20 border <?php if (strpos($products["search_product_promotion"], $code["code_no"]) !== false) {
                                            echo "tab_active_";
                                        } ?>"
                                            data-code="<?= $code["code_no"] ?>"
                                            data-type="promotion"><?= $code["code_name"] ?></li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                        <div class="category-left-item">
                            <div class="subtitle">
                                <span>테마</span>

                            </div>
                            <div class="tab_box_area_">
                                <ul class="tab_box_show_">
                                    <?php
                                    foreach ($topics as $code) {
                                        ?>
                                        <li class="tab_box_element_ tab_box_mo_js p--20 border <?php if (strpos($products["search_product_topic"], $code["code_no"]) !== false) {
                                            echo "tab_active_";
                                        } ?>"
                                            data-code="<?= $code["code_no"] ?>"
                                            data-type="topic"><?= $code["code_name"] ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="category-left-item">
                            <div class="subtitle">
                                <span>침실수</span>

                            </div>
                            <div class="tab_box_area_">
                                <ul class="tab_box_show_">
                                    <?php
                                    foreach ($bedrooms as $code) {
                                        ?>
                                        <li class="tab_box_element_ tab_box_mo_js p--20 border <?php if (strpos($products["search_product_bedroom"], $code["code_no"]) !== false) {
                                            echo "tab_active_";
                                        } ?>"
                                            data-code="<?= $code["code_no"] ?>"
                                            data-type="bedroom"><?= $code["code_name"] ?></li>
                                        <?php
                                    }
                                    ?>
                                    <li class="tab_box_element_ tab_box_mo_js p--20 border " rel="tab2">3 베드룸~(성인6인~)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        var baht_thai = parseFloat('<?=$baht_thai?>');

        $(".content-sub-product-hotel .btn_fil_price").on("click", function () {
            $(this).addClass("active").siblings().removeClass("active");
            let type = $(this).data("type");
            let price_max = 500000;
            let text_unit = "원";
            if (type == "B") {
                price_max = parseInt(500000 / baht_thai);
                text_unit = "바트";
            }

            console.log(baht_thai);
            

            $("#price_type").val(type);
            $(this).closest(".tab_price_area").find(".tab-currency").html(`<span class="currency active">${text_unit} · </span><span class="currency">${text_unit}</span>`);
            $(this).closest(".tab_price_area").find(".price_range").html(`<i class="price_min">0</i>${text_unit} ~ <i class="price_max">0</i>${text_unit} 이상`);
            $(this).closest(".tab_price_area").find("#slider-track").css({"left": "0%", "width": "0%"});
            $(this).closest(".tab_price_area").find("#slider-min").val(0);
            $(this).closest(".tab_price_area").find("#slider-min").attr("max", price_max);
            $(this).closest(".tab_price_area").find("#slider-max").val(0);
            $(this).closest(".tab_price_area").find("#slider-max").attr("max", price_max);
        });

        $("#input_hotel").keyup(function (event) {
            var search_name = $(this).val().trim();

            if (search_name == "") {
                $("#search_words_hotel").hide();
            } else {

                clearTimeout(debounceTimeout);

                debounceTimeout = setTimeout(function () {
                    $.ajax({
                        url: "/api/products/get_search_products",
                        type: "GET",
                        data: "search_name=" + search_name + "&gubun=hotel",
                        error: function (request, status, error) {
                            alert("code : " + request.status + "\r\nmessage : " + request.responseText);
                        },
                        success: function (response, status, request) {
                            let products = response;

                            if (products.length > 0) {
                                let html = ``;
                                let url = '';

                                products.forEach(product => {
                                    html += `<li><a href="/product-hotel/hotel-detail/${product["product_idx"]}">${product["product_name"]}</a></li>`;
                                });

                                $("#search_words_hotel").html(html);
                                $("#search_words_hotel").show();
                            } else {
                                $("#search_words_hotel").hide();
                            }
                            return;
                        }
                    });
                }, 100);

            }

            if (event.keyCode == 13) {
                location.href = "/product_search?search_name=" + search_name;
            }
        });
    </script>
    <script>
        $(".arrow_menu").click(function () {
            let tab_box_area = $(this).closest(".category-left-item").find(".tab_box_area_");

            if (tab_box_area.css('display') !== 'none') {
                $(this).css('transform', 'rotate(180deg)');
                tab_box_area.css("display", "none");
            } else {
                $(this).css('transform', 'rotate(0)');
                tab_box_area.css("display", "block");
            }
        });

        $(".arrow_menu_item").click(function () {
            let tab_box_area = $(this).closest(".item-info-box").find(".item-info");

            if (tab_box_area.css('display') !== 'none') {
                $(this).css('transform', 'rotate(180deg)');
                tab_box_area.css("display", "none");
            } else {
                $(this).css('transform', 'rotate(0)');
                tab_box_area.css("display", "block");
            }
        });

        $(document).ready(function () {
            function formatDate(date) {
                if (date) {
                    var d = new Date(date);

                    var month = '' + (d.getMonth() + 1);
                    var day = '' + d.getDate();
                    var year = d.getFullYear();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    return [year, month, day].join('-');
                } else {
                    return "";
                }

            }

            $("#checkin, #checkout").datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function (dateText, inst) {
                    var date = $(this).datepicker('getDate');
                    $(this).val(formatDate(date));
                }
            });

            $('#checkin').val(formatDate('<?=$products["day_start"]?>'));
            $('#checkout').val(formatDate('<?=$products["day_end"]?>'));
        });

        var category = [];
        var hotel = [];
        var rating = [];
        var promotion = [];
        var topic = [];
        var bedroom = [];

        function filter_product() {
            category = [];
            hotel = [];
            rating = [];
            promotion = [];
            topic = [];
            bedroom = [];

            if ($(window).width() > 850) {
                $(".tab_box_js.tab_active_").each(function () {
                    if ($(this).data("type") == "category") {
                        category.push($(this).data("code"));
                    } else if ($(this).data("type") == "hotel") {
                        hotel.push($(this).data("code"));
                    } else if ($(this).data("type") == "rating") {
                        rating.push($(this).data("code"));
                    } else if ($(this).data("type") == "promotion") {
                        promotion.push($(this).data("code"));
                    } else if ($(this).data("type") == "topic") {
                        topic.push($(this).data("code"));
                    } else if ($(this).data("type") == "bedroom") {
                        bedroom.push($(this).data("code"));
                    }
                });
            } else {
                $(".tab_box_mo_js.tab_active_").each(function () {
                    if ($(this).data("type") == "category") {
                        category.push($(this).data("code"));
                    } else if ($(this).data("type") == "hotel") {
                        hotel.push($(this).data("code"));
                    } else if ($(this).data("type") == "rating") {
                        rating.push($(this).data("code"));
                    } else if ($(this).data("type") == "promotion") {
                        promotion.push($(this).data("code"));
                    } else if ($(this).data("type") == "topic") {
                        topic.push($(this).data("code"));
                    } else if ($(this).data("type") == "bedroom") {
                        bedroom.push($(this).data("code"));
                    }
                });
            }

            $("#search_product_category").val(category.join(","));
            $("#search_product_hotel").val(hotel.join(","));
            $("#search_product_rating").val(rating.join(","));
            $("#search_product_promotion").val(promotion.join(","));
            $("#search_product_topic").val(topic.join(","));
            $("#search_product_bedroom").val(bedroom.join(","));
        }

        filter_product();

        $(window).resize(function () {
            filter_product();
            $('.list-tag').empty();

            $('.tab_box_js.tab_active_').each(function () {
                let tabText = $(this).text();
                let type = $(this).data("type");
                $('.list-tag').append(
                    '<div class="tag-item">' +
                    '<span data-type=' + type + '>' + tabText + '</span>' +
                    '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                    '</div>'
                );
            });
        });

        $('.tab_box_js.tab_active_').each(function () {
            let tabText = $(this).text();
            let type = $(this).data("type");
            $('.list-tag').append(
                '<div class="tag-item">' +
                '<span data-type=' + type + '>' + tabText + '</span>' +
                '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                '</div>'
            );
        });

        $('.tab_box_js, .tab_box_mo_js').click(function () {
            let group = $(this).closest('.tab_box_area_');
            let tabText = $(this).text();
            let type = $(this).data("type");
            let activeTab = group.find('.tab_box_js.tab_active_').text();

            // if (activeTab) {
            //     $('.list-tag .tag-item span').each(function() {
            //         if ($(this).text() === activeTab) {
            //             $(this).text(tabText);
            //             return false;
            //         }
            //     });
            // } else {
            //     $('.list-tag').append(
            //         '<div class="tag-item">' +
            //         '<span>' + tabText + '</span>' +
            //         '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
            //         '</div>'
            //     );
            // }

            if ($(this).data("code") === "all") {
                $(this).siblings('[data-code]:not([data-code="all"])').removeClass('tab_active_');
                $('.list-tag .tag-item span').each(function () {
                    if ($(this).text() !== tabText && type == $(this).data("type")) {
                        $(this).closest(".tag-item").remove();
                    }
                });
            } else {
                let allBtn = $(this).siblings('[data-code="all"]');
                allBtn.removeClass('tab_active_');
                $('.list-tag .tag-item span').each(function () {
                    if ($(this).text() === allBtn.text() && type == $(this).data("type")) {
                        $(this).closest(".tag-item").remove();
                    }
                });
            }

            if ($(this).hasClass('tab_active_')) {
                $(this).removeClass('tab_active_');
                $('.list-tag .tag-item span').each(function () {
                    if ($(this).text() === tabText && type == $(this).data("type")) {
                        $(this).closest(".tag-item").remove();
                    }
                });
            } else {
                $(this).addClass('tab_active_');
                $('.list-tag').append(
                    '<div class="tag-item">' +
                    '<span data-type=' + type + '>' + tabText + '</span>' +
                    '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                    '</div>'
                );
            }

            filter_product();

            // group.find('.tab_box_js').removeClass('tab_active_');
            // $(this).addClass('tab_active_');
        });

        $(document).on('click', '.close_icon', function () {
            let tagItem = $(this).parent('.tag-item');
            let tagText = tagItem.find('span').text();
            let type = tagItem.find('span').data("type");
            // Remove the active class from the corresponding tab
            $('.tab_box_js, .tab_box_mo_js').each(function () {
                if ($(this).text() === tagText && type === $(this).data("type")) {
                    $(this).removeClass('tab_active_');
                }
            });

            // Remove the tag item
            tagItem.remove();

            filter_product();

        });

        $('#delete_all').click(function () {
            $('.list-tag .tag-item').remove();
            $('.tab_box_js, .tab_box_mo_js').removeClass('tab_active_');

            filter_product();
        });

        // $('.tab_box_mo_js').click(function() {
        //     var $this = $(this); // The clicked tab element
        //     var $group = $this.closest('.category-left-item'); // Find the parent group

        //     // Remove 'tab_active_' class from all tabs in this group
        //     $group.find('.tab_box_mo_js').removeClass('tab_active_');

        //     // Add 'tab_active_' class to the clicked tab
        //     $this.addClass('tab_active_');
        // });
        // $(document).ready(function() {
        // });

        const sliders = document.querySelectorAll('.content-sub-product-hotel .slider-container');
        sliders.forEach(slider => {
            const sliderMin = slider.querySelector('#slider-min');
            const sliderMax = slider.querySelector('#slider-max');
            const sliderTrack = slider.querySelector('#slider-track');

            function updateSliderTrack() {
                const min = parseFloat(sliderMin.value);
                const max = parseFloat(sliderMax.value);

                if (min > max) {
                    [sliderMin.value, sliderMax.value] = [sliderMax.value, sliderMin.value];
                }

                const percentMin = (sliderMin.value - sliderMin.min) / (sliderMin.max - sliderMin.min) * 100;
                const percentMax = (sliderMax.value - sliderMax.min) / (sliderMax.max - sliderMax.min) * 100;

                sliderTrack.style.left = percentMin + '%';
                sliderTrack.style.width = (percentMax - percentMin) + '%';

                $(".content-sub-product-hotel .price_min").text(number_format(sliderMin.value));
                $(".content-sub-product-hotel .price_max").text(number_format(sliderMax.value));
            }

            sliderMin.addEventListener('input', updateSliderTrack);
            sliderMax.addEventListener('input', updateSliderTrack);

            window.addEventListener('DOMContentLoaded', updateSliderTrack);
        });

        $(".img-div").click(function () {
            $(".popup").show();
        });
        $(".close_popup").click(function () {
            $(".popup").hide();
        });

        $(document).ready(function () {

            $('.icon_open_depth_new_').click(function () {
                let depth = $(this).data("depth");
                $('#' + depth).toggleClass('active_');
            })
            $(window).on('click', function (event) {

                let icon_open_depth_02 = $('.icon_open_depth_02_new');
                let depth_2_tools_ = $('#depth_2_tools_new_');

                if (depth_2_tools_.is(event.target) || depth_2_tools_.has(event.target).length > 0 || icon_open_depth_02.is(event.target) || icon_open_depth_02.has(event.target).length > 0) {
                    depth_2_tools_.addClass('active_');
                } else {
                    depth_2_tools_.removeClass('active_');
                }
            });

            async function getCodeDepth(code) {
                let apiUrl = `<?= route_to('api.hotel_.get_code') ?>?code=${code}`;
                try {
                    let response = await fetch(apiUrl);
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

                    let res = await response.json();
                    renderDepthCode(res.data.data);
                } catch (error) {
                    console.error('Error fetching hotel data:', error);
                }
            }

            function renderDepthCode(data) {
                let html = "";
                for (let i = 0; i < data.length; i++) {
                    html += `<li class="depth_2_item_new_" data-code="${data[i].code_no}">
                                                <a href="${data[i].link_ ?? '#'}">${data[i].code_name}</a>
                                            </li>`;
                }

                $('#depth_2_tool_list_new_').html(html);
            }
        })
    </script>
    <div id="dim"></div>

    <div id="popup_img" class="on">
        <strong id="pop_roomName"></strong>
        <div>
            <ul class="multiple-items">
            </ul>
        </div>
        <a class="closed_btn" href=""><img src="/images/ico/close_ico_w.png" alt="close"/></a>
    </div>

    <script>
        jQuery(document).ready(function () {
            var dim = $('#dim');
            var popup2 = $('#popup_img');
            var closedBtn2 = $('#popup_img .closed_btn');

            closedBtn2.click(function () {
                popup2.hide();
                dim.fadeOut();
                $('.multiple-items').slick('unslick'); // slick 삭제
                return false;
            });
        });

        function openPopupImage(idx) {
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
    </script>
<?php $this->endSection(); ?>