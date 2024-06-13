<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<main id="container" class="sub item_list item_list_main pt0">

  <!-- <script>
$( document ).ready(function() {

      var message = "";
      var img_url = "";
      $.ajax({

        url: "/ajax/ajax.subpage_image.php",
        type: "POST",
        data: {
          "s_code": '112'
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
          message = data.message;
          if(message) img_url = "https://hihojoonew.cafe24.com/data/bbs/"+message;
        },
        error:function(request,status,error){
          alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
        }
      });

      if(img_url != "") {
         $(".sub_visual_ttl").css("background-image", "url("+img_url+")");
            }
});
</script>

 -->

  <section class="sub_visual tours">
    <section class="list_top_banner">
      <a href="" id="myLink">
        <picture>
          <source media="(max-width: 850px)" srcset="https://hihojoonew.cafe24.com/data/catebanner/20240319140317.png">
          <img src="https://hihojoonew.cafe24.com/data/catebanner/20240319140335.png" alt="패키지 탑 배너 ">
        </picture>
      </a>
    </section>
    <div class="inner">
      <h3 class="sub_visual_ttl">호주 자유여행</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item home">
            <a href="/"><i></i></a>
          </li>
          <li class="breadcrumb-item depth1">
            <a href="/t-trip/view_reservation.php?code_no=1317"><i></i>자유여행</a>
          </li>



        </ol>
      </nav>


      <script>
        $('.breadcrumb .depth3').on('click', function () {
          $(this).toggleClass('dep_open')
        })
      </script>
      <!-- <a href="" id="myLink">
      <h3 class="sub_visual_ttl">호주의 심장 자유여행</h3>  
   </a> -->
    </div>
  </section>


  <div class="inner">
    <nav class="snb ">
      <ul>
        <!-- 해당 페이지가면 on 붙여주세요.
          현재는 확인하기위해 인클루드시키면서 on클래스 붙이고있습니다 -->
        <!--li class="on"><a href="./item_list_main.php?code_no=">전체투어</a></li>
      <li class=""><a href="./item_list_daily.php?code_no=">단독투어</a></li>
      <li class=""><a href="./item_list_daily.php?code_no="">데이투어</a></li>
      <li class=""><a href="./item_list_work.php?code_no="">액티비티</a></li>
      <li class=""><a href="./item_list_tourtel.php?code_no="">투어텔/세미팩</a></li>
      <li class=""><a href="./item_list_ticket.php?code_no="">입장권/티켓/유람선</a></li>
      <li class=""><a href="./item_list_golf.php?code_no=""> 일일골프/골프예약 </a></li>
    </ul-->
      </ul>
    </nav>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var myLink = document.getElementById("myLink");

      if (myLink.getAttribute("href") === "") {
        myLink.addEventListener("click", function (event) {
          event.preventDefault();
        });
      }
    });
  </script>

  <div class="inner">

    <!-- half_slider_sec -->
    <!-- <section class="half_slider_sec">
      <div class="visual_slider half_slider slick-initialized slick-slider slick-dotted"><button
          class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;">Previous</button>

        <div class="slick-list draggable">
          <div class="slick-track" style="opacity: 1; width: 7380px; transform: translate3d(-1230px, 0px, 0px);">
            <div class="slide_item slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1"
              style="width: 585px;">
              <a href="https://hihojoo.com/event/event_view.php?code=event&amp;bbs_idx=835" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606170.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160617.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1"
              style="width: 585px;">
              <a href="" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606440.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160644.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false"
              tabindex="0" role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10"
              style="width: 585px;">
              <a href="/event/event_view.php?code=event&amp;bbs_idx=519" tabindex="0">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202403121403370.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240312140337.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0"
              role="tabpanel" id="slick-slide11" style="width: 585px;">
              <a href="/t-tours/item_view.php?product_idx=1526" tabindex="0">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202403151303230.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240315130323.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="tabpanel"
              id="slick-slide12" aria-describedby="slick-slide-control11" style="width: 585px;">
              <a href="https://hihojoo.com/event/event_view.php?code=event&amp;bbs_idx=834" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606500.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160650.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1" role="tabpanel"
              id="slick-slide13" style="width: 585px;">
              <a href="https://hihojoo.com/event/event_view.php?code=event&amp;bbs_idx=835" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606170.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160617.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="4" aria-hidden="true" tabindex="-1" role="tabpanel"
              id="slick-slide14" aria-describedby="slick-slide-control12" style="width: 585px;">
              <a href="" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606440.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160644.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="5" aria-hidden="true" tabindex="-1"
              style="width: 585px;">
              <a href="/event/event_view.php?code=event&amp;bbs_idx=519" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202403121403370.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240312140337.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="6" aria-hidden="true" tabindex="-1"
              style="width: 585px;">
              <a href="/t-tours/item_view.php?product_idx=1526" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202403151303230.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240315130323.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="7" aria-hidden="true" tabindex="-1"
              style="width: 585px;">
              <a href="https://hihojoo.com/event/event_view.php?code=event&amp;bbs_idx=834" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606500.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160650.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="8" aria-hidden="true" tabindex="-1"
              style="width: 585px;">
              <a href="https://hihojoo.com/event/event_view.php?code=event&amp;bbs_idx=835" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606170.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160617.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="9" aria-hidden="true" tabindex="-1"
              style="width: 585px;">
              <a href="" tabindex="-1">
                <picture>
                  <source media="(max-width: 768px)" srcset="/data/banner/202406111606440.png">
                  <img src="https://hihojoonew.cafe24.com/data/banner/20240611160644.png" alt="배너1 이름 넣어주세요">
                </picture>
              </a>
            </div>
          </div>
        </div>
        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;">Next</button>
      </div>
    </section> -->
    <!-- //half_slider_sec -->
    <style>
      .slick-track {
        display: flex !important;
      }

      .slick-slide {
        height: inherit !important;
      }
    </style>
    <!-- one_txt_slider_sec -->
    <!-- <section class="one_txt_slider_sec item_list">
      <div class="sub_sec_ttl flex_b_c">
        <h2 class="ttl">하이호주 에서만 즐기는 <b class="color_point">단독투어</b></h2>
      </div>
      <div class="one_txt_slider one_slider slick-initialized slick-slider"><button class="slick-prev slick-arrow"
          aria-label="Previous" type="button" style="display: block;">Previous</button>
        <div class="slick-list draggable">
          <div class="slick-track" style="opacity: 1; width: 34800px; transform: translate3d(-6000px, 0px, 0px);">
            <div class="slide_item slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1411" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110107.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 퍼핑빌리 증기열차</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>146,240</strong>원($160) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1398" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190214.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 블루마운틴 &amp; 동물원</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>173,660</strong>원($190) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>유네스코에 등재된 세계자연유산인 블루마운틴을 자유롭게 여행할 수 있습니다.</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1392" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207140210.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                    <picture class="best_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                      <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                    </picture>
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 시드니 공항픽업 + 동부해안 반일 투어</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>82,260</strong>원($90) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>시드니 도착해서 동부 해안 투어 후 호텔 드롭까지! 체크인 전까지 알차게 쓰는 시간</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1331" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207220231.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 포트스테판에서 즐기는 액티비티</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>164,520</strong>원($180) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>포트 스테판의 모래언덕과 깨끗한 바다에서 모래썰매와 돌핀 크루즈를 탑승하며 호주의 색다른 매력을 느껴보세요.</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1393" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207160231.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 울릉공 &amp; 로얄 내셔널 파크 &amp; 키아마</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>109,680</strong>원($120) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>해안 절벽을 따라 달리는 그랜드 퍼시픽 드라이브 코스. 파도가 하늘로 솟아 오르는 블로우홀을 볼수있는 키아마. 수억 년된 자연의 위대함을 느낄수 있는 일라와라
                        국립공원까지!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-current slick-active" data-slick-index="4" aria-hidden="false"
              tabindex="0" style="width: 1200px;">
              <a href="./item_view.php?product_idx=1395" class="flex__c" tabindex="0">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207180252.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 취향 맞춰 떠나는 헌터밸리 와이너리 투어</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>137,100</strong>원($150) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>유명한 호주 와인을 제조하는 와이너리들을 둘러보고 와인 시음과 함께 아기자기하고 예쁜 것들이 가득한 헌터밸리 가든까지!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="5" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1394" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190243.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 내맘대로 즐기는 포트스테판 (액티비티 선택 옵션)</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>118,820</strong>원($130) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>포트스테판에서 즐길수있는 모든 액티비티를 골라서 내맘대로!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="6" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1399" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190225.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 블루마운틴 선셋 &amp; 별빛투어</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>118,820</strong>원($130) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>유네스코에 등재된 세계자연유산인 블루마운틴의 낮과 밤의 두가지 매력을 모두 느껴보세요. 화창한 낮, 붉은 노을에 물든 해질녘, 별이 빛나는 밤까지!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="7" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1397" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190236.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 저비스베이 (하이호주 ONLY)</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>137,100</strong>원($150) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>자연이 만들어낸 아름다운 절벽, 세상에서 가장 하얀 모래의 해변,그 사이를 헤엄치는 야생돌고래를 만나 볼수 있는 곳! 저비스베이를 다녀올수있는 유일한 투어입니다.
                      </li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="8" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1401" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207220251.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 시드니 시티 + 동부해안</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>118,820</strong>원($130) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>호주 제 1의 도시! 언제나 활기가 넘치는 시드니를 여행하고 본다이비치, 갭팍 같은 명소가 있는 동부해안을 둘러보세요!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="9" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1414" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110151.jpeg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 야라밸리 와이너리</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>219,360</strong>원($240) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="10" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1409" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110138.jpeg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 필립 아일랜드</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>182,800</strong>원($200) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="11" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1111" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20231218171209.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 그레이트 오션 로드</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>155,380</strong>원($170) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>하이호주 소속 현지 한인 가이드</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>죽기 전 꼭 가봐야 할 여행지로 뽑힌 그레이트오션로드를 자유롭게 여행합니다.</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="12" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1412" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110101.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 페닌슐라 온천+와이너리</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>146,240</strong>원($160) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide" data-slick-index="13" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1411" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110107.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 퍼핑빌리 증기열차</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>146,240</strong>원($160) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="14" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1398" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190214.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 블루마운틴 &amp; 동물원</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>173,660</strong>원($190) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>유네스코에 등재된 세계자연유산인 블루마운틴을 자유롭게 여행할 수 있습니다.</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="15" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1392" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207140210.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                    <picture class="best_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                      <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                    </picture>
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 시드니 공항픽업 + 동부해안 반일 투어</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>82,260</strong>원($90) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>시드니 도착해서 동부 해안 투어 후 호텔 드롭까지! 체크인 전까지 알차게 쓰는 시간</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="16" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1331" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207220231.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 포트스테판에서 즐기는 액티비티</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>164,520</strong>원($180) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>포트 스테판의 모래언덕과 깨끗한 바다에서 모래썰매와 돌핀 크루즈를 탑승하며 호주의 색다른 매력을 느껴보세요.</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="17" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1393" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207160231.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 울릉공 &amp; 로얄 내셔널 파크 &amp; 키아마</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>109,680</strong>원($120) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>해안 절벽을 따라 달리는 그랜드 퍼시픽 드라이브 코스. 파도가 하늘로 솟아 오르는 블로우홀을 볼수있는 키아마. 수억 년된 자연의 위대함을 느낄수 있는 일라와라
                        국립공원까지!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="18" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1395" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207180252.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 취향 맞춰 떠나는 헌터밸리 와이너리 투어</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>137,100</strong>원($150) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>유명한 호주 와인을 제조하는 와이너리들을 둘러보고 와인 시음과 함께 아기자기하고 예쁜 것들이 가득한 헌터밸리 가든까지!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="19" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1394" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190243.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 내맘대로 즐기는 포트스테판 (액티비티 선택 옵션)</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>118,820</strong>원($130) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>포트스테판에서 즐길수있는 모든 액티비티를 골라서 내맘대로!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="20" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1399" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190225.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 블루마운틴 선셋 &amp; 별빛투어</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>118,820</strong>원($130) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>유네스코에 등재된 세계자연유산인 블루마운틴의 낮과 밤의 두가지 매력을 모두 느껴보세요. 화창한 낮, 붉은 노을에 물든 해질녘, 별이 빛나는 밤까지!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="21" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1397" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207190236.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 저비스베이 (하이호주 ONLY)</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>137,100</strong>원($150) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>자연이 만들어낸 아름다운 절벽, 세상에서 가장 하얀 모래의 해변,그 사이를 헤엄치는 야생돌고래를 만나 볼수 있는 곳! 저비스베이를 다녀올수있는 유일한 투어입니다.
                      </li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="22" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1401" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240207220251.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 시드니 시티 + 동부해안</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>118,820</strong>원($130) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>호주 제 1의 도시! 언제나 활기가 넘치는 시드니를 여행하고 본다이비치, 갭팍 같은 명소가 있는 동부해안을 둘러보세요!</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="23" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1414" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110151.jpeg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 야라밸리 와이너리</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>219,360</strong>원($240) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="24" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1409" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110138.jpeg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 필립 아일랜드</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>182,800</strong>원($200) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="25" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1111" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20231218171209.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 그레이트 오션 로드</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>155,380</strong>원($170) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>하이호주 소속 현지 한인 가이드</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                  <div class="point_list">
                    <strong>Trip Point</strong>
                    <ul>
                      <li>죽기 전 꼭 가봐야 할 여행지로 뽑힌 그레이트오션로드를 자유롭게 여행합니다.</li>
                    </ul>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="26" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1412" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110101.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 페닌슐라 온천+와이너리</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>146,240</strong>원($160) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
            <div class="slide_item slick-slide slick-cloned" data-slick-index="27" aria-hidden="true" tabindex="-1"
              style="width: 1200px;">
              <a href="./item_view.php?product_idx=1411" class="flex__c" tabindex="-1">
                <div class="list_prd_img flex">
                  <figure class="cover_img">
                    <img src="https://hihojoonew.cafe24.com/data/product/thum_500_300/20240111110107.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                  </div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">[단독] 퍼핑빌리 증기열차</strong>
                  <div class="amount flex__e">
                    <p class="price"><strong>146,240</strong>원($160) </p>
                  </div>

                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
















        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;">Next</button>
      </div>
    </section> -->
    <!-- //one_txt_slider_sec -->

    <!-- daytour_sec -->
    <input type="hidden" id="code_no" value="1317">

    <section class="daytour_sec">
      <div class="sub_sec_ttl tac ">
        <h2 class="ttl">하루동안 즐기는, <b class="color_point">하이호주 데이투어</b> <span class="font_emoji">🌞</span></h2>
      </div>
      <ul class="line_tab line_tab_recommend flex flex_w">
        <!-- <li class="active"><button type="button" id="all_sel_guide" class="sel_guide" value="232901">전체</button></li> -->
        <li class=" active"><button type="button" class="sel_guide" value="232901">시드니</button></li>
        <li class=" "><button type="button" class="sel_guide" value="232902">골드코스트</button></li>
        <li class=" "><button type="button" class="sel_guide" value="232903">멜버른</button></li>
        <li class=" "><button type="button" class="sel_guide" value="232904">울룰루</button></li>
        <li class=" "><button type="button" class="sel_guide" value="232905">해밀턴아일랜드</button></li>
        <li class=" "><button type="button" class="sel_guide" value="232906">케언즈</button></li>
        <li class=" "><button type="button" class="sel_guide" value="232907">퍼스</button></li>
        <li class=" "><button type="button" class="sel_guide" value="232908">타즈매니아</button></li>
      </ul>
      <div class="item_list_wrap">
        <ul class=" w100 item_list img_big" style="--mg-x:14px; --mg-t:40px" id="line_add">

          <li>
            <a href="./item_view.php?product_idx=1422">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227100222.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[외국인가이드] 시드니 블루마운틴(시닉월드) + 동물원</strong>
                <span class="prd_desc only_web">유네스코 세계 자연유산에 지정된 블루마운틴과 시닉 열차 3종, 남반구 최대 동물원 시드니 동물원을 하루안에 방문하는
                  알찬코스!</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>외국인가이드/영어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="discount"><strong>10</strong>%</p>
                  <p class="price"><strong>156,290</strong>원($171) </p>
                  <p class="cost">~ 172,750원($189)</p>
                </div>
              </div>
            </a>
          </li>

          <li>
            <a href="./item_view.php?product_idx=1423">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227100203.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[외국인가이드] 시드니 포트스테판</strong>
                <span class="prd_desc only_web">호주인이 사랑하는 휴양지 포트스테판에서 즐기는 짜릿한 모래썰매와 돌고래 크루즈, 로컬 와이너리 투어</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>외국인가이드/영어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="discount"><strong>10</strong>%</p>
                  <p class="price"><strong>156,290</strong>원($171) </p>
                  <p class="cost">~ 172,750원($189)</p>
                </div>
              </div>
            </a>
          </li>

          <li>
            <a href="./item_view.php?product_idx=1421">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111130118.jpeg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <picture class="best_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                    <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture>
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[한국인가이드] 콤보! 블루마운틴 &amp; 포트스테판 + 시드니워킹투어★</strong>
                <span class="prd_desc only_web">블루마운틴 &amp; 시드니동물원과 포트스테판을 한번에 구매하여 인당 $10 더 저렴하고 편안하게 여행하세요!</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="price"><strong>223,930</strong>원($245) </p>
                </div>
              </div>
            </a>
          </li>

          <li>
            <a href="./item_view.php?product_idx=1418">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111120135.jpeg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <picture class="best_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                    <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture>
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[한국인가이드] UPGRADE! 시드니 블루마운틴 선셋 &amp; 별보기 투어</strong>
                <span class="prd_desc only_web">해질녘의 블루마운틴을 경험하는 이색 투어! 어두운 밤하늘에 수놓아진 수많은 별들과 은하수까지 감상해보세요</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="discount"><strong>30</strong>%</p>
                  <p class="price"><strong>63,980</strong>원($70) </p>
                  <p class="cost">~ 91,400원($100)</p>
                </div>
              </div>
            </a>
          </li>

          <li>
            <a href="./item_view.php?product_idx=1424">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227100243.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[한국인가이드] 헌터밸리 와이너리 투어 + 시드니워킹투어★</strong>
                <span class="prd_desc only_web">와인 애호가라면 놓치지 말아야 할 곳! 드넓게 포도밭이 펼쳐진 호주 뉴 사우스 웨일즈 주의 대표적인 와인 생산지! 헌터밸리에서
                  즐기는 다양한 와인 시음의 기회!</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt"></span><span class="yoil_txt">월요일<span class="slash">/</span></span><span
                          class="yoil_txt"></span><span class="yoil_txt"></span><span class="yoil_txt"></span><span
                          class="yoil_txt"></span><span class="yoil_txt">토요일<span class="slash">/</span></span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="price"><strong>155,380</strong>원($170) </p>
                </div>
              </div>
            </a>
          </li>

          <li>
            <a href="./item_view.php?product_idx=1420">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227100237.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[한국인가이드] 블루마운틴 (시닉월드 옵션) &amp; 동물원 + 시드니워킹투어★</strong>
                <span class="prd_desc only_web">유네스코 세계 자연 유산 블루마운틴을 시닉월드를 탑승하여 다양한 각도로 감상하고 호주 로컬 동물들을 가까이 만나 볼수있는 시드니
                  동물원까지 한번에!</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="price"><strong>82,260</strong>원($90) </p>
                </div>
              </div>
            </a>
          </li>

          <li>
            <a href="./item_view.php?product_idx=1419">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227100252.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[한국인가이드] 포트스테판 + 시드니워킹투어★</strong>
                <span class="prd_desc only_web">환상적인 해변도시 포트스테판에서 즐기는 이색체험! 야생돌고래 관광 크루즈와 모래언덕에서 즐기는 아찔한 모래썰매
                  체험까지</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="price"><strong>150,810</strong>원($165) </p>
                </div>
              </div>
            </a>
          </li>

          <li>
            <a href="./item_view.php?product_idx=1417">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227100254.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[한국인가이드] 시드니 공항 픽업+동부 해안 반일 투어</strong>
                <span class="prd_desc only_web">시드니 도착 후 호텔 체크인까지, 모든 시간을 알차고 편안하게! 무거운 짐은 차에 실어두고 아름다운 해안을 보며 시드니 여행을
                  시작하세요.</span>
                <div class="only_web">
                  <div class="detail_box">
                    <dl>
                      <dt>가이드/언어</dt>
                      <dd>한인가이드 / 한국어</dd>
                    </dl>
                    <dl>
                      <dt>출발요일</dt>
                      <dd>
                        <span class="yoil_txt">매일</span>
                      </dd>
                    </dl>
                  </div>
                </div>
                <div class="amount flex__e">
                  <p class="price"><strong>82,260</strong>원($90) </p>
                </div>
              </div>
            </a>
          </li>
        </ul>


      </div>
    </section>
    <!-- //daytour_sec -->

    <section class="line_banner">
      <a href="/t-tours/item_list_main.php?code_no=1317">
        <picture>
          <source media="(max-width: 768px)" srcset="https://hihojoonew.cafe24.com/data/bbs/20240517130508.jpg">
          <img src="https://hihojoonew.cafe24.com/data/bbs/20240308150313.jpg" alt="매일 신나는 엑티비티!!! 배너">
        </picture>
      </a>
    </section>

    <!--  col4_slider_sec-->
    <section class="col4_slider_sec spe">
      <div class="sub_sec_ttl flex_b_c">
        <h2 class="ttl">호주를 즐기기 위한 <b class="color_point">필수 티켓</b> <span class="font_emoji">🎟</span></h2>
        <div class="slider_btn">
          <ul class="sub-dots">
            <ul class="slick-dots" role="tablist" style="display: flex;">
              <li class="" role="presentation"><button type="button" role="tab" id="slick-slide-control20"
                  aria-controls="slick-slide20" aria-label="1 of 6" tabindex="-1">1</button></li>
              <li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control21"
                  aria-controls="slick-slide24" aria-label="2 of 6" tabindex="-1">2</button></li>
              <li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control22"
                  aria-controls="slick-slide28" aria-label="3 of 6" tabindex="-1">3</button></li>
              <li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control23"
                  aria-controls="slick-slide212" aria-label="4 of 6" tabindex="-1">4</button></li>
              <li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control24"
                  aria-controls="slick-slide216" aria-label="5 of 6" tabindex="-1">5</button></li>
              <li role="presentation" class="slick-active"><button type="button" role="tab" id="slick-slide-control25"
                  aria-controls="slick-slide220" aria-label="6 of 6" tabindex="-1">6</button></li>
            </ul>
          </ul>
        </div>
      </div>

      <div class="item_list_wrap">
        <div class="prd_slider item_list quarter_slider_spe slick-initialized slick-slider slick-dotted"><button
            class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;">Previous</button>
          <div class="slick-list draggable">
            <div class="slick-track" style="opacity: 1; width: 14168px; transform: translate3d(-6468px, 0px, 0px);">
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1587" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306190356.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 커럼빈 동물원</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>58,500</strong>원($64) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1594" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306190355.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 스카이포인트 전망대</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>28,330</strong>원($31) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1549" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240229090222.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 타롱가 동물원 (왕복페리추가가능)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>63,070</strong>원($69) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1552" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306140326.png" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">마담투소/아쿠아리움/시드니타워/와일드라이프 4콤보 티켓</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>56</strong>%</p>
                      <p class="price"><strong>73,120</strong>원($80) </p>
                      <p class="cost">~ 164,520원($180)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide20" aria-describedby="slick-slide-control20" style="width: 278px;">
                <a href="./item_view.php?product_idx=1528" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240228160257.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 시드니 울릉공 스카이다이빙 15,000 ft 비치랜딩</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>364,690</strong>원($399) </p>
                      <p class="cost">~ 382,970원($419)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide21" style="width: 278px;">
                <a href="./item_view.php?product_idx=1610" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115150137.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 멜버른 그레이트 오션 로드 스카이다이빙 15,000ft</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>6</strong>%</p>
                      <p class="price"><strong>346,410</strong>원($379) </p>
                      <p class="cost">~ 364,690원($399)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide22" style="width: 278px;">
                <a href="./item_view.php?product_idx=1529" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240228160236.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 픽톤 스카이다이빙 15,000 ft</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>282,430</strong>원($309) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide23" style="width: 278px;">
                <a href="./item_view.php?product_idx=1536" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227160245.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[특가] 시드니 하버 브릿지 클라임 (3시간 Summit)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>16</strong>%</p>
                      <p class="price"><strong>265,060</strong>원($290) </p>
                      <p class="cost">~ 314,420원($344)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="4" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide24" aria-describedby="slick-slide-control21" style="width: 278px;">
                <a href="./item_view.php?product_idx=1447" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111170135.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[그레이트배리어리프] 케언즈 리프매직 크루즈 - 다이빙 추천!</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>7</strong>%</p>
                      <p class="price"><strong>283,340</strong>원($310) </p>
                      <p class="cost">~ 301,620원($330)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="5" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide25" style="width: 278px;">
                <a href="./item_view.php?product_idx=1448" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111170155.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[그레이트배리어리프] 선러버 크루즈 + 피츠로이 아일랜드</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>6</strong>%</p>
                      <p class="price"><strong>246,780</strong>원($270) </p>
                      <p class="cost">~ 260,490원($285)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="6" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide26" style="width: 278px;">
                <a href="./item_view.php?product_idx=1604" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115150114.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">케언즈 리프 씨닉 플라이트 (경비행기)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>218,450</strong>원($239) </p>
                      <p class="cost">~ 227,590원($249)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="7" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide27" style="width: 278px;">
                <a href="./item_view.php?product_idx=1528" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240228160257.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 시드니 울릉공 스카이다이빙 15,000 ft 비치랜딩</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>364,690</strong>원($399) </p>
                      <p class="cost">~ 382,970원($419)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="8" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide28" aria-describedby="slick-slide-control22" style="width: 278px;">
                <a href="./item_view.php?product_idx=1534" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227170202.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 헌터밸리 열기구 스파클링 조식</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>297,050</strong>원($325) </p>
                      <p class="cost">~ 309,850원($339)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="9" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide29" style="width: 278px;">
                <a href="./item_view.php?product_idx=1526" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240229140213.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[10%할인] 시드니 오페라 하우스 공연 예약</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>10</strong>%</p>
                      <p class="price"><strong>287,910</strong>원($315) </p>
                      <p class="cost">~ 318,990원($349)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="10" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide210" style="width: 278px;">
                <a href="./item_view.php?product_idx=1539" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240229140219.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[크루즈] 클리어 뷰 글래스 보트 런치/디너 크루즈 (음료포함)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>18</strong>%</p>
                      <p class="price"><strong>173,660</strong>원($190) </p>
                      <p class="cost">~ 210,220원($230)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="11" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide211" style="width: 278px;">
                <a href="./item_view.php?product_idx=1789" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240319080351.png" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시티 고래 와칭 크루즈 (3시간)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">일요일<span class="slash">/</span></span><span
                            class="yoil_txt"></span><span class="yoil_txt"></span><span class="yoil_txt"></span><span
                            class="yoil_txt">목요일<span class="slash">/</span></span><span class="yoil_txt">금요일<span
                              class="slash">/</span></span><span class="yoil_txt">토요일<span class="slash">/</span></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>9</strong>%</p>
                      <p class="price"><strong>91,400</strong>원($100) </p>
                      <p class="cost">~ 99,630원($109)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="12" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide212" aria-describedby="slick-slide-control23" style="width: 278px;">
                <a href="./item_view.php?product_idx=1530" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227170212.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 오페라하우스 내부투어 (한국어 가이드)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>30,160</strong>원($33) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="13" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide213" style="width: 278px;">
                <a href="./item_view.php?product_idx=1622" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160111.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[퍼스] 로트네스트 바이크 렌탈 (왕복페리 포함)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>104,200</strong>원($114) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="14" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide214" style="width: 278px;">
                <a href="./item_view.php?product_idx=1569" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115120131.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <picture class="best_ico">
                        <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                        <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                      </picture>
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 골드코스트 바이런베이 스카이다이빙 15,000ft</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>355,550</strong>원($389) </p>
                      <p class="cost">~ 373,830원($409)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="15" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide215" style="width: 278px;">
                <a href="./item_view.php?product_idx=1595" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306210342.png" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 4콤보 (무비월드 + 씨월드+ 파라다이스 컨트리 + 웻 앤 와일드)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>22</strong>%</p>
                      <p class="price"><strong>150,810</strong>원($165) </p>
                      <p class="cost">~ 191,030원($209)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="16" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide216" aria-describedby="slick-slide-control24" style="width: 278px;">
                <a href="./item_view.php?product_idx=1596" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306200332.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 드림월드 (DREAM WORLD)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>6</strong>%</p>
                      <p class="price"><strong>90,490</strong>원($99) </p>
                      <p class="cost">~ 95,970원($105)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-active" data-slick-index="17" aria-hidden="false" tabindex="-1"
                role="tabpanel" id="slick-slide217" style="width: 278px;">
                <a href="./item_view.php?product_idx=1587" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306190356.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 커럼빈 동물원</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>58,500</strong>원($64) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-active" data-slick-index="18" aria-hidden="false" tabindex="-1"
                role="tabpanel" id="slick-slide218" style="width: 278px;">
                <a href="./item_view.php?product_idx=1594" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306190355.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 스카이포인트 전망대</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>28,330</strong>원($31) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-active" data-slick-index="19" aria-hidden="false" tabindex="-1"
                role="tabpanel" id="slick-slide219" style="width: 278px;">
                <a href="./item_view.php?product_idx=1549" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240229090222.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 타롱가 동물원 (왕복페리추가가능)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>63,070</strong>원($69) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-current slick-active" data-slick-index="20" aria-hidden="false"
                tabindex="0" role="tabpanel" id="slick-slide220" aria-describedby="slick-slide-control25"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1552" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306140326.png" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">마담투소/아쿠아리움/시드니타워/와일드라이프 4콤보 티켓</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>56</strong>%</p>
                      <p class="price"><strong>73,120</strong>원($80) </p>
                      <p class="cost">~ 164,520원($180)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="21" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1528" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240228160257.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 시드니 울릉공 스카이다이빙 15,000 ft 비치랜딩</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>364,690</strong>원($399) </p>
                      <p class="cost">~ 382,970원($419)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="22" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1610" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115150137.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 멜버른 그레이트 오션 로드 스카이다이빙 15,000ft</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>6</strong>%</p>
                      <p class="price"><strong>346,410</strong>원($379) </p>
                      <p class="cost">~ 364,690원($399)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="23" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1529" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240228160236.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 픽톤 스카이다이빙 15,000 ft</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>282,430</strong>원($309) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="24" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1536" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227160245.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[특가] 시드니 하버 브릿지 클라임 (3시간 Summit)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>16</strong>%</p>
                      <p class="price"><strong>265,060</strong>원($290) </p>
                      <p class="cost">~ 314,420원($344)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="25" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1447" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111170135.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[그레이트배리어리프] 케언즈 리프매직 크루즈 - 다이빙 추천!</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>7</strong>%</p>
                      <p class="price"><strong>283,340</strong>원($310) </p>
                      <p class="cost">~ 301,620원($330)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="26" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1448" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111170155.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[그레이트배리어리프] 선러버 크루즈 + 피츠로이 아일랜드</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>6</strong>%</p>
                      <p class="price"><strong>246,780</strong>원($270) </p>
                      <p class="cost">~ 260,490원($285)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="27" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1604" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115150114.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">케언즈 리프 씨닉 플라이트 (경비행기)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>218,450</strong>원($239) </p>
                      <p class="cost">~ 227,590원($249)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="28" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1528" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240228160257.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 시드니 울릉공 스카이다이빙 15,000 ft 비치랜딩</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>364,690</strong>원($399) </p>
                      <p class="cost">~ 382,970원($419)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="29" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1534" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227170202.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 헌터밸리 열기구 스파클링 조식</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>297,050</strong>원($325) </p>
                      <p class="cost">~ 309,850원($339)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="30" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1526" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240229140213.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[10%할인] 시드니 오페라 하우스 공연 예약</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>10</strong>%</p>
                      <p class="price"><strong>287,910</strong>원($315) </p>
                      <p class="cost">~ 318,990원($349)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="31" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1539" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240229140219.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[크루즈] 클리어 뷰 글래스 보트 런치/디너 크루즈 (음료포함)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>18</strong>%</p>
                      <p class="price"><strong>173,660</strong>원($190) </p>
                      <p class="cost">~ 210,220원($230)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="32" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1789" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240319080351.png" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시티 고래 와칭 크루즈 (3시간)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">일요일<span class="slash">/</span></span><span
                            class="yoil_txt"></span><span class="yoil_txt"></span><span class="yoil_txt"></span><span
                            class="yoil_txt">목요일<span class="slash">/</span></span><span class="yoil_txt">금요일<span
                              class="slash">/</span></span><span class="yoil_txt">토요일<span class="slash">/</span></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>9</strong>%</p>
                      <p class="price"><strong>91,400</strong>원($100) </p>
                      <p class="cost">~ 99,630원($109)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="33" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1530" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240227170212.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 오페라하우스 내부투어 (한국어 가이드)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>30,160</strong>원($33) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="34" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1622" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160111.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[퍼스] 로트네스트 바이크 렌탈 (왕복페리 포함)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>104,200</strong>원($114) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="35" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1569" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115120131.jpeg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <picture class="best_ico">
                        <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                        <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                      </picture>
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[$20할인] 골드코스트 바이런베이 스카이다이빙 15,000ft</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>5</strong>%</p>
                      <p class="price"><strong>355,550</strong>원($389) </p>
                      <p class="cost">~ 373,830원($409)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="36" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1595" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306210342.png" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 4콤보 (무비월드 + 씨월드+ 파라다이스 컨트리 + 웻 앤 와일드)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>22</strong>%</p>
                      <p class="price"><strong>150,810</strong>원($165) </p>
                      <p class="cost">~ 191,030원($209)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="37" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1596" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306200332.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 드림월드 (DREAM WORLD)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>6</strong>%</p>
                      <p class="price"><strong>90,490</strong>원($99) </p>
                      <p class="cost">~ 95,970원($105)</p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="38" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1587" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306190356.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 커럼빈 동물원</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>58,500</strong>원($64) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="39" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1594" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306190355.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">골드코스트 스카이포인트 전망대</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>28,330</strong>원($31) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="40" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1549" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240229090222.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">시드니 타롱가 동물원 (왕복페리추가가능)</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>63,070</strong>원($69) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="41" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1552" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240306140326.png" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">마담투소/아쿠아리움/시드니타워/와일드라이프 4콤보 티켓</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="discount"><strong>56</strong>%</p>
                      <p class="price"><strong>73,120</strong>원($80) </p>
                      <p class="cost">~ 164,520원($180)</p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>





















          <!--div class="slide_item">
            <a href="./item_view.php">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="../assets/img/main/prd_img02.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="best_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                      <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                    </picture> -->
          <!--picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <!-- <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
          <!--/div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">하이호주  픽톤 스카이다이빙 15,000 ft - 자유 낙하 하는 러쉬</strong>
                <div class="detail_box">
                  <dl>
                    <dt>출발요일</dt>
                    <dd>매일</dd>
                  </dl>
                </div>
                <div class="amount flex__e">
                  <p class="discount"><strong>23</strong>%</p>
                  <p class="price"><strong>83,850</strong>원 (60$)</p>
                  <p class="cost">120,000원</p>
                </div>
              </div>
            </a>
          </div-->

          <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;">Next</button>
        </div>
      </div>
    </section>
    <!--  // col4_slider_sec  -->

    <!-- tour_hotel_sec -->
    <section class="tour_hotel_sec">
      <div class="sub_sec_ttl sub_sec_ttl_1 flex_b_c">
        <h2 class="ttl">하이호주 실속 상품 <b class="color_point">투어텔</b> <span class="font_emoji">🏣</span></h2>
        <a href="" class="more_link">더보기 <i></i></a>
      </div>
      <div class="item_list_wrap ">
        <ul class="flex col_4 w_25 mo_col_2 item_list"
          style="--mg-x:14px; --mg-t:40px; --mo-mg-t: 0.961rem;--mo-mg-x:0.3384rem">
          <li>
            <a href="./item_view.php?product_idx=1435">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111170150.jpeg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">★행복한가족여행★ 탕갈루마 2박 패키지 (숙소+투어) / 모튼 아일랜드</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="price"><strong>421,350</strong>원($461) </p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="./item_view.php?product_idx=1431">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111170155.jpeg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[외국인가이드] 가리 아일랜드 홀리데이 2박 패키지 (프레이저 아일랜드)</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="discount"><strong>10</strong>%</p>
                  <p class="price"><strong>461,570</strong>원($505) </p>
                  <p class="cost">~ 512,750원($561)</p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="./item_view.php?product_idx=1429">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240111130148.jpeg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">시로멧 와이너리 2박 3일 패키지 (Sirromet Winery)</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="price"><strong>667,220</strong>원($730) </p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="./item_view.php?product_idx=1742">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240113120153.jpeg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                  <picture class="sale_ico">
                    <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture>
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">해밀턴 아일랜드 3박 패키지 (숙소+그레이트배리어리프) 2인 1실</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="price"><strong>917,660</strong>원($1,004) </p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="./item_view.php?product_idx=1503">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240530130539.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[외국인가이드] 1박 2일 울룰루 캠핑투어 (Adventure Tours)</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="discount"><strong>10</strong>%</p>
                  <p class="price"><strong>489,900</strong>원($536) </p>
                  <p class="cost">~ 543,830원($595)</p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="./item_view.php?product_idx=1826">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240424120413.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">와인과 함께하는 헌터밸리 1박2일 기차여행♥ Hunter Wine Train</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="discount"><strong>7</strong>%</p>
                  <p class="price"><strong>273,290</strong>원($299) </p>
                  <p class="cost">~ 292,480원($320)</p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="./item_view.php?product_idx=1752">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240409170415.jpg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[외국인가이드] 타즈매니아 4박5일 Famous 5</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="discount"><strong>10</strong>%</p>
                  <p class="price"><strong>722,060</strong>원($790) </p>
                  <p class="cost">~ 799,750원($875)</p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="./item_view.php?product_idx=1491">
              <div class="list_prd_img">
                <figure class="cover_img">
                  <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240113110137.jpeg" alt="상품썸네일">
                </figure>
                <div class="tag_box">
                  <!-- <picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
                </div>
              </div>
              <div class="list_prd_info">
                <strong class="prd_tit">[한국인가이드] 핑크호수+칼바리+피나클 별빛투어 2박3일 / 퍼스 서호주 로드트립</strong>
                <!--                  <div class="detail_box">-->
                <!--                    <dl>-->
                <!--                      <dt>출발요일</dt>-->
                <!--						<dd>-->
                <!--						  --><!--						</dd>-->
                <!--                    </dl>-->
                <!--                  </div>-->
                <div class="amount flex__e">
                  <p class="price"><strong>722,060</strong>원($790) </p>
                </div>
              </div>
            </a>
          </li>

          <!--li>
              <a href="#!">
                <div class="list_prd_img">
                  <figure class="cover_img">
                    <img src="../assets/img/main/prd_img02.jpg" alt="상품썸네일">
                  </figure>
                  <div class="tag_box">
                    <!-- <picture class="best_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_best_m.png">
                      <img src="../assets/img/ico/tag_best.png" alt="베스트상품">
                    </picture> -->
          <!--picture class="event_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                      <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                    </picture>
                    <!-- <picture class="sale_ico">
                      <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                      <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                    </picture> -->
          <!--/div>
                </div>
                <div class="list_prd_info">
                  <strong class="prd_tit">하이호주  픽톤 스카이다이빙 15,000 ft - 자유 낙하 하는 러쉬</strong>
                  <div class="detail_box">
                    <dl>
                      <dt>출발요일</dt>
                      <dd>매일</dd>
                    </dl>
                  </div>
                  <div class="amount flex__e">
                    <p class="discount"><strong>23</strong>%</p>
                    <p class="price"><strong>83,850</strong>원 (60$)</p>
                    <p class="cost">120,000원</p>
                  </div>
                </div>
              </a>
            </li-->

        </ul>
      </div>
    </section>
    <!--  // tour_hotel_sec -->

    <section class="line_banner">
      <a href="/t-trip/item_list.php?code_no=1325">
        <picture>
          <source media="(max-width: 768px)" srcset="https://hihojoonew.cafe24.com/data/bbs/20240308150349.jpg">
          <img src="https://hihojoonew.cafe24.com/data/bbs/20240308150341.jpg" alt="쉽고 빠른 골프 예약! 하이호주에서 배너">
        </picture>
      </a>
    </section>

    <!--  col4_slider_sec-->
    <section class="col4_slider_sec spe">
      <div class="sub_sec_ttl flex_b_c">
        <h2 class="ttl">시드니를 즐기기 위한 <b class="color_point">일일골프</b> <span class="font_emoji">🎟</span></h2>
        <div class="slider_btn">
          <ul class="sub-dots2">
            <ul class="slick-dots" role="tablist" style="display: flex;">
              <li class="" role="presentation"><button type="button" role="tab" id="slick-slide-control30"
                  aria-controls="slick-slide30" aria-label="1 of 3" tabindex="-1">1</button></li>
              <li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control31"
                  aria-controls="slick-slide34" aria-label="2 of 3" tabindex="-1">2</button></li>
              <li role="presentation" class="slick-active"><button type="button" role="tab" id="slick-slide-control32"
                  aria-controls="slick-slide38" aria-label="3 of 3" tabindex="-1">3</button></li>
            </ul>
          </ul>
        </div>
      </div>

      <div class="item_list_wrap">
        <div class="prd_slider item_list quarter_slider2 slick-initialized slick-slider slick-dotted"><button
            class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;">Previous</button>
          <div class="slick-list draggable">
            <div class="slick-track" style="opacity: 1; width: 8008px; transform: translate3d(-3388px, 0px, 0px);">
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1633" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160136.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Coast + 동부해안</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>278,770</strong>원($305) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1631" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160110.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Vintage + 와이너리 투어</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>272,370</strong>원($298) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1632" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160118.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">Twin Creeks + 블루마운틴</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">일요일<span class="slash">/</span></span><span class="yoil_txt">월요일<span
                              class="slash">/</span></span><span class="yoil_txt">화요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt">목요일<span
                              class="slash">/</span></span><span class="yoil_txt">금요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>260,490</strong>원($285) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1629" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160115.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[Stay&amp;Play] Kooindah Waters Golf Club</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>228,500</strong>원($250) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="0" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide30" aria-describedby="slick-slide-control30" style="width: 278px;">
                <a href="./item_view.php?product_idx=1634" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115170101.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">New South Wales + 라페루즈</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>891,150</strong>원($975) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide31" style="width: 278px;">
                <a href="./item_view.php?product_idx=1756" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240312110310.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Lakes + 라페루즈</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt"></span><span class="yoil_txt">월요일<span
                              class="slash">/</span></span><span class="yoil_txt">화요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt">목요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>845,450</strong>원($925) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide32" style="width: 278px;">
                <a href="./item_view.php?product_idx=1636" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115170118.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">Terrey Hills Golf &amp; Country Club</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt"></span><span class="yoil_txt">월요일<span
                              class="slash">/</span></span><span class="yoil_txt">화요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt">목요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>571,250</strong>원($625) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide33" style="width: 278px;">
                <a href="./item_view.php?product_idx=1630" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240226110209.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">St. Michael's + 동부해안</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">일요일<span class="slash">/</span></span><span
                            class="yoil_txt"></span><span class="yoil_txt">화요일<span class="slash">/</span></span><span
                            class="yoil_txt">수요일<span class="slash">/</span></span><span class="yoil_txt"></span><span
                            class="yoil_txt">금요일<span class="slash">/</span></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>347,320</strong>원($380) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="4" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide34" aria-describedby="slick-slide-control31" style="width: 278px;">
                <a href="./item_view.php?product_idx=1628" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160119.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[Stay&amp;Play] 만족도최고 Chateau Elan &amp; The Vintage</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>329,040</strong>원($360) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="5" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide35" style="width: 278px;">
                <a href="./item_view.php?product_idx=1635" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115170112.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">Riverside Oaks Golf Resort [36홀 라운딩]</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>319,900</strong>원($350) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide" data-slick-index="6" aria-hidden="true" tabindex="-1" role="tabpanel"
                id="slick-slide36" style="width: 278px;">
                <a href="./item_view.php?product_idx=1329" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/202401021701225.jpg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[Stay&amp;Play] Riverside Oaks Golf Resort</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>310,760</strong>원($340) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-active" data-slick-index="7" aria-hidden="false" tabindex="-1"
                role="tabpanel" id="slick-slide37" style="width: 278px;">
                <a href="./item_view.php?product_idx=1633" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160136.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Coast + 동부해안</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>278,770</strong>원($305) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-current slick-active" data-slick-index="8" aria-hidden="false"
                tabindex="0" role="tabpanel" id="slick-slide38" aria-describedby="slick-slide-control32"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1631" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160110.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Vintage + 와이너리 투어</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>272,370</strong>원($298) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-active" data-slick-index="9" aria-hidden="false" tabindex="0"
                role="tabpanel" id="slick-slide39" style="width: 278px;">
                <a href="./item_view.php?product_idx=1632" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160118.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">Twin Creeks + 블루마운틴</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">일요일<span class="slash">/</span></span><span class="yoil_txt">월요일<span
                              class="slash">/</span></span><span class="yoil_txt">화요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt">목요일<span
                              class="slash">/</span></span><span class="yoil_txt">금요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>260,490</strong>원($285) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-active" data-slick-index="10" aria-hidden="false" tabindex="0"
                role="tabpanel" id="slick-slide310" style="width: 278px;">
                <a href="./item_view.php?product_idx=1629" tabindex="0">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160115.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[Stay&amp;Play] Kooindah Waters Golf Club</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>228,500</strong>원($250) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="11" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1634" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115170101.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">New South Wales + 라페루즈</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>891,150</strong>원($975) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="12" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1756" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240312110310.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Lakes + 라페루즈</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt"></span><span class="yoil_txt">월요일<span
                              class="slash">/</span></span><span class="yoil_txt">화요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt">목요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>845,450</strong>원($925) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="13" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1636" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115170118.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">Terrey Hills Golf &amp; Country Club</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt"></span><span class="yoil_txt">월요일<span
                              class="slash">/</span></span><span class="yoil_txt">화요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt">목요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>571,250</strong>원($625) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="14" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1630" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240226110209.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">St. Michael's + 동부해안</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">일요일<span class="slash">/</span></span><span
                            class="yoil_txt"></span><span class="yoil_txt">화요일<span class="slash">/</span></span><span
                            class="yoil_txt">수요일<span class="slash">/</span></span><span class="yoil_txt"></span><span
                            class="yoil_txt">금요일<span class="slash">/</span></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>347,320</strong>원($380) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="15" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1628" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160119.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                      <picture class="sale_ico">
                        <source media="(max-width: 850px)" srcset="../assets/img/ico/tag_sale_m.png">
                        <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                      </picture>
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[Stay&amp;Play] 만족도최고 Chateau Elan &amp; The Vintage</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>329,040</strong>원($360) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="16" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1635" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115170112.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                      <!-- <picture class="event_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_event_m.png">
                    <img src="../assets/img/ico/tag_event.png" alt="이벤트상품">
                  </picture>
                  <picture class="sale_ico">
                    <source media="(max-width: 768px)" srcset="../assets/img/ico/tag_sale_m.png">
                    <img src="../assets/img/ico/tag_sale.png" alt="특가상품">
                  </picture> -->
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">Riverside Oaks Golf Resort [36홀 라운딩]</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>319,900</strong>원($350) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="17" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1329" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/202401021701225.jpg"
                        alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[Stay&amp;Play] Riverside Oaks Golf Resort</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>310,760</strong>원($340) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="18" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1633" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160136.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">

                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Coast + 동부해안</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>278,770</strong>원($305) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="19" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1631" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160110.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">The Vintage + 와이너리 투어</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>272,370</strong>원($298) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="20" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1632" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160118.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">

                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">Twin Creeks + 블루마운틴</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">일요일<span class="slash">/</span></span><span class="yoil_txt">월요일<span
                              class="slash">/</span></span><span class="yoil_txt">화요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span><span class="yoil_txt">목요일<span
                              class="slash">/</span></span><span class="yoil_txt">금요일<span
                              class="slash">/</span></span><span class="yoil_txt"></span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">

                      <p class="price"><strong>260,490</strong>원($285) </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="slide_item slick-slide slick-cloned" data-slick-index="21" aria-hidden="true" tabindex="-1"
                style="width: 278px;">
                <a href="./item_view.php?product_idx=1629" tabindex="-1">
                  <div class="list_prd_img">
                    <figure class="cover_img">
                      <img src="https://hihojoonew.cafe24.com/data/product/thum_300_218/20240115160115.jpg" alt="상품썸네일">
                    </figure>
                    <div class="tag_box">
                    </div>
                  </div>
                  <div class="list_prd_info">
                    <strong class="prd_tit">[Stay&amp;Play] Kooindah Waters Golf Club</strong>
                    <div class="detail_box">
                      <dl>
                        <dt>출발요일</dt>
                        <dd>
                          <span class="yoil_txt">매일</span>
                        </dd>
                      </dl>
                    </div>
                    <div class="amount flex__e">
                      <p class="price"><strong>228,500</strong>원($250) </p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;">Next</button>
        </div>
      </div>
    </section>
    <!--  // col4_slider_sec  -->
  </div>
</main>
<?php $this->endSection(); ?>