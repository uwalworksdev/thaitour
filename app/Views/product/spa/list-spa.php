<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<div class="content-sub-product-hotel custom-product-golf">
    <div class="body_inner">
        <?php echo view("/product/inc/navigation_container.php", ["parent_code" => $parent_code, "code_name" => $code_info['code_name'], "code_no" => $code_info['code_no']]); ?>
        <div class="sub-hotel-container">
            <div class="category-left golf_filter">
                <img class="close_popup only_mo" src="/uploads/icons/pop_close_icon.png" alt="close_icon">
                <div class="only_web">
                    <div class="category-left-tit flex_b_c">
                        <h1 class="title"><?= $code_info['code_name'] ?></h1>
                        <div class="search-navigation flex">
                            <div class="navigation-container-next">
                                <span class="font-bold"><?= $code_info['code_name'] ?></span>

                                <div class="depth_2_tools_new_" id="depth_2_tools_new_">
                                    <ul class="depth_2_tool_list_new_" id="depth_2_tool_list_new_">
                                        <?php echo getHeaderTabSubChildNew($parent_code, $code_no); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="navigation-container-next new">
                                <img class="ball_dot_icon icon_open_depth_02_new icon_open_depth_new_" data-depth="depth_2_tools_new_"
                                    src="/uploads/icons/ball_dot_icon.png"
                                    alt="ball_dot_icon">
                            </div>
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
								<?php if (
                                    strpos($search_product_category, "all") !== false
                                    || empty($search_product_category)
                                ) {
                                    echo "tab_active_";
                                } ?>"
                                    data-idx="0" data-group="search_product_category">지역전체
                                </li>
                                <?php
                                foreach ($codes as $code) {
                                ?>
                                    <li class="tab_box_element_ tab_box_js p--20 border
									<?php if (strpos($search_product_category, $code["code_no"]) !== false) {
                                        echo "tab_active_";
                                    } ?>"
                                        data-idx="<?= $code["code_no"] ?>"
                                        data-group="search_product_category"><?= $code["code_name"] ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>MBTI</span>
                            <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                        </div>
                        <div class="tab_box_area_">
                            <ul class="tab_box_show_">
                                <li class="tab_box_element_ tab_box_js p--20 border
								<?php if (
                                    strpos($search_product_mbti, "all") !== false
                                    || empty($search_product_mbti)
                                ) {
                                    echo "tab_active_";
                                } ?>"
                                    data-idx="0" data-group="search_product_mbti">전체
                                </li>
                                <?php
                                foreach ($mcodes as $code) {
                                ?>
                                    <li class="tab_box_element_ tab_box_js p--20 border
									<?php if (strpos($search_product_mbti, $code["code_no"]) !== false) {
                                        echo "tab_active_";
                                    } ?>"
                                        data-idx="<?= $code["code_no"] ?>"
                                        data-group="search_product_mbti"><?= $code["code_name"] ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="category-left-item">
                        <div class="subtitle">
                            <span>1박 평균가격</span>
                            <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                        </div>
                        <?php
                            if(empty($products["price_type"]) || $products["price_type"] == "W"){
                                $unit_price = "원";
                            }else{
                                $unit_price = "바트";
                            }
                        ?>
                        <div class="tab_box_area_ tab_price_area">
                            <p class="tab-currency">
                                <span class="currency active"><?=$unit_price?> · </span><span class="currency"><?=$unit_price?></span>
                            </p>

                            <div class="slider-container only_web">
                                <div class="slider-background"></div>
                                <div class="slider-track" id="slider-track"></div>
                                <input type="range" min="0" max="<?= $products["total_price_max"] ?>" value="<?= !empty($products["price_min"]) ? $products["price_min"] : 0 ?>"
                                        name="price_min" class="slider" id="slider-min">
                                <input type="range" min="0" max="<?= $products["total_price_max"] ?>" value="<?= !empty($products["price_max"]) ? $products["price_max"] : 0 ?>"
                                        name="price_max" class="slider" id="slider-max">
                            </div>
                            <div class="filter_price_wrap">
                                <span class="price_range">
                                    <i class="price_min">0</i><?=$unit_price?> ~ <i class="price_max">0</i><?=$unit_price?> 이상
                                </span>
                                <div class="filter">
                                    <button type="button" class="btn_fil_price <?php if(empty($products["price_type"]) || $products["price_type"] == "W"){ echo "active"; } ?>" data-type="W">원</button>
                                    <button type="button" class="btn_fil_price <?php if($products["price_type"] == "B"){ echo "active"; } ?>" data-type="B">바트</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="only_mo">
                        <div class="filter_mo">
                            <button type="button" class="btn_search_" id="filter_product" onclick="search_it()">
                                검색
                            </button>
                            <button type="button" id="delete_all_mo">전체삭제</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <div class="only_mo category-mo-cus">
                    <span class="title-cate"><?= $code_info['code_name'] ?></span>
                    <div class="img-div">
                        <img src="/uploads/icons/hotel_filter_icon.png" alt="hotel_filter_icon">
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
                </div>
                <?php foreach ($products['items'] as $key => $product): ?>
                    <div class="product-card-item-container">
                        <div class="product-card-item-left">
                            <a href="/product-golf/golf-detail/<?= $product['product_idx'] ?>">
                                <img style="height: 100%;" src="<?= getImage("/data/product/{$product['ufile1']}") ?>" alt="sub_hotel_1">
                            </a>
                            <div class="product-card-label-list">
                                <?php
                                foreach ($product["label_list"] as $label) {
                                ?>
                                    <div class="product-card-label" style="background-color: <?= $label["color"] ?>"><?= $label["code_name"] ?></div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="product-card-item-right">
                            <div class="title-container">
                                <a href="/product-golf/golf-detail/<?= $product['product_idx'] ?>">
                                    <h2><?= $product['product_name'] ?></h2>
                                </a>
                            </div>
                            <div class="flex_b_c">
                                <div class="sub-title">
                                    <?php $num = count($product['codeTree']);
                                    foreach ($product['codeTree'] as $key => $code):
                                    ?>
                                        <span><?= $code['code_name'] ?></span>
                                        <?php if ($key < $num - 1): ?>
                                            <img class="only_web" src="/uploads/icons/arrow_right.png"
                                                alt="arrow_right">
                                            <img class="only_mo arrow_right_mo" src="/uploads/icons/arrow_right_mo.png"
                                                alt="arrow_right_mo">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="only_web">
                                    <div class="star-container">
                                        <div class="">
                                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                            <span><?= $product['review_average'] ?></span>
                                        </div>
                                        <div class="star-content">
                                            <span class="text-primary">리얼리뷰 <strong>(<?= $product['total_review'] ?>)</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="only_mo">
                                <div class="star-container">
                                    <div class="star-left">
                                        <img src="/uploads/icons/star_icon_mo.png" alt="star_icon_mo">
                                        <span><?= $product['review_average'] ?></span>
                                    </div>
                                    <div class="star-content">
                                        <span class="text-primary">리얼리뷰 <strong>(<?= $product['total_review'] ?>)</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-item-info golf-list">
                                <div class="item-info">
                                    <div class="item-info-label text-gray" style="background-color: #fff7f4;"><?= nl2br($product['description']) ?></div>
                                </div>
                                <div class="item-info">
                                    <div class="item-info">
                                        <div class="item-price-info tour-price">
                                            <span class="main">
                                                <?= number_format($product['spa_price_won']) ?> </span>
                                            <span class="text-gray"> 원 ~</span>
                                            <span class="sub text-gray"><?= number_format($product['spa_price']) ?>바트~</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php
                    $url = $_SERVER['REQUEST_URI'];

                    parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
                    unset($queryParams['pg']);
                    $queryParams['pg'] = "";
                    $newQuery = urldecode(http_build_query($queryParams));
                    $newUrl = strtok($url, '?') . '?' . $newQuery;
                ?>
                <?= ipagelistingSub($products["pg"], $products["nPage"], $products["g_list_rows"], $newUrl) ?>
            </div>
        </div>
    </div>
</div>
<script>
    var baht_thai = parseFloat('<?=$baht_thai?>');

    $(".content-sub-product-hotel .btn_fil_price").on("click", function() {
        $(this).addClass("active").siblings().removeClass("active");
        let type = $(this).data("type");

        console.log(type);
        
        let price_max = 500000;
        let text_unit = "원";
        if(type == "B"){
            price_max = parseInt(500000 / baht_thai);     
            text_unit = "바트";
        }

        $("#price_type").val(type);
        $(this).closest(".tab_price_area").find(".tab-currency").html(`<span class="currency active">${text_unit} · </span><span class="currency">${text_unit}</span>`);
        $(this).closest(".tab_price_area").find(".price_range").html(`<i class="price_min">0</i>${text_unit} ~ <i class="price_max">0</i>${text_unit} 이상`);
        $(this).closest(".tab_price_area").find("#slider-track").css({"left": "0%", "width" : "0%"});
        $(this).closest(".tab_price_area").find("#slider-min").val(0);
        $(this).closest(".tab_price_area").find("#slider-min").attr("max", price_max);
        $(this).closest(".tab_price_area").find("#slider-max").val(0);
        $(this).closest(".tab_price_area").find("#slider-max").attr("max", price_max);
    });

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
    });

    function updateSelectedGroup(group, idx) {
        const tabs = $(`.tab_box_js[data-group="${group}"]`);

        const tabAll = $(`.tab_box_js[data-group="${group}"][data-idx="0"]`);

        const tabsNotAll = tabs.not(tabAll);

        if (idx == 0) {
            if (tabAll.hasClass('tab_active_')) {
                tabsNotAll.addClass('tab_active_');
            } else {
                tabsNotAll.removeClass('tab_active_');
            }
        } else {
            const tabsNotAllActive = tabsNotAll.filter('.tab_active_');
            if (tabsNotAllActive.length == tabsNotAll.length) {
                tabAll.addClass('tab_active_');
            } else {
                tabAll.removeClass('tab_active_');
            }
        }

    }

    function updateSelected() {
        $('.list-tag').empty();
        $('.tab_box_js.tab_active_[data-idx!="0"]').filter(function() {
            const siblings = $(this).siblings();
            const hasInvalidSibling = siblings.is('[data-idx="0"].tab_active_');
            return !hasInvalidSibling;
        }).each(function() {
            var tabText = $(this).text();
            $('.list-tag').append(
                '<div class="tag-item" data-idx="' + $(this).data('idx') + '" data-group="' + $(this).data('group') + '">' +
                '<span>' + tabText + '</span>' +
                '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                '</div>'
            );
        });
    }
    $(document).ready(function() {
        updateSelected();
        $('.tab_box_js').click(function() {
            $(this).toggleClass('tab_active_');
            updateSelectedGroup($(this).data('group'), $(this).data('idx'));
            updateSelected();
        });

        $(document).on('click', '.close_icon', function() {
            var $tagItem = $(this).parent('.tag-item');
            var tagIdx = $tagItem.data("idx");

            $('.tab_box_js').each(function() {
                if ($(this).data("idx") === tagIdx) {
                    $(this).removeClass('tab_active_');
                }
            });

            $tagItem.remove();
        });

        $('#delete_all, #delete_all_mo').click(function() {
            $('.list-tag .tag-item').remove();
            $('.tab_box_js').removeClass('tab_active_');
        });

        $('.tab_box_mo_js').click(function() {
            var $this = $(this);
            $this.toggleClass('tab_active_');

            updateSelected()
        });
        $(".arrow_menu").click(function() {
            let tab_box_area = $(this).closest(".category-left-item").find(".tab_box_area_");

            if (tab_box_area.css('display') !== 'none') {
                $(this).css('transform', 'rotate(180deg)');
                $(this).closest(".category-left-item").find(".subtitle").css("padding-bottom", "0");
                tab_box_area.css("display", "none");
            } else {
                $(this).css('transform', 'rotate(0)');
                $(this).closest(".category-left-item").find(".subtitle").css("padding-bottom", "20px");
                tab_box_area.css("display", "block");
            }
        });
    });

    const sliders = document.querySelectorAll('.slider-container');
    sliders.forEach(slider => {
        const sliderMin = slider.querySelector('#slider-min');
        const sliderMax = slider.querySelector('#slider-max');
        const sliderTrack = slider.querySelector('#slider-track');

        function updateSliderTrack() {
            const min = parseFloat(sliderMin.value);
            const max = parseFloat(sliderMax.value);
            console.log(min + "---" + max);

            if (min > max) {
                [sliderMin.value, sliderMax.value] = [sliderMax.value, sliderMin.value];
            }

            const percentMin = (sliderMin.value - sliderMin.min) / (sliderMin.max - sliderMin.min) * 100;
            const percentMax = (sliderMax.value - sliderMax.min) / (sliderMax.max - sliderMax.min) * 100;

            sliderTrack.style.left = percentMin + '%';
            sliderTrack.style.width = (percentMax - percentMin) + '%';

            $(".price_min").text(number_format(sliderMin.value));
            $(".price_max").text(number_format(sliderMax.value));
        }

        sliderMin.addEventListener('input', updateSliderTrack);
        sliderMax.addEventListener('input', updateSliderTrack);

        window.addEventListener('DOMContentLoaded', updateSliderTrack);
    });

    $(".img-div").click(function() {
        $(".golf_filter").addClass("show");
    });
    $(".close_popup").click(function() {
        $(".golf_filter").removeClass("show");
    });


    function search_it() {
        const grouped = {};
        const items = $(".list-tag .tag-item[data-group]");

        const types = items.each(function() {
            const group = $(this).data('group');
            const idx = $(this).data('idx');

            if (!grouped[group]) {
                grouped[group] = "";
            }

            if (grouped[group] !== "") {
                grouped[group] = grouped[group] + ",";
            }

            grouped[group] = grouped[group] + String(idx);
        });

        const priceMin = $("#slider-min").val();
        const priceMax = $("#slider-max").val();
        const priceType = $(".btn_fil_price.active").data("type");    

        if (priceMin) grouped["price_min"] = priceMin;
        if (priceMax) grouped["price_max"] = priceMax;
        if (priceType) grouped["price_type"] = priceType;

        grouped['pg'] = [1];

        const query = Object.keys(grouped).map(key => `${key}=${grouped[key]}`).join("&");
        const path = window.location.href.split('?')[0];
        window.location.href = path + (query ? `?${query}` : ``);

    }


    $(document).ready(function() {

        $('.icon_open_depth_new_').click(function() {
            let depth = $(this).data("depth");
            $('#' + depth).toggleClass('active_');
        })

        $(window).on('click', function(event) {
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

<?php $this->endSection(); ?>