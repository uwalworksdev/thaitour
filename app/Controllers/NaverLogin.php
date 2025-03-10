<?php

namespace App\Controllers;

use App\Libraries\NaverOAuth;

class NaverLogin extends BaseController
{
    private $member;
    protected $db;

	public function __construct()
    {
        $this->db = db_connect();
        $this->member = model("Member");
        helper('my_helper');

    }

    public function login()
    {
        $naver = new NaverOAuth();
        return redirect()->to($naver->getLoginUrl());
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

public function callback()
{
    // 네이버 로그인 콜백 예제
    $client_id     = env('NAVER_CLIENT_ID');
    $client_secret = env('NAVER_CLIENT_SECRET');
    $code          = $_GET["code"];
    $state         = $_GET["state"];
    $redirectURI   = urlencode("https://" . $_SERVER["HTTP_HOST"] . "/naver/callback");
    
    // 1. Validate the state parameter to prevent CSRF
    if ($state !== $_SESSION['naver_state']) {
        die("Invalid state parameter!");
    }

    // 네이버 토큰 요청 URL
    $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=" . $client_id . "&client_secret=" . $client_secret . "&redirect_uri=" . $redirectURI . "&code=" . $code . "&state=" . $state;
    
    // cURL 요청
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status_code == 200) {
        $responseArr = json_decode($response, true);
        // 토큰값을 세션에 저장
        $_SESSION['naver_access_token']  = $responseArr['access_token'];
        $_SESSION['naver_refresh_token'] = $responseArr['refresh_token'];

        // 2. 네이버 회원정보 가져오기
        $me_headers = array(
            'Content-Type: application/json',
            sprintf('Authorization: Bearer %s', $responseArr['access_token'])
        );

        $me_ch = curl_init();
        curl_setopt($me_ch, CURLOPT_URL, "https://openapi.naver.com/v1/nid/me");
        curl_setopt($me_ch, CURLOPT_HTTPHEADER, $me_headers);
        curl_setopt($me_ch, CURLOPT_RETURNTRANSFER, true);
        $me_response = curl_exec($me_ch);
        $me_status_code = curl_getinfo($me_ch, CURLINFO_HTTP_CODE);
        curl_close($me_ch);

        if ($me_status_code == 200) {
            $me_responseArr = json_decode($me_response, true);
            if (isset($me_responseArr['response']['id'])) {
                $mb_uid = 'naver_' . $me_responseArr['response']['id'];

                // 회원 정보 조회
                $sql = "SELECT * FROM tbl_member WHERE user_id = '" . $mb_uid . "'";
                $row = $this->db->query($sql)->getRowArray();
                $session = session();

                if (count($row) > 0) {
                    // 기존 회원일 경우: 토큰 업데이트 및 로그인
                    $this->db->query("UPDATE tbl_member SET sns_key = '" . $responseArr['access_token'] . "' WHERE user_id = '" . $mb_uid . "'");

                    // 세션에 회원 정보 저장
                    $session->set('sns.gubun', 'naver');
                    $session->set('member', [
                        'id'      => $row['user_id'],
                        'idx'     => $row['m_idx'],
                        'name'    => $row['user_name'],
                        'email'   => $row['user_email'],
                        'level'   => $row['user_level'],
                        'sns_key' => $row['sns_key'],
                        'mlevel'  => $row['mem_level']
                    ]);

                    // 로그인 성공 후 리디렉션
                    return redirect()->to('/');
                } else {
                    // 회원가입
                    $userName = $me_responseArr['response']['nickname'];
                    $userEmail = $me_responseArr['response']['email'];
                    $sns_key = $me_responseArr['response']['id'];

                    $data = [
                        'id'      => $mb_uid,
                        'sns_key' => $sns_key,
                        'name'    => $userName,
                        'email'   => $userEmail
                    ];

                    // 회원가입 로직 추가 (DB 삽입 등)

                    // 리디렉션
                    return redirect()->to('/');
                }
            }
        } else {
            echo "Error fetching user info: " . $me_response;
        }
    } else {
        echo "Error fetching access token: " . $response;
    }
}



}
