<?php
$formAction = $idx ? "/AdmMaster/_hotel_theme/write_ok/$idx" : "/AdmMaster/_hotel_theme/write_ok";
helper("my_helper");
?>

<link rel="stylesheet" href="/css/admin/popup.css" type="text/css" />

<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/popup.css" type="text/css" />
<script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<!-- <script type="text/javascript" src="/js/admin/tours/write.js"></script> -->

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
                    <input type="hidden" id="type" name="type" value="month">
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
                                    <th>URL</th>
                                    <td colspan="3">
                                        <input type="text" name="url"
                                            value="<?= $url ?? "" ?>"
                                            class="text" maxlength="100" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>내용</th>
                                    <td colspan="3">

                                        <textarea name="m_recommend_text" id="m_recommend_text" rows="10" cols="100" class="input_txt" style="width:100%; height:400px; display:none;"><?= viewSQ($recommend_text) ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "m_recommend_text",
                                                sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
                                                htParams: {
                                                    bUseToolbar: true, // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseVerticalResizer: true, // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                                    bUseModeChanger: true, // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                                    fOnBeforeUnload: function() {
                                                        //alert("완료!");
                                                    }
                                                }, //boolean
                                                fOnAppLoad: function() {
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
                                                $img = "/data/product/" . ${"ufile" . $i};
                                            ?>
                                                <div class="file_input_wrap">
                                                    <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                        <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                            onchange="productImagePreview(this, '<?= $i ?>')">
                                                        <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                        <input type="hidden" name="m_checkImg_<?= $i ?>" class="checkImg">
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

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                            style="table-layout:fixed;">

                            <colgroup>
                                <col width="10%" />
                                <col width="40%" />
                                <col width="10%" />
                                <col width="40%" />
                            </colgroup>
                            <tbody>
                                <td colspan="4">
                                    <input type="hidden" name="s_idx[]" class="s_idx" value="<?= $product_list[0]["s_idx"] ?>">
                                    <div style="width: 100%; display: flex; justify-content: space-between; align-items: center">
                                        <p>객실</p>
                                    </div>
                                </td>
                                <tr>
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="theme_name[]"
                                            value="<?= $product_list[0]["theme_name"] ?>"
                                            class="text" maxlength="100" />
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>내용</th>
                                    <td colspan="3">
                                        <textarea name="recommend_text[]" rows="10" cols="100" class="input_txt" style="width:100%; height:100px;"><?= viewSQ( $product_list[0]["recommend"]) ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>객실 별 사이즈</th>
                                    <td colspan="3">
                                        <textarea name="details[]" rows="10" cols="100" class="input_txt" style="width:100%; height:100px;"><?= viewSQ($product_list[0]["details"]) ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                $img = "/data/product/" . $product_list[0]["ufile1"];
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($product_list[0]["ufile1"]) ? "" : "applied" ?>">
                                                    <input type="file" name='o_ufile_1[]' id="o_ufile_1_1"
                                                        onchange="productImagePreview(this, '1')">
                                                    <label for="o_ufile_1_1" <?= !empty($product_list[0]["ufile1"]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="o_checkImg_1[]" class="checkImg">

                                                    <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                    <?php if ($product_list[0]["ufile1"]) { ?>
                                                        <a class="img_txt imgpop" href="<?= $img ?>"
                                                            id="o_text_ufile_1_1">미리보기</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                $img = "/data/product/" . $product_list[0]["ufile2"];
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($product_list[0]["ufile2"]) ? "" : "applied" ?>">
                                                    <input type="file" name='o_ufile_2[]' id="o_ufile_1_2"
                                                        onchange="productImagePreview(this, '2')">
                                                    <label for="o_ufile_1_2" <?= !empty($product_list[0]["ufile2"]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="o_checkImg_2[]" class="checkImg">

                                                    <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                    <?php if ($product_list[0]["ufile2"]) { ?>
                                                        <a class="img_txt imgpop" href="<?= $img ?>"
                                                            id="o_text_ufile_1_2">미리보기</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                            style="table-layout:fixed;">

                            <colgroup>
                                <col width="10%" />
                                <col width="40%" />
                                <col width="10%" />
                                <col width="40%" />
                            </colgroup>
                            <tbody>
                                <td colspan="4">
                                    <input type="hidden" name="s_idx[]" class="s_idx" value="<?= $product_list[1]["s_idx"] ?>">
                                    <div style="width: 100%; display: flex; justify-content: space-between; align-items: center">
                                        <p>위치</p>
                                    </div>
                                </td>
                                <tr>
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="theme_name[]"
                                            value="<?= $product_list[1]["theme_name"] ?>"
                                            class="text" maxlength="100" />
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>내용</th>
                                    <td colspan="3">
                                        <textarea name="recommend_text[]" rows="10" cols="100" class="input_txt" style="width:100%; height:100px;"><?= viewSQ( $product_list[1]["recommend"]) ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>객실 별 사이즈</th>
                                    <td colspan="3">
                                        <textarea name="details[]" rows="10" cols="100" class="input_txt" style="width:100%; height:100px;"><?= viewSQ($product_list[1]["details"]) ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                $img = "/data/product/" . $product_list[1]["ufile1"];
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($product_list[1]["ufile1"]) ? "" : "applied" ?>">
                                                    <input type="file" name='o_ufile_1[]' id="o_ufile_2_1"
                                                        onchange="productImagePreview(this, '1')">
                                                    <label for="o_ufile_2_1" <?= !empty($product_list[1]["ufile1"]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="o_checkImg_1[]" class="checkImg">

                                                    <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                    <?php if ($product_list[1]["ufile1"]) { ?>
                                                        <a class="img_txt imgpop" href="<?= $img ?>"
                                                            id="o_text_ufile_2_1">미리보기</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                $img = "/data/product/" . $product_list[1]["ufile2"];
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($product_list[1]["ufile2"]) ? "" : "applied" ?>">
                                                    <input type="file" name='o_ufile_2[]' id="o_ufile_2_2"
                                                        onchange="productImagePreview(this, '2')">
                                                    <label for="o_ufile_2_2" <?= !empty($product_list[1]["ufile2"]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="o_checkImg_2[]" class="checkImg">

                                                    <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                    <?php if ($product_list[1]["ufile2"]) { ?>
                                                        <a class="img_txt imgpop" href="<?= $img ?>"
                                                            id="o_text_ufile_2_2">미리보기</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                            style="table-layout:fixed;">

                            <colgroup>
                                <col width="10%" />
                                <col width="40%" />
                                <col width="10%" />
                                <col width="40%" />
                            </colgroup>
                            <tbody>
                                <td colspan="4">
                                    <input type="hidden" name="s_idx[]" class="s_idx" value="<?= $product_list[2]["s_idx"] ?>">
                                    <div style="width: 100%; display: flex; justify-content: space-between; align-items: center">
                                        <p>위치</p>
                                    </div>
                                </td>
                                <tr>
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="theme_name[]"
                                            value="<?= $product_list[2]["theme_name"] ?>"
                                            class="text" maxlength="100" />
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>내용</th>
                                    <td colspan="3">
                                        <textarea name="recommend_text[]" rows="10" cols="100" class="input_txt" style="width:100%; height:100px;"><?= viewSQ( $product_list[2]["recommend"]) ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>객실 별 사이즈</th>
                                    <td colspan="3">
                                        <textarea name="details[]" rows="10" cols="100" class="input_txt" style="width:100%; height:100px;"><?= viewSQ($product_list[2]["details"]) ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                $img = "/data/product/" . $product_list[2]["ufile1"];
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($product_list[2]["ufile1"]) ? "" : "applied" ?>">
                                                    <input type="file" name='o_ufile_1[]' id="o_ufile_3_1"
                                                        onchange="productImagePreview(this, '1')">
                                                    <label for="o_ufile_3_1" <?= !empty($product_list[2]["ufile1"]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="o_checkImg_1[]" class="checkImg">

                                                    <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                    <?php if ($product_list[2]["ufile1"]) { ?>
                                                        <a class="img_txt imgpop" href="<?= $img ?>"
                                                            id="o_text_ufile_3_1">미리보기</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                $img = "/data/product/" . $product_list[2]["ufile2"];
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($product_list[2]["ufile2"]) ? "" : "applied" ?>">
                                                    <input type="file" name='o_ufile_2[]' id="o_ufile_3_2"
                                                        onchange="productImagePreview(this, '2')">
                                                    <label for="o_ufile_3_2" <?= !empty($product_list[2]["ufile2"]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="o_checkImg_2[]" class="checkImg">

                                                    <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                    <?php if ($product_list[2]["ufile2"]) { ?>
                                                        <a class="img_txt imgpop" href="<?= $img ?>"
                                                            id="o_text_ufile_3_2">미리보기</a>
                                                    <?php } ?>

                                                </div>
                                            </div>
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
    function send_it() {

        var frm = document.frm;

        if (frm.title.value == "") {
            alert("제목 입력해주세요.");
            frm.title.focus();
            return;
        }

        $(".sub_area").each(function() {
            $(this).find(".product_area").each(function() {
                let step = $(this).index();

                $(this).find(".step_index").val(step);
            });
        });

        if ($("#check_img_ufile1").length > 0 && !$("#check_img_ufile1").val() && $("#ufile1").get(0).files.length === 0) {
            alert("이미지를 등록해주세요.");
            return false;
        }

        $(".img_add_group .file_input").each(function(index) {
            $(this).find(".onum_img").val(index + 1);
        });

        oEditors1?.getById["m_recommend_text"]?.exec("UPDATE_CONTENTS_FIELD", []);

        $("#ajax_loader").removeClass("display-none");

        frm.submit();
    }
</script>

<script>
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
                $(inputFile).closest('.file_input').find('label').css("background-image", "url(" + imageReader.result + ")");
            };
            imageReader.readAsDataURL(files[0]);

        } else {
            alert('40개 이미지로 제한이 있습니다.');
        }
    }

    function productImagePreviewRemove(element) {
        let parent = $(element).closest('.file_input_wrap');
        parent.find('input[type="file"]').val("");
        parent.find('label').css("background-image", "");
        parent.find('.file_input').removeClass('applied');
        parent.find('.checkImg').val('N');
        parent.find('.imgpop').attr("href", "");
        parent.find('.imgpop').remove();
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