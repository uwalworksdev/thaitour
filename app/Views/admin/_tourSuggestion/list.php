<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/AdmMaster/_common/css/popup.css" type="text/css"/>

<div id="container" class="item_manage">
    <div id="print_this">
        <!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2>추천상품 관리</h2>
            </div><!-- // inner -->
        </header><!-- // headerContainer -->

        <div id="contents" class="">
            <div class="listWrap_noline">
                <form name="frm" id="frm" action="./list.php" method="post">
                    <input type="hidden" name="code" id="code" value="<?= $code ?>">
                    <input type="hidden" name="table" id="table" value="tbl_goods">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <caption></caption>
                            <colgroup>
                                <col width="150px">
                                <col width="*">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>노출분류</th>
                                <td>
                                    <div class="sel_wrap">
                                        <div class="sel_box">
                                            <select name="code" id="code" class="main_category"
                                                    onchange="area_sel(this.value);">
                                                <option value="">카테고리 선택</option>
                                                <?php
                                                foreach ($result as $row) {
                                                    ?>
                                                    <option value="<?= $row['code_no'] ?>" <?php if ($code == $row['code_no']) echo "selected"; ?> ><?= $row['code_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th> 상품 등록</th>
                                <td colspan="3">
                                    <div class="list_up">
                                        <div>
                                            <button type="button" class="btn btn-default val03">상품등록</button>
                                        </div>
                                    </div>
                                    <table id="pick_select_layer">
                                        <colgroup>
                                            <!--col style="width: 80px"-->
                                            <col style="width: auto">
                                            <col style="width: 160px">
                                            <col style="width: 100px">
                                            <col style="width: 100px">


                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <!--th></th-->
                                            <th>상품명</th>
                                            <th>상품코드</th>
                                            <th>우선순위</th>
                                            <th>삭제</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($result2 as $row) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $row['product_name'] ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <?= $row['product_code'] ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <a href="#!" class="order_btn"
                                                       onclick="return positionUP('<?= $code ?>','<?= $row['code_idx']; ?>','U')">▲</a>
                                                    <a href="#!" class="order_btn"
                                                       onclick="return positionUP('<?= $code ?>','<?= $row['code_idx']; ?>','D')">▼</a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger"
                                                            onclick="javascript:goods_del('<?= $row['code_idx'] ?>');">
                                                        삭제
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>

                            <script>
                                function area_sel(area) {
                                    $("#area").val(area);
                                    $("#frm").submit();
                                }
                            </script>

                            <script>
                                function positionUP(code, id, flag) {

                                    if (code == "") return false;
                                    if (id == "") return false;
                                    if (flag == "") return false;

                                    //alert(code+' - '+id+' - '+flag);
                                    var message = "";
                                    $.ajax({

                                        url: "./ajax.seq_upd1.php",
                                        type: "POST",
                                        data: {
                                            "code": code,
                                            "id": id,
                                            "flag": flag
                                        },
                                        dataType: "json",
                                        async: false,
                                        cache: false,
                                        success: function (data, textStatus) {
                                            message = data.message;
                                            if (message == "OK") {
                                                location.reload();
                                            } else {
                                                alert(data);
                                            }

                                        },
                                        error: function (request, status, error) {
                                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                        }
                                    });
                                }

                                function select_del() {
                                    if (!confirm("선택한 상품을 정말 삭제하시겠습니까?"))
                                        return false;

                                    var chkIdx = "";
                                    $(".select_idx").each(function () {

                                        if ($(this).prop("checked")) {
                                            chkIdx += "|" + $(this).val() + "|";
                                        }

                                    });

                                    if (chkIdx == "") {
                                        alert('삭제할 상품을 선택하세요.');
                                        return false;
                                    }


                                    var message = "";
                                    $.ajax({

                                        url: "ajax.goods_alldel.php",
                                        type: "POST",
                                        data: {
                                            "chkIdx": chkIdx
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

                                function goods_del(idx) {
                                    if (!confirm("선택한 상품을 정말 삭제하시겠습니까?"))
                                        return false;

                                    var message = "";
                                    $.ajax({

                                        url: "./ajax.product_del.php",
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
                            </script>

                            <script>
                                // item_layer_select_all item_layer_unselect_all item_layer_del_each
                                function item_layer_select_all() {
                                    $(".select_idx").each(function () {
                                        $(this).prop("checked", true);
                                    });
                                }

                                function item_layer_unselect_all() {
                                    $(".select_idx").each(function () {
                                        $(this).prop("checked", false);
                                    });
                                }

                                function item_layer_del_each() {
                                    var idx_val = "";
                                    $(".select_item").each(function () {
                                        if ($(this).is(":checked")) {
                                            idx_val += $(this).val() + ',';
                                        }
                                    });
                                    alert('idx_val- ' + idx_val);

                                    if (!confirm("선택한 상품을 정말 삭제하시겠습니까?"))
                                        return false;

                                    var message = "";
                                    $.ajax({

                                        url: "ajax.goods_alldel.php",
                                        type: "POST",
                                        data: {
                                            "idx_val": idx_val
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


                                function item_layer_onum_update() {

                                    var main_category = $("#main_category").val();
                                    var goods_category = $("#goods_category").val();

                                    var idx_val = "";
                                    var idx = "";
                                    var onum = "";
                                    $(".select_item").each(function () {
                                        idx = $(this).val();
                                        onum = $("#onum_" + idx).val();
                                        idx_val += idx + ',' + onum + '|';
                                    });

                                    //alert('idx_val- '+idx_val);
                                    if (!confirm("선택한 상품의 순위를 변경하시겠습니까?"))
                                        return false;

                                    var message = "";
                                    $.ajax({

                                        url: "ajax.goods_onum_update.php",
                                        type: "POST",
                                        data: {
                                            "idx_val": idx_val
                                        },
                                        dataType: "json",
                                        async: false,
                                        cache: false,
                                        success: function (data, textStatus) {
                                            message = data.message;
                                            alert(message);
                                            //$("#main_category").val(main_category).prop("selected", true);
                                            //$("#goods_category").val(goods_category).prop("selected", true);
                                            sub_sel();
                                        },
                                        error: function (request, status, error) {
                                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                        }

                                    });


                                }

                                function item_layer_del(g_idx) {
                                    $("#item_" + g_idx).prop("checked", false);
                                    $("#pick_select_onum_" + g_idx).attr("disabled", true);
                                    $("#item_layer_" + g_idx).hide();
                                }
                            </script>

                            </tbody>
                        </table>
                    </div>
                </form>

            </div><!-- // contents -->
            <div class="pick_item_pop02" id="item_pop" style="display:none;">
                <div>
                    <h2>메인노출상품 등록</h2>
                    <div class="search_box">

                        <form name="pick_item_search" id="pick_item_search" onsubmit="return false;">
                            <input type="hidden" name="upd_code" id="upd_code" value="<?= $code ?>">
                            <select id="product_code_1" name="product_code_1" class="input_select"
                                    onchange="javascript:get_code(this.value, 3)">
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
                                    <option value="<?= $frow["code_no"] ?>" <?php if (isset($row["product_code_1"]) && $row["product_code_1"] == $frow["code_no"]) {
                                        echo "selected";
                                    } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                <?php } ?>

                            </select>
                            <select id="product_code_2" name="product_code_2" class="input_select"
                                    onchange="javascript:get_code(this.value, 4)">
                                <option value="">2차분류</option>
                                <?php
                                foreach ($fresult2 as $frow) {
                                    $status_txt = "";
                                    if ($frow["status"] == "Y") {
                                        $status_txt = "";
                                    } elseif ($frow["status"] == "N") {
                                        $status_txt = "[삭제]";
                                    } elseif ($frow["status"] == "C") {
                                        $status_txt = "[마감]";
                                    }

                                    ?>
                                    <option value="<?= $frow["code_no"] ?>" <?php if ($row["product_code_2"] == $frow["code_no"]) {
                                        echo "selected";
                                    } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                <?php } ?>
                            </select>
                            <select id="product_code_3" name="product_code_3" class="input_select">
                                <option value="">3차분류</option>
                                <?php
                                foreach ($fresult3 as $frow) {
                                    $status_txt = "";
                                    if ($frow["status"] == "Y") {
                                        $status_txt = "";
                                    } elseif ($frow["status"] == "N") {
                                        $status_txt = "[삭제]";
                                    } elseif ($frow["status"] == "C") {
                                        $status_txt = "[마감]";
                                    }

                                    ?>
                                    <option value="<?= $frow["code_no"] ?>" <?php if ($row["product_code_3"] == $frow["code_no"]) {
                                        echo "selected";
                                    } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                <?php } ?>
                            </select>
                            <select id="search_category" name="search_category" class="input_select"
                                    style="width:112px">
                                <option value="product_name">상품명</option>
                                <option value="product_code">상품코드</option>
                            </select>
                            <input type="text" id="search_txt" onkeyup="press_it()" name="search_txt" value=""
                                   class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px">
                            <a href="javascript:search_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                        </form>
                    </div>
                    <div class="table_box">
                        <form method="post" name="select_pick_frm" id="select_pick_frm">
                            <input type="hidden" name="isrt_code" id="isrt_code" value="<?= $code ?>">
                            <table>
                                <caption>상품찾기</caption>
                                <colgroup>
                                    <col style="width: 5%;">
                                    <col>
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>상품명</th>
                                    <th>코드</th>
                                </tr>
                                </thead>
                                <tbody id="id_contents">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="sel_box">
                        <button type="button" class="close">닫기</button>
                        <button type="button" class="select_all">전체선택</button>
                        <button type="button" onclick="fn_pick_update();" class="search">등록</button>
                    </div>
                </div>
            </div>
        </div><!-- 인쇄 영역 끝 //-->
    </div>
</div>


<script>
    let first_select_all = true;
    $(".select_all").click(function () {
        if ($("#select_pick_frm .idx").is(":checked") && !first_select_all) {
            $("#select_pick_frm .idx").prop('checked', false);
            $(this).text("전체선택")
        } else {
            $("#select_pick_frm .idx").prop('checked', true);
            $(this).text("선택해체")
        }
        first_select_all = false;
    })

    function get_code(strs, depth) {
        $.ajax({
            type: "GET"
            , url: "/AdmMaster/_tourRegist/get_code.ajax.php"
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
    $(function () {

        $('.list_up .btn-default').on('click', function () {
            //$("#pick_select_layer tbody").html('');

            let code = $("#code").val();
            var inq_sw = "fst";
            const product_code_no = '<?=$product_code_no?>';

            $.ajax({

                url: "./goods_find.php",
                type: "POST",
                data: {
                    "code_no": code,
                    "inq_sw": inq_sw
                },
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {

                }
                , success: function (response, status, request) {
                    if (product_code_no) {
                        $("#pick_item_search").html(`
							<h1><?=$product_code_name?></h1>
						`);
                    }
                    $("#id_contents").empty();
                    $("#id_contents").append(response);
                    $('.pick_item_pop02').show();


                }
            });


        })


        $('.pick_item_pop02 .sel_box .close').on('click', function () {
            $('.pick_item_pop02').hide()
        })

    });


    function fn_pick_update() {

        var f = document.select_pick_frm;

        var pick_data = $(f).serialize();
        var save_result = "";
        $.ajax({
            type: "POST",
            data: pick_data,
            url: "./main_update.ajax.php",
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

    function fn_pick_select() {

        if ($(".idx").is(":checked") == false) {
            alert("상품을 선택해 주세요.");
            return;
        }


        $.ajax({

            url: "./pick_select.ajax.php",
            type: "POST",
            dataType: "html",
            data: $("#select_pick_frm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , complete: function (request, status, error) {
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                let tmpHtml = $("#pick_select_layer tbody").html();
                tmpHtml += response;
                $("#pick_select_layer tbody").html(tmpHtml);
                $("#item_pop").hide();

            }
        });

    }

    function press_it() {
        if (event.keyCode == 13) {
            search_it();
        }
    }

    function search_it() {


        let code = $("#code_").val();
        let product_code_1 = $("#product_code_1").val();
        let product_code_2 = $("#product_code_2").val();
        let product_code_3 = $("#product_code_3").val();
        let search_category = $("#search_category").val();
        let search_txt = $("#search_txt").val();

        $.ajax({

            url: "./item_allfind.php",
            type: "POST",
            data: {
                "code": code,
                "product_code_1": product_code_1,
                "product_code_2": product_code_2,
                "product_code_3": product_code_3,
                "search_category": search_category,
                "search_txt": search_txt,

            },
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , complete: function (request, status, error) {

            }
            , success: function (response, status, request) {

                $("#id_contents").empty();
                $("#id_contents").append(response);
                $('.pick_item_pop02').show();
            }
        });
    }

    function send_it() {

        var frm = document.frm;

        if ($(".select_item").length > 12) {
            //	alert_("카테고리별 12개까지만 MD Pick 상품 등록이 가능 합니다.");
            //	return;
        }

        //$("#ajax_loader").removeClass("display-none");
        $("#frm").submit();

    }

    $(function () {

        $("#goods_category").on('change', function () {

            let main_category = $("#main_category").val();
            let goods_category = $("#goods_category").val();

            $.ajax({

                url: "./goods_list.php",
                type: "POST",
                data: {
                    "main_category": main_category,
                    "goods_category": goods_category

                },
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {

                }
                , success: function (response, status, request) {

                    $("#pick_select_layer tbody").empty();
                    $("#pick_select_layer tbody").html(response);
                }
            });

        });

    });
</script>

<script>
    function sub_sel(code) {

        /*
                let main_category   = $("#main_category").val();
                let goods_category  = $("#goods_category").val();

                $.ajax({

                    url: "./goods_list.php",
                    type: "POST",
                    data: {
                        "main_category"  : main_category,
                        "goods_category" : goods_category

                    },
                    error : function(request, status, error) {
                     //통신 에러 발생시 처리
                        alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        $("#ajax_loader").addClass("display-none");
                    }
                    ,complete: function(request, status, error) {

                    }
                    , success : function(response, status, request) {
                        $("#pick_select_layer tbody").empty();
                        $("#pick_select_layer tbody").html(response);
                    }
                });
        */
        let main_category = $("#main_category").val();
        let goods_category = $("#goods_category").val();

        document.location = "./item_management.php?category=" + main_category + "&scate=" + goods_category;


    }
</script>

<?= $this->endSection() ?>
