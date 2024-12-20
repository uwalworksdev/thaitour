<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>결제 요청</title>
</head>
<body>
    <h1>KG이니시스 결제 테스트</h1>
    <form method="POST" action="<?= $url ?>">
        <input type="hidden" name="mid" value="<?= $mid ?>">
        <input type="hidden" name="price" value="<?= $price ?>">
        <input type="hidden" name="buyer" value="<?= $buyer ?>">
        <input type="hidden" name="timestamp" value="<?= $timestamp ?>">
        <input type="hidden" name="returnUrl" value="<?= $returnUrl ?>">
        <input type="hidden" name="cancelUrl" value="<?= $cancelUrl ?>">
        <button type="submit">결제하기</button>
    </form>
</body>
</html>
