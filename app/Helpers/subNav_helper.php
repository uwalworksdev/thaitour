<?php
/**
 * 코드 값이 있다면 해당 코드에 맞는 정보만 리턴
 * * 코드 안넣으면 등록된 리스트 전체 출력
 * @param string $mainCode
 * @return array
 */
function subNavList($mainCode = null){

    $locale         = service('request')->getLocale();

    $subNavArray['company']['title'] = lang("Header.subNav.company.title");
    $subNavArray['company']['list']['greeting']['name']         = lang("Header.subNav.company.list.greeting");
    $subNavArray['company']['list']['greeting']['link']         = ($locale == "kr") ? "greeting" : url_to("Company::Main", "greeting");
    $subNavArray['company']['list']['history']['name']          = lang("Header.subNav.company.list.history");
    $subNavArray['company']['list']['history']['link']          = ($locale == "kr") ? "history" : url_to("Company::Main", "history");
    $subNavArray['company']['list']['mission']['name']          = lang("Header.subNav.company.list.mission");
    $subNavArray['company']['list']['mission']['link']          = ($locale == "kr") ? "mission" : url_to("Company::Main", "mission");
    $subNavArray['company']['list']['license']['name']          = lang("Header.subNav.company.list.license");
    $subNavArray['company']['list']['license']['link']          = ($locale == "kr") ? "license" : url_to("Company::Main", "license");
    $subNavArray['company']['list']['introducting_ci']['name']  = lang("Header.subNav.company.list.introducting_ci");
    $subNavArray['company']['list']['introducting_ci']['link']  = ($locale == "kr") ? "introducting_ci" : url_to("Company::Main", "introducting_ci");
    $subNavArray['company']['list']['location']['name']         = lang("Header.subNav.company.list.location");
    $subNavArray['company']['list']['location']['link']         = ($locale == "kr") ? "location" : url_to("Company::Main", "location");

    $subNavArray['business']['title'] = lang("Header.subNav.business.title");
    $subNavArray['business']['list']['strategy']['name']        = lang("Header.subNav.business.list.strategy");
    $subNavArray['business']['list']['strategy']['link']        = ($locale == "kr") ? "strategy" : url_to("Business::Main", "strategy");
    $subNavArray['business']['list']['ultrapure']['name']       = lang("Header.subNav.business.list.ultrapure");
    $subNavArray['business']['list']['ultrapure']['link']       = ($locale == "kr") ? "ultrapure" : url_to("Business::Main", "ultrapure");
    $subNavArray['business']['list']['waterTreatment']['name']  = lang("Header.subNav.business.list.waterTreatment");
    $subNavArray['business']['list']['waterTreatment']['link']  = ($locale == "kr") ? "waterTreatment" : url_to("Business::Main", "waterTreatment");
    $subNavArray['business']['list']['wasteWater']['name']      = lang("Header.subNav.business.list.wasteWater");
    $subNavArray['business']['list']['wasteWater']['link']      = ($locale == "kr") ? "wasteWater" : url_to("Business::Main", "wasteWater");
    $subNavArray['business']['list']['seaWater']['name']        = lang("Header.subNav.business.list.seaWater");
    $subNavArray['business']['list']['seaWater']['link']        = ($locale == "kr") ? "seaWater" : url_to("Business::Main", "seaWater");
    $subNavArray['business']['list']['certified']['name']       = lang("Header.subNav.business.list.certified");
    $subNavArray['business']['list']['certified']['link']       = ($locale == "kr") ? "certified" : url_to("Business::Main", "certified");
    $subNavArray['business']['list']['affiliate']['name']       = lang("Header.subNav.business.list.affiliate");
    $subNavArray['business']['list']['affiliate']['link']       = ($locale == "kr") ? "affiliate" : url_to("Business::Main", "affiliate");

    if ($locale === "kr") {
        $subNavArray['investment']['title'] = lang("Header.subNav.investment.title");
        $subNavArray['investment']['list']['announcements']['name']     = lang("Header.subNav.investment.list.announcements");
        $subNavArray['investment']['list']['announcements']['link']     = "announcements";
        $subNavArray['investment']['list']['stockinformation']['name']  = lang("Header.subNav.investment.list.stockinformation");
        $subNavArray['investment']['list']['stockinformation']['link']  = "stockinformation";
        $subNavArray['investment']['list']['management']['name']        = lang("Header.subNav.investment.list.management");
        $subNavArray['investment']['list']['management']['link']        = "management";
        $subNavArray['investment']['list']['publicNotice']['name']      = lang("Header.subNav.investment.list.publicNotice");
        $subNavArray['investment']['list']['publicNotice']['link']      = "publicNotice";
    } else {
        $subNavArray['investment']['title'] = lang("Header.subNav.investment.title");
        $subNavArray['investment']['list']['announcements']['name']     = lang("Header.subNav.investment.list.announcements");
        $subNavArray['investment']['list']['announcements']['link']     = url_to("Investment::Main", "announcements");
        $subNavArray['investment']['list']['stockinformation']['name']  = lang("Header.subNav.investment.list.stockinformation");
        $subNavArray['investment']['list']['stockinformation']['link']  = url_to("Investment::Main", "stockinformation");
        $subNavArray['investment']['list']['management']['name']        = lang("Header.subNav.investment.list.management");
        $subNavArray['investment']['list']['management']['link']        = url_to("Investment::Main", "management");
        // $subNavArray['investment']['list']['publicNotice']['name']      = lang("Header.subNav.investment.list.publicNotice");
        // $subNavArray['investment']['list']['publicNotice']['link']      = url_to("Investment::Main", "publicNotice");
    }

    $subNavArray['esg']['title'] = lang("Header.subNav.esg.title");
    $subNavArray['esg']['list']['safety']['name']                   = lang("Header.subNav.esg.list.safety");
    $subNavArray['esg']['list']['safety']['link']                   = ($locale == "kr") ? "safety" : url_to("Esg::Main", "safety");
    $subNavArray['esg']['list']['ethical']['name']                  = lang("Header.subNav.esg.list.ethical");
    $subNavArray['esg']['list']['ethical']['link']                  = ($locale == "kr") ? "ethical" : url_to("Esg::Main", "ethical");
    $subNavArray['esg']['list']['environmental']['name']            = lang("Header.subNav.esg.list.environmental");
    $subNavArray['esg']['list']['environmental']['link']            = ($locale == "kr") ? "environmental" : url_to("Esg::Main", "environmental");

    $subNavArray['promotion']['title'] = lang("Header.subNav.promotion.title");
    $subNavArray['promotion']['list']['notice']['name']             = lang("Header.subNav.promotion.list.notice");
    $subNavArray['promotion']['list']['notice']['link']             = ($locale == "kr") ? "notice" : url_to("Promotion::Main", "notice");

    $subNavArray['promotion']['list']['report']['name']             = lang("Header.subNav.promotion.list.report");
    $subNavArray['promotion']['list']['report']['link']             = ($locale == "kr") ? "report" : url_to("Promotion::Main", "report");

    $subNavArray['promotion']['list']['brochure']['name']           = lang("Header.subNav.promotion.list.brochure");
    $subNavArray['promotion']['list']['brochure']['link']           = ($locale == "kr") ? "brochure" : url_to("Promotion::Main", "brochure");
    
    $subNavArray['recruitment']['title'] = lang("Header.subNav.recruitment.title");
    $subNavArray['recruitment']['list']['welfare']['name']          = lang("Header.subNav.recruitment.list.welfare");
    $subNavArray['recruitment']['list']['welfare']['link']          = ($locale == "kr") ? "welfare" : url_to("Recruitment::Main", "welfare");

    $subNavArray['recruitment']['list']['recruit']['name']          = lang("Header.subNav.recruitment.list.recruit");
    $subNavArray['recruitment']['list']['recruit']['link']          = ($locale == "kr") ? "recruit" : url_to("Recruitment::Main", "recruit");
    
    if($mainCode){
        return $subNavArray[$mainCode];
    }else{
        return $subNavArray;
    }
}
/**
 * 패밀리사이트 배열
 * @return array
 */
function FamilySiteList(){
    $familySiteList['headerTitle']      = lang("Header.familySite.headerTitle");
    $familySiteList['footerTitle']      = lang("Header.familySite.footerTitle");
    $familySiteList['list'][0]['title'] = lang("Header.familySite.list.0");
    $familySiteList['list'][0]['url']  = "http://www.dyenbio.com/";
    $familySiteList['list'][1]['title'] = lang("Header.familySite.list.1");
    $familySiteList['list'][1]['url']  = "https://ecw.co.kr/";
    $familySiteList['list'][2]['title'] = lang("Header.familySite.list.2");
    $familySiteList['list'][2]['url']  = "https://enwatersolution.co.kr/";

    return $familySiteList;
}