<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<?php echo view("/product/inc/spa_ticket_restaurant/list.php", ['title_page_main' => '<p>지역별 더투어랩 레스토랑</p>', 'title_page' => '<p><span>더</span>투어랩 레스토랑</p>']); ?>

<?php $this->endSection(); ?>
