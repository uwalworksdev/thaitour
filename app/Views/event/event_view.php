<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<script src="/js/cms.js" type="text/javascript"></script>
<div id="container" class="sub view_container">

    <section class="view_sect">
        <div class="inner">
            <div class="view_top">
                <div class="sect_ttl_box">
                    <h2><?= $event['subject'] ?></h2>
                </div>
                <p class="date"><?= date("Y.m.d", strtotime($event['r_date'])) ?></p>
            </div>
            <div class="view_content">
                <div class="view_content-detail">
                    <?= viewSQ($event['contents']) ?>
                </div>
            </div>

            <div class="view_relate">
                <h2 class="ttl"><span>관련</span> 여행상품</h2>
                <div class="prd_slider item_list quarter_slider">
                    <?php
                    foreach ($related_products as $row_s) {
                        $img = "";
                        $img = get_img($row_s["ufile1"], "/data/product", "300", "218");

                        if ($row_s['product_code_1'] == "1324")
                            $urlLink = "/t-package";
                        if ($row_s['product_code_1'] == "1320")
                            $urlLink = "/t-honeymoon";
                        if ($row_s['product_code_1'] == "1317")
                            $urlLink = "/t-tours";
                        if ($row_s['product_code_1'] == "1325")
                            $urlLink = "/t-trip";

                        if ($row_s['product_code_1'] == "1325" || $row_s['product_code_1'] == "1317") {
                            $product_price = round(($row_s['product_price'] * _US_DOLLAR) / 10) * 10;
                            $original_price = round(($row_s['original_price'] * _US_DOLLAR) / 10) * 10;
                        }

                        if ($row_s['product_code_1'] == "1324" || $row_s['product_code_1'] == "1320") {
                            $product_price = $row_s['product_price'] / _US_DOLLAR;
                            $original_price = $row_s['original_price'] / _US_DOLLAR;
                        }

                        ?>
                        <div class="slide_item">
                            <a href="<?= $urlLink ?>/item_view?product_idx=<?= $row_s['product_idx'] ?>">
                                <div class="list_prd_img">
                                    <figure class="cover_img">
                                        <img src="<?= $img ?>" alt="<?= $row_s['product_name'] ?>상품썸네일">
                                    </figure>
                                    <div class="tag_box">

                                        <?php if ($row_s['product_best'] == "Y") { ?>
                                            <picture class="best_ico">
                                                <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_best_m.png">
                                                <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                                            </picture>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="list_prd_info">
                                    <strong class="prd_tit"><?= $row_s['product_name'] ?></strong>
                                    <span class="prd_desc"><?= viewSQ(html_entity_decode($row_s['product_info'])) ?></span>
                                    <div class="amount flex__e">
                                        <?php
                                        $percent = 100 - ((int) ($product_price / $original_price * 100));
                                        if ($percent != 0) {
                                            ?>
                                            <p class="discount">
                                                <strong><?= 100 - ((int) ($product_price / $original_price * 100)) ?></strong>%</p>
                                        <?php } ?>
                                        <?php if ($row_s['product_code_1'] == "1324" || $row_s['product_code_1'] == "1320") { ?>
                                            <p class="price">
                                                <strong><?= number_format($row_s['product_price']) ?></strong>원($<?= number_format($product_price) ?>)
                                            </p>
                                        <?php }
                                        if ($row_s['product_code_1'] == "1317" || $row_s['product_code_1'] == "1325") { ?>
                                            <p class="price">
                                                <strong><?= number_format($product_price) ?></strong>원($<?= number_format($row_s['product_price']) ?>)
                                            </p>
                                        <?php } ?>
                                        <?php
                                        if ($percent != 0) {
                                            ?>
                                            <?php if ($row_s['product_code_1'] == "1324" || $row_s['product_code_1'] == "1320") { ?>
                                                <p class="cost">~
                                                    <?= number_format($row_s['original_price']) ?>원($<?= number_format($original_price) ?>)
                                                </p>
                                            <?php }
                                            if ($row_s['product_code_1'] == "1317" || $row_s['product_code_1'] == "1325") { ?>
                                                <p class="cost">~
                                                    <?= number_format($original_price) ?>원($<?= number_format($row_s['original_price']) ?>)
                                                </p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="comment_box">
                    <div class="comment_box-top">
                        <div class="comment_box-count">
                            <span>댓글</span>
                            <span id="comment_count">(0)</span>
                        </div>
                        <form name="com_form" id="com_form" method="post" onsubmit="return false">
                            <input type="hidden" name="r_code" id="r_code" value="<?= $event['code'] ?>">
                            <input type="hidden" name="r_idx" id="r_idx" value="<?= $event['bbs_idx'] ?>">
                            <input type="hidden" name="tbc_idx" id="tbc_idx" value="">
                            <div class="comment_box-input flex">
                                <textarea style="resize:none" name="comment" class="bs-input" id="contents"
                                    placeholder="댓글을 입력해주세요."></textarea>
                                <button type="button" onclick="fn_comment(<?=session('member.idx')?>);"
                                    class="btn btn-point btn-lg comment_btn">등록</button>
                            </div>
                        </form>
                    </div>
                    <div class="comment_box-details comment" id="comment_list">

                    </div>
                </div>
                <?php
                // include $_SERVER['DOCUMENT_ROOT'] . "/inc/popup_inc.php";
                echo view("inc/popup_inc");
                ?>
                <div class="btn-wrap">
                    <button onclick="go_list();" class="btn btn-lg go_to_list">목록으로</button>
                </div>
            </div>
    </section>
</div>

<script>
    function go_list() {
        // location.href = '/event/winning_list';
        history.back();
    }
    const r_code = "event";
    const r_idx = '<?= $event['bbs_idx'] ?>';
    
</script>

<script src="/js/comment.js"></script>


<?php $this->endSection(); ?>