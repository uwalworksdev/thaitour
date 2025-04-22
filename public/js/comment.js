function fn_comment(m_idx) {

    if (m_idx) {
        if ($("#comment").val() == "") {
            alert("댓글을 입력해주세요.");
            return;
        }
        var queryString = $("form[name=com_form]").serialize();
        $.ajax({
            type: "POST",
            url: "/comment/comment",
            data: queryString,
            cache: false,
            success: function (ret) {
                if (ret.trim() == "OK") {
                    fn_comment_list();
                    $("#comment").val("");
                } else {
                    alert("등록 오류입니다." + ret);
                }
            }
        });
    } else {
        alert("로그인을 해주세요.");
    }
}
function fn_comment_list() {

    $.ajax({
        type: "GET",
        url: "/comment/comment_list",
        data: {
            "r_code": r_code,
            "r_idx": r_idx,
            "role": typeof role !== 'undefined' ? role : ''
        },
        cache: false,
        success: function (ret) {
            $("#comment_list").html(ret);
        }
    });

}

fn_comment_list();

$('input[name="comment"]').keydown(function (event) {
    if (event.keyCode === 13) {
        event.target.value += "\n";
    }
});

function handleReplyComment(idx) {
    var member_idx = $("#member_idx").val();
	if(member_idx == "") {
        alert('로그인 후 이용해 주세요');
        location.href='/member/login_form.php';
        return false;
    }
    
    const displayChk = document.querySelector("#rrp_write_" + idx).style.display;
    if (displayChk == '') {
        document.querySelector("#rrp_write_" + idx).style.display = 'none';
    } else {
        document.querySelector("#rrp_write_" + idx).style.display = '';
        document.querySelector("#rrp_write_" + idx + " textarea").focus();
    }
}
/**
 * * 대댓글 함수
 * @param {*} e 클릭이 발생한 이벤트
 * @param {Number} idx 댓글을 달 첫번째 댓글의 idx
 */
function handleReplySubmit(e, idx, r_idx) {
    const comment = e.target.closest(".write_box").querySelector("textarea").value;
    const r_level = e.target.closest(".write_box").querySelector("input").value;
    const frmData = new FormData();
    frmData.append("r_ref", idx);
    frmData.append("r_idx", r_idx);
    frmData.append("r_level", r_level);
    frmData.append("r_content", comment);
    frmData.append("r_code", r_code);
    
    $.ajax({
        url: "/comment/cmtRep",
        data: frmData,
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        cache: false,
        error: function (req, status, err) {
            alert("CODE: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
            return;
        },
        success: function (res, status, req) {
            // alert(res.msg);
            if (res.result == 'OK') {
                fn_comment_list();
            } else {
                return;
            }
        }
    })
}

/**
 * * 댓글 삭제처리 함수
 * @param {Number} idx 삭제할 댓글의 Idx
 */
function handleCmtDelete(idx) {
    if (confirm("삭제하시겠습니까?") == false) {
        return;
    }

    $.ajax({
        url: "/comment/cmtDel",
        data: { r_cmt_idx: idx },
        dataType: "JSON",
        type: "POST",
        cache: false,
        error: function (req, status, err) {
            alert("CODE: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
            return;
        },
        success: function (res, status, req) {
            alert(res.msg)
            if (res.result == 'OK') {
                fn_comment_list();
            } else {
                return;
            }
        }
    })
}

function handleCmtEdit(idx) {
    const displayChk = document.querySelector("#rrp_edit_" + idx).style.display;
    if (displayChk == '') {
        document.querySelector("#rrp_edit_" + idx).style.display = 'none';
        document.querySelector("#rrp_content_" + idx).style.display = '';
        
    } else {
        document.querySelector("#rrp_edit_" + idx).style.display = '';
        // document.querySelector("#rrp_edit_" + idx).focus();
        document.querySelector("#rrp_edit_" + idx + " textarea").focus();
        document.querySelector("#rrp_content_" + idx).style.display = 'none';
    }
}

function handleCmtEditSubmit(e, idx) {
    const comment = e.target.closest(".write_box").querySelector("textarea").value;
    $.ajax({
        url: "/comment/cmtEdit",
        data: { r_cmt_idx: idx, r_content: comment },
        dataType: "JSON",
        type: "POST",
        cache: false,
        error: function (req, status, err) {
            alert("CODE: " + req.status + "\r\nmessage: " + req.responseTxt + "\r\nerror: " + err);
            return;
        },
        success: function (res, status, req) {
            // alert(res.msg)
            if (res.result == 'OK') {
                fn_comment_list();
            } else {
                return;
            }
        }
    })
}

function handleBlurEdit(idx) {
    document.querySelector("#rrp_edit_" + idx).style.display = 'none';
    document.querySelector("#rrp_content_" + idx).style.display = '';
}
function handleBlurEdit1(idx) {
    document.querySelector("#rrp_edit_" + idx).focus();
    // const child = $(event.target).siblings("button");
    // const parent = $("#rrp_edit_" + idx);
    // console.log(parent.has(child[0]));
}

function handleReportBad() {
    $.ajax({
        url: "/comment/cmtReport",
        type: "POST",
        data: $("#report_frm").serialize(),
        success: function(rs) {
            if (rs.result == "OK") {
                alert("신고되었습니다");
                closePopup();
            } else {
                alert(rs.msg||"Error")
            }
        },
        error: function() {
            closePopup();
        }
    })
}