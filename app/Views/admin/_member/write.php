<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>


<style>
    .btn_s_black {
        border-radius: 3px;
        color: #fff !important;
        border: 1px solid #222;
        background: #444;
        box-sizing: border-box;
        cursor: pointer;
        width: 42px !important;
    }
</style>
<div id="container"> 
<span id="print_this">

    <header id="headerContainer">
        <div class="inner">
            <h2><?= esc($titleStr) ?></h2>
            <div class="menus">
                <ul>
                    <li><a href="javascript:history.back();" class="btn btn-default"><span
                                    class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
                    <?php if (isset($member['m_idx'])): ?>
                        <li><a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
                        <li><a href="javascript:del_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a></li>
                    <?php else: ?>
                        <li><a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </header> 

    <?= form_open('member/update/' . $member['m_idx'], ['name' => 'frm', 'target' => 'hiddenFrame']) ?>
    <?= form_hidden('o_status', $status) ?>
    
    <div id="contents">
        <div class="listWrap_noline">
            <div class="listBottom">
                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                    <colgroup>
                        <col width="10%"/>
                        <col width="40%"/>
                        <col width="10%"/>
                        <col width="40%"/>
                    </colgroup>
                    <tbody>
                        <!-- 아이디 -->
                        <tr height="45">
                            <th>아이디</th>
                            <td><?= esc($member['user_id']) ?></td>
                            <th>비밀번호</th>
                            <td><input type="password" name="user_pw" autocomplete="new-password" value=""
                                       class="bbs_inputbox_pixel" style="width:200px" maxlength="50"/></td>
                        </tr>

                        <!-- 레벨 và 현황 -->
                        <tr height="45">
                            <th>레벨</th>
                            <td>
                                <select name="user_level">
                                    <option value="10" <?= $member['user_level'] == "10" ? 'selected' : '' ?>>일반</option>
                                    <option value="9" <?= $member['user_level'] == "9" ? 'selected' : '' ?>>실버</option>
                                    <option value="8" <?= $member['user_level'] == "8" ? 'selected' : '' ?>>골드</option>
                                    <option value="7" <?= $member['user_level'] == "7" ? 'selected' : '' ?>>VIP</option>
                                    <option value="6" <?= $member['user_level'] == "6" ? 'selected' : '' ?>>VVIP</option>
                                </select>
                            </td>
                            <th>현황</th>
                            <td>
                                <select name="status" onchange="javascript:change_it(this.value)">
                                    <option value="Y" <?= $member['status'] == "Y" ? 'selected' : '' ?>>이용중</option>
                                    <option value="N" <?= $member['status'] == "N" ? 'selected' : '' ?>>정지중</option>
                                    <option value="O" <?= $member['status'] == "O" ? 'selected' : '' ?>>탈퇴</option>
                                </select>
                            </td>
                        </tr>

                        <!-- 성명 và 이메일 -->
                        <tr height="45">
                            <th>성명</th>
                            <td><input type="text" name="user_name" value="<?= esc($member['user_name']) ?>"
                                       class="bbs_inputbox_pixel" style="width:200px" maxlength="50"/></td>
                            <th>이메일</th>
                            <td>
                                <input type="text" class="mail_write" name="email1" id="email1"
                                       style="ime-mode:disabled;width:150px" value="<?= esc($email1) ?>">
                                <em>@</em>
                                <input type="text" class="mail_write" name="email2" id="email2"
                                       style="ime-mode:disabled;width:100px" value="<?= esc($email2) ?>">
                                <select name="email3" id="email3" onChange="javascript:changeEmail()">
                                    <option value="">직접입력</option>
                                    <option value="naver.com" <?= $email2 == "naver.com" ? 'selected' : '' ?>>naver.com</option>
                                    <option value="daum.net" <?= $email2 == "daum.net" ? 'selected' : '' ?>>daum.net</option>
                                    <option value="gmail.com" <?= $email2 == "gmail.com" ? 'selected' : '' ?>>gmail.com</option>
                                    <option value="hotmail.com" <?= $email2 == "hotmail.com" ? 'selected' : '' ?>>hotmail.com</option>
                                    <option value="nate.com" <?= $email2 == "nate.com" ? 'selected' : '' ?>>nate.com</option>
                                </select>

                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="imfor_r03" name="user_email_yn"
                                       value="Y" <?= $member['user_email_yn'] == "Y" ? 'checked' : '' ?>><label
                                        for="imfor_r03">수신동의</label>
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="imfor_r04" class="mar_l" name="user_email_yn"
                                       value="N" <?= $member['user_email_yn'] == "N" ? 'checked' : '' ?>><label
                                        for="imfor_r04">수신동의 안함</label>
                            </td>
                        </tr>

                        <!-- 성별 và 결혼여부 -->
                        <tr height="45">
                            <th>성별</th>
                            <td>
                                <input type="radio" id="imfor_r01" name="gender"
                                       value="M" <?= $member['gender'] == "M" ? 'checked' : '' ?>><label
                                        for="imfor_r01">남성</label>
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="imfor_r02" name="gender"
                                       value="F" <?= $member['gender'] == "F" ? 'checked' : '' ?>><label
                                        for="imfor_r02">여성</label>
                            </td>
                            <th>결혼여부</th>
                            <td>
                                <input type="radio" id="imfor_05" name="marriage_yn"
                                       value="Y" <?= $member['marriage_yn'] == "Y" ? 'checked' : '' ?>><label
                                        for="imfor_05">예</label>
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="imfor_06" name="marriage_yn"
                                       value="N" <?= $member['marriage_yn'] == "N" ? 'checked' : '' ?> class="mar_l"><label
                                        for="imfor_06">아니오</label>
                            </td>
                        </tr>

                        <!-- 직업 và 생년월일 -->
                        <tr height="45">
                            <th>직업</th>
                            <td>
                                <select class="jop_sel" name="job" id="job111">
                                    <option value="">선택</option>
                                    <!-- Hiển thị các tùy chọn nghề nghiệp -->
                                    <?php foreach ($jobs as $job): ?>
                                        <option value="<?= esc($job['code_no']) ?>" <?= $member['job'] == $job['code_no'] ? 'selected' : '' ?>><?= esc($job['code_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <th>생년월일</th>
                            <td>
                                <select name="byy" id="byy">
                                    <option value="">년도선택</option>
                                    <?php for ($i = date("Y"); $i > 1900; $i--): ?>
                                        <option value="<?= $i ?>" <?= $i == $byy ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                                <em class="ig_line"><img src="/images/ico/sub_ml.png" alt="-"></em>
                                <select name="bmm" id="bmm">
                                    <option value="">월선택</option>
                                    <!-- Các tùy chọn cho tháng -->
                                    <?php for ($m = 1; $m <= 12; $m++): ?>
                                        <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>" <?= $m == $bmm ? 'selected' : '' ?>><?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>월</option>
                                    <?php endfor; ?>
                                </select>
                                <em class="ig_line"><img src="/images/ico/sub_ml.png" alt="-"></em>
                                <select name="bdd" id="bdd">
                                    <option value="">선택</option>
                                    <!-- Các tùy chọn cho ngày -->
                                    <?php for ($d = 1; $d <= 31; $d++): ?>
                                        <option value="<?= str_pad($d, 2, '0', STR_PAD_LEFT) ?>" <?= $d == $bdd ? 'selected' : '' ?>><?= str_pad($d, 2, '0', STR_PAD_LEFT) ?>일</option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>

                        <!-- 휴대전화 và 전화번호 -->
                        <tr height="45">
                            <th>휴대전화</th>
                            <td>
                                <select class="wd_sel" name="mobile1" id="mobile1">
                                    <option value="">선택</option>
                                    <option value="010" <?= $mobile1 == "010" ? 'selected' : '' ?>>010</option>
                                    <option value="011" <?= $mobile1 == "011" ? 'selected' : '' ?>>011</option>
                                    <option value="013" <?= $mobile1 == "013" ? 'selected' : '' ?>>013</option>
                                    <option value="016" <?= $mobile1 == "016" ? 'selected' : '' ?>>016</option>
                                    <option value="017" <?= $mobile1 == "017" ? 'selected' : '' ?>>017</option>
                                    <option value="018" <?= $mobile1 == "018" ? 'selected' : '' ?>>018</option>
                                    <option value="019" <?= $mobile1 == "019" ? 'selected' : '' ?>>019</option>
                                </select>
                                <em class="ig_line"><img src="/images/ico/sub_ml.png" alt="-"></em>
                                <input type="number" class="wd_md" value="<?= esc($mobile2) ?>" name="mobile2"
                                       id="mobile2" style="width:60px;height:25px;">
                                <em class="ig_line"><img src="/images/ico/sub_ml.png" alt="-"></em>
                                <input type="number" class="wd_md" value="<?= esc($mobile3) ?>" name="mobile3"
                                       id="mobile3" style="width:60px;height:25px;">
                                <?= !empty($member['user_mobile']) ? "({$member['user_mobile']})" : '' ?>
                            </td>
                            <th>전화번호</th>
                            <td>
                                <select class="wd_sel" name="phone1" id="phone1">
                                    <option value="">선택</option>
                                    <option value="02" <?= $phone1 == "02" ? 'selected' : '' ?>>02</option>
                                </select>
                                <em class="ig_line"><img src="/images/ico/sub_ml.png" alt="-"></em>
                                <input type="number" name="phone2" value="<?= esc($phone2) ?>" class="wd_md"
                                       style="width:60px;height:25px;">
                                <em class="ig_line"><img src="/images/ico/sub_ml.png" alt="-"></em>
                                <input type="number" name="phone3" value="<?= esc($phone3) ?>" class="wd_md"
                                       style="width:60px;height:25px;">
                                <?= !empty($member['user_phone']) ? "({$member['user_phone']})" : '' ?>
                            </td>
                        </tr>

                        <tr height="45">
                            <th>상품주문</th>
                            <td><?= number_format($total) ?>원 <button class="btn_s_black" type="button"
                                                                      onclick="orderList(`<?= $member['m_idx'] ?>`)"> 보기</button></td>
                            <th>쿠폰내역</th>
                            <td><button type="button" class="btn_s_black" onclick="couponList()"> 보기</button></td>
                        </tr>

                        <!-- 주소 -->
                        <tr height="45">
                            <th>주소</th>
                            <td colspan="1">
                                <input type="text" name="zip" id="sample2_postcode" placeholder="" class="bs-input"
                                       style="width:70px;" value="<?= esc($member['zip']) ?>">
                                <button type="button" onclick="openPostCode()"
                                        class="zip_btn btn btn-outline-dark">우편번호</button>
                                <input type="text" name="addr1" id="sample2_address" placeholder="" class="bs-input"
                                       style="width:130px;" value="<?= esc($member['addr1']) ?>">
                                <input type="text" name="addr2" id="sample2_detailAddress" placeholder=""
                                       class="bs-input" style="width:130px;" value="<?= esc($member['addr2']) ?>">
                            </td>
                            <th>적립금</th>
                            <td>1,500P <button type="button" class="btn_s_black"
                                               onclick="reserveList()"> 보기</button></td>
                        </tr>

                        <!-- 문자메세지, 이메일 and 카카오톡 -->
                        <tr height="45">
                            <th>문자메세지</th>
                            <td>
                                <input type="radio" name="sms_yn"
                                       value="Y" <?= $member['sms_yn'] == "Y" ? 'checked' : '' ?>>수락
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="sms_yn"
                                       value="N" <?= $member['sms_yn'] != "Y" ? 'checked' : '' ?>>거부
                            </td>
                            <th>이메일</th>
                            <td>
                                <input type="radio" name="user_email_yn"
                                       value="Y" <?= $member['user_email_yn'] == "Y" ? 'checked' : '' ?>>수락
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="user_email_yn"
                                       value="N" <?= $member['user_email_yn'] != "Y" ? 'checked' : '' ?>>거부
                            </td>
                        </tr>
                        <tr height="45">
                            <th>카카오톡</th>
                            <td>
                                <input type="radio" name="kakao_yn"
                                       value="Y" <?= $member['kakao_yn'] == "Y" ? 'checked' : '' ?>>수락
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="kakao_yn"
                                       value="N" <?= $member['kakao_yn'] != "Y" ? 'checked' : '' ?>>거부
                            </td>

                            <th>MBTI</th>
                            <td>
                                <select name="mbti" id="MBTI" class="bs-select domain_list">
                                    <?php foreach ($mcodes as $code): ?>
                                        <option <?= $code['code_no'] == $member['mbti'] ? 'selected' : '' ?> value="<?= $code['code_no'] ?>"><?= $code['code_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>

                        <!-- 탈퇴 관련 -->
                        <tr height="45" class="cls_out" style="display:none;">
                            <th>탈퇴일</th>
                            <td colspan="3"><?= esc($member['out_date']) ?></td>
                        </tr>
                        <tr height="45" class="cls_out" style="display:none;">
                            <th>탈퇴내용</th>
                            <td colspan="3">
                                <textarea name="out_reason" id="out_reason"
                                          style="width:90%;height:300px;"><?= esc($member['out_reason']) ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </span>
    <?= form_close() ?>
</div>

<script>
    function orderList(m_idx) {
        let url = "/AdmMaster/_member/member_order?member=" + m_idx;
        window.open(url, "orderList", "height=500, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
    }

    function couponList() {
        let url = "/AdmMaster/_member/member_coupon";
        window.open(url, "couponList", "height=500, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
    }

    function reserveList() {
        var url = "/AdmMaster/_member/member_reserve";
        window.open(url, "reserveList", "height=500, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
    }
</script>

<script>
    function send_it() {
        var frm = document.frm;
        if (frm.user_name.value == "") {
            frm.user_name.focus();
            alert("이름을 입력해 주세요.");
            return;
        }
        frm.submit();
    }

    function change_it(str) {
        if (str === "O") {
            $(".cls_out").show();
        } else {
            $(".cls_out").hide();
        }
    }

    <?php if ($member["status"] == "O") { ?>
    change_it('<?=$member["status"]?>');
    <?php } ?>

    function del_it() {
        if (confirm("삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
            hiddenFrame.location.href = "<?= site_url('member/delete/' . $member['m_idx']) ?>";
        }
    }
</script>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>
<?= $this->endSection() ?>
