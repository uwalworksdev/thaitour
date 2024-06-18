<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
$product_code = $order_detail["product_code"];
$air_code_name = $order_detail["air_code_name"];
$air_name_1 = $order_detail["air_name_1"];
$air_image = $order_detail["air_image"];
$product_code_1 = $order_detail["product_code_1"];
$product_code_2 = $order_detail["product_code_2"];
$product_code_3 = $order_detail["product_code_3"];
$product_info = $order_detail["product_info"];
$air_idx = $order_detail["air_idx"];
$yoil_idx = $order_detail["yoil_idx"];
$product_idx = $order_detail["product_idx"];
$product_img = $order_detail["ufile1"];
$code_name_1 = $order_detail["code_name_1"];
$code_name_2 = $order_detail["code_name_2"];
$code_name_3 = $order_detail["code_name_3"];
$product_name = $order_detail["product_name"];
$order_gubun = $order_detail["order_gubun"];
$order_no = $order_detail["order_no"];
$order_date = $order_detail["order_date"];
$order_user_name = $order_detail["order_user_name"];
$order_user_email = $order_detail["order_user_email"];
$order_user_mobile = $order_detail["order_user_mobile"];
$order_user_phone = $order_detail["order_user_phone"];
$order_memo = $order_detail["order_memo"];
$local_phone = $order_detail["local_phone"];
$start_date = $order_detail["start_date"];
$end_date = $order_detail["end_date"];
$product_period = $order_detail["product_period"];
$tour_period = $order_detail["tour_period"];
$people_adult_cnt = $order_detail["people_adult_cnt"];
$people_adult_price = $order_detail["people_adult_price"];
$people_kids_cnt = $order_detail["people_kids_cnt"];
$people_kids_price = $order_detail["people_kids_price"];
$people_baby_cnt = $order_detail["people_baby_cnt"];
$people_baby_price = $order_detail["people_baby_price"];
$order_price = $order_detail["order_price"];
$order_confirm_price = $order_detail["order_confirm_price"];
$order_method = $order_detail["order_method"];
$used_coupon_idx = $order_detail["used_coupon_idx"];
$used_coupon_point = $order_detail["used_coupon_point"];
$product_mileage = $order_detail["product_mileage"];
$order_mileage = $order_detail["order_mileage"];
$used_coupon_money = $order_detail["used_coupon_money"];
$oil_price = $order_detail["oil_price"];
$order_status = $order_detail["order_status"];
$order_r_date = $order_detail["order_r_date"];
$admin_memo = $order_detail["admin_memo"];
$paydate = $order_detail["paydate"];
$deposit_price = $order_detail["deposit_price"];
$order_confirm_date = $order_detail["order_confirm_date"];
$used_mileage_money = $order_detail["used_mileage_money"];
$order_mileage_yn = $order_detail["order_mileage_yn"];

$ResultCode_1 = $order_detail["ResultCode_1"];
$ResultMsg_1 = $order_detail["ResultMsg_1"];
$Amt_1 = $order_detail["Amt_1"];
$TID_1 = $order_detail["TID_1"];
$AuthCode_1 = $order_detail["AuthCode_1"];
$AuthDate_1 = $order_detail["AuthDate_1"];
$CancelDate_1 = $order_detail["CancelDate_1"];

$ResultCode_2 = $order_detail["ResultCode_2"];
$ResultMsg_2 = $order_detail["ResultMsg_2"];
$Amt_2 = $order_detail["Amt_2"];
$TID_2 = $order_detail["TID_2"];
$AuthCode_2 = $order_detail["AuthCode_2"];
$AuthDate_2 = $order_detail["AuthDate_2"];
$CancelDate_2 = $order_detail["CancelDate_2"];

$tour_price = $order_detail['tour_price'];
$tour_price_kids = $order_detail['tour_price_kids'];
$tour_price_baby = $order_detail['tour_price_baby'];

$addr1 = $order_detail['addr1'];
$addr2 = $order_detail['addr2'];

$s_air_time_1 = $order_detail['s_air_time_1'];
$e_air_time_1 = $order_detail['e_air_time_1'];
$air_no_1 = $order_detail['air_no_1'];
$air_no_2 = $order_detail['air_no_2'];
$s_air_time_2 = $order_detail['s_air_time_2'];
$e_air_time_2 = $order_detail['e_air_time_2'];
$tour_period = $order_detail['tour_period'];
// 공지사항 게시판
?>

<link href="/css/invoice/invoice.css" rel="stylesheet" type="text/css" />
<link href="/css/invoice/invoice_responsive.css" rel="stylesheet" type="text/css" />

<style>
    #comment_list .comment_user-content .comment_user-date::after {
        display: none;
    }
</style>

<section class="invoice_paid">
    <div class="inner">
        <div class="ttl_box">
            <h1><?= strAsterisk($order_user_name) ?>님의 여행예약이 <?= get_status_name($order_status) ?>되었습니다.</h1>
            <span class="stt_1"><?= get_status_name($order_status) ?></span>
        </div>
        <p class="ttl_date"><?= date("Y.m.d", strtotime($order_r_date)) ?></p>
        <div class="invoice_img_wrap">
            <div class="invoice_img_top">
                <img src="https://hihojoo.com/data/product/<?= $product_img ?>" alt="<?= $product_name ?>썸네일">
                <div class="invoice_img_content">
                    <p class="invoice_img_ttl">상품번호<span> <?= $product_code ?></span></p>
                    <h3><?= $product_name ?></h3>
                    <p class="invoice_img_des" id="invoice_product_des">
                        <?= viewSQ($product_info) ?>
                    </p>
                </div>
            </div>
            <div class="m_invoice_img_des">
                <p><?= $product_info ?></p>
            </div>
        </div>

        <?php
        $data = $order_detail;
        $data["order_detail_extra"] = $order_detail_extra;
        if ($product_code_1 == 1300) { // 맞춤여행
            echo view("invoice/invoice_view_1", $data);
        } else if ($product_code_1 == 1324) { // 패키지
            echo view("invoice/invoice_view_2", $data);
        } else if ($product_code_1 == 1320) { // 허니문
            echo view("invoice/invoice_view_3", $data);
        } else if ($product_code_1 == 1317 || $product_code_1 == 1325) { // 자유여행 or 골프여행
            echo view("invoice/invoice_view_4", $data);
        }

        ?>
        <div class="invoice_comment">
            <div class="invoice_comment-top">
                <div class="invoice_comment-count">
                    <span>댓글</span>
                    <span id="comment_count">(0)</span>
                </div>
                <form action="" id="frm" class="frm" name="com_form">
                    <input type="hidden" name="code" id="code" value="order">
                    <input type="hidden" name="r_code" id="r_code" value="order">
                    <input type="hidden" name="r_idx" id="r_idx" value="<?= $order_idx ?>">
                    <div class="invoice_comment-input">
                        <textarea style="resize:none" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
                        <button type="button" onclick="fn_comment(<?=session('member.idx')?>)">등록</button>
                    </div>
                </form>
            </div>
            <div class="invoice_comment-details" id="comment_list">
                <?php
                $r_code = "order";
                $r_idx = $order_idx;

                // include $_SERVER['DOCUMENT_ROOT'] . "/include/comment_list.php" ?>
            </div>
        </div>

        <?php
        // include $_SERVER['DOCUMENT_ROOT'] . "/inc/popup_inc.php";
        ?>

        <div class="invoice_button">
            <button onclick="goBack()">목록으로</button>
        </div>
    </div>
</section>

<script>
    function goBack() {
        window.history.back();
    }

    const r_code = "order";
    const r_idx = "<?= $order_idx ?>";
</script>
<script src="/js/comment.js"></script>
<?php $this->endSection(); ?>