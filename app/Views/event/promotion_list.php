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

                <form name="frmSearch" id="frmSearch" method="GET">
                    <div class="magazines_list__top_right_">
                        <div class="form_el_">
                            <select name="search_category" id="search_mode_" class="select_sort_">
                                <option value="title" <?php if($search_category == "title"){ echo "selected"; }?>>제목</option>
                            </select>
                        </div>
                        <div class="form_el_">
                            <input type="text" class="input_search_" name="search_txt" id="search_word_" value="<?=$search_txt?>" placeholder="검색어를 입력해 주세요">
                            <div class="icon_">
                                <img role="button" src="/images/ico/icon_search_23_22.png" alt="" class="icon_search_" id="icon_search_" onclick="search_it()">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="magazines_list__content_">
                <?php
                    foreach($result as $row) {
                        if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/promotion/" . $row["ufile1"])) {
                            $img = "/data/promotion/" . $row["ufile1"];
                        } else {
                            $img = "/data/product/noimg.png";
                        }

                        if ($row["ufile3"] != "" && is_file(ROOTPATH . "/public/data/promotion/" . $row["ufile3"])) {
                            $img_mo = "/data/promotion/" . $row["ufile3"];
                        } else {
                            $img_mo = "/data/product/noimg.png";
                        }
                ?>
                    <a href="/promotion?idx=<?=$row["idx"]?>" class="magazines_list__item_">
                        <img src="<?=$img?>" alt="<?=$row["title"]?>" class="magazines_list__item_image_ only_web">
                        <img src="<?=$img_mo?>" alt="<?=$row["title"]?>" class="magazines_list__item_image_ only_mo">
                        <div class="magazines_list__item_title_ text_truncate_">
                            <?=$row["title"]?> 
                        </div>
                        <div class="magazines_list__item_desc_">
                            <?=date("Y-m-d", strtotime($row["r_date"]))?> (<?=dateToYoil($row["r_date"])?>) <span class="src_">|</span> <span class="view_"><?=$row["hit"]?></span>
                        </div>
                    </a>
                <?php
                    }
                ?>
            </div>

            <?php 
                echo ipagelistingSub($pg, $nPage, $g_list_rows, current_url() . "?search_category=". $search_category ."&search_txt=". $search_txt ."&pg=")
            ?>
        </div>
    </div>
</main>
<script>
    function search_it() {
        let frm = document.frmSearch;
        frm.submit();
    }
</script>
<?php $this->endSection(); ?>