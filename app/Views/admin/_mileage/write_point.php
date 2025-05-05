<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2>항목별지급</h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_mileage/list" class="btn btn-default"><span
                                    class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        </li>
                        <li><a href="javascript:send_it()" class="btn btn-default"><span
                                    class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
                    </ul>
                </div>
            </div>
            <!-- // inner -->

        </header>
        <!-- // headerContainer -->

        <form name="frm" id="frm" action="write_point_ok" method="post" enctype="multipart/form-data">
            <div class="listBottom">
                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="table-layout: fixed;">
                    <caption>
                    </caption>
                    <colgroup>
                        <col width="150px" />
                        <col width="35%" />
                        <col width="150px" />
                        <col width="*" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>새로운 회원</th>
                            <td colspan="3">
                                <input type="text" id="member_point" name="member_point"
                                    value="<?= $row['member_point'] ?? 0 ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="input_txt placeHolder"
                                    style="width:250px" />
                            </td>
                        </tr>

                        <tr>
                            <th>새로운 회원</th>
                            <td colspan="3">
                                <input type="text" id="review_point" name="review_point"
                                    value="<?= $row['review_point'] ?? 0 ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="input_txt placeHolder"
                                    style="width:250px" />
                            </td>
                        </tr>

                        <tr>
                            <th>새로운 회원</th>
                            <td colspan="3">
                                <input type="text" id="comment_point" name="comment_point"
                                    value="<?= $row['comment_point'] ?? 0 ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="input_txt placeHolder"
                                    style="width:250px" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->
<script>
    function send_it() {
        var frm = document.frm;
        frm.submit();
    }
</script>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>