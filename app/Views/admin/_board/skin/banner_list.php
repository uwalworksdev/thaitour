<div class="listBottom">
    <table cellpadding="0" cellspacing="0" summary="" class="listTable">
    <caption></caption>
    <colgroup>
        <col width="70px" />
        <col width="70px" />
        <col width="500px" />
        <col width="*" />
        <col width="120px" />
        <col width="120px" />
        <col width="130px" />
    </colgroup>
    <thead>
        <tr>
            <th>번호</th>
            <th>순위</th>
            <th>이미지</th>
            <th>코드명</th>
            <th>타이틀</th>
            <th>이미지갯수</th>
            <th>롤링현황</th>
            <th>관리</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($nTotalCount == 0) {

            ?>
            <tr>
                <td colspan=10 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
            </tr>
            <?php
        }
        $num = $nTotalCount - $nFrom;
        foreach ($rows as $row) {
            $img = "";
            $row['subject'] = str_replace('&lt;br class=&#34only_mo&#34&gt;', '', $row['subject']);
            $scategory = $row['category'];
            if ($row["ufile5"]) {
                if (substr(strtolower($row["ufile5"]), -3) == "jpg" || substr(strtolower($row["ufile5"]), -3) == "png" || substr(strtolower($row["ufile5"]), -3) == "gif") {
                    //$img = get_img($row["ufile6"], ROOTPATH . "/public/upload/bbs/", 390, 220);
                    $img = "/uploads/bbs/" . $row["ufile5"];
                }
            } elseif ($youtube_code != "") {
                $img = "http://img.youtube.com/vi/" . $youtube_code . "/hqdefault.jpg";
            } elseif ($row["ufile6"]) {
                if (substr(strtolower($row["ufile6"]), -3) == "jpg" || substr(strtolower($row["ufile6"]), -3) == "png" || substr(strtolower($row["ufile6"]), -3) == "gif") {
                    //$img = get_img($row["ufile5"], ROOTPATH . "/public/upload/bbs/", 390, 220);
                    $img = "/uploads/bbs/" . $row["ufile6"];
                }
            } else {
                $img = getConImg(str_replace("", "", viewSQ($row["contents"])));
            }
            ?>
            <tr style="height:50px">
                <td><?= $num-- ?></td>
                <td>
                    <input type="hidden" name="idx[]" value="<?= $row['bbs_idx'] ?>">
                    <input type="text" name="onum[]" value="<?= $row['onum'] ?>"
                        style="max-width: 50px;text-align: center;padding: 3px;">
                </td>
                <td class="tac">
                    <?php if ($img != '') { ?>
                        <img src="<?= $img ?>" style="width:280px; height:100px;">
                    <?php } else { ?>
                        <p>No Image</p>
                    <?php } ?>
                </td>
                <td class="tal"><?= $row['subject'] ?></td>
                <td class="tal"><?= $row['subject'] ?></td>
                <td class="tac">1</td>
                <td class="tac">사용</td>
                <td>
                    <a href="/AdmMaster/_bbs/board_write/<?= $row['bbs_idx'] ?>?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&pg=<?= $pg ?>"
                        class="btn btn-default">수정</a>
                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>
</div>