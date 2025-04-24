<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <style>
        
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

		.dom-line {
			padding: 10px 0;
			font-size: 14px;
			color: #000;
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

		.line_new {
			width: 100%;
			height: 1px;
			background-color: #000;
		}
	
    </style>
</head>
<body>
	<div style="width: 100%">
		<h1>더투어랩 여행견적서</h1>
		<table style="width: 100%; border: unset; height: 100%;">
			<tr style="border: unset; height: 100%;">
				<td style="width: 48%; text-align:left; border: unset;">
					<table style="width: 100%; border: unset;">
						<tr style="border: unset;">
							<td style="vertical-align: top; text-align:left; border: unset;">
								<div style="margin: 0; font-weight: bold; font-size: 18px; color: #000">The Tour Lab Co.,Ltd</div> <br>
								<div style="">Sukhumvit 13 Klongtoei Nuea</div>
								<div style="">Watthana Bangkok 10110</div>
								<div style="">서비스/여행업 No. 0105565060507</div> <br>
								<div class="dom-line" style="marign-top: 10px">
								견적일 : <?=date('Y')?>년 <?=date('m')?>월 <?=date('d')?>일
								</div>
								<hr style="border: none; height: 1px; background-color: #000;">
								<div class="dom-line">
								고객명 : <?=session()->get("member")["name"]?> 님 귀하
								</div>
								<hr style="border: none; height: 1px; background-color: #000;">
							</td>

							<td style="width: 60px; text-align: right; vertical-align: top; border: unset;">
								<img src="<?= FCPATH . 'img/sub/sign-001.jpg' ?>" style="width: 60px;">
							</td>
						</tr>
					</table>
				</td>
				<td style="width: 4%; vertical-align: top; border: unset;"></td>
				<td style="width: 48%; vertical-align: top; border: unset;">
				<table style="width: 100%; border-collapse: collapse; border: unset;">
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
				</td>
			</tr>
		</table>

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
						<td style="text-align: left">
							<p class="time" style="font-size: 14px; color: #000; font-weight: bold"><?= esc($i['order_date'])?>(<?= esc(dateToYoil($i['order_date']))?>) | <?= esc($i['product_name']) ?> </p>
							<p style="font-size: 12px; color: #757575;"><?=$order_info?> </p>
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
              <p>- 태국: Kasikorn Bank 895-2-19850-6 (Totobooking)xxxx </p>
          </div>
          <div class="send_mail">
              <input type="text" value="lifeess@naver.com ">
              <button>메일보내기.. </button>
          </div>
          <div class="btns_download">
              <button>프린트</button>
              <button> PDF다운로드</button>
          </div>		  
	</div>

	<!-- <p>견적일: <?= date('Y년 m월 d일') ?><br>
	   고객명: <?=session()->get("member")["name"]?> 님 귀하</p> -->

 </body>
</html>
