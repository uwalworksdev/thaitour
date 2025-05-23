<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<link href="/css/center/img_convert.css" rel="stylesheet" type="text/css" />
<section class="privacy">
    <?php
    echo view("center/center_term", ["tab5" => "on"]);
    ?>
    <div class="inner">
        <div class="contentArea">

            <div class="content_wrap">
                <?= viewSQ($policy['policy_contents']); ?>
            </div>

        </div>
    </div>

</section>

<?php $this->endSection(); ?>