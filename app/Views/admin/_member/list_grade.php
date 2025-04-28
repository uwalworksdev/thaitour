<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<div id="container">
    <span id="print_this">
        <header id="headerContainer">
            <div class="inner">
                <h2>회원등급관리</h2>
            </div>
        </header>

        <div id="contents">

            <script>
                function search_it() {
                    var frm = document.search;
                    if (frm.search_name.value == "검색어 입력") {
                        frm.search_name.value = "";
                    }
                    frm.submit();
                }
            </script>
            <div class="listWrap">
                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="*" />
                                <col width="10%" />
                                <col width="20%" />
                                <col width="10%" />
                                <col width="10%" />
                                <col width="20%" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>회원등급명</th>
                                    <th>등급</th>
                                    <th>적립율(%)</th>
                                    <th>등록일</th>
                                    <th>수정일</th>
                                    <th>관리</th>
                                </tr>
                            </thead>
							<tbody>
								<?php foreach ($fresult as $row) { ?>
									<tr>
										<td>
											<input type="text" name="grade_name" id="grade_name_<?= esc($row['g_idx']) ?>" value="<?= esc($row['grade_name']) ?>" style="width:100px;text-align:right;">
										</td>	
										<td>
											<input type="text" name="user_level" id="user_level_<?= esc($row['g_idx']) ?>" value="<?= esc($row['user_level']) ?>" style="width:100px;text-align:right;" readonly>
										</td>
										<td>
											<input type="text" name="amount_rate" id="amount_rate_<?= esc($row['g_idx']) ?>" value="<?= esc($row['amount_rate']) ?>" style="width:100px;text-align:right;">
										</td>
										<td><?= esc($row['upd_date']) ?></td>
										<td><?= esc($row['reg_date']) ?></td>
										<td>
											<button type="button" class="grade_upd" value="<?= esc($row['g_idx']) ?>">등급수정</button>
										</td>
									</tr>
								<?php } ?>
								<!--tr>
									<td>
										<input type="text" name="grade_name" id="grade_name" value="" style="width:100px;text-align:left;">
									</td>
									<td>
										<input type="text" name="user_level" id="user_level" value="" style="width:100px;text-align:left;">
									</td>
									<td>
										<input type="text" name="amount_rate" id="amount_rate" value="" style="width:100px;text-align:right;">
									</td>
									<td></td>
									<td></td>
									<td>
										<button type="button" id="grade_add">등급추가</button>
									</td>
								</tr-->
							</tbody>

                        </table>
                    </div>
                </form>

            </div>
        </div>
    </span>
</div>

<script>
$(function() {

    // 🔧 등급 수정 버튼 클릭 시
    $(document).on('click', '.grade_upd', function() {
        const g_idx       = $(this).val();
        const grade_name  = $('#grade_name_' + g_idx).val();
        const amount_rate = $('#amount_rate_' + g_idx).val();

		$.ajax({

			url: "/ajax/ajax_grade_update",
			type: "POST",
			data: {
					"g_idx"       : g_idx,
					"grade_name"  : grade_name,
					"amount_rate" : amount_rate
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				var message = data.message;
				alert(message);
				location.reload();
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});		
    });

    // ➕ 등급 추가 버튼 클릭 시
    $('#grade_add').on('click', function() {
        const grade_name    = $('#grade_name').val();
        const amount_rate = $('#amount_rate').val();

        $.post('/admin/member/grade_add', {
            grade_name: grade_name,
            amount_rate: amount_rate
        }).done(function(response) {
            alert('새 등급이 추가되었습니다.');
            location.reload();
        }).fail(function() {
            alert('추가 실패');
        });
    });

});
</script>

<script>
    function del_it(m_idx) {

        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        let url = "";

        <?php 
            if($s_status == "Y"){
        ?>   
            url = "member_out";     
        <?php
            }else{
        ?>     
            url = "del";     
        <?php
            }
        ?>

        $("#ajax_loader").removeClass("display-none");
        $.ajax({
            url: url,
            type: "POST",
            data: "m_idx[]=" + m_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                alert("삭제되었습니다.");
                location.reload();
            }
        });
    }
</script>
<?= $this->endSection() ?>