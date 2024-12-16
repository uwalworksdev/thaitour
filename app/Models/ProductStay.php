<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductStay extends Model
{
    protected $table = 'tbl_product_stay';
    protected $primaryKey = 'stay_idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'code_no', 'country_code_1', 'country_code_2', 'country_code_3', 'stay_code', 'stay_city', 'stay_address',
        'stay_user_name', 'stay_name_eng', 'stay_name_kor', 'stay_internet', 'stay_level', 'stay_check_in',
        'stay_check_in_ampm', 'stay_check_in_hour', 'stay_check_in_min', 'stay_check_out', 'stay_check_out_ampm',
        'stay_check_out_hour', 'stay_check_out_min', 'stay_service', 'stay_parking', 'stay_room', 'facilities', '
        room_facil', 'tel_no', 'mobile_no', 'stay_homepage', 'stay_contents', 'ufile1', 'rfile1', 'ufile2', 'rfile2',
        'ufile3', 'rfile3', 'ufile4', 'rfile4', 'ufile5', 'rfile5', 'stay_onum', 'note', 'stay_m_date', 'stay_r_date',
        'onum', 'room_list', 'code_utilities', 'code_services', 'code_best_utilities', 'code_populars', 'latitude', 'longitude',
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
}
