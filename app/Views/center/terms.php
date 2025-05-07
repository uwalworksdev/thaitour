<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/center/center.css" rel="stylesheet" type="text/css" />
<link href="/css/center/center_responsive.css" rel="stylesheet" type="text/css" />
<section class="terms">
	<?php
	echo view("center/center_term", ["tab3" => "on"]);
	?>
	<div class="inner">
		<div class="contentArea">
			<div class="content_wrap">
                <?= viewSQ($policy['policy_contents']) ?>
            </div>

			<!-- <div class="content_wrap">
				<p>
					<strong>
						<font color="#000000">&nbsp;</font>
					</strong>
				</p>
				<p>
					<strong>
						<font color="#000000">[ 더투어랩는 소비자 보호에 관한 법률과 기타 관련법령의 규정 및 국내 외 여행 표정 약관등에 의해 약관을 운영합니다 ]</font>
						<br><br>
					</strong><br>
				</p>
				<p>
					<strong>
						<font color="#000000">제 1조 (목적)</font>
					</strong>
				</p>
				<p>이 약관은 ㈜에스에스케이투어가 운영하는 더투어랩 웹사이트(이하 "사이트"라 한다)<br>에서 제공하는 인터넷관련 서비스 (이하 "서비스"라 한다)를 이용함에 있어 <br>이용자의
					권리 의무 및 책임사항을 규정함을 목적으로 합니다.&nbsp;</p>
				<p>
					<br><strong>
						<font color="#000000">제 2조 (정의)</font>
					</strong><br>① "사이트"란 ㈜에스에스케이투어가 정보를 이용자에게 제공하기 위하여 컴퓨터 등 정보통신 설비를 이용하여 정보를 제공하는 <br>온라인상의 영업장을
					말합니다.<br>② "이용자"란 "사이트"에 접속하여 이 약관에 따라 "사이트"에서 제공하는 서비스를 받는 비회원을 말합니다. <br>③ '비회원'이라 함은 회원에 가입하지 않고
					"사이트"이 제공하는 서비스를 이용하는 자를 말합니다.&nbsp;
				</p>
				<p>
					<br>
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제3조 (약관 등의 명시)</font>
					</strong><br>"사이트"는 이 약관의 내용과 상호 및 대표자 성명, 영업소 소재지 주소(소비자의 불만을 처리할 수 있는 곳의 주소를
					포함),전화번호,<br>팩스번호,전자우편주소,사업자등록번호,개인정보관리책임자 등을 이용자가 쉽게 알 수 있도록 사이트의 초기 서비스화면(전면)에 <br>게시합니다. 다만, 약관의
					내용은 이용자가 연결화면을 통하여 볼 수 있도록 할 수 있습니다.
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제 4조 (서비스의 제공)</font>
					</strong><br>"사이트"는 다음과 같은 업무를 수행합니다. <br>1. 여행에 대한 정보 제공 <br>2. 여행과 관련된 커뮤니티 운영 <br>3. 기타 "사이트"가
					정하는 업무
				</p>
				<p>
					<br>
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제 5조 (서비스의 중단)</font>
					</strong><br>"사이트"는 컴퓨터 등 정보통신설비의 보수점검,교체 및 고장, 통신의 두절 등의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 <br>중단할 수
					있습니다.
				</p>
				<p>
					<br>
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제 6조 (개인정보보호)</font>
					</strong><br>개인정보보호에 관한 사항에 사이트에 게시된 당사의 개인정보취급방침에 규정된 내용에 따릅니다.
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제7조 ("사이트"의 의무)</font>
					</strong><br>"사이트"는 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하지 않으며 이 약관이 정하는 바에 따라 지속적이고, 안정적으로 <br>정보를 제공하는데
					최선을 다하여야 합니다.
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제 8조 (이용자의 의무)</font>
					</strong><br>이용자는 다음 행위를 하여서는 안됩니다. <br>1. 신청 또는 변경 시 허위 내용의 등록<br>2. 타인의 정보 도용<br>3. "사이트"에 게시된 정보의
					변경 <br>4. "사이트"가 정한 정보 이외의 정보(컴퓨터 프로그램 등) 등의 송신 또는 게시<br>5. "사이트" 기타 제3자의 저작권 등 지적재산권에 대한 침해 <br>6.
					"사이트" 기타 제3자의 명예를 손상시키거나 업무를 방해하는 행위 <br>7. 외설 또는 폭력적인 메시지, 화상, 음성, 기타 공서양속에 반하는 정보를 사이트에 공개 또는 게시하는
					행위<br>&nbsp;<br>① "사이트"가 작성한 저작물에 대한 저작권 기타 지적재산권은 "사이트"에 귀속합니다. <br>② 이용자는 "사이트"를 이용함으로써 얻은 정보 중
					"사이트"에게 지적재산권이 귀속된 정보를 "사이트"의 사전 승낙 없이 복제, 송신,<br>출판, 배포, 방송 기타 방법에 의하여 영리목적으로 이용하거나 제3자에게 이용하게 하여서는
					안됩니다. <br>③ "사이트"는 약정에 따라 이용자에게 귀속된 저작권을 사용하는 경우 당해 이용자에게 통보하여야 합니다.
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제 9조 (저작권의 귀속 및 이용제한)</font>
					</strong><br>여행 도중 피보험자가 승객으로서 탑승한 항공기가 납치됨에 따라 예정 목적지에 도착 할 수 없게 되는 동안에 대하여 일정금액 보상
				</p>
				<p>
					<br>
				</p>
				<p>
					<br>
				</p>
				<p>
					<strong>
						<font color="#000000">제 10조 (분쟁해결)</font>
					</strong>
				</p>
				<p>"사이트"는 이용자로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만, 신속한 처리가 곤란한 경우에는 <br>이용자에게 그 사유와 처리일정을 즉시 통보해
					드립니다. </p>
				<p>&nbsp;</p>
				<p>
					<a href="https://www.swisswatchessite.com/" style="display:none;" target="_blank">replica watches sale</a>
				</p>
			</div> -->
		</div>
	</div>
</section>
<?php $this->endSection(); ?>