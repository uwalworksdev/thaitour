<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

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
        <?php foreach ($list as $key_gubun => $item): ?>
        <div class="search__result <?=$key_gubun == $tab ? 'show' : ''?>" id="search__result_<?=$key_gubun?>">
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