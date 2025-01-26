<?php



// 출력
echo "<pre>";
print_r($_POST);
echo "</pre>";

// room_types 배열 순회
if (isset($_POST['room_types']) && is_array($_POST['room_types'])) {
    $roomTypes = $_POST['room_types'];

    for ($i = 0; $i < count($roomTypes); $i++) {
        // room_types의 각 타입 정보 출력
        echo "Room Type " . ($i + 1) . ": " . $roomTypes[$i]['type_name'] . "<br>";

        // 해당 room_type의 rooms 배열 순회
        $rooms = $roomTypes[$i]['rooms'];
        for ($j = 0; $j < count($rooms); $j++) {
            echo "&nbsp;&nbsp;Room " . ($j + 1) . ": " . $rooms[$j] . "<br>";
        }

        // 해당 room_type의 name 배열 순회
        $rooms = $roomTypes[$i]['name'];
        for ($j = 0; $j < count($name); $j++) {
            echo "&nbsp;&nbsp;Name " . ($j + 1) . ": " . $name[$j] . "<br>";
        }
        echo "<br>";
    }
}

?>  