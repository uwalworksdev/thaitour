<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Member;

class BirthdayChecker extends Controller
{
    public function index()
    {
        $userModel = new Member();

        // 오늘 날짜 가져오기 (YYYY-MM-DD 형식)
        $today = date('m-d'); // 연도를 제외하고 비교 (01-01, 02-15 같은 형식)

        // 오늘 생일인 사용자 조회
        $birthdays = $userModel->where("DATE_FORMAT(birthday, '%m-%d')", $today)->findAll();

        if (!empty($birthdays)) {
            foreach ($birthdays as $user) {
                //write_log("🎉 생일 축하합니다! {$user['user_id']} ({$user['birthday']})");
                // 이메일 발송 등의 추가 작업 가능
            }
        } else {
            echo "오늘 생일인 사용자가 없습니다.\n";
        }
    }
}

// 0 0 * * * /usr/bin/php /var/www/html/public/index.php birthdaychecker >> /var/log/birthday.log 2>&1
