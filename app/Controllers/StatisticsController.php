<?php

namespace App\Controllers;

class StatisticsController extends BaseController {

    public function __construct() {
        
    }

    public function main() {
        $data = [
            'db' => \Config\Database::connect(),
        ];
        return view('admin/_statistics/main', $data);
    }
}
?>
