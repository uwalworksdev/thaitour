<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/magazines/magazines.css">
<main id="container" class="sub magazines_page_">
    <div class="inner magazines_area_">
        <!-- <div class="magazines_breadcrumb_">
                <ul class="breadcrumb_">
                    <li class="breadcrumb_item_">
                        <a href="#"><img class="home_icon_" src="/images/ico/home_icon_14_12.png" alt=""></a>
                    </li>
                    <li class="breadcrumb_item_">
                        <img class="home_icon_" src="/images/ico/navi_icon_7_14.png" alt="">
                    </li>
                    <li class="breadcrumb_item_">
                        <a href="#">
                            <span>매거진</span>
                            <img class="circle_direct_" src="/images/ico/circle_direct_18_18.png" alt=""></a>
                    </li>
                </ul>
            </div> -->
        <div class="sect_ttl_box">
            <h2>프로모션</h2>
        </div>

        <div class="magazines_list_">
            <div class="magazines_list__top_">
                <div class="magazines_list__top_left_">
                    <div class="total_">
                        총 상품
                        <span class="count_"><?=$nTotalCount?></span>
                    </div>
                </div>

                <div class="magazines_list__top_right_">
                    <div class="form_el_">
                        <select name="search_category" id="search_mode_" class="select_sort_">
                            <option value="subject">제목</option>
                        </select>
                    </div>
                    <div class="form_el_">
                        <input type="text" class="input_search_" name="search_txt" id="search_word_" value="" placeholder="검색어를 입력해 주세요">
                        <div class="icon_">
                            <img role="button" src="/images/ico/icon_search_23_22.png" alt="" class="icon_search_" id="icon_search_">
                        </div>
                    </div>
                </div>
            </div>
            <div class="magazines_list__content_">
                <?php
                    foreach($result as $row) {
                        if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/promotion/" . $row["ufile1"])) {
                            $img = "/data/promotion/" . $row["ufile1"];
                        } else {
                            $img = "/data/product/noimg.png";
                        }
                ?>
                    <a href="/promotion?idx=<?=$row["title"]?>" class="magazines_list__item_">
                        <img src="<?=$img?>" alt="<?=$row["ufile1"]?>" class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            <?=$row["title"]?> </div>
                        <div class="magazines_list__item_desc_">
                            <?=date("Y-m-d", strtotime($row["r_date"]))?> (금) <span class="src_">|</span> <span class="view_">36</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            관리자 </div>
                    </a>
                <?php
                    }
                ?>
            </div>

            <div class="pagination_">
                <div class="customer-center-page">
                    <div class="pagination">
                        <a class="page-link" href="javascript:void(0);" aria-label="First"><img src="/images/community/pagination_prev.png" alt="pagination_prev">
                        </a>
                        <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                            <img src="/images/community/pagination_prev_s.png" alt="pagination_prev">
                        </a>
                        <a class="page-link active" href="https://thetourlab.com/magazines/list?page=1">
                            1 </a>
                        <a class="page-link" href="javascript:void(0);" aria-label="Next"><img src="/images/community/pagination_next_s.png" alt="pagination_next">
                        </a>
                        <a class="page-link" href="javascript:void(0);" aria-label="Last">
                            <img src="/images/community/pagination_next.png" alt="pagination_next">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $("#icon_search_").click(function() {
        const search_mode = $("#search_mode_").val();
        const search_word = $("#search_word_").val();
        location.href = "/magazines/list?search_mode=" + search_mode + "&search_word=" + search_word
    })
</script>
<?php $this->endSection(); ?>