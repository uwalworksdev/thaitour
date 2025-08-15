<?php

namespace App\Models;

use CodeIgniter\Model;

class Rooms extends Model
{
    protected $table = 'tbl_room';
    protected $primaryKey = 'g_idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "hotel_code", "roomName", "roomName_eng", "ufile1", "rfile1", "ufile2", "rfile2", "ufile3", "rfile3",
        "ufile4", "rfile4", "ufile5", "rfile5", "ufile6", "rfile6", "room_facil",
        "category", "scenery", "extent", "floor", "policy_customer", "breakfast", "lunch", "dinner", "max_num_people", "onum"
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

    public function copyRooms($product_idx, $new_product_idx)
    {
        $info = $this->where("hotel_code", $product_idx)->get()->getResultArray();

        $data = [];

        foreach($info as $row) {
            unset($row['idx']);
            $row['hotel_code'] = $new_product_idx;
            $data[] = $row;
        }

        if (!empty($data)) {
            $this->insertBatch($data);
        }
    }
}
