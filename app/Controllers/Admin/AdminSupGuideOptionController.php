<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GuideSupOptions;

class AdminSupGuideOptionController extends BaseController
{
    protected $guideSupOptionModel;

    public function __construct()
    {
        $this->guideSupOptionModel = new GuideSupOptions();
    }

    public function delete()
    {
        try {
            $s_idx = $this->request->getPost('s_idx');

            $this->guideSupOptionModel->deleteData($s_idx);

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => '삭제되었습니다.',
                    'data' => ''
                ]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'data' => null,
                    'message' => $e->getMessage()
                ]);
        }
    }
}
