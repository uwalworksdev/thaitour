<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
  .slick-dots {
    text-align: center;
  }

  .slick-dots li button:before {
    font-size: 12px;
    color: black;
  }
</style>

<main id="container" class="sub item_list">
  <div class="inner">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item home">
          <a href="/"><i></i></a>
        </li>
        <li class="breadcrumb-item depth1">
          <a href="/t-trip/view_reservation.php?code_no=1325"><i></i>골프여행</a>
        </li>
      </ol>
    </nav>


    <script>
      $('.breadcrumb .depth3').on('click', function () {
        $(this).toggleClass('dep_open')
      })
    </script>

    <!-- list_top_banner -->
    <section class="list_top_banner">
      <a href="" id="myLink">
        <picture>
          <source media="(max-width: 850px)" srcset="https://hihojoonew.cafe24.com/data/catebanner/20240228160231.png">
          <img src="https://hihojoonew.cafe24.com/data/catebanner/20240315170323.png" alt="골프여행 배너 ">
        </picture>
      </a>
    </section>

    <!--  // list_top_banner -->
    <style>
      @media (max-width: 850px) {
        .list_mid_banner .half_slider {
          /* padding-right: 50px */
        }

        .list_mid_banner .half_slider .slick-list {
          /* overflow: visible; */
        }
      }
    </style>
    <!-- //list_mid_banner -->

    <!--  best_prd-->
    <section class="best_prd" id="best_prd">
      <div class="sub_sec_ttl sub_sec_ttl_horizon flex_b_c">
        <h2 class="ttl">하이호주 MD 추천 베스트 <span class="font_emoji">💕</span> </h2>
        <!-- <div class="slider_btn"> -->
        <!-- <ul class="sub-dots">
                <ul class="slick-dots" role="tablist">
                    <li class="slick-active" role="presentation">
                        <button type="button" role="tab" id="slick-slide-control00" aria-controls="slick-slide00" aria-label="1 of 1" tabindex="0" aria-selected="true">1</button>
                    </li>
                </ul>
            </ul> -->
        <!-- </div> -->
      </div>

      <div class="item_list_wrap">
        <div class="prd_slider item_list quarter_slider">
          <?php foreach ($suggestedProducts as $product) { ?>
            <div class="slide_item">
            <a href="<?=base_url('product_view/'.$product['product_idx']) ?>">           
                <div class="list_prd_img">
                  <figure class="cover_img">
                    <img
                      src="https://hihojoonew.cafe24.com/data/<?= $product['ufile1'] ? 'product/thum_300_218/' . $product['ufile1'] : 'product/noimg.png' ?>"
                      alt="<?= $product['product_name'] ?> 상품썸네일">
                  </figure>
                  <div class="tag_box">
                    <?php if ($product['product_best'] == "Y") { ?>
                      <picture class="best_ico">
                        <source media="(max-width: 850px)"
                          srcset="https://hihojoonew.cafe24.com/data/images/thumb_product/tag_best_m.png">
                        <img src="https://hihojoonew.cafe24.com/data/images/thumb_product/tag_best.png" alt="베스트상품">
                      </picture>
                    <?php } ?>
                    <?php if ($product['special_price'] == "Y") { ?>
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)"
                          srcset="https://hihojoonew.cafe24.com/data/images/thumb_product/tag_sale_m.png">
                        <img src="https://hihojoonew.cafe24.com/data/images/thumb_product/tag_sale.png" alt="특가상품">
                      </picture>
                    <?php } ?>
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit"><?= html_entity_decode($product['product_name']) ?></strong>
                  <span class="prd_desc only_web"><?= html_entity_decode($product['product_info']) ?></span>
                  <div class="amount flex__e">
                    <?php $percent = 100 - ((int) ($product['product_price'] / $product['original_price'] * 100));
                    if ($percent != 0) { ?>
                      <p class="discount">
                        <strong><?= 100 - ((int) ($product['product_price'] / $product['original_price'] * 100)) ?></strong>%
                      </p>
                    <?php } ?>
                    <p class="price"><strong><?= number_format($product['product_price']) ?></strong>원~
                    </p>
                    <?php if ($percent != 0) { ?>
                      <p class="cost"><?= number_format($product['original_price']) ?>원</p>
                    <?php } ?>
                  </div>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!--  // best_prd  -->

    <section class="item_list_sec">
      <div class="sub_sec_ttl sub_sec_ttl_horizon flex_b_c border_b">
        <div class="now_wrap sub_ttl item_cate">
          <button class="now_btn"><span>#</span><em><?= $code_name; ?></em></button>
          <ul class="filter_cho">
            <?php foreach ($codes as $code) { ?>
              <li class="<?= ($code->code_no == $code_no ? 'active' : '') ?>">
                <a
                  href="<?= base_url('/t-package/item_list.php?code_no=' . $code->code_no) ?>"><?= $code->code_name ?></a>
              </li>
            <?php } ?>
          </ul>
        </div>

        <div class="sub_ttl item_filter flex_b_c">
          <ul class="filter_cho">
            <li onclick="getOrderBy('1');" <?= ($s == "1" ? "class='active'" : "") ?>>전체</li>
            <li onclick="getOrderBy('2');" <?= ($s == "2" ? "class='active'" : "") ?>>추천순</li>
            <li onclick="getOrderBy('3');" <?= ($s == "3" ? "class='active'" : "") ?>>예약순</li>
            <li onclick="getOrderBy('4');" <?= ($s == "4" ? "class='active'" : "") ?>>평점순</li>
            <li onclick="getOrderBy('5');" <?= ($s == "5" ? "class='active'" : "") ?>>높은가격순</li>
            <li onclick="getOrderBy('6');" <?= ($s == "6" ? "class='active'" : "") ?>>낮은가격순</li>
          </ul>
          <select name="s" id="s" class="only_mo" onchange="getOrderBy(this.value);">
            <option value="1" <?= ($s == "1" ? "selected" : "") ?>>전체</option>
            <option value="2" <?= ($s == "2" ? "selected" : "") ?>>추천순</option>
            <option value="3" <?= ($s == "3" ? "selected" : "") ?>>예약순</option>
            <option value="4" <?= ($s == "4" ? "selected" : "") ?>>평점순</option>
            <option value="5" <?= ($s == "5" ? "selected" : "") ?>>높은가격순</option>
            <option value="6" <?= ($s == "6" ? "selected" : "") ?>>낮은가격순</option>
          </select>
        </div>
      </div>

      <div class="item_list_wrap">
        <ul class="flex col_4 w_25 mo_col_2 item_list_gallery"
          style="--mg-x:14px; --mg-t:40px; --mo-mg-t: 0.961rem;--mo-mg-x:0.3384rem" id="line_add">
          <?php foreach ($products as $product) { ?>
            <li>
              <a href="<?= base_url('product_view/' . $product['product_idx']) ?>">
                <div class="list_prd_img">
                  <figure class="cover_img">
                    <img
                      src="https://hihojoonew.cafe24.com/data/<?= $product['ufile1'] ? 'product/thum_300_218/' . $product['ufile1'] : 'product/noimg.png' ?>"
                      alt="<?= $product['product_name'] ?> 썸네일">
                  </figure>
                  <div class="tag_box">
                    <?php if ($product['product_best'] == "Y") { ?>
                      <picture class="best_ico">
                        <source media="(max-width: 850px)" srcset="<?= base_url("images/thumb_product/tag_best.png") ?>">
                        <img src="<?= base_url("images/thumb_product/tag_best.png") ?>" alt="베스트상품">
                      </picture>
                    <?php } ?>
                    <?php if ($product['special_price'] == "Y") { ?>
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="<?= base_url("images/thumb_product/tag_sale.png") ?>">
                        <img src="<?= base_url("images/thumb_product/tag_sale.png") ?>" alt="특가상품">
                      </picture>
                    <?php } ?>
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit"><?= html_entity_decode($product['product_name']) ?></strong>
                  <span class="prd_desc only_web"><?= html_entity_decode($product['product_info']) ?></span>
                  <div class="amount flex__e">
                    <?php $percent = 100 - ((int) ($product['product_price'] / $product['original_price'] * 100));
                    if ($percent != 0) { ?>
                      <p class="discount">
                        <strong><?= $percent ?></strong>%
                      </p>
                    <?php } ?>
                    <p class="price"><strong><?= number_format($product['product_price']) ?></strong>원</p>
                    <?php if ($percent != 0) { ?>
                      <p class="cost"><?= number_format($product['original_price']) ?>원</p>
                    <?php } ?>
                  </div>
                </div>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <?= $pager->makeLinks($page, $perPage, $totalProducts, 'default_full') ?>
      </div>
    </section>
    <script type="text/javascript">
      function getOrderBy(order) {
        window.location.href = "<?= base_url('/t-package/item_list.php?code_no=' . $code_no . '&s=') ?>" + order;
      }
    </script>
    <script type="text/javascript">
      function getOrderBy(orderBy) {
        var code_no = '<?= $code_no ?>';
        var url = `<?= base_url() ?>product-golf/${code_no}/${orderBy}`;
        window.location.href = url;
      }
    </script>
  </div>
</main>

<script type="text/javascript">
  $(document).ready(function () {
    $('.prd_slider').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      dots: false,
      arrows: true,
      nextArrow: '<button type="button" class="slick-next2 slick-arrow next_cust"></button>',
      prevArrow: '<button type="button" class="slick-prev2 slick-arrow "></button>',
    });
  });
</script>
<?php $this->endSection(); ?>