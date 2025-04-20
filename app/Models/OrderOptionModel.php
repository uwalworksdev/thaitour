<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderOptionModel extends Model
{
    protected $table      = 'tbl_order_option';
    protected $primaryKey = 'opt_idx';

    protected $allowedFields = [
		'option_type', 
		'order_idx',	
		'product_idx',	
		'option_name',	
		'option_name_eng',	
		'option_idx',	
		'option_tot',	
		'option_tot_bath',	
		'option_cnt',	
		'option_date',	
		'option_price',	
		'option_price_bath', 	
		'option_qty', 	
		'baht_thai',		
    ];

    public function getOption($order_idx, $option_type)
    {
        return $this->where('order_idx', $order_idx)->where('option_type', $option_type)->findAll();
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

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

        return $this->insert($filteredData);
    }
}
