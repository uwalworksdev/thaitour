<?php

use CodeIgniter\Model;

class OrderSubModel extends Model
{
    protected $table = 'tbl_order_list';
    protected $primaryKey = 'gl_idx';
    protected $allowedFields = [];
    public function getOrderSub($order_idx){
        $builder = $this->db->table($this->table);
        $builder->where('order_idx', $order_idx);
        $query = $builder->get();
        return $query->getResultArray();
    }
}