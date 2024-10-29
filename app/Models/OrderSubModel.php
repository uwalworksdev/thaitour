<?php

use CodeIgniter\Model;

class OrderSubModel extends Model
{
    protected $table = 'tbl_order_list';
    protected $primaryKey = 'gl_idx';
    protected $allowedFields = [
        'm_idx', 'order_idx', 'product_idx', 'number_room', 'order_gubun', 'order_name_kor', 'order_first_name', 'order_last_name'
        , 'passport_num', 'passport_date', 'order_birthday', 'order_mobile', 'order_email', 'order_sex', 'ufile', 'rfile', 'encode'
    ];
    public function getOrderSub($order_idx){
        $builder = $this->db->table($this->table);
        $builder->where('order_idx', $order_idx);
        $query = $builder->get();
        return $query->getResultArray();
    }

}