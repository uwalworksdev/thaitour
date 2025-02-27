<?= $this->include("admin/inc/header") ?>
<?= $this->renderSection("body") ?>
<footer id="footer">
    <!--
    <p class="tel"><img src="/AdmMaster/_images/common/tel.png" alt="시스템 이용관련 문의 02.3667.6635" /></p>
    -->
    <p class="btnTop"><a href="#" class="scrollTop"><img src="/images/ico/btn_scrolltop.png" alt="top"/></a></p>
</footer><!-- // footer -->


</div><!-- // wrap -->

<script>
    $(function () {
        $.datepicker.regional['ko'] = {
            prevText: '이전',
            nextText: '다음',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            weekHeader: 'Wk',
            dateFormat: 'yy-mm-dd',
            firstDay: 0,
            isRTL: false,
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear: true,
            closeText: '닫기',  // 닫기 버튼 패널
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ko']);

        setTimeout(function () {
            $(".datepicker").datepicker();
            $(".datepicker2").datepicker();
            $('img.ui-datepicker-trigger').css({'cursor': 'pointer'});
            $('input.hasDatepicker').css({'cursor': 'pointer'});
        }, 100);
    });

	$(function() {
		// Datepicker에 한국어 설정 적용
		$.datepicker.setDefaults($.datepicker.regional['ko']);
		
		// 시작일과 종료일 초기화
		var startDatePicker = $("#s_date");
		var endDatePicker   = $("#e_date");
		
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
<style>
    #colorbox {
        z-index: 999999999 !important;
    }
</style>

<script type="text/javascript" src="/lib/jquery/jquery.easing.min.js" charset="utf-8"></script>
<script src="/js/admin/common.js"></script>
<script>
    //$(".imgpop").colorbox({rel:'imgpop'});
    $(document).ready(function () {

        // $(".imgpop").colorbox({
        //     rel: 'imgpop',
        //     maxWidth: '90%',
        //     maxHeight: '90%'
        // });

        $(".imgpop").each(function () {
            if ($(this).attr("href") && $(this).attr("href").match(/\.(jpg|jpeg|png|gif|bmp)$/i)) {
                $(this).colorbox({
                    rel: 'imgpop',
                    maxWidth: '90%',
                    maxHeight: '90%'
                });
            }
        });

        $(".price").keyup(function() {
            let number = $(this).val().replace(/,/g, '');
            if (!isNaN(number)) {
                $(this).val(Number(number).toLocaleString("en-US"));
            }
        });
    });
    //$('#colorbox').draggable();

</script>

</body>
</html>
