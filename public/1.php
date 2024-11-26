<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datepicker Example</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>
<body>
    <label for="start_date">Start Date:</label>
    <input type="text" name="start_date[]" class="start_date">
    <label for="end_date">End Date:</label>
    <input type="text" name="end_date[]" class="end_date">

    <label for="start_date">Start Date:</label>
    <input type="text" name="start_date[]" class="start_date">
    <label for="end_date">End Date:</label>
    <input type="text" name="end_date[]" class="end_date">

    <script>
        $(function () {
            // 시작 날짜
            $(".start_date").datepicker({
                dateFormat: "yy-mm-dd",
                onClose: function (selectedDate) {
                    $(".end_date").datepicker("option", "minDate", selectedDate);
                }
            });

            // 종료 날짜
            $(".end_date").datepicker({
                dateFormat: "yy-mm-dd",
                onClose: function (selectedDate) {
                    $(".start_date").datepicker("option", "maxDate", selectedDate);
                }
            });
        });
    </script>
</body>
</html>
