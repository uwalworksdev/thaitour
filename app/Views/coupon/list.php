<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<section class="coupon_list">
    <div class="inner">
        <div class="coupon_visual">
            <img src="/images/sub/coupon_main.png" alt="" class="only_w">
            <img src="/images/sub/coupon_main_mo.png" alt="" class="only_m">
            <div class="visual_txt">
                <p>할인쿠폰 전체 출력</p>
                <span>전체 쿠폰 출력을 원하시면 클릭해주세요.</span>
            </div>
        </div>
        <div class="coupon_content">
            <div class="top">
                <p>여행 쿠폰</p>
                <div class="custom_select_rounded" style="display: flex !important;">
                    <select class="select_custom_ select_code_category">
                        <option value="">전체</option>
                        <?php 
                            foreach($code_list as $code){
                        ?>
                            <option value="<?=$code["code_no"]?>"><?=$code["code_name"]?></option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="list_tag" style="flex-wrap: wrap;">
                <!-- <button type="button" class="active tag">전체</button>
                <button type="button" class="tag">방콕</button>
                <button type="button" class="tag">파타야</button>
                <button type="button" class="tag">푸켓</button>
                <button type="button" class="tag">치앙마이</button>
                <button type="button" class="tag">치앙라이</button>
                <button type="button" class="tag">후아힌</button>
                <button type="button" class="tag">카오야이</button>
                <button type="button" class="tag">칸차나부리</button>
                <button type="button" class="tag">기타지역</button> -->
            </div>
            <div class="card_cou">
                <!-- <div class="card">
                    <div class="images">
                        <img src="/images/sub/coupon_img01.png" alt="">
                    </div>
                    <div class="text">
                        <div class="keyword">
                            <p>기타</p>
                        </div>
                        <p class="title">첫 예약 축하 5000포인트 쿠폰</p>
                    </div>
                </div>
                <div class="card">
                    <div class="images">
                        <img src="/images/sub/coupon_img02.png" alt="">
                    </div>
                    <div class="text">
                        <div class="keyword">
                            <p>방콕 후웨이꽝</p>
                        </div>
                        <p class="title">꽝씨푸드 10% 할인 쿠폰</p>
                    </div>
                </div>
                <div class="card">
                    <div class="images">
                        <img src="/images/sub/coupon_img03.png" alt="">
                    </div>
                    <div class="text">
                        <div class="keyword">
                            <p>방콕</p>
                        </div>
                        <p class="title">해브 어 지드 (Have a zeed) 10% 할인
                        쿠폰 </p>
                    </div>
                </div>
                <div class="card">
                    <div class="images">
                        <img src="/images/sub/coupon_img04.png" alt="">
                    </div>
                    <div class="text">
                        <div class="keyword">
                            <p>방콕 Phra Khanong</p>
                        </div>
                        <p class="title">서울 비비큐 보이(Seoul BBQ Boy) 20%
                        할인 쿠폰</p>
                    </div>
                </div> -->
                
            </div>
            <div class="add_btn flex_c_c">
                <button type="button" class="add_card flex_c_c coupon_pagination_btn">더보기 +</button>
            </div>
        </div>
    </div>
    <div class="popup_coupon" data-coupon_idx="">
        <div class="popup">
            <div class="top flex_e_c">
                <button type="button" class="close">
                    <img src="/images/ico/close_icon_popup.png" alt="닫기 아이콘">
                </button>
            </div>
            <div class="content">
                <div class="infomation flex">
                    <div class="avatar_info">
                        <img src="/images/sub/infomation_coupon.png" alt="">
                    </div>
                    <div class="txt_info">
                        <p class="title">서울 비비큐 보이(Seoul BBQ Boy) 20% 할인 쿠폰</p>
                        <div class="list_des">
                            <div class="des flex">
                                <p>ㆍ대상 :</p>
                                <span class="target">더투어랩을 통해 예약하신 모든 회원</span>
                            </div>
                            <div class="des flex">
                                <p>ㆍ사용처 :</p>
                                <span class="location">프라카농 지점</span>
                            </div>
                            <div class="des flex">
                                <p>ㆍ유의사항 :</p>
                                <span class="memo">서울 비비큐 보이(Seoul BBQ Boy) 1,000바트 이상 매장내 식사 또는
                                방문포장시 20% 할인 쿠폰 (주류, 부가세 제외금액)</span>
                            </div>
                            <div class="des flex">
                                <p>ㆍ유효기간 :</p>
                                <span class="exp_date">2023-04-11(화) ~ 2033-06-30(목)</span>
                            </div>
                        </div>
                        <div class="info_download">
                            <button class="btn_down flex_c_c" type="button">
                                <img src="/images/sub/ic_download.png" alt="" class="only_w">
                                <img src="/images/sub/ic_download_m.png" alt="" class="only_m">
                                <p>쿠폰 다운받기</p>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="infomation_slide">
                    <div class="swiper myslide">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="/images/sub/coupon_img05.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/sub/coupon_img05.png" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img src="/images/sub/coupon_img05.png" alt="">
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="infomation_detail">
                    <p class="detail_tit">방콕 프라카농 역 주변에 위치한 비비큐 맛집!! 한국 음식이 생각날때 방문해 보세요^^</p>
                    <p class="detail_tit">서울 비비큐 보이(Seoul BBQ Boy) 1,000바트 이상 식사 또는 방문포장시 20% 할인 쿠폰 (주류, 부가세 제외금액)</p>
                    <div class="content">
                        <p><span>예약전화 :</span> 097-005-0138</p>
                        <p><span>영업시간 :</span> 11:30 - 22:00</p>
                        <p>구글맵에 Seoul BBQ boy 로 검색하시면 위치 확인 가능합니다.</p>
                        <p>- 모바일 쿠폰으로 이용 가능합니다.</p>
                    </div>
                </div>
                <!-- <div class="infomation_map">
                    <div class="text">
                        <p>주소 : 4091 Rama IV Rd, Phra Khanong, Khlong Toei, Bangkok 10110</p>
                        <p>전화 : 097-005-0138</p>
                    </div>
                    <div id="map" class="map_info" style="width: 100%; height: 300px;"></div>
                    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
                    <script>
                             var lat = '20.7011147' || 13.7563;
                            var lng = '106.7859727' || 100.5018;
                            var map = L.map('map').setView([lat, lng], 17);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: 'The Tour Lab'
                            }).addTo(map);
                            L.marker([lat, lng]).addTo(map)

                            setTimeout(() => {
                                map.invalidateSize();
                            }, 500);
                    </script>
                </div> -->
            </div>
        </div>
        <div class="bg"></div>
    </div>
</section>
<script>
    const select_cat = $('.custom_select_rounded .select_code_category');
    var current_page = 1;   

    function adjustSelectWidth() {
        const tempSpan = $('<span>')
            .css({
                visibility: 'hidden',
                position: 'absolute',
                whiteSpace: 'nowrap',
            })
            .text(select_cat.find('option:selected').text())
            .appendTo('body');

        const newWidth = tempSpan.outerWidth() + 70;
        select_cat.css('width', newWidth);
        tempSpan.remove();
    }

    select_cat.on('change', adjustSelectWidth);

    $(document).ready(function() {
        adjustSelectWidth();
        get_code();
        get_coupon_list(1);
    });

    $('.custom_select_rounded .select_code_category').on("change", function() {
        get_code();
    });

    function formatToYYYYMMDD(dateString) {
        const date = new Date(dateString);
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');

        return `${year}-${month}-${day}`;
    }

    function getDayOfWeekKorean(dateString) {
        const date = new Date(dateString);
        const daysKorean = ['일', '월', '화', '수', '목', '금', '토'];
        return daysKorean[date.getDay()];
    }

    $(".popup_coupon .info_download .btn_down").on("click", function() {

        <?php
            if(empty(session()->get("member")["id"])){
        ?>  
            alert("쿠폰을 적용하려면 로그인하세요.");   
            return false;   
        <?php
            }   
        ?>

        if (!confirm("이 쿠폰을 추가하시겠습니까?")){
            return false;
        }

        let coupon_idx = $(this).closest(".popup_coupon").attr('data-coupon_idx');

        $.ajax({
            url: "/coupon/add_coupon_member",
            type: "POST",
            data: {
                coupon_idx: coupon_idx
            },
            success: function(response) {
                alert(response.message);
                if(response.result == true){
                    location.reload();
                }
            }
        });
    });

    $(".coupon_pagination_btn").on("click", function() {
        current_page += 1;
        get_coupon_list(current_page);
    });

    function get_coupon_list(page) {
        let code_no = $('.custom_select_rounded .select_code_category').val();
        let child_code = $('.list_tag .tag.active').data("code");

        $.ajax({
            url: "/ajax/get_coupon_list",
            type: "GET",
            data: {
                code: code_no,
                child_code: child_code,
                page: page
            },
            success: function(res) {
                let data = res["coupon_list"];
                let totalPage = res["nPage"];
                let html = ``;
                data.forEach(element => {
                    let img = "";
                    if(element["ufile1"]){
                        img = "/data/coupon/" + element["ufile1"];
                    }
                    html += `<div class="card" data-idx="${element["idx"]}">
                                <div class="images">
                                    <img src="${img}" alt="${element["rfile1"]}">
                                </div>
                                <div class="text">
                                    <div class="keyword">
                                        <p>${element["category_name"]}</p>
                                    </div>
                                    <p class="title">${element["coupon_name"]}</p>
                                </div>
                            </div>`;
                });

                if(page <= 1){
                    $(".card_cou").html(html);
                }else{
                    $(".card_cou").append(html);
                }

                if(page >= totalPage){
                    $(".coupon_pagination_btn").hide();
                }else{
                    $(".coupon_pagination_btn").show();
                }

            }
        })
    }

    function get_code() {
        let code_no = $('.custom_select_rounded .select_code_category').val();
        $.ajax({
            url: "/ajax/get_sub_code",
            type: "GET",
            data: {
                code: code_no,
                depth: 3
            },
            success: function(res) {
                $(".list_tag").empty();
                let data = res.results;
                let html = `<button type="button" class="active tag" data-code="">전체</button>`;
                data.forEach(element => {
                    html += `<button type="button" class="tag" data-code="${element["code_no"]}">${element["code_name"]}</button>`;
                });
                $(".list_tag").html(html);

                get_coupon_list(1);
            }
        });
    }

    $(".list_tag").on("click", ".tag", function () {
        $(this).addClass("active").siblings().removeClass("active");
        get_coupon_list(1);
    });

    $(".card_cou").on("click", ".card", function () {
        let idx = $(this).data("idx");

        $.ajax({
            url: "/ajax/coupon_view",
            type: "GET",
            data: {
                idx: idx
            },
            success: function(res) {
                let data = res;
                let text_use = "";

                if(data["is_use"] == 'Y'){
                    $(".popup_coupon .info_download button p").text("쿠폰 다운로드 완료");
                    $(".popup_coupon .info_download button").prop('disabled', true);
                }else if(data["is_use"] == 'D'){
                    $(".popup_coupon .info_download button p").text("쿠폰이 만료되었습니다");
                    $(".popup_coupon .info_download button").prop('disabled', true);
                }else{
                    $(".popup_coupon .info_download button p").text("쿠폰 다운받기");
                    $(".popup_coupon .info_download button").prop('disabled', false);
                }


                let avatar_info = "";
                if(data["ufile1"]){
                    avatar_info = "/data/coupon/" + data["ufile1"];
                }

                $(".popup_coupon .popup .avatar_info").html(
                    `<img src="${avatar_info}" alt="${data["rfile1"]}">`
                );
                
                let exp_start_day = formatToYYYYMMDD(data["exp_start_day"]);
                let exp_end_day = formatToYYYYMMDD(data["exp_end_day"]);
                let exp_day = exp_start_day + "(" + getDayOfWeekKorean(exp_start_day) + ")" + " " + exp_end_day + "(" + getDayOfWeekKorean(exp_end_day) + ")";
                $(".popup_coupon .popup .txt_info .title").text(data["coupon_name"]);
                $(".popup_coupon .popup .txt_info .target").text(data["member_grade_name"]);
                $(".popup_coupon .popup .txt_info .location").text(data["location"]);
                $(".popup_coupon .popup .txt_info .memo").text(data["etc_memo"]);
                $(".popup_coupon .popup .txt_info .exp_date").text(exp_day);                

                if(data["cnt_img"] > 0){
                    let img_slide = `<div class="swiper myslide">
                                        <div class="swiper-wrapper">`;
                    for(let i = 2; i <= 7; i++){
                        if(data["ufile" + i]){
                            let img_sub = "/data/coupon/" + data["ufile" + i];
                            img_slide += `
                                <div class="swiper-slide">
                                    <img src="${img_sub}" alt="${data["rfile" + i]}">
                                </div>
                            `;
                        }
                    }  
                    img_slide += `  </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-pagination"></div>
                                </div>`;


                    $(".popup_coupon .popup .infomation_slide").html(img_slide);

                    if (swiper instanceof Swiper) {
                        swiper.destroy(true, true);
                    }

                    swiper = new Swiper(".myslide", {
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        pagination: {
                            el: ".swiper-pagination",
                        },
                    });
                }else{
                    $(".popup_coupon .popup .infomation_slide").empty();
                }

                $(".popup_coupon .popup .infomation_detail").html(data["coupon_contents"]);

            }
        });

        $('.popup_coupon').attr("data-coupon_idx", idx);

        $('.popup_coupon').show();
        // setTimeout(() => {
        //     map.invalidateSize();
        // }, 300);
    });

    $('.popup_coupon .close, .popup_coupon .bg').on('click', function () {
        $('.popup_coupon').hide();
    });
</script>
<script>
    var swiper;
    swiper = new Swiper(".myslide", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
</script>
<?php $this->endSection(); ?>