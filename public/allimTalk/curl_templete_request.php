<?php

  /*  https://thetourlab.com/allimTalk/curl_templete_request.php
  
  -----------------------------------------------------------------------------------
  템플릿 검수 요청
  -----------------------------------------------------------------------------------
  작성이 완료된 템플릿에 대하여 검수요청을 합니다. 검수 결과에 따라 재작성 요청이 발생 할 수 있습니다.
  */

  $_apiURL		=	'https://kakaoapi.aligo.in/akv10/template/request/';
  $_hostInfo	=	parse_url($_apiURL);
  $_port			=	(strtolower($_hostInfo['scheme']) == 'https') ? 443 : 80;
  $_variables	=	array(
    'apikey'        => 'jmtgzroihpl1ecbi6rf8t2ndpqxho7sn',
    'userid'        => 'thetourlab',
    'senderkey'     => '181493389bdbb44fb4c8835797c455dfc28cd663',
    'tpl_code'      => 'TY_1652'
  );

  $oCurl = curl_init();
  curl_setopt($oCurl, CURLOPT_PORT, $_port);
  curl_setopt($oCurl, CURLOPT_URL, $_apiURL);
  curl_setopt($oCurl, CURLOPT_POST, 1);
  curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($_variables));
  curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);

  $ret = curl_exec($oCurl);
  $error_msg = curl_error($oCurl);
  curl_close($oCurl);

  // 리턴 JSON 문자열 확인
  print_r($ret . PHP_EOL);

  // JSON 문자열 배열 변환
  $retArr = json_decode($ret);

  // 결과값 출력
  print_r($retArr);

  /*
  code : 0 성공, 나머지 숫자는 에러
  message : 결과 메시지
  */