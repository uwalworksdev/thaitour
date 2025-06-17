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
        $result = $this->where('order_idx', $order_idx)->where('option_type', $option_type)->findAll();

        foreach($result as $key => $value) {
            $sql_opt = " SELECT * FROM tbl_golf_option WHERE idx = '" . $value['option_idx'] . "' AND group_idx = '' AND option_type = 'S' AND o_sale = 'Y' ";
            $query_opt = $this->db->query($sql_opt);
            $result_opt = $query_opt->getRowArray();
            $result[$key]['op_name_en'] = $result_opt['goods_name_eng'];
        }

        return $result;
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
