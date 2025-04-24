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
              <input type="text" value="<?=session()->get("member")["email"]?>">
              <button>메일보내기 </button>
          </div>
          <div class="btns_download">
              <button id="btn_print">프린트</button>
              <button id="btn_pdf" value="<?= esc($i['group_no']) ?>"> PDF다운로드</button>
          </div>
      </div>

		<script>
			// 프린트 버튼 클릭 시 브라우저 인쇄 기능 실행
			// $(document).on('click', '#btn_print', function () {
			// 	window.print();
			// });

            $(document).on('click', '#btn_print', function () {
                const content = document.querySelector('.estimate_popup_content').innerHTML;

                let iframe = document.createElement('iframe');
                iframe.name = "printFrame";
                iframe.style.position = 'absolute';
                iframe.style.top = '-9999px';
                document.body.appendChild(iframe);

                let frameDoc = iframe.contentWindow || iframe.contentDocument;
                if (frameDoc.document) frameDoc = frameDoc.document;

                frameDoc.open();
                frameDoc.write(`
                    <html>
                    <head>
                        <title>여행 견적서</title>
                        <link href="css/mypage/mypage_new.css" rel="stylesheet" />
                        <style>
                            @media print {
                                body {
                                    background: white !important;
                                    margin: 0;
                                    padding: 0;
                                    color: #000;
                                }

                                .estimate_popup_content {
                                    box-shadow: none;
                                    width: 100%;
                                    padding: 0;
                                }

                                /* 불필요한 요소 숨기기 */
                                .btns_download,
                                .send_mail,
                                .btn_close_popup,
                                nav,
                                footer {
                                    display: none !important;
                                }

                                /* a 태그 자동 링크 표시 방지 */
                                a[href]:after {
                                    content: "" !important;
                                }

                                /* 이미지 max-width 제한 해제 */
                                img {
                                    max-width: none !important;
                                }

                                h1 {
                                    text-align: center;
                                    font-size: 24px;
                                    font-weight: bold;
                                    margin-bottom: 30px
                                }
                                
                                .sec1 {
                                    display: flex;
                                    /* gap: 30px; */
                                    justify-content: space-between;
                                }
                                
                                .sec1 .left {
                                    position: relative;
                                    width: 294px;
                                }
                                
                                .sec1 .left .img_stem {
                                    position: absolute;
                                    top: 12px;
                                    right: 5px;
                                    width: 60px;
                                }
                                
                                .sec1 .ttl {
                                    font-size: 16px;
                                    margin-bottom: 8px;
                                    color: #353535;
                                    font-weight: 600;
                                }
                                
                                .sec1 .left>span {
                                    font-size: 14px;
                                    color: #757575;
                                    margin-bottom: 5px;
                                    display: block;
                                }
                                
                                .sec1 .left .day,
                                .sec1 .left .name {
                                    font-size: 14px;
                                    color: #252525;
                                    padding: 10px 0;
                                    border-bottom: 1px solid #999
                                }
                                
                                table {
                                    border-collapse: collapse;
                                    width: 100%;
                                }
                                
                                td,
                                th {
                                    border: 1px solid #dbdbdb;
                                    padding: 6px;
                                    text-align: center;
                                    font-size: 14px;
                                    color: #252525
                                }
                                
                                th {
                                    background-color: #fafafa
                                }
                                
                                tr .total {
                                    color: rgb(250, 17, 17)
                                }
                                
                                .sec2 {
                                    margin-top: 40px
                                }
                                
                                .sec2 .time {
                                    font-size: 14px;
                                    font-weight: 600;
                                    text-align: left;
                                    margin-bottom: 4px;
                                
                                }
                                
                                .sec2 .time+p {
                                    text-align: left;
                                    color: #757575;
                                    font-size: 12px
                                }
                                
                                .sec2 td {
                                    padding: 12px
                                }
                                
                                .list_desc {
                                    margin-top: 20px;
                                    margin-bottom: 34px;
                                }
                                
                                .list_desc p {
                                    font-size: 13px;
                                    color: #656565;
                                    line-height: 1.4;
                                }
                                
                                .send_mail {
                                    display: flex;
                                    align-items: center;
                                    gap : 8px;
                                    padding-top: 35px;
                                    border-top: 1px solid #dbdbdb;
                                }
                                
                                .send_mail input {
                                    flex: 1;
                                    padding: 0 10px;
                                    border: 1px solid #dbdbdb;
                                    outline: none;
                                    height: 45px;
                                    font-size: 14px;
                                    color : #555
                                }
                                
                                .send_mail button {
                                    font-size: 14px;
                                    font-weight: 700;
                                    color: #666;
                                    border: 1px solid #dbdbdb;
                                    height: 45px;
                                    padding: 10px 20px;
                                }
                                
                                .btns_download {
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    gap : 4px;
                                    margin-top: 35px
                                }
                                
                                .btns_download button {
                                    font-size: 15px;
                                    font-weight: 700;
                                    padding: 16px 36px;
                                    background-color: #17469e;
                                    color: #fff;
                                    border: none;
                                
                                }
                            }
                        </style>
                    </head>
                    <body>
                        ${content}
                    </body>
                    </html>
                `);
                frameDoc.close();

                setTimeout(function () {
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                    document.body.removeChild(iframe); 
                }, 500);
            });

			
			// PDF 버튼 클릭 시
			$(document).on('click', '#btn_pdf', function () {
				var group_no = $(this).val(); 
				location.href='/pdf/quotation?group_no='+group_no;
			});
		</script>
