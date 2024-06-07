

<?=$this->extend("admin/inc/layout_admin")?>
<?=$this->section("body")?>
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

        <div id="contents">
            <div class="listWrap_noline">
                <form name="frm" id="frm" method="POST" enctype="multipart/form-data">
                    <input hidden="hidden" />
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 기본정보 & 도메인</p>
                        </div>
                    </div>

                    <div class="listBottom">
                        <table class="listTable mem_detail">
                            <colgroup>
                                <col style="width:150px;">
                                <col style="width:35%;">
                                <col style="width:150px;">
                                <col style="width:auto;">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>사이트명</th>
                                    <td>
                                        <input type="text" id="site_name" name="site_name"
                                            value="<?=!empty($data['site_name']) ? esc($data['site_name']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_SITE_NAME
                                    </td>
                                    <th>사이트 대표 도메인</th>
                                    <td>
                                        <input type="text" id="domain_url" name="domain_url"
                                            value="<?=!empty($data['domain_url']) ? esc($data['domain_url']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_DOMAIN_URL
                                    </td>
                                </tr>

                                <tr>
                                    <th>관리자명</th>
                                    <td>
                                        <input type="text" id="admin_name" name="admin_name" value=""
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_ADMIN_NAME
                                    </td>
                                    <th>관리자 이메일</th>
                                    <td>
                                        <input type="text" id="admin_email" name="admin_email" value=""
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_ADMIN_EMAIL
                                    </td>
                                </tr>

                                <tr>
                                    <th>비밀번호입력</th>
                                    <td>
                                        <input type="password" id="passwd" name="passwd" value=""
                                            class="input_txt placeHolder" rel="" style="width:200px" />
                                    </td>
                                    <th>비밀번호확인</th>
                                    <td>
                                        <input type="password" id="passwdChk" name="passwdChk" value=""
                                            class="input_txt placeHolder" rel="" style="width:200px" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 사이트 기본값</p>
                        </div>
                    </div>

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
                                    <th>브라우져 타이틀</th>
                                    <td>
                                        <input type="text" id="browser_title" name="browser_title"
                                            value="<?=!empty($data['browser_title']) ? esc($data['browser_title']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_BROWSER_TITLE
                                    </td>
                                </tr>

                                <tr>
                                    <th>메타 테그</th>
                                    <td>
                                        <input type="text" id="meta_tag" name="meta_tag"
                                            value="<?=!empty($data['meta_tag']) ? esc($data['meta_tag']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_META_TAG
                                    </td>
                                </tr>

                                <tr>
                                    <th>메타 키워드</th>
                                    <td>
                                        <input type="text" id="meta_keyword" name="meta_keyword"
                                            value="<?=!empty($data['meta_keyword']) ? $data['meta_keyword'] : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_META_KEYWORD
                                    </td>
                                </tr>

                                <tr>
                                    <th>og:제목</th>
                                    <td>
                                        <input type="text" id="og_title" name="og_title"
                                            value="<?=!empty($data['og_title'] ? esc($data['og_title']) : null)?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_OG_TITLE
                                    </td>
                                </tr>
                                <tr>
                                    <th>og:부가설명</th>
                                    <td>
                                        <input type="text" id="og_des" name="og_des"
                                            value="<?=!empty($data['og_des']) ? esc($data['og_des']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_OG_DES
                                    </td>
                                </tr>
                                <tr>
                                    <th>og:url</th>
                                    <td>
                                        <input type="text" id="og_url" name="og_url"
                                            value="<?=!empty($data['og_url']) ? esc($data['og_url']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_OG_URL
                                    </td>
                                </tr>
                                <tr>
                                    <th>og:사이트이름</th>
                                    <td>
                                        <input type="text" id="og_site" name="og_site"
                                            value="<?=!empty($data['og_site']) ? esc($data['og_site']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_OG_SITE
                                    </td>
                                </tr>
                                <tr>
                                    <th>og:이미지</th>
                                    <!-- <td colspan="3">
                                        <input type="file" name="og_img" class="bbs_inputbox_pixel"
                                            style="width:300px" /> _IT_OG_IMG
                                        <br />
                                        <? if (!empty($data["og_img"])) { ?>
                                        <img src="/uploads/setting/<?=$data["og_img"]?>" style="max-height:200px">
                                        <? } ?>
                                    </td> -->
                                </tr>


                                <tr>
                                    <th>COPY RIGHT</th>
                                    <td>
                                        <input type="text" id="buytext" name="buytext"
                                            value="<?=!empty($data['buytext']) ? esc($data['buytext']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_BUY_TEXT
                                    </td>
                                </tr>


                                <tr>
                                    <th>반품지 주소</th>
                                    <td>
                                        <input type="text" id="trantext" name="trantext"
                                            value="<?=!empty($data['trantext']) ? esc($data['trantext']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>favico 이미지</th>
                                    <td colspan="3">
                                        <input type="file" name="favico_img" class="bbs_inputbox_pixel"
                                            style="width:300px" /> _IT_FAVICO_IMG
                                        <br />
                                        <? if (!empty($data["og_img"])) { ?>
                                        <img src="/uploads/setting/<?=$data["favico_img"]?>" style="max-height:200px">
                                        <? } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>네이버 verification</th>
                                    <td>
                                        <input type="text" id="naver_verfct" name="naver_verfct"
                                            value="<?=!empty($data['naver_verfct']) ? esc($data['naver_verfct']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_NAVER_VERFCT
                                    </td>
                                </tr>
                                <tr>
                                    <th>구글 verification</th>
                                    <td>
                                        <input type="text" id="google_verfct" name="google_verfct"
                                            value="<?=!empty($data['google_verfct']) ? esc($data['google_verfct']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:70%;" /> _IT_GOOGLE_VERFCT
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
                                    <td>
                                        <input type="text" id="home_name" name="home_name"
                                            value="<?=!empty($data['home_name']) ? esc($data['home_name']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_HOME_NAME
                                    </td>
                                    <th>상호영문</th>
                                    <td>
                                        <input type="text" id="home_name_en" name="home_name_en"
                                            value="<?=!empty($data['home_name_en']) ? esc($data['home_name_en']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_HOME_NAME_EN
                                    </td>
                                </tr>

                                <tr>
                                    <th>업태</th>
                                    <td>
                                        <input type="text" id="store_service01" name="store_service01"
                                            value="<?=!empty($data['store_service01']) ? esc($data['store_service01']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_STORE_SER01
                                    </td>
                                    <th>종목</th>
                                    <td>
                                        <input type="text" id="store_service02" name="store_service02"
                                            value="<?=!empty($data['store_service02']) ? esc($data['store_service02']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_STORE_SER02
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" name="zip" id="zip"
                                            value="<?=!empty($data['zip']) ? esc($data['zip']) : null?>" class="text"
                                            style="margin-bottom:5px;" placeholder="우편번호 입력" readonly /> _IT_ZIP_CODE
                                        <button type='button' onclick="execDaumPostcode('frm','zip','addr1','addr2')"
                                            class="btn btn-default" style="margin-bottom:5px">
                                            <span class="glyphicon glyphicon-cog"></span>
                                            <span class="txt">주소검색</span>
                                        </button>

                                        <div class="address_info">
                                            <input type="text" name="addr1" id="addr1"
                                                value="<?=!empty($data['addr1']) ? esc($data['addr1']) : null?>"
                                                class="text" style="width:90%;margin-bottom:5px" placeholder="주소 입력"
                                                readonly>
                                            _IT_ADDR1
                                            <input type="text" name="addr2" id="addr2"
                                                value="<?=!empty($data['addr2']) ? esc($data['addr2']) : null?>"
                                                class="text" style="width:90%;" placeholder="상세 주소 입력"> _IT_ADDR2
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <th>사업자번호</th>
                                    <td>
                                        <input type="text" id="comnum" name="comnum"
                                            value="<?=!empty($data['comnum']) ? esc($data['comnum']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_COMNUM
                                    </td>
                                    <th>통신판매신고번호</th>
                                    <td>
                                        <input type="text" id="mall_order" name="mall_order"
                                            value="<?=!empty($data['mall_order']) ? esc($data['mall_order']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_MALL_ORDER
                                    </td>
                                </tr>
                                <tr>
                                    <th>대표자명</th>
                                    <td>
                                        <input type="text" id="com_owner" name="com_owner"
                                            value="<?=!empty($data['com_owner']) ? esc($data['com_owner']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_COM_OWNER
                                    </td>
                                    <th>개인정보보호 담당자명</th>
                                    <td>
                                        <input type="text" id="info_owner" name="info_owner"
                                            value="<?=!empty($data['info_owner']) ? esc($data['info_owner']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_INFO_OWER
                                    </td>
                                </tr>
                                <tr>
                                    <th>대표번호(고객센터)</th>
                                    <td>
                                        <input type="text" id="custom_phone" name="custom_phone"
                                            value="<?=!empty($data['custom_phone']) ? esc($data['custom_phone']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_CUSTOM_PHONE
                                        (여러개일 경우 / 로 추가)
                                    </td>
                                    <th>팩스번호</th>
                                    <td>
                                        <input type="text" id="fax" name="fax"
                                            value="<?=!empty($data['fax']) ? esc($data['fax']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:200px" /> _IT_FAX
                                    </td>
                                </tr>

                                <tr>
                                    <th>상담시간1</th>
                                    <td>
                                        <input type="text" id="counsel1" name="counsel1"
                                            value="<?=!empty($data['counsel1']) ? esc($data['counsel1']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:300px" /> _IT_COUNSEL1
                                    </td>
                                    <th>상담시간2</th>
                                    <td>
                                        <input type="text" id="counsel2" name="counsel2"
                                            value="<?=!empty($data['counsel2']) ? esc($data['counsel2']) : null?>"
                                            class="input_txt placeHolder" rel="" style="width:300px" /> _IT_COUNSEL2
                                    </td>
                                </tr>

                                <tr>
                                    <th>로고 이미지</th>
                                    <td colspan="3">
                                        <input type="file" name="logos" class="bbs_inputbox_pixel"
                                            style="width:300px" />
                                        <!-- 삭제 : <input type="checkbox" name="dels" id="dels"
                                            value="y" />  -->
                                        _IT_LOGOS
                                        <br />
                                        <? if (!empty($data["logos"])) { ?>
                                        <img src="/uploads/setting/<?=$data["logos"]?>" style="max-height:200px">
                                        <? } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>하단 로고 이미지</th>
                                    <td colspan="3">
                                        <input type="file" name="logo_footer" class="bbs_inputbox_pixel"
                                            style="width:300px" />
                                        <!-- 삭제 : <input type="checkbox" name="dels_f" id="dels_f"
                                            value="y" />  -->
                                        _IT_LOGOS_FOOTER
                                        <br />
                                        <? if (!empty($data["logo_footer"])) { ?>
                                        <img src="/uploads/setting/<?=$data["logo_footer"]?>" style="max-height:200px">
                                        <? } ?>
                                    </td>
                                </tr>

                                <!-- <tr>
                                    <th>사업자 회원</th>
                                    <td colspan="3">
                                        사용 <input type="radio" name="use_mem1" value="Y" />
                                        | 사용안함 <input type="radio" name="use_mem1" value="N" />
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

    </span>
</div>
<?=$this->endSection()?>