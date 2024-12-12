<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?= view("inc/popup_main") ?>

<style>
    .mice_main_visual {
    height: 329px;
    background: url('/img/sub/online_quote_mainvisual_bg_w.png') no-repeat center / cover;
}

.mice_main_visual .title {
    font-size: 40px;
    color: rgb(255, 255, 255);
    text-align: center;
    padding-top: 180px;
    font-family: 'NanumMyeongjo';
    font-weight: 600;
}

.mice_main {
    padding: 100px 0 115px;
}

.ttl_services { 
    font-family: "Pretendard", sans-serif;
    font-weight: bold;
    font-size: 38px;
    color: #252525;
    text-align: center;
}

.our_location_ttl {
    font-weight: bold;
    font-size: 48px;
    line-height: 66px;
    color: #252525;
    text-align: center;
    margin-top: 30px;
}

.ttl_sub_greeting {
    margin-top: 65px;
}

.ttl_sub_greeting {
    font-weight: 500;
    font-size: 28px;
    color: #454545;
    text-align: center;
    margin-top: 30px;
}

.des_sub_greeting {
    font-size: 20px;
    line-height: 30px;
    color: #454545;
    text-align: center;
    margin-top: 35px;
}

.our_services {
    padding: 140px 0 130px;
    background-color: #fbfbfb;
}

.ttl_services { 
    font-family: "Pretendard", sans-serif;
    font-weight: bold;
    font-size: 38px;
    color: #252525;
    text-align: center;
}

.our_services_list {
    margin-top: 60px;
    display: flex;
    gap: 25px;
}

.our_services_list .our_services_el {
    width: 25%;
}

.our_services_list .our_services_el img {
    width: 100%;
    height: 220px;
}

.our_services_list .our_services_el h5 {
    font-weight: 500;
    font-size: 20px;
    color: #454545;
    margin-top: 25px;
}

.our_services_list .our_services_el p {
    font-size: 16px;
    line-height: 22px;
    color: #757575;
    margin-top: 15px;
}

.our_value {
    padding: 180px 0 230px;
    background: url("/img/sub/our_value_bg.png") no-repeat center;
    background-size: 100% 100%;
}

.ttl_value {
    font-family: "Pretendard", sans-serif;
    font-weight: bold;
    font-size: 38px;
    color: #fbfbfb;
    text-align: center;
}

.our_value_ttl {
    margin-top: 30px;
    font-weight: bold;
    font-size: 48px;
    line-height: 66px;
    color: #fbfbfb;
    text-align: center;
}

.our_value_ttl span {
    color: #ff8f13;
}

.our_value_re {
    margin-top: 45px;
    text-align: center;
    font-size: 20px;
    color: #fbfbfb;
    opacity: 0.4;
    letter-spacing: 1px;
}

.our_location {
    padding: 130px 0 180px;
}

.our_location_ttl {
    font-weight: bold;
    font-size: 48px;
    line-height: 66px;
    color: #252525;
    text-align: center;
    margin-top: 30px;
}

.complete_sect {
    padding: 100px 0;
    background-color: #f9f9f9;
}

.complete_wrap .complete_list {
    gap: 80px;
    margin-top: 50px;
    align-items: flex-start;
    max-width: 825px;
    flex-wrap: wrap;
}

.complete_wrap .complete_list .complete_child img {
    width: 120px;
    height: 120px;
}

.complete_wrap .complete_list .complete_child p {
    font-size: 18px;
    line-height: 24px;
    color: #454545;
    margin-top: 20px;
    text-align: center;
}

.meeting_sect {
    padding: 120px 0 150px;
}

.meeting_sect .meeting_wrap {
    margin-top: 25px;
}

.meeting_sect .meeting_wrap .meeting_list {
    display: flex;
    gap: 40px;
    padding: 30px 0;
    border-bottom: 1px solid #eeeeee;
}

.meeting_sect .meeting_wrap .meeting_list img {
    width: 540px;
    height: 320px;
}

.meeting_sect .meeting_wrap .meeting_list .content {
    margin-top: 20px;
}

.meeting_sect .meeting_wrap .meeting_list .content .ttl {
    font-size: 24px;
    font-weight: bold;
    color: #252525;
}

.meeting_sect .meeting_wrap .meeting_list .content .ttl.two {
    margin-top: 25px;
}

.meeting_sect .meeting_wrap .meeting_list .content .desc {
    font-size: 18px;
    line-height: 30px;
    color: #757575;
    margin-top: 15px;
}

@media screen and (max-width: 850px) {
    .ttl_services {
        font-family: "Pretendard", sans-serif;
        font-weight: bold;
        font-size: 1.8462rem;
        color: #252525;
        text-align: center;
    }

    .our_location_ttl {
        font-weight: bold;
        font-size: 2.2308rem;
        line-height: 2.9231rem;
        color: #252525;
        text-align: center;
        margin-top: 1.1538rem;
    }

    .our_location_ttl {
        margin-top: 2.1154rem;
    }

    .ttl_sub_greeting {
        font-weight: 500;
        font-size: 1.3077rem;
        color: #454545;
        text-align: center;
        margin-top: 1.5385rem;
    }

    .ttl_sub_greeting {
        margin-top: 2.1154rem;
    }

    .des_sub_greeting {
        font-size: 1.1538rem;
        line-height: 1.5385rem;
        color: #454545;
        text-align: center;
        margin-top: 1.7308rem;
        padding: 0 .7692rem;
    }

    .complete_sect {
        padding: 4.0385rem 0;
        background-color: #f9f9f9;
    }
    
    .complete_wrap .complete_list {
        gap: 2.3077rem 0;
        margin-top: 3.6538rem;
        align-items: flex-start;
        max-width: 100%;
        flex-wrap: wrap;
    }
    
    .complete_wrap .complete_list .complete_child {
        width: 50%;
    }

    .complete_wrap .complete_list .complete_child img {
        width: 7.6923rem;
        height: 7.6923rem;
    }
    
    .complete_wrap .complete_list .complete_child p {
        font-size: 1.0769rem;
        line-height: 1.3077rem;
        color: #454545;
        margin-top: 1.3462rem;
        text-align: center;
    }
    
    .meeting_sect {
        padding: 4.6154rem 0 9.0385rem;
    }
    
    .meeting_sect .meeting_wrap {
        margin-top: 0;
    }
    
    .meeting_sect .meeting_wrap .meeting_list {
        display: flex;
        flex-wrap: wrap;
        gap: 0;
        padding: 2.3077rem 0;
        border-bottom: .0769rem solid #eeeeee;
    }
    
    .meeting_sect .meeting_wrap .meeting_list img {
        width: 100%;
        height: 15rem;
    }
    
    .meeting_sect .meeting_wrap .meeting_list .content {
        margin-top: 0;
    }
    
    .meeting_sect .meeting_wrap .meeting_list .content .ttl {
        font-size: 1.3077rem;
        font-weight: bold;
        color: #252525;
        margin-bottom: 0;
        margin-top: 1.3462rem;
    }
    
    .meeting_sect .meeting_wrap .meeting_list .content .ttl.two {
        margin-top: 1.3462rem;
    }
    
    .meeting_sect .meeting_wrap .meeting_list .content .desc {
        font-size: 1.0769rem;
        line-height: 1.5385rem;
        color: #757575;
        margin-top: 1.1538rem;
    }
}
</style>
<script>
    $(document).ready(function () {
        $('a[data-key="micepage"]').addClass("active_");
    })
</script>
<section class="mice_main_visual">
    <h1 class="title">MICE</h1>
</section>
<section class="mice_main">
    <div class="inner">
        <h2 class="ttl_services">MICE</h2>
        <h3 class="our_location_ttl">
            태국전문 여행사로 20년 노하우를 가진
            <br class="only_web">
            스페셜 맞춤 여행의 선두주자! 
        </h3>
        <h3 class="ttl_sub_greeting">차별화 된 독창적인 프로그램과 남다른 노하우에서 오는 감동적인 서비스</h3>
        <p class="des_sub_greeting">
            M.I.C.E란 Meeting, Incentive, Convention, Exhibition을 의미하며, 트리플굿투어는 <br class="only_web">
            다양한 국제회의, 전시 및 박람회, 문화이벤트 등 국제적인 기업행사를 타사와는 차별화 된 독창적인 프로그램과 <br class="only_web">
            MICE 전문팀만의 노하우로 감동적인 서비스를 제공하고 있습니다.
        </p>
        <p class="des_sub_greeting">
            ※ 연간 M.I.C.E 프로젝트 : 주요고객사 150여개, 행사 건수 약 350여건. 행사 참여 인원 : 연 45,000명 이상
        </p>
    </div>
</section>
<section class="complete_sect">
    <div class="inner">
        <h2 class="ttl_services">MICE 경쟁력</h2>
        <div class="complete_wrap flex_c_c dr-col">
            <div class="complete_list flex_c_c">
                <div class="complete_child flex_c_c dr-col">
                    <img src="/img/ico/mice_ico_1.png" alt="">
                    <p>
                        국내 최초 서비스 <br>
                        보장제 시행
                    </p>
                </div>
                <div class="complete_child flex_c_c dr-col">
                    <img src="/img/ico/mice_ico_2.png" alt="">
                    <p>
                        기업에 맞는 새로운 <br>
                        지역 개발 및 추천
                    </p>
                </div>
                <div class="complete_child flex_c_c dr-col">
                    <img src="/img/ico/mice_ico_3.png" alt="">
                    <p>
                        Activity 프로그램 <br>
                        기획 및 진행
                    </p>
                </div>
                <div class="complete_child flex_c_c dr-col">
                    <img src="/img/ico/mice_ico_4.png" alt="">
                    <p>
                        스토리텔링 기획하여 <br>
                        담은 감동적인 행사기획
                    </p>
                </div>
                <div class="complete_child flex_c_c dr-col">
                    <img src="/img/ico/mice_ico_5.png" alt="">
                    <p>
                        전문 STAFF 구성
                    </p>
                </div>
                <div class="complete_child flex_c_c dr-col">
                    <img src="/img/ico/mice_ico_6.png" alt="">
                    <p>
                        행사 기획,현지 진행까지 <br>
                        스페셜리스트 전담
                    </p>
                </div>
                <div class="complete_child flex_c_c dr-col">
                    <img src="/img/ico/mice_ico_7.png" alt="">
                    <p>
                        행사 종료 후 설문을 <br>
                        통한 행사 리포트 제공
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="meeting_sect">
    <div class="inner">
        <h2 class="ttl_services">MICE (Meeting, Incentive, Convention, Exhibition)</h2>
        <div class="meeting_wrap">
            <div class="meeting_list">
                <div class="img_wrap">
                    <img src="/img/sub/mice_meeting_1.png" alt="">
                </div>
                <div class="content">
                    <h4 class="ttl">Meeting</h4>
                    <p class="desc">
                        - 국제회의, 정부회의, 기업/협회회의 <br>
                        - 회의기획, 준비 및 집행 <br>
                        - 예산관리, 스폰서 교섭 및 선정 <br>
                        - 행사장 섭외, 예상참가자 DB구축
                    </p>
                    <h4 class="ttl two">주요행사</h4>
                    <p class="desc">
                        - 연간 미팅 <br>
                        - IR 행사
                    </p>
                </div>
            </div>
            <div class="meeting_list">
                <div class="img_wrap">
                    <img src="/img/sub/mice_meeting_2.png" alt="">
                </div>
                <div class="content">
                    <h4 class="ttl">Incentive</h4>
                    <p class="desc">
                        - 포상관광 프로그램 기획 및 진행 <br>
                        - 행사지 분석 및 여행 컨설팅 <br>
                        - 각종 액티비티 및 팀빌딩 프로그램 <br>
                        - 국내 항공, 숙박등 토탈 여행서비스
                    </p>
                    <h4 class="ttl two">주요행사</h4>
                    <p class="desc">
                        - 기업체 및 그룹 세일즈 인센티브 투어 <br>
                        - VIP 스페셜 투어 <br>
                        - 포상여행 <br>
                        - 고객감사 여행 프로그램
                    </p>
                </div>
            </div>
            <div class="meeting_list">
                <div class="img_wrap">
                    <img src="/img/sub/mice_meeting_3.png" alt="">
                </div>
                <div class="content">
                    <h4 class="ttl">Convention</h4>
                    <p class="desc">
                        - 국제 학술전 및 세계 총회 유치 <br>
                        - 행사 프로그램 편성, 관리 <br>
                        - 공식 및 사교행사 기획 및 진행 <br>
                        - 부대 행사 기획 및 운영
                    </p>
                    <h4 class="ttl two">주요행사</h4>
                    <p class="desc">
                        - 해외 의학회 <br>
                        - 컨퍼런스 및 컨벤션 개최/참가 여행
                    </p>
                </div>
            </div>
            <div class="meeting_list">
                <div class="img_wrap">
                    <img src="/img/sub/mice_meeting_4.png" alt="">
                </div>
                <div class="content">
                    <h4 class="ttl">Event &amp; Exhibition</h4>
                    <p class="desc">
                        - 전시기획 및 운영 <br>
                        - 사내 워크샵 기획 및 진행 <br>
                        - 팀 빌딩 추천 프로그램 제시 <br>
                        - 행사 홍보 및 마케팅
                    </p>
                    <h4 class="ttl two">주요행사</h4>
                    <p class="desc">
                        - 팀빌딩 및 팀워크 프로그램 <br>
                        - 각종 테마파티 및 만찬 <br>
                        - 각종 시상식 및 연도상 개최
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection(); ?>