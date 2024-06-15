<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<div id="container" class="sub contact">
    
    <section class="notice_sect">
        <div class="inner">
            <div class="sect_ttl_box">
                <h2>공지사항</h2>
            </div>
            <div class="flex notice_search">
                <form name="search" id="search">
                    <div class="evaluate_search flex">
                        <select name="search_mode" class="evaluate_filter_selection">
                            <option value="subject" <?php if ($search_mode == "subject") echo "selected";  ?>>제목</option>
                            <option value="contents" <?php if ($search_mode == "contents") echo "selected"; ?>>내용</option>
                        </select>
                        <input type="text" name="search_word" value="<?= $search_word ?>">
                        <button class="search_button" type="button" onclick="search_it()">검색</button>
                    </div>
                </form>
            </div>
            <table class="bs_table">
                <colgroup>
                    <col width="80px">
                    <col width="*">
                    <col width="110px">
                </colgroup>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>제목</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($b2b_notice_list as $row) {
                    ?>
                        <tr class="<?php if ($row['notice_yn'] == "Y") echo "notice_tr"; ?>">
                            <td class="num" ><?php if ($row['notice_yn'] !== "Y") echo $no ?> <?php if ($row['notice_yn'] == "Y") echo "공지"?></td>
                            <td class="subject" style=" <?php if ($row['notice_yn'] == "Y") echo"font-weight:700;" ?>"><a href="announcement_view?bbs_idx=<?= $row['bbs_idx'] ?>"><?= $row['subject'] ?></a></td>
                            <td class="date"><?= substr($row['r_date'], 0, 10) ?></td>
                        </tr>
                    <?php
						$no--;
                    }
                    ?>
                </tbody>
            </table>
    
            <div class="paging_wrap"><?php echo ipageListing2($page, $total_page, $total_cnt, $_SERVER['PHP_SELF'] . "?category=$category&page=") ?></div>
    
        </div>
    </section>
</div>
<script>
        function search_it() {
        var frm = document.search;
        frm.submit();
    }
</script>
<?php $this->endSection(); ?>
