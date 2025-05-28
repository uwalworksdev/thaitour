<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<style>
    .point_system {
        background-color: #f0f2f5;
        padding-top: 1px;
        padding-bottom: 100px;
    }

    .point_system .wraper_content {
        background-color: #fff;
        border-radius: 10px;
        padding: 80px 30px;

    }

    .point_system .sec_title {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .point_system .sub_title {
        text-align: center;
        font-weight: 500;
        color: #757575;
        line-height: 1.5;

    }

    .point_system .sub_title+.sub_title {
        margin-top: 8px;
    }


    .point_system ._table {
        margin-top: 80px;
        border-top: 2px solid #dbdbdb;
        border-bottom: 2px solid #dbdbdb;
        width: 100%
    }

    .point_system ._table tr {
        border-bottom: 1px solid #dbdbdb;
    }

    .point_system ._table th {
        background-color: #fafafa;
        font-size: 18px;
        font-weight: 700;
        position: relative;
    }

    .point_system ._table th p {
        position: absolute;
        top: 20px;
        width: 100%;
        text-align: left;
        padding-left: 30px;
        font-size: 18px;
    }

    .point_system ._table td {
        padding: 20px 0 20px 45px;
        border-bottom: 1px solid #dbdbdb;
    }


    .point_system ._table .title_box {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .point_system ._table .content_box p {
        color: #757575;
        font-size: 17px;
        line-height: 1.4;
    }

    .point_system ._table .box_coin {
        display: flex;
        padding-left: 78px;
        padding-top: 128px;
        margin-bottom: 46px;
        gap: 40px;
    }


    .point_system ._table .box_coin .coin_item {
        position: relative;
        width: 180px;
        text-align: center;
    }

    .point_system ._table .box_coin .coin_item .coin_item_top {
        height: 140px;
        width: 100%;
        border-radius: 24px;
        background-color: #f6f6f8;
        position: relative;
        z-index: 2;
        padding: 13px;



    }

    .point_system ._table .box_coin .coin_item .coin_item_top p {
        font-size: 15px;
        padding-top: 14px;
    }

    .point_system ._table .box_coin .coin_item .coin_item_top p._ttl {
        color: #2a459f;
        font-size: 18px;
        font-weight: 800;
        padding-bottom: 8px;
        padding-top: 0;
        border-bottom: 1px solid #dbdbdb;
    }

    .point_system ._table .box_coin .coin_item .coin_item_img {
        position: absolute;
        top: -85px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        width: 133px;
    }


    .point_system ._table .box_coin .coin_item .coin_item_bot {
        margin-top: 20px;
        font-size: 16px;
        font-weight: 500;
        line-height: 1.4;
    }

    .point_system .box_desc_detail {
        margin-top: 80px;
        padding: 35px 55px;
        border: 1px solid #dbdbdb;
        border-radius: 10px;
    }

    .point_system .box_desc_detail .desc_title h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 30px
    }

    .point_system .box_desc_detail .item {
        display: flex;
        color: #454545;
        gap: 4px;
        margin-bottom: 8px;
        line-height: 1.4;
    }
    @media screen and (max-width: 850px) {
          .point_system .sec_title {
                    text-align: center;
                    font-size: 4.2rem; 
                    font-weight: 700;
                    margin-bottom: 1.8rem;
          }
          .point_system .sub_title+.sub_title {
            margin-top: 0.8001rem;
            font-size: 2.4rem;
          }

          .point_system .sub_title span {
            font-size: 2.4rem;
          }
          .point_system ._table th p {
                    position: absolute;
                    top: 2.0001rem;
                    width: 100%;
                    text-align: left;
                    padding-left: 3rem;
                    font-size: 2.6rem; 
                    }
          .point_system ._table td {
                    padding: 2.0001rem 0 2.0001rem 4.5rem;
                    border-bottom: 0.333px solid #dbdbdb;
          }
          .point_system ._table .title_box {
                    font-size: 2.6rem; 
                    font-weight: 500;
                    margin-bottom: 1.2rem;
          }

          p {
                    font-size: 2.3001rem;
          }
          .point_system ._table .content_box p {
                    font-size: 2.4rem;
                    line-height: 1.4;
          }
}
</style>


<div class="container point_system">
    <?php echo view("center/center_term", ['tab7' => 'on']) ?>
    <div class="only_web">
        <div class="inner wraper_content">
            <?= viewSQ($policy['policy_contents']); ?>
        </div>
    </div>
    <div class="only_mo">
        <div class="inner wraper_content">
            <?= viewSQ($policy['policy_contents_m']); ?>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>