<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <style>
        #delete_all {
            padding: 8px 12px;
            background-color: #fff;
            color: #252525;
            /*font-weight: 600;*/
        }
    </style>
    <div class="content-sub-product-hotel">
        <div class="body_inner">
            <?php echo view("/product/inc/navigation_container.php", ["parent_code" => 1301, "code_name" => $code_name, "code_no" => $code_no]); ?>
            <form name="frmSearch" id="frmSearch">
                <div class="sub-hotel-container">
                    <input type="hidden" name="search_keyword" id="search_keyword"
                           value="<?= $search_keyword ?>">
                    <input type="hidden" name="search_product_tour" id="search_product_tour"
                           value="<?= $search_product_tour ?>">
                    <input type="hidden" name="price_type" id="price_type" value="<?= $products["price_type"] ?? "" ?>">
                    <input type="hidden" name="pg" id="pg" value="<?= $products["pg"] ?>">

                    <div class="category-left only_web">
                        <div class="category-left-tit flex_b_c">
                            <h1 class="title"><?= $code_name ?></h1>
                            <div class="search-navigation flex">
                                <div class="navigation-container-next">
                                    <span class="font-bold"><?= $code_name ?></span>
    
                                    <div class="depth_2_tools_new_" id="depth_2_tools_new_">
                                        <ul class="depth_2_tool_list_new_" id="depth_2_tool_list_new_">
                                            <?php $parent_code = 1301?>
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
                        <div class="category-left-list">
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>키워드</span>
                                    <img src="/uploads/icons/arrow_up_icon.png" class="arrow_menu" alt="arrow_up">
                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php if ($search_keyword == "all" || empty($search_keyword)): ?>
                                                tab_active_
                                            <?php elseif ($search_keyword == $item): ?>
                                                tab_active_
                                            <?php endif; ?>"
                                            data-keyword="all" data-type="keyword">전체키워드
                                        </li>
                                        <?php foreach ($keyWordAll as $key => $item): ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                                <?= ($search_keyword == $item) ? 'tab_active_' : '' ?>"
                                                data-keyword="<?= $item ?>" data-type="keyword">#<?= $item ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-left-item">
                                <div class="subtitle">
                                    <span>투어타입</span>

                                </div>
                                <div class="tab_box_area_">
                                    <ul class="tab_box_show_">
                                        <li class="tab_box_element_ tab_box_js p--20 border
                                        <?php 
                                            if (strpos($search_product_tour, "all") !== false || empty($search_product_tour)) {
                                                echo "tab_active_";
                                            }
                                        ?>" data-code="all" data-type="tour">전체타입</li>

                                        <?php foreach ($product_theme as $code): ?>
                                            <li class="tab_box_element_ tab_box_js p--20 border
                                            <?php 
                                                if (strpos($products["search_product_tour"], $code["code_no"]) !== false) {
                                                    echo "tab_active_";
                                                }
                                            ?>" data-code="<?= $code["code_no"] ?>" data-tour="<?= $code["code_name"] ?>" data-type="tour"><?= $code["code_name"] ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="category-left-item">
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
                                        <input type="range" min="0" max="<?= $products["total_price_max"] ?>" value="<?= $products["price_min"] ?>"
                                               name="price_min" class="slider" id="slider-min">
                                        <input type="range" min="0" max="<?= $products["total_price_max"] ?>" value="<?= $products["price_max"] ?>"
                                               name="price_max" class="slider" id="slider-max">
                                    </div>
                                    <div class="filter_price_wrap">
                                        <span class="price_range">
                                            <i class="price_min">0</i>원 ~ <i class="price_max">0</i>원 이상
                                        </span>
                                        <div class="filter">
                                            <button type="button" class="btn_fil_price <?php if(empty($products["price_type"]) || $products["price_type"] == "W"){ echo "active"; } ?>" data-type="W">원</button>
                                            <button type="button" class="btn_fil_price <?php if($products["price_type"] == "B"){ echo "active"; } ?>" data-type="B">바트</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-right">

                        <div class="filter-container form_element_">
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
                            <div class="search_keyword flex__c">
                                <!--                                <div class="two-way-arrow-content">-->
                                <!--                                    <a href="#" class="">-->
                                <!--                                        <img class="two-way_arrow" src="/uploads/icons/2-way_arrow.png" alt="two-way_arrow">-->
                                <!--                                        <span class="text-primary">추천순</span>-->
                                <!--                                    </a>-->
                                <!--                                </div>-->
                                <form name="frm" method="GET" action="/search">
                                    <div class="btn_search flex_b_c">
                                        <input type="text" class="txt" id="top_search" name="search_word"
                                               value="<?= $search_word ?>" placeholder="여행을 검색해 주세요.">
                                        <button type="submit" class="search_words" style="cursor:pointer;"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                                    <a href="/product-tours/item_view/<?= $product["product_idx"] ?>">
                                        <img src="<?= $src ?>" alt="sub_hotel_1">
                                    </a>
                                </div>
                                <div class="product-card-item-right">
                                    <div class="title-container">
                                        <a href="/product-tours/item_view/<?= $product["product_idx"] ?>">
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
                                        <div class="sub-title tour">
                                            <?php $num = count($product['codeTree']);
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
                                    </div>
                                    <div class="list-item-info">
                                        <div class="item-info">
                                            <div class="item-info-label text-gray flex_tour">
                                                <?php
                                                $arr_keyword = explode(",", $product['keyword']);
                                                $arr_keyword = array_filter($arr_keyword);
                                                ?>
                                                <?php foreach ($arr_keyword as $keyword): ?>
                                                    <p>#<?= $keyword ?></p>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-price-info">
                                                <span class="main"><?= number_format($product['product_price_won']) ?></span class="text-gray"> 원
                                                ~
                                                <span class="sub text-gray"><?= number_format($product['product_price']) ?>바트~</span>
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
        </div>
    </div>
    <script>
        var baht_thai = parseFloat('<?=$baht_thai?>');

        $(".content-sub-product-hotel .btn_fil_price").on("click", function() {
            $(this).addClass("active").siblings().removeClass("active");
            let type = $(this).data("type");
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

        const codeMapping = <?= json_encode(array_column($product_theme, 'code_name', 'code_no')) ?>;


        $(document).ready(function () {
            let keywords = $("#search_keyword").val().split(",").filter(item => item && item !== "all");
            let tours = $("#search_product_tour").val().split(",").filter(item => item && item !== "all");

            update_tags(keywords, tours);

            keywords.forEach(function (keyword) {
                if (keyword !== "all") {
                    $(".tab_box_js[data-keyword='" + keyword + "']").addClass('tab_active_');
                } else {
                    $(".tab_box_js[data-keyword='all']").addClass('tab_active_');
                }
            });

            tours.forEach(function (tour) {
                if (tour !== "all") {
                    $(".tab_box_js[data-code='" + tour + "']").addClass('tab_active_');
                } else {
                    $(".tab_box_js[data-code='all']").addClass('tab_active_');
                }
            });
        });

        function update_tags(keywords, tours) {
                $('.list-tag').empty(); 

                if (keywords.includes("all") && keywords.length > 1) {
                    keywords = keywords.filter(keyword => keyword !== "all");
                }

                keywords.forEach(function (keyword) {
                    if (keyword && keyword !== "undefined") {
                        let tabText = (keyword === "all") ? "전체키워드" : keyword;
                        $('.list-tag').append(
                            '<div class="tag-item">' +
                            '<span data-type="keyword">' + tabText + '</span>' +
                            '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                            '</div>'
                        );
                    }
                });

                if (keywords.length === 0) {
                    $('.list-tag').append(
                        '<div class="tag-item">' +
                        '<span data-type="keyword">전체키워드</span>' +
                        '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                        '</div>'
                    );
                }

                if (tours.includes("all") && tours.length > 1) {
                    tours = tours.filter(tour => tour !== "all");
                }

                let addedTours = new Set();
                tours.forEach(function (tour) {
                    if (tour && tour !== "undefined" && !addedTours.has(tour)) {
                        let tabText = (tour === "all") ? "전체타입" : (codeMapping[tour] || tour); 
                        $('.list-tag').append(
                            '<div class="tag-item">' +
                            '<span data-type="tour">' + tabText + '</span>' +
                            '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                            '</div>'
                        );
                        addedTours.add(tour);
                    }
                });

                if (tours.length === 0) {
                    $('.list-tag').append(
                        '<div class="tag-item">' +
                        '<span data-type="tour">전체타입</span>' +
                        '<img class="close_icon" src="/uploads/icons/close_icon.png" alt="close_icon">' +
                        '</div>'
                    );
                }
            }

            function update_search_keyword() {
                let keywords = [];
                let codes = [];
                let tours = [];

                $(".tab_box_js.tab_active_").each(function () {
                    let keyword = $(this).data("keyword");
                    if (keyword && keyword !== "all" && !keywords.includes(keyword)) {
                        keywords.push(keyword);
                    }

                    let code = $(this).data("code");
                    if (code && code !== "all" && !codes.includes(code)) {
                        codes.push(code);
                    }

                    let name = $(this).data("tour");
                    if (name && name !== "all" && !tours.includes(name)) {
                        tours.push(name);
                    }
                });

                if (keywords.length === 0) {
                    keywords.push("all");
                }

                if (codes.length === 0) {
                    codes.push("all");
                }

                if (tours.length === 0) {
                    tours.push("all");
                }

                $("#search_keyword").val(keywords.join(","));
                $("#search_product_tour").val(codes.join(","));

                update_tags(keywords, tours);
            }

        $('.tab_box_js').click(function () {
            let group = $(this).closest('.tab_box_area_');

            if ($(this).data("keyword") === "all") {
                group.find('.tab_box_js').not(this).removeClass('tab_active_');
                $(this).addClass('tab_active_');
            } else if ($(this).data("keyword")) {
                $(this).toggleClass('tab_active_');
                if ($(this).hasClass('tab_active_')) {
                    group.find('[data-keyword="all"]').removeClass('tab_active_');
                }
            }

            if ($(this).data("code") === "all") {
                group.find('.tab_box_js').not(this).removeClass('tab_active_');
                $(this).addClass('tab_active_');
            } else if ($(this).data("code")) {
                $(this).toggleClass('tab_active_');
                if ($(this).hasClass('tab_active_')) {
                    group.find('[data-code="all"]').removeClass('tab_active_');
                }
            }

            update_search_keyword();
        });

        $('.list-tag').on('click', '.tag-item .close_icon', function () {
            let $tagItem = $(this).closest('.tag-item'); 
            let text = $tagItem.find('span').text().trim(); 
            let type = $tagItem.find('span').data('type'); 

            let keywords = $("#search_keyword").val().split(",").filter(item => item);
            let tours = $("#search_product_tour").val().split(",").filter(item => item);

            if (type === "keyword") {
                keywords = keywords.filter(keyword => keyword !== text);
                if (keywords.length === 0) keywords.push("all");
                $("#search_keyword").val(keywords.join(","));
            } else if (type === "tour") {
                tours = tours.filter(tour => tour !== text);
                if (tours.length === 0) tours.push("all");
                $("#search_product_tour").val(tours.join(","));
            }

            $(".tab_box_js").each(function () {
                if ($(this).data("keyword") === text || $(this).data("code") === text) {
                    $(this).removeClass('tab_active_');
                }
            });

            $tagItem.remove();
        });

        $('#delete_all').click(function () {
            $('.list-tag .tag-item').remove();

            $("#search_keyword").val("all");
            $("#search_product_tour").val("all");

            $(".tab_box_js").removeClass('tab_active_');

            // update_tags(["all"], ["all"]);
        });


        $(window).resize(function () {
            update_search_keyword();
        });

        function search_it() {
            let frm = document.frmSearch;
            let keywords = $("#search_keyword").val().split(",").filter((item, index, self) => self.indexOf(item) === index);
            let tours = $("#search_product_tour").val().split(",").filter((item, index, self) => self.indexOf(item) === index);

            if (keywords.length === 0) {
                $("#search_keyword").val("all");
            }
            if (tours.length === 0) {
                $("#search_product_tour").val("all");
            }
            frm.submit();
        }



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

<?php $this->endSection(); ?>