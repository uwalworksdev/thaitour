<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">

    <link rel="stylesheet" href="/css/admin/import.css" type="text/css" />
    <link rel="stylesheet" href="/css/admin/adm_login.css" type="text/css" />
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
    <?=$this->renderSection("body")?>
</body>

</html>