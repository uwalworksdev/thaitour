<h1>결제가 실패했습니다.</h1>
<p>오류 메시지: <?= esc($message) ?></p>
<?php
if (isset($response['status']) && $response['status'] !== 'SUCCESS') {
    echo "오류 메시지: " . $response['message'];
}

?>