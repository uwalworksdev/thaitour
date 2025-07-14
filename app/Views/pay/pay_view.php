<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <title>카드결제 - 결제하기</title>
  <style>
    body { font-family: Arial, sans-serif; text-align: center; }
    .step { margin: 20px auto; display: flex; justify-content: center; }
    /*.step div { padding: 10px 20px; border-radius: 20px; background-color: #f2f2f2; margin: 0 5px; }*/
    .active { background-color: #2d3e9b; color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
    .info-box { margin-top: 40px; text-align: left; display: inline-block; }
    .info-box p { margin: 5px 0; }
    button { padding: 10px 30px; background-color: #2d3e9b; color: white; border: none; border-radius: 5px; margin-top: 30px; }
  </style>
</head>
<body>

  <h2>카드결제</h2>
  <div class="step">
    <div>01 결제 로그인 인증</div>
    <div class="active">02 카드결제</div>
    <div>03 결제완료</div>
  </div>

  <h1><?= esc($product_title) ?></h1>

  <div class="info-box">
    <h3>결제정보</h3>
    <p>예약자명: <?= esc($reservation_name) ?></p>
    <p>이메일: <?= esc($email) ?></p>
    <p>주문번호: <?= esc($order_number) ?></p>
    <p>선금 결제금액: <?= number_format($amount) ?>원</p>
  </div>

  <form action="/pay/complete" method="post">
    <button type="submit">결제하기</button>
  </form>

</body>
</html>
