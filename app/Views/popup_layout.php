<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? '팝업') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        /* 팝업용 간단한 스타일 예시 */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <?= $this->renderSection('content') ?>
</body>
</html>
