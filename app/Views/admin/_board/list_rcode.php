<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script>
    var r_code = "<?= $r_code; ?>";
    var total_cnt = <?= $total_cnt * 1; ?>;
    var scale = <?= $scale * 1; ?>;
    var page = <?= $page * 1; ?>;
    var sch_param = "<?= $Bbs->sch_param; ?>";
    var sort_param = "<?= $Bbs->sort_param; ?>";
</script>
<script src="index.js"></script>

<style>
    /* Your existing styles here */
</style>

<div id="container">
    <span id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2><?= $code_info['r_title']; ?></h2>
                <div class="menus">
                    <!-- Your existing menu code here -->
                </div>
            </div>
        </header>

        <div id="contents">
            <div class="listWrap">
                <div class="listTop">
                    <div class="left">
                        <p class="schTxt">■ 총 <span id="str_total_cnt"><?= number_format($total_cnt) ?></span>개의 목록이 있습니다.</p>
                    </div>
                    <div class="right">
                        <form name="search" id="frm_sch" method="get" action="<?= current_url(); ?>">
                            <!-- Your existing search form code here -->
                        </form>
                    </div>
                </div>

                <form name="lfrm" id="lfrm">
                    <div class="listBottom">
                        <table id="tbl_list" class="listTable">
                            <colgroup>
                                <!-- Your existing colgroup here -->
                            </colgroup>
                            <thead>
                                <!-- Your existing thead here -->
                            </thead>
                            <tbody>
                                <?php for ($i = 0, $no = $list_cnt; $i < $list_cnt; $i++, $no--): ?>
                                    <?php $row = $list_arr[$i]; ?>
                                    <tr data-idx="<?= $row['r_idx']; ?>">
                                        <!-- Your existing row code here -->
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </form>

                <div class='paging mt30'>
                    <!-- Your existing pagination code here -->
                </div>

                <div id="headerContainer">
                    <div class="inner">
                        <div class="menus">
                            <!-- Your existing menus here -->
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </span>
</div>

<?= $this->endSection() ?>