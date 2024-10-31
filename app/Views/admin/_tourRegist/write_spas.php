<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
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
                    <h2>자유여행 상품관리 정보입력 <?= $titleStr ?> </h2>
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
                                <li><a href="javascript:del_it('<?= $product_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span
                                                class="txt">완전삭제</span></a></li>
                                <script>
                                    function copy_it() {
                                        if (confirm("제품을 복사하시겠습니까?")) {
                                            location.href = "copy.php?product_idx=<?=$product_idx?>";
                                        }
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

                <input type="hidden" name="code_utilities" id="code_utilities"
                       value='<?= $code_utilities ?? "" ?>'/>
                <input type="hidden" name="code_services" id="code_services"
                       value='<?= $code_services ?? "" ?>'/>
                <input type="hidden" name="code_best_utilities" id="code_best_utilities"
                       value='<?= $code_best_utilities ?? "" ?>'/>
                <input type="hidden" name="code_populars" id="code_populars"
                       value='<?= $code_populars ?? "" ?>'/>

                <input type="hidden" name="available_period" id="available_period"
                       value='<?= $available_period ?? "" ?>'/>
                <input type="hidden" name="deadline_time" id="deadline_time"
                       value='<?= $deadline_time ?? "" ?>'/>

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
                                    <th>상품분류</th>
                                    <td>
                                        <select id="product_code_1" name="product_code_1" class="input_select"
                                                onchange="javascript:get_code(this.value, 3)">
                                            <option value="">1차분류</option>
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
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_1) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

                                            <?php endforeach; ?>

                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select"
                                                onchange="javascript:get_code(this.value, 4)">
                                            <option value="">2차분류</option>
                                            <?php
                                            foreach ($fresult2 as $frow):
                                                $status_txt = "";
                                                if ($frow["code_no"] == $product_code_2) {
                                                    $status_txt = "";
                                                } elseif ($frow["code_no"] == $product_code_2) {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["code_no"] == $product_code_2) {
                                                    $status_txt = "[마감]";
                                                }

                                                ?>
                                                <option value="<?= $frow["code_no"] ?>" <?php if ($frow["code_no"] == $product_code_2) {
                                                    echo "selected";
                                                } ?>><?= $frow["code_name"] ?> <?= $status_txt ?></option>

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
                                    <th>일자</th>
                                    <td>
                                        <select id="tour_period" name="tour_period" class="input_select">
                                            <option value="">일자선택</option>
                                            <?php for ($i = 1; $i <= 40; $i++) { ?>
                                                <option value="<?= $i ?>" <?php if ($tour_period == $i) {
                                                    echo "selected";
                                                } ?>><?= $i ?>일
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th rowspan="3">썸네일<br>(600 * 450)</th>
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
                                    </td>
                                    <th>상품명</th>
                                    <td>
                                        <input type="text" id="product_name" name="product_name"
                                               value="<?= $product_name ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>


                                <tr>
                                    <th>간단소개</th>
                                    <td>
                                        <input type="text" id="product_info" name="product_info"
                                               value="<?= $product_info ?>"
                                               class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>사용여부</th>
                                    <td>
                                        <select id="is_view" name="is_view">
                                            <option value='Y' <?php if ($is_view == "Y") {
                                                echo "selected";
                                            } ?>>사용
                                            </option>
                                            <option value='N' <?php if ($is_view == "N") {
                                                echo "selected";
                                            } ?>>사용안함
                                            </option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품담당자</th>
                                    <td>
                                        <input id="product_manager" name="product_manager" class="input_txt" type="text"
                                               value="<?= $product_manager ?>" style="width:100px"/>
                                        /<input id="phone" name="phone" class="input_txt" type="text"
                                                value="<?= $phone ?>"
                                                style="width:200px"/> /<input id="email" name="email" class="input_txt"
                                                                              type="text" value="<?= $email ?>"
                                                                              style="width:200px"/>
                                        <select name="product_manager_id" id="product_manager_sel"
                                                onchange="change_manager(this.value)">
                                            <?php
                                            foreach ($member_list as $row_member) :
                                                ?>
                                                <option value="<?= $row_member["user_id"] ?>" <? if ($product_manager_id == $row_member["user_id"]) {
                                                    echo "selected";
                                                } ?>><?= $row_member["user_name"] ?></option>
                                            <?php endforeach; ?>
                                            <option value="서소연 대리" <?php if ($product_manager == "서소연 대리") {
                                                echo "selected";
                                            } ?>>서소연 대리
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
                                    <th>기존상품가(단위: AUD)</th>
                                    <td>
                                        <input id="original_price" name="original_price" class="input_txt price"
                                               type="text"
                                               value="<?= $original_price ?>" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품의 할인 전 금액</span>
                                    </td>
                                    <th>상품최저가</th>
                                    <td>
                                        <input id="product_price" name="product_price" value="<?= $product_price ?>"
                                               class="input_txt price" type="text" style="width:90%"/><br/>
                                        <span style="color: gray;">* ex) 상품페이지에 보여질 상품가격(할인가)</span>
                                    </td>
                                </tr>

                                <script>
                                    function prod_copy(idx) {
                                        if (!confirm("선택한 상품을 복사 하시겠습니까?"))
                                            return false;

                                        var message = "";
                                        $.ajax({

                                            url: "./ajax.prod_copy_tours.php",
                                            type: "POST",
                                            data: {
                                                "product_idx": idx
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
                                    <th>베스트여부</th>
                                    <td>
                                        <input type="checkbox" name="product_best"
                                               id="product_best"
                                               value="Y" <?php if (isset($product_best) && $product_best == "Y") {
                                            echo "checked";
                                        } ?>/>
                                    </td>
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt"
                                               style="width:80px"/> <span
                                                style="color: gray;">(숫자가 높을수록 상위에 노출됩니다.)</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>단품 메인노출</th>
                                    <td colspan="3">
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
                            </script>

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
                                        <div class="al_list_" id="al_list_">
                                            <?php foreach ($arr_deadline_time as $itemTime) { ?>
                                                <?php if ($itemTime && $itemTime != '') { ?>
                                                    <?php
                                                    $arr_itemTime = explode('||', $itemTime)
                                                    ?>
                                                    <div class="al">
                                                        <input type="text" class="input_txt _deadline_time_ datepicker"
                                                               name="deadline_start" value="<?= $arr_itemTime[0] ?>"
                                                               id="deadline_start">
                                                        <span> ~ </span>
                                                        <input type="text" class="input_txt _deadline_time_ datepicker"
                                                               name="deadline_end" value="<?= $arr_itemTime[1] ?>"
                                                               id="deadline_end">

                                                        <button onclick="removeEl(this);" style="margin: 0"
                                                                class="btn_al_plus_ btn_02" type="button">
                                                            -
                                                        </button>
                                                        <button onclick="plusEl(this);" style="margin: 0"
                                                                class="btn_al_plus_ btn_01" type="button">
                                                            +
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <script>
                                let num = sessionStorage.getItem('num') ?? 0;

                                function plusEl(el) {
                                    num = parseInt(num) + 1;

                                    let html_ = ` <div class="al">
                                                <input type="text" class="input_txt _deadline_time_ datepicker" name="deadline_start"
                                                       id="deadline_start_${num}">
                                                <span> ~ </span>
                                                <input type="text" class="input_txt _deadline_time_ datepicker" name="deadline_end"
                                                       id="deadline_end_${num}">

                                                <button onclick="removeEl(this);" style="margin: 0"
                                                        class="btn_al_plus_ btn_02" type="button">
                                                    -
                                                </button>
                                                <button onclick="plusEl(this);" style="margin: 0"
                                                        class="btn_al_plus_ btn_01" type="button">
                                                    +
                                                </button> </div>`;

                                    let pa = $(el).closest('.al_list_');
                                    pa.append(html_)

                                    sessionStorage.setItem('num', num);

                                    openDatepicker();
                                }

                                function removeEl(el) {
                                    let pa = $(el).closest('.al');
                                    pa.remove();
                                }

                                function openDatepicker() {
                                    $(".datepicker").datepicker();
                                    $(".datepicker2").datepicker();
                                    $('img.ui-datepicker-trigger').css({'cursor': 'pointer'});
                                    $('input.hasDatepicker').css({'cursor': 'pointer'});
                                }
                            </script>

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="5%"/>
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
                                    <th>추천 포인트</th>
                                    <th>
                                        <input type="checkbox" id="all_code_utility" class="all_input"
                                               name="_code_utility" value=""/>
                                        <label for="all_code_utility">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $code_utilities);
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
                                        <input type="checkbox" id="all_code_best_utilities" class="all_input"
                                               name="_code_best_utilities" value=""/>
                                        <label for="all_code_best_utilities">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $code_best_utilities);
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
                                        <input type="checkbox" id="all_code_service" class="all_input"
                                               name="_code_service" value=""/>
                                        <label for="all_code_service">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $code_services);
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

                                <tr>
                                    <th>호텔주변 추천명소</th>
                                    <th style="width: 20px">
                                        <input type="checkbox" id="all_code_populars" class="all_input"
                                               name="_code_populars" value="Y"/>
                                        <label for="all_code_populars">
                                            모두 선택
                                        </label>
                                    </th>
                                    <td colspan="2">
                                        <?php
                                        $_arr = explode("|", $code_populars);
                                        foreach ($fresult8 as $row_r) :
                                            $find = "";
                                            for ($i = 0; $i < count($_arr); $i++) {
                                                if ($_arr[$i]) {
                                                    if ($_arr[$i] == $row_r['code_no']) $find = "Y";
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" id="code_populars<?= $row_r['code_no'] ?>"
                                                   name="_code_populars" class="code_populars"
                                                   value="<?= $row_r['code_no'] ?>" <?php if ($find == "Y") echo "checked"; ?> />
                                            <label for="code_populars<?= $row_r['code_no'] ?>">
                                                <?= $row_r['code_name'] ?>
                                            </label>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
            <!-- // listBottom -->

            <div class="tail_menu">
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
                            <a href="javascript:del_it('<?= $product_idx ?>')" class="btn btn-default"><span
                                        class="glyphicon glyphicon-trash"></span><span class="txt">완전삭제</span></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>


            <div class="listBottom" style="padding: 15px;">
                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                    <caption>
                    </caption>
                    <colgroup>
                        <col width="*"/>
                    </colgroup>
                    <tbody>

                    <tr>
                        <th>옵션추가</th>
                        <td>
                            <input type='text' name='moption_name' id='moption_name' value="" style="width:550px"/>
                            <button type="button" class="btn_01" onclick="add_moption();">추가</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <?php foreach ($options as $row_option): ?>
                <div class="listBottom">
                    <form name="optionForm_<?= $row_option['code_idx'] ?>"
                          id="optionForm_<?= $row_option['code_idx'] ?>">
                        <input type="hidden" name="product_idx" value="<?= $product_idx ?>"/>
                        <input type="hidden" name="code_idx" value="<?= $row_option['code_idx'] ?>"/>

                        <table class="listTable mem_detail">
                            <tbody>
                            <tr>
                                <th>옵션</th>
                                <td>
                                    <input type="text" name="moption_name" value="<?= $row_option['moption_name'] ?>"/>
                                    <button type="button" onclick="upd_moption('<?= $row_option['code_idx'] ?>');">수정
                                    </button>
                                    <button type="button" onclick="del_moption('<?= $row_option['code_idx'] ?>');">삭제
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>추가 옵션등록</th>
                                <td>
                                    <button type="button" onclick="add_option('<?= $row_option['code_idx'] ?>');">추가
                                    </button>
                                    <button type="button" onclick="upd_option('<?= $row_option['code_idx'] ?>');">등록
                                    </button>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>옵션명</th>
                                            <th>가격</th>
                                            <th>적용</th>
                                            <th>순서</th>
                                            <th>삭제</th>
                                        </tr>
                                        </thead>
                                        <tbody id="settingBody_<?= $row_option['code_idx'] ?>">
                                        <?php foreach ($row_option['additional_options'] as $option): ?>
                                            <tr>
                                                <td><input type="text" name="o_name[]"
                                                           value="<?= $option['option_name'] ?>"/></td>
                                                <td><input type="text" name="o_price[]"
                                                           value="<?= $option['option_price'] ?>"/></td>
                                                <td>
                                                    <select name="use_yn[]">
                                                        <option value="Y" <?= $option['use_yn'] == 'Y' ? 'selected' : '' ?>>
                                                            판매중
                                                        </option>
                                                        <option value="N" <?= $option['use_yn'] != 'Y' ? 'selected' : '' ?>>
                                                            중지
                                                        </option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="o_num[]" value="<?= $option['onum'] ?>"/>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="delOption('<?= $option['idx'] ?>');">
                                                        삭제
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script>
        function change_manager(user_id) {

            if (user_id === "정민경 사원") {
                $("#product_manager").val("정민경 사원");
                $("#phone").val("070-7430-5812");
                $("#email").val("booking@hihojoo.com");
            } else {
                $.ajax({
                    url: "../../ajax/ajax.change_manager.php",
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
                        $("#product_manager").val(data.user_name);
                        $("#phone").val(data.user_phone);
                        $("#email").val(data.user_email);

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


            addOption += "	<td>																  ";
            addOption += '		<button type="button" onclick="delOption(\'\',this)">삭제</button>	  ';
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


            addOption += "	<td>																  ";
            addOption += '		<button type="button" onclick="delOption(\'\',this)">삭제</button>	  ';
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

    <script type="text/javascript">
        function del_yoil(yoil_idx) {
            if (confirm("삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.")) {
                hiddenFrame.location.href = "/AdmMaster/_tourRegist/yoil_del.php?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>&product_idx=<?= $product_idx ?>&yoil_idx=" + yoil_idx;
            }
        }

        function del_detail(air_code) {
            if (confirm("삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.")) {
                hiddenFrame.location.href = "/AdmMaster/_tourRegist/detail_del.php?product_idx=<?= $product_idx ?>&air_code=" + air_code;
            }
        }


    </script>
    <script>
        function send_it() {
            $("#ajax_loader").removeClass("display-none");

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

            let al_list_ = $('#al_list_');
            let al_list_item_ = al_list_.find('.al')

            al_list_item_.each(function () {
                let el = $(this);

                let deadline_start = el.find('input[name="deadline_start"]').val();
                let deadline_end = el.find('input[name="deadline_end"]').val();

                let deadline_ = deadline_start + '||' + deadline_end;

                _deadline_time = _deadline_time + '||||' + deadline_;
            })

            $('#available_period').val(_available_period)
            $('#deadline_time').val(_deadline_time)

            frm.submit();
        }

        function del_it(idx) {
            let uri = `<?= route_to('admin.api.spa_.del') ?>`

            if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

            let message = "";
            $.ajax({

                url: uri,
                type: "POST",
                data: {
                    "product_idx": idx
                },
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
<?= $this->endSection() ?>