<?php
    function getFilterItems($filter = [], $type = 1, $params = []) {
        ${"{$filter['filter_name']}"} = $params[$filter['filter_name']] ?? [];
        ?>
        <div class="category-left-item">
            <div class="subtitle">
                <span><?=$filter['code_name']?></span>
                <img class="arrow_menu" src="/uploads/icons/arrow_up_icon.png" alt="arrow_up">
            </div>
            <div class="tab_box_area_">
                <?php switch ($type) {
                    case 1: $arr = ${"{$filter['filter_name']}"} ?? []; ?>
                    <ul class="tab_box_show_">
                        <li class="tab_box_element_ tab_box_js <?= count($arr) == 0 ? 'tab_active_' : '' ?> p--20 border" data-group="<?=$filter['filter_name']?>" data-idx="0">전체</li>
                        <?php foreach ($filter['children'] as $item) { ?>
                            <li class="tab_box_element_ tab_box_js <?= in_array($item['code_no'], $arr) ? 'tab_active_' : '' ?> p--20 border" data-group="<?=$filter['filter_name']?>" data-idx="<?=$item['code_no']?>"><?=$item['code_name']?></li>
                        <?php } ?>
                    </ul>
                    <?php break;
                    case 2: $arr = ${"{$filter['filter_name']}"} ?? []; ?>
                    <div class="checkbox-group-golf-category">
                        <form>
                            <div class="form-group tab_box_js <?= count($arr) == 0 ? 'tab_active_' : '' ?>" data-group="<?=$filter['filter_name']?>" data-idx="0">
                                <label for="time1">전체</label>
                            </div>
                            <?php foreach ($filter['children'] as $item) { ?>
                                <div class="form-group tab_box_js <?= in_array($item['code_no'], $arr) ? 'tab_active_' : '' ?>" data-group="<?=$filter['filter_name']?>" data-idx="<?=$item['code_no']?>">
                                    <label for="time1"><?=$item['code_name']?></label>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                <?php break;
                default: break; } ?>
            </div>
        </div>
    <?php } ?>
<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<div class="content-sub-product-hotel custom-product-golf">
    <div class="body_inner">
        <?php echo view("/product/inc/navigation_container.php", ["parent_code" => 1302, "code_name" => $code_info['code_name'], "code_no" => $code_info['code_no']]); ?>
        <div class="sub-hotel-container">
            <div class="category-left golf_filter">
                <img class="close_popup only_mo" src="/uploads/icons/pop_close_icon.png" alt="close_icon">
                    <div class="only_web">                        
                        <div class="category-left-tit flex_b_c">
                            <h1 class="title"><?=$code_info['code_name']?></h1>
                            <div class="search-navigation flex">
                                <div class="navigation-container-next">
                                    <span class="font-bold"><?=$code_info['code_name']?></span>
    
                                    <div class="depth_2_tools_new_" id="depth_2_tools_new_">
                                        <ul class="depth_2_tool_list_new_" id="depth_2_tool_list_new_">
                                            <?php $parent_code = 1302?>
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
                <!-- <h1 class="title"><?=$code_info['code_name']?></h1> -->
                <div class="category-left-list">
                    <?php foreach ($filters as $key => $filter) {
                        $type = $filter['filter_name'] == "travel_times" ? 2 : 1;
                        getFilterItems($filter, $type, [
                            'green_peas' => $green_peas,
                            'sports_days' => $sports_days,
                            'slots' => $slots,
                            'golf_course_odd_numbers' => $golf_course_odd_numbers,
                            'travel_times' => $travel_times,
                            'carts' => $carts,
                            'facilities' => $facilities
                        ]);
                    } ?>
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
                    <span class="title-cate"><?=$code_info['code_name']?></span>
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
                        <p>총 상품 <span><?=$products["nTotalCount"]?></span></p>
                    </div>
<!--                    <div class="two-way-arrow-content">-->
<!--                        <a href="#" class="">-->
<!--                            <img class="two-way_arrow" src="/uploads/icons/2-way_arrow.png" alt="two-way_arrow">-->
<!--                            <span class="text-primary">추천순</span>-->
<!--                        </a>-->
<!--                    </div>-->
                </div>
                <?php foreach ($products['items'] as $key => $product): ?>
                    <div class="product-card-item-container">
                        <div class="product-card-item-left">
                            <a href="/product-golf/golf-detail/<?=$product['product_idx']?>">
                                <img src="<?=getImage("/data/product/{$product['ufile1']}")?>" alt="sub_hotel_1">
                            </a>
                        </div>
                        <div class="product-card-item-right">
                            <div class="title-container">
                                <a href="/product-golf/golf-detail/<?=$product['product_idx']?>">
                                    <h2><?=$product['product_name']?></h2>
                                </a>
                                <div class="only_web">
                                    <div class="star-container">
                                        <div class="">
                                            <img src="/uploads/icons/star_icon.png" alt="star_icon">
                                            <span><?=$product['review_average']?></span>
                                        </div>
                                        <div class="star-content">
                                            <span class="text-primary">생생리뷰 <strong>(<?=$product['total_review']?>)</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-title">
                                <?php $num = count($product['codeTree']);
                                foreach ($product['codeTree'] as $key => $code):
                                    ?>
                                    <span><?=$code['code_name']?></span>
                                    <?php if ($key < $num - 1): ?>
                                        <img class="only_web" src="/uploads/icons/arrow_right.png"
                                            alt="arrow_right">
                                        <img class="only_mo arrow_right_mo" src="/uploads/icons/arrow_right_mo.png"
                                            alt="arrow_right_mo">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="only_mo">
                                <div class="star-container">
                                    <div class="star-left">
                                        <img src="/uploads/icons/star_icon_mo.png" alt="star_icon_mo">
                                        <span><?=$product['review_average']?></span>
                                    </div>
                                    <div class="star-content">
                                        <span class="text-primary">생생리뷰 <strong>(<?=$product['total_review']?>)</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-item-info">
                                <div class="item-info">
                                    <div class="item-info-label text-gray">
                                        ✓ 장거리 이동도 편안하게! 22인승 럭셔리 리무진 탑승<br>
                                        ✓ 미서부 핵심 3대 도시 + 4대캐년 관광
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="item-info">
                                        <div class="item-price-info">
                                                <span class="main">
                                                    <?= number_format($product['product_price_won']) ?> </span>
                                            <span class="text-gray"> 원 ~</span>
                                            <span class="sub text-gray"><?= number_format($product['product_price']) ?>바트~</span>
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
                <?=ipagelistingSub($products["pg"], $products["nPage"], $products["g_list_rows"], $newUrl)?>
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
            $('.tab_box_js.tab_active_[data-idx!="0"]').filter(function () {
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

                // Remove the active class from the corresponding tab
                $('.tab_box_js').each(function() {
                    if ($(this).data("idx") === tagIdx) {
                        $(this).removeClass('tab_active_');
                    }
                });

                // Remove the tag item
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
                $(this).parent().siblings().slideToggle();
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

                if (min > max) {
                    [sliderMin.value, sliderMax.value] = [sliderMax.value, sliderMin.value];
                }

                const percentMin = (sliderMin.value - sliderMin.min) / (sliderMin.max - sliderMin.min) * 100;
                const percentMax = (sliderMax.value - sliderMax.min) / (sliderMax.max - sliderMax.min) * 100;

                sliderTrack.style.left = percentMin + '%';
                sliderTrack.style.width = (percentMax - percentMin) + '%';
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

            const types = items.each(function () {
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

            grouped['pg'] = [1];

            const query = Object.keys(grouped).map(key => `${key}=${grouped[key]}`).join("&");
            const path = window.location.href.split('?')[0];
            window.location.href = path + (query ? `?${query}` : ``);
            
        }

        
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
    </script>

    <?php $this->endSection(); ?>