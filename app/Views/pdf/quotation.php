<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'DejaVu Sans'; font-size: 12pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        h1, h3 { text-align: center; }
    </style>
</head>
<body>

<h1>더투어랩 여행견적서</h1>
<h3>TOTO Booking Co., Ltd.</h3>

<p>Sukhumvit 101 Bangjak<br>
Prakhanong Bangkok 10260<br>
서비스/여행업 No.101-86-79949</p>

<p>견적일: <?= $quotation_date ?><br>
고객명: <?= $customer_name ?> 님 귀하</p>
<img src="/img/sub/sign-001.jpg" class="img_stem">

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

<p style="margin-top: 30px;">
- 상기 견적은 고객님께서 직접 선택하신 상품으로 발행된 견적서입니다.<br>
- 견적서상 내용은 항공 및 예약 가능여부/환율 등에 따라 금액 및 내용에 변동이 있을 수 있습니다.<br>
- 계좌번호: 636101-01-3031315 (주) 토토북킹<br>
- 태국: Kasikorn Bank 895-2-19850-6 (Totobooking)
</p>

</body>
</html>
