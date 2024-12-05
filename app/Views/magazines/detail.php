<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <link rel="stylesheet" href="/css/magazines/magazines.css">
    <main id="container" class="sub magazines_page_" style="background-color: #f0f2f5;">
        <div class="inner magazines_area_">
            <div class="magazines_detail_">
                <div class="magazines_detail__title_">
                    <?=$magazine['subject']?>
                </div>
                <div class="magazines_detail__desc_">
                    <p class="author_">
                        <?=$magazine['writer']?>
                    </p>
                    <p class="src_">
                        |
                    </p>
                    <p class="date_">
                        <?=date('Y-m-d', strtotime($magazine['r_date']))?>
                    </p>
                    <p class="src_">
                        |
                    </p>
                    <p class="more_">
                        조회수 : <?=$magazine['hit']?>
                    </p>
                </div>
                <div class="magazines_detail__content_">
                   <?=viewSQ($magazine['contents'])?>
                </div>
            </div>
        </div>
    </main>

<?php $this->endSection(); ?>