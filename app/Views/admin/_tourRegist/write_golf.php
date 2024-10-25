<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
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
                    <h2>골프 상품관리 정보입력 <?= $titleStr ?> </h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="list_golf?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
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

            <form name=frm action="write_golf_ok<?= $product_idx ? "/$product_idx" : "" ?>" method=post enctype="multipart/form-data" target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
                <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
                <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>
                <input type=hidden name="product_option" id="product_option" value=''>
                <input type=hidden name="tours_cate" id="tours_cate"
                       value='<?= isset($tours_cate) ? $tours_cate : "" ?>'>

                <div id="contents">
                    <div class="listWrap_noline">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="table-layout:fixed">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="140px"/>
                                    <col width="40%"/>
                                    <col width="140px"/>
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
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" id="product_name" name="product_name"
                                               value="<?= $product_name ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th rowspan=8>썸네일<br>(600 * 450)</th>
                                    <td rowspan=8>
                                        <?php for ($i = 1; $i <= 7; $i++) { ?>
                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                   style="width:500px;margin-bottom:10px"/>
                                            <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox name="del_<?= $i ?>" value='Y'><a
                                                    href="/data/product/<?= ${"ufile" . $i} ?>"
                                                    class="imgpop"><?= ${"rfile" . $i} ?><br>
                                                    <img style="max-width: 200px" src="/data/product/<?= ${"ufile" . $i} ?>" alt="">
                                                </a><?php } ?>
                                        <?php } ?>
                                    </td>
                                    <th>간단소개</th>
                                    <td>
                                        <input type="text" id="product_info" name="product_info"
                                               value="<?= $product_info ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>더투어랩 평가 등급</th>
                                    <td>
                                        <select id="star_level" name="star_level" class="input_select">
                                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                <option value="<?= $i ?>" <?php if ($golf_info['star_level'] == $i) {
                                                    echo "selected";
                                                } ?>><?= $i ?>&#9733;
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>총홀수</th>
                                    <td>
                                        <input id="holes_number" name="holes_number" class="input_txt" type="text" value="<?= $golf_info['holes_number'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>휴무일</th>
                                    <td>
                                        <input id="holidays" name="holidays" class="input_txt" type="text" value="<?= $golf_info['holidays'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>팀당 라운딩 인원</th>
                                    <td>
                                        <input id="num_of_players" name="num_of_players" class="input_txt" type="text" value="<?= $golf_info['num_of_players'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>시내에서 거리 및 이동기간	</th>
                                    <td>
                                        <input id="distance_from_center" name="distance_from_center" class="input_txt" type="text" value="<?= $golf_info['distance_from_center'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>공항에서 거리 및 이동시간</th>
                                    <td>
                                        <input id="distance_from_airport" name="distance_from_airport" class="input_txt" type="text" value="<?= $golf_info['distance_from_airport'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>전동카트</th>
                                    <td>
                                        <input id="electric_car" name="electric_car" class="input_txt" type="text" value="<?= $golf_info['electric_car'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>구분</th>
                                    <td>
                                        <label for="is_best_value">
                                            <input type="checkbox" name="is_best_value" id="is_best_value" value="Y" 
                                            <?php if ($row["is_best_value"] == "Y") { echo "checked"; } ?> />
                                            가성비추천
                                        </label>
                                        <label for="special_price">
                                            <input type="checkbox" name="special_price" id="special_price" value="Y" 
                                            <?php if ($row["special_price"] == "Y") { echo "checked"; } ?> />
                                            특가여부
                                        </label>
                                    </td>
                                    <th>갤러리피</th>
                                    <td>
                                        <input id="caddy" name="caddy" class="input_txt" type="text" value="<?= $golf_info['caddy'] ?>" style="width:100%"/>
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
                                    <th>장비렌탈</th>
                                    <td>
                                        <input id="equipment_rent" name="equipment_rent" class="input_txt" type="text" value="<?= $golf_info['equipment_rent'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>가이드/언어</th>
                                    <td>
                                        <input id="guide_lang" name="guide_lang" class="input_txt" type="text"
                                               value="<?= isset($guide_lang) ? $guide_lang : '' ?>"
                                               style="width:20%"/><br/>
                                    </td>
                                    <th>스포츠데이</th>
                                    <td>
                                        <input id="sports_day" name="sports_day" class="input_txt" type="text" value="<?= $golf_info['sports_day'] ?>" style="width:100%"/>
                                    </td>
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
                                    <th>최소출발인원(성인)</th>
                                    <td>
                                        <input id="minium_people_cnt" name="minium_people_cnt" class="input_txt"
                                               type="text"
                                               value="<?= $minium_people_cnt ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" autocomplete="off" name="addrs" id="addrs" value="<?= $addrs ?>" class="text" style="width:70%"/>
										<button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">get location</button>
										<div style="margin-top: 10px;">
											Latitude : <input type="text" name="latitude" id="latitude" value="<?= $latitude ?>" class="text" style="width: 200px;" readonly/>
											Longitude : <input type="text" name="longitude" id="longitude" value="<?= $longitude ?>" class="text" style="width: 200px;" readonly/>
										</div>
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
                                                } ?>><?= $row_member["user_name"] ?></option>
                                            <?php endforeach; ?>
                                            <option value="서소연 대리" <?php if ($product_manager == "서소연 대리") {
                                                echo "selected";
                                            } ?> >
                                                안나현팀장
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

                                            url: "./ajax.prod_copy_golf.php",
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
                                                       value="Y" <?php if (isset($row["product_best"]) && $row["product_best"] == "Y") {
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
                                                sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
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
                                </tbody>

                            </table>
                        </div>
                    </div>
            </form>

            <?php if ($product_idx): ?>
                <div class="listBottom">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                        <caption>
                        </caption>
                        <colgroup>
                            <col width="10%"/>
                            <col width="90%"/>
                        </colgroup>
                        <tbody>

                        <tr>
                            <th>옵션추가</th>
                            <td>
                                <div class="flex__c">
                                    <select name="moption_hole" id="moption_hole">
                                        <option value="18">18홀</option>
                                        <option value="27">27홀</option>
                                        <option value="36">36홀</option>
                                        <option value="45">45홀</option>
                                    </select>&nbsp;
                                    <select name="moption_hour" id="moption_hour">
                                        <option value="06">06시</option>
                                        <option value="07">07시</option>
                                        <option value="08">08시</option>
                                        <option value="09">09시</option>
                                        <option value="10">10시</option>
                                        <option value="11">11시</option>
                                        <option value="12">12시</option>
                                        <option value="13">13시</option>
                                        <option value="14">14시</option>
                                        <option value="15">15시</option>
                                        <option value="16">16시</option>
                                        <option value="17">17시</option>
                                        <option value="18">18시</option>
                                        <option value="19">19시</option>
                                    </select>&nbsp;
                                    <select name="moption_minute" id="moption_minute">
                                        <option value="00">00분</option>
                                        <option value="12">12분</option>
                                        <option value="24">24분</option>
                                        <option value="36">36분</option>
                                        <option value="48">48분</option>
                                    </select>&nbsp;
                                    <button style="margin: 0px;" type="button" class="btn_01" onclick="add_moption();">추가</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>옵션추가</th>
                            <td>
                                <table>
                                    <colgroup>
                                        <col width="40%"/>
                                        <col width="30%"/>
                                        <col width="30%"/>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>옵션명</th>
                                            <th>가격</th>
                                            <th>관리</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list_option">
                                        <?php foreach ($options as $m) { ?>
                                            <tr id="option_<?= $m['idx'] ?>">
                                                <td>
                                                    <span><?= $m['hole_cnt'] ?>홀</span>&nbsp;/&nbsp;<span><?= $m['hour'] ?>시</span>&nbsp;/&nbsp;<span><?= $m['minute'] ?>분</span>
                                                </td>
                                                <td>
                                                    <div class="flex_c_c"><input type="text" id="option_price_<?= $m['idx'] ?>" value='<?= $m['option_price'] ?>'>원</div>
                                                </td>
                                                <td>
                                                    &nbsp;<button style="margin: 0;" type="button" class="btn_01" onclick="upd_moption(<?= $m['idx'] ?>);">수정</button>
                                                    &nbsp;<button style="margin: 0;" type="button" class="btn_02" onclick="del_moption(<?= $m['idx'] ?>);">삭제</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <!-- // listBottom -->
            <div class="tail_menu">
                <ul>
                    <li class="left"></li>
                    <li class="right_sub">

                        <a href="list_golf?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
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

        </div>
        <!-- // listWrap -->
        <div class="pick_item_pop02" id="popup_location">
            <div>
                <h2>메인노출상품 등록</h2>
                <div class="table_box" style="height: calc(100% - 146px);">
                    <ul id="list_location">
                        
                    </ul>
                </div>
                <div class="sel_box">
                    <button type="button" class="close">닫기</button>
                </div>
            </div>
        </div>
        <script>
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
            function change_manager(user_id) {
                console.log(user_id);

                if (user_id === "안나현팀장") {
                    $("#product_manager").val("안나현팀장");
                    $("#phone").val("070-7430-5891");
                    $("#email").val("ashley@hihojoo.com");
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

                    url: "/AdmMaster/_tourRegist/write_golf/upd_moption/" + code_idx,
                    type: "PUT",
                    data: {
                        "option_price": $("#option_price_" + code_idx).val()
                    },
                    dataType: "json",
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        message = data.message;
                        alert(message);
                        // location.reload();
                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
            }

            function add_moption() {
                var message = "";
                $.ajax({
                    url: "/AdmMaster/_tourRegist/write_golf/add_moption",
                    type: "POST",
                    data: {
                        "product_idx": '<?=$product_idx?>',
                        "moption_hole": $("#moption_hole").val(),
                        "moption_hour": $("#moption_hour").val(),
                        "moption_minute": $("#moption_minute").val(),
                    },
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        $("#list_option").append(data);
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

                    url: "/AdmMaster/_tourRegist/write_golf/del_moption/" + code_idx,
                    type: "DELETE",
                    dataType: "json",
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        message = data.message;
                        alert(message);
                        $("#option_" + code_idx).remove();
                        // location.reload();
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
                if (confirm("정말 삭제하시겠습니까?")) {

                    if (idx != "") {
                        $.ajax({
                            url: "del_option.php",
                            type: "POST",
                            data: "idx=" + idx,
                            error: function (request, status, error) {
                                //통신 에러 발생시 처리
                                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                                $("#ajax_loader").addClass("display-none");
                            }
                            , complete: function (request, status, error) {

                            }
                            , success: function (response, status, request) {


                                response = response.trim();

                                if (response == "OK") {
                                    alert("삭제되었습니다.");
                                } else {
                                    alert("오류!");
                                    location.reload();
                                }


                            }
                        });

                    }
                    $(obj).closest("tr").remove();
                }

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
            var formSubmitted = false;

            function send_it() {
                var frm = document.frm;
                oEditors14.getById["tour_info"].exec("UPDATE_CONTENTS_FIELD", []);


                if (formSubmitted) {
                    return;
                }

                // if (frm.tour_period.value == "") {
                //     alert("일자를 선택하셔야 합니다.");
                //     frm.tour_period.focus();
                //     return;
                // }
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

                // formSubmitted = true;

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
                    , url: "/ajax/get_code"
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

            $('.pick_item_pop02 .sel_box .close').on('click', function () {
                $('.pick_item_pop02').hide()
            })

            function getCoordinates() {
		
            let address = $("#addrs").val();
            if(!address){
                alert("주소를 입력해주세요");
                return false;
            }
            const apiUrl = `https://google-map-places.p.rapidapi.com/maps/api/place/textsearch/json?query=${encodeURIComponent(address)}&radius=1000&opennow=true&location=40%2C-110&language=en&region=en`;

            const options = {
                method: 'GET',
                headers: {
                    'x-rapidapi-host': 'google-map-places.p.rapidapi.com',
                    'x-rapidapi-key': '79b4b17bc4msh2cb9dbaadc30462p1f029ajsn6d21b28fc4af'
                }
            };

            fetch(apiUrl, options)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data:', data);
                    let html = '';
                    if(data.results.length > 0){
                        data.results.forEach(element => {
                            let address = element.formatted_address;
                            let lat = element.geometry.location.lat;
                            let lon = element.geometry.location.lng;
                            html += `<li data-lat="${lat}" data-lon="${lon}">${address}</li>`;
                        });
                    }else{
                        html = `<li>No data</li>`;
                    }

                    $("#popup_location #list_location").html(html);
                    $("#popup_location").show();
                    $("#popup_location #list_location li").click(function () {
                        let latitude = $(this).data("lat");
                        let longitude = $(this).data("lon");
                        $("#latitude").val(latitude);
                        $("#longitude").val(longitude);
                        $("#popup_location").hide();
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        </script>
        <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

        <form id="listForm" action="./list_golf.php">
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
<?= $this->endSection() ?>