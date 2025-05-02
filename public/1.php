<?php
//$payment_no, 
$add_mileage = 50; 
$payment_price = 2524; 
$cancelAmt = 1000;

$rate = ($payment_price - $cancelAmt) / $payment_price;
echo $rate ."<br>";
$mileage = ($add_mileage * (($payment_price - $cancelAmt) / $payment_price)) / 100;

echo $mileage;

?>