<?php
		namespace App\Controllers;

		use App\Models\YourModel;
		use CodeIgniter\HTTP\ResponseInterface;

		class PositionController extends BaseController
		{
				public function change()
				{
					$data = $this->request->getJSON(true);

					$p_idx     = $data['groupCode'] ?? '';
					$code_idx  = $data['itemId'] ?? '';
					$direction = $data['direction'] ?? '';

					$model = new \App\Models\TblMainDispModel();

					$success = $model->reorderItem($p_idx, $code_idx, $direction);

					return $this->response->setJSON([
						'success' => $success,
						'message' => $success ? '순서가 변경되었습니다.' : '변경 실패'
					]);
				}

		}
