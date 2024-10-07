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

        .popup_ {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.2);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .popup_.show_ {
            display: flex;
        }

        .popup_area_ {
            height: auto;
            max-height: 50vh;
            overflow: auto;
            background-color: #FFFFFF;
            width: 100%;
            max-width: 800px;
            padding: 10px 40px 30px;
            font-size: 14px;
        }

        .popup_top_ {
            width: 100%;
            height: 50px;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #dbdbdb;
        }

        .popup_content_ {

        }

        .popup_bottom_ {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding-top: 20px;
            width: 100%;
            border-top: 1px solid #dbdbdb;
        }

        .popup_bottom_ button {
            display: inline-block;
            width: 100px;
            height: 40px;
            border: 1px solid rgb(204, 204, 204);
        }

        .table_border_ {
            border: 2px solid #dbdbdb;
        }

        .table_border_ th,
        .table_border_ td {
            border: 1px solid #dbdbdb;
            padding: 10px 20px;
        }

        .table_border_ th {
            background-color: rgba(220, 220, 220, 0.5);
        }

        .table_border_ td.list_g_idx_ {
            vertical-align: middle;
            text-align: center;
        }

        .btn_select_room_list {
            background-color: #17469E;
            color: #FFFFFF;
            width: 80px !important;
            height: 35px !important;
            margin: 10px 0 !important;
        }

        .room_list_render_ .item_ {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 20px;
            margin-bottom: 10px;
        }

        .room_list_render_ input {
            width: 25%;
            cursor: not-allowed;
        }

        .room_list_render_ button {
            margin: 0 !important;
            background-color: #EA353D;
            color: #FFFFFF;
            height: 30px;
        }
    </style>
<?php $back_url = "write"; ?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="list?s_country_code_1=<?= $s_country_code_1 ?>&s_country_code_2=<?= $s_country_code_2 ?>&search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"
                                   class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                            class="txt">리스트</span></a></li>
                            <?php if ($stay_idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li><a href="javascript:del_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                </li>
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

            <form name=frm action="<?= route_to('admin.tourStay.write_ok') ?>" method=post enctype="multipart/form-data"
                  target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="stay_idx" value='<?= $stay_idx ?>'>
                <input type=hidden name="s_country_code_1" value='<?= $s_country_code_1 ?>'>
                <input type=hidden name="s_country_code_2" value='<?= $s_country_code_2 ?>'>
                <input type=hidden name="s_country_code_3" value='<?= $s_country_code_3 ?>'>
                <input type=hidden name="facilities" id="facilities" value='<?= $facilities ?>'>
                <input type=hidden name="room_facil" id="room_facil" value='<?= $room_facil ?>'>
                <input type=hidden name="room_list" id="room_list" value='<?= $room_list ?>'>
                <input type="hidden" name="code_utilities" id="code_utilities"
                       value='<?= $code_utilities ?? "" ?>'/>
                <input type="hidden" name="code_services" id="code_services"
                       value='<?= $code_services ?? "" ?>'/>
                <input type="hidden" name="code_best_utilities" id="code_best_utilities"
                       value='<?= $code_best_utilities ?? "" ?>'/>
                <input type="hidden" name="code_populars" id="code_populars"
                       value='<?= $code_populars ?? "" ?>'/>

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
                                    <td colspan="4">
                                        여행
                                    </td>
                                </tr>
                                <tr>
                                    <th>도시명</th>
                                    <td colspan="3">
                                        <input type="text" id="stay_city" name="stay_city" value="<?= $stay_city ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>분류</th>
                                    <td>
                                        <select id="country_code_1" name="country_code_1" class="input_select"
                                                onchange="javascript:get_code(this.value, 3)" style="width:200px">
                                            <option value="">1차분류</option>
                                            <?php
                                            foreach ($fresult1 as $frow) :
                                                $status_txt = "";
                                                if ($frow["status"] == "Y") {
                                                    $status_txt = "";
                                                } elseif ($frow["status"] == "N") {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["status"] == "C") {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($s_country_code_1 == $frow["code_no"]) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                        <select id="country_code_2" name="country_code_2" class="input_select"
                                                style="width:200px">
                                            <option value="">2차분류</option>
                                            <?php
                                            foreach ($fresult2 as $frow) :
                                                $status_txt = "";
                                                if ($frow["status"] == "Y") {
                                                    $status_txt = "";
                                                } elseif ($frow["status"] == "N") {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["status"] == "C") {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($row["country_code_2"] == $frow["code_no"]) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <select name="stay_code" id="stay_code">
                                            <option value="">유형선택</option>
                                            <?php
                                            foreach ($fresult3 as $frow) :
                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($stay_code == $frow["code_no"]) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <th>담당자</th>
                                    <td>
                                        <input type="text" id="stay_user_name" name="stay_user_name"
                                               value="<?= $stay_user_name ?>" class="input_txt" placeholder=""
                                               style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>호텔명(국문)</th>
                                    <td>
                                        <input type="text" id="stay_name_kor" name="stay_name_kor"
                                               value="<?= $stay_name_kor ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                    <th>호텔명(영문)</th>
                                    <td>
                                        <input type="text" id="stay_name_eng" name="stay_name_eng"
                                               value="<?= $stay_name_eng ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td>
                                        <input type="text" id="stay_address" name="stay_address"
                                               value="<?= $stay_address ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                    <th>호텔등급</th>
                                    <td>
                                        <select id="stay_level" name="stay_level" class="select_txt">
                                            <option value="">등급선택</option>
                                            <option value="5" <?php if ($stay_level == "5") {
                                                echo "selected";
                                            } ?>>★★★★★
                                            </option>
                                            <option value="4.5" <?php if ($stay_level == "4.5") {
                                                echo "selected";
                                            } ?>>★★★★✭
                                            </option>
                                            <option value="4" <?php if ($stay_level == "4") {
                                                echo "selected";
                                            } ?>>★★★★
                                            </option>
                                            <option value="3.5" <?php if ($stay_level == "3.5") {
                                                echo "selected";
                                            } ?>>★★★✭
                                            </option>
                                            <option value="3" <?php if ($stay_level == "3") {
                                                echo "selected";
                                            } ?>>★★★
                                            </option>
                                            <option value="2.5" <?php if ($stay_level == "2.5") {
                                                echo "selected";
                                            } ?>>★★✭
                                            </option>
                                            <option value="2" <?php if ($stay_level == "2") {
                                                echo "selected";
                                            } ?>>★★
                                            </option>
                                            <option value="1.5" <?php if ($stay_level == "1.5") {
                                                echo "selected";
                                            } ?>>★✭
                                            </option>
                                            <option value="1" <?php if ($stay_level == "1") {
                                                echo "selected";
                                            } ?>>★
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>체크인</th>
                                    <td>
                                        <select name="stay_check_in_hour">
                                            <option value="">선택</option>
                                            <?php for ($i = 1; $i < 24; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_check_in_hour == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>시
                                                </option>
                                            <?php } ?>
                                        </select>시
                                        ~
                                        <select name="stay_check_in_min">
                                            <option value="">선택</option>
                                            <?php for ($i = 0; $i < 60; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_check_in_min == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>분
                                                </option>
                                            <?php } ?>
                                        </select>분
                                    </td>
                                    <th>체크아웃</th>
                                    <td>
                                        <select name="stay_check_out_hour">
                                            <option value="">선택</option>
                                            <?php for ($i = 1; $i < 24; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_check_out_hour == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>시
                                                </option>
                                            <?php } ?>
                                        </select>시
                                        ~
                                        <select name="stay_check_out_min">
                                            <option value="">선택</option>
                                            <?php for ($i = 0; $i < 60; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_check_out_min == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>분
                                                </option>
                                            <?php } ?>
                                        </select>분
                                    </td>
                                </tr>
                                <tr>
                                    <th>서비스</th>
                                    <td>
                                        <input type="text" id="stay_service" name="stay_service"
                                               value="<?= $stay_service ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                    <th>주차</th>
                                    <td>
                                        <input type="text" id="stay_parking" name="stay_parking"
                                               value="<?= $stay_parking ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>객실정보</th>
                                    <td>
                                        <input type="text" id="stay_room" name="stay_room" value="<?= $stay_room ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                    <th>홈페이지</th>
                                    <td>
                                        <input type="text" id="stay_homepage" name="stay_homepage"
                                               value="<?= $stay_homepage ?>"
                                               class="input_txt" placeholder="" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>전화번호</th>
                                    <td>
                                        <input type="text" id="tel_no" name="tel_no" value="<?= $tel_no ?>"
                                               class="input_txt"
                                               placeholder="" style="width:90%"/>
                                    </td>
                                    <th>참조사항</th>
                                    <td>
                                        <input type="text" id="note" name="note" value="<?= $note ?>" class="input_txt"
                                               placeholder="" style="width:90%"/>
                                    </td>
                                </tr>
                                <!--                                <tr>-->
                                <!--                                    <th>호텔부대시설</th>-->
                                <!--                                    <td colspan="3">-->
                                <!--                                        --><?php
                                //                                        $_arr = explode("|", $facilities);
                                //                                        foreach ($fresult4 as $row_f) :
                                //                                            $find = "";
                                //                                            for ($i = 0; $i < count($_arr); $i++) {
                                //                                                if ($_arr[$i]) {
                                //                                                    if ($_arr[$i] == $row_f['code_no']) $find = "Y";
                                //                                                }
                                //                                            }
                                //                                            ?>
                                <!--                                            <input type="checkbox" id="facilities_-->
                                <?php //= $row_f['code_no'] ?><!--"-->
                                <!--                                                   name="_facilities"-->
                                <!--                                                   value="-->
                                <?php //= $row_f['code_no'] ?><!--" -->
                                <?php //if ($find == "Y") echo "checked"; ?><!-- />-->
                                <?php //= $row_f['code_name'] ?><!----><?php //= $find ?>
                                <!--                                        --><?php //endforeach; ?>
                                <!--                                    </td>-->
                                <!--                                </tr>-->
                                </tbody>

                            </table>

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
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
                                    <td colspan="4">
                                        숙소개요
                                    </td>
                                </tr>

                                <tr>
                                    <th>추천 포인트</th>
                                    <td colspan="3">
                                        <?php
                                        $_arr = explode("|", $code_utilities);
                                        foreach ($fresult6 as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_utilitie<?= $row_r['code_no'] ?>"
                                                   name="_code_utilities"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> /><?= $row_r['code_name'] ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>인기 시설 및 서비스</th>
                                    <td colspan="3">
                                        <?php
                                        $_arr = explode("|", $code_best_utilities);
                                        foreach ($fresult6 as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_best_utilities<?= $row_r['code_no'] ?>"
                                                   name="_code_best_utilities"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> /><?= $row_r['code_name'] ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>시설 & 서비스</th>
                                    <td colspan="3">
                                        <?php
                                        $_arr = explode("|", $code_services);
                                        foreach ($fresult5 as $row_r) : ?>
                                            <div class="" style="margin-bottom: 20px">
                                                <span class=""
                                                      style="font-weight: 600;color: #333;font-size: 13px;"> <?= $row_r['code_name'] ?></span>
                                                <div class="" style="margin-left: 30px;margin-top: 8px;">
                                                    <?php
                                                    $fresult6 = $row_r['child'];
                                                    foreach ($fresult6 as $row_r2) :
                                                        $find2 = "";
                                                        for ($i = 0; $i < count($_arr); $i++) {
                                                            if ($_arr[$i]) {
                                                                if ($_arr[$i] == $row_r2['code_no']) $find2 = "Y";
                                                            }
                                                        }
                                                        ?>
                                                        <input type="checkbox"
                                                               id="code_service<?= $row_r['code_no'] ?>_<?= $row_r2['code_no'] ?>"
                                                               name="_code_services"
                                                               value="<?= $row_r2['code_no'] ?>" <?php if ($find2 == "Y") echo "checked"; ?> /><?= $row_r2['code_name'] ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔주변 추천명소</th>
                                    <td colspan="3">
                                        <?php
                                        $_arr = explode("|", $code_populars);
                                        foreach ($fresult8 as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_populars<?= $row_r['code_no'] ?>"
                                                   name="_code_populars"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> /><?= $row_r['code_name'] ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

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
                                    <td colspan="4">
                                        방식
                                    </td>
                                </tr>

                                <tr>
                                    <th>내용</th>
                                    <td colspan=3>
                                        <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
                                        <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>

                                        <textarea name="stay_contents" id="stay_contents" class="input_txt"
                                                  style="width:100%; height:200px; display:none;"><?= $stay_contents; ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors,
                                                elPlaceHolder: "stay_contents",
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
                                    <th>썸네일첨부</th>
                                    <td colspan=3>
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                   style="width:500px"/><br>
                                            640px * 480px    <?php if (${"ufile" . $i} != "") { ?>파일삭제:<input
                                                    type=checkbox
                                                    name="del_<?= $i ?>"
                                                    value='Y'><a
                                                    href="/include/dn.php?mode=stay&ufile=<?= ${"ufile" . $i} ?>&rfile=<?= ${"rfile" . $i} ?>"><?= ${"rfile" . $i} ?></a>
                                            <?php } ?>
                                            <br><br>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>룸목록</th>
                                    <td colspan="3">
                                        <button type="button" class="btn_select_room_list" onclick="showOrHide();">
                                            룸추가
                                        </button>
                                        <div class="room_list_render_" id="room_list_render_">
                                            <?php
                                            $_arr = explode("|", $room_list);
                                            foreach ($rresult as $row_r) : ?>
                                                <?php
                                                $find = "";
                                                foreach ($_arr as $iValue) {
                                                    if ($iValue) {
                                                        if ($iValue == $row_r['g_idx']) {
                                                            ?>

                                                            <div class="item_">
                                                                <input readonly type="text"
                                                                       value="<?= $row_r['roomName'] ?>">
                                                                <button onclick="removeRoomSelect(this, '<?= $row_r['g_idx'] ?>')"
                                                                        type="button">삭제
                                                                </button>
                                                            </div>

                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            <?php endforeach; ?>
                                        </div>
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

                                    <a href="list?s_country_code_1=<?= $s_country_code_1 ?>&s_country_code_2=<?= $s_country_code_2 ?>&search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"
                                       class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                                class="txt">리스트</span></a>
                                    <?php if ($stay_idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <a href="javascript:del_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- // listWrap -->

                </div>
                <!-- // contents -->

                <div class="popup_">
                    <div class="popup_area_">
                        <div class="popup_top_">
                            <p>
                                룸목록 관리
                            </p>
                            <p>
                                <button type="button" class="btn_close_"
                                        onclick="showOrHide();">X
                                </button>
                            </p>
                        </div>
                        <div class="popup_content_">
                            <table class="table_border_">
                                <colgroup>
                                    <col width="8%">
                                    <col width="*">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th><input type="checkbox" class="check_all_" id="check_all_"></th>
                                    <th>룸명</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $_arr = explode("|", $room_list);
                                foreach ($rresult as $row_r) : ?>
                                    <tr>
                                        <td class="list_g_idx_">
                                            <?php
                                            $find = "";
                                            foreach ($_arr as $iValue) {
                                                if ($iValue) {
                                                    if ($iValue == $row_r['g_idx']) {
                                                        $find = "Y";
                                                    }
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="room_list_<?= $row_r['g_idx'] ?>"
                                                   name="_room_list" class="check_item_"
                                                   value="<?= $row_r['g_idx'] ?>"
                                                <?php if ($find === "Y") echo "checked"; ?> />
                                        </td>
                                        <td>
                                            <label for="room_list_<?= $row_r['g_idx'] ?>"><?= $row_r['roomName'] ?></label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="popup_bottom_">
                            <button type="button" class="" onclick="showOrHide();">취소</button>
                            <button type="button" class="" onclick="saveValueRoom();">확인</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->
    <script>
        $('#check_all_').change(function () {
            if ($(this).is(":checked")) {
                $('.check_item_').prop('checked', true);
            } else {
                $('.check_item_').prop('checked', false);
            }
        })

        function showOrHide() {
            $(".popup_").toggleClass('show_');
        }

        function removeRoomSelect(el, idx) {
            $("input[name=_room_list][value=" + idx + "]").prop("checked", false);
            $(el).parent().remove();
        }

        function saveValueRoom() {
            showOrHide();

            getRoomSelectAndRender();
        }

        function getRoomSelectAndRender() {
            let html = '';
            let room_list = [];

            $("input[name=_room_list]:checked").each(function () {
                let idx = $(this).val();
                let name = $('label[for="room_list_' + idx + '"]').text();
                let data = {
                    idx: idx,
                    name: name
                }
                room_list.push(data);
            })

            for (let i = 0; i < room_list.length; i++) {
                let data = room_list[i];
                html += `<div class="item_">
                            <input readonly type="text" value="${data.name}">
                            <button onclick="removeRoomSelect(this, ${data.idx})" type="button">삭제</button>
                        </div>`;
            }

            $("#room_list_render_").empty().append(html);
        }

        function send_it() {
            var frm = document.frm;

            let facilities = "";
            let room_facil = "";
            let room_list = "";

            $("input[name=_facilities]:checked").each(function () {
                facilities += $(this).val() + '|';
            })

            $("#facilities").val(facilities);

            $("input[name=_room_facil]:checked").each(function () {
                room_facil += $(this).val() + '|';
            })

            $("#room_facil").val(room_facil);

            oEditors.getById["stay_contents"].exec("UPDATE_CONTENTS_FIELD", []);

            $("input[name=_room_list]:checked").each(function () {
                room_list += $(this).val() + '|';
            })

            $("#room_list").val(room_list);

            let _code_utilities = '';
            let _code_services = '';
            let _code_best_utilities = '';
            let _code_populars = '';

            $("input[name=_code_utilities]:checked").each(function () {
                _code_utilities += $(this).val() + '|';
            })

            $("#code_utilities").val(_code_utilities);

            $("input[name=_code_services]:checked").each(function () {
                _code_services += $(this).val() + '|';
            })

            $("#code_services").val(_code_services);

            $("input[name=_code_best_utilities]:checked").each(function () {
                _code_best_utilities += $(this).val() + '|';
            })

            $("#code_best_utilities").val(_code_best_utilities);

            $("input[name=_code_populars]:checked").each(function () {
                _code_populars += $(this).val() + '|';
            })

            $("#code_populars").val(_code_populars);

            frm.submit();
        }

        function del_it() {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "<?= route_to('admin.api.tour_stay.del') ?>",
                type: "POST",
                data: "stay_idx[]=" + '<?= $stay_idx ?>',
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    // if (response == "OK")
                    // {
                    console.log(response);
                    alert_("정상적으로 삭제되었습니다.");
                    window.location.href = "/AdmMaster/_tourStay/list";
                    // } else {
                    // 	alert(response);
                    // 	alert_("오류가 발생하였습니다!!");
                    // 	return;
                    // }
                }
            });

        }

        function get_code(strs, depth) {
            $.ajax({
                type: "GET"
                , url: "/AdmMaster/api/get_code"
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
                        $("#country_code_2").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_2").append("<option value=''>2차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#country_code_3").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_3").append("<option value=''>3차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#country_code_4").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_4").append("<option value=''>4차분류</option>");
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
                        $("#country_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                    }
                }
            });
        }
    </script>
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
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>
<?= $this->endSection() ?>