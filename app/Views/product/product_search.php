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
                <?php foreach ($list as  $item): ?>
                    <div class="travel_slider active01 active">
                        
                    </div>
                <?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php $this->endSection(); ?>