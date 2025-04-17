<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? '팝업') ?></title>
	<link href="<?= base_url('css/mypage/mypage_new.css') ?>" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url('css/mypage/mypage_reponsive_new.css') ?>" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url('css/mypage/mypage_reponsive_new02.css') ?>" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url('css/mypage/mypage.css') ?>" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url('css/mypage/mypage_reponsive.css') ?>" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url('css/community/community.css') ?>" rel="stylesheet" type="text/css"/>	
</head>
<body>
    <?= $this->renderSection('content') ?>
</body>
</html>
