<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelThemeSub extends Model
{
    protected $table = 'tbl_hotel_sub_theme';

    protected $primaryKey = 's_idx';

    protected $allowedFields = [
        "theme_idx", "ha_idx", "product_idx", "theme_name", "recommend", "details", "ufile1", "rfile1", "ufile2", "rfile2",
        "ufile3", "rfile3", "ufile4", "rfile4", "step", "star", "r_date", "m_date"
    ];

    protected $codeModel;
    protected $hotelTheme;

    public function __construct()
    {
        parent::__construct();
        $this->codeModel = new Code();
        $this->hotelTheme = new HotelThemeModel();
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter($data, function ($key) use ($allowedFields, $data) {
            return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
        },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

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

		return $this->update($id, $filteredData);
    }

}