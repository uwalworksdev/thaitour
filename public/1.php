<?php
function getDatesAfterSpecificDate($specificDate) {
    $dates = [];

    $date = new DateTime($specificDate);
    for ($i = 1; $i <= 3; $i++) {
        $dates[] = $date->add(new DateInterval('P1D'))->format('Y-m-d');
    }

    return $dates;
}

$specificDate = '2025-02-06';
$result = getDatesAfterSpecificDate($specificDate);

print_r($result);
?>
