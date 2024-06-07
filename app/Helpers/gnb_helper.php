<?php

/**
 * 고정된 게시판 정보
 * @return array
 */
function adminGnbBoard(){
    // 회사소개-보유면허
    $codeArray["license"]['code'] = "license";
    $codeArray["license"]['title']['kr'] = "회사소개-보유면허";
    $codeArray["license"]['title']['en'] = "회사소개-보유면허";
    $codeArray["license"]['onum'] = 0;
    $codeArray["license"]['auth'] = '';
    $codeArray["license"]['template'] = 'gallery';
    // 사업영역-초순수/순수
    $codeArray["ultrapure"]['code'] = "ultrapure";
    $codeArray["ultrapure"]['title']['kr'] = "사업영역-초순수/순수";
    $codeArray["ultrapure"]['title']['en'] = "사업영역-초순수/순수";
    $codeArray["ultrapure"]['onum'] = 0;
    $codeArray["ultrapure"]['auth'] = '';
    $codeArray["ultrapure"]['template'] = 'list';
    // 사업영역-용수처리
    $codeArray["waterTreatment"]['code'] = "waterTreatment";
    $codeArray["waterTreatment"]['title']['kr'] = "사업영역-용수처리";
    $codeArray["waterTreatment"]['title']['en'] = "사업영역-용수처리";
    $codeArray["waterTreatment"]['onum'] = 0;
    $codeArray["waterTreatment"]['auth'] = '';
    $codeArray["waterTreatment"]['template'] = 'list';
    // 사업영역-하폐수/재이용
    $codeArray["wasteWater"]['code'] = "wasteWater";
    $codeArray["wasteWater"]['title']['kr'] = "사업영역-하폐수/재이용";
    $codeArray["wasteWater"]['title']['en'] = "사업영역-하폐수/재이용";
    $codeArray["wasteWater"]['onum'] = 0;
    $codeArray["wasteWater"]['auth'] = '';
    $codeArray["wasteWater"]['template'] = 'list';
    // 사업영역-해수담수화
    $codeArray["seaWater"]['code'] = "seaWater";
    $codeArray["seaWater"]['title']['kr'] = "사업영역-해수담수화";
    $codeArray["seaWater"]['title']['en'] = "사업영역-해수담수화";
    $codeArray["seaWater"]['onum'] = 0;
    $codeArray["seaWater"]['auth'] = '';
    $codeArray["seaWater"]['template'] = 'list';
    // 사업영역-R&D
    $codeArray["certified"]['code'] = "certified";
    $codeArray["certified"]['title']['kr'] = "사업영역-R&D";
    $codeArray["certified"]['title']['en'] = "사업영역-R&D";
    $codeArray["certified"]['onum'] = 0;
    $codeArray["certified"]['auth'] = '';
    $codeArray["certified"]['template'] = 'gallery';
    // 투자정보-공시정보
    // $codeArray["announcements"]['code'] = "announcements";
    // $codeArray["announcements"]['title'] = "투자정보-공시정보";
    // $codeArray["announcements"]['onum'] = 0;
    // $codeArray["announcements"]['auth'] = '';
    // $codeArray["announcements"]['template'] = 'list';
    // 투자정보-전자공고
    $codeArray["publicNotice"]['code'] = "publicNotice";
    $codeArray["publicNotice"]['title']['kr'] = "투자정보-전자정보";
    $codeArray["publicNotice"]['title']['en'] = "투자정보-전자정보";
    $codeArray["publicNotice"]['onum'] = 0;
    $codeArray["publicNotice"]['auth'] = '';
    $codeArray["publicNotice"]['template'] = 'list';
    // 홍보센터-공지사항
    $codeArray["notice"]['code'] = "notice";
    $codeArray["notice"]['title']['kr'] = "홍보센터-공지사항";
    $codeArray["notice"]['title']['en'] = "홍보센터-공지사항";
    $codeArray["notice"]['onum'] = 0;
    $codeArray["notice"]['auth'] = '';
    $codeArray["notice"]['template'] = 'list';
    // 홍보센터-언론보도
    $codeArray["report"]['code'] = "report";
    $codeArray["report"]['title']['kr'] = "홍보센터-언론보도";
    $codeArray["report"]['title']['en'] = "홍보센터-언론보도";
    $codeArray["report"]['onum'] = 0;
    $codeArray["report"]['auth'] = '';
    $codeArray["report"]['template'] = 'list';
    // 홍보센터-브로슈어
    $codeArray["brochure"]['code'] = "brochure";
    $codeArray["brochure"]['title']['kr'] = "홍보센터-브로슈어";
    $codeArray["brochure"]['title']['en'] = "홍보센터-브로슈어";
    $codeArray["brochure"]['onum'] = 0;
    $codeArray["brochure"]['auth'] = '';
    $codeArray["brochure"]['template'] = 'list';



    return $codeArray;
}
/**
 * 관리자에서 사용되는 Gnb 배열
 * @return array
 */
function adminGnb(){
    $adminUrl = "/adm";
    $adminGnbBoardArray = adminGnbBoard();

    $boardArray['kr'] = [];
    $boardAuth['kr'] = [];
    $boardArray['en'] = [];
    $boardAuth['en'] = [];
    foreach($adminGnbBoardArray AS $adminGnbBoard){
        
        $boardItem['code'] = $adminGnbBoard['code'];
        $boardItem['title'] = $adminGnbBoard['title']['kr'];
        $boardItem['mainUrl'] = "{$adminUrl}/board/{$adminGnbBoard['code']}";
        $boardItem['link'] = "{$adminUrl}/board/{$boardItem['code']}/list";
        $boardItem['onum'] = $adminGnbBoard['onum'];
        $boardItem['auth'] = $adminGnbBoard['auth'];
        $boardArray['kr'][$adminGnbBoard['code']] = $boardItem;
        array_push($boardAuth['kr'], $adminGnbBoard['auth']);

        // 영문
        $boardItem['code'] = $adminGnbBoard['code'];
        $boardItem['title'] = $adminGnbBoard['title']['en'];
        $boardItem['mainUrl'] = "{$adminUrl}/en/board/{$adminGnbBoard['code']}";
        $boardItem['link'] = "{$adminUrl}/en/board/{$boardItem['code']}/list";
        $boardItem['onum'] = $adminGnbBoard['onum'];
        $boardItem['auth'] = $adminGnbBoard['auth'];
        $boardArray['en'][$adminGnbBoard['code']] = $boardItem;
        array_push($boardAuth['en'], $adminGnbBoard['auth']);
    }
    

    $gnbArray = [
        "board"=>[
            "mainUrl"   => "{$adminUrl}/board",
            "title"     => "게시판",
            "link"      => "",
            "icon"      => "",
            "auth"      => $boardAuth['kr'],
            "onum"      => 0,
            "child"     => $boardArray['kr'],
        ],
        "board_en"=>[
            "mainUrl"   => "{$adminUrl}/en/board",
            "title"     => "게시판-영문",
            "link"      => "",
            "icon"      => "",
            "auth"      => $boardAuth['en'],
            "onum"      => 0,
            "child"     => $boardArray['en'],
        ],
        "setting"=>[
            "mainUrl"   => "{$adminUrl}/setting",
            "title"     => "설정",
            "link"      => "",
            "icon"      => "",
            "auth"      => [],
            "onum"      => 0,
            "child"     => [
                "site"  => [
                    "title"     => "사이트 기본설정",
                    "mainUrl"   => "{$adminUrl}/setting/site",
                    "link"      => "{$adminUrl}/setting/site",
                    "auth"      => "",
                    "onum"      => 0,
                ],
                "popup" => [
                    "title"     => "팝업",
                    "mainUrl"   => "{$adminUrl}/setting/popup",
                    "link"      => "{$adminUrl}/setting/popup/list",
                    "auth"      => "",
                    "onum"      => 0,
                ],
                "policy"=> [
                    "title"     => "약관 및 정책",
                    "mainUrl"   => "{$adminUrl}/setting/policy",
                    "link"      => "{$adminUrl}/setting/policy",
                    "auth"      => "",
                    "onum"      => 0,
                ],
            ],
        ]
    ];

    return $gnbArray;
}