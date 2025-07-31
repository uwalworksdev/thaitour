<?php
    $formAction = $idx ? "/AdmMaster/_promotion/write_ok/$idx" : "/AdmMaster/_promotion/write_ok";
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

    $titleStr = "목록 프로모션";
?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2><?= $titleStr ?></h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_promotion/list" class="btn btn-default"><span
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
                                    <td colspan="3">
                                        <input type="text" name="title"
                                            value="<?= $title ?? "" ?>"
                                            class="text" maxlength="100" />
                                    </td>
                                </tr>

                                <tr>
                                    <th>대표이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                for ($i = 1; $i <= 1; $i++) :
                                                    $img = "/data/promotion/" . ${"ufile" . $i};
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
                                <tr>
                                    <th>
                                        배너 이미지(1000X600)
                                        <button type="button" class="btn_01" onclick="add_sub_image();">추가</button>
                                        <button type="button" class="btn_02" style="margin-top: 10px;" onclick="delete_all_image();">전체 삭제</button>
                                    </th>
                                    <td colspan="3">
                                        <div class="img_add img_add_group">
                                            <?php
                                                $i = 2;
                                                foreach ($img_list as $img) :
                                                    $s_img = "/data/promotion/" . $img["ufile"];
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($img["ufile"]) ? "" : "applied" ?>">
                                                    <input type="hidden" name="i_idx[]" value="<?= $img["i_idx"] ?>">
                                                    <input type="hidden" class="onum_img" name="onum_img[]" value="<?= $img["onum"] ?>">
                                                    <input type="file" name='ufile[]' id="ufile<?= $i ?>" multiple onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty($img["ufile"]) ? "style='background-image:url($s_img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                    <button type="button" class="remove_btn"  onclick="productImagePreviewRemove(this)"></button>
                                                    <a class="img_txt imgpop" href="<?= $s_img ?>" style="display: <?= !empty($img["ufile"]) ? "block" : "none" ?>;" 
                                                        id="text_ufile<?= $i ?>">미리보기</a>
                                                </div>
                                            </div>
                                            <?php
                                                $i++;
                                                endforeach;
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>지도 이미지(600X440)</th>
                                    <td colspan="3">

                                        <div class="img_add">
                                            <?php
                                                for ($i = 2; $i <= 2; $i++) :
                                                    $img = "/data/promotion/" . ${"ufile" . $i};
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
                    </div>
                </form>

                <div class="tail_menu">
                    <ul>
                        <li class="left"></li>
                        <li class="right_sub">
                            <a href="/AdmMaster/_promotion/list" class="btn btn-default"><span
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

        if ($("#check_img_ufile1").length > 0 && !$("#check_img_ufile1").val() && $("#ufile1").get(0).files.length === 0) {
            alert("이미지를 등록해주세요.");
            return false;
        }

        $(".img_add_group .file_input").each(function(index) {
            $(this).find(".onum_img").val(index + 1);
        });

        // oEditors1?.getById["m_recommend_text"]?.exec("UPDATE_CONTENTS_FIELD", []);

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
            if(id){
                arr_img.push({
                    i_idx: id,
                });
            }
		});

        if(arr_img.length > 0){
            $.ajax({
                url: "/AdmMaster/_hotel/del_all_image",
                type: "POST",
                data: JSON.stringify({ arr_img: arr_img }),
                contentType: "application/json",
                success: function(response) {
                    alert(response.message);
                    if(response.result == true){
                        $(".img_add_group").html("");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("error:", error);
                }
            });
        }else{
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
            imageReader.onload = function () {
                $('label[for="ufile' + onum + '"]').css("background-image", "url(" + imageReader.result + ")");
            };
            imageReader.readAsDataURL(files[0]);

            if (files.length > 1) {
                files.slice(1).forEach((file, index) => {
                    let newReader = new FileReader();
                    let i = Date.now();

                    newReader.onload = function () {
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
        }else{
            alert('40개 이미지로 제한이 있습니다.');
        }
    }

    function productImagePreviewRemove(element) {
        let parent = $(element).closest('.file_input_wrap');
        if(parent.find('input[name="ufile[]"]').length > 0){
            let inputFile = parent.find('input[type="file"][multiple]')[0] 
                            || parent.prevAll().find('input[type="file"][multiple]')[0];
            let labelImg = parent.find('label');
            let i_idx = parent.find('input[name="i_idx[]"]').val();
    
            let dt = new DataTransfer();
            let fileArray = Array.from(inputFile.files);
            let imageUrl = labelImg.css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
            
            fileArray.forEach((file) => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    if (e.target.result !== imageUrl) {      
                        dt.items.add(file);
                    }
                };
                reader.readAsDataURL(file);
            });
    
            setTimeout(() => {
                inputFile.files = dt.files;
                if(parent.find('input[type="file"][multiple]')[0]){
                    parent.css("display", "none");
                }else{
                    parent.remove();
                }
            }, 100);
    
            if (i_idx) {
                if (!confirm("이미지를 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다.")) {
                    return false;
                }
    
                $.ajax({
                    url: "/AdmMaster/_hotel/del_image",
                    type: "POST",
                    data: { "i_idx": i_idx },
                    success: function (data) {
                        alert(data.message);
                        if (data.result) {
                            parent.css("display", "none");
                        }
                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                    }
                });
            }
        }else{            
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

<iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>