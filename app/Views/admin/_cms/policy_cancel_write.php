<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <link rel="stylesheet" href="/AdmMaster/_common/css/sms_contents.css" type="text/css"/>
    <script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style type="text/css">
        .radio_sel span {
            margin-right: 15px;
        }
    </style>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>약관 및 정책</h2>
                    <div class="menus">
                        <ul>
                            <li><a href="./policy_cancel_list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($p_idx) { ?>
                                <li><a href="javascript:send_its()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                            <?php } else { ?>
                                <li><a href="javascript:send_its()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">신규등록</span></a>
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
                    <form name="frm" id="frm" action="policy_cancel_ok" method="post" enctype="multipart/form-data">
                        <input type="text" name="product_idx" id="" hidden value="<?= $product_idx ?>">
                        <?php if ($p_idx || $product_idx) { ?>
                            <input type="text" name="p_idx" id="p_idx" hidden value="<?= $p_idx ?>">
                            <input type="hidden" name="product_code" id="product_code" value="<?= $product_code ?>">
                            <input type="hidden" name="product_code_2" id="product_code_2" value="<?= $product_code_2 ?>">
                            <input type="hidden" name="product_code_3" id="product_code_3" value="<?= $product_code_3 ?>">
                        <?php } ?>

                        <?php

                        ?>

                        <div class="listBottom">

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%">
                                    <col width="70%">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>여행형태</th>
                                    <td class="input_box travel_box">
                                        <div class="travel_box_child" style="display: flex;gap: 10px;">
                                            <?php if ($p_idx || $product_idx) { ?>
                                                <input style="width: 12%" type="text" name="" value="<?= $product_code_name ?>"
                                                    disabled>

                                                <?php if ($product_code_name_2): ?>
                                                    <input style="width: 12%" type="text" name="product_code_2"
                                                        value="<?= $product_code_name_2 ?>" disabled>
                                                <?php endif; ?>
                                                <?php if ($product_code_name_3) { ?>
                                                    <input type="text" name="product_code_3" value="<?= $product_code_name_3 ?>"
                                                        style="width: 12%" disabled>
                                                <?php } ?>
                                                <input type="text" name="" id="products" class="in_pro" value="<?= $product_name ?>"
                                                    style="width: 12%" disabled>
                                            <?php } else {
                                                ?>
                                                <select name="product_code" id="product_code_1">
                                                    <option value="">선택</option>
                                                    <?php

                                                    foreach ($list_code as $row0) {
                                                        ?>
                                                        <option value="<?= $row0['code_no'] ?>"><?= $row0['code_name'] ?></option>
                                                        <?php
                                                    }

                                                    ?>
                                                </select>
                                                <select style="display: none;" name="product_code_2" id="product_code_2">
                                                    <option value="">선택</option>
                                                </select>
                                                <select style="display: none; padding-right: 40px; width: 12%;" name="product_idx" id="products">
                                                    <option value="">선택</option>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>약관명</th>
                                    <td>
								    <textarea name="policy_contents" id="policy_contents" rows="10" cols="100"
                                          class="input_txt"
                                          style="width:100%; height:400px; display:none;"><?= isset($policy_contents) ? viewSQ($policy_contents) : '' ?></textarea>

                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "policy_contents",
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
                        </div>

                </div>
                <!-- // contents -->

            </div><!-- 인쇄 영역 끝 //-->
        </div>
        <!-- // container -->
    </div>
    <script>
        function send_its() {
            var frm = document.frm;
            oEditors1.getById["policy_contents"].exec("UPDATE_CONTENTS_FIELD", []);
            $("#frm").submit();
        }

    </script>

    <script>
        $("#product_code_1").on("change", function (event) {
            $.ajax({
                url: "/tools/get_travel_types",
                type: "POST",
                data: {
                    code: event.target.value,
                    depth: 3
                },
                success: function (res) {
                    const data = JSON.parse(res);
                    if (data.cnt == 0) {
                        $("#product_code_2").hide();
                        // $("#product_code_3").hide();
                        $("#products").hide();
                    } else {
                        $("#product_code_2").html(data.data);
                        $("#product_code_2").show();
                        // $("#product_code_3").show();
                        $("#products").show();
                    }
                }
            })
        })

        function openListType() {
            let product_code_1 = $("#product_code_1").val();
            let product_code_2 = $("#product_code_2").val();

            if (product_code_1 == "1324" && product_code_2 == "132404") {
                $("#product_code_3").show();
            } else {
                $("#product_code_3").hide();
            }
        }

        function showListCodeType(type) {
            let product_code_1 = $("#product_code_1").val();
            let product_code_2 = $("#product_code_2").val();
            let product_code_3 = $("#product_code_3").val();
            let url = '<?= route_to('tools.get_list_code_type_review') ?>?type=' + type
                + '&product_code_1=' + product_code_1
                + '&product_code_2=' + product_code_2
                + '&product_code_3=' + product_code_3;

            $.ajax({
                url: url,
                type: "GET",
                success: function (res) {
                    console.log(res);
                    let html = '';
                    let codes = res.data.codes;

                    if(product_code_2 == "132403") {
                        $(".guide_n").hide();
                    } else {
                        $(".guide_n").show();
                        for (let i = 0; i < codes.length; i++) {
                            let code = codes[i];
    
                            html += `<div class="wrapper_label">
                                        <input type="checkbox" class="input_checkbox" value="${code.code_no}"
                                            ${code.checked}
                                            name="input_checkbox" id="input_checkbox${code.code_no}">
                                        <label for="input_checkbox${code.code_no}" style="margin-right: 10px">${code.code_name}</label>
                                    </div>`;
                        }
    
                        $('#list_code_type').empty().append(html);
                    }

                }
            })
        }

        getListCodeType();

        function getListCodeType() {
            let product_idx = `<?= $product_idx ?>`;
            let idx = `<?= $idx ?>`;
            let url = '<?= route_to('tools.get_list_code_type_review') ?>?product_idx=' + product_idx + '&idx=' + idx;

            $.ajax({
                url: url,
                type: "GET",
                success: function (res) {
                    console.log(res);
                    let html = '';
                    let codes = res.data.codes;

                    for (let i = 0; i < codes.length; i++) {
                        let code = codes[i];

                        html += `<div class="wrapper_label">
                                    <input type="checkbox" class="input_checkbox" value="${code.code_no}"
                                        ${code.checked}
                                        name="input_checkbox" id="input_checkbox${code.code_no}">
                                    <label for="input_checkbox${code.code_no}" style="margin-right: 10px">${code.code_name}</label>
                                </div>`;
                    }

                    $('#list_code_type').empty().append(html);
                }
            })
        }

        $("#product_code_2").on("change", function (event) {
            let product_code_1 = $("#product_code_1").val();
            let product_code_2 = $(this).val();
            openListType();
            if (product_code_1 == "1324" && product_code_2 == "132404") {
                $("#products").show();
                let product_code_2 = $("#product_code_2").val();
                $.ajax({
                    url: "/tools/get_list_product",
                    type: "POST",
                    data: {
                        product_code: product_code_2,
                        s_code: event.target.value
                    },
                    dataType: 'json',
                    success: function (res) {
                        // const data = JSON.parse(res);
                        // $("#product_code_3").html(data.data)
                        showListCodeType(3);
                        $("#products").html(res.data)
                    }
                })
            } else {
                $.ajax({
                    url: "/tools/get_list_product",
                    type: "POST",
                    data: {
                        product_code: event.target.value,
                    },
                    dataType: 'json',
                    success: function (res) {
                        // const data = JSON.parse(res);
                        // $("#product_code_3").html(data.data)
                        showListCodeType(2);
                        $("#products").html(res.data)
                    }
                })
            }
        })
        

        $("#product_code_3").on("change", function (event) {
            let product_code_2 = $("#product_code_2").val();
            $.ajax({
                url: "/tools/get_list_product",
                type: "POST",
                data: {
                    product_code: product_code_2,
                    s_code: event.target.value
                },
                dataType: 'json',
                success: function (res) {
                    // const data = JSON.parse(res);
                    // $("#product_code_3").html(data.data)
                    showListCodeType(3);
                    $("#products").html(res.data)
                }
            })
        })

        $("#products").on("change", function () {
            let product_idx = $(this).val();

            if (product_idx) {
                $.ajax({
                    url: "/AdmMaster/_cms/check_product_exists",
                    type: "POST",
                    data: { product_idx: product_idx },
                    dataType: "json",
                    success: function (res) {
                        if (res.exists) {
                            alert("제품이 이미 존재합니다. 다른 제품을 선택하세요.");
                            $("#products").val("");
                        }
                    }
                });
            }
        });
    </script>

<?= $this->endSection() ?>