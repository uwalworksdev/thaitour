<div class="listBottom">
    <div class="">
        <?php if ($isCategory == "Y") { ?>
            <select name="category" class="input_select">
                <option value="">선택</option>
                <?php
                $fsql = " select * from tbl_bbs_category where code='$code' order by onum asc";
                $fresult = mysqli_query($connect, $fsql) or die (mysqli_error($connect));
                while ($frow = mysqli_fetch_array($fresult)) {
                    ?>
                    <option value="<?= $frow["tbc_idx"] ?>" <? if ($frow["tbc_idx"] == $category) {
                        echo "selected";
                    } ?>><?= $frow["subject"] ?></option>
                    <?php
                }
                ?>
            </select>
        <?php } ?>
    </div>
    <script type="text/javascript">
        $(function () {
            $("select[name='category']").change(function () {
                var cate = $(this).val();
                location.href = "?code=<?=$code?>&scategory=" + cate;
            });
        });
    </script>
    <form name=lfrm id=lfrm>
        <table cellpadding="0" cellspacing="0" summary="" class="listTable schedule">
            <caption></caption>
            <colgroup>
                <col width="5%"/>
                <col width="5%"/>
                <? if ($isCategory == "Y") { ?>
                    <col width="10%"/>
                <? } ?>
                <? if ($code == "news" || $code == "hashtag") { ?>
                    <col width="30%"/>
                <? } ?>
                <col width="*"/>

                <? if ($code == "sns") { ?>
                    <col width="5%"/>   <!-- sns -->
                    <col width="5%"/>   <!-- sns -->
                    <col width="5%"/>   <!-- sns -->
                <? } ?>


                <? if ($skin != "faq") { ?>
                    <!-- <col width="8%" /> -->

                    <? if ($code == "sns") { ?>
                        <col width="8%"/>  <!-- sns -->
                    <? } ?>
                    <!-- <col width="10%" /> -->
                    <col width="10%"/>
                    <!-- <col width="5%" /> -->
                <? } ?>
                <col width="6%"/>
            </colgroup>


            <thead>
            <tr>
                <th>선택</th>
                <th>번호</th>
                <? if ($isCategory == "Y") { ?>
                    <th>구분</th>
                <? } ?>
                <? if ($code == "news" || $code == "hashtag") { ?>
                    <th>사진</th>
                <? } ?>
                <th>제목</th>


                <? if ($code == "sns") { ?>
                    <th>인스타</th>    <!-- sns -->
                    <th>페이스북</th>  <!-- sns -->
                    <th>유튜브</th>   <!-- sns -->
                <? } ?>



                <? if ($skin != "faq") { ?>
                    <!-- <th>작성자</th> -->

                    <? if ($code == "sns") { ?>
                        <th>아이디</th>    <!-- sns -->
                    <? } ?>

                    <!-- <th>첨부파일</th> -->
                    <th>작성일</th>
                    <!-- <th>조회</th> -->
                <? } ?>
                <th>관리</th>

            </tr>
            </thead>
            <tbody>
            <?
            $nPage = ceil($nTotalCount / $g_list_rows);
            if ($pg == "") $pg = 1;
            $nFrom = ($pg - 1) * $g_list_rows;

            $sql = $total_sql . " order by $orderStr notice_yn desc, r_date desc,  b_ref desc, b_step asc limit $nFrom, $g_list_rows ";
            $result = mysqli_query($connect, $sql) or die (mysql_error());
            $num = $nTotalCount - $nFrom;
            while ($row = mysqli_fetch_array($result)) {

                if ($row[notice_yn] == "Y") {
                    $nums = "Notice";
                } else {
                    $nums = $num;
                }
                $newStr = "";
                if (listNew(24, $row[r_date]) == 0) {
                    $newStr = "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />";
                }

                $recStr = "";
                if ($row[recomm_yn] == "Y") {
                    $recStr = "<font color=red>[추천]</font>";
                }
                $file_chk = "N";
                for ($i = 1; $i <= 5; $i++) {
                    if ($row["rfile" . $i]) {
                        $file_chk = "Y";
                    }
                }
                $rstr = "";
                for ($i = 1; $i <= $row[b_level]; $i++) {
                    $rstr = $rstr . "&nbsp;&nbsp;";
                }
                if ($row[b_level] > 0) {
                    $rstr = $rstr . "ㄴ";
                }
                $c_cnt = "";
                if ($row[comment_cnt] > 0) {
                    $c_cnt = "(" . $row[comment_cnt] . ")";
                }
                $secureStr = "";
                if ($row[secure_yn] == "Y") {
                    $secureStr = "<img src='/img/ico/ico_lock.png'>";
                }
                ?>
                <tr>
                    <td><input type="checkbox" id="" name="bbs_idx[]" value="<?= $row[bbs_idx] ?>"
                               class="bbs_idx input_check"/></td>
                    <td><?= $nums ?></td>
                    <?php if ($isCategory == "Y") { ?>
                        <td><?= $row[category] ?></td>
                    <?php } ?>


                    <?php if ($code == "news" || $code == "hashtag") { ?>
                        <?php if ($row['ufile1'] == "") {
                            $row['ufile1'] = "panda.jpg";
                        } ?>
                        <td><img src="../../data/bbs/<?= $row['ufile1'] ?> "/></td>
                    <?php } ?>


                    <td class=" <?php if ($code != "hashtag") { ?>tal<? } ?> bold txt_black"><?= $rstr ?><a
                                href="board_view.php?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $row[bbs_idx] ?>&pg=<?= $pg ?>">
                            <?= $recStr ?> <?= $row[subject] ?> <?= $secureStr ?>
                            <?= $c_cnt ?>
                        </a>
                    </td>

                    <?php if ($code == "sns") { ?>
                        <td><?= $row['url1_chk'] ?></td>
                        <td><?= $row['url2_chk'] ?></td>
                        <td><?= $row['url3_chk'] ?></td>
                    <?php } ?>


                    <?php if ($skin != "faq") { ?>
                        <?php if ($code == "sns") { ?>
                            <td>아이디</td>
                        <?php } ?>

                        <td><?= $row[r_date] ?></td>
                    <?php } ?>
                    <td>
                        <a href="board_write.php?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $row[bbs_idx] ?>&pg=<?= $pg ?>"><img
                                    src="/AdmMaster/_images/common/ico_setting2.png" alt="설정"/></a> &nbsp;
                        <a href="javascript:del_chk('<?= $row[bbs_idx] ?>')"><img
                                    src="/AdmMaster/_images/common/ico_error.png" alt="에러"/></a>
                    </td>
                </tr>
                <?php
                $num = $num - 1;
            }
            ?>
            </tbody>
        </table>
    </form>
</div><!-- // listBottom -->
