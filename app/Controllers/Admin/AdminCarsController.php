<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminCarsController extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $carsOptionModel;
    protected $carsSubModel;

    protected $codeModel;


    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
        $this->carsOptionModel = model("CarsOptionModel");
        $this->carsSubModel = model("CarsSubModel");
        $this->codeModel = model("Code");
    }

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? 1);
        $search_txt = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy = $_GET["orderBy"] ?? "1";

        $where = [
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'orderBy' => $orderBy,
            'product_code_1' => 1324,
            'product_code_list' => 132404,
        ];

        $orderByArr = [];

        if ($orderBy == 1) {
			$orderByArr = [
				'onum'   => 'ASC',
				'r_date' => 'DESC'
			];			
			
        } elseif ($orderBy == 2) {
            $orderByArr['r_date'] = "DESC";
        }

        $result = $this->productModel->findProductPaging($where, $g_list_rows, $pg, $orderByArr);

        $data = [
            'result' => $result['items'],
            'orderBy' => $orderBy,
            'num' => $result['num'],
            'nTotalCount' => $result['nTotalCount'],
            'nPage' => $result['nPage'],
            'pg' => $pg,
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
        ];
        return view("admin/_cars/list", $data);
    }

    public function write()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');

        $fresult = $this->codeModel->getByCodeNos(["1324"]);

        $cfresult = $this->codeModel->getByParentAndDepth(47, 2)->getResultArray();

        $place_start_list = $this->codeModel->getByParentCode(48)->getResultArray();

        $place_end_list = $this->codeModel->getByParentCode(49)->getResultArray();

        $cars_sub_list = $this->carsSubModel->findSub($product_idx);

        foreach ($cars_sub_list as $key => $value) {
            $cars_sub_list[$key]["departure_name"] = $this->codeModel->getCodeName($value["departure_code"]);
            $cars_sub_list[$key]["destination_name"] = $this->codeModel->getCodeName($value["destination_code"]);
        }

        $product_code_no = $this->productModel->createProductCode("C");

        if ($product_idx) {
            $row = $this->productModel->find($product_idx);
            $product_code_no = $row["product_code"];
        }

        $oresult = $this->carsOptionModel->where("product_code", $row["product_code"])->findAll();

        $mcodes = $this->codeModel->getByParentCode('56')->getResultArray();

        $data = [
            'mcodes' => $mcodes,
            'product_idx' => $product_idx,
            'product_code_no' => $product_code_no,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            'row' => $row ?? '',
            'fresult' => $fresult,
            'cfresult' => $cfresult,
            'options' => $oresult,
            'place_start_list' => $place_start_list,
            'place_end_list' => $place_end_list,
            'cars_sub_list' => $cars_sub_list
        ];
        return view("admin/_cars/write", $data);
    }

    public function write_ok($product_idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data = $this->request->getPost();

            $o_idx = $_POST["option_idx"] ?? [];
            $c_op_type = $_POST["c_op_type"] ?? [];
            $c_op_name = $_POST["c_op_name"] ?? [];

            $arr_departure_area = $this->request->getPost("departure_area");
            $arr_destination_area = $this->request->getPost("destination_area");

            if (isset($arr_departure_area)) {
                $departure_area = implode(",", $arr_departure_area) ?? "";
            } else {
                $departure_area = "";
            }

            if (isset($arr_destination_area)) {
                $destination_area = implode(",", $arr_destination_area) ?? "";
            } else {
                $destination_area = "";
            }

            $data["departure_area"] = $departure_area ?? "";
            $data["destination_area"] = $destination_area ?? "";

            for ($i = 1; $i <= 7; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }
                // if (isset(${"del_" . $i}) && ${"del_" . $i} === "Y") {
                //     $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                // }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/data/cars/';
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }


            if ($product_idx) {

                foreach ($o_idx as $key => $val) {
                    $row_chk = $this->carsOptionModel->find($val);

                    if ($row_chk) {
                        $this->carsOptionModel->update($val, [
                            'c_op_name' => $c_op_name[$key],
                            'c_op_type' => $c_op_type[$key],
                        ]);

                    } else {
                        $this->carsOptionModel->insert([
                            'product_code' => $data['product_code'],
                            'c_op_name' => $c_op_name[$key],
                            'c_op_type' => $c_op_type[$key],
                        ]);

                    }
                }

                $data['mbti'] = $_POST["mbti"] ?? '';

                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                // 상품 테이블 변경
                $this->productModel->updateData($product_idx, $data);

            } else {
                // 옵션 등록
                foreach ($o_idx as $key => $val) {

                    $this->carsOptionModel->insert([
                        'product_code' => $data['product_code'],
                        'c_op_name' => $c_op_name[$key],
                        'c_op_type' => $c_op_type[$key],
                    ]);

                }

                $data['mbti'] = $_POST["mbti"] ?? '';
                $data['is_view'] = "Y";
                $data['product_code_1'] = '1324';
                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $count_product_code = $this->productModel->where("product_code", $data['product_code'])->countAllResults();

                if ($count_product_code > 0) {
                    $message = "이미 있는 상품코드입니다. \n 다시 확인해주시기바랍니다.";
                    return "<script>
                                alert('$message');
                                parent.location.reload();
                            </script>";
                }

                $this->productModel->insert($data);

            }

            if ($product_idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            } else {
                $message = "정상적인 등록되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.href='/AdmMaster/_cars/list';
                    </script>";
            }


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function change()
    {
        try {
            $product_idx = $_POST['code_idx'] ?? '';
            $onum = $_POST['onum'] ?? '';

            $tot = count($product_idx);
            for ($j = 0; $j < $tot; $j++) {
                $this->productModel->update($product_idx[$j], ['onum' => $onum[$j]]);
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'message' => '수정 했습니다.'
                    ]
                );

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function delete()
    {
        try {
            $idx = $_POST['product_idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'error' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            foreach ($idx as $iValue) {
                $sql1 = " update tbl_product_mst set product_status = 'D' where product_idx = '" . $iValue . "' ";
                $db1 = $this->connect->query($sql1);
                if (!$db1) {
                    $data = [
                        'status' => 'error',
                        'error' => 'error!'
                    ];
                    return $this->response->setJSON($data, 400);
                }
            }

            $data = [
                'status' => 'success',
                'message' => 'delete success!'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_cars_option()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'idx가 없습니다.'
                ], 400);
            }

            $sql = "DELETE FROM tbl_cars_option WHERE idx = " . $idx;
            $this->connect->query($sql);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => '삭제되었습니다.'
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    function cars_sub_ok()
    {
        try {
            $product_idx = $this->request->getPost("product_idx") ?? [];
            $cars_sub_idx = $this->request->getPost("cars_sub_idx") ?? [];
            $departure_list = $this->request->getPost("departure_code") ?? [];
            $destination_list = $this->request->getPost("destination_code") ?? [];
            $car_price = $this->request->getPost("car_price") ?? [];

            foreach ($cars_sub_idx as $key => $val) {
                $row_chk = $this->carsSubModel->find($val);

                if ($row_chk) {
                    $this->carsSubModel->update($val, [
                        'car_price' => $car_price[$key],
                    ]);

                } else {
                    $this->carsSubModel->insert([
                        'product_idx' => $product_idx,
                        'departure_code' => $departure_list[$key],
                        'destination_code' => $destination_list[$key],
                        'car_price' => $car_price[$key],
                    ]);

                }
            }

            return $this->response->setJSON([
                'result' => true,
                'message' => '업데이트되었습니다.'
            ], 200);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function cars_sub_del()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'idx가 없습니다.'
                ], 400);
            }

            $result = $this->carsSubModel->delete($idx);

            if ($result) {
                return $this->response->setJSON([
                    'result' => true,
                    'message' => '삭제되었습니다.'
                ], 200);
            } else {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => "오류!"
                ], 400);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
