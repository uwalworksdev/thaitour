<link href="<?= base_url('css/mypage/mypage_new.css') ?>" rel="stylesheet" />
<link href="<?= base_url('css/mypage/mypage_reponsive_new.css') ?>" rel="stylesheet" />
	  <div class="group_movement_popup_content custom_popup_content">
         <div class="btn_close_popup">
              <img src="/img/btn/btn_close_black_20x20.png" alt="">
          </div>
          <h1>그룹이동</h1>
          <div class="sec2">
            <div class="box_select">
                <select name="group_select" id="group_select" style="width:300px;">
                <?php foreach ($groups as $g): ?>
                    <option value="<?= esc($g['group_no']) ?>">그룹번호 <?= esc($g['group_no']) ?></option>
                <?php endforeach; ?>
                </select>
                <div class="btn_select" id="btn_select">그룹이동</div>
            </div>
              <table>
                  <colgroup>
                      <col width="30px">
                      <col width="70px">
                      <col width="*">
                      <col width="110px">
                  </colgroup>
                  <tbody>
				  
                      <tr>
                          <th><input id="check_all" type="checkbox"><label for="check_all"></label></th>
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
                        <td>
                            <input id="check_b_<?= esc($i['order_idx']) ?>" type="checkbox" value="<?= esc($i['order_idx']) ?>">
                            <label for="check_b_<?= esc($i['order_idx']) ?>"></label>
                        </td>
                          <td><?= esc($i['code_name']) ?></td>
                          <td>
                              <p class="time"><?= esc($i['product_name']) ?></p>
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
              <p>* 상품을 선택하고 그룹을 선택 후 그룹이동 버튼을 클릭합니다. </p>
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