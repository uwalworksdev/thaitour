<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script>
    localStorage.removeItem('place');
    localStorage.removeItem('room');
</script>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>호텔 상품관리</h2>
                <div class="menus">
                    <ul class="first">
                    </ul>

                    <ul class="last">
                        <li><a href="javascript:change_it()" class="btn btn-success btn_change">순위변경</a></li>
                        <li><a href="write" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-pencil"></span> <span
                                        class="txt">상품 등록</span></a></li>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">
            <form name="search" id="search">
                <input type="hidden" name="orderBy" id="orderBy" value="<?= $orderBy ?>">
                <input type="hidden" name="pg" id="pg" value="<?= $pg ?>">
                <input type="hidden" name="product_idx" id="product_idx" value="">
                <input type="hidden" name="special_price" id="special_price" value="<?= $special_price ?>">

                <table cellpadding="0" cellspacing="0" summary="" class="listTable01" style="table-layout:fixed;">
                    <colgroup>
                        <col width="150">
                        <col width="*">
                    </colgroup>
                    <thead>
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="label">카테고리</td>
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
                    </tr>

                    <tr>
                        <td class="label">상태</td>
                        <td class="inbox">
                            <p><input name="is_view_y" class="type_chker" id="is_view_y" type="checkbox"
                                      value="Y" <?php if ($is_view_y == "Y") echo "checked"; ?>> <label
                                        for="state_chker_1">사용</label></p>
                            <p><input name="is_view_n" class="type_chker" id="is_view_n" type="checkbox"
                                      value="Y" <?php if ($is_view_n == "Y") echo "checked"; ?>> <label
                                        for="state_chker_2">사용안함</label></p>
                            <p><input name="best" class="type_chker" id="best" type="checkbox"
                                      value="Y" <?php if ($best == "Y") echo "checked"; ?>> <label
                                        for="state_chker_3">베스트</label></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="label">핫한 특가</td>
                        <td class="inbox">
                            <p>
                                <input type="radio" name="special_price" id="special_price_all" value=""
                                    <?= empty($special_price) ? 'checked' : '' ?>> 
                                <label for="special_price_all">전체</label>
                            </p>
                            <p>
                                <input type="radio" name="special_price" id="special_price_y" value="Y"
                                    <?= ($special_price === "Y") ? 'checked' : '' ?>> 
                                <label for="special_price_y">사용</label>
                            </p>
                            <p>
                                <input type="radio" name="special_price" id="special_price_n" value="N"
                                    <?= ($special_price === "N") ? 'checked' : '' ?>> 
                                <label for="special_price_n">사용안함</label>
                            </p>
                        </td>

                    </tr>

                    <tr>
                        <td class="label">검색어</td>
                        <td class="inbox">
                            <div class="r_box">
                                <select id="" name="search_category" class="input_select" style="width:180px">
                                    <option value="product_name" <?php if ($search_category == "product_name") {
                                        echo "selected";
                                    } ?> >
                                        상품명
                                    </option>
                                    <option value="product_air" <?php if ($search_category == "product_air") {
                                        echo "selected";
                                    } ?> >
                                        이용항공
                                    </option>
                                    <option value="phone" <?php if ($search_category == "phone") {
                                        echo "selected";
                                    } ?> >
                                        담당자 전화번호
                                    </option>
                                    <option value="product_code" <?php if ($search_category == "product_code") {
                                        echo "selected";
                                    } ?> >
                                        상품코드
                                    </option>
                                </select>
                                <input type="text" id="search_txt" name="search_txt"
                                       value="<?= $search_txt ?>" class="input_txt placeHolder"
                                       placeholder="검색어 입력" style="width:240px"
                                       onkeydown="if(event.keyCode==13)search_it();">
                                <a href="javascript:search_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-search"></span> <span
                                            class="txt">검색</span></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>

            <script>
                function search_it() {
                    var frm = document.search;
                    if (frm.search_txt.value == "검색어 입력") {
                        frm.search_txt.value = "";
                    }
                    frm.submit();
                }

                $(function () {
                    $.datepicker.regional['ko'] = {
                        showButtonPanel: true,
                        beforeShow: function (input) {
                            setTimeout(function () {
                                var buttonPane = $(input)
                                    .datepicker("widget")
                                    .find(".ui-datepicker-buttonpane");
                                var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                btn.unbind("click").bind("click", function () {
                                    $.datepicker._clearDate(input);
                                });
                                btn.appendTo(buttonPane);
                            }, 1);
                        },
                        closeText: '닫기',
                        prevText: '이전',
                        nextText: '다음',
                        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                        monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                        weekHeader: 'Wk',
                        dateFormat: 'yy-mm-dd',
                        firstDay: 0,
                        isRTL: false,
                        showMonthAfterYear: true,
                        changeMonth: true,
                        changeYear: true,
                        showMonthAfterYear: true,
                        closeText: '닫기',  // 닫기 버튼 패널
                        yearSuffix: ''
                    };
                    $.datepicker.setDefaults($.datepicker.regional['ko']);

                    $(".date_form").datepicker({
                        showButtonPanel: true
                        , beforeShow: function (input) {
                            setTimeout(function () {
                                var buttonPane = $(input)
                                    .datepicker("widget")
                                    .find(".ui-datepicker-buttonpane");
                                var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
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
                function change_it() {
                    let f = document.frm;

                    let url = '<?= route_to("admin._hotel.change") ?>'
                    let prod_data = $(f).serialize();
                    $.ajax({
                        type: "POST",
                        data: prod_data,
                        url: url,
                        cache: false,
                        async: false,
                        success: function (data, textStatus) {
                            let message = data.message;
                            alert(message);
                            window.location.reload();
                        },
                        error: function (request, status, error) {
                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                        }
                    });
                }

            </script>

			<form name="frm" id="frm">
            <div class="listWrap">
                <!-- 안내 문구 필요시 구성 //-->
                <div class="listTop flex_b_c">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                    </div>
                    <div class="right_btn">
                        <button type="button" class="btn_filter" onclick="orderBy_set('1');"><img
                                    src="/images/admin/common/filter.png" alt="">순위순
                        </button>
                        <button type="button" class="btn_filter" onclick="orderBy_set('2');"><img
                                    src="/images/admin/common/filter.png" alt="">최신순
                        </button>
                        <button type="button" class="btn_filter" onclick="orderBy_set('3');"><img
                                    src="/images/admin/common/filter.png" alt="">예약순
                        </button>

						<select id="g_list_rows" name="g_list_rows" class="input_select" style="width: 80px" onchange="submitForm();">
							<option value="30"  <?= ($g_list_rows == 30)  ? 'selected' : '' ?>>30개</option>
							<option value="50"  <?= ($g_list_rows == 50)  ? 'selected' : '' ?>>50개</option>
							<option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
							<option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
						</select>
					</div>

                </div><!-- // listTop -->
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="50px"/>
                                <col width="250px"/>
                                <col width="150px"/>
                                <col width="120px"/>
                                <col width="*"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>메인/상품분류</th>
                                <th>상품코드</th>
                                <th>썸네일이미지</th>
                                <th>타이틀</th>
                                <th>상품담당자</th>
                                <th>판매상태결정</th>
                                <th>가격수정</th>
                                <th>핫한 특가</th>
                                <th>순위</th>
                                <th>등록일</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($nTotalCount == 0) {
                                ?>
                                <tr>
                                    <td colspan=11 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                </tr>
                                <?php
                            }
                            foreach ($result as $row) :
                                ?>
                                <tr style="height:30px" data-idx="<?= $row['product_idx']; ?>">
                                    <td><?= $num-- ?></td>
                                    <td class="tac">
                                        <?php
                                        $_product_code_arr = explode("|", $row['product_code_list']);
                                        $_product_code_arr = array_filter($_product_code_arr);
                                        ?>
                                        <div class="" style="padding: 0 20px">
                                            <?php
                                            foreach ($_product_code_arr as $_tmp_code) {
                                                ?>

                                                <p class="new"><?= get_cate_text($_tmp_code) ?>
                                                </p>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="flex_c_c" style="gap: 10px;">
                                            <a href="/product-hotel/hotel-detail/<?= $row["product_idx"] ?>"
                                               class="product_view" target="_blank">[<span>상품상세</span>]</a>
                                            <a href="write?search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&product_idx=<?= $row["product_idx"] ?>"
                                               class="product_view" style="color: red;">[<span>상세수정</span>]</a>
                                        </div>
                                    </td>
                                    <td class="tac"><?= $row["product_code"] ?></td>
                                    <td class="tac">
                                        <?php
                                        if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $row["ufile1"])) {
                                            $src = "/data/product/" . $row["ufile1"];
                                        } else {
                                            $src = "/data/product/noimg.png";
                                        }
                                        ?>
                                        <a href="<?= $src ?>" class="imgpop">
                                            <img src="<?= $src ?>"
                                                 style="max-width:150px;max-height:100px"></a>
                                    </td>
                                    <td class="tal" style="font-weight:bold">
                                        <a href="write?search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&product_idx=<?= $row["product_idx"] ?>">
                                            <?= viewSQ($row["product_name"]) ?>
                                       

                                    </td>
                                    <td class="tac"><?= $row["product_manager"] ?></td>
                                    <td class="tac">
                                        <select name="product_status[]" id="product_status_<?= $row["product_idx"] ?>">
                                            <option value="sale" <?php if (isset($row["product_status"]) && $row["product_status"] === "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="plan" <?php if (isset($row["product_status"]) && $row["product_status"] === "plan") {
                                                echo "selected";
                                            } ?>>예약중지
                                            </option>
                                            <option value="stop" <?php if (isset($row["product_status"]) && $row["product_status"] === "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                        </select>
                                    </td>
                                    <td class="tac">
                                        <div class=""
                                             style="display: flex; align-items: center; justify-content: center">
                                            <a href="write_price?search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&product_idx=<?= $row["product_idx"] ?>"
                                               class=""
                                               style="color: #fff;background: #4F728A;border: 1px solid #2b3f4c;font-size: 12px; padding: 5px 10px; width: 50px; line-height: initial;">
                                                <span class="txt">수정</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="special_price_show_[]"
                                               onclick="check_sale('<?= $row["product_idx"] ?>')"
                                               id="special_price_show_<?= $row["product_idx"] ?>"
                                            <?= $row["special_price"] == 'Y' ? 'checked' : '' ?>>
                                    </td>
                                    <td>
                                        <input type="text" name="onum[]" id="onum_<?= $row["product_idx"] ?>"
                                               value="<?= $row['onum'] ?>" style="width:66px;">
                                        <input type="hidden" name="product_best[]"
                                               id="product_best_<?= $row["product_idx"] ?>"
                                               value="<?= $row["product_best"] ?>" style="width:66px;">
                                        <input type="hidden" name="special_price[]"
                                               id="special_price_<?= $row["product_idx"] ?>"
                                               value="<?= $row["special_price"] ?>" style="width:66px;">
                                        <input type="hidden" name="code_idx[]" value="<?= $row["product_idx"] ?>"
                                               class="input_txt"/>
                                    </td>
                                    <td>
                                        <?= $row["r_date"] ?>
                                    </td>
                                    <td>
                                        <a href="#!" onclick="prod_update('<?= $row['product_idx'] ?>');"><img
                                                    src="/images/admin/common/ico_setting2.png"></a>&nbsp;
                                        <a href="javascript:del_it('<?= $row['product_idx'] ?>');"><img
                                                    src="/images/admin/common/ico_error.png" alt="삭제"/></a>
                                    </td>
                                </tr>
                                <!-- <tr style="height:45px">
                                    <th style="background:#fafafa;border:1px solid #dddddd;padding:10px 0;font-size:14px;font-weight:bold;color:#464646;text-align:center;">
                                        검색키워드
                                    </th>
                                    <td colspan="9"
                                        style="background:#fafafa;;text-align:left;padding-left:15px;font-weight:bold">
                                        <?= $row["goods_keyword"] ?>
                                    </td>
                                </tr> -->
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_hotel/list') . "?product_code_1=$product_code_1&s_status=$s_status&search_category=$search_category&g_list_rows=$g_list_rows&search_name=$search_name&pg=" . $arrays_paging) ?>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first">
                            </ul>

                            <ul class="last">
                                <li><a href="javascript:change_it()"
                                       class="btn btn-success btn_change">순위변경</a></li>
                                <li><a href="write" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-pencil"></span> <span
                                                class="txt">상품 등록</span></a></li>
                            </ul>

                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->


    </div><!-- 인쇄 영역 끝 //-->
</div><!-- // container -->

<script>
	function submitForm() {
		document.getElementById("frm").submit();
	}
</script>

<script>
    function check_best(idx) {
        if ($("#product_best_best_" + idx).is(":checked")) {
            $("#product_best_" + idx).val('Y');
        } else {
            $("#product_best_" + idx).val('N');

        }
    }

    function check_sale(idx) {
        if ($("#special_price_show_" + idx).is(":checked")) {
            $("#special_price_" + idx).val('Y');
        } else {
            $("#special_price_" + idx).val('N');

        }
    }

    function prod_update(idx) {
        let onum = $("#onum_" + idx).val();
        let product_status = $("#product_status_" + idx).val();

        let is_view = $("#is_view_" + idx).val();

        let url = '/AdmMaster/prod_update/' + idx;

        let product_best;
        if ($("#product_best_best_" + idx).is(":checked")) {
            product_best = "Y";
        } else {
            product_best = "N";
        }

        let special_price = $("#special_price_" + idx).val();

        if (!confirm("선택한 상품의 정보를 변경 하시겠습니까?"))
            return false;

        let message = "";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                "product_idx": idx,
                "product_best": product_best,
                "special_price": special_price,
                "is_view": is_view,
                "product_status": product_status,
                "onum": onum
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data, textStatus) {
                message = data.message;
                alert(message);
                // location.href='/AdmMaster/_tourRegist/list.php?pg='+$("#pg").val();
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    function go_write(idx) {
        $("#product_idx").val(idx);
        $("#search").attr("action", "./write").submit();
    }

    function orderBy_set(seq) {
        $("#orderBy").val(seq);
        search_it();
    }

    function CheckAll(checkBoxes, checked) {
        var i;
        if (checkBoxes.length) {
            for (i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = checked;
            }
        } else {
            checkBoxes.checked = checked;
        }

    }

    function SELECT_DELETE() {
        if ($(".product_idx").is(":checked") == false) {
            alert_("삭제할 내용을 선택하셔야 합니다.");
            return;
        }
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        $("#ajax_loader").removeClass("display-none");

        let url = "<?= route_to("admin._hotel.del") ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: $("#frm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert_("정상적으로 삭제되었습니다.");
                location.reload();
                return;
            }
        });

    }

    function del_it(product_idx) {

        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");

        let url = "<?= route_to("admin._hotel.del") ?>";

        $.ajax({
            url: url,
            type: "POST",
            data: "product_idx[]=" + product_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert_("정상적으로 삭제되었습니다.");
                location.reload();
                return;
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

<?= $this->endSection() ?>
