<div class="listBottom">
    <form name=lfrm id=lfrm>
        <table cellpadding="0" cellspacing="0" summary="" class="listTable schedule">
            <caption></caption>
            <colgroup>
                <col width="5%"/>
                <col width="5%"/>
                <col width="*"/>
                <?php use App\Controllers\BoardController;

                if ($skin != "faq") { ?>
                    <col width="10%"/>
                    <col width="8%"/>
                    <col width="12%"/>
                    <col width="7%"/>
                <?php } ?>
                <col width="7%"/>
            </colgroup>
            <thead>
            <tr>
                <th>선택</th>
                <th>번호</th>
                <th>제목</th>
                <?php if ($skin != "faq") { ?>
                    <th>작성자</th>
                    <th>첨부파일</th>
                    <th>작성일</th>
                    <th>조회</th>
                <?php } ?>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($result as $row) {

                if ($row['notice_yn'] == "Y") {
                    $nums = "Notice";
                } else {
                    $nums = $num;
                }
                $newStr = "";

                $boardController = new BoardController();
                $newStr2 = $boardController->listNew(24, $row['r_date']);
                if ($newStr2 == 0) {
                    $newStr = "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />";
                }

                $recStr = "";
                if ($row['recomm_yn'] == "Y") {
                    $recStr = "<font color=red>[추천]</font>";
                }
                $file_chk = "N";
                for ($i = 1; $i <= 5; $i++) {
                    if ($row["rfile" . $i]) {
                        $file_chk = "Y";
                    }
                }
                $rstr = "";
                for ($i = 1; $i <= $row['b_level']; $i++) {
                    $rstr = $rstr . "&nbsp;&nbsp;";
                }
                if ($row['b_level'] > 0) {
                    $rstr = $rstr . "ㄴ";
                }
                $c_cnt = "";
                if ($row['comment_cnt'] > 0) {
                    $c_cnt = "(" . $row['comment_cnt'] . ")";
                }
                $secureStr = "";
                if ($row['secure_yn'] == "Y") {
                    $secureStr = "<img src='/img_board/icon_key.gif'>";
                }
                ?>
                <tr style="height:40px">
                    <td><input type="checkbox" id="" name="bbs_idx[]" value="<?= $row['bbs_idx'] ?>"
                               class="bbs_idx input_check" <?= $row["m_idx"] == $_SESSION['member']['idx'] || $_SESSION['member']['id'] == "admin" ? "" : "disabled" ?> />
                    </td>
                    <td><?= $nums ?></td>
                    <td class="tal bold txt_black"><?= $rstr ?><a
                                href="board_view?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $row['bbs_idx'] ?>&pg=<?= $pg ?>">
                            <?php if ($is_category == "Y") { ?>
                                <?php if ($row['category'] != "") {
                                    echo "[" . $row['category'] . "]";
                                } ?>
                            <?php } ?>
                            <?= $recStr ?> <?= $row['subject'] ?> <?= $secureStr ?>
                            <?= $c_cnt ?>
                        </a>
                    </td>
                    <?php if ($skin != "faq") { ?>
                        <td class="bold"><?= $row['writer'] ?></td>
                        <td>
                            <?php if ($file_chk == "Y") { ?>
                                <img src="/images/admin/content/icon_file.png" alt="파일"/>
                            <?php } ?>
                        </td>
                        <td><?= $row['r_date'] ?></td>
                        <td><?= $row['hit'] ?></td>
                    <?php } ?>
                    <td>
                        <?php if ($row["m_idx"] == $_SESSION['member']['idx'] || $_SESSION['member']['id'] == "admin") { ?>
                            <a href="board_write?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $row['bbs_idx'] ?>&pg=<?= $pg ?>"><img
                                        src="/images/admin/common/ico_setting2.png" alt="설정"/></a> &nbsp;
                            <a href="javascript:del_chk('<?= $row['bbs_idx'] ?>')"><img
                                        src="/images/admin/common/ico_error.png" alt="에러"/></a>
                        <?php } ?>
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
