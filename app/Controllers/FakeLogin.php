<?php
		namespace App\Controllers;

		use CodeIgniter\Controller;

		class FakeLogin extends Controller
		{
			public function index()
			{
				// 세션 서비스 로드
				$session = session();

				// 가상의 사용자 데이터
				$id = "N_". time();
				$userData = [
					'id'   => $id,  // 가상의 사용자 ID
					'name'  => '비회원',  // 가상의 사용자 이름
					'logged_in' => true,   // 로그인 상태
				];

				// 세션에 사용자 데이터 저장
				$session->set($userData);

				// 확인 메시지 출력
				echo "가상 로그인 성공! <br>";
				echo "세션 데이터: ";
				print_r($session->get());
			}

			public function logout()
			{
				// 세션 서비스 로드
				$session = session();

				// 세션 데이터 삭제
				$session->destroy();

				echo "로그아웃 성공!";
			}
		}

?>