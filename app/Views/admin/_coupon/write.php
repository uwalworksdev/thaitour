<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<?php

    $titleStr = "생성";

    if ($idx) {
        foreach ($row as $keys => $vals) {
            ${$keys} = $vals;
        }

        $titleStr = "수정";
    }

?>

<style>
    .img_add #input_file_ko {
        display: none;
    }

    .img_add.img_add_group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .img_add .file_input + .file_input {
        margin-left: 0;
    }
</style>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>쿠폰설정 <?= $titleStr ?> </h2>
                <div class="menus">
                    <ul>
                        <li><a href="javascript:history.back();" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        </li>

                        <?php if ($idx) { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>

                            <li><a href="javascript:del_it()" class="btn btn-default"><span
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

        <form name="frm" action="<?= route_to('admin.coupon.write_ok') ?>" method="post" enctype="multipart/form-data" target="hiddenFrame">
            <input type="hidden" name="idx" value='<?= $idx ?>'>
            <input type="hidden" name="publish_type" value='N'>
            <input type="hidden" name="coupon_type" id="coupon_type" value="both">
            <input type="hidden" name="product_code_list" id="product_code_list" value="<?=$product_code_list?>">

            <div id="contents">
                <div class="listWrap_noline">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>카테고리선택</th>
                                    <td colspan="3">
                                        <select id="product_code_1" name="product_code_1" class="input_select" onchange="get_code(this.value, 3)">
                                            <option value="">1차분류</option>
                                            <?php
                                            foreach ($code_list as $code) {
                                                $status_txt = "";
                                                if ($code["status"] == "Y") {
                                                    $status_txt = "";
                                                } elseif ($code["status"] == "N") {
                                                    $status_txt = "[삭제]";
                                                } elseif ($code["status"] == "C") {
                                                    $status_txt = "[마감]";
                                                }
                                                ?>
                                                <option value="<?= $code["code_no"] ?>"><?= $code["code_name"] ?>
                                                    <?= $status_txt ?></option>
                                            <?php } ?>
                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select">
                                            <option value="">2차분류</option>
                                        </select>
                                        <select id="product_idx" name="product_idx" class="input_select">
                                            <option value="">3차분류</option>
                                        </select>
                                        <button type="button" id="btn_reg_cate" class="btn_01">등록</button>
                                    </td>
                                </tr>
                                <?php
                                    // $_product_code_arr = explode("|", $product_code_list);
                                    // $_product_code_arr = array_filter($_product_code_arr);
                                ?>
                                <tr>
                                    <th>등록된 카테고리</th>
                                    <td colspan="3">
                                        <ul id="reg_cate">
                                            <?php
                                                foreach($coupon_category_list as $cat){
                                            ?> 
                                                <li>[<?= $cat["product_idx"] ?>] <?php echo $cat["product_code_name_1"] . " > " . $cat["product_code_name_2"] . " > " . $cat["product_name"];?> 
                                                <span onclick="delCategory('<?= $cat['product_code_1'] ?>', '<?= $cat['product_code_2'] ?>', '<?= $cat['product_idx'] ?>', this);">삭제</span>
                                                </li>       
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <th>쿠폰명</th>
                                    <td>
                                        <input type="text" id="coupon_name" name="coupon_name"
                                                value="<?= isset($coupon_name) ? $coupon_name : '' ?>"
                                                class="input_txt" style="width:30%"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>쿠폰 종류</th>
                                    <td>
                                        <input type="checkbox" name="type_select[]" id="chk_member" value="M" <?php echo (strpos($type_select, "M") !== false) ? "checked" : ""; ?>>
                                        <label for="chk_member">신입 회원 가입 시</label>
                                        <input type="checkbox" name="type_select[]" id="chk_birthday" value="B" <?php echo (strpos($type_select, "B") !== false) ? "checked" : ""; ?>>
                                        <label for="chk_birthday">회원 생일 시</label>
                                        <input type="checkbox" name="type_select[]" id="chk_all" value="A" <?php echo (strpos($type_select, "A") !== false) ? "checked" : ""; ?>>
                                        <label for="chk_all">전체</label>
                                    </td>
                                </tr>

                                <tr>
                                    <th>대상</th>
                                    <td>
                                        <select name="member_grade" id="member_grade">
                                            <?php
                                                foreach($grade_list as $grade){
                                            ?>
                                                <option value="<?=$grade["g_idx"]?>" <?php if (isset($member_grade) && $grade["g_idx"] == $member_grade){ echo "selected"; } ?> >
                                                    <?=$grade["grade_name"]?>
                                                </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인방법</th>
                                    <td>
                                        <select name="dc_type" id="dc_type">
                                            <option value="P" <?php if (isset($dc_type) && $dc_type == "P") echo "selected"; ?> >
                                                할인율
                                            </option>
                                            <option value="D" <?php if (isset($dc_type) && $dc_type == "D") echo "selected"; ?> >
                                                가격할인
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인율 설정</th>
                                    <td>
                                        <input type="text" id="coupon_pe" name="coupon_pe"
                                                value="<?= isset($coupon_pe) ? $coupon_pe : '' ?>"
                                                style="width:100px;" class="input_txt onlynum" maxlength="3"/> %
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인가격</th>
                                    <td>
                                        <input type="text" id="coupon_price" name="coupon_price"
                                                value="<?= isset($coupon_price) ? $coupon_price : '' ?>"
                                                style="width:100px;" class="input_txt onlynum"/> 바트
                                    </td>
                                </tr>

                                <tr>
                                    <th>최대사용금액</th>
                                    <td>
                                        <input type="text" id="max_coupon_price" name="max_coupon_price"
                                                value="<?= isset($max_coupon_price) ? $max_coupon_price : '' ?>"
                                                style="width:100px;" class="input_txt onlynum"/> 바트
                                    </td>
                                </tr>

                                <tr>
                                    <th>발행일수</th>
                                    <td>
                                        <div style="text-align:left;">
											<input type="text" name="exp_start_day" id="exp_start_day" value="<?=isset($exp_start_day) ? date("Y-m-d", strtotime($exp_start_day)) : ''?>" style="text-align: center;background: white; width: 120px;" readonly> ~
											<input type="text" name="exp_end_day" id="exp_end_day" value="<?=isset($exp_end_day) ? date("Y-m-d", strtotime($exp_end_day)) : ''?>" style="text-align: center;background: white; width: 120px;" readonly>
										</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>쿠폰설명</th>
                                    <td>
                                <textarea name="etc_memo" id="etc_memo" rows="10" cols="100" class="input_txt"
                                            style="width:100%; height:100px;"><?= viewSQ(isset($etc_memo) ? $etc_memo : ''); ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상태설정</th>
                                    <td>
                                        <select name="state" id="state">
                                            <option value="Y" <?php if (isset($state) && $state == "Y") echo "selected"; ?> >
                                                사용
                                            </option>
                                            <option value="N" <?php if (isset($state) && $state == "N") echo "selected"; ?> >
                                                중지
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상태설정</th>
                                    <td>
                                        <textarea name="coupon_contents" id="coupon_contents" rows="10" cols="100" class="input_txt"
                                            style="width:100%; height:400px; display:none;"><?= viewSQ($coupon_contents) ?></textarea>
                                            <script type="text/javascript">
                                                var oEditors = [];

                                                // 추가 글꼴 목록
                                                //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                                nhn.husky.EZCreator.createInIFrame({
                                                    oAppRef: oEditors,
                                                    elPlaceHolder: "coupon_contents",
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

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:50px;">
                            
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
                                                for($i = 1; $i <= 1; $i++) : 
                                                    $img = get_img(${"ufile" . $i}, "/data/coupon/", "600", "440");
                                            ?>
                                                <div class="file_input <?=empty(${"ufile" . $i}) ? "" : "applied"?>">
                                                    <input type="file" name='ufile<?=$i?>' id="ufile<?=$i?>" onchange="productImagePreview(this, '<?=$i?>')">
                                                    <label for="ufile<?=$i?>" <?=!empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : ""?>></label>
                                                    <input type="hidden" name="checkImg_<?=$i?>" class="checkImg">
                                                    <button type="button" class="remove_btn" onclick="productImagePreviewRemove(this)"></button>
													<?php if(${"ufile" . $i}) { ?>		
                                                        <a class="img_txt imgpop" href="<?=$img?>" id="text_ufile<?=$i?>">미리보기</a>
													<?php } ?>   
                                                </div>
                                            <?php 
                                                endfor; 
                                            ?>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        서브이미지(600X400) 
                                        <button type="button" class="btn_01" onclick="add_sub_image();">추가</button>
                                    </th>
                                    <td colspan="3">
                                        <div class="img_add img_add_group">
                                            <?php
                                                $i = 2;
                                                foreach ($img_list as $img) :
                                                    $s_img = get_img($img["ufile"], "/data/coupon/", "600", "440");
                                            ?>
                                            <div class="file_input_wrap">
                                                <div class="file_input <?= empty($img["ufile"]) ? "" : "applied" ?>">
                                                    <input type="hidden" name="i_idx[]" value="<?= $img["i_idx"] ?>">
                                                    <input type="file" name='ufile[]' id="ufile<?= $i ?>"
                                                            onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty($img["ufile"]) ? "style='background-image:url($s_img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
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

                                <!-- <tr>
                                    <th>대표이미지(600X400)</th>
                                    <td colspan="3">

                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                                style="width:500px;margin-bottom:10px"/>
                                        <?php if (isset($ufile1) && $ufile1 !== "") { ?>
                                            <br>파일삭제:<input type="checkbox" name="del_1" value='Y'>
                                            <a href="/data/coupon/<?= $ufile1 ?>"
                                                class="imgpop"><?= $rfile1 ?></a>
                                                <br>
                                                <br>
                                            <img src="/data/coupon/<?= $ufile1 ?>" width="200px"/>
                                        <?php } ?>

                                    </td>
                                </tr>

                                <?php for ($i = 2; $i <= 7; $i++) { ?>
                                    <tr>
                                        <th>서브이미지<?= $i - 1 ?>(600X400)</th>
                                        <td colspan="3">

                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                    style="width:500px;margin-bottom:10px"/>
                                            <?php if (isset(${"ufile" . $i}) && ${"ufile" . $i} !== "") { ?>
                                                <br>파일삭제: <input type=checkbox name="del_<?= $i ?>" value='Y'>
                                                <a href="/data/coupon/<?= ${"ufile" . $i} ?>" class="imgpop"><?= ${"rfile" . $i} ?></a>
                                                <br>
                                                <br>
                                                <img src="/data/coupon/<?= ${"ufile" . $i} ?>" width="200px"/>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?> -->
                            </tbody>
                        </table>
                    </div>
                    <!-- // listBottom -->

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">

                                <a href="javascript:history.back();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">수정</span></a>

                                    <a href="javascript:del_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>

                                <?php } ?>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- // listWrap -->

            </div>
            <!-- // contents -->
        </form>
    </div><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->
<script>
    $(function () {

        $("#exp_start_day").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "both",
            buttonImage: "/images/admin/common/date.png",
            buttonImageOnly: true,
            closeText: '닫기',
            currentText: '오늘',
            prevText: '이전',
            nextText: '다음',
            yearRange: "c:c+10",
            minDate: new Date(),
            maxDate: "+99Y",
            onClose: function (selectedDate) {
                $("#exp_end_day").datepicker("option", "minDate", selectedDate);
            },
            beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            }
        });


        $("#exp_end_day").datepicker({
            showButtonPanel: true
            , onClose: function (selectedDate) {
                // To 날짜 선택기의 최소 날짜를 설정
                $("#exp_start_day").datepicker("option", "maxDate", selectedDate);
            }
            , beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            }
            , dateFormat: 'yy-mm-dd'
            , showOn: "both"
            , yearRange: "c:c+30"
            , buttonImage: "/images/admin/common/date.png"
            , buttonImageOnly: true
            , closeText: '닫기'
            , currentText: '오늘' // 오늘 버튼 텍스트 설정
            , prevText: '이전'
            , nextText: '다음'
            , minDate: new Date() 
            , maxDate: "+99Y"
        });
    });
    
</script>
<script type="text/javascript">
    function add_sub_image() {        

        let i = Date.now();

        let html = `
            <div class="file_input">
                <input type="hidden" name="i_idx[]" value="">
                <input type="file" name='ufile[]' id="ufile${i}"
                        onchange="productImagePreview(this, '${i}')">
                <label for="ufile${i}"></label>
                <input type="hidden" name="checkImg_${i}" class="checkImg">
                <button type="button" class="remove_btn"
                        onclick="productImagePreviewRemove(this)"></button>

            </div>
        `;

        $(".img_add_group").append(html);

    }

    function productImagePreview(inputFile, onum) {
        if (!sizeAndExtCheck(inputFile)) {
            $(inputFile).val("");
            return false;
        }

        let imageTag = $('label[for="ufile' + onum + '"]');

        if (inputFile.files.length > 0) {
            let imageReader = new FileReader();

            imageReader.onload = function () {
                imageTag.css("background-image", "url(" + imageReader.result + ")");
                $(inputFile).closest('.file_input').addClass('applied');
                $(inputFile).closest('.file_input').find('.checkImg').val('Y');
            };
            
            imageReader.readAsDataURL(inputFile.files[0]);
        }
    }

	/**
     * 상품 이미지 삭제
     * @param {element} button
     */
	function productImagePreviewRemove(element) {
        let parent = $(element).closest('.file_input');
        let inputFile = parent.find('input[type="file"]');
        let labelImg = parent.find('label');
        let i_idx = parent.find('input[name="i_idx[]"]').val();
        
        if(parent.find('input[name="i_idx[]"]').length > 0){
            if(i_idx){

                if(!confirm("이미지를 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다.")){
                    return false;
                }

                $.ajax({
        
                    url: "/AdmMaster/_hotel/del_image",
                    type: "POST",
                    data: {
                            "i_idx"   : i_idx,
                    },
                    success: function (data, textStatus) {
                        message = data.message;
                        alert(message);
                        if(data.result){
                            parent.closest('.file_input_wrap').remove();
                        }
                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
            }else{
                parent.remove();
            }
        }else{
            inputFile.val("");
            labelImg.css("background-image", "");
            parent.removeClass('applied');
            parent.find('.checkImg').val('N');
            parent.find('.imgpop').attr("href", "");
            parent.find('.imgpop').remove();
        }
    }

	function sizeAndExtCheck(input) {
		let fileSize        = input.files[0].size;
		let fileName        = input.files[0].name;

		// 20MB
		let megaBite        = 20;
		let maxSize         = 1024 * 1024 * megaBite;

		if(fileSize > maxSize) {
			alert("파일용량이 "+megaBite+"MB를 초과할 수 없습니다.");
			return false;
		}
		
		let fileNameLength  = fileName.length;
		let findExtension   = fileName.lastIndexOf('.');
		let fileExt         = fileName.substring(findExtension, fileNameLength).toLowerCase();

		if(fileExt != ".jpg" && fileExt != ".jpeg" && fileExt != ".png" && fileExt != ".gif" && fileExt != ".bmp" && fileExt != ".ico") {
			alert("이미지 파일 확장자만 업로드 할 수 있습니다.");
			return false;
		}

		return true;
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
                if (depth <= 3) {
                    $("#product_code_2").find('option').each(function () {
                        $(this).remove();
                    });
                    $("#product_code_2").append("<option value=''>2차분류</option>");

                    $("#product_idx").find('option').each(function () {
                        $(this).remove();
                    });
                    $("#product_idx").append("<option value=''>3차분류</option>");
                }

                var list = $.parseJSON(json);
                var listLen = list.length;
                var contentStr = "";
                for (var i = 0; i < listLen; i++) {
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

    $("#product_code_2").on("change", function(event) {
        $.ajax({
            url: "/ajax/get_list_product",
            type: "GET",
            data: {
                field: "product_code_2",
                product_code: event.target.value
            },
            success: function(res) {
                let data = res.results;
                let html = `<option value=''>선택</option>`;
                data.forEach(element => {
                    html += `<option value='${element["product_idx"]}'>${element["product_name"]}</option>`;
                });
                $("#product_idx").html(html);
            }
        })
    });

    $("#btn_reg_cate").click(function () {

        let tmp_code = "";
        let tmp_code_txt = "";

        let cate_code1 = $("#product_code_1").val();
        let cate_text1 = $("#product_code_1 option:selected").text();

        if (cate_code1 !== "") {
            tmp_code_txt += cate_text1;
        }

        let cate_code2 = $("#product_code_2").val();
        let cate_text2 = $("#product_code_2 option:selected").text();

        if (cate_code2 !== "") {
            tmp_code_txt += " > " + cate_text2;
        }

        let product_idx = $("#product_idx").val();
        let product_name = $("#product_idx option:selected").text();

        if (product_idx !== "") {
            tmp_code_txt += " > " + product_name;
        }

        if (product_idx === "") {
            alert("카테고리를 선택해주세요.");
            return false;
        }

        addCategory(cate_code1, cate_code2, product_idx, tmp_code_txt);

    });

    function addCategory(cate_code1, cate_code2, product_idx, cateText) {
        // 코드 추가 부분
        if (chkCategory(cate_code1, cate_code2, product_idx)) {
            alert("이미 등록된 카테고리입니다.");
            return false;
        }
        var tmp_product_code = $("#product_code_list").val();
        ;
        tmp_product_code = tmp_product_code + "|" + cate_code1 + "," + cate_code2 + "," + product_idx + "|";
        $("#product_code_list").val(tmp_product_code);

        var newList = "<li>[" + product_idx + "] " + cateText + " <span onclick=\"delCategory('" + cate_code1 + "', '" + cate_code2 + "', '" + product_idx + "', this);\" >삭제</span></li>";
        $("#reg_cate").append(newList);
    }

    // 카테고리 삭제 함수
    function delCategory(cate_code1, cate_code2, product_idx, obj) {

        
        if (chkCategory(cate_code1, cate_code2, product_idx)) {

            var tmp_product_code = $("#product_code_list").val();
            var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

            var code_array = re_tmp_product_code.split('||');

            var tmp_product_code_re = "";

            $.each(code_array, function (key, val) {
                let arr = val.split(",");
                
                if(arr[0] != cate_code1 || arr[1] != cate_code2 || arr[2] != product_idx){
                    tmp_product_code_re = tmp_product_code_re + "|" + arr[0] + "," + arr[1] + "," + arr[2] + "|";
                }

            });

            $("#product_code_list").val(tmp_product_code_re);
            obj.closest("li").remove();

        }
    }

    function chkCategory(cate_code1, cate_code2, product_idx) {
        var tmp_product_code = $("#product_code_list").val();
        var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

        var code_array = re_tmp_product_code.split('||');
        let check = false;
        
        for(let i = 0; i < code_array.length; i++){
            
            if(code_array[i]){
                let arr = code_array[i].split(",");
                if(arr[0] == cate_code1 && arr[1] == cate_code2 && arr[2] == product_idx){
                    check = true;
                    break;
                }
            }
        }
        return check;
        // return ($.inArray(chkcode, code_array));
    }

    function send_it() {

        var frm = document.frm;

        if(typeof oEditors != "undefined") {
            oEditors?.getById["coupon_contents"]?.exec("UPDATE_CONTENTS_FIELD", []);
        }

        if(frm.product_code_list.value == ""){
            alert("카테고리를 등록해주세요.");
            return;
        }

        if (frm.coupon_name.value == "") {
            frm.coupon_name.focus();
            alert("쿠폰명을 입력하셔야 합니다.");
            return;
        }

        if ($("#dc_type").val() == "P") {
            if (frm.coupon_pe.value == "") {
                frm.coupon_pe.focus();
                alert("할인율 설정을 입력하셔야 합니다.");
                return;
            }
        } else {
            if (frm.coupon_price.value == "") {
                frm.coupon_price.focus();
                alert("할인가격 설정을 입력하셔야 합니다.");
                return;
            }
        }

        if (frm.exp_start_day.value == "") {
            frm.exp_start_day.focus();
            alert("발행일수를 입력하셔야 합니다.");
            return;
        }

        if (frm.exp_end_day.value == "") {
            frm.exp_end_day.focus();
            alert("발행일수를 입력하셔야 합니다.");
            return;
        }

        $("#ajax_loader").removeClass("display-none");

        frm.submit();
    }

    function del_it() {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            handleDel();
        }
    }

    function handleDel() {
        let uri = `<?= route_to('admin.coupon.delete') ?>`;

        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: uri,
            type: "POST",
            data: "idx[]=" + `<?= $idx ?? ''?>`,
            async: false,
            cache: false,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }

            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert("정상적으로 삭제되었습니다.");
                window.location.href = '/AdmMaster/_coupon/list';
                return;
            }
        });
    }

</script>
    
<iframe width="0" height="0" name="hiddenFrame" id="hiddenFrame" src="" style="display:none;"></iframe>
<?= $this->endSection() ?>