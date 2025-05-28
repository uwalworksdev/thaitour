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
        padding: 80px 60px;

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

    .list_steps {
        display: flex;
        gap: 43px;
        margin-top: 60px;
        flex-wrap: wrap;
    }

    .list_steps .step {
        width: calc((100% - 43px * 2) / 3);
        border: 2px solid #2a459f;
        border-radius: 43px;
        padding: 20px 30px 35px;
        position: relative;
    }

    .list_steps .step::before {
        content: '';
        position: absolute;
        width: 14px;
        height: 21px;
        top: 195px;
        right: -32px;
        background: url(/img/sub/arrow-right-blue_2.png);
    }

    .list_steps .step:nth-child(3)::before,
    .list_steps .step:nth-child(6)::before ,
    .list_steps .step:last-child::before {
        content: '';
        display: none;

    }

    .list_steps .step .heading {
        background-color: #2a459f;
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        border-radius: 22px;
        width: 150px;
        height: 42px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 25px;

    }

    .list_steps .step .title {
        font-size: 22px;
        font-weight: 700;
        color: #2a459f;
        margin-bottom: 17px;
    }

    .list_steps .step .desc {
        font-size: 18px;
        color: #757575;
        line-height: 1.4;
    }

    .list_steps .step .btn_go {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        background-color: #f5f7fa;
        border-radius: 21px;
        border: 1px solid #2a459f;
        margin-top: 23px;
        width: 190px;
        height: 42px;
        font-size: 18px;
        color: #2a459f;
    }
    @media screen and (max-width: 850px) {

    .point_system .wraper_content {
        background-color: #fff;
        border-radius: 1rem;
        padding: 8rem 6rem;
    }
.point_system .sec_title {
    text-align: center;
    font-size: 4.2rem;
    font-weight: 700;
    margin-bottom: 1.8rem;
}
.point_system .sub_title {
          font-size: 2.3rem;
}

.point_system .sub_title br {
    display: none;
}
.point_system .sub_title+.sub_title{
    margin-top: 0.8rem;
}
.list_steps {
    display: flex;
    flex-direction: column;
    gap: 7.5rem;
    margin-top: 6rem;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}
.list_steps .step{
    width: calc((100% - 1.5rem * 2) / 1);
    border: 2px solid #2a459f;
    border-radius: 6rem;
    padding: 2rem 3rem 3.5rem;
    position: relative;
}
.list_steps .step::before{
    content: '';
    position: absolute;
    width: 2.4rem;
    height: 3.1rem;
    top: unset;
    right: unset;
    left: 50%;
    bottom: -6rem;
    transform: translateX(-50%) rotate(90deg);
    background: url(/img/sub/arrow-right-blue_2.png);
    background-size: 2.4rem 3.1rem;
}
.list_steps .step .heading {
    background-color: #2a459f;
    font-size: 3.2rem;
    font-weight: 700;
    color: #fff;
    border-radius: 3.2rem;
    width: 19rem;
    height: 5.2rem;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    margin-bottom: 2.5rem;
}
.list_steps .step .title {
    font-size: 3.2rem;
    font-weight: 700;
    margin-bottom: 1.7rem;
}
.list_steps .step .desc {
    font-size: 2.8rem;
}
.list_steps .step .btn_go {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.8rem;
    background-color: #f5f7fa;
    border-radius: 3rem;
    border: 1px solid #2a459f;
    margin-top: 2.3rem;
    width: 30.1rem;
    height: 6rem;
    font-size: 2.8rem;
    color: #2a459f;
    margin-left: auto;
    margin-right: auto;
}
.list_steps .step .btn_go img{
          width: 3.1rem;
}
    .list_steps .step:nth-child(3)::before,
    .list_steps .step:nth-child(6)::before {
        display: block;
        content: ''; 
    }
    .list_steps .step:last-child::before {
        display: none;
        content: '';
    }
    }
</style>


<div class="container point_system">
    <?php echo view("center/center_term", ['tab8' => 'on']) ?>
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