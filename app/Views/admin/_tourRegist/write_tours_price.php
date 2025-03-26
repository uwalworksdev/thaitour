<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<div id="container" style="overflow: hidden;">
    <div id="print_this"><!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2>가격리스트</h2>
                <div class="menus">
                    <ul>
                        <li>
                            <a href="list_tours?s_product_code_1=<?= $s_product_code_1 ?>&s_product_code_2=<?= $s_product_code_2 ?>&s_product_code_2=<?= $s_product_code_3 ?>&search_name=<?= $search_name ?>&search_category=<?= $search_category ?>&pg=<?= $pg ?>"
                                class="btn btn-default">
                                <span class="glyphicon glyphicon-th-list"></span>
                                <span class="txt">리스트</span>
                            </a>
                        </li>
                        <?php
                            $info_idx = !empty($productTourInfo) ? $productTourInfo[0]['info_idx'] : null;
                        ?>
                            <li>
                                <a href="/AdmMaster/_tourRegist/write_tour_info?product_idx=<?= $product_idx ?>"
                                    class="btn btn-default">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    <span class="txt"><?= $info_idx ? "수정하기" : "가격등록" ?></span>
                                </a>
                            </li>
                    </ul>
                </div>
            </div>
            <!-- // inner -->
        </header>
        <!-- // headerContainer -->

        <form name=frm action="<?= route_to('admin._tours.write_ok') ?>" method=post enctype="multipart/form-data"
                target="hiddenFrame">
            <input type=hidden name="search_category" value='<?= $search_category ?>'>
            <input type=hidden name="search_name" value='<?= $search_name ?>'>
            <input type=hidden name="pg" value='<?= $pg ?>'>
            <input type=hidden name="product_idx" id="product_idx" value='<?= $product_idx ?>'>
            <input type=hidden name="s_product_code_1" value='<?= $s_product_code_1 ?>'>
            <input type=hidden name="s_product_code_2" value='<?= $s_product_code_2 ?>'>
            <input type=hidden name="s_product_code_3" value='<?= $s_product_code_3 ?>'>
        </form>
        <!-- // listBottom -->

        <div id="contents">

            <!-- <div class="listBottom">
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
                            <input type='text' name='moption_name' id='moption_name' value=""
                                    style="width:550px"/>
                            <button type="button" class="btn_01" onclick="add_moption();">추가</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> -->

            <?php foreach ($options as $row_option): ?>
                <!-- <div class="listBottom">
                    <form name="optionForm_<?= $row_option['code_idx'] ?>"
                            id="optionForm_<?= $row_option['code_idx'] ?>">
                        <input type="hidden" name="product_idx" value="<?= $product_idx ?>"/>
                        <input type="hidden" name="code_idx" value="<?= $row_option['code_idx'] ?>"/>

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                style="margin-top:50px;">
                            <colgroup>
                                <col width="10%">
                                <col width="90%">
                            </colgroup>
                            <tbody>
                            <tr height="45">
                                <th colspan="5">
                                    <div class="flex__c" style="gap: 5px;">
                                        옵션 <input type='text' name='moption_name'
                                                    id='moption_name_<?= $row_option['code_idx'] ?>'
                                                    value="<?= $row_option['moption_name'] ?>" style="width:550px"/>
                                        <button type="button" class="btn_01"
                                                onclick="upd_moption('<?= $row_option['code_idx'] ?>');">수정
                                        </button>
                                        <button type="button" class="btn_01"
                                                onclick="del_moption('<?= $row_option['code_idx'] ?>');">삭제
                                        </button>
                                    </div>
                                </th>
                            </tr>
                            <tr height="45">
                                <th>
                                    추가 옵션등록
                                    <div class="flex" style="margin-top:10px; gap: 5px;">
                                        <button type="button" id="btn_add_option"
                                                onclick="add_option('<?= $row_option['code_idx'] ?>');"
                                                class="btn_01">추가
                                        </button>
                                        <button type="button" id="btn_upd_option"
                                                onclick="upd_option('<?= $row_option['code_idx'] ?>');"
                                                class="btn_01">등록
                                        </button>
                                    </div>
                                </th>
                                <td>
                                    <span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다.</span>
                                    <div>
                                        <table>
                                            <colgroup>
                                                <col width="*"></col>
                                                <col width="10%"></col>
                                                <col width="5%"></col>
                                                <col width="5%"></col>
                                                <col width="12%"></col>
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>옵션명 한글/영문</th>
                                                <th>가격(단위: 바트)</th>
                                                <th>적용</th>
                                                <th>순서</th>
                                                <th>삭제</th>
                                            </tr>
                                            </thead>
                                            <tbody id="settingBody_<?= $row_option['code_idx'] ?>">
                                            <?php foreach ($row_option['additional_options'] as $option): ?>
                                                <tr>
                                                    <td>
                                                        <input type='text' name='o_name[]'     id='o_name_<?= $option['idx'] ?>'     value="<?= $option['option_name'] ?>"     style="width:48%;" />
                                                        <input type='text' name='o_name_eng[]' id='o_name_eng_<?= $option['idx'] ?>' value="<?= $option['option_name_eng'] ?>" style="width:48%;" />
                                                    </td>
                                                    <td>
                                                        <input type='text' class='onlynum' style="text-align:right;"
                                                                name='o_price[]' id='o_price_<?= $option['idx'] ?>'
                                                                value="<?= $option['option_price'] ?>"/>
                                                    </td>
                                                    <td>
                                                        <select name="use_yn[]" id="use_yn_<?= $option['idx'] ?>">
                                                            <option value="Y" <?php if ($option['use_yn'] == "Y") echo "selected"; ?> >
                                                                판매중
                                                            </option>
                                                            <option value="N" <?php if ($option['use_yn'] != "Y") echo "selected"; ?> >
                                                                중지
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='onlynum' name='o_num[]'
                                                                id='o_num_<?= $option['idx'] ?>'
                                                                value="<?= $option['onum'] ?>"/>
                                                    </td>
                                                    <td align="center"
                                                        style="display: flex; gap: 5px; justify-content: center; align-items: center">
                                                        <button type="button" style="height: 25px"
                                                                onclick="updOption('<?= $option['idx'] ?>')">수정
                                                        </button>
                                                        <button type="button" style="height: 25px"
                                                                onclick="delOption('<?= $option['idx'] ?>')">삭제
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
                </div> -->
            <?php endforeach; ?>

            <!-- <div class="tail_menu">
                <ul>
                    <li class="left">■ 가격리스트</li>
                    <?php
                    $info_idx = !empty($productTourInfo) ? $productTourInfo[0]['info_idx'] : null;
                    if ($info_idx):
                        ?>
                        <li class="right_sub" style="padding-bottom:10px">
                            <a href="/AdmMaster/_tourRegist/write_tour_info?product_idx=<?= $product_idx ?>"
                                class="btn btn-default">
                                <span class="glyphicon glyphicon-cog"></span>
                                <span class="txt">수정하기</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="right_sub" style="padding-bottom:10px">
                            <a href="/AdmMaster/_tourRegist/write_tour_info?product_idx=<?= $product_idx ?>"
                                class="btn btn-default">
                                <span class="glyphicon glyphicon-cog"></span>
                                <span class="txt">가격등록</span>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div> -->

            <div class="listBottom">
                <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                    <caption></caption>
                    <colgroup>
                        <col width="5%"/>
                        <col width="10%"/>
                        <col width="*"/>
                        <col width="14%"/>
                        <col width="8%"/>
                        <col width="8%"/>
                        <col width="8%"/>
                        <col width="6%"/>
                        <col width="5%"/>
                        <col width="6%"/>
                    </colgroup>
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>기간</th>
                            <th>적용요일</th>
                            <th>상품명</th>
                            <th>성인가격(단위: 바트)</th>
                            <th>소아가격(단위: 바트)</th>
                            <th>유아가격(단위: 바트)</th>
                            <th>등록일</th>
                            <th>판매상태</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(count($productTourInfo) <= 0):
                    ?>
                        <tr style="height:40px">
                            <td>1</td>
                            <td rowspan="2"></td>
                            <td>
                                <input type="checkbox" name="yoil_0" class="yoil" disabled> 일요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_1" class="yoil" disabled> 월요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_2" class="yoil" disabled> 화요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_3" class="yoil" disabled> 수요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_4" class="yoil" disabled> 목요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_5" class="yoil" disabled> 금요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_6" class="yoil" disabled> 토요일&nbsp;&nbsp;
                            </td>
                            <td></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="tac"></td>
                            <td class="tac"></td>
                            <td rowspan="2"></td>
                        </tr>
                        <tr style="height:40px">
                            <td>2</td>
                            <td>
                                <input type="checkbox" name="yoil_0" class="yoil" disabled> 일요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_1" class="yoil" disabled> 월요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_2" class="yoil" disabled> 화요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_3" class="yoil" disabled> 수요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_4" class="yoil" disabled> 목요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_5" class="yoil" disabled> 금요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_6" class="yoil" disabled> 토요일&nbsp;&nbsp;
                            </td>
                            <td></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td class="tac"></td>
                            <td class="tac"></td>
                        </tr>
                    <?php endif; ?>

                    <?php
                        $i = 1;
                        $infoIdxCounts = [];
                        $toursIdxMap = [];

                        foreach ($productTourInfo as $row) {
                            $info_idx = $row['info_idx'];
                            $tours_idx = $row['tours_idx'];

                            if (!isset($infoIdxCounts[$info_idx])) {
                                $infoIdxCounts[$info_idx] = 0;
                            }

                            if (!isset($toursIdxMap[$info_idx])) {
                                $toursIdxMap[$info_idx] = [];
                            }

                            if ($tours_idx !== null && !in_array($tours_idx, $toursIdxMap[$info_idx])) {
                                $toursIdxMap[$info_idx][] = $tours_idx;
                            }

                            $infoIdxCounts[$info_idx]++;
                        }

                        $printedInfoIdx = [];

                        foreach ($productTourInfo as $row):
                            $status = ($row['status'] == "Y") ? "판매중" : "중지";

                            $info_idx = $row['info_idx'];
                            $printRowspan = false;

                            $tours_idx_array = isset($toursIdxMap[$info_idx]) ? $toursIdxMap[$info_idx] : [];
                            $tours_idx_json = htmlspecialchars(json_encode($tours_idx_array), ENT_QUOTES, 'UTF-8');

                            if (!in_array($info_idx, $printedInfoIdx)) {
                                $printRowspan = true;
                                $printedInfoIdx[] = $info_idx;
                            }
                    ?>
                        <tr style="height:40px">
                            <td><?= $i++ ?></td>

                            <?php if ($printRowspan): ?>
                                <td rowspan="<?= $infoIdxCounts[$info_idx] ?>">
                                    <?= substr($row['o_sdate'], 0, 10) ?>
                                    ~ <?= substr($row['o_edate'], 0, 10) ?>
                                </td>
                            <?php endif; ?>

                            <td>
                                <input type="checkbox" name="yoil_0" <?php if($row['yoil_0'] == "Y") echo "checked"; ?> class="yoil" disabled> 일요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_1" <?php if($row['yoil_1'] == "Y") echo "checked"; ?> class="yoil" disabled> 월요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_2" <?php if($row['yoil_2'] == "Y") echo "checked"; ?> class="yoil" disabled> 화요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_3" <?php if($row['yoil_3'] == "Y") echo "checked"; ?> class="yoil" disabled> 수요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_4" <?php if($row['yoil_4'] == "Y") echo "checked"; ?> class="yoil" disabled> 목요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_5" <?php if($row['yoil_5'] == "Y") echo "checked"; ?> class="yoil" disabled> 금요일&nbsp;&nbsp;
                                <input type="checkbox" name="yoil_6" <?php if($row['yoil_6'] == "Y") echo "checked"; ?> class="yoil" disabled> 토요일&nbsp;&nbsp;
                            </td>
                            <td><?= $row['tours_subject'] ?></td>
                            <td><?= number_format($row["tour_price"], 0) ?></td>
                            <td><?= number_format($row["tour_price_kids"], 0) ?></td>
                            <td><?= number_format($row["tour_price_baby"], 0) ?></td>
                            <td class="tac"><?= substr($row["r_date"], 0, 10) ?></td>
                            <td class="tac"><?= $status ?></td>

                            <?php if ($printRowspan): ?>
                                <td rowspan="<?= $infoIdxCounts[$info_idx] ?>">
                                    <a href="javascript:del_tours('<?= $row["info_idx"] ?>', <?= $tours_idx_json ?>);"
                                    class="btn btn-default">삭제하기</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>

<script>
    
    function del_tours(info_idx, tours_idx_array) {
        if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
            return false;
        }

        $.ajax({
            url: "/AdmMaster/_tours/del_tours",
            type: "POST",
            data: {
                "info_idx": info_idx,
                "tours_idx": tours_idx_array
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data, textStatus) {
                alert(data.message);
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
            }
        });
    }

</script>

<script>
    function add_option(code_idx) {
        var addOption = "";
        addOption += "<tr color='' size='' >												  ";

        addOption += "	<td>																  ";
        addOption += "		<input type='hidden' name='o_idx[]'  value='' />	  ";
        addOption += "		<input type='hidden' name='option_type[]'  value='M' />	  ";
        addOption += "		<input type='file' name='a_file[]'  value='' style='display:none;' />					  ";
        addOption += "		<input type='text' name='o_name[]'  value='' size='70' style='width:48%' />	  ";
        addOption += "		<input type='text' name='o_name_eng[]'  value='' size='70' style='width:48%' />	  ";
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
        addOption += '		<button type="button" style="height: 25px" onclick="delOption(\'\',this)">삭제</button>	  ';
        addOption += "	</td>																  ";
        addOption += "</tr>																	  ";

        $("#settingBody_" + code_idx).append(addOption);
    }

    function upd_moption(code_idx) {
        var message = "";
        $.ajax({

            url: "/AdmMaster/_tourRegist/write_tours/updMoption",
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
        var message = "";
        $.ajax({

            url: "/AdmMaster/_tourRegist/write_tours/addMoption",
            type: "POST",
            data: {
                "product_idx": $("#product_idx").val(),
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

        var message = "";
        $.ajax({

            url: "/AdmMaster/_tourRegist/write_tours/delMoption",
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
        var option_data = jQuery("#optionForm_" + code_idx).serialize();
        var save_result = "";

        $.ajax({
            type: "POST",
            data: option_data,
            url: "/AdmMaster/_tourRegist/write_tours/addOption",
            cache: false,
            success: function (data) {
                var message = data.message;
                alert(message);
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
            }
        });
    }

    // 옵션 삭제 함수
    function delOption(idx, obj) {

        if (!confirm("선택한 옵션을 삭제 하시겠습니까?"))
            return false;

        var message = "";
        $.ajax({

            url: "/AdmMaster/_tourRegist/write_tours/delOption",
            type: "POST",
            data: {
                "idx": idx
            },
            dataType: "json",
            success: function (data) {
                if (data && data.message) {
                    alert(data.message);
                } else {
                    alert("삭제 오류. 다시 시도해주세요.");
                }
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
            }
        });

    }

    // 옵션 수정 함수
    function updOption(idx) {

        if (!confirm("선택한 옵션을 수정 하시겠습니까?"))
            return false;

        var message = "";
        $.ajax({

            url: "/AdmMaster/_tourRegist/write_tours/updOption",
            type: "POST",
            data: {
                "idx"              : idx,
                "option_name"      : $("#o_name_" + idx).val(),
                "option_name_eng"  : $("#o_name_eng_" + idx).val(),
                "option_price"     : $("#o_price_" + idx).val(),
                "use_yn"           : $("#use_yn_" + idx).val(),
                "onum"             : $("#o_num_" + idx).val()
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

<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>