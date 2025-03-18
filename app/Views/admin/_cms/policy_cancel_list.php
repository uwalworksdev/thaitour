<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2>취소 규정</h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="javascript:CheckAll(document.getElementsByName('p_idx[]'), true)"
                                   class="btn btn-success">전체선택</a></li>
                            <li><a href="javascript:CheckAll(document.getElementsByName('p_idx[]'), false)"
                                   class="btn btn-success">선택해체</a></li>
                            <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                            <li><a href="policy_cancel_write" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">글 등록</span></a></li>
                        </ul>

                        <ul class="last">
                        </ul>

                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">
                <style>
                    div.listBottom table.listTable tbody td:nth-child(5) {
                        text-align: left !important;
                        padding-left: 10px;
                        max-width: 500px;
                        word-wrap: break-word;
                        padding-right: 10px;
                    }

                    div.listBottom table.listTable tbody td:nth-child(5) a {
                        display: -webkit-box;
                        -webkit-line-clamp: 1;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        -webkit-box-orient: vertical;
                    }
                </style>
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
                        <td class="label">검색어</td>
                        <td class="inbox">
                            <div class="r_box">
                                <select id="" name="search_category" class="input_select" style="width:180px">
                                    <option value="product_name" <?php if ($search_category == "product_name") {
                                        echo "selected";
                                    } ?> >
                                        상품명
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
                <div class="listWrap">
                    <!-- 안내 문구 필요시 구성 //-->
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                        </div>

                    </div><!-- // listTop -->
                    <form name="frm" id="frm">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="15%"/>
                                    <col width="*"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>카테고리</th>
                                    <th>상품명</th>
                                    <th>약관명</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan=5 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php
                                }
                                foreach ($result as $row) {
                                    ?>
                                    <tr style="height:50px;">
                                        <td><input type="checkbox" name="p_idx[]" class="p_idx" value="<?= $row['p_idx'] ?>"
                                                   class="input_check"/></a></td>
                                        <td class="tac"><?= $row["product_code_name"] ?> -> <?= $row["product_code_name_2"] ?></td>
                                        <td class="tac"><?= $row['product_name'] ?>
                                        </td>
                                        <td class="tac"><?= $row["r_date"] ?></td>
                                        <td class="td_control">
                                            <div style="display: flex; justify-content: center; gap: 3px">
                                                <a href="policy_cancel_write?p_idx=<?= $row['p_idx'] ?>"><img
                                                            src="/images/admin/common/ico_setting2.png"></a>
                                                <a href="javascript:del_it('<?= $row['p_idx'] ?>');"><img
                                                            src="/images/admin/common/ico_error.png" alt="삭제"/></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>


                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?php echo ipageListing($pg, $nPage, $g_list_rows, $currentUri . "?&search_gubun=$search_gubun&search_category=$search_category&s_txt=$s_txt&pg=") ?>


                    <div id="headerContainer">

                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                    <li><a href="javascript:CheckAll(document.getElementsByName('p_idx[]'), true)"
                                           class="btn btn-success">전체선택</a></li>
                                    <li><a href="javascript:CheckAll(document.getElementsByName('p_idx[]'), false)"
                                           class="btn btn-success">선택해체</a></li>
                                    <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                                </ul>

                                <ul class="last">
                                </ul>

                            </div>

                        </div><!-- // inner -->

                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->

            </div><!-- // contents -->


        </div><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->


    <script>
        $(".input_check").change(function (evt) {
            if ($(evt.target).is(":checked")) {
                $(evt.target).siblings("input[type=text]").val("Y");
            } else {
                $(evt.target).siblings("input[type=text]").val("N");
            }
        })

    </script>


    <script>
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
            if ($(".p_idx").is(":checked") == false) {
                alert("삭제할 내용을 선택하셔야 합니다.");
                return;
            }
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            // $("#ajax_loader")NaNpxoveClass("display-none");



            var selectedValues = [];
            $(".p_idx:checked").each(function () {
                selectedValues.push($(this).val());
            });

            $.ajax({
                url: "/AdmMaster/_cms/delete",
                    type: "POST",
                    data: { p_idx: selectedValues },
                    dataType: "json",
                    error: function (request, status, error) {
                        alert("code : " + request.status + "\nmessage : " + request.responseText);
                    },
                    success: function (response) {
                        if (response.status === "OK") {
                            alert("삭제되었습니다");
                            location.reload();
                        } else {
                            alert("오류가 발생하였습니다!!");
                        }
                    }
            });
        }


        function del_it(p_idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $.ajax({
                url: "/AdmMaster/_cms/delete",
                type: "POST",
                data: "p_idx[]=" + p_idx,
                dataType: "json",
                error: function (request, status, error) {
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , complete: function (request, status, error) {
                }
                , success: function (response) {
                    if (response.status === "OK") {
                            alert("삭제되었습니다");
                            location.reload();
                        } else {
                            alert("오류가 발생하였습니다!!");
                        }
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

    <script>
		function search_it() {
			var frm = document.search;
			if (frm.search_txt.value == "검색어 입력") {
				frm.search_txt.value = "";
			}
			frm.submit();
		}
    </script>

<?= $this->endSection() ?>