<link href="<?= base_url('css/mypage/mypage_new.css') ?>" rel="stylesheet" />

	<style>
	@media print {
		.btns_download,
		.send_mail,
		.btn_close_popup {
			display: none !important;
		}

		body {
			background: white;
		}

		.estimate_popup_content {
			box-shadow: none;
		}
	}
	</style>
	
      <div class="estimate_popup_content custom_popup_content">
         <div class="btn_close_popup">
              <img src="/img/btn/btn_close_black_20x20.png" alt="">
          </div>
          <h1>더투어랩 여행견적서 </h1>
          <div class="sec1">
              <div class="left">
                  <p class="ttl">The Tour Lab Co.,Ltd </p>
                  <span>Sukhumvit 13 Klongtoei Nuea </span>
                  <span>Watthana Bangkok 10110 </span>
                  <span>서비스/여행업 No. 0105565060507 </span>
                  <p class="day">견적일 : <?=date('Y')?>년 <?=date('m')?>월 <?=date('d')?>일 </p>
                  <p class="name">고객명 : <?=session()->get("member")["name"]?> 님 귀하 </p>
                  <img src="/img/sub/sign-001.jpg" class="img_stem">
              </div>
              <div class="right">
                  <table>
                      <colgroup>
                          <col width="110px">
                          <col width="110px">
                          <col width="110px">
                      </colgroup>
                      <tbody>
					      <?php
						    $tot_cnt = 0;
						    $tot_won = 0;
						  ?>	
					      <?php foreach ($sum as $i): ?>
					      <?php
						    $tot_cnt = $tot_cnt + $i['cnt'];
						    $tot_won = $tot_won + $i['total_won'];
						  ?>	
                          <tr>
                              <th><?= esc($i['code_name']) ?></th>
                              <td><?= esc($i['cnt']) ?>건 </td>
                              <td><?= number_format(esc($i['total_won'])) ?>원 </td>
                          </tr>
						  <?php endforeach; ?>
                          <tr>
                              <th class="total">합계 </th>
                              <td class="total"><?=$tot_cnt?>건 </td>
                              <td class="total"><?=number_format($tot_won)?>원 </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div class="sec2">
              <table>
                  <colgroup>
                      <col width="70px">
                      <col width="*">
                      <col width="110px">
                  </colgroup>
                  <tbody>
                      <tr>
                          <th>품목</th>
                          <th>상세</th>
                          <th>금액</th>
                      </tr>
					  <?php foreach ($items as $i): ?>
					  <?php
							$order_info  = "";
							
							if($i['order_gubun'] == "hotel" || $i['order_gubun'] == "golf" || $i['order_gubun'] == "spa" || $i['order_gubun'] == "restaurant") {
							   $order_info = order_info($i['order_gubun'], $i['order_no'], $i['order_idx']);
							}   
					  ?>
                      <tr>
                          <td><?= esc($i['code_name']) ?></td>
                          <td>
                              <p class="time"><?= esc($i['order_date'])?>(<?= esc(dateToYoil($i['order_date']))?>) | <?= esc($i['product_name']) ?> </p>
                              <p><?=$order_info?> </p>
                          </td>
                          <td>
                              <p><?= number_format(esc($i['real_price_won'])) ?>원 </p>
                              <p>(<?= number_format(esc($i['real_price_bath'])) ?>바트) </p>
                          </td>
                      </tr>
					  <?php endforeach; ?>
              </table>
          </div>
  
          <div class="list_desc">
              <p>- 상기 견적은 고객님께서 직접 선택하신 상품으로 발행된 견적서입니다. </p>
              <p>- 견적서상 내용은 확정 예약시 상품의 예약가능여부/환을 등에 따라 금액 및 내용에 변동이 있을 수 있습니다. </p>
              <p>- 한국 : 국민은행 636101-01-301315 (주) 토토부킹 </p>
              <p>- 태국: Kasikorn Bank 895-2-19850-6 (Totobooking) </p>
          </div>
          <div class="send_mail">
              <input type="text" value="lifeess@naver.com ">
              <button>메일보내기 </button>
          </div>
          <div class="btns_download">
              <button id="btn_print">프린트</button>
              <button> PDF다운로드</button>
          </div>
      </div>

		<script>
			// 프린트 버튼 클릭 시 브라우저 인쇄 기능 실행
			$(document).on('click', '#btn_print', function () {
				window.print();
			});
		</script>

		<script>
		$(document).on('click', '#btn_select', function() {
			
				// 예: 선택된 그룹 값 가져오기
				let selectedGroup = $('#group_select').val();
				if(selectedGroup == "") {
				   alert('이동 그룹을 선택하세요.');
				   $("#group_select").focus();
				   return false;
				}   
				
				// 예: 체크된 항목 수
				let selectedItems = $('input[type="checkbox"][id^="check_b_"]:checked')
					.map(function () {
						return $(this).val();
					})
					.get()
					.join('|');

				if(selectedItems == "") {
				   alert('이동할 에약을 선택하세요.');
				   return false;
				}   
					
				console.log('선택된 그룹:', selectedGroup);
				console.log('선택된 예약:', selectedItems);
				
				$.ajax({

					url: "/ajax/ajax_group_change",
					type: "POST",
					data: {

						"selectedGroup": selectedGroup, 
						"order_idxs"   : selectedItems 

					},
					dataType: "json",
					async: false,
					cache: false,
					success: function (data, textStatus) {
						var message = data.message;
						alert(message);
						location.reload();
					},
					error: function (request, status, error) {
						alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
					}
				});				
		});

		$(document).on('click', '#check_all', function () {
				const isChecked = $(this).is(':checked');
				
				// 모든 개별 체크박스에 체크 상태 설정
				$('input[type="checkbox"][id^="check_b_"]').prop('checked', isChecked);
		});
		</script>