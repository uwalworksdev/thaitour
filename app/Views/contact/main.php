<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/inquiry/inquiry.css" rel="stylesheet" type="text/css" />
<link href="/css/inquiry/inquiry_responsive.css" rel="stylesheet" type="text/css" />
<div id="container" class="sub list_container">
    
    <section class="inquiry_section">
        <div class="inner">
            <?php if($visual['ufile6']) { ?>
                <div class="sub_visual" style="background-image: url('<?= $visual['ufile6']?>');"></div>
			<?php } else { ?>
                <div class="sub_visual" style="display: none"></div>
            <?php } ?>
            <div class="sect_ttl_box">
                <h2>문의하기</h2>
            </div>
            <div class="flex notice_search">
                <form name="search" id="search">
                    <div class="evaluate_search flex">
                        <select id="" name="search_category" class="evaluate_filter_selection">
						<option value="title" <?php if ($search_category == "title") {
													echo "selected";
												} ?>>제목</option>
                        <option value="contents" <?php if ($search_category == "contents") {
														echo "selected";
													} ?>>내용</option>
						<option value="user_name" <?php if ($search_category == "user_name") {
														echo "selected";
													} ?>>글쓴이</option>
					</select>

                        <input type="text" name="s_txt" value="<?= $s_txt ?>">
                        <button class="search_button" type="button" onclick="search_it()">검색</button>
                    </div>
                </form>
            </div>
            <script>
            function search_it() {
                var frm = document.search;
                frm.submit();
            }
        </script>
            <table class="bs_table">
                <colgroup>
                <col width="80px">
                    <col width="*">
                    <col width="110px">
                    <col width="110px">
                </colgroup>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$page) {
                        $page = 1;
                    }
    
                    
                    if ($total_cnt == 0) {
                        ?>
                        <tr>
                            <td colspan= "4" style="width: 100%;text-align:center;height:100px">검색된 결과가 없습니다.</td>
                        </tr>
                        <?php
					}
                    $now = strtotime(date("Y-m-d H:i:s"));
                    foreach ($list_contact as $row) {
    
                    $time = strtotime($row['r_reg_date']);
                    $diff_time = $now - $time;
                    $is_new = $diff_time < (24 * 60 * 60) ? "<i></i>" : "";
                    ?>
                    <tr>
                        <td class="num"><?=$no?></td>
                        <td class="subject">
                            <?php
                            if ((session('member.idx') && $row["reg_m_idx"] == session('member.idx')) 
                                    || (session('member.idx') && session('member.id') == 'admin')
                                    || (session('member.idx') && session('member.level') <= 2)) {
                                echo "<a href='/contact/view?idx=$row[idx]'>$row[title]</a> <span class='red'>($row[cmt_cnt])</span>";
                            } else {
                                $message = !session('member.idx') ? "로그인을 해주세요!" : "내가쓴글만 열람이 가능합니다.";
                                echo "<a href='#' onclick='alert(`$message`);'>$row[title]</a><span class='red'>($row[cmt_cnt])</span><i></i>";
                            }
                            ?>
                        </td>
                        <td class="name"><?=strAsterisk(sqlSecretConver($row['user_name'], 'decode'))?></td>
                        <td class="date date_travel"><?=date("Y.m.d", strtotime($row['r_date']))?></td>
                    </tr>
                    <?php
                        $no--;
                    }
                    ?>
                </tbody>
            </table>
    
            <div class="paging_wrap">
                <?php echo ipageListing2($page, $total_page, 10, $currentUri."?page=",$deviceType) ?>
                <a href="/contact/write" class="btn btn-lg btn-point contact_btn">문의하기</a>
            </div>
    
            <div class="popup_wrap edit_input_pop">
                <form id="view_inquiry_frm" class="pop_box" action="./inquiry_view" method="post">
                    <button type="button" class="close" onclick="closePopup()"></button>
                    <div class="pop_body">
                        <div class="padding">
                            <div class="pop_txt">
                                <p>비밀번호를 입력해주세요.</p>
                            </div>
                            <div class="pop_input flex_c_c">
                                <input type="text" name="pw" id="pw">
                            </div>
                            <div class="pop_input flex_c_c">
                                <button type="button" class="default_btn" onclick="closePopup()">취소</button>
                                <button type="submit" class="default_btn">확인</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="dim"></div>
            </div>
        </div>
    </section>
</div>

<script>
    function showCheckPass(idx) {
        $("#view_inquiry_frm").attr("action", `./inquiry_view?idx=${idx}`)
        $('.edit_input_pop').show();
    }

    function closePopup() {
        $('.popup_wrap').hide();
    }
</script>
<?php $this->endSection(); ?>
