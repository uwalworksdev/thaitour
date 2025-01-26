<?php

use App\Controllers\Admin\AdminHotelController;

?>

<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
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

        .head_table {
            display: flex;
            justify-content: space-between;
        }
        .btns_setting {
            display: inline-block;
            float: right;
            margin-top: 6px;
        }

        button {
            height: 31px;
        }

    </style>
	
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
	
    <script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
    <script type="text/javascript" src="/js/admin/tours/write.js"></script>

<?php
if (isset($product_idx) && isset($row)) {
    foreach ($row as $keys => $vals) {
        ${$keys} = $vals;
    }
}

$titleStr = "호텔정보 수정";
$links = "list";
?>
<?php echo view("/admin/_hotel/inc/map/js_map.php", ['fresult10' => $fresult10, 'fresult11' => $fresult11]); ?>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2>호텔가격 상세정보</h2>
                    <div class="menus">
                        <ul>
                            <li><a href="/AdmMaster/_hotel/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            </li>
                            <li><a href="javascript:send_it_price()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // inner -->

            </header>
            <!-- // headerContainer -->

            <div id="contents">
                <div class="listWrap_noline">
                    <!--  target="hiddenFrame22"  -->
                    <form name="frm" id="frm" action="<?= route_to('admin.api.hotel_.write_price_ok') ?>" method="post"
                          enctype="multipart/form-data"
                          target="hiddenFrame22">
                        <!-- 상품 고유 번호 -->
                        <input type="hidden" name="code_populars" id="code_populars"
                               value='<?= $code_populars ?? "" ?>'/>

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
                        <input type="hidden" name="product_idx" id="product_idx"
                               value='<?= $product_idx ?>'>

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
                                    <th>상품명</th>
                                    <td colspan="3">
                                        <input type="text" name="product_name" readonly="readonly"
                                               value="<?= $product_name ?? "" ?>"
                                               class="text" style="width:100%" maxlength="100"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th>상품코드</th>
                                    <td colspan="3">
                                        <input type="text" name="product_code" id="product_code"
                                               value="<?= $product_code_no ?? "" ?>"
                                               readonly="readonly" class="text" style="width:200px">
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="10%">
                                    <col width="40%">
                                    <col width="10%">
                                    <col width="40%">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        룸정보
										<button type="button" class="btn_select_room_list" onclick="showOrHide();" style="width : 90px ;background-color : #4f728a; color : #fff">룸타입 추가</button>
                                    </td>
                                </tr>

                                <tr>
                                    <th>룸타입 등록</th>
                                    <td colspan="3">
									
                                    <?php foreach ($roomresult as $row) : ?>
										<div class="item_" style="margin-bottom: 10px;">
											<input readonly="" type="text" value="<?=$row['roomName']?>" style="width:50%">
											<button class="btn_del" onclick="removeRoomSelect(this, <?=$row['roomType_idx']?>)" type="button" style="width: 50px; background-color: #4f728a; color : #fff;">삭제</button>
											<button class="btn_set" onclick="updateRoomSelect(this, <?=$row['roomType_idx']?>)" type="button" style="width: 50px ; background-color: #d03a3e; color : #fff;">수정</button>
										</div>
                                    <?php endforeach; ?>
									
										<!--div class="item_" style="margin-bottom: 10px;">
											<input readonly="" type="text" value="Test123" style="width:50%">
											<button class="btn_del" onclick="removeRoomSelect(this, 80)" type="button" style="width: 50px; background-color: #4f728a; color : #fff;">삭제</button>
											<button class="btn_set" onclick="updateRoomSelect(this, 80)" type="button" style="width: 50px ; background-color: #d03a3e; color : #fff;">수정</button>
										</div>


										<div class="item_" style="margin-bottom: 10px;">
											<input readonly="" type="text" value="테스트 상품 phong-룸-1" style="width:50%">
											<button class="btn_del" onclick="removeRoomSelect(this, 80)" type="button" style="width: 50px; background-color: #4f728a; color : #fff;">삭제</button>
											<button class="btn_set" onclick="updateRoomSelect(this, 80)" type="button" style="width: 50px ; background-color: #d03a3e; color : #fff;">수정</button>
										</div>

										<div class="item_" style="margin-bottom: 10px;">
											<input readonly="" type="text" value="222222222222" style="width:50%">
											<button class="btn_del" onclick="removeRoomSelect(this, 80)" type="button" style="width: 50px; background-color: #4f728a; color : #fff;">삭제</button>
											<button class="btn_set" onclick="updateRoomSelect(this, 80)" type="button" style="width: 50px ; background-color: #d03a3e; color : #fff;">수정</button>
										</div-->
                                    </td>
                                </tr>
                                </tbody>
                            </table>
							
                            <!--table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                   style="margin-top:50px;">
                                <caption>
                                </caption>
                                <colgroup>
                                    <col width="13%"/>
                                    <col width="*%"/>
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
                                    <th>최초가격(정찰가)(단위: 바트)</th>
                                    <td colspan="3">
                                        <input type="text" name="original_price" id="original_price" class="onlynum"
                                               style="text-align:right;width: 200px;"
                                               value="<?= $original_price ?? "" ?>"/>
                                    </td>

                                </tr>

                                <tr>
                                    <th>판매가격(단위: 바트)</th>
                                    <td colspan="3">
                                        <input type="text" name="product_price" id="product_price" class="onlynum"
                                               style="text-align:right;width: 200px;"
                                               value="<?= $product_price ?? "" ?>"/>
                                    </td>

                                </tr-->

                                <!--tr>
                                    <th>가격 숨김</th>
                                    <td colspan="3">
                                        <div style="display: flex; gap: 10px; align-items: center;">
                                            <div style="display: flex; align-items: center;">
                                                <input type="radio" name="is_won_bath" id="is_won_bath"
                                                       value="" <?php if (empty($is_won_bath)) {
                                                    echo "checked";
                                                } ?>/>
                                                <label for="is_won_bath">현재 가격</label>
                                            </div>
                                            <div style="display: flex; align-items: center;">
                                                <input type="radio" name="is_won_bath" id="is_won"
                                                       value="W" <?php if ($is_won_bath == "W") {
                                                    echo "checked";
                                                } ?>/>
                                                <label for="is_won">바트가격 숨김</label>
                                            </div>

                                            <div style="display: flex; align-items: center;">
                                                <input type="radio" name="is_won_bath" id="is_bath"
                                                       value="B" <?php if ($is_won_bath == "B") {
                                                    echo "checked";
                                                } ?>/>
                                                <label for="is_bath">원화가격 숨김</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table-->

                            <?php if ($product_idx): ?>
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
                                        <th>aeson Sale Offer <br> 프리미어 트윈</th>
                                        <td>
                                            <!--div class="item_">
												<input readonly="" type="text" value="디럭스001" style="width:60%">
												<button class="delete_" onclick="removeRoomSelect(this, 86)" type="button">삭제</button>
												<button class="update_" onclick="updateRoomSelect(this, 86)" type="button">수정</button>
                                            </div-->		
											
											<!--table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="table-layout:fixed;">
												<caption>
												</caption>
												<colgroup>
													<col width="10%">
													<col width="40%">
													<col width="10%">
													<col width="40%">
												</colgroup>
												<tbody>
												<tr>
													<td colspan="4">
														기본정보
													</td>
												</tr>
												<tr>
													<th>객실시설</th>
													<td colspan="3">
														 <input type="checkbox" id="room_facil_2501" name="" checked="" value="2501">
														 <label for="room_facil_2501">책상</label><input type="checkbox" id="room_facil_2502" name="" checked="" value="2502">
														 <label for="room_facil_2502">커피포트</label><input type="checkbox" id="room_facil_2503" name="" checked="" value="2503">
														 <label for="room_facil_2503">전화</label><input type="checkbox" id="room_facil_2504" name="" checked="" value="2504">
														 <label for="room_facil_2504">유료영화</label><input type="checkbox" id="room_facil_2505" name="" value="2505">
														 <label for="room_facil_2505">케이블채널</label><input type="checkbox" id="room_facil_2506" name="" value="2506">
														 <label for="room_facil_2506">안전금고</label><input type="checkbox" id="room_facil_2507" name="" value="2507">
														 <label for="room_facil_2507">세면용품</label><input type="checkbox" id="room_facil_2508" name="" value="2508">
														 <label for="room_facil_2508">에어컨</label><input type="checkbox" id="room_facil_2509" name="" value="2509">
														 <label for="room_facil_2509">미니바</label><input type="checkbox" id="room_facil_2510" name="" value="2510">
														 <label for="room_facil_2510">평면TV</label><input type="checkbox" id="room_facil_2511" name="" value="2511">
														 <label for="room_facil_2511">다림질도구</label><input type="checkbox" id="room_facil_2543" name="" value="2543">
														 <label for="room_facil_2543">test 2</label><input type="checkbox" id="room_facil_2542" name="" value="2542">
														 <label for="room_facil_2542">타올</label><input type="checkbox" id="room_facil_2541" name="" value="2541">
														 <label for="room_facil_2541">목욕가운</label><input type="checkbox" id="room_facil_2540" name="" value="2540">
														 <label for="room_facil_2540">객실내 풀</label><input type="checkbox" id="room_facil_2539" name="" value="2539">
														 <label for="room_facil_2539">욕조</label><input type="checkbox" id="room_facil_2538" name="" value="2538">
														 <label for="room_facil_2538">세탁기</label><input type="checkbox" id="room_facil_2537" name="" value="2537">
														 <label for="room_facil_2537">풀키친</label><input type="checkbox" id="room_facil_2536" name="" value="2536">
														 <label for="room_facil_2536">소파</label><input type="checkbox" id="room_facil_2533" name="" value="2533">
														 <label for="room_facil_2533">슬리퍼</label><input type="checkbox" id="room_facil_2532" name="" value="2532">
														 <label for="room_facil_2532">객실내영화</label><input type="checkbox" id="room_facil_2531" name="" value="2531">
														 <label for="room_facil_2531">무선인터넷</label><input type="checkbox" id="room_facil_2530" name="" value="2530">
														 <label for="room_facil_2530">알람시계</label><input type="checkbox" id="room_facil_2529" name="" value="2529">
														 <label for="room_facil_2529">모닝콜서비스</label><input type="checkbox" id="room_facil_2528" name="" value="2528">
														 <label for="room_facil_2528">창문</label><input type="checkbox" id="room_facil_2527" name="" value="2527">
														 <label for="room_facil_2527">식사공간</label><input type="checkbox" id="room_facil_2526" name="" value="2526">
														 <label for="room_facil_2526">전자레인지</label><input type="checkbox" id="room_facil_2525" name="" value="2525">
														 <label for="room_facil_2525">커피/티</label><input type="checkbox" id="room_facil_2524" name="" value="2524">
														 <label for="room_facil_2524">헤어드라이어</label><input type="checkbox" id="room_facil_2523" name="" value="2523">
														 <label for="room_facil_2523">냉장고</label><input type="checkbox" id="room_facil_2522" name="" value="2522">
														 <label for="room_facil_2522">테라스</label><input type="checkbox" id="room_facil_2521" name="" value="2521">
														 <label for="room_facil_2521">발코니</label><input type="checkbox" id="room_facil_2520" name="" value="2520">
														 <label for="room_facil_2520">휴식공간</label><input type="checkbox" id="room_facil_2519" name="" value="2519">
														 <label for="room_facil_2519">Wifi (유료)</label><input type="checkbox" id="room_facil_2518" name="" value="2518">
														 <label for="room_facil_2518">Wifi (무료)</label><input type="checkbox" id="room_facil_2514" name="" value="2514">
														 <label for="room_facil_2514">샤워시설</label><input type="checkbox" id="room_facil_2513" name="" value="2513">
														 <label for="room_facil_2513">화장실</label><input type="checkbox" id="room_facil_2512" name="" value="2512">
														 <label for="room_facil_2512">전용욕실</label>
													</td>
												</tr>

												<tr>
													<th>장면</th>
													<td colspan="3">
														<input type="text" name="scenery" value="장면이 어디 나오나" class="text" id="scenery77" style="width:300px" maxlength="50">
													</td>
												</tr>

												<tr>
													<th>범주</th>
													<td colspan="3">
														 <input type="checkbox" id="room_category_3604" name="" checked="" value="3604">
														 <label for="room_category_3604">오션 뷰</label><input type="checkbox" id="room_category_3603" name="" checked="" value="3603">
														 <label for="room_category_3603">침대 여러개</label><input type="checkbox" id="room_category_3602" name="" value="3602">
														 <label for="room_category_3602">침대 2개</label><input type="checkbox" id="room_category_3601" name="" value="3601">
														 <label for="room_category_3601">조식 포함</label>
													</td>
												</tr>

												<tr>
													<th>식사</th>
													<td colspan="3">
														<input type="checkbox" id="rbreakfast77" name="breakfast" value="Y" checked="">
														<label for="rbreakfast">조식 </label>

														<input type="checkbox" id="lunch77" name="lunch" value="Y">
														<label for="lunch">중식</label>

														<input type="checkbox" id="dinner77" name="dinner" value="Y">
														<label for="dinner">석식</label>
													</td>
												</tr>

												<tr>
													<th>총인원</th>
													<td colspan="3">
														<input type="text" name="max_num_people" value="3" id="max_num_people77" class="number" min="1" style="width:100px">
													</td>
												</tr>
												</tbody>
											</table>

											<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
												<caption>
												</caption>
												<colgroup>
													<col width="10%">
													<col width="90%">
												</colgroup>
												<tbody>

												<tr>
													<td colspan="2">
														이미지 등록
													</td>
												</tr>

												<tr>
													<th>서브이미지(600X400)</th>
													<td>
														<div class="img_add">
															<div class="" style="display: flex; gap: 20px">
																<img src="/uploads/rooms/1737001846_51ecf801be69f6feb8d6.png" alt="" width="100px">
																<img src="/uploads/rooms/" alt="" width="100px">
																<img src="/uploads/rooms/" alt="" width="100px">
															</div>
														</div>
													</td>
												</tr>
												</tbody>
											</table-->
						
                                            <div class="head_table">
                                                <div class="btn_more">
                                                    <button type="button" id="addTableBtn" style = "width : 70px ;background-color : #4f728a; color : #fff">룸 추가</button>
                                                    <span style="color : red" class="note">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다</span>
                                                </div>
                                                <div class="btn_save_all">
                                                    <button style = "background-color : #4f728a; color : #fff">전체저장</button>
                                                </div>
                                            </div>
                                            <div class="table_child">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="background-color: #eee;">
                                                                <span>제 목</span>
                                                                <input style="width: 30%;" type="text">
                                                                <input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
                                                                <span>~</span> 
                                                                <input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
                                                                <button style="width: 50px; background-color : #4f728a; color : #fff;" class="btn_edit">수정</button>
                                                                <!--input type="checkbox">사용-->
                                                                <input type="checkbox">마감
                                                                <div class="btns_setting">
                                                                    <button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">저장</button>
                                                                    <button style="width: 50px ; background-color: #d03a3e; color : #fff;" class="btn_del">삭제</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <span>기본가</span>
                                                                <input style="width: 100px;" type="text">
                                                                <span>컨택가</span>
                                                                <input style="width: 100px;" type="text">
                                                                <span>+수익</span>
                                                                <input style="width: 100px;" type="text">
                                                                <span>=상품가</span>
                                                                <input style="width: 100px;" type="text">
                                                                <!--select>
                                                                    <option value="">현재 가격</option>
                                                                    <option value="">현재 가격</option>
                                                                </select-->
                                                                <label style="margin-left: 30px;" for="check_bx_001">비밀특가</label>
                                                                <input id="check_bx_001" type="checkbox">
																
																<span style="margin-left: 30px;">가격숨김</span>
																<input type="radio" name="is_won_bath" id="is_won_bath"
																	   value="" <?php if (empty($is_won_bath)) {
																	echo "checked";
																} ?>/>
																<label for="is_won_bath">원화+바트</label>
																<input type="radio" name="is_won_bath" id="is_won"
																	   value="W" <?php if ($is_won_bath == "W") {
																	echo "checked";
																} ?>/>
																<label for="is_won">원화</label>
																<input type="radio" name="is_won_bath" id="is_bath"
																	   value="B" <?php if ($is_won_bath == "B") {
																	echo "checked";
																} ?>/>
																<label for="is_bath">바트</label>
																
                                                            </td>
                                                        </tr>
														
                                                        <tr>
                                                            <td>
                                                                <p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))</p>
                                                                <!--input style="width: 18%;" type="text">
                                                                <input style="width: 8%;" type="text">
                                                                <input style="width: 18%; margin-left: 20px;" type="text">
                                                                <input style="width: 8%;" type="text"-->
                                                                <input style="width: 18%; margin-left: 20px;" type="text">
                                                                <input style="width: 8%;" type="text">
                                                                <button style="width: 31px; height : 31px">+</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p style="margin-bottom: 3px;">옵션 내용을 추가 합니다. (html 태그 사용가능)</p>
                                                                <input style="width: 18%;" type="text">
                                                                <button style="width: 31px; height : 31px">+</button>
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                       style="margin-top:50px;">
                                    <caption>
                                    </caption>
                                    <colgroup>
                                        <col width="15%"/>
                                        <col width="90%"/>
                                    </colgroup>
                                    <tbody>

                                    <tr height="45">
                                        <th>호텔명</th>
                                        <td>
                                            <select id="hotel_code" name="hotel_code" class="input_select"
                                                    onchange="fn_new_chgRoom(this.value)">
                                                <option value="">선택</option>
                                                <?php
                                                foreach ($fresult3 as $frow) {
                                                    ?>
                                                    <option value="<?= $frow["code_no"] ?>"
                                                        <?php if (isset($stay_idx) && $stay_idx === $frow["code_no"])
                                                            echo "selected"; ?>>
                                                        <?= $frow["stay_name_eng"] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span>(호텔을 선택해야 옵션에서 룸을 선택할 수 있습니다.)</span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <script>
                                    function fn_new_chgRoom() {
                                        let selectedValue = $('#hotel_code').val();

                                        if (selectedValue.startsWith("H0")) {
                                            selectedValue = selectedValue.substring(2);
                                        }

                                        document.getElementById("stay_idx").value = selectedValue;
                                    }
                                </script>
                            <?php endif; ?>
                        </div>
                    </form>

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">
                                <a href="/AdmMaster/_hotel/list" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                                <a href="javascript:send_it_price()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
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
                                    <input type="text" name="roomName" value="<?= $roomName ?? '' ?>" class="text"
                                           style="width:300px" maxlength="50" id="roomName"/>
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
                                    <input type="text" name="scenery" value="<?= $scenery ?? '' ?>" class="text"
                                           id="scenery" style="width:300px" maxlength="50"/>
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
                                    <input type="checkbox" id="rbreakfast" name="breakfast"
                                           value="Y" <?php if ($breakfast == "Y") echo "checked"; ?> />
                                    <label for="rbreakfast">조식 </label>

                                    <input type="checkbox" id="lunch" name="lunch"
                                           value="Y" <?php if ($lunch == "Y") echo "checked"; ?> />
                                    <label for="lunch">중식</label>

                                    <input type="checkbox" id="dinner" name="dinner"
                                           value="Y" <?php if ($dinner == "Y") echo "checked"; ?> />
                                    <label for="dinner">석식</label>
                                </td>
                            </tr>

                            <tr>
                                <th>총인원</th>
                                <td colspan="3">
                                    <input type="text" name="max_num_people" value="<?= $max_num_people ?? 1 ?>"
                                           id="max_num_people" class="number" min="1" style="width:100px"/>
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
                                                <input type="hidden" name="checkImg_<?= $i ?>">
                                                <button type="button" class="remove_btn"
                                                        onclick="productImagePreviewRemove(this)"></button>

                                                <a class="img_txt imgpop_p" href="<?= $img ?>"
                                                   id="text_room_ufile<?= $i ?>">미리보기</a>
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
    function saveValueRoom(e) {
        e.preventDefault();
        let formData = new FormData($('#formRoom')[0]);

        let room_facil = $("input[name=_room_facil]:checked").map(function () {
            return $(this).val();
        }).get().join('|');
        formData.append("room_facil", room_facil);

        let room_category = $("input[name=_room_category]:checked").map(function () {
            return $(this).val();
        }).get().join('|');
        formData.append("room_category", room_category);

        let apiUrl = `<?= route_to('admin.api.hotel_.write_room_ok') ?>`;

        $("#ajax_loader").removeClass("display-none");

        $.ajax(apiUrl, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                alert(response.message);
                $("#ajax_loader").addClass("display-none");
                showOrHide();
                location.reload();
            },
            error: function (request, status, error) {
                alert("Error " + request.status + ": " + request.responseText);
                $("#ajax_loader").addClass("display-none");
            }
        });
    }
	</script>
	
    <script>
        $(document).ready(function () {
            // 클릭 이벤트 핸들러
            $("#addTableBtn").on("click", function () {
                // 새로운 테이블 HTML 생성
                const newTable = `
					  <table>
						<tbody>
							<tr>
								<td style="background-color: #eee;">
									<span>제 목</span>
									<input style="width: 30%;" type="text">
									<input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
									<span>~</span> 
									<input style="width: 10%;" type="text" name="" id="" class="s_date datepicker">
									<button style="width: 50px; background-color : #4f728a; color : #fff;" class="btn_edit">수정</button>
									<input type="checkbox">사용
									<input type="checkbox">미사용
									<div class="btns_setting">
										<button style="width: 50px; background-color: #4f728a; color : #fff;" class="btn_set">저장</button>
										<button style="width: 50px ; background-color: #d03a3e; color : #fff;" class="deleteRowBtn btn_del">삭제</button>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<span>기본가</span>
									<input style="width: 100px;" type="text">
									<span>컨택가</span>
									<input style="width: 100px;" type="text">
									<span>+수익</span>
									<input style="width: 100px;" type="text">
									<span>=상품가</span>
									<input style="width: 100px;" type="text">
									<select>
										<option value="">현재 가격</option>
										<option value="">현재 가격</option>
									</select>
									<label style="margin-left: 30px;" for="check_bx_001">비밀특가</label>
									<input id="check_bx_001" type="checkbox">
									
									<span style="margin-left: 30px;">가격숨김</span>
									<input type="radio" name="is_won_bath" id="is_won_bath" value="" />
									<label for="is_won_bath">현재 가격</label>
									<input type="radio" name="is_won_bath" id="is_won" value="W" />
									<label for="is_won">바트가격 숨김</label>
									<input type="radio" name="is_won_bath" id="is_bath" value="B" />
									<label for="is_bath">원화가격 숨김</label>
									
								</td>
							</tr>
							
							<tr>
								<td>
									<p style="margin-bottom: 3px;">침대타입추가 (침대타입의 가격은 추가되는 금액만 넣습니다. (제목/금액))</p>
									<input style="width: 18%;" type="text">
									<input style="width: 8%;" type="text">
									<input style="width: 18%; margin-left: 20px;" type="text">
									<input style="width: 8%;" type="text">
									<input style="width: 18%; margin-left: 20px;" type="text">
									<input style="width: 8%;" type="text">
									<button style="width: 31px; height : 31px">+</button>
								</td>
							</tr>
							<tr>
								<td>
									<p style="margin-bottom: 3px;">옵션 내용을 추가 합니다. (html 태그 사용가능)</p>
									<input style="width: 18%;" type="text">
									<button style="width: 31px; height : 31px">+</button>
									
								</td>
							</tr>
						</tbody>
					</table>`;
                
                // 새 테이블을 .table-container에 추가
                $(".table_child").append(newTable);
            });

            // 삭제 버튼 동작
            $(document).on("click", ".deleteRowBtn", function () {
                $(this).closest("table").remove();
            });
        });
    </script>				
    <script>
        $("#mainRoom").on('change', '.chk_price_secret', function () {
            let check = "";
            if ($(this).is(":checked")) {
                check = "Y";
            }
            $(this).closest(".chk_price_wrap").find(".price_secret").val(check);
        });
    </script>
    <script>
        function productImagePreview(inputFile, onum) {
            if (sizeAndExtCheck(inputFile) == false) {
                inputFile.value = "";
                return false;
            }

            let imageTag = document.querySelector('label[for="ufile' + onum + '"]');

            if (inputFile.files.length > 0) {
                let imageReader = new FileReader();

                imageReader.onload = function () {
                    imageTag.style = "background-image:url(" + imageReader.result + ")";
                    inputFile.closest('.file_input').classList.add('applied');
                    inputFile.closest('.file_input').children[3].value = 'Y';
                }
                return imageReader.readAsDataURL(inputFile.files[0]);
            }
        }

        /**
         * 상품 이미지 삭제
         * @param {element} button
         */
        function productImagePreviewRemove(element) {
            let inputFile = element.parentNode.children[1];
            let labelImg = element.parentNode.children[2];

            inputFile.value = "";
            labelImg.style = "";
            element.closest('.file_input').classList.remove('applied');
            element.closest('.file_input').children[3].value = 'N';
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
    <iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>