<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
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
<?php $back_url = "write"; ?>
    <script type="text/javascript">
        function checkForNumber(str) {
            let key = event.keyCode;
            let frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }
    </script>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2>스파/쇼·입장권/레스토랑 상품정보입력 <?= $titleStr ?> </h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="list_spas?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                                   class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                            class="txt">리스트</span></a></li>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:prod_copy('<?= $product_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">제품복사</span></a>
                                </li>
                                <li><a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                </li>
                                <!--li><a href="javascript:del_it('<?= $product_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span
                                                class="txt">완전삭제</span></a></li-->
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

            <form name=frm action="<?= route_to('admin.api.spa_.write_ok') ?>" method=post enctype="multipart/form-data"
                  target="hiddenFrame">
                <input type=hidden name="search_category" value='<?= $search_category ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>
                <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
                <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
                <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>
                <input type=hidden name="product_option" id="product_option" value=''>
                <input type=hidden name="direct" id="direct" value='<?= $direct_payment ?>'>
 
                <input type="hidden" name="code_utilities" id="code_utilities"
                       value='<?= $code_utilities ?? "" ?>'/>
                <input type="hidden" name="code_services" id="code_services"
                       value='<?= $code_services ?? "" ?>'/>
                <input type="hidden" name="code_best_utilities" id="code_best_utilities"
                       value='<?= $code_best_utilities ?? "" ?>'/>
                <input type="hidden" name="code_populars" id="code_populars"
                       value='<?= $code_populars ?? "" ?>'/>

                <input type="hidden" name="mbti" id="mbti"
                       value='<?= $mbti ?? "" ?>'/>

                <input type="hidden" name="available_period" id="available_period"
                       value='<?= $available_period ?? "" ?>'/>
                <input type="hidden" name="deadline_time" id="deadline_time"
                       value='<?= $deadline_time ?? "" ?>'/>
                <input type="hidden" id="check_img_ufile1" value="<?=$ufile1?>">
                
                <!-- <input type="hidden" name="chk_product_code" id="chk_product_code"
                       value='<?= $product_idx ? "Y" : "N" ?>'> -->
                <div id="contents">
                    <div class="listWrap_noline">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
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
                                            <p>기본정보</p>
                                            <?php if ($product_idx): ?>
                                                <?php
                                                $url = '';
                                                switch ($product_code_1) {
                                                    case '1320':
                                                        $url = '/product-restaurant/restaurant-detail/';
                                                        break;
                                                    case '1317':
                                                        $url = '/ticket/ticket-detail/';
                                                        break;
                                                    default:
                                                        $url = '/product-spa/spa-details/';
                                                        break;
                                                }

                                                ?>
                                                <a class="btn btn-default"
                                                   href="<?= $url . $product_idx ?>"
                                                   target="_blank">
                                                    상품 상세보기
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>상품분류</th>
                                    <td colspan="3">
                                        <select id="product_code_1" name="product_code_1" class="input_select"
                                                onchange="javascript:get_code(this.value, 3)">
                                            <option value="">1차분류<?=$product_code_1?></option>
                                            <?php
                                            foreach ($fresult as $frow):
                                                $status_txt = "";
                                                if ($frow["code_no"] == $product_code_1) {
                                                    $status_txt = "";
                                                } elseif ($frow["code_no"] == $product_code_1) {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["code_no"] == $product_code_1) {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $row['product_code_1']) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                            <?php endforeach; ?>

                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select"
                                                onchange="javascript:get_code(this.value, 4)">
                                            <option value="">2차분류</option>
                                            <?php
                                            foreach ($fresult2 as $frow):
                                                if(substr($frow["code_no"],0,4) == $row['product_code_1']) 
												{
													$status_txt = "";
													if ($frow["code_no"] == $product_code_3) {
														$status_txt = "";
													} elseif ($frow["code_no"] == $product_code_3) {
														$status_txt = "[삭제]";
													} elseif ($frow["code_no"] == $product_code_3) {
														$status_txt = "[마감]";
													}
											?>		
                                                   <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $row['product_code_2']) echo "selected";?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>
                                            <?php } ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <select id="product_code_3" name="product_code_3" class="input_select">
                                            <option value="">3차분류</option>
                                            <?php
                                            foreach ($fresult3 as $frow):
                                                $status_txt = "";
                                                if ($frow["code_no"] == $product_code_3) {
                                                    $status_txt = "";
                                                } elseif ($frow["code_no"] == $product_code_3) {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["code_no"] == $product_code_3) {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_3) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <!-- <th rowspan="3">썸네일<br>(600 * 450)</th>
                                    <td rowspan="3">
                                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                   style="width:500px;margin-bottom:10px"/>
                                            <?php if (${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                 name="del_<?= $i ?>"
                                                                                                 value='Y'><a
                                                    href="/data/product/<?= ${"ufile" . $i} ?>"
                                                    class="imgpop"><?= ${"rfile" . $i} ?></a><br><br><?php } ?>
                                        <?php } ?>
                                    </td> -->
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" id="product_name" name="product_name"
                                               value="<?= $product_name ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>

                                    <th>상품명(영문)</th>
                                    <td>
                                        <input type="text" id="product_name_en" name="product_name_en"
                                               value="<?= $product_name_en ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt"
                                               style="width:80px"/> <span
                                                style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                    <th>골프장 담당자</th>
                                    <td>
                                        이름: <input type="text" id="stay_user_name" name="stay_user_name"  value="<?= $stay_item['stay_user_name'] ?>" class="input_txt" placeholder="" style="width:150px"/>
										&ensp;이메일: <input id="phone" name="phone" class="input_txt" type="text" value="<?= $phone ?? '' ?>"   style="width:150px"/>
                                        &ensp;연락처: <input id="email" name="email" class="input_txt"  type="text" value="<?= $email ?? '' ?>"   style="width:150px"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품코드</th>
                                    <td colspan="">
                                        <input type="text" name="product_code" id="product_code"
                                               value="<?= $product_code_no ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if (empty($product_idx) || empty($product_code)) { ?>
                                            <!-- <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button> -->
                                            <!-- <button type="button" class="btn_01" onclick="check_product_code('<?= $product_code_no ?>');">조회</button> -->
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>
                                    </td>
                                    <th>단품 메인노출</th>
                                    <td>
                                        <input type="checkbox" name="product_type" id="product_type_01"
                                               value="MD 추천" <?php if (isset($row["product_type"]) && $row["product_type"] == "MD 추천") {
                                            echo "checked";
                                        } ?> />
                                        <label for="product_type_01">MD 추천</label>

                                        <input type="checkbox" name="product_type" id="product_type_02"
                                               value="핫딜 추천" <?php if (isset($row["product_type"]) && $row["product_type"] == "핫딜 추천") {
                                            echo "checked";
                                        } ?> />
                                        <label for="product_type_02">핫딜 추천</label>

                                        <input type="checkbox" name="product_type" id="product_type_03"
                                               value="가성비 추천" <?php if (isset($row["product_type"]) && $row["product_type"] == "가성비 추천") {
                                            echo "checked";
                                        } ?> />
                                        <label for="product_type_03">가성비 추천</label>
                                    </td>
                                </tr>

                                <tr>
                                    <th>간단소개</th>
                                    <td>
                                        <input type="text" id="product_info" name="product_info"
                                               value="<?= $product_info ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                    <th>판매상태결정</th>
                                    <td>
                                        <select name="product_status" id="product_status">
                                            <option value="sale" <?php if (isset($product_status) && $product_status == "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="plan" <?php if (isset($product_status) && $product_status == "plan") {
                                                echo "selected";
                                            } ?>>예약중지
                                            </option>
                                            <option value="stop" <?php if (isset($product_status) && $product_status == "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품담당자</th>
                                    <td>
                                        <input id="product_manager" name="product_manager" class="input_txt" type="text"
                                               value="<?= $product_manager ?>" style="width:100px" readonly/>
                                        /<input id="phone" name="phone" class="input_txt" type="text"
                                                value="<?= $phone ?>" readonly
                                                style="width:200px"/>
                                        /<input id="email" name="email" class="input_txt"
                                                type="text" value="<?= $email ?>" readonly
                                                style="width:200px"/>
                                        <select name="product_manager_id" id="product_manager_sel"
                                                onchange="change_manager(this.value)">
                                            <?php
                                            foreach ($member_list as $row_member) :
                                                ?>
                                                <option value="<?= $row_member["user_id"] ?>" <?php if ($product_manager_id == $row_member["user_id"]) {
                                                    echo "selected";
                                                } ?>><?= $row_member["user_name"] ?></option>
                                            <?php endforeach; ?>
                                            <option value="서소연 대리" <?php if ($product_manager == "서소연 대리") {
                                                echo "selected";
                                            } ?> >
                                                장은진
                                            </option>
                                        </select>
                                        <br><span style="color: gray;">* ex) 상품등록하는 담당자의 성함/연락처/이메일</span>
                                    </td>
                                    <th>검색키워드</th>
                                    <td>
                                        <input id="keyword" name="keyword" class="input_txt" type="text"
                                               value="<?= $keyword ?>"
                                               style="width:90%"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)유럽,해외연수,하노니여행</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>기존상품가(단위: 바트)</th>
                                    <td>
                                        <input id="original_price" name="original_price" class="input_txt price"
                                               type="text"
                                               value="<?= $original_price ?>" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품의 할인 전 금액</span>
                                    </td>
                                    <th>상품최저가(단위: 바트)</th>
                                    <td>
                                        <input id="product_price" name="product_price" value="<?= $product_price ?>"
                                               class="input_txt price" type="text" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품페이지에 보여질 상품가격(할인가)</span>
                                    </td>
                                </tr>

                                <script>
                                    function select_add_it() {
                                        popOpen('1024', '600', '../_tourStay/popup.php?strs=' + $("#stay_list").val(), 'stay');
                                    }

                                    function sight_add_it() {
                                        popOpen('1024', '600', '../_tourSights/popup.php?strs=' + $("#sight_list").val(), 'sight');
                                    }

                                    function country_add_it() {
                                        popOpen('1024', '600', '../_tourCountry/popup.php?strs=' + $("#sight_list").val(), 'country');
                                    }

                                    function active_add_it() {
                                        popOpen('1024', '600', '../_tourGuide/popup.php?strs=' + $("#sight_list").val(), 'country');
                                    }
                                </script>

                                <tr>
                                    <th>
                                        MBTI
                                        <input type="checkbox" id="all_code_mbti" class="all_input"
                                               name="_code_mbti" value=""/>
                                        <label for="all_code_mbti">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="3">
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
                                    <th>직접결제</th>
                                    <td colspan="3">
										<input type="checkbox" id="direct_payment" value="Y" <?php if (isset($direct_payment) && $direct_payment === "Y")
                                                echo "checked=checked"; ?>> 
                                    </td>								
								</tr>
                                <tr>
                                    <th>예약시간</th>
                                    <td colspan="3">
                                        <input id="time_line" name="time_line" class="input_txt" type="text"
                                               value="<?= $time_line ?>" style="width:100%"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)07:50 ~ 13:30, 13:30 ~ 18:30</span>
                                    </td>								
								</tr>
                                </tbody>
                            </table>

                            <script>
                                $('input[name="product_type"]').change(function () {
                                    let list_ = $('input[name="product_type"]');
                                    let el = $(this);

                                    list_.each(function () {
                                        let el2 = $(this);
                                        if (el2.val() === el.val() && el2.is(':checked')) {
                                            list_.not(this).prop('checked', false);
                                        }
                                    });
                                });

                                $('#all_code_mbti').change(function () {
                                    if ($('#all_code_mbti').is(':checked')) {
                                        $('.code_mbti').prop('checked', true)
                                    } else {
                                        $('.code_mbti').prop('checked', false)
                                    }
                                });
                            </script>
                            <style>
                                .btn_al_plus_ {
                                    width: 50px !important;
                                }
                            </style>
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
                                        상세정보
                                    </td>
                                </tr>

                                <style>
                                    .al {
                                        display: flex;
                                        align-items: center;
                                        justify-content: start;
                                        margin: 30px 0;
                                        gap: 20px;
                                    }

                                    .al input {
                                        width: 15%
                                    }
                                </style>

                                <?php

                                $arr_available_period = explode('||', $available_period);
                                $arr_deadline_time = explode('||||', $deadline_time)

                                ?>

                                <tr>
                                    <th>사용 가능 기간</th>
                                    <td colspan="3">
                                        <div class="al">
                                            <input type="text" class="input_txt _available_period_ datepicker"
                                                   name="available_period_start" value="<?= $arr_available_period[0] ?>"
                                                   id="available_period_start">
                                            <span> ~ </span>
                                            <input type="text" class="input_txt _available_period_ datepicker"
                                                   name="available_period_end" value="<?= $arr_available_period[1] ?>"
                                                   id="available_period_end">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>마감 시간</th>
                                    <td colspan="3">
                                        <?php foreach ($arr_deadline_time as $itemTime) { ?>
                                            <?php if ($itemTime && $itemTime != '') { ?>
                                                <?php
                                                $arr_itemTime = explode('||', $itemTime);
                                                $deadline_date = implode("~", $arr_itemTime);
                                                ?>
                                                <input type="text" name="deadline_date[]"
                                                       data-start_date="<?= $arr_itemTime[0] ?>"
                                                       data-end_date="<?= $arr_itemTime[1] ?>" class="deadline_date"
                                                       value="<?= $deadline_date ?>" style="width: 200px;" readonly>
                                            <?php } ?>
                                        <?php } ?>

                                        <button class="btn btn-primary" type="button" id="btn_add_date_range"
                                                style="width: auto;height: auto">+
                                        </button>
                                        <!-- <p>"|" 로 일자를 구분해 주세요  </p> -->
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <script>
                                $('.deadline_date').each(function () {
                                    $(this).daterangepicker({
                                        locale: {
                                            "format": "YYYY-MM-DD",
                                            "separator": " ~ ",
                                            cancelLabel: 'Delete',
                                        },
                                        "startDate": $(this).data("start_date"),
                                        "endDate": $(this).data("end_date"),
                                        "cancelClass": "btn-danger",
                                        "minDate": $("#datetest1").val(),
                                        "maxDate": $("#datetest3").val(),
                                    });
                                })
                                $('.deadline_date').on('cancel.daterangepicker', function () {
                                    $(this).remove();
                                });
                                $("#btn_add_date_range").click(function () {
                                    console.log($(this));
                                    const new_date_range = $(`<input type="text" class="deadline_date" name="deadline_date[]" style="width: 200px;" readonly >`);
                                    $(this).before(new_date_range);
                                    console.log(new_date_range);
                                    new_date_range.daterangepicker({
                                        locale: {
                                            "format": "YYYY-MM-DD",
                                            "separator": " ~ ",
                                            cancelLabel: 'Delete',
                                        },
                                        "cancelClass": "btn-danger",
                                        "minDate": $("#datetest1").val(),
                                        "maxDate": $("#datetest3").val(),
                                    })
                                    new_date_range.on('cancel.daterangepicker', function () {
                                        $(this).remove();
                                    });
                                })
                            </script>

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
                                    <th>대표이미지(600X400)</th>
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
                                        서브이미지(600X400)
                                        <button type="button" class="btn_01" onclick="add_sub_image();">추가</button>
                                    </th>
                                    <td colspan="3">
                                        <div class="img_add img_add_group">
                                            <?php
                                            // for ($i = 2; $i <= 6; $i++) :
                                            //     $img = get_img(${"ufile" . $i}, "/data/product/", "600", "440");
                                                // $img ="/data/product/" . ${"ufile" . $i};
                                                ?>
                                                <!-- <div class="file_input <?= empty(${"ufile" . $i}) ? "" : "applied" ?>">
                                                    <input type="file" name='ufile<?= $i ?>' id="ufile<?= $i ?>"
                                                           onchange="productImagePreview(this, '<?= $i ?>')">
                                                    <label for="ufile<?= $i ?>" <?= !empty(${"ufile" . $i}) ? "style='background-image:url($img)'" : "" ?>></label>
                                                    <input type="hidden" name="checkImg_<?= $i ?>">
                                                    <button type="button" class="remove_btn"
                                                            onclick="productImagePreviewRemove(this)"></button>
                                                    <a class="img_txt imgpop" href="<?= $img ?>"
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
                                        상세정보
                                    </td>
                                </tr>

                                <tr>
                                    <th>소개&시설</th>
                                    <td colspan="3">
                                        <textarea name="product_contents" id="product_contents" rows="10" cols="100"
                                                  class="input_txt"
                                                  style="width:100%; height:400px; display:none;"><?= viewSQ($product_contents) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors14 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors14,
                                                elPlaceHolder: "product_contents",
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
                                    <th>소개&시설 모바일</th>
                                    <td colspan="3">
                                        <textarea name="product_contents_m" id="product_contents_m" rows="10" cols="100"
                                                  class="input_txt"
                                                  style="width:100%; height:400px; display:none;"><?= viewSQ($product_contents_m) ?>
                                        </textarea>
                                        <script type="text/javascript">
                                            var oEditors15 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors15,
                                                elPlaceHolder: "product_contents_m",
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
                                    <th>유의사항</th>
                                    <td colspan="3">

								    <textarea name="note_news" id="note_news" rows="10" cols="100" class="input_txt"
                                              style="width:100%; height:400px; display:none;"><?= viewSQ($note_news) ?></textarea>
                                        <script type="text/javascript">
                                            var oEditors16 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors16,
                                                elPlaceHolder: "note_news",
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
                                    <th>위치안내</th>
                                    <td colspan="3">
                                        <input type="text" autocomplete="off" name="addrs" id="addrs"
                                               value="<?= $addrs ?>" class="text" style="width:70%"/>
                                        <button type="button" class="btn btn-primary" style="width: unset;"
                                                onclick="getCoordinates();">위치선택
                                        </button>
                                        <div style="margin-top: 10px;">
                                            Latitude : <input type="text" name="latitude" id="latitude"
                                                              value="<?= $latitude ?>" class="text"
                                                              style="width: 200px;" readonly/>
                                            Longitude : <input type="text" name="longitude" id="longitude"
                                                               value="<?= $longitude ?>" class="text"
                                                               style="width: 200px;" readonly/>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <!--                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"-->
                            <!--                                   style="margin-top:50px;">-->
                            <!--                                <caption>-->
                            <!--                                </caption>-->
                            <!--                                <colgroup>-->
                            <!--                                    <col width="5%"/>-->
                            <!--                                    <col width="x"/>-->
                            <!--                                    <col width="10%"/>-->
                            <!--                                    <col width="10%"/>-->
                            <!--                                    <col width="10%"/>-->
                            <!--                                </colgroup>-->
                            <!--                                <tbody>-->
                            <!--                                <tr>-->
                            <!--                                    <td colspan="5">-->
                            <!--                                        상품문의(FAQ)-->
                            <!--                                    </td>-->
                            <!--                                </tr>-->
                            <!---->
                            <!--                                <tr>-->
                            <!--                                    <th>번호</th>-->
                            <!--                                    <th>코드명</th>-->
                            <!--                                    <th>현황</th>-->
                            <!--                                    <th>등록일</th>-->
                            <!--                                    <th>관리</th>-->
                            <!--                                </tr>-->
                            <!---->
                            <!--                                <tr>-->
                            <!--                                    <td>32</td>-->
                            <!--                                    <td class="tal">-->
                            <!--                                        <a href="#">호텔등급</a>-->
                            <!--                                    </td>-->
                            <!--                                    <td>-->
                            <!--                                        답변완료-->
                            <!--                                    </td>-->
                            <!--                                    <td>-->
                            <!--                                        2024-10-31 18:16:58-->
                            <!--                                    </td>-->
                            <!--                                    <td>-->
                            <!--                                        <div class="" style="display: flex; gap: 10px">-->
                            <!--                                            <a href="#" class="btn btn-default">추가등록</a>-->
                            <!--                                            <a href="#" class="btn btn-default">하위리스트</a>-->
                            <!--                                        </div>-->
                            <!--                                    </td>-->
                            <!--                                </tr>-->
                            <!---->
                            <!--                                </tbody>-->
                            <!--                            </table>-->

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
                                        자세한 정보
                                    </td>
                                </tr>

                                <tr>
                                    <th>서비스 정책</th>
                                    <td>
                                        <textarea name="meet_out_time" id="meet_out_time"
                                                  style="width:90%;height:100px;"><?= $meet_out_time ?? "" ?></textarea>
                                    </td>
                                    <th>결제 정책</th>
                                    <td>
                                        <textarea name="children_policy" id="children_policy"
                                                  style="width:90%;height:100px;"><?= $children_policy ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>할인 정책</th>
                                    <td>
                                        <textarea name="baby_beds" id="baby_beds"
                                                  style="width:90%;height:100px;"><?= $baby_beds ?? "" ?></textarea>
                                    </td>
                                    <th>개인청보 보안 정책</th>
                                    <td>
                                        <textarea name="breakfast" id="breakfast"
                                                  style="width:90%;height:100px;"><?= $breakfast ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>보증금 규정</th>
                                    <td>
                                        <textarea name="deposit_regulations" id="deposit_regulations"
                                                  style="width:90%;height:100px;"><?= $deposit_regulations ?? "" ?></textarea>
                                    </td>
                                    <th>반려동물</th>
                                    <td>
                                        <textarea name="pets" id="pets"
                                                  style="width:90%;height:100px;"><?= $pets ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>연령 제한</th>
                                    <td>
                                        <textarea name="age_restriction" id="age_restriction"
                                                  style="width:90%;height:100px;"><?= $age_restriction ?? "" ?></textarea>
                                    </td>
                                    <th>흡연 정책</th>
                                    <td>
                                        <textarea name="smoking_policy" id="smoking_policy"
                                                  style="width:90%;height:100px;"><?= $smoking_policy ?? "" ?></textarea>
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
                                   style="margin-top:50px;">
                                <caption></caption>
                                <colgroup>
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="*">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>시작일</th>
                                    <th>종료일</th>
                                    <th>선택요일</th>
                                    <th>대인가격(단위: 바트)</th>
                                    <th>소인가격(단위: 바트)</th>
                                    <th>가격추가</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="height:50px">
                                    <td class="tac">
                                        <input type="text" class="input_txt _available_period_ datepicker"
                                               name="d_start" value="" readonly
                                               id="d_start">
                                    </td>
                                    <td class="tac">
                                        <input type="text" class="input_txt _available_period_ datepicker"
                                               name="d_end" value="" readonly
                                               id="d_end">
                                    </td>
                                    <td class="tac">
                                        <input type="checkbox" name="yoil_0" id="yoil_0" value="Y" class="yoil">
                                        <label for="yoil_0">일요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_1" id="yoil_1" value="Y" class="yoil">
                                        <label for="yoil_1">월요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_2" id="yoil_2" value="Y" class="yoil">
                                        <label for="yoil_2">화요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_3" id="yoil_3" value="Y" class="yoil">
                                        <label for="yoil_3">수요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_4" id="yoil_4" value="Y" class="yoil">
                                        <label for="yoil_4">목요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_5" id="yoil_5" value="Y" class="yoil">
                                        <label for="yoil_5">금요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="yoil_6" id="yoil_6" value="Y" class="yoil">
                                        <label for="yoil_6">토요일</label>
                                        &nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="text-align:center">
                                        <input type="text" name="price1" id="price1" value="0"
                                               class="price price1 input_txt"
                                               style="width:90%;text-align:right;">
                                    </td>
                                    <td style="text-align:center">
                                        <input type="text" name="price2" id="price2" value="0"
                                               class="price price2 input_txt"
                                               style="width:90%;text-align:right;">
                                    </td>
                                    <td style="text-align: center">
                                        <a href="#!" onclick="isrt_price();" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-cog"></span><span class="txt">가격추가</span></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption></caption>
                                <colgroup>
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="*">
                                    <col width="10%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>시작일</th>
                                    <th>종료일</th>
                                    <th>선택요일</th>
                                    <th>등록일</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i2 = 0;
                                foreach ($fresult9 as $row) {
                                    $i2++;
                                    ?>
                                    <tr style="height:50px">
                                        <td><?= $i2 ?></td>
                                        <td class="tac">
                                            <?= $row['s_date'] ?>
                                        </td>
                                        <td class="tac">
                                            <?= $row['e_date'] ?>
                                        </td>
                                        <td class="tac">
                                            <input type="checkbox" name="yoil_0" id="yoil_0_<?= $row['p_idx'] ?>"
                                                   value="Y" <?= $row['yoil_0'] == "Y" ? "checked" : "" ?>
                                                   class="yoil">
                                            <label for="yoil_0_<?= $row['p_idx'] ?>">일요일</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_1" id="yoil_1_<?= $row['p_idx'] ?>"
                                                   value="Y" <?= $row['yoil_1'] == "Y" ? "checked" : "" ?>
                                                   class="yoil">
                                            <label for="yoil_1_<?= $row['p_idx'] ?>">월요일</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_2" id="yoil_2_<?= $row['p_idx'] ?>"
                                                   value="Y" <?= $row['yoil_2'] == "Y" ? "checked" : "" ?>
                                                   class="yoil">
                                            <label for="yoil_2_<?= $row['p_idx'] ?>">화요일</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_3" id="yoil_3_<?= $row['p_idx'] ?>"
                                                   value="Y" <?= $row['yoil_3'] == "Y" ? "checked" : "" ?>
                                                   class="yoil">
                                            <label for="yoil_3_<?= $row['p_idx'] ?>">수요일</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_4" id="yoil_4_<?= $row['p_idx'] ?>"
                                                   value="Y" <?= $row['yoil_4'] == "Y" ? "checked" : "" ?>
                                                   class="yoil">
                                            <label for="yoil_4_<?= $row['p_idx'] ?>">목요일</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_5" id="yoil_5_<?= $row['p_idx'] ?>"
                                                   value="Y" <?= $row['yoil_5'] == "Y" ? "checked" : "" ?>
                                                   class="yoil">
                                            <label for="yoil_5_<?= $row['p_idx'] ?>">금요일</label>
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="yoil_6" id="yoil_6_<?= $row['p_idx'] ?>"
                                                   value="Y" <?= $row['yoil_6'] == "Y" ? "checked" : "" ?>
                                                   class="yoil">
                                            <label for="yoil_6_<?= $row['p_idx'] ?>">토요일</label>
                                            &nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td style="text-align:center">
                                            <?= $row['c_date'] ?>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="/AdmMaster/_productPrice/write_new?yoil_idx=<?= $row['p_idx'] ?>&product_idx=<?= $product_idx ?>"
                                               class="btn btn-default">가격수정</a>

                                            <a href="javascript:close_yoil('<?= $row['p_idx'] ?>');"
                                               class="btn btn-default">마감처리</a>

                                            <a href="javascript:del_yoil('<?= $row['p_idx'] ?>');"
                                               class="btn btn-default">삭제하기</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Delete option spa/ticket/restaurant -->

            <div class="tail_menu" style="margin-bottom: 60px">
                <ul>
                    <li class="left"></li>
                    <li class="right_sub">

                        <a href="list_spas?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                           class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        <?php if ($product_idx == "") { ?>
                            <a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                        <?php } else { ?>
                            <a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            <!--a href="javascript:del_it('<?= $product_idx ?>')" class="btn btn-default"><span
                                        class="glyphicon glyphicon-trash"></span><span class="txt">완전삭제</span></a-->
                        <?php } ?>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- // listBottom -->
    <div class="pick_item_pop02" id="popup_location">
        <div>
            <h2>메인노출상품 등록</h2>
            <div class="table_box" style="height: calc(100% - 146px);">
                <ul id="list_location">

                </ul>
            </div>
            <div class="sel_box">
                <button type="button" class="close" onclick="fn_close_popup();">닫기</button>
            </div>
        </div>
    </div>

    <script>
        function fn_close_popup() {
            $('#popup_location').css('display', 'none')
        }

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

        function isrt_price() {
            upd_price('');
        }

        function close_yoil(p_idx) 
		{
            alert(p_idx);
            if (!confirm("선택한 기간을 마감하시겠습니까?"))
                return false;

            let message = "";
            $.ajax({

                url: "/ajax/ajax.close_yoil.php",
                type: "POST",
                data: {
                    "tours_idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });				 
        }
		
        function del_yoil(p_idx) {
            $("#ajax_loader").removeClass("display-none");
            if (!confirm("정말로 삭제하시겠습니까?\n\n한 번 삭제되면 데이터를 복구할 수 없습니다.\n\n")){
                $("#ajax_loader").addClass("display-none");
                return false;
            }

            let url = `<?= route_to('admin.api.spa_.del_option_price') ?>`;

            let data = {
                "p_idx": p_idx,
            };

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    let message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    $("#ajax_loader").addClass("display-none");
                }

            });
        }

        function del_detail(air_code) {

        }

        function upd_price(p_idx) {
            $("#ajax_loader").removeClass("display-none");
            let url = `<?= route_to('admin.api.spa_.save_option_price') ?>`;

            let d_start = $("#d_start").val();
            let d_end = $("#d_end").val();

            let price_1 = $("#price1").val().replaceAll(',', '');
            let price_2 = $("#price2").val().replaceAll(',', '');
            // let price_3 = $("#price3").val().replaceAll(',', '');

            let yoil_0 = $("#yoil_0").is(":checked") ? "Y" : "N";
            let yoil_1 = $("#yoil_1").is(":checked") ? "Y" : "N";
            let yoil_2 = $("#yoil_2").is(":checked") ? "Y" : "N";
            let yoil_3 = $("#yoil_3").is(":checked") ? "Y" : "N";
            let yoil_4 = $("#yoil_4").is(":checked") ? "Y" : "N";
            let yoil_5 = $("#yoil_5").is(":checked") ? "Y" : "N";
            let yoil_6 = $("#yoil_6").is(":checked") ? "Y" : "N";

            let data = {
                "p_idx": p_idx,
                "product_idx": '<?= $product_idx ?>',
                "s_date": d_start,
                "e_date": d_end,
                "price1": price_1,
                "price2": price_2,
                "price3": 0,
                "yoil_0": yoil_0,
                "yoil_1": yoil_1,
                "yoil_2": yoil_2,
                "yoil_3": yoil_3,
                "yoil_4": yoil_4,
                "yoil_5": yoil_5,
                "yoil_6": yoil_6
            };

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    let message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    $("#ajax_loader").removeClass("display-none");
                }

            });
        }
    </script>
    <script>
        function change_manager(user_id) {

            if (user_id === "정민경 사원") {
                $("#product_manager").val("정민경 사원");
                $("#phone").val("070-7430-5812");
                $("#email").val("booking@hihojoo.com");
            } else {
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
                        // message = data.message;
                        // alert(message);
                        // $("#listForm").submit();
                        $("#product_manager").val(data?.user_name || " ");
                        $("#phone").val(data?.user_mobile || "");
                        $("#email").val(data?.user_email || "");

                    },
                    error: function (request, status, error) {
                        alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                    }
                });
            }

        }

        function del_tours(idx) {
            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            let message = "";
            $.ajax({

                url: "/ajax/ajax.del_tours.php",
                type: "POST",
                data: {
                    "tours_idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }
    </script>
    <script>
        $("#btn_add_optionx").click(function () {

            let addOption = "";
            addOption += "<tr color='' size='' >												  ";

            addOption += "	<td>																  ";
            addOption += "		<input type='hidden' name='o_idx[]'  value='' />	  ";
            addOption += "		<input type='hidden' name='option_type[]'  value='M' />	  ";
            addOption += "		<input type='file' name='a_file[]'  value='' style='display:none;' />					  ";
            addOption += "		<input type='text' name='o_name[]'  value='' size='70' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum' name='o_price[]'  value='' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<select name='ues_yn[]'>	                                      ";
            addOption += "		<option value='Y'>판매</option>    	                              ";
            addOption += "		<option value='N'>중지</option>    	                              ";
            addOption += "		</select>	                                                      ";
            addOption += "	</td>																  ";
//		addOption += "	<td>																  ";
//		addOption += "		<input type='text' class='onlynum' name='o_jaego[]'  value='' />	  ";
//		addOption += "	</td>																  ";


            addOption += "	<td class='cus_'>																  ";
            addOption += '		<button style="height: 31px; background-color:#d03a3e; color: #FFFFFF" ' +
                'type="button" onclick="delOption(\'\',this)">삭제</button>	  ';
            addOption += "	</td>																  ";
            addOption += "</tr>																	  ";

            $("#settingBody").append(addOption);

        });

        function add_option(code_idx) {
            let addOption = "";
            addOption += "<tr color='' size='' >												  ";

            addOption += "	<td>																  ";
            addOption += "		<input type='hidden' name='o_idx[]'  value='' />	  ";
            addOption += "		<input type='hidden' name='option_type[]'  value='M' />	  ";
            addOption += "		<input type='file' name='a_file[]'  value='' style='display:none;' />					  ";
            addOption += "		<input type='text' name='o_name[]'  value='' size='70' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum' name='o_price[]'  value='' />	  ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<select name='ues_yn[]'>	                                      ";
            addOption += "		<option value='Y'>판매</option>    	                              ";
            addOption += "		<option value='N'>중지</option>    	                              ";
            addOption += "		</select/>	                                                      ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum' name='o_num[]'  value='' />	  ";
            addOption += "	</td>																  ";
//		addOption += "	<td>																  ";
//		addOption += "		<input type='text' class='onlynum' name='o_jaego[]'  value='' />	  ";
//		addOption += "	</td>																  ";


            addOption += "	<td class='cus_'>																  ";
            addOption += '		<button style="height: 31px; background-color:#d03a3e; color: #FFFFFF" ' +
                'type="button" onclick="delOption(\'\',this)">삭제</button>	  ';
            addOption += "	</td>																  ";
            addOption += "</tr>																	  ";

            $("#settingBody_" + code_idx).append(addOption);
        }

        function upd_moption(code_idx) {
            let message = "";
            $.ajax({

                url: "<?= route_to('admin.api.spa_.upd_moption') ?>",
                type: "POST",
                data: {
                    "code_idx": code_idx,
                    "moption_name": $("#moption_name_" + code_idx).val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        function add_moption() {
            let moption_name = $('#moption_name').val();
            if (!moption_name) {
                alert('옵션명을 입력하세요!')
                return;
            }
            let message = "";
            $.ajax({

                url: "<?= route_to('admin.api.spa_.add_moption') ?>",
                type: "POST",
                data: {
                    "product_idx": '<?= $product_idx ?>',
                    "moption_name": $("#moption_name").val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        function del_moption(code_idx) {
            if (!confirm("선택한 옵션을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            let message = "";
            $.ajax({

                url: "<?= route_to('admin.api.spa_.del_moption') ?>",
                type: "POST",
                data: {
                    "code_idx": code_idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }

        function upd_option(code_idx) {
            let option_data = jQuery("#optionForm_" + code_idx).serialize();

            $.ajax({
                type: "POST",
                data: option_data,
                url: "<?= route_to('admin.api.spa_.add_option') ?>",
                cache: false,
                async: false,
                success: function (data, textStatus) {
                    let message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        // 옵션 삭제 함수
        function delOption(idx, obj) {

            if (!confirm("선택한 옵션을 삭제 하시겠습니까?"))
                return false;

            let message = "";
            $.ajax({

                url: "<?= route_to('admin.api.spa_.del_option') ?>",
                type: "POST",
                data: {
                    "idx": idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }


        // 옵션 수정 함수
        function updOption(idx) {

            if (!confirm("선택한 옵션을 수정 하시겠습니까?"))
                return false;

            var message = "";
            $.ajax({

                url: "<?= route_to('admin.api.spa_.upd_option') ?>",
                type: "POST",
                data: {
                    "idx": idx,
                    "option_name": $("#o_name_" + idx).val(),
                    "option_price": $("#o_price_" + idx).val(),
                    "use_yn": $("#use_yn_" + idx).val(),
                    "onum": $("#o_num_" + idx).val()
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }
    </script>
    <script>
        function img_remove(img) {
            //alert('img- '+img);
            if (!confirm("선택한 이미지를 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n."))
                return false;

            var message = "";
            $.ajax({

                url: "<?= route_to('admin.api.spa_.img_remove') ?>",
                type: "POST",
                data: {
                    "product_idx": $("#product_idx").val(),
                    "img": img
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }

            });
        }
    </script>

    <script>
        function send_it() {

			if ($('#direct_payment').is(':checked')) { // 체크 여부 확인
				$("#direct").val('Y');
			} else {
				$("#direct").val('');
			}			
            let frm = document.frm;
            /*
            oEditors1.getById["product_contents"].exec("UPDATE_CONTENTS_FIELD", []);
            */
            // oEditors4.getById["mobile_unable"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors3.getById["mobile_able"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors2.getById["product_able"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors5.getById["product_unable"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors6.getById["special_benefit"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors7.getById["special_benefit_m"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors8.getById["notice_comment"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors9.getById["notice_comment_m"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors10.getById["etc_comment"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors11.getById["etc_comment_m"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors14.getById["tour_info"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors12.getById["product_info"].exec("UPDATE_CONTENTS_FIELD", []);
            // oEditors13.getById["product_info_m"].exec("UPDATE_CONTENTS_FIELD", []);

            oEditors14.getById["product_contents"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors15.getById["product_contents_m"].exec("UPDATE_CONTENTS_FIELD", []);
            oEditors16.getById["note_news"].exec("UPDATE_CONTENTS_FIELD", []);

            // if ($("#chk_product_code").val() == "N") {
            //     alert("중복된 제품 코드를 확인하세요.");
            //     return;
            // }

            if($("#check_img_ufile1").length > 0 && !$("#check_img_ufile1").val() && $("#ufile1").get(0).files.length === 0){
                alert("이미지를 등록해주세요.");
                return false;
            }

            let option = "";
            $("input:checkbox[name='_option']:checked").each(function () {
                option += '|' + $(this).val();
            });
            option += '|';
            $("#product_option").val(option);

            let tours_cate = "";
            $("input:checkbox[name='_tours_cate']:checked").each(function () {
                tours_cate += '|' + $(this).val();
            });
            option += '|';
            $("#tours_cate").val(tours_cate);

            let _code_utilities = '';
            let _code_services = '';
            let _code_best_utilities = '';
            let _code_populars = '';

            $("input[name=_code_utilities]:checked").each(function () {
                _code_utilities += $(this).val() + '|';
            })
            $("#code_utilities").val(_code_utilities);

            $("input[name=_code_services]:checked").each(function () {
                _code_services += $(this).val() + '|';
            })
            $("#code_services").val(_code_services);

            $("input[name=_code_best_utilities]:checked").each(function () {
                _code_best_utilities += $(this).val() + '|';
            })
            $("#code_best_utilities").val(_code_best_utilities);

            $("input[name=_code_populars]:checked").each(function () {
                _code_populars += $(this).val() + '|';
            })
            $("#code_populars").val(_code_populars);

            let _available_period = '';
            let _deadline_time = '';

            let available_period_start = $('#available_period_start').val();
            let available_period_end = $('#available_period_end').val();

            _available_period = available_period_start + '||' + available_period_end;

            $('.deadline_date').each(function () {
                let item = $(this).val();

                let arr_item_ = item.split('~');
                let start_ = arr_item_[0].trim();
                let end = arr_item_[1].trim();

                let date_ = start_ + '||' + end;
                _deadline_time = _deadline_time + '||||' + date_;
            })

            let _code_mbtis = '';
            $("input[name=_code_mbti]:checked").each(function () {
                _code_mbtis += $(this).val() + '|';
            })

            $("#mbti").val(_code_mbtis);

            // let al_list_ = $('#al_list_');
            // let al_list_item_ = al_list_.find('.al')
            //
            // al_list_item_.each(function () {
            //     let el = $(this);
            //
            //     let deadline_start = el.find('input[name="deadline_start"]').val();
            //     let deadline_end = el.find('input[name="deadline_end"]').val();
            //
            //     let deadline_ = deadline_start + '||' + deadline_end;
            //
            //     _deadline_time = _deadline_time + '||||' + deadline_;
            // })

            $('#available_period').val(_available_period)
            $('#deadline_time').val(_deadline_time)

            $("#ajax_loader").removeClass("display-none");

            frm.submit();
        }

        function del_it(idx) {
            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            let message = "";
            $.ajax({

                url: "/AdmMaster/_tourRegist/del_product",
                type: "DELETE",
                data: "product_idx[]=" + idx,
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    alert(message);
                    $("#listForm").submit();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        }

        function get_code(strs, depth) {
            let uri = `<?= route_to('admin.api.spa_.get_code') ?>`
            $.ajax({
                type: "GET"
                , url: uri
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
                        $("#product_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                    }
                }
            });
        }

        function get_code_2(strs, depth) {
            let uri = `<?= route_to('admin.api.spa_.get_code') ?>`

            $.ajax({
                type: "GET",
                url: uri,
                dataType: "html",
                timeout: 30000,
                cache: false,
                data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth,
                error: function (request, status, error) {
                    alert("code : " + request.status + "\r\nmessage : " + request.responseText);
                },
                success: function (json) {
                    var list = $.parseJSON(json);
                    var listLen = list.length;

                    $("#text").empty();

                    for (var i = 0; i < listLen; i++) {
                        var contentStr = "";
                        if (list[i].code_status == "C") {
                            contentStr = "[마감]";
                        } else if (list[i].code_status == "N") {
                            contentStr = "[사용안함]";
                        }
                        $("#text").append("<input type='checkbox' name='_tours_cate' class='product_option' value='" + list[i].code_no + "' /> " + list[i].code_name + " " + contentStr + "<br>");
                    }
                }
            });
        }
    </script>
    <script>
        $('#all_code_populars').change(function () {
            if ($('#all_code_populars').is(':checked')) {
                $('.code_populars').prop('checked', true)
            } else {
                $('.code_populars').prop('checked', false)
            }
        });

        $('#all_code_service').change(function () {
            if ($('#all_code_service').is(':checked')) {
                $('.code_service').prop('checked', true)
            } else {
                $('.code_service').prop('checked', false)
            }
        });

        $('#all_code_best_utilities').change(function () {
            if ($('#all_code_best_utilities').is(':checked')) {
                $('.code_best_utilities').prop('checked', true)
            } else {
                $('.code_best_utilities').prop('checked', false)
            }
        });

        $('#all_code_utility').change(function () {
            if ($('#all_code_utility').is(':checked')) {
                $('.code_utilities').prop('checked', true)
            } else {
                $('.code_utilities').prop('checked', false)
            }
        })

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
                    $("#popup_location #list_location li").click(function () {
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
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

    <form id="listForm" action="./list_spas">
        <input type="hidden" name="orderBy" value="<?= $orderBy ?>">
        <input type="hidden" name="pg" value="<?= $pg ?>">
        <input type="hidden" name="product_idx" value="<?= $product_idx ?>">
        <input type="hidden" name="_product_code_1" value="<?= $product_code_1 ?>">
        <input type="hidden" name="_product_code_2" value="<?= $product_code_2 ?>">
        <input type="hidden" name="_product_code_3" value="<?= $product_code_3 ?>">
        <input type="hidden" name="s_date" value="<?= $s_date ?>">
        <input type="hidden" name="e_date" value="<?= $e_date ?>">
        <input type="hidden" name="s_time" value="<?= $s_time ?>">
        <input type="hidden" name="e_time" value="<?= $e_time ?>">
        <input type="hidden" name="search_category" value="<?= $search_category ?>">
        <input type="hidden" name="search_name" value="<?= $search_name ?>">
    </form>
    <script>
        function check_product_code(product_code) {
            $.ajax({
                url: "/ajax/check_product_code",
                type: "POST",
                data: "product_code=" + product_code,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (response, status, request) {
                    alert(response.message);

                    if (response.result == true) {
                        $("#chk_product_code").val("Y");
                    } else {
                        $("#chk_product_code").val("N");
                        location.reload();
                    }
                }
            });
        }
    </script>
<?= $this->endSection() ?>