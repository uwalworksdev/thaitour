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
            showButtonPanel: true,
            beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            },
            closeText: '닫기',
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
            showMonthAfterYear: true,
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear: true,
            closeText: '닫기',  // 닫기 버튼 패널
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ko']);

        setTimeout(function () {
            $(".datepicker").datepicker({
                showButtonPanel: true
                , beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                }
                , dateFormat: 'yy-mm-dd'
                , showOn: "both"
                , yearRange: "c-100:c+10"
                , buttonImage: "/AdmMaster/_images/common/date.png"
                , buttonImageOnly: true
                , closeText: '닫기'
                , prevText: '이전'
                , nextText: '다음'

            });
            $(".datepicker2").datepicker({
                showButtonPanel: true
                , beforeShow: function (input) {
                    setTimeout(function () {
                        var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");
                        var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                        btn.unbind("click").bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                        btn.appendTo(buttonPane);
                    }, 1);
                }
                , dateFormat: 'yy-mm-dd'
                , yearRange: "c-100:c+10"
                , closeText: '닫기'
                , prevText: '이전'
                , nextText: '다음'

            });
            $('img.ui-datepicker-trigger').css({'cursor': 'pointer'});
            $('input.hasDatepicker').css({'cursor': 'pointer'});
            $(".ui-datepicker-prev").css({
                "background-image": "url('/images/ico/caret-left-square.png')",
                "background-repeat": "no-repeat",
                "background-position": "center center",
                "background-size": "20px 20px"
            });

            // Áp dụng cho nút Next
            $(".ui-datepicker-next").css({
                "background-image": "url('/images/ico/caret-right-square.png')",
                "background-repeat": "no-repeat",
                "background-position": "center center",
                "background-size": "20px 20px"
            });
        }, 100);
    });

</script>

<script type="text/javascript" src="/lib/jquery/jquery.easing.min.js" charset="utf-8"></script>
<script src="/js/admin/common.js"></script>
<script>
    //$(".imgpop").colorbox({rel:'imgpop'});
    $(document).ready(function () {
        $(".imgpop").colorbox({
            rel: 'imgpop',
            maxWidth: '90%',
            maxHeight: '90%'
        });
    });
    //$('#colorbox').draggable();

    $(".price").number(true);

</script>

</body>
</html>
