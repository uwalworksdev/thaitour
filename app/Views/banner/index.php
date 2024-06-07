<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Banner List</title>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/inc/header_inc.php"; ?>
    </header>

    <main id="container" class="sub item_list">
        <div class="inner">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/inc/breadcrumb.php"; ?>

            <!-- list_top_banner -->
            <?php if (!empty($banners) && count($banners) == 2) { ?>
                <section class="list_top_banner">
                    <a href="<?= $banners[0]['url'] ?>" id="myLink">
                        <picture>
                            <source media="(max-width: 850px)" srcset="<?= base_url($banners[1]['ufile1']) ?>">
                            <img src="<?= base_url($banners[0]['ufile1']) ?>" alt="패키지 탑 배너">
                        </picture>
                    </a>
                </section>
            <?php } ?>

            <!-- list_mid_banner -->
            <section class="list_mid_banner">
                <div class="visual_slider half_slider">
                    <?php foreach ($codeBanners as $banner) { ?>
                        <div class="slide_item">
                            <a href="<?= $banner['url'] ?>">
                                <picture>
                                    <img src="<?= base_url('data/banner/' . $banner['ufile']) ?>" alt="배너1 이름 넣어주세요">
                                </picture>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_inc.php"; ?>
    </footer>
</body>
</html>
