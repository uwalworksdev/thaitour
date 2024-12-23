<?php
     helper('setting_helper');
     $setting = homeSetInfo();
?>
<?php echo view('inc/head', ["setting" => $setting]); ?>
<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
<div class="bank_conts">
    <a href="/invoice/payment_golf" class="acc_closed fr mr10"></a>
    <h1><a href="/" style="border:0px;"><img src="/uploads/setting/<?= $setting['logos']?>" alt=""></a></h1>
    <div class="bank_conts_cont">
        <span class="bank_name">Kasikorn Bank</span><br>
        <span class="bank_acno">895-2-19850-6</span><br>
        <span class="bank_acname">(Totobooking)</span>
        <br>
        <p class="f_nilegreen">
        <a href="/user/board/mypage_list.php?code=mypage">
        ※ 입금 후 <strong>1:1 게시판</strong>으로 결제 확인 요청을 꼭 해주세요.
        </a>
        </p>
    </div>
</div>
