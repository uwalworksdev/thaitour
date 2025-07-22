<?php
    $formAction = $idx ? "/AdmMaster/_hotel_theme/write_ok/$idx" : "/AdmMaster/_hotel_theme/write_ok";
    helper("my_helper");
?>

<link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>

<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/popup.css" type="text/css" />
<script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<script type="text/javascript" src="/js/admin/tours/write.js"></script>

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

    ul#reg_cate li.new {
        width: 100%;
    }

    .img_add.img_add_group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .img_add .file_input+.file_input {
        margin-left: 0;
    }

    .img_add #input_file_ko {
        display: none;
    }
</style>

<?php
    if (isset($idx) && isset($row)) {
        foreach ($row as $keys => $vals) {
            ${$keys} = $vals;
        }
    }

    $titleStr = "테마별 인기호텔";
    $links = "list";
?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2><?= $titleStr ?></h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_hotel_theme/list" class="btn btn-default"><span
                                    class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        </li>

                        <?php if ($idx) { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">저장</span></a>
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
                    <input type="hidden" id="type" value="area">
                    <input type="hidden" id="check_img_ufile1" value="<?= $ufile1 ?>">

                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                            style="table-layout:fixed;">

                            <colgroup>
                                <col width="10%" />
                                <col width="40%" />
                                <col width="10%" />
                                <col width="40%" />
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td colspan="4">
                                        <div class=""
                                            style="width: 100%; display: flex; justify-content: space-between; align-items: center">
                                            <p>상품 기본정보</p>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>제목</th>
                                    <td>
                                        <input type="text" name="title"
                                                    value="<?= $title ?? "" ?>"
                                                    class="text" maxlength="100" />
                                    </td>
                                    <th>부제</th>
                                    <td>
                                        <input type="text" name="subtitle"
                                                    value="<?= $subtitle ?? "" ?>"
                                                    class="text" maxlength="100" />
                                    </td>
                                </tr>  

                                <tr>
                                    <th>내용</th>
                                    <td colspan="3">

                                        <textarea name="recommend_text" id="recommend_text" rows="10" cols="100"  class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($recommend_text) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "recommend_text",
                                                sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
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

                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                            for ($i = 1; $i <= 1; $i++) :
                                                // $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                                $img ="/data/product/" . ${"ufile" . $i};
                                            ?>
                                                <div class="file_input_wrap">
                                                    <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                        <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                            onchange="productImagePreview(this, '<?= $i ?>')">
                                                        <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                        <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                        <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>

                                                        <?php if (${"ufile" . $i}) { ?>
                                                            <a class="img_txt imgpop" href="<?= $img ?>"
                                                                id="text_ufile<?= $i ?>">미리보기</a>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            <?php
                                            endfor;
                                            ?>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <th>영역</th>
                                    <td colspan="3">
                                        <select id="category_code" name="category_code" class="input_select" onchange="get_info(this.value)">
                                            <option value="">선택</option>
                                                <?php
                                                    foreach ($category_list as $frow){
                                                ?>
                                                    <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $category_code) echo "selected"; ?>><?= $frow["code_name"] ?></option>
                                                <?php } ?>
                                        </select>
                                        <button type="button" class="btn btn-primary" onclick="add_area();">추가</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="area_list">
                            <!-- <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail sub_area"
                                style="table-layout:fixed;">
    
                                <colgroup>
                                    <col width="10%" />
                                    <col width="*" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <input type="hidden" name="s_category_code[]" class="s_category_code" value="">
                                            <div style="width: 100%; display: flex; align-items: center; gap: 5px;">
                                                제목
                                                <button type="button" class="btn btn-primary" onclick="showPopup(this);" style="margin: unset; margin-left: 30px;">추가</button>
                                                <button type="button" class="btn btn-danger" style="margin: unset">삭제</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                                style="table-layout:fixed;">
    
                                                <colgroup>
                                                    <col width="10%" />
                                                    <col width="*" />
                                                </colgroup>
                                                <tbody>
                                                    <tr>
                                                        <th style="text-align: center;">
                                                            <div class="flex_c_c" style="margin-top: 5px;">
                                                                <button type="button" class="btn btn-danger">삭제</button>
                                                            </div>
                                                        </th>
                                                        <td colspan="3">
                                                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                                                style="table-layout:fixed;">
    
                                                                <colgroup>
                                                                    <col width="10%" />
                                                                    <col width="40%" />
                                                                    <col width="10%" />
                                                                    <col width="40%" />
                                                                </colgroup>
                                                                <tbody>                                                                
                                                                    <tr>
                                                                        <th>상품명</th>
                                                                        <td colspan="3">
                                                                            <input type="text" name="theme_name[]"
                                                                                        value=""
                                                                                        class="text" maxlength="100" />
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <th>등급</th>
                                                                        <td colspan="3">
                                                                            <select name="star[]" class="input_select">
                                                                                <option value="5">
                                                                                    <font color="#17469E">★★★★★</font>
                                                                                </option>
                                                                                <option value="4">
                                                                                    <font color="#17469E">★★★★</font>
                                                                                </option>
                                                                                <option value="3">
                                                                                    <font color="#17469E">★★★</font>
                                                                                </option>
                                                                                <option value="2">
                                                                                    <font color="#17469E">★★</font>
                                                                                </option>
                                                                                <option value="1">
                                                                                    <font color="#17469E">★</font>
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <th>내용</th>
                                                                        <td colspan="3">
                                                                            <textarea name="recommend_text[]" rows="10" cols="100"  class="input_txt"  style="width:100%; height:100px;"><?= viewSQ($recommend_text) ?></textarea>
                                                                        </td>
                                                                    </tr>
    
                                                                    <tr>
                                                                        <th>대표이미지(600X440)</th>
                                                                        <td colspan="3">
    
                                                                            <div class="img_add">
                                                                                <?php
                                                                                    for ($i = 1; $i <= 1; $i++) :
                                                                                ?>
                                                                                    <div class="file_input_wrap">
                                                                                        <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                                                            <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                                                                onchange="productImagePreview(this, '<?= $i ?>')">
                                                                                            <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                                                            <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                                                            <button type="button" class="remove_btn"
                                                                                                onclick="productImagePreviewRemove(this)"></button>
    
                                                                                            <?php if (${"ufile" . $i}) { ?>
                                                                                                <a class="img_txt imgpop" href="<?= $img ?>"
                                                                                                    id="text_ufile<?= $i ?>">미리보기</a>
                                                                                            <?php } ?>
    
                                                                                        </div>
                                                                                    </div>
                                                                                <?php
                                                                                endfor;
                                                                                ?>
                                                                            </div>
    
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>대표이미지(600X440)</th>
                                                                        <td colspan="3">
    
                                                                            <div class="img_add img_add_group">
                                                                                <?php
                                                                                for ($i = 2; $i <= 4; $i++) :
                                                                                    $img ="/data/product/" . ${"ufile" . $i};
                                                                                ?>
                                                                                    <div class="file_input_wrap">
                                                                                        <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                                                            <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                                                                onchange="productImagePreview(this, '<?= $i ?>')">
                                                                                            <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                                                            <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                                                            <button type="button" class="remove_btn"
                                                                                                onclick="productImagePreviewRemove(this)"></button>
    
                                                                                            <?php if (${"ufile" . $i}) { ?>
                                                                                                <a class="img_txt imgpop" href="<?= $img ?>"
                                                                                                    id="text_ufile<?= $i ?>">미리보기</a>
                                                                                            <?php } ?>
    
                                                                                        </div>
                                                                                    </div>
                                                                                <?php
                                                                                    endfor;
                                                                                ?>
                                                                            </div>
    
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>  
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table> -->
                        </div>
                    </div>
                </form>

                <div class="tail_menu">
                    <ul>
                        <li class="left"></li>
                        <li class="right_sub">
                            <a href="/AdmMaster/_hotel_theme/list" class="btn btn-default"><span
                                    class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            <?php if ($idx == "") { ?>
                                <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            <?php } else { ?>
                                <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">저장</span></a>
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

<div class="pick_item_pop02" data-code="" id="item_pop" style="display:none;">
    <div>
        <h2>메인노출상품 등록</h2>
        <div class="search_box">

            <form name="pick_item_search" id="pick_item_search" onsubmit="return false">
                <select id="product_code_2" name="product_code_2" class="input_select">
                    <option value="">분류</option>
                    <?php
                    foreach ($category_list as $frow) {
                        $status_txt = "";
                        if ($frow["status"] == "Y") {
                            $status_txt = "";
                        } elseif ($frow["status"] == "N") {
                            $status_txt = "[삭제]";
                        } elseif ($frow["status"] == "C") {
                            $status_txt = "[마감]";
                        }

                        ?>
                        <option value="<?= $frow["code_no"] ?>"><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                    <?php } ?>
                </select>
                <select id="search_category" name="search_category" class="input_select"
                        style="width:112px">
                    <option value="product_name">상품명</option>
                    <option value="product_code">상품코드</option>
                </select>
                <input type="text" id="search_txt" onkeyup="press_it()" name="search_txt" value=""
                        class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px">
                <a href="javascript:search_product()" class="btn btn-default"><span
                            class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
            </form>
        </div>
        <div class="table_box">
            <form method="post" name="select_pick_frm" id="select_pick_frm">
                <input type="hidden" name="isrt_code" id="isrt_code" value="<?= $replace_code ?>">
                <table>
                    <caption>상품찾기</caption>
                    <colgroup>
                        <col style="width: 5%;">
                        <col>
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>선택</th>
                        <th>상품명</th>
                        <th>코드</th>
                    </tr>
                    </thead>
                    <tbody id="id_contents">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="sel_box">
            <button type="button" class="close">닫기</button>
            <button type="button" class="select_all">전체선택</button>
            <button type="button" onclick="fn_pick_update();" class="search">등록</button>
        </div>
    </div>
</div>

<script>
    function press_it() {
        if (event.keyCode == 13) {
            search_product();
        }
    }

    function showPopup(button) {
        let code = $(button).closest("td").find(".s_category_code").val();
        $("#item_pop").attr("data-code", code);
        $("#product_code_2").val(code);
        $('.pick_item_pop02').show();
    }

    $('.pick_item_pop02 .sel_box .close').on('click', function () {
        $('.pick_item_pop02').hide()
    });

    function add_area() {
        let code = $("#category_code").val();
        let code_name = $("#category_code").find('option:selected').text();

        if(code == ""){
            alert("영역을 선택해줘.");
            return false;
        }

        let isDuplicate = false;

        $('.sub_area').each(function(index, element) {
            if($(element).find(".s_category_code").val() == code){
                isDuplicate = true;
                return false;
            }
        });

        if (isDuplicate) {
            alert("이전에 찾은 영역이 있습니다.");
            return false;
        }
        
        let html = `
            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail sub_area"
                style="table-layout:fixed;">

                <colgroup>
                    <col width="10%" />
                    <col width="*" />
                </colgroup>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="s_category_code[]" class="s_category_code" value="${code}">
                            <div style="width: 100%; display: flex; align-items: center; gap: 5px;">
                                ${code_name}
                                <button type="button" class="btn btn-primary" onclick="showPopup(this);" style="margin: unset; margin-left: 30px;">추가</button>
                                <button type="button" class="btn btn-danger" style="margin: unset">삭제</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        `;

        $(".area_list").append(html);
    }

    function search_product() {
        let product_code_1 = '1303';
        let product_code_2 = $("#product_code_2").val();
        let search_category = $("#search_category").val();
        let search_txt = $("#search_txt").val();

        $.ajax({
            url: "./item_allfind",
            type: "GET",
            data: {
                "product_code_1": product_code_1,
                "product_code_2": product_code_2,
                "search_category": search_category,
                "search_txt": search_txt,
            },
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#id_contents").empty();
                $("#id_contents").append(response);
                $('.pick_item_pop02').show();
            }
        });
    }

</script>

<script>
    $(".imgpop_p").each(function() {
        if ($(this).attr("href") && $(this).attr("href").match(/\.(jpg|jpeg|png|gif|bmp)$/i)) {
            $(this).colorbox({
                rel: 'imgpop_p',
                maxWidth: '90%',
                maxHeight: '90%'
            });
        }
    });
</script>

<script>
    function get_info(idx){
        $.ajax({
            url: "/AdmMaster/_hotel_theme/get_category",
            type: "GET",
            data: {
                idx: idx
            },
            success: function(response) {
                
                $("#city_code_name").text("(" + response.city_code_name + ")");
                $("#category_code_name").text("(" + response.category_code_name + ")");

                let town_code_list = response.town_code_list;
                let subcategory_code_list = response.subcategory_code_list;

                let html_town = '<option value="">선택</option>';
                for (let i = 0; i < town_code_list.length; i++) {
                    html_town += `<option value="${town_code_list[i].code_no}">${town_code_list[i].code_name}</option>`
                }

                $("#town_code").html(html_town);

                let html_cat = '<option value="">선택</option>';
                for (let i = 0; i < subcategory_code_list.length; i++) {
                    html_cat += `<option value="${subcategory_code_list[i].code_no}">${subcategory_code_list[i].code_name}</option>`
                }

                $("#subcategory_code").html(html_cat);
            },
            error: function(xhr, status, error) {
                console.error("error:", error);
            }
        });
    }
</script>

<script>
    function send_it() {

        var frm = document.frm;

        if (frm.product_name.value == "") {
            alert("상품명을 입력해주세요.");
            frm.product_name.focus();
            return;
        }

        if($("#check_img_ufile1").length > 0 && !$("#check_img_ufile1").val() && $("#ufile1").get(0).files.length === 0){
            alert("이미지를 등록해주세요.");
            return false;
        }
      
        $(".img_add_group .file_input").each(function (index) { 
            $(this).find(".onum_img").val(index + 1);        
        });

        oEditors1?.getById["recommend_text"]?.exec("UPDATE_CONTENTS_FIELD", []);

        $("#ajax_loader").removeClass("display-none");

        frm.submit();
    }
</script>

<script>
    function add_sub_image() {

        let i = Date.now();

        let html = `
            <div class="file_input_wrap">
                <div class="file_input">
                    <input type="hidden" name="i_idx[]" value="">
                    <input type="hidden" class="onum_img" name="onum_img[]" value="">
                    <input type="file" name='ufile[]' id="ufile${i}" multiple
                            onchange="productImagePreview(this, '${i}')">
                    <label for="ufile${i}"></label>
                    <input type="hidden" name="checkImg_${i}" class="checkImg">
                    <button type="button" class="remove_btn"
                            onclick="productImagePreviewRemove(this)"></button>
                </div>
            </div>
        `;

        $(".img_add_group").append(html);

    }

    function delete_all_image() {
        if (!confirm("이미지를 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다.")) {
            return false;
        }

        let arr_img = [];

        $(".img_add_group .file_input").each(function() {
            let id = $(this).find("input[name='i_idx[]']").val();
            if (id) {
                arr_img.push({
                    i_idx: id,
                });
            }
        });

        if (arr_img.length > 0) {
            $.ajax({
                url: "/AdmMaster/_hotel_theme/del_all_image",
                type: "POST",
                data: JSON.stringify({
                    arr_img: arr_img
                }),
                contentType: "application/json",
                success: function(response) {
                    alert(response.message);
                    if (response.result == true) {
                        $(".img_add_group").html("");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("error:", error);
                }
            });
        } else {
            $(".img_add_group").html("");
        }
    }

    function productImagePreview(inputFile, onum) {
        if (inputFile.files.length <= 40 && inputFile.files.length > 0) {

            $(inputFile).closest('.file_input').addClass('applied');
            $(inputFile).closest('.file_input').find('.checkImg').val('Y');

            let lastElement = $(inputFile).closest('.file_input_wrap');
            let files = Array.from(inputFile.files);

            let imageReader = new FileReader();
            imageReader.onload = function() {
                $('label[for="ufile' + onum + '"]').css("background-image", "url(" + imageReader.result + ")");
            };
            imageReader.readAsDataURL(files[0]);

            if (files.length > 1) {
                files.slice(1).forEach((file, index) => {
                    let newReader = new FileReader();
                    let i = Date.now();

                    newReader.onload = function() {
                        let imagePreview = `
                            <div class="file_input_wrap">
                                <div class="file_input applied">
                                    <input type="hidden" name="i_idx[]" value="">
                                    <input type="hidden" class="onum_img" name="onum_img[]" value="">
                                    <input type="file" id="ufile${i}_${index}" 
                                        onchange="productImagePreview(this, '${i}_${index}')" disabled>
                                    <label for="ufile${i}_${index}" style='background-image:url(${newReader.result})'></label>
                                    <input type="hidden" name="checkImg_${i}_${index}" class="checkImg">
                                    <button type="button" class="remove_btn" onclick="productImagePreviewRemove(this)"></button>
                                </div>
                            </div>`;

                        lastElement.after(imagePreview);
                        lastElement = lastElement.next();
                    };

                    newReader.readAsDataURL(file);
                });
            }
        } else {
            alert('40개 이미지로 제한이 있습니다.');
        }
    }

    function productImagePreview2(inputFile, onum) {
        if (!sizeAndExtCheck(inputFile)) {
            $(inputFile).val("");
            return false;
        }

        let imageTag = $('label[for="room_ufile' + onum + '"]');

        if (inputFile.files.length > 0) {
            let imageReader = new FileReader();

            imageReader.onload = function() {
                imageTag.css("background-image", "url(" + imageReader.result + ")");
                $(inputFile).closest('.file_input').addClass('applied');
                $(inputFile).closest('.file_input').find('.checkImg').val('Y');
            }
            return imageReader.readAsDataURL(inputFile.files[0]);
        }
    }

    function productImagePreviewRemove(element) {
        let parent = $(element).closest('.file_input_wrap');
        if (parent.find('input[name="ufile[]"]').length > 0) {
            let inputFile = parent.find('input[type="file"][multiple]')[0] ||
                parent.prevAll().find('input[type="file"][multiple]')[0];
            let labelImg = parent.find('label');
            let i_idx = parent.find('input[name="i_idx[]"]').val();

            let dt = new DataTransfer();
            let fileArray = Array.from(inputFile.files);
            let imageUrl = labelImg.css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');

            fileArray.forEach((file) => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    if (e.target.result !== imageUrl) {
                        dt.items.add(file);
                    }
                };
                reader.readAsDataURL(file);
            });

            setTimeout(() => {
                inputFile.files = dt.files;
                if (parent.find('input[type="file"][multiple]')[0]) {
                    parent.css("display", "none");
                } else {
                    parent.remove();
                }
            }, 100);

            if (i_idx) {
                if (!confirm("이미지를 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다.")) {
                    return false;
                }

                $.ajax({
                    url: "/AdmMaster/_hotel_theme/del_image",
                    type: "POST",
                    data: {
                        "i_idx": i_idx
                    },
                    success: function(data) {
                        alert(data.message);
                        if (data.result) {
                            parent.css("display", "none");
                        }
                    },
                    error: function(request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                    }
                });
            }
        } else {
            parent.find('input[type="file"]').val("");
            parent.find('label').css("background-image", "");
            parent.find('.file_input').removeClass('applied');
            parent.find('.checkImg').val('N');
            parent.find('.imgpop').attr("href", "");
            parent.find('.imgpop').remove();
        }
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
    function closePopupLocation() {
        $("#popup_location").hide();
    }

    function getCoordinates() {

        let address = $("#addrs").val();
        if (!address) {
            alert("주소를 입력해주세요");
            return false;
        }
        const apiUrl = `https://google-map-places.p.rapidapi.com/maps/api/place/textsearch/json?query=${encodeURIComponent(address)}&radius=1000&opennow=true&location=40%2C-110&language=en&region=en`;

        const options = {
            method: 'GET',
            headers: {
                'x-rapidapi-host': 'google-map-places.p.rapidapi.com',
                'x-rapidapi-key': '79b4b17bc4msh2cb9dbaadc30462p1f029ajsn6d21b28fc4af'
            }
        };

        fetch(apiUrl, options)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Data:', data);
                let html = '';
                if (data.results.length > 0) {
                    data.results.forEach(element => {
                        let address = element.formatted_address;
                        let lat = element.geometry.location.lat;
                        let lon = element.geometry.location.lng;
                        html += `<li data-lat="${lat}" data-lon="${lon}">${address}</li>`;
                    });
                } else {
                    html = `<li>No data</li>`;
                }

                $("#popup_location #list_location").html(html);
                $("#popup_location").show();
                $("#popup_location #list_location li").click(function() {
                    let latitude = $(this).data("lat");
                    let longitude = $(this).data("lon");
                    $("#latitude").val(latitude);
                    $("#longitude").val(longitude);
                    $("#addrs").val($(this).text().trim());
                    $("#popup_location").hide();
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
<iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>