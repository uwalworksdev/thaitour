<?
// 기본 헤더
include $_SERVER['DOCUMENT_ROOT'] . "/inc/head_inc.php";

include $_SERVER['DOCUMENT_ROOT'] . "/inc/header_inc.php";


if ($s_txt and ($search_category == "order_user_name")) {
    $strSql = $strSql." and CONVERT(AES_DECRYPT(UNHEX($search_category),'$private_key') USING utf8)  LIKE '%$s_txt%' "; 
}

    $sql     = "select * from tbl_bbs_list where code = 'banner' and category = '110' ";
    $result  = mysqli_query($connect, $sql) or die (mysqli_error($connect));
    $row     = mysqli_fetch_array($result);

    $pc_img    = "/data/bbs/". $row['ufile6'];
    $mo_img    = "/data/bbs/". $row['ufile5'];


	$total_sql = "select s1.*, s3.code_name, count(s4.r_idx) as cmt_cnt
	, (select ifnull(count(*),0) from tbl_order_list where s1.order_idx= tbl_order_list.order_idx) as cnt
	from tbl_order_mst s1
	left join tbl_product_mst s2 on s1.product_idx = s2.product_idx
	left join tbl_code s3 on s1.product_code_1 = s3.code_no
	left join tbl_bbs_cmt s4 on s1.order_idx = s4.r_idx and s4.r_code = 'order' and s4.r_status = 'Y' and s4.r_delYN = 'N'
	where s1.is_modify='N' and s1.isDelete != 'Y' and s1.order_gubun='tour' and s1.order_status != 'D' $strSql
	group by s1.order_idx ";

	$result = mysqli_query($connect, $total_sql) or die(mysqli_error($connect));

	$g_list_rows = 10;

	$nTotalCount = mysqli_num_rows($result);


	$nPage = ceil($nTotalCount / $g_list_rows);
	if ($pg == "") $pg = 1;
	$nFrom = ($pg - 1) * $g_list_rows;


	$sql = $total_sql . " order by s1.order_r_date desc, s1.order_idx desc limit $nFrom, $g_list_rows ";

	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

	$num = $nTotalCount - $nFrom;


// 공지사항 게시판
?>

<link rel="stylesheet" href="./invoice.css" type="text/css">
<link rel="stylesheet" href="./invoice_responsive.css" type="text/css">

<div id="container" class="sub list_container">
    
    <section class="invoice_section">
        <div class="inner">
		    <? if($row['ufile6']) { ?>
            <div class="sub_visual" style="background-image: url('<?=$pc_img ?>');"></div>
			<? } else { ?>
                <div class="sub_visual" style="display: none"></div>
            <? } ?>
            <div class="sect_ttl_box">
                <h2>예약현황</h2>
            </div>
            <div class="flex notice_search">
                <form name="search" id="search">
                    <div class="evaluate_search flex">
                        <select name="search_category" class="evaluate_filter_selection">
                            <option value="order_user_name" <? if ($search_mode == "order_user_name") echo "selected"; ?>>글쓴이</option>
                        </select>
                        <input type="text" name="s_txt" value="<?= $s_txt ?>">
                        <button class="search_button" type="button" onclick="search_it()">검색</button>
                    </div>
                </form>
            </div>
            <script>
            function search_it() {
                var frm = document.search;
                frm.submit();
            }
        </script>
            <table class="bs_table">
                <colgroup>
                    <col width="80px">
                    <col width="110px">
                    <col width="*">
                    <col width="110px">
                    <col width="110px">
                </colgroup>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>구분</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                     $deviceType = get_device();
                    if ( $nTotalCount == 0) {
                        ?>
                        <tr>
                            <td colspan=4 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                        </tr>
                        <?
                            }
    
                    while ($row = mysqli_fetch_array($result)) {
                        $sql_d    = "SELECT   AES_DECRYPT(UNHEX('{$row['order_user_name']}'),   '$private_key') order_user_name";
                        $res_d    = mysqli_query($connect,$sql_d) or die(mysqli_error($connect));
                        $row_d    = mysqli_fetch_array($res_d);
                        $row['order_user_name']   = $row_d['order_user_name'];
                        ?>
                    <tr>
                        <td class="num"><span><?=$num--;?></span></td>
                        <td class="ttl"><span><?=$row['code_name']?></span></td>
                        <td class="subject">
                            <!-- <span class="stt_1"><?=get_status_name($row["order_status"])?></span> -->
                        <?
                        if (($row['m_idx'] == $_SESSION['member']['mIdx']) 
                            || ($_SESSION['member']['idx'] && $_SESSION['member']['id'] == 'admin') 
                            || ($_SESSION['member']['idx'] && $_SESSION['member']['level'] <= 2)) {
                            ?>
                            <a href="./invoice_view_paid.php?order_idx=<?=$row['order_idx']?>"><?=strAsterisk($row["order_user_name"])?>님의 여행예약이 <?=get_status_name($row["order_status"])?>되었습니다.  <span class="red">(<?=$row['cmt_cnt']?>)</span></a>
                            <?
                        } else {
                            $message = !$_SESSION['member']['idx'] ? "로그인을 해주세요!" : "내가쓴글만 열람이 가능합니다.";
                            ?>
                            <a href="#" onclick="alert(`<?=$message?>`);"><?=strAsterisk($row["order_user_name"])?>님의 여행예약이 <?=get_status_name($row["order_status"])?>되었습니다. <span class="red">(<?=$row['cmt_cnt']?>)</span></a>&nbsp;<i></i>
                            <?
                        }
    
                        ?>
    
                          
                        </td>
                        <td class="writer"><?=strAsterisk($row['order_user_name'])?></td>
                        <td class="date"><?=date("Y.m.d", strtotime($row["order_r_date"]))?></td>
                    </tr>
    
                    <?
                    }
    
                    ?>
                    <!-- <tr>
                        <td class="id"><span>14683</span></td>
                        <td class="ttl"><span>자유여행</span></td>
                        <td class="des"><span class="stt_2">접수</span><a href="./invoice_view_paid.php">황수연님의 여행예약이 접수되었습니다.</a><span class="red">(1)</span>
                        </td>
                        <td class="name">황수연</td>
                        <td class="m_ttl">구분: <span>맞춤여행</span></td>
                        <td class="m_name">작성자: <span>김선혁</span></td>
                        <td class="date">2023.09.11</td>
                    </tr> -->
                </tbody>
            </table>
    
            <?
                include $_SERVER['DOCUMENT_ROOT'] . "/inc/popup_inc.php";
            ?>
    
    
            <div class="paging_wrap"><?php echo ipageListing2($pg, $nPage, 10, $_SERVER['PHP_SELF']."?pg=",$deviceType) ?></div>
        </div>
    </section>
</div>

<?
include $_SERVER['DOCUMENT_ROOT'] . "/inc/footer_inc.php";

?>