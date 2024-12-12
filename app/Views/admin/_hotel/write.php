<?php

use App\Controllers\Admin\AdminHotelController;

$formAction = $product_idx ? "/AdmMaster/_hotel/write_ok/$product_idx" : "/AdmMaster/_hotel/write_ok";
helper("my_helper");
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
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>

                            <li><a href="/AdmMaster/_hotel/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:prod_copy('<?= $product_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">제품복사</span></a>
                                </li>
                                <script>
                                    function prod_copy(idx) {
                                        if (!confirm("선택한 상품을 복사 하시겠습니까?"))
                                            return false;

                                        var message = "";
                                        $.ajax({

                                            url: "/AdmMaster/_tourRegist/prod_copy",
                                            type: "POST",
                                            data: {
                                                "product_idx": idx
                                            },
                                            dataType: "json",
                                            async: false,
                                            cache: false,
                                            success: function (data, textStatus) {
                                                alert(data.message);
                                                if (data.status == "success") {
                                                    const searchParams = new URLSearchParams(window.location.search);
                                                    searchParams.set('product_idx', data.newProductIdx);
                                                    location.href = window.location.pathname + '?' + searchParams.toString();
                                                }
                                            },
                                            error: function (request, status, error) {
                                                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                            }
                                        });
                                    }
                                </script>
                            <?php } ?>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li>
                                    <a href="javascript:del_it(`<?= route_to("admin._hotel.del") ?>`, `<?= $product_idx ?>`)"
                                       class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                </li>
                            <?php } else { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
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

                        <input type="hidden" name="chk_product_code" id="chk_product_code"
                               value='<?= $product_idx ? "Y" : "N" ?>'>

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

                                                <li class="new">[<?= $_tmp_code ?>] <?= get_cate_text($_tmp_code) ?>
                                                    <span
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
                                    <td>
                                        <input type="text" name="product_code" id="product_code"
                                               value="<?= $product_code_no ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if (empty($product_idx) || empty($product_code)) { ?>
                                            <!-- <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button> -->
                                            <button type="button" class="btn_01"
                                                    onclick="check_product_code('<?= $product_code_no ?>');">조회
                                            </button>
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>

                                    </td>
                                    <th>주소</th>
                                    <td>
                                        <input type="text" name="addrs" value="<?= $addrs ?? "" ?>" class="text"
                                               style="width:300px" maxlength="1000"/>
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
                                    <th>상품담당자</th>
                                    <td>
                                        <input id="product_manager" name="product_manager" class="input_txt" type="text"
                                               value="장은진과장" style="width:100px" readonly/>
                                        /<input id="phone" name="phone" class="input_txt" type="text"
                                                value="070-7430-5890" readonly
                                                style="width:200px"/>
                                        /<input id="email" name="email" class="input_txt"
                                                type="text" value="ej.jang@hihojoo.com" readonly
                                                style="width:200px"/>
                                        <select name="product_manager_id" id="product_manager_sel"
                                                onchange="change_manager(this.value)">
                                            <?php
                                            foreach ($member_list as $row_member) :
                                                ?>
                                                <option value="<?= $row_member["user_id"] ?>" <?php if ($product_manager_id == $row_member["user_id"]) {
                                                    echo "selected";
                                                } ?>><?= $row_member["user_name"] ?></option>
                                            <?php endforeach; ?>
                                            <option value="서소연 대리" <?php if ($product_manager == "서소연 대리") {
                                                echo "selected";
                                            } ?> >
                                                장은진
                                            </option>
                                        </select>
                                        <br><span style="color: gray;">* ex) 상품등록하는 담당자의 성함/연락처/이메일</span>
                                    </td>

                                    <th>판매상태결정</th>
                                    <td>
                                        <select name="product_status" id="product_status">
                                            <option value="sale" <?php if (isset($product_status) && $product_status === "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="plan" <?php if (isset($product_status) && $product_status === "plan") {
                                                echo "selected";
                                            } ?>>예약중지
                                            </option>
                                            <option value="stop" <?php if (isset($product_status) && $product_status === "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>등급</th>
                                    <td>
                                        <select name="product_level">
                                            <?php
                                            foreach ($fresult9 as $frow) {
                                                if (isset($product_level) && $product_level == $frow['code_no']) {
                                                    echo "<option value='" . $frow['code_no'] . "' selected>" . $frow['code_name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $frow['code_no'] . "' >" . $frow['code_name'] . "</option>";
                                                }
                                            }
                                            ?>
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

                            <style>
                                .list_value_ {
                                    display: flex;
                                    align-items: center;
                                    justify-content: start;
                                    gap: 10px;
                                    margin-top: 10px;
                                }

                                .list_value_ .item_ {
                                    position: relative;
                                    padding: 10px;
                                    border: 1px solid #dbdbdb;
                                }

                                .list_value_ .item_ .remove {
                                    position: absolute;
                                    color: #FFFFFF;
                                    cursor: pointer;
                                    padding: 0 6px 2px 6px;
                                    top: -10px;
                                    background-color: rgba(255, 0, 0, 0.8);
                                    border-radius: 50%;
                                    right: -5px;
                                    border: 1px solid rgba(255, 0, 0, 0.8);
                                }
                            </style>
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
                                        호텔정보
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔 테마</th>
                                    <td colspan="3">
                                        <select name="select_product_theme" id="select_product_theme"
                                                class="from-select">
                                            <option value="">선택</option>
                                            <?php foreach ($pthemes as $item) { ?>
                                                <option value="<?= $item['code_no'] ?>---<?= $item['code_name'] ?>"><?= $item['code_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="list_value_ list_value_theme">
                                            <?php
                                            $_product_theme_arr = explode("|", $product_theme);
                                            $_product_theme_arr = array_filter($_product_theme_arr);

                                            ?>
                                            <?php foreach ($pthemes as $item) { ?>
                                                <?php if (in_array($item['code_no'], $_product_theme_arr)) { ?>
                                                    <div class="item_">
                                                        <?= $item['code_name'] ?>
                                                        <input type="hidden" name="product_theme_"
                                                               value="<?= $item['code_no'] ?>">
                                                        <div class="remove" onclick="removeData(this)">
                                                            x
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔 침실수</th>
                                    <td colspan="3">
                                        <select name="select_product_bedrooms" id="select_product_bedrooms"
                                                class="from-select">
                                            <option value="">선택</option>
                                            <?php foreach ($pbedrooms as $item) { ?>
                                                <option value="<?= $item['code_no'] ?>---<?= $item['code_name'] ?>"><?= $item['code_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="list_value_ list_value_bedroom">
                                            <?php
                                            $_product_bedroom_arr = explode("|", $product_bedrooms);
                                            $_product_bedroom_arr = array_filter($_product_bedroom_arr);
                                            ?>
                                            <?php foreach ($pbedrooms as $item) { ?>
                                                <?php if (in_array($item['code_no'], $_product_bedroom_arr)) { ?>
                                                    <div class="item_">
                                                        <?= $item['code_name'] ?>
                                                        <input type="hidden" name="product_bedroom_"
                                                               value="<?= $item['code_no'] ?>">
                                                        <div class="remove" onclick="removeData(this)">
                                                            x
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔타입</th>
                                    <td colspan="3">
                                        <select name="select_product_type" id="select_product_type"
                                                class="from-select">
                                            <option value="">선택</option>
                                            <?php foreach ($ptypes as $item) { ?>
                                                <option value="<?= $item['code_no'] ?>---<?= $item['code_name'] ?>"><?= $item['code_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="list_value_ list_value_type">
                                            <?php
                                            $_product_type_arr = explode("|", $product_type);
                                            $_product_type_arr = array_filter($_product_type_arr);
                                            ?>
                                            <?php foreach ($ptypes as $item) { ?>
                                                <?php if (in_array($item['code_no'], $_product_type_arr)) { ?>
                                                    <div class="item_">
                                                        <?= $item['code_name'] ?>
                                                        <input type="hidden" name="product_type_"
                                                               value="<?= $item['code_no'] ?>">
                                                        <div class="remove" onclick="removeData(this)">
                                                            x
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔 프로모션</th>
                                    <td colspan="3">
                                        <select name="select_product_promotions" id="select_product_promotions"
                                                class="from-select">
                                            <option value="">선택</option>
                                            <?php foreach ($ppromotions as $item) { ?>
                                                <option value="<?= $item['code_no'] ?>---<?= $item['code_name'] ?>"><?= $item['code_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="list_value_ list_value_promotion">
                                            <?php
                                            $_product_promotion_arr = explode("|", $product_promotions);
                                            $_product_promotion_arr = array_filter($_product_promotion_arr);
                                            ?>
                                            <?php foreach ($ppromotions as $item) { ?>
                                                <?php if (in_array($item['code_no'], $_product_promotion_arr)) { ?>
                                                    <div class="item_">
                                                        <?= $item['code_name'] ?>
                                                        <input type="hidden" name="product_promotion_"
                                                               value="<?= $item['code_no'] ?>">
                                                        <div class="remove" onclick="removeData(this)">
                                                            x
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $('#select_product_theme').on('change', function () {
                                        let data = $(this).val();
                                        let arr = data.split('---');

                                        let value = arr[0];
                                        let name = arr[1];

                                        let theme = ` <div class="item_">
                                                ${name}
                                                <input type="hidden" name="product_theme_" value="${value}">
                                                <div class="remove" onclick="removeData(this)">
                                                    x
                                                </div>
                                            </div>`;

                                        let list_ = $('input[name="product_theme_"]');

                                        let isExist = false;
                                        list_.each(function () {
                                            if ($(this).val() === value || $(this).val() === '' || $(this).val() === null) {
                                                isExist = true;
                                            }
                                        })

                                        if (!isExist) {
                                            $('.list_value_theme').append(theme);
                                        }
                                    });

                                    $('#select_product_bedrooms').on('change', function () {
                                        let data = $(this).val();
                                        let arr = data.split('---');

                                        let value = arr[0];
                                        let name = arr[1];

                                        let bedroom = ` <div class="item_">
                                                ${name}
                                                <input type="hidden" name="product_bedroom_" value="${value}">
                                                <div class="remove" onclick="removeData(this)">
                                                    x
                                                </div>
                                            </div>`;

                                        let list_ = $('input[name="product_bedroom_"]');

                                        let isExist = false;
                                        list_.each(function () {
                                            if ($(this).val() === value || $(this).val() === '' || $(this).val() === null) {
                                                isExist = true;
                                            }
                                        })

                                        if (!isExist) {
                                            $('.list_value_bedroom').append(bedroom);
                                        }
                                    });

                                    $('#select_product_type').on('change', function () {
                                        let data = $(this).val();
                                        let arr = data.split('---');

                                        let value = arr[0];
                                        let name = arr[1];

                                        let type = ` <div class="item_">
                                                ${name}
                                                <input type="hidden" name="product_type_" value="${value}">
                                                <div class="remove" onclick="removeData(this)">
                                                    x
                                                </div>
                                            </div>`;

                                        let list_ = $('input[name="product_type_"]');

                                        let isExist = false;
                                        list_.each(function () {
                                            if ($(this).val() === value || $(this).val() === '' || $(this).val() === null) {
                                                isExist = true;
                                            }
                                        })

                                        if (!isExist) {
                                            $('.list_value_type').append(type);
                                        }
                                    });

                                    $('#select_product_promotions').on('change', function () {
                                        let data = $(this).val();
                                        let arr = data.split('---');

                                        let value = arr[0];
                                        let name = arr[1];

                                        let promotion = ` <div class="item_">
                                                ${name}
                                                <input type="hidden" name="product_promotion_" value="${value}">
                                                <div class="remove" onclick="removeData(this)">
                                                    x
                                                </div>
                                            </div>`;

                                        let list_ = $('input[name="product_promotion_"]');

                                        let isExist = false;
                                        list_.each(function () {
                                            if ($(this).val() === value || $(this).val() === '' || $(this).val() === null) {
                                                isExist = true;
                                            }
                                        })

                                        if (!isExist) {
                                            $('.list_value_promotion').append(promotion);
                                        }
                                    });
                                })

                                function removeData(el) {
                                    $(el).parent('.item_').remove();
                                }
                            </script>

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

                                </tbody>
                            </table>

                            <style>
                                .btnAddBreakfast {
                                    padding: 5px 7px;
                                    color: #fff;
                                    background: #4F728A;
                                    border: 1px solid #2b3f4c;
                                }

                                .btnDeleteBreakfast {
                                    padding: 5px 7px;
                                    color: #fff;
                                    background: #d03a3e;
                                    border: 1px solid #ba1212;
                                }
                            </style>
                            <?php
                            if ($product_more) {
                                $productMoreData = json_decode($product_more, true);

                                if (json_last_error() !== JSON_ERROR_NONE) {
//                                    die("Lỗi giải mã JSON: " . json_last_error_msg());
                                }
                                $breakfast_data = '';
                                if ($productMoreData) {
                                    $meet_out_time = $productMoreData['meet_out_time'];
                                    $children_policy = $productMoreData['children_policy'];
                                    $baby_beds = $productMoreData['baby_beds'];
                                    $deposit_regulations = $productMoreData['deposit_regulations'];
                                    $pets = $productMoreData['pets'];
                                    $age_restriction = $productMoreData['age_restriction'];
                                    $smoking_policy = $productMoreData['smoking_policy'];
                                    $breakfast = $productMoreData['breakfast'];
                                    $breakfast_data = $productMoreData['breakfast_data'];
                                }
                            }

                            $breakfast_data_arr = explode('||||', $breakfast_data ?? "");
                            $breakfast_data_arr = array_filter($breakfast_data_arr);
                            ?>
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
                                        세부정보
                                    </td>
                                </tr>

                                <tr>
                                    <th>체크인 & 체크아웃 시간</th>
                                    <td>
                                        <textarea name="meet_out_time" id="meet_out_time"
                                                  style="width:90%;height:100px;"><?= $meet_out_time ?? "" ?></textarea>
                                    </td>
                                    <th>어린이 정책</th>
                                    <td>
                                        <textarea name="children_policy" id="children_policy"
                                                  style="width:90%;height:100px;"><?= $children_policy ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>유아용 침대 및 엑스트라 베드</th>
                                    <td>
                                        <textarea name="baby_beds" id="baby_beds"
                                                  style="width:90%;height:100px;"><?= $baby_beds ?? "" ?></textarea>
                                    </td>
                                    <th>조식</th>
                                    <td>
                                        <textarea name="breakfast" id="breakfast"
                                                  style="width:90%;height:100px;"><?= $breakfast ?? "" ?></textarea>
                                        <div class="" style="margin-top: 10px">
                                            <button type="button" class="btnAddBreakfast">추가</button>
                                        </div>
                                        <table style="width:90%">
                                            <tbody id="tBodyTblBreakfast">
                                            <?php foreach ($breakfast_data_arr as $dataBreakfast) { ?>
                                                <?php
                                                $dataBreakfastArr = explode('::::', $dataBreakfast);
                                                ?>
                                                <tr>
                                                    <th style="width: 30%">
                                                        <input type="text" name="breakfast_item_name_[]"
                                                               value="<?= $dataBreakfastArr[0] ?? "" ?>">
                                                    </th>
                                                    <td style="width: 60%">
                                                        <input type="text" name="breakfast_item_value_[]"
                                                               value="<?= $dataBreakfastArr[1] ?? "" ?>">
                                                    </td>
                                                    <td style="width: 10%">
                                                        <button type="button" class="btnDeleteBreakfast"
                                                                onclick="removeBreakfast(this);">삭제
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <th>보증금 규정</th>
                                    <td>
                                        <textarea name="deposit_regulations" id="deposit_regulations"
                                                  style="width:90%;height:100px;"><?= $deposit_regulations ?? "" ?></textarea>
                                    </td>
                                    <th>반려동물</th>
                                    <td>
                                        <textarea name="pets" id="pets"
                                                  style="width:90%;height:100px;"><?= $pets ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>연령 제한</th>
                                    <td>
                                        <textarea name="age_restriction" id="age_restriction"
                                                  style="width:90%;height:100px;"><?= $age_restriction ?? "" ?></textarea>
                                    </td>
                                    <th>흡연 정책</th>
                                    <td>
                                        <textarea name="smoking_policy" id="smoking_policy"
                                                  style="width:90%;height:100px;"><?= $smoking_policy ?? "" ?></textarea>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <script>
                                let tr = ` <tr>
                                                <th style="width: 30%">
                                                    <input type="text" name="breakfast_item_name_[]">
                                                </th>
                                                <td style="width: 60%">
                                                    <input type="text" name="breakfast_item_value_[]">
                                                </td>
                                                <td style="width: 10%">
                                                    <button type="button" class="btnDeleteBreakfast" onclick="removeBreakfast(this);">삭제</button>
                                                </td>
                                            </tr>`;

                                $('.btnAddBreakfast').click(function () {
                                    $('#tBodyTblBreakfast').append(tr);
                                });

                                function removeBreakfast(el) {
                                    $(el).parent().parent().remove();
                                }
                            </script>

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
                                    <th>유의사항(pc)</th>
                                    <td>

                                        <textarea name="product_important_notice" id="product_important_notice"
                                                  rows="10" cols="100"
                                                  class="input_txt"
                                                  style="width:100%; height:400px; display:none;"><?= viewSQ($product_important_notice) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "product_important_notice",
                                                sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                    <th>유의사항(mobile)</th>
                                    <td>

                                        <textarea name="product_notes" id="product_notes" rows="10" cols="100"
                                                  class="input_txt"
                                                  style="width:100%; height:400px; display:none;"><?= viewSQ($product_notes) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors2 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors2,
                                                elPlaceHolder: "product_notes",
                                                sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                                                    fOnBeforeUnload: function () {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function () {
                                                    //예제 코드
                                                    //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                                },
                                                fCreator: "createSEditor2"
                                            });
                                        </script>

                                    </td>
                                </tr>
                                </tbody>
                            </table>

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
                                                onchange="fn_chgRoom(this.value)">
                                            <option value="">선택</option>
                                            <?php
                                            foreach ($fresult3 as $frow) {
                                                ?>
                                                <option value="<?= $frow["code_no"] ?>"
                                                    <?php if (isset($hotel_code) && $hotel_code === $frow["code_no"])
                                                        echo "selected"; ?>>
                                                    <?= $frow["stay_name_eng"] ?></option>
                                            <?php } ?>
                                        </select>
                                        <!-- <div style="position: relative; width: 285px">
                                            <input type="text" id="hotel_code" name="hotel_code" class="input_select">
                                            <div class="search_hotel" style="position: absolute; top: 5px; right: 5px;">
                                                <img src="/images/ico/keyword_ic.png" alt="" style="width: 80%">
                                            </div>
                                        </div> -->
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
                                                        </col>
                                                        <col width="30%">
                                                        </col>
                                                        <col width="10%">
                                                        </col>
                                                        <col width="10%">
                                                        </col>
                                                        <col width="10%">
                                                        </col>
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th>객실명</th>
                                                        <th>기간</th>
                                                        <th>가격(단위: 바트)</th>
                                                        <th>우대가격(단위: 바트)</th>
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
                                                                <input type='hidden' name='o_room[]' id=''
                                                                       value="<?= $frow3['o_room'] ?>" size="70"/>
                                                                <input type='hidden' name='o_name[]' id=''
                                                                       value="<?= $frow3['goods_name'] ?>" size="70"/>
                                                                <span class="room_option_"
                                                                      data-id="<?= $frow3['o_room'] ?>"><?= $frow3['goods_name'] ?></span>
                                                            </td>
                                                            <td>
                                                                <div style="display: flex; align-items: center; gap: 5px">
                                                                    <input type='text' readonly
                                                                           class='s_date datepicker' name='o_sdate[]'
                                                                           value='<?= $frow3['o_sdate'] ?>'
                                                                           style='width:35%'/> ~
                                                                    <input type='text' readonly
                                                                           class='e_date datepicker' name='o_edate[]'
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

                                                            <!--td>
                                                                <input type='text' class='' name='o_soldout[]' id=''
                                                                       style='width:100%;'
                                                                       value="<?= $frow3['o_soldout'] ?>"/>
                                                            </td-->
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
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>방 이름</th>
                                                    <th>객실 상세</th>
                                                    <th>옵션명</th>
                                                    <th>가격(단위: 바트)</th>
                                                    <th>우대 가격(단위: 바트)</th>
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
                                                            <input type='text' class='onlynum' name='sup__price[]' id=''
                                                                   style="text-align:right;"
                                                                   value="<?= $row['r_price'] ?>"/>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='onlynum' name='sup__price_sale[]'
                                                                   style="text-align:right;"
                                                                   id=''
                                                                   value="<?= $row['r_sale_price'] ?>"/>
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

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>

                                <tr height="45">
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
                                                $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
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
                                                $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
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
                                </tbody>
                            </table>

                            <!-- <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
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
                                        <?php if (isset($ufile1) && $ufile1 !== "") { ?><br>파일삭제:<input type=checkbox
                                                                                                        name="del_1"
                                                                                                        value='Y'><a
                                                href="/data/product/<?= $ufile1 ?>"
                                                class="imgpop"><?= $rfile1 ?></a><br><br>
                                            <img src="/data/product/<?= $ufile1 ?>" width="200px"/>
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
                                                        href="/data/product/<?= ${"ufile" . $i} ?>"
                                                        class="imgpop"><?= ${"rfile" . $i} ?></a><br><br>
                                                <img src="/data/product/<?= ${"ufile" . $i} ?>" width="200px"/>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table> -->
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

                    <div id="popup_hotel" class="popup pick_item_pop02">
                        <div>
                            <div class="search_box">
                                <form name="pick_item_search" id="pick_item_search" onsubmit="return false">
                                    <input type="text" id="search_txt" onkeyup="press_it()" name="search_txt" value=""
                                           class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px">
                                    <a href="javascript:search_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                                </form>
                            </div>
                            <div class="table_box" style="height: calc(100% - 72px);">
                                <form method="post" name="select_pick_frm" id="select_pick_frm">
                                    <input type="hidden" name="isrt_code" id="isrt_code" value="">
                                    <table>
                                        <caption>상품찾기</caption>
                                        <colgroup>
                                            <col style="width: 30%;">
                                            <col style="width: 50%">
                                            <col style="width: 20%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>선택</th>
                                            <th>주소</th>
                                            <th>전택</th>
                                        </tr>
                                        </thead>
                                        <tbody id="id_content">
                                        <?php
                                        foreach ($fresult3 as $frow) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $frow["code_no"] ?></td>
                                                <td class="text-center"><?= $frow["stay_name_eng"] ?></td>
                                                <td class="text-center"><p
                                                            onclick="fn_chgRoom('<?= $frow["code_no"] ?>')">[선택]</p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">
                                <a href="/AdmMaster/_hotel/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($product_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <a href="javascript:del_it(`<?= route_to("admin._hotel.del") ?>`, `<?= $product_idx ?>`)"
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