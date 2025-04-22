<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
<link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
<link href="/event/css/style.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
<script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000" data-border-radius="small"></script>
<script src="/event/js/tailwind.config.js"></script>
<style>
  .icon-menu-item {
    display: flex;
    align-items: center;
    flex-direction: column;
  }

  .select2-container .select2-selection--single .select2-selection__rendered span{
    display: flex;
    align-items: center;
    gap: 3px;
  }
</style>
<body class="font-[&#39;Noto_Sans_KR&#39;] bg-gray-50 scroll-smooth">

<!-- 배너 섹션 -->
<section class="w-full min-h-screen relative overflow-hidden ">
    <div class="absolute inset-0 w-full h-full">
        <div class="slider-container w-full h-full relative">

        <div class="slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000">
            <img src="/event/images/i2.jpg" alt="방콕 왕궁" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-transparent"></div>
        </div>
        <div class="slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000">
            <img src="/event/images/i4.jpg" alt="왓아룬 사원" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-transparent"></div>
        </div>
        <div class="slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000">
            <img src="/event/images/i3.jpg" alt="랏차다 기차 야시장" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-transparent"></div>
        </div>
        <div class="slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000">
            <img src="/event/images/i1.jpg" alt="랏차다 기차 야시장" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-transparent"></div>
        </div>
        </div>
    </div>
    <div class="absolute inset-0 flex items-center justify-center z-10 ">
        <div class="bg-black/50 w-full h-full flex items-center justify-center p-4">
        <img src="/event/images/24시간꽉찬여행%2B방콕.png" alt="24시간 꽉찬 여행 방콕" class="w-full h-auto max-h-[70vh] object-contain main_title">
        </div>
    </div>
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
        <button class="w-3 h-3 rounded-full bg-white/50 slider-dot" data-index="0"></button>
        <button class="w-3 h-3 rounded-full bg-white/50 slider-dot" data-index="1"></button>
        <button class="w-3 h-3 rounded-full bg-white/50 slider-dot" data-index="2"></button>
    </div>
</section>

<!-- 구글폰트 Pretendard 사용 -->
<link href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/variable/pretendardvariable.css" rel="stylesheet" />

<div class="max-w-8xl mx-auto px-4 py-8 bg-[#fcf1e0] section-best" >

    <!-- 제목 필요시 활성화 -->
    <!-- <h1 class="text-4xl font-bold text-center mb-16 text-gray-800">방콕 한눈에 살펴보기</h1> -->

    <!-- 전체 배경 지도 (중앙) -->
    <div class="relative h-[935px] md:h-[935px] flex flex-col md:block items-center">
        <img src="/event/images/방콕명소요약가이드.png" class="object-scale-down w-full h-44">
        <!-- 중앙 지도 -->
        <div class="hidden md:block absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 lg:translate-y-[-140px] w-[647px]">
            <img src="/event/images/방콕명소요약가이드%2B1.png" alt="방콕 지도" class="w-full h-auto">
        </div>

        <!-- 사원 -->
        <div class="absolute lg:right-1/2 lg:transform lg:translate-x-[-140px] md:absolute location-card">
            <img src="/event/images/방콕명소요약가이드%2B2.png" class=" w-[439px] h-auto max-w-none">
        </div>

        <!-- 강 -->
        <div class="absolute lg:right-1/2 lg:transform lg:translate-x-[-140px] lg:translate-y-[36px] md:absolute location-card">
            <img src="/event/images/방콕명소요약가이드%2B3.png" class=" w-[417px] h-auto max-w-none">
        </div>

        <!-- 야시장 -->
        <div class="absolute  md:absolute lg:left-1/2 lg:transform lg:translate-x-[-500px] lg:translate-y-[16px] location-card">
            <img src="/event/images/방콕명소요약가이드%2B4.png" class="w-[800px]  h-auto max-w-none">
        </div>

        <!-- 카오산 -->
        <div class="absolute lg:left-1/2 lg:transform lg:translate-x-[-522px] lg:translate-y-[16px] md:absolute location-card">
            <img src="/event/images/방콕명소요약가이드%2B5.png" class=" w-[1000px] h-auto max-w-none">
        </div>

        <!-- 쇼핑몰 -->
        <div class="absolute lg:left-1/2 lg:transform lg:translate-x-[-103px] lg:translate-y-[375px] md:absolute location-card">
            <img src="/event/images/방콕명소요약가이드%2B6.png" class=" w-[362px] h-auto max-w-none">
        </div>

        <!-- 무에타이 -->
        <div class="absolute lg:right-1/2 lg:transform lg:translate-x-[-105px] g:translate-y-[10px] md:absolute location-card">
            <img src="/event/images/방콕명소요약가이드%2B7.png" class=" w-[440px] h-auto max-w-none">
        </div>
    </div>
</div>

<div class="bg-gradient max-w-8xl mx-auto px-4 py-12 best5">
    <div class="title-section-best sub-1"></div>
    <div class="flex flex-col items-center justify-center space-y-5 relative">
        <img src="/event/images/방콕필수코스5가지%2B1.png" class="card-animation w-[700px] " alt="이미지1" />
        <img src="/event/images/방콕필수코스5가지%2B2.png" class="card-animation w-[700px] " alt="이미지2" />
        <img src="/event/images/방콕필수코스5가지%2B3.png" class="card-animation w-[700px] " alt="이미지3" />
        <img src="/event/images/방콕필수코스5가지%2B4.png" class="card-animation w-[700px] " alt="이미지4" />
        <img src="/event/images/방콕필수코스5가지%2B5.png" class="card-animation w-[700px] " alt="이미지5" />
    </div>
</div>

<nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-8xl mx-auto">
        <div class="flex justify-center">
            <div class="flex space-x-8">
                <a href="#hotel-section" class="px-3 py-4 text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">호텔 & 리조트</a>
                <a href="#tour-section" class="px-3 py-4 text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">투어</a>
                <a href="#rest-section" class="px-3 py-4 text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">레스토랑</a>
                <a href="#golf-section" class="px-3 py-4 text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">골프</a>
            </div>
        </div>
    </div>
</nav>
<main class="max-w-8xl mx-auto px-4 py-8">
    <div id="hotel-section" class="mb-16">
        <div class="title-section luxury-hotel" title="럭셔리 호텔"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="luxury-hotel"></div>
        <div class="title-section residence-hotel" ></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="residence-hotel"></div>
        <div class="title-section good-price-hotel"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="good-price-hotel"></div>
        <div class="title-section infinitypool-hotel"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="infinitypool-hotel"></div>
        <div class="title-section shopping-hotel"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="shopping-hotel"></div>
        <div class="title-section pet-hotel"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="pet-hotel">  </div>
    </div>
    <div id="tour-section" class="mb-16">
        <div class="title-section-tour tour-1"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="tour-1"></div>
        <div class="title-section-tour tour-2"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="tour-2"></div>
        <div class="title-section-tour tour-3"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="tour-3"></div>
        <div class="title-section-tour tour-4"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="tour-4"></div>
        <div class="title-section-tour tour-5"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="tour-5"></div>
        <div class="title-section-tour tour-6"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="tour-6"></div>
    </div>
    <div id="rest-section">
        <div class="title-section-tour tour-7"></div>
        <div class="flex flex-wrap justify-center gap-6 mb-16 hotel-list" data-id="tour-7"></div>
    </div>
    <div id="golf-section">
        <div class="title-section-golf sub-1"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="sub-1"></div>
        <div class="title-section-golf sub-2"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="sub-2"></div>
        <div class="title-section-golf sub-3"></div>
        <div class="flex flex-wrap justify-center gap-6 hotel-list" data-id="sub-3"></div>
    </div>
</main>
<!-- <footer class="bg-gray-900 text-white py-12">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div>
        <h3 class="text-xl font-['Pacifico'] mb-4">logo</h3>
        <p class="text-gray-400 mb-4">방콕 여행의 모든 것을 알려드리는 완벽한 가이드북으로 잊지 못할 추억을 만들어보세요.</p>
        <div class="flex space-x-4">
          <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-primary transition-colors">
            <i class="ri-instagram-line"></i>
          </a>
          <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-primary transition-colors">
            <i class="ri-facebook-fill"></i>
          </a>
          <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800 rounded-full hover:bg-primary transition-colors">
            <i class="ri-youtube-fill"></i>
          </a>
        </div>
      </div>
      <div>
        <h4 class="text-lg font-bold mb-4">빠른 링크</h4>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">홈</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">인기 관광지</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">추천 코스</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">현지 맛집</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">여행 팁</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-lg font-bold mb-4">고객 지원</h4>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">자주 묻는 질문</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">문의하기</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">개인정보 처리방침</a></li>
          <li><a href="#" class="text-gray-400 hover:text-white transition-colors">이용약관</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-lg font-bold mb-4">뉴스레터 구독</h4>
        <p class="text-gray-400 mb-4">최신 여행 정보와 특별 할인 소식을 받아보세요.</p>
        <form class="flex">
          <input type="email" placeholder="이메일 주소" class="px-4 py-2 w-full bg-gray-800 border-none rounded-l text-white focus:outline-none focus:ring-1 focus:ring-primary">
          <button type="submit" class="bg-primary px-4 py-2 !rounded-r-button whitespace-nowrap hover:bg-opacity-90 transition-colors">구독</button>
        </form>
      </div>
    </div>
    <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">
      <p>&copy; 2025 방콕 여행 가이드북. All rights reserved.</p>
    </div>
  </div>
</footer> -->
<script src="/event/js/index.js"></script>
<?php $this->endSection(); ?>

