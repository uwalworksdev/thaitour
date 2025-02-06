<?php
function getDatesIncludingSpecificDate($specificDate) {
    $dates = [];

    $date = new DateTime($specificDate);
    for ($i = -1; $i <= 1; $i++) {
        $interval = new DateInterval('P' . abs($i) . 'D');
        if ($i < 0) {
            $interval->invert = 1; // 전날
        }
        $dates[] = $date->add($interval)->format('Y-m-d');
    }

    return $dates;
}

$specificDate = '2025-02-06';
$result = getDatesIncludingSpecificDate($specificDate);

print_r($result);
?>
