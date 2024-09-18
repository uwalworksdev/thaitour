<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<div id="container">
    <div id="print_this">
        <!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2><?= $board_name ?></h2>
                <div class="menus">
                    <ul class="first">
                        <li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), true)" class="btn btn-success">전체선택</a></li>
                        <li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), false)" class="btn btn-success">선택해체</a></li>
                        <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                    </ul>
                    <ul class="last">
                        <?php if ($code == "banner" || $code == "event" || $code == "main_event" || $code == "awards") { ?>
                            <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                        <?php } ?>
                        <li><a href="board_write?code=<?= esc($code) ?>&scategory=<?= esc($scategory) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a></li>
                    </ul>
                </div>
            </div>
        </header>


        <div id="contents">
            <form name="frmSearch" method="GET">
                <input type="hidden" name="code" value="<?= esc($code) ?>">
                <input type="hidden" name="scategory" value="<?= esc($scategory) ?>">
                <header id="headerContents">
                    <p>
                        <?php if ($is_category == "Y") { ?>
                        <!-- Category selection logic here -->
                        <?php } ?>

                        <input type="radio" name="search_mode" value="" <?php if ($search_mode == "") echo "checked"; ?>>
                        전체 &nbsp; &nbsp;
                        <input type="radio" name="search_mode" value="subject" <?php if ($search_mode == "subject") echo "checked"; ?>> 제목 &nbsp; &nbsp;
                        <input type="radio" name="search_mode" value="contents" <?php if ($search_mode == "contents") echo "checked"; ?>> 내용 &nbsp; &nbsp;
                        <input type="radio" name="search_mode" value="writer" <?php if ($search_mode == "writer") echo "checked"; ?>> 작성자 &nbsp; &nbsp;
                        <input type="text" name="search_word" value='<?= esc($search_word) ?>' class="input_txt placeHolder" style="width:240px" />

                        <?php if ($code == "awards") { ?> 
                            <select name="scategory" class="input_select">
                                <option value="">선택</option>
                                <?php
                                // Fetch categories from database
                                ?>
                            </select>
                        <?php } ?>

                        <a href="javascript:document.frmSearch.submit();" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                    </p>
                </header>
            </form>
            <!-- Additional content and logic for displaying lists -->

            <div class="listWrap">
                <div class="listTop">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= esc($nTotalCount) ?>개의 목록이 있습니다.</p>
                    </div>
                </div>

                <?php if (in_array($skin, ['gallery', 'media', 'event']) || $code == 'main_event' || $code == 'awards'): ?>
                <?= $this->include('admin/_board/photo') ?>
                <?php elseif ($code == 'qna'): ?>
                    <?= $this->include('admin/_board/list2') ?>
                <?php else: ?>
                    <?= $this->include('admin/_board/list1') ?>
                <?php endif; ?>

                <?= ipageListing($pg, $nPage, $g_list_rows, current_url() . "?scategory=$scategory&search_mode=$search_mode&search_word=$search_word&code=$code&pg=") ?>
            </div>
        </div>
    </div>
</div>

<script>
// JavaScript functions for CheckAll, SELECT_DELETE, etc.
</script>
<?= $this->endSection() ?>
