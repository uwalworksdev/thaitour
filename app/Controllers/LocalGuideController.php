<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Config\Services;
use Exception;

class LocalGuideController extends BaseController
{
    private $db;
    
    public function __construct()
    {
        $this->db = db_connect();
        
        helper(['my_helper']);
    }
	
}