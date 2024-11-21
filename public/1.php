<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Datepicker Example</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
    <label for="start-date">시작일: </label>
    <input type="text" id="start-date" placeholder="YYYY-MM-DD">
    
    <label for="end-date">종료일: </label>
    <input type="text" id="end-date" placeholder="YYYY-MM-DD">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui/1.13.2/i18n/datepicker-ko.min.js"></script>
    <script>
        $(function() {
            // Datepicker에 한국어 설정 적용
            $.datepicker.setDefaults($.datepicker.regional['ko']);
            
            // 시작일과 종료일 초기화
            var startDatePicker = $("#start-date");
            var endDatePicker = $("#end-date");
            
            startDatePicker.datepicker({
                dateFormat: "yy-mm-dd",
                onClose: function(selectedDate) {
                    if (selectedDate) {
                        endDatePicker.datepicker("option", "minDate", selectedDate);
                    }
                }
            });

            endDatePicker.datepicker({
                dateFormat: "yy-mm-dd",
                onClose: function(selectedDate) {
                    if (selectedDate) {
                        startDatePicker.datepicker("option", "maxDate", selectedDate);
                    }
                }
            });
        });
    </script>
</body>
</html>
