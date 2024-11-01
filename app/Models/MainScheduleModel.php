<?php

use CodeIgniter\Model;

class MainScheduleModel extends Model
{
    protected $table = 'tbl_product_main_schedule';

    protected $allowedFields = ['detail_idx', 'day_idx', 'schedule_date', 'detail_title', 'detail_experience1', 'detail_experience2', 'detail_experience3', 'hotel_text', 'hotel', 'shopping', 'meal1', 'meal2', 'meal3'];

    public function getByDetailAndDay($detailIdx, $dayIdx)
    {
        return $this->where(['detail_idx' => $detailIdx, 'day_idx' => $dayIdx])->first();
    }

    public function getAllByDetail($detailIdx, $dayIdx = null)
    {
        $this->where('detail_idx', $detailIdx);
        if ($dayIdx !== null) {
            $this->where('day_idx', $dayIdx);
        }
        return $this->findAll();
    }
}