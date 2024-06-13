<?php
function fetchCommentsFromDatabase($list, $parentCommentId, $level)
{
    $filteredArray = array_filter($list ?? [], function ($value) use ($parentCommentId, $level) {
        return $value['r_level'] == $level and $value['r_ref'] == $parentCommentId;
    });
    return $filteredArray;
}
function displayComments($list, $parentCommentId = 0, $level = 1)
{
    $html = '';
    $comments = fetchCommentsFromDatabase($list, $parentCommentId, $level);
    global $r_idx;
    global $r_code;

    foreach ($comments as $comment) {
        $ww = ($comment['r_level'] - 1) * 40;
        $html .= '<div class="comment_user" style="margin-left: ' . $ww . 'px;">';
        $html .= '<div class="comment_user-avatar">';
        if ($comment['user_level'] == 1) {
            $avt_img = "/img/ico/hi_avatar.jpg";
        } else if ($comment['avt_new'] != '' && $comment['user_level'] == 2) {
            $avt_img = '/data/member/' . $comment['avt_new'];
        } else {
            $avt_img = '/assets/img/event/user_2.png';
        }
        $html .= '<img src="' . $avt_img . '" alt="">';
        $html .= '</div>';
        $html .= '<div class="comment_user-detail">';
        $html .= '<div>';
        $html .= '<div class="comment_user-comment" id="rrp_content_' . $comment['r_cmt_idx'] . '">';
        $html .= nl2br($comment['r_content']);
        $html .= '</div>';
        $html .= '<div class="comment_comment-input write_box" id="rrp_edit_' . $comment['r_cmt_idx'] . '"';
        $html .= 'style="display: none;" tabindex="0" onblur="handleBlurEdit(' . $comment['r_cmt_idx'] . ')">';
        $html .= '<input type="hidden" value="' . $comment['r_cmt_idx'] . '">';
        $html .= '<textarea onblur="handleBlurEdit1(' . $comment['r_cmt_idx'] . ')" style="resize:none" tabindex="0"';
        $html .= 'name="comment" id="contents"';
        $html .= 'placeholder="댓글을 입력해주세요.">' . nl2br(viewSQ($comment['r_content'])) . '</textarea>';
        $html .= '<button type="button" onclick="handleCmtEditSubmit(event, ' . $comment['r_cmt_idx'] . ')">수정</button>';
        $html .= '</div>';
        $html .= '<div class="comment_user-content">';
        $html .= '<span class="comment_user-title">' . $comment['r_name'] . '</span>';
        $html .= '<span class="comment_user-date">' . $comment['r_reg_date'] . '</span>';
        if ($r_code != 'order') {

            $html .= '<span class="comment_user-type"';
            $html .= 'onclick="showReport(`' . $r_code . '`, `' . $r_idx . '`, `' . $comment['r_cmt_idx'] . '`)">신고</span>';
        }
        if ($comment['user_level'] <= 2) {
            $html .= '<br /><span class="comment_user-title">' . $comment['user_phone'] . '</span>';
            $html .= '<span class="comment_user-date">' . $comment['user_email'] . '</span>';
        }
        $html .= '</div>';
        $html .= '<div class="comment_user-operation">';
        if (($_SESSION['member']['idx'] == $comment['r_m_idx']) || $_SESSION['member']['id'] == "admin" || $_SESSION['member']['level'] <= 2) {
            $html .= '<button type="button" onclick="handleCmtEdit(' . $comment['r_cmt_idx'] . ')">수정</button>';
            $html .= '<button type="button" onclick="handleCmtDelete(' . $comment['r_cmt_idx'] . ')">삭제</button>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        if ($level < 5) {
            displayComments($list, $comment['r_cmt_idx'], $level + 1);
        }
    }
    return $html;
}
function getComment($list)
{
    $html = '<div class="comment">';
    $html .= displayComments($list);
    $html .= '</div>';
    $html .= '<script>';
    $html .= '$("#comment_count").text(`(' . count($list) . ')`)';
    $html .= '</script>';
    return $html;
}