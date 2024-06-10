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
  <div class="inner">
  <?php echo view('shared/air_info', [
    'start_date_in' => $start_date_in,
    'air_info' => $air_info,
    'min_amt' => $min_amt, // Truyền biến min_amt vào view
    '_start_dd' => $_start_dd, // Truyền biến _start_dd vào view
    'tour_price' => $tour_price,
    'oil_price' => $oil_price,
    'tour_price_kids' => $tour_price_kids,
    'tour_price_baby' => $tour_price_baby,
    'product_idx' => $product_idx // Truyền biến product_idx vào view
]); ?>
<article>
    <a id="prd_info"></a>
    <?php if (isset($tour_info) && $tour_info != "&lt;p&gt;&nbsp;&lt;/p&gt;" && $tour_info != ""): ?>
        <ul class="item_anchor">
            <li><a href="#prd_info" class="on">상품소개</a></li>
            <?php if (!empty($day_details) && $day_details['total_day'] > 0): ?>
                <li><a href="#itinerary">여행일정</a></li>
            <?php endif; ?>
            <?php if (isset($row_ht['stay_name_eng']) && $row_ht['stay_name_eng'] != ''): ?>
                <li><a href="#lodging">숙박정보</a></li>
            <?php endif; ?>
            <?php if (isset($tour_detail) && $tour_detail != "&lt;p&gt;&nbsp;&lt;/p&gt;"): ?>
                <li><a href="#detail_info">상세정보</a></li>
            <?php endif; ?>
        </ul>
        <div class="item_cont info">
            <p class="label">상품 핵심 포인트</p>
            <?= view('t-package/view_info_inc') ?>
        </div>
    <?php endif; ?>
</article>

<!-- 여행일정  -->
<article>
    <a id="itinerary"></a>
    <?php if (!empty($day_details) && $day_details['total_day'] > 0): ?>
        <ul class="item_anchor">
            <li><a href="#prd_info">상품소개</a></li>
            <li><a href="#itinerary" class="on">여행일정</a></li>
            <?php if (isset($row_ht['stay_name_eng']) && $row_ht['stay_name_eng'] != ''): ?>
                <li><a href="#lodging">숙박정보</a></li>
            <?php endif; ?>
            <?php if (isset($tour_detail) && $tour_detail != "&lt;p&gt;&nbsp;&lt;/p&gt;"): ?>
                <li><a href="#detail_info">상세정보</a></li>
            <?php endif; ?>
        </ul>
        <div class="item_cont info">
            <p class="label">여행일정</p>
            <?= view('t-package/view_itinerary_inc') ?>
        </div>
    <?php endif; ?>
</article>

<!-- 숙박정보  -->
<article>
    <a id="lodging"></a>
    <?php if (isset($row_ht['stay_name_eng']) && $row_ht['stay_name_eng'] != ''): ?>
        <ul class="item_anchor">
            <li><a href="#prd_info">상품소개</a></li>
            <?php if (!empty($day_details) && $day_details['total_day'] > 0): ?>
                <li><a href="#itinerary">여행일정</a></li>
            <?php endif; ?>
            <li><a href="#lodging" class="on">숙박정보</a></li>
            <?php if (isset($tour_detail) && $tour_detail != "&lt;p&gt;&nbsp;&lt;/p&gt;"): ?>
                <li><a href="#detail_info">상세정보</a></li>
            <?php endif; ?>
        </ul>
        <div class="item_cont info">
            <p class="label">숙박정보</p>
            <?= view('t-package/view_lodging_inc') ?>
        </div>
    <?php endif; ?>
</article>

<!-- 상세정보  -->
<article>
    <a id="detail_info"></a>
    <?php if (isset($tour_detail) && $tour_detail != "&lt;p&gt;&nbsp;&lt;/p&gt;"): ?>
        <ul class="item_anchor">
            <li><a href="#prd_info">상품소개</a></li>
            <?php if (!empty($day_details) && $day_details['total_day'] > 0): ?>
                <li><a href="#itinerary">여행일정</a></li>
            <?php endif; ?>
            <?php if (isset($row_ht['stay_name_eng']) && $row_ht['stay_name_eng'] != ''): ?>
                <li><a href="#lodging">숙박정보</a></li>
            <?php endif; ?>
            <li><a href="#detail_info" class="on">상세정보</a></li>
        </ul>
        <div class="item_cont info">
            <p class="label">상세정보</p>
            <?= view('t-package/view_detail_info_inc') ?>
        </div>
    <?php endif; ?>
</article>


</div>


</section>

<script>
  function set_plus(id) {
    //if($("#adult_air").val() == 0 || $("#kids_air").val() == 0 || $("#baby_air").val() == 0) {
    //   alert('항공편을 선택해 주세요.2');
    //   return false;
    //}

    var $n = $(this).parent(".count_box").find(".input-qty");

    if (id == "1") {
      var man_cnt = parseInt($("#man_cnt").val()) + 1;
      $("#adult_mem").val(man_cnt);
      $("#man_cnt").val(man_cnt);
      $n.val(man_cnt);
      $("#adult_qty").val(man_cnt);
    }

    if (id == "2") {
      var kids_cnt = parseInt($("#kids_cnt").val()) + 1;
      $("#kids_mem").val(kids_cnt);
      $("#kids_cnt").val(kids_cnt);
      $n.val(kids_cnt);
      $("#kids_qty").val(kids_cnt);
    }

    if (id == "3") {
      var baby_cnt = parseInt($("#baby_cnt").val()) + 1;
      $("#baby_mem").val(baby_cnt);
      $("#baby_cnt").val(baby_cnt);
      $n.val(baby_cnt);
      $("#baby_qty").val(baby_cnt);
    }

    price_account();

  }

  function set_minus(id) {

    //if($("#adult_air").val() == 0 || $("#kids_air").val() == 0 || $("#baby_air").val() == 0) {
    //   alert('항공편을 선택해 주세요.3'); 
    //   return false;
    //}
    var $n = $(this).parent(".count_box").find(".input-qty");
    if (id == "1") {
      var man_cnt = parseInt($("#man_cnt").val()) - 1;
      if (man_cnt < 1) man_cnt = 1;
      $("#adult_mem").val(man_cnt);
      $("#man_cnt").val(man_cnt);
      $n.val(man_cnt);
    }

    if (id == "2") {
      var kids_cnt = parseInt($("#kids_cnt").val()) - 1;
      if (kids_cnt < 0) kids_cnt = 0;
      $("#kids_mem").val(kids_cnt);
      $("#kids_cnt").val(kids_cnt);
      $n.val(kids_cnt);
    }

    if (id == "3") {
      var baby_cnt = parseInt($("#baby_cnt").val()) - 1;
      if (baby_cnt < 0) baby_cnt = 0;
      $("#baby_mem").val(baby_cnt);
      $("#baby_cnt").val(baby_cnt);
      $n.val(baby_cnt);
    }

    price_account();
  }

  function get_reservation(idx) {

    $("#air_idx").val(idx);

    var message = "";
    var detail = "";
    $.ajax({
      url: "/ajax/ajax.get_air.php",
      type: "POST",
      data: {
        "product_idx": '<?= $product_idx ?>',
        "idx": idx
      },
      dataType: "json",
      async: false,
      cache: false,
      success: function (data, textStatus) {
        message = data.message;


        var _price = message.split("|");

        $("#adult_air").val(_price[0]);
        $("#kids_air").val(_price[1]);
        $("#baby_air").val(_price[2]);
        $("#air_code").val(_price[3]);
        $("#air_code_in").val(_price[3]);
        $("#air_idx_in").val(idx);

        $("#tour_price").val(_price[0]);
        $("#tour_price_kids").val(_price[1]);
        $("#tour_price_baby").val(_price[2]);

        var adult_price = _price[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '원';
        var kids_price = _price[1].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '원';
        var baby_price = _price[2].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '원';
        $("#adult_price").text(adult_price);
        $("#kids_price").text(kids_price);
        $("#baby_price").text(baby_price);
        $("#detail").html(detail);

        $("#kids_mem").val('0');
        $("#kids_cnt").val('0');
        $("#baby_mem").val('0');
        $("#baby_cnt").val('0');
        $("#go_view").submit();
        //price_account();
      }
    });
  }

  function price_account() {
    var adult_cnt = parseInt($("#adult_mem").val() || 0);
    var kids_cnt = parseInt($("#kids_mem").val() || 0);
    var baby_cnt = parseInt($("#baby_mem").val() || 0);

    var adult_tot = parseInt($("#adult_air").val() || 0) * adult_cnt;
    var kids_tot = parseInt($("#kids_air").val() || 0) * kids_cnt;
    var baby_tot = parseInt($("#baby_air").val() || 0) * baby_cnt;
    var oil_price_tot = (parseInt($("#oil_price").val() || 0) * adult_cnt) + (parseInt($("#oil_price").val() || 0) * kids_cnt);

    //alert('adult_tot- '+adult_tot);
    //alert('kids_tot- '+kids_tot);
    //alert('baby_tot- '+baby_tot);


    var price_tot = parseInt(adult_tot + kids_tot + baby_tot + oil_price_tot);
    $("#total_price").val(price_tot);
    var txt_price = String(price_tot);
    var _total_price = txt_price.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $(".total_txt").text(_total_price);
  }
</script>
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