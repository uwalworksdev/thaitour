<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<style>
    .point_system {
        background-color: #f0f2f5;
        padding-top: 30px;
        padding-bottom: 100px;
    }

    .point_system .wraper_content {
        background-color: #fff;
        border-radius: 10px;
        padding:  80px 30px;
       
    }

    .point_system .sec_title {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 13px;
    }
</style>


<div class="container point_system">
    <div class="inner wraper_content">
        <h2 class="sec_title">
            더투어랩 포인트 제도
        </h2>
        <p class="sub_content">더투어랩에서는 크게 2가지 방법으로 포인트를 적립할 수 있습니다.</p>
        <table class="_table">
            <tbody>
                <tr>
                    <th>1. 상품 예약에 따른 적립</th>
                    <td>적립대상</td>
                </tr>
                <tr>
                    <th>2. 게시글 작성에 따른 적립</th>
                    <td>적립대상</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection(); ?>