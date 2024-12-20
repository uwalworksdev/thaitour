<?php

namespace Config;

class Inicis
{
    public $mid = 'INIpayTest'; // 상점 아이디
    public $key = '1111'; // 상점 키
    public $url = 'https://iniapi.inicis.com'; // 결제 요청 URL
    public $returnUrl = 'https://thetourlab.com/return'; // 응답 URL
    public $cancelUrl = 'https://thetourlab.com/cancel'; // 취소 URL
}
