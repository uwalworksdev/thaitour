<?php

use CodeIgniter\Model;

class OrderTourModel extends Model
{
    protected $table = 'tbl_order_tour';

    protected $primaryKey = 'idx';

    protected $allowedFields = ['order_idx', 'product_idx', 'tours_idx', 'start_place', 'metting_time', 'id_kakao', 'description', 'end_place', 'r_date'];

    public function findByOrderIdx($order_idx)
    {
        return $this->where('order_idx', $order_idx)->findAll();
    }
}