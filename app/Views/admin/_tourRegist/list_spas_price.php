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

	.center-checkbox {
		display: flex;
		flex-direction: row;  /* 가로 방향 정렬 */
		justify-content: center; /* 수평 중앙 정렬 */
		align-items: center; /* 수직 중앙 정렬 */
		gap: 5px; /* 체크박스 간 간격 조정 (필요에 따라 변경) */
	}

	div.listBottom table.mem_detail tbody td {
		padding: 5px 15px !important;
	}
</style>

<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>투어 요금정보 </h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_tourRegist/<?=$category_prd?>/write_info?product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        </li>
						
                        <?php if ($product_idx) { ?>
                            <li><a href="javascript:all_update()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">저장</span></a>
                            </li>
                        <?php } else { ?>
                            <!-- <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            </li> -->
                        <?php } ?>
                       
                    </ul>
                </div>
            </div>
            <!-- // inner -->

        </header>
        <!-- // headerContainer -->

        <form name="chargeForm" id="chargeForm" method="post">
            <input type=hidden name="product_idx" id="product_idx" value="<?= $product_idx ?>">
            <input type=hidden name="info_idx" id="info_idx" value="<?= $info_idx ?>">
			
            <input type=hidden name="o_soldout" value="" id="o_soldout">
            <input type=hidden name="chk_idx"   value="" id="chk_idx">
            <input type=hidden name="updateData" value="" id="updateData">

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
                                <th>상품타입</th>
                                <td>
								    <input type="checkbox" class="spaAll" id="spaAll">전체선택
                                    <?php foreach ($spas_option as $option): ?>
									 <input type="checkbox" name="spa_option" class="spa_option" value="<?=$option['spas_idx']?>"><?=$option['spas_subject']?>
									<?php endforeach; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>날짜지정</th>
                                <td>
                                    <div class="container_date flex__c" style="margin: 0">
                                        <div style="text-align:left;margin-right:20px;">  
                                            <?= $s_date ?> ~ <?= $e_date ?>
                                        </div>

										<div style="text-align:left;">
											<input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" style="text-align: center;background: white; width: 120px;" readonly> ~
											<input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" style="text-align: center;background: white; width: 120px;" readonly>
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="inqCharge" class="btn btn-primary">조회</a>
                                        </div>

                                        <div style="text-align:left;">
											<input type="text" name="days" id="days" value="" numberonly="true" style="text-align:center;background: white; width: 70px;">일
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="addCharge" class="btn btn-primary">추가</a>  
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>일괄적용(단위: 바트)</th>
                                <td>
                                    <div class="container_date flex__c" style="margin: 0">
                                        <div style="text-align:left;">
											<input type="checkbox" class="priceAll" id="checkAll" >전체선택
											<input type="checkbox" class="priceDow" value="일" >일
											<input type="checkbox" class="priceDow" value="월" >월
											<input type="checkbox" class="priceDow" value="화" >화
											<input type="checkbox" class="priceDow" value="수" >수
											<input type="checkbox" class="priceDow" value="목" >목
											<input type="checkbox" class="priceDow" value="금" >금
											<input type="checkbox" class="priceDow" value="토" >토
										</div>
                                        <div style="margin:10px;text-align:left;" class="product-row">
                                            성인가격: <input type="text" name="dowPrice1" id="dowPrice1" value="0" numberonly="true" style="text-align:right;background: white; width: 130px;">
											소아가격: <input type="text" name="dowPrice2" id="dowPrice2" value="0" numberonly="true" style="text-align:right;background: white; width: 130px;">
										</div>
                                        <div style="margin:10px">
                                            <a href="#!" id="dowCharge" class="btn btn-primary">날짜별 일괄 적용</a>  
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <p>
                        <span style="font-weight: bold; color: red;">※</span> 수정불가로 설정되면 가격적용시 수정 되지않습니다. <span style="color:red;">수정가능으로 저장하면, 가격 적용시 수정됩니다.</span>
						<select id="list_rows" name="list_rows" id="list_rows" class="input_select" style="width: 80px" onchange="submitForm();">
							<option value="30"  <?= ($g_list_rows == 30)  ? 'selected' : '' ?>>30개</option>
							<option value="50"  <?= ($g_list_rows == 50)  ? 'selected' : '' ?>>50개</option>
							<option value="100" <?= ($g_list_rows == 100) ? 'selected' : '' ?>>100개</option>
							<option value="200" <?= ($g_list_rows == 200) ? 'selected' : '' ?>>200개</option>
							<option value="500" <?= ($g_list_rows == 500) ? 'selected' : '' ?>>500개</option>
							<option value="900" <?= ($g_list_rows == 900) ? 'selected' : '' ?>>900개</option>
						</select>				
					</p>
                    <div class="listBottom">
         				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <colgroup>
                                <!--col width="5%"-->
                                <col width="5%">
                                <col width="*">
                                <col width="9%">
                                <col width="9%">
                                <col width="9%">
                                <col width="8%">
                                <col width="10%">
                                <col width="10%">
                                <col width="6%">
                            </colgroup>
                            <tbody id="charge">
                                <tr style="height:40px">
                                    <td style="text-align:center">
                                        <input type="checkbox" name="upd_all" class="upd_all" value="Y"  >
                                    </td>
                                    <td style="text-align:center">
                                        상품명
                                    </td>
                                    <td style="text-align:center">
                                        일자
                                    </td>
                                    
                                    <td style="text-align:center">
                                        성인가격
                                        <input type="checkbox" name="" id="price1_all">전체
                                    </td>
                                    <td style="text-align:center">
                                        소아가격
                                        <input type="checkbox" name="" id="price2_all">전체
                                    </td>
                                    <td style="text-align:center">
                                        마감
                                        <input type="checkbox" name="" id="end_all">전체											
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
                                <?php foreach ($spas_price as $item): ?>
                                    <tr>
                                        <td>
                                            <label class="center-checkbox">
                                                <input type="checkbox" name="upd_chk" class="upd_chk <?=$item['dow']?>" data-idx="<?= $item['idx'] ?>"  value="Y">
                                            </label>
                                        </td>
                                        <td style="text-align:center"><?=$item['spas_subject']?></td>                                        
                                        <td style="text-align:center"><?=$item['goods_date']?> [<?=$item['dow']?>]</td>
                                        <td style="text-align:center">
                                            <input type="hidden" name="idx[]" id="idx_<?=$item['idx']?>" value="<?=$item['idx']?>">
                                            <input type="hidden" name="goods_date[]" id="goods_date_<?=$item['idx']?>" value="<?=$item['goods_date']?>">
                                            <input type="text" name="goods_price1[]" id="price1_<?=$item['idx']?>" value="<?=number_format($item['goods_price1'])?>" class="price price1 goods_price input_txt" numberonly="true" style="text-align:right;">
                                        </td>
                                        <td style="text-align:center">
                                            <input type="text" name="goods_price2[]" id="price2_<?=$item['idx']?>" value="<?=number_format($item['goods_price2'])?>" class="price price2 goods_price input_txt" numberonly="true" style="text-align:right;">
                                        </td>
                                        <td style="text-align:center;">
                                            <input type="checkbox" class="use_yn" name="use_yn[]" id="use_yn_<?=$item['idx']?>" data-idx= "<?=$item['idx']?>" value="Y" <?php if($item['use_yn'] == "N") echo "checked";?>>
                                        </td> 
                                        <td style="text-align:center;"><?=$item['reg_date']?></td> 
                                        <td style="text-align:center;"><?=$item['upd_date']?></td> 
                                        <td style="text-align:center;">
                                            <button type="button" class="chargeUpdate" value="<?=$item['idx']?>">수정</button>
                                        </td> 
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
			        </div>
                    <!-- // listBottom -->
					
					<script>
						$(document).ready(function() {
							$("#s_date","#e_date").on("change", function() {
								let selectedDate = $(this).val();
								$("#pg").val('1');
							});
						});
					</script>					

					<script>
                        $(document).ready(function () {
                            $(".upd_all").on("change", function () {
                                // 체크 여부 확인
                                let isChecked = $(this).prop("checked");

                                // row 클래스가 "yes"인 경우만 체크박스 변경
                                $("tr").find("input.upd_chk").prop("checked", isChecked);
                            });
                        });
					</script>
					
					<script>
						$(document).ready(function () {
							// 전체 선택 체크박스 클릭 이벤트
							$('#checkAll').on('change', function () {
								$('.priceDow').prop('checked', $(this).prop('checked'));
							});

							// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
							$('.priceDow').on('change', function () {
								$('#checkAll').prop('checked', $('.priceDow:checked').length === $('.priceDow').length);
							});
						});
					</script>

					<script>
						$(document).ready(function () {
							// 전체 선택 체크박스 클릭 이벤트
							$('#spaAll').on('change', function () {
								$('.spa_option').prop('checked', $(this).prop('checked'));
							});

							// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
							$('.spa_option').on('change', function () {
								$('#spaAll').prop('checked', $('.spa_option:checked').length === $('.spa_option').length);
							});
						});
					</script>
					
					<script>
						$("#inqCharge").one("click", function () {
							$("#in_s_date").val($("#s_date").val());
							$("#in_e_date").val($("#e_date").val());
							$("#priceForm").submit();
						});

						$('#price_all').on('click', function() {
							if ($(this).is(':checked')) {
								var price = $('input[name="price[]"]').first().val();
								$('.price').val(price);
							} else {
								location.reload();
                            }
						});

						$('#price1_all').on('click', function() {
							if ($(this).is(':checked')) {
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price1[]"]').first().val();
								
                                $("tr").find("input.upd_all").prop("checked", true);
                                $("tr").find("input.upd_chk").prop("checked", true);

								if (price !== undefined) {
									$('.price1').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								// location.reload(); // 체크 해제 시 새로고침
							}
						});

						$('#price2_all').on('click', function() {
							if ($(this).is(':checked')) {
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price2[]"]').first().val();

                                $("tr").find("input.upd_all").prop("checked", true);
                                $("tr").find("input.upd_chk").prop("checked", true);

								if (price !== undefined) {
									$('.price2').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								// location.reload(); // 체크 해제 시 새로고침
							}
						});

						$('#price3_all').on('click', function() {
							if ($(this).is(':checked')) {
								// 첫 번째 `price1[]` 값 가져오기
								var price = $('input[name="goods_price3[]"]').first().val();
								
                                $("tr").find("input.upd_all").prop("checked", true);
                                $("tr").find("input.upd_chk").prop("checked", true);

								if (price !== undefined) {
									$('.price3').val(price);
								} else {
									alert("가격을 찾을 수 없습니다.");
								}
							} else {
								// location.reload(); // 체크 해제 시 새로고침
							}
						});

					</script>

					<script>
                        $(document).ready(function(){
                            // 전체 선택/해제
                            $("#end_all").on("change", function(){
                                $(".use_yn").prop("checked", $(this).prop("checked"));
                            });

                            // 개별 체크 시 전체 체크박스 상태 변경
                            $(".use_yn").on("change", function(){
                                let total = $(".use_yn").length;
                                let checked = $(".use_yn:checked").length;
                                $("#end_all").prop("checked", total === checked);
                            });
                        });
					</script>

					<script>
						$("#addCharge").one("click", function () {
                            if (!confirm("일자를 추가 하시겠습니까?"))
                                return false;

                            var product_idx = $("#product_idx").val(); 
                            var info_idx    = $("#info_idx").val(); 
                            var days        = $("#days").val();
                            
                            $.ajax({
                                url: "<?= route_to('admin.api.spa_.spas_price_add') ?>",
                                type: "POST",
                                data: {
                                    "product_idx" : product_idx,
                                    "info_idx"    : info_idx, 
                                    "days"        : days 
                                },
                                dataType: "json",
                                async: false,
                                cache: false,
                                success: function(data, textStatus) {
                                    var message = data.message;
                                    var s_date  = data.s_date;
                                    var e_date  = data.e_date;
                                    alert(message);
                                    location.href='/AdmMaster/_tourRegist/<?=$category_prd?>/list_price?product_idx='+$("#product_idx").val()+'&info_idx='+$("#info_idx").val();
                                },
                                error:function(request,status,error){
                                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                }
                            });
                        });

					</script>

					<script>
                        $(document).ready(function () {
                            $('#dowCharge').click(function () {
                                count_chk = 0;
                                $(".spa_option:checked").each(function() {
                                    count_chk++;
                                });

                                if(count_chk == 0){
                                    alert("상품타입 선택해주세요!");
                                    return false;
                                }

                                if (!confirm("금액 일괄적용을 처리 하시겠습니까?"))
                                    return false;

                                var checkedIdx = [];
                                var uncheckedIdx = [];

                                // 모든 .upd_chk 체크박스를 순회
                                $(".upd_chk").each(function() {
                                    // data-idx 값을 가져옵니다.
                                    var idx = $(this).data("idx");
                                    // 체크 여부에 따라 배열에 추가
                                    if ($(this).is(":checked")) {
                                        checkedIdx.push(idx);
                                    } else {
                                        uncheckedIdx.push(idx);
                                    }
                                });

                                // 체크된 베드타입 가져오기
                                var spa_option = "";

                                const spaOptionValues = $('.spa_option:checked') // 체크된 요소만 선택
                                .map(function () {
                                    return "'"+$(this).val()+"'"; // 각 체크박스의 value 값 반환
                                })
                                .get(); // 결과를 배열로 변환

                                // 결과 출력
                                if(spaOptionValues) {
                                    spa_option = spaOptionValues.join(', ');
                                }
                                
                                // 체크된 요일 가져오기
                                var dow_val = "";

                                const checkedValues = $('.priceDow:checked') // 체크된 요소만 선택
                                .map(function () {
                                    return "'"+$(this).val()+"'"; // 각 체크박스의 value 값 반환
                                })
                                .get(); // 결과를 배열로 변환

                                // 결과 출력
                                if(checkedValues) {
                                    dow_val = checkedValues.join(', ');
                                }

                                if(dow_val == "") {
                                    alert('적용할 요일을 선택하세요.');
                                    return false;
                                }

                                if($("#dowPrice1").val() < "1") {
                                    alert('기본가를 입력하세요.');
                                    $("#dowPrice1").focus();
                                    return false;
                                }

                                if($("#dowPrice2").val() < "1") {
                                    alert('컨택가를 입력하세요.');
                                    $("#dowPrice2").focus();
                                    return false;
                                }

                                // if($("#dowPrice3").val() < "1") {
                                //     alert('수익가를 입력하세요.');
                                //     $("#dowPrice3").focus();
                                //     return false;
                                // }

                                $.ajax({

                                    url: "<?= route_to('admin.api.spa_.update_all_price') ?>",
                                    type: "POST",
                                    data: {
                                            "s_date"       : $("#s_date").val(),
                                            "e_date"       : $("#e_date").val(),	
                                            "spa_option"   : spa_option,
                                            "dow_val"      : dow_val,
                                            "product_idx"  : $("#product_idx").val(),
                                            "info_idx"     : $("#info_idx").val(),
                                            "goods_price1" : $("#dowPrice1").val(),
                                            "goods_price2" : $("#dowPrice2").val(),
                                        },
                                    dataType: "json",
                                    async: false,
                                    cache: false,
                                    success: function(data, textStatus) {
                                        var message = data.message;
                                        alert(message);
                                        location.reload();
                                    },
                                    error:function(request,status,error){
                                        alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                                    }
                                });
                            });
                        });
					</script>

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
                                minDate: new Date(),
                                maxDate: "+99Y",
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
                                , minDate: new Date() 
                                , maxDate: "+99Y"
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
                                <a href="/AdmMaster/_tourRegist/<?=$category_prd?>/write_info?product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>											
								<?php if ($product_idx) { ?>
                                    <a href="javascript:all_update()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span class="txt">저장</span></a>
									<li>
									</li>
								<?php } else { ?>
									<!-- <li><a href="javascript:send_it()" class="btn btn-default"><span
													class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
									</li> -->
								<?php } ?>
								
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // listWrap -->

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tourRegist/'.$category_prd.'/list_price?product_idx='.$product_idx.'&info_idx='.$info_idx.'&s_date='.$s_date.'&e_date='.$e_date.'&g_list_rows='.$g_list_rows) . "&pg=") ?>

            </div>
            <!-- // contents -->
        </form>
    </div><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->

<script>
    $(document).ready(function() {
        // 차량정보 확인버튼 클릭 이벤트
        $(".chargeUpdate").click(function() {

            if (!confirm("가격정보를 수정 하시겠습니까?"))
                return false;

            var idx      = $(this).val();
            var use_yn   = ""; 
            if ($("#use_yn_"+idx).prop('checked')) {
                var use_yn = "N";
            }

            $.ajax({

                url: "<?= route_to('admin.api.spa_.spa_price_update') ?>",
                type: "POST",
                data: {
                    "idx"           : idx,
                    "goods_price1"  : $("#price1_"+idx).val(),
                    "goods_price2"  : $("#price2_"+idx).val(),
                    "use_yn"        : use_yn 
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    var message  = data.message;
                    alert(message);
                    location.reload();
                },
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        });

    });			
</script>

<script>
    $(document).ready(function() {
        // 차량정보 삭제버튼 클릭 이벤트
        $(".chargeDelete").click(function() {

            if (!confirm("가격정보를 삭제 하시겠습니까?"))
                    return false;

            var idx      = $(this).val();
            var message  = "";
            $.ajax({

                url: "/ajax/golf_price_delete",
                type: "POST",
                data: {
                    "idx" : idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    message  = data.message;
                    location.reload();
                },
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        });
    });			
</script>

<script>
    function all_update() {    
        // 배열 초기화
        var checkedIdx = [];
        var uncheckedIdx = [];

        // 모든 .upd_chk 체크박스를 순회
        $(".upd_chk").each(function() {
            // data-idx 값을 가져옵니다.
            var idx = $(this).data("idx");
            // 체크 여부에 따라 배열에 추가
            if ($(this).is(":checked")) {
                checkedIdx.push(idx);
            } else {
                uncheckedIdx.push(idx);
            }
        });

        let rows = [];

        $("tr:has(.upd_chk:checked)").each(function () {
            let row = {
                idx: $(this).find(".upd_chk").data("idx"),
                goods_price1: $(this).find("[name='goods_price1[]']").val().replace(/,/g, ""),
                goods_price2: $(this).find("[name='goods_price2[]']").val().replace(/,/g, ""),
                use_yn: $(this).find(".use_yn").is(":checked") ? "N" : "Y" // 체크되었으면 "N", 해제되었으면 "Y"			
            };
            rows.push(row);
        });

        if (rows.length > 0) {
            $.ajax({
                url: "<?= route_to('admin.api.spa_.spas_all_update') ?>", // 실제 업데이트할 API URL
                type: "POST",
                data: { 
                    rows : rows 
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        alert("업데이트 완료!");
                        location.reload();
                    } else {
                        alert("업데이트 실패: " + response.message);
                    }
                },
                error: function () {
                    alert("서버 오류가 발생했습니다.");
                }
            });
        } else {
            alert("수정할 항목이 없습니다.");
        }
    }

    function send_it(idx) {
        var o_soldout = [];
        var chk_idx   = "";

        // 선택된 체크박스의 값을 배열에 추가
        $(".use_yn:checked").each(function () {
            o_soldout.push($(this).val());
            chk_idx += $(this).data("idx")+':'+'N,';
        });

        $('.use_yn:not(:checked)').each(function () {
            chk_idx += $(this).data("idx")+':'+'Y,';
        });

        $("#o_soldout").val(o_soldout.join("||"));
        $("#chk_idx").val(chk_idx);

        let f = document.chargeForm;

        let url = "/ajax/golf_price_allupdate"
        let price_data = $(f).serialize();
        $.ajax({
            type: "POST",
            data: price_data,
            url: url,
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
</script>

<script>
    function submitForm() {
        $("#g_list_rows").val($("#list_rows").val());
        $("#pg").val('1');
        document.getElementById("priceForm").submit();
    }
</script>

<form name="priceForm" id="priceForm" method="get" action="/AdmMaster/_tourRegist/<?=$category_prd?>/list_price">
    <input type="hidden" name="product_idx"  value='<?=$product_idx?>' >
    <input type="hidden" name="info_idx"     value="<?=$info_idx?>" >
    <input type="hidden" name="s_date"       value="<?=$s_date?>" id="in_s_date" >
    <input type="hidden" name="e_date"       value="<?=$e_date?>" id="in_e_date" >
    <input type="hidden" name="g_list_rows"  value="<?=$g_list_rows?>" id="g_list_rows">
    <input type="hidden" name="pg"           value="<?=$pg?>" id="pg">
</form>

<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>