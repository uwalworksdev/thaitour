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

    .img_add.img_add_group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .img_add .file_input + .file_input {
        margin-left: 0;
    }
</style>

<script type="text/javascript">
    function checkForNumber(str) {
        let key = event.keyCode;
        let frm = document.frm1;
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
                <h2>스파/쇼·입장권/레스토랑 상품정보입력</h2>
                <div class="menus">
                    <ul>
                        <li>
                            <a href="list_spas?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                                class="btn btn-default">
                                <span class="glyphicon glyphicon-th-list"></span>
                                <span class="txt">리스트</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- // inner -->
        </header>
        <!-- // headerContainer -->

        <form name=frm action="" method=post enctype="multipart/form-data"
                target="hiddenFrame">
            <input type=hidden name="search_category" value='<?= $search_category ?>'>
            <input type=hidden name="search_name" value='<?= $search_name ?>'>
            <input type=hidden name="pg" value='<?= $pg ?>'>
            <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>
            <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
            <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
            <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>

            <div id="contents">
                <div class="listWrap_noline">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                style="margin-top:50px;">
                            <caption></caption>
                            <colgroup>
                                <col width="10%">
                                <col width="10%">
                                <col width="*">
                                <col width="10%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>시작일</th>
                                <th>종료일</th>
                                <th>선택요일</th>
                                <th>대인가격(단위: 바트)</th>
                                <th>소인가격(단위: 바트)</th>
                                <th>가격추가</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="height:50px">
                                <td class="tac">
                                    <input type="text" class="input_txt _available_period_ datepicker"
                                            name="d_start" value="" readonly
                                            id="d_start">
                                </td>
                                <td class="tac">
                                    <input type="text" class="input_txt _available_period_ datepicker"
                                            name="d_end" value="" readonly
                                            id="d_end">
                                </td>
                                <td class="tac">
                                    <input type="checkbox" name="yoil_0" id="yoil_0" value="Y" class="yoil">
                                    <label for="yoil_0">일요일</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="yoil_1" id="yoil_1" value="Y" class="yoil">
                                    <label for="yoil_1">월요일</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="yoil_2" id="yoil_2" value="Y" class="yoil">
                                    <label for="yoil_2">화요일</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="yoil_3" id="yoil_3" value="Y" class="yoil">
                                    <label for="yoil_3">수요일</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="yoil_4" id="yoil_4" value="Y" class="yoil">
                                    <label for="yoil_4">목요일</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="yoil_5" id="yoil_5" value="Y" class="yoil">
                                    <label for="yoil_5">금요일</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" name="yoil_6" id="yoil_6" value="Y" class="yoil">
                                    <label for="yoil_6">토요일</label>
                                    &nbsp;&nbsp;&nbsp;
                                </td>
                                <td style="text-align:center">
                                    <input type="text" name="price1" id="price1" value="0"
                                            class="price price1 input_txt"
                                            style="width:90%;text-align:right;">
                                </td>
                                <td style="text-align:center">
                                    <input type="text" name="price2" id="price2" value="0"
                                            class="price price2 input_txt"
                                            style="width:90%;text-align:right;">
                                </td>
                                <td style="text-align: center">
                                    <a href="#!" onclick="isrt_price();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">가격추가</span></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                style="margin-top:50px;">
                            <caption></caption>
                            <colgroup>
                                <col width="5%">
                                <col width="10%">
                                <col width="10%">
                                <col width="*">
                                <col width="10%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>시작일</th>
                                <th>종료일</th>
                                <th>선택요일</th>
                                <th>등록일</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i2 = 0;
                                foreach ($fresult9 as $row) {
                                    $i2++;
                            ?>
                                <tr style="height:50px">
                                    <td><?= $i2 ?></td>
                                    <td class="tac">
                                        <?= $row['s_date'] ?>
                                    </td>
                                    <td class="tac">
                                        <?= $row['e_date'] ?>
                                    </td>
                                    <td class="tac">
                                        <input type="checkbox" name="yoil_0" id="yoil_0_<?= $row['p_idx'] ?>"
                                                value="Y" <?= $row['yoil_0'] == "Y" ? "checked" : "" ?>
                                                class="yoil">
                                        <label for="yoil_0_<?= $row['p_idx'] ?>">일요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_1" id="yoil_1_<?= $row['p_idx'] ?>"
                                                value="Y" <?= $row['yoil_1'] == "Y" ? "checked" : "" ?>
                                                class="yoil">
                                        <label for="yoil_1_<?= $row['p_idx'] ?>">월요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_2" id="yoil_2_<?= $row['p_idx'] ?>"
                                                value="Y" <?= $row['yoil_2'] == "Y" ? "checked" : "" ?>
                                                class="yoil">
                                        <label for="yoil_2_<?= $row['p_idx'] ?>">화요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_3" id="yoil_3_<?= $row['p_idx'] ?>"
                                                value="Y" <?= $row['yoil_3'] == "Y" ? "checked" : "" ?>
                                                class="yoil">
                                        <label for="yoil_3_<?= $row['p_idx'] ?>">수요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_4" id="yoil_4_<?= $row['p_idx'] ?>"
                                                value="Y" <?= $row['yoil_4'] == "Y" ? "checked" : "" ?>
                                                class="yoil">
                                        <label for="yoil_4_<?= $row['p_idx'] ?>">목요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_5" id="yoil_5_<?= $row['p_idx'] ?>"
                                                value="Y" <?= $row['yoil_5'] == "Y" ? "checked" : "" ?>
                                                class="yoil">
                                        <label for="yoil_5_<?= $row['p_idx'] ?>">금요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_6" id="yoil_6_<?= $row['p_idx'] ?>"
                                                value="Y" <?= $row['yoil_6'] == "Y" ? "checked" : "" ?>
                                                class="yoil">
                                        <label for="yoil_6_<?= $row['p_idx'] ?>">토요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="text-align:center">
                                        <?= $row['c_date'] ?>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/AdmMaster/_productPrice/write_new?yoil_idx=<?= $row['p_idx'] ?>&product_idx=<?= $product_idx ?>"
                                            class="btn btn-default">가격수정</a>

                                        <?php if($row['sale'] == "N") { ?>
                                        <a href="javascript:open_yoil('<?= $row['p_idx'] ?>');" class="btn btn-default">마감해제</a>
                                        <?php } else { ?>
                                        <a href="javascript:close_yoil('<?= $row['p_idx'] ?>');" class="btn btn-default">마감처리</a>
                                        <?php } ?>

                                        <a href="javascript:del_yoil('<?= $row['p_idx'] ?>');"
                                            class="btn btn-default">삭제하기</a>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>

        <!-- Delete option spa/ticket/restaurant -->

        <div class="tail_menu" style="margin-bottom: 60px">
            <ul>
                <li class="left"></li>
                <li class="right_sub">
                    <a href="list_spas?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                        class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                </li>
            </ul>
        </div>

    </div>
</div>

<!-- // listBottom -->

<script>
    
    function isrt_price() {
        upd_price('');
    }

    function open_yoil(p_idx)
    {
        if (!confirm("선택한 기간의 마감을 해제하시겠습니까?"))
            return false;

        let message = "";
        $.ajax({

            url: "/ajax/ajax_open_yoil",
            type: "POST",
            data: {
                "p_idx": p_idx
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
    function close_yoil(p_idx) 
    {
        if (!confirm("선택한 기간을 마감하시겠습니까?"))
            return false;

        let message = "";
        $.ajax({

            url: "/ajax/ajax_close_yoil",
            type: "POST",
            data: {
                "p_idx": p_idx
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
    
    function del_yoil(p_idx) {
        $("#ajax_loader").removeClass("display-none");
        if (!confirm("정말로 삭제하시겠습니까?\n\n한 번 삭제되면 데이터를 복구할 수 없습니다.\n\n")){
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
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                $("#ajax_loader").addClass("display-none");
            }

        });
    }

    function upd_price(p_idx) {
        $("#ajax_loader").removeClass("display-none");
        let url = `<?= route_to('admin.api.spa_.save_option_price') ?>`;

        let d_start = $("#d_start").val();
        let d_end = $("#d_end").val();

        let price_1 = $("#price1").val().replaceAll(',', '');
        let price_2 = $("#price2").val().replaceAll(',', '');
        // let price_3 = $("#price3").val().replaceAll(',', '');

        let yoil_0 = $("#yoil_0").is(":checked") ? "Y" : "N";
        let yoil_1 = $("#yoil_1").is(":checked") ? "Y" : "N";
        let yoil_2 = $("#yoil_2").is(":checked") ? "Y" : "N";
        let yoil_3 = $("#yoil_3").is(":checked") ? "Y" : "N";
        let yoil_4 = $("#yoil_4").is(":checked") ? "Y" : "N";
        let yoil_5 = $("#yoil_5").is(":checked") ? "Y" : "N";
        let yoil_6 = $("#yoil_6").is(":checked") ? "Y" : "N";

        let data = {
            "p_idx": p_idx,
            "product_idx": '<?= $product_idx ?>',
            "s_date": d_start,
            "e_date": d_end,
            "price1": price_1,
            "price2": price_2,
            "price3": 0,
            "yoil_0": yoil_0,
            "yoil_1": yoil_1,
            "yoil_2": yoil_2,
            "yoil_3": yoil_3,
            "yoil_4": yoil_4,
            "yoil_5": yoil_5,
            "yoil_6": yoil_6
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
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                $("#ajax_loader").removeClass("display-none");
            }

        });
    }
</script>

<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>
<?= $this->endSection() ?>