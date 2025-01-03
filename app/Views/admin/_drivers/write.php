<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>

<?php

$titleStr = " 가이드 소개 수정";
if ($driver_idx && $driver) {
    foreach ($driver as $keys => $vals) {
        ${$keys} = $vals;

    }
    $titleStr = " 가이드 소개 등록";
}
?>

    <style>
        ul#reg_cate,
        ul#reg_cate li {
            width: auto;
            display: unset;
        }

        ul#reg_cate li span {
            margin-left: 30px;
        }

        .img_add #input_file_ko {
            display: none;
        }
    </style>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>

                            <li><a href="/AdmMaster/_drivers/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($driver_idx) { ?>
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

            <div id="contents">
                <div class="listWrap_noline">
                    <!--  target="hiddenFrame22"  -->
                    <form name="frm" id="frm" action="" method="post" enctype="multipart/form-data"
                          target="hiddenFrame22"> <!--  -->
                        <!-- 상품 고유 번호 -->
                        <input type="hidden" name="d_idx" id="d_idx" value='<?= $driver_idx ?>'/>

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
                                    <th>닉네임</th>
                                    <td>
                                        <input type="text" name="special_name" value="<?= $special_name ?? '' ?>"
                                               class="text"/>
                                    </td>
                                    <th>경력</th>
                                    <td>
                                        <input type="text" name="exp" value="<?= $exp ?>"
                                               class=""/>
                                    </td>
                                </tr>

                                <!--                                <tr>-->
                                <!--                                    <th>전화번호</th>-->
                                <!--                                    <td>-->
                                <!--                                        <input type="text" name="phone" value="-->
                                <?php //= $phone ?? '' ?><!--" class="text"/>-->
                                <!--                                    </td>-->
                                <!--                                    <th>이메일 주소</th>-->
                                <!--                                    <td>-->
                                <!--                                        <input type="text" name="email" value="-->
                                <?php //= $email ?? '' ?><!--" class="text"/>-->
                                <!--                                    </td>-->
                                <!--                                </tr>-->

                                <tr>
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" name="onum" value="<?= $onum ?? '' ?>"
                                               class="number" min="1"/>
                                        <span style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                    <th>판매상태결정</th>
                                    <td>
                                        <select name="is_show" id="is_show">
                                            <option value="A" <?php if (isset($is_show) && $is_show === "A") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            </option>
                                            <option value="S" <?php if (isset($is_show) && $is_show === "S") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>차량 유형</th>
                                    <td>
                                        <select id="vehicle_type" class="input_select" name="vehicle_type">
                                            <?php foreach ($fresult as $frow) { ?>
                                                <option value="<?= $frow["code_no"] ?>"><?= $frow["code_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <th>차량 이름</th>
                                    <td>
                                        <input type="text" name="vehicle_name" value="<?= $vehicle_name ?>"
                                               class=""/>
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

                                <?php
                                $avatarUrl = '/uploads/drivers/' . $avatar;
                                $vehicle_imageUrl = '/uploads/drivers/' . $vehicle_image;
                                ?>

                                <tr>
                                    <th>메인 이미지(600X400)</th>
                                    <td colspan="3">
                                        <div class="img_add">
                                            <div class="file_input <?= empty(${"avatar"}) ? "" : "applied" ?>">
                                                <input type="file" name='avatar' id="avatar"
                                                       onchange="productImagePreview(this)">
                                                <label for="avatar" <?= !empty(${"avatar"}) ? "style='background-image:url($avatarUrl)'" : "" ?>></label>
                                                <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>
                                                <a class="img_txt imgpop" href="<?= $avatarUrl ?>"
                                                   id="text_avatar">미리보기</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>차량 식별 이미지(600X400)</th>
                                    <td colspan="3">
                                        <div class="img_add">
                                            <div class="file_input <?= empty(${"vehicle_image"}) ? "" : "applied" ?>">
                                                <input type="file" name='vehicle_image' id="vehicle_image"
                                                       onchange="productImagePreview(this)">
                                                <label for="vehicle_image" <?= !empty(${"vehicle_image"}) ? "style='background-image:url($vehicle_imageUrl)'" : "" ?>></label>
                                                <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>
                                                <a class="img_txt imgpop" href="<?= $vehicle_imageUrl ?>"
                                                   id="text_vehicle_image">미리보기</a>
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
                                <a href="/AdmMaster/_drivers/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($driver_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
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

        </div><!-- 인쇄 영역 끝 //-->
    </div>

    <iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
    <script>
        function productImagePreview(inputFile) {
            if (sizeAndExtCheck(inputFile) == false) {
                inputFile.value = "";
                return false;
            }

            let inp = $(inputFile);
            let name = inp.attr('name')

            let imageTag = document.querySelector('label[for="' + name + '"]');

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
        function send_it() {
            let formData = new FormData($('#frm')[0]);

            let apiUrl = `<?= route_to('admin._drivers.write_ok') ?>`;

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
                    <?php if ($driver_idx):?>
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
            let url = '<?= route_to('admin._drivers.delete') ?>';

            let data = {
                driver_idx: '<?= $driver_idx ?>'
            };

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    alert_(response.message);
                    console.log(response)
                    window.location.reload();
                }
            });
        }

    </script>
<?= $this->endSection() ?>