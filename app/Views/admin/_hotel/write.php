<?php
    $formAction = $product_idx ? "/AdmMaster/_hotel/write_ok/$product_idx" : "/AdmMaster/_hotel/write_ok";
    helper("my_helper");
?>

<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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

        .img_add .file_input + .file_input {
            margin-left: 0;
        }
    </style>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="/js/admin/tours/write.js"></script>
    <style>
        .tab_title {
            font-size: 16px;
            color: #333333;
            font-weight: bold;
            height: 28px;
            line-height: 28px;
            background: url('/img/ico/deco_tab_title.png') left center no-repeat;
            padding-left: 43px;
            margin-left: 7px;
            margin-bottom: 26px;
        }

        #input_file_ko {
            display: inline-block;
            width: 500px;
        }

        .popup_ {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: rgba(0, 0, 0, 0.2);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .popup_.show_ {
            display: flex;
        }

        .popup_area_ {
            height: auto;
            /*min-height: 50vh;*/
            max-height: 60vh;
            overflow: auto;
            background-color: #FFFFFF;
            width: 100%;
            max-width: 800px;
            padding: 10px 40px 30px;
            font-size: 14px;
        }

        .popup_area_xl_ {
            max-width: 60vw;
        }

        .popup_top_ {
            width: 100%;
            height: 50px;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #dbdbdb;
        }

        .popup_content_ {
            margin-top: 20px;
        }

        .popup_bottom_ {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding-top: 20px;
            width: 100%;
            border-top: 1px solid #dbdbdb;
        }

        .popup_bottom_ button {
            display: inline-block;
            width: 100px;
            height: 40px;
            border: 1px solid rgb(204, 204, 204);
        }

        .table_border_ {
            border: 2px solid #dbdbdb;
        }

        .table_border_ th,
        .table_border_ td {
            border: 1px solid #dbdbdb;
            padding: 10px 20px;
        }

        .table_border_ th {
            background-color: rgba(220, 220, 220, 0.5);
        }

        .table_border_ td.list_g_idx_ {
            vertical-align: middle;
            text-align: center;
        }

        .btn_select_room_list {
            background-color: #17469E;
            color: #FFFFFF;
            width: 80px !important;
            height: 35px !important;
            margin: 10px 0 !important;
        }

        .room_list_render_ .item_ {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 20px;
            margin-bottom: 10px;
        }

        .room_list_render_ input:not('type=checkbox') {
            width: 25%;
            cursor: not-allowed;
        }

        .room_list_render_ button.delete_ {
            margin: 0 !important;
            background-color: #EA353D;
            color: #FFFFFF;
            height: 30px;
        }

        .room_list_render_ button.update_ {
            margin: 0 !important;
            background-color: rgba(23, 70, 158, 0.75);
            color: #FFFFFF;
            height: 30px;
        }

        .btn_add {
            background-color: #17469E;
            color: #FFFFFF;
            margin: 0 0 !important;
            width: 80px !important;
            height: 35px !important;
        }

        .justify-between {
            align-items: center;
            justify-content: space-between;
        }

        .img_add #input_file_ko {
            display: none;
        }
    </style>
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
                                <li><a href="javascript:prod_copy('<?= $product_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">제품복사</span></a>
                                </li>
                                <script>
                                    function prod_copy(idx) {
                                        if (!confirm("선택한 상품을 복사 하시겠습니까?"))
                                            return false;

                                        var message = "";
                                        $.ajax({

                                            url: "/AdmMaster/_tourRegist/prod_copy",
                                            type: "POST",
                                            data: {
                                                "product_idx": idx
                                            },
                                            dataType: "json",
                                            async: false,
                                            cache: false,
                                            success: function (data, textStatus) {
                                                alert(data.message);
                                                if (data.status == "success") {
                                                    const searchParams = new URLSearchParams(window.location.search);
                                                    searchParams.set('product_idx', data.newProductIdx);
                                                    location.href = window.location.pathname + '?' + searchParams.toString();
                                                }
                                            },
                                            error: function (request, status, error) {
                                                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                            }
                                        });
                                    }
                                </script>
                            <?php } ?>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <!--li>
                                    <a href="javascript:del_it(`<?= route_to("admin._hotel.del") ?>`, `<?= $product_idx ?>`)"
                                       class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                </li-->
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

                        <input type="hidden" name="code_utilities" id="code_utilities"
                               value='<?= $stay_item['code_utilities'] ?? "" ?>'/>
                        <input type="hidden" name="code_services" id="code_services"
                               value='<?= $stay_item['code_services'] ?? "" ?>'/>
                        <input type="hidden" name="code_best_utilities" id="code_best_utilities"
                               value='<?= $stay_item['code_best_utilities'] ?? "" ?>'/>
                        <input type="hidden" name="code_populars" id="code_populars"
                               value='<?= $stay_item['code_populars'] ?? "" ?>'/>
                        <input type="hidden" name="mbti" id="mbti"
                               value='<?= $mbti ?? "" ?>'/>

                        <input type="hidden" name="room_list" id="room_list"
                               value='<?= $stay_item['room_list'] ?? "" ?>'/>

                        <input type="hidden" name="place_list" id="place_list"
                               value=""/>
                        <input type="hidden" id="check_img_ufile1" value="<?=$ufile1?>">
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
                                        <div class=""
                                             style="width: 100%; display: flex; justify-content: space-between; align-items: center">
                                            <p>상품 기본정보</p>  
                                            <?php if ($product_idx): ?>
                                                <a class="btn btn-default"
                                                   href="/product-hotel/hotel-detail/<?= $product_idx ?>"
                                                   target="_blank">
                                                    상품 상세보기
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>카테고리선택</th>
                                    <td colspan="3">
                                        <select id="product_code_1" name="product_code_1" class="input_select"
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
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_1) echo "selected"; ?> ><?= $frow["code_name"] ?><?= $status_txt ?></option>
                                            <?php } ?>
                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select"
                                                onchange="get_code(this.value, 4)">
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

                                                <li class="new">[<?= $_tmp_code ?>] <?= get_cate_text($_tmp_code) ?>
                                                    <span
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
                                    <td>
                                        <input type="text" name="product_code" id="product_code"
                                               value="<?= $product_code_no ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if (empty($product_idx) || empty($product_code)) { ?>
                                            <!-- <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button> -->
                                            <!-- <button type="button" class="btn_01"
                                                    onclick="check_product_code('<?= $product_code_no ?>');">조회
                                            </button> -->
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>

                                    </td>
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt"
                                               style="width:80px"/> <span
                                                style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>상품명</th>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <input type="text" name="product_name"
                                                   value="<?= $product_name ?? "" ?>"
                                                   class="text" style="width:500px" maxlength="100"/>
                                            <span style="color: gray;">(제목)</span>
                                        </div>
                                        <div style="display: flex; align-items: center;">
                                            <input type="text" name="product_name_en"
                                                value="<?= $product_name_en ?? "" ?>"
                                                class="text" style="width:500px" maxlength="100"/>
                                            <span style="color: gray;">(영문호텔명)</span>
                                        </div>
                                    </td>
                                    <th>핫한 특가</th>
                                    <td>
                                        <input type="checkbox" name="special_price" id="special_price" value="Y"
                                            <?php if (isset($special_price) && $special_price === "Y")
                                                echo "checked=checked"; ?>> <label for="special_price"
                                                                                   style="max-height:200px;margin-right:20px;">핫한
                                            특가</label>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품 담당자</th>
                                    <td>
                                        <input id="product_manager" name="product_manager" class="input_txt" type="text"
                                               value="<?= $product_manager ?? '' ?>" style="width:100px" readonly/>
                                        /<input id="phone" name="phone" class="input_txt" type="text" value="<?= $phone ?? '' ?>" readonly  style="width:200px"/>
                                        /<input id="email" name="email" class="input_txt"  type="text" value="<?= $email ?? '' ?>" readonly  style="width:200px"/>
                                        <select name="product_manager_id" id="product_manager_sel"
                                                onchange="change_manager(this.value)">
                                            <option value="">선택</option>
                                            <?php
                                            foreach ($member_list as $row_member) :
                                                ?>
                                                <option value="<?= $row_member["user_id"] ?>" <?php if ($product_manager_id == $row_member["user_id"]) {
                                                    echo "selected";
                                                } ?>><?= $row_member["user_name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <br><span style="color: gray;">* ex) 상품등록하는 담당자의 성함/연락처/이메일</span>
                                    </td>

                                    <th>판매상태결정</th>
                                    <td>
                                        <select name="product_status" id="product_status">
                                            <option value="stop" <?php if (isset($product_status) && $product_status === "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                            <option value="sale" <?php if (isset($product_status) && $product_status === "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="plan" <?php if (isset($product_status) && $product_status === "plan") {
                                                echo "selected";
                                            } ?>>예약중지
                                            </option>
                                        </select>
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
                                    <th>MBTI</th>
									
                                    <td colspan="3">
									 <input type="checkbox" id="all_code_mbti" class="all_input" name="_code_mbti" value=""/>
                                        <label for="all_code_mbti">
                                            모두 선택 >
                                        </label> &ensp;
                                        <?php
                                        $_arr = explode("|", $mbti);
                                        foreach ($mcodes as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_mbti<?= $row_r['code_no'] ?>"
                                                   name="_code_mbti" class="code_mbti"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                            <label for="code_mbti<?= $row_r['code_no'] ?>">
                                                <?= $row_r['code_name'] ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품 간략소개</th>
                                    <td colspan="3">
										<textarea name="product_info" id="product_info"
                                                  style="width:90%;height:100px;"><?= $product_info ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>목록 간략소개</th>
                                    <td colspan="3">
										<textarea name="product_intro" id="product_intro"
                                                  style="width:90%;height:100px;"><?= $product_intro ?? "" ?></textarea>
                                    </td>
                                </tr>

                               <!--  <tr>
                                    <th>직접결제</th>
                                    <td colspan="3">
                                        <input type="checkbox" name="direct_payment" id="direct_payment"
                                               value="Y" <?php if (isset($direct_payment) && $direct_payment === "Y")
                                            echo "checked=checked"; ?>>
                                    </td>
                                </tr> -->
                                </tbody>
                            </table>
							
							
							<!-- mbti 스크립트 -->
							<script>

                                function check_mbti() {
                                    let count_mbti = 0;

                                    $(".code_mbti").each(function () {
                                        if ($(this).is(":checked")) {
                                            count_mbti++;
                                        }
                                    });

                                    if (count_mbti == $(".code_mbti").length) {
                                        $("#all_code_mbti").prop("checked", true);
                                    } else {
                                        $("#all_code_mbti").prop("checked", false);
                                    }
                                }

                                function check_service() {
                                    let count_service = 0;

                                    $(".code_service").each(function () {
                                        if ($(this).is(":checked")) {
                                            count_service++;
                                        }
                                    });
                                    if (count_service == $(".code_service").length) {
                                        $("#all_code_service").prop("checked", true);
                                    } else {
                                        $("#all_code_service").prop("checked", false);
                                    }
                                }

                                function check_best_utilities() {
                                    let count_best_utilities = 0;

                                    $(".code_best_utilities").each(function () {
                                        if ($(this).is(":checked")) {
                                            count_best_utilities++;
                                        }
                                    });
                                    if (count_best_utilities == $(".code_best_utilities").length) {
                                        $("#all_code_best_utilities").prop("checked", true);
                                    } else {
                                        $("#all_code_best_utilities").prop("checked", false);
                                    }
                                }

                                function check_utility() {
                                    let count_utility = 0;

                                    $(".code_utilities").each(function () {
                                        if ($(this).is(":checked")) {
                                            count_utility++;
                                        }
                                    });
                                    if (count_utility == $(".code_utilities").length) {
                                        $("#all_code_utility").prop("checked", true);
                                    } else {
                                        $("#all_code_utility").prop("checked", false);
                                    }
                                }

                                check_mbti();
                                check_service();
                                check_best_utilities();
                                check_utility();

                                $('#all_code_populars').change(function () {
                                    if ($('#all_code_populars').is(':checked')) {
                                        $('.code_populars').prop('checked', true)
                                    } else {
                                        $('.code_populars').prop('checked', false)
                                    }
                                });

                                $(".code_mbti").on("change", function () {
                                    check_mbti();
                                });

                                $(".code_service").on("change", function () {
                                    check_service();
                                });

                                $(".code_best_utilities").on("change", function () {
                                    check_best_utilities();
                                });

                                $(".code_utilities").on("change", function () {
                                    check_utility();
                                });

                                $('#all_code_mbti').change(function () {
                                    if ($('#all_code_mbti').is(':checked')) {
                                        $('.code_mbti').prop('checked', true)
                                    } else {
                                        $('.code_mbti').prop('checked', false)
                                    }
                                });

                                $(document).ready(function () {										
									// 전체 선택 체크박스 클릭 이벤트
									$("#all_code_service").on("click", function () {
										$(".code_service").prop("checked", $(this).prop("checked"));
									});

									// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
									$(".code_service").on("click", function () {
										$("#all_code_service").prop("checked", $(".code_service:checked").length === $(".code_service").length);
									});										
                                })

                                $(document).ready(function () {										
									// 전체 선택 체크박스 클릭 이벤트
									$("#all_code_best_utilities").on("click", function () {
										$(".code_best_utilities").prop("checked", $(this).prop("checked"));
									});

									// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
									$(".code_best_utilities").on("click", function () {
										$("#all_code_best_utilities").prop("checked", $(".code_best_utilities:checked").length === $(".code_best_utilities").length);
									});										
                                })

								$(document).ready(function () {										
									// 전체 선택 체크박스 클릭 이벤트
									$("#all_code_utility").on("click", function () {
										$(".code_utilities").prop("checked", $(this).prop("checked"));
									});

									// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
									$(".code_utilities").on("click", function () {
										$("#all_code_utility").prop("checked", $(".code_utilities:checked").length === $(".code_utilities").length);
									});										
                                })
                            </script>
							
							<!-- mbti 스크립트 -->

                            <!-- Update product stay-->
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
                                       호텔 기본정보 (1)
                                    </td>
                                </tr>
                                <tr>
                                    <th>도시명</th>
                                    <td>
                                        <input type="text" id="stay_city" name="stay_city" value="<?= $stay_item['stay_city'] ?>" class="input_txt" placeholder="" style="width:50%"/>
                                    </td>
									 <th>호텔 담당자</th>
                                    <td>
                                        이름: <input type="text" id="stay_user_name" name="stay_user_name"  value="<?= $stay_item['stay_user_name'] ?>" class="input_txt" placeholder="" style="width:150px"/>
										&ensp;이메일: <input id="phone" name="phone" class="input_txt" type="text" value="<?= $phone ?? '' ?>"   style="width:150px"/>
                                        &ensp;연락처: <input id="email" name="email" class="input_txt"  type="text" value="<?= $email ?? '' ?>"   style="width:150px"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>체크인/체크아웃</th>
                                    <td>체크인 : 
                                        <select name="stay_check_in_hour">
                                            <option value="">선택</option>
                                            <?php for ($i = 1; $i < 24; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_item['stay_check_in_hour'] == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>시
                                                </option>
                                            <?php } ?>
                                        </select>시
                                        ~
                                        <select name="stay_check_in_min">
                                            <option value="">선택</option>
                                            <?php for ($i = 0; $i < 60; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_item['stay_check_in_min'] == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>분
                                                </option>
                                            <?php } ?>
                                        </select>분&ensp; ~ &ensp;
										
										체크아웃 : <select name="stay_check_out_hour">
                                            <option value="">선택</option>
                                            <?php for ($i = 1; $i < 24; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_item['stay_check_out_hour'] == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>시
                                                </option>
                                            <?php } ?>
                                        </select>시
                                        ~
                                        <select name="stay_check_out_min">
                                            <option value="">선택</option>
                                            <?php for ($i = 0; $i < 60; $i++) { ?>
                                                <option value="<?= str_pad($i, 2, "0", STR_PAD_LEFT) ?>" <?php if ($stay_item['stay_check_out_min'] == str_pad($i, 2, "0", STR_PAD_LEFT)) {
                                                    echo "selected";
                                                } ?> >
                                                    <?= str_pad($i, 2, "0", STR_PAD_LEFT); ?>분
                                                </option>
                                            <?php } ?>
                                        </select>분
                                    </td>
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
                                   
                                </tr>
								<tr>
								 <th>동영상 링크</th>
                                    <td colspan="3">
                                        <input type="text" name="product_video" id="product_video"
                                               value="<?= $product_video ?? "" ?>" class="text"
                                               style="width:90%;"/><br/>
                                    </td>
								</tr>
								<tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" id="stay_address" name="stay_address" value="<?= $stay_item['stay_address'] ?>"
                                               class="input_txt" placeholder="" style="width:45%"/>
                                        <button type="button" class="btn btn-primary" style="width: unset;" onclick="getCoordinates();">get location</button>&ensp;
                                            Latitude : <input type="text" name="latitude" id="latitude" value="<?= $stay_item['latitude'] ?>" class="text" style="width: 200px;" readonly/>
                                            Longitude : <input type="text" name="longitude" id="longitude" value="<?= $stay_item['longitude'] ?>" class="text" style="width: 200px;"  readonly/>
                                        
                                    </td>
                                   
                                </tr>
                                </tbody>

                            </table>
							
							<!-- 호텔 기본정보2 -->
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
                                        호텔 기본정보 (2)
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔 테마</th>
                                    <td colspan="3">
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px ">
                                            <?php
                                            $_product_theme_arr = isset($product_theme) ? explode("|", $product_theme) : [];
                                            $_product_theme_arr = array_filter($_product_theme_arr);
                                            ?>
											<div class="checkbox-item">
												<label>
													<input type="checkbox" id="checkAll_1" >전체선택
												</label>
											</div>
                                            <?php foreach ($pthemes as $item) { ?>
                                                <div class="checkbox-item">
                                                    <label>
                                                        <input type="checkbox" name="select_product[]" class="checkbox_1"
                                                               value="<?= $item['code_no'] ?>"
                                                            <?= in_array($item['code_no'], $_product_theme_arr) ? 'checked' : '' ?>>
                                                        <?= $item['code_name'] ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <!--tr>
                                    <th>호텔 침실수</th>
                                    <td colspan="3">
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px ">
                                            <?php
                                            $_product_bedroom_arr = isset($product_bedrooms) ? explode("|", $product_bedrooms) : [];
                                            $_product_bedroom_arr = array_filter($_product_bedroom_arr);
                                            ?>
											<div class="checkbox-item">
												<label>
													<input type="checkbox" id="checkAll_2" >전체선택
												</label>
											</div>
											
                                            <?php foreach ($pbedrooms as $item) { ?>
                                                <div class="checkbox-item">
                                                    <label>
                                                        <input type="checkbox" name="product_bedrooms[]" class="checkbox_2"
                                                               value="<?= $item['code_no'] ?>"
                                                            <?= in_array($item['code_no'], $_product_bedroom_arr) ? 'checked' : '' ?>>
                                                        <?= $item['code_name'] ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr-->

                                <tr>
                                    <th>호텔타입</th>
                                    <td colspan="3">
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px ">
                                            <?php
                                            $_product_type_arr = isset($product_type) ? explode("|", $product_type) : [];
                                            $_product_type_arr = array_filter($_product_type_arr);
                                            ?>
											<div class="checkbox-item">
												<label>
													<input type="checkbox" id="checkAll_3" >모두선택
												</label>
											</div>
											
                                            <?php foreach ($ptypes as $item) { ?>
                                                <div class="checkbox-item">
                                                    <label>
                                                        <input type="checkbox" name="product_type[]" class="checkbox_3"
                                                               value="<?= $item['code_no'] ?>"
                                                            <?= in_array($item['code_no'], $_product_type_arr) ? 'checked' : '' ?>>
                                                        <?= $item['code_name'] ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>호텔 프로모션</th>
                                    <td colspan="3">
                                        <div style="display: flex; flex-wrap: wrap; gap: 10px ">
                                            <?php
                                            $_product_promotion_arr = isset($product_promotions) ? explode("|", $product_promotions) : [];
                                            $_product_promotion_arr = array_filter($_product_promotion_arr);
                                            ?>
											<div class="checkbox-item">
												<label>
													<input type="checkbox" id="checkAll_4" >모두선택
												</label>
											</div>
											
                                            <?php foreach ($ppromotions as $item) { ?>
                                                <div class="checkbox-item">
                                                    <label>
                                                        <input type="checkbox" name="product_promotions[]" class="checkbox_4"
                                                               value="<?= $item['code_no'] ?>"
                                                            <?= in_array($item['code_no'], $_product_promotion_arr) ? 'checked' : '' ?>>
                                                        <?= $item['code_name'] ?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <script>
                                function change_manager(user_id) {
                                    $.ajax({
                                        url: "/member/mem_detail",
                                        type: "POST",
                                        data: {
                                            "user_id": user_id
                                        },
                                        dataType: "json",
                                        async: false,
                                        cache: false,
                                        success: function (data, textStatus) {
                                            $("#product_manager").val(data?.user_name || " ");
                                            $("#phone").val(data?.user_mobile || "");
                                            $("#email").val(data?.user_email || "");

                                        },
                                        error: function (request, status, error) {
                                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                        }
                                    });
                                }

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
//                                $productMoreData = json_decode($product_more, true);
//
//                                if (json_last_error() !== JSON_ERROR_NONE) {
//                                    die("Lỗi giải mã JSON: " . json_last_error_msg());
//                                }
//                                $breakfast_data = '';
//                                if ($productMoreData) {
//                                    $meet_out_time = $productMoreData['meet_out_time'];
//                                    $children_policy = $productMoreData['children_policy'];
//                                    $baby_beds = $productMoreData['baby_beds'];
//                                    $deposit_regulations = $productMoreData['deposit_regulations'];
//                                    $pets = $productMoreData['pets'];
//                                    $age_restriction = $productMoreData['age_restriction'];
//                                    $smoking_policy = $productMoreData['smoking_policy'];
//                                    $breakfast = $productMoreData['breakfast'];
//                                    $breakfast_data = $productMoreData['breakfast_data'];
//                                }
                                $productMoreData = explode('$$$$', $product_more);
                                $meet_out_time = $productMoreData[0];
                                $children_policy = $productMoreData[1];
                                $baby_beds = $productMoreData[2];
                                $deposit_regulations = $productMoreData[3];
                                $pets = $productMoreData[4];
                                $age_restriction = $productMoreData[5];
                                $smoking_policy = $productMoreData[6];
                                $breakfast = $productMoreData[7];
                                $breakfast_data = $productMoreData[8];
                            }

                            $breakfast_data_arr = explode('||||', $breakfast_data ?? "");
                            $breakfast_data_arr = array_filter($breakfast_data_arr);
                            ?>
								
							<!-- 호텔 기본정보2 끝-->	
								
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"  style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="8%"/>
                                    <col width="8%"/>
                                    <col width="*"/>
                                    <col width="*"/>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        시설 & 서비스
                                    </td>
                                </tr>

                                <tr>
                                    <th>추천 포인트</th>
                                    <th>
                                        <input type="checkbox" id="all_code_utility" class="all_input" name="_code_utility" value=""/>
                                        <label for="all_code_utility">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $stay_item['code_utilities']);
                                        foreach ($fresult6 as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_utilitie<?= $row_r['code_no'] ?>"
                                                   name="_code_utilities" class="code_utilities"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                            <label for="code_utilitie<?= $row_r['code_no'] ?>"><?= $row_r['code_name'] ?></label>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>인기 시설 및 서비스</th>
                                    <th>
                                        <input type="checkbox" id="all_code_best_utilities" class="all_input"  name="_code_best_utilities" value=""/>
                                        <label for="all_code_best_utilities">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $stay_item['code_best_utilities']);
                                        foreach ($fresult6 as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_best_utilities<?= $row_r['code_no'] ?>"
                                                   name="_code_best_utilities" class="code_best_utilities"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                            <label for="code_best_utilities<?= $row_r['code_no'] ?>">
                                                <?= $row_r['code_name'] ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>시설 & 서비스</th>
                                    <th>
                                        <input type="checkbox" id="all_code_service" class="all_input"  name="_code_service" value=""/>
                                        <label for="all_code_service">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $stay_item['code_services']);
                                        foreach ($fresult5 as $row_r) : ?>
                                            <div class="" style="margin-bottom: 20px">
                                                <span class=""
                                                      style="font-weight: 600;color: #333;font-size: 13px;"> <?= $row_r['code_name'] ?></span>
                                                <div class="" style="margin-left: 30px;margin-top: 8px;">
                                                    <?php
                                                    $fresult6 = $row_r['child'];
                                                    foreach ($fresult6 as $row_r2) :
                                                        $find2 = "";
                                                        for ($i = 0; $i < count($_arr); $i++) {
                                                            if ($_arr[$i]) {
                                                                if ($_arr[$i] == $row_r2['code_no']) $find2 = "Y";
                                                            }
                                                        }
                                                        ?>
                                                        <input type="checkbox" class="code_service"
                                                               id="code_service<?= $row_r['code_no'] ?>_<?= $row_r2['code_no'] ?>"
                                                               name="_code_services"
                                                               value="<?= $row_r2['code_no'] ?>" <?php if ($find2 == "Y") echo "checked"; ?> />
                                                        <label for="code_service<?= $row_r['code_no'] ?>_<?= $row_r2['code_no'] ?>">
                                                            <?= $row_r2['code_name'] ?>
                                                        </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
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
                                        호텔정책
                                    </td>
                                </tr>

                                <tr>
                                    <th>체크인 & 체크아웃 시간</th>
                                    <td>
                                        <textarea name="meet_out_time" id="meet_out_time"
                                                  style="width:90%;height:60px;"><?= $meet_out_time ?? "" ?></textarea>
                                    </td>
                                    <th>어린이 정책</th>
                                    <td>
                                        <textarea name="children_policy" id="children_policy"
                                                  style="width:90%;height:60px;"><?= $children_policy ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>엑스트라 베드 및<br> 유아용 침대 </th>
                                    <td>
                                        <textarea name="baby_beds" id="baby_beds"
                                                  style="width:90%;height:60px;"><?= $baby_beds ?? "" ?></textarea>
                                    </td>
                                    <th>조식</th>
                                    <td>
                                        <textarea name="breakfast" id="breakfast"
                                                  style="width:90%;height:60px;"><?= $breakfast ?? "" ?></textarea>
                                        <div class="" style="margin-top: 10px">
                                            <button type="button" class="btnAddBreakfast">추가</button>
                                        </div>
                                        <table style="width:90%">
                                            <tbody id="tBodyTblBreakfast">
                                            <?php foreach ($breakfast_data_arr as $dataBreakfast) { ?>
                                                <?php
                                                $dataBreakfastArr = explode('::::', $dataBreakfast);
                                                ?>
                                                <tr>
                                                    <th style="width: 30%">
                                                        <input type="text" name="breakfast_item_name_[]" value="<?= $dataBreakfastArr[0] ?? "" ?>">
                                                    </th>
                                                    <td style="width: 60%">
                                                        <input type="text" name="breakfast_item_value_[]" value="<?= $dataBreakfastArr[1] ?? "" ?>">
                                                    </td>
                                                    <td style="width: 10%">
                                                        <button type="button" class="btnDeleteBreakfast" onclick="removeBreakfast(this);">삭제
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
                                        <textarea name="deposit_regulations" id="deposit_regulations" style="width:90%;height:60px;"><?= $deposit_regulations ?? "" ?></textarea>
                                    </td>
                                    <th>반려동물</th>
                                    <td>
                                        <textarea name="pets" id="pets" style="width:90%;height:60px;"><?= $pets ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>연령 제한</th>
                                    <td>
                                        <textarea name="age_restriction" id="age_restriction" style="width:90%;height:60px;"><?= $age_restriction ?? "" ?></textarea>
                                    </td>
                                    <th>흡연 정책</th>
                                    <td>
                                        <textarea name="smoking_policy" id="smoking_policy" style="width:90%;height:60px;"><?= $smoking_policy ?? "" ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>호텔소개</th>
                                    <td colspan="3">
                                        <textarea name="product_notes" id="product_notes"  rows="10" cols="100"   class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($product_notes) ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors3 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors3,
                                                elPlaceHolder: "product_notes",
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
                                <tr>
                                    <th>객실 안내</th>
                                    <td colspan="3">
                                        <textarea name="room_guides" id="room_guides"  rows="10" cols="100"   class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($room_guides) ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors5 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors5,
                                                elPlaceHolder: "room_guides",
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
                                <!-- <tr>
                                    <th>중요 사항</th>
                                    <td colspan="3">
                                        <textarea name="important_notes" id="important_notes"  rows="10" cols="100"   class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($important_notes) ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors6 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors6,
                                                elPlaceHolder: "important_notes",
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
                                </tr> -->
								<tr>
                                    <th>중요사항</th>
                                    <td colspan="3">

                                        <textarea name="product_important_notice" id="product_important_notice" rows="10" cols="100"  class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($product_important_notice) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "product_important_notice",
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
                                   style="margin-top:50px; display: none">
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
                                    <th>유의사항(mobile)</th>
                                    <td>

                                        <textarea name="product_important_notice_m" id="product_important_notice_m"  rows="10" cols="100"   class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($product_important_notice_m) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors2 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors2,
                                                elPlaceHolder: "product_important_notice_m",
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
                                    <th>중요안내(mobile)</th>
                                    <td>

                                        <textarea name="product_notes_m" id="product_notes_m" rows="10" cols="100"  class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($product_notes_m) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors4 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors4,
                                                elPlaceHolder: "product_notes_m",
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
							
							<!-- 추천명소 -->
							<div class="flex justify-between" style="margin-top:50px;">
                                <p>
                                    호텔주변 추천명소
                                </p>
                                <button class="btn_add" type="button" onclick="showOrHidePlace()">새로 추가</button>
                            </div>
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption></caption>
                                <colgroup>
                                    <col width="70px"/>
                                    <col width="*"/>
                                    <col width="150px"/>
                                    <col width="150px"/>
                                    <col width="120px"/>
                                    <col width="120px"/>
                                    <col width="200px"/>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>명소</th>
                                    <th>이미지</th>
                                    <th>장소유형</th>
                                    <th>거리</th>
                                    <th>우선순위</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody id="tbodyData">

                                </tbody>
                            </table>
                            <!-- End product stay-->

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
							<!-- 추천명소 -->

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
                                                $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                                // $img ="/data/product/" . ${"ufile" . $i};
                                                ?>
                                                <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                           onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
													
													<?php if(${"ufile" . $i}) { ?>		
                                                    <a class="img_txt imgpop" href="<?= $img ?>"
                                                       id="text_ufile<?= $i ?>">미리보기</a>
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
                                        서브이미지(1000X600)
                                        <button type="button" class="btn_01" onclick="add_sub_image();">추가</button>
                                    </th>
                                    <td colspan="3">
                                            <div class="img_add img_add_group">
                                                <?php
                                                // for ($i = 2; $i <= 6; $i++) :
                                                //     $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                                //     // $img ="/data/product/" . ${"ufile" . $i};
                                                    ?>
                                                    <!-- <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                        <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                               onchange="productImagePreview(this, '<?= $i ?>')">
                                                        <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                        <input type="hidden" name="checkImg_<?= $i ?>">
                                                        <button type="button" class="remove_btn"
                                                                onclick="productImagePreviewRemove(this)"></button>
                                                                
                                                        <a class="img_txt imgpop" href="<?= $img ?>" style="visibility: <?= !empty(${"ufile" . $i}) ? "visible" : "hidden" ?>;"
                                                           id="text_ufile<?= $i ?>">미리보기</a>
                                                    </div> -->
                                                <?php
                                                // endfor;
                                                ?>
                                                <?php
                                                    $i = 2;
                                                    foreach ($img_list as $img) :
                                                        $s_img = get_img($img["ufile"], "/data/product/", "600", "440");
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

                    <div id="popup_hotel" class="popup pick_item_pop02">
                        <div>
                            <div class="search_box">
                                <form name="pick_item_search" id="pick_item_search" onsubmit="return false">
                                    <input type="text" id="search_txt" onkeyup="press_it()" name="search_txt" value=""
                                           class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px">
                                    <a href="javascript:search_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                                </form>
                            </div>
                            <div class="table_box" style="height: calc(100% - 72px);">
                                <form method="post" name="select_pick_frm" id="select_pick_frm">
                                    <input type="hidden" name="isrt_code" id="isrt_code" value="">
                                    <table>
                                        <caption>상품찾기</caption>
                                        <colgroup>
                                            <col style="width: 30%;">
                                            <col style="width: 50%">
                                            <col style="width: 20%;">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>선택</th>
                                            <th>주소</th>
                                            <th>전택</th>
                                        </tr>
                                        </thead>
                                        <tbody id="id_content">
                                        <?php
                                        foreach ($fresult3 as $frow) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $frow["code_no"] ?></td>
                                                <td class="text-center"><?= $frow["stay_name_eng"] ?></td>
                                                <td class="text-center"><p
                                                            onclick="fn_chgRoom('<?= $frow["code_no"] ?>')">[선택]</p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </form>
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
                                    <a href="javascript:send_it()" class="btn btn-default"><span  class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <!--a href="javascript:del_it(`<?= route_to("admin._hotel.del") ?>`, `<?= $product_idx ?>`)"
                                       class="btn btn-default"><span class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a-->
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

    <div class="popup_" id="popupItem_">
        <div class="popup_area_ popup_area_xl_">
            <div class="popup_top_">
                <p>
                    룸목록 관리
                </p>
                <p>
                    <button type="button" class="btn_close_"
                            onclick="showOrHide();">X
                    </button>
                </p>
            </div>
            <div class="popup_content_">
                <form name="formRoom" id="formRoom" action="#" method=post enctype="multipart/form-data"
                      target="hiddenFrame">
                    <input type="hidden" name="g_idx" id="g_idx" value=""/>
                    <input type=hidden name="room_facil" id="room_facil" value="">
                    <input type=hidden name="room_category" id="room_category" value="">
                    <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>

                    <div class="listBottom" style="margin-bottom: 20px">
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
                                <th>룸 이름</th>
                                <td colspan="3">
                                    <input type="text" name="roomName" value="<?= $roomName ?? '' ?>" class="text" style="width:300px" maxlength="50" id="roomName"/>
                                </td>
                            </tr>
                            <tr>
                                <th>객실시설</th>
                                <td colspan="3">
                                    <?php
                                    $_arr = explode("|", $room_facil);
                                    foreach ($fresult10 as $row_r) :
                                        $find = "";
                                        for ($i = 0; $i < count($_arr); $i++) {
                                            if ($_arr[$i]) {
                                                if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                            }
                                        }
                                        ?>
                                        <input type="checkbox" id="room_facil_<?= $row_r['code_no'] ?>"
                                               name="_room_facil"
                                               value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                        <label for="room_facil_<?= $row_r['code_no'] ?>"><?= $row_r['code_name'] ?></label>
                                    <?php endforeach; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>장면</th>
                                <td colspan="3">
                                    <input type="text" name="scenery" value="<?= $scenery ?? '' ?>" class="text"  id="scenery" style="width:300px" maxlength="50"/>
                                </td>
                            </tr>

                            <tr>
                                <th>범주</th>
                                <td colspan="3">
                                    <?php
                                    $_arr = explode("|", $category);
                                    foreach ($fresult11 as $row_r) :
                                        $find = "";
                                        for ($i = 0; $i < count($_arr); $i++) {
                                            if ($_arr[$i]) {
                                                if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                            }
                                        }
                                        ?>
                                        <input type="checkbox" id="room_category_<?= $row_r['code_no'] ?>"
                                               name="_room_category"
                                               value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                        <label for="room_category_<?= $row_r['code_no'] ?>"><?= $row_r['code_name'] ?></label>
                                    <?php endforeach; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>식사</th>
                                <td colspan="3">
                                    <input type="checkbox" id="rbreakfast" name="breakfast" value="Y" <?php if ($breakfast == "Y") echo "checked"; ?> />
                                    <label for="rbreakfast">조식 </label>

                                    <input type="checkbox" id="lunch" name="lunch" value="Y" <?php if ($lunch == "Y") echo "checked"; ?> />
                                    <label for="lunch">중식</label>

                                    <input type="checkbox" id="dinner" name="dinner" value="Y" <?php if ($dinner == "Y") echo "checked"; ?> />
                                    <label for="dinner">석식</label>
                                </td>
                            </tr>

                            <tr>
                                <th>총인원</th>
                                <td colspan="3">
                                    <input type="text" name="max_num_people" value="<?= $max_num_people ?? 1 ?>" id="max_num_people" class="number" min="1" style="width:100px"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"  style="margin-top:50px;">
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
                                <th>서브이미지(600X400)</th>
                                <td colspan="3">
                                    <div class="img_add">
                                        <?php
                                        for ($i = 1; $i <= 3; $i++) :
                                            // $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                            $img = "/uploads/rooms/" . ${"ufile" . $i};
                                            ?>
                                            <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                <input type="file" name='room_ufile<?= $i ?>' id="room_ufile<?= $i ?>"
                                                       onchange="productImagePreview2(this, '<?= $i ?>')">
                                                <label for="room_ufile<?= $i ?>" <?= !empty(${"room_ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                <input type="hidden" name="checkImg_<?= $i ?>" class="checkImg">
                                                <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                <a class="img_txt imgpop_p" href="<?= $img ?>" id="text_room_ufile<?= $i ?>">미리보기</a>
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
                    <!-- // listBottom -->

                    <!-- // listWrap -->
                </form>
            </div>
            <div class="popup_bottom_">
                <button type="button" class="" onclick="showOrHide();">취소</button>
                <button type="button" class="" onclick="saveValueRoom(event);">확인</button>
            </div>
        </div>
    </div>

    <script>
        $(".imgpop_p").each(function () {
            if ($(this).attr("href") && $(this).attr("href").match(/\.(jpg|jpeg|png|gif|bmp)$/i)) {
                $(this).colorbox({
                    rel: 'imgpop_p',
                    maxWidth: '90%',
                    maxHeight: '90%'
                });
            }
        });
    </script>

    <div class="popup_" id="popupPlace_">
        <div class="popup_area_ popup_area_xl_">
            <div class="popup_top_">
                <p>
                    호텔주변 추천명소 코드 리스트
                </p>
                <p>
                    <button type="button" class="btn_close_" style="background: none"
                            onclick="showOrHidePlace();">X
                    </button>
                </p>
            </div>
            <div class="popup_content_">
                <form name="formPlace" id="formPlace" action="#" method=post enctype="multipart/form-data"
                      target="hiddenFrame">
                    <input type=hidden name="idx" id="product_place_idx" value="">
                    <input type=hidden name="product_idx" value="<?= $stay_idx ?>">

                    <div class="listBottom" style="margin-bottom: 20px">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                            <tr>
                                <th>명소</th>
                                <td>
                                    <input type="text" id="product_place_name" name="name" value="" placeholder="명소이름 입력" class="input_txt"/>
                                </td>
                            </tr>
                            <tr>
                                <th>거리</th>
                                <td>
                                    <input type="text" id="product_place_distance" name="distance" value="" placeholder="공항으로부터의 거리를 작성해주세요(ex:3Km)" class="input_txt"/>
                                </td>
                            </tr>
                            <tr>
                                <th>유형</th>
                                <td>
                                    <input type="text" id="product_place_type" name="type" value="" placeholder="유원지,병원등" class="input_txt"/>
                                </td>
                            </tr>
                            <tr>
                                <th>링크</th>
                                <td>
                                    <input type="text" id="product_url" name="url" value=""
                                           class="input_txt"/>
                                </td>
                            </tr>
                            <tr>
                                <th>이미지</th>
                                <td>
                                    <input type="file" id="product_place_ufile1" name="ufile1" class="input_txt"
                                           style="width:20%"/>
                                    <div class="place_image_" id="place_image_">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>우선순위</th>
                                <td>
                                    <input type="text" id="product_place_onum" name="onum" value=""
                                           class="input_txt"
                                           style="width:100px"/> (숫자가 높을수록 상위에 노출됩니다.)
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- // listBottom -->

                    <!-- // listWrap -->
                </form>
            </div>
            <div class="popup_bottom_">
                <button type="button" class="" onclick="showOrHidePlace();">취소</button>
                <button type="button" class="" onclick="writePlace();">확인</button>
            </div>
        </div>
    </div>

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

    <!-- Edit product-->
<?php if (isset($product_idx) && $product_idx != ""): ?>
    <?php echo view("/admin/_hotel/inc/editmap/js_edit.php", ['stay_idx' => $stay_idx, 'product_idx' => $product_idx,]); ?>
    <script>
        async function loadPage() {
            await get_code('<?= $product_code_1 ?>', 3, '<?= $product_code_2 ?>');
            await get_code('<?= $product_code_2 ?>', 4, '<?= $product_code_3 ?>');
        }

        loadPage();

    </script>
    <!-- Create product-->
<?php else: ?>
    <?php echo view("/admin/_hotel/inc/createmap/js_create.php"); ?>
<?php endif; ?>
<?php echo view("/admin/_hotel/inc/map/js_map.php", ['fresult10' => $fresult10, 'fresult11' => $fresult11]); ?>
<!-- Script perview image -->

<script>
	$(document).ready(function () {
		// 전체 선택 체크박스 클릭 이벤트
		$("#checkAll_1").on("click", function () {
			$(".checkbox_1").prop("checked", $(this).prop("checked"));
		});

		// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
		$(".checkbox_1").on("click", function () {
			$("#checkAll_1").prop("checked", $(".checkbox_1:checked").length === $(".checkbox_1").length);
		});
	});
	$(document).ready(function () {
		// 전체 선택 체크박스 클릭 이벤트
		$("#checkAll_2").on("click", function () {
			$(".checkbox_2").prop("checked", $(this).prop("checked"));
		});

		// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
		$(".checkbox_2").on("click", function () {
			$("#checkAll_2").prop("checked", $(".checkbox_2:checked").length === $(".checkbox_2").length);
		});
	});
	$(document).ready(function () {
		// 전체 선택 체크박스 클릭 이벤트
		$("#checkAll_3").on("click", function () {
			$(".checkbox_3").prop("checked", $(this).prop("checked"));
		});

		// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
		$(".checkbox_3").on("click", function () {
			$("#checkAll_3").prop("checked", $(".checkbox_3:checked").length === $(".checkbox_3").length);
		});
	});
	$(document).ready(function () {
		// 전체 선택 체크박스 클릭 이벤트
		$("#checkAll_4").on("click", function () {
			$(".checkbox_4").prop("checked", $(this).prop("checked"));
		});

		// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
		$(".checkbox_4").on("click", function () {
			$("#checkAll_4").prop("checked", $(".checkbox_4:checked").length === $(".checkbox_4").length);
		});
	});
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

    // function productImagePreview(inputFile, onum) {
    //     if (!sizeAndExtCheck(inputFile)) {
    //         $(inputFile).val("");
    //         return false;
    //     }

    //     let imageTag = $('label[for="ufile' + onum + '"]');

    //     let lastElement = $(inputFile).closest('.file_input_wrap');

    //     if (inputFile.files.length > 0) {
    //         $(inputFile).closest('.file_input').addClass('applied');
    //         $(inputFile).closest('.file_input').find('.checkImg').val('Y');

    //         Array.from(inputFile.files).forEach((file, index) => {
    //             let imageReader = new FileReader();

    //             let i = Date.now();

    //             imageReader.onload = function () {
    //                 let imagePreview = `
    //                                 <div class="file_input_wrap">
    //                                     <div class="file_input applied">
    //                                         <input type="hidden" name="i_idx[]" value="">
    //                                         <input type="file" name='ufile[]' id="ufile${i}_${index}" multiple onchange="productImagePreview(this, '${i}_${index}')">
    //                                         <label for="ufile${i}_${index}" style='background-image:url(${imageReader.result})'></label>
    //                                         <input type="hidden" name="checkImg_${i}_${index}" class="checkImg">
    //                                         <button type="button" class="remove_btn"  onclick="productImagePreviewRemove(this)"></button>
    //                                     </div>
    //                                 </div>`;
    //                 lastElement.after(imagePreview);
    //                 lastElement = lastElement.next();
    //             };

    //             imageReader.readAsDataURL(file);
    //         });            

    //         // let imageReader = new FileReader();

    //         // imageReader.onload = function () {
    //         //     imageTag.css("background-image", "url(" + imageReader.result + ")");
    //         //     $(inputFile).closest('.file_input').addClass('applied');
    //         //     $(inputFile).closest('.file_input').find('.checkImg').val('Y');
    //         // };
            
    //         // imageReader.readAsDataURL(inputFile.files[0]);
    //     }
    // }

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
                                    <input type="file" id="ufile${i}_${index}" multiple 
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

    function productImagePreview2(inputFile, onum) {
        if (!sizeAndExtCheck(inputFile)) {
            $(inputFile).val("");
            return false;
        }

        let imageTag = $('label[for="room_ufile' + onum + '"]');

        if (inputFile.files.length > 0) {
            let imageReader = new FileReader();

            imageReader.onload = function () {
                imageTag.css("background-image", "url(" + imageReader.result + ")");
                $(inputFile).closest('.file_input').addClass('applied');
                $(inputFile).closest('.file_input').find('.checkImg').val('Y');
            }
            return imageReader.readAsDataURL(inputFile.files[0]);
        }
    }

    function productImagePreviewRemove(element) {
        let parent = $(element).closest('.file_input_wrap');
        let inputFile = parent.find('input[type="file"]')[0];
        let labelImg = parent.find('label');
        let i_idx = parent.find('input[name="i_idx[]"]').val();

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
                        parent.remove();
                    }
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
                }
            });
        } else if (inputFile.files.length > 1) {
            let dt = new DataTransfer(); // Tạo đối tượng chứa file mới
            let fileArray = Array.from(inputFile.files);
            let indexToRemove = $(element).closest('.file_input_wrap').index(); // Lấy vị trí ảnh bị xóa

            fileArray.forEach((file, index) => {
                if (index !== indexToRemove) {
                    dt.items.add(file); // Giữ lại file không bị xóa
                }
            });

            inputFile.files = dt.files; // Gán lại danh sách file đã lọc
        } else {
            parent.remove();
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
<!-- Script get longitude + latitude from address -->
<script>

    function closePopupLocation() {
        $("#popup_location").hide();
    }

    function getCoordinates() {

        let address = $("#stay_address").val();
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
                $("#popup_location #list_location li").click(function () {
                    let latitude = $(this).data("lat");
                    let longitude = $(this).data("lon");
                    $("#latitude").val(latitude);
                    $("#longitude").val(longitude);
                    $("#stay_address").val($(this).text().trim());
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