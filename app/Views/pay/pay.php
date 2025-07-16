<!DOCTYPE html>
<html lang="en">
<?php
    $setting = homeSetInfo();
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="<?= $setting['og_title'] ?>" name="Title">
  <meta content="<?= $setting['og_des'] ?>" name="Description">
  <meta content="<?= $setting['meta_keyword'] ?>" name="Keyword">
  <meta property="og:title" content="<?= $setting['og_title'] ?>">
  <meta property="og:description" content="<?= $setting['og_des'] ?>">
  <meta property="og:image" content="/uploads/setting/<?= $setting['og_img'] ?>">
  <meta property="og:url" content="<?= $setting['og_url'] ?>">
  <meta property="al:web:url" content="<?= $setting['og_url'] ?>">
  <meta name="naver-site-verification" content="466ef04fc98ddc84f2dc2f63451ef03d71efa5d7">
  <meta name="robots" content="index,follow">

  <link href="/uploads/setting/<?= $setting['favico'] ?>" rel="icon" type="image/x-icon">
  <link rel="canonical" href="<?= $setting['og_url'] ?>">

  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/pay.css">

  <script type="text/javascript"
    src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
  <script type="text/javascript" src="/js/apple.js"></script>

  <title><?= $setting['browser_title'] ?></title>
</head>

<body>
  <div class="pay_container">
    <div class="inner_620">
      <h2 class="top_ttl">카드결제</h2>
      <div class="join_step">
        <ul>
          <li class="step01 on" data-step="step01">
            <div class="step_ele">
              <span class="step_ele_num">01</span> <span class="step_ele_txt">결제 로그인 인증</span>
            </div>
          </li>
          <li class="step02" data-step="step02">
            <div class="step_ele">
              <span class="step_ele_num">02</span> <span class="step_ele_txt">카드결제</span>
            </div>
          </li>
          <li class="step03" data-step="step03">
            <div class="step_ele">
              <span class="step_ele_num">03</span> <span class="step_ele_txt">결제완료</span>
            </div>
          </li>
        </ul>
      </div>
      <div class="sub_sec_ttl tac ">
        <h1 class="ttl_big">인증 후 결제 진행이 가능합니다.</h1>
        <p>주문 시 입력한 휴대폰번호 뒷자리 4자리를 입력해 인증해주세요.</p>
      </div>

      <div class="form-box">
        <form action="/pay/check" method="post">
          <input type="hidden" name="idx" value="<?= esc($idx) ?>" />
          <input type="text" name="phone_last4" placeholder="휴대폰 뒷자리 4자리" maxlength="4" required />
          <br>
          <button type="submit">확인</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>