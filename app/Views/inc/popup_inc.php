<div class="popup_wrap delete_pop">
    <div class="pop_box">
    
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="pop_txt">
                    <p>댓글이 완전히 삭제 되었습니다.</p>
                </div>
                <div class="pop_input flex_c_c">
                    <button type="button" class="default_btn" onclick="closePopup()">취소</button>      
                    <button type="button" class="default_btn" onclick="javascript:location.reload();">확인</button>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<div class="popup_wrap edit_pop">
    <div class="pop_box">
    
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="pop_txt">
                    <p>수정이 완료되었습니다.</p>
                </div>
                <div class="pop_input flex_c_c">
                    <button type="button" class="default_btn" onclick="closePopup()">취소</button>      
                    <button type="button" class="default_btn">확인</button>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<div class="popup_wrap edit_input_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="pop_txt">
                    <p>비밀번호를 입력해주세요.</p>
                </div>
                <div class="pop_input flex_c_c">
                    <input type="text" name="edit_comment">
                </div>
                <div class="pop_input flex_c_c">
                    <button type="button" class="default_btn" onclick="closePopup()">취소</button>      
                    <button type="button" class="default_btn" onclick="closePopup()">확인</button>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<div class="popup_wrap report_pop_review">
    <div class="pop_box">
    
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="pop_txt">
                    <p>신고하기</p>
                </div>
                <div class="pop_desc">
                    <p>신고 사유를 선택해주세요. 신고된 글은 즉시 차단되며</p>
                    <p>신고 내용은 이용약관 및 정책에 의해 처리됩니다. </p>
                </div>
                    <form action="" id="report_review_frm">
                        <input type="hidden" value="" class="review_idx" name="review_idx">
                        <div class="pop_input wrap_check flex_s_c">
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="부적절한 홍보 또는 비방글" id="r_radio_1" checked>
                                <label for="r_radio_1">부적절한 홍보 또는 비방글</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="욕설 또는 무의미한 단어의 반복" id="r_radio_2">
                                <label for="r_radio_2">욕설 또는 무의미한 단어의 반복</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="욕설 또는 무의미한 단어의 반복" id="r_radio_3">
                                <label for="r_radio_3">욕설 또는 무의미한 단어의 반복</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="명예훼손 및 저작권 침해 등" id="r_radio_4">
                                <label for="r_radio_4">명예훼손 및 저작권 침해 등</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="관련법 위반" id="r_radio_5">
                                <label for="r_radio_5">관련법 위반</label>
                            </div>
                        </div>
                    </form>
                <div class="pop_input flex_c_c">
                    <button type="button" class="default_btn" onclick="closePopup()">취소</button>      
                    <button type="button" class="default_btn" onclick="confirmReport()" >확인</button>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<div class="popup_wrap report_pop" data-idx="">
    <div class="pop_box">
    
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="pop_txt">
                    <p>신고하기</p>
                </div>
                <div class="pop_desc">
                    <p>신고 사유를 선택해주세요. 신고된 글은 즉시 차단되며</p>
                    <p>신고 내용은 이용약관 및 정책에 의해 처리됩니다. </p>
                </div>
                    <form action="" id="report_frm">
                        <input type="hidden" value="<?=$r_code?>" name="code">
                        <input type="hidden" value="<?=$idx?>" name="r_idx">
                        <input type="hidden" value="" name="r_cmt_idx">
                        <div class="pop_input wrap_check flex_s_c">
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="부적절한 홍보 또는 비방글" id="radio_1" checked>
                                <label for="radio_1">부적절한 홍보 또는 비방글</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="욕설 또는 무의미한 단어의 반복" id="radio_2">
                                <label for="radio_2">욕설 또는 무의미한 단어의 반복</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="욕설 또는 무의미한 단어의 반복" id="radio_3">
                                <label for="radio_3">욕설 또는 무의미한 단어의 반복</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="명예훼손 및 저작권 침해 등" id="radio_4">
                                <label for="radio_4">명예훼손 및 저작권 침해 등</label>
                            </div>
                            <div class="check_box">
                                <input type="radio" name="report_reason" class="security" value="관련법 위반" id="radio_5">
                                <label for="radio_5">관련법 위반</label>
                            </div>
                        </div>
                    </form>
                <div class="pop_input flex_c_c">
                    <button type="button" class="default_btn" onclick="closePopup()">취소</button>      
                    <button type="button" class="default_btn" onclick="handleReportBad()" >확인</button>
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>

<script>
   function showDelete() {
    $('.delete_pop').show();
   }

   function showEdit() {
    $('.edit_pop').show();
   }
 

   function showReport(code, r_idx, r_cmt_idx) {
    <?php if ($_SESSION["member"]["id"] != "") { ?>
    $('#report_frm input[name=code]').val(code);
    $('#report_frm input[name=r_idx]').val(r_idx);
    $('#report_frm input[name=r_cmt_idx]').val(r_cmt_idx);
    $('.report_pop').show();
    <?php } else { ?>
            alert("로그인을 해주세요.");
            return;
    <?php } ?>
   }

   function showReport_comment(code, bbs_idx, tbc_idx)
   {
    <?php if ($_SESSION["member"]["id"] != "") { ?>
    $('#report_frm input[name=code]').val(code);
    $('#report_frm input[name=r_idx]').val(bbs_idx);
    $('#report_frm input[name=r_cmt_idx]').val(tbc_idx);
    $('.report_pop').show();
    <?php } else { ?>
            alert("로그인을 해주세요.");
            return;
    <?php } ?>

   }

   function showCheckPass() {
    $('.edit_input_pop').show();
   }

   function closePopup() {
    $('.popup_wrap').hide();
   }

 
</script>