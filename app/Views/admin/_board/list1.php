<div class="listBottom">
    <div class="">
        <?php if ($is_category == "Y"): ?>
            <select name="category" class="input_select">
                <option value="">선택</option>
                <?php foreach ($categories as $frow): ?>
                    <option value="<?= $frow['tbc_idx'] ?>" <?= $frow['tbc_idx'] == $scategory ? 'selected' : '' ?>>
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
                    <?php
                    $titles = BBS_LIST_CONFIG[$code]['titles'] ?? [];
                    foreach ($titles as $key => $val):
                        $width = BBS_LIST_CONFIG[$code]['widths'][$key];
                    ?>
                        <col width="<?=$width?>" />
                    <?php endforeach; ?>
                <col width="6%" />
            </colgroup>
            <thead>
                <tr>
                    <th>선택</th>
                    <th>번호</th>
                    <?php foreach ($titles as $key => $val): ?>
                        <th><?= $val ?></th>
                    <?php endforeach; ?>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $num = $nTotalCount - $nFrom;
                if($nTotalCount == 0){
                    if($code == "faq"){
                        $colspan = 5;
                    }
                ?>  
                <tr>
                    <td colspan="<?=$colspan?>">검색한 결과가 없습니다</td>
                </tr>  
                <?php
                    }
                foreach ($rows as $row): 
                    $nums = $row['notice_yn'] == "Y" ? "Notice" : $num;
                    $newStr = $row['is_new'] ? "<img src=\"/img_board/new.gif\" style=\"margin:1px 3px 0 5px;\" alt=\"신규게시물\" />" : "";
                                        $recStr = $row['recomm_yn'] == "Y" ? "<font color=red>[추천]</font>" : "";
                    $rstr = str_repeat("&nbsp;&nbsp;", $row['b_level']) . ($row['b_level'] > 0 ? "ㄴ" : "");
                    $c_cnt = $row['comment_cnt'] > 0 ? "(" . $row['comment_cnt'] . ")" : "";
                    $secureStr = $row['secure_yn'] == "Y" ? "<img src='/img/ico/ico_lock.png'>" : "";
                ?>
                <tr>
                    <td>
                        <input type="hidden" name="idx[]" value="<?= $row['bbs_idx'] ?>">    
                        <input type="checkbox" name="bbs_idx[]" value="<?= $row['bbs_idx'] ?>" class="bbs_idx input_check" />
                    </td>
                    <td><?= $nums ?></td>
                    <?php foreach ($titles as $key => $val):
                        $name = BBS_LIST_CONFIG[$code]['names'][$key];
                        ?>
                        <td class="pd10">
                            <?= view("admin/_board/list_field", ['info' => $row, 'key' => $key]) ?>
                        </td>
                    <?php endforeach; ?>
                    <td>
                        <a href="/AdmMaster/_bbs/board_write/<?= $row['bbs_idx'] ?>?code=<?= esc($code) ?>"><img src="/images/admin/common/ico_setting2.png"></a>
                        <a href="javascript:del_it('<?= $row['bbs_idx'] ?>');"><img src="/images/admin/common/ico_error.png" alt="삭제" /></a>
                    </td>
                </tr>
                <?php $num--; endforeach; ?>
            </tbody>
        </table>
    </form>
</div><!-- // listBottom -->
