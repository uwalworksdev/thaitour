<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderGuideModel extends Model
{
    protected $table = 'tbl_order_guide';
    protected $primaryKey = 'idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "order_idx", "guide_meeting_hour", "guide_meeting_min", "guide_meeting_place",
        "guide_schedule", "request_memo", "product_idx", "created_at", "updated_at",
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getListByOrderIdx($o_idx)
    {
        $sql = " select * from tbl_order_guide where order_idx = '" . $o_idx . "' order by idx desc";
        write_log($sql);
        return $this->db->query($sql)->getResultArray();
    }
}