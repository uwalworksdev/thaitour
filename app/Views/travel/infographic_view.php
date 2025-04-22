<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<script src="/js/cms.js" type="text/javascript"></script>

<div id="container" class="sub view_container">
    <section class="view_sect">
        <div class="inner">
            <div class="view_top_wrap">
                <h4 class="view_top_ttl"><?= $infographic['subject'] ?></h4>
                <?php
                    $arrDayOfWeek = ['일', '월', '화', '수', '목', '금', '토'];
                    $dateString = $infographic["r_date"];
                    $timestamp = strtotime($dateString);
                    $dayOfWeek = date('w', $timestamp);
                ?>
                <div class="view_top_info">
                    <p class="writer"><?=$infographic['writer']?></p>
                    <span>|</span>
                    <p class="date"><?= date("Y.m.d", strtotime($infographic['r_date'])) ?>(<?=$arrDayOfWeek[$dayOfWeek]?>)</p>
                    <span>|</span>
                    <p class="view">조회수 : <?=$infographic['hit']?></p>
                </div>
            </div>
            <div class="view_content">
                <div class="view_content-detail">
                    <?= viewSQ($infographic['contents']) ?>
                </div>
            </div>

            <div class="btn-wrap">
                <button onclick="go_list();" class="btn btn-lg go_to_list">목록으로</button>
            </div>

            <div class="view_relate">
                <div class="comment_box">
                    <div class="comment_box-top">
                        <div class="comment_box-count">
                            <span>댓글</span>
                            <span id="comment_count">(0)</span>
                        </div>
                        <?php
                            if(isset(session()->get("member")['idx'])){
                        ?>
                            <form name="com_form" id="com_form" method="post" onsubmit="return false">
                                <input type="hidden" name="r_code" id="r_code" value="<?= $infographic['code'] ?>">
                                <input type="hidden" name="r_idx" id="r_idx" value="<?= $infographic['bbs_idx'] ?>">
                                <input type="hidden" name="tbc_idx" id="tbc_idx" value="">
                                <div class="comment_box-input flex">
                                    <textarea style="resize:none" name="comment" class="bs-input" id="contents"
                                        placeholder="댓글을 입력해주세요."></textarea>
                                    <button type="button" onclick="fn_comment(<?=session('member.idx')?>);"
                                        class="btn btn-point btn-lg comment_btn">등록</button>
                                </div>
                            </form>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="comment_box-details comment" id="comment_list">

                    </div>
                </div>
                <?php
                    echo view("inc/popup_inc");
                ?>
            </div>
    </section>
</div>

<script>
    function go_list() {
        history.back();
    }
    const r_code = "infographics";
    const r_idx = '<?= $infographic['bbs_idx'] ?>';
</script>

<script src="/js/comment.js"></script>

<?php $this->endSection(); ?>