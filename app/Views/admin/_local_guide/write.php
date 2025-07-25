<?php
    $formAction = $idx ? "/AdmMaster/_local_guide/write_ok/$idx" : "/AdmMaster/_local_guide/write_ok";
    helper("my_helper");
?>

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

    $titleStr = "추천여행지(상품)";
    $links = "list";
?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2><?= $titleStr ?></h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_local_guide/list" class="btn btn-default"><span
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
                    <input type="hidden" id="city_code" value="<?= $city_code ?>">
                    <input type="hidden" id="category_code" value="<?= $category_code ?>">
                    <input type="hidden" id="check_img_ufile1" value="<?= $ufile1 ?>">

                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                            style="table-layout:fixed;">
                            <caption>
                            </caption>
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
                                    <th>핫 플레이스</th>
                                    <td colspan="3">
                                        <select id="lp_idx" name="lp_idx" class="input_select" onchange="get_info(this.value)">
                                            <option value="">선택</option>
                                                <?php
                                                    foreach ($product_list as $frow){
                                                ?>
                                                    <option value="<?= $frow["idx"] ?>" <?php if ($frow["idx"] == $lp_idx) echo "selected"; ?>><?= $frow["title"] ?></option>
                                                <?php } ?>
                                        </select>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>테마여행 카테고리</th>
                                    <td>
                                        <span id="city_code_name"><?= $city_code_name ? "(" . $city_code_name . ")"  : ''?></span>
                                        <select id="town_code" name="town_code" class="input_select">
                                            <option value="">선택</option>
                                            <?php
                                                foreach($town_code_list as $frow){
                                            ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $town_code) echo "selected"; ?>><?= $frow["code_name"] ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <th>카테고리</th>
                                    <td>
                                        <span id="category_code_name"><?= $category_code_name ? "(" . $category_code_name . ")"  : ''?></span>
                                        <select id="subcategory_code" name="subcategory_code" class="input_select">
                                            <option value="">선택</option>       
                                            <?php
                                                foreach($subcategory_code_list as $frow){
                                            ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $subcategory_code) echo "selected"; ?>><?= $frow["code_name"] ?></option>
                                            <?php
                                                }
                                            ?>                                    
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" name="product_name"
                                                    value="<?= $product_name ?? "" ?>"
                                                    class="text" maxlength="100" />
                                    </td>
                                    <th>영문명</th>
                                    <td>
                                        <input type="text" name="product_name_en"
                                                    value="<?= $product_name_en ?? "" ?>"
                                                    class="text" maxlength="100" />
                                    </td>
                                </tr>  

                                <tr>
                                    <th>전화번호</th>
                                    <td>
                                        <input type="text" name="contact"
                                               value="<?= $contact?>"
                                               class="text" maxlength="50"/>
                                    </td>
                                    <th>영업시간</th>
                                    <td>
                                        <input type="text" name="time_line"
                                               value="<?= $time_line?>"
                                               class="text" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>홈페이지</th>
                                    <td>
                                        <input type="text" name="url" value="<?= $url?>" class="text" maxlength="50"/>
                                    </td>
                                    <th>찾아가는 법</th>
                                    <td>
                                        <input type="text" name="routes" value="<?= $routes?>" class="text"/>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" id="addrs" name="addrs" value="<?= $addrs ?>"
                                               class="input_txt" placeholder="" style="width:45%"/>
                                        <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">get location</button>&ensp;
                                            Latitude : <input type="text" name="latitude" id="latitude" value="<?= $latitude ?>" class="text" style="width: 200px;" readonly/>
                                            Longitude : <input type="text" name="longitude" id="longitude" value="<?= $longitude ?>" class="text" style="width: 200px;"  readonly/>
                                        
                                    </td>                                  
                                </tr>

                                <tr>
                                    <th>중요사항</th>
                                    <td colspan="3">

                                        <textarea name="product_contents" id="product_contents" rows="10" cols="100"  class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($product_contents) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "product_contents",
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
                            </tbody>
                        </table>

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                            style="margin-top:50px;">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%" />
                                <col width="90%" />
                            </colgroup>
                            <tbody>

                                <tr height="45">
                                    <td colspan="2">
                                        이미지 등록
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
                                    <th>
                                        서브이미지(1000X600)
                                        <button type="button" class="btn_01" onclick="add_sub_image();">추가</button>
                                        <button type="button" class="btn_02" style="margin-top: 10px;" onclick="delete_all_image();">전체 삭제</button>
                                    </th>
                                    <td colspan="3">
                                        <div class="img_add img_add_group">
                                            <?php
                                                $i = 2;
                                                foreach ($img_list as $img) :
                                                    $s_img = "/data/product/" . $img["ufile"];
                                            ?>
                                                <div class="file_input_wrap">
                                                    <div class="file_input <?= empty($img["ufile"]) ? "" : "applied" ?>">
                                                        <input type="hidden" name="i_idx[]" value="<?= $img["i_idx"] ?>">
                                                        <input type="hidden" class="onum_img" name="onum_img[]" value="<?= $img["onum"] ?>">
                                                        <input type="file" name='ufile[]' id="ufile<?= $i ?>" multiple onchange="productImagePreview(this, '<?= $i ?>')">
                                                        <label for="ufile<?= $i ?>" <?= !empty($img["ufile"]) ? "style='background-image:url($s_img)'" : "" ?>></label>
                                                        <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                        <button type="button" class="remove_btn" onclick="productImagePreviewRemove(this)"></button>
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
                            </tbody>
                        </table>
                    </div>
                </form>

                <div class="tail_menu">
                    <ul>
                        <li class="left"></li>
                        <li class="right_sub">
                            <a href="/AdmMaster/_local_guide/list" class="btn btn-default"><span
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

<div class="pick_item_pop02" id="popup_location">
    <div>
        <h2>메인노출상품 등록</h2>
        <div class="table_box" style="height: calc(100% - 146px);">
            <ul id="list_location">

            </ul>
        </div>
        <div class="sel_box">
            <button type="button" class="close" onclick="closePopupLocation()">닫기</button>
        </div>
    </div>
</div>

<script>
    function get_info(idx){
        $.ajax({
            url: "/AdmMaster/_local_guide/get_category",
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

        oEditors1?.getById["product_contents"]?.exec("UPDATE_CONTENTS_FIELD", []);

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
                url: "/AdmMaster/_local_guide/del_all_image",
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
                    url: "/AdmMaster/_local_guide/del_image",
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