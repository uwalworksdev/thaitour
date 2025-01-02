<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$r_code = "review";

foreach ($review as $key => $value) {
    $$key = $value;
}

$user_name = sqlSecretConver($review["user_name"], 'decode');
$user_email = sqlSecretConver($review["user_email"], 'decode');
?>
    <link href="/css/inquiry/inquiry.css" rel="stylesheet" type="text/css"/>
    <link href="/css/inquiry/inquiry_responsive.css" rel="stylesheet" type="text/css"/>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .inquiry_view_section .inquiry_table .subject {
            word-break: break-all;
        }

        .view_top {
            display: flex;
            align-items: end;
            justify-content: space-between;
        }

        .main_info {
            gap: 20px;
        }

        .font_bold_ {
            font-weight: bold !important;
        }
    </style>
    <div id="container" class="sub view_container ">
        <section class="view_sect">
            <div class="inner">
                <div class="view_top">
                    <div class="title_" style="padding-bottom: 0">
                        <div class="sect_ttl_box">
                            <h2><?= $review['title'] ?></h2>
                        </div>
                    </div>
                    <div class="main_info flex">
                        <p><?= $user_name ?></p>
                        <p class="date"><?= date("Y.m.d", strtotime($r_date)) ?></p>
                    </div>
                </div>
                <div class="view_content-top">
                    <ul class="line flex_b_c">
                        <?php
                        $name = $product_name ?? $special_name;
                        if ($name == '') {
                            $name = $product_special_name;
                        }
                        ?>
                        <li>
                            <h4 class="font_bold_">여행형태: </h4>
                            <div class="view_content-info">
                                <?= $travel_type_name ?> <img src="/img/ico/ico_next_grey_.png" alt="">
                                <?= $travel_type_name2 ?> <img src="/img/ico/ico_next_grey_.png" alt="">
                                <?= $name ?>
                            </div>
                        </li>
                        <?php
                        if ($ufile2) {
                            ?>
                            <li class="view_content-file file">
                                <h4 class="font_bold_">첨부파일: </h4>
                                <div class="view_content-info icon">
                                    <a href='/uploads/review/<?= $ufile2 ?>' download='<?= $rfile2 ?>'><?= $rfile2 ?>
                                        <i></i></a>
                                </div>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </div>
                <div class="view_content-top">
                    <ul class="line flex_b_c">
                        <li>
                            <h4 class="font_bold_">상품명: </h4>
                            <div class="view_content-info">
                                <?= $product_name ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="view_content-top">
                    <ul class="line flex_b_c">
                        <li>
                            <h4 class="font_bold_">평가 구분: </h4>
                            <div class="view_content-info">
                                <p style="display: flex; gap: 10px">
                                    <?php foreach ($list_code_type as $code): ?>
                                        <span><?= $code['code_name'] ?></span>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="main_info flex" style="gap: 10px">
                                <p class="font_bold_">평점: </p>
                                <?= $number_stars ?>
                                <img src="/img/ico/star_yellow_full.png" alt="">
                            </div>
                        </li>
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
                                <button type="button" onclick="fn_comment(<?= session('member.idx') ?>)"
                                        class="btn btn-point btn-lg comment_btn">등록
                                </button>
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
                    data: {idx: '<?= $idx ?>'},
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