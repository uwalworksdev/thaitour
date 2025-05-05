<?php

namespace App\Controllers;
use DateTime;

class DailyController extends BaseController {
    private $db;
    private $productModel;
    private $roomImg;
    private $CodeModel;

    public function __construct() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
    }
	
    public function service_end() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
		write_log("service_end");
    }
	
    public function service_cancel() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
		
		write_log("service_cancel");
    }
	
}	