<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$r_code = "review";

$user_name = sqlSecretConver($review["user_name"], 'decode');
$user_email = sqlSecretConver($review["user_email"], 'decode');

$ufile2 = $review["ufile2"];
$rfile2 = $review["rfile2"];
$r_date = $review["r_date"];
$product_name = $review["product_name"];
$code_name = $review["code_name"];

$title = $review['title'];
$contents = $review["contents"];
$reg_m_idx = $review["reg_m_idx"];
?>
<link href="/css/inquiry/inquiry.css" rel="stylesheet" type="text/css" />
<link href="/css/inquiry/inquiry_responsive.css" rel="stylesheet" type="text/css" />
<style>
    .inquiry_view_section .inquiry_table .subject {
        word-break: break-all;
    }
</style>
<div id="container" class="sub view_container ">
    <section class="view_sect">
        <div class="inner">
            <div class="view_top" style="padding-bottom: 0">
                <div class="sect_ttl_box">
                    <h2><?= $review['title'] ?></h2>

                </div>
            </div>
            <div class="view_content-top">
                <ul>
                    <div class="line flex_b_c">
                        <li>
                            <h4>여행형태</h4>
                            <div class="view_content-info">
                                <?= $code_name ?>
                            </div>
                        </li>
                        <li>
                            <div class="main_info flex">
                                <p><?= $user_name ?></p>
                                <p class="date"><?= date("Y.m.d", strtotime($r_date)) ?></p>
                            </div>
                        </li>
                    </div>
                    <?php
                    if ($ufile2) {
                        ?>
                        <li class="view_content-file file">
                            <h4>첨부파일</h4>
                            <div class="view_content-info icon">
                                <a href='/uploads/review/<?= $ufile2 ?>' download='<?= $rfile2 ?>'><?= $rfile2 ?><i></i></a>
                            </div>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
            <div class="view_content" style="overflow: auto;">
                <div class="view_content-detail">
                    <?= viewSQ($review['contents']) ?>
                </div>
            </div>

            <?php

            if (session('member.idx') == $reg_m_idx || session('member.id') == 'admin') { ?>
                <div class="f_list flex_e_c">
                    <a href="/review/review_write?idx=<?= $idx ?>" class="btn btn-point btn_edit">수정</a>
                    <button class="btn btn_delete" onclick="del_it()">삭제</button>
                </div>

            <?php } ?>


            <div class="comment_box">
                <div class="comment_box-top">
                    <div class="comment_box-count">
                        <span>댓글</span>
                        <span id="comment_count">(<?= $review['r_cmt_cnt'] ?>)</span>
                    </div>
                    <form action="" name="com_form" id="frm" class="frm">
                        <input type="hidden" name="r_idx" value="<?= $idx ?>">
                        <input type="hidden" name="code" id="code" value="review">
                        <input type="hidden" name="r_code" id="r_code" value="review">
                        <div class="comment_box-input flex">
                            <textarea style="resize:none" class="bs-input" name="comment" id="comment"
                                placeholder="댓글을 입력해주세요."></textarea>
                            <button type="button" onclick="fn_comment(<?=session('member.idx')?>)"
                                class="btn btn-point btn-lg comment_btn">등록</button>
                        </div>
                    </form>
                </div>
                <div class="comment_box-details" id="comment_list">
                    <?php //include ("./comment_list.php") ?>
                </div>
            </div>

            <?php
            //include $_SERVER['DOCUMENT_ROOT'] . "/inc/popup_inc.php";
            echo view('inc/popup_inc');
            ?>

            <div class="btn-wrap">
                <a href="javascript:void(0);" onclick="goBack()" class="btn btn-lg go_to_list">목록으로</a>
            </div>
        </div>
    </section>
</div>

<script>
    function goBack() {
        window.history.back();
    }

    function del_it() {

        if (confirm("삭제 하시겠습니까? \n삭제후에는 복구가 불가능합니다.?")) {
            $.ajax({
                url: "./review_delete",
                type: "POST",
                data: { idx: '<?= $idx ?>' },
                success: (res) => {
                    if (res == "OK") {
                        alert("정상적으로 삭제되었습니다.");
                        window.location.href = "/review/review_list";
                    } else {
                        alert("오류가 발생하였습니다!!");
                    }
                }
            })
        }
    }

    $(function () {
        $('input[name="comment"]').keydown(function () {
            if (event.keyCode === 13) {
                event.target.value += "\n";
            }
        });
    });

    const r_code = "review";
    const r_idx = "<?= $idx ?>";
</script>
<script src="/js/comment.js"></script>
<?php $this->endSection(); ?>