<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<link rel="stylesheet" type="text/css" href="/css/admin/popup.css">

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<div id="datepicker"></div>
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

<style>
    .container_date {
        display: flex; /* 가로 정렬 */
    }

    .order_btn {
        cursor: pointer;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

</style>

<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>상품요금정보 </h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_hotel/write?search_category=&search_txt=&pg=&product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                        </li>
                        <?php if ($o_idx) { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>
                            <li><a href="#" class="btn btn-default"><span
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

        <form name="chargeForm" id="chargeForm" method="post">
            <input type=hidden name="product_idx" value='<?= $product_idx ?>' id="product_idx">
            <input type=hidden name="o_idx" value='<?= $o_idx ?>' id='o_idx'>

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
                                <th>상품명</th>
                                <td>
                                    <?= $product_name ?>
                                </td>
                            </tr>

                            <tr>
                                <th>날짜지정</th>
                                <td>
                                    <div class="container_date flex__c" style="margin: 0">
                                        <div style="text-align:left;">
                                            시작일: <input type="text" name="s_date" value="<?= $o_sdate ?>" id="s_date"
                                                        style="text-align: center;background: white; width: 120px;" readonly>
                                        </div>
                                        <div style="text-align:left;text-wrap: nowrap; margin-left: 30px;">
                                            종료일: <input type="text" name="e_date" value="<?= $o_edate ?>" id="e_date"
                                                        style="text-align: center; background: white; width: 120px;" readonly>
                                        </div>

                                        <div style="margin:10px">
                                            <a href="javascript:addOption();" id="addcharge" class="btn btn-primary">조회</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>요금정보</th>
                                <td>
                                    
                                    <table style="width:100%" id="chargeTable">
                                        <colgroup>
                                            <col width="*">
                                            <col width="30%">
                                            <col width="30%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <tbody id="charge">
                                            <tr style="height:40px">
                                                <td style="text-align:center">
                                                    적용일자
                                                </td>
                                                <td style="text-align:center">
                                                    가격
                                                </td>
                                                <td style="text-align:center">
                                                    우대가격
                                                </td>
                                                <td style="text-align:center">
                                                    마감
                                                </td>
                                                <td style="text-align:center">
                                                    처리
                                                </td>
                                            </tr>
                                        
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            </tbody>

                        </table>
                    </div>

<div class="listBottom">
         				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
									<colgroup>
									<col width="*">
									<col width="20%">
									<col width="20%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
									<col width="15%">
									</colgroup>
					                <tbody id="charge">
										<tr style="height:40px">
											<td style="text-align:center">
												일자
											</td>
											<td style="text-align:center">
												정상가격(원)
											</td>
											<td style="text-align:center">
												할인가격(원)
											</td>
											<td style="text-align:center">
												마감
											</td>
											<td style="text-align:center">
												등록일
											</td>
											<td style="text-align:center">
												수정일
											</td>
											<td style="text-align:center">
												처리
											</td>
										</tr>
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-11</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_720" value="720">
												<input type="hidden" name="price_date[]" id="price_date_720" value="2024-11-11">
												<input type="text" name="goods_price1[]" id="goods_price1_720" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_720" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_720" value="2024-11-11">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="720">수정</button>
												<button type="button" class="chargeDelete" value="720">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-12</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_721" value="721">
												<input type="hidden" name="price_date[]" id="price_date_721" value="2024-11-12">
												<input type="text" name="goods_price1[]" id="goods_price1_721" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_721" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_721" value="2024-11-12">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="721">수정</button>
												<button type="button" class="chargeDelete" value="721">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-13</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_722" value="722">
												<input type="hidden" name="price_date[]" id="price_date_722" value="2024-11-13">
												<input type="text" name="goods_price1[]" id="goods_price1_722" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_722" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_722" value="2024-11-13">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="722">수정</button>
												<button type="button" class="chargeDelete" value="722">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-14</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_723" value="723">
												<input type="hidden" name="price_date[]" id="price_date_723" value="2024-11-14">
												<input type="text" name="goods_price1[]" id="goods_price1_723" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_723" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_723" value="2024-11-14">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="723">수정</button>
												<button type="button" class="chargeDelete" value="723">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-15</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_724" value="724">
												<input type="hidden" name="price_date[]" id="price_date_724" value="2024-11-15">
												<input type="text" name="goods_price1[]" id="goods_price1_724" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_724" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_724" value="2024-11-15">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="724">수정</button>
												<button type="button" class="chargeDelete" value="724">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-16</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_725" value="725">
												<input type="hidden" name="price_date[]" id="price_date_725" value="2024-11-16">
												<input type="text" name="goods_price1[]" id="goods_price1_725" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_725" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_725" value="2024-11-16">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="725">수정</button>
												<button type="button" class="chargeDelete" value="725">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-17</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_726" value="726">
												<input type="hidden" name="price_date[]" id="price_date_726" value="2024-11-17">
												<input type="text" name="goods_price1[]" id="goods_price1_726" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_726" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_726" value="2024-11-17">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="726">수정</button>
												<button type="button" class="chargeDelete" value="726">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-18</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_727" value="727">
												<input type="hidden" name="price_date[]" id="price_date_727" value="2024-11-18">
												<input type="text" name="goods_price1[]" id="goods_price1_727" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_727" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_727" value="2024-11-18">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="727">수정</button>
												<button type="button" class="chargeDelete" value="727">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-19</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_728" value="728">
												<input type="hidden" name="price_date[]" id="price_date_728" value="2024-11-19">
												<input type="text" name="goods_price1[]" id="goods_price1_728" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_728" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_728" value="2024-11-19">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="728">수정</button>
												<button type="button" class="chargeDelete" value="728">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-20</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_729" value="729">
												<input type="hidden" name="price_date[]" id="price_date_729" value="2024-11-20">
												<input type="text" name="goods_price1[]" id="goods_price1_729" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_729" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_729" value="2024-11-20">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="729">수정</button>
												<button type="button" class="chargeDelete" value="729">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-21</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_730" value="730">
												<input type="hidden" name="price_date[]" id="price_date_730" value="2024-11-21">
												<input type="text" name="goods_price1[]" id="goods_price1_730" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_730" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_730" value="2024-11-21">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="730">수정</button>
												<button type="button" class="chargeDelete" value="730">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-22</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_731" value="731">
												<input type="hidden" name="price_date[]" id="price_date_731" value="2024-11-22">
												<input type="text" name="goods_price1[]" id="goods_price1_731" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_731" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_731" value="2024-11-22">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="731">수정</button>
												<button type="button" class="chargeDelete" value="731">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-23</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_732" value="732">
												<input type="hidden" name="price_date[]" id="price_date_732" value="2024-11-23">
												<input type="text" name="goods_price1[]" id="goods_price1_732" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_732" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_732" value="2024-11-23">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="732">수정</button>
												<button type="button" class="chargeDelete" value="732">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-24</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_733" value="733">
												<input type="hidden" name="price_date[]" id="price_date_733" value="2024-11-24">
												<input type="text" name="goods_price1[]" id="goods_price1_733" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_733" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_733" value="2024-11-24">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="733">수정</button>
												<button type="button" class="chargeDelete" value="733">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-25</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_734" value="734">
												<input type="hidden" name="price_date[]" id="price_date_734" value="2024-11-25">
												<input type="text" name="goods_price1[]" id="goods_price1_734" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_734" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_734" value="2024-11-25">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="734">수정</button>
												<button type="button" class="chargeDelete" value="734">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-26</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_735" value="735">
												<input type="hidden" name="price_date[]" id="price_date_735" value="2024-11-26">
												<input type="text" name="goods_price1[]" id="goods_price1_735" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_735" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_735" value="2024-11-26">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="735">수정</button>
												<button type="button" class="chargeDelete" value="735">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-27</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_736" value="736">
												<input type="hidden" name="price_date[]" id="price_date_736" value="2024-11-27">
												<input type="text" name="goods_price1[]" id="goods_price1_736" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_736" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_736" value="2024-11-27">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="736">수정</button>
												<button type="button" class="chargeDelete" value="736">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-28</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_737" value="737">
												<input type="hidden" name="price_date[]" id="price_date_737" value="2024-11-28">
												<input type="text" name="goods_price1[]" id="goods_price1_737" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_737" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_737" value="2024-11-28">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="737">수정</button>
												<button type="button" class="chargeDelete" value="737">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-29</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_738" value="738">
												<input type="hidden" name="price_date[]" id="price_date_738" value="2024-11-29">
												<input type="text" name="goods_price1[]" id="goods_price1_738" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_738" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_738" value="2024-11-29">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="738">수정</button>
												<button type="button" class="chargeDelete" value="738">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-11-30</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_739" value="739">
												<input type="hidden" name="price_date[]" id="price_date_739" value="2024-11-30">
												<input type="text" name="goods_price1[]" id="goods_price1_739" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_739" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_739" value="2024-11-30">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="739">수정</button>
												<button type="button" class="chargeDelete" value="739">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-01</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_740" value="740">
												<input type="hidden" name="price_date[]" id="price_date_740" value="2024-12-01">
												<input type="text" name="goods_price1[]" id="goods_price1_740" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_740" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_740" value="2024-12-01">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="740">수정</button>
												<button type="button" class="chargeDelete" value="740">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-02</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_741" value="741">
												<input type="hidden" name="price_date[]" id="price_date_741" value="2024-12-02">
												<input type="text" name="goods_price1[]" id="goods_price1_741" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_741" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_741" value="2024-12-02">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="741">수정</button>
												<button type="button" class="chargeDelete" value="741">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-03</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_742" value="742">
												<input type="hidden" name="price_date[]" id="price_date_742" value="2024-12-03">
												<input type="text" name="goods_price1[]" id="goods_price1_742" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_742" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_742" value="2024-12-03">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="742">수정</button>
												<button type="button" class="chargeDelete" value="742">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-04</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_743" value="743">
												<input type="hidden" name="price_date[]" id="price_date_743" value="2024-12-04">
												<input type="text" name="goods_price1[]" id="goods_price1_743" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_743" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_743" value="2024-12-04">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="743">수정</button>
												<button type="button" class="chargeDelete" value="743">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-05</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_744" value="744">
												<input type="hidden" name="price_date[]" id="price_date_744" value="2024-12-05">
												<input type="text" name="goods_price1[]" id="goods_price1_744" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_744" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_744" value="2024-12-05">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="744">수정</button>
												<button type="button" class="chargeDelete" value="744">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-06</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_745" value="745">
												<input type="hidden" name="price_date[]" id="price_date_745" value="2024-12-06">
												<input type="text" name="goods_price1[]" id="goods_price1_745" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_745" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_745" value="2024-12-06">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="745">수정</button>
												<button type="button" class="chargeDelete" value="745">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-07</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_746" value="746">
												<input type="hidden" name="price_date[]" id="price_date_746" value="2024-12-07">
												<input type="text" name="goods_price1[]" id="goods_price1_746" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_746" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_746" value="2024-12-07">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="746">수정</button>
												<button type="button" class="chargeDelete" value="746">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-08</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_747" value="747">
												<input type="hidden" name="price_date[]" id="price_date_747" value="2024-12-08">
												<input type="text" name="goods_price1[]" id="goods_price1_747" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_747" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_747" value="2024-12-08">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="747">수정</button>
												<button type="button" class="chargeDelete" value="747">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-09</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_748" value="748">
												<input type="hidden" name="price_date[]" id="price_date_748" value="2024-12-09">
												<input type="text" name="goods_price1[]" id="goods_price1_748" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_748" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_748" value="2024-12-09">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="748">수정</button>
												<button type="button" class="chargeDelete" value="748">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-10</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_749" value="749">
												<input type="hidden" name="price_date[]" id="price_date_749" value="2024-12-10">
												<input type="text" name="goods_price1[]" id="goods_price1_749" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_749" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_749" value="2024-12-10">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="749">수정</button>
												<button type="button" class="chargeDelete" value="749">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-11</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_750" value="750">
												<input type="hidden" name="price_date[]" id="price_date_750" value="2024-12-11">
												<input type="text" name="goods_price1[]" id="goods_price1_750" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_750" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_750" value="2024-12-11">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="750">수정</button>
												<button type="button" class="chargeDelete" value="750">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-12</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_751" value="751">
												<input type="hidden" name="price_date[]" id="price_date_751" value="2024-12-12">
												<input type="text" name="goods_price1[]" id="goods_price1_751" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_751" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_751" value="2024-12-12">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="751">수정</button>
												<button type="button" class="chargeDelete" value="751">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-13</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_752" value="752">
												<input type="hidden" name="price_date[]" id="price_date_752" value="2024-12-13">
												<input type="text" name="goods_price1[]" id="goods_price1_752" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_752" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_752" value="2024-12-13">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="752">수정</button>
												<button type="button" class="chargeDelete" value="752">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-14</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_753" value="753">
												<input type="hidden" name="price_date[]" id="price_date_753" value="2024-12-14">
												<input type="text" name="goods_price1[]" id="goods_price1_753" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_753" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_753" value="2024-12-14">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="753">수정</button>
												<button type="button" class="chargeDelete" value="753">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-15</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_754" value="754">
												<input type="hidden" name="price_date[]" id="price_date_754" value="2024-12-15">
												<input type="text" name="goods_price1[]" id="goods_price1_754" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_754" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_754" value="2024-12-15">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="754">수정</button>
												<button type="button" class="chargeDelete" value="754">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-16</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_755" value="755">
												<input type="hidden" name="price_date[]" id="price_date_755" value="2024-12-16">
												<input type="text" name="goods_price1[]" id="goods_price1_755" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_755" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_755" value="2024-12-16">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="755">수정</button>
												<button type="button" class="chargeDelete" value="755">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-17</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_756" value="756">
												<input type="hidden" name="price_date[]" id="price_date_756" value="2024-12-17">
												<input type="text" name="goods_price1[]" id="goods_price1_756" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_756" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_756" value="2024-12-17">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="756">수정</button>
												<button type="button" class="chargeDelete" value="756">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-18</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_757" value="757">
												<input type="hidden" name="price_date[]" id="price_date_757" value="2024-12-18">
												<input type="text" name="goods_price1[]" id="goods_price1_757" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_757" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_757" value="2024-12-18">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="757">수정</button>
												<button type="button" class="chargeDelete" value="757">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-19</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_758" value="758">
												<input type="hidden" name="price_date[]" id="price_date_758" value="2024-12-19">
												<input type="text" name="goods_price1[]" id="goods_price1_758" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_758" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_758" value="2024-12-19">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="758">수정</button>
												<button type="button" class="chargeDelete" value="758">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-20</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_759" value="759">
												<input type="hidden" name="price_date[]" id="price_date_759" value="2024-12-20">
												<input type="text" name="goods_price1[]" id="goods_price1_759" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_759" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_759" value="2024-12-20">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="759">수정</button>
												<button type="button" class="chargeDelete" value="759">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-21</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_760" value="760">
												<input type="hidden" name="price_date[]" id="price_date_760" value="2024-12-21">
												<input type="text" name="goods_price1[]" id="goods_price1_760" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_760" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_760" value="2024-12-21">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="760">수정</button>
												<button type="button" class="chargeDelete" value="760">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-22</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_761" value="761">
												<input type="hidden" name="price_date[]" id="price_date_761" value="2024-12-22">
												<input type="text" name="goods_price1[]" id="goods_price1_761" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_761" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_761" value="2024-12-22">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="761">수정</button>
												<button type="button" class="chargeDelete" value="761">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-23</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_762" value="762">
												<input type="hidden" name="price_date[]" id="price_date_762" value="2024-12-23">
												<input type="text" name="goods_price1[]" id="goods_price1_762" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_762" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_762" value="2024-12-23">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="762">수정</button>
												<button type="button" class="chargeDelete" value="762">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-24</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_763" value="763">
												<input type="hidden" name="price_date[]" id="price_date_763" value="2024-12-24">
												<input type="text" name="goods_price1[]" id="goods_price1_763" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_763" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_763" value="2024-12-24">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="763">수정</button>
												<button type="button" class="chargeDelete" value="763">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-25</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_764" value="764">
												<input type="hidden" name="price_date[]" id="price_date_764" value="2024-12-25">
												<input type="text" name="goods_price1[]" id="goods_price1_764" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_764" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_764" value="2024-12-25">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="764">수정</button>
												<button type="button" class="chargeDelete" value="764">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-26</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_765" value="765">
												<input type="hidden" name="price_date[]" id="price_date_765" value="2024-12-26">
												<input type="text" name="goods_price1[]" id="goods_price1_765" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_765" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_765" value="2024-12-26">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="765">수정</button>
												<button type="button" class="chargeDelete" value="765">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-27</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_766" value="766">
												<input type="hidden" name="price_date[]" id="price_date_766" value="2024-12-27">
												<input type="text" name="goods_price1[]" id="goods_price1_766" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_766" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_766" value="2024-12-27">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="766">수정</button>
												<button type="button" class="chargeDelete" value="766">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-28</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_767" value="767">
												<input type="hidden" name="price_date[]" id="price_date_767" value="2024-12-28">
												<input type="text" name="goods_price1[]" id="goods_price1_767" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_767" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_767" value="2024-12-28">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="767">수정</button>
												<button type="button" class="chargeDelete" value="767">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-29</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_768" value="768">
												<input type="hidden" name="price_date[]" id="price_date_768" value="2024-12-29">
												<input type="text" name="goods_price1[]" id="goods_price1_768" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_768" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_768" value="2024-12-29">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="768">수정</button>
												<button type="button" class="chargeDelete" value="768">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-30</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_769" value="769">
												<input type="hidden" name="price_date[]" id="price_date_769" value="2024-12-30">
												<input type="text" name="goods_price1[]" id="goods_price1_769" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_769" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_769" value="2024-12-30">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="769">수정</button>
												<button type="button" class="chargeDelete" value="769">삭제</button>
						                    </td> 
                                        </tr>										
										
																				<tr style="height:40px">
											<td style="text-align:center">2024-12-31</td>
											<td style="text-align:center">
												<input type="hidden" name="p_idx[]" id="p_idx_770" value="770">
												<input type="hidden" name="price_date[]" id="price_date_770" value="2024-12-31">
												<input type="text" name="goods_price1[]" id="goods_price1_770" value="1400000" class="price goods_price input_txt" numberonly="true" style="text-align:right">
											</td>
											<td style="text-align:center">
												<input type="text" name="goods_price2[]" id="goods_price2_770" value="0" class="price goods_discount_price input_txt" numberonly="true" style="text-align:right">
											</td>
						                    <td style="text-align:center;">
						                        <input type="checkbox" class="deadline" name="deadline[]" id="deadline_770" value="2024-12-31">
						                    </td> 
						                    <td style="text-align:center;">2024-11-27 02:48:42</td> 
						                    <td style="text-align:center;">0000-00-00 00:00:00</td> 
						                    <td style="text-align:center;">
												<button type="button" class="chargeUpdate" value="770">수정</button>
												<button type="button" class="chargeDelete" value="770">삭제</button>
						                    </td> 
                                        </tr>										
										
										
									</tbody>
								</table>
			</div>
                    <!-- // listBottom -->

                    <script>

                        $(function () {

                            $("#s_date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                showOn: "both",
                                buttonImage: "/images/admin/common/date.png",
                                buttonImageOnly: true,
                                closeText: '닫기',
                                currentText: '오늘',
                                prevText: '이전',
                                nextText: '다음',
                                yearRange: "c:c+10",
                                minDate: '<?=$o_sdate?>',
                                maxDate: '<?=$o_edate?>',
                                onClose: function (selectedDate) {
                                    $("#e_date").datepicker("option", "minDate", selectedDate);
                                },
                                beforeShow: function (input) {
                                    setTimeout(function () {
                                        var buttonPane = $(input)
                                            .datepicker("widget")
                                            .find(".ui-datepicker-buttonpane");
                                        var btn = $('<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                                        btn.unbind("click").bind("click", function () {
                                            $.datepicker._clearDate(input);
                                        });
                                        btn.appendTo(buttonPane);
                                    }, 1);
                                }
                            });


                            $("#e_date").datepicker({
                                showButtonPanel: true
                                , onClose: function (selectedDate) {
                                    // To 날짜 선택기의 최소 날짜를 설정
                                    $("#s_date").datepicker("option", "maxDate", selectedDate);
                                }
                                , beforeShow: function (input) {
                                    setTimeout(function () {
                                        var buttonPane = $(input)
                                            .datepicker("widget")
                                            .find(".ui-datepicker-buttonpane");
                                        //var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                        btn.unbind("click").bind("click", function () {
                                            $.datepicker._clearDate(input);
                                        });
                                        btn.appendTo(buttonPane);
                                    }, 1);
                                }
                                , dateFormat: 'yy-mm-dd'
                                , showOn: "both"
                                , yearRange: "c:c+30"
                                , buttonImage: "/images/admin/common/date.png"
                                , buttonImageOnly: true
                                , closeText: '닫기'
                                , currentText: '오늘' // 오늘 버튼 텍스트 설정
                                , prevText: '이전'
                                , nextText: '다음'
                                , minDate: '<?=$o_sdate?>'
                                , maxDate: '<?=$o_edate?>'
                            });
                        });
                        
                    </script>

                    <script>
                        // 동적으로 추가된 input 요소에 콤마 적용 - 이벤트 위임 사용
                        $(document).on('input', '.input_txt', function () {
                            var value = $(this).val().replace(/,/g, ''); // 기존 콤마 제거

                            if (!isNaN(value) && value !== '') {  // 숫자인 경우에만 처리
                                var formattedValue = Number(value).toLocaleString('en');  // 콤마 추가
                                $(this).val(formattedValue);  // 값 업데이트
                            }
                        });

                        $(document).on('input', '.only_number', function () {
                            var value = $(this).val();
                            $(this).val(value.replace(/[^0-9]/g, '')); 
                        });
                    </script>

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">

                                <a href="javascript:go_list();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                                <?php if ($o_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">수정</span></a>
                                    <a href="#" class="btn btn-default"><span
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
    $(document).on('click', '.chargeDelete', function () {
        $(this).closest("tr").remove();
    });


    function addOption() {
        let startDate = new Date($("#s_date").val());
        let endDate = new Date($("#e_date").val());

        let html = ``;
        while (startDate <= endDate) {
            let dateStr = startDate.toISOString().split('T')[0];

            
            let issetDate = $('.option_date .date[data-value="' + dateStr + '"]');

            if(issetDate.length <= 0){
                html += `
                        <tr class="option_date" style="height:40px">
                            <td class="date" style="text-align:center" data-value="${dateStr}">
                                ${dateStr}
                            </td>
                            <td style="text-align:center">
                                <input type="text" class="price tour_price input_txt only_number" style="text-align:right"/>
                            </td>
                            <td style="text-align:center">
                                <input type="text" class="price tour_price input_txt only_number" style="text-align:right"/>
                            </td>
                            <td style="text-align:center;">
                                <div class="" style="display: flex; gap: 10px">
                                    <button style="height: 30px" type="button"
                                            class="chargeUpdate">수정
                                    </button>
                                    <button style="height: 30px" type="button"
                                            class="chargeDelete">삭제
                                    </button>
                                </div>
                            </td>
                        </tr>
                `;
            }

            startDate.setDate(startDate.getDate() + 1);
        }

        $("#charge").append(html);

    }
</script>

<script>
    function go_list() {
        window.location.href = "AdmMaster/_hotel/write?search_category=&search_txt=&pg=&product_idx=<?=$product_idx?>";
    }
</script>

<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>