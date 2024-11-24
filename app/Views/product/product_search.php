<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<style>
    .travel .travel_slider {
    display: none;
    }

    .travel_tab {
        display: flex;
    }

    .travel .travel_tab .slide_tab {
    width: 100%;
}
.travel .travel_slider.active {
    display: block;
}

.travel .travel_tab .travel_btn {
    height: 60px;
    width: 100%;
    flex-basis: 20%;
    font-size: 18px;
    border: 1px solid #dbdbdb;
    border-bottom: 1px solid;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.travel .travel_tab .travel_btn.active {
    color: #e5001a;
    border-bottom: unset;
    border: unset;
    border-left: 1px solid black;
    border-top: 1px solid black;
    border-right: 1px solid black;
}
.item_search_section_1 .title {
    font-size: 30px;
    line-height: 42px;
    font-weight: 700;
    text-align: center;
    padding-top: 100px;
    padding-bottom: 60px;
}
</style>
<section class="item_search_section_1 travel">
	<div class="body_inner">
		<h1 class="title"><span class="red_text">‘<?=$search_name?>’</span> 검색결과</h1>
	</div>
	<div class="travel_box">
		<div class="body_inner travel_tab flex">
			<div class="slide_tab">
				<div class="swiper-wrapper">
                    <?php foreach ($list as $key => $item): ?>
                        <button type="button" value="active01" class="travel_btn">
                            <?=$item['title']?>(<?=count($item['items'])?>)
                        </button>
                    <?php endforeach; ?>
					<div class="last only_web"></div>
				</div>
			</div>
		</div>

		<div class="body_inner">
			<div class="travel_desc">
                    <div class="travel_slider active01 active">
                    <?php foreach ($listhotel as $item1_1): ?>
                        <?php $img_dir = img_link($item1_1['product_code_1']); ?>
                        <?php $prog_link = prog_link($item1_1['product_code_1']); ?>
                        <a href="<?= $prog_link ?><?= $item1_1['product_idx'] ?>" class="best_list_item">
                            <div class="img_box img_box_3">
                                <img src="/data/<?= $img_dir ?>/<?= $item1_1['ufile1'] ?>" alt="main">
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb_item">방콕</li>
                                <li class="breadcrumb_item">시암</li>
                            </ul>
                            <div class="prd_name">
                                <?= $item1_1['product_name'] ?>
                            </div>
                            <div class="prd_info">
                                <img class="ico_star" src="/images/ico/ico_star.svg" alt="">
                                <span class="star_avg">4.7</span>
                                <span class="star_review_cnt">(954)</span>
                            </div>
                            <div class="prd_price_ko">
                                <?= number_format($item1_1['original_price']) ?> <span>원</span>
                            </div>
                            <div class="prd_price_thai">
                                6,000 <span>바트</span>
                            </div>
                        </a>
                    <?php endforeach; ?>                        
                    </div>
			</div>
		</div>
	</div>
</section>

<?php $this->endSection(); ?>