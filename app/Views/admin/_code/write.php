<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="/lib/smarteditor/js/HuskyEZCreator.js"></script>
<script type="text/javascript">
    function checkForNumber(str) {
        var key = event.keyCode;
        var frm = document.frm1;
        if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
            (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
            event.returnValue = false;
        }
    }

    function send_it() {
        var frm = document.frm;
        if (frm.code_name.value == "") {
            frm.code_name.focus();
            alert("코드명을 입력하셔야 합니다.");
            return;
        }

        frm.submit();
    }
</script>


<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>코드 <?= $titleStr ?></h2>
                <div class="menus">
                    <ul>
                        <li><a href="javascript:history.back();" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
                        <?php if ($code_idx) { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
                            <?php if ($depth == 0) { ?>
                                <li><a href="javascript:del_it('<?= $code_idx ?>')" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span
                                                class="txt">삭제</span></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a></li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
            <!-- // inner -->

        </header>
        <!-- // headerContainer -->

        <form name=frm action="write_ok" method=post enctype="multipart/form-data" target="hiddenFrame">
            <input type=hidden name="code_idx" value='<?= $code_idx ?>'>
            <input type=hidden name="code_no" value='<?= $code_no ?>'>
            <input type=hidden name="depth" value='<?= $depth ?>'>
            <input type=hidden name="parent_code_no" value='<?= $parent_code_no ?>'>
            <input type=hidden name="product_idx" value='<?= $product_idx ?>'>
            <input type=hidden name="yoil_idx" value='<?= $yoil_idx ?>'>
            <div id="contents">
                <div class="listWrap_noline">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                            <tr>
                                <th>코드NO</th>
                                <td>
                                    <?= $code_no ?>
                                </td>
                            </tr>
                            <?php if ($parent_code_no == "0" && $code_idx == "") { ?>
                                <tr>
                                    <th>코드구분</th>
                                    <td>
                                        <input type="text" id="code_gubun" name="code_gubun" value="<?= $code_gubun ?>"
                                               class="input_txt" style="width:100px;ime-mode:disabled"/> (영문으로만)
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <input type="hidden" id="code_gubun" name="code_gubun" value="<?= $code_gubun ?>"
                                       class="input_txt" style="width:100px;ime-mode:disabled"/>
                            <?php } ?>
                            <tr>
                                <th>코드명</th>
                                <td>
                                    <input type="text" id="code_name" name="code_name" value="<?= $code_name ?>"
                                           class="input_txt" style="width:90%"/>
                                </td>
                            </tr>
                            <?php if ($parent_code_no === '35' || $parent_code_no === '4403') : ?>
                                <tr>
                                    <th>거리</th>
                                    <td>
                                        <input type="text" id="distance" name="distance" value="<?= $distance ?>"
                                               class="input_txt"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>유형</th>
                                    <td>
                                        <input type="text" id="type" name="type" value="<?= $type ?>"
                                               class="input_txt"/>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($parent_code_no === '51') : ?>
                                <tr>
                                    <th>설명하다</th>
                                    <td>
                                        <input type="text" id="code_memo" name="code_memo" value="<?= $code_memo ?>"
                                               class="input_txt"/>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($parent_code_no != 14) : ?>
                            <tr>
                                <th>이미지</th>
                                <td>
                                    <input type="file" id="ufile1" name="ufile1" class="input_txt" style="width:20%"/>

                                    <?php if ($ufile1 && $rfile1) { ?>
                                        <img src="/data/code/<?= $ufile1 ?>">
                                        <input type="checkbox" name="del_1" value="Y">
                                        <a href="/data/code/<?= $ufile1 ?>"
                                           class="imgpop cboxElement"><?= $rfile1 ?></a>
                                    <?php } ?>

                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php
                            if ($parent_code_no == 14) {
                                ?>
                                <tr>
                                    <th>
                                        비행 
                                        <button type="button" onclick="add_op_flight();" class="btn_01">추가</button>
                                    </th>
                                    <td>
                                        <table>
                                            <colgroup>
                                                <col width="*">
                                                <col width="40%">
                                                <col width="40%">
                                                <col width="10%">
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>항공번호</th>
                                                <th>출발지 / 출발시간</th>
                                                <th>도착지 / 도착시간</th>
                                                <th>삭제</th>
                                            </tr>
                                            </thead>
                                            <tbody id="flight_wrap">
                                                <?php
                                                    foreach($flight_arr as $flight){
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="f_idx[]" value="<?=$flight["f_idx"]?>">
                                                            <input type="text" name="code_flight[]" class="code_flight" maxlength="10" value="<?=$flight["code_flight"]?>">
                                                        </td>
                                                        <td>
                                                            <div style="display: flex; gap: 10px;">
                                                                <input type="text" name="f_depature_name[]" class="f_depature_name" value="<?=$flight["f_depature_name"]?>">
                                                                <input type="time" name="f_depature_time[]" class="f_depature_time" value="<?=$flight["f_depature_time"]?>">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="display: flex; gap: 10px;">
                                                                <input type="text" name="f_destination_name[]" class="f_destination_name" value="<?=$flight["f_destination_name"]?>">
                                                                <input type="time" name="f_destination_time[]" class="f_destination_time" value="<?=$flight["f_destination_time"]?>">
                                                            </div>
                                                        </td>      
                                                        <td>
                                                            <button type="button" onclick="del_op_flight('<?=$flight['f_idx']?>',this)" class="btn_02">
                                                                삭제
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php   
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <th>현황</th>
                                <td>
                                    <input type="radio" name="status"
                                           value="Y" <?php if ($status == "Y" || $status == "") {
                                        echo "checked";
                                    } ?>> 사용&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="status" value="C" <?php if ($status == "C") {
                                        echo "checked";
                                    } ?>> 마감&nbsp;&nbsp;&nbsp;
                                    <!--input type="radio" name="status" value="N" <?php if ($status == "N") {
                                        echo "checked";
                                    } ?>> 삭제-->
                                </td>
                            </tr>

                            <tr>
                                <th>우선순위</th>
                                <td>
                                    <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt"
                                           style="width:100px"/> (숫자가 높을수록 상위에 노출됩니다.)
                                </td>
                            </tr>
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
                                <?php if ($code_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                    <?php if ($depth == 0) { ?>
                                        <a href="javascript:del_it('<?= $code_idx ?>')" class="btn btn-default"><span
                                                    class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                    <?php } ?>
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
    function handle_delete_row(obj) {
        // let rowCount = $(obj).closest("tbody").find("tr").length;
        // if (rowCount == 1) {
        //     $(obj).closest("table").remove();
        // } else {
        //     $(obj).closest("tr").remove();
        // }

        $(obj).closest("tr").remove();
    }

    function del_op_flight(idx, el) {
        if (idx && idx !== "") {
            if (confirm("정말 삭제하시겠습니까?")) {
                $.ajax({
                    url: "delete_flight",
                    type: "POST",
                    data: "idx=" + idx,
                    error: function (request, status, error) {
                        alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    }
                    , success: function (response, status, request) {
                        alert(response.message);
                        handle_delete_row(el);
                    }
                });
            }
        } else {
            handle_delete_row(el);
        }
    }

    function add_op_flight() {
        let html = `
            <tr>
                <td>
                    <input type="hidden" name="f_idx[]" value="">
                    <input type="text" name="code_flight[]" class="code_flight" maxlength="10" value="">
                </td>
                <td>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="f_depature_name[]" class="f_depature_name" value="">
                        <input type="time" name="f_depature_time[]" class="f_depature_time">
                    </div>
                </td>
                <td>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="f_destination_name[]" class="f_destination_name" value="">
                        <input type="time" name="f_destination_time[]" class="f_destination_time">
                    </div>
                </td>      
                <td>
                    <button type="button" onclick="del_op_flight('',this)" class="btn_02">
                        삭제
                    </button>
                </td>
            </tr>
        `;

        $("#flight_wrap").append(html);
    }

    function del_it(idx) {

        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
            return false;

        var message = "";
        $.ajax({

            url: "del",
            type: "POST",
            data: {
                "code_idx": idx
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data, textStatus) {
                message = data.message;
                alert(message);
                location.href = '/AdmMaster/_code/list';
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });

    }
</script>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>

