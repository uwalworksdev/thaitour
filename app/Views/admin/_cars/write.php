<?php
    $formAction = $product_idx ? "/AdmMaster/_cars/write_ok/$product_idx" : "/AdmMaster/_cars/write_ok";
?>
<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <style>
        .btn_01 {
            height: 32px !important;
        }
    </style>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="/js/admin/tours/write.js"></script>

<?php
if (isset($product_idx) && isset($row)) {
    foreach ($row as $keys => $vals) {
        ${$keys} = $vals;
    }
}

$titleStr = "차량정보 수정";
$links = "list";
?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li><a href="/AdmMaster/_cars/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:send_it_c()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li>
                                    <a href="javascript:del_it_c(`<?= route_to("admin._cars.del") ?>`, `<?= $product_idx ?>`)"
                                       class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                </li>
                            <?php } else { ?>
                                <li><a href="javascript:send_it_c()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <div id="contents">
                <div class="listWrap_noline">
                    <!--  target="hiddenFrame22"  -->
                    <form name="frm" id="frm" action="<?= $formAction ?>" method="post"
                          enctype="multipart/form-data"
                          target="hiddenFrame22"> <!--  -->
                        <!-- 상품 고유 번호 -->
                        <input type="hidden" name="code_populars" id="code_populars"
                               value='<?= $code_populars ?? "" ?>'/>

                        <!-- db에 있는 product_code -->
                        <input type="hidden" name="old_goods_code" id="old_goods_code"
                               value='<?= $product_code ?? "" ?>'>
                        <input type="hidden" name="product_code_list" id="product_code_list"
                               value='<?= $product_code_list ?? "" ?>'>

                        <input type="hidden" name="product_theme" id="product_theme"
                               value='<?= $product_theme ?? "" ?>'>
                        <input type="hidden" name="product_bedrooms" id="product_bedrooms"
                               value='<?= $product_bedrooms ?? "" ?>'>
                        <input type="hidden" name="product_type" id="product_type"
                               value='<?= $product_type ?? "" ?>'>
                        <input type="hidden" name="product_promotions" id="product_promotions"
                               value='<?= $product_promotions ?? "" ?>'>

                        <input type="hidden" name="product_more" id="product_more"
                               value='<?= $product_more ?? "" ?>'>

                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="table-layout:fixed;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        기본정보
                                    </td>
                                </tr>
                                <tr>
                                    <th>카테고리선택</th>
                                    <td colspan="3">
                                        <select id="product_code_1" name="product_code_1" class="input_select"
                                                onchange="get_code(this.value, 3)">
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
                                                <option value="<?= $frow["code_no"] ?>"><?= $frow["code_name"] ?>
                                                    <?= $status_txt ?></option>
                                            <?php } ?>
                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select"
                                                onchange="get_code(this.value, 4)">
                                            <option value="">2차분류</option>
                                        </select>
                                        <select id="product_code_3" name="product_code_3" class="input_select">
                                            <option value="">3차분류</option>
                                        </select>
                                        <button type="button" id="btn_reg_cate" class="btn_01">등록</button>
                                    </td>
                                </tr>
                                <?php
                                $_product_code_arr = explode("|", $product_code_list);
                                $_product_code_arr = array_filter($_product_code_arr);
                                ?>
                                <tr>
                                    <th>등록된 카테고리</th>
                                    <td colspan="3">
                                        <ul id="reg_cate">
                                            <?php
                                            foreach ($_product_code_arr as $_tmp_code) {
                                                ?>

                                                <li>[<?= $_tmp_code ?>] <?= get_cate_text($_tmp_code) ?> <span
                                                            onclick="delCategory('<?= $_tmp_code ?>', this);">삭제</span>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품코드</th>
                                    <td colspan="3">
                                        <input type="text" name="product_code" id="product_code"
                                               value="<?= $product_code ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if (empty($product_idx) || empty($product_code)) { ?>
                                            <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button>
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" name="product_name"
                                               value="<?= $product_name ?? "" ?>"
                                               class="text" style="width:300px" maxlength="100"/>
                                    </td>
                                    <th>핫한 특가</th>
                                    <td>
                                        <input type="checkbox" name="special_price" id="special_price" value="Y"
                                            <?php if (isset($special_price) && $special_price === "Y")
                                                echo "checked=checked"; ?>> <label for="special_price"
                                                                                   style="max-height:200px;margin-right:20px;">매력적인
                                            제안</label>
                                    </td>
                                </tr>

                                <tr>
                                    <th>판매상태결정</th>
                                    <td>
                                        <select name="product_status" id="product_status">
                                            <option value="sale" <?php if (isset($product_status) && $product_status === "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="stop" <?php if (isset($product_status) && $product_status === "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                            <option value="plan" <?php if (isset($product_status) && $product_status === "plan") {
                                                echo "selected";
                                            } ?>>등록예정
                                            </option>
                                        </select>
                                    </td>
                                    <th>검색키워드</th>
                                    <td>
                                        <input type="text" name="keyword" id="keyword"
                                               value="<?= $keyword ?? "" ?>" class="text" style="width:90%;"
                                               maxlength="1000"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)자켓,방풍자켓,기능성자켓</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>간략소개</th>
                                    <td colspan="3">
										<textarea name="product_info" id="product_info"
                                                  style="width:90%;height:100px;"><?= $product_info ?? "" ?></textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        가격
                                    </td>
                                </tr>

                                <tr>
                                    <th>최초가격(정찰가)</th>
                                    <td colspan="3">
                                        <input type="text" name="original_price" id="original_price" class="onlynum"
                                               style="text-align:right;width: 200px;"
                                               value="<?= $original_price ?? "" ?>"/> 원
                                    </td>

                                </tr>

                                <tr>
                                    <th>판매가격</th>
                                    <td colspan="3">
                                        <input type="text" name="product_price" id="product_price" class="onlynum"
                                               style="text-align:right;width: 200px;"
                                               value="<?= $product_price ?? "" ?>"/> 원
                                    </td>

                                </tr>

                                </tbody>
                            </table>

                            <div class="listBottom">
                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                    <caption>
                                    </caption>
                                    <colgroup>
                                        <col width="10%"/>
                                        <col width="90%"/>
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <th>
                                            옵션추가
                                            <button style="margin: 0px;" type="button" class="btn_01" onclick="add_option();">추가</button>
                                        </th>
                                        <td>
                                            <table>
                                                <colgroup>
                                                    <col width="*%"/>
                                                    <col width="30%"/>
                                                    <col width="20%"/>
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th>옵션명</th>
                                                        <th>차량옵션</th>
                                                        <th>관리</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="list_option">
                                                    <?php
                                                        foreach($options as $option){
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class='flex_c_c'>
                                                                <input type='hidden' name='option_idx[]' value='<?=$option["idx"]?>'>
                                                                <input type='hidden' class='c_op_type' name='c_op_type[]' value='<?=$option["c_op_type"]?>'>
                                                                <input type='text' class='c_op_name' name='c_op_name[]' value='<?=$option["c_op_name"]?>'>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class='flex_c_c' style='gap: 10px;'>
                                                                <?php
                                                                    foreach($cfresult as $c_type){
                                                                ?>
                                                                    <div class='check_wrap'>
                                                                        <input type='checkbox' value='<?=$c_type['code_no']?>'
                                                                        <?php if(strpos($option["c_op_type"], $c_type['code_no']) !== false){ echo "checked"; }?>>
                                                                        <label for=''><?=$c_type['code_name']?></label>
                                                                    </div>
                                                                <?php 
                                                                    }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td class='tac'>
                                                            <button style='margin: 0;' type='button' class='btn_02' onclick='delOption("<?=$option["idx"]?>", this);'>삭제</button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>

                                <tr>
                                    <td colspan="2">
                                        이미지 등록
                                    </td>
                                </tr>

                                <tr>
                                    <th>대표이미지(600X400)</th>
                                    <td colspan="3">

                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                               style="width:500px;margin-bottom:10px"/>
                                        <?php if (isset($ufile1) && $ufile1 !== "") { ?><br>
                                            파일삭제: <input type=checkbox name="del_1" value='Y'>
                                            <a href="/data/cars/<?= $ufile1 ?>" class="imgpop"><?= $rfile1 ?></a>
                                            <br><br>
                                            <img src="/data/cars/<?= $ufile1 ?>" width="200px"/>
                                        <?php } ?>

                                    </td>
                                </tr>


                                <?php for ($i = 2; $i <= 7; $i++) { ?>
                                    <tr>
                                        <th>서브이미지<?= $i - 1 ?>(600X400)</th>
                                        <td colspan="3">

                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                   style="width:500px;margin-bottom:10px"/>
                                            <?php if (isset(${"ufile" . $i}) && ${"ufile" . $i} !== "") { ?><br>파일삭제:
                                                <input type=checkbox
                                                       name="del_<?= $i ?>"
                                                       value='Y'><a
                                                        href="/data/cars/<?= ${"ufile" . $i} ?>"
                                                        class="imgpop"><?= ${"rfile" . $i} ?></a><br><br>
                                                <img src="/data/cars/<?= ${"ufile" . $i} ?>" width="200px"/>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- 중복체크 팝업 -->
                    <div id="pooup_01" class="popup">
                        <div class="pooup_bg"></div>
                        <div class="popup_con">
                            <input type="hidden" name="chk_codeType" id="chk_codeType">
                            <input type="hidden" name="chk_codeCnt" id="chk_codeCnt">
                            <h2 class="tit"><span class="code_text"></span>코드 중복 체크</h2>
                            <p class="text">- 고객님이 요청하신 <span class="code_text"></span>코드 중복 체크</p>
                            <input type="text" name="pop_search" id="pop_search" class="box nothangul">

                            <label for="" class="name_search">조회</label>
                            <p class="result_text"><strong>코드</strong>를 입력하신 후 조회해주세요.</p>

                            <div class="btn_box">
                                <p class="ok_btn">사용</p><span>|</span>
                                <p class="close_btn">닫기</p>
                            </div>
                        </div>
                    </div>

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">
                                <a href="/AdmMaster/_cars/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($product_idx == "") { ?>
                                    <a href="javascript:send_it_c()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it_c()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <a href="javascript:del_it_c(`<?= route_to("admin._cars.del") ?>`, `<?= $product_idx ?>`)"
                                       class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- // listWrap -->

            </div>
            <!-- // contents -->

        </div><!-- 인쇄 영역 끝 //-->
    </div>
<script>
    function add_option() {
        var addOption = "";
        addOption +="<tr>";
        addOption +=    "<td>";
        addOption +=       "<div class='flex_c_c'>";
        addOption +=            "<input type='hidden' name='option_idx[]' id='option_idx_' value=''>";
        addOption +=            "<input type='text' class='c_op_name' name='c_op_name[]' value=''>";
        addOption +=            "<input type='hidden' class='c_op_type' name='c_op_type[]' value=''>";
        addOption +=        "</div>";
        addOption +=    "</td>";
        addOption +=    "<td>";
        addOption +=        "<div class='flex_c_c' style='gap: 10px;'>";
                    <?php
                        foreach($cfresult as $c_type){
                    ?>
        addOption +=                "<div class='check_wrap'>";
        addOption +=                    "<input type='checkbox' value='<?=$c_type['code_no']?>'>";
        addOption +=                    "<label for=''><?=$c_type['code_name']?></label>";
        addOption +=              " </div>";
                    <?php 
                        }
                    ?>
        addOption +=        "</div>";
        addOption +=    "</td>"
        addOption +=    "<td class='tac'>";
        addOption +=        "<button style='margin: 0;' type='button' class='btn_02' onclick='delOption(\"\",this);'>삭제</button>";
        addOption +=    "</td>";
        addOption += "</tr>";

        $("#list_option").append(addOption);
    }

    function delOption(idx, obj) {
        if (confirm("정말 삭제하시겠습니까?")) {

            if (idx) {
                $.ajax({
                    url: "/AdmMaster/_cars/del_cars_option",
                    type: "POST",
                    data: "idx=" + idx,
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
                        alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        $("#ajax_loader").addClass("display-none");
                    }
                    , success: function (response, status, request) {
                        response = response.trim();
                        if (response == "OK") {
                            alert("삭제되었습니다.");
                        } else {
                            alert("오류!");
                            location.reload();
                        }
                    }
                });
            }

            $(obj).closest("tr").remove();
        }
    }

    function send_it_c() {
        $("#list_option tr").each(function(){
            let arr_type = [];
            $(this).find(".check_wrap").each(function(){
                if($(this).find("input[type='checkbox']").is(":checked")){
                    arr_type.push($(this).find("input[type='checkbox']").val());
                }
            });
            $(this).find(".c_op_type").val(arr_type.join(","));
        });

        var frm = document.frm;

        if (frm.product_code_list.value == "") {
            alert("카테고리를 등록해주세요.");
            frm.product_code_1.focus();
            return;
        }

        if (frm.product_code.value == "") {
            alert("상품코드를 입력해주세요.");
            frm.product_code.focus();
            return;
        }


        if (frm.product_name.value == "") {
            alert("상품명을 입력해주세요.");
            frm.product_name.focus();
            return;
        }

        $("#ajax_loader").removeClass("display-none");
        frm.submit();
    }

    function del_it_c(url, g_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: url,
            type: "POST",
            data: "g_idx[]=" + g_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert("정상적으로 삭제되었습니다.");
                window.location.href = '/AdmMaster/_cars/list';
                return;
            }
        });
    }
</script>
    <iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>