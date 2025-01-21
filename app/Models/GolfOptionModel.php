<?php

namespace App\Models;

use CodeIgniter\Model;

class GolfOptionModel extends Model
{
    protected $table      = 'tbl_golf_option';
    protected $primaryKey = 'idx';

    protected $allowedFields = [

		'product_idx',	
		'goods_name',	
		'goods_price1',	
		'goods_price2',	
		'goods_price3',	
		'goods_price4',	
		'goods_price5',	
		'goods_price6',	
		'goods_price7',	
        'vehicle_price1',	
	    'vehicle_price2',	
	    'vehicle_price3',	
	    'cart_price',	
	    'caddie_fee',			
		'o_day_price',	
		'o_night_price',	
		'use_yn',	
		'o_day_yn',	
		'o_night_yn',	
		'option_type',	
		'o_sdate',	
		'o_edate',	
		'o_soldout',	
		'o_golf'	

    ];

    protected $returnType = 'array';

    protected $useTimestamps = false;

    protected $useSoftDeletes = false;

    public function getCodeByIdx($idx)
    {
        return $this->where('idx', $idx)->first();
    }

    public function getOptions($product_idx, $goods_name = null)
    {
		//$this->table = 'tbl_golf_price'; 
	 
        $options = $this->where("product_idx", $product_idx);
        if ($goods_name) {
            $options = $options->where("goods_name", $goods_name);
        }

        return $options->findAll();
/*
		// 예약가능한 일자 및 금액 데이터 조회

        $where = "";
		if ($hole_cnt) {
            $where .= " AND hole_cnt = '$hole_cnt' ";
        }
        if ($hour) {
            $where .= " AND hour = '$hour' ";
        }
        if ($minute) {
            $where .= " AND minute = '$minute' ";
        }

		$sql_p    = "SELECT * FROM tbl_golf_price WHERE product_idx = '$product_idx' $where AND use_yn != 'N' ";
		write_log($sql_p);
		$result_p = $this->db->query($sql_p);
		$options  = $result_p->getResultArray();
      
	    return $options;
*/
    }

    public function getGolfPrice($product_idx, $golf_date, $hole_cnt, $hour)
    {
		// 예약가능한 일자 및 금액 데이터 조회
		$sql_p    = "SELECT * FROM tbl_golf_price WHERE product_idx = '$product_idx' AND goods_date = '$golf_date' AND goods_name = '$hole_cnt' AND use_yn != 'N' ";
		write_log($sql_p);
		$result_p = $this->db->query($sql_p);
		$options  = $result_p->getResultArray();
      
	    return $options;
    }

	public function getByIdx($idx)
    {
        return $this->where("idx", $idx)->first();
    }

    public function checkOptionExist($product_idx, $goods_name)
    {
        $cnt = $this->where("product_idx", $product_idx)
                    ->where("goods_name",  $goods_name)
                    ->countAllResults();
        if ($cnt > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function copyOption($originProductIdx, $targetProductIdx)
    {
        $options = $this->where("product_idx", $originProductIdx)->findAll();
        foreach ($options as $option) {
            $option["product_idx"] = $targetProductIdx;
            $this->insert($option);
        }
    }
}
