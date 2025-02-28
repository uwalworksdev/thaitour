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
                        <li><a href="/AdmMaster/_tour_guides/write" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-pencil"></span> <span
                                        class="txt">상품 등록</span></a></li>
                        <li><a href="/AdmMaster/_tour_guides/write_info" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-pencil"></span> <span
                                        class="txt">가이드 소개 등록</span></a></li>
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
                                <col width="120px"/>
                                <col width="120px"/>
                                <col width="100px"/>
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
                                <th>구분</th>
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
                            foreach ($products as $row) :
                                ?>
                                <tr style="height:50px" data-idx="<?= $row['product_idx']; ?>">
                                    <td><?= $num-- ?></td>
                                    <td class="tac"><?= $row["product_code"] ?></td>
                                    <td>
                                        <?php if ($row["guide_type"] == 'I'): ?>
                                            가이드 소개
                                        <?php else: ?>
                                            가이드 상품
                                        <?php endif; ?>
                                    </td>
                                    <td class="tac">
                                        <?php if ($row["ufile1"] != "") { ?>
                                            <img src="<?= base_url('/uploads/guides/') . $row['ufile1'] ?>"
                                                 alt="<?= viewSQ($row["product_name"]) ?>">
                                        <?php } else {
                                            ?>
                                            <img src="/data/product/noimg.png"
                                                 alt="<?= viewSQ($row["product_name"]) ?>">
                                        <?php } ?>
                                    </td>
                                    <td class="tal" style="font-weight:bold">
                                        <?php if ($row["guide_type"] == 'I'): ?>
                                            <a href="/AdmMaster/_tour_guides/write_info?search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&product_idx=<?= $row["product_idx"] ?>">
                                                <?= viewSQ($row["special_name"]) ?></a>
                                        <?php else: ?>
                                            <a href="/AdmMaster/_tour_guides/write?search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>&product_idx=<?= $row["product_idx"] ?>">
                                                <?= viewSQ($row["product_name"]) ?></a>
                                            <br>판매가격 : <?= number_format($row['product_price']) ?>바트
                                        <?php endif; ?>
                                    </td>
                                    <td class="tac">
                                        <select name="product_status[]" id="product_status_<?= $row["product_idx"] ?>">
                                            <option value="sale" <?php if (isset($row["product_status"]) && $row["product_status"] === "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="stop" <?php if (isset($row["product_status"]) && $row["product_status"] === "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>

                                            <?php if ($row["guide_type"] == 'P'): ?>
                                                <option value="plan" <?php if (isset($row["product_status"]) && $row["product_status"] === "plan") {
                                                    echo "selected";
                                                } ?>>예약중지
                                                </option>
                                            <?php endif; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="onum[]" id="onum_<?= $row["product_idx"] ?>"
                                               value="<?= $row['onum'] ?>" style="width:66px;">
                                        <input type="hidden" name="product_idx[]"
                                               id="product_idx_<?= $row["product_idx"] ?>"
                                               value="<?= $row['product_idx'] ?>" style="width:66px;">
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
                                    <td colspan="7"
                                        style="background:#fafafa;;text-align:left;padding-left:15px;font-weight:bold">
                                        <?= $row["keyword"] ?>
                                    </td>
                                </tr> -->
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tour_guides/list') . "?pg=") ?>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first"></ul>

                            <ul class="last">
                                <li><a href="javascript:change_it()"
                                       class="btn btn-success btn_change">순위변경</a></li>
                                <li><a href="/AdmMaster/_tour_guides/write" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-pencil"></span> <span
                                                class="txt">상품 등록</span></a></li>
                                <li><a href="/AdmMaster/_tour_guides/write_info" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-pencil"></span> <span
                                                class="txt">가이드 소개 등록</span></a></li>
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

    function change_it() {
        let f = document.frm;
        $("#ajax_loader").removeClass("display-none");
        let url = '<?= route_to("admin._tour_guides.change") ?>'
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
                $("#ajax_loader").addClass("display-none");
                window.location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    function prod_update(idx) {
        let onum = $("#onum_" + idx).val();
        let product_status = $("#product_status_" + idx).val();

        let url = '<?= route_to('admin._tour_guides.update') ?>';

        if (!confirm("선택한 상품의 정보를 변경 하시겠습니까?")) {
            return false;
        }

        let data = {
            onum: onum,
            product_idx: idx,
            product_status: product_status,
        };

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            async: false,
            cache: false,
            success: function (data, textStatus) {
                let message = data.message;
                alert(message);
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

    function del_it(product_idx) {
        if (!confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");

        let url = '<?= route_to('admin._tour_guides.delete') ?>';

        let data = {
            product_idx: product_idx
        }

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert("정상적으로 삭제되었습니다.");
                window.location.reload();
            }
        });

    }

</script>

<?= $this->endSection() ?>
