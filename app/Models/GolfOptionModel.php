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
