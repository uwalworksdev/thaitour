<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <!-- ckeditor5 -->
    <script type='text/javascript' src="<?=base_url("WYSIWYG/ckeditor5/ckeditor.js")?>"></script>
    <link rel='stylesheet' href="<?=base_url("WYSIWYG/ckeditor5/styles.css")?>" />
    <link rel="stylesheet" href="<?=base_url("css/admin/import.css")?>" type="text/css" />
    <link rel="stylesheet" href="<?=base_url("css/lib/jquery-ui.css")?>" type="text/css" />
    <script src="<?=base_url("vendor/jquery-1.12.4.min.js")?>" type="text/javascript"></script>
    <script src="<?=base_url("vendor/jquery-ui-1.12.1.custom.js")?>" type="text/javascript"></script>
    <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <!-- <script src="<?=base_url("js/common.js")?>"></script> -->
    <?php 
    if(!empty($headers)){
        foreach($headers AS $header){
            echo $header;
        }
    }
    ?>
    <title>관리자</title>
</head>

<body>
    <div id="wrap">
        <?=$this->include("admin/inc/header")?>
        <?=$this->renderSection("body")?>
    </div>
</body>

</html>
