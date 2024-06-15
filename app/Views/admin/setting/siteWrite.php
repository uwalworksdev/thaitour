<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<style type="text/css">
.radio_sel span {
    margin-right: .9375rem;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 7.2px 14.4px;
    font-size: calc(16px - .0625rem);
    font-weight: 400;
    line-height: 1.9375rem;
    height: 1.9375rem;
    color: #454545;
    background-clip: padding-box;
    border: .0625rem solid #bbbbbb;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    box-sizing: border-box;
    border-radius: 0.25em;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
</style>
<div id="container">
<span id="print_this">
    <header id="headerContainer">
        <div class="inner">
            <h2>사이트 기본설정</h2>
            <div class="menus">
                <ul>
                    <li>
                        <button type='submit' form="frm" class="btn btn-default">
                            <span class="glyphicon glyphicon-cog"></span>
                            <span class="txt">수정</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </header> 
    <div class="listWrap_noline">
        <form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="/settings/site/update">
            <input hidden="hidden" />
            <div class="listTop">
                <div class="left">
                    <p class="schTxt">■ 기본정보 & 도메인</p>
                </div>
            </div>
            <div class="listBottom">
                <table class="listTable mem_detail">
                    <colgroup>
                        <col style="width:9.375rem;">
                        <col style="width:35%;">
                        <col style="width:9.375rem;">
                        <col style="width:auto;">
                    </colgroup>
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                    <caption>
                            </caption>
                            <colgroup>
                                <col width="150px" />
                                <col width="*" />
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>쇼핑몰명</th>
                                    <td><input type="text" id="site_name" name="site_name"
                                    value="<?=!empty($data['site_name']) ? esc($data['site_name']) : null?>" class="input_txt placeHolder" rel=""
                                            style="width:15.625rem" /></td>
                                    <th>달러환율</th>
                                    <td><input type="text" id="us_dollar" name="us_dollar"
                                               value="<?=!empty($data['us_dollar']) ? esc($data['us_dollar']) : null?>"
                                             class="input_txt placeHolder" rel=""
                                            style="width:6.25rem" />(원)_US_DOLLAR</td>
                                </tr>            

                                <tr>
                                    <th>쇼핑몰 대표 도메인</th>
                                    <td><input type="text" id="domain_url" name="domain_url"
                                             value="<?=!empty($data['domain_url']) ? esc($data['domain_url']) : null?>"
                                             class="input_txt placeHolder" rel=""
                                            style="width:15.625rem" /></td>
                                    <th>관리자 비번수정</th>
                                    <td>
                                        <input type="text" id="admin_pass" name="admin_pass" value=""
                                            class="input_txt placeHolder" rel="" style="width:9.375rem" />
                                        <input type="text" id="admin_pass_r" name="admin_pass_r" value=""
                                            class="input_txt placeHolder" rel="" style="width:9.375rem" />
                                        <a href="#!" onclick="pass_change();" class="btn btn-default"
                                            style="margin-bottom:.3125rem"><span class="glyphicon glyphicon-cog"></span><span
                                                class="txt">비번수정</span></a>
                                    </td>
                                </tr>

                                <tr>
                                    <th>관리자명</th>
                                    <td>
                                        <input type="text" id="admin_name" name="admin_name"
                                            value="<?=!empty($data['admin_name']) ? esc($data['admin_name']) : null?>"
                                             class="input_txt placeHolder" rel=""
                                            style="width:15.625rem" />
                                    </td>
                                    <th>관리자 이메일</th>
                                    <td>
                                        <input type="text" id="admin_email" name="admin_email"
                                            value="<?=!empty($data['admin_email']) ? esc($data['admin_email']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:15.625rem" />_ADMIN_EMAIL
                                    </td>
                                </tr>
                                <tr>
                                    <th>휴대전화</th>
                                    <td colspan="3">
                                        <input type="text" id="admin_mobile_list" name="admin_mobile_list"
                                             value="<?=!empty($data['admin_mobile_list']) ? esc($data['admin_mobile_list']) : null?>"
                                             class="input_txt placeHolder" rel=""
                                            style="width:50rem" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
            </div>
            
            <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 상점기본정보</p>
                        </div>
                    </div>
                    <!-- // listTop -->

                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail ">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="150px" />
                                <col width="35%" />
                                <col width="150px" />
                                <col width="*" />
                            </colgroup>
                            <tbody>

                                <tr>
                                    <th>상호명</th>
                                    <td><input type="text" id="home_name" name="home_name"
                                              value="<?=!empty($data['home_name']) ? esc($data['home_name']) : null?>"
                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_HOME_NAME</td>
                                    <th>상호영문</th>
                                    <td><input type="text" id="home_name_en" name="home_name_en"
                                            value="<?=!empty($data['home_name_en']) ? esc($data['home_name_en']) : null?>"
                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_HOME_NAME_EN</td>
                                </tr>

                                <tr>
                                    <th>업태</th>
                                    <td><input type="text" id="store_service01" name="store_service01"
                                            value="<?=!empty($data['store_service01']) ? esc($data['store_service01']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_UPTAE</td>
                                    <th>종목</th>
                                    <td><input type="text" id="store_service02" name="store_service02"
                                            value="<?=!empty($data['store_service02']) ? esc($data['store_service02']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_JONGMOK</td>
                                </tr>
                                <tr>
                                    <th>고객문의 이메일</th>
                                    <td><input type="text" id="qna_email" name="qna_email"
                                            value="<?=!empty($data['qna_email']) ? esc($data['qna_email']) : null?>"

                                             class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_QNA_EMAIL</td>
                                    <th>서비스품목</th>
                                    <td><input type="text" id="service_item" name="service_item"
                                            value="<?=!empty($data['service_item']) ? esc($data['service_item']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_SERVICE_ITEM</td>
                                </tr>
                                <tr>
                                    <th>브랜드</th>
                                    <td colspan="3">
                                        <input type="text" id="brand_name" name="brand_name"
                                            value="<?=!empty($data['brand_name']) ? esc($data['brand_name']) : null?>"

                                            class="input_txt placeHolder" rel="" 
                                            style="width: 980px"/>_IT_BRAND_NAME
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" name="zip" id="zip" 
                                        value="<?=!empty($data['zip']) ? esc($data['zip']) : null?>"

                                        class="text"
                                            style="margin-bottom:5px;" placeholder="우편번호 입력" readonly>
                                        <a href="javascript:execDaumPostcode('frm','zip','addr1','addr2')"
                                            class="btn btn-default" style="margin-bottom:5px"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">주소검색</span></a>

                                        <div class="address_info">
                                            <input type="text" name="addr1" id="addr1" 
                                            value="<?=!empty($data['addr1']) ? esc($data['addr1']) : null?>"

                                                class="text" style="width:90%;margin-bottom:5px" placeholder="주소 입력"
                                                readonly>_IT_ADDR1
                                            <input type="text" name="addr2" id="addr2" 
                                            value="<?=!empty($data['addr2']) ? esc($data['addr2']) : null?>"

                                                class="text" style="width:90%;" placeholder="상세 주소 입력">_IT_ADDR2
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>시드니 주소</th>
                                    <td colspan="3">
                                        <div class="address_info">
                                           <input type="text" name="sydney_addr" id="sydney_addr"
                                           value="<?=!empty($data['sydney_addr']) ? esc($data['sydney_addr']) : null?>"
                                            class="text" style="margin-bottom:5px;width:800px;" placeholder="시드니 주소" >_SYDNEY_ADDR
										</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>대표자명</th>
                                    <td><input type="text" id="com_owner" name="com_owner"
                                            value="<?=!empty($data['com_owner']) ? esc($data['com_owner']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_COM_OWNER</td>
                                    <th>개인정보보호 담당자명</th>
                                    <td><input type="text" id="info_owner" name="info_owner"
                                            value="<?=!empty($data['info_owner']) ? esc($data['info_owner']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_INFO_OWNER</td>
                                </tr>
                                <tr>
                                    <th>대표번호(고객센터)</th>
                                    <td><input type="text" id="custom_phone" name="custom_phone"
                                            value="<?=!empty($data['custom_phone']) ? esc($data['custom_phone']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_CUSTOM_PHONE</td>
                                    <th>팩스번호</th>
                                    <td><input type="text" id="fax" name="fax" 
                                    value="<?=!empty($data['fax']) ? esc($data['fax']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:250px" />_IT_FAX</td>
                                </tr>

                                <tr>
                                    <th>서울지사</th>
                                    <td><input type="text" id="custom_service_phone_seoul"
                                            name="custom_service_phone_seoul"
                                            value="<?=!empty($data['custom_service_phone_seoul']) ? esc($data['custom_service_phone_seoul']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_CUSTOM_SERVICE_PHONE_SEOUL</td>
                                    <th>시드니 본사</th>
                                    <td><input type="text" id="custom_service_phone_sydney"
                                            name="custom_service_phone_sydney"
                                            value="<?=!empty($data['custom_service_phone_sydney']) ? esc($data['custom_service_phone_sydney']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_CUSTOM_SERVICE_PHONE_SYDNEY <input type="text"
                                            id="custom_service_phone_sydney_call_from_australia"
                                            name="custom_service_phone_sydney_call_from_australia"
                                            value="<?= $data['custom_service_phone_sydney_call_from_australia'] ?>"
                                            class="input_txt placeHolder" rel=""
                                            style="width:250px; margin-left: 5px" />_CUSTOM_SERVICE_PHONE_SYDNEY_CALL_FROM_AUSTRALIA
                                    </td>
                                </tr>

                                <tr>
                                    <th>사업자등록번호</th>
                                    <td><input type="text" id="comnum" name="comnum"
                                            value="<?=!empty($data['comnum']) ? esc($data['comnum']) : null?>"

                                            style="width:250px" />_IT_COMNUM</td>
                                    <th>관광사업등록번호</th>
                                    <td><input type="text" id="tournum" name="tournum"
                                            value="<?=!empty($data['tournum']) ? esc($data['tournum']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:250px" />_IT_TOUR_NO</td>
                                </tr>
                                <tr>
                                    <th>통신판매번호</th>
                                    <td colspan="3"><input type="text" id="mallOrder" name="mallOrder"
                                            value="<?=!empty($data['mallOrder']) ? esc($data['mallOrder']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:500px" />_IT_MALL_ORDER</td>
                                </tr>
                                <tr>
                                    <th>Copyright</th>
                                    <td colspan="3"><input type="text" id="copyright" name="copyright"
                                            value="<?=!empty($data['copyright']) ? esc($data['copyright']) : null?>"

                                            class="input_txt placeHolder" rel=""
                                            style="width:500px" />_IT_COPYRIGHT</td>
                                </tr>

                                <tr>
                                    <th>로고 이미지</th>
                                    <td>
                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                            style="width:300px" /> 삭제 : <input type="checkbox" name="dels" id="dels"
                                            value="y" />
                                        <br />
                                        <img src="/data/home/<?= $data["logos"] ?>" style="max-height:200px">
                                    </td>
                                    <th>파비콘</th>
                                    <td>
                                        <input type="file" name="ufile3" class="bbs_inputbox_pixel"
                                            style="width:300px" /> 
                                        <br />
                                        <img src="/data/home/<?= $data["favico"] ?>" style="max-height:200px">
                                        _IT_FAVICO
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 이메일 연동</p>
                        </div>
                    </div>
                    <!-- // listTop -->

                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail ">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="150px" />
                                <col width="*" />
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>HOST</th>
                                    <td><input type="text" id="smtp_host" name="smtp_host"
                                            value="<?= $data["smtp_host"] ?>" class="input_txt placeHolder" rel=""
                                            style="width:250px" /> _SMTP_HOST</td>
                                </tr>

                                <tr>
                                    <th>ID</th>
                                    <td><input type="text" id="smtp_id" name="smtp_id" value="<?= $data["smtp_id"] ?>"
                                            class="input_txt placeHolder" rel="" style="width:250px" /> _SMTP_ID</td>
                                </tr>

                                <tr>
                                    <th>PASS</th>
                                    <td><input type="text" id="smtp_pass" name="smtp_pass"
                                            value="<?= $data["smtp_pass"] ?>" class="input_txt placeHolder" rel=""
                                            style="width:250px" /> _SMTP_PASS</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
        </form>
    </div>
    


</span>
</div>
<script>
document.getElementById('frm').addEventListener('submit', function(event) {
    if (!confirm('Are you sure you want to update the settings?')) {
        event.preventDefault();
    }
});
</script>
<?= $this->endSection() ?>