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
    <meta name="robots" content="noindex">
    <link href="/uploads/setting/<?= $setting['favico'] ?>" rel="icon" type="image/x-icon">
    <link rel="canonical" href="https://happythaitour.com/">

    <!-- Old version -->
    <script src="/lib/jquery/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="/lib/swiper-11.1.4/package/swiper-bundle.min.css"/>
    <script src="/lib/jquery/jquery-ui.min.js"></script>
    <script src="/lib/swiper-11.1.4/package/swiper-bundle.min.js"></script>

    <!-- New version-->
    <!--    <link rel="stylesheet" href="/lib/new_swiper/swiper4.5.1.css"/>-->
    <!--    <link rel="stylesheet" href="/lib/new_swiper/swiper.min.css"/>-->
    <!---->
    <!--    <script src="/lib/new_jquery/jquery-2.1.4.min.js"></script>-->
    <!--    <script src="/lib/new_jquery/jquery-ui.min.js"></script>-->
    <!---->
    <!--    <script src="/lib/new_swiper/swiper4.5.1.js"></script>-->
    <!--    <script src="/lib/new_swiper/swiper.min.js"></script>-->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/summernote/summernote-lite.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <script src="/js/script.js"></script>
    <!--    <script src="/lib/slick/slick.js"></script>-->
    <script src="/lib/slick/slick.min.js"></script>
    <script src="/lib/summernote/summernote-lite.js"></script>
    <script src="/lib/summernote/lang/summernote-ko-KR.js"></script>

    <script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
    <script type="text/javascript" src="/js/apple.js"></script>
    
    <title><?= $setting['site_name'] ?></title>
    <script>
        var kakao_key = '<?=env("KAKAO_KEY")?>';
    </script>
</head>