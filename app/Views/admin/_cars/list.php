<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<style>
</style>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>차량 정보관리</h2>
                <div class="menus">
                    <ul class="first"></ul>

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
                        <td class="label">검색어</td>
                        <td class="inbox">
                            <div class="r_box">
                                <select id="" name="search_category" class="input_select" style="width:180px">
                                    <option value="product_name" <?php if ($search_category == "product_name") {
                                        echo "selected";
                                    } ?> >
                                        상품명
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

            </script>

            <script>
                function change_it() {
                    let f = document.frm;

                    let url = '<?= route_to("admin._cars.change") ?>'
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
                            location.reload();
                        },
                        error: function (request, status, error) {
                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                        }
                    });
                }

            </script>

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
                    </div>

                </div><!-- // listTop -->
                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="50px"/>
                                <col width="100px"/>
                                <col width="120px"/>
                                <col width="*"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="150px"/>
                                <col width="100px"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>상품코드</th>
                                <th>이미지</th>
                                <th>타이틀</th>
                                <th>사용유무</th>
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
                                    <td colspan="9" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                </tr>
                                <?php
                            }
                            foreach ($result as $row) :
                                ?>
                                <tr style="height:50px" data-idx="<?= $row['product_idx']; ?>">
                                    <td rowspan="2"><?= $num-- ?></td>
                                    <td rowspan="2" class="tac"><?= $row["product_code"] ?></td>
                                    <td class="tac">
                                        <?php
                                        if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/cars/" . $row["ufile1"])) {
                                            $src = "/data/cars/" . $row["ufile1"];
                                        } else {
                                            $src = "/data/product/noimg.png";
                                        }
                                            ?>
                                            <a href="<?=$src?>" class="imgpop">
                                                <img src="<?=$src?>"
                                                    style="max-width:150px;max-height:100px"></a>
                                    </td>
                                    <td class="tal" style="font-weight:bold">
                                        <a href="write?search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&product_idx=<?= $row["product_idx"] ?>">
                                            <?= viewSQ($row["product_name"]) ?>
                                        </a><br>최초가격(정찰가) : <?= number_format($row['original_price']) ?>바트
                                        <br>판매가격 : <?= number_format($row['product_price']) ?>바트

                                    </td>
                                    <td class="tac">
                                        <select name="is_view[]" id="is_view_<?= $row["product_idx"] ?>">
                                            <option value="Y" <?php if ($row["is_view"] == "Y") echo "selected"; ?> >
                                                사용
                                            </option>
                                            <option value="N" <?php if ($row["is_view"] != "Y") echo "selected"; ?> >
                                                사용안함
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="onum[]" id="onum_<?= $row["product_idx"] ?>"
                                               value="<?= $row['onum'] ?>" style="width:66px;">
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
                                <tr style="height:45px">
                                    <th style="background:#fafafa;border:1px solid #dddddd;padding:10px 0;font-size:14px;font-weight:bold;color:#464646;text-align:center;">
                                        검색키워드
                                    </th>
                                    <td colspan="7"
                                        style="background:#fafafa;;text-align:left;padding-left:15px;font-weight:bold">
                                        <?= $row["goods_keyword"] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_cars/list') . "?pg=") ?>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first"></ul>

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

    function prod_update(idx) {
        let onum = $("#onum_" + idx).val();

        let is_view = $("#is_view_" + idx).val();

        let url = '/AdmMaster/prod_update/' + idx;

        let product_best = "";

        if (!confirm("선택한 상품의 정보를 변경 하시겠습니까?"))
            return false;

        let message = "";
        $.ajax({
            url: url,
            type: "POST",
            data: { product_best, onum, is_view },
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
            alert("삭제할 내용을 선택하셔야 합니다.");
            return;
        }
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        $("#ajax_loader").removeClass("display-none");

        let url = "<?= route_to("admin._cars.del") ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: $("#frm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert("정상적으로 삭제되었습니다.");
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

        let url = "<?= route_to("admin._cars.del") ?>";

        $.ajax({
            url: url,
            type: "POST",
            data: "product_idx[]=" + product_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert("정상적으로 삭제되었습니다.");
                location.reload();
                return;
            }
        });

    }

</script>

<?= $this->endSection() ?>
