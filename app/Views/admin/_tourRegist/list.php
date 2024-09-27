<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>호텔정보 리스트</h2>
                <div class="menus">
                    <ul class="first">
                        <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), true)"
                               class="btn btn-success">전체선택</a></li>
                        <li><a href="javascript:CheckAll(document.getElementsByName('idx[]'), false)"
                               class="btn btn-success">선택해체</a></li>
                        <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                    </ul>

                    <ul class="last">
                        <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                        <li><a href="write" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-pencil"></span> <span class="txt">상품 등록</span></a>
                        </li>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">
            <form name="search" id="search">
                <header id="headerContents">
                    <select id="product_code_1" name="s_product_code_1" class="input_select"
                            onchange="javascript:document.search.submit();">
                        <option value="">1차분류</option>
                        <?php
                        foreach ($fresult as $frow) {
                            $status_txt = "";
                            if ($frow["status"] == "Y") {
                                $status_txt = "";
                            } elseif ($frow["status"] == "N") {
                                $status_txt = "[삭제]";
                            } elseif ($frow["status"] == "C") {
                                $status_txt = "[마감]";
                            }

                            ?>
                            <option value="<?= $frow["code_no"] ?>" <?php if ($s_product_code_1 == $frow["code_no"]) {
                                echo "selected";
                            } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                        <?php } ?>

                    </select>

                    <select id="" name="search_category" class="input_select" style="width:112px">
                        <option value="goods_name_front" <?php if ($search_category == "goods_name_front") {
                            echo "selected";
                        } ?>>상품명
                        </option>
                    </select>


                    <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                           class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px"/>

                    <a href="javascript:search_it()" class="btn btn-default"><span
                                class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                </header><!-- // headerContents -->
            </form>
            <script>
                function search_it() {
                    var frm = document.search;
                    if (frm.search_name.value == "검색어 입력") {
                        frm.search_name.value = "";
                    }
                    frm.submit();
                }
            </script>

            <div class="listWrap">
                <!-- 안내 문구 필요시 구성 //-->


                <div class="listTop">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                    </div>

                </div><!-- // listTop -->


                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable" style="table-layout:fixed;">
                            <caption></caption>
                            <colgroup>
                                <col width="4%"/>
                                <col width="4%"/>
                                <col width="9%"/>
                                <col width="10%"/>
                                <col width="*"/>
                                <col width="11%"/>
                                <col width="7%"/>
                                <col width="5%"/>
                                <col width="10%"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>선택</th>
                                <th>EDIT</th>
                                <th>제품코드</th>
                                <th>이미지</th>
                                <th>제품명</th>
                                <th>판매가격</th>
                                <th>우선순위</th>
                                <th>상태</th>
                                <th>등록일시</th>
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
                            ?>

                            <?php
                            foreach ($result as $row) {
                                // 등록된 정보 체크함
                                if (isset($row['content']) && $row['content'] == "") {
                                    $li_content_yn = "off";
                                } else {
                                    $li_content_yn = "on";
                                }
                                if (isset($row['use_month']) && $row['use_month'] == "") {
                                    $li_use_month_yn = "off";
                                } else {
                                    $li_use_month_yn = "on";
                                }
                                if (isset($row['md_comment']) && $row['md_comment'] == "") {
                                    $li_md_comment_yn = "off";
                                } else {
                                    $li_md_comment_yn = "on";
                                }
                                if (isset($row['goods_make_date']) && $row['goods_make_date'] == "") {
                                    $li_make_date_yn = "off";
                                } else {
                                    $li_make_date_yn = "on";
                                }
                                if (isset($row['goods_keyword']) && $row['goods_keyword'] == "") {
                                    $li_keyword_yn = "off";
                                } else {
                                    $li_keyword_yn = "on";
                                }
                                if (isset($row['item_weight']) && $row['item_weight'] == "") {
                                    $li_weight_yn = "off";
                                } else {
                                    $li_weight_yn = "on";
                                }

                                ?>

                                <tr>
                                    <td><input type="checkbox" name="idx[]" class="idx"
                                               value="<?= $row['product_idx'] ?>"/>
                                    </td>
                                    <td><a href="write?product_idx=<?= $row['product_idx'] ?>"><span
                                                    class="edit_btn">EDIT</span></a></td>
                                    <td>
                                        <p class="categore"><?= isset($row['goods_code']) ? $row['goods_code'] : "" ?></p>
                                        <p class="product_view"><a
                                                    href="#"
                                                    target="_blank">[<span>상품상세</span>]</a></p>
                                    </td>
                                    <td class="images">
                                        <?php if ($row["ufile1"]) {
                                            ?>
                                            <img src="/data/product/<?= $row["ufile1"] ?>" alt="제품 이미지">
                                        <?php } ?>
                                    </td>
                                    <td class="product_name">
                                        <p><strong>상품명</strong> :
                                            <span><?= isset($row['goods_name_front']) ? $row['goods_name_front'] : "" ?></span>
                                        </p>
                                        <!--                                        --><?php
                                        //                                        $product_code = getCodeSlice($row['product_code']);
                                        //                                        $product_code_ar = explode("||", $product_code);
                                        //                                        ?>
                                        <!--                                        <p><strong>상품카테고리</strong> :-->
                                        <!--                                            <span>-->
                                        <?php //= get_cate_text($product_code_ar[0]) ?><!--</span></p>-->


                                    </td>
                                    <td class="price">
                                        <p><strong>최초가</strong> :
                                            <span><?= number_format(isset($row['price_mk']) ? $row['price_mk'] : 0) ?>원</span>
                                        </p>
                                        <p><strong>판매가</strong> :
                                            <span><?= number_format(isset($row['price_se']) ? $row['price_se'] : 0) ?>원</span>
                                        </p>
                                        <p><strong>할인율</strong> :
                                            <span>
                                                <?= round(
                                                    (isset($row['price_mk']) && isset($row['price_se']) && $row['price_mk'] > 0)
                                                        ? (($row['price_mk'] - $row['price_se']) / $row['price_mk'] * 100)
                                                        : 0,
                                                    1
                                                ) ?>%
                                            </span>
                                        </p>

                                    </td>
                                    <td>

                                        <input type="text" name="onum[]" value="<?= $row["onum"] ?>" class="input_txt"
                                               style="width:30px"/>
                                        <input type="hidden" name="g_idx[]" value="<?= $row["product_idx"] ?>"
                                               class="input_txt"/>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($row['item_state'] ?? "") {
                                            case "sale" :
                                                echo "판매중";
                                                break;

                                            case "stop" :
                                                echo "판매중지";
                                                break;

                                            case "plan" :
                                                echo "등록예정";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td class="date">
                                        <ul>
                                            <li><strong>등록 :
                                                    관리자</strong><span><?= substr($row['reg_date'] ?? date("Y-m-d H:i:s"), 0, 16) ?></span>
                                            </li>
                                            <li><strong>수정 :
                                                    관리자</strong><span><?= substr($row['mod_date'] ?? date("Y-m-d H:i:s"), 0, 16) ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>


                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">


                            <ul class="last">
                                <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
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


    function change_it() {
        $.ajax({
            url: "change2.php",
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
                if (response == "OK") {
                    alert_("정상적으로 변경되었습니다.");
                    location.reload();
                    return;
                } else {
                    alert(response);
                    alert_("오류가 발생하였습니다!!");
                    return;
                }
            }
        });
    }

    function SELECT_DELETE() {
        if ($(".idx").is(":checked") == false) {
            alert_("삭제할 내용을 선택하셔야 합니다.");
            return;
        }
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: "hdel.php",
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
                response = response.trim();

                if (response == "OK") {
                    alert_("정상적으로 삭제되었습니다.");
                    location.reload();
                    return;
                } else {
                    alert(response);
                    alert_("오류가 발생하였습니다!!");
                    return;
                }
            }
        });

    }

    function del_it(product_idx) {

        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");
        $.ajax({
            url: "del.php",
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
                if (response == "OK") {
                    alert_("정상적으로 삭제되었습니다.");
                    location.reload();
                    return;
                } else {
                    alert(response);
                    alert_("오류가 발생하였습니다!!");
                    return;
                }
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
<?= $this->endSection() ?>
