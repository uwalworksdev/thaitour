<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="/js/admin/tours/write.js"></script>

<?php
if (isset($product_idx) && isset($row)) {
    foreach ($row as $keys => $vals) {
        ${$keys} = $vals;
    }
}
?>
    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2><?= $titleStr ?></h2>
                    <div class="menus">
                        <ul>

                            <li><a href="/AdmMaster/_tourRegist/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <?php if ($product_idx) { ?>
                                <li><a href="javascript:copy_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">제품복사</span></a>
                                </li>
                                <script>
                                    function copy_it() {
                                        if (confirm("제품을 복사하시겠습니까?")) {
                                            location.href = "copy2.php?g_idx=<?= $product_idx ?>";
                                        }
                                    }
                                </script>
                            <?php } ?>
                            <?php if (isset($idx)) { ?>
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
                    <form name="frm" id="frm" action="hwrite_ok.php" method="post" enctype="multipart/form-data"
                          target="hiddenFrame22"> <!--  -->
                        <!-- 상품 고유 번호 -->
                        <input type="hidden" name="g_idx" id="g_idx" value=''/>
                        <!-- 상품 카테고리 -->
                        <input type="hidden" name="product_code" id="product_code" value=''/>

                        <!-- 상품 옵션 -->
                        <input type="hidden" name="product_option" id="product_option" value=''
                               style="width:500px;">

                        <!-- db에 있는 goods_code -->
                        <input type="hidden" name="old_goods_code" id="old_goods_code" value=''>
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
                                <tr height="45">
                                    <td colspan="4">
                                        기본정보
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>카테고리선택</th>
                                    <td colspan="3">
                                        <select id="product_code_1" name="product_code_1" class="input_select"
                                                onchange="javascript:get_code(this.value, 2)">
                                            <option value="">1차분류</option>
                                        </select>
                                        <select id="product_code_2" name="product_code_2" class="input_select"
                                                onchange="javascript:get_code(this.value, 3)">
                                            <option value="">2차분류</option>
                                        </select>
                                        <select id="product_code_3" name="product_code_3" class="input_select"
                                                onchange="javascript:get_code(this.value, 4)">
                                            <option value="">3차분류</option>
                                        </select>
                                        <select id="product_code_4" name="product_code_4" class="input_select">
                                            <option value="">4차분류</option>
                                        </select>
                                        <button type="button" id="btn_reg_cate" class="btn_01">등록</button>
                                    </td>
                                </tr>
                                <?php

                                ?>
                                <tr height="48">
                                    <th>등록된 카테고리</th>
                                    <td colspan="3">
                                    </td>
                                </tr>

                                <tr height="45">
                                    <th>상품코드</th>
                                    <td colspan="3">
                                        <input type="text" name="goods_code" id="goods_code" value=""
                                               readonly="readonly" class="text" style="width:200px">
                                        <?php if ($product_idx == "") { ?>
                                            <button type="button" class="btn_01" onclick="fn_pop('code');">코드입력</button>
                                        <?php } else { ?>
                                            <span style="color:red;">상품코드는 수정이 불가능합니다.</span>
                                        <?php } ?>

                                    </td>

                                </tr>
                                <tr height="45">
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="goods_name_front" value=""
                                               class="text" style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr height="45">
                                    <th>등급</th>
                                    <td colspan="3">
                                        <select name="grade">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>주소</th>
                                    <td colspan="3">
                                        <input type="text" name="addrs" value="" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>위치</th>
                                    <td colspan="3">
                                        <input type="text" name="locations" value="" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>객실수</th>
                                    <td colspan="3">
                                        <input type="text" name="room_cnt" value="" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr height="45">
                                    <th>체크인/아웃</th>
                                    <td colspan="3">
                                        <input type="text" name="chkIn" value="" class="text"
                                               style="width:300px" maxlength="50"/>
                                    </td>
                                </tr>

                                <tr height="45">
                                    <th>간략소개</th>
                                    <td colspan="3">
										<textarea name="oneInfo" id="oneInfo"
                                                  style="width:90%;height:100px;"></textarea>
                                    </td>
                                </tr>

                                <tr height="45">
                                    <th>검색어</th>
                                    <td colspan="3">
                                        <input type="text" name="goods_keyword" id="goods_keyword"
                                               value="" class="text" style="width:90%;"
                                               maxlength="100"/><br/>
                                        <span style="color:red;">검색어는 콤마(,)로 구분하셔서 입력하세요. 입력예)자켓,방풍자켓,기능성자켓</span>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>노출</th>
                                    <td colspan="3">
                                        <input type="checkbox" name="goods_dis3" id="goods_dis3" value="Y"> <label
                                                for="goods_dis3"
                                                style="max-height:200px;margin-right:20px;">BEST
                                            인기호텔</label>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>판매상태결정</th>
                                    <td colspan="3">
                                        <select name="item_state" id="item_state">
                                            <option value="sale">판매중</option>
                                            <option value="stop">판매중지</option>
                                            <option value="plan">등록예정</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>관리자메모</th>
                                    <td colspan="3">
										<textarea name="admin_memo" id="admin_memo"
                                                  style="width:90%;height:100px;"></textarea>
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
                                <tr height="45">
                                    <td colspan="4">
                                        가격
                                    </td>
                                </tr>

                                <tr height="45">
                                    <th>최초가격(정찰가)</th>
                                    <td colspan="3">
                                        <input type="text" name="price_mk" id="price_mk" class="onlynum"
                                               style="text-align:right;" value=""/> 원
                                    </td>

                                </tr>

                                <tr height="45">
                                    <th>판매가격</th>
                                    <td colspan="3">
                                        <input type="text" name="price_se" id="price_se" class="onlynum"
                                               style="text-align:right;" value=""/> 원
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

                                <tr height="45">
                                    <th>호텔선택</th>
                                    <td>
                                        <select id="hotel_code" name="hotel_code" class="input_select"
                                                onchange="fn_chgRoom(this.value)">
                                            <option value="">선택</option>
                                        </select> <span>(호텔을 선택해야 옵션에서 룸을 선택할 수 있습니다.)</span>
                                    </td>
                                </tr>
                                <tr height="45">
                                    <th>
                                        객실등록
                                        <p style="display:block;margin-top:10px;">
                                            <select name="roomIdx" id="roomIdx">

                                            </select>
                                            <button type="button" id="btn_add_option" class="btn_01">추가</button>
                                        </p>
                                    </th>
                                    <td>
									<span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다. /
										마감날짜 예시) [ 2019-10-15||2019-10-17 ] Y-m-d 형식으로 || 를 구분자로 사용해주세요.</span>
                                        <div id="mainRoom">
                                            <table>
                                                <colgroup>
                                                    <col width="*">
                                                    </col>
                                                    <col width="25%">
                                                    </col>
                                                    <col width="10%">
                                                    </col>
                                                    <col width="30%">
                                                    </col>
                                                    <col width="10%">
                                                    </col>
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>객실명</th>
                                                    <th>기간</th>
                                                    <th>가격</th>
                                                    <th>마감날짜</th>
                                                    <th>삭제</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tblroom">
                                                <tr color='' size=''>

                                                    <td>
                                                        <input type='hidden' name='o_idx[]'
                                                               value=''/>
                                                        <input type='hidden' name='option_type[]'
                                                               value=''/>
                                                        <input type='hidden' name='o_room[]' id=''
                                                               value="" size="70"/>
                                                        <input type='hidden' name='o_name[]' id=''
                                                               value="" size="70"/>
                                                    </td>
                                                    <td>
                                                        <input type='text' readonly class='datepicker '
                                                               name='o_sdate[]'
                                                               value=''/> ~
                                                        <input type='text' readonly class='datepicker '
                                                               name='o_edate[]'
                                                               value=''/>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='onlynum' name='o_price1[]'
                                                               id=''
                                                               value=""/>
                                                    </td>

                                                    <td>
                                                        <input type='text' class='' name='o_soldout[]' id=''
                                                               style='width:100%;'
                                                               value=""/>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                                onclick="delOption('',this)">
                                                            삭제
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>


                                <tr height="45">
                                    <th>
                                        추가옵션등록
                                        <p style="display:block;margin-top:10px;">
                                            <button type="button" id="btn_add_option2" class="btn_01">추가</button>
                                        </p>
                                    </th>
                                    <td>
										<span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에
											삭제바랍니다.</span>
                                        <div>
                                            <table>
                                                <colgroup>
                                                    <col width="*">
                                                    </col>
                                                    <col width="25%">
                                                    </col>
                                                    <col width="15%">
                                                    </col>
                                                </colgroup>
                                                <thead>
                                                <tr>
                                                    <th>옵션명</th>
                                                    <th>가격</th>
                                                    <th>삭제</th>
                                                </tr>
                                                </thead>
                                                <tbody id="settingBody2">


                                                <tr color='' size=''>
                                                    <td>
                                                        <input type='hidden' name='o_idx[]'
                                                               value=''/>
                                                        <input type='hidden' name='option_type[]'
                                                               value=''/>
                                                        <input type='text' name='o_name[]' id=''
                                                               value="" size="70"/>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='onlynum' name='o_price1[]' id=''
                                                               value=""/>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                                onclick="delOption('',this)">삭제
                                                        </button>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
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

                                        <input type="file" name="ufile1" class="bbs_inputbox_pixel"
                                               style="width:500px;margin-bottom:10px"/>
                                        <?php if (isset($ufile1) && $ufile1 != "") { ?><br>파일삭제:<input type=checkbox name="del_1"
                                                                                     value='Y'><a
                                                href="/data/product/<?= $ufile1 ?>"
                                                class="imgpop"><?= $rfile1 ?></a><br><br>
                                            <?php $imgs = get_img($ufile1, "/data/product/", "200", "200"); ?>
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
                                            <?php if (isset(${"ufile" . $i}) && ${"ufile" . $i} != "") { ?><br>파일삭제:<input type=checkbox
                                                                                                 name="del_<?= $i ?>"
                                                                                                 value='Y'><a
                                                    href="/data/product/<?= ${"ufile" . $i} ?>"
                                                    class="imgpop"><?= ${"rfile" . $i} ?></a><br><br>
                                                <?php $imgs = get_img(${"ufile" . $i}, "/data/product/", "200", "200"); ?>
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

                                <tr height="45">
                                    <td colspan="2">
                                        상품 상세설명
                                    </td>
                                </tr>

                                <tr height="45">
                                    <td colspan="2">

										<textarea name="content" id="content" rows="10" cols="100" class="input_txt"
                                                  style="width:100%; height:1200px; display:none;"</textarea>

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
                                                  style="width:100%; height:1200px; display:none;"></textarea>

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
                                                  style="width:100%; height:400px; display:none;"></textarea>

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
                                <a href="/AdmMaster/_tourRegist/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <?php if (isset($idx) == "") { ?>
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