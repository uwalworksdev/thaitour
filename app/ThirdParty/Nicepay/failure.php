<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>결제 실패</title>
</head>
<body>
    <h1>결제가 실패하였습니다.</h1>
    <p>오류 코드: <?= $result['resultCode'] ?></p>
    <p>오류 메시지: <?= $result['resultMsg'] ?></p>
</body>
</html>
