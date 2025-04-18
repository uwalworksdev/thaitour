<form name=lfrm id=lfrm>
    <ul class="gallery-wrap" style="text-align:center;width:1500px; margin: 0 auto;">

        <?php
        foreach ($rows as $row) {

            if ($row['notice_yn'] == "Y") {
                $nums = "Notice";
            } else {
                $nums = $num;
            }

            $recStr = "";
            if ($row['recomm_yn'] == "Y") {
                $recStr = "<font color=red>[추천]</font>";
            }
            $file_chk = "N";
            $img = "";
            $url = "";
            $youtubes = explode("https://youtu.be/", $row["url"]);
            $youtube_codes = explode("?", $youtubes[1]);
            $youtube_code = $youtube_codes[0];

            $row["subject"] = str_replace('&lt;br class=&#34only_mo&#34&gt;', '', $row["subject"]);
            $scategory = $row['category'];

            if ($row["ufile6"]) {
                if (substr(strtolower($row["ufile6"]), -3) == "jpg" || substr(strtolower($row["ufile6"]), -3) == "png" || substr(strtolower($row["ufile6"]), -3) == "gif") {
                    $img = "/data/bbs/" . $row["ufile6"]; //get_img($row["ufile6"], "/data/bbs/", 390, 220);
                }
            } elseif ($youtube_code != "") {
                $img = "http://img.youtube.com/vi/" . $youtube_code . "/hqdefault.jpg";
            } elseif ($row["ufile1"]) {
                if (substr(strtolower($row["ufile1"]), -3) == "jpg" || substr(strtolower($row["ufile1"]), -3) == "png" || substr(strtolower($row["ufile1"]), -3) == "gif") {
                    $img = "/data/bbs/" . $row["ufile1"]; //get_img($row["ufile1"], "/data/bbs/", 390, 220);
                }
            } else {
                $img = getConImg(str_replace("", "", viewSQ($row["contents"])));
            }
            ?>
            <li class="gallery-list" style="width:280px" rel="<?= $row['b_ref'] ?>">
                <a href="/AdmMaster/_bbs/board_write/<?= $row['bbs_idx'] ?>?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&pg=<?= $pg ?>">
                    <p class="pic" style="width:280px"><img src="<?= $img ?>" alt="<?= $row['subject'] ?>"></p>
                    <p class="pic-info">
                        <input type="checkbox" id="" name="bbs_idx[]" value="<?= $row['bbs_idx'] ?>"
                               class="bbs_idx input_check"/>
                        <span style="display: inline-block; width: 180px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;">
												<?= $row['subject'] ?>
											</span>
                        <?php if ($code == "event") {
                            ?>
                            <br/>(<?= $row['s_date'] ?> ~ <?= $row['e_date'] ?>)
                            <?php
                        } ?>
                    </p>
                </a>
                <input type="text" name="onum[]" value="<?= $row['onum'] ?>" style="width:60px;"/>
                <input type="hidden" name="code_idx[]" value="<?= $row["bbs_idx"] ?>" class="input_txt"/>
            </li>


            <?php
            $num = $num - 1;
        }
        ?>
    </ul>
</form>