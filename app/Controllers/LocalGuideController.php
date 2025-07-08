<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Config\Services;
use Exception;

class Product extends BaseController
{
    public function __construct()
    {
        $this->db = db_connect();
        
        helper(['my_helper']);
    }
	
}