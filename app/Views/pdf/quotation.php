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

    <p>- 계좌번호: 636101-01-3031315 (주) 토토북킹</p>
</body>
</html>
