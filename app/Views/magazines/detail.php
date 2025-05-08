<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <style>
        .comment_box .comment_box-details {
            padding: 20px;
            background-color: #FFF;
        }
    </style>
    <link rel="stylesheet" href="/css/magazines/magazines.css">
    <main id="container" class="sub magazines_page_" style="background-color: #f0f2f5;">
        <div class="inner magazines_area_">
            <div class="magazines_detail_">
                <div class="magazines_detail__title_">
                    <?= $magazine['subject'] ?>
                </div>
                <div class="magazines_detail__desc_">
                    <p class="author_">
                        <?= $magazine['writer'] ?>
                    </p>
                    <p class="src_">
                        |
                    </p>
                    <p class="date_">
                        <?= date('Y-m-d', strtotime($magazine['r_date'])) ?>
                    </p>
                    <p class="src_">
                        |
                    </p>
                    <p class="more_">
                        조회수 : <?= $magazine['hit'] ?>
                    </p>
                </div>
                <div class="magazines_detail__content_">
                    <?= viewSQ($magazine['contents']) ?>
                </div>
            </div>

            <div class="comment_box" style="margin-top: 50px">
                <div class="comment_box-top">
                    <div class="comment_box-count">
                        <span>댓글</span>
                        <span id="comment_count">( <span id="r_cmt_cnt">0</span>)</span>
                    </div>
                    <?php if (session('member.id')) { ?>
                        <form action="" name="com_form" id="frm" class="frm">
                            <input type="hidden" name="r_idx" value="<?= $magazine['bbs_idx'] ?>">
                            <input type="hidden" name="code" id="code" value="<?= $magazine['code'] ?>">
                            <input type="hidden" name="r_code" id="r_code" value="<?= $magazine['code'] ?>">
                            <div class="comment_box-input flex">
                            <textarea style="resize:none" class="bs-input" name="comment" id="comment"
                                      placeholder="댓글을 입력해주세요."></textarea>
                                <button type="button" onclick="fn_comment()"
                                        class="btn btn-point btn-lg comment_btn">등록
                                </button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
                <div class="comment_box-details" id="comment_list">

                </div>
            </div>
        </div>
    </main>
    <script>
        listComment();

        async function listComment() {
            let url = `<?= route_to('api.magazines.list.comment') ?>?bbs_idx=<?= $magazine['bbs_idx'] ?>`;
            try {
                let response = await fetch(url);
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

                let data = await response.json();
                renderComment(data.data);
            } catch (error) {
                console.error('Error fetching hotel data:', error);
            }
        }

        function renderComment(data) {
            let r_cmt_cnt = data.length;
            let comment_list = $("#comment_list");
            if (r_cmt_cnt == 0) {
                comment_list.css('display', 'none');
            } else {
                comment_list.css('display', 'block');
            }

            $("#r_cmt_cnt").text(r_cmt_cnt);
            comment_list.empty();
            let html = "";
            for (let i = 0; i < data.length; i++) {
                let comment = data[i];

                html += `
                   <div class="comment">
                        <div class="comment_user" style="margin-left: 0px;">
                            <div class="comment_user-avatar">
                                <img src="${comment.ufile1 ?? '/images/profile/avatar.png'}" alt="">
                            </div>
                            <div class="comment_user-detail">
                                <div>
                                    <div class="comment_user-comment" id="rrp_content_${comment.tbc_idx}">
                                           ${comment.comment}
                                    </div>
                                    <div class="comment_comment-input write_box" id="rrp_edit_${comment.tbc_idx}"
                                         style="display: none;" tabindex="0" onblur="handleBlurEdit(${comment.tbc_idx})">
                                        <input type="hidden" value=" ${comment.tbc_idx}">
                                        <textarea onblur="handleBlurEdit1(${comment.tbc_idx})"
                                                  style="resize:none" tabindex="0"
                                                  name="comment" id="contents"
                                                  placeholder="댓글을 입력해주세요.">${comment.comment}</textarea>
                                        <button type="button" onclick="handleCmtEditSubmit(event, ${comment.tbc_idx})">수정</button>
                                    </div>
                                    <div class="comment_user-content"><span class="comment_user-title"></span><span
                                                class="comment_user-date"> ${comment.r_date}</span><span
                                                class="comment_user-type" onclick="showReport('review', '${comment.bbs_idx}', '${comment.tbc_idx}')">신고</span>
                                    </div>
                                    <div class="comment_user-operation">
                                        <button type="button" onclick="handleCmtEdit(event, ${comment.tbc_idx})">수정</button>
                                        <button type="button" onclick="handleCmtDelete(event, ${comment.tbc_idx})">삭제</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            }

            $('#comment_list').html(html);
        }

        function handleBlurEdit(idx) {

        }

        function handleBlurEdit1(idx) {

        }

        function handleCmtEditSubmit(event, idx) {
            event.preventDefault();

            let data = {
                tbc_idx: idx,
                comment: $('#contents').val()
            };
            let url = `<?= route_to('api.magazines.update.comment') ?>`;

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (res, status) {
                    console.log(res);
                    listComment();
                },
                error: function (request, status, error) {
                    console.error("Error:", request, status, error);
                    alert("오류 발생: " + (request.responseText || "알 수 없는 오류"));
                }
            });
        }

        function handleCmtEdit(event, idx) {
            event.preventDefault();
            $('#rrp_content_' + idx).css('display', 'none');
            $('#rrp_edit_' + idx).css('display', 'flex');
        }

        function handleCmtDelete(event, idx) {
            if (!confirm('댓글을 삭제하시겠습니까?')) {
                return;
            }
            event.preventDefault();

            let data = {
                tbc_idx: idx,
            };
            let url = `<?= route_to('api.magazines.delete.comment') ?>`;

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (res, status) {
                    console.log(res);
                    listComment();
                },
                error: function (request, status, error) {
                    console.error("Error:", request, status, error);
                    alert("오류 발생: " + (request.responseText || "알 수 없는 오류"));
                }
            });
        }

        function fn_comment() {
            let frm = new FormData($('#frm')[0]);

            let url = `<?= route_to('api.magazines.create.comment') ?>`;

            $.ajax({
                url: url,
                type: 'POST',
                data: frm,
                contentType: false,
                processData: false,
                success: function (res, status) {
                    console.log(res);
                    listComment();
                },
                error: function (request, status, error) {
                    console.error("Error:", request, status, error);
                    alert("오류 발생: " + (request.responseText || "알 수 없는 오류"));
                }
            });
        }
    </script>

<?php echo view('inc/popup_inc.php'); ?>
<?php $this->endSection(); ?>