<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<?php
$titleStr = "여행후기";
$user_name = sqlSecretConver($row["user_name"], 'decode');
$user_email = sqlSecretConver($row["user_email"], 'decode');

$status = $row["status"];
$ufile1 = $row["ufile1"];
$rfile1 = $row["rfile1"];
$ufile2 = $row["ufile2"];
$rfile2 = $row["rfile2"];
$r_date = $row["r_date"];
$code_name = $row["code_name"];

$product_name = $row['product_name'];
$title = $row['title'];
$contents = $row["contents"];
$idx = $row["idx"];
?>
    <script type="text/javascript">
        function checkForNumber(str) {
            var key = event.keyCode;
            var frm = document.frm1;
            if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
                (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
                event.returnValue = false;
            }
        }

        function send_it() {
            var frm = document.frm;
            frm.submit();
        }
    </script>


    <div id="container"> <span id="print_this"><!-- 인쇄영역 시작 //-->
	
	<header id="headerContainer">
		<div class="inner">
			<h2><?= $titleStr ?></h2>
			<div class="menus"> 
				<ul>
					<li><a href="/AdmMaster/_review/write.php?idx=<?= $idx ?>" class="btn btn-default"><span
                                    class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
                    <li><a href="javascript:del_it('<?= $idx ?>');" class="btn btn-default"><span
                                    class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a></li>
					<li><a href="/AdmMaster/_review/list.php" class="btn btn-default"><span
                                    class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
				</ul>
			</div>
		</div>
        <!-- // inner -->
		
	</header>
            <!-- // headerContainer -->
	
<form name=frm action="" method=post target="hiddenFrame">
<input type=hidden name="idx" value='<?= $idx ?>'>
	
	<div id="contents">
		<div class="listWrap_noline">
			<div class="listBottom">
				<table cellpadding="0" cellspacing="0" summary="" id="table_form_online_quote"
                       class="listTable mem_detail">
					<caption>
					</caption>
					<colgroup>
					<col width="10%"/>
					<col width="40%"/>
					<col width="10%"/>
					<col width="40%"/>
					</colgroup>
					<tbody>
						<tr>
							<th>현황</th>
							<td>
									<? if ($status == "Y") {
                                        echo "승인";
                                    } ?>
                                    <? if ($status == "N") {
                                        echo "미승인";
                                    } ?>
							</td>
							<th>여행자 성함</th>
							<td>
									<?= $user_name ?>
							</td>
						</tr>
						<tr>
							<th>여행형태</th>
							<td>
									<?= $code_name ?>
							</td>
							<th>이메일</th>
							<td>
									<?= $user_email ?>
							</td>
						</tr>
						<tr>
							<th>제목</th>
							<td colspan="3"><?= $title ?></td>
						</tr>
						<tr>
							<th>내용</th>
							<td colspan="3"><?= viewSQ($contents) ?></td>
						</tr>
						<tr>
							<th>첨부파일</th>
							<td colspan="3">
								<a href="/data/review/<?= $ufile1 ?>" download="<?= $rfile1 ?>"><?= $rfile1 ?></a>
							</td>
						</tr>
						<tr>
							<th>첨부파일</th>
							<td colspan="3">
								<a href="/data/review/<?= $ufile2 ?>" download="<?= $rfile2 ?>"><?= $rfile2 ?></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

            <!-- // listBottom -->
				<div class="tail_menu">  
					<ul>
						<li class="left"></li>  
						<li class="right_sub">  
							<a href="/AdmMaster/_review/write.php?idx=<?= $idx ?>" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                    		<a href="javascript:del_it('<?= $idx ?>');" class="btn btn-default"><span
                                        class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
							<a href="/AdmMaster/_review/list.php" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
						</li>
					</ul>
				</div>
			
		</div>
        <!-- // listWrap -->
		
	</div>
    <!-- // contents -->
	</form>
		<div class="inner cmt_area" style="">
			<form action="" id="frm" name="com_form" class="com_form">
				<input type="hidden" name="code" id="code" value="review">
				<input type="hidden" name="r_code" id="r_code" value="review">
				<input type="hidden" name="r_idx" id="r_idx" value="<?= $idx ?>">
				<div class="comment_box-input flex">
					<textarea class="cmt_input" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
					<button type="button" class="btn btn-point comment_btn"
                            onclick="fn_comment('<?= session('member.idx') ?>')">등록</button>
				</div>
			</form>
			<div id="comment_list"></div>
		</div>
	</span><!-- 인쇄 영역 끝 //-->
    </div>
    <!-- // container -->
    <script>
        function change_it(str) {
            if (str == "O") {
                $(".cls_out").show();
            } else {
                $(".cls_out").hide();
            }
        }
        <? if ($status == "O") { ?>
        change_it('<?=$status?>');
        <? } ?>

        function del_it() {
            if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
                hiddenFrame.location.href = "del.php?idx[]=<?=$idx?>&mode=view";
            }

        }
    </script>
    <script src="https://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script>
        //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
        function execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function (data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                    var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                        extraRoadAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if (data.buildingName !== '' && data.apartment === 'Y') {
                        extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if (extraRoadAddr !== '') {
                        extraRoadAddr = ' (' + extraRoadAddr + ')';
                    }
                    // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                    if (fullRoadAddr !== '') {
                        fullRoadAddr += extraRoadAddr;
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('zip').value = data.zonecode; //5자리 새우편번호 사용
                    document.getElementById('addr1').value = fullRoadAddr;
                    document.getElementById('addr2').focus();
                }
            }).open();
        }

        const r_code = "review";
        const r_idx = "<?=$idx?>";
        const role = "admin";
    </script>
    <script src="/js/comment.js"></script>
    <iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>