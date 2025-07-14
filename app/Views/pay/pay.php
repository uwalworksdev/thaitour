<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <title>카드결제 - 인증</title>
  <style>
    body { font-family: Arial, sans-serif; text-align: center; }
    .step { margin: 20px auto; display: flex; justify-content: center; }
    .step div { padding: 10px 20px; border-radius: 20px; background-color: #c3bebe; margin: 0 5px; }
    .active { background-color: #2d3e9b; color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
    .form-box { margin-top: 40px; }
    input { padding: 10px; width: 250px; margin-bottom: 20px; }
    button { padding: 10px 30px; background-color: #2d3e9b; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>

  <h2>카드결제</h2>
  <div class="step">
    <div class="active">01 결제 로그인 인증</div>
    <div>02 카드결제</div>
    <div>03 결제완료</div>
  </div>

  <h1>인증 후 결제 진행이 가능합니다.</h1>
  <p>주문 시 입력한 휴대폰번호 뒷자리 4자리를 입력해 인증해주세요.</p>

  <div class="form-box">
    <form action="/pay/check" method="get">
      <input type="hidden" name="idx" value="<?= esc($idx) ?>" />
      <input type="text" name="phone_last4" placeholder="휴대폰 뒷자리 4자리" maxlength="4" required />
      <br>
      <button type="submit">확인</button>
    </form>
  </div>

</body>
</html>
