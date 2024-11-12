<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<link rel="stylesheet" href="/item/item_style.css">
<link rel="stylesheet" href="/item/item_style_responsive.css">



<section id="sub_container">
    <div class="book_form_wrap">
        <div class="sub_con_inner">
            <div class="book_result">
                <div class="result_inner">
                    <div class="flex_c_c">
                        <b class="result_inner_tit">회원탈퇴가 완료되었습니다</b>
                        <i></i>
                    </div>
                    <p class="result_inner_txt">그 동안 <span><?= _IT_SITE_NAME ?? '' ?></span>를 </p>
                    <p class="result_inner_txt">사랑해주셔서 감사합니다.</p>
                    <div class="member_out_img">
                        <img src="/images/mypage/mypage_member_out.png" alt="member_out_img">
                    </div>
                    <a href="/">처음으로</a> <!-- 비회원 예약 시 -->

                </div>
            </div>
            <!--일시 사용!-->
            <div id=ERP_RESULT>
                <?php
                //$order_no = "S190509905";
                // curl이 설치 되었는지 확인
                if (function_exists('curl_init')) {
                    // curl 리소스를 초기화
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'http://reserv.nestro.co.kr/bluesky/order.asp?idx=' . $order_no);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
                    $content = curl_exec($ch);
                    //echo $content;
                    curl_close($ch);
                } else {
                    // curl 라이브러리가 설치 되지 않음. 다른 방법 알아볼 것
                }
                ?>
            </div>

        </div><!-- sub_con_inner -->
    </div><!-- book_form -->

</section>
<!-- //container End -->
<?php $this->endSection(); ?>
