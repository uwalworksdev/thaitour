<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<style>
</style>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>차량 상품관리</h2>
                <div class="menus">
                    <ul class="first"></ul>

                    <ul class="last">
                        <li>
                            <!-- <a href="javascript:change_it()" class="btn btn-success btn_change">순위변경</a> -->
                        </li>
                        <li>
                            <a href="write" class="btn btn-primary">
                                <span class="glyphicon glyphicon-pencil"></span> 
                                <span class="txt">상품 등록</span>
                            </a>
                        </li>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">
            <!-- <form name="search" id="search">
                <input type="hidden" name="pg" id="pg" value="<?= $pg ?>">
                <input type="hidden" name="ca_idx" id="ca_idx" value="">

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
            </form> -->

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

                    let url = '<?= route_to("admin._cars_category.change") ?>'
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

            <form name="frm" id="frm">
            <div class="listWrap">
                <!-- 안내 문구 필요시 구성 //-->
                <div class="listTop flex_b_c">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                    </div>
                    <!-- <div class="right_btn">
                        <button type="button" class="btn_filter" onclick="orderBy_set('1');"><img
                                    src="/images/admin/common/filter.png" alt="">순위순
                        </button>
                        <button type="button" class="btn_filter" onclick="orderBy_set('2');"><img
                                    src="/images/admin/common/filter.png" alt="">최신순
                        </button>
                    </div> -->

					<select id="g_list_rows" name="g_list_rows" class="input_select" style="width: 80px" onchange="submitForm();">
						<option value="10"  <?= ($g_list_rows == 10)  ? 'selected' : '' ?>>10개</option>
						<option value="50"  <?= ($g_list_rows == 50)  ? 'selected' : '' ?>>50개</option>
						<option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
						<option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
					</select>

                </div><!-- // listTop -->
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="7%"/>
                                <col width="*"/>
                                <col width="40%"/>
                                <col width="10%"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>출발지역</th>
                                <th>도착지역</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($nTotalCount == 0) {
                            ?>
                                <tr>
                                    <td colspan="4" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                </tr>
                            <?php
                                }else{
                                    foreach($category_list as $category){
                            ?>
                                    <tr style="height:50px">
                                        <td>
                                            <?= $num-- ?>
                                        </td>
                                        <td>
                                            <a href="write?ca_idx=<?=$category["ca_idx"]?>&search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>">
                                                <?= getCodeFromCodeNo($category["departure_code"])["code_name"] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?= getCodeFromCodeNo($category["destination_code"])["code_name"] ?>
                                        </td>
                                        <td>
                                            <a href="write?ca_idx=<?=$category["ca_idx"]?>&search_category=<?= $search_category ?>&search_txt=<?= $search_txt ?>&pg=<?= $pg ?>">
                                                <img src="/images/admin/common/ico_setting2.png">
                                            </a>&nbsp;
                                            <a href="javascript:del_it('<?=$category["ca_idx"]?>');">
                                                <img src="/images/admin/common/ico_error.png" alt="삭제"/>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_cars_category/list') . "?product_code_1=$product_code_1&s_status=$s_status&search_category=$search_category&g_list_rows=$g_list_rows&search_name=$search_name&pg=" . $arrays_paging) ?>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first"></ul>

                            <ul class="last">
                                <li>
                                    <!-- <a href="javascript:change_it()" class="btn btn-success btn_change">순위변경</a> -->
                                </li>
                                <li>
                                    <a href="write" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span> 
                                        <span class="txt">상품 등록</span>
                                    </a>
                                </li>
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

    // function orderBy_set(seq) {
    //     $("#orderBy").val(seq);
    //     search_it();
    // }

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
        if ($(".ca_idx").is(":checked") == false) {
            alert("삭제할 내용을 선택하셔야 합니다.");
            return;
        }
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        $("#ajax_loader").removeClass("display-none");

        let url = "<?= route_to("admin._cars_category.del") ?>";
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

    function del_it(ca_idx) {

        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");

        let url = "<?= route_to("admin._cars_category.delete") ?>";

        $.ajax({
            url: url,
            type: "POST",
            data: "ca_idx=" + ca_idx,
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
