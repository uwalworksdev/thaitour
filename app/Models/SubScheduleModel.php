<?php

use CodeIgniter\Model;

class SubScheduleModel extends Model
{
    protected $table = 'tbl_product_sub_schedule';

    protected $allowedFields = ['detail_idx', 'day_idx', 'groups', 'onum', 'detail_sub_tit', 'detail_sub_memo', 'detail_summary', 
    'rfile1', 'ufile1', 'rfile2', 'ufile2', 'rfile3', 'ufile3', 'rfile4', 'ufile4', 'rfile5', 'ufile5', 'rfile6', 'ufile6', 'rfile7', 'ufile7', 'rfile8', 'ufile8', 'rfile9', 'ufile9', 'rfile10', 'ufile10', 
    'detail_desc01', 'detail_desc02', 'detail_desc03', 'detail_desc', 'img_yn', 'detail_desc04'];

    public function deleteDaySchedule($detail_idx, $dayIdx, $group) {
        return $this->where('detail_idx', $detail_idx)
                    ->where('day_idx', $dayIdx)
                    ->where('groups', $group)
                    ->delete();
    }
}