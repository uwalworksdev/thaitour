<?php

namespace App\Controllers;

class SocialLoginController extends BaseController
{

    protected $memberModel;

    public function __construct()
    {
        $this->memberModel = new \App\Models\Member();
    }

    public function naverLogin()
    {

        $state = $this->request->getVar('state');
        $code = $this->request->getVar('code');

        $session = session();

        if (session("naver_state") != $state) {
            return "<script>alert('잘못된 경로로 접근하였습니다.');</script>";
        }

        session()->remove('naver_state');

        // 네이버 로그인 콜백 예제
        $client_id = env('NAVER_CLIENT_ID');
        $client_secret = env('NAVER_CLIENT_SECRET');
        //$redirectURI = urlencode("https://" . $_SERVER["HTTP_HOST"] . "/member/sns_naver_login.php");
        $redirectURI = $previousUrl;
        $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=" . $client_id . "&client_secret=" . $client_secret . "&redirect_uri=" . $redirectURI . "&code=" . $code . "&state=" . $state;
        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        if ($status_code == 200) {
            $responseArr = json_decode($response, true);
            $_SESSION['naver_access_token'] = $responseArr['access_token'];
            $_SESSION['naver_refresh_token'] = $responseArr['refresh_token'];

            // 토큰값으로 네이버 회원정보 가져오기 
            $me_headers = array(
                'Content-Type: application/json',
                sprintf('Authorization: Bearer %s', $responseArr['access_token'])
            );
            $me_is_post = false;
            $me_ch = curl_init();
            curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me");
            curl_setopt($me_ch, CURLOPT_POST, $me_is_post);
            curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers);
            curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true);
            $me_response = curl_exec($me_ch);
            $me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE);
            curl_close($me_ch);
            $me_responseArr = json_decode($me_response, true);

            if ($me_responseArr['response']['id']) {
                $mb_uid = 'naver_' . $me_responseArr['response']['id'];


                $row = $this->memberModel->getLogin($mb_uid);
                $mode = substr($state, -3);
                if ($row) {
                    if ($mode == 'myp') {
                        return "<script>location.href='/mypage/imfor_change';</script>";
                    } else if ($mode == 'log') {
                        $this->memberModel->where('user_id', $mb_uid)->set([
                            'sns_key' => $responseArr['access_token'],
                            'login_count' => $row['login_count'] + 1,
                            'login_date' => 'now()'
                        ])->update();
                        getLoginDeviceUserChk($row['user_id']);

                        getLoginIPChk();

                        session()->remove("member");

                        $data = [];

                        $data['id'] = $row['user_id'];
                        $data['idx'] = $row['m_idx'];
                        $data["mIdx"] = $row['m_idx'];
                        $data['name'] = $row['user_name'];
                        $data['email'] = $row['user_email'];
                        $data['level'] = $row['user_level'];
                        $data['phone'] = $row['user_mobile'];

                        session()->set("member", $data);

                        return redirect()->to("/");

                    } else if ($mode == 'reg') {
                        echo "<script>
                            alert('이미 가입한 회원입니다.');
                            location.href='/';
                        </script>";
                    }
                } else {

                    $email = $me_responseArr['response']['email'];
                    $name = $me_responseArr['response']['name'];
                    $id = $me_responseArr['response']['id'];

                    $session->set('sns.gubun', 'naver');
                    $session->set('naver.userEmail', $email);
                    $session->set('naver.userName', $name);
                    $session->set('naver.user_id', 'naver_' . $id);
                    $session->set('naver.sns_key', $id);

                    return $this->redirectForm('/member/join_form_sns', [
                        'gubun' => 'naver',
                        'sns_key' => $id,
                        'userEmail' => $email,
                        'user_name' => $name
                    ]);
                }
            } else {
                echo "<script>
                    alert('아이디를 가져오는데 실패하였습니다.');
                    location.href='/';
                </script>";
            }
        } else {
            return "<script>
                alert('에러가 발생하였습니다.');
                location.href='/';
            </script>";
        }
    }

    private function redirectForm($url, $data)
    {

        $form = '<form id="redirectForm" action="' . $url . '" method="POST">';

        foreach ($data as $key => $value) {
            $form .= '<input type="hidden" name="' . esc($key) . '" value="' . esc($value) . '">';
        }

        $form .= '</form>';
        $form .= '<script type="text/javascript">document.getElementById("redirectForm").submit();</script>';

        return $form;
    }

	public function naverCallback()
	{
		$code  = $this->request->getGet('code');
		$state = $this->request->getGet('state');

		// Debugging: 값이 제대로 넘어오는지 확인
		log_message('debug', '네이버 로그인 콜백 호출 - code: ' . $code . ', state: ' . $state);
		echo "code: " . $code . "<br>";
		echo "state: " . $state . "<br>";

		if (!$code || !$state) {
			return "code 또는 state 값이 없습니다.";
		}
	}
	
}
