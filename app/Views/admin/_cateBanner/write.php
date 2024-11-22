<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
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
            frm.submit();
        }
    </script>


    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>카테고리 배너관리 </h2>
                    <div class="menus">
                        <ul>
                            <li>
                                <a href="javascript:history.back();" class="btn btn-default">
                                    <span class="glyphicon glyphicon-th-list"></span>
                                    <span class="txt">리스트</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <div id="contents">
                <div class="listWrap_noline">
                    <div>
                        <input type=hidden name="code_no" value='<?= $row['code_no'] ?>'>
                        <input type=hidden name="code_idx" value='<?= $code_idx ?>'>
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
                                            <?= $row['code_no'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>코드명</th>
                                        <td>
                                            <?= $row['code_name'] ?>
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
                                    <a href="javascript:show_it()" class="btn btn-default">등록</a>
                                    <a href="javascript:history.back();" class="btn btn-default">
                                        <span class="glyphicon glyphicon-th-list"></span>
                                        <span class="txt">리스트</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <style>
                        div.listBottom table.listTable tbody td {
                            padding: 5px;
                        }
                        #input_file_ko {
                            width: 200px;
                        }
                    </style>
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="70px"/>
                                <col width="100px"/>
                                <col width="70px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="100px"/>
                                <col width="70px"/>
                                <col width="50px"/>
                                <col width="150px"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>구분</th>
                                <th colspan="2">기본 설치</th>
                                <th>PC 이미지</th>
                                <th>모바일 이미지</th>
                                <th>우선순위</th>
                                <th>현황</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <?php
                            $i = 1;
                            foreach ($row3 as $row) {
                                ?>
                                <form name="frm_<?= $i ?>" action="/AdmMaster/_cateBanner/write_ok/<?=$row['cb_idx']?>" method="post" enctype="multipart/form-data" target="hiddenFrame">
                                    <tbody>
                                        <tr style="height:45px;">
                                            <td rowspan="3"><?= $i ?></td>
                                            <td rowspan="3">
                                                <select name="category" id="category">
                                                    <option value="">선택</option>
                                                    <option value="top" <?=$row['category'] == "top" ? "selected" : ""?>>상단배너</option>
                                                    <option value="middle" <?=$row['category'] == "middle" ? "selected" : ""?>>중간배너</option>
                                                    <option value="bottom" <?=$row['category'] == "bottom" ? "selected" : ""?>>하단배너</option>
                                                </select>
                                            </td>
                                            <td>URL</td>
                                            <td>
                                                <input type="text" name="url" value="<?= $row["url"] ?>" style="width: 200px;">
                                            </td>
                                            <td rowspan="3" style="vertical-align: top;">
                                                <input type="file" name="ufile1" class="bbs_inputbox_pixel" style="width:200px"/>
                                                <a href="/data/cate_banner/<?= $row["ufile1"] ?>" class="imgpop">
                                                <img src="/data/cate_banner/<?= $row["ufile1"] ?>" style="max-height:200px;max-width:200px"></a>
                                            </td>
                                            <td rowspan="3" style="vertical-align: top;">
                                                <input type="file" name="ufile2" class="bbs_inputbox_pixel" style="width:200px"/>
                                                <a href="/data/cate_banner/<?= $row["ufile12"] ?>" class="imgpop">
                                                <img src="/data/cate_banner/<?= $row["ufile2"] ?>" style="max-height:200px;max-width:200px"></a>
                                            </td>
                                            <td rowspan="3">
                                                <input type="text" name="onum" class="bbs_inputbox_pixel" style="width:50px" value="<?= $row["onum"] ?>"/>
                                            </td>
                                            <td rowspan="3">
                                                <input type="checkbox" name="use_yn" value="Y" <?= $row["use_yn"] == "Y" ? "checked" : ""?>>
                                            </td>
                                            <td rowspan="3">
                                                <a href="javascript:document.frm_<?= $i ?>.submit();" class="btn btn-default">
                                                    <span class="glyphicon glyphicon-cog"></span>
                                                    <span class="txt">수정</span>
                                                </a>
                                                <a href="javascript:file_del_it('<?= $row["cb_idx"] ?>')" class="btn btn-default">
                                                    <span class="glyphicon glyphicon-cog"></span>
                                                    <span class="txt">삭제</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>제목</td>
                                            <td>
                                                <input type="text" name="title" value="<?= $row["title"] ?>" style="width: 200px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>서브제목</td>
                                            <td>
                                                <input type="text" name="subtitle" value="<?= $row["subtitle"] ?>" style="width: 200px;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </form>
                                <?php
                                $i = $i + 1;
                            } ?>
                        </table>

                    </div>
                    <!-- // listWrap -->

                </div>
                <!-- // contents -->
            </div><!-- 인쇄 영역 끝 //-->
        </div>
        <!-- // container -->
        <div class="pick_item_pop02" id="item_pop" style="display:none;">
            <div>
                <h2>이벤트 상품등록</h2>
                <div class="listBottom table_box">
                    <form action="write_ok" method="post" name="write_frm" id="write_frm" enctype="multipart/form-data" target="hiddenFrame">
                        <input type="hidden" name="code_no" value="<?=$row['code_no']?>">
                        <input type="hidden" name="code_idx" value="<?=$code_idx?>">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <colgroup>
                            <col width="10%"/>
                            <col width="90%"/>
                            </colgroup>
                            <tbody>
                                <!-- <tr>
                                    <th>코드명</th>
                                    <td>
                                        <input type="text" id="code_name" name="code_name" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr> -->
                                <tr>
                                    <th>구분</th>
                                    <td>
                                        <select name="category" id="category">
                                            <option value="">선택</option>
                                            <option value="top">상단배너</option>
                                            <option value="middle">중간배너</option>
                                            <option value="bottom">하단배너</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td>
                                        <input type="text" id="url" name="url" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>제목</th>
                                    <td>
                                        <input type="text" id="title" name="title" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>서브제목</th>
                                    <td>
                                        <input type="text" id="subtitle" name="subtitle" class="input_txt" style="width:90%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>PC 이미지</th>
                                    <td>
                                        <input type="file" id="ufile1" name="ufile1" class="input_txt" style="width:20%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>모바일 이미지</th>
                                    <td>
                                        <input type="file" id="ufile2" name="ufile2" class="input_txt" style="width:20%"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>현황</th>
                                    <td>
                                        <input type="radio" name="use_yn" value="Y" checked> 사용&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="use_yn" value="N"> 마감&nbsp;&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <th>우선순위</th>
                                    <td>
                                        <input type="text" id="onum" name="onum" value="<?= $onum ?>" class="input_txt" style="width:100px"/> (숫자가 높을수록 상위에 노출됩니다.)
                                    </td>
                                </tr>
                            </tbody>
                        
                        </table>
                    </form>
                </div>
                <div class="sel_box">
                    <button type="button" class="close">닫기</button>
                    <button type="submit" form="write_frm" class="search">등록</button>
                </div>
            </div>
        </div>
        <script>

            function show_it(cb_idx = null) {
                $("#item_pop").show();
            }
            $(".close").click(function () {
                $("#item_pop").hide();
            });

            function file_del_it(cb_idx) {
                if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                    $.ajax({
                        url: "file_del?cb_idx=" + cb_idx,
                        type: "DELETE",
                        success: function () {
                            location.reload();
                        }
                    })
                }

            }
        </script>
        <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>