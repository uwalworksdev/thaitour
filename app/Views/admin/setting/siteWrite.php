<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>


    <?php if(session()->getFlashdata('success')): ?>
        <script>
            alert('<?= session()->getFlashdata('success')?>');
        </script>
    <?php endif; ?>

    <style type="text/css">
        .radio_sel span {
            margin-right: 15px;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 0.45rem 0.9rem;
            font-size: calc(1rem - 1px);
            font-weight: 400;
            line-height: 31px;
            height: 31px;
            color: #454545;
            background-clip: padding-box;
            border: 1px solid #bbbbbb;
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

    <div id="container"> <span id="print_this">
        <!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>환경설정</h2>
                <div class="menus">
                    <ul>
                        <li><a href="javascript:send_its()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
                    </ul>
                </div>
            </div>
            <!-- // inner -->

        </header>
            <!-- // headerContainer -->

        <div id="contents">
            <div class="listWrap_noline">
                <form name="frm" id="frm" action="/AdmMaster/_adminrator/update" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="paymethod" id="paymethod" value="<?= $row['paymethod'] ?>">
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 기본정보 & 도메인</p>
                        </div>
                    </div>
                    <!-- // listTop -->


                    <div class="listBottom">

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
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
                                    <th>쇼핑몰명</th>
                                    <td><input type="text" id="site_name" name="site_name"
                                               value="<?= $row['site_name'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /></td>
                                    <th>환율</th>
                                    <td><input type="text" id="baht_thai" name="baht_thai"
                                               value="<?= $row['baht_thai'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:100px" />BAHT_(원)</td>
                                </tr>

                                <tr>
                                    <th>세금및 서비스</th>
                                    <td colspan="3">
                                        <input type="radio" name="type_extra_cost" id="extra_cost_1" value="P" 
                                            <?php if($row['type_extra_cost'] == "P" || empty($row['type_extra_cost'])) echo "checked" ; ?>>
                                        <label for="extra_cost_1"><span>세금율</span></label>
                                        <input type="radio" name="type_extra_cost" id="extra_cost_2" value="D" 
                                            <?php if($row['type_extra_cost'] == "D" ) echo "checked" ; ?>>
                                        <label for="extra_cost_2"><span>가격</span></label>
                                        <input type="text" id="extra_cost" name="extra_cost" oninput="this.value = this.value.replace(/[^0-9.,]/g, '')" maxlength="11"
                                                value="<?= $row['extra_cost'] ?>" class="input_txt placeHolder" rel=""
                                                style="width:250px; margin-left: 10px;" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>쇼핑몰 대표 도메인</th>
                                    <td><input type="text" id="domain_url" name="domain_url"
                                               value="<?= $row['domain_url'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /></td>
                                    <th>관리자 비번수정</th>
                                    <td>
                                        <input type="text" id="admin_pass" name="admin_pass" value=""
                                               class="input_txt placeHolder" rel="" style="width:150px" />
                                        <input type="text" id="admin_pass_r" name="admin_pass_r" value=""
                                               class="input_txt placeHolder" rel="" style="width:150px" />
                                        <a href="#!" onclick="pass_change();" class="btn btn-default"
                                           style="margin-bottom:5px"><span class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">비번수정</span></a>
                                    </td>
                                </tr>

                                <tr>
                                    <th>관리자명</th>
                                    <td>
                                        <input type="text" id="admin_name" name="admin_name"
                                               value="<?= $row['admin_name'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />
                                    </td>
                                    <th>관리자 이메일</th>
                                    <td>
                                        <input type="text" id="admin_email" name="admin_email"
                                               value="<?= $row['admin_email'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_ADMIN_EMAIL
                                    </td>
                                </tr>
                                <tr>
                                    <th>휴대전화</th>
                                    <td colspan="3">
                                        <input type="text" id="admin_mobile_list" name="admin_mobile_list"
                                               value="<?= $row['admin_mobile_list'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:800px" />
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
                                    <th>브라우져 타이틀</th>
                                    <td colspan="3"><input type="text" id="browser_title" name="browser_title"
                                                           value="<?= $row['browser_title'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_BROWSER_TITLE</td>
                                </tr>

                                <tr>
                                    <th>메타 테그</th>
                                    <td colspan="3"><input type="text" id="meta_tag" name="meta_tag"
                                                           value="<?= $row['meta_tag'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_META_TAG</td>
                                </tr>

                                <tr>
                                    <th>메타 키워드</th>
                                    <td colspan="3"><input type="text" id="meta_keyword" name="meta_keyword"
                                                           value="<?= $row['meta_keyword'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_META_KEYWORD</td>
                                </tr>
                                <tr>
                                    <th>og:제목</th>
                                    <td colspan="3"><input type="text" id="og_title" name="og_title"
                                                           value="<?= $row['og_title'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_OG_TITLE</td>
                                </tr>
                                <tr>
                                    <th>og:부가설명</th>
                                    <td colspan="3"><input type="text" id="og_des" name="og_des"
                                                           value="<?= $row['og_des'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_OG_DES</td>
                                </tr>
                                <tr>
                                    <th>og:url</th>
                                    <td colspan="3"><input type="text" id="og_url" name="og_url"
                                                           value="<?= $row['og_url'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_OG_URL</td>
                                </tr>
                                <tr>
                                    <th>og:사이트이름</th>
                                    <td colspan="3"><input type="text" id="og_site" name="og_site"
                                                           value="<?= $row['og_site'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_OG_SITE</td>
                                </tr>
                                <tr>
                                    <th>og:이미지</th>
                                    <td colspan="3">
                                        <input type="file" name="ufile2" class="bbs_inputbox_pixel"
                                               style="width:300px" />
                                        <br />
                                        <img src="/uploads/setting/<?= $row["og_img"] ?>" style="max-height:200px">_OG_IMG
                                    </td>
                                </tr>

                                <tr>
                                    <th>구매혜택</th>
                                    <td colspan="3"><input type="text" id="buytext" name="buytext"
                                                           value="<?= $row['buytext'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:70%;" />_BUYTEXT</td>
                                </tr>


                                <tr>
                                    <th>예약안내</th>
                                    <td><textarea style="border:1px solid #bbb;padding: 0.45rem 0.9rem;border-radius: 0.25em;" name="trantext" cols="100" rows="5"><?= $row['trantext'] ?></textarea>_SITE_INFORM
                                    </td>
                                </tr>

                                <tr>
                                    <th>해외구매안내</th>
                                    <td><textarea style="border:1px solid #bbb;padding: 0.45rem 0.9rem;border-radius: 0.25em;" name="oversea_purchase" cols="100"
                                                  rows="5"><?= $row['oversea_purchase'] ?></textarea>_OVEREA_PURCHASE</td>
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
                                               value="<?= $row['home_name'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_HOME_NAME</td>
                                    <th>상호영문</th>
                                    <td><input type="text" id="home_name_en" name="home_name_en"
                                               value="<?= $row['home_name_en'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_HOME_NAME_EN</td>
                                </tr>

                                <tr>
                                    <th>업태</th>
                                    <td><input type="text" id="store_service01" name="store_service01"
                                               value="<?= $row['store_service01'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_UPTAE</td>
                                    <th>종목</th>
                                    <td><input type="text" id="store_service02" name="store_service02"
                                               value="<?= $row['store_service02'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_JONGMOK</td>
                                </tr>
                                <tr>
                                    <th>고객문의 이메일</th>
                                    <td><input type="text" id="qna_email" name="qna_email"
                                               value="<?= $row['qna_email'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_QNA_EMAIL</td>
                                    <th>서비스품목</th>
                                    <td><input type="text" id="service_item" name="service_item"
                                               value="<?= $row['service_item'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_SERVICE_ITEM</td>
                                </tr>
                                <tr>
                                    <th>브랜드</th>
                                    <td colspan="3">
                                        <input type="text" id="brand_name" name="brand_name"
                                               value="<?= $row['brand_name'] ?>" class="input_txt placeHolder" rel=""
                                               style="width: 980px"/>_IT_BRAND_NAME
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" name="zip" id="zip" value="<?= $row["zip"] ?>" class="text"
                                               style="margin-bottom:5px;" placeholder="우편번호 입력" readonly>
                                        <a href="javascript:execDaumPostcode('frm','zip','addr1','addr2')"
                                           class="btn btn-default" style="margin-bottom:5px"><span
                                                    class="glyphicon glyphicon-cog"></span><span class="txt">주소검색</span></a>

                                        <div class="address_info">
                                            <input type="text" name="addr1" id="addr1" value="<?= $row["addr1"] ?>"
                                                   class="text" style="width:90%;margin-bottom:5px" placeholder="주소 입력"
                                                   readonly>_IT_ADDR1
                                            <input type="text" name="addr2" id="addr2" value="<?= $row["addr2"] ?>"
                                                   class="text" style="width:90%;" placeholder="상세 주소 입력">_IT_ADDR2
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <th>시드니 주소</th>
                                    <td colspan="3">
                                        <div class="address_info">
                                           <input type="text" name="sydney_addr" id="sydney_addr" value="<?= $row["sydney_addr"] ?>" class="text" style="margin-bottom:5px;width:800px;" placeholder="시드니 주소" >_SYDNEY_ADDR
										</div>
                                    </td> -->
                                </tr>
                                <tr>
                                    <th>대표자명</th>
                                    <td><input type="text" id="com_owner" name="com_owner"
                                               value="<?= $row['com_owner'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_COM_OWNER</td>
                                    <th>개인정보보호 담당자명</th>
                                    <td><input type="text" id="info_owner" name="info_owner"
                                               value="<?= $row['info_owner'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_INFO_OWNER</td>
                                </tr>
                                <tr>
                                    <th>대표번호(고객센터)</th>
                                    <td><input type="text" id="custom_phone" name="custom_phone"
                                               value="<?= $row['custom_phone'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_CUSTOM_PHONE</td>
                                    <th>팩스번호</th>
                                    <td><input type="text" id="fax" name="fax" value="<?= $row['fax'] ?>"
                                               class="input_txt placeHolder" rel="" style="width:250px" />_IT_FAX</td>
                                </tr>

                                <tr>
                                    <th>서울지사</th>
                                    <td><input type="text" id="custom_service_phone_seoul"
                                               name="custom_service_phone_seoul"
                                               value="<?= $row['custom_service_phone_seoul'] ?>"
                                               class="input_txt placeHolder" rel=""
                                               style="width:250px" />_CUSTOM_SERVICE_PHONE_SEOUL</td>
                                    <!-- <th>시드니 본사</th>
                                    <td><input type="text" id="custom_service_phone_sydney"
                                               name="custom_service_phone_sydney"
                                               value="<?= $row['custom_service_phone_sydney'] ?>"
                                               class="input_txt placeHolder" rel=""
                                               style="width:250px" />_CUSTOM_SERVICE_PHONE_SYDNEY <input type="text"
                                                                                                         id="custom_service_phone_sydney_call_from_australia"
                                                                                                         name="custom_service_phone_sydney_call_from_australia"
                                                                                                         value="<?= $row['custom_service_phone_sydney_call_from_australia'] ?>"
                                                                                                         class="input_txt placeHolder" rel=""
                                                                                                         style="width:250px; margin-left: 5px" />_CUSTOM_SERVICE_PHONE_SYDNEY_CALL_FROM_AUSTRALIA
                                    </td> -->
                                    <th>관광사업등록번호</th>
                                    <td><input type="text" id="tournum" name="tournum"
                                               value="<?= $row['tournum'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" />_IT_TOUR_NO</td>
                                </tr>

                                <tr>
                                    <th>사업자등록번호</th>
                                    <td colspan="3"><input type="text" id="comnum" name="comnum"
                                               value="<?= $row['comnum'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:500px" />_IT_COMNUM</td>
                                    
                                </tr>
                                <tr>
                                    <th>통신판매번호</th>
                                    <td colspan="3"><input type="text" id="mallOrder" name="mallOrder"
                                                           value="<?= $row['mallOrder'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:500px" />_IT_MALL_ORDER</td>
                                </tr>
                                <tr>
                                    <th>Copyright</th>
                                    <td colspan="3"><input type="text" id="copyright" name="copyright"
                                                           value="<?= $row['copyright'] ?>" class="input_txt placeHolder" rel=""
                                                           style="width:500px" />_IT_COPYRIGHT</td>
                                </tr>

                                <tr>
                                    <th>로고 이미지</th>
                                    <td>
                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                               style="width:300px" /> 삭제 : <input type="checkbox" name="dels" id="dels"
                                                                                  value="y" />
                                        <br />
                                        <img src="/uploads/setting/<?= $row["logos"] ?>" style="max-height:200px">
                                    </td>
                                    <th>파비콘</th>
                                    <td>
                                        <input type="file" name="ufile3" class="bbs_inputbox_pixel"
                                               style="width:300px" />
                                        <br />
                                        <img src="/uploads/setting/<?= $row["favico"] ?>" style="max-height:200px">
                                        _IT_FAVICO
                                    </td>
                                </tr>

                                <!-- <tr>
                                    <th>추천 검색어</th>
                                    <td colspan="3">
                                        <input type="text" name="search_word" class="bbs_inputbox_pixel"
                                            style="width:600px" value="<?= $row["search_word"] ?>" />_SEARCH_WORD
                                        <span style="color:red;"> 검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)유럽,해외연수,하노니여행</span>
                                    </td>
                                </tr> -->


                            </tbody>
                        </table>
                    </div>



                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ SMS 연동</p>
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
                                    <th>알림톡 apikey</th>
                                    <td><input type="text" id="allim_apikey" name="allim_apikey"
                                               value="<?= $row['allim_apikey'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:300px" /> _ALLIM_APIKEY</td>
                                </tr>

                                <tr>
                                    <th>알림톡 userid</th>
                                    <td><input type="text" id="allim_userid" name="allim_userid"
                                               value="<?= $row['allim_userid'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:300px" /> _ALLIM_USERID</td>
                                </tr>

                                <tr>
                                    <th>알림톡 senderkey</th>
                                    <td><input type="text" id="allim_senderkey" name="allim_senderkey"
                                               value="<?= $row['allim_senderkey'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:300px" /> _ALLIM_SENDERKEY</td>
                                </tr>

                                <tr>
                                    <th>문자 발신번호</th>
                                    <td><input type="text" id="sms_phone" name="sms_phone"
                                               value="<?= $row['sms_phone'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:300px" />_IT_SMS_PHONE</td>
                                </tr>

                                <tr>
                                    <th>이메일</th>
                                    <td><input type="text" id="email" name="email" value="<?= $row['email'] ?>"
                                               class="input_txt placeHolder" rel="" style="width:300px" /></td>
                                </tr>

                                <!--
						<tr>
							<th>예금주</th>
							<td ><input type="text" id="banks" name="banks" value="<?= $row['banks'] ?>" class="input_txt placeHolder" rel="" style="width:250px" /></td>
						</tr>

						-->

                                <tr>
                                    <th>SSL 사용</th>
                                    <td class="radio_sel">
                                        <input type="radio" name="ssl_chk" id="ssl_Y" value="Y" <?php if
                                        ($row['ssl_chk']=="Y" ) echo "checked" ; ?>><label
                                                for="ssl_Y"><span>사용</span></label>
                                        <input type="radio" name="ssl_chk" id="ssl_N" value="N" <?php if
                                        ($row['ssl_chk']=="N" ) echo "checked" ; ?>><label
                                                for="ssl_N"><span>사용안함</span></label>
                                        (전체 사이트를 SSL 적용 여부를 선택합니다.)
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
                                               value="<?= $row['smtp_host'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /> _SMTP_HOST</td>
                                </tr>

                                <tr>
                                    <th>ID</th>
                                    <td><input type="text" id="smtp_id" name="smtp_id" value="<?= $row['smtp_id'] ?>"
                                               class="input_txt placeHolder" rel="" style="width:250px" /> _SMTP_ID</td>
                                </tr>

                                <tr>
                                    <th>PASS</th>
                                    <td><input type="text" id="smtp_pass" name="smtp_pass"
                                               value="<?= $row['smtp_pass'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /> _SMTP_PASS</td>
                                </tr>

                                <tr>
                                    <th>이메일 발송</th>
                                    <td><input type="text" id="admin_email_list" name="admin_email_list"
                                               value="<?= $row['admin_email_list'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:80%" /> _ADMIN_EMAIL_LIST</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ NICEPAY 인증결제</p>
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
                                    <th>취소비번</th>
                                    <td><input type="text" id="nicepay_pass" name="nicepay_pass"
                                               value="<?= $row['nicepay_pass'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /> _NICEPAY_PASS</td>
                                </tr>

                                <tr>
                                    <th>MID</th>
                                    <td><input type="text" id="nicepay_mid" name="nicepay_mid"
                                               value="<?= $row['nicepay_mid'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /> _NICEPAY_MID</td>
                                </tr>

                                <tr>
                                    <th>Key</th>
                                    <td><input type="text" id="nicepay_key" name="nicepay_key"
                                               value="<?= $row['nicepay_key'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:700px" /> _NICEPAY_KEY</td>
                                </tr>

                                <tr>
                                    <th>결제수단</th>
                                    <td class="radio_sel">
                                        <?php
                                        $_paymethod = explode(",", "Card,Rbank,Vbank");
                                        $paymethod  = explode(",", $row['paymethod']);
                                        for ($i = 0; $i < count($_paymethod); $i++) {
                                            $check = 0;
                                            for ($ii = 0; $ii < count($paymethod); $ii++) {
                                                if ($_paymethod[$i] == $paymethod[$ii]) $check++;
                                            }

                                            if ($check != 0) {
                                                echo "<input type='checkbox' name='_paymethod' id='paymethod_" . $i . "' value='" . $_paymethod[$i] . "' checked><label for='paymethod_" . $i . "'><span>" . getPgMethod($_paymethod[$i]) . "</span></label>";
                                            } else {
                                                echo "<input type='checkbox' name='_paymethod' id='paymethod_" . $i . "' value='" . $_paymethod[$i] . "' ><label for='paymethod_" . $i . "'><span>" . getPgMethod($_paymethod[$i]) . "</span></label>";
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ NICEPAY 비인증 결제</p>
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
                                    <th>MID</th>
                                    <td><input type="text" id="nicepay_mid_m" name="nicepay_mid_m"
                                               value="<?= $row['nicepay_mid_m'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /> _NICEPAY_MID_M</td>
                                </tr>

                                <tr>
                                    <th>Key</th>
                                    <td><input type="text" id="nicepay_key_m" name="nicepay_key_m"
                                               value="<?= $row['nicepay_key_m'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:700px" /> _NICEPAY_KEY_M</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ NICEPAY 빌링</p>
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
                                    <th>MID</th>
                                    <td><input type="text" id="nicepay_mid_b" name="nicepay_mid_b"
                                               value="<?= $row['nicepay_mid_b'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /> _NICEPAY_MID_B</td>
                                </tr>

                                <tr>
                                    <th>Key</th>
                                    <td><input type="text" id="nicepay_key_b" name="nicepay_key_b"
                                               value="<?= $row['nicepay_key_b'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:700px" /> _NICEPAY_KEY_B</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ KG 이니시스 인증 결제</p>
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
                                    <th>MID</th>
                                    <td><input type="text" id="inicis_mid" name="inicis_mid"
                                               value="<?= $row['inicis_mid'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:250px" /> _INICIS_MID</td>
                                </tr>

                                <tr>
                                    <th>SignKey</th>
                                    <td><input type="text" id="inicis_signkey" name="inicis_signkey"
                                               value="<?= $row['inicis_signkey'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:700px" /> _INICIS_KEY</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 마일리지 사용/지급 정책</p>
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
                                    <th>최소사용 마일리지</th>
                                    <td><input type="number" id="mileage_min" name="mileage_min"
                                               value="<?= $row['mileage_min'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:100px;text-align:right;" /> _MILEEAGE_MIN</td>
                                </tr>

                                <tr>
                                    <th>최대사용 마일리지</th>
                                    <td><input type="number" id="mileage_max" name="mileage_max"
                                               value="<?= $row['mileage_max'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:100px;text-align:right;" /> _MILEEAGE_MAX</td>
                                </tr>
                                <tr>
                                    <th>후기작성  지급마일리지</th>
                                    <td><input type="number" id="mileage_review" name="mileage_review"
                                               value="<?= $row['mileage_review'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:100px;text-align:right;" /> _MILEEAGE_REVIEW</td>
                                </tr>

                                <tr>
                                    <th>현금결제 지급마일리지</th>
                                    <td><input type="number" id="mileage_cash" name="mileage_cash"
                                               value="<?= $row['mileage_cash'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:100px;text-align:right;" />% _MILEEAGE_CASH</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 무통장 입금계좌</p>
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
                                    <th>예금주명</th>
                                    <td><input type="text" id="bank_owner" name="bank_owner"
                                               value="<?= $row['bank_owner'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:300px;" /> _BANK_OWNER_KOREA</td>
                                    <th>예금주명</th>
                                    <td><input type="text" id="bank_owner" name="bank_owner_australia"
                                               value="<?= $row['bank_owner_australia'] ?>" class="input_txt placeHolder"
                                               rel="" style="width:300px;" /> _BANK_OWNER_AUSTRALIA</td>
                                </tr>
                                <tr>
                                    <th>은행</th>
                                    <td><input type="text" id="bank_name" name="bank_name"
                                               value="<?= $row['bank_name'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:300px;" /> _BANK_NAME_KOREA</td>
                                    <th>은행</th>
                                    <td><input type="text" id="bank_name" name="bank_name_australia"
                                               value="<?= $row['bank_name_australia'] ?>" class="input_txt placeHolder"
                                               rel="" style="width:300px;" /> _BANK_NAME_AUSTRALIA</td>
                                </tr>

                                <tr>
                                    <th>계좌번호</th>
                                    <td><input type="text" id="bank_no" name="bank_no" value="<?= $row['bank_no'] ?>"
                                               class="input_txt placeHolder" rel="" style="width:300px" />
                                        _BANK_NO_KOREA_1<br />
                                        <div style="margin-top: 10px;">
                                            <input type="text" id="bank_no" name="bank_no1"
                                                   value="<?= $row['bank_no1'] ?>" class="input_txt placeHolder" rel=""
                                                   style="width:300px;" /> _BANK_NO_KOREA_2
                                        </div>
                                    </td>
                                    <th>계좌번호</th>
                                    <td><input type="text" id="bank_no" name="bank_no_australia"
                                               value="<?= $row['bank_no_australia'] ?>" class="input_txt placeHolder" rel=""
                                               style="width:300px" />
                                        _BANK_NO_AUSTRALIA_1<br />
                                        <div style="margin-top: 10px;">
                                            <input type="text" id="bank_no" name="bank_no_australia1"
                                                   value="<?= $row['bank_no_australia1'] ?>" class="input_txt placeHolder"
                                                   rel="" style="width:300px;" /> _BANK_NO_AUSTRALIA_2
                                        </div>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </form>





            </div>
            <!-- // listWrap -->




        </div>
            <!-- // contents -->

    </span><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->

    <script>
        function pass_change() {
            if ($("#admin_pass").val() == "" || $("#admin_pass_r").val() == "") {
                alert('비번을 입력하세요');
                $("#admin_pass").focus();
                return false;
            }

            if (!confirm("관리자 비번을 수정하시겠습니까."))
                return false;

            if ($("#admin_pass").val() != $("#admin_pass_r").val()) {
                alert('비번을 확인하세요');
                $("#admin_pass").focus();
                return false;
            }

            var message = "";
            $.ajax({

                url: "./ajax.pass_change.php",
                type: "POST",
                data: {
                    "admin_pass": $("#admin_pass").val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function(request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " +
                        error); // 실패 시 처리
                }
            });

        }

        function send_its() {

            var paymethod = "";
            $("input[name=_paymethod]:checked").each(function() {
                paymethod += $(this).val() + ',';
            })

            $("#paymethod").val(paymethod);

            $("#frm").submit();
        }
    </script>
<?= $this->endSection() ?>