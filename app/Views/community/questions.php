<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<style>
    .box_header {
        font-size: 18px;
        line-height: 1.3;
    }

    .box_ttl {
        font-size: 18px !important;
        font-weight: 700;
        margin-top: 25px;
        margin-bottom: 15px;
    }

    .wrap_img p {
        font-size: 18px !important;
        margin-bottom: 12px;
    }

    .wrap_img img {
        margin-bottom: 26px;
    }

    .box_02 img {
        margin-right: 80px;
    }

    .faq_sect .faq_list .answer_box_wrap {
        padding: 20px;
        padding-left: 110px;
        position: relative;
    }

    .answer_box_wrap .author {
        position: absolute;
        top: 20px;
        left: 0;
    }

    .answer_box_wrap .author p {
        color: #757575;
        font-size: 14px !important;
        margin-bottom: 4px;
    }

    @media screen and (max-width: 850px) {
        .answer_box_wrap .author {
            position: absolute;
            top: 2rem;
            left: 0;
        }

        .answer_box_wrap .author p {
            color: #757575;
            font-size: 2.2rem !important;
            margin-bottom: 0.4rem;
        }
    }


</style>
<div id="container" class="sub contact">
    <section class="faq_sect">
        <div class="inner">
            <div class="sect_ttl_box">
                <h2>자주묻는 질문</h2>
                <div class="common_tab_wrap">
                    <ul class="common_tab flex_c_c">
                        <li <?php if ($code_no == "")
                                echo ' class="active" '; ?>>
                            <a href="/community/questions?code_no=">전체</a>
                        </li>
                        <?php
                        foreach ($code_gubun as $row_c) {
                            if ($code_no == $row_c['code_no']) {
                                echo "<li class='active'><a href='/community/questions?code_no=" . $row_c['code_no'] . "'>" . $row_c['code_name'] . "</a></li>";
                            } else {
                                echo "<li><a href='/community/questions?code_no=" . $row_c['code_no'] . "'>" . $row_c['code_name'] . "</a></li>";
                            }
                        }
                        ?>

                    </ul>

                </div>
                <div class="only_mo">
                    <div class="line_arrow flex__c">
                        <img src="../assets/img/ico/arr_next.png" alt="">
                    </div>
                </div>
            </div>
            <div class="faq_list_wrap">
                <ul class="faq_list">
                    <li>
                        <a href="#!" class="ques_box">
                            <p class="code_name">상품문의</p>
                            <div class="ques_text">
                                <i class="q"></i>
                                <p class="description">상품 이용 후 포인트 적립 방법 </p>
                            </div>
                            <i class="arrow"></i>
                        </a>
                        <div class="answer_box_wrap" style="display: none;">
                            <div class="answer_box">
                                <i class="ans"></i>
                                <div>
                                    <div class="box_header">
                                        <p>리뷰 남기는 시점</p>
                                        <p>ㆍ예약상품 사용 후 다음날</p>
                                        <p>ㆍ호텔은 체크아웃일 다음날</p>
                                    </div>
                                    <div class="box_01">
                                        <p class="box_ttl">※ PC일 경우</p>
                                        <div class="wrap_img">
                                            <p>1. 마이페이지에 마우스를 올려보세요.</p>
                                            <img src="/images/sub/question_img_01.png" alt="">
                                        </div>
                                        <div class="wrap_img">
                                            <p>2. 예약확인/결제를 클릭합니다.</p>
                                            <img src="/images/sub/question_img_02.png" alt="">
                                        </div>
                                        <div class="wrap_img">
                                            <p>3. 리뷰쓰기를 클릭하시면 해당 상품페이지로 들어갑니다. 그 곳에서 리뷰를 남겨주시면 자동적립! </p>
                                            <img src="/images/sub/question_img_03.png" alt="">
                                        </div>
                                    </div>
                                    <div class="box_02">
                                        <p class="box_ttl">※ 모바일일 경우</p>
                                        <div class="sec_top">
                                            <div class="wrap_img">
                                                <p>1. 하단의 마이페이지를 클릭합니다.</p>
                                                <img src="/images/sub/question_img_04.png" alt="">
                                            </div>
                                            <div class="wrap_img">
                                                <p>2. 예약확인/결제를 클릭합니다.</p>
                                                <img src="/images/sub/question_img_05.png" alt="">
                                            </div>

                                        </div>
                                        <div class="sec_bot">
                                            <div class="wrap_img">
                                                <p>3. 리뷰쓰기를 클릭해주세요.</p>
                                                <img src="/images/sub/question_img_006.png" alt="">
                                            </div>
                                            <div class="wrap_img">
                                                <p>4. 리뷰 작성 후 아래 등록하기 버튼 눌러주시면 자동적립!</p>
                                                <img src="/images/sub/question_img_07.png" alt="">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="author">
                                <p class="name">Younn</p>
                                <p class="name">(2022.10.05)</p>
                            </div>
                        </div>
                    </li>
                    <?php
                    foreach ($question_list as $row) {
                    ?>
                        <li>
                            <a href="#!" class="ques_box">
                                <p class="code_name"><?= $row['code_name'] ?></p>
                                <div class="ques_text">
                                    <i class="q"></i>
                                    <p class="description"><?= $row['r_title'] ?></p>
                                </div>
                                <i class="arrow"></i>
                            </a>
                            <div class="answer_box_wrap" style="display: none;">
                                <div class="answer_box">
                                    <i class="ans"></i>
                                    <div>
                                        <?= viewSQ($row['r_content']) ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <?php //echo ipageListing2(1, 2, 10, $_SERVER['PHP_SELF'] . "?scategory=$scategory&pg=")
            ?>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        $('.faq_list .answer_box_wrap').hide();


        // qna 클릭시 슬라이드
        $('.ques_box').on('click', function() {
            if (!$(this).hasClass('active')) {
                $('.ques_box').removeClass('active');
                $(this).addClass('active');

                $('.faq_list .answer_box_wrap').hide();
                $(this).siblings('.answer_box_wrap').show();

            } else {
                $(this).removeClass('active');
                $(this).siblings('.answer_box_wrap').hide();

            }
        });
    });

    function addRemove(el) {
        $(el).addClass("active").siblings().removeClass("active");
    }
</script>
<?php $this->endSection(); ?>