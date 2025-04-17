<link href="<?= base_url('css/mypage/mypage_new.css') ?>" rel="stylesheet" />
	  <div class="group_movement_popup_content custom_popup_content">
         <div class="btn_close_popup">
              <img src="/img/btn/btn_close_black_20x20.png" alt="">
          </div>
          <h1>그룹이동</h1>
          <div class="sec2">
            <div class="box_select">
                <select name="group_select" id="group_select" style="width:100px;">
                <?php foreach ($groups as $g): ?>
                    <option value="<?= esc($g['group_no']) ?>">그룹번호 <?= esc($g['group_no']) ?></option>
                <?php endforeach; ?>
                </select>
                <div class="btn_select">그룹이동</div>
            </div>
              <table>
                  <colgroup>
                      <col width="30px">
                      <col width="70px">
                      <col width="*">
                      <col width="110px">
                  </colgroup>
                  <tbody>
				  <?php foreach ($items as $i): ?>
                      <tr>
                          <th><input id="check_all" type="checkbox"><label for="check_all"></label></th>
                          <th>품목</th>
                          <th>상세</th>
                          <th>금액</th>

                      </tr>
                      <tr>
                        <td>
                            <input id="check_b_<?= esc($i['order_idx']) ?>" type="checkbox">
                            <label for="check_b_<?= esc($i['order_idx']) ?>"></label>
                        </td>
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
              <p>* 상품을 선택하고 그룹을 선택 후 그룹이동 버튼을 클릭합니다. </p>
          </div>
      </div>
