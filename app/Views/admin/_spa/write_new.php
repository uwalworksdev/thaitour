<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/admin/popup.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <div id="datepicker"></div>
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

    <style>
        .container_date {
            display: flex; /* 가로 정렬 */
        }
    </style>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>상품요금정보 <?= $titleStr ?> </h2>
                    <div class="menus">
                        <ul>
                            <li><a href="javascript:go_list();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                            </li>
                            <?php if ($yoil_idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li><a href="javascript:del_yoil('<?= $yoil_idx ?>');" class="btn btn-default"><span
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

            <form name="chargeForm" id="chargeForm" method="post">
                <input type=hidden name="query" value='write.php?<?= $_SERVER['QUERY_STRING'] ?>'>
                <input type=hidden name="back_url" value='<?= $back_url ?>'>
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="product_idx" value='<?= $product_idx ?>' id="product_idx">
                <input type=hidden name="yoil_idx" value='<?= $yoil_idx ?>' id='yoil_idx'>
                <input type=hidden name="parent_yoil_idx" value='<?= $parent_yoil_idx ?>'>
                <input type=hidden name="product_code_1" id="product_code_1" value='<?= $product_code_1 ?>'>
                <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
                <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
                <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>
                <input type=hidden name="s_station" value='<?= $s_station ?>' id="s_station">

                <div id="contents">
                    <div class="listWrap_noline">
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
                                    <th>상품명</th>
                                    <td>
                                        <?= $product_name ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>날짜지정</th>
                                    <td>
                                        <div class="container_date" style="margin: 0">
                                            <div id="datepicker1"></div>
                                            <div style="text-align:left;">
                                                시작일:<input type="text" name="s_date" value="<?= $s_date ?>" id="from"
                                                           style="text-align: center;background: white; width: 200px;"
                                                           readonly>
                                            </div>
                                            <div id="datepicker2"></div>
                                            <div style="text-align:left;text-wrap: nowrap; margin-left: 80px;">
                                                종료일:<input type="text" name="e_date" value="<?= $e_date ?>" id="to"
                                                           style="text-align: center; background: white;; width: 200px;"
                                                           readonly>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>예약마감</th>
                                    <td>
                                        <input type="checkbox" name="sale" value="N" <?php if ($sale == "N") {
                                            echo "checked";
                                        } ?> id="sale" class="yoil"> 마감
                                    </td>
                                </tr>

                                <tr style="<?php if ($product_code_1 == "1301") {
                                    echo "display:none";
                                } ?>">
                                    <th>요일선택</th>
                                    <td>
                                        <?php
                                        if ($parent_yoil_idx) {
                                            ?>
                                            <?= $yoilStr ?>
                                            <input type="hidden" name="yoil_0" value="<?= $yoil_0 ?>">
                                            <input type="hidden" name="yoil_1" value="<?= $yoil_1 ?>">
                                            <input type="hidden" name="yoil_2" value="<?= $yoil_2 ?>">
                                            <input type="hidden" name="yoil_3" value="<?= $yoil_3 ?>">
                                            <input type="hidden" name="yoil_4" value="<?= $yoil_4 ?>">
                                            <input type="hidden" name="yoil_5" value="<?= $yoil_5 ?>">
                                            <input type="hidden" name="yoil_6" value="<?= $yoil_6 ?>">
                                        <?php } else { ?>
                                            <input type="checkbox" name="yoil_0" id="yoil_0"
                                                   value="Y" <?php if ($yoil_0 == "Y") {
                                                echo "checked";
                                            } ?> class="yoil"> 일요일&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_1" id="yoil_1"
                                                   value="Y" <?php if ($yoil_1 == "Y") {
                                                echo "checked";
                                            } ?> class="yoil"> 월요일&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_2" id="yoil_2"
                                                   value="Y" <?php if ($yoil_2 == "Y") {
                                                echo "checked";
                                            } ?> class="yoil"> 화요일&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_3" id="yoil_3"
                                                   value="Y" <?php if ($yoil_3 == "Y") {
                                                echo "checked";
                                            } ?> class="yoil"> 수요일&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_4" id="yoil_4"
                                                   value="Y" <?php if ($yoil_4 == "Y") {
                                                echo "checked";
                                            } ?> class="yoil"> 목요일&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_5" id="yoil_5"
                                                   value="Y" <?php if ($yoil_5 == "Y") {
                                                echo "checked";
                                            } ?> class="yoil"> 금요일&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_6" id="yoil_6"
                                                   value="Y" <?php if ($yoil_6 == "Y") {
                                                echo "checked";
                                            } ?> class="yoil"> 토요일&nbsp;&nbsp;&nbsp;
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>요금정보</th>
                                    <td>
                                        <div style="margin:10px">
                                            <a href="#!" id="addcharge" class="btn btn-primary">+추가</a>
                                            <!--a href="javascript:remove_it();" class="btn btn-primary">확인</a-->
                                        </div>
                                        <table style="width:100%" id="chargeTable">
                                            <colgroup>
                                                <col width="*">
                                                <col width="10%">
                                                <col width="10%">
                                                <col width="15%">
                                            </colgroup>
                                            <tbody id="charge">
                                            <tr style="height:40px">
                                                <td style="text-align:center">
                                                    구분(국문/영문)
                                                </td>
                                                <td style="text-align:center">
                                                    대인가격(바트)
                                                    <input type="checkbox" name="" id="adult_price">전체
                                                </td>
                                                <td style="text-align:center">
                                                    소인가격(바트)
                                                    <input type="checkbox" name="" id="kids_price">전체
                                                </td>
                                                <td style="text-align:center">
                                                    처리
                                                </td>
                                            </tr>
                                            <style>
                                                .order_btn {
                                                    cursor: pointer;
                                                    width: 30px;
                                                    height: 30px;
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    border: 1px solid #ccc;
                                                    border-radius: 5px;
                                                }
                                            </style>
                                            <?php
                                            $i = 0;
                                            foreach ($fresult2 as $frow2) {
                                                ?>
                                                <tr style="height:40px">
                                                    <td style="text-align:center">
                                                        <input type="hidden" name="charge_idx[]"
                                                               id="charge_idx_<?= $frow2["charge_idx"] ?>]"
                                                               class="charge_idx" value="<?= $frow2["charge_idx"] ?>">

                                                        <div class="" style="display: flex; gap: 10px">
                                                            <input type="text" name="s_station[]" id="s_station_<?= $frow2["charge_idx"] ?>" value="<?= $frow2["s_station"] ?>" class="s_station input_txt" style="width:80%"/>
                                                            <input type="text" name="s_station_eng[]" id="s_station_eng_<?= $frow2["charge_idx"] ?>" value="<?= $frow2["s_station_eng"] ?>" class="s_station input_txt" style="width:80%"/>
                                                            <a href="#!"
                                                                <?php if ($i !== 0) {
                                                                    echo 'onclick="return positionUP(' . $frow2["charge_idx"] . ',\'U\')"';
                                                                } else {
                                                                    echo 'disabled';
                                                                } ?>
                                                               class="order_btn">▲</a>
                                                            <a href="#!" class="order_btn"
                                                               onclick="return positionUP('<?= $frow2["charge_idx"] ?>','D')">▼</a>
                                                        </div>
                                                    </td>
                                                    <td style="text-align:center">
                                                        <input type="text" name="tour_price[]"
                                                               id="tour_price_<?= $frow2["charge_idx"] ?>"
                                                               value="<?= number_format($frow2["tour_price"]) ?>"
                                                               class="price tour_price input_txt"
                                                               style="text-align:right"/>
                                                    </td>
                                                    <td style="text-align:center">
                                                        <input type="text" name="tour_price_kids[]"
                                                               id="tour_price_kids_<?= $frow2["charge_idx"] ?>"
                                                               value="<?= number_format($frow2["tour_price_kids"]) ?>"
                                                               class="price tour_price_kids input_txt"
                                                               style="text-align:right"/>
                                                    </td>

                                                    <td style="text-align:center;">
                                                        <div class="" style="display: flex; gap: 10px">
                                                            <button style="height: 30px" type="button"
                                                                    class="chargeUpdate"
                                                                    value="<?= $frow2["charge_idx"] ?>">수정
                                                            </button>
                                                            <button style="height: 30px" type="button"
                                                                    class="chargeDelete"
                                                                    value="<?= $frow2["charge_idx"] ?>">삭제
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                </tbody>

                            </table>
                        </div>
                        <!-- // listBottom -->

                        <script>
                            // async function positionUP(id, flag) {
                            //
                            //     let myPromise = new Promise(function (myResolve) {
                            //         $("#ajax_loader").removeClass("display-none");
                            //         myResolve();
                            //     });
                            //
                            //     myPromise.then(
                            //         function (value) {
                            //             handlePositionUp(id, flag);
                            //         },
                            //     );
                            // }

                            function positionUP(id, flag) {
                                $("#ajax_loader").removeClass("display-none");
                                let uri = `<?= route_to('admin.api.spa_.station_seq')?>`;

                                if (id == "") return false;
                                if (flag == "") return false;

                                var message = "";
                                $.ajax({

                                    url: uri,
                                    type: "POST",
                                    data: {
                                        "id": id,
                                        "flag": flag,
                                        "product_idx": $("#product_idx").val(),
                                        "yoil_idx": $("#yoil_idx").val()
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
                                        $("#ajax_loader").addClass("display-none");
                                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                    }
                                });
                            }
                        </script>

                        <script>
                            $('#adult_price').on('click', function () {
                                if ($(this).is(':checked')) {
                                    var tour_price = $('input[name="tour_price[]"]').first().val();
                                    $('.tour_price').val(tour_price);
                                    //} else {
                                    //	location.reload();
                                }
                            });

                            $('#kids_price').on('click', function () {
                                if ($(this).is(':checked')) {
                                    var tour_price_kids = $('input[name="tour_price_kids[]"]').first().val();
                                    $('.tour_price_kids').val(tour_price_kids);
                                    //} else {
                                    //	location.reload();
                                }
                            });

                            $('#senior_price').on('click', function () {
                                if ($(this).is(':checked')) {
                                    var tour_price_senior = $('input[name="tour_price_senior[]"]').first().val();
                                    $('.tour_price_senior').val(tour_price_senior);
                                    //} else {
                                    //	location.reload();
                                }
                            });
                        </script>

                        <script>
                            function search_it() {
                                var frm = document.search;
                                if (frm.search_name.value == "검색어 입력") {
                                    frm.search_name.value = "";
                                }
                                frm.submit();
                            }

                            $(function () {

                                $("#s_date").datepicker({
                                    showButtonPanel: true
                                    , onClose: function (selectedDate) {
                                        // To 날짜 선택기의 최소 날짜를 설정
                                        $("#e_date").datepicker("option", "minDate", selectedDate);
                                    }
                                    , beforeShow: function (input) {
                                        setTimeout(function () {
                                            var buttonPane = $(input)
                                                .datepicker("widget")
                                                .find(".ui-datepicker-buttonpane");
                                            //var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                            btn.unbind("click").bind("click", function () {
                                                $.datepicker._clearDate(input);
                                            });
                                            btn.appendTo(buttonPane);
                                        }, 1);
                                    }
                                    , dateFormat: 'yy-mm-dd'
                                    , showOn: "both"
                                    , yearRange: "c:c+10"
                                    , buttonImage: "/images/admin/common/date.png"
                                    , buttonImageOnly: true
                                    , closeText: '닫기'
                                    , currentText: '오늘' // 오늘 버튼 텍스트 설정
                                    , prevText: '이전'
                                    , nextText: '다음'

                                });


                                $("#e_date").datepicker({
                                    showButtonPanel: true
                                    , onClose: function (selectedDate) {
                                        // To 날짜 선택기의 최소 날짜를 설정
                                        $("#s_date").datepicker("option", "maxDate", selectedDate);
                                    }
                                    , beforeShow: function (input) {
                                        setTimeout(function () {
                                            var buttonPane = $(input)
                                                .datepicker("widget")
                                                .find(".ui-datepicker-buttonpane");
                                            //var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                            btn.unbind("click").bind("click", function () {
                                                $.datepicker._clearDate(input);
                                            });
                                            btn.appendTo(buttonPane);
                                        }, 1);
                                    }
                                    , dateFormat: 'yy-mm-dd'
                                    , showOn: "both"
                                    , yearRange: "c:c+30"
                                    , buttonImage: "/images/admin/common/date.png"
                                    , buttonImageOnly: true
                                    , closeText: '닫기'
                                    , currentText: '오늘' // 오늘 버튼 텍스트 설정
                                    , prevText: '이전'
                                    , nextText: '다음'


                                });


                                $("#from").datepicker({
                                    showButtonPanel: true
                                    , onClose: function (selectedDate) {
                                        // To 날짜 선택기의 최소 날짜를 설정
                                        $("#to").datepicker("option", "minDate", selectedDate);
                                    }
                                    , beforeShow: function (input) {
                                        setTimeout(function () {
                                            var buttonPane = $(input)
                                                .datepicker("widget")
                                                .find(".ui-datepicker-buttonpane");
                                            //var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                            btn.unbind("click").bind("click", function () {
                                                $.datepicker._clearDate(input);
                                            });
                                            btn.appendTo(buttonPane);
                                        }, 1);
                                    }
                                    , dateFormat: 'yy-mm-dd'
                                    , showOn: "both"
                                    , yearRange: "c:c+30"
                                    , buttonImage: "/images/admin/common/date.png"
                                    , buttonImageOnly: true
                                    , closeText: '닫기'
                                    , currentText: '오늘' // 오늘 버튼 텍스트 설정
                                    , prevText: '이전'
                                    , nextText: '다음'

                                });


                                $("#to").datepicker({
                                    showButtonPanel: true
                                    , onClose: function (selectedDate) {
                                        // To 날짜 선택기의 최소 날짜를 설정
                                        $("#from").datepicker("option", "maxDate", selectedDate);
                                    }
                                    , beforeShow: function (input) {
                                        setTimeout(function () {
                                            var buttonPane = $(input)
                                                .datepicker("widget")
                                                .find(".ui-datepicker-buttonpane");
                                            //var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                            btn.unbind("click").bind("click", function () {
                                                $.datepicker._clearDate(input);
                                            });
                                            btn.appendTo(buttonPane);
                                        }, 1);
                                    }
                                    , dateFormat: 'yy-mm-dd'
                                    , showOn: "both"
                                    , yearRange: "c-100:c+10"
                                    , buttonImage: "/images/admin/common/date.png"
                                    , buttonImageOnly: true
                                    , closeText: '닫기'
                                    , currentText: '오늘' // 오늘 버튼 텍스트 설정
                                    , prevText: '이전'
                                    , nextText: '다음'


                                });
                            });
                            $(".contact_btn_box .contact_btn").click(function () {
                                resetClass();
                                $(this).addClass("active");


                                var date1 = $(this).attr("rel");
                                var date2 = $.datepicker.formatDate('yy-mm-dd', new Date());

                                $("#s_date").val(date1);
                                $("#e_date").val(date2);

                            });

                            function resetClass() {
                                $(".contact_btn_box .contact_btn").each(function () {
                                    $(this).removeClass("active");
                                });
                            }
                        </script>

                        <script>
                            $(document).ready(function () {
                                // 차량정보 확인버튼 클릭 이벤트
                                $(".chargeUpdate").click(function () {
                                    $("#ajax_loader").removeClass("display-none");
                                    let uri = '<?= route_to('admin.api.spa_.charge_update') ?>';

                                    if (!confirm("가격정보를 수정 하시겠습니까?")) {
                                        $("#ajax_loader").addClass("display-none");
                                        return false;
                                    }

                                    let idx = $(this).val();
                                    let message = "";
                                    $.ajax({
                                        url: uri,
                                        type: "POST",
                                        data: {
                                            "charge_idx": idx,
                                            "s_station": $("#s_station_" + idx).val(),
                                            "tour_price": $("#tour_price_" + idx).val().replaceAll(',', ''),
                                            "tour_price_kids": $("#tour_price_kids_" + idx).val().replaceAll(',', ''),
                                            "tour_price_senior": 0
                                        },
                                        dataType: "json",
                                        async: false,
                                        cache: false,
                                        success: function (data, textStatus) {
                                            message = data.message;
                                            alert(message);
                                            $("#ajax_loader").addClass("display-none");
                                        },
                                        error: function (request, status, error) {
                                            $("#ajax_loader").addClass("display-none");
                                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                        }
                                    });
                                });

                                // 차량정보 삭제버튼 클릭 이벤트
                                $(".chargeDelete").click(function () {
                                    $("#ajax_loader").removeClass("display-none");
                                    let uri = '<?= route_to('admin.api.spa_.charge_delete') ?>';

                                    if (!confirm("가격정보를 삭제 하시겠습니까?")) {
                                        $("#ajax_loader").addClass("display-none");
                                        return false;
                                    }

                                    $(this).closest('tr').remove();

                                    let idx = $(this).val();
                                    let message = "";
                                    $.ajax({

                                        url: uri,
                                        type: "POST",
                                        data: {
                                            "charge_idx": idx
                                        },
                                        dataType: "json",
                                        async: false,
                                        cache: false,
                                        success: function (data, textStatus) {
                                            message = data.message;
                                            $("#ajax_loader").addClass("display-none");
                                        },
                                        error: function (request, status, error) {
                                            $("#ajax_loader").addClass("display-none");
                                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                        }
                                    });
                                });

                                // Select 요소에서 값이 변경될 때마다 호출되는 함수
                                $('.unique-select').on('change', function () {
                                    var selectedValues = [];
                                    var isValid = true;

                                    // 모든 선택된 값 수집
                                    $('.unique-select').each(function () {
                                        var value = $(this).val();
                                        if (value && selectedValues.includes(value)) {
                                            isValid = false;
                                            $(this).val("");
                                            alert('출발지 중복선택 입니다');
                                            location.reload();
                                            return false;

                                        } else {
                                            // 상품에 지정된 역검증
                                            if ($("#s_station").val().indexOf(value) == -1) {  // 상품에 지정한 역이 없을 경우
                                                //if(value == "청주역") {
                                                isValid = false;
                                                $(this).val("");
                                                alert('지정되지않은 출발역 입니다');
                                                location.reload();
                                                return false;
                                            }
                                        }
                                        selectedValues.push(value);
                                    });
                                });

                                // 요금정보 추가 버튼 클릭 이벤트
                                $('#addcharge').click(function () {
                                    $("#ajax_loader").removeClass("display-none");
                                    let uri = `<?= route_to('admin.api.spa_.charge_dummy') ?>`;

                                    let message = "";
                                    $.ajax({
                                        url: uri,
                                        type: "POST",
                                        data: {
                                            "product_idx": $("#product_idx").val(),
                                            "yoil_idx": $("#yoil_idx").val()
                                        },
                                        success: function (rs) {
                                            location.reload();
                                        },
                                        error: function (request, status, error) {
                                            $("#ajax_loader").addClass("display-none");
                                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                        }
                                    });

                                });

                                // 동적으로 추가된 행에서도 제거 기능이 작동하도록 이벤트 위임 사용
                                $('#chargeTable').on('click', '.chargeRemove', function () {
                                    $(this).closest('tr').remove();
                                });
                            });

                            function convertNUmber(num) {
                                return num.toLocaleString();
                            }
                        </script>

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
                            });

                            $('.deadline_date').on('cancel.daterangepicker', function () {
                                $(this).remove();
                            });

                            $("#btn_add_date_range").click(function () {
                                const new_date_range = $(`<input type="text" class="deadline_date" name="deadline_date[]" style="width: 200px;" readonly >`);
                                $(this).before(new_date_range);
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

                            function remove_it() {
                                var cnt = parseInt($(".air_list_1").length);
                                if (cnt > 1) {
                                    $(".air_list_1:eq(" + (parseInt(cnt) - 1) + ")").remove();
                                    $(".air_list_2:eq(" + (parseInt(cnt) - 1) + ")").remove();
                                }
                            }

                            $(window).load(function () {
                                $("#datepicker1").datepicker("setDate", '<?=$s_date?>');
                                $("#datepicker2").datepicker("setDate", '<?=$e_date?>');

                                <?php
                                if ($parent_yoil_idx) {
                                ?>
                                $("#datepicker1").datepicker("option", "minDate", "<?=$min_date?>");
                                $("#datepicker1").datepicker("option", "maxDate", "<?=$max_date?>");
                                $("#datepicker2").datepicker("option", "minDate", "<?=$min_date?>");
                                $("#datepicker2").datepicker("option", "maxDate", "<?=$max_date?>");
                                <?php } ?>

                            });
                        </script>

                        <script>
                            // 동적으로 추가된 input 요소에 콤마 적용 - 이벤트 위임 사용
                            $(document).on('input', '.input_txt', function () {
                                var value = $(this).val().replace(/,/g, ''); // 기존 콤마 제거

                                if (!isNaN(value) && value !== '') {  // 숫자인 경우에만 처리
                                    var formattedValue = Number(value).toLocaleString('en');  // 콤마 추가
                                    $(this).val(formattedValue);  // 값 업데이트
                                }
                            });
                        </script>

                        <div class="tail_menu">
                            <ul>
                                <li class="left"></li>
                                <li class="right_sub">

                                    <a href="javascript:go_list();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                                    <?php if ($yoil_idx == "") { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">등록</span></a>
                                    <?php } else { ?>
                                        <a href="javascript:send_it()" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span
                                                    class="txt">수정</span></a>
                                        <a href="javascript:del_yoil('<?= $yoil_idx ?>');" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- // listWrap -->
                </div>
                <!-- // contents -->
            </form>
        </div><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->

    <script>
        function go_list() {
            window.location.href = "/AdmMaster/_tourRegist/write_spas?s_product_code_1=&s_product_code_2=&s_product_code_2=&search_category=&search_name=&pg=<?= $pg ?>&product_idx=<?= $product_idx ?>";
        }
    </script>

    <script>
        $(".air_code_1").on("change", function () {
            const $this = $(this);
            $.ajax({
                url: "./air_info.ajax.php",
                type: "POST",
                data: {code_no: $(this).val()},
                dataType: "JSON",
                success: function (res) {
                    $($this).closest("tr").find(".oil_price").val(res?.init_oil_price || 0);
                }
            })
        })

        function send_it() {
            upd_price('<?= $yoil_idx ?>');
        }


        function upd_price(p_idx) {
            $("#ajax_loader").removeClass("display-none");
            let url = `<?= route_to('admin.api.spa_.save_option_price') ?>`;

            // let formData = $("#chargeForm").serialize();
            const formData = new FormData($('#chargeForm')[0]);

            let d_start = $("#from").val();
            let d_end = $("#to").val();

            let sale = $("#sale").is(":checked") ? "N" : "Y";

            let yoil_0 = $("#yoil_0").is(":checked") ? "Y" : "N";
            let yoil_1 = $("#yoil_1").is(":checked") ? "Y" : "N";
            let yoil_2 = $("#yoil_2").is(":checked") ? "Y" : "N";
            let yoil_3 = $("#yoil_3").is(":checked") ? "Y" : "N";
            let yoil_4 = $("#yoil_4").is(":checked") ? "Y" : "N";
            let yoil_5 = $("#yoil_5").is(":checked") ? "Y" : "N";
            let yoil_6 = $("#yoil_6").is(":checked") ? "Y" : "N";

            //let data = {
            //    "p_idx": p_idx,
            //    "product_idx": '<?php //= $product_idx ?>//',
            //    "s_date": d_start,
            //    "e_date": d_end,
            //    "sale": sale,
            //    "yoil_0": yoil_0,
            //    "yoil_1": yoil_1,
            //    "yoil_2": yoil_2,
            //    "yoil_3": yoil_3,
            //    "yoil_4": yoil_4,
            //    "yoil_5": yoil_5,
            //    "yoil_6": yoil_6
            //};

            formData.append("p_idx", p_idx);
            formData.append("product_idx", '<?= $product_idx ?>');
            formData.append("s_date", d_start);
            formData.append("e_date", d_end);
            formData.append("sale", sale);
            formData.append("yoil_0", yoil_0);
            formData.append("yoil_1", yoil_1);
            formData.append("yoil_2", yoil_2);
            formData.append("yoil_3", yoil_3);
            formData.append("yoil_4", yoil_4);
            formData.append("yoil_5", yoil_5);
            formData.append("yoil_6", yoil_6);

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data, textStatus) {
                    let message = data.message;
                    alert(message);
                    $("#ajax_loader").addClass("display-none");
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    $("#ajax_loader").addClass("display-none");
                }

            });
        }

        function del_it() {
            if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                hiddenFrame.location.href = "del.php?product_idx[]=<?=$product_idx?>&mode=view";
            }

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

        function del_yoil(p_idx) {
            $("#ajax_loader").removeClass("display-none");
            if (!confirm("정말로 삭제하시겠습니까?\n\n한 번 삭제되면 데이터를 복구할 수 없습니다.\n\n")) {
                $("#ajax_loader").addClass("display-none");
                return false;
            }

            let url = `<?= route_to('admin.api.spa_.del_option_price') ?>`;

            let data = {
                "p_idx": p_idx,
            };

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    let message = data.message;
                    alert(message);
                    window.history.back();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    $("#ajax_loader").addClass("display-none");
                }

            });
        }

        $(document).ready(function () {
            // 폼 제출 시 AJAX 요청 보내기
            $('#chargeForm').on('submit', function (event) {
                event.preventDefault(); // 폼의 기본 동작(페이지 새로고침) 방지

                $.ajax({
                    url: 'write_ok.php',  // 데이터를 전송할 서버의 URL
                    type: 'POST',  // HTTP 요청 방식
                    data: $(this).serialize(),  // 폼 데이터를 직렬화하여 전송
                    success: function (rs) {  // 요청 성공 시 실행되는 함수
                        const data = JSON.parse(rs);
                        var message = data.message;
                        var url = data.url;
                        alert(message);
                        //location.href='url';
                    },
                    error: function (xhr, status, error) {  // 요청 실패 시 실행되는 함수
                        $('#response').html('<p>오류가 발생했습니다. 다시 시도해 주세요.</p>');
                    }
                });
            });
        });
    </script>

    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>