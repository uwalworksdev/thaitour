<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>카드결제 - 인증</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 0;
      padding: 20px;
      box-sizing: border-box;
      background-color: #f9f9f9;
    }

    h2 {
      margin-bottom: 10px;
      color: #333;
    }

	.step div {
	  padding: 10px 20px;
	  border-radius: 20px;
	  background-color: #e0e0e0;     /* 비활성 단계 색상 */
	  color: #666;
	  margin: 5px;
	  font-weight: 500;
	  transition: background-color 0.3s, color 0.3s;
	}

	.step .active {
	  background-color: #2d3e9b;     /* 활성 단계 색상 */
	  color: #fff;
	  font-weight: 700;
	  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
	}

    .active {
      background-color: #2d3e9b;
      color: white;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    h1 {
      font-size: 1.2rem;
      margin: 20px 0 10px;
      padding: 0 10px;
      color: #444;
    }

    p {
      font-size: 1rem;
      margin-bottom: 20px;
      padding: 0 10px;
      color: #666;
    }

    .form-box {
      margin-top: 30px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-box input {
      padding: 12px;
      width: 100%;
      max-width: 300px;
      box-sizing: border-box;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }

    .form-box button {
      padding: 12px 30px;
      background-color: #2d3e9b;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-box button:hover {
      background-color: #1c2a7b;
    }

    @media (max-width: 480px) {
      .step {
        flex-direction: column;
        align-items: center;
      }

      h1 {
        font-size: 1rem;
      }

      p {
        font-size: 0.9rem;
      }
    }
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
    <form action="/pay/check" method="post">
      <input type="hidden" name="idx" value="<?= esc($idx) ?>" />
      <input type="text" name="phone_last4" placeholder="휴대폰 뒷자리 4자리" maxlength="4" required />
      <br>
      <button type="submit">확인</button>
    </form>
  </div>

</body>
</html>
