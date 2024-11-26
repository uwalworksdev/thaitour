<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<link rel="stylesheet" type="text/css" href="/css/admin/popup.css">

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<div id="datepicker"></div>
<script type="text/javascript">
    function checkForNumber(str) {
        var key = event.keyCode;
        var frm = document.frm1;
        if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
            (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
            event.returnValue = false;
        }
    }
</script>

<style>
    .container_date {
        display: flex; /* 가로 정렬 */
    }

    .order_btn {
        cursor: pointer;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

</style>

<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>상품요금정보 </h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_hotel/write?search_category=&search_txt=&pg=&product_idx=<?=$product_idx?>" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                        </li>
                        <?php if ($o_idx) { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>
                            <li><a href="#" class="btn btn-default"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                            </li>
                        <?php } else { ?>
                            <li><a href="javascript:send_it()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
            <!-- // inner -->

        </header>
        <!-- // headerContainer -->

        <form name="chargeForm" id="chargeForm" method="post">
            <input type=hidden name="product_idx" value='<?= $product_idx ?>' id="product_idx">
            <input type=hidden name="o_idx" value='<?= $o_idx ?>' id='o_idx'>

            <div id="contents">
                <div class="listWrap_noline">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                            <tr>
                                <th>상품명</th>
                                <td>
                                    <?= $product_name ?>
                                </td>
                            </tr>

                            <tr>
                                <th>날짜지정</th>
                                <td>
                                    <div class="container_date flex__c" style="margin: 0">
                                        <div style="text-align:left;">
                                            시작일: <input type="text" name="s_date" value="<?= $o_sdate ?>" id="s_date"
                                                        style="text-align: center;background: white; width: 120px;" readonly>
                                        </div>
                                        <div style="text-align:left;text-wrap: nowrap; margin-left: 30px;">
                                            종료일: <input type="text" name="e_date" value="<?= $o_edate ?>" id="e_date"
                                                        style="text-align: center; background: white; width: 120px;" readonly>
                                        </div>

                                        <div style="margin:10px">
                                            <a href="javascript:addOption();" id="addcharge" class="btn btn-primary">조회</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>요금정보</th>
                                <td>
                                    
                                    <table style="width:100%" id="chargeTable">
                                        <colgroup>
                                            <col width="*">
                                            <col width="30%">
                                            <col width="30%">
                                            <col width="15%">
                                            <col width="15%">
                                        </colgroup>
                                        <tbody id="charge">
                                            <tr style="height:40px">
                                                <td style="text-align:center">
                                                    적용일자
                                                </td>
                                                <td style="text-align:center">
                                                    가격
                                                </td>
                                                <td style="text-align:center">
                                                    우대가격
                                                </td>
                                                <td style="text-align:center">
                                                    마감
                                                </td>
                                                <td style="text-align:center">
                                                    처리
                                                </td>
                                            </tr>
                                        
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            </tbody>

                        </table>
                    </div>
                    <!-- // listBottom -->

                    <script>

                        $(function () {

                            $("#s_date").datepicker({
                                dateFormat: 'yy-mm-dd',
                                showOn: "both",
                                buttonImage: "/images/admin/common/date.png",
                                buttonImageOnly: true,
                                closeText: '닫기',
                                currentText: '오늘',
                                prevText: '이전',
                                nextText: '다음',
                                yearRange: "c:c+10",
                                minDate: '<?=$o_sdate?>',
                                maxDate: '<?=$o_edate?>',
                                onClose: function (selectedDate) {
                                    $("#e_date").datepicker("option", "minDate", selectedDate);
                                },
                                beforeShow: function (input) {
                                    setTimeout(function () {
                                        var buttonPane = $(input)
                                            .datepicker("widget")
                                            .find(".ui-datepicker-buttonpane");
                                        var btn = $('<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                                        btn.unbind("click").bind("click", function () {
                                            $.datepicker._clearDate(input);
                                        });
                                        btn.appendTo(buttonPane);
                                    }, 1);
                                }
                            });


                            $("#e_date").datepicker({
                                showButtonPanel: true
                                , onClose: function (selectedDate) {
                                    // To 날짜 선택기의 최소 날짜를 설정
                                    $("#s_date").datepicker("option", "maxDate", selectedDate);
                                }
                                , beforeShow: function (input) {
                                    setTimeout(function () {
                                        var buttonPane = $(input)
                                            .datepicker("widget")
                                            .find(".ui-datepicker-buttonpane");
                                        //var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                                        btn.unbind("click").bind("click", function () {
                                            $.datepicker._clearDate(input);
                                        });
                                        btn.appendTo(buttonPane);
                                    }, 1);
                                }
                                , dateFormat: 'yy-mm-dd'
                                , showOn: "both"
                                , yearRange: "c:c+30"
                                , buttonImage: "/images/admin/common/date.png"
                                , buttonImageOnly: true
                                , closeText: '닫기'
                                , currentText: '오늘' // 오늘 버튼 텍스트 설정
                                , prevText: '이전'
                                , nextText: '다음'
                                , minDate: '<?=$o_sdate?>'
                                , maxDate: '<?=$o_edate?>'
                            });
                        });
                        
                    </script>

                    <script>
                        // 동적으로 추가된 input 요소에 콤마 적용 - 이벤트 위임 사용
                        $(document).on('input', '.input_txt', function () {
                            var value = $(this).val().replace(/,/g, ''); // 기존 콤마 제거

                            if (!isNaN(value) && value !== '') {  // 숫자인 경우에만 처리
                                var formattedValue = Number(value).toLocaleString('en');  // 콤마 추가
                                $(this).val(formattedValue);  // 값 업데이트
                            }
                        });

                        $(document).on('input', '.only_number', function () {
                            var value = $(this).val();
                            $(this).val(value.replace(/[^0-9]/g, '')); 
                        });
                    </script>

                    <div class="tail_menu">
                        <ul>
                            <li class="left"></li>
                            <li class="right_sub">

                                <a href="javascript:go_list();" class="btn btn-default"><span
                                            class="glyphicon glyphicon-th-list"></span><span class="txt">상품보기</span></a>
                                <?php if ($o_idx == "") { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">등록</span></a>
                                <?php } else { ?>
                                    <a href="javascript:send_it()" class="btn btn-default"><span
                                                class="glyphicon glyphicon-cog"></span><span
                                                class="txt">수정</span></a>
                                    <a href="#" class="btn btn-default"><span
                                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- // listWrap -->
            </div>
            <!-- // contents -->
        </form>
    </div><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->

<script>
    $(document).on('click', '.chargeDelete', function () {
        $(this).closest("tr").remove();
    });


    function addOption() {
        let startDate = new Date($("#s_date").val());
        let endDate = new Date($("#e_date").val());

        let html = ``;
        while (startDate <= endDate) {
            let dateStr = startDate.toISOString().split('T')[0];

            
            let issetDate = $('.option_date .date[data-value="' + dateStr + '"]');

            if(issetDate.length <= 0){
                html += `
                        <tr class="option_date" style="height:40px">
                            <td class="date" style="text-align:center" data-value="${dateStr}">
                                ${dateStr}
                            </td>
                            <td style="text-align:center">
                                <input type="text" class="price tour_price input_txt only_number" style="text-align:right"/>
                            </td>
                            <td style="text-align:center">
                                <input type="text" class="price tour_price input_txt only_number" style="text-align:right"/>
                            </td>
                            <td style="text-align:center;">
                                <div class="" style="display: flex; gap: 10px">
                                    <button style="height: 30px" type="button"
                                            class="chargeUpdate">수정
                                    </button>
                                    <button style="height: 30px" type="button"
                                            class="chargeDelete">삭제
                                    </button>
                                </div>
                            </td>
                        </tr>
                `;
            }

            startDate.setDate(startDate.getDate() + 1);
        }

        $("#charge").append(html);

    }
</script>

<script>
    function go_list() {
        window.location.href = "AdmMaster/_hotel/write?search_category=&search_txt=&pg=&product_idx=<?=$product_idx?>";
    }
</script>

<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>