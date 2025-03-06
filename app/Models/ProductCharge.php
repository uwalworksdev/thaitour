<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCharge extends Model
{
    protected $table            = 'tbl_product_charge';
    protected $primaryKey       = 'charge_idx';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'seq', 'product_idx', 'yoil_idx', 's_station', 's_station_eng', 'tour_price',
        'tour_price_kids', 'tour_price_senior', 'r_date', 'u_date', 'sale', 'deadline_date',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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

    public function getById($charge_idx)
    {
        try {
            $sql = " select * from tbl_product_charge where charge_idx = '" . $charge_idx . "' ";
            write_log($sql);
            return $this->db->query($sql)->getRowArray();
        } catch (\Exception $e) {
            write_log($e->getMessage());
            return false;
        }
    }

    public function getByYoilAndProduct($yoil_idx, $product_idx, $orderby = null, $sort = 'asc')
    {
        try {
            $sql = " select * from tbl_product_charge where product_idx = '" . $product_idx . "' and yoil_idx = '" . $yoil_idx . "' ";
            if ($orderby) {
                $sql .= " order by " . $orderby . " " . $sort;
            }
            write_log($sql);
            return $this->db->query($sql)->getResultArray();
        } catch (\Exception $e) {
            write_log($e->getMessage());
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

    public function updateSeq($charge_idx, $type)
    {
        try {
            if ($type == 'up') {
                $sql = "UPDATE tbl_product_charge SET seq = seq + 1.5 WHERE charge_idx = " . $charge_idx;
                write_log($sql);
            } else {
                $sql = "UPDATE tbl_product_charge SET seq = seq - 1.5 WHERE charge_idx = " . $charge_idx;
                write_log($sql);
            }
            return $this->db->query($sql);
        } catch (\Exception $e) {
            write_log($e->getMessage());
            return false;
        }
    }

    public function updateSeqByProduct($charge_idx, $seq)
    {
        try {
            $sql = "UPDATE tbl_product_charge SET seq = '" . $seq . "' WHERE charge_idx = " . $charge_idx;
            write_log($sql);
            return $this->db->query($sql);
        } catch (\Exception $e) {
            write_log($e->getMessage());
            return false;
        }
    }

    public function selectSeqByProduct($product_idx)
    {
        try {
            $sql = "SELECT charge_idx, seq FROM tbl_product_charge where product_idx = '" . $product_idx . "' ORDER BY seq ASC";
            write_log($sql);
            return $this->db->query($sql);
        } catch (\Exception $e) {
            write_log($e->getMessage());
            return false;
        }
    }

    public function selectByProductAndYoil($product_idx, $yoil_idx)
    {
        $sql = "select * from tbl_product_charge where product_idx = '" . $product_idx . "' and yoil_idx = '" . $yoil_idx . "' order by seq asc";
        return $this->db->query($sql)->getResultArray();
    }
}
