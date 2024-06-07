<?php

namespace App\Libraries;

/**
 * 정규식 라이브러리 클래스
 */
class Regex {

    public $firstOnlyString = "/^[\p{L}]+(\s.*)?$/u";
    public $onlyEnglish = "/^[a-zA-Z]+$/";

    /**
     * img 태그를 조회하여 src 내용을 리턴 정규식
     * * src 내용만 출력됩니다.
     * @param string $content 내용
     * @return array
     */
    public function imgSrcReg($content){
        $regRule = '/<img[^>]*src\s*=\s*[\"\'\']?([^>\"\'\']+)[\"\'\']?[^>]*>/';
        preg_match_all($regRule, $content, $matches);
        return $matches[1];
    }

    /**
     * 단어 검증
     * * 첫번째 문자가 영문 소문자
     * * 영문 소문자 + 숫자로 만 이루어져 있는지 확인
     * @param string $str 확인할 문자
     */
    public function lowerCaseEn($str){
        $regRule = '/^[a-z][a-z0-9]*$/';
        if(preg_match($regRule, $str)){
            return true;
        }else{
            return false;
        }
    }
}