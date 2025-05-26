<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<?php
    date_default_timezone_set('Asia/Seoul');
?>
<div class="container travel-tips">
    <div class="sec_banner">
        <div class="inner">
            <div class="wrap_banner">
                <img class="only_web" src="/data/cate_banner/<?= $bannerTop['ufile1'] ?>" alt="">
                <img class="only_mo" src="/data/cate_banner/<?= $bannerTop['ufile2'] ?>" alt="">

                <div class="text_banner">
                    <span><?=viewSQ($bannerTop['title'])?></span>
                    <p><?=viewSQ($bannerTop['subtitle'])?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="sec_01">
        <div class="inner">
            <div class="header_sec">
                <h3 class="title_sec"><i style="color : #29459f">더투어랩</i> 테마여행</h3>
                <p class="sub_title_sec">관광지부터 핫 플레이스, 맛집까지 정보가 한곳에</p>
            </div>
            <div class="only_web content_sec">
                <div class="list_item">
                    <?php foreach($bannerMiddle as $i => $banner): 
                        $url = !empty($banner['url']) ? $banner['url'] : "/travel-tips/theme_travel";
                    ?>
                        <a 
                            href="<?=$url?>" 
                            class="item item_1" 
                            style="background-image: url('/data/cate_banner/<?=$banner['ufile1']?>');"
                            data-pc="/data/cate_banner/<?=$banner['ufile1']?>"
                            data-mo="/data/cate_banner/<?=$banner['ufile2']?>"
                            id="banner_<?=$i?>"
                        >
                            <span><?=$banner['title']?></span>
                        </a>
                    <?php endforeach; ?>

                    <script>
                        function updateBannerImages() {
                            const isMobile = window.innerWidth < 850;
                            document.querySelectorAll('.item.item_1').forEach(el => {
                                const img = isMobile ? el.dataset.mo : el.dataset.pc;
                                el.style.backgroundImage = `url('${img}')`;
                            });
                        }

                        window.addEventListener('DOMContentLoaded', updateBannerImages);
                        window.addEventListener('resize', updateBannerImages);
                    </script>
                    <!-- <a href="#!" class="item item_1">
                        <span>#관광명소</span>
                    </a>
                    <a href="#!" class="item item_2">
                        <span>#할거리</span>
                    </a>
                    <a href="#!" class="item item_3">
                        <span>#음식</span>
                    </a>
                    <a href="#!" class="item item_4">
                        <span>#쇼핑</span>
                    </a>
                    <a href="#!" class="item item_5">
                        <span>#나이트</span>
                    </a> -->
                </div>
            </div>
            <div class="only_mo content_sec">
                <div class="swiper swipper_sec_01">
                    <div class="swiper-wrapper list_item">
                        <div class="swiper-slide">
                            <a href="#!" class="item item_1">
                                <span>#관광명소</span>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#!" class="item item_2">
                                <span>#할거리</span>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#!" class="item item_3">
                                <span>#음식</span>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#!" class="item item_4">
                                <span>#쇼핑</span>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#!" class="item item_5">
                                <span>#나이트</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sec_02">
        <div class="inner">
            <div class="header_sec">
                <h3 class="title_sec">추천 여행지</h3>
                <a href="/travel-tips/hot-place" class="more_link">더보기 +</a>
            </div>
            <div class="content_sec">
                <div class="relative">
                    <div class="swiper tra_sec_02_swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a class="tra_sec_02_swiper_item" href="/travel-tips/view_detail">
                                    <div class="_img_box">
                                        <img src="/images/sub/tra-sec-02-1.png" alt="">
                                    </div>
                                    <div class="_text_box">
                                        <h5>가볼만한 아름다운 태국 사원</h5>
                                        <p>태국 사원에서 시작하는 태국 여행!</p>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a class="tra_sec_02_swiper_item" href="/travel-tips/view_detail">
                                    <div class="_img_box">
                                        <img src="/images/sub/tra-sec-02-2.png" alt="">
                                    </div>
                                    <div class="_text_box">
                                        <h5>태국 로컬시장 완벽 탐구! </h5>
                                        <p>전통시장부터 야시장까지~</p>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a class="tra_sec_02_swiper_item" href="/travel-tips/view_detail">
                                    <div class="_img_box">
                                        <img src="/images/sub/tra-sec-02-3.png" alt="">
                                    </div>
                                    <div class="_text_box">
                                        <h5>타이 쿠킹 스쿨 리스트</h5>
                                        <p>태국 요리도 배우고 음식도 맛보고</p>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a class="tra_sec_02_swiper_item" href="/travel-tips/view_detail">
                                    <div class="_img_box">
                                        <img src="/images/sub/tra-sec-02-2.png" alt="">
                                    </div>
                                    <div class="_text_box">
                                        <h5>태국 로컬시장 완벽 탐구! </h5>
                                        <p>전통시장부터 야시장까지~</p>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-pagination tra_sec_02_swiper_pagination"></div>
                    <div class="swiper-button-next tra_sec_02_swiper_btn_next"></div>
                    <div class="swiper-button-prev tra_sec_02_swiper_btn_prev"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrap_secs">
        <div class="inner">
            <div class="sec_03">
                <div class="header_sec">
                    <h3 class="title_sec">여행정보</h3>
                    <a href="/travel-tips/travel-info" class="more_link">더보기 +</a>
                </div>
                <div class="content_sec">
                    <div class="list_travel_info">
                        <?php
                            $arrDayOfWeek = ['일', '월', '화', '수', '목', '금', '토'];
                            foreach($tour_list as $tour):
                                $dateString = $tour["r_date"];
                                $timestamp = strtotime($dateString);
                                $dayOfWeek = date('w', $timestamp);

                                if(!empty($tour["ufile1"])){
                                    $img_tour = "/data/bbs/" . $tour["ufile1"];
                                }
                        ?>
                            <a href="/travel-tips/travel-info/view?code=<?=$tour["code"]?>&bbs_idx=<?=$tour["bbs_idx"]?>" class="item">
                                <img src="<?=$img_tour?>" alt="<?=$tour["rfile1"]?>">
                                <div class="bx_text">
                                    <span class="head_text"><?=$tour["code_name"]?></span>
                                    <p class="title"><?=$tour["subject"]?></p>
                                    <div class="desc">
                                        <span class="time"><?=date('Y-m-d', $timestamp)?>(<?=$arrDayOfWeek[$dayOfWeek]?>)</span>
                                        <span class="name"><?=$tour["writer"]?></span>
                                        <span class="view">조회수 <?=$tour["hit"]?></span>
                                    </div>
                                </div>
                            </a>
                        <?php
                            endforeach;
                        ?>
                        <!-- <a href="#!" class="item">
                            <img src="/images/sub/tra-sec-03-2.png" alt="">
                            <div class="bx_text">
                                <span class="head_text">기타 정보</span>
                                <p class="title">[태국/정보] 2025년 연휴달력, 여행가기 좋은 날은 언제?</p>
                                <div class="desc">
                                    <span class="time">2025-01-08(수)</span>
                                    <span class="name">더투어랩-스마일</span>
                                    <span class="view">조회수 25</span>
                                </div>
                            </div>
                        </a>
                        <a href="#!" class="item">
                            <img src="/images/sub/tra-sec-03-3.png" alt="">
                            <div class="bx_text">
                                <span class="head_text">기타 정보</span>
                                <p class="title">[태국/쇼핑] 300원짜리 볶음면? 한국인들이 안 사서 정리 골프 여행객에게 인기 좋은 호텔</p>
                                <div class="desc">
                                    <span class="time">2025-01-08(수)</span>
                                    <span class="name">더투어랩-스마일</span>
                                    <span class="view">조회수 25</span>
                                </div>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="sec_04">
                <div class="header_sec">
                    <h3 class="title_sec">테마별 인기호텔</h3>
                    <a href="/travel-tips/theme_main" class="more_link">더보기 +</a>
                </div>
                <div class="content_sec">
                    <div class="list_travel_banner">
                        <a href="/travel-tips/theme_view" class="item">
                            <img class="only_web" src="/images/sub/tra-sec-04-1.png" alt="">
                            <img class="only_mo" src="/images/sub/tra-sec-04-1-m.png" alt="">
                            <div class="bx_text">
                                <span class="loca">방콕ㆍ파타야</span>
                                <p class="title">골프 여행객에게 인기 좋은 호텔</p>
                            </div>
                        </a>
                        <a href="/travel-tips/theme_view" class="item">
                            <img class="only_web" src="/images/sub/tra-sec-04-2.png" alt="">
                            <img class="only_mo" src="/images/sub/tra-sec-04-2-m.png" alt="">
                            <div class="bx_text">
                                <span class="loca">태국</span>
                                <p class="title">골프 여행객에게 인기 좋은 호텔</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sec_05">
        <div class="inner">
            <div class="header_sec">
                <h3 class="title_sec">인포그래픽</h3>
                <a href="/travel-tips/infographic" class="more_link">더보기 +</a>
            </div>
            <div class="only_web content_sec">
                <div class="list_travel_banner">
                    <?php
                        foreach($infographics_list as $infographic) :
                            if(!empty($infographic["ufile1"])) {
                                $img_infographic = "/data/bbs/" . $infographic["ufile1"];
                            }
                    ?>
                        <a href="/travel-tips/infographic/view?code=<?=$infographic["code"]?>&bbs_idx=<?=$infographic["bbs_idx"]?>" class="item">
                            <img src="<?=$img_infographic?>" alt="<?=$infographic["rfile1"]?>">
                        </a>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>

            <div class="only_mo content_sec">
                <div class="swiper swipper_sec_05">
                    <div class="swiper-wrapper">
                        <?php
                            foreach($infographics_list as $infographic_mo) :
                                if(!empty($infographic_mo["ufile1"])) {
                                    $img_infographic_mo = "/data/bbs/" . $infographic_mo["ufile1"];
                                }
                        ?>
                            <div class="swiper-slide">
                                <a href="#!" class="item">
                                    <img src="<?=$img_infographic_mo?>" alt="<?=$infographic_mo["rfile1"]?>">
                                </a>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
                <div class="swiper-pagination tra-sec-05-swiper-pagination"></div>
            </div>
        </div>
    </div>

    <div class="sec_06">
        <div class="inner">
            <div class="header_sec">
                <h3 class="title_sec"><span style="color : #29459f">더투어랩</span> 매거진 최신호</h3>
                <a href="/magazines/list" class="more_link">더보기 +</a>
            </div>
            <div class="content_sec">
                <div class="swiper swipper_sec_06">
                    <div class="list_travel_banner swiper-wrapper">
                        <?php foreach ($magazines as $magazine): ?>
                            <div class="swiper-slide">
                                <a href="/magazines/detail?m_idx=<?= $magazine['bbs_idx'] ?>" class="item">
                                    <img src="/data/bbs/<?= $magazine['ufile1'] ?>" alt="">
                                </a>
                            </div>
                        <?php endforeach; ?>

                        <!-- <div class="swiper-slide">
                            <a href="#!" class="item">
                                <img src="/images/sub/tra-sec-06-2.png" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#!" class="item">
                                <img src="/images/sub/tra-sec-06-3.png" alt="">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#!" class="item">
                                <img src="/images/sub/tra-sec-06-2.png" alt="">
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.slider_sec_01').slick({
                dots: false,
                infinite: true,
                speed: 500,
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: false,
            });
        });
    </script>

    <script>
        var swiper = new Swiper(".swipper_sec_01", {
            slidesPerView: 2,
            spaceBetween:20,
            centeredSlides: false,
            loop: true,
        });
    </script>

    <script>
        var swiper = new Swiper(".swipper_sec_05", {
            slidesPerView: "auto",
            spaceBetween: 20,
            centeredSlides: true,
            loop: true,
            pagination: {
                el: ".swiper-pagination.tra-sec-05-swiper-pagination",
                clickable: true,
            },
        });
    </script>

    <script>
        var swiper = new Swiper(".swipper_sec_06", {
            slidesPerView: "auto",
            spaceBetween: 20,
            loop: true,
        });
    </script>

    <script>
        var swiper = new Swiper(".tra_sec_02_swiper", {
            slidesPerView: "auto",
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination.tra_sec_02_swiper_pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next.tra_sec_02_swiper_btn_next",
                prevEl: ".swiper-button-prev.tra_sec_02_swiper_btn_prev",
            },
        });
    </script>

    <?php $this->endSection(); ?>