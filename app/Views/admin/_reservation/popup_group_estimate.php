<link href="<?= base_url('css/mypage/mypage_new.css') ?>" rel="stylesheet" />

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
                          <tr>
                              <th>호텔 </th>
                              <td>0건 </td>
                              <td>0원 </td>
                          </tr>
                          <tr>
                              <th>골프 </th>
                              <td>1건 </td>
                              <td>303,175원 </td>
                          </tr>
                          <tr>
                              <th>투어 </th>
                              <td>1건 </td>
                              <td>39,000원 </td>
                          </tr>
                          <tr>
                              <th>차량 </th>
                              <td>0건 </td>
                              <td>0원 </td>
                          </tr>
                          <tr>
                              <th>가이드 </th>
                              <td>0건 </td>
                              <td>0원 </td>
                          </tr>
                          <tr>
                              <th class="total">합계 </th>
                              <td class="total">2건 </td>
                              <td class="total">342,175원 </td>
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
                      <tr>
                          <td>골프 </td>
                          <td>
                              <p class="time">2025-03-28(금) | 로얄 방파인 골프 클럽 </p>
                              <p>18홀 오전 | 성인 2명 | 그린피 : 6,700바트 | 3,350바트 X 2명 </p>
                          </td>
                          <td>
                              <p>303,175원 </p>
                              <p>(6,700바트) </p>
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
              <button>프린트</button>
              <button> PDF다운로드</button>
          </div>
      </div>

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