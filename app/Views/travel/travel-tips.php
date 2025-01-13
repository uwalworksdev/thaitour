<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<style>
    .travel-tips .sec_banner {
        margin-top: 32px;
        margin-bottom: 90px;
    }

    .travel-tips .sec_banner {
        position: relative;
    }

    .travel-tips .sec_banner .text_banner {
        position: absolute;
        top: 50%;
        left: 120px;
        transform: translateY(-50%);
        color: #fff;
    }

    .travel-tips .sec_banner .text_banner span {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 10px;
        display: block;
    }

    .travel-tips .sec_banner .text_banner p {
        font-size: 18px;
        font-weight: 400;
        line-height: 1.2;
    }

    .travel-tips .header_sec {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 32px;
    }

    .travel-tips .header_sec .title_sec {
        font-size: 28px;
        font-weight: 700;

    }

    .travel-tips .header_sec .sub_title_sec {
        font-size: 17px;
        color: #757575;
    }

    .travel-tips .content_sec .list_item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 5px;
        margin-bottom: 115px;
    }

    .travel-tips .content_sec .list_item .item {
        width: 224px;
        height: 150px;
        position: relative;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover
    }

    .travel-tips .content_sec .list_item .item span {
        position: absolute;
        top: 35px;
        left: 30px;
        font-size: 20px;
        font-weight: 700;
        color: #252525;
    }

    .travel-tips .content_sec .list_item .item_1 {
        background-image: url(/images/sub/tra-sec-01-1.png);

    }

    .travel-tips .content_sec .list_item .item_2 {
        background-image: url(/images/sub/tra-sec-01-2.png);

    }

    .travel-tips .content_sec .list_item .item_3 {
        background-image: url(/images/sub/tra-sec-01-3.png);

    }

    .travel-tips .content_sec .list_item .item_4 {
        background-image: url(/images/sub/tra-sec-01-4.png);

    }

    .travel-tips .content_sec .list_item .item_5 {
        background-image: url(/images/sub/tra-sec-01-5.png);

    }
</style>


<div class="container travel-tips">
    <div class="body_inner">
        <div class="sec_banner">
            <img src="/images/sub/tra_sec_banner.png" alt="">
            <div class="text_banner">
                <span>여행꿀팁</span>
                <p>태국에서 뭐하지? 어디가지? <br> 깨알 같은 정보를 모두 모아서 한눈에~!</p>
            </div>
        </div>
        <div class="sec_01">
            <div class="header_sec">
                <h3 class="title_sec"><i style="color : #29459f">더투어랩</i> 나침반</h3>
                <p class="sub_title_sec">관광지부터 핫 플레이스, 맛집까지 정보가 한곳에</p>
            </div>
            <div class="content_sec">
                <div class="list_item">
                    <div class="item item_1">
                        <span>#관광명소</span>
                    </div>
                    <div class="item item_2">
                        <span>#할거리</span>
                    </div>
                    <div class="item item_3">
                        <span>#음식</span>
                    </div>
                    <div class="item item_4">
                        <span>#쇼핑</span>
                    </div>
                    <div class="item item_5">
                        <span>#나이트</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="sec_02">
            <div class="header_sec">
                <h3 class="title_sec">핫 플레이스</h3>
            </div>
            <div class="content_sec">
                
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>