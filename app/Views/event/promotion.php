<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&amp;display=swap" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="https://ai-public.creatie.ai/gen_page/tailwind-custom.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
<link href="/event/css/style.css" rel="stylesheet">
<script
    src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1"></script>
<script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000"
    data-border-radius="small"></script>
<script src="/event/js/tailwind.config.js"></script>
<style>
    .icon-menu-item {
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .select2-container .select2-selection--single .select2-selection__rendered span {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .pb_10 {
        padding-bottom: 10rem !important;
    }

    /* @media screen and (max-width: 700px) {
        .box_img {
            margin: 0 16rem;
        }
    } */
</style>

<body class="font-[&#39;Noto_Sans_KR&#39;] bg-gray-50 scroll-smooth">

    <!-- 배너 섹션 -->
    <section class="w-full min-h-[66rem]  md:min-h-screen relative overflow-hidden ">
        <div class="absolute inset-0 w-full h-full">
            <div class="slider-container w-full h-full relative">
                <!-- <?php
                    foreach($banner_promotion as $banner){
                        if(!empty($banner['ufile1']) && is_file(ROOTPATH . "/public/data/cate_banner/" . $banner["ufile1"])){
                            $img_banner = "/data/cate_banner/" . $banner['ufile1'];
                ?>
                    <div class="slide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000">
                        <img src="<?= $img_banner ?>" alt="<?=$banner['title']?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-transparent"></div>
                    </div>
                <?php
                    }
                }
                ?> -->
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
                <img src="/event/images/main_pro.png" alt="24시간 꽉찬 여행 방콕"
                    class="w-full h-auto max-h-[70vh] object-contain main_title only_web">
                <img src="/event/images/main_pro_mo.png" alt="24시간 꽉찬 여행 방콕" class=" news main_title only_mo">
            </div>
        </div>
        <!-- <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
        <button class="w-3 h-3 rounded-full bg-white/50 slider-dot" data-index="0"></button>
        <button class="w-3 h-3 rounded-full bg-white/50 slider-dot" data-index="1"></button>
        <button class="w-3 h-3 rounded-full bg-white/50 slider-dot" data-index="2"></button>
    </div> -->
    </section>

    <!-- 구글폰트 Pretendard 사용 -->
    <link href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/variable/pretendardvariable.css"
        rel="stylesheet" />

    <div class="max-w-8xl mx-auto px-4 py-8 bg-[#ffffff] section-best overflow-hidden">

        <!-- 제목 필요시 활성화 -->
        <!-- <h1 class="text-4xl font-bold text-center mb-16 text-gray-800">방콕 한눈에 살펴보기</h1> -->

        <!-- 전체 배경 지도 (중앙) -->
        <div class="only_web">
            <div class="relative h-auto md:h-[935px] flex flex-col md:block items-center">
                <img src="/event/images/map_pro_ttl.png" class="object-scale-down w-full h-44">
                <!-- 중앙 지도 -->
                <div class="hidden lg:block">
                    <div
                        class="hidden md:block absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 lg:translate-y-[-140px] w-[647px]">
                        <img src="/event/images/방콕명소요약가이드%2B1.png" alt="방콕 지도" class="w-full h-auto">
                    </div>

                    <!-- 사원 -->
                    <div class="absolute lg:right-1/2 lg:transform lg:translate-x-[-140px] md:absolute location-card">
                        <img src="/event/images/방콕명소요약가이드%2B2.png" class=" w-[439px] h-auto max-w-none">
                    </div>

                    <!-- 강 -->
                    <div
                        class="absolute lg:right-1/2 lg:transform lg:translate-x-[-140px] lg:translate-y-[36px] md:absolute location-card">
                        <img src="/event/images/방콕명소요약가이드%2B3.png" class=" w-[417px] h-auto max-w-none">
                    </div>

                    <!-- 야시장 -->
                    <div
                        class="absolute  md:absolute lg:left-1/2 lg:transform lg:translate-x-[-500px] lg:translate-y-[16px] location-card">
                        <img src="/event/images/방콕명소요약가이드%2B4.png" class="w-[800px]  h-auto max-w-none">
                    </div>

                    <!-- 카오산 -->
                    <div
                        class="absolute lg:left-1/2 lg:transform lg:translate-x-[-522px] lg:translate-y-[16px] md:absolute location-card">
                        <img src="/event/images/방콕명소요약가이드%2B5.png" class=" w-[1000px] h-auto max-w-none">
                    </div>

                    <!-- 쇼핑몰 -->
                    <div
                        class="absolute lg:left-1/2 lg:transform lg:translate-x-[-103px] lg:translate-y-[375px] md:absolute location-card">
                        <img src="/event/images/방콕명소요약가이드%2B6.png" class=" w-[362px] h-auto max-w-none">
                    </div>

                    <!-- 무에타이 -->
                    <div
                        class="absolute lg:right-1/2 lg:transform lg:translate-x-[-105px] g:translate-y-[10px] md:absolute location-card">
                        <img src="/event/images/방콕명소요약가이드%2B7.png" class=" w-[440px] h-auto max-w-none">
                    </div>
                </div>
                <!-- <div class="lg:hidden">
                     <img src="/event/images/map_mo_img.png" alt="방콕 지도" class="w-full h-auto">
                 </div> -->
            </div>
        </div>
        <div class="only_mo">
            <div class="title_map">
                <img src="/event/images/map_pro_ttl.png" alt="">
            </div>
            <div class="promotion_map">
                <div class="location" id="location01">
                    <div class="detail_map">
                        <div class="icon" id="icon01">
                            <img src="/event/images/promotion_ic05.png" alt="" class="img_loca">
                            <img src="/event/images/promotion_ic05_hover.png" alt="" class="img_loca hover">
                        </div>
                        <div class="location_pop" id="pop01">
                            <div class="location_desc">
                                <div class="ic_pop">
                                    <img src="/event/images/pop_img01.png" alt="">
                                </div>
                                <div class="contents">
                                    <p>짜뚜짝 시장 등 다양한 테마의 야시장이 도시 <br>
                                        전역에 있어 먹거리, 쇼핑, 투어가 가능하며 <br>
                                        길거리 음식을 모두 맛볼 수 있는 찬스! <br>
                                        <span>대표 명소 : 짜뚜짝, 짯페어, 수언룸 야시장</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="location" id="location02">
                    <div class="detail_map">
                        <div class="icon" id="icon02">
                            <img src="/event/images/promotion_ic06.png" alt="" class="img_loca">
                            <img src="/event/images/promotion_ic06_hover.png" alt="" class="img_loca hover">
                        </div>
                        <div class="location_pop" id="pop02">
                            <div class="location_desc">
                                <div class="ic_pop">
                                    <img src="/event/images/pop_img04.png" alt="">
                                </div>
                                <div class="contents">
                                    <p>짜뚜짝 시장 등 다양한 테마의 야시장이 도시 <br>
                                        전역에 있어 먹거리, 쇼핑, 투어가 가능하며 <br>
                                        길거리 음식을 모두 맛볼 수 있는 찬스! <br>
                                        <span>대표 명소 : 짜뚜짝, 짯페어, 수언룸 야시장</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="location" id="location03">
                    <div class="detail_map">
                        <div class="icon" id="icon03">
                            <img src="/event/images/promotion_ic09.png" alt="" class="img_loca">
                            <img src="/event/images/promotion_ic09_hover.png" alt="" class="img_loca hover">
                        </div>
                        <div class="location_pop" id="pop03">
                            <div class="location_desc">
                                <div class="ic_pop">
                                    <img src="/event/images/pop_img06.png" alt="">
                                </div>
                                <div class="contents">
                                    <p>화려한 사원과 불교 문화! <br>
                                        방콕에는 수백 개의 사원이 있으며, 불교가 <br>
                                        일상속에 깊숙이 자리 잡고 있습니다. <br>
                                        <span>대표 명소 : 왓 프라깨우, 왓 포, 왓 아룬</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="location" id="location04">
                    <div class="detail_map">
                        <div class="icon" id="icon04">
                            <img src="/event/images/promotion_ic08.png" alt="" class="img_loca">
                            <img src="/event/images/promotion_ic08_hover.png" alt="" class="img_loca hover">
                        </div>
                        <div class="location_pop" id="pop04">
                            <div class="location_desc">
                                <div class="ic_pop">
                                    <img src="/event/images/pop_img03.png" alt="">
                                </div>
                                <div class="contents">
                                    <p>짜뚜짝 시장 등 다양한 테마의 야시장이 도시 <br>
                                        전역에 있어 먹거리, 쇼핑, 투어가 가능하며 <br>
                                        길거리 음식을 모두 맛볼 수 있는 찬스! <br>
                                        <span>대표 명소 : 짜뚜짝, 짯페어, 수언룸 야시장</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="location" id="location05">
                    <div class="detail_map">
                        <div class="icon" id="icon05">
                            <img src="/event/images/promotion_ic07.png" alt="" class="img_loca">
                            <img src="/event/images/promotion_ic07_hover.png" alt="" class="img_loca hover">
                        </div>
                        <div class="location_pop" id="pop05">
                            <div class="location_desc">
                                <div class="ic_pop">
                                    <img src="/event/images/pop_img02.png" alt="">
                                </div>
                                <div class="contents">
                                    <p>짜뚜짝 시장 등 다양한 테마의 야시장이 도시 <br>
                                        전역에 있어 먹거리, 쇼핑, 투어가 가능하며 <br>
                                        길거리 음식을 모두 맛볼 수 있는 찬스! <br>
                                        <span>대표 명소 : 짜뚜짝, 짯페어, 수언룸 야시장</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="location" id="location06">
                    <div class="detail_map">
                        <div class="icon" id="icon06">
                            <img src="/event/images/pin_location.png" alt="" class="img_loca">
                            <img src="/event/images/pin_location_hover.png" alt="" class="img_loca hover">
                        </div>
                        <div class="location_pop" id="pop06">
                            <div class="location_desc">
                                <div class="ic_pop">
                                    <img src="/event/images/pop_img05.png" alt="">
                                </div>
                                <div class="contents">
                                    <p>방콕을 가로지르는 큰 강으로, <br>
                                        수상버스나 디너 크루즈를 타고 강변의<br>
                                        야경과 문화를 즐길 수 있으며 <br>
                                        디너크루즈는 꼭 추천~</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient section_gradient max-w-8xl mx-auto px-4 py-12 best5 overflow-hidden">
        <div class="title-section-best sub-1"></div>
        <div class="box_img flex flex-col items-center justify-center space-y-5 relative mx-[6rem] md:mx-[0]"
            style="gap: 45px;">
            <div class="wrap_item card-animation">
                <div class="num_box">
                    <span class="blue">01</span>
                </div>
                <div class="text_box">
                    <div class="title">왕궁과 에메랄드 사원 투어 </div>
                    <p class="des">태국 왕실의 역사와 문화를 엿볼 수 있는 왕궁과 에메랄드 사원 
                        (Wat Phra Kaew)을 방문해 보세요.  
                        화려한 건축물과 예술 작품을 감상할 수 있습니다.
                    </p>
                </div>
                <div class="image_box">
                    <img src="/event/images/po_001.jpg" alt="">
                </div>
            </div>
            <div class="wrap_item card-animation">
                <div class="num_box">
                    <span class="yellow">02</span>
                </div>
                <div class="text_box">
                    <div class="title">담넌 사두억 수상 시장 투어</div>
                    <p class="des">전통적인 태국의 수상 시장을 경험하며 보트를 타고  
                        신선한 과일과 현지 음식을 즐길 수 있는 이색 체험을 
                        할 수 있습니다.
                    </p>
                </div>
                <div class="image_box">
                    <img src="/event/images/po_002.jpg" alt="">
                </div>
            </div>
            <div class="wrap_item card-animation">
                <div class="num_box">
                    <span class="violet">03</span>
                </div>
                <div class="text_box">
                    <div class="title">짜뚜짝 주말 시장 탐방 </div>
                    <p class="des">세계 최대 규모의 주말 시장인 짜뚜짝 시장에서 현지에서만 
                        구매가능한 다양한 상품을 볼 수 있습니다. 너무커서 하루에
                        못 볼 수도 있어요.
                    </p>
                </div>
                <div class="image_box">
                    <img src="/event/images/po_003.jpg" alt="">
                </div>
            </div>
            <div class="wrap_item card-animation">
                <div class="num_box">
                    <span class="green">04</span>
                </div>
                <div class="text_box">
                    <div class="title">차이나타운 야시장</div>
                    <p class="des">방콕의 차이나타운에서 다양한 길거리 음식을 맛보고 활기찬
                        밤 문화를  체험할 수 있습니다. 현지인들과 관광객이 어우러진  
                        특별한 야경을 즐길 수 있는 곳입니다.
                    </p>
                </div>
                <div class="image_box">
                    <img src="/event/images/po_004.jpg" alt="">
                </div>
            </div>
            <div class="wrap_item card-animation">
                <div class="num_box">
                    <span class="orange">05</span>
                </div>
                <div class="text_box">
                    <div class="title">차오프라야 강 디너 크루즈 </div>
                    <p class="des">차오프라야 강 위에서 방콕 왕궁의 야경을 감상하며 저녁 식사를  
                        즐기는 로맨틱한 크루즈로 추억에 남을만한 시간을 가질수 
                        있습니다.  현지 음악과 함께하는 선상 공연은 여행을 한층 더 
                        특별하게 만들어줍니다.
                    </p>
                </div>
                <div class="image_box">
                    <img src="/event/images/po_005.jpg" alt="">
                </div>
            </div>






<!-- 
            <img src="/event/images/img_location_pro01.png" class="card-animation w-[70rem] lg:w-[900px] only_web"
                alt="이미지1" />
            <img src="/event/images/img_location_pro01_mo.png" class="card-animation w-[70rem] lg:w-[900px] only_mo"
                alt="이미지1" />
            <img src="/event/images/img_location_pro02.png" class="card-animation w-[70rem] lg:w-[900px] only_web"
                alt="이미지2" />
            <img src="/event/images/img_location_pro02_mo.png" class="card-animation w-[70rem] lg:w-[900px] only_mo"
                alt="이미지1" />
            <img src="/event/images/img_location_pro03.png" class="card-animation w-[70rem] lg:w-[900px] only_web"
                alt="이미지3" />
            <img src="/event/images/img_location_pro03_mo.png" class="card-animation w-[70rem] lg:w-[900px] only_mo"
                alt="이미지1" />
            <img src="/event/images/img_location_pro04.png" class="card-animation w-[70rem] lg:w-[900px] only_web"
                alt="이미지4" />
            <img src="/event/images/img_location_pro04_mo.png" class="card-animation w-[70rem] lg:w-[900px] only_mo"
                alt="이미지1" />
            <img src="/event/images/img_location_pro05.png" class="card-animation w-[70rem] lg:w-[900px] only_web"
                alt="이미지5" />
            <img src="/event/images/img_location_pro05_mo.png" class="card-animation w-[70rem] lg:w-[900px] only_mo"
                alt="이미지1" /> -->
        </div>
    </div>

    <div class="sec_banner">
        <div class="promotion_banner_img">
            <img class="only_web" src="/event/images/promotion_banner-1.png" alt="">
            <img class="only_mo" src="/event/images/promotion_banner-1_mo.png" alt="">
        </div>
        <div class="promotion_banner_content">
            <div class="po_round">
                <img src="/event/images/po_banner-head1.png" alt="">
            </div>
            <h3 class="po_head">호텔 & 리조트</h3>
            <p class="po_head_sub">여행의 시작은 내게 맞는 호텔 선택</p>
            <div class="promotion_box">
                <h5 class="ttl">럭셔리 호텔</h5>
                <p class="ttl_sub">호화로운 인생숙소!</p>
                <div class="promotion_box_contain">
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it1.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">카펠라 방콕</div>
                            <div class="info_hash_tag">
                                <p><span>#에메랄드바다 #워터풀빌라 #올인크루시브 #모히또가서몰디브한잔 <br class="only_web">
                                        #휴양끝판왕</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>조기예약할인, 리조트별상이(별도문의)</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it2.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">신돈 켐핀스키 호텔 방콕</div>
                            <div class="info_hash_tag">
                                <p><span>#액티비티의천국 #알로하 #쇼핑천국 #와이키키비치 <br class="only_web"> #승무원들이뽑은최고의휴양지 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>조기예약할인, 터틀스노클링서비스, 스냅촬영포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it3.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">포 시즌 호텔 방콕 앳 차오프라야 리버</div>
                            <div class="info_hash_tag">
                                <p><span>#럭셔리풀빌라 #야시장 #호핑투어 #맛집투어 #마사지 <br> #가성비허니문 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>플로팅조식, 풀빌라4박업그레이드(리조트별상이)</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it4.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">에스콧 엠바시 사톤</div>
                            <div class="info_hash_tag">
                                <p><span>#반자유패키지 #유럽스냅 #야경 #관광과쇼핑집결지 #로맨틱허니문</span> </p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>스냅앨범제공, 스위스VIP패스제공, 파리스냅촬영</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it5.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">샤마 레이크뷰 아속 방콕</div>
                            <div class="info_hash_tag">
                                <p><span>#올인클루시브 #액티비티천국 #멕시코여행 #카리브해 <br class="only_web"> #호캉스끝판왕</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>조기예약할인, 터틀스노클링서비스, 스냅촬영포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it6.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">차트리움 레지던스 사톤</div>
                            <div class="info_hash_tag">
                                <p><span>#프라이빗휴양지 #로맨틱허니문 #풀빌라맛집 #아름다운섬 <br class="only_web"> #태국여행</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>단독행사(현지인가이드), 플로팅조식(리조트별상이), TT비치클럽중식제공</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="promotion_box">
                <h5 class="ttl">레지던스형 호텔</h5>
                <p class="ttl_sub">내집처럼 편안한 숙소!</p>
                <div class="promotion_box_contain">
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it7.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품07. 발리</div>
                            <div class="info_hash_tag">
                                <p><span>#신들의섬 #풀빌라천국 #노옵션 #단독행사 #다양한선택일정 <br class="only_web"> #풀패키지 #1일1마사지 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>단독행사(현지인가이드), 플로팅조식(리조트별상이), TT비치클럽중식제공</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it8.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품08. 괌</div>
                            <div class="info_hash_tag">
                                <p><span>#태교여행 #짧은비행 #호캉스 #별빛투어 #렌터카일주 #쇼핑</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>렌트카24시간포함, 시내투어포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it9.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품09. 호주</div>
                            <div class="info_hash_tag">
                                <p><span>#대자연 #샌드보딩 #노옵션노팁 #디너크루즈 #다양한야생동물 <br class="only_web"> #소도시여행</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>특전 샴페인 or 와인 서비스, 야경투어 서비스</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it7.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품07. 발리</div>
                            <div class="info_hash_tag">
                                <p><span>#신들의섬 #풀빌라천국 #노옵션 #단독행사 #다양한선택일정 <br class="only_web"> #풀패키지 #1일1마사지 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>단독행사(현지인가이드), 플로팅조식(리조트별상이), TT비치클럽중식제공</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it8.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품08. 괌</div>
                            <div class="info_hash_tag">
                                <p><span>#태교여행 #짧은비행 #호캉스 #별빛투어 #렌터카일주 #쇼핑</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>렌트카24시간포함, 시내투어포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it9.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품09. 호주</div>
                            <div class="info_hash_tag">
                                <p><span>#대자연 #샌드보딩 #노옵션노팁 #디너크루즈 #다양한야생동물 <br class="only_web"> #소도시여행</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>특전 샴페인 or 와인 서비스, 야경투어 서비스</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sec_banner">
        <div class="promotion_banner_img">
            <img class="only_web" src="/event/images/promotion_banner-2.png" alt="">
            <img class="only_mo" src="/event/images/promotion_banner-2_mo.png" alt="">
        </div>
        <div class="promotion_banner_content">
            <div class="po_round">
                <img src="/event/images/po_banner-head2.png" alt="">
            </div>
            <h3 class="po_head">투어</h3>
            <p class="po_head_sub">방콕 투어 여행 가이드북</p>
            <div class="promotion_box">
                <h5 class="ttl">반일 투어</h5>
                <p class="ttl_sub">알차고 짧고 굵게 여행</p>
                <div class="promotion_box_contain">
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it7.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품07. 발리</div>
                            <div class="info_hash_tag">
                                <p><span>#신들의섬 #풀빌라천국 #노옵션 #단독행사 #다양한선택일정 <br> #풀패키지 #1일1마사지 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>단독행사(현지인가이드), 플로팅조식(리조트별상이), TT비치클럽중식제공</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it8.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품08. 괌</div>
                            <div class="info_hash_tag">
                                <p><span>#태교여행 #짧은비행 #호캉스 #별빛투어 #렌터카일주 #쇼핑</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>렌트카24시간포함, 시내투어포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it9.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품09. 호주</div>
                            <div class="info_hash_tag">
                                <p><span>#대자연 #샌드보딩 #노옵션노팁 #디너크루즈 #다양한야생동물 <br> #소도시여행</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>특전 샴페인 or 와인 서비스, 야경투어 서비스</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it7.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품07. 발리</div>
                            <div class="info_hash_tag">
                                <p><span>#신들의섬 #풀빌라천국 #노옵션 #단독행사 #다양한선택일정 <br> #풀패키지 #1일1마사지 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>단독행사(현지인가이드), 플로팅조식(리조트별상이), TT비치클럽중식제공</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it8.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품08. 괌</div>
                            <div class="info_hash_tag">
                                <p><span>#태교여행 #짧은비행 #호캉스 #별빛투어 #렌터카일주 #쇼핑</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>렌트카24시간포함, 시내투어포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it9.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품09. 호주</div>
                            <div class="info_hash_tag">
                                <p><span>#대자연 #샌드보딩 #노옵션노팁 #디너크루즈 #다양한야생동물 <br> #소도시여행</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>특전 샴페인 or 와인 서비스, 야경투어 서비스</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sec_banner">
        <div class="promotion_banner_img">
            <img class="only_web" src="/event/images/promotion_banner-3.png" alt="">
            <img class="only_mo" src="/event/images/promotion_banner-3_mo.png" alt="">
        </div>
        <div class="promotion_banner_content">
            <div class="po_round">
                <img src="/event/images/po_banner-head3.png" alt="">
            </div>
            <h3 class="po_head green">골프</h3>
            <p class="po_head_sub">더투랩이 엄선한 골프 투어</p>
            <div class="promotion_box">
                <h5 class="ttl">반일 투어</h5>
                <p class="ttl_sub">알차고 짧고 굵게 여행</p>
                <div class="promotion_box_contain">
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it7.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품07. 발리</div>
                            <div class="info_hash_tag">
                                <p><span>#신들의섬 #풀빌라천국 #노옵션 #단독행사 #다양한선택일정 <br> #풀패키지 #1일1마사지 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>단독행사(현지인가이드), 플로팅조식(리조트별상이), TT비치클럽중식제공</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it8.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품08. 괌</div>
                            <div class="info_hash_tag">
                                <p><span>#태교여행 #짧은비행 #호캉스 #별빛투어 #렌터카일주 #쇼핑</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>렌트카24시간포함, 시내투어포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it9.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품09. 호주</div>
                            <div class="info_hash_tag">
                                <p><span>#대자연 #샌드보딩 #노옵션노팁 #디너크루즈 #다양한야생동물 <br> #소도시여행</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>특전 샴페인 or 와인 서비스, 야경투어 서비스</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it7.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품07. 발리</div>
                            <div class="info_hash_tag">
                                <p><span>#신들의섬 #풀빌라천국 #노옵션 #단독행사 #다양한선택일정 <br> #풀패키지 #1일1마사지 </span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>단독행사(현지인가이드), 플로팅조식(리조트별상이), TT비치클럽중식제공</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it8.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품08. 괌</div>
                            <div class="info_hash_tag">
                                <p><span>#태교여행 #짧은비행 #호캉스 #별빛투어 #렌터카일주 #쇼핑</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>렌트카24시간포함, 시내투어포함</p>
                            </div>
                        </div>
                    </div>
                    <div class="promotion_box_item">
                        <div class="box_img"><img src="/event/images/po_box_it9.png" alt=""></div>
                        <div class="box_info">
                            <div class="info_name">행사상품09. 호주</div>
                            <div class="info_hash_tag">
                                <p><span>#대자연 #샌드보딩 #노옵션노팁 #디너크루즈 #다양한야생동물 <br> #소도시여행</span></p>
                            </div>
                            <div class="special">
                                <img class="only_web" src="/event/images/special_label.png" alt="">
                                <img class="only_mo" src="/event/images/special_label_mo.png" alt="">
                                <p>특전 샴페인 or 와인 서비스, 야경투어 서비스</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
    <div class="max-w-8xl mx-auto">
        <div class="flex justify-center">
            <div class="flex space-x-8">
                <a href="#hotel-section" class="px-3 py-4 text-2xl lg:text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">호텔 & 리조트</a>
                <a href="#tour-section" class="px-3 py-4 text-2xl lg:text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">투어</a>
                <a href="#rest-section" class="px-3 py-4 text-2xl lg:text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">레스토랑</a>
                <a href="#golf-section" class="px-3 py-4 text-2xl lg:text-base font-medium text-gray-500 hover:text-custom hover:border-b-2 hover:border-custom">골프</a>
            </div>
        </div>
    </div>
</nav> -->
    <!-- <main class="max-w-8xl mx-auto px-4 py-8 overflow-hidden pb_10">
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
</main> -->
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