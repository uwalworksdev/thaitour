<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
    $str_search_txt = preg_replace('/[^a-zA-Z0-9가-힣\s]+/u', ' ', trim($search_name));
    $arr_search_txt = preg_split('/\s+/', $str_search_txt);
?>
<section class="item_search_section">
    <div class="body_inner">
        <div class="search__summary">
            <span>“<?=$search_name?>”</span> 검색어 결과로 총 <span><?=$total?> 건</span>이 검색되었습니다.
        </div>
        <div class="search__box">
            <select id="search_cate" class="search__type">
                <option value="">통합검색</option>
                <?php foreach ($list as $key => $item): ?>
                    <option value="<?=$key?>" <?=$key == $search_cate ? 'selected' : ''?>>
                        <?=$item['title']?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" class="search__input" id="search__input" value="<?=$search_name?>">
            <button class="search__btn" onclick="search_it()">검색</button>
        </div>
        <div class="search__tabs">
            <ul>
                <?php foreach ($list as $key => $item): ?>
                    <li class="search__tab search__tab_<?=$key?> <?= $key == $tab ? 'active' : ''?>" data-tab="<?=$key?>">
                        <button type="button" data-tab="<?=$key?>">
                            <?=$item['title']?> <?=$item['result']['nTotalCount']?>건
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php foreach ($list as $key => $item): ?>
        <div class="search__result <?=$key == $tab ? 'show' : ''?>" id="search__result_<?=$key?>">
            <div class="search__result__head">
                <h1 class="ttl"><?=$item['title']?><span>(<?=$item['result']['nTotalCount']?>)</span></h1>
                <ul class="search__result__sort">
                    <li><a href="#!" onclick="sort_it('recommended')" class="<?=$sort == "recommended"    ? "active" : ""?>">추천순</a></li>
                    <li><a href="#!" onclick="sort_it('reservation')" class="<?=$sort == "reservation"    ? "active" : ""?>">예약순</a></li>
                    <li><a href="#!" onclick="sort_it('rating')" class="<?=$sort == "rating"         ? "active" : ""?>">평점순</a></li>
                    <li><a href="#!" onclick="sort_it('highest_price')" class="<?=$sort == "highest_price"  ? "active" : ""?>">높은가격순</a></li>
                    <li><a href="#!" onclick="sort_it('lowest_price')" class="<?=$sort == "lowest_price"   ? "active" : ""?>">낮은가격순</a></li>
                </ul>
                <select class="search__result__sort__select only_mo" onchange="sort_it(this.value)">
                    <option value="recommended" <?=$sort == "recommended" ? "selected" : ""?>>추천순</option>
                    <option value="reservation" <?=$sort == "reservation" ? "selected" : ""?>>예약순</option>
                    <option value="rating" <?=$sort == "rating" ? "selected" : ""?>>평점순</option>
                    <option value="highest_price" <?=$sort == "highest_price" ? "selected" : ""?>>높은가격순</option>
                    <option value="lowest_price" <?=$sort == "lowest_price" ? "selected" : ""?>>낮은가격순</option>
                </select>
            </div>
            <div class="search__result__list">
                <?php foreach ($item['result']['items'] as $item1_1):
                    switch ($key) {
                        case "hotel":
                            $href = "/product-hotel/hotel-detail/{$item1_1['product_idx']}";
                            break;
                        case "golf":
                            $href = "/product-golf/golf-detail/{$item1_1['product_idx']}";
                            break;
                        case "tour":
                            $href = "/product-tours/item_view/{$item1_1['product_idx']}";
                            break;
                        case "spa":
                            $href = "/product-spa/spa-details/{$item1_1['product_idx']}";
                            break;
                        case "show_ticket":
                            $href = "/ticket/ticket-detail/{$item1_1['product_idx']}";
                            break;
                        case "restaurant":
                            $href = "/product-restaurant/restaurant-detail/{$item1_1['product_idx']}";
                            break;
                        case "vehicle":
                            $href = "#!";
                            break;
                        default:
                            $href = "#!";
                    }
                    ?>
                    <a href="<?=$href?>" class="product-card-item-container">
                        <div class="product-card-item-left">
                            <span>
                                <img src="<?=getImage("/data/product/{$item1_1['ufile1']}")?>" alt="sub_hotel_1">
                            </span>
                        </div>
                        <div class="product-card-item-right">
                            <div class="title-container">
                                <div>
                                    <h2><?=$item1_1['product_name']?></h2>
                                    <div class="sub-title">
                                        <?php $num = count($item1_1['codeTree']);
                                        foreach ($item1_1['codeTree'] as $key => $code):
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
                                </div>
                                <div class="star-container">
                                    <div class="star-left">
                                        <img src="/uploads/icons/star_icon_mo.png" alt="star_icon_mo">
                                        <span><?=$item1_1['review_average']?></span>
                                    </div>
                                    <div class="star-content">
                                        <span class="text-primary">생생리뷰 <strong>(<?=$item1_1['total_review']?>)</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="list-item-info">
                                <div class="item-info">
                                    <div class="item-info-label text-gray">
                                        <?php
                                            $arr_keyword = explode(",", $item1_1['keyword']);
                                            $arr_keyword = array_filter($arr_keyword);
                                        ?>
                                        <?php foreach ($arr_keyword as $key => $keyword): ?>
                                            <?=$key > 0 ? '&nbsp;&nbsp;' : ''?>
                                            #<?= $keyword?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="item-price-info">
                                        <?php 
                                            if($item1_1['is_won_bath'] == "W" || $item1_1['is_won_bath'] == "B"){
                                                if($item1_1['is_won_bath'] == "W"){
                                        ?>
                                            <span class="main"><?=number_format($item1_1['product_price_won'])?></span class="text-gray"> 원</span></span>
                                        <?php
                                                }else if($item1_1['is_won_bath'] == "B"){
                                        ?>    
                                            <span class="main"><?=number_format($item1_1['product_price'])?></span class="text-gray"> 바트 ~</span>    
                                        <?php
                                                }
                                            }else{
                                        ?>   
                                            <span class="main"><?=number_format($item1_1['product_price_won'])?></span class="text-gray"> 원 ~</span>
                                            <span class="sub text-gray"><?=number_format($item1_1['product_price'])?>바트</span>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<script>
    $(document).ready(function () {
        var search_cate = '<?=$search_cate?>';

        $("#search_cate_pc__header").find("option[value='" + search_cate + "']").prop("selected", true);
        $("#search_input_pc__header").val("<?=$search_name?>");
    })
    $(".search__tabs ul li button").on("click", function () {
        var idx = $(this).parent().index();
        $(".search__tabs ul li").removeClass("active");
        $(this).parent().addClass("active");
        $(".search__result").removeClass("show");
        $(".search__result").eq(idx).addClass("show");
        const currentUrl = new URL(window.location);
        var tab = $(this).data("tab");
        currentUrl.searchParams.set("tab", tab);
        history.replaceState(null, null, currentUrl.toString());
    });
    function sort_it(sort) {
        var tab = $(".search__tab.active").data("tab");
        var search_name = $("#search__input").val();
        var search_cate = $("#search_cate").val();
        location.href = "/product_search?sort=" + sort + "&tab=" + tab + "&search_name=" + search_name + "&search_cate=" + search_cate;
    }
    function search_it() {
        var search_name = $("#search__input").val();
        var search_cate = $("#search_cate").val();
        location.href = "/product_search?search_name=" + search_name + "&search_cate=" + search_cate;
    }
    $("#search__input").on("keydown", function (e) {
        if (e.keyCode == 13) {
            search_it();
        }
    })
</script>
<?php $this->endSection(); ?>