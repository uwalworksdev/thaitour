<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?= view("inc/popup_main") ?>

    <style>
        .main_visual {
            height: 540px;
            background: url("/img/sub/group_main_visual_w.jpg") no-repeat center;
        }

        .main_visual h1 {
            font-family: "ONE Mobile Title";
            font-size: 28px;
            line-height: 27px;
            text-align: center;
            color: #37495f;
            padding-top: 90px;
        }

        .section_2 {
            margin-top: 120px;
        }

        .section_2 .top_content {
            text-align: center;
        }

        .section_2 .top_content .title {
            font-family: "ONEMobileTitle";
            font-size: 34px;
            line-height: 46px;
            color: #252525;
        }

        .section_2 .top_content .description {
            margin-top: 40px;
            font-size: 20px;
            line-height: 30px;
            color: #757575;
        }

        .section_2 .top_content .list_img {
            margin: 90px 0;
            gap: 120px;
        }

        .section_2 .bot_content {
            margin: 0 auto;
            margin-bottom: 285px;
            max-width: 1600px;
            height: 510px;
            background: url("/img/sub/group_section_2_bot_content_bg_w.png") no-repeat center;
        }

        .section_2 .bot_content .note {
            padding: 70px 75px;
            position: absolute;
            left: 0;
            top: 410px;
            width: 860px;
            height: 200px;
            z-index: 2;
            background-color: rgb(255, 255, 255);
        }

        .section_2 .bot_content .note h1 {
            font-family: "ONEMobileTitle";
            font-size: 34px;
            line-height: 46px;
        }

        .section_2 .bot_content .note p {
            font-size: 20px;
            line-height: 30px;
            padding-top: 36px;
            color: #757575;
        }

        .section_3 {
            border-top: 1px solid #eeeeee;
            margin-bottom: 120px;
        }

        .section_3 .title {
            margin-top: 120px;
            margin-bottom: 30px;
            font-size: 34px;
            line-height: 46px;
        }

        .section_3 .info {
            flex-wrap: wrap;
        }

        .section_3 .info_detail {
            align-items: center;
            justify-content: start;
            max-width: 50%;
            margin-top: 40px;
        }

        .section_3 .info_detail h1 {
            font-size: 24px;
            line-height: 27px;
            font-weight: 700;
        }

        .section_3 .info_detail p {
            font-size: 18px;
            line-height: 26px;
            color: #757575;
            padding-top: 18px;
        }

        .section_3 .info_detail > div {
            padding: 0 25px;
        }

        .section_4 {
            height: 550px;
            background-color: #f1f4f9;
        }

        .section_4 h1 {
            font-family: "ONEMobileTitle";
            text-align: center;
            font-size: 42px;
            line-height: 62px;
            padding-top: 120px;
        }

        .section_4 .hashtag_btn_wrap {
            display: flex;
            gap: 60px;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 60px;
        }

        .section_4 .hashtag_btn_wrap li figure {
            height: 86px;
            width: 86px;
            background: #ffffff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        .section_4 .hashtag_btn_wrap li:hover img {
            transform: translateY(-20px) scale(1.5);
        }

        .section_4 .hashtag_btn_wrap li img {
            transition: all 0.3s;
        }

        .section_4 .hashtag_btn_wrap li p {
            margin-top: 20px;
            font-size: 18px;
            line-height: 27px;
            font-weight: 500;
            text-align: center;
            color: #757572;
        }

        .section_5 {
            margin-top: 68px;
        }

        .section_5 h1 {
            font-family: "ONEMobileTitle";
            font-size: 34px;
            line-height: 46px;
            margin-bottom: 20px;
        }

        .section_5 p {
            line-height: 24px;
            margin-bottom: 40px;
            color: #757575;
        }

        .section_5 .post {
            flex-wrap: wrap;
            gap: 40px;
        }

        .section_5 .post .post_detail {
            max-width: 48.3%;
            margin-top: 20px;
        }

        .section_5 .post .post_detail .post_image {
            border-radius: 16px;
        }

        .section_5 .post .post_detail .title_1 {
            margin-top: 30px;
            font-weight: 700;
            font-size: 24px;
            line-height: 27px;
        }

        .section_5 .post .post_detail .description {
            line-height: 24px;
            color: #757575;
            margin-top: 20px;
            padding-right: 15px;
        }

        .section_5 .post .post_detail .title_2 {
            margin-top: 40px;
            font-weight: 700;
            font-size: 18px;
            line-height: 26px;
        }

        .section_5 .post .post_detail .post_hashtag {
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .section_5 .post .post_detail .post_hashtag a {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #757575;
            padding: 6px 9px;
            border-radius: 3px;
            background-color: rgb(243, 247, 250);
        }

        .section_5 .contact {
            gap: 10px;
            margin-top: 80px;
            margin-bottom: 120px;
        }

        .section_5 .contact button:first-child {
            width: 273px;
            height: 66px;
            border-radius: 4px;
            background-color: rgb(255, 255, 255);
            border: 1px solid rgb(219, 219, 219);
            font-weight: 500;
            font-size: 18px;
            line-height: 26px;
        }

        .section_5 .contact button:nth-child(2),
        .section_5 .contact button.contact_11 {
            width: 273px;
            height: 66px;
            border-radius: 4px;
            background-color: rgb(46, 62, 146);
            box-shadow: 0px 16px 15.04px 0.96px rgba(46, 62, 146, 0.28);
            border: 1px solid rgb(219, 219, 219);
            font-weight: 500;
            font-size: 18px;
            line-height: 26px;
            color: #ffffff;
        }

        .side-bar-inc {
            top: 85%;
        }

        .main_sale_banner {
            top: 85%;
        }

        @media screen and (min-width: 1921px) {
            .side-bar-inc {
                top: 78%;
            }

            .main_sale_banner {
                top: 78%;
            }
        }

        @media screen and (min-width: 2400px) {
            .side-bar-inc {
                top: 68%;
            }

            .main_sale_banner {
                top: 68%;
            }
        }

        @media screen and (min-width: 2560px) {
            .side-bar-inc {
                top: 64%;
            }

            .main_sale_banner {
                top: 64%;
            }
        }

        @media screen and (min-width: 2880px) {
            .side-bar-inc {
                top: 57%;
            }

            .main_sale_banner {
                top: 57%;
            }
        }

        @media screen and (min-width: 3840px) {
            .side-bar-inc {
                top: 43%;
            }

            .main_sale_banner {
                top: 43%;
            }
        }

        @media screen and (min-width: 5760px) {
            .side-bar-inc {
                top: 28%;
            }

            .main_sale_banner {
                top: 28%;
            }

        }

        @media screen and (min-width: 7680px) {
            .side-bar-inc {
                top: 18%;
            }

            .main_sale_banner {
                top: 18%;
            }
        }

        @media screen and (max-width: 850px) {
            .main_visual {
                height: 38.462rem;
                background: url(/img/sub/group_main_visual_m.png) no-repeat center /
      cover;
            }

            .main_visual h1 {
                font-size: 1.462rem;
                line-height: 1.846rem;
                padding-top: 3.846rem;
            }

            .section_2 {
                margin-top: 5.385rem;
            }

            .section_2 .top_content .title {
                font-size: 1.692rem;
                line-height: 2.154rem;
                letter-spacing: 0.038rem;
            }

            .section_2 .top_content .description {
                margin-top: 2.308rem;
                font-size: 1.154rem;
                line-height: 1.615rem;
                letter-spacing: -0.04em;
            }

            .section_2 .top_content .list_img {
                margin: 5.577rem 0;
                gap: 3.462rem;
            }

            .section_2 .top_content .list_img img {
                width: 5.538rem;
                height: auto;
            }

            .section_2 .bot_content {
                margin: unset;
                margin-bottom: 21.615rem;
                max-width: unset;
                height: 15.769rem;
                background: url(/assets/img/sub/group_section_2_bot_content_bg_m.png) no-repeat center / cover;
            }

            .section_2 .bot_content .note {
                padding: 4.615rem 1.923rem;
                position: absolute;
                left: 0;
                top: 12.308rem;
                width: unset;
                height: 0;
                z-index: 2;
            }

            .section_2 .bot_content .note h1 {
                font-size: 1.692rem;
                line-height: 2.154rem;
                letter-spacing: -0.04em;
            }

            .section_2 .bot_content .note p {
                font-size: 1.154rem;
                line-height: 1.615rem;
                padding-top: 2.308rem;
                text-align: center;
            }

            .section_3 {
                border-top: unset;
                margin-bottom: 4.615rem;
            }

            .section_3 .title {
                margin-top: unset;
                margin-bottom: 1.154rem;
                font-size: 1.692rem;
                line-height: 1.769rem;
                padding-top: 4.615rem;
                text-align: center;
            }

            .section_3 .info {
                flex-wrap: unset;
                flex-direction: column;
            }

            .section_3 .info_detail {
                align-items: center;
                justify-content: start;
                max-width: unset;
                margin-top: 2.308rem;
            }

            .section_3 .info_detail img {
                width: 6.231rem;
                height: 6.231rem;
            }

            .section_3 .info_detail h1 {
                font-size: 1.308rem;
                line-height: 1.038rem;
            }

            .section_3 .info_detail p {
                font-size: 1.077rem;
                line-height: 1.538rem;
                padding-top: 0.769rem;
            }

            .section_3 .info_detail > div {
                padding: 0 0.962rem;
                padding-right: 3.269rem;
            }

            .section_4 {
                height: 45.769rem;
                background-color: #f1f4f9;
            }

            .section_4 .hashtag_btn_wrap {
                display: flex;
                gap: 1.231rem;
                flex-wrap: wrap;
                justify-content: unset;
                padding-top: 60px;
                margin: 0 auto;
                width: 25.385rem;
            }

            .section_4 .hashtag_btn_wrap li figure {
                height: 5.385rem;
                width: 5.385rem;
                border-radius: 0.385rem;
            }

            .section_4 .hashtag_btn_wrap li p {
                margin-top: 0.769rem;
                font-size: 1.077rem;
                line-height: 1.038rem;
            }

            .section_4 h1 {
                font-family: "ONE Mobile Title";
                text-align: center;
                font-size: 1.692rem;
                line-height: 2.385rem;
                padding-top: 4.615rem;
            }

            .section_5 {
                margin-top: 4.615rem;
            }

            .section_5 h1 {
                font-family: "ONE Mobile Title";
                font-size: 1.692rem;
                line-height: 1.769rem;
                margin-bottom: 2.308rem;
                text-align: center;
            }

            .section_5 p {
                font-size: 1rem;
                line-height: 1.385rem;
                margin-bottom: 3.192rem;
                text-align: center;
            }

            .section_5 .contact {
                gap: 0.769rem;
                margin-top: 3.077rem;
                margin-bottom: 4.615rem;
            }

            .section_5 .contact button:first-child {
                width: 100%;
                height: 3.462rem;
                border-radius: 4px;
                background-color: rgb(255, 255, 255);
                border: 1px solid rgb(219, 219, 219);
                font-weight: 500;
                font-size: 1.077rem;
                line-height: 1rem;
            }

            .item_list_sec .item_filter .filter_cho {
                display: none;
                position: absolute;
                top: calc(100% + 0.6667rem);
                background: #fff;
                border: 1px solid #252525;
                box-shadow: 0rem 0.2rem 0.658rem 0.042rem rgba(0, 0, 0, 0.22);
                border-radius: 0.6667rem;
                min-width: 4.3333rem;
                padding: 0.8333rem 1.3333rem;
                z-index: 99;
                right: 0;
            }

            .section_5 .contact button:nth-child(2),
            .section_5 .contact button.contact_11 {
                width: 100%;
                height: 3.462rem;
                border-radius: 4px;
                background-color: rgb(46, 62, 146);
                box-shadow: 0px 16px 15.04px 0.96px rgba(46, 62, 146, 0.28);
                border: 1px solid rgb(219, 219, 219);
                font-weight: 500;
                font-size: 1.077rem;
                line-height: 1rem;
            }
        }
    </style>
    <main>
        <script>
            $(document).ready(function () {
                $('a[data-key="micepage"]').addClass("active_");
            })
        </script>
        <section class="main_visual">
            <h1>고민은 줄이고 꿈을 키우는 단체, <br class="only_mo">기업을 위한</h1>
        </section>
        <section class="section_2">
            <div class="inner">
                <div class="top_content">
                    <h1 class="title">전문적이지 않다면 그 어느것도 보장할 수 없습니다.<br class="only_web">비즈니스 투어의 기본은 전문성</h1>
                    <p class="description">더투어랩은 시드니 현지에서 20년 이상을 오직 더투어랩만을 연구, 개발, 기획한 노하우로 직접 계약부터 투어까지<br
                                class="only_web">원스톱
                        시스템으로 진행하여 고민, 시간,
                        비용을 절감한 효율적인 여행을 완벽히 구현해 냅니다.</p>
                    <div class="list_img flex_c_c">
                        <img class="only_web" src="/img/sub/group_section_2_icon1_w.png" alt="">
                        <img class="only_web" src="/img/sub/group_section_2_icon2_w.png" alt="">
                        <img class="only_web" src="/img/sub/group_section_2_icon3_w.png" alt="">
                        <img class="only_mo" src="/img/sub/group_section_2_icon1_m.png" alt="">
                        <img class="only_mo" src="/img/sub/group_section_2_icon2_m.png" alt="">
                        <img class="only_mo" src="/img/sub/group_section_2_icon3_m.png" alt="">
                    </div>
                </div>
            </div>
            <div class="bot_content">
                <div class="inner">
                    <div class="note">
                        <h1 class="title">비즈니스 투어 전문 회사라면 단체의 특성을<br class="only_web">가장 먼저 파악이 첫 번째!</h1>
                        <p>더투어랩에 관련한 모든 노하우로 그에 맞는 여행을 이끌어 낼 수 있는 능력이 있어야 합니다.<br class="only_web">
                            더투어랩는 1:1 맞춤 서비스로 따라가는 여행이 아닌 생각하는 프로젝트를 만들어 갑니다.<br class="only_web">
                            더투어랩 비즈니스 투어 전문가와 함께 편안하고 안전한 여행을 즐겨보세요.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section_3">
            <div class="inner">
                <h1 class="title">더투어랩와 함께라면</h1>
                <div class="info flex">
                    <div class="info_detail flex">
                        <img src="/img/sub/section_3_info_detail_img_1.png" alt="">
                        <div>
                            <h1>1:1 전담제</h1>
                            <p>더투어랩 전문 스페셜리스트를 통한 컨설팅으로 출발 계획
                                부터 귀국 후까지 체계적인 시스템으로 편안하고 편리하게
                                더투어랩을 방문할 수 있습니다.</p>
                        </div>
                    </div>
                    <div class="info_detail flex">
                        <img src="/img/sub/section_3_info_detail_img_2.png" alt="">
                        <div>
                            <h1>합리적인가격</h1>
                            <p>더투어랩의 정보를 갖고 있는 전문 기업에서만 조율할 수 있는
                                부분으로 합리적이고 이상적인 수배를 할 수 있습니다.</p>
                        </div>
                    </div>
                    <div class="info_detail flex">
                        <img src="/img/sub/section_3_info_detail_img_3.png" alt="">
                        <div>
                            <h1>전속 가이드</h1>
                            <p>더투어랩 전문 스페셜리스트를 통한 컨설팅으로 출발 계획부터
                                귀국 후까지 체계적인 시스템으로 편안하고 편리하게
                                더투어랩을 방문할 수 있습니다.</p>
                        </div>
                    </div>
                    <div class="info_detail flex">
                        <img src="/img/sub/section_3_info_detail_img_4.png" alt="">
                        <div>
                            <h1>20년 무사고</h1>
                            <p>긴급 상황을 대비하여 복수노선 확보를 하고 있고, 지정된
                                보험회사에 여행자 보험을 등록하여 안전함을 최우선으로
                                하고 있습니다.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section_4">
            <div class="inner">
                <h1>더투어랩 기업/단체여행에서만 제공되는<br class="only_web">특별한 기본 서비스</h1>
            </div>
            <ul class="hashtag_btn_wrap">
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_1.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>장소 섭외</p>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_2.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>기업 섭외</p>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_3.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>더투어랩 레저<br>
                            투어 제공</p>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_4.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>통번역</p>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_5.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>비자</p>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_6.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>숙박</p>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_7.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>항공</p>
                    </a>
                </li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_8.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                    </a>
                    <p><a href="#!">차량
                        </a>
                    </p></li>
                <li>
                    <a href="#!">
                        <figure>
                            <picture>
                                <img src="/img/sub/group_section_4_hastag_img_9.png" alt="도시투어 아이콘">
                            </picture>
                        </figure>
                        <p>VIP 의전 행사</p>
                    </a>
                </li>
            </ul>
        </section>
        <section class="section_5">
            <div class="inner">
                <h1>기업/비즈니스/출장</h1>
                <p>기업 혹은 단체에서 방문 혹은 시찰을 위해 더투어랩 방문하시는 경우에 차량, 통역, 숙박, 요청일정 등 필요한 현지 서비스를 제공합니다.<br class="only_web">
                    전체일정을 요청하시거나 부분적으로 필요한 부분만 요청해주셔도 목적에 맞는 더투어랩 방문이 최우선이 될 수 있도록 안내를 제공합니다.</p>
                <img src="/img/sub/group_section_5_post_image.png" alt="">
                <!-- <div class="post flex">
                  <div class="post_detail">
                    <div class="post_image">
                      <img src="/assets/img/sub/group_section_5_post_image_1.png" alt="">
                    </div>
                    <p class="title_1">기업/비즈니스</p>
                    <p class="description">기업에서 호주에 관련한 시찰이나 타 기업 방문을 위해 더투어랩 방문이 필요할 경우 더투어랩 전 관련
                      기관을 수배하고 있습니다. 기업 또는 개인의 비즈니스 관련 더투어랩 현지 상담이 가능하며, 그에
                      관한 기관들을 리스트 업하여 현지 서비스가 가능할 수 있도록 도와드립니다.</p>
                    <p class="title_2">카테고리</p>
                    <div class="post_hashtag flex">
                      <a href="">#더투어랩 미팅</a>
                      <a href="">#더투어랩 견학</a>
                      <a href="">#컨퍼런스 참가</a>
                      <a href="">#더투어랩 현지 상담 서비스</a>
                      <a href="">#기업체 방문</a>
                      <a href="">#현지 컨설팅</a>
                    </div>
                  </div>
                  <div class="post_detail">
                    <div class="post_image">
                      <img src="/assets/img/sub/group_section_5_post_image_2.png" alt="">
                    </div>
                    <p class="title_1">정부/공공기관</p>
                    <p class="description">관공서, 지방자치단체, 정부 투자 기관, 특수 법인, 공기업, 정부 산하 기관, 정부 출연 기관,
                      정부 투자 기관 등 한국의 공공기관에서 더투어랩을 방문하게 될 때 필요한 모든 항목을 리스트 업
                      하고 있습니다. 목적에 맞는 호주의 모든 기관 수배가 가능하며, 현지 서비스를 제공함으로써
                      편안한 더투어랩 방문이 될 수 있도록 안내해 드립니다.</p>
                    <p class="title_2">카테고리</p>
                    <div class="post_hashtag flex">
                      <a href="">#더투어랩 법인</a>
                      <a href="">#더투어랩 공공 기관</a>
                      <a href="">#컨퍼런스</a>
                      <a href="">#회의 개최 등</a>
                      <a href="">#더투어랩 정부 산하 기관</a>
                    </div>
                  </div>
                  <div class="post_detail">
                    <div class="post_image">
                      <img src="/assets/img/sub/group_section_5_post_image_3.png" alt="">
                    </div>
                    <p class="title_1">교육기관</p>
                    <p class="description">긴급 상황을 대비하여 복수노선 확보를 하고 있고, 지정된 보험회사에 여행자 보험을 등교육청,
                      학교, 관련 사업 등 한국의 교육 기관에서 호주의 방문이 필요할 때, 더투어랩 스페셜리스트를 통해
                      관련된 기업체나 컨퍼런스 장소 등에 대한 자세한 설명을 들으실 수 있습니다. 또한 탄력적인
                      호주일정 조율이 가능하며, 목적에 맞는 더투어랩 방문이 최우선이 될 수 있도록 안내해드립니다.
                      록하여 안전함을 최우선으로 하고 있습니다.</p>
                    <p class="title_2">카테고리</p>
                    <div class="post_hashtag flex">
                      <a href="">#더투어랩 연수</a>
                      <a href="">#기업체 방문</a>
                      <a href="">#학회</a>
                      <a href="">#학교 법인</a>
                      <a href="">#컨벤션 참가</a>
                      <a href="">#더투어랩 견학 등</a>
                    </div>
                  </div>
                  <div class="post_detail">
                    <div class="post_image">
                      <img src="/assets/img/sub/group_section_5_post_image_4.png" alt="">
                    </div>
                    <p class="title_1">이벤트 & 전시</p>
                    <p class="description">관련 분야에서 필요한 호주의 각종 이벤트와 전시에 참여를 위해 호주에 방문하게 될 때,
                      방문 목적에 따른 이벤트와 전시 스케줄과 더불어 성향 등을 파악해 추천해 드립니다.
                      물론 원하는 호주의 이벤트와 전시를 관람할 수 있으며, 전지훈련이나 특별한 목적에 의한
                      더투어랩 방문 시 필요로 하는 모든 서비스를 제공하고 있습니다.</p>
                    <p class="title_2">카테고리</p>
                    <div class="post_hashtag flex">
                      <a href="">#전시</a>
                      <a href="">#대관</a>
                      <a href="">#이벤트</a>
                      <a href="">#스포츠 시설</a>
                      <a href="">#컨퍼런스</a>
                      <a href="">#문화 예술 시설</a>
                      <a href="">#미팅</a>
                    </div>
                  </div>
                  <div class="post_detail">
                    <div class="post_image">
                      <img src="/assets/img/sub/group_section_5_post_image_5.png" alt="">
                    </div>
                    <p class="title_1">인센티브</p>
                    <p class="description">기업이나 단체에서 근무 성과나 공적이 우수한 직원들에게 보상, 장려 차원에서 더투어랩을
                      방문하실 때 여행 상품 기획, 행사 진행, 장소 섭외 등의 서비스를 제공하고 있습니다.
                      더투어랩 전문 스페셜리스트를 통해 좀 더 전문적이고, 알찬 더투어랩 방문이 될 수 있도록 도와드립니다.</p>
                    <p class="title_2">카테고리</p>
                    <div class="post_hashtag flex">
                      <a href="">#더투어랩 여행</a>
                      <a href="">#이벤트</a>
                      <a href="">#행사 진행</a>
                      <a href="">#컨퍼런스</a>
                      <a href="">#전시</a>
                    </div>
                  </div>
                  <div class="post_detail">
                    <div class="post_image">
                      <img src="/assets/img/sub/group_section_5_post_image_6.png" alt="">
                    </div>
                    <p class="title_1">맞춤형 패키지</p>
                    <p class="description">호주에서의 MEETING뿐 아니라 이민을 위한 방문, 특정한 분야의 전문성이 필요한 부분까지도
                      모두 케어할 수 있는 맞춤형 더투어랩 일정을 기획하고 있습니다. 문의를 주신 시점부터 귀국 후까지
                      필요로 하는 모든 서비스를 제공하여 부담 없는 더투어랩 방문이 될 수 있도록 도와드립니다.
                      또한 국내외 VVIP 성격에 맞는 맞춤형 국내/외 여행 프로그램을 즐길 수 있습니다.</p>
                    <p class="title_2">카테고리</p>
                    <div class="post_hashtag flex">
                      <a href="">#현지 컨설팅</a>
                      <a href="">#엔터테인먼트 시스템</a>
                      <a href="">#더투어랩 정보 제공</a>
                    </div>
                  </div>
                </div> -->
                <div class="contact flex_c_c">
                    <!-- <button>취소하기</button> -->
                    <button class="contact_11" onclick="location='/qna/list'">1:1 여행상담</button>
                </div>
            </div>
        </section>

    </main>
<?php $this->endSection(); ?>