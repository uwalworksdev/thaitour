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
<?php
$titleStr = " 가이드 상품 수정";
if ($product_idx && $product) {
    foreach ($product as $keys => $vals) {
        ${$keys} = $vals;

    }
    $titleStr = " 가이드 상품 등록";
}
?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li><a href="/AdmMaster/_tour_guides/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <li>
                                    <a href="javascript:del_it(`<?= $product_idx ?>`)"
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
                        <input type="hidden" name="product_idx" id="product_idx" value='<?= $product_idx ?>'/>
                        <input type="hidden" name="product_code_list" id="product_code_list"
                               value='<?= $product_code_list ?? "" ?>'>

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
                                        <select id="product_code_1" class="input_select" name="product_code_1"
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
                                        <select id="product_code_2" class="input_select" name="product_code_2"
                                                onchange="get_code(this.value, 4)">
                                            <option value="">2차분류</option>
                                        </select>
                                        <select id="product_code_3" class="input_select" name="product_code_3">
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
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="product_name"
                                               value="<?= $product_name ?? "" ?>"
                                               class="text"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>검색키워드</th>
                                    <td colspan="3">
                                        <input type="text" name="keyword" id="keyword"
                                               value="<?= $keyword ?? "" ?>" class="text" style="width:90%;"
                                               maxlength="1000"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)자켓,방풍자켓,기능성자켓</span>
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
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" name="onum" value="<?= $onum ?? 1 ?>"
                                               class="number" min="1"/>
                                        <span style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>전화번호</th>
                                    <td>
                                        <input type="text" name="phone" value="<?= $phone ?? '' ?>" class="text"/>
                                    </td>
                                    <th>지역</th>
                                    <td>
                                        <input type="text" name="product_country" value="<?= $product_country ?? '' ?>"
                                               class="text"/>
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

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top: 50px">
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
                                                <col width="10%"/>
                                                <col width="10%"/>
                                                <col width="10%"/>
                                                <col width="10%"/>
                                                <col width="8%"/>
                                                <col width="8%"/>
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>옵션명</th>
                                                <th>최초가격</th>
                                                <th>판매가격</th>
                                                <th>예약가능여부</th>
                                                <th>총인원</th>
                                                <th>우선순위</th>
                                                <th>관리</th>
                                            </tr>
                                            </thead>
                                            <tbody id="list_option">
                                            <?php foreach ($options as $option) { ?>
                                                <tr>
                                                    <td>
                                                        <div class='flex_c_c'>
                                                            <input type='hidden' name='o_idx[]'
                                                                   value='<?= $option['o_idx'] ?>'>
                                                            <input type='text' class='o_name' name='o_name[]'
                                                                   value='<?= $option['o_name'] ?>'>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='number' name='o_price[]'
                                                               value='<?= $option['o_price'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='number' name='o_sale_price[]'
                                                               value='<?= $option['o_sale_price'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='o_availability'
                                                               name='o_availability[]'
                                                               value='<?= $option['o_availability'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='number' name='o_people_cnt[]'
                                                               value='<?= $option['o_people_cnt'] ?>'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='number' name='o_onum[]'
                                                               value='<?= $option['onum'] ?>'>
                                                    </td>
                                                    <td class='tac'>
                                                        <button style='margin: 0;' type='button' class='btn_02'
                                                                onclick='delOption("<?= $option['o_idx'] ?>", this);'>
                                                            삭제
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
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
                                    <th>유의사항</th>
                                    <td colspan="3">

                                        <textarea name="product_info" id="product_info"
                                                  rows="10" cols="100"
                                                  class="input_txt"
                                                  style="width:100%; height:400px; display:none;"><?= viewSQ($product_info) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "product_info",
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
                                                $img = get_img(${"ufile" . $i}, "/uploads/guides/", "600", "440");
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
                                                $img = get_img(${"ufile" . $i}, "/uploads/guides/", "600", "440");
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

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">
                                <a href="/AdmMaster/_tour_guides/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($product_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <a href="javascript:del_it(`<?= $product_idx ?>`)"
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
    <script>
        $("#btn_reg_cate").click(function () {

            let tmp_code = "";
            let tmp_code_txt = "";

            let cate_code1 = $("#product_code_1").val();
            let cate_text1 = $("#product_code_1 option:selected").text();

            if (cate_code1 !== "") {
                tmp_code = cate_code1;
                tmp_code_txt += cate_text1;
            }

            let cate_code2 = $("#product_code_2").val();
            let cate_text2 = $("#product_code_2 option:selected").text();

            if (cate_code2 !== "") {
                tmp_code = cate_code2;
                tmp_code_txt += " > " + cate_text2;
            }

            let cate_code3 = $("#product_code_3").val();
            let cate_text3 = $("#product_code_3 option:selected").text();

            if (cate_code3 !== "") {
                tmp_code = cate_code3;
                tmp_code_txt += " > " + cate_text3;
            }

            if (tmp_code === "") {
                alert("카테고리를 선택해주세요.");
                return false;
            }

            addCategory(tmp_code, tmp_code_txt);
        });

        function addCategory(code, cateText) {
            // 코드 추가 부분
            // if (chkCategory(code) > -1) {
            //     alert("이미 등록된 카테고리입니다.");
            //     return false;
            // }
            let tmp_product_code = $("#product_code_list").val();

            tmp_product_code = tmp_product_code + "|" + code + "|";
            $("#product_code_list").val(tmp_product_code);

            let newList = "<li class='new'>[" + code + "] " + cateText + " <span onclick=\"delCategory('" + code + "', this);\" >삭제</span></li>";
            $("#reg_cate").append(newList);
        }

        function chkCategory(chkcode) {
            let tmp_product_code = $("#product_code_list").val();
            let re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

            let code_array = re_tmp_product_code.split('||');

            return ($.inArray(chkcode, code_array));
        }

        function delCategory(code, obj) {

            if (chkCategory(code) > -1) {

                let tmp_product_code = $("#product_code_list").val();
                let re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

                let code_array = re_tmp_product_code.split('||');

                let tmp_product_code_re = "";

                $.each(code_array, function (key, val) {
                    if (val != code) {
                        tmp_product_code_re = tmp_product_code_re + "|" + val + "|";
                    }
                });

                $("#product_code_list").val(tmp_product_code_re);
                obj.closest("li").remove();

            }
        }

        function get_code(strs, depth) {
            $.ajax({
                type: "GET"
                , url: "/ajax/get_code"
                , dataType: "html" //전송받을 데이터의 타입
                , timeout: 30000 //제한시간 지정
                , cache: false  //true, false
                , data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth //서버에 보낼 파라메터
                , error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (json) {
                    //alert(json);
                    if (depth <= 3) {
                        $("#product_code_2").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_2").append("<option value=''>2차분류</option>");
                    }

                    if (depth <= 4) {
                        $("#product_code_3").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_3").append("<option value=''>3차분류</option>");
                    }

                    if (depth <= 5) {
                        $("#product_code_4").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#product_code_4").append("<option value=''>4차분류</option>");
                    }

                    let list = $.parseJSON(json);
                    let listLen = list.length;
                    let contentStr = "";
                    for (let i = 0; i < listLen; i++) {
                        contentStr = "";
                        if (list[i].code_status == "C") {
                            contentStr = "[마감]";
                        } else if (list[i].code_status == "N") {
                            contentStr = "[사용안함]";
                        }
                        $("#product_code_" + (parseInt(depth - 1))).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                    }
                }
            });
        }
    </script>
    <script>
        function send_it() {
            oEditors1?.getById["product_info"]?.exec("UPDATE_CONTENTS_FIELD", []);

            let formData = new FormData($('#frm')[0]);

            let apiUrl = `<?= route_to('admin._tour_guides.write_ok') ?>`;

            $("#ajax_loader").removeClass("display-none");

            $.ajax(apiUrl, {
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    alert(response.message);
                    $("#ajax_loader").addClass("display-none");
                    <?php if ($product_idx):?>
                    window.location.reload();
                    <?php else: ?>
                    window.history.back();
                    <?php endif; ?>
                },
                error: function (request, status, error) {
                    alert("Error " + request.status + ": " + request.responseText);
                    $("#ajax_loader").addClass("display-none");
                }
            });
        }

        function del_it() {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            let url = '<?= route_to('admin._tour_guides.delete') ?>';

            let data = {
                product_idx: '<?= $product_idx ?>'
            };

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    console.log(response)
                    window.location.href = '/AdmMaster/_tour_guides/list';
                }
            });
        }

    </script>
    <script>
        function add_option() {
            let html = `<tr>
                                                    <td>
                                                        <div class='flex_c_c'>
                                                            <input type='hidden' name='o_idx[]'
                                                                   value=''>
                                                            <input type='text' class='o_name' name='o_name[]'
                                                                   value=''>
                                                        </div>
                                                    </td>
                                                    <td>
                                                            <input type='text' class='number' name='o_price[]'
                                                                   value=''>
                                                    </td>
                                                    <td>
                                                            <input type='text' class='number' name='o_sale_price[]'
                                                                   value=''>
                                                    </td>
                                                    <td>
                                                            <input type='text' class='o_availability' name='o_availability[]'
                                                                   value=''>
                                                    </td>
                                                    <td>
                                                            <input type='text' class='number' name='o_people_cnt[]'
                                                                   value=''>
                                                    </td>
                                                    <td>
                                                            <input type='text' class='number' name='o_onum[]'
                                                                   value=''>
                                                    </td>
                                                    <td class='tac'>
                                                        <button style='margin: 0;' type='button' class='btn_02'
                                                                onclick='delOption("", this);'>
                                                            삭제
                                                        </button>
                                                    </td>
                                                </tr>`;

            $('#list_option').append(html)
        }

        function delOption(o_idx, el) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
                return;
            }

            $(el).closest('tr').remove();

            if (o_idx && o_idx !== "") {
                $("#ajax_loader").removeClass("display-none");

                let url = '<?= route_to('admin._option_guides.delete') ?>';

                let data = {
                    o_idx: o_idx
                };

                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    error: function (request, status, error) {
                        //통신 에러 발생시 처리
                        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                        $("#ajax_loader").addClass("display-none");
                    }
                    , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                    }
                    , success: function (response, status, request) {
                        alert(response.message);
                        console.log(response)
                        $("#ajax_loader").addClass("display-none");
                    }
                });
            }
        }
    </script>
<?= $this->endSection() ?>