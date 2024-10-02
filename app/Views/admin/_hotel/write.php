<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="/js/admin/tours/write.js"></script>

<?php
if (isset($g_idx) && isset($row)) {
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

                            <li><a href="/AdmMaster/_goods/hlist.php" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($g_idx) { ?>
                                <li><a href="javascript:copy_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">제품복사</span></a>
                                </li>
                                <script>
                                    function copy_it() {
                                        if (confirm("제품을 복사하시겠습니까?")) {
                                            location.href = "copy2.php?g_idx=<?= $g_idx ?>";
                                        }
                                    }
                                </script>
                            <?php } ?>
                            <?php if ($g_idx) { ?>
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
                    <form name="frm" id="frm" action="<?= route_to('admin._hotel.write_ok') ?>" method="post"
                          enctype="multipart/form-data"
                          target="hiddenFrame22"> <!--  -->
                        <!-- 상품 고유 번호 -->
                        <input type="hidden" name="g_idx" id="g_idx" value='<?= $g_idx ?>'/>
                        <!-- 상품 카테고리 -->
                        <input type="hidden" name="product_code" id="product_code" value='<?= $product_code ?? "" ?>'/>

                        <!-- 상품 옵션 -->
                        <input type="hidden" name="product_option" id="product_option"
                               value='<?= $product_option ?? "" ?>'
                               style="width:500px;">

                        <!-- db에 있는 goods_code -->
                        <input type="hidden" name="old_goods_code" id="old_goods_code" value='<?= $goods_code ?? "" ?>'>
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
                                    <th>카테고리선택</th>
                                    <td colspan="3">
                                        <select id="product_code_1" name="product_code_1" class="input_select">
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
                                                <option value="<?= $frow["code_no"] ?>"><?= $frow["code_name"] ?>
                                                    <?= $status_txt ?></option>
                                            <?php } ?>
                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select">
                                            <option value="">2차분류</option>
                                            <?php
                                            foreach ($fresult2 as $frow) {
                                                $status_txt = "";
                                                if ($frow["status"] == "Y") {
                                                    $status_txt = "";
                                                } elseif ($frow["status"] == "N") {
                                                    $status_txt = "[삭제]";
                                                } elseif ($frow["status"] == "C") {
                                                    $status_txt = "[마감]";
                                                }
                                                ?>
                                                <option value="<?= $frow["code_no"] ?>"><?= $frow["code_name"] ?>
                                                    <?= $status_txt ?></option>
                                            <?php } ?>
                                        </select>
                                        <button type="button" id="btn_reg_cate" class="btn_01">등록</button>
                                    </td>
                                </tr>
                                <?php
                                $_product_code_arr = explode("||", getCodeSlice($product_code ?? ""));
                                ?>
                                <tr>
                                    <th>등록된 카테고리</th>
                                    <td colspan="3">
                                        <ul id="reg_cate">
                                            <?php
                                            if (!empty($product_code)) {
                                                foreach ($_product_code_arr as $_tmp_code) {
                                                    ?>

                                                    <li>[<?= $_tmp_code ?>] <?= get_cate_text($_tmp_code) ?> <span
                                                                onclick="delCategory('<?= $_tmp_code ?>', this);">삭제</span>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품코드</th>
                                    <td colspan="3">
                                        <input type="text" name="goods_code" id="goods_code"
                                               value="<?= $goods_code ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if (empty($g_idx) || empty($goods_code)) { ?>
                                            <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button>
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>

                                    </td>

                                </tr>
                                <tr>
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="goods_name_front"
                                               value="<?= $goods_name_front ?? "" ?>"
                                               class="text" style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>등급</th>
                                    <td colspan="3">
                                        <select name="grade">
                                            <option value="1" <?php if (isset($grade) && $grade === "1")
                                                echo "selected"; ?>>1
                                            </option>
                                            <option value="2" <?php if (isset($grade) && $grade === "2")
                                                echo "selected"; ?>>2
                                            </option>
                                            <option value="3" <?php if (isset($grade) && $grade === "3")
                                                echo "selected"; ?>>3
                                            </option>
                                            <option value="4" <?php if (isset($grade) && $grade === "4")
                                                echo "selected"; ?>>4
                                            </option>
                                            <option value="5" <?php if (isset($grade) && $grade === "5")
                                                echo "selected"; ?>>5
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" name="addrs" value="<?= $addrs ?? "" ?>" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>위치</th>
                                    <td colspan="3">
                                        <input type="text" name="locations" value="<?= $locations ?? "" ?>" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>객실수</th>
                                    <td colspan="3">
                                        <input type="text" name="room_cnt" value="<?= $room_cnt ?? "" ?>" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>체크인/아웃</th>
                                    <td colspan="3">
                                        <input type="text" name="chkIn" value="<?= $chkIn ?? "" ?>" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>간략소개</th>
                                    <td colspan="3">
										<textarea name="oneInfo" id="oneInfo"
                                                  style="width:90%;height:100px;"><?= $oneInfo ?? "" ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <th>검색키워드</th>
                                    <td colspan="3">
                                        <input type="text" name="goods_keyword" id="goods_keyword"
                                               value="<?= $goods_keyword ?? "" ?>" class="text" style="width:90%;"
                                               maxlength="100"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)자켓,방풍자켓,기능성자켓</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>노출</th>
                                    <td colspan="3">
                                        <input type="checkbox" name="goods_dis3" id="goods_dis3" value="Y"
                                            <?php if (isset($goods_dis3) && $goods_dis3 === "Y")
                                                echo "checked=checked"; ?>> <label for="goods_dis3"
                                                                                   style="max-height:200px;margin-right:20px;">BEST
                                            인기호텔</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>판매상태결정</th>
                                    <td colspan="3">
                                        <select name="item_state" id="item_state">
                                            <option value="sale" <?php if (isset($item_state) && $item_state === "sale") {
                                                echo "selected";
                                            } ?>>판매중
                                            </option>
                                            <option value="stop" <?php if (isset($item_state) && $item_state === "stop") {
                                                echo "selected";
                                            } ?>>판매중지
                                            </option>
                                            <option value="plan" <?php if (isset($item_state) && $item_state === "plan") {
                                                echo "selected";
                                            } ?>>등록예정
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>관리자메모</th>
                                    <td colspan="3">
										<textarea name="admin_memo" id="admin_memo"
                                                  style="width:90%;height:100px;"><?= $admin_memo ?? "" ?></textarea>
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
                                        가격
                                    </td>
                                </tr>

                                <tr>
                                    <th>최초가격(정찰가)</th>
                                    <td colspan="3">
                                        <input type="text" name="price_mk" id="price_mk" class="onlynum"
                                               style="text-align:right;width: 200px;" value="<?= $price_mk ?? "" ?>"/> 원
                                    </td>

                                </tr>

                                <tr>
                                    <th>판매가격</th>
                                    <td colspan="3">
                                        <input type="text" name="price_se" id="price_se" class="onlynum"
                                               style="text-align:right;width: 200px;" value="<?= $price_se ?? "" ?>"/> 원
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

                                <tr>
                                    <th>대표이미지(600X400)</th>
                                    <td colspan="3">

                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                               style="width:500px;margin-bottom:10px"/>
                                        <?php if (isset($ufile1) && $ufile1 !== "") { ?><br>파일삭제:<input type=checkbox
                                                                                                        name="del_1"
                                                                                                        value='Y'><a
                                                href="/uploads/hotel/<?= $ufile1 ?>"
                                                class="imgpop"><?= $rfile1 ?></a><br><br>
                                            <?php $imgs = get_img($ufile1, "/uploads/hotel/", "200", "200"); ?>
                                            <img src="<?= $imgs ?>"/>
                                        <?php } ?>

                                    </td>
                                </tr>


                                <?php for ($i = 2; $i <= 6; $i++) { ?>
                                    <tr>
                                        <th>서브이미지<?= $i - 1 ?>(600X400)</th>
                                        <td colspan="3">

                                            <input type="file" name="ufile<?= $i ?>" class="bbs_inputbox_pixel"
                                                   style="width:500px;margin-bottom:10px"/>
                                            <?php if (isset(${"ufile" . $i}) && ${"ufile" . $i} !== "") { ?><br>파일삭제:
                                                <input type=checkbox
                                                       name="del_<?= $i ?>"
                                                       value='Y'><a
                                                        href="/uploads/hotel/<?= ${"ufile" . $i} ?>"
                                                        class="imgpop"><?= ${"rfile" . $i} ?></a><br><br>
                                                <?php $imgs = get_img(${"ufile" . $i}, "/uploads/hotel/", "200", "200"); ?>
                                                <img src="<?= $imgs ?>"/>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
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
                                        상품 상세설명
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2">

										<textarea name="content" id="content" rows="10" cols="100" class="input_txt"
                                                  style="width:100%; height:1200px; display:none;"><?= viewSQ($content ?? '') ?></textarea>

                                        <script type="text/javascript">
                                            var oEditors1 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors1,
                                                elPlaceHolder: "content",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
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
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>

                                <tr height=45>
                                    <td colspan="2">
                                        여행일정
                                    </td>
                                </tr>

                                <tr height=45>
                                    <td colspan="2">

										<textarea name="c_calendar" id="c_calendar" rows="10" cols="100"
                                                  class="input_txt"
                                                  style="width:100%; height:1200px; display:none;"><?= viewSQ($c_calendar ?? '') ?></textarea>

                                        <script type="text/javascript">
                                            var oEditors3 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors3,
                                                elPlaceHolder: "c_calendar",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
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
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%"/>
                                    <col width="90%"/>
                                </colgroup>
                                <tbody>

                                <tr height=45>
                                    <td colspan="2">
                                        취소/환불규정
                                    </td>
                                </tr>

                                <tr height=45>
                                    <td colspan="2">

										<textarea name="caution" id="caution" rows="10" cols="100" class="input_txt"
                                                  style="width:100%; height:400px; display:none;"><?= viewSQ($caution ?? '') ?></textarea>

                                        <script type="text/javascript">
                                            var oEditors2 = [];

                                            // 추가 글꼴 목록
                                            //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

                                            nhn.husky.EZCreator.createInIFrame({
                                                oAppRef: oEditors2,
                                                elPlaceHolder: "caution",
                                                sSkinURI: "/smarteditor/SmartEditor2Skin.html",
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
                            <!--
                        <p class="result_text">요청하신 <strong>상품코드</strong>는 사용 <span>가능</span> 합니다.</p>
                        -->
                            <div class="btn_box">
                                <p class="ok_btn">사용</p><span>|</span>
                                <p class="close_btn">닫기</p>
                            </div>
                        </div>
                    </div>


                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">
                                <a href="/AdmMaster/_goods/hlist.php" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if ($g_idx === "") { ?>
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
<?= $this->endSection() ?>