<?php

namespace App\Models;

use CodeIgniter\Model;

class GolfInfoModel extends Model
{
    protected $table = 'tbl_golf_info';

    protected $primaryKey = 'info_idx';

    protected $allowedFields = [
        "product_idx",
        "star_level",
        "holes_number",
        "holidays",
        "distance_from_center",
        "distance_from_airport",
        "num_of_players",
        "electric_car",
        "caddy",
        "equipment_rent",
        "sports_day",
        "golf_vehicle",
        "green_peas",
        "sports_days",
        "slots",
        "golf_course_odd_numbers",
        "travel_times",
        "carts",
        "facilities",
        "s_date",
        "e_date",
        "deadline_date"
    ];

    public function getGolfInfo($product_idx)
    {
        return $this->where("product_idx", $product_idx)->first();
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

    public function copyInfo($originProductIdx, $targetProductIdx)
    {
        $info = $this->where("product_idx", $originProductIdx)->get()->getRowArray();
        $info["product_idx"] = $targetProductIdx;
        unset($info["info_idx"]);
        $this->insert($info);
    }
}