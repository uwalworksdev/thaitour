<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductPrice extends Model
{
    protected $table = 'tbl_product_price';
    protected $primaryKey = 'p_idx';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'product_idx', 's_date', 'e_date', 'adult_price', 'kids_price', 'senior_price',
        'yoil_0', 'yoil_1', 'yoil_2', 'yoil_3', 'yoil_4', 'yoil_5', 'yoil_6', 'c_date',
        'sale', 'status', 'column_name',
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

    public function getById($p_idx)
    {
        try {
            $sql = " select * from tbl_product_price where p_idx = '" . $p_idx . "'";
            //write_log($sql);
            return $this->db->query($sql)->getRowArray();
        } catch (\Exception $e) {
            //write_log($e->getMessage());
            return false;
        }
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

        return $this->insert($filteredData);
    }

    public function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

        return $this->update($id, $filteredData);
    }

    public function selectYoilByProductIdx($yoil, $day_, $product_idx)
    {
        switch ($yoil) {
            case 'yoil_0':
                $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_0 = 'Y' AND product_idx = ?";
                break;
            case 'yoil_1':
                $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_1 = 'Y' AND product_idx = ?";
                break;
            case 'yoil_2':
                $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_2 = 'Y' AND product_idx = ?";
                break;
            case 'yoil_3':
                $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_3 = 'Y' AND product_idx = ?";
                break;
            case 'yoil_4':
                $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_4 = 'Y' AND product_idx = ?";
                break;
            case 'yoil_5':
                $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_5 = 'Y' AND product_idx = ?";
                break;
            default:
                $sql = "SELECT * FROM tbl_product_price WHERE s_date <= ? AND e_date >= ? AND yoil_6 = 'Y' AND product_idx = ?";
                break;
        }
        return $this->db->query($sql, [$day_, $day_, $product_idx])->getResultArray();
    }
}
