<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<?php
    if($type == "hotel") {
        $str_title = "호텔 & 리조트";
    }else if($type == "golf") {
        $str_title = "투어";
    }else {
        $str_title = "골프";
    }
?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2><?= $str_title ?></h2>
                <div class="menus">
                    <ul class="first">
                    </ul>

                    <ul class="last">
                        <li><a href="javascript:change_it()" class="btn btn-success btn_change">순위변경</a></li>
                        <li><a href="./write_product?type=<?=$type?>" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-pencil"></span> <span
                                    class="txt">영역 등록</span></a></li>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">
            <form name="search" id="search">
                <input type="hidden" name="pg" id="pg" value="<?= $pg ?>">

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
                                        <option value="title" <?php if ($search_category == "title") {
                                                                            echo "selected";
                                                                        } ?>>
                                            제목
                                        </option>
                                        <option value="desc" <?php if ($search_category == "desc") {
                                                                            echo "selected";
                                                                        } ?>>
                                            내용
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

                </div><!-- // listTop -->
                <div class="listBottom">
                    <form name="frm_l" id="frm_l">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="50px" />
                                <col width="*" />
                                <col width="100px" />
                                <col width="100px" />
                                <col width="100px" />
                                <col width="100px" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>썸네일이미지</th>
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
                                        <td colspan=6 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                <?php
                                }
                                foreach ($result as $row) :
                                    $row['product_code_list'] = $row['product_code_1'] ."|". $row['product_code_2'] ."|". $row['product_code_3']; 
                                    $_product_code_arr = explode("|", $row['product_code_list']);
                                ?>
                                    <tr style="height:30px">
                                        <td><?= $num-- ?></td>
                                        <td class="tac">
                                            <div class="flex_c_c" style="flex-direction: column;">
                                                <?= get_cate_name($row['product_code_list'])?>
                                                <a href="./write_product?type=<?=$type?>&idx=<?= $row["idx"] ?>"><?= $row["title"] ?></a> 
                                            </div>
                                        </td>
                                       
                                        <td class="tac">
                                            <?php
                                            if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/promotion/" . $row["ufile1"])) {
                                                $src = "/data/promotion/" . $row["ufile1"];
                                            } else {
                                                $src = "/data/product/noimg.png";
                                            }
                                            ?>
                                            <a href="<?= $src ?>" class="imgpop">
                                                <img src="<?= $src ?>"
                                                    style="max-width:150px;max-height:100px"></a>
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
                                            <a href="./write_product?type=<?=$type?>&idx=<?= $row["idx"] ?>"><img
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

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_promotion/list_product') . "?search_category=$search_category&g_list_rows=$g_list_rows&search_name=$search_name&pg=") ?>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first">
                            </ul>

                            <ul class="last">
                                <li><a href="javascript:change_it()"
                                        class="btn btn-success btn_change">순위변경</a></li>
                                <li><a href="./write_product?type=<?=$type?>" class="btn btn-primary"><span
                                            class="glyphicon glyphicon-pencil"></span> <span
                                            class="txt">영역 등록</span></a></li>
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
    
</script>

<script>
    function change_it() {
        let f = document.frm_l;

        let url = '<?= route_to("admin._promotion.change_product") ?>'
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

        let url = "<?= route_to("admin._promotion.del_product") ?>";
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

        let url = "<?= route_to("admin._promotion.del_product") ?>";

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

</script>

<?= $this->endSection() ?>