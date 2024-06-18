<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
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
    $(document).ready(function () {
        $('.faq_list .answer_box_wrap').hide();


        // qna 클릭시 슬라이드
        $('.ques_box').on('click', function () {
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