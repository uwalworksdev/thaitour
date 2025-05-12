<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <div id="container">
        <span id="print_this"><!-- 인쇄영역 시작 //-->

            <header id="headerContainer">
                <div class="inner">
                    <h2>자동SMS설정</h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="sms" class="btn btn_email01">자동SMS설정</a></li>
                            
                            <!-- <li><a href="sms02.php" class="btn btn_email01">단체SMS발송</a></li>  
                            <li><a href="sms03.php" class="btn btn_email01">SMS발송</a></li>  
                            <li class="mr_10"><a href="sms04.php" class="btn btn_email01">SMS발송내역</a></li>   -->
                            <li>
                                <a href="sms_view" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil"></span> 
                                    <span class="txt">상품 등록</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- // inner -->
            </header><!-- // headerContainer -->

            <div id="contents" class="sms_container sms_container01">
                <div class="listWrap sms_container01">
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <?= $total_count ?>개의 목록이 있습니다.</p>
                        </div>
                    </div><!-- // listTop -->

                    <form name="frm" id="frm">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="10%" />
                                    <col width="10%" />
                                    <col width="70%" />
                                    <col width="10%" />
                                    <col width="10%"/>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>코드</th>
                                        <th>SMS명</th>
                                        <th>SMS내용</th>
                                        <th>사용여부</th>
                                        <th>관리</th>    
                                    </tr>
                                </thead>    
                                <tbody>
                                    <?php if (empty($sms_list)): ?>
                                        <tr>
                                            <td colspan="4" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($sms_list as $row): ?>
                                            <tr>
                                                <td><?= esc($row['code']) ?></td>
                                                <td><a href="<?= site_url('/AdmMaster/_member/sms_view?idx=' . $row['idx']) ?>"><?= esc($row['title']) ?></a></td>
                                                <td><?= esc($row['content']) ?></td>
                                                <td><?= ($row['autosend'] == "Y") ? "사용" : "사용안함" ?></td>
                                                <td>
                                                        <a href="<?= site_url('/AdmMaster/_member/sms_view?idx=' . $row['idx']) ?>">
                                                            <img src="/images/admin/common/ico_setting2.png" alt="설정"/>
                                                        </a>
                                                        <a href="javascript:del_it('<?= $row['idx'] ?>');">
                                                            <img src="/images/admin/common/ico_error.png" alt="에러"/>
                                                        </a>
                                                    </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <!-- Pagination can be added here -->
                </div><!-- // listWrap -->
            </div><!-- // contents -->

        </span><!-- 인쇄 영역 끝 //-->
    </div><!-- // container -->

    <script>
        function del_it(idx) {
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
                handleDel(idx);
            }
        }

        async function handleDel(idx) {
            let uri = '/AdmMaster/_member/sms_delete';

            $("#ajax_loader").removeClass("display-none");

            $.ajax({
                url: uri,
                type: "POST",
                data: "idx[]=" + idx,
                async: false,
                cache: false,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    $("#ajax_loader").addClass("display-none");
                    alert("정상적으로 삭제되었습니다.");
                    location.reload();
                    return;
                }
            });
        }
    </script>
    <?= $this->endSection() ?>