<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<style>
    .bs_table {
        width: 100%;
        table-layout: unset;
        border-top: 1px solid #252525;
    }

</style>
<div id="container" class="sub contact contact_main">
    <div class="inner">
        <div class="sect_ttl_box">
            <h2>더투어랩 고객센터</h2>
            <p class="description">더투어랩 서비스 이용 중 궁금하신 문의사항에 대해 친절하게 상담해드립니다.<br class="only_web">
                고객님의 작은 질문까지 소중히 생각하며 고객님의 의견을 항상 열린 마음으로 수용하겠습니다.
            </p>
        </div>
        <div class="contents">

            <div class="contact_main_top flex col_2 mo_block_100" style="--mg-x: 20px; --mg-t: 0; --mo-mg-t: 2.5rem">
                <section class="faq_sect">
                    <div class="cont_ttl flex_b_c">
                        <h3>자주묻는 질문</h3>
                        <a class="more_btn" href="/community/questions">
                            더보기 <i></i>
                        </a>
                    </div>
                    <div class="faq_list_wrap">
                        <ul class="faq_list">
                            <?php
                            foreach ($faq_list as $row) {
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
                </section>
                <section class="notice_sect">
                    <div class="cont_ttl flex_b_c">
                        <h3>태국뉴스 및 공지사항</h3>
                        <a class="more_btn" href="/community/customer_center/list_notify">
                            더보기 <i></i>
                        </a>
                    </div>
                    <table class="bs_table">
                        <colgroup>
                            <?php if ($row['notice_yn'] == "Y")
                                echo "<col width='70px'>" ?>

                                <col width="*">
                            </colgroup>
                            <tbody>
                                <?php
                            foreach ($b2b_notice_list as $row) {
                                ?>
                                <tr class="<?php if ($row['notice_yn'] == "Y")
                                    echo "notice_tr"; ?>">
                                    <?php if ($row['notice_yn'] != "Y")
                                        echo "<td class='notice'>공지</td>" ?>
                                        <td class="subject">
                                            <a
                                                href="/community/announcement_view?bbs_idx=<?= $row['bbs_idx'] ?>"><?= $row['subject'] ?></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="qiuck_box">
                <div class="info flex">
                    <div class="info_detail">
                        <a href="/contact/main">
                            <picture>
                                <source media="(max-width:850px)" srcset="/images/community/info_detail_1_m.png">
                                <img src="/images/community/info_detail_1.png" alt="">
                            </picture>문의하기
                        </a>
                    </div>
                    <div class="info_detail">
                        <a href="/qna/list">
                            <picture>
                                <source media="(max-width:850px)" srcset="/images/community/info_detail_2_m.png">
                                <img src="/images/community/info_detail_2.png" alt="">
                            </picture>1:1 여행상담
                        </a>
                    </div>
                    <div class="info_detail">
                        <a href="/invoice/list">
                            <picture>
                                <source media="(max-width:850px)" srcset="/images/community/info_detail_3_m.png">
                                <img src="/images/community/info_detail_3.png" alt="">
                            </picture>예약현황
                        </a>
                    </div>
                    <div class="info_detail">
                        <a href="/review/review_list">
                            <picture>
                                <source media="(max-width:850px)" srcset="/images/community/info_detail_4_m.png">
                                <img src="/images/community/info_detail_4.png" alt="">
                            </picture>여행후기
                        </a>
                    </div>
                </div>
            </div>
            <div class="contact_main_middle">
                <div class="flex side_by_side mo_block_100" style="--mg-s: 40px; --mo-mg-t: 2.5rem">
                    <section class="event_sect ing">
                        <div class="cont_ttl flex_b_c">
                            <h3>진행 중인 이벤트</h3>
                            <a class="more_btn" href="/event/event_list">
                                더보기 <i></i>
                            </a>
                        </div>
                        <div class="list_wrap event_list_wrap">
                            <ul class="flex col_2 mo_block_100" style="--mg-x: 10px; --mg-t: 0px; --mo-mg-t: 0.7143rem">
                                <?php
                                foreach ($event_list as $row) {
                                    if ($row['ufile6'] != '') {
                                        $img = '/data/bbs/' . $row['ufile6'];
                                    } else {
                                        $img = '/data/product/noimg.png';
                                    }
                                    ?>
                                    <li class="list_box">
                                        <a href="/event/event_view?code=event&bbs_idx=<?= $row["bbs_idx"] ?>">
                                            <div class="thumb">
                                                <img src="<?= $img ?>" alt="<?= $row['rfile6'] ?>">
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                                <!-- <div class="hangout_img">
                                        <img src="/images/community/hangout_event_img_2.png" alt="">
                                    </div> -->
                            </ul>
                        </div>
                    </section>
                    <section class="event_sect announcement">
                        <div class="cont_ttl flex_b_c">
                            <h3>이벤트 당첨자 발표</h3>
                            <a class="more_btn" href="/event/winning_list">
                                더보기 <i></i>
                            </a>
                        </div>
                        <table class="bs_table">
                            <colgroup>
                                <col width="*">
                                <col width="120px">
                            </colgroup>
                            <tbody>
                                <?php

                                foreach ($winner_list as $row) {
                                    ?>
                                    <tr>
                                        <td class="subject"><?= $row['subject'] ?></td>
                                        <td class="date"><?= date("Y.m.d", strtotime($row['r_date'])) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </section>
                </div>
            </div>
            <div class="contact_main_bot main_section_3">
                <div class="cont_ttl flex_b_c">
                    <h3>예약현황</h3>
                    <a class="more_btn" href="/invoice/list">
                        더보기 <i></i>
                    </a>
                </div>
                <table class="bs_table">
                    <colgroup>
                        <col width="10%">
                        <col width="10%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <tbody>
                        <?php
                        foreach ($order_list as $row) {
                            ?>
                            <tr>
                                <td class="num"><span><?= $num--; ?></span></td>
                                <td class="ttl code_name"><span><?= $row['code_name'] ?></span></td>
                                <td class="subject">
                                    <?php
                                    if ($row['m_idx'] == session('member.mIdx')) {
                                        ?>
                                        <a href="/invoice/view_paid?order_idx=<?= $row['order_idx'] ?>"><?= strAsterisk($row["order_user_name"]) ?>님의
                                            여행예약이 <?= get_status_name($row["order_status"]) ?>되었습니다.</a><span
                                            class="red">(<?= $row['cmt_cnt'] ?>)</span>
                                        <?php
                                    } else {
                                        $message = !session('member.idx') ? "로그인을 해주세요!" : "내가쓴글만 열람이 가능합니다.";
                                        ?>
                                        <button onclick="alert(`<?= $message ?>`);">비밀글입니다!</button>&nbsp;<i></i>
                                        <?php
                                    }
                                    ?>

                                </td>
                                <td class="name"><?= strAsterisk($row['order_user_name']) ?></td>
                                <td class="date"><?= date("Y.m.d", strtotime($row["order_r_date"])) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('a[data-key="_community"]').addClass("active_");
    })

<script>
    $(document).ready(function () {
        $('.ques_box .answer_box_wrap').hide();


        // qna 클릭시 슬라이드
        $('.ques_box').on('click', function () {
            if (!$(this).hasClass('active')) {
                $('.ques_box').removeClass('active');
                $(this).addClass('active');

                $('.answer_box_wrap').hide();
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