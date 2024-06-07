<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<section id="container" class="sub item_view pt60">
  <div class="inner">
    <section class="view_top_sec flex">
      <div class="detail_img_wrap">
        <div class="detail_slider_wrap">
          <!-- <div class="loading-container" style="top:50%;" id="loading-container">
            <div class="spinner"></div>
            <div class="loading-text">Loading...</div>
          </div> -->
 <!-- Swiper Container -->
<div class="swiper-container detail_slider one_btn_custom_slider">
    <div class="swiper-wrapper">
        <?php if ($img_1): ?>
        <div class="swiper-slide">
            <figure class="cover_img list_view_slider_img preload" id="cover_img_f">
                <picture>
                    <img id="firstImage" src="<?= $img_1 ?>" alt="상세이미지">
                </picture>
            </figure>
        </div>
        <?php endif; ?>
        <?php if ($img_2): ?>
        <div class="swiper-slide">
            <figure class="cover_img">
                <picture>
                    <img loading="lazy" src="<?= $img_2 ?>" alt="상세이미지">
                </picture>
            </figure>
        </div>
        <?php endif; ?>
        <!-- Add more images as needed -->
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

          <div class="slick-counter">
            <span class="prevBtn slider_btn">prev</span>
            <span class="current">01</span> / <span class="total"></span>
            <span class="nextBtn slider_btn">next</span>
          </div>
        </div>
        <ul class="ux_btn_wrap flex_e_c">
          <li><button type="button" onclick="openPopup()" class="ux_txt_btn message"><i></i>일정보내기</button></li>
          <li><button type="button" onclick="printPage()" class="ux_txt_btn print"><i></i>인쇄</button></li>
          <li>
            <button type="button" aria-label="공유버튼" class="ux_square_btn share"><i></i></button>
            <div class="wrap_share">
              <button type="button" class="sns_close"></button>
              <ul class="sns_list flex_c_c">
                <li>
                  <a class="btn_kakao" id="kakaotalk-sharing-btn">
                    <img src="../img/ico/share_kakao_ico.png" alt="">
                    <p>카카오</p>
                  </a>
                </li>
                <li>
                  <a onclick="copyItemLink(`<?= 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>`)">
                    <img src="../img/ico/share_link_icon.png" alt="">
                    <p>링그</p>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>

        <div class="view_banner only_web">
          <a href="/mypage/discount_download.php">
            <picture>
              <source media="(max-width: 768px)" srcset="<?=base_url("images/banner/view_mid_banner.png") ?>">
              <img src="<?=base_url("images/banner/view_mid_banner.png") ?>" alt="쿠폰받고 더욱 저렴하게 여행가기 배너">
            </picture>
          </a>
        </div>
      </div>

      <div class="detail_txt_info">
        <p class="item_num">상품번호 <strong><?= $product['product_code'] ?></strong></p>
        <h2 class="item_ttl"><?=htmlspecialchars_decode($product['product_name']) ?></h2>
        <span class="item_desc"><?= htmlspecialchars_decode($product['product_info']) ?></span>
        <div class="hash_box">
          <?php foreach (explode(',', $product['keyword']) as $keyword): ?>
            <span>#<?= $keyword ?></span>
          <?php endforeach; ?>
        </div>

        <div class="summary">
          <dl>
            <dt>인원</dt>
            <dd><?= $product['minium_people_cnt'] ?></dd>
          </dl>
          <dl>
            <dt>여행도시</dt>
            <dd><?= $product['capital_city'] ?></dd>
          </dl>
          <dl>
            <dt>총 여행일</dt>
            <dd><?= $product['product_period'] ?></dd>
          </dl>
          <dl>
            <dt>이용호텔</dt>
            <dd>
              <?php foreach (explode('|', $product['stay_list']) as $stay): ?>
                <a href="javascript:void(0)" class="hotal_link"><span><?= $stay ?></span><i></i></a>
              <?php endforeach; ?>
            </dd>
          </dl>
        </div>

        <div class="manager flex__c">
          <figure class="cover_img">
            <img src="../assets/img/sub/sub_logo.png" alt="하이호주 로고">
          </figure>
          <div class="profile">
            <strong class="name"><?= $product['product_manager'] ?></strong>
            <div class="communication">
              <a href="tel:<?= $product['phone'] ?>"><?= $product['phone'] ?></a>
              <span>/</span>
              <a href="mailto: <?= $product['email'] ?>"><?= $product['email'] ?></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.detail_slider', {
      slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        // Additional Swiper options
    });
});
</script>

<?php $this->endSection(); ?>