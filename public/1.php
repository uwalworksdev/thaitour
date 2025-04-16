<?php
$baht_thai    = "42.41";
$order_price  = "4157";
$real_amt_bath = (int)($order_price / $baht_thai); 

echo $real_amt_bath;