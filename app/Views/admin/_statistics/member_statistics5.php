<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="/css/admin/statistics.css" type="text/css" />
<link rel="stylesheet" href="/js/admin/statistics.js">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/gh/xpressengine/xeicon@latest/xeicon.min.css">

<style>
    #contents input[type=text] {
        height: 31px;
    }

    .ui-datepicker-trigger {
        display: none;
    }
</style>

<?php
    $s_date = $_GET['s_date'];
    $e_date = $_GET['e_date'];


    if ($s_date == "") {
        $s_date = date('Y-m-d');
    }

    if ($e_date == "") {
        $e_date = date('Y-m-d');
    }
?>

<div id="container">
    <span id="print_this">
        <header id="headerContainer">

            <div class="inner">
                <h2>회원및 방문분석</h2>
            </div><!-- // inner -->

        </header>
        <div id="contents">
            <div id="mainContentMenu" class="contentMenu">
                <ul>
                    <li class="contentMenuSub">
                        <a href="member_statistics">회원가입통계 </a>
                    </li>
                    <li class="contentMenuSub ">
                        <a href="member_statistics3">방문자수통계</a>
                    </li>
                    <li class="contentMenuSub ">
                        <a href="member_statistics4">검색어통계</a>
                    </li>
                    <li class="contentMenuSub selected">
                        <a href="member_statistics5"> 접속경로관리</a>
                    </li>
                </ul>
                <div class="contentBar left" style="left: 1215.55px; display: none;"></div>
                <div class="contentBar right" style="left: 1459px; display: none;"></div>
            </div>
            <div class="content">

                <form name="listSearchForm" method="get" action="member_statistics5" autocomplete="off">

                    <div class="searchBox">
                        <div class="floatLeft">
                            <select name="search_type">
                                <option value="order_num">접속경로</option>
                            </select>
                        </div>
                        <div class="searchBoxIn">
                            <input type="text" name="keyword" value="" data-search-btn="1" data-on-enter="1" autocomplete="off">
                            <p class="searchIcon2 searchIconBtn"><i class="xi-search masterTooltip" title="검색" onclick="fn_search();"></i></p>
                        </div>
                    </div>

                    <div class="period_search" style="margin-top:20px;">
                        <div class="period_input">
                            <input type="text" name="s_date" id="s_date" value="<?= $s_date ?>" readonly class="date_form">
                            <span>~</span>
                            <input type="text" name="e_date" id="e_date" value="<?= $e_date ?>" readonly class="date_form">
                        </div>
                        <button type="submit">검색</button>
                        <button type="button" class="contact_btn" rel="<?= date('Y-m-d'); ?>">오늘</button>
                        <button type="button" class="contact_btn" rel="<?= date('Y-m-d', strtotime('-3 day')); ?>">3일</button>
                        <button type="button" class="contact_btn" rel="<?= date('Y-m-d', strtotime('-7 day')); ?>">7일</button>
                        <button type="button" class="contact_btn" rel="<?= date('Y-m-d', strtotime('-1 month')); ?>">1개월</button>
                    </div>

                    <div class="empty60"></div>

                    <div class="listTop">
                        <div class="listLeft size14">
                            전체 : <b class="orange">0</b>건

                        </div>
                        <div class="listRight size10">
                            <div class="floatLeft">
                                <select name="sort" onchange="fn_search()">
                                    <option value="DESC" <?php if ($sort == "DESC") echo "selected"; ?>>등록일 역순</option>
                                    <option value="ASC" <?php if ($sort == "ASC") echo "selected"; ?>>등록일 순</option>
                                </select>
                                &nbsp;&nbsp;
                            </div>
                            <div class="floatLeft">
                                <select name="limit" onchange="fn_search()">
                                    <option value="10" <?php if ($g_list_rows == "10") echo "selected"; ?>>10개 보기</option>
                                    <option value="20" <?php if ($g_list_rows == "20") echo "selected"; ?>>20개 보기</option>
                                    <option value="30" <?php if ($g_list_rows == "30") echo "selected"; ?>>30개 보기</option>
                                    <option value="40" <?php if ($g_list_rows == "40") echo "selected"; ?>>40개 보기</option>
                                    <option value="50" <?php if ($g_list_rows == "50") echo "selected"; ?>>50개 보기</option>
                                    <option value="60" <?php if ($g_list_rows == "60") echo "selected"; ?>>60개 보기</option>
                                    <option value="70" <?php if ($g_list_rows == "70") echo "selected"; ?>>70개 보기</option>
                                    <option value="80" <?php if ($g_list_rows == "80") echo "selected"; ?>>80개 보기</option>
                                    <option value="90" <?php if ($g_list_rows == "90") echo "selected"; ?>>90개 보기</option>
                                    <option value="100" <?php if ($g_list_rows == "100") echo "selected"; ?>>100개 보기</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="empty10"></div>
                <div class="listLine"></div>

                <div id="listArea">
                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="6%">
                            <col width="*">
                            <col width="10%">
                            <col width="10%">
                            <col width="12%">
                            <col width="12%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>접속경로</th>
                                <th>운영체제</th>
                                <th>브라우저</th>
                                <th>접속아이피</th>
                                <th>접속시간</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="number">1</td>
                                <td style="text-align:left; font-size:12px"></td>
                                <td style="text-align:center;"></td>
                                <td style="text-align:center;"></td>
                                <td></td>
                                <td class="number"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="listLineB"></div>

                <?php echo ipageListing(1, 1, 10, $_SERVER['PHP_SELF'] . "?search_type=$search_type&keyword=$keyword&sort=$sort&limit=$limit&pg=") ?>

            </div>
        </div>
    </span>
</div>

<script>
    $(".date_form").datepicker({
        showButtonPanel: true,
        beforeShow: function(input) {
            setTimeout(function() {
                var buttonPane = $(input)
                    .datepicker("widget")
                    .find(".ui-datepicker-buttonpane");
                var btn = $(
                    '<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>'
                );
                btn.unbind("click").bind("click", function() {
                    $.datepicker._clearDate(input);
                });
                btn.appendTo(buttonPane);
            }, 1);
        },
        dateFormat: 'yy-mm-dd',
        showOn: "both",
        yearRange: "c-100:c+10",
        buttonImage: "/AdmMaster/_images/common/date.png",
        buttonImageOnly: true,
        closeText: '닫기',
        prevText: '이전',
        nextText: '다음'

    });


    $(".contact_btn").click(function() {

        var date1 = $(this).attr("rel");
        var date2 = $.datepicker.formatDate('yy-mm-dd', new Date());

        $("#s_date").val(date1);
        $("#e_date").val(date2);

    });
</script>

<?= $this->endSection() ?>