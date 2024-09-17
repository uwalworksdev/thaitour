<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>
                            <li><a href="list?idx=<?= $idx ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>"
                                   class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                            class="txt">리스트</span></a></li>
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

            <form name=frm action="write_ok.php" method=post enctype="multipart/form-data" target="hiddenFrame">
                <input type=hidden name="idx" value='<?= $idx ?>'>
                <input type=hidden name="search_name" value='<?= $search_name ?>'>
                <input type=hidden name="pg" value='<?= $pg ?>'>
                <input type=hidden name="idx" value='<?= $idx ?>'>


                <div id="contents">
                    <div class="listWrap_noline">


                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="40%"/>
                                </colgroup>
                                <tbody>
                                <tr height=45>
                                    <th>등급명</th>
                                    <td>
                                        <input type="text" id="level_name" name="level_name" value="<?= $level_name ?>"
                                               class="input_txt" placeholder="" style="width:400px"/>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>현황</th>
                                    <td>
                                        <input type="radio" name="status"
                                               value="Y" <?php if ($status != "N") echo "checked"; ?> > 사용&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="status"
                                               value="N" <?php if ($status == "N") echo "checked"; ?> > 정지&nbsp;&nbsp;&nbsp;
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

                                    <a href="list?search_name=<?= $search_name ?>&pg=<?= $pg ?>"
                                       class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span
                                                class="txt">리스트</span></a>
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

        function send_it() {
            var frm = document.frm;
            /*
            oEditors1.getById["country_contents"].exec("UPDATE_CONTENTS_FIELD", []);
            if (frm.country_title.value == "")
            {
                frm.country_title.focus();
                alert("제목을 입력하셔야 합니다.");
                return;
            }
            */
            frm.submit();
        }

        function del_it() {
            if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                hiddenFrame.location.href = "del.php?idx[]=<?=$idx?>&mode=view";
            }
        }

        function get_code(strs, depth) {
            $.ajax({
                type: "GET"
                , url: "../_tourLevel/get_code.ajax.php"
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
                        $("#country_code_2").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_2").append("<option value=''>2차분류</option>");
                    }
                    if (depth <= 4) {
                        $("#country_code_3").find('option').each(function () {
                            $(this).remove();
                        });
                        $("#country_code_3").append("<option value=''>3차분류</option>");
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
                        $("#country_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }
    </script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>