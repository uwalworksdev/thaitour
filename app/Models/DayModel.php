<?php

use CodeIgniter\Model;

class  DayModel extends Model
{
    protected $table = 'tbl_product_day_detail';

    protected $primaryKey = 'idx';

    protected $allowedFields = ['product_idx', 'air_code', 'total_day', 'shopping', 'sdate'];

    public function getProductDetail($productIdx, $airCode)
    {
        return $this->where(['product_idx' => $productIdx, 'air_code' => $airCode])->first();
    }
    
    public function createProductDetail($data)
    {
        return $this->insert($data);
    }

    public function updateSchedule($productIdx, $airCode, $sdate)
    {
        return $this->set('sdate', $sdate)
            ->set('total_day', 'total_day + 1', false)
            ->where('product_idx', $productIdx)
            ->where('air_code', $airCode)
            ->update();
    }

}