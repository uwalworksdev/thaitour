<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12pt; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        h1 { text-align: center; }
        tr, td, th { page-break-inside: avoid; }
		.img_stem {
			position: absolute;
			top: 12px;
			right: 5px;
			width: 60px;
		}		
    </style>
</head>
<body>
    <h1>더투어랩 여행견적서</h1>
    <h3>TOTO Booking Co., Ltd.</h3>
    <p>
        Sukhumvit 101 Bangjak<br>
        Prakhanong Bangkok 10260<br>
        서비스/여행업 No.101-86-79949
    </p>
    <img src="<?= FCPATH . 'img/sub/sign-001.jpg' ?>" width="150">

    <p>
        견적일: <?=date('Y')?>년 <?=date('m')?>월 <?=date('d')?>일<br>
        고객명: <?=session()->get("member")["name"]?> 님 귀하
    </p>

    <table>
	  <colgroup>
		  <col width="50%">
		  <col width="*">
		  <col width="30%">
	  </colgroup>
	  <tbody>		
		<tr>
		    <th align="center">예약구분</th>
			<th align="center">건수(건)</th>
			<th align="center">예약금액(원)</th>
		</tr>
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
		    <th align="center"><?= esc($i['code_name']) ?></th>
		    <td align="right"><?= esc($i['cnt']) ?></td>
		    <td align="right"><?= number_format(esc($i['total_won'])) ?></td>
        </tr>
        <?php endforeach; ?>		
	    <tr>
		    <th align="center">합계 </th>
		    <td align="right"><?=$tot_cnt?></td>
		    <td align="right"><?=number_format($tot_won)?></td>
	    </tr>
	  <tbody>		
    </table>
	<table>
	  <colgroup>
		  <col width="10%">
		  <col width="*">
		  <col width="20%">
	  </colgroup>
	  <tbody>
		  <tr>
			  <th>예약상품</th>
			  <th>상세</th>
			  <th>금액(원)</th>
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
	</tbody>
	</table>
          <div class="list_desc">
              <p>- 상기 견적은 고객님께서 직접 선택하신 상품으로 발행된 견적서입니다. </p>
              <p>- 견적서상 내용은 확정 예약시 상품의 예약가능여부/환을 등에 따라 금액 및 내용에 변동이 있을 수 있습니다. </p>
              <p>- 한국 : 국민은행 636101-01-301315 (주) 토토부킹 </p>
              <p>- 태국: Kasikorn Bank 895-2-19850-6 (Totobooking) </p>
          </div>
 </body>
</html>
