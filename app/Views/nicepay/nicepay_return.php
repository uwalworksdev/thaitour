<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>결제 성공</title>
</head>
<body>
    <h1>결제가 성공적으로 완료되었습니다!</h1>
    <p>거래 번호: <?= $result['tid'] ?></p>
    <p>결제 금액: <?= $result['amount'] ?>원</p>
</body>
</html>
