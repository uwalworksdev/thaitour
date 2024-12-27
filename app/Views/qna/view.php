<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
if ($qna) {
    if (session('member.id') != 'admin' && session('member.level') > 2) {
        if ($qna['reg_m_idx'] != session('member.idx') or !session('member.idx')) {
            echo "
                <script>
                    alert('비밀번호 올바르게 입력해주세요!');
                    location.href = '/qna/list';
                </script>
            ";
            die();
        }
    }

    $user_name = sqlSecretConver($qna["user_name"], 'decode');
    $user_phone = sqlSecretConver($qna["user_phone"], 'decode');
    $user_email = sqlSecretConver($qna["user_email"], 'decode');

    $departure_date = $qna["departure_date"];
    $arrival_date = $qna["arrival_date"];
    $status = $qna["status"];
    $ufile1 = $qna["ufile1"];
    $rfile1 = $qna["rfile1"];
    $r_date = $qna["r_date"];

    $consultation_time = $qna['consultation_time'];
    $product_name = $qna['product_name'];
    $title = $qna['title'];
    $contents = $qna["contents"];
}
?>

<link href="/css/qna/travel.css" rel="stylesheet" type="text/css" />
<link href="/css/qna/travel_responsive.css" rel="stylesheet" type="text/css" />

<style>
    .travel_comment-details .travel_user-content .travel_user-date::after {
        display: none;
    }

    @media screen and (max-width: 850px) {
        .inquy_title {
            font-size: 3.5rem;
            text-align: center;
            margin: 7rem 0;
        }

        .travel_view_section .title h1 {
            font-family: "Noto Sans KR";
            font-size: 3.4rem;
            line-height: 2.1538rem;
            color: #252525;
            font-weight: bold;
            margin-bottom: 1.1538rem;
        }

        .travel_view_section .title p {
            font-family: "Noto Sans KR";
            font-size: 2.7rem;
            color: #757575;
            margin-bottom: 1.5385rem;
            margin-top: 2rem;
        }

        .travel_view_section .travel_table {
            width: 100%;
            border-top: 2px solid #252525;
            display: block;
        }

        .travel_view_section .travel_table tbody {
            width: 100%;
            display: block;
        }

        .travel_view_section .travel_table tbody tr {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            border-bottom: 1px solid #dbdbdb;
        }

        .travel_view_section .travel_table .subject {
            font-size: 2.6rem;
            color: #252525;
            font-family: "Noto Sans KR";
            font-weight: 600;
            width: 100%;
            padding: 2rem;

        }

        .travel_view_section .travel_table .content {
            font-family: "Noto Sans KR";
            color: #454545;
            padding-left: 0;
            line-height: 1.2;
            font-size: 2.6rem;
            padding: 2rem;
            padding-top: 0;
        }

        .travel_view_section .travel_edit {
            margin-top: 4rem;
            width: 100%;
            display: flex;
            gap: 3rem;
            justify-content: center;
        }


        .travel_view_section .travel_edit button {
            width: 32rem;
            font-size: 2.9rem;
            height: 8rem;
            padding: 0 3rem;
            color: #252525;
            font-size: 2.6rem;
            font-weight: 500;
            border: 1px solid #dbdbdb;
            text-align: center;
            border-radius: var(--bs-input-rounded);
        }

        .travel_comment .travel_comment-top .travel_comment-count span {
            font-family: "Noto Sans KR";
            font-size: 2.6rem;
            line-height: 1.0769rem;
            color: #252525;
            font-weight: 500;
        }

        .travel_comment .travel_comment-top .travel_comment-count {
            margin-bottom: 1rem;
        }


        .travel_comment .travel_comment-top .travel_comment-input textarea {
            height: 10rem;
            width: calc(100% - 4.6154rem - 0.7692rem);
            padding: 1rem;
            font-size: 2.6rem;
            font-family: "Noto Sans KR";
            border: 1px solid #aaaaaa;
            border-radius: 4px;
        }

        .travel_comment .travel_comment-top .travel_comment-input textarea::placeholder {
            font-size: 2.6rem;
        }

        .travel_comment .travel_comment-top .travel_comment-input button {
            width: 10rem;
            height: 10rem;
            border-radius: 4px;
            background-color: #2e3e92;
            font-size: 2.8rem;
            font-weight: 600;
            line-height: 1.4;
            font-family: "Noto Sans KR";
            font-weight: 600;
            color: #ffffff;
        }

        #comment_list .comment_user {
            display: flex;
            column-gap: 3rem;
            padding: 3rem 0;
            border-bottom: 1px solid #dbdbdb;
        }


        #comment_list .comment_user-content {
            margin-top: 3rem;
        }

        #comment_list .comment_user-content span {
            line-height: 28px;
            color: #6c7580;
            position: relative;
            margin-right: 3rem;
            font-size: 2.6rem;
        }

        #comment_list .comment_user-content {
            margin-top: 1rem;
        }

        #comment_list .comment_user-detail .comment_user-operation {
            margin-top: 2.5rem;
        }

        #comment_list .comment_user-detail .comment_user-operation button {
            line-height: 28px;
            color: #454545;
            border: 1px solid #dbdbdb;
            padding: 0 1.2rem;
            border-radius: 3px;
            margin-right: 1.6rem;
            font-size: 2.6rem;
        }

        #comment_list .comment_user .comment_user-avatar img {
            width: 6rem;
            height: 6rem;
            border-radius: 50%;
            border: 1px solid #dbdbdb;
        }
        .travel_view_section .travel_button a {
            color: #252525;
            border-radius: 4px;
            border: 1px solid #dbdbdb;
            margin: 0 auto;
            font-weight: bold;
            width: 100%;
            height: 8rem;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 3rem;
        }

    }
</style>
<section class="travel_view_section">
    <div class="inner">
        <h1 class="inquy_title">1:1 여행상담</h1>
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
                            <a href="/data/qna/<?= $ufile1 ?>" download="<?= $rfile1 ?>"><?= $rfile1 ?>
                                <i></i></a>
                        <?php }
                        ?>
                    </td>
                </tr>

            </tbody>
        </table>
        <?php if ($status == 'W') { ?>
            <div class="travel_edit">
                <a href="./write?idx=<?= $qna['idx'] ?>">
                    <button type="button" class="edit btn-point">수정</button>
                </a>
                <button type="button" class="del" onclick="del_check(<?= $qna['idx'] ?>)">삭제</button>
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
                        <input type="hidden" name="code" id="code" value="qna">
                        <input type="hidden" name="r_code" id="r_code" value="qna">
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
            url: "/qna/delete",
            type: "POST",
            data: "idx=" + idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            success: function (response, status, request) {
                alert(response.message);
                if (response.result == true) {
                    location.href = "/qna/list";
                }
                return;
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
    const r_code = "qna";
    const r_idx = "<?= $idx ?>";
</script>
<script src="/js/comment.js"></script>
<?php $this->endSection(); ?>
