<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index,follow">
    <meta content="<?= $setting['site_name'] ?>" name="Title">
    <meta content="<?= $setting['site_name'] ?>" name="Description">
    <meta content="<?= $setting['site_name'] ?>" name="Keyword">
    <meta property="og:title" content="<?= $setting['site_name'] ?>">
    <meta property="og:description" content="<?= $setting['site_name'] ?>">
    <meta property="og:image" content="/uploads/setting/<?= $setting['og_img'] ?>">
    <meta property="og:url" content="https://happythaitour.com/">
    <meta property="al:web:url" content="https://happythaitour.com/">
    <meta name="naver-site-verification" content="466ef04fc98ddc84f2dc2f63451ef03d71efa5d7">
    <link href="/uploads/setting/<?= $setting['favico'] ?>" rel="icon" type="image/x-icon">
    <link rel="canonical" href="https://happythaitour.com/">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="/lib/jquery/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/swiper-11.1.4/package/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/lib/summernote/summernote-lite.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="/js/script.js"></script>
    <script src="/lib/swiper-11.1.4/package/swiper-bundle.min.js"></script>
    <script src="/lib/slick/slick.js"></script>
    <script src="/lib/jquery/jquery-ui.min.js"></script>
    <script src="/lib/summernote/summernote-lite.js"></script>
    <script src="/lib/summernote/lang/summernote-ko-KR.js"></script>
    <title><?= $setting['site_name'] ?></title>
    <script>
        var kakao_key = '<?=env("KAKAO_KEY")?>';
    </script>
</head>