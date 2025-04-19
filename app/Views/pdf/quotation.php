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
    <img src="/img/sub/sign-001.jpg" class="img_stem">

    <p>
        견적일: <?= esc($quotation_date) ?><br>
        고객명: <?= esc($customer_name) ?> 님 귀하
    </p>

    <table>
        <tr>
            <th>호텔</th><td><?= $hotel_count ?></td><td><?= $hotel_price ?></td>
            <th>골프</th><td><?= $golf_count ?></td><td><?= $golf_price ?></td>
        </tr>
        <tr>
            <th>투어</th><td><?= $tour_count ?></td><td><?= $tour_price ?></td>
            <th>차량</th><td><?= $car_count ?></td><td><?= $car_price ?></td>
        </tr>
        <tr>
            <th>가이드</th><td><?= $guide_count ?></td><td><?= $guide_price ?></td>
            <th>합계</th><td><?= $total_count ?></td><td><?= $total_price ?></td>
        </tr>
    </table>
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
													<tr>
			  <td>스파</td>
			  <td>
				  <p class="time">2025-04-16 18:36:59(수) | Spa 테스트 상품... </p>
				  <p>성인: 테스트 3: 1명 | 아동: 테스트 4: 1명 </p>
			  </td>
			  <td>
				  <p>212원 </p>
				  <p>(5바트) </p>
			  </td>
		  </tr>
													<tr>
			  <td>레스토랑</td>
			  <td>
				  <p class="time">2025-04-16 21:46:57(수) | 테스트 상품 0304 </p>
				  <p>성인: 테스트 : 1명 | 아동: 테스트 1: 1명 </p>
			  </td>
			  <td>
				  <p>127,230원 </p>
				  <p>(3,000바트) </p>
			  </td>
		  </tr>
		  <tr>
			  <td>차량</td>
			  <td>
				  <p class="time">2025-04-16 22:02:33(수) | 프리미엄세단 (도요타 알티스, 캠리 등 준중형 세단) 좌석 3개 (어른7) </p>
				  <p> </p>
			  </td>
			  <td>
				  <p>42,410원 </p>
				  <p>(1,000바트) </p>
			  </td>
		  </tr>
	</tbody>
	</table>
    <p>- 계좌번호: 636101-01-3031315 (주) 토토북킹</p>
</body>
</html>
