<?php
$this->extend('inc/layout_index');
$this->section('content');
$member = session('member') ?? [];
?>

<main id="container" class="sub member complete pt100"  data-step-page="step03">
  <div class="inner_620">

    <div class="sub_sec_ttl tac ">
      <h2 class="ttl">회원가입</h2>
    </div>

    <?php echo view('member/join_step_inc'); ?>

    <div class="sub_sec_ttl tac ">
      <h2 class="ttl">반가워요!</h2>
      <strong class="ttl_big"><?=$member['name']?> 님, 회원가입을 <br>축하합니다.</strong>
    </div>

    <picture class="join_complete_img_box">
      <source media="(max-width: 768px)" srcset="https://hihojoo.com/assets/img/sub/join_complete_img_m.png">
      <img src="https://hihojoo.com/assets/img/sub/join_complete_img.png" alt="가입환영 이미지">
    </picture>

    <div class="bot_btn">
      <a href="../main/main.php" class="cta_btn btn-point">홈으로</a>
    </div>
    

    
  
  </div>

</main>



<?php $this->endSection(); ?>
