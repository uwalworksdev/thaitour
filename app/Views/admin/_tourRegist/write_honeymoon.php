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
                    <h2>허니문 상품관리 정보입력 <?= $titleStr ?> </h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="list_honeymoon?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
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

            <form name=frm action="write_ok" method=post enctype="multipart/form-data" target="hiddenFrame">
                <input type=hidden name="back_url"
                       value="/AdmMaster/_tourRegist/write_honeymoon.php?<?= $_SERVER['QUERY_STRING'] ?>">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>
                <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
                <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
                <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>
                <input type=hidden name="product_option" id="product_option" value=''>
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
                                    <th rowspan=7>썸네일<br>(600 * 450)</th>
                                    <td rowspan=7>
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
                                    <th>메모</th>
                                    <td colspan="3"><textarea name="information" cols="100" rows="5"
                                                              style="width: 100%"><?= $information ?></textarea></td>
                                </tr>

                                <tr>
                                    <th>사용여부</th>
                                    <td>
                                        <select id="is_view" name="is_view">
                                            <option value='Y' <? if ($is_view == "Y") {
                                                echo "selected";
                                            } ?> >
                                                사용
                                            </option>
                                            <option value='N' <? if ($is_view == "N") {
                                                echo "selected";
                                            } ?> >
                                                사용안함
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
                                                <option value="<?= $row_member["user_id"] ?>" <?php if ($product_manager_id == $row_member["user_id"]) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= $row_member["user_name"] ?>
                                                </option>
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
                                    <th>기존상품가</th>
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

                                            url: "./ajax.prod_copy.php",
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
                                    <th>옵션상품추가</th>
                                    <td colspan="3">
                                        <input id="active_list" name="active_list" class="input_txt" type="text"
                                               value="<?= $active_list ?>" style="width:400px"/>
                                        <a href="javascript:active_add_it();" class="btn btn-primary">추가</a>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품옵션</th>
                                    <td>
                                        <?php

                                        foreach ($oresult as $row_o) :
                                            if (strpos($product_option, $row_o['option_name'] . "|") == true) {
                                                $chk = "checked";
                                            } else {
                                                $chk = "";
                                            }
                                            ?>
                                            <input type="checkbox" name="_option" class="product_option"
                                                   value="<?= $row_o['option_name'] ?>" <?= $chk ?> /><?= $row_o['option_name'] ?> &nbsp;&nbsp;
                                        <?php endforeach; ?>
                                    </td>
                                    <th>상품등급</th>
                                    <td>
                                        <select name="product_level">
                                            <option value="">등급선택</option>
                                            <?php
                                            foreach ($lresult as $row_l) :
                                                if (isset($row['product_level']) && $row_l['idx'] == $row['product_level']) {
                                                    echo '<option value="' . $row_l['idx'] . '" selected>' . $row_l['level_name'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $row_l['idx'] . '" >' . $row_l['level_name'] . '</option>';
                                                }
                                            endforeach;
                                            ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>베스트여부</th>
                                    <td>
                                        <?php foreach ($mresult2 as $row_m) : ?>
                                            <?php if (isset($row_m['maintitle1'])) { ?>
                                                <?= $row_m['maintitle1'] ?>
                                                <input type="checkbox" name="product_best"
                                                       id="product_best"
                                                       value="Y" <?php if ($row["product_best"] == "Y") {
                                                    echo "checked";
                                                } ?>/>
                                            <?php } ?>
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
                                    <td colspan="3">
                                        <input type="checkbox" name="special_price" id="special_price"
                                               value="Y" <?php if (isset($row["special_price"]) && $row["special_price"] == "Y") {
                                            echo "checked";
                                        } ?> />&nbsp;&nbsp;&nbsp;&nbsp;
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
                                    <th>상품상세</th>
                                    <td colspan="3">


								<textarea name="tour_detail" id="tour_detail" rows="10" cols="100" class="input_txt"
                                          style="width:100%; height:400px; display:none;"><?= viewSQ($tour_detail) ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors15 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors15,
                                                elPlaceHolder: "tour_detail",
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
                        <!-- // listBottom -->


                        <div class="tail_menu">
                            <ul>
                                <li class="left"></li>
                                <li class="right_sub">

                                    <a href="list_honeymoon?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                                       class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                                class="txt">리스트</span></a>
                                    <? if ($product_idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <? } else { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <a href="javascript:del_it('<?= $product_idx ?>')" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-trash"></span><span
                                                    class="txt">완전삭제</span></a>
                                    <? } ?>
                                </li>
                            </ul>
                        </div>


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
                                                               data-air_code="<?= $frow["air_code_1"] ?>" id="fileInput" accept=".json">
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
                    <!-- // listWrap -->

                </div>
                <!-- // contents -->
            </form>
        </div><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->

    <script>

        function change_manager(user_id) {
            console.log(user_id);

            if (user_id === "서소연 대리") {
                $("#product_manager").val("서소연 대리");
                $("#phone").val("070-7430-5893");
                $("#email").val("travel@hihojoo.com");
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
                hiddenFrame.location.href = "/AdmMaster/_tourRegist/yoil_del.php?s_product_code_1=<?=$s_product_code_1?>&s_product_code_2=<?=$s_product_code_2?>&s_product_code_2=<?=$s_product_code_3?>&search_name=<?=$search_name?>&search_category=<?=$search_category?>&pg=<?=$pg?>&product_idx=<?=$product_idx?>&yoil_idx=" + yoil_idx;
            }
        }

        function del_detail(air_code) {
            if (confirm("삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.")) {
                hiddenFrame.location.href = "/AdmMaster/_tourRegist/detail_del.php?product_idx=<?=$product_idx?>&air_code=" + air_code;
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
            oEditors15.getById["tour_detail"].exec("UPDATE_CONTENTS_FIELD", []);


            if (frm.tour_period.value == "") {
                alert("일자를 선택하셔야 합니다.");
                frm.tour_period.focus();
                return;
            }
            if (frm.product_code_1.value == "") {
                alert("1차분류를 선택하셔야 합니다.");
                frm.product_code_1.focus();
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
                    if (depth <= 4) {
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
    </script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

    <form id="listForm" action="./list_honeymoon.php">
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>">
        <input type="hidden" name="pg" value="<?= $pg ?>">
        <input type="hidden" name="product_idx" value="<?= $product_idx ?>">
        <input type="hidden" name="product_code_1" value="<?= $product_code_1 ?>">
        <input type="hidden" name="product_code_2" value="<?= $product_code_2 ?>">
        <input type="hidden" name="product_code_3" value="<?= $product_code_3 ?>">
        <input type="hidden" name="s_date" value="<?= $s_date ?>">
        <input type="hidden" name="e_date" value="<?= $e_date ?>">
        <input type="hidden" name="s_time" value="<?= $s_time ?>">
        <input type="hidden" name="e_time" value="<?= $e_time ?>">
        <input type="hidden" name="search_category" value="<?= $search_category ?>">
        <input type="hidden" name="search_name" value="<?= $search_name ?>">
    </form>
<?= $this->endSection() ?>