<?php

use App\Controllers\Admin\AdminHotelController;

?>

<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <style>
        .btn_01 {
            height: 30px !important;
            padding: 0px 10px 0px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img_add #input_file_ko {
            display: none;
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

$titleStr = "호텔정보 수정";
$links = "list";
?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2>호텔상세정보</h2>
                    <div class="menus">
                        <ul>
                            <li><a href="/AdmMaster/_hotel/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <li><a href="javascript:send_it_price()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <div id="contents">
                <div class="listWrap_noline">
                    <!--  target="hiddenFrame22"  -->
                    <form name="frm" id="frm" action="<?= route_to('admin.api.hotel_.write_price_ok') ?>" method="post"
                          enctype="multipart/form-data"
                          target="hiddenFrame22">
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

                        <input type="hidden" name="stay_idx" id="stay_idx"
                               value='<?= $stay_idx ?>'>
                        <input type="hidden" name="product_idx" id="product_idx"
                               value='<?= $product_idx ?>'>

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
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="product_name" readonly="readonly"
                                               value="<?= $product_name ?? "" ?>"
                                               class="text" style="width:100%" maxlength="100"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품코드</th>
                                    <td colspan="3">
                                        <input type="text" name="product_code" id="product_code"
                                               value="<?= $product_code_no ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
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
                                    <th>최초가격(정찰가)(단위: 바트)</th>
                                    <td colspan="3">
                                        <input type="text" name="original_price" id="original_price" class="onlynum"
                                               style="text-align:right;width: 200px;"
                                               value="<?= $original_price ?? "" ?>"/>
                                    </td>

                                </tr>

                                <tr>
                                    <th>판매가격(단위: 바트)</th>
                                    <td colspan="3">
                                        <input type="text" name="product_price" id="product_price" class="onlynum"
                                               style="text-align:right;width: 200px;"
                                               value="<?= $product_price ?? "" ?>"/>
                                    </td>

                                </tr>

                                <tr>
                                    <th>바트가격 숨김</th>
                                    <td colspan="3">
                                        <input type="checkbox" name="is_view_only_won" id="is_view_only_won"
                                               value="Y" <?php if($is_view_only_won == "Y"){ echo "checked"; }?>/>
                                    </td>

                                </tr>

                                </tbody>
                            </table>

                            <?php if ($product_idx): ?>
                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                       style="margin-top:50px;">
                                    <caption>
                                    </caption>
                                    <colgroup>
                                        <col width="15%"/>
                                        <col width="90%"/>
                                    </colgroup>
                                    <tbody>

                                    <tr height="45">
                                        <th>호텔선택</th>
                                        <td>
                                            <?php if (empty($stay_idx)) { ?>
                                                <select id="hotel_code" name="hotel_code" class="input_select"
                                                        onchange="fn_chgRoom(this.value)">
                                                    <option value="">선택</option>
                                                    <?php
                                                    foreach ($fresult3 as $frow) {
                                                        ?>
                                                        <option value="<?= $frow["code_no"] ?>"
                                                            <?php if (isset($stay_idx) && $stay_idx === $frow["code_no"])
                                                                echo "selected"; ?>>
                                                            <?= $frow["stay_name_eng"] && $frow["stay_name_eng"] != '' ? $frow["stay_name_eng"] : $product_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } else { ?>
                                                <?php foreach ($hresult as $hrow) { ?>
                                                    <input type="text" readonly
                                                           value=" <?= $frow["stay_name_eng"] && $frow["stay_name_eng"] != '' ? $frow["stay_name_eng"] : $product_name ?>"
                                                           style="width: 50%">
                                                <?php } ?>
                                            <?php } ?>
                                            <span>(호텔을 선택해야 옵션에서 룸을 선택할 수 있습니다.)</span>
                                        </td>
                                    </tr>


                                    <tr height="45">
                                        <th>
                                            <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between">
                                                객실등록
                                                <button type="button" id="btn_add_option" class="btn_01">추가</button>
                                            </div>
                                            <p style="display:block;margin-top:10px;">
                                                <select name="roomIdx" id="roomIdx" class="input_select"
                                                        style="width: 100%">
                                                    <?php if (!empty($stay_idx)) { ?>
                                                        <?php
                                                        foreach ($rresult as $frow) {
                                                            ?>
                                                            <option value="<?= $frow['g_idx'] ?>"><?= $frow['roomName'] ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </p>
                                        </th>
                                        <td>
									<span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다. /
										마감날짜 예시) [ 2019-10-15||2019-10-17 ] Y-m-d 형식으로 || 를 구분자로 사용해주세요.</span>
                                            <div id="mainRoom">
                                                <?php

                                                $gresult = (new AdminHotelController())->getListOption($product_code ?? null);
                                                foreach ($gresult as $grow) {
                                                    ?>

                                                    <table>
                                                        <colgroup>
                                                            <col width="*">
                                                            <col width="30%">
                                                            <col width="10%">
                                                            <col width="10%">
                                                            <col width="10%">
                                                            <col width="10%">
                                                        </colgroup>
                                                        <thead>
                                                        <tr>
                                                            <th>객실명</th>
                                                            <th>기간</th>
                                                            <th>컨택가</th>
                                                            <th>프로모션</th>
                                                            <th>수익</th>
                                                            <th>삭제</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tblroom<?= $grow['o_room'] ?>">
                                                        <?php
                                                        $gresult2 = (new AdminHotelController())->getListOptionRoom($product_code ?? null, $grow['o_room'] ?? null);
                                                        foreach ($gresult2 as $frow3) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <input type='hidden' name='o_idx[]'
                                                                           value='<?= $frow3['idx'] ?>'/>
                                                                    <input type='hidden' name='option_type[]'
                                                                           value='<?= $frow3['option_type'] ?>'/>
                                                                    <input type='hidden' name='o_room[]' class="o_room"
                                                                           id=''
                                                                           value="<?= $frow3['o_room'] ?>" size="70"/>
                                                                    <input type='hidden' name='o_name[]' id=''
                                                                           value="<?= $frow3['goods_name'] ?>"
                                                                           size="70"/>
                                                                    <span class="room_option_"
                                                                          data-id="<?= $frow3['o_room'] ?>"><?= $frow3['goods_name'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <div style="display: flex; align-items: center; gap: 5px">
                                                                        <input type='text' readonly
                                                                               class='s_date datepicker'
                                                                               name='o_sdate[]'
                                                                               value='<?= $frow3['o_sdate'] ?>'
                                                                               style='width:35%'/> ~
                                                                        <input type='text' readonly
                                                                               class='e_date datepicker'
                                                                               name='o_edate[]'
                                                                               value='<?= $frow3['o_edate'] ?>'
                                                                               style='width:35%'/>

                                                                        <a href="/AdmMaster/_hotel/write_options?o_idx=<?= $frow3['idx'] ?>&product_idx=<?= $product_idx ?>"
                                                                           style="text-wrap: nowrap"
                                                                           class="btn_01">수정</a>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='onlynum' name='o_price1[]'
                                                                           style="text-align:right;"
                                                                           id=''
                                                                           value="<?= $frow3['goods_price1'] ?>"/>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='onlynum' name='o_price2[]'
                                                                           style="text-align:right;"
                                                                           id=''
                                                                           value="<?= $frow3['goods_price2'] ?>"/>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='onlynum' name='o_price3[]'
                                                                           style="text-align:right;"
                                                                           id=''
                                                                           value="<?= $frow3['goods_price3'] ?>"/>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                            onclick="delOption('<?= $frow3['idx'] ?>',this)"
                                                                            class="btn_02">
                                                                        삭제
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr height="45">
                                        <th>
                                            <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between">
                                                객실 옵션 추가
                                                <button type="button" id="btn_add_option3" class="btn_01">추가</button>
                                            </div>
                                            <p style="display:block;margin-top:10px;">
                                                <select name="roomIdx2" id="roomIdx2" class="input_select">

                                                </select>
                                            </p>
                                        </th>
                                        <td>
                                            <div>
                                                <table>
                                                    <colgroup>
                                                        <col width="10%">
                                                        <col width="*">
                                                        <col width="25%">
                                                        <col width="10%">
                                                        <col width="10%">
                                                        <col width="10%">
                                                        <col width="10%">
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th>방 이름</th>
                                                        <th>객실 상세</th>
                                                        <th>옵션명</th>
                                                        <th>컨택가</th>
                                                        <th>프로모션</th>
                                                        <th>수익</th>
                                                        <th>삭제</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="settingBody3">
                                                    <?php foreach ($roresult as $row) { ?>
                                                        <tr>
                                                            <td>
                                                                <input type='hidden' name='rop_idx[]' id=''
                                                                       value="<?= $row['rop_idx'] ?>"/>
                                                                <input type='hidden' name='sup_room__idx[]' id=''
                                                                       value="<?= $row['r_idx'] ?>"/>

                                                                <input type='hidden' name='sup_room__name[]' id=''
                                                                       value="<?= $row['r_name'] ?>"/>
                                                                <?= $row['r_name'] ?>
                                                            </td>
                                                            <td>
                                                                <input type='text' name='sup__key[]' id=''
                                                                       value="<?= $row['r_key'] ?>" size="70"/>
                                                            </td>
                                                            <td>
                                                                <button type="button" id="btn_add_name"
                                                                        onclick="addName(this);"
                                                                        class="btn_01">추가
                                                                </button>
                                                                <div class="list_name list__room_name"
                                                                     style="margin-top: 10px;">
                                                                    <?php
                                                                    $i = 0;
                                                                    $arr = explode('|', $row['r_val']);
                                                                    foreach ($arr as $key => $val) {
                                                                        ?>
                                                                        <div class="input_item"
                                                                             style="display: flex;margin-top: 5px;">
                                                                            <input type='text' class='sup__name_child'
                                                                                   name='sup__name_child[]' id=''
                                                                                   value="<?= $val ?>"/>
                                                                            <button type="button" id="btn_del_name"
                                                                                    onclick="delName(this);"
                                                                                    class="btn_02">삭제
                                                                            </button>
                                                                        </div>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <input type='hidden' class='' name='sup__name[]' id=''
                                                                       value="<?= $row['r_val'] ?>"/>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='onlynum' name='sup__price[]'
                                                                       id=''
                                                                       style="text-align:right;"
                                                                       value="<?= $row['r_price'] ?>"/>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='onlynum'
                                                                       name='sup__price_2[]'
                                                                       style="text-align:right;"
                                                                       id=''
                                                                       value="<?= $row['r_price_2'] ?>"/>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='onlynum'
                                                                       name='sup__price_3[]'
                                                                       style="text-align:right;"
                                                                       id=''
                                                                       value="<?= $row['r_price_3'] ?>"/>
                                                            </td>
                                                            <td>
                                                                <button type="button" id="btn_del_option3"
                                                                        onclick="delOption2(<?= $row['rop_idx'] ?>, this);"
                                                                        class="btn_02">삭제
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                       style="margin-top:50px;">
                                    <caption>
                                    </caption>
                                    <colgroup>
                                        <col width="15%"/>
                                        <col width="90%"/>
                                    </colgroup>
                                    <tbody>

                                    <tr height="45">
                                        <th>호텔선택</th>
                                        <td>
                                            <select id="hotel_code" name="hotel_code" class="input_select"
                                                    onchange="fn_new_chgRoom(this.value)">
                                                <option value="">선택</option>
                                                <?php
                                                foreach ($fresult3 as $frow) {
                                                    ?>
                                                    <option value="<?= $frow["code_no"] ?>"
                                                        <?php if (isset($stay_idx) && $stay_idx === $frow["code_no"])
                                                            echo "selected"; ?>>
                                                        <?= $frow["stay_name_eng"] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span>(호텔을 선택해야 옵션에서 룸을 선택할 수 있습니다.)</span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <script>
                                    function fn_new_chgRoom() {
                                        let selectedValue = $('#hotel_code').val();

                                        if (selectedValue.startsWith("H0")) {
                                            selectedValue = selectedValue.substring(2);
                                        }

                                        document.getElementById("stay_idx").value = selectedValue;
                                    }
                                </script>
                            <?php endif; ?>
                        </div>
                    </form>

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">
                                <a href="/AdmMaster/_hotel/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <a href="javascript:send_it_price()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
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
        function productImagePreview(inputFile, onum) {
            if (sizeAndExtCheck(inputFile) == false) {
                inputFile.value = "";
                return false;
            }

            let imageTag = document.querySelector('label[for="ufile' + onum + '"]');

            if (inputFile.files.length > 0) {
                let imageReader = new FileReader();

                imageReader.onload = function () {
                    imageTag.style = "background-image:url(" + imageReader.result + ")";
                    inputFile.closest('.file_input').classList.add('applied');
                    inputFile.closest('.file_input').children[3].value = 'Y';
                }
                return imageReader.readAsDataURL(inputFile.files[0]);
            }
        }

        /**
         * 상품 이미지 삭제
         * @param {element} button
         */
        function productImagePreviewRemove(element) {
            let inputFile = element.parentNode.children[1];
            let labelImg = element.parentNode.children[2];

            inputFile.value = "";
            labelImg.style = "";
            element.closest('.file_input').classList.remove('applied');
            element.closest('.file_input').children[3].value = 'N';
        }

        function sizeAndExtCheck(input) {
            let fileSize = input.files[0].size;
            let fileName = input.files[0].name;

            // 20MB
            let megaBite = 20;
            let maxSize = 1024 * 1024 * megaBite;

            if (fileSize > maxSize) {
                alert("파일용량이 " + megaBite + "MB를 초과할 수 없습니다.");
                return false;
            }

            let fileNameLength = fileName.length;
            let findExtension = fileName.lastIndexOf('.');
            let fileExt = fileName.substring(findExtension, fileNameLength).toLowerCase();

            if (fileExt != ".jpg" && fileExt != ".jpeg" && fileExt != ".png" && fileExt != ".gif" && fileExt != ".bmp" && fileExt != ".ico") {
                alert("이미지 파일 확장자만 업로드 할 수 있습니다.");
                return false;
            }

            return true;
        }
    </script>
    <iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>