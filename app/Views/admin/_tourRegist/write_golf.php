<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
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

        .img_add #input_file_ko {
            display: none;
        }
    </style>
    <script>
        $(function () {
            var clareCalendar1 = {
                dateFormat: 'yy-m-dd',
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                /* 			changeMonth : true, //월변경가능
                            changeYear : true, //년변경가능 */
                showMonthAfterYear: true, //년 뒤에 월 표시
                yearRange: '2023:2050',//2023~2050
                inline: true,
                /*minDate : 0,//현재날짜로 부터 이전 날짜 비활성화 */
                dateFormat: 'yy-mm-dd',
                minDate: 0,
                prevText: '이전달',
                nextText: '다음달',
                currentText: '오늘',
                yearSuffix: '년',
                onSelect: function (dateText, inst) {
                    $("#datepicker1").val(dateText.split("-")[0] + "-" + dateText.split("-")[1] + "-" + dateText.split("-")[2] + "");
                    $('.deadline_date').each(function () {
                        $(this).data('daterangepicker').minDate = moment($("#datepicker1").val());
                    })
                }
            };

            var clareCalendar2 = {
                dateFormat: 'yy-m-dd',
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                /* 			changeMonth : true, //월변경가능
                            changeYear : true, //년변경가능 */
                dateFormat: 'yy-mm-dd',
                showMonthAfterYear: true, //년 뒤에 월 표시
                yearRange: '2023:2050',//2023~2050
                inline: true,
                minDate: 0,//현재날짜로 부터 이전 날짜 비활성화 */
                prevText: '이전달',
                nextText: '다음달',
                currentText: '오늘',
                yearSuffix: '년',
                onSelect: function (dateText, inst) {
                    $("#datepicker2").val(dateText.split("-")[0] + "-" + dateText.split("-")[1] + "-" + dateText.split("-")[2] + "");
                    $('.deadline_date').each(function () {
                        $(this).data('daterangepicker').maxDate = moment($("#datepicker2").val());
                    })
                }
            };
            $("#datepicker1").datepicker(clareCalendar1);
            $("#datepicker2").datepicker(clareCalendar2);

        });
    </script>
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

            <form name="frm" action="write_golf_ok<?= $product_idx ? "/$product_idx" : "" ?>" method=post
                  enctype="multipart/form-data" target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="s_product_code_1" value='<?= $product['product_code_1'] ?>'>
                <input type=hidden name="s_product_code_2" value='<?= $product['product_code_2'] ?>'>
                <input type=hidden name="s_product_code_3" value='<?= $product['product_code_3'] ?>'>
                <input type=hidden name="night_y" id="night_y" value="">
                <input type=hidden name="night_n" id="night_n" value="">
                <input type=hidden name="product_option" id="product_option" value=''>
                <input type=hidden name="tours_cate" id="tours_cate"
                       value='<?= isset($tours_cate) ? $tours_cate : "" ?>'>
                <input type="hidden" name="mbti" id="mbti"
                       value='<?= $mbti ?? "" ?>'/>

                <div id="contents">
                    <div class="listWrap_noline">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="table-layout:fixed">
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
                                    <td colspan="4">
                                        <div class=""
                                             style="width: 100%; display: flex; justify-content: space-between; align-items: center">
                                            <p>기본정보</p>
                                            <?php if ($product_idx): ?>
                                                <a class="btn btn-default"
                                                   href="/product-golf/golf-detail/<?= $product_idx ?>"
                                                   target="_blank">
                                                    상품 상세보기
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
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
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product['product_code_1']) echo "selected"; ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

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
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product['product_code_2']) {
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
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product['product_code_3']) {
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
                                <!-- <tr>
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
                                </tr> -->
                                <tr>
                                    <th>상품코드</th>
                                    <td colspan="3">
                                        <input type="text" name="product_code" id="product_code"
                                               value="<?= $product_code_no ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if (empty($product_idx) || empty($product_code)) { ?>
                                            <!-- <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button> -->
                                            <!-- <button type="button" class="btn_01" onclick="check_product_code('<?= $product_code_no ?>');">조회</button> -->
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>더투어랩 평가 등급</th>
                                    <td colspan="3">
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
                                    <th>
                                        MBTI
                                        <input type="checkbox" id="all_code_mbti" class="all_input"
                                               name="_code_mbti" value=""/>
                                        <label for="all_code_mbti">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $mbti);
                                        foreach ($mcodes as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_mbti<?= $row_r['code_no'] ?>"
                                                   name="_code_mbti" class="code_mbti"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                            <label for="code_mbti<?= $row_r['code_no'] ?>">
                                                <?= $row_r['code_name'] ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>총홀수</th>
                                    <td>
                                        <input id="holes_number" name="holes_number" class="input_txt" type="text"
                                               value="<?= $golf_info['holes_number'] ?>" style="width:100%"/>
                                    </td>
                                    <th>휴무일</th>
                                    <td>
                                        <input id="holidays" name="holidays" class="input_txt" type="text"
                                               value="<?= $golf_info['holidays'] ?>" style="width:100%"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>팀당 라운딩 인원</th>
                                    <td>
                                        <input id="num_of_players" name="num_of_players" class="input_txt" type="text"
                                               value="<?= $golf_info['num_of_players'] ?>" style="width:100%"/>
                                    </td>
                                    <th>시내에서 거리 및 이동기간</th>
                                    <td>
                                        <input id="distance_from_center" name="distance_from_center" class="input_txt"
                                               type="text" value="<?= $golf_info['distance_from_center'] ?>"
                                               style="width:100%"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>공항에서 거리 및 이동시간</th>
                                    <td>
                                        <input id="distance_from_airport" name="distance_from_airport" class="input_txt"
                                               type="text" value="<?= $golf_info['distance_from_airport'] ?>"
                                               style="width:100%"/>
                                    </td>
                                    <th>전동카트</th>
                                    <td>
                                        <input id="electric_car" name="electric_car" class="input_txt" type="text"
                                               value="<?= $golf_info['electric_car'] ?>" style="width:100%"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>최소출발인원(성인)</th>
                                    <td>
                                        <input id="minium_people_cnt" name="minium_people_cnt" class="input_txt"
                                               type="text"
                                               value="<?= $minium_people_cnt ?>" style="width:100%"/>
                                    </td>
                                    <th>갤러리피</th>
                                    <td>
                                        <input id="caddy" name="caddy" class="input_txt" type="text"
                                               value="<?= $golf_info['caddy'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>최대인원(성인)</th>
                                    <td>
                                        <input id="total_people_cnt" name="total_people_cnt" class="input_txt"
                                               type="text"
                                               value="<?= $total_people_cnt ?>" style="width:100%"/>
                                    </td>
                                    <th>장비렌탈</th>
                                    <td>
                                        <input id="equipment_rent" name="equipment_rent" class="input_txt" type="text"
                                               value="<?= $golf_info['equipment_rent'] ?>" style="width:100%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- <th>베스트여부</th>
                                    <td>
                                        <?php foreach ($mresult2 as $row_m) : ?>
                                                <input type="checkbox" name="product_best"
                                                       id="product_best"
                                                       value="Y" <?php if (isset($row["product_best"]) && $row["product_best"] == "Y") {
                                        echo "checked";
                                    } ?>/>
                                        <?php endforeach; ?>
                                    </td> -->
                                    <th>스포츠데이</th>
                                    <td>
                                        <input id="sports_day" name="sports_day" class="input_txt" type="text"
                                               value="<?= $golf_info['sports_day'] ?>" style="width:100%"/>
                                    </td>
                                    <th>판매상태결정</th>
                                    <td>
                                        <select name="product_status" id="product_status">
                                            <option value="sale" <?php if (isset($product_status) && $product_status === "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="plan" <?php if (isset($product_status) && $product_status === "plan") {
                                                echo "selected";
                                            } ?>>예약중지
                                            </option>
                                            <option value="stop" <?php if (isset($product_status) && $product_status === "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- <th>가이드/언어</th>
                                    <td>
                                        <input id="guide_lang" name="guide_lang" class="input_txt" type="text"
                                                value="<?= isset($guide_lang) ? $guide_lang : '' ?>"
                                                style="width:50%"/><br/>
                                    </td> -->

                                </tr>
                                <tr>
                                    <th>구분</th>
                                    <td colspan="3">
                                        <label for="is_best_value">
                                            <input type="checkbox" name="is_best_value" id="is_best_value" value="Y"
                                                <?php if ($row["is_best_value"] == "Y") {
                                                    echo "checked";
                                                } ?> />
                                            가성비추천
                                        </label>
                                        <label for="special_price">
                                            <input type="checkbox" name="special_price" id="special_price" value="Y"
                                                <?php if ($row["special_price"] == "Y") {
                                                    echo "checked";
                                                } ?> />
                                            특가여부
                                        </label>
                                        <!-- <label for="md_recommendation_yn">
                                            <input type="checkbox" name="md_recommendation_yn" id="md_recommendation_yn"
                                                   value="Y"
                                                <?php if ($row["md_recommendation_yn"] == "Y") {
                                                    echo "checked";
                                                } ?> />
                                            MD 추천
                                        </label> -->
                                        <label for="hot_deal_yn">
                                            <input type="checkbox" name="hot_deal_yn" id="hot_deal_yn" value="Y"
                                                <?php if ($row["hot_deal_yn"] == "Y") {
                                                    echo "checked";
                                                } ?> />
                                            핫딜추천
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" autocomplete="off" name="addrs" id="addrs"
                                               value="<?= $addrs ?>" class="text" style="width:70%"/>
                                        <button type="button" class="btn btn-primary" style="width: unset;"
                                                onclick="getCoordinates();">get location
                                        </button>
                                        <div style="margin-top: 10px;">
                                            Latitude : <input type="text" name="latitude" id="latitude"
                                                              value="<?= $latitude ?>" class="text"
                                                              style="width: 200px;" readonly/>
                                            Longitude : <input type="text" name="longitude" id="longitude"
                                                               value="<?= $longitude ?>" class="text"
                                                               style="width: 200px;" readonly/>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품담당자</th>
                                    <td>
                                        <input id="product_manager" name="product_manager" class="input_txt" type="text"
                                               value="<?=$product['product_manager']?>" style="width:100px" readonly/>
                                        /<input id="phone" name="phone" class="input_txt" type="text"
                                                value="<?=$product['phone']?>" readonly
                                                style="width:200px"/>
                                        /<input id="email" name="email" class="input_txt"
                                                type="text" value="<?=$product['email']?>" readonly
                                                style="width:200px"/>
                                        <select name="product_manager_id" id="product_manager_sel"
                                                onchange="change_manager(this.value)">
                                            <option value="">선택</option>
                                            <?php
                                            foreach ($member_list as $row_member) :
                                                ?>
                                                <option value="<?= $row_member["user_id"] ?>" <?php if ($product_manager_id == $row_member["user_id"]) {
                                                    echo "selected";
                                                } ?>>
                                                    <?= $row_member["user_name"] ?>
                                                </option>
                                            <?php endforeach; ?>
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
                                    <th>기존상품가(단위: 바트)</th>
                                    <td>
                                        <input id="original_price" name="original_price" class="input_txt price"
                                               type="text"
                                               value="<?= $original_price ?>" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품의 할인 전 금액</span>
                                    </td>
                                    <th>상품최저가(단위: 바트)</th>
                                    <td>
                                        <input id="product_price" name="product_price" value="<?= $product_price ?>"
                                               class="input_txt price" type="text" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품페이지에 보여질 상품가격(할인가)</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>왕복 픽업차량((단위: 바트)</th>
                                    <td colspan="3">
                                        승용차      <input id="vehicle_idx1" name="vehicle_cnt1" class="input_txt price" type="text" value="<?= $vehicle_price1 ?>" style="width:10%"/>&nbsp;&nbsp;&nbsp;
                                        밴 (승합차) <input id="vehicle_idx2" name="vehicle_cnt2" class="input_txt price" type="text" value="<?= $vehicle_price2 ?>" style="width:10%"/>&nbsp;&nbsp;&nbsp;
                                        SUV        <input id="vehicle_idx3" name="vehicle_cnt3" class="input_txt price" type="text" value="<?= $vehicle_price3 ?>" style="width:10%"/>
                                    </td>
                                </tr>
								
                                <script>
                                    $('#all_code_mbti').change(function () {
                                        if ($('#all_code_mbti').is(':checked')) {
                                            $('.code_mbti').prop('checked', true)
                                        } else {
                                            $('.code_mbti').prop('checked', false)
                                        }
                                    });

                                    function prod_copy(idx) {
                                        if (!confirm("선택한 상품을 복사 하시겠습니까?"))
                                            return false;

                                        var message = "";
                                        $.ajax({

                                            url: "/AdmMaster/_tourRegist/prod_copy",
                                            type: "POST",
                                            data: {
                                                "product_idx": idx
                                            },
                                            dataType: "json",
                                            async: false,
                                            cache: false,
                                            success: function (data, textStatus) {
                                                alert(data.message);
                                                if (data.status == "success") {
                                                    const searchParams = new URLSearchParams(window.location.search);
                                                    searchParams.set('product_idx', data.newProductIdx);
                                                    location.href = window.location.pathname + '?' + searchParams.toString();
                                                }
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
                                    <th>직접결제</th>
                                    <td>
										<input type="checkbox" name="direct_payment" id="direct_payment" value="Y" <?php if (isset($direct_payment) && $direct_payment === "Y")
                                                echo "checked=checked"; ?>> 
                                    </td>
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt"
                                               style="width:80px"/> <span
                                                style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                </tr>
									
                                </tr>
                                <tr>
                                    <th>대표이미지(600X400)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                            for ($i = 1; $i <= 1; $i++) :
                                                $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                                // $img ="/data/product/" . ${"ufile" . $i};
                                                ?>
                                                <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                           onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
                                                    <a class="img_txt imgpop" href="<?= $img ?>"
                                                       id="text_ufile<?= $i ?>">미리보기</a>

                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <th>서브이미지(600X400)</th>
                                    <td colspan="3">
                                        <div class="img_add">
                                            <?php
                                            for ($i = 2; $i <= 7; $i++) :
                                                $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                                // $img ="/data/product/" . ${"ufile" . $i};
                                                ?>
                                                <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                           onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
                                                    <a class="img_txt imgpop" href="<?= $img ?>"
                                                       id="text_ufile<?= $i ?>">미리보기</a>
                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>픽업차량</th>
                                    <td colspan="3">
                                        <?php foreach ($vehicles as $vehicle) :
                                            $checked = in_array($vehicle['code_no'], explode("|", $golf_info['golf_vehicle'])) ? "checked" : "";
                                            ?>
                                            <span>
                                                <input type="checkbox" name="vehicle_arr[]"
                                                       id="vehicle_<?= $vehicle["code_idx"] ?>"
                                                       value="<?= $vehicle["code_no"] ?>" <?= $checked ?>/>
                                                <label for="vehicle_<?= $vehicle["code_idx"] ?>"><?= $vehicle["code_name"] ?></label>
                                            </span>
                                        <?php endforeach; ?>
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
                                <!-- <tr>
                                    <th>출발요일</th>
                                    <td colspan="3">
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
                                </tr> -->
                                <!--tr>
                                        <th>시작일</th>
                                        <td>
                                            <input type="text" name="s_date" value="<?= $golf_info["s_date"] ?>" id="datepicker1" style="text-align: center;background: white; width: 231px;" readonly>
                                        </td>
                                        <th>종료일</th>
                                        <td>
                                            <input type="text" name="e_date" value="<?= $golf_info["e_date"] ?>" id="datepicker2" style="text-align: center; background: white; white; width: 231px;" readonly>
                                        </td>
                                </tr>
                                <tr>
                                    <th>예약마감일 지정</th>
                                    <td colspan="3">
                                        <?php
                                $deadline_date = explode(",", $golf_info["deadline_date"]);
                                $deadline_date = array_filter($deadline_date);

                                foreach ($deadline_date as $key => $value) {
                                    $date_array = explode("~", $value);
                                    ?>
                                            <input type="text" name="deadline_date[]" data-start_date="<?= $date_array[0] ?>" data-end_date="<?= $date_array[1] ?>" class="deadline_date" value="<?= $deadline_date ?>" style="width: 200px;" readonly >
                                        <?php }
                                ?>
                                        <button class="btn btn-primary" type="button" id="btn_add_date_range" style="width: auto;height: auto">+</button>
                                        <!-- <p>"|" 로 일자를 구분해 주세요  </p> -->
                                <!--/td>
                            </tr-->
                                </tbody>
                            </table>
                            <script>
                                $('.deadline_date').each(function () {
                                    $(this).daterangepicker({
                                        locale: {
                                            "format": "YYYY-MM-DD",
                                            "separator": " ~ ",
                                            cancelLabel: 'Delete',
                                        },
                                        "startDate": $(this).data("start_date"),
                                        "endDate": $(this).data("end_date"),
                                        "cancelClass": "btn-danger",
                                        "minDate": $("#datetest1").val(),
                                        "maxDate": $("#datetest3").val(),
                                    });
                                })
                                $('.deadline_date').on('cancel.daterangepicker', function () {
                                    $(this).remove();
                                });
                                $("#btn_add_date_range").click(function () {
                                    console.log($(this));
                                    const new_date_range = $(`<input type="text" class="deadline_date" name="deadline_date[]" style="width: 200px;" readonly >`);
                                    $(this).before(new_date_range);
                                    console.log(new_date_range);
                                    new_date_range.daterangepicker({
                                        locale: {
                                            "format": "YYYY-MM-DD",
                                            "separator": " ~ ",
                                            cancelLabel: 'Delete',
                                        },
                                        "cancelClass": "btn-danger",
                                        "minDate": $("#datetest1").val(),
                                        "maxDate": $("#datetest3").val(),
                                    })
                                    new_date_range.on('cancel.daterangepicker', function () {
                                        $(this).remove();
                                    });
                                })
                            </script>
                            <style>
                                .list_value_ {
                                    display: flex;
                                    align-items: center;
                                    justify-content: start;
                                    gap: 10px;
                                    margin-top: 10px;
                                }

                                .list_value_ .item_ {
                                    position: relative;
                                    padding: 10px;
                                    border: 1px solid #dbdbdb;
                                }

                                .list_value_ .item_ .remove {
                                    position: absolute;
                                    color: #FFFFFF;
                                    cursor: pointer;
                                    padding: 0 6px 2px 6px;
                                    top: -10px;
                                    background-color: rgba(255, 0, 0, 0.8);
                                    border-radius: 50%;
                                    right: -5px;
                                    border: 1px solid rgba(255, 0, 0, 0.8);
                                }
                            </style>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="12%"/>
                                    <col width="*%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        제품정보
                                    </td>
                                </tr>
                                <?php foreach ($filters as $key => $filter) { ?>
                                    <tr>
                                        <th>
                                            <?= $filter['code_name'] ?>
                                            <input type="checkbox" id="all_<?=$filter['filter_name']?>" class="all_input" value=""/>
                                            <label for="all_<?=$filter['filter_name']?>">
                                                모두 선택
                                            </label>
                                        </th>
                                        <td colspan="3">
                                            <!-- <select name="filter_<?= $filter['code_no'] ?>"
                                                    id="filter_<?= $filter['code_no'] ?>"
                                                    class="from-select select_filter"
                                                    data-code_no="<?= $filter['code_no'] ?>"
                                                    data-filter_name="<?= $filter['filter_name'] ?>">
                                                <option value="">선택하다</option>
                                                <?php foreach ($filter['children'] as $item) { ?>
                                                    <option value="<?= $item['code_no'] ?>---<?= $item['code_name'] ?>"><?= $item['code_name'] ?></option>
                                                <?php } ?>
                                            </select> -->
                                            <!-- <div class="list_value_ list_value_<?= $filter['code_no'] ?>">
                                                <?php
                                                $filter_arr = explode("|", $golf_info[$filter['filter_name']]);
                                                $filter_arr = array_filter($filter_arr);

                                                ?>
                                                <?php foreach ($filter['children'] as $item) { ?>
                                                    <?php if (in_array($item['code_no'], $filter_arr)) { ?>
                                                        <div class="item_">
                                                            <span><?= $item['code_name'] ?></span>
                                                            <input type="hidden" class="item_<?= $filter['code_no'] ?>"
                                                                   name="<?= $filter['filter_name'] ?>[]"
                                                                   value="<?= $item['code_no'] ?>">
                                                            <div class="remove" onclick="removeData(this)">
                                                                x
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div> -->
                                            <?php foreach ($filter['children'] as $item) { ?>
                                                <input type="checkbox" class="code_<?= $filter['filter_name'] ?>"
                                                        id="<?= $filter['filter_name'] ?>_<?= $item['code_no'] ?>"
                                                        name="<?= $filter['filter_name'] ?>[]"
                                                        value="<?= $item['code_no'] ?>" <?php if (in_array($item['code_no'], $filter_arr)) { echo "checked"; } ?> />
                                                <label for="<?= $filter['filter_name'] ?>_<?= $item['code_no'] ?>">
                                                    <?= $item['code_name'] ?>
                                                </label>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                               style="margin-top:10px;">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                            <tr height="45">
                                <th>홀선택</th>
                                <td>
                                    <select id="golf_code" name="golf_code" class="input_select">
                                        <option value="">선택</option>
                                        <?php foreach (GOLF_HOLES as $hole) : ?>
                                            <option value="<?= $hole ?>"><?= $hole ?>홀</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- <span>(호텔을 선택해야 옵션에서 룸을 선택할 수 있습니다.)</span> -->
                                </td>
                            </tr>
                            <th>
                                홀등록
                                <p style="display:block;margin-top:10px;">
                                    <button type="button" id="btn_add_option" class="btn_01">추가</button>
                                </p>
                            </th>

                            <td>
								<span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다. </span>
                                <div id="mainGolf">
                                    <?php foreach ($options as $frow3): ?>
                                        <?php if ($frow3['option_type'] == "M") { ?>
                                            <table>
                                                <colgroup>
                                                    <col width="*"></col>
                                                    <col width="12%"></col>
                                                    <col width="12%"></col>
                                                    <col width="12%"></col>
                                                    <col width="12%"></col>
                                                    <col width="12%"></col>
                                                    <col width="12%"></col>
                                                    <col width="12%"></col>
                                                    <col width="5%"></col>
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>홀수</th>
                                                    <th>일</th>
                                                    <th>월</th>
                                                    <th>화</th>
                                                    <th>수</th>
                                                    <th>목</th>
                                                    <th>금</th>
                                                    <th>토</th>
                                                    <th>삭제</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tblgolf<?= $grow['o_golf'] ?>">
                                                <tr id="option_<?= $frow3['idx'] ?>">

                                                    <input type='hidden' name='o_idx[]'
                                                           value='<?= $frow3['idx'] ?>'/>
                                                    <input type='hidden' name='option_type[]'
                                                           value='<?= $frow3['option_type'] ?>'/>
                                                    <input type='hidden' name='o_golf[]' id=''
                                                           value="<?= $frow3['o_golf'] ?>" size="70" class="hole_cnt"/>
                                                    <input type='hidden' name='o_name[]' id=''
                                                           value="<?= $frow3['goods_name'] ?>" size="70"/>
                                                    <td rowspan="2" style="text-align:center;">
                                                        <?= $frow3['goods_name'] ?>
                                                    </td>
                                                    <td>
                                                        <input type="text" numberonly="true" name="o_price1[]"
                                                               style="text-align:right;width:"
                                                               id="goods_price1_<?= $frow3['idx'] ?>"
                                                               value='<?= $frow3['goods_price1'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type="text" numberonly="true" name="o_price2[]"
                                                               style="text-align:right;width:"
                                                               id="goods_price2_<?= $frow3['idx'] ?>"
                                                               value='<?= $frow3['goods_price2'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type="text" numberonly="true" name="o_price3[]"
                                                               style="text-align:right;width:"
                                                               id="goods_price3_<?= $frow3['idx'] ?>"
                                                               value='<?= $frow3['goods_price3'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type="text" numberonly="true" name="o_price4[]"
                                                               style="text-align:right;width:"
                                                               id="goods_price4_<?= $frow3['idx'] ?>"
                                                               value='<?= $frow3['goods_price4'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type="text" numberonly="true" name="o_price5[]"
                                                               style="text-align:right;width:"
                                                               id="goods_price5_<?= $frow3['idx'] ?>"
                                                               value='<?= $frow3['goods_price5'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type="text" numberonly="true" name="o_price6[]"
                                                               style="text-align:right;width:"
                                                               id="goods_price6_<?= $frow3['idx'] ?>"
                                                               value='<?= $frow3['goods_price6'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type="text" numberonly="true" name="o_price7[]"
                                                               style="text-align:right;width:"
                                                               id="goods_price7_<?= $frow3['idx'] ?>"
                                                               value='<?= $frow3['goods_price7'] ?>'>
                                                    </td>
                                                    <td rowspan="2">
                                                        <!--button type="button" onclick="updPrice('<?= $frow3['idx'] ?>',this)">수정</button-->
                                                        <button type="button"
                                                                onclick="delOption('<?= $frow3['idx'] ?>',this)">삭제
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr color='<?= $_tmp_color ?>' size='<?= $frow2['type'] ?>'>
                                                    <td colspan="3">
                                                        적용기간: <input type='text' readonly class='datepicker '
                                                                     name='o_sdate[]' style="width:30%"
                                                                     value='<?= $frow3['o_sdate'] ?>'/> ~
                                                        <input type='text' readonly class='datepicker ' name='o_edate[]'
                                                               style="width:30%" value='<?= $frow3['o_edate'] ?>'/>
                                                        <button type="button"
                                                                onclick="updOption('<?= $frow3['idx'] ?>',this)">수정
                                                        </button>
                                                    </td>
                                                    <td colspan="2">
                                                        <input type='checkbox' name='o_day_yn[]'
                                                               id='day_<?= $frow3['o_golf'] ?>_<?= $i ?>' value='Y'
                                                               checked disabled>
                                                        <label for='day_<?= $frow3['o_golf'] ?>_<?= $i ?>'>주간</label>
                                                        <input type='text' name="o_day_price[]"
                                                               value="<?= $frow3['o_day_price'] ? $frow3['o_day_price'] : 0 ?>"
                                                               numberonly="true" style='width:60%;text-align:right;'>
                                                    </td>
                                                    <td colspan="2">
                                                        <?php if ($frow3['o_night_yn'] == "Y") { ?>
                                                            <input type='checkbox' name='night_yn[]' class='night_yn'
                                                                   id='night_<?= $frow3['o_golf'] ?>_<?= $i ?>'
                                                                   data-idx="<?= $frow3['idx'] ?>" value='Y' checked>
                                                        <?php } else { ?>
                                                            <input type='checkbox' name='night_yn[]' class='night_yn'
                                                                   id='night_<?= $frow3['o_golf'] ?>_<?= $i ?>'
                                                                   value='Y' data-idx="<?= $frow3['idx'] ?>">
                                                        <?php } ?>

                                                        <?php if ($frow3['o_night_yn'] == "Y") { ?>
                                                            <input type='hidden' name='o_night_yn[]' class='o_night_yn'
                                                                   value='Y'>
                                                        <?php } else { ?>
                                                            <input type='hidden' name='o_night_yn[]' class='o_night_yn'
                                                                   value=''>
                                                        <?php } ?>

                                                        <label for='night_<?= $frow3['o_golf'] ?>_<?= $i ?>'>야간</label>
                                                        <input type='text' name="o_night_price[]"
                                                               value="<?= $frow3['o_night_price'] ? $frow3['o_night_price'] : 0 ?>"
                                                               numberonly="true" style='width:60%;text-align:right;'>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                            </tr>

                            <tr height="45">
                                <th>
                                    추가옵션등록
                                    <p style="display:block;margin-top:10px;">
                                        <button type="button" id="btn_add_option2" class="btn_01">추가</button>
                                    </p>
                                </th>
                                <td>
										<span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에
											삭제바랍니다.</span>
                                    <div>
                                        <table>
                                            <colgroup>
                                                <col width="*">
                                                </col>
                                                <col width="25%">
                                                </col>
                                                <col width="15%">
                                                </col>
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>옵션명</th>
                                                <th>가격</th>
                                                <th>삭제</th>
                                            </tr>
                                            </thead>
                                            <tbody id="settingBody2">
                                            <?php foreach ($options as $frow3): ?>
                                                <?php if ($frow3['option_type'] == "S") { ?>
                                                    <tr color='<?= $_tmp_color ?>' size='<?= $frow2['type'] ?>'>
                                                        <td>
                                                            <input type='hidden' name='o_idx[]'
                                                                   value='<?= $frow3['idx'] ?>'/>
                                                            <input type='hidden' name='option_type[]'
                                                                   value='<?= $frow3['option_type'] ?>'/>
                                                            <input type='text' name='o_name[]' style='width: 100%;'
                                                                   id=''
                                                                   value="<?= $frow3['goods_name'] ?>" size="70"/>
                                                        </td>
                                                        <td>
                                                            <input type='text' numberonly='true'
                                                                   style='text-align:right;' name='o_price1[]' id=''
                                                                   value="<?= $frow3['goods_price1'] ?>"/>
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                    onclick="delOption('<?= $frow3['idx'] ?>',this)">삭제
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
            </form>

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
            var filters = <?php echo json_encode($filters);?>;
            let dynamicFunctions = {};
            for(let i = 0; i < filters.length; i++){
                dynamicFunctions[`check_${filters[i].filter_name}`] = function() {
                    let count = 0;
                    
                    $(`.code_${filters[i].filter_name}`).each(function() {
                        if ($(this).is(":checked")) {
                            count++;
                        }
                    });

                    console.log(count);
                    

                    if (count == $(`.code_${filters[i].filter_name}`).length) {
                        $(`#all_${filters[i].filter_name}`).prop("checked", true);
                    } else {
                        $(`#all_${filters[i].filter_name}`).prop("checked", false);
                    }
                };

                $(`#all_${filters[i].filter_name}`).change(function () {
                    if ($(`#all_${filters[i].filter_name}`).is(':checked')) {
                        $(`.code_${filters[i].filter_name}`).prop('checked', true)
                    } else {
                        $(`.code_${filters[i].filter_name}`).prop('checked', false)
                    }
                });

                $(`.code_${filters[i].filter_name}`).on("change", function() {
                    dynamicFunctions[`check_${filters[i].filter_name}`]();
                });
            }

            for (let funcName in dynamicFunctions) {
                if (typeof dynamicFunctions[funcName] === "function") {
                    dynamicFunctions[funcName]();
                }
            }

            
        </script>

        <script>
            function check_mbti() {
                let count_mbti = 0;

                $(".code_mbti").each(function() {
                    if($(this).is(":checked")) {
                        count_mbti++;
                    }
                });
                
                if(count_mbti == $(".code_mbti").length){
                    $("#all_code_mbti").prop("checked", true);
                }else{
                    $("#all_code_mbti").prop("checked", false);
                }
            }

            check_mbti();

            $(".code_mbti").on("change", function() {
                check_mbti();
            });

        </script>
        <script>
            $(document).ready(function () {


                $("#btn_tmp_option").click(function () {

                    if (confirm("임시 저장을 하시겠습니까?\r삭제된 옵션은 복구 되지 않으며, 기존 주문에 영향을 끼칠 수 있습니다 반드시 확인해주세요.")) {

                        var g_idx = $("#g_idx").val();
                        if (g_idx == "") {
                            alert("올바른 접근이 아닙니다.");
                            return false;
                        }

                        var frm = document.frm;
                        frm.action = "alter_option.php";
                        frm.target = "hiddenFrame22";
                        frm.submit();

                    }


                });

                var i = 1;

                $("#btn_add_option").click(function () {

                    var g_idx = $("#golf_code option:selected").val();
                    console.log(g_idx);

                    if (g_idx == "") {
                        alert("홀 선택해주세요.");
                        return false;
                    }

                    var golf_code = $("#golf_code").val();

                    var exists = false;
                    $('.hole_cnt').each(function () {
                        if ($(this).val() == golf_code) {
                            alert('홀이 중복선택 되었습니다.');
                            exists = true; // 일치하는 값이 있으면 true로 설정
                        }
                    });

                    if (exists == false) {
                        var golfName = $("#golf_code option:selected").text();


                        if ($("#tblgolf" + g_idx).html() == undefined) {


                            var addTable = "";

                            addTable += "<table>";
                            addTable += "	<colgroup>";
                            addTable += "		<col width='*'></col>";
                            addTable += "		<col width='12%'></col>";
                            addTable += "		<col width='12%'></col>";
                            addTable += "		<col width='12%'></col>";
                            addTable += "		<col width='12%'></col>";
                            addTable += "		<col width='12%'></col>";
                            addTable += "		<col width='12%'></col>";
                            addTable += "		<col width='12%'></col>";
                            addTable += "		<col width='5%'></col>";
                            addTable += "	</colgroup>";
                            addTable += "	<thead>";
                            addTable += "		<tr>";
                            addTable += "			<th>홀수</th>";
                            addTable += "			<th>일</th>";
                            addTable += "			<th>월</th>";
                            addTable += "			<th>화</th>";
                            addTable += "			<th>수</th>";
                            addTable += "			<th>목</th>";
                            addTable += "			<th>금</th>";
                            addTable += "			<th>토</th>";
                            addTable += "			<th>삭제</th>";
                            addTable += "		</tr>";
                            addTable += "	</thead>";
                            addTable += "	<tbody id='tblgolf" + g_idx + "'>";

                            addTable += "	</tbody>";
                            addTable += "</table>";


                            $("#mainGolf").append(addTable);

                        }


                        var addOption = "";
                        addOption += "<tr color='' size='' >												  ";
                        addOption += "		<input type='hidden' name='o_idx[]'  value='' />				  ";
                        addOption += "		<input type='hidden' name='option_type[]'  value='M' />			  ";
                        addOption += "		<input type='hidden' name='o_golf[]'  value='" + g_idx + "' size='70' class='hole_cnt' />		  ";
                        addOption += "		<input type='hidden' name='o_name[]'  value='" + golfName + "' size='70' />		  ";
                        addOption += "	<td style='text-align:center;' rowspan='2'>																  ";
                        addOption += golfName;
                        addOption += "	</td>																  ";
                        addOption += "	<td>																  ";
                        addOption += "		<input type='text' numberonly='true' name='o_price1[]' style='text-align:right;' value='0' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td>																  ";
                        addOption += "		<input type='text' numberonly='true' name='o_price2[]' style='text-align:right;' value='0' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td>																  ";
                        addOption += "		<input type='text' numberonly='true' name='o_price3[]' style='text-align:right;' value='0' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td>																  ";
                        addOption += "		<input type='text' numberonly='true' name='o_price4[]' style='text-align:right;' value='0' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td>																  ";
                        addOption += "		<input type='text' numberonly='true' name='o_price5[]' style='text-align:right;' value='0' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td>																  ";
                        addOption += "		<input type='text' numberonly='true' name='o_price6[]' style='text-align:right;' value='0' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td>																  ";
                        addOption += "		<input type='text' numberonly='true' name='o_price7[]' style='text-align:right;' value='0' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td rowspan='2'>																  ";
                        addOption += '		<button type="button" onclick="delOption(\'\',this)" >삭제</button>	  ';
                        addOption += "	</td>																  ";
                        //addOption += "	<td>																  ";
                        //addOption += "		<input type='text' class='onlynum' name='o_soldout[]'  value='' style='width:100%;' /> ";
                        //addOption += "	</td>																  ";
                        addOption += "	</tr>																  ";
                        addOption += "	<tr>																  ";
                        addOption += "	<td colspan='3'>																  ";
                        addOption += "		적용기간: <input type='text' class='datepicker' readonly name='o_sdate[]'  value='' style='width:30%' /> ~ ";
                        addOption += "		         <input type='text' class='datepicker' readonly name='o_edate[]'  value='' style='width:30%' /> ";
                        addOption += "	</td>																  ";
                        addOption += "	<td colspan='2'>																  ";
                        addOption += "			     <input type='checkbox' name='o_day_yn[]' id='" + "day_" + g_idx + "_" + i + "' value='Y' checked disabled>";
                        addOption += "			     <label for='" + "day_" + g_idx + "_" + i + "'>주간</label>";
                        addOption += "			     <input type='text' name='o_day_price[]' value='0' numberonly='true' style='width:60%;text-align:right;'>";
                        addOption += "	</td>																  ";
                        addOption += "	<td colspan='2'>																  ";
                        addOption += "			     <input type='checkbox' name='night_yn[]' class='night_yn' id='" + "night_" + g_idx + "_" + i + "' value='Y'>";
                        addOption += "			     <input type='hidden' name='o_night_yn[]' class='o_night_yn' value=''>";
                        addOption += "			     <label for='" + "night_" + g_idx + "_" + i + "'>야간</label>";
                        addOption += "			     <input type='text' name='o_night_price[]' value='0' numberonly='true' style='width:60%;text-align:right;'>";
                        addOption += "	</td>																  ";
                        addOption += "</tr>																	  ";

                        $("#tblgolf" + g_idx).append(addOption);
                        i++;
                        $(".datepicker").datepicker();
                        $(".night_yn").change(function () {
                            if ($(this).is(":checked")) {
                                $(this).closest(".day_check").find(".o_night_yn").val("Y");
                            } else {
                                $(this).closest(".day_check").find(".o_night_yn").val("");
                            }
                        });
                    }
                });


                $("#btn_add_option2").click(function () {

                    var addOption = "";
                    addOption += "<tr color='' size='' >												  ";
                    addOption += "	<td>																  ";
                    addOption += "		<input type='hidden' name='o_idx[]'  value='' />				  ";
                    addOption += "		<input type='hidden' name='option_type[]'  value='S' />			  ";
                    addOption += "		<input type='text' name='o_name[]' style='width: 100%;' value='' size='70' />		  ";
                    addOption += "	</td>																  ";
                    addOption += "	<td>																  ";
                    addOption += "		<input type='text' class='onlynum' name='o_price1[]' numberonly='true' value='' style='text-align:right;'/>  ";
                    addOption += "	</td>																  ";
                    addOption += "	<td>																  ";
                    addOption += '		<button type="button" onclick="delOption(\'\',this)" >삭제</button>	  ';
                    addOption += "	</td>																  ";
                    addOption += "</tr>																	  ";

                    $("#settingBody2").append(addOption);

                });


            });
        </script>

        <script>
            function updOption(idx) {
                location.href = '/AdmMaster/_tourRegist/list_golf_price?o_idx=' + idx + '&product_idx=' + $("#product_idx").val();
            }
        </script>

        <script>
            function check_product_code(product_code) {
                $.ajax({
                    url: "/ajax/check_product_code",
                    type: "POST",
                    data: "product_code=" + product_code,
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
                        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    }
                    , success: function (response, status, request) {
                        alert(response.message);

                        if (response.result == true) {
                            $("#chk_product_code").val("Y");
                        } else {
                            $("#chk_product_code").val("N");
                            location.reload();
                        }
                    }
                });
            }

            function productImagePreview(inputFile, onum) {
                if (sizeAndExtCheck(inputFile) == false) {
                    inputFile.value = "";
                    return false;
                }

                let imageTag = document.querySelector('label[for="ufile' + onum + '"]');

                if (inputFile.files.length > 0) {
                    let imageReader = new FileReader();

                    imageReader.onload = function () {
                        imageTag.style = "background-image:url(" + imageReader.result + ")";
                        inputFile.closest('.file_input').classList.add('applied');
                        inputFile.closest('.file_input').children[3].value = 'Y';
                    }
                    return imageReader.readAsDataURL(inputFile.files[0]);
                }
            }

            /**
             * 상품 이미지 삭제
             * @param {element} button
             */
            function productImagePreviewRemove(element) {
                let inputFile = element.parentNode.children[1];
                let labelImg = element.parentNode.children[2];

                inputFile.value = "";
                labelImg.style = "";
                element.closest('.file_input').classList.remove('applied');
                element.closest('.file_input').children[3].value = 'N';
            }

            function sizeAndExtCheck(input) {
                let fileSize = input.files[0].size;
                let fileName = input.files[0].name;

                // 20MB
                let megaBite = 20;
                let maxSize = 1024 * 1024 * megaBite;

                if (fileSize > maxSize) {
                    alert("파일용량이 " + megaBite + "MB를 초과할 수 없습니다.");
                    return false;
                }

                let fileNameLength = fileName.length;
                let findExtension = fileName.lastIndexOf('.');
                let fileExt = fileName.substring(findExtension, fileNameLength).toLowerCase();

                if (fileExt != ".jpg" && fileExt != ".jpeg" && fileExt != ".png" && fileExt != ".gif" && fileExt != ".bmp" && fileExt != ".ico") {
                    alert("이미지 파일 확장자만 업로드 할 수 있습니다.");
                    return false;
                }

                return true;
            }

            $(document).ready(function () {
                // 숫자 전용 입력 처리
                $('.numberOnly').on('input', function () {
                    // 입력값에서 숫자가 아닌 문자는 제거
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
            });

            function delOption(idx) {

                if (!confirm("가격정보를 삭제 하시겠습니까?"))
                    return false;

                $.ajax({

                    url: "/ajax/golf_option_delete",
                    type: "POST",
                    data: {

                        "idx": idx
                    },
                    dataType: "json",
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        var message = data.message;
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
                $.ajax({
                    url: "/member/mem_detail",
                    type: "POST",
                    data: {
                        "user_id": user_id
                    },
                    dataType: "json",
                    async: false,
                    cache: false,
                    success: function (data, textStatus) {
                        $("#product_manager").val(data?.user_name || " ");
                        $("#phone").val(data?.user_mobile || "");
                        $("#email").val(data?.user_email || "");

                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
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
                        "goods_price": $("#goods_price_" + code_idx).val(),
                        "goods_price1": $("#goods_price1_" + code_idx).val(),
                        "goods_price2": $("#goods_price2_" + code_idx).val(),
                        "goods_price3": $("#goods_price3_" + code_idx).val(),
                        "goods_price4": $("#goods_price4_" + code_idx).val(),
                        "goods_price5": $("#goods_price5_" + code_idx).val(),
                        "goods_price6": $("#goods_price6_" + code_idx).val(),
                        "goods_price7": $("#goods_price7_" + code_idx).val(),
                        "caddy_fee": $("#caddy_fee_" + code_idx).val(),
                        "cart_pie_fee": $("#cart_pie_fee_" + code_idx).val(),
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
                        "moption_minute": $("#moption_minute").val()
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

            function date_moption(idx) {
                location.href = "/AdmMaster/_tourRegist/list_golf_price?product_idx=" + idx;
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

                let _code_mbtis = '';
                $("input[name=_code_mbti]:checked").each(function () {
                    _code_mbtis += $(this).val() + '|';
                })

                $("#mbti").val(_code_mbtis);

                if (formSubmitted) {
                    return;
                }

                // if (frm.tour_period.value == "") {
                //     alert("일자를 선택하셔야 합니다.");
                //     frm.tour_period.focus();
                //     return;
                // }
                //if ($("#product_code_1").value == "") {
                //    alert("1차분류를 선택하셔야 합니다.");
                //    return;
                //}
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
                if (frm.product_code_1.value == "") {
                    alert("1차분류를 선택하셔야 합니다..");
                    frm.product_code_1.focus();
                    return;
                }

                if (frm.product_code_2.value == "") {
                    alert("2차분류를 선택하셔야 합니다..");
                    frm.product_code_2.focus();
                    return;
                }

                // if ($("#chk_product_code").val() == "N") {
                //     alert("중복된 제품 코드를 확인하세요.");
                //     return;
                // }

                if (frm.product_name.value == "") {
                    alert("상품명을 입력하셔야 합니다.");
                    frm.product_name.focus();
                    return;
                }

                // if (frm.phone.value == "") {
                //     alert("전화번호를 입력하셔야 합니다..");
                //     frm.phone.focus();
                //     return;
                // }
                //
                // if (frm.email.value == "") {
                //     alert("이메일을 입력하셔야 합니다..");
                //     frm.email.focus();
                //     return;
                // }

                if (frm.keyword.value == "") {
                    alert("검색키워드를 입력하셔야 합니다..");
                    frm.keyword.focus();
                    return;
                }

                if (frm.original_price.value == "") {
                    alert("기존상품가를 입력하셔야 합니다..");
                    frm.original_price.focus();
                    return;
                }

                if (frm.product_price.value == "") {
                    alert("상품최저가를 입력하셔야 합니다..");
                    frm.product_price.focus();
                    return;
                }


                if (frm.onum.value == "") {
                    alert("우선순위를 입력하셔야 합니다..");
                    frm.onum.focus();
                    return;
                }

                var checkedValues = $('.night_yn:checked').map(function () {
                    return $(this).data('idx');
                }).get();
                $("#night_y").val(checkedValues);

                let uncheckedValues = $(".night_yn:not(:checked)").map(function () {
                    return $(this).data('idx');
                }).get();
                $("#night_n").val(uncheckedValues);

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

                    url: "/AdmMaster/_tourRegist/del_product",
                    type: "delete",
                    data: "product_idx[]=" + idx,
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
                if (!address) {
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
                        //console.log('Data:', data);
                        let html = '';
                        if (data.results.length > 0) {
                            data.results.forEach(element => {
                                let address = element.formatted_address;
                                let lat = element.geometry.location.lat;
                                let lon = element.geometry.location.lng;
                                html += `<li data-lat="${lat}" data-lon="${lon}">${address}</li>`;
                            });
                        } else {
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

            $(".select_filter").on("change", function () {
                const val = $(this).val();
                const code_no = $(this).data("code_no");
                const filter_name = $(this).data("filter_name");
                let arr = val.split('---');

                let value = arr[0];
                let name = arr[1];

                let theme = ` <div class="item_">
                                <span data-value="${value}">${name}</span>
                                <input type="hidden" class="item_${code_no}" name="${filter_name}[]" value="${value}">
                                <div class="remove" data-parent="${code_no}" data-value="${val}" onclick="removeData(this)">
                                    x
                                </div>
                            </div>`;

                let list_ = $(`.item_${code_no}`);

                let isExist = false;
                list_.each(function () {
                    if ($(this).val() === value || $(this).val() === '' || $(this).val() === null) {
                        isExist = true;
                    }
                })

                if (!isExist) {
                    $(`.list_value_${code_no}`).append(theme);
                    $(this).find(`option[value="${val}"]`).remove();
                    $(this).val("");
                }
            });

            function removeData(el) {
                $(el).parent('.item_').remove();
                const value = $(el).data('value');
                let arr = value.split('---');
                const code_no = $(el).data('parent');
                $(`#filter_${code_no}`).append(`<option value="${value}">${arr[1]}</option>`);
            }
        </script>
        <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

        <form id="listForm" action="/AdmMaster/_tourRegist/list_golf">
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