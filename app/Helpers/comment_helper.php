<?php

helper('setting_helper');

function fetchCommentsFromDatabase($list, $parentCommentId, $level)
{
    $filteredArray = array_filter($list ?? [], function ($value) use ($parentCommentId, $level) {
        return $value['r_level'] == $level and $value['r_ref'] == $parentCommentId;
    });
    return $filteredArray;
}
function displayComments($list, $r_code, $r_idx, $parentCommentId = 0, $level = 1)
{
    $html = '';
    $seting_model = model('Setting');
    $seting = $seting_model->info(1);

    $comments = fetchCommentsFromDatabase($list, $parentCommentId, $level);

    foreach ($comments as $comment) {
        $ww = ($comment['r_level'] - 1) * 40;
        $html .= '<div class="comment_user" style="margin-left: ' . $ww . 'px;">';
        $html .= '<div class="comment_user-avatar">';
        if ($comment['user_level'] == 1) {
            $avt_img = "/uploads/setting/" . $seting['logos_consult'];
            $user_name = $seting['admin_name'];
            $user_phone = $seting['custom_phone'];
            $user_email = $seting['qna_email'];
        } else if ($comment['avt_new'] != '' && $comment['user_level'] == 2) {
            $avt_img = '/data/member/' . $comment['avt_new'];
            $user_name = $comment['r_name'];
            $user_phone = $comment['user_phone'];
            $user_email = $comment['user_email'];
        } else {
            $avt_img = '/images/profile/avatar.png';
            $user_name = $comment['r_name'];
            $user_phone = $comment['user_phone'];
            $user_email = $comment['user_email'];
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
        $html .= '<span class="comment_user-title">' . $user_name . '</span>';
        $html .= '<span class="comment_user-date">' . $comment['r_reg_date'] . '</span>';
        if ($r_code != 'order') {

            $html .= '<span class="comment_user-type"';
            $html .= 'onclick="showReport(`' . $r_code . '`, `' . $r_idx . '`, `' . $comment['r_cmt_idx'] . '`)">신고</span>';
        }
        if ($comment['user_level'] <= 2) {
            $html .= '<br /><span class="comment_user-title">' . $user_phone . '</span>';
            $html .= '<span class="comment_user-date">' . $user_email . '</span>';
        }
        $html .= '</div>';
        $html .= '<div class="comment_user-operation">';
        if (
            (!empty(session('member.idx')) && session('member.idx') == $comment['r_m_idx']) ||
            (!empty(session('member.id')) && session('member.id') == "admin") ||
            (!empty(session('member.level')) && session('member.level') <= 2)
        ) {
            $html .= '<button type="button" onclick="handleCmtEdit(' . $comment['r_cmt_idx'] . ')">수정</button>';
            $html .= '<button type="button" onclick="handleCmtDelete(' . $comment['r_cmt_idx'] . ')">삭제</button>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        if ($level < 5) {
            displayComments($list, $r_code, $r_idx, $comment['r_cmt_idx'], $level + 1);
        }
    }
    return $html;
}
function getComment($list, $r_code, $r_idx)
{
    $html = '<div class="comment">';
    $html .= displayComments($list, $r_code, $r_idx);
    $html .= '</div>';
    $html .= '<script>';
    $html .= '$("#comment_count").text(`(' . count($list) . ')`)';
    $html .= '</script>';
    return $html;
}

function displayCommentsTimeSale($list, $r_code, $r_idx, $parentCommentId = 0, $level = 1)
{
    $user_name = session()->get("member")["name"];
    $html = '';
    $comments = fetchCommentsFromDatabase($list, $parentCommentId, $level);

    $seting_model = model('Setting');
    $seting = $seting_model->info(1);

    foreach ($comments as $comment) {
        if($comment['user_level'] == 1){
            $user_name = $seting['admin_name'];
        }

        if($level <= 1){
            $html .= '<div class="comment_el">';
        }
        if($level <= 1){
            $html .= '<div class="comment_wrap" id="rrp_content_' . $comment['r_cmt_idx'] . '">';
        }else{
            $html .= '<div class="comment_wrap comment_reply_wrap" id="rrp_content_' . $comment['r_cmt_idx'] . '" style="padding-left: 30px;">';
            $html .= '<i class="ico_reply"></i>';
        }
        $html .= '<div class="info">';
        $html .= '<div class="left">';
        $html .= '<span class="user">' . $user_name . '</span>';
        $html .= '<span class="date">' . $comment['r_reg_date'] . '</span>';

        if (
            (!empty(session('member.idx')) && session('member.idx') == $comment['r_m_idx']) ||
            (!empty(session('member.id')) && session('member.id') == "admin") ||
            (!empty(session('member.level')) && session('member.level') <= 2)
        )  {
            $html .= '<div class="setting">';
            $html .= '<button type="button" class="btn_delete" onclick="handleCmtDelete(this, ' . $comment['r_cmt_idx'] . ', '. $r_idx .')">삭제</button>';
            $html .= '<button type="button" class="btn_edit" onclick="handleCmtEdit(this, ' . $comment['r_cmt_idx'] . ')">수정</button>';
            $html .= '</div>';
        }
        
        $html .= '</div>';

        if($level <= 1){
            $html .= '<button type="button" class="btn_reply" onclick="handleReplyComment(this, ' . $comment['r_cmt_idx'] . ')">답변</button>';
        }
        $html .= '</div>';
        $html .= '<div class="content">' . nl2br($comment['r_content']) . '</div>';

        $html .= '<div class="comment_edit" style="display: none;">';
        $html .= '<div class="comment_write">';
        $html .= '<textarea placeholder="로그인해서 댓글을 입력해주세요"></textarea>';
        $html .= '<span class="line"></span>';
        $html .= '<button class="btn_comment" onclick="handleCmtEditSubmit(this, ' . $comment['r_cmt_idx'] . ', '. $r_idx .')">글쓰기</button>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="comment_reply_write" style="display: none;">';
        $html .= '<i class="ico_reply_arrow"></i>';
        $html .= '<div class="comment_write">';
        $html .= '<input type="hidden" value="'. ($level + 1) .'">';
        $html .= '<textarea placeholder="@'. $user_name .' :""></textarea>';
        $html .=  '<span class="line"></span>';
        $html .=  '<button class="btn_comment" onclick="handleReplySubmit(this, ' . $comment['r_cmt_idx'] . ', '. $r_idx .')">글쓰기</button>';
        $html .=  '</div>';
        $html .=  '</div>';

        if ($level < 3) {
            $html .= displayCommentsTimeSale($list, $r_code, $r_idx, $comment['r_cmt_idx'], $level + 1);
        }
        $html .=  '</div>';

        if($level <= 1){
            $html .=  '</div>';
        }
        
    }
    return $html;
}

function getCommentTimeSale($list, $r_code, $r_idx){
    $html = '';
    $html .= displayCommentsTimeSale($list, $r_code, $r_idx);
    $html .= '<script>';
    $html .= '$(".comment_pop .comment_total .total").text(`(' . count($list) . ')`);';
    $html .= '$(".comment_pop .tools_list .comment span").text(' . count($list) . ');';
    $html .= '$("#time_sale_child_'. $r_idx .' .tools_list .comment span").text(' . count($list) . ');';
    $html .= '</script>';
    return $html;
}

function displayCommentsAdmin($commentsArray, $r_code, $r_idx, $parentCommentId = 0, $level = 1)
{
    $comments = fetchCommentsFromDatabase($commentsArray, $parentCommentId, $level);
    $html = '';

    $seting_model = model('Setting');
    $seting = $seting_model->info(1);

    foreach ($comments as $comment) {
        if ($comment['user_level'] == 1) {
            $avatar = "/uploads/setting/" . $seting['logos_consult'];
            $user_name = $seting['admin_name'];
            $user_phone = $seting['custom_phone'];
            $user_email = $seting['qna_email'];
        
        } else if ($comment['user_level'] == 2) {
            $avatar = "/data/member/" . $comment['user_avatar'];
            $user_name = $comment['r_name'];
            $user_phone = $comment['user_phone'];
            $user_email = $comment['user_email'];
        } else {
            $avatar = "/images/profile/avatar.png";
            $user_name = $comment['r_name'];
            $user_phone = $comment['user_phone'];
            $user_email = $comment['user_email'];
        }

        $class = '';

        if(!empty($comment["report_idx"]) && $comment["report_state"] != 1){
            $class = 'reported';
        }

        $html .= '<tr class="' . $class . '" style="position: relative;">';
        $html .= '<td><div class="user_info">';
        $html .= '<img src="' . $avatar . '" class="user_avatar" width="100px" height="100px" alt="">';
        $html .= '<div class="user_info_1">';
        $html .= '<p class="user-name">' . $user_name;

        $html .= '</p><p>' . $user_phone . '</p><p>' . $user_email . '</p></div></div></td>';
        $html .= '<td><div class="user-comment" id="rrp_content_' . $comment['r_cmt_idx'] . '">';
        $html .= nl2br($comment['r_content']);
        $html .= '</div><div class="comment-input write_box flex" id="rrp_edit_' . $comment['r_cmt_idx'] . '" style="display: none;" tabindex="0" onblur="handleBlurEdit(' . $comment['r_cmt_idx'] . ')">';
        $html .= '<input type="hidden" value="' . $comment['r_cmt_idx'] . '">';
        $html .= '<textarea class="cmt_input" onblur="handleBlurEdit1(' . $comment['r_cmt_idx'] . ', event)" name="comment" id="contents" placeholder="댓글을 입력해주세요.">' . nl2br(viewSQ($comment['r_content'])) . '</textarea>';
        $html .= '<button class="btn btn-point btn-lg comment_btn" type="button" onclick="handleCmtEditSubmit(event, ' . $comment['r_cmt_idx'] . ')">수정</button>';
        $html .= '</div><p class="cmt_date">' . date("Y.m.d H:i", strtotime($comment['r_reg_date'])) . '</p></td>';
        $html .= '<td class="user-operation">';
        if(!empty($comment["report_idx"]) && $comment["report_state"] != 1){
            $html .= '<select onchange="handleUpdateReportState('. $r_idx . ', '. $comment['r_cmt_idx'] .', this.value)">';
            $html .= '<option value="0" '. ($comment["report_state"] == 0 ? 'selected' : '') .'>신고접수</option>';
            $html .= '<option value="1" '. ($comment["report_state"] == 1 ? 'selected' : '') .'>계속노출</option>';
            $html .= '<option value="2" '. ($comment["report_state"] == 2 ? 'selected' : '') .'>비노출</option>';
            $html .= '</select>';
            $html .= '<br>';
        }
        if (session('member.idx') == $comment['r_m_idx']) {
            $html .= '<button type="button" onclick="handleCmtEdit(' . $comment['r_cmt_idx'] . ')">수정</button>';
        }
        if (session('member.idx') == $comment['r_m_idx'] || session('member.id') == "admin") {
            $html .= '<button type="button" onclick="handleCmtDelete(' . $comment['r_cmt_idx'] . ')">삭제</button>';
        }

        if(!empty($comment["report_idx"]) && $comment["report_state"] != 1){
            $html .= '<div class="report_area">';
            $html .=    '이 댓글이 신고된 댓글입니다. <br>';
            $html .=    '신고사유 :"' . $comment['report_reason'] . '" ';                                                       
            $html .= '</div>';
        }

        $html .= '</td></tr>';

        if ($level < 5) {
            $html .= displayCommentsAdmin($commentsArray, $r_code, $r_idx, $comment['r_cmt_idx'], $level + 1);
        }
    }

    return $html;
}
function generateCommentsAdminHTML($commentsArray, $r_code, $r_idx)
{
    $html = '<table class="comment"><colgroup><col width="20%"><col width="70%"><col width="10%"></colgroup><tbody>';
    $html .= displayCommentsAdmin($commentsArray, $r_code, $r_idx);
    $html .= '</tbody></table>';
    $html .= '<script>$("#comment_count").text("(' . count($commentsArray) . ')")</script>';

    return $html;
}
