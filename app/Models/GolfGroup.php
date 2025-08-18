<?php

namespace App\Models;

use CodeIgniter\Model;

class GolfGroup extends Model
{
    protected $table = 'tbl_golf_group';

    protected $primaryKey = 'group_idx';

    protected $allowedFields = [
        "product_idx",
        "sdate",
        "edate",
        "reg_date"
    ];

    private $golfOptionModel;
    private $golfPriceModel;

    public function __construct()
    {
        parent::__construct();
        $this->golfOptionModel = model("GolfOptionModel");
        $this->golfPriceModel = model("GolfPriceModel");
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;
        
        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->insert($filteredData);
    }
    public function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields; 
        
        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

        return $this->where("product_idx", $id)->set($filteredData)->update();
    }

    public function copyGroup($originProductIdx, $targetProductIdx)
    {
        $info = $this->where("product_idx", $originProductIdx)->get()->getResultArray();
        foreach($info as $row) {
            $group_idx = $row["group_idx"];
            unset($row["group_idx"]);
            $row['product_idx'] = $targetProductIdx;
            $row['reg_date'] = date("Y-m-d H:i:s");
            $new_group_idx = $this->insert($row);

            $option_list = $this->golfOptionModel->where("product_idx", $originProductIdx)
                                                ->where("group_idx", $group_idx)->findAll();

            foreach ($option_list as $option) {
                $o_idx = $option["idx"];
                unset($option["idx"]);
                $option["product_idx"] = $targetProductIdx;
                $option["group_idx"] = $new_group_idx;
                $option["reg_date"] = date("Y-m-d H:i:s");
                $new_o_idx = $this->insert($option);

                $golf_price = $this->golfPriceModel->where("product_idx", $originProductIdx)
                                                    ->where("o_idx", $o_idx)
                                                    ->where("group_idx", $group_idx)
                                                    ->orderBy("goods_date", "asc")->findAll();

                foreach ($golf_price as $price) {
                    unset($price["idx"]);
                    $price["product_idx"] = $targetProductIdx;
                    $price["group_idx"] = $new_group_idx;
                    $price["o_idx"] = $new_o_idx;
                    $price["reg_date"] = date("Y-m-d H:i:s");
                    $this->insert($price);
                }
            }
        }
    }
}