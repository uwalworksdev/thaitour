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

        .head_table {
            display: flex;
            justify-content: space-between;
        }
        .btns_setting {
            display: inline-block;
            float: right;
            margin-top: 6px;
        }

        button {
            height: 31px;
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
                                    <col width="13%"/>
                                    <col width="*%"/>
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

                                <!--tr>
                                    <th>가격 숨김</th>
                                    <td colspan="3">
                                        <div style="display: flex; gap: 10px; align-items: center;">
                                            <div style="display: flex; align-items: center;">
                                                <input type="radio" name="is_won_bath" id="is_won_bath"
                                                       value="" <?php if (empty($is_won_bath)) {
                                                    echo "checked";
                                                } ?>/>
                                                <label for="is_won_bath">현재 가격</label>
                                            </div>
                                            <div style="display: flex; align-items: center;">
                                                <input type="radio" name="is_won_bath" id="is_won"
                                                       value="W" <?php if ($is_won_bath == "W") {
                                                    echo "checked";
                                                } ?>/>
                                                <label for="is_won">바트가격 숨김</label>
                                            </div>

                                            <div style="display: flex; align-items: center;">
                                                <input type="radio" name="is_won_bath" id="is_bath"
                                                       value="B" <?php if ($is_won_bath == "B") {
                                                    echo "checked";
                                                } ?>/>
                                                <label for="is_bath">원화가격 숨김</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr-->

                                </tbody>
                            </table>

                            <?php if ($product_idx): ?>
                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                       style="margin-top:50px;">
                                    <caption>
                                    </caption>
                                    <colgroup>
                                        <col width="10%"/>
                                        <col width="90%"/>
                                    </colgroup>
                                    <tbody>

                                    <!--tr height="45">
                                        <th>호텔명</th>
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
                                    </tr-->
                                    <tr>
                                        <th>aeson Sale Offer <br> 프리미어 트윈</th>
                                        <td>
                                            <div class="head_table">
                                                <div class="btn_more">
                                                    <button type="button" id="addTableBtn" style = "width : 50px ;background-color : #4f728a; color : #fff">추가</button>
                                                    <span style="color : red" class="note">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다</span>
                                                </div>
                                                <div class="btn_save_all">
                                                    <button style = "background-color : #4f728a; color : #fff">전체저장</button>
                                                </div>
                                            </div>
                                            <div class="table_child">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="background-color: #eee;">
                                                                <span>제 목</span>
                                                                <input style="width: 30%;" type="text">
                                                                <input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
                                                                <span>~</span> 
                                                                <input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
                                                                <button style="width: 50px; background-color : #4f728a; color : #fff;" class="btn_edit">수정</button>
                                                                <input type="checkbox">사용
                                                                <input type="checkbox">미사용
                                                                <div class="btns_setting">
                                                                    <button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">저장</button>
                                                                    <button style="width: 50px ; background-color: #d03a3e; color : #fff;" class="btn_del">삭제</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span>기본가</span>
                                                                <input style="width: 100px;" type="text">
                                                                <span>컨택가</span>
                                                                <input style="width: 100px;" type="text">
                                                                <span>+수익</span>
                                                                <input style="width: 100px;" type="text">
                                                                <span>=상품가</span>
                                                                <input style="width: 100px;" type="text">
                                                                <select>
                                                                    <option value="">현재 가격</option>
                                                                    <option value="">현재 가격</option>
                                                                </select>
                                                                <label style="margin-left: 30px;" for="check_bx_001">비밀특가</label>
                                                                <input id="check_bx_001" type="checkbox">
																
																<span style="margin-left: 30px;">가격숨김</span>
																<input type="radio" name="is_won_bath" id="is_won_bath"
																	   value="" <?php if (empty($is_won_bath)) {
																	echo "checked";
																} ?>/>
																<label for="is_won_bath">현재 가격</label>
																<input type="radio" name="is_won_bath" id="is_won"
																	   value="W" <?php if ($is_won_bath == "W") {
																	echo "checked";
																} ?>/>
																<label for="is_won">바트가격 숨김</label>
																<input type="radio" name="is_won_bath" id="is_bath"
																	   value="B" <?php if ($is_won_bath == "B") {
																	echo "checked";
																} ?>/>
																<label for="is_bath">원화가격 숨김</label>
																
                                                            </td>
                                                        </tr>
														
                                                        <tr>
                                                            <td>
                                                                <p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))</p>
                                                                <input style="width: 18%;" type="text">
                                                                <input style="width: 8%;" type="text">
                                                                <input style="width: 18%; margin-left: 20px;" type="text">
                                                                <input style="width: 8%;" type="text">
                                                                <input style="width: 18%; margin-left: 20px;" type="text">
                                                                <input style="width: 8%;" type="text">
                                                                <button style="width: 31px; height : 31px">+</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p style="margin-bottom: 3px;">옵션 내용을 추가 합니다. (html 태그 사용가능)</p>
                                                                <input style="width: 18%;" type="text">
                                                                <button style="width: 31px; height : 31px">+</button>
                                                                
                                                            </td>
                                                        </tr>
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
                                        <th>호텔명</th>
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
        $(document).ready(function () {
            // 클릭 이벤트 핸들러
            $("#addTableBtn").on("click", function () {
                // 새로운 테이블 HTML 생성
                const newTable = `
					  <table>
						<tbody>
							<tr>
								<td style="background-color: #eee;">
									<span>제 목</span>
									<input style="width: 30%;" type="text">
									<input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
									<span>~</span> 
									<input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
									<button style="width: 50px; background-color : #4f728a; color : #fff;" class="btn_edit">수정</button>
									<input type="checkbox">사용
									<input type="checkbox">미사용
									<div class="btns_setting">
										<button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">저장</button>
										<button style="width: 50px ; background-color: #d03a3e; color : #fff;" class="deleteRowBtn btn_del">삭제</button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span>기본가</span>
									<input style="width: 100px;" type="text">
									<span>컨택가</span>
									<input style="width: 100px;" type="text">
									<span>+수익</span>
									<input style="width: 100px;" type="text">
									<span>=상품가</span>
									<input style="width: 100px;" type="text">
									<select>
										<option value="">현재 가격</option>
										<option value="">현재 가격</option>
									</select>
									<label style="margin-left: 30px;" for="check_bx_001">비밀특가</label>
									<input id="check_bx_001" type="checkbox">
									
									<span style="margin-left: 30px;">가격숨김</span>
									<input type="radio" name="is_won_bath" id="is_won_bath" value="" />
									<label for="is_won_bath">현재 가격</label>
									<input type="radio" name="is_won_bath" id="is_won" value="W" />
									<label for="is_won">바트가격 숨김</label>
									<input type="radio" name="is_won_bath" id="is_bath" value="B" />
									<label for="is_bath">원화가격 숨김</label>
									
								</td>
							</tr>
							
							<tr>
								<td>
									<p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))</p>
									<input style="width: 18%;" type="text">
									<input style="width: 8%;" type="text">
									<input style="width: 18%; margin-left: 20px;" type="text">
									<input style="width: 8%;" type="text">
									<input style="width: 18%; margin-left: 20px;" type="text">
									<input style="width: 8%;" type="text">
									<button style="width: 31px; height : 31px">+</button>
								</td>
							</tr>
							<tr>
								<td>
									<p style="margin-bottom: 3px;">옵션 내용을 추가 합니다. (html 태그 사용가능)</p>
									<input style="width: 18%;" type="text">
									<button style="width: 31px; height : 31px">+</button>
									
								</td>
							</tr>
						</tbody>
					</table>`;
                
                // 새 테이블을 .table-container에 추가
                $(".table_child").append(newTable);
            });

            // 삭제 버튼 동작
            $(document).on("click", ".deleteRowBtn", function () {
                $(this).closest("table").remove();
            });
        });
    </script>				
    <script>
        $("#mainRoom").on('change', '.chk_price_secret', function () {
            let check = "";
            if ($(this).is(":checked")) {
                check = "Y";
            }
            $(this).closest(".chk_price_wrap").find(".price_secret").val(check);
        });
    </script>
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