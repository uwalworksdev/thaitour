<?php

namespace App\Models;

use CodeIgniter\Model;

class GolfOptionModel extends Model
{
    protected $table = 'tbl_golf_option';
    protected $primaryKey = 'idx';

    protected $allowedFields = [
        'product_idx',
        'hole_cnt',
        'hour',
        'minute',
        'option_price',
        'option_price1',
        'option_price2',
        'option_price3',
        'option_price4',
        'option_price5',
        'option_price6',
        'option_price7',
        'option_cnt',
        'use_yn',
        'afile',
        'bfile',
        'option_type',
        'onum',
        'rdate',
        'caddy_fee',
        'cart_pie_fee'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = false;

    protected $useSoftDeletes = false;

    public function getOptions($product_idx, $hole_cnt = null, $hour = null, $minute = null)
    {
		 
        $options = $this->where("product_idx", $product_idx);
        if ($hole_cnt) {
            $options = $options->where("hole_cnt", $hole_cnt);
        }
        if ($hour) {
            $options = $options->where("hour", $hour);
        }
        if ($minute) {
            $options = $options->where("minute", $minute);
        }

        return $options->findAll();

    }

    public function getGolfPrice($product_idx, $golf_date = null, $hole_cnt = null, $hour = null, $minute = null)
    {
		// 예약가능한 일자 및 금액 데이터 조회
		$sql_p    = "SELECT * FROM tbl_golf_price WHERE product_idx = '$product_idx' AND golf_date = '$golf_date' AND hole_cnt = 'hole_cnt' AND hour = '$hour' AND use_yn = '' ";
		$result_p = $this->db->query($sql_p);
		$options  = $result_p->getResultArray();

    }

	public function getByIdx($idx)
    {
        return $this->where("idx", $idx)->first();
    }
    public function checkOptionExist($product_idx, $hole_cnt, $hour, $minute)
    {
        $cnt = $this->where("product_idx", $product_idx)
                    ->where("hole_cnt", $hole_cnt)
                    ->where("hour", $hour)
                    ->where("minute", $minute)
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
