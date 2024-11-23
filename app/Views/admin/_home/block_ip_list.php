<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

    <link rel="stylesheet" href="/css/admin/sms_contents.css" type="text/css"/>

    <div id="container">
        <div id="print_this"><!-- 인쇄영역 시작 //-->
            <header id="headerContainer">
                <div class="inner">
                    <h2>IP 차단</h2>
                    <div class="menus">
                        <ul class="first">
                            <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), true)"
                                   class="btn btn-success">전체선택</a></li>
                            <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), false)"
                                   class="btn btn-success">선택해체</a></li>
                            <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                        </ul>

                    </div>
                </div><!-- // inner -->
            </header><!-- // headerContainer -->

            <style>
                .ipheaderContents {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 15px;
                }

                .ipheaderContents .ipleft {
                    margin-right: auto;
                    margin-left: auto;
                }
            </style>
            <div id="contents">
                <form name="search" id="search">
                    <input type="hidden" name="gubun" value="">
                    <header class="ipheaderContents">
                        <div class="ipleft">
                            <select id="" name="ip" class="input_select">
                                <option value="ip">IP</option>
                            </select>
                            <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                                   class="input_txt placeHolder" rel="검색어 입력" style="width:240px;height:30px;">
                            <a href="javascript:search_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                        </div>
                        <div class="ipright">
                            IP 추가 <input type="text" name="blockip" name="blockip" style="width:140px;height:30px;"> 
							<a href="javascript:fnAddIp()" class="btn btn-primary">추 가</a>
                        </div>
                    </header><!-- // headerContents -->
                </form>

                <div class="listWrap">
                    <!-- 안내 문구 필요시 구성 //-->
                    <div class="listTop">
                        <div class="left">
                            <p class="schTxt">■ 총 <?= number_format($nTotalCount) ?>개의 목록이 있습니다.</p>
                        </div>
                    </div><!-- // listTop -->

                    <form name="frm" id="frm">
                        <div class="listBottom">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                                <caption></caption>
                                <colgroup>
                                    <col width="70px">
                                    <col width="100px">
                                    <col width="170px">
                                    <col width="170px">
                                    <col width="100px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>선택</th>
                                    <th>번호</th>
                                    <th>IP</th>
                                    <th>등록일</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($nTotalCount == 0) {
                                    ?>
                                    <tr>
                                        <td colspan=13 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                                    </tr>
                                    <?php

                                }
                               foreach ($result as $row) {

                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="m_idx[]" class="m_idx"
                                                   value="<?= $row['m_idx'] ?>">
                                        </td>
                                        <td><?= $row['m_idx'] ?></td>
                                        <td class="tac"><?= $row['ip'] ?></td>
                                        <td class="tac"><?= $row['reg_date'] ?></td>
                                        <td>
                                            <a href="javascript:del_it('<?= $row['m_idx'] ?>');"><img
                                                        src="/AdmMaster/_images/common/ico_error.png" alt="에러"></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div><!-- // listBottom -->
                    </form>

                    <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_adminrator/block_ip_list') . "?s_status=$s_status&search_category=$search_category&search_name=$search_name&pg=") ?>

                    <div id="headerContainer">
                        <div class="inner">
                            <div class="menus">
                                <ul class="first">
                                    <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), true)"
                                           class="btn btn-success">전체선택</a></li>
                                    <li><a href="javascript:CheckAll(document.getElementsByName('m_idx[]'), false)"
                                           class="btn btn-success">선택해체</a></li>
                                    <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                                </ul>
                            </div>
                        </div><!-- // inner -->
                    </div><!-- // headerContainer -->
                </div><!-- // listWrap -->
            </div><!-- // contents -->
        </div><!-- 인쇄 영역 끝 //-->
    </div>
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

        function SELECT_DELETE() {
            if ($(".m_idx").is(":checked") == false) {
                alert_("삭제할 내용을 선택하셔야 합니다.");
                return;
            }
            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }

            $("#ajax_loader").removeClass("display-none");

            $.ajax({
                url: "ip_del.php",
                type: "POST",
                data: $("#frm").serialize(),
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
                    //				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {
                    if (response == "OK") {
                        alert_("정상적으로 삭제되었습니다.");
                        location.reload();
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }

        function del_it(m_idx) {

            if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
                return;
            }
            $("#ajax_loader").removeClass("display-none");
            $.ajax({
                url: "ip_del.php",
                type: "POST",
                data: "m_idx[]=" + m_idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {
                    //				$("#ajax_loader").addClass("display-none");
                }
                , success: function (response, status, request) {

                    if (response.trim() == "OK") {
                        alert_("정상적으로 삭제되었습니다.");
                        location.reload();
                        return;
                    } else {

                        alert("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });

        }


        function search_it() {

            var frm = document.search;
            if (frm.search_name.value == "검색어 입력") {
                frm.search_name.value = "";
            }
            frm.submit();
        }

        function fnAddIp() {

				let url = '/ajax/fnAddIp_insert'
				let prod_data = $(f).serialize();
				$.ajax({
					type: "POST",
					data: {  "ip" : $("#blockip").val()  },
					url: url,
					cache: false,
					async: false,
					success: function (data, textStatus) {
						let message = data.message;
						alert(message);
						location.reload();
					},
					error: function (request, status, error) {
						alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
					}
				});
        }

    </script>

<?= $this->endSection() ?>