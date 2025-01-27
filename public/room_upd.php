<?php
/*
Array
(
    [room_types] => Array
        (
            [0] => Array
                (
                    [idx] => 1
                    [rooms] => Array
                        (
                            [0] => 101
                            [1] => 102
                        )

                    [name] => Array
                        (
                            [0] => Room 101
                            [1] => Room 102
                        )

                )

            [1] => Array
                (
                    [rooms] => Array
                        (
                            [0] => 201
                            [1] => 202
                        )

                    [name] => Array
                        (
                            [0] => Room 201
                            [1] => Room 202
                        )

                )

        )

)
*/

// 출력
echo "<pre>";
print_r($_POST);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch bed type and price data
    $bed_types = $_POST['bed_type'] ?? []; // Default to an empty array if not set
    $bed_prices = $_POST['bed_price'] ?? []; // Default to an empty array if not set

    // Fetch option values
    $options = $_POST['option_val'] ?? []; // Default to an empty array if not set

    // Process each room's data
    foreach ($bed_types as $roomIdx => $beds) {
        echo "Room Index: $roomIdx<br>";

        // Process each bed type and price
        foreach ($beds as $index => $bedType) {
            $bedPrice = $bed_prices[$roomIdx][$index] ?? '';
            echo "Bed Type: $bedType, Bed Price: $bedPrice<br>";
        }

        // Process each option for the room
        $roomOptions = $options[$roomIdx] ?? [];
        foreach ($roomOptions as $optionIdx => $optionValue) {
            echo "Option $optionIdx: $optionValue<br>";
        }
        echo "<hr>";
    }
}

?>  