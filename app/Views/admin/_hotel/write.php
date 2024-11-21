<?php

use App\Controllers\Admin\AdminHotelController;

$formAction = $product_idx ? "/AdmMaster/_hotel/write_ok/$product_idx" : "/AdmMaster/_hotel/write_ok";

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
                                <li><a href="javascript:copy_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">제품복사</span></a>
                                </li>
                                <script>
                                    function copy_it() {
                                        if (confirm("제품을 복사하시겠습니까?")) {
                                            location.href = "copy2?product_idx=<?= $product_idx ?>";
                                        }
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
                                        <select id="product_code_1" name="product_code_1" class="input_select" onchange="get_code(this.value, 3)">
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
                                        <select id="product_code_2" name="product_code_2" class="input_select" onchange="get_code(this.value, 4)">
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
                                    <th>주소</th>
                                    <td>
                                        <input type="text" name="addrs" value="<?= $addrs ?? "" ?>" class="text"
                                               style="width:300px" maxlength="1000"/>
                                    </td>
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
                                </tr>
                                <tr>
                                    <th>객실수</th>
                                    <td colspan="3">
                                        <input type="text" name="room_cnt" value="<?= $room_cnt ?? "" ?>" class="text"
                                               style="width:300px" maxlength="50"/>
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
                                        제품정보
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔 테마</th>
                                    <td colspan="3">
                                        <select name="select_product_theme" id="select_product_theme"
                                                class="from-select">
                                            <option value="">선택하다</option>
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
                                            <option value="">선택하다</option>
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
                                            <option value="">선택하다</option>
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
                                            <option value="">선택하다</option>
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

							            <div class="listBottom">
											<table cellpadding="0" cellspacing="0" summary="" class="listTable">
												<caption></caption>
												<colgroup>
													<col width="10%">
													<col width="10%">
													<col width="*">
													<col width="10%">
													<!--col width="10%">
													<col width="10%"-->
													<col width="10%">
												</colgroup>
												<thead>
													<tr>
														<th>시작일</th>
														<th>종료일</th>
														<th>선택요일</th>
														<th>가격</th>
														<!--th>소인가격</th>
														<th>경로가격</th-->
														<th>가격추가</th>
													</tr>
												</thead>
												<tbody>
													<tr style="height:50px">
														<td class="tac">
															<input type="text" name="s_date" value="" id="s_date" class="datepicker" style="text-align: center;background: white; width: 90%;" readonly="">								
														</td>
														<td class="tac">
															<input type="text" name="e_date" value="" id="e_date" class="datepicker" style="text-align: center;background: white; width: 90%;" readonly="">								
														</td>
														<td class="tac"> 
															<input type="checkbox" name="yoil_0" id="yoil_0" value="Y" class="yoil"> 일요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_1" id="yoil_1" value="Y" class="yoil"> 월요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_2" id="yoil_2" value="Y" class="yoil"> 화요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_3" id="yoil_3" value="Y" class="yoil"> 수요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_4" id="yoil_4" value="Y" class="yoil"> 목요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_5" id="yoil_5" value="Y" class="yoil"> 금요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_6" id="yoil_6" value="Y" class="yoil"> 토요일&nbsp;&nbsp;&nbsp;
														</td>
														<td style="text-align:center"><input type="text" name="price1" id="price1" value="0" class="price price1 input_txt" style="width:90%;text-align:right;"></td>
														<!--td style="text-align:center"><input type="text" name="price2" id="price2" value="0" class="price price2 input_txt" style="width:90%;text-align:right;"></td>
														<td style="text-align:center"><input type="text" name="price3" id="price3" value="0" class="price price3 input_txt" style="width:90%;text-align:right;"></td-->
														<td>
															<a href="#!" onclick="isrt_price();" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">가격추가</span></a>
														</td>
													</tr>
											</tbody>
											</table>
										</div>

										<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
										<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
										<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui/1.13.2/i18n/datepicker-ko.min.js"></script>

										<script>
											$(function() {
												// Datepicker에 한국어 설정 적용
												$.datepicker.setDefaults($.datepicker.regional['ko']);
												
												// 시작일과 종료일 초기화
												var startDatePicker = $("#s_date");
												var endDatePicker   = $("#s_date");
												
												startDatePicker.datepicker({
													dateFormat: "yy-mm-dd",
													onClose: function(selectedDate) {
														if (selectedDate) {
															endDatePicker.datepicker("option", "minDate", selectedDate);
														}
													}
												});

												endDatePicker.datepicker({
													dateFormat: "yy-mm-dd",
													onClose: function(selectedDate) {
														if (selectedDate) {
															startDatePicker.datepicker("option", "maxDate", selectedDate);
														}
													}
												});
											});
										</script>

							            <div class="listBottom">
											<table cellpadding="0" cellspacing="0" summary="" class="listTable">
												<caption></caption>
												<colgroup>
													<col width="5%">
													<col width="10%">
													<col width="10%">
													<col width="*">
													<col width="10%">
													<col width="10%">
													<col width="20%">
												</colgroup>
												<thead>
													<tr>
														<th>번호</th>
														<th>시작일</th>
														<th>종료일</th>
														<th>선택요일</th>
														<th>마감</th>
														<th>등록일</th>
														<th>관리</th>
													</tr>
												</thead>
												<tbody>
																			<tr style="height:50px">
														<td>1</td>
														<td class="tac">
															2024-11-01								
														</td>
														<td class="tac">
															2024-11-30								
														</td>
														<td class="tac"> 
															<input type="checkbox" name="yoil_0" id="yoil_0_162" value="Y" checked="" class="yoil" disabled=""> 일요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_1" id="yoil_1_162" value="Y" checked="" class="yoil" disabled=""> 월요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_2" id="yoil_2_162" value="Y" checked="" class="yoil" disabled=""> 화요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_3" id="yoil_3_162" value="Y" checked="" class="yoil" disabled=""> 수요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_4" id="yoil_4_162" value="Y" class="yoil" disabled=""> 목요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_5" id="yoil_5_162" value="Y" class="yoil" disabled=""> 금요일&nbsp;&nbsp;&nbsp;
															<input type="checkbox" name="yoil_6" id="yoil_6_162" value="Y" class="yoil" disabled=""> 토요일&nbsp;&nbsp;&nbsp;
														</td>
														<td>
															<input type="checkbox" name="sale" id="sale_162" value="N" class="yoil" disabled="">
														</td>
														<td class="tac">
															2024-11-04 15:00:21							</td>
														<td>
															<a href="../_tourPrice/write_new.php?s_product_code_1=&amp;s_product_code_2=&amp;s_product_code_2=&amp;search_name=&amp;search_category=&amp;pg=1&amp;product_idx=3148&amp;back_url=write.php&amp;yoil_idx=162" class="btn btn-default">가격수정</a>
															
																							<a href="javascript:close_yoil('162');" class="btn btn-default">마감처리</a>
															
															<a href="javascript:del_yoil('162');" class="btn btn-default">삭제하기</a>
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
                                    die("Lỗi giải mã JSON: " . json_last_error_msg());
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
                                        자세한 정보
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
                                            <button type="button" class="btnAddBreakfast">수정</button>
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
                                        </select> <span>(호텔을 선택해야 옵션에서 룸을 선택할 수 있습니다.)</span>
                                    </td>
                                </tr>


                                <tr height="45">
                                    <th>
                                        객실등록
                                        <p style="display:block;margin-top:10px;">
                                            <select name="roomIdx" id="roomIdx" class="input_select">

                                            </select>
                                            <button type="button" id="btn_add_option" class="btn_01">추가</button>
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
                                                        <col width="25%">
                                                        </col>
                                                        <col width="10%">
                                                        </col>
                                                        <col width="30%">
                                                        </col>
                                                        <col width="10%">
                                                        </col>
                                                    </colgroup>
                                                    <thead>
                                                    <tr>
                                                        <th>객실명</th>
                                                        <th>기간</th>
                                                        <th>가격</th>
                                                        <th>마감날짜</th>
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
                                                                <input type='text' readonly class='datepicker '
                                                                       name='o_sdate[]'
                                                                       value='<?= $frow3['o_sdate'] ?>' style='width:40%' /> ~
                                                                <input type='text' readonly class='datepicker '
                                                                       name='o_edate[]'
                                                                       value='<?= $frow3['o_edate'] ?>' style='width:40%' />
                                                            </td>
                                                            <td>
                                                                <input type='text' class='onlynum' name='o_price1[]'
                                                                       id=''
                                                                       value="<?= $frow3['goods_price1'] ?>"/>
                                                            </td>

                                                            <td>
                                                                <input type='text' class='' name='o_soldout[]' id=''
                                                                       style='width:100%;'
                                                                       value="<?= $frow3['o_soldout'] ?>"/>
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                        onclick="delOption('<?= $frow3['idx'] ?>',this)">
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
                                        객실 옵션 추가
                                        <p style="display:block;margin-top:10px;">
                                            <select name="roomIdx2" id="roomIdx2" class="input_select">

                                            </select>
                                            <button type="button" id="btn_add_option3" class="btn_01">추가</button>
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
                                                    <th>가격</th>
                                                    <th>우대 가격</th>
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
                                                                   value="<?= $row['r_price'] ?>"/>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='onlynum' name='sup__price_sale[]'
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
                                                href="/data/hotel/<?= $ufile1 ?>"
                                                class="imgpop"><?= $rfile1 ?></a><br><br>
                                            <img src="/data/hotel/<?= $ufile1 ?>" width="200px"/>
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
                                                        href="/data/hotel/<?= ${"ufile" . $i} ?>"
                                                        class="imgpop"><?= ${"rfile" . $i} ?></a><br><br>
                                                <img src="/data/hotel/<?= ${"ufile" . $i} ?>" width="200px"/>
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

    <iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>