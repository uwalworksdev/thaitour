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
</style>

<div id="container">
    <span id="print_this">
        <header id="headerContainer">

            <div class="inner">
                <h2>매출분석</h2>
                <div class="menus">
                    <ul class="first">
						<li><a href="/AdmMaster/_statistics/member_statistics" class="btn btn_email01">회원가입통계</a></li>	
						<li><a href="/AdmMaster/_statistics/member_statistics3" class="btn btn_email01">방문자수통계</a></li>	
						<li><a href="/AdmMaster/_statistics/member_statistics4" class="btn btn_email01">검색어통계</a></li>	
						<li class="mr_10"><a href="/AdmMaster/_statistics/member_statistics5" class="btn btn_email01">접속경로관리</a></li>					
                    </ul>
                </div>
            </div><!-- // inner -->

        </header>
        <div id="contents">
            <div id="mainContentMenu" class="contentMenu">
                <ul>
                    <li class="contentMenuSub">
                        <a href="statistics_sale_yoil">매출통계</a>
                    </li>
                    <li class="contentMenuSub">
                        <a href="statistics_sale_sales">업체별 매출통계</a>
                    </li>

                    <li class="contentMenuSub">
                        <a href="statistics_sale_type">결제수단매출통계</a>
                    </li>

                    <li class="contentMenuSub ">
                        <a href="statistics_sale_type2">상품분석</a>
                    </li>

                    <li class="contentMenuSub">
                        <a href="statistics_sale_type3"> 지역별매출톨계</a>
                    </li>

                    <li class="contentMenuSub selected">
                        <a href="statistics_sale_list">매출상세내역</a>
                    </li>
                </ul>
                <div class="contentBar left" style="left: 1215.55px; display: none;"></div>
                <div class="contentBar right" style="left: 1459px; display: none;"></div>


            </div>
            <div class="content">

                <form name="listSearchForm" method="get" action="statistics_sale_list" autocomplete="off">

                    <div class="searchBox">
                        <div class="floatLeft">
                            <select name="search_type">
                                <option value="order_num" <?php if ($search_type == "order_num") echo "selected"; ?>>주문번호</option>
                            </select>
                        </div>
                        <div class="searchBoxIn">
                            <input type="text" name="keyword" value="<?= $keyword ?>" data-search-btn="1" data-on-enter="1" autocomplete="off">
                            <p class="searchIcon2 searchIconBtn"><i class="xi-search masterTooltip" title="검색" onclick="fn_search();"></i></p>
                        </div>
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
                <div class="listSelectR">
                    <button class="graident3 graButton btnExcel" type="button" onclick="location.href='#';"><i class="xi-focus-frame xi-x"></i> 엑셀다운로드</button>
                </div>

                <div id="listArea">

                    <table class="listIn fixed-header">
                        <colgroup>
                            <col width="6%">
                            <col width="14%">
                            <col width="38%">
                            <col width="12%">
                            <col width="8%">
                            <col width="8%">
                            <col width="14%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>주문번호 <i class="xi-external-link"></i></th>
                                <th>내역</th>
                                <th>금액</th>
                                <th>타입</th>
                                <th>상태</th>
                                <th>등록일</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="number">1</td>
                                <td class="number"><a href="#" target="_blank">T01314</a></td>
                                <td style="text-align:left; font-size:12px">
                                    [주문완료] 매출발생
                                </td>
                                <td class="number" style="text-align:right; font-weight:bold">0</td>
                                <td>상품</td>
                                <td >
                                    매출발생
                                </td>
                                <td class="number">2025-04-29</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="listSelectRB">
                    <button class="graident3 graButton btnExcel" type="button" onclick="location.href='#';"><i class="xi-focus-frame xi-x"></i> 엑셀다운로드</button>
                </div>

                <div class="listLineB"></div>

                <?php echo ipageListing(1, 1, 10, $_SERVER['PHP_SELF'] . "?search_type=$search_type&keyword=$keyword&sort=$sort&limit=$limit&pg=") ?>

            </div>
        </div>
    </span>
</div>

<script>
    // 검색하기
    function fn_search(){
        let frm = document.listSearchForm;
        frm.submit();
    }
</script>

<?= $this->endSection() ?>

