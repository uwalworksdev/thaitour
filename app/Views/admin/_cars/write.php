<?php
$formAction = $product_idx ? "/AdmMaster/_cars/write_ok/$product_idx" : "/AdmMaster/_cars/write_ok";
?>
<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <style>
        .btn_01 {
            height: 32px !important;
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

$titleStr = "차량 정보관리";
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
                        <input type="hidden" name="mbti" id="mbti"
                               value='<?= $mbti ?? "" ?>'/>

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
                        <!-- <input type="hidden" name="chk_product_code" id="chk_product_code"
                            value='<?= $product_idx ? "Y" : "N" ?>'> -->
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
                                        <select id="product_code_1" class="input_select"
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
                                        <select id="product_code_2" class="input_select"
                                                onchange="get_code(this.value, 4)">
                                            <option value="">2차분류</option>
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
                                               value="<?= $product_code_no ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if (empty($product_idx) || empty($product_code)) { ?>
                                            <!-- <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button> -->
                                            <!-- <button type="button" class="btn_01" onclick="check_product_code('<?= $product_code_no ?>');">조회</button> -->
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>

                                    </td>
                                </tr>

                                <tr>
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="product_name"
                                               value="<?= $product_name ?? "" ?>"
                                               class="text" style="width:300px" maxlength="100"/>
                                    </td>
                                </tr>

                                <tr class="" style="display: none !important;">
                                    <th>
                                        MBTI
                                        <input type="checkbox" id="all_code_mbti" class="all_input"
                                               name="_code_mbti" value=""/>
                                        <label for="all_code_mbti">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $mbti);
                                        foreach ($mcodes as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_mbti<?= $row_r['code_no'] ?>"
                                                   name="_code_mbti" class="code_mbti"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                            <label for="code_mbti<?= $row_r['code_no'] ?>">
                                                <?= $row_r['code_name'] ?>
                                            </label>
                                        <?php endforeach; ?>
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
                                        <select name="is_view" id="is_view">
                                            <option value="Y" <?php if ($is_view == "Y") echo "selected"; ?> >
                                                사용
                                            </option>
                                            <option value="N" <?php if ($is_view != "Y") echo "selected"; ?> >
                                                사용안함
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
                                    <th>최소 차량대수</th>
                                    <td>
                                        <input id="minium_people_cnt" name="minium_people_cnt"
                                               class="input_txt only_number"
                                               type="text"
                                               value="<?= $minium_people_cnt ? $minium_people_cnt : "0" ?>"
                                               style="width:100%"/>
                                    </td>
                                    <th>최대 차량대수</th>
                                    <td>
                                        <input id="total_people_cnt" name="total_people_cnt"
                                               class="input_txt only_number"
                                               type="text"
                                               value="<?= $total_people_cnt ? $total_people_cnt : "0" ?>"
                                               style="width:100%"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>좌석수(성인)</th>
                                    <td>
                                        <input id="adult_people_cnt" name="adult_people_cnt"
                                               class="input_txt only_number"
                                               type="text"
                                               value="<?= $adult_people_cnt ? $adult_people_cnt : "0" ?>"
                                               style="width:100%"/>
                                    </td>
                                    <th>총 좌석 수(성인 + 소아)</th>
                                    <td>
                                        <input id="people_cnt" name="people_cnt" class="input_txt only_number"
                                               type="text"
                                               value="<?= $people_cnt ? $people_cnt : "0" ?>" style="width:100%"/>
                                    </td>
                                </tr>

                                <!-- <tr>
                                <th>간략소개</th>
                                <td colspan="3">
                                    <textarea name="product_info" id="product_info"
                                                style="width:90%;height:100px;"><?= $product_info ?? "" ?></textarea>
                                </td>
                            </tr> -->
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
                                               value="<?= $original_price ?? "" ?>"/> 바트
                                    </td>
                                </tr>

                                <tr>
                                    <th>판매가격</th>
                                    <td colspan="3">
                                        <input type="text" name="product_price" id="product_price" class="onlynum"
                                               style="text-align:right;width: 200px;"
                                               value="<?= $product_price ?? "" ?>"/> 바트
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <!-- <div class="listBottom">
                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                    <caption>
                                    </caption>
                                    <colgroup>
                                        <col width="10%"/>
                                        <col width="90%"/>
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <?php
                                        $arr_departure_area = array_filter(explode(",", $departure_area));
                                        $arr_destination_area = array_filter(explode(",", $destination_area));
                                        ?>
                                        <th>
                                            <input type="checkbox" id="all_departure_area" class="all_input"
                                                <?php if (count($arr_departure_area) == count($place_start_list)) {
                                                    echo "checked";
                                                } ?>>
                                            <label for="all_departure_area">
                                                출발지역
                                            </label>
                                        </th>
                                        <td>
                                            <?php
                                            foreach ($place_start_list as $start) {
                                                ?>
                                                <input type="checkbox" id="departure_area_<?= $start["code_no"] ?>"
                                                       name="departure_area[]"
                                                       class="departure_area" value="<?= $start["code_no"] ?>"
                                                    <?php if (in_array($start["code_no"], $arr_departure_area)) {
                                                        echo "checked";
                                                    } ?>>
                                                <label for="departure_area_<?= $start["code_no"] ?>"><?= $start["code_name"] ?></label>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="all_destination_area" class="all_input"
                                                <?php if (count($arr_destination_area) == count($place_end_list)) {
                                                    echo "checked";
                                                } ?>>
                                            <label for="all_destination_area">
                                                도착지역
                                            </label>
                                        </th>
                                        <td>
                                            <?php
                                            foreach ($place_end_list as $end) {
                                                ?>
                                                <input type="checkbox" id="destination_area_<?= $end["code_no"] ?>"
                                                       name="destination_area[]"
                                                       class="destination_area" value="<?= $end["code_no"] ?>"
                                                    <?php if (in_array($end["code_no"], $arr_destination_area)) {
                                                        echo "checked";
                                                    } ?>>
                                                <label for="destination_area_<?= $end["code_no"] ?>"><?= $end["code_name"] ?></label>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> -->

                            <!-- <?php
                            if (isset($product_idx) && count($arr_departure_area) > 0 && count($arr_destination_area) > 0) {
                                ?>
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
                                            </th>
                                            <td>
                                                <button type="button" onclick="showPopup();">설정</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            ?> -->

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
                                            <button style="margin: 0px;" type="button" class="btn_01"
                                                    onclick="add_option();">추가
                                            </button>
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
                                                foreach ($options as $option) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class='flex_c_c'>
                                                                <input type='hidden' name='option_idx[]'
                                                                       value='<?= $option["idx"] ?>'>
                                                                <input type='hidden' class='c_op_type'
                                                                       name='c_op_type[]'
                                                                       value='<?= $option["c_op_type"] ?>'>
                                                                <input type='text' class='c_op_name' name='c_op_name[]'
                                                                       value='<?= $option["c_op_name"] ?>'>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class='flex_c_c' style='gap: 10px;'>
                                                                <?php
                                                                foreach ($cfresult as $c_type) {
                                                                    ?>
                                                                    <div class='check_wrap'>
                                                                        <input type='checkbox'
                                                                               value='<?= $c_type['code_no'] ?>'
                                                                            <?php if (strpos($option["c_op_type"], $c_type['code_no']) !== false) {
                                                                                echo "checked";
                                                                            } ?>>
                                                                        <label for=''><?= $c_type['code_name'] ?></label>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td class='tac'>
                                                            <button style='margin: 0;' type='button' class='btn_02'
                                                                    onclick='delOption("<?= $option["idx"] ?>", this);'>
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

                                        <div class="img_add">
                                            <?php
                                            for ($i = 1; $i <= 1; $i++) :
                                                $img = get_img(${"ufile" . $i}, "/data/cars/", "600", "440");
                                                // $img ="/data/product/" . ${"ufile" . $i};
                                                ?>
                                                <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                           onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
                                                    <a class="img_txt imgpop" href="<?= $img ?>"
                                                       id="text_ufile<?= $i ?>">미리보기</a>

                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                        </div>

                                    </td>
                                </tr>


                                <tr>
                                    <th>서브이미지(600X400)</th>
                                    <td colspan="3">
                                        <div class="img_add">
                                            <?php
                                            for ($i = 2; $i <= 7; $i++) :
                                                $img = get_img(${"ufile" . $i}, "/data/cars/", "600", "440");
                                                ?>
                                                <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                           onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
                                                    <a class="img_txt imgpop" href="<?= $img ?>"
                                                       id="text_ufile<?= $i ?>">미리보기</a>
                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                        </div>
                                    </td>
                                </tr>
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
    <div class="pop_common detail_pop">
        <div class="pop_item">
            <div class="pop_top">
                <button type="button" class="btn_close no_txt" onclick="PopCloseBtn('.detail_pop')">
                    닫기
                </button>
            </div>
            <div class="pop_mid">
                <div>
                    <select name="select_departure_code" id="select_departure_code">
                        <?php
                        foreach ($place_start_list as $code) {
                            if (count($arr_departure_area) > 0 && in_array($code["code_no"], $arr_departure_area)) {
                                ?>
                                <option value="<?= $code["code_no"] ?>"><?= $code["code_name"] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                    <select name="select_destination_code" id="select_destination_code">
                        <?php
                        foreach ($place_end_list as $code) {
                            if (count($arr_destination_area) > 0 && in_array($code["code_no"], $arr_destination_area)) {
                                ?>
                                <option value="<?= $code["code_no"] ?>"><?= $code["code_name"] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <button class="btn_01" onclick="add_option_sub();">추가</button>
                </div>
                <div class="listBottom">
                    <form name="sFrm" id="sFrm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_idx" id="product_idx" value="<?= $product_idx ?? "" ?>">
                        <table class="listTable mem_detail">
                            <colgroup>
                                <col width="25%"/>
                                <col width="25%"/>
                                <col width="*%"/>
                                <col width="20%"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>출발지역</th>
                                <th>도착지역</th>
                                <th>판매가격</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody id="list_option_sub">
                            <?php
                            foreach ($cars_sub_list as $car_sub) {
                                ?>
                                <tr>
                                    <input type='hidden' name='cars_sub_idx[]' class='cars_sub_idx'
                                           value='<?= $car_sub["idx"] ?>'>
                                    <td>
                                        <div class="flex_c_c">
                                            <input type='hidden' name='departure_code[]' class='departure_code'
                                                   value='<?= $car_sub["departure_code"] ?>'>
                                            <span class='departure_name'><?= $car_sub["departure_name"] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex_c_c">
                                            <input type='hidden' name='destination_code[]' class='destination_code'
                                                   value='<?= $car_sub["destination_code"] ?>'>
                                            <span class='destination_name'><?= $car_sub["destination_name"] ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type='text' name='car_price[]' class='car_price' maxlength="10"
                                               value='<?= $car_sub["car_price"] ?>'>
                                    </td>
                                    <td class='tac'>
                                        <button style='margin: 0;' type='button' class='btn_02'
                                                onclick='delOptionSub("<?= $car_sub["idx"] ?>", this);'>삭제
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="pop_bot">
                <div class="btn_wrap flex_c_c">
                    <button type="button" class="btn btn-success" onclick="PopCloseBtn('.detail_pop')">
                        취소
                    </button>
                    <button class="btn btn-primary" onclick="send_cars_sub();">확인</button>
                </div>
            </div>
        </div>
        <div class="pop_dim"></div>
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

        $("#all_departure_area").on("change", function () {
            if ($(this).is(":checked")) {
                $(".departure_area").prop("checked", true);
            } else {
                $(".departure_area").prop("checked", false);
            }
        });

        $(".departure_area").on("click", function () {
            var checkAll = true;

            $('.departure_area').each(function () {
                if (!$(this).is(":checked")) {
                    checkAll = false;
                    return false;
                }
            });

            if (checkAll) {
                $("#all_departure_area").prop("checked", true)
            } else {
                $("#all_departure_area").prop("checked", false)
            }
        });

        $("#all_destination_area").on("change", function () {
            if ($(this).is(":checked")) {
                $(".destination_area").prop("checked", true);
            } else {
                $(".destination_area").prop("checked", false);
            }
        });

        $(".destination_area").on("click", function () {
            var checkAll = true;

            $('.destination_area').each(function () {
                if (!$(this).is(":checked")) {
                    checkAll = false;
                    return false;
                }
            });

            if (checkAll) {
                $("#all_destination_area").prop("checked", true)
            } else {
                $("#all_destination_area").prop("checked", false)
            }
        });
    </script>
    <script>
        $('.car_price').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('.only_number').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        function showPopup() {
            $(".detail_pop").show();
        }

        function add_option() {
            var addOption = "";
            addOption += "<tr>";
            addOption += "<td>";
            addOption += "<div class='flex_c_c'>";
            addOption += "<input type='hidden' name='option_idx[]' id='option_idx_' value=''>";
            addOption += "<input type='text' class='c_op_name' name='c_op_name[]' value=''>";
            addOption += "<input type='hidden' class='c_op_type' name='c_op_type[]' value=''>";
            addOption += "</div>";
            addOption += "</td>";
            addOption += "<td>";
            addOption += "<div class='flex_c_c' style='gap: 10px;'>";
            <?php
            foreach($cfresult as $c_type){
            ?>
            addOption += "<div class='check_wrap'>";
            addOption += "<input type='checkbox' value='<?=$c_type['code_no']?>'>";
            addOption += "<label for=''><?=$c_type['code_name']?></label>";
            addOption += " </div>";
            <?php
            }
            ?>
            addOption += "</div>";
            addOption += "</td>"
            addOption += "<td class='tac'>";
            addOption += "<button style='margin: 0;' type='button' class='btn_02' onclick='delOption(\"\",this);'>삭제</button>";
            addOption += "</td>";
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

        function add_option_sub() {

            let departure_code = $("#select_departure_code").val();
            let destination_code = $("#select_destination_code").val();

            let departure_name = $("#select_departure_code option:selected").text();
            let destination_name = $("#select_destination_code option:selected").text();

            let check = true;

            $("#list_option_sub tr").each(function () {
                if (departure_code == $(this).find(".departure_code").val()
                    && destination_code == $(this).find(".destination_code").val()) {
                    check = false;
                    return;
                }
            });

            if (check) {
                var addOptionSub = ``;
                addOptionSub += `<tr>`;
                addOptionSub += `<input type='hidden' name='cars_sub_idx[]' class='cars_sub_idx' value=''>`;
                addOptionSub += `<td>`;
                addOptionSub += `<div class='flex_c_c'>`;
                addOptionSub += `<input type='hidden' name='departure_code[]' class='departure_code' value='${departure_code}'>`;
                addOptionSub += `<span class='departure_name'>${departure_name}</span>`;
                addOptionSub += `</div>`;
                addOptionSub += `<td>`;
                addOptionSub += `<div class='flex_c_c'>`;
                addOptionSub += `<input type='hidden' name='destination_code[]' class='destination_code' value='${destination_code}'>`;
                addOptionSub += `<span class='destination_name'>${destination_name}</span>`;
                addOptionSub += `</div>`;
                addOptionSub += `</td>`;
                addOptionSub += `<td>`;
                addOptionSub += `<input type='text' name='car_price[]' maxlength='10' class='car_price'>`;
                addOptionSub += `</td>`;
                addOptionSub += `<td class='tac'>`;
                addOptionSub += `<button style='margin: 0;' type='button' class='btn_02' onclick='delOptionSub(\"\",this);'>삭제</button>`;
                addOptionSub += `</td>`;
                addOptionSub += `</tr>`;

                $("#list_option_sub").append(addOptionSub);
            } else {
                alert("위치가 중복되었습니다.");
                return;
            }

            $('.car_price').on('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        function delOptionSub(idx, obj) {
            if (confirm("정말 삭제하시겠습니까?")) {

                if (idx) {
                    $.ajax({
                        url: "/AdmMaster/_cars/cars_sub_del",
                        type: "POST",
                        data: "idx=" + idx,
                        error: function (request, status, error) {
                            //통신 에러 발생시 처리
                            alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        }
                        , success: function (response, status, request) {
                            alert(response.message);
                        }
                    });
                }

                $(obj).closest("tr").remove();
            }
        }

        function send_cars_sub() {
            $.ajax({
                url: "/AdmMaster/_cars/cars_sub_ok",
                type: "POST",
                data: $("#sFrm").serialize(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    return;
                }
            });
        }

        $('#all_code_mbti').change(function () {
            if ($('#all_code_mbti').is(':checked')) {
                $('.code_mbti').prop('checked', true)
            } else {
                $('.code_mbti').prop('checked', false)
            }
        });

        function send_it_c() {
            let _code_mbtis = '';
            $("input[name=_code_mbti]:checked").each(function () {
                _code_mbtis += $(this).val() + '|';
            })

            $("#mbti").val(_code_mbtis);

            $("#list_option tr").each(function () {
                let arr_type = [];
                $(this).find(".check_wrap").each(function () {
                    if ($(this).find("input[type='checkbox']").is(":checked")) {
                        arr_type.push($(this).find("input[type='checkbox']").val());
                    }
                });
                $(this).find(".c_op_type").val(arr_type.join(","));
            });

            var frm = document.frm;

            if (frm.product_code_list.value == "") {
                alert("카테고리를 등록해주세요.");
                $("#product_code_1").focus();
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