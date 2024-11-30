<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>쿠폰설정</h2>
                <div class="menus">
                    <ul class="first">
                    </ul>

                    <ul class="last">
                        <li>
                            <a href="write" class="btn btn-primary">
                                <span class="glyphicon glyphicon-pencil"></span> 
                                <span class="txt">신규등록</span>
                            </a>
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
                        <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                    </div>

                </div><!-- // listTop -->

                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="5%"/>
                                <col width="*"/>
                                <col width="10%"/>
                                <col width="10%"/>
                                <col width="10%"/>
                                <col width="10%"/>
                                <col width="10%"/>
                                <col width="10%"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>쿠폰명</th>
                                <th>발행타입</th>
                                <th>할인타입</th>
                                <th>할인율</th>
                                <th>사용기간</th>
                                <th>상태</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if ($nTotalCount == 0) {
                            ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                </tr>
                            <?php
                                }
                                foreach ($coupon_list as $row) {
                            ?>
                                <tr>
                                    <td><?= $num-- ?></td>
                                    <td class="tac">
                                        <a href="write?idx=<?= $row['idx'] ?>"><?= $row["coupon_name"] ?></a>
                                    </td>
                                    <td class="tac">
                                        <?php
                                        switch ($row['publish_type']) {
                                            case "M" :
                                                echo "회원가입";
                                                break;

                                            case "B" :
                                                echo "생일쿠폰";
                                                break;

                                            case "N" :
                                                echo "일반쿠폰";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td class="tac">
                                        <?php
                                        switch ($row['dc_type']) {
                                            case "P" :
                                                echo "할인율";
                                                break;

                                            case "D" :
                                                echo "가격할인";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td class="tac">
                                        <?php
                                        if ($row["dc_type"] == "P") {
                                            echo $row["coupon_pe"] . " %";
                                        } else if ($row["dc_type"] == "D") {
                                            echo number_format($row["coupon_price"]) . " 원";
                                        }
                                        ?>
                                    </td>
                                    <td class="tac">발행일로부터  일</td>
                                    <td class="tac">
                                        <?php
                                        if ($row["state"] == "Y") {
                                            echo "사용";
                                        } elseif ($row["state"] == "N") {
                                            echo "중지";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="write?idx=<?= $row['idx'] ?>">
                                            <img src="/images/admin/common/ico_setting2.png" alt="설정"/>
                                        </a>
                                        <a href="javascript:del_it('<?= $row['idx'] ?>');">
                                            <img src="/images/admin/common/ico_error.png" alt="에러"/>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_coupon/list') . "?search_category=$search_category&search_name=$search_name&pg=") ?>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first">
                            </ul>

                            <ul class="last">

                                <li>
                                    <a href="coupon_setting_write" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span> 
                                        <span class="txt">신규 등록</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->

    </div><!-- 인쇄 영역 끝 //-->
</div><!-- // container -->


<script>
    function CheckAll(checkBoxes, checked) {
        var i;
        if (checkBoxes.length) {
            for (i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = checked;
            }
        } else {
            checkBoxes.checked = checked;
        }

    }

    function del_it(idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            handleDel(idx);
        }
    }

    async function handleDel(idx) {
        let uri = `<?= route_to('admin.coupon.delete') ?>`;

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
                window.location.href = '/AdmMaster/_coupon/list';
                return;
            }
        });
    }

</script>

<?= $this->endSection() ?>
