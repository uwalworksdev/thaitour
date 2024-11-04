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

    public function deleteMainScheduleByDetailIdx($detailIdx)
    {
        $this->db->table('tbl_product_main_schedule')
                 ->where('detail_idx', $detailIdx)
                 ->delete();
    }

    public function insertMainSchedule($data)
    {
        $this->db->table('tbl_product_main_schedule')->insert($data);
    }

    public function subScheduleExists($detailIdx, $dayIdx, $group, $orderNum)
    {
        return $this->db->table('tbl_product_sub_schedule')
                        ->where('detail_idx', $detailIdx)
                        ->where('day_idx', $dayIdx)
                        ->where('groups', $group)
                        ->where('onum', $orderNum)
                        ->countAllResults() > 0;
    }

    public function insertSubSchedule($data)
    {
        $this->db->table('tbl_product_sub_schedule')->insert($data);
    }

    public function updateSubSchedule($data, $detailIdx, $dayIdx, $group, $orderNum)
    {
        $this->db->table('tbl_product_sub_schedule')
                 ->where('detail_idx', $detailIdx)
                 ->where('day_idx', $dayIdx)
                 ->where('groups', $group)
                 ->where('onum', $orderNum)
                 ->update($data);
    }

    public function day_delete($daySeq)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $_row = explode(",", $daySeq);
        $idx = $_row[0];
        $day_idx = $_row[1];

        $db->table('tbl_product_day_detail')->where('idx', $idx)->set('total_day', 'total_day - 1', false)->update();

        $db->table('tbl_product_main_schedule')->where(['detail_idx' => $idx, 'day_idx' => $day_idx])->delete();

        $db->table('tbl_product_sub_schedule')->where(['detail_idx' => $idx, 'day_idx' => $day_idx])->delete();

        $db_main = $db->table('tbl_product_main_schedule')
            ->where('detail_idx', $idx)
            ->where('day_idx >', $day_idx)
            ->orderBy('day_idx', 'asc')
            ->get()
            ->getResultArray();

        foreach ($db_main as $row_main) {
            $db->table('tbl_product_main_schedule')
                ->where(['detail_idx' => $row_main['detail_idx'], 'day_idx' => $row_main['day_idx']])
                ->set('day_idx', 'day_idx - 1', false)
                ->update();
        }

        $db_sub = $db->table('tbl_product_sub_schedule')
            ->where('detail_idx', $idx)
            ->where('day_idx >', $day_idx)
            ->orderBy('day_idx', 'asc')
            ->get()
            ->getResultArray();

        foreach ($db_sub as $row_sub) {
            $db->table('tbl_product_sub_schedule')
                ->where(['detail_idx' => $row_sub['detail_idx'], 'groups' => $row_sub['groups'], 'onum' => $row_sub['onum']])
                ->set('day_idx', 'day_idx - 1', false)
                ->update();
        }

        $db->transComplete(); 

        if ($db->transStatus() === false) {
            return "N";
        }
        return "Y";
    }

}