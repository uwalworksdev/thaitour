<?php

namespace App\Libraries;

class NaverOAuth
{
    private $clientId;
    private $clientSecret;
    private $callbackUrl;
    private $authorizeUrl = "https://nid.naver.com/oauth2.0/authorize";
    private $tokenUrl     = "https://nid.naver.com/oauth2.0/token";
    private $userInfoUrl  = "https://openapi.naver.com/v1/nid/me";

    public function __construct()
    {
        $this->clientId     = env('NAVER_CLIENT_ID');
        $this->clientSecret = env('NAVER_CLIENT_SECRET');
        $this->callbackUrl  = env('NAVER_CALLBACK_URL');
    }

    public function getLoginUrl()
    {
        $state = bin2hex(random_bytes(16)); // CSRF 방지를 위한 state 값 생성
        session()->set('naver_oauth_state', $state);

        return $this->authorizeUrl . '?' . http_build_query([
            'response_type' => 'code',
            'client_id'     => $this->clientId,
            'redirect_uri'  => $this->callbackUrl,
            'state'         => $state,
        ]);
    }

    public function getAccessToken($code, $state)
    {
		
$response = file_get_contents("https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=thHkJbn94PdAfE38YW5r&client_secret=Y5V6L6ryPj&code={$code}&state={$state}");
write_log($response);

        if (session()->get('naver_oauth_state') !== $state) {
            throw new \Exception("Invalid state value");
        }

        $response = file_get_contents($this->tokenUrl . '?' . http_build_query([
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code'          => $code,
            'state'         => $state,
        ]));

        return json_decode($response, true);
    }

    public function getUserInfo($accessToken)
    {
        $headers = [
            "Authorization: Bearer {$accessToken}"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->userInfoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
