<?php

namespace App\Controllers;

class InicisController extends BaseController
{
    public function request()
    {
        // 로직 구현
		echo "Inicis request";
		return $this->renderView('inicis_request', $data);
    }
}

?>