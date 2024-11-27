<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
if ($contact) {
    if (session('member.id') != 'admin' && session('member.level') > 2) {
        if ($contact['reg_m_idx'] != session('member.idx') or !session('member.idx')) {
            echo "
                <script>
                    alert('비밀번호 올바르게 입력해주세요!');
                    location.href = '/contact/main';
                </script>
            ";
            die();
        }
    }

    $user_name = sqlSecretConver($contact["user_name"], 'decode');
    $user_phone = sqlSecretConver($contact["user_phone"], 'decode');
    $user_email = sqlSecretConver($contact["user_email"], 'decode');

    $departure_date = $contact["departure_date"];
    $arrival_date = $contact["arrival_date"];
    $status = $contact["status"];
    $ufile1 = $contact["ufile1"];
    $rfile1 = $contact["rfile1"];
    $r_date = $contact["r_date"];

    $consultation_time = $contact['consultation_time'];
    $product_name = $contact['product_name'];
    $title = $contact['title'];
    $contents = $contact["contents"];
}
?>

<style>
    .travel_comment-details .travel_user-content .travel_user-date::after {
        display: none;
    }
</style>
<link href="/css/qna/travel.css" rel="stylesheet" type="text/css" />
<link href="/css/qna/travel_responsive.css" rel="stylesheet" type="text/css" />

<section class="travel_view_section">
    <div class="inner">
        <h1 class="inquy_title">문의하기</h1>
        <div class="title">
            <h1><?= $title ?></h1>
            <p><?= date("Y.m.d", strtotime($r_date)) ?></p>
        </div>
        <table class="travel_table">
            <colgroup>
                <col width="10%">
                <col width="90%">
            </colgroup>
            <tbody>
                <tr>
                    <td class="subject">성함</td>
                    <td class="content"><?= $user_name ?></td>
                </tr>
                <tr>
                    <td class="subject">연락처</td>
                    <td class="content"><?= $user_phone ?></td>
                </tr>
                <tr>
                    <td class="subject">이메일</td>
                    <td class="content"><?= $user_email ?></td>
                </tr>
                <tr>
                    <td class="subject">여행예정일</td>
                    <td class="content">
                        <?= date("Y.m.d", strtotime($departure_date)) ?>~<?= date("Y.m.d", strtotime($arrival_date)) ?>
                    </td>
                </tr>
                <tr>
                    <td class="subject">여행형태</td>
                    <td class="content">
                        <span>
                            <?= $travel_type_1['code_name'] ?>
                        </span>
                        <span>
                            <?= !empty($travel_type_2['code_name']) ? ' > ' . $travel_type_2['code_name'] : '' ?>
                        </span>
                        <span>
                            <?= !empty($travel_type_3['code_name']) ? ' > ' . $travel_type_3['code_name'] : '' ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="subject">상담가능시간</td>
                    <td class="content"><?= $consultation_time ?></td>
                </tr>
                <tr>
                    <td class="subject">상품명</td>
                    <td class="content"><?= $product_name ?></td>
                </tr>
                <tr>
                    <td class="subject">내용</td>
                    <td class="content">
                        <?= nl2br($contents) ?>
                    </td>
                </tr>
                <tr>
                    <td class="subject">첨부파일</td>
                    <td class="content icon">
                        <?php
                        if ($ufile1) { ?>
                            <a href="/data/contact/<?= $ufile1 ?>" download="<?= $rfile1 ?>"><?= $rfile1 ?>
                                <i></i></a>
                        <?php }
                        ?>
                    </td>
                </tr>

            </tbody>
        </table>
        <?php if ($status == 'W') { ?>
            <div class="travel_edit">
                <a href="./write?idx=<?= $contact['idx'] ?>">
                    <button type="button" class="edit btn-point">수정</button>
                </a>
                <button type="button" class="del" onclick="del_check(<?= $contact['idx'] ?>)">삭제</button>
            </div>
        <?php } ?>

        <div class="travel_comment">
            <div class="travel_comment-top">
                <div class="travel_comment-count">
                    <span>댓글</span>
                    <span id="comment_count">(0)</span>
                </div>
                <?php if (session('member.id')) { ?>
                    <form action="" id="frm" name="com_form" class="frm">
                        <input type="hidden" name="code" id="code" value="contact">
                        <input type="hidden" name="r_code" id="r_code" value="contact">
                        <input type="hidden" name="r_idx" id="r_idx" value="<?= $idx ?>">
                        <div class="travel_comment-input">
                            <textarea style="resize:none" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
                            <button type="button" onclick="fn_comment('<?=session('member.idx')?>')">등록</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
            <div class="travel_comment-details" id="comment_list">
                <?php // include ("./comment_list.php") ?>
            </div>
        </div>

		<?php
			echo view("inc/popup_inc");
		?>

        <div class="travel_button">
            <a href="javascript:void(0);" onclick="goBack()">목록으로</a>
        </div>
    </div>
</section>
<script>
    function goBack() {
        window.history.back();
    }

    function del_check(idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $.ajax({
            url: "del.php",
            type: "POST",
            data: "idx=" + idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            complete: function (request, status, error) {

            },
            success: function (response, status, request) {
                if (response == "OK") {
                    alert("정상적으로 삭제되었습니다.");
                    location.href = "/travel/travel_list.php";
                    return;
                } else {
                    alert("오류가 발생하였습니다!!");
                    return;
                }
            }
        });

    }

    $(function () {
        $('input[name="comment"]').keydown(function () {
            if (event.keyCode === 13) {
                event.target.value += "\n";
            }
        });
    });
    const r_code = "contact";
    const r_idx = "<?= $idx ?>";
</script>
<script src="/js/comment.js"></script>
<?php $this->endSection(); ?>
