<?php

namespace App\Controllers;

class InicisController extends BaseController
{
    public function request()
    {
        // 로직 구현

		$data[] = "";
		return $this->renderView('inicis_request', $data);
    }

    public function close()
    {
        // 로직 구현

		$data[] = "";
		return $this->renderView('inicis_close', $data);
    }

	public function inicisResult()
	{
  	    $util = service('iniStdPayUtil');
  	    $prop = service('properties');


	    $data[] = "";
	    return $this->renderView('inicis_result', $data);

    }


}

?>