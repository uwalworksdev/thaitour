<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<link href="/css/center/img_convert.css" rel="stylesheet" type="text/css" />
<section class="privacy">
          <?php
          echo view("center/center_term", ["tab9" => "on"]);
          ?>
          <div class="only_web">
              <div class="inner">
                    <?= viewSQ($policy['policy_contents']); ?>
              </div>
          </div>
          <div class="only_mo">
            <div class="inner">
                    <?= viewSQ($policy['policy_contents_m']); ?>
            </div>
          </div>

</section>
<?php $this->endSection(); ?>