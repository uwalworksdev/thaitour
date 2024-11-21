<div class="inner cmt_area">
    <form name="com_form" id="com_form" method="post" onsubmit="return false" class="com_form">
        <input type="hidden" name="code" id="code" value="<?= $code ?>">
        <input type="hidden" name="bbs_idx" id="bbs_idx" value="<?= $bbs_idx ?>">
        <input type="hidden" name="tbc_idx" id="tbc_idx" value="">
        <div class="comment_box-input flex">
            <textarea style="resize:none" name="comment" class="cmt_input" id="contents"
                placeholder="댓글을 입력해주세요."></textarea>
            <button type="button" onclick="fn_comment();" class="btn btn-point comment_btn">등록</button>
        </div>
    </form>
    <div id="comment_list">
        <table class="comment">
            <colgroup>
                <col width='20%'>
                <col width='70%'>
                <col width='10%'>
            </colgroup>
            <tbody>
                <?php
                foreach ($list_comment as $row_c) {
                    $is_reported = !!$row_c['report_idx'];
                    $should_show = $row_c['report_state'] == '2';
                    ?>
                    <input type="hidden" name="comment_<?= $row_c['tbc_idx'] ?>" id="comment_<?= $row_c['tbc_idx'] ?>"
                        value="<?= $row_c['comment'] ?>">
                    <tr class="<?= ($is_reported && !$should_show ? "reported" : "") ?>" style="position: relative;">
                        <td>
                            <?php
                            if ($row_c['user_level'] == 1) {
                                $avt_img = "/img/ico/hi_avatar.jpg";
                            } else if ($row_c['avt_new'] != '' && $row_c['user_level'] == 2) {
                                $avt_img = '/data/member/' . $row_c['avt_new'];
                            } else {
                                $avt_img = '/assets/img/event/user_2.png';
                            }
                            ?>
                            <div class="user_info">
                                <img src="<?= $avt_img ?>" class="user_avatar" width="100px" height="100px" alt="">
                                <div class="user_info_1">
                                    <p class="user-name">
                                        <?= $row_c['user_name'] ?>
                                    </p>
                                    <p>
                                        <?= $row_c['user_phone'] ?>
                                    </p>
                                    <p>
                                        <?= $row_c['user_email'] ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-comment" id="rrp_content_<?= $row_c['tbc_idx'] ?>">
                                <?= nl2br($row_c['comment']) ?>
                            </div>

                            <div class="comment-input write_box flex" id="rrp_edit_<?= $row_c['tbc_idx'] ?>"
                                style="display: none;" tabindex="0" onblur="handleBlurEdit('<?= $row_c['tbc_idx'] ?>')">
                                <input type="hidden" value="<?= $row_c['tbc_idx'] ?>">
                                <textarea onblur="handleBlurEdit1('<?= $row_c['tbc_idx'] ?>')" class="cmt_input"
                                    style="width:1100px;" tabindex="0" name="comment" id="contents"
                                    placeholder="댓글을 입력해주세요."><?= viewSQ($row_c['comment']) ?></textarea>
                                <button type="button" class="btn btn-point btn-lg comment_btn"
                                    onclick="handleCmtEditSubmit(event, <?= $row_c['tbc_idx'] ?>)">수정</button>
                            </div>
                            <p class="cmt_date">
                                <?= date("Y.m.d H:i", strtotime($row_c['r_date'])) ?>
                            </p>
                        </td>
                        <td class="user-operation">
                            <?php if ($is_reported) { ?>
                                <select name="report_state" id="report_state"
                                    onchange="handleUpdateReportState('<?= $row_c['report_idx'] ?>', this.value)">
                                    <option value="0" <?= ($row_c['report_state'] == "0" ? "selected" : "") ?>>신고접수</option>
                                    <option value="1" <?= ($row_c['report_state'] == "1" ? "selected" : "") ?>>비노출</option>
                                    <option value="2" <?= ($row_c['report_state'] == "2" ? "selected" : "") ?>>계속노출</option>
                                </select>
                            <?php } ?>
                            <?php if ((session('member.idx') == $row_c['m_idx'])) { ?>
                                <button type="button" onclick="handleCmtEdit('<?= $row_c['tbc_idx'] ?>')">수정</button>
                            <?php } ?>
                            <?php if ((session('member.idx') == $row_c['m_idx']) || session('member.id') == "admin") { ?>
                                <button type="button" onclick="commentDelete(<?= $row_c['tbc_idx'] ?>)">삭제</button>
                            <?php } ?>
                            <?php if ($is_reported && !$should_show) { ?>
                                <div class="report_area">
                                    이 댓글이 신고된 댓글입니다. <br>
                                    신고사유 : <?= $row_c['report_reason'] ?>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>