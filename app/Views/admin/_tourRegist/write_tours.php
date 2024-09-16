<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <style>
        .tab_title {
            font-size: 16px;
            color: #333333;
            font-weight: bold;
            height: 28px;
            line-height: 28px;
            background: url('/img/ico/deco_tab_title.png') left center no-repeat;
            padding-left: 43px;
            margin-left: 7px;
            margin-bottom: 26px;
        }

        #input_file_ko {
            display: inline-block;
            width: 500px;
        }
    </style>
<?php $back_url = "write"; ?>
    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }
    </script>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2>자유여행 상품관리 정보입력 <?= $titleStr ?> </h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="list_tours?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                                   class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                            class="txt">리스트</span></a></li>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:prod_copy('<?= $product_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">제품복사</span></a>
                                </li>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li><a href="javascript:del_it('<?= $product_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span
                                                class="txt">완전삭제</span></a></li>
                                <script>
                                    function copy_it() {
                                        if (confirm("제품을 복사하시겠습니까?")) {
                                            location.href = "copy.php?product_idx=<?=$product_idx?>";
                                        }
                                    }
                                </script>
                            <?php } else { ?>

                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <!-- // inner -->
            </header>
            <!-- // headerContainer -->

            <form name=frm action="write_tours_ok.php" method=post enctype="multipart/form-data" target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>
                <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
                <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
                <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>
                <input type=hidden name="product_option" id="product_option" value=''>
                <input type=hidden name="tours_cate" id="tours_cate" value='<?= $tours_cate ?>'>

                <div id="contents">
                    <div class="listWrap_noline">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>

                                <tr>
                                    <th>상품분류</th>
                                    <td>
                                        <select id="product_code_1" name="product_code_1" class="input_select"
                                                onchange="javascript:get_code(this.value, 3)">
                                            <option value="">1차분류</option>
                                            <?php
                                            foreach ($fresult as $frow):
                                                $status_txt = "";
                                                if ($frow["status"] == "Y") {
                                                    $status_txt = "";
                                                } elseif ($frow["status"] == "N") {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["status"] == "C") {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_1) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                            <?php endforeach; ?>

                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select"
                                                onchange="javascript:get_code(this.value, 4)">
                                            <option value="">2차분류</option>
                                            <?php
                                            foreach ($fresult2 as $frow):
                                                $status_txt = "";
                                                if ($frow["status"] == "Y") {
                                                    $status_txt = "";
                                                } elseif ($frow["status"] == "N") {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["status"] == "C") {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_2) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                        <select id="product_code_3" name="product_code_3" class="input_select">
                                            <option value="">3차분류</option>
                                            <?php
                                            foreach ($fresult3 as $frow):
                                                $status_txt = "";
                                                if ($frow["status"] == "Y") {
                                                    $status_txt = "";
                                                } elseif ($frow["status"] == "N") {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["status"] == "C") {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_3) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <th>일자</th>
                                    <td>
                                        <select id="tour_period" name="tour_period" class="input_select">
                                            <option value="">일자선택</option>
                                            <?php for ($i = 1; $i <= 40; $i++) { ?>
                                                <option value="<?= $i ?>" <?php if ($tour_period == $i) {
                                                    echo "selected";
                                                } ?>><?= $i ?>일
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan=8>썸네일<br>(600 * 450)</th>
                                    <td rowspan=8>
                                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                   style="width:500px;margin-bottom:10px"/>
                                            <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                 name="del_<?= $i ?>"
                                                                                                 value='Y'><a
                                                    href="/data/product/<?= ${"ufile" . $i} ?>"
                                                    class="imgpop"><?= ${"rfile" . $i} ?></a><br><br><?php } ?>
                                        <?php } ?>
                                    </td>
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" id="product_name" name="product_name"
                                               value="<?= $product_name ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>이용항공</th>
                                    <td>
                                        <input type="text" id="product_air" name="product_air"
                                               value="<?= $product_air ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>간단소개</th>
                                    <td>
                                        <input type="text" id="product_info" name="product_info"
                                               value="<?= $product_info ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>간단일정(사용안함)</th>
                                    <td>
                                        <input type="text" id="product_schedule" name="product_schedule"
                                               value="<?= $product_schedule ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>여행국가(사용안함)</th>
                                    <td>
                                        <input id="product_country" name="product_country" class="input_txt" type="text"
                                               value="<?= $product_country ?>" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>최소출발인원(성인)</th>
                                    <td>
                                        <input id="minium_people_cnt" name="minium_people_cnt" class="input_txt"
                                               type="text"
                                               value="<?= $minium_people_cnt ?>" style="width:500px"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>마일리지</th>
                                    <td>
                                        <input id="product_mileage" name="product_mileage" class="input_txt" type="text"
                                               value="<?= $product_mileage ?>" style="width:50px" maxlength="2"/>% (총
                                        결제비용 %)
                                    </td>
                                </tr>
                                <tr>
                                    <th>이동방법</th>
                                    <td>
                                        <input id="tour_transport" name="tour_transport" class="input_txt" type="text"
                                               value="<?= $tour_transport ?>" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>여행혜택</th>
                                    <td>
                                        <input id="benefit" name="benefit" class="input_txt" type="text"
                                               value="<?= $benefit ?>"
                                               style="width:90%"/><br/>
                                    </td>
                                    <th>대표도시</th>
                                    <td>
                                        <input id="capital_city" name="capital_city" class="input_txt" type="text"
                                               value="<?= $capital_city ?>" style="width:200px"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>출발요일</th>
                                    <td>
                                        <input type="checkbox" name="yoil_0" value="Y"
                                               class="yoil" <?php if (isset($yoil_0) && $yoil_0 == "Y") echo "checked"; ?> >
                                        일요일&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_1" value="Y"
                                               class="yoil" <?php if (isset($yoil_1) && $yoil_1 == "Y") echo "checked"; ?> >
                                        월요일&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_2" value="Y"
                                               class="yoil" <?php if (isset($yoil_2) && $yoil_2 == "Y") echo "checked"; ?> >
                                        화요일&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_3" value="Y"
                                               class="yoil" <?php if (isset($yoil_3) && $yoil_3 == "Y") echo "checked"; ?> >
                                        수요일&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_4" value="Y"
                                               class="yoil" <?php if (isset($yoil_4) && $yoil_4 == "Y") echo "checked"; ?> >
                                        목요일&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_5" value="Y"
                                               class="yoil" <?php if (isset($yoil_5) && $yoil_5 == "Y") echo "checked"; ?> >
                                        금요일&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_6" value="Y"
                                               class="yoil" <?php if (isset($yoil_6) && $yoil_6 == "Y") echo "checked"; ?> >
                                        토요일&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <th>가이드/언어</th>
                                    <td>
                                        <input id="guide_lang" name="guide_lang" class="input_txt" type="text"
                                               value="<?= $guide_lang ?>" style="width:20%"/><br/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>메모</th>
                                    <td colspan="3"><textarea name="information" cols="100" rows="5"
                                                              style="width: 100%"><?= $information ?></textarea></td>
                                </tr>

                                <tr>
                                    <th>사용여부</th>
                                    <td>
                                        <select id="is_view" name="is_view">
                                            <option value='Y' <?php if ($is_view == "Y") {
                                                echo "selected";
                                            } ?>>사용
                                            </option>
                                            <option value='N' <?php if ($is_view == "N") {
                                                echo "selected";
                                            } ?>>사용안함
                                            </option>
                                        </select>
                                    </td>
                                    <th>여행기간</th>
                                    <td>
                                        <input id="product_period" name="product_period" class="input_txt" type="text"
                                               value="<?= $product_period ?>" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 3박 5일</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품담당자</th>
                                    <td>
                                        <input id="product_manager" name="product_manager" class="input_txt" type="text"
                                               value="<?= $product_manager ?>" style="width:100px"/>
                                        /<input id="phone" name="phone" class="input_txt" type="text"
                                                value="<?= $phone ?>"
                                                style="width:200px"/> /<input id="email" name="email" class="input_txt"
                                                                              type="text" value="<?= $email ?>"
                                                                              style="width:200px"/>
                                        <select name="product_manager_id" id="product_manager_sel"
                                                onchange="change_manager(this.value)">
                                            <?php
                                            foreach ($member_list as $row_member) :
                                                ?>
                                                <option value="<?= $row_member["user_id"] ?>" <? if ($product_manager_id == $row_member["user_id"]) {
                                                    echo "selected";
                                                } ?>><?= $row_member["user_name"] ?></option>
                                            <?php endforeach; ?>
                                            <option value="서소연 대리" <?php if ($product_manager == "서소연 대리") {
                                                echo "selected";
                                            } ?>>서소연 대리
                                            </option>
                                        </select>
                                        <br><span style="color: gray;">* ex) 상품등록하는 담당자의 성함/연락처/이메일</span>
                                    </td>
                                    <th>검색키워드</th>
                                    <td>
                                        <input id="keyword" name="keyword" class="input_txt" type="text"
                                               value="<?= $keyword ?>"
                                               style="width:90%"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)유럽,해외연수,하노니여행</span>
                                    </td>
                                </tr>


                                <tr>
                                    <th>기존상품가(단위: AUD)</th>
                                    <td>
                                        <input id="original_price" name="original_price" class="input_txt price"
                                               type="text"
                                               value="<?= $original_price ?>" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품의 할인 전 금액</span>
                                    </td>
                                    <th>상품최저가</th>
                                    <td>
                                        <input id="product_price" name="product_price" value="<?= $product_price ?>"
                                               class="input_txt price" type="text" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품페이지에 보여질 상품가격(할인가)</span>
                                    </td>
                                </tr>


                                <script>
                                    function prod_copy(idx) {
                                        if (!confirm("선택한 상품을 복사 하시겠습니까?"))
                                            return false;

                                        var message = "";
                                        $.ajax({

                                            url: "./ajax.prod_copy_tours.php",
                                            type: "POST",
                                            data: {
                                                "product_idx": idx
                                            },
                                            dataType: "json",
                                            async: false,
                                            cache: false,
                                            success: function (data, textStatus) {
                                                message = data.message;
                                                alert(message);
                                                location.reload();
                                            },
                                            error: function (request, status, error) {
                                                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                            }
                                        });
                                    }
                                </script>


                                <script>
                                    function select_add_it() {
                                        popOpen('1024', '600', '../_tourStay/popup.php?strs=' + $("#stay_list").val(), 'stay');
                                    }

                                    function sight_add_it() {
                                        popOpen('1024', '600', '../_tourSights/popup.php?strs=' + $("#sight_list").val(), 'sight');
                                    }

                                    function country_add_it() {
                                        popOpen('1024', '600', '../_tourCountry/popup.php?strs=' + $("#sight_list").val(), 'country');
                                    }

                                    function active_add_it() {
                                        popOpen('1024', '600', '../_tourGuide/popup.php?strs=' + $("#sight_list").val(), 'country');
                                    }
                                </script>

                                <tr>
                                    <th>베스트여부</th>
                                    <td>
                                        <?php foreach ($mresult2 as $row_m) : ?>
                                                <input type="checkbox" name="product_best"
                                                       id="product_best"
                                                       value="Y" <?php if (isset($row_m["product_best"]) && $row_m["product_best"] == "Y") {
                                                    echo "checked";
                                                } ?>/>
                                        <?php endforeach; ?>
                                    </td>
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt"
                                               style="width:80px"/> <span
                                                style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>특가여부</th>
                                    <td>
                                        <input type="checkbox" name="special_price" id="special_price"
                                               value="Y" <?php if (isset($row["special_price"]) && $row["special_price"] == "Y") {
                                            echo "checked";
                                        } ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <th>투어구분</th>
                                    <td>
                                        <div id="text" class="flex" style="gap: 5px">
                                            <?php foreach ($codes as $code): ?>
                                                <?php
                                                $chk = (strpos($tours_cate, $code['code_no']) !== false) ? "checked" : "";
                                                ?>
                                                <input type="checkbox" name="_tours_cate" class="product_option"
                                                       value="<?= esc($code['code_no']) ?>" <?= $chk ?> /><?= esc($code['code_name']) ?> &nbsp;&nbsp;
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>성인/소아/유아 구분</th>
                                    <td colspan="3">
                                        <input type="text" name="adult_text" class="bbs_inputbox_pixel"
                                               style="width:300px"
                                               value="<?= isset($row) ? $row["adult_text"] : '' ?>"/>
                                        <span style="margin-right:20px;"></span>
                                        <input type="text" name="kids_text" class="bbs_inputbox_pixel"
                                               style="width:300px"
                                               value="<?= isset($row) ? $row["kids_text"] : '' ?>"/>
                                        <span style="margin-right:20px;"></span>
                                        <input type="text" name="baby_text" class="bbs_inputbox_pixel"
                                               style="width:300px"
                                               value="<?= isset($row) ? $row["baby_text"] : '' ?>"/>
                                        <span style="margin-right:20px;"></span>
                                    </td>
                                </tr>

                                <tr style="display:none">
                                    <th>상품내용</th>
                                    <td colspan="3">
								<textarea name="product_contents" id="product_contents" rows="10" cols="100"
                                          style="width:100%; height:412px; display:none;"><?= $product_contents ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품정보</th>
                                    <td colspan="3">


								<textarea name="tour_info" id="tour_info" rows="10" cols="100" class="input_txt"
                                          style="width:100%; height:400px; display:none;"><?= viewSQ($tour_info) ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors14 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors14,
                                                elPlaceHolder: "tour_info",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                </tr>
                                <tr>
                                    <th>예약전 확인사항(PC)</th>
                                    <td>

								<textarea name="product_confirm" id="product_confirm" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($product_confirm); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors12 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors12,
                                                elPlaceHolder: "product_confirm",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors2.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                    <th>예약전 확인사항(모바일)</th>
                                    <td>
								<textarea name="product_confirm_m" id="product_confirm_m" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($product_confirm_m); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors13 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors13,
                                                elPlaceHolder: "product_confirm_m",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors5.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <th>포함사항</th>
                                    <td>

								<textarea name="product_able" id="product_able" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($product_able); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors2 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors2,
                                                elPlaceHolder: "product_able",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors2.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                    <th>불포함사항</th>
                                    <td>
								<textarea name="product_unable" id="product_unable" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($product_unable); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors5 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors5,
                                                elPlaceHolder: "product_unable",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors5.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <th>모바일용<br>포함사항</th>
                                    <td>
								<textarea name="mobile_able" id="mobile_able" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($mobile_able); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors3 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors3,
                                                elPlaceHolder: "mobile_able",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                    <th>모바일용<br>불포함사항</th>
                                    <td>

								<textarea name="mobile_unable" id="mobile_unable" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($mobile_unable); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors4 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors4,
                                                elPlaceHolder: "mobile_unable",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors4.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <th>스페셜 혜택</th>
                                    <td>
								<textarea name="special_benefit" id="special_benefit" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($special_benefit); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors6 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors6,
                                                elPlaceHolder: "special_benefit",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                    <th>모바일용<br>스페셜 혜택</th>
                                    <td>
								<textarea name="special_benefit_m" id="special_benefit_m" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($special_benefit_m); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors7 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors7,
                                                elPlaceHolder: "special_benefit_m",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <th>유의사항</th>
                                    <td>
								<textarea name="notice_comment" id="notice_comment" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($notice_comment); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors8 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors8,
                                                elPlaceHolder: "notice_comment",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                    <th>모바일용<br>유의사항</th>
                                    <td>
								<textarea name="notice_comment_m" id="notice_comment_m" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($notice_comment_m); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors9 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors9,
                                                elPlaceHolder: "notice_comment_m",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>


                                <tr>
                                    <th>기타사항</th>
                                    <td>
								<textarea name="etc_comment" id="etc_comment" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($etc_comment); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors10 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors10,
                                                elPlaceHolder: "etc_comment",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                    <th>모바일용<br>기타사항</th>
                                    <td>
								<textarea name="etc_comment_m" id="etc_comment_m" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($etc_comment_m); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors11 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors11,
                                                elPlaceHolder: "etc_comment_m",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </form>
            <!-- // listBottom -->


            <div class="tail_menu">
                <ul>
                    <li class="left"></li>
                    <li class="right_sub">

                        <a href="list_tours?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                           class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        <?php if ($product_idx == "") { ?>
                            <a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                        <?php } else { ?>
                            <a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            <a href="javascript:del_it('<?= $product_idx ?>')" class="btn btn-default"><span
                                        class="glyphicon glyphicon-trash"></span><span class="txt">완전삭제</span></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>


            <div class="listBottom" style="padding: 15px;">
                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                    <caption>
                    </caption>
                    <colgroup>
                        <col width="*"/>
                    </colgroup>
                    <tbody>

                    <tr>
                        <th>옵션추가</th>
                        <td>
                            <input type='text' name='moption_name' id='moption_name' value="" style="width:550px"/>
                            <button type="button" class="btn_01" onclick="add_moption();">추가</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <?php foreach ($options as $row_option): ?>
                <div class="listBottom">
                    <form name="optionForm_<?= $row_option['code_idx'] ?>"
                          id="optionForm_<?= $row_option['code_idx'] ?>">
                        <input type="hidden" name="product_idx" value="<?= $product_idx ?>"/>
                        <input type="hidden" name="code_idx" value="<?= $row_option['code_idx'] ?>"/>

                        <table class="listTable mem_detail">
                            <tbody>
                            <tr>
                                <th>옵션</th>
                                <td>
                                    <input type="text" name="moption_name" value="<?= $row_option['moption_name'] ?>"/>
                                    <button type="button" onclick="upd_moption('<?= $row_option['code_idx'] ?>');">수정
                                    </button>
                                    <button type="button" onclick="del_moption('<?= $row_option['code_idx'] ?>');">삭제
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>추가 옵션등록</th>
                                <td>
                                    <button type="button" onclick="add_option('<?= $row_option['code_idx'] ?>');">추가
                                    </button>
                                    <button type="button" onclick="upd_option('<?= $row_option['code_idx'] ?>');">등록
                                    </button>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>옵션명</th>
                                            <th>가격</th>
                                            <th>적용</th>
                                            <th>순서</th>
                                            <th>삭제</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($row_option['additional_options'] as $option): ?>
                                            <tr>
                                                <td><input type="text" name="o_name[]"
                                                           value="<?= $option['option_name'] ?>"/></td>
                                                <td><input type="text" name="o_price[]"
                                                           value="<?= $option['option_price'] ?>"/></td>
                                                <td>
                                                    <select name="use_yn[]">
                                                        <option value="Y" <?= $option['use_yn'] == 'Y' ? 'selected' : '' ?>>
                                                            판매중
                                                        </option>
                                                        <option value="N" <?= $option['use_yn'] != 'Y' ? 'selected' : '' ?>>
                                                            중지
                                                        </option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="o_num[]" value="<?= $option['onum'] ?>"/>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="delOption('<?= $option['idx'] ?>');">
                                                        삭제
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            <?php endforeach; ?>


            <?php if ($product_idx): ?>
                <div class="tail_menu">
                    <ul>
                        <li class="left">■ 가격리스트</li>
                        <li class="right_sub" style="padding-bottom:10px">
                            <a href="../_tourPrice/write<?= ($product_code_1 == "1301") ? "_package" : "" ?>.php?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_3=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>&product_idx=<?= $product_idx ?>&back_url=<?= $back_url ?>"
                               class="btn btn-default">
                                <span class="glyphicon glyphicon-cog"></span>
                                <span class="txt">가격등록</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="listBottom">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                        <caption></caption>
                        <colgroup>
                            <col width="5%"/>
                            <col width="5%"/>
                            <col width="5%"/>
                            <col width="*"/>
                            <col width="8%"/>
                            <col width="5%"/>
                            <col width="5%"/>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>시작일</th>
                            <th>종료일</th>
                            <th>항공사별 가격</th>
                            <th>선택요일</th>
                            <th>등록일</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <?php echo $yoil_html ?>
                    </table>
                </div>

                <div class="tail_menu">
                    <ul>
                        <li class="left">■ 상세내역</li>
                        <li class="right_sub" style="padding-bottom:10px"></li>
                    </ul>
                </div>

                <div class="listBottom">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                        <colgroup>
                            <col width="70px"/>
                            <col width="*"/>
                            <col width="260px"/>
                            <col width="260px"/>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>항공사</th>
                            <th>일차</th>
                            <th>관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($fTotalresult4 > 0): ?>
                            <?php $i = 1; ?>
                            <?php foreach ($fresult4 as $frow): ?>
                                <tr style="height:50px">
                                    <td><?= $i++ ?></td>
                                    <td class="tac"><?= $frow["code_name"] ?></td>
                                    <td class="tac"><?= $frow["cnt"] ?>일차</td>
                                    <td>
                                        <a href="detailwrite_new.php?product_idx=<?= $product_idx ?>&air_code=<?= $frow["air_code_1"] ?>"
                                           class="btn btn-default">상세내역관리</a>
                                        <?php if ($_SERVER['REMOTE_ADDR'] == "113.160.96.156"): ?>
                                            <input type="file" hidden name="fileInput"
                                                   data-air_code="<?= $frow["air_code_1"] ?>" id="fileInput"
                                                   accept=".json">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr style="height:50px">
                                <td><?= $i++ ?></td>
                                <td class="tac">미등록</td>
                                <td class="tac">미등록</td>
                                <td>
                                    <a href="detailwrite_new.php?product_idx=<?= $product_idx ?>&air_code="
                                       class="btn btn-default">상세내역관리</a>
                                    <?php if ($_SERVER['REMOTE_ADDR'] == "113.160.96.156"): ?>
                                        <!-- <button type="button">Tải lên lịch trình</button> -->
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script>
        function change_manager(user_id) {

            if (user_id === "정민경 사원") {
                $("#product_manager").val("정민경 사원");
                $("#phone").val("070-7430-5812");
                $("#email").val("booking@hihojoo.com");
            } else {
                $.ajax({
                    url: "../../ajax/ajax.change_manager.php",
                    type: "POST",
                    data: {
                        "user_id": user_id
                    },
                    dataType: "json",
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        // message = data.message;
                        // alert(message);
                        // $("#listForm").submit();
                        $("#product_manager").val(data.user_name);
                        $("#phone").val(data.user_phone);
                        $("#email").val(data.user_email);

                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
            }

        }

        function del_tours(idx) {
            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            var message = "";
            $.ajax({

                url: "/ajax/ajax.del_tours.php",
                type: "POST",
                data: {
                    "tours_idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }
    </script>

    <script>
        $("#btn_add_optionx").click(function () {

            var addOption = "";
            addOption += "<tr color='' size='' >												  ";

            addOption += "	<td>																  ";
            addOption += "		<input type='hidden' name='o_idx[]'  value='' />	  ";
            addOption += "		<input type='hidden' name='option_type[]'  value='M' />	  ";
            addOption += "		<input type='file' name='a_file[]'  value='' style='display:none;' />					  ";
            addOption += "		<input type='text' name='o_name[]'  value='' size='70' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum' name='o_price[]'  value='' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<select name='ues_yn[]'>	                                      ";
            addOption += "		<option value='Y'>판매</option>    	                              ";
            addOption += "		<option value='N'>중지</option>    	                              ";
            addOption += "		</select>	                                                      ";
            addOption += "	</td>																  ";
//		addOption += "	<td>																  ";
//		addOption += "		<input type='text' class='onlynum' name='o_jaego[]'  value='' />	  ";
//		addOption += "	</td>																  ";


            addOption += "	<td>																  ";
            addOption += '		<button type="button" onclick="delOption(\'\',this)">삭제</button>	  ';
            addOption += "	</td>																  ";
            addOption += "</tr>																	  ";

            $("#settingBody").append(addOption);

        });

        function add_option(code_idx) {
            var addOption = "";
            addOption += "<tr color='' size='' >												  ";

            addOption += "	<td>																  ";
            addOption += "		<input type='hidden' name='o_idx[]'  value='' />	  ";
            addOption += "		<input type='hidden' name='option_type[]'  value='M' />	  ";
            addOption += "		<input type='file' name='a_file[]'  value='' style='display:none;' />					  ";
            addOption += "		<input type='text' name='o_name[]'  value='' size='70' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum' name='o_price[]'  value='' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<select name='ues_yn[]'>	                                      ";
            addOption += "		<option value='Y'>판매</option>    	                              ";
            addOption += "		<option value='N'>중지</option>    	                              ";
            addOption += "		</select/>	                                                      ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum' name='o_num[]'  value='' />	  ";
            addOption += "	</td>																  ";
//		addOption += "	<td>																  ";
//		addOption += "		<input type='text' class='onlynum' name='o_jaego[]'  value='' />	  ";
//		addOption += "	</td>																  ";


            addOption += "	<td>																  ";
            addOption += '		<button type="button" onclick="delOption(\'\',this)">삭제</button>	  ';
            addOption += "	</td>																  ";
            addOption += "</tr>																	  ";

            $("#settingBody_" + code_idx).append(addOption);
        }

        function upd_moption(code_idx) {
            var message = "";
            $.ajax({

                url: "/ajax/ajax.upd_moption.php",
                type: "POST",
                data: {
                    "code_idx": code_idx,
                    "moption_name": $("#moption_name_" + code_idx).val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        function add_moption() {
            var message = "";
            $.ajax({

                url: "/ajax/ajax.add_moption.php",
                type: "POST",
                data: {
                    "product_idx": '<?= $product_idx ?>',
                    "moption_name": $("#moption_name").val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        function del_moption(code_idx) {
            if (!confirm("선택한 옵션을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            var message = "";
            $.ajax({

                url: "/ajax/ajax.del_moption.php",
                type: "POST",
                data: {
                    "code_idx": code_idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }

        function upd_option(code_idx) {
            var option_data = jQuery("#optionForm_" + code_idx).serialize();
            var save_result = "";

            $.ajax({
                type: "POST",
                data: option_data,
                url: "/ajax/ajax.add_option.php",
                cache: false,
                async: false,
                success: function (data, textStatus) {
                    save_result = data;
                    //alert('save_result- '+save_result);
                    var obj = jQuery.parseJSON(save_result);
                    var message = obj.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        // 옵션 삭제 함수
        function delOption(idx, obj) {

            if (!confirm("선택한 옵션을 삭제 하시겠습니까?"))
                return false;

            var message = "";
            $.ajax({

                url: "/ajax/ajax.del_option.php",
                type: "POST",
                data: {
                    "idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }


        // 옵션 수정 함수
        function updOption(idx) {

            if (!confirm("선택한 옵션을 수정 하시겠습니까?"))
                return false;

            var message = "";
            $.ajax({

                url: "/ajax/ajax.upd_option.php",
                type: "POST",
                data: {
                    "idx": idx,
                    "option_name": $("#o_name_" + idx).val(),
                    "option_price": $("#o_price_" + idx).val(),
                    "use_yn": $("#use_yn_" + idx).val(),
                    "onum": $("#o_num_" + idx).val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }
    </script>

    <script>
        function img_remove(img) {
            //alert('img- '+img);
            if (!confirm("선택한 이미지를 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n."))
                return false;

            var message = "";
            $.ajax({

                url: "ajax.img_remove.php",
                type: "POST",
                data: {
                    "product_idx": $("#product_idx").val(),
                    "img": img
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }

            });
        }
    </script>

    <script type="text/javascript">
        function del_yoil(yoil_idx) {
            if (confirm("삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.")) {
                hiddenFrame.location.href = "/AdmMaster/_tourRegist/yoil_del.php?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>&product_idx=<?= $product_idx ?>&yoil_idx=" + yoil_idx;
            }
        }

        function del_detail(air_code) {
            if (confirm("삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.")) {
                hiddenFrame.location.href = "/AdmMaster/_tourRegist/detail_del.php?product_idx=<?= $product_idx ?>&air_code=" + air_code;
            }
        }


    </script>
    <script>
        function send_it() {
            var frm = document.frm;
            /*
            oEditors1.getById["product_contents"].exec("UPDATE_CONTENTS_FIELD", []);
            */
            oEditors4.getById["mobile_unable"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors3.getById["mobile_able"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors2.getById["product_able"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors5.getById["product_unable"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors6.getById["special_benefit"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors7.getById["special_benefit_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors8.getById["notice_comment"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors9.getById["notice_comment_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors10.getById["etc_comment"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors11.getById["etc_comment_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors12.getById["product_confirm"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors13.getById["product_confirm_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors14.getById["tour_info"].exec("UPDATE_CONTENTS_FIELD", []);


            if (frm.tour_period.value == "") {
                alert("일자를 선택하셔야 합니다.");
                frm.tour_period.focus();
                return;
            }
            if (frm.product_code_1.value == "") {
                alert("1차분류를 선택하셔야 합니다.");
                //frm.product_code_1.focus();
                return;
            }
            /*
            if (frm.product_code_2.value == "")
            {
                alert("2차분류를 선택하셔야 합니다.");
                frm.product_code_2.focus();
                return;
            }
            if (frm.product_code_3.value == "")
            {
                alert("3차분류를 선택하셔야 합니다.");
                frm.product_code_3.focus();
                return;
            }
            if (frm.product_code_4.value == "")
            {
                alert("4차분류를 선택하셔야 합니다.");
                frm.product_code_4.focus();
                return;
            }
            */
            if (frm.product_name.value == "") {
                alert("상품명을 입력하셔야 합니다.");
                frm.product_name.focus();
                return;
            }

            var option = "";
            $("input:checkbox[name='_option']:checked").each(function () {
                option += '|' + $(this).val();
            });
            option += '|';
            $("#product_option").val(option);

            var tours_cate = "";
            $("input:checkbox[name='_tours_cate']:checked").each(function () {
                tours_cate += '|' + $(this).val();
            });
            option += '|';
            $("#tours_cate").val(tours_cate);

            frm.submit();
        }

        function del_it(idx) {


            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            var message = "";
            $.ajax({

                url: "./ajax.prod_del.php",
                type: "POST",
                data: {
                    "product_idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    $("#listForm").submit();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        function get_code(strs, depth) {
            $.ajax({
                type: "GET"
                , url: "get_code.ajax.php"
                , dataType: "html" //전송받을 데이터의 타입
                , timeout: 30000 //제한시간 지정
                , cache: false  //true, false
                , data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth //서버에 보낼 파라메터
                , error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (json) {
                    //alert(json);
                    if (depth <= 3) {
                        $("#product_code_2").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_2").append("<option value=''>2차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#product_code_3").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_3").append("<option value=''>3차분류</option>");
                    }
                    if (depth <= 5) {
                        $("#product_code_4").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_4").append("<option value=''>4차분류</option>");
                    }
                    var list = $.parseJSON(json);
                    var listLen = list.length;
                    var contentStr = "";
                    for (var i = 0; i < listLen; i++) {
                        contentStr = "";
                        if (list[i].code_status == "C") {
                            contentStr = "[마감]";
                        } else if (list[i].code_status == "N") {
                            contentStr = "[사용안함]";
                        }
                        $("#product_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                    }
                }
            });
        }

        function get_code_2(strs, depth) {
            $.ajax({
                type: "GET",
                url: "get_code.ajax.php",
                dataType: "html",
                timeout: 30000,
                cache: false,
                data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth,
                error: function (request, status, error) {
                    alert("code : " + request.status + "\r\nmessage : " + request.responseText);
                },
                success: function (json) {
                    var list = $.parseJSON(json);
                    var listLen = list.length;

                    $("#text").empty();

                    for (var i = 0; i < listLen; i++) {
                        var contentStr = "";
                        if (list[i].code_status == "C") {
                            contentStr = "[마감]";
                        } else if (list[i].code_status == "N") {
                            contentStr = "[사용안함]";
                        }
                        $("#text").append("<input type='checkbox' name='_tours_cate' class='product_option' value='" + list[i].code_no + "' /> " + list[i].code_name + " " + contentStr + "<br>");
                    }
                }
            });
        }
    </script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

    <form id="listForm" action="./list_tours.php">
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>">
        <input type="hidden" name="pg" value="<?= $pg ?>">
        <input type="hidden" name="product_idx" value="<?= $product_idx ?>">
        <input type="hidden" name="_product_code_1" value="<?= $product_code_1 ?>">
        <input type="hidden" name="_product_code_2" value="<?= $product_code_2 ?>">
        <input type="hidden" name="_product_code_3" value="<?= $product_code_3 ?>">
        <input type="hidden" name="s_date" value="<?= $s_date ?>">
        <input type="hidden" name="e_date" value="<?= $e_date ?>">
        <input type="hidden" name="s_time" value="<?= $s_time ?>">
        <input type="hidden" name="e_time" value="<?= $e_time ?>">
        <input type="hidden" name="search_category" value="<?= $search_category ?>">
        <input type="hidden" name="search_name" value="<?= $search_name ?>">
    </form>

<? include "../_include/_footer.php"; ?>
<?= $this->endSection() ?>