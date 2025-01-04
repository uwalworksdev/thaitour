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

        .img_add .file_input {
            position: relative;
            display: inline-block;
            width: 100px;
            height: 100px;
            border: 1px solid #dbdbdb;
            box-sizing: border-box;
            background: #f5f6f8 url(/images/ico/img_add_basic.png) center no-repeat;
        }

        .img_add .file_input input[type="file"] {
            display: none;
            width: 0;
            height: 0;
        }

        .img_add .file_input input[type="file"] + label {
            display: inline-block;
            width: 100%;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .img_add .file_input .remove_btn {
            display: none;
        }

        .img_add .file_input .img_txt {
            display: block;
            font-size: 12px;
            margin-top: 8px;
            line-height: 1.3;
            text-align: center;
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

    <div id="container" style="overflow: hidden;">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2>투어 상품관리 정보입력 <?= $titleStr ?> </h2>
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

            <form name=frm action="<?= route_to('admin._tours.write_ok') ?>" method=post enctype="multipart/form-data"
                  target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>
                <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
                <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
                <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>
                <input type=hidden name="product_option" id="product_option" value=''>
                <input type=hidden name="tours_cate" id="tours_cate" value='<?= $tours_cate ?>'>
                <!-- <input type="hidden" name="chk_product_code" id="chk_product_code" value='<?= $product_idx ? "Y" : "N" ?>'> -->
                <input type="hidden" name="mbti" id="mbti"
                       value='<?= $product['mbti'] ?? "" ?>'/>

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
                                        <div class=""
                                             style="width: 100%; display: flex; justify-content: space-between; align-items: center">
                                            <p>기본정보</p>
                                            <?php if ($product_idx): ?>
                                                <a class="btn btn-default"
                                                   href="/product-tours/item_view/<?= $product_idx ?>"
                                                   target="_blank">
                                                    상품 상세보기
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>상품분류</th>
                                    <td colspan="3">
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
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product['product_code_1']) {
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
                                    <!-- <th>일자</th>
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
                                    </td> -->
                                </tr>

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
                                    <!-- <th rowspan=7>썸네일<br>(600 * 450)</th>
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
                                    </td> -->
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" id="product_name" name="product_name"
                                               value="<?= $product_name ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                    <th>예약시간</th>
                                    <td>
                                        <input id="time_line" name="time_line" class="input_txt" type="text"
                                               value="<?= $time_line ?>" style="width:100%"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)07:50 ~ 13:30, 13:30 ~ 18:30</span>
                                    </td>
                                    <!-- <th>이용항공</th>
                                    <td>
                                        <input type="text" id="product_air" name="product_air"
                                               value="<?= $product_air ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td> -->
                                </tr>

                                <!-- <tr>
                                    <th>간단소개</th>
                                    <td>
                                        <input type="text" id="product_info" name="product_info"
                                               value="<?= $product_info ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                    <th>간단일정(사용안함)</th>
                                    <td>
                                        <input type="text" id="product_schedule" name="product_schedule"
                                               value="<?= $product_schedule ?>" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr> -->

                                <!-- <tr>
                                    <th>여행국가(사용안함)</th>
                                    <td>
                                        <input id="product_country" name="product_country" class="input_txt" type="text"
                                               value="<?= $product_country ?>" style="width:90%"/>
                                    </td>
                                    <th>최소출발인원(성인)</th>
                                    <td>
                                        <input id="minium_people_cnt" name="minium_people_cnt" class="input_txt"
                                               type="text"
                                               value="<?= $minium_people_cnt ?>" style="width:500px"/>
                                    </td>
                                </tr> -->

                                <!-- <tr>
                                    <th>마일리지</th>
                                    <td colspan="3">
                                        <input id="product_mileage" name="product_mileage" class="input_txt" type="text"
                                               value="<?= $product_mileage ?>" style="width:50px" maxlength="2"/>% (총
                                        결제비용 %)
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                    <th>이동방법</th>
                                    <td>
                                        <input id="tour_transport" name="tour_transport" class="input_txt" type="text"
                                               value="<?= $tour_transport ?>" style="width:90%"/>
                                    </td>
                                </tr> -->
                                <!-- <tr>
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
                                </tr> -->

                                <tr>
                                    <!-- <th>출발요일</th>
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
                                    </td> -->
                                    <!-- <th>가이드/언어</th>
                                    <td>
                                        <input id="guide_lang" name="guide_lang" class="input_txt" type="text"
                                               value="<?= $guide_lang ?>" style="width:20%"/><br/>
                                    </td> -->

                                </tr>
                                <!-- <tr>
                                    <th>시작일</th>
                                    <td>
                                        <input type="text" name="t_sdate" value="<?= substr($t_sdate, 0, 10) ?>" id="datepicker1" style="text-align: center;background: white; width: 231px;" readonly>
                                    </td>
                                    <th>종료일</th>
                                    <td>
                                        <input type="text" name="t_edate" value="<?= substr($t_edate, 0, 10) ?>" id="datepicker2" style="text-align: center; background: white; white; width: 231px;" readonly>
                                    </td>
                                </tr> -->

                                <!-- <tr>
                                    <th>메모</th>
                                    <td colspan="3"><textarea name="information" cols="100" rows="5"
                                                              style="width: 100%"><?= $information ?></textarea></td>
                                </tr> -->

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
                                    <th>여행기간</th>
                                    <td colspan="">
                                        <input id="product_period" name="product_period" class="input_txt" type="text"
                                               value="<?= $product_period ?>" style="width:39%"/><br/>
                                        <span style="color: gray;">* ex) 3박 5일</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품담당자</th>
                                    <td>
                                        <input id="product_manager" name="product_manager" class="input_txt" type="text"
                                               value="" style="width:100px" readonly/>
                                        /<input id="phone" name="phone" class="input_txt" type="text"
                                                value="" readonly
                                                style="width:200px"/>
                                        /<input id="email" name="email" class="input_txt"
                                                type="text" value="" readonly
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
                                                장은진
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
                                    <th>기존상품가(단위: 바트)</th>
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
                                    <!-- <th>베스트여부</th>
                                    <td>
                                        <?php foreach ($mresult2 as $row_m) : ?>
                                            <input type="checkbox" name="product_best"
                                                   id="product_best"
                                                   value="Y" <?php if (isset($row_m["product_best"]) && $row_m["product_best"] == "Y") {
                                        echo "checked";
                                    } ?>/>
                                        <?php endforeach; ?>
                                    </td> -->
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt"
                                               style="width:80px"/> <span
                                                style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                    <th>특가여부</th>
                                    <td colspan="3">
                                        <input type="checkbox" name="special_price" id="special_price"
                                               value="Y" <?php if (isset($row["special_price"]) && $row["special_price"] == "Y") {
                                            echo "checked";
                                        } ?> />&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <th>직접결제</th>
                                    <td colspan="3">
										<input type="checkbox" name="direct_payment" id="direct_payment" value="Y" <?php if (isset($direct_payment) && $direct_payment === "Y")
                                                echo "checked=checked"; ?>> 
                                    </td>
                                </tr>

                                    <!-- <th>투어구분</th>
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
                                    </td> -->
                                </tr>
                                <tr>
                                    <th>투어메인</th>
                                    <td>
                                        <input type="checkbox" name="tours_guide" value="Y"
                                               class="yoil" <?php if (isset($tours_guide) && $tours_guide == "Y") echo "checked"; ?> >
                                        가이드 유&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="tours_ko" value="Y"
                                               class="yoil" <?php if (isset($tours_ko) && $tours_ko == "Y") echo "checked"; ?> >
                                        한국어&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="tours_join" value="Y"
                                               class="yoil" <?php if (isset($tours_join) && $tours_join == "Y") echo "checked"; ?> >
                                        조인투어&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="tours_total_hour" value="Y"
                                               class="yoil" <?php if (isset($tours_total_hour) && $tours_total_hour == "Y") echo "checked"; ?> >
                                        총 시간&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <th>총 시간</th>
                                    <td>
                                        <input id="tours_hour" name="tours_hour" class="input_txt" type="text"
                                               value="<?= $tours_hour ?>" style="width:20%">
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
                                    <td colspan="3">
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
                                    <th>투어타입</th>
                                    <td colspan="3">
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px ">
                                            <?php
                                            $_product_theme_arr = isset($product_theme) ? explode("|", $product_theme) : [];
                                            $_product_theme_arr = array_filter($_product_theme_arr);
                                            ?>
                                            <?php foreach ($pthemes as $item) { ?>
                                                <div class="checkbox-item">
                                                    <label>
                                                        <input type="checkbox" name="select_product[]"
                                                               value="<?= $item['code_no'] ?>"
                                                            <?= in_array($item['code_no'], $_product_theme_arr) ? 'checked' : '' ?>>
                                                        <?= $item['code_name'] ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>예약마감일 지정</th>
                                    <td colspan="3">
                                        <?php
                                        $deadline_date = explode(",", $deadline_date);
                                        $deadline_date = array_filter($deadline_date);

                                        foreach ($deadline_date as $key => $value) {
                                            $date_array = explode("~", $value);
                                            ?>
                                            <input type="text" name="deadline_date[]"
                                                   data-start_date="<?= $date_array[0] ?>"
                                                   data-end_date="<?= $date_array[1] ?>" class="deadline_date"
                                                   value="<?= $deadline_date ?>" style="width: 200px;" readonly>
                                        <?php }
                                        ?>
                                        <button class="btn btn-primary" type="button" id="btn_add_date_range"
                                                style="width: auto;height: auto">+
                                        </button>
                                        <!-- <p>"|" 로 일자를 구분해 주세요  </p> -->
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
                                <!-- <tr>
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
                                </tr> -->
                                <tr>
                                    <th>투어 사진</th>
                                    <td colspan="3">
                                        <div class="img_add" style="font-size: 0; margin-top: 10px;">
                                            <?php
                                            for ($i = 1; $i <= 6; $i++) :
                                                $img = get_img_tour(${"tours_ufile" . $i}, "/data/product/", "100", "100");
                                                ?>
                                                <div class="file_input <?= empty(${"tours_ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='tours_ufile<?= $i ?>'
                                                           id="tours_ufile<?= $i ?>"
                                                           onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="tours_ufile<?= $i ?>" <?= !empty(${"tours_ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" id="checkImg_tours_<?= $i ?>"
                                                           name="checkImg_tours_<?= $i ?>" value="Y">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                        </div>
                                    </td>
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
                                                           onchange="productImageMainPreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImageMainPreviewRemove(this)"></button>
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
                                            for ($i = 2; $i <= 6; $i++) :
                                                $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                                // $img ="/data/product/" . ${"ufile" . $i};
                                                ?>
                                                <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                           onchange="productImageMainPreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImageMainPreviewRemove(this)"></button>
                                                    <a class="img_txt imgpop" href="<?= $img ?>"
                                                       id="text_ufile<?= $i ?>">미리보기</a>
                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                        </div>
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
                                <tr>
                                    <th>미팅/픽업장소 안내</th>
                                    <td colspan="3">

								<textarea name="product_confirm" id="product_confirm" class="input_txt"
                                          style="width:100%; height:200px; display:none;"><?= viewSQ($product_confirm); ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors12 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors12,
                                                elPlaceHolder: "product_confirm",
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
                                                    //oEditors2.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                    <!-- <th>예약전 확인사항(모바일)</th>
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
                                                    //oEditors5.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td> -->
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
                                                    //oEditors5.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                </tr>

                                <tr>
                                    <th>추가정보 및 참고사항</th>
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
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                    <th>어린이정책</th>
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
                                                    //oEditors3.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>
                                    </td>
                                    <th>더투어랩 이용방법</th>
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

            <div id="contents">
                <div class="tail_menu">
                    <ul>
                        <li class="left"></li>
                        <li class="right_sub" style="display: none">

                            <a href="list_tours?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                               class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                        class="txt">리스트</span></a>
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

                <?php if ($product_idx): ?>
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
                                    <input type='text' name='moption_name' id='moption_name' value=""
                                           style="width:550px"/>
                                    <button type="button" class="btn_01" onclick="add_moption();">추가</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <?php foreach ($options as $row_option): ?>
                    <div class="listBottom">
                        <form name="optionForm_<?= $row_option['code_idx'] ?>"
                              id="optionForm_<?= $row_option['code_idx'] ?>">
                            <input type="hidden" name="product_idx" value="<?= $product_idx ?>"/>
                            <input type="hidden" name="code_idx" value="<?= $row_option['code_idx'] ?>"/>

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <colgroup>
                                    <col width="10%">
                                    <col width="90%">
                                </colgroup>
                                <tbody>
                                <tr height="45">
                                    <th colspan="5">
                                        옵션 <input type='text' name='moption_name'
                                                  id='moption_name_<?= $row_option['code_idx'] ?>'
                                                  value="<?= $row_option['moption_name'] ?>" style="width:550px"/>
                                        <button type="button" class="btn_01"
                                                onclick="upd_moption('<?= $row_option['code_idx'] ?>');">수정
                                        </button>
                                        <button type="button" class="btn_01"
                                                onclick="del_moption('<?= $row_option['code_idx'] ?>');">삭제
                                        </button>
                                    </th>
                                </tr>
                                <tr height="45">
                                    <th>
                                        추가 옵션등록
                                        <p style="display:block;margin-top:10px;">
                                            <button type="button" id="btn_add_option"
                                                    onclick="add_option('<?= $row_option['code_idx'] ?>');"
                                                    class="btn_01">추가
                                            </button>
                                            <button type="button" id="btn_upd_option"
                                                    onclick="upd_option('<?= $row_option['code_idx'] ?>');"
                                                    class="btn_01">등록
                                            </button>
                                        </p>
                                    </th>
                                    <td>
                                        <span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다.</span>
                                        <div>
                                            <table>
                                                <colgroup>
                                                    <col width="*"></col>
                                                    <col width="25%"></col>
                                                    <col width="5%"></col>
                                                    <col width="5%"></col>
                                                    <col width="12%"></col>
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>옵션명</th>
                                                    <th>가격(단위: 바트)</th>
                                                    <th>적용</th>
                                                    <th>순서</th>
                                                    <th>삭제</th>
                                                </tr>
                                                </thead>
                                                <tbody id="settingBody_<?= $row_option['code_idx'] ?>">
                                                <?php foreach ($row_option['additional_options'] as $option): ?>
                                                    <tr>
                                                        <td>
                                                            <input type='text' name='o_name[]'
                                                                   id='o_name_<?= $option['idx'] ?>'
                                                                   value="<?= $option['option_name'] ?>" size="70"/>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='onlynum' style="text-align:right;"
                                                                   name='o_price[]' id='o_price_<?= $option['idx'] ?>'
                                                                   value="<?= $option['option_price'] ?>"/>
                                                        </td>
                                                        <td>
                                                            <select name="use_yn[]" id="use_yn_<?= $option['idx'] ?>">
                                                                <option value="Y" <?php if ($option['use_yn'] == "Y") echo "selected"; ?> >
                                                                    판매중
                                                                </option>
                                                                <option value="N" <?php if ($option['use_yn'] != "Y") echo "selected"; ?> >
                                                                    중지
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='onlynum' name='o_num[]'
                                                                   id='o_num_<?= $option['idx'] ?>'
                                                                   value="<?= $option['onum'] ?>"/>
                                                        </td>
                                                        <td align="center"
                                                            style="display: flex; gap: 5px; justify-content: center; align-items: center">
                                                            <button type="button" style="height: 25px"
                                                                    onclick="updOption('<?= $option['idx'] ?>')">수정
                                                            </button>
                                                            <button type="button" style="height: 25px"
                                                                    onclick="delOption('<?= $option['idx'] ?>')">삭제
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
							<!--div class="listBottom">
								<table cellpadding="0" cellspacing="0" summary="" class="listTable">
									<caption></caption>
									<colgroup>
										<col width="10%">
										<col width="10%">
										<col width="*">
										<col width="10%">
										<col width="10%">
										<col width="10%">
										<col width="10%">
									</colgroup>
									<thead>
										<tr>
											<th>시작일</th>
											<th>종료일</th>
											<th>선택요일</th>
											<th>대인가격</th>
											<th>소인가격</th>
											<th>경로가격</th>
											<th>가격추가</th>
										</tr>
									</thead>
									<tbody>
										<tr style="height:50px">
											<td class="tac">
												<input type="text" name="s_date" value="" id="s_date" class="s_date hasDatepicker" style="text-align: center;background: white; width: 90%;" readonly="">								
											</td>
											<td class="tac">
												<input type="text" name="e_date" value="" id="e_date" class="e_date hasDatepicker" style="text-align: center;background: white; width: 90%;" readonly="">								
											</td>
											<td class="tac"> 
												<input type="checkbox" name="yoil_0" id="yoil_0" value="Y" class="yoil"> 일요일&nbsp;&nbsp;&nbsp;
												<input type="checkbox" name="yoil_1" id="yoil_1" value="Y" class="yoil"> 월요일&nbsp;&nbsp;&nbsp;
												<input type="checkbox" name="yoil_2" id="yoil_2" value="Y" class="yoil"> 화요일&nbsp;&nbsp;&nbsp;
												<input type="checkbox" name="yoil_3" id="yoil_3" value="Y" class="yoil"> 수요일&nbsp;&nbsp;&nbsp;
												<input type="checkbox" name="yoil_4" id="yoil_4" value="Y" class="yoil"> 목요일&nbsp;&nbsp;&nbsp;
												<input type="checkbox" name="yoil_5" id="yoil_5" value="Y" class="yoil"> 금요일&nbsp;&nbsp;&nbsp;
												<input type="checkbox" name="yoil_6" id="yoil_6" value="Y" class="yoil"> 토요일&nbsp;&nbsp;&nbsp;
											</td>
											<td style="text-align:center"><input type="text" name="price1" id="price1" value="0" class="price price1 input_txt" style="width:90%;text-align:right;"></td>
											<td style="text-align:center"><input type="text" name="price2" id="price2" value="0" class="price price2 input_txt" style="width:90%;text-align:right;"></td>
											<td style="text-align:center"><input type="text" name="price3" id="price3" value="0" class="price price3 input_txt" style="width:90%;text-align:right;"></td>
											<td>
												<a href="#!" onclick="isrt_price();" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">가격추가</span></a>
											</td>
										</tr>
								</tbody>
								</table>
							</div-->	
							
                            <?php
                            $info_idx = !empty($productTourInfo) ? $productTourInfo[0]['info_idx'] : null;
                            if ($info_idx):
                                ?>
                                <li class="right_sub" style="padding-bottom:10px">
                                    <a href="/AdmMaster/_tourRegist/write_tour_info?product_idx=<?= $product_idx ?>"
                                       class="btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                        <span class="txt">수정하기</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="right_sub" style="padding-bottom:10px">
                                    <a href="/AdmMaster/_tourRegist/write_tour_info?product_idx=<?= $product_idx ?>"
                                       class="btn btn-default">
                                        <span class="glyphicon glyphicon-cog"></span>
                                        <span class="txt">가격등록</span>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>

                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="5%"/>
                                <col width="10%"/>
                                <col width="*"/>
                                <col width="8%"/>
                                <col width="8%"/>
                                <col width="8%"/>
                                <col width="8%"/>
                                <col width="6%"/>
                                <col width="5%"/>
                                <col width="6%"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>기간</th>
                                <th>적용요일</th>
                                <th>상품명</th>
                                <th>성인가격(단위: 바트)</th>
                                <th>소아가격(단위: 바트)</th>
                                <th>유아가격(단위: 바트)</th>
                                <th>등록일</th>
                                <th>판매상태</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $infoIdxCounts = [];
                            $toursIdxMap = [];

                            foreach ($productTourInfo as $row) {
                                $info_idx = $row['info_idx'];
                                $tours_idx = $row['tours_idx'];

                                if (!isset($infoIdxCounts[$info_idx])) {
                                    $infoIdxCounts[$info_idx] = 0;
                                }

                                if (!isset($toursIdxMap[$info_idx])) {
                                    $toursIdxMap[$info_idx] = [];
                                }

                                if ($tours_idx !== null && !in_array($tours_idx, $toursIdxMap[$info_idx])) {
                                    $toursIdxMap[$info_idx][] = $tours_idx;
                                }

                                $infoIdxCounts[$info_idx]++;
                            }

                            $printedInfoIdx = [];

                            foreach ($productTourInfo as $row):
                                $status = ($row['status'] == "Y") ? "판매중" : "중지";

                                $info_idx = $row['info_idx'];
                                $printRowspan = false;

                                $tours_idx_array = isset($toursIdxMap[$info_idx]) ? $toursIdxMap[$info_idx] : [];
                                $tours_idx_json = htmlspecialchars(json_encode($tours_idx_array), ENT_QUOTES, 'UTF-8');

                                if (!in_array($info_idx, $printedInfoIdx)) {
                                    $printRowspan = true;
                                    $printedInfoIdx[] = $info_idx;
                                }
                                ?>
                                <tr style="height:40px">
                                    <td><?= $i++ ?></td>

                                    <?php if ($printRowspan): ?>
                                        <td rowspan="<?= $infoIdxCounts[$info_idx] ?>">
                                            <?= substr($row['o_sdate'], 0, 10) ?>
                                            ~ <?= substr($row['o_edate'], 0, 10) ?>
                                        </td>
                                    <?php endif; ?>

                                    <td>
										<input type="checkbox" name="yoil_0" <?php if($row['yoil_0'] == "Y") echo "checked"; ?> class="yoil" disabled> 일요일&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="yoil_1" <?php if($row['yoil_1'] == "Y") echo "checked"; ?> class="yoil" disabled> 월요일&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="yoil_2" <?php if($row['yoil_2'] == "Y") echo "checked"; ?> class="yoil" disabled> 화요일&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="yoil_3" <?php if($row['yoil_3'] == "Y") echo "checked"; ?> class="yoil" disabled> 수요일&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="yoil_4" <?php if($row['yoil_4'] == "Y") echo "checked"; ?> class="yoil" disabled> 목요일&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="yoil_5" <?php if($row['yoil_5'] == "Y") echo "checked"; ?> class="yoil" disabled> 금요일&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="yoil_6" <?php if($row['yoil_6'] == "Y") echo "checked"; ?> class="yoil" disabled> 토요일&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td><?= $row['tours_subject'] ?></td>
                                    <td><?= number_format($row["tour_price"], 0) ?></td>
                                    <td><?= number_format($row["tour_price_kids"], 0) ?></td>
                                    <td><?= number_format($row["tour_price_baby"], 0) ?></td>
                                    <td class="tac"><?= substr($row["r_date"], 0, 10) ?></td>
                                    <td class="tac"><?= $status ?></td>

                                    <?php if ($printRowspan): ?>
                                        <td rowspan="<?= $infoIdxCounts[$info_idx] ?>">
                                            <a href="javascript:del_tours('<?= $row["info_idx"] ?>', <?= $tours_idx_json ?>);"
                                               class="btn btn-default">삭제하기</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>


                        </table>
                    </div>

                    <!-- <div class="listBottom">
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
                    </div> -->

                    <div class="tail_menu">
                        <ul>
                            <li class="left">■ 일정내역</li>
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
                                <th></th>
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
                                            <a href="/AdmMaster/_tours/detailwrite_new?product_idx=<?= $product_idx ?>&air_code=0000"
                                               class="btn btn-default">상세내역관리</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr style="height:50px">
                                    <td><?= $i++ ?></td>
                                    <td class="tac">미등록</td>
                                    <td class="tac">미등록</td>
                                    <td>
                                        <a href="/AdmMaster/_tours/detailwrite_new?product_idx=<?= $product_idx ?>&air_code=0000"
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
    </div>
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

        function del_tours(info_idx, tours_idx_array) {
            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
                return false;
            }

            $.ajax({
                url: "/AdmMaster/_tours/del_tours",
                type: "POST",
                data: {
                    "info_idx": info_idx,
                    "tours_idx": tours_idx_array
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    alert(data.message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }


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
                    console.log('Data:', data);
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
            addOption += '		<button type="button" style="height: 25px" onclick="delOption(\'\',this)">삭제</button>	  ';
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
            addOption += '		<button type="button" style="height: 25px" onclick="delOption(\'\',this)">삭제</button>	  ';
            addOption += "	</td>																  ";
            addOption += "</tr>																	  ";

            $("#settingBody_" + code_idx).append(addOption);
        }

        function upd_moption(code_idx) {
            var message = "";
            $.ajax({

                url: "/AdmMaster/_tourRegist/write_tours/updMoption",
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

                url: "/AdmMaster/_tourRegist/write_tours/addMoption",
                type: "POST",
                data: {
                    "product_idx": $("#product_idx").val(),
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

                url: "/AdmMaster/_tourRegist/write_tours/delMoption",
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
                url: "/AdmMaster/_tourRegist/write_tours/addOption",
                cache: false,
                success: function (data) {
                    var message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        }

        // 옵션 삭제 함수
        function delOption(idx, obj) {

            if (!confirm("선택한 옵션을 삭제 하시겠습니까?"))
                return false;

            var message = "";
            $.ajax({

                url: "/AdmMaster/_tourRegist/write_tours/delOption",
                type: "POST",
                data: {
                    "idx": idx
                },
                dataType: "json",
                success: function (data) {
                    if (data && data.message) {
                        alert(data.message);
                    } else {
                        alert("삭제 오류. 다시 시도해주세요.");
                    }
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });

        }


        // 옵션 수정 함수
        function updOption(idx) {

            if (!confirm("선택한 옵션을 수정 하시겠습니까?"))
                return false;

            var message = "";
            $.ajax({

                url: "/AdmMaster/_tourRegist/write_tours/updOption",
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

    <script>
        function productImagePreview(inputFile, onum) {
            if (sizeAndExtCheck(inputFile) == false) {
                inputFile.value = "";
                return false;
            }

            let imageTag = document.querySelector('label[for="tours_ufile' + onum + '"]');

            if (inputFile.files.length > 0) {
                let imageReader = new FileReader();

                imageReader.onload = function () {
                    imageTag.style = "background-image:url(" + imageReader.result + ")";
                    inputFile.closest('.file_input').classList.add('applied');
                    inputFile.closest('.file_input').children[2].value = 'Y';
                }
                return imageReader.readAsDataURL(inputFile.files[0]);
            }
        }

        function productImagePreviewRemove(element) {
            let inputFile = element.parentNode.querySelector('input[type="file"]');
            let labelImg = element.parentNode.querySelector('label');
            let checkImgInput = element.parentNode.querySelector('input[type="hidden"]');

            inputFile.value = "";
            labelImg.style.backgroundImage = "";
            element.closest('.file_input').classList.remove('applied');

            checkImgInput.value = 'N';
        }

        function productImageMainPreview(inputFile, onum) {
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
                    inputFile.closest('.file_input').children[2].value = 'Y';
                }
                return imageReader.readAsDataURL(inputFile.files[0]);
            }
        }

        function productImageMainPreviewRemove(element) {
            let inputFile = element.parentNode.querySelector('input[type="file"]');
            let labelImg = element.parentNode.querySelector('label');
            let checkImgInput = element.parentNode.querySelector('input[type="hidden"]');

            inputFile.value = "";
            labelImg.style.backgroundImage = "";
            element.closest('.file_input').classList.remove('applied');

            checkImgInput.value = 'N';
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
            // oEditors4.getById["mobile_unable"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors3.getById["mobile_able"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors2.getById["product_able"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors5.getById["product_unable"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors6.getById["special_benefit"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors7.getById["special_benefit_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors8.getById["notice_comment"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors9.getById["notice_comment_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors10.getById["etc_comment"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors11.getById["etc_comment_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors12.getById["product_confirm"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors13.getById["product_confirm_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors14.getById["tour_info"].exec("UPDATE_CONTENTS_FIELD", []);


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

            // if ($("#chk_product_code").val() == "N") {
            //     alert("중복된 제품 코드를 확인하세요.");
            //     return;
            // }
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

            let _code_mbtis = '';
            $("input[name=_code_mbti]:checked").each(function () {
                _code_mbtis += $(this).val() + '|';
            })

            $("#mbti").val(_code_mbtis);


            frm.submit();
        }

        function del_it(idx) {


            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            var message = "";
            $.ajax({

                url: "/AdmMaster/_tourRegist/del_product",
                type: "DELETE",
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

    <form id="listForm" action="/AdmMaster/_tourRegist/list_tours">
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

<? // include "../_include/_footer.php"; ?>
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
    </script>
<?= $this->endSection() ?>