<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

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
                <input type="hidden" name="idx" id="idx" value="">

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
                            <td class="label">추천 여행지</td>
                            <td>
                                <select id="city_code" name="city_code" class="input_select"
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
                                        <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $city_code) {
                                                                                    echo "selected";
                                                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                    <?php endforeach; ?>

                                </select>
                                <select id="town_code" name="town_code" class="input_select">
                                    <option value="">2차분류</option> 
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">추천여행 카테고리</td>
                            <td>
                                <select id="category_code" name="category_code" class="input_select"
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
                                        <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $category_code) {
                                                                                    echo "selected";
                                                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                    <?php endforeach; ?>

                                </select>
                                <select id="subcategory_code" name="subcategory_code" class="input_select">
                                    <option value="">2차분류</option> 
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
                                                                        } ?>>
                                            상품명
                                        </option>
                                    </select>
                                    <input type="text" id="search_txt" name="search_txt"
                                        value="<?= $search_txt ?>" class="input_txt placeHolder"
                                        placeholder="검색어 입력" style="width:240px"
                                        onkeydown="if(event.keyCode == 13)search_it();">
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
                <div class="listTop flex_b_c">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                    </div>
                    <form name="frm" id="frm">
                        <div class="right_btn">
                            <button type="button" class="btn_filter" onclick="orderBy_set('1');"><img
                                    src="/images/admin/common/filter.png" alt="">순위순
                            </button>
                            <button type="button" class="btn_filter" onclick="orderBy_set('2');"><img
                                    src="/images/admin/common/filter.png" alt="">최신순
                            </button>

                            <select id="g_list_rows" name="g_list_rows" class="input_select" style="width: 80px" onchange="submitForm();">
                                <option value="30" <?= ($g_list_rows == 30)  ? 'selected' : '' ?>>30개</option>
                                <option value="50" <?= ($g_list_rows == 50)  ? 'selected' : '' ?>>50개</option>
                                <option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
                                <option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
                            </select>
                        </div>
                    </form>

                </div><!-- // listTop -->
                <div class="listBottom">
                    <form name="frm_l" id="frm_l">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="50px" />
                                <col width="250px" />
                                <col width="200px" />
                                <col width="200px" />
                                <col width="100px" />
                                <col width="*" />
                                <col width="100px" />
                                <col width="100px" />
                                <col width="100px" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>핫 플레이스</th>
                                    <th>추천 여행지</th>
                                    <th>추천여행 카테고리</th>
                                    <th>썸네일이미지</th>
                                    <th>타이틀</th>
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
                                        <td colspan=7 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                <?php
                                }
                                foreach ($result as $row) :
                                ?>
                                    <tr style="height:30px" data-idx="<?= $row['idx']; ?>">
                                        <td><?= $num-- ?></td>
                                        <td class="tac"><?= $row["local_product_title"] ?></td>
                                        <td class="tac">
                                            <?php
                                                $city_code_list = $row['city_code'] . "|" . $row['town_code'];
                                                
                                                $category_code_list = $row['category_code'] . "|" . $row['subcategory_code'];
                                                
                                            ?>
                                            <div class="" style="padding: 0 20px">
                                                <p class="new"><?= get_cate_name($city_code_list) ?></p>
                                            </div>
                                            <div class="flex_c_c" style="gap: 10px;">
                                                <a href="/product-hotel/hotel-detail/<?= $row["idx"] ?>"
                                                    class="product_view" target="_blank">[<span>상품상세</span>]</a>
                                                <a href="write?city_code=<?= $city_code ?>&town_code=<?= $town_code ?>&category_code=<?= $category_code ?>&subcategory_code=<?= $subcategory_code ?>&search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&idx=<?= $row["idx"] ?>"
                                                    class="product_view" style="color: red;">[<span>상세수정</span>]</a>
                                            </div>
                                        </td>
                                        <td class="tac">
                                            <p class="new"><?= get_cate_name($category_code_list) ?></p>
                                        </td>
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
                                            <a href="write?city_code=<?= $city_code ?>&town_code=<?= $town_code ?>&category_code=<?= $category_code ?>&subcategory_code=<?= $subcategory_code ?>&search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&idx=<?= $row["idx"] ?>">
                                                <?= viewSQ($row["product_name"]) ?>
                                        </td>
                                        <td>
                                            <input type="text" name="onum[]" id="onum_<?= $row["idx"] ?>"
                                                value="<?= $row['onum'] ?>" style="width:66px; text-align:center;">                                    
                                            <input type="hidden" name="code_idx[]" value="<?= $row["idx"] ?>"
                                                class="input_txt" />
                                        </td>
                                        <td>
                                            <?= $row["r_date"] ?>
                                        </td>
                                        <td>
                                            <a href="#!" onclick="prod_update('<?= $row['idx'] ?>');"><img
                                                    src="/images/admin/common/ico_setting2.png"></a>&nbsp;
                                            <a href="javascript:del_it('<?= $row['idx'] ?>');"><img
                                                    src="/images/admin/common/ico_error.png" alt="삭제" /></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                </div><!-- // listBottom -->

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_local_guide/list') . "?city_code=$city_code&category_code=$category_code&town_code=$town_code&subcategory_code=$subcategory_code&search_category=$search_category&g_list_rows=$g_list_rows&search_name=$search_name&pg=") ?>

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
    function search_it() {
        var frm = document.search;
        if (frm.search_txt.value == "검색어 입력") {
            frm.search_txt.value = "";
        }
        frm.submit();
    }

    $(function() {
        $.datepicker.regional['ko'] = {
            showButtonPanel: true,
            beforeShow: function(input) {
                setTimeout(function() {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                    btn.unbind("click").bind("click", function() {
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
            closeText: '닫기', // 닫기 버튼 패널
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ko']);

        $(".date_form").datepicker({
            showButtonPanel: true,
            beforeShow: function(input) {
                setTimeout(function() {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                    btn.unbind("click").bind("click", function() {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            },
            dateFormat: 'yy-mm-dd',
            showOn: "both",
            yearRange: "c-100:c+10",
            buttonImage: "/images/admin/common/date.png",
            buttonImageOnly: true,
            closeText: '닫기',
            prevText: '이전',
            nextText: '다음'

        });
    });
    
</script>

<script>
    function change_it() {
        let f = document.frm_l;

        let url = '<?= route_to("admin._local_guide.change") ?>'
        let prod_data = $(f).serialize();
        $.ajax({
            type: "POST",
            data: prod_data,
            url: url,
            cache: false,
            async: false,
            success: function(data, textStatus) {
                let message = data.message;
                alert(message);
                window.location.reload();
            },
            error: function(request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }
</script>

<script>
    function submitForm() {
        //document.getElementById("frm").submit();
        var product_code_1 = '<?= $product_code_1 ?>';
        var product_code_2 = '<?= $product_code_2 ?>';
        var product_code_3 = '<?= $product_code_3 ?>';
        var search_category = '<?= $search_category ?>';
        var product_name = '<?= $product_name ?>';
        var g_list_rows = $("#g_list_rows").val();
        var search_name = '<?= $search_name ?>';
        var pg = '<?= $pg ?>';
        location.href = '/AdmMaster/_local_guide/list?product_code_1=' + product_code_1 + '&product_code_2=' + product_code_2 + '&product_code_3=' + product_code_3  + '&search_category=' + search_category + '&product_name=' + product_name + '&g_list_rows=' + g_list_rows + '&search_name=' + search_name + '&pg=' + pg;
    }
</script>

<script>
    function orderBy_set(seq) {
        $("#orderBy").val(seq);
        search_it();
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

        let url = "<?= route_to("admin._local_guide.del") ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: $("#frm").serialize(),
            error: function(request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            },
            success: function(response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert_("정상적으로 삭제되었습니다.");
                location.reload();
                return;
            }
        });

    }

    function del_it(idx) {

        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");

        let url = "<?= route_to("admin._local_guide.del") ?>";

        $.ajax({
            url: url,
            type: "POST",
            data: "idx[]=" + idx,
            error: function(request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            },
            success: function(response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert_("정상적으로 삭제되었습니다.");
                location.reload();
                return;
            }
        });

    }

    function get_code(strs, depth) {
        $.ajax({
            type: "GET",
            url: "/AdmMaster/api/get_code",
            dataType: "html" //전송받을 데이터의 타입
            ,
            timeout: 30000 //제한시간 지정
            ,
            cache: false //true, false
            ,
            data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth //서버에 보낼 파라메터
,
            error: function(request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            success: function(json) {
                //alert(json);
                if (depth <= 3) {
                    $("#product_code_2").find('option').each(function() {
                        $(this).remove();
                    });
                    $("#product_code_2").append("<option value=''>2차분류</option>");
                }
                if (depth <= 4) {
                    $("#product_code_3").find('option').each(function() {
                        $(this).remove();
                    });
                    $("#product_code_3").append("<option value=''>3차분류</option>");
                }
                if (depth <= 4) {
                    $("#product_code_4").find('option').each(function() {
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