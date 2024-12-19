<?php

namespace App\Controllers;

class TravelController extends BaseController
{
    public function index()
    {
        // 로직 구현

		$data[] = "";
		return $this->renderView('/travel/travel_insurance', $data);
    }

}

?>