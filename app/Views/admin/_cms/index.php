<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <script>
        var r_code = "<?=$r_code;?>";

        var total_cnt = <?=$total_cnt * 1;?>; // 검색된 전체 갯수
        var scale = <?=$scale * 1;?>; // 검색된 전체 갯수
        var page = <?=$page * 1;?>; // 현재 페이지 번호

        var sch_param = "<?=$Cms->sch_param;?>"; // 검색 조건
        var sort_param = "<?=$Cms->sort_param;?>"; // 정렬 조건
    </script>
    <script src="/js/admin/cms/index.js"></script>

    <style>
        .date_pic {
            width: 100px;
            text-align: center;
        }

        .btn_mod, .btn_del {
            margin: 5px;
            cursor: pointer;
        }

        .stock_link {
            color: blue;
            font-weight: bold;
            cursor: pointer;
        }

        #tbl_list tr:hover {
            background: #eee;
        }

        #tbl_list tr td {
            text-align: center;
            padding: 5px;
        }

        #tbl_list tr td.td_str {
            text-align: left;
        }

        #tbl_list tr td.td_num {
            text-align: right;
        }

        #tbl_list button {
            border: 1px solid #999;
            border-radius: 3px;
            background: #f5f5f5;
        }

        #tbl_list .btn:disabled {
            color: #bbb;
            border-color: #ddd;
        }

        #tbl_list .btn_chk {
            cursor: pointer;
        }

        .div_notice {
            padding: 30px 50px;
            text-align: center;
            font-size: 20px;
            line-height: 30px;
            font-weight: bold;
            color: #888;
        }
    </style>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">

                <div class="inner">
                    <h2><?= $code_info['r_title']; ?></h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="#!" class="btn btn-default" onClick="check_all(true);"><span
                                            class="glyphicon glyphicon-ok"></span><span class="txt">전체선택</span></a></li>
                            <li><a href="#!" class="btn btn-default" onClick="check_all(false);"><span
                                            class="glyphicon glyphicon-remove"></span><span class="txt">선택해체</span></a>
                            </li>
                            <li><a href="#!" class="btn btn-danger" onClick="go_del_ok('checked');"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">선택삭제</span></a>
                            </li>
                        </ul>

                        <ul class="last">
                            <li><a href="#!" class="btn btn-primary" onClick="go_form('');"><span
                                            class="glyphicon glyphicon-pencil"></span> <span class="txt">글 등록</span></a>
                            </li>
                        </ul>
                    </div>

                </div><!-- // inner -->

            </header><!-- // headerContainer -->

            <div id="contents">

                <div class="listWrap">
                    <!-- 안내 문구 필요시 구성 //-->

                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <span id="str_total_cnt"><?= number_format($total_cnt) ?></span>개의 목록이
                                있습니다.</p>
                        </div>

                        <div class="right">
                            <form name="search" id="frm_sch" method="get" action="<?= $_SERVER['PHP_SELF']; ?>">
                                <!-- ajax 호출용 -->
                                <input type="hidden" name="call_type" value="ajax">
                                <input type="hidden" name="data_type" value="json">
                                <input type="hidden" name="cmd" value="ajax_get_list">

                                <!-- 정렬 -->
                                <input type="hidden" name="sort_item" value="">
                                <input type="hidden" name="sort_dir" value="">

                                <!-- 페이지 -->
                                <input type="hidden" name="start" value="0">
                                <input type="hidden" name="scale" value="<?= $scale; ?>">
                                <input type="hidden" name="page" value="<?= $page; ?>">

                                <header id="headerContents">
                                    <select name="scale" id="scale">
                                        <option <?php if ($scale == "25") echo "selected"; ?> value="25">25개씩 표시</option>
                                        <option <?php if ($scale == "50") echo "selected"; ?> value="50">50개씩 표시</option>
                                        <option <?php if ($scale == "100") echo "selected"; ?> value="100">100개씩 표시
                                        </option>
                                    </select>
                                    &nbsp;
                                    상태 :
                                    <select name="sch_status">
                                        <option value="">전체</option>
                                        <option <?php if ($sch_status == "Y") echo "selected"; ?> value="Y">정상</option>
                                        <option <?php if ($sch_status == "N") echo "selected"; ?> value="N">잠김</option>
                                    </select>
                                    &nbsp;
                                    <select name="sch_item" style="height:30px;">
                                        <option <?php if ($sch_item == "all") echo "selected"; ?> value="all">전체</option>
                                        <?php if ($code_info['r_use_name'] == "Y") { ?>
                                            <option <?php if ($sch_item == "r_name") echo "selected"; ?> value="r_name">
                                                작성자
                                            </option>
                                        <?php } ?>
                                        <?php if ($code_info['r_use_title'] == "Y") { ?>
                                            <option <?php if ($sch_item == "r_title") echo "selected"; ?> value="r_title">
                                                제목
                                            </option>
                                        <?php } ?>
                                        <?php if ($code_info['r_use_desc'] == "Y") { ?>
                                            <option <?php if ($sch_item == "r_desc") echo "selected"; ?> value="r_desc">
                                                요약
                                            </option>
                                        <?php } ?>
                                        <?php if ($code_info['r_use_content'] == "Y") { ?>
                                            <option <?php if ($sch_item == "r_content") echo "selected"; ?>
                                                    value="r_content">내용
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <input type="text" name="sch_value" value="<?= $sch_value ?>"
                                           class="input_txt placeHolder" rel="" style="width:150px; line-height:28px;"/>

                                    <a href="javascript:go_sch();" class="btn btn-default"><span
                                                class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                                </header><!-- // headerContents -->
                            </form>
                        </div>
                    </div><!-- // listTop -->

                    <div class="listBottom">
                        <table id="tbl_list" class="listTable">
                            <colgroup>
                                <col style="width:15px;">
                                <col style="width:50px;">
                                <?php if ($code_info['r_use_content'] == "Y") { ?>
                                    <col style="width:350px;">
                                <?php } ?>
                                <?php if ($code_info['r_use_type'] == "Y") { ?>
                                    <col style="width:150px;">
                                <?php } ?>
                                <?php if ($code_info['r_use_title'] == "Y") { ?>
                                    <col style="width:auto;">
                                <?php } ?>
                                <?php if ($code_info['r_use_name'] == "Y") { ?>
                                    <col style="width:200px;">
                                <?php } ?>
                                <?php if ($code_info['r_use_s_date'] == "Y") { ?>
                                    <col style="width:150px;">
                                <?php } ?>
                                <?php if ($code_info['r_use_e_date'] == "Y") { ?>
                                    <col style="width:150px;">
                                <?php } ?>
                                <?php if ($code_info['r_use_file'] == "Y") { ?>
                                    <col style="width:200px;">
                                <?php } ?>
                                <col style="width:150px;">
                                <col style="width:80px;">
                            </colgroup>
                            <thead>
                            <tr>
                                <th><input type="checkbox" onClick="check_all(this.checked);"></th>
                                <th>No</th>
                                <?php if ($code_info['r_use_content'] == "Y") { ?>
                                    <th data-item="T.r_content">이미지</th>
                                <?php } ?>
                                <?php if ($code_info['r_use_type'] == "Y") { ?>
                                    <th data-item="T.r_type">구분</th>
                                <?php } ?>
                                <?php if ($code_info['r_use_title'] == "Y") { ?>
                                    <th data-item="T.r_title">제목</th>
                                <?php } ?>
                                <?php if ($code_info['r_use_name'] == "Y") { ?>
                                    <th data-item="T.r_name">작성자</th>
                                <?php } ?>
                                <?php if ($code_info['r_use_s_date'] == "Y") { ?>
                                    <th data-item="T.r_s_date">시작일</th>
                                <?php } ?>
                                <?php if ($code_info['r_use_e_date'] == "Y") { ?>
                                    <th data-item="T.r_e_date">종료일</th>
                                <?php } ?>
                                <?php if ($code_info['r_use_file'] == "Y") { ?>
                                    <th data-item="T.r_file_name">첨부파일</th>
                                <?php } ?>
                                <th>작성일</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0, $no = $total_cnt - $start; $i < $list_cnt; $i++, $no--) {
                                $row = $list_arr[$i]; ?>
                                <tr data-idx="<?= $row['r_idx']; ?>">
                                    <td class="td_check"><input type="checkbox" class="check_idx"
                                                                value="<?= $row['r_idx']; ?>"></td>
                                    <td class="td_no"><?= $no; ?></td>
                                    <?php
                                    $htmlContent = $row['r_content'];
                                    preg_match('/<img[^>]+>/i', $htmlContent, $matches);
                                    ?>
                                    <?php if ($code_info['r_use_content'] == "Y") { ?>
                                        <td class="td_type">
                                            <div class="td_type_tit"><?php
                                                if (!empty($matches)) {
                                                    $imgTag = $matches[0];
                                                    echo $imgTag;
                                                } else {
                                                    echo "";
                                                }
                                                ?></div>
                                        </td>
                                    <?php } ?>
                                    <?php if ($code_info['r_use_type'] == "Y") { ?>
                                        <td class="td_type">
                                            <?= $type_arr[$row['r_type']]; ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($code_info['r_use_title'] == "Y") { ?>
                                        <td class="td_title"><?= $row['r_title']; ?></td>
                                    <?php } ?>
                                    <?php if ($code_info['r_use_name'] == "Y") { ?>
                                        <td class="td_name"><?= $row['r_name']; ?></td>
                                    <?php } ?>
                                    <?php if ($code_info['r_use_s_date'] == "Y") { ?>
                                        <td class="td_s_date"
                                            title="<?= $row['r_s_date']; ?>"><?= substr($row['r_s_date'], 0, 10); ?></td>
                                    <?php } ?>
                                    <?php if ($code_info['r_use_e_date'] == "Y") { ?>
                                        <td class="td_e_date"
                                            title="<?= $row['r_e_date']; ?>"><?= substr($row['r_e_date'], 0, 10); ?></td>
                                    <?php } ?>
                                    <?php if ($code_info['r_use_file'] == "Y") { ?>
                                        <td class="td_file_name"><?= $row['r_file_name']; ?></td>
                                    <?php } ?>
                                    <td class="td_date"
                                        title="<?= $row['r_date']; ?>"><?= substr($row['r_date'], 0, 10); ?></td>
                                    <td class="td_control">
                                        <img src="/images/admin/common/ico_setting2.png" class="btn_mod" alt="관리">
                                        <img src="/images/admin/common/ico_error.png" class="btn_del" alt="삭제">
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <?php
                    // 페이지 목록
                    $start_page = (floor(($page - 1) / $page_cnt) * $page_cnt) + 1;
                    $end_page = $start_page + $page_cnt - 1;
                    if ($end_page > $total_page) $end_page = $total_page;

                    $prev_page = ($start_page > 1) ? $start_page - 1 : 1;
                    $next_page = ($end_page < $total_page) ? $end_page + 1 : $total_page;
                    ?>
                    <div class='paging mt30'>
                        <ul>
                            <li class='first'><a href='javascript: go_page(1);' title='Go to next page'>&lt;&lt; 처음</a>
                            </li>
                            <li class='prev'><a href='javascript: go_page(<?= $prev_page; ?>);'
                                                title='Go to first page'>&lt; 이전</a></li>
                            <?php for ($p = $start_page; $p <= $end_page; $p++) { ?>
                                <li class="<?php if ($p == $page) echo "active"; ?>"><a
                                            href="javascript: go_page(<?= $p; ?>);"
                                            title='Go to <?= $p; ?> page'><?= $p; ?></a></li>
                            <?php } ?>
                            <li class='next'><a href='javascript: go_page(<?= $next_page; ?>);' title='Go to next page'>다음
                                    &gt;</a></li>
                            <li class='last'><a href='javascript: go_page(<?= $total_page; ?>);'
                                                title='Go to last page'>맨끝 &gt;&gt;</a></li>
                        </ul>
                    </div>
                    <br>
                    <br>

                    <div id="headerContainer">
                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                    <li><a href="#!" class="btn btn-default" onClick="check_all(true);"><span
                                                    class="glyphicon glyphicon-ok"></span><span class="txt">전체선택</span></a>
                                    </li>
                                    <li><a href="#!" class="btn btn-default" onClick="check_all(false);"><span
                                                    class="glyphicon glyphicon-remove"></span><span
                                                    class="txt">선택해체</span></a></li>
                                    <li><a href="#!" class="btn btn-danger" onClick="go_del_ok('checked');"><span
                                                    class="glyphicon glyphicon-trash"></span><span
                                                    class="txt">선택삭제</span></a></li>
                                </ul>

                                <ul class="last">
                                    <li><a href="#!" class="btn btn-primary" onClick="go_form('');"><span
                                                    class="glyphicon glyphicon-pencil"></span> <span
                                                    class="txt">글 등록</span></a></li>
                                </ul>
                            </div>
                        </div><!-- // inner -->
                    </div><!-- // headerContainer -->

                </div>
            </div>

        </div><!-- print_this -->
    </div><!-- container -->

<?= $this->endSection() ?>