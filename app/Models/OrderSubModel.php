<?php

use CodeIgniter\Model;

class OrderSubModel extends Model
{
    protected $table = 'tbl_order_list';
    protected $primaryKey = 'gl_idx';
    protected $allowedFields = [
        'm_idx', 'order_idx', 'product_idx', 'number_room', 'order_gubun', 'order_name_kor', 'order_first_name', 'order_last_name'
        , 'passport_num', 'passport_date', 'order_birthday', 'order_mobile', 'order_email', 'order_sex', 'ufile', 'rfile', 'encode'
        , 'order_full_name'
    ];
    public function getOrderSub($order_idx){

        $private_key = private_key();

        $fsql = " SELECT order_gubun, number_room
        , AES_DECRYPT(UNHEX(order_name_kor),   '$private_key') AS order_name_kor
        , AES_DECRYPT(UNHEX(order_first_name), '$private_key') AS order_first_name
        , AES_DECRYPT(UNHEX(order_full_name),  '$private_key') AS order_full_name
        , AES_DECRYPT(UNHEX(order_last_name),  '$private_key') AS order_last_name
        , AES_DECRYPT(UNHEX(order_mobile),     '$private_key') AS order_mobile
        , AES_DECRYPT(UNHEX(passport_num),     '$private_key') AS passport_num
        , AES_DECRYPT(UNHEX(order_email),      '$private_key') AS order_email
        , order_birthday
        , passport_date
        , order_sex
        , gl_idx
        , ufile
        , rfile FROM tbl_order_list WHERE order_idx = '" . $order_idx . "' ORDER BY gl_idx asc";

        return $this->db->query($fsql)->getResultArray();
    }

}