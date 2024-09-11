<div class="listBottom">
    <div class="">
        <?php if ($is_category == "Y"): ?>
            <select name="category" class="input_select">
                <option value="">선택</option>
                <?php foreach ($categories as $frow): ?>
                    <option value="<?= $frow['tbc_idx'] ?>" <?= $frow['tbc_idx'] == $category ? 'selected' : '' ?>>
                        <?= $frow['subject'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>
    <script type="text/javascript">
        $(function(){
            $("select[name='category']").change(function(){
                var cate = $(this).val();
                location.href = "?code=<?= $code ?>&scategory=" + cate;
            });
        });
    </script>
    <form name="lfrm" id="lfrm">
        <table cellpadding="0" cellspacing="0" summary="" class="listTable schedule">
            <caption></caption>
            <colgroup>
                <col width="5%" />
                <col width="5%" />
                <?php if ($is_category == "Y"): ?>
                    <col width="10%" />
                <?php endif; ?>
                <?php if ($code == "news" || $code == "hashtag"): ?>
                    <col width="30%" />
                <?php endif; ?>
                <col width="*" />
                <?php if ($code == "sns"): ?>
                    <col width="5%" />
                    <col width="5%" />
                    <col width="5%" />
                <?php endif; ?>
                <?php if ($skin != "faq"): ?>
                    <?php if ($code == "sns"): ?>
                        <col width="8%" />
                    <?php endif; ?>
                    <col width="10%" />
                <?php endif; ?>
                <col width="6%" />
            </colgroup>
            <thead>
                <tr>
                    <th>선택</th>
                    <th>번호</th>
                    <?php if ($is_category == "Y"): ?>
                        <th>구분</th>
                    <?php endif; ?>
                    <?php if ($code == "news" || $code == "hashtag"): ?>
                        <th>사진</th>
                    <?php endif; ?>
                    <th>제목</th>
                    <?php if ($code == "sns"): ?>
                        <th>인스타</th>
                        <th>페이스북</th>
                        <th>유튜브</th>
                    <?php endif; ?>
                    <?php if ($skin != "faq"): ?>
                        <?php if ($code == "sns"): ?>
                            <th>아이디</th>
                        <?php endif; ?>
                        <th>작성일</th>
                    <?php endif; ?>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $num = $nTotalCount - $nFrom;
                foreach ($rows as $row): 
                    $nums = $row['notice_yn'] == "Y" ? "Notice" : $num;
                    $newStr = $row['is_new'] ? "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />" : "";
                                        $recStr = $row['recomm_yn'] == "Y" ? "<font color=red>[추천]</font>" : "";
                    $rstr = str_repeat("&nbsp;&nbsp;", $row['b_level']) . ($row['b_level'] > 0 ? "ㄴ" : "");
                    $c_cnt = $row['comment_cnt'] > 0 ? "(" . $row['comment_cnt'] . ")" : "";
                    $secureStr = $row['secure_yn'] == "Y" ? "<img src='/img/ico/ico_lock.png'>" : "";
                ?>
                <tr>
                    <td><input type="checkbox" name="bbs_idx[]" value="<?= $row['bbs_idx'] ?>" class="bbs_idx input_check" /></td>
                    <td><?= $nums ?></td>
                    <?php if ($is_category == "Y"): ?>
                        <td><?= $row['category'] ?></td>
                    <?php endif; ?>
                    <?php if ($code == "news" || $code == "hashtag"): ?>
                        <td><img src="../../data/bbs/<?= $row['ufile1'] ?: "panda.jpg" ?>" /></td>
                    <?php endif; ?>
                    <td class="<?= $code != "hashtag" ? "tal" : "" ?> bold txt_black">
                        <?= $rstr ?><a href="board_view.php?scategory=<?= $scategory ?>&search_mode=<?= $search_mode ?>&search_word=<?= $search_word ?>&code=<?= $code ?>&bbs_idx=<?= $row['bbs_idx'] ?>&pg=<?= $pg ?>">
                            <?= $recStr ?> <?= $row['subject'] ?> <?= $secureStr ?> <?= $c_cnt ?>
                        </a>
                    </td>
                    <?php if ($code == "sns"): ?>
                        <td><?= $row['url1_chk'] ?></td>
                        <td><?= $row['url2_chk'] ?></td>
                        <td><?= $row['url3_chk'] ?></td>
                    <?php endif; ?>
                    <?php if ($skin != "faq"): ?>
                        <td><?= $row['r_date'] ?></td>
                    <?php endif; ?>
                    <td>
                        <a href="board_write?code=<?= esc($code) ?>&bbs_idx=<?= $row['bbs_idx'] ?>"><img src="/images/admin/common/ico_setting2.png"></a>
                        <a href="javascript:del_it('<?= $row['m_idx'] ?>');"><img src="/images/admin/common/ico_error.png" alt="삭제" /></a>
                    </td>
                </tr>
                <?php $num--; endforeach; ?>
            </tbody>
        </table>
    </form>
</div><!-- // listBottom -->
