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
    protected $roomImg;
    protected $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->roomImg = new RoomImg();
        $this->productModel = new ProductModel();
    }

    public function copyRooms($product_idx, $new_product_idx)
    {
        $info = $this->where("hotel_code", $product_idx)->get()->getResultArray();

        $product = $this->productModel->getById($new_product_idx);
        $stay_idx = $product['stay_idx'] ?? '';

        $_arr_room_list = [];

        foreach($info as $row) {
            $room_idx = $row['g_idx'];
            unset($row['g_idx']);
            $row['hotel_code'] = $new_product_idx;
            $new_room_idx = $this->insert($row);
            $img_list = $this->roomImg->where('room_idx', $room_idx)->get()->getResultArray();
            foreach($img_list as $img) {
                unset($img['i_idx']);
                $img['room_idx'] = $new_room_idx;
                $img['r_date'] = date("Y-m-d H:i:s");
                $this->roomImg->insert($img);
            }

            $rooms_list = $this->db->table('tbl_hotel_rooms')->where('g_idx', $room_idx)
                                                          ->where('goods_code', $product_idx)
                                                          ->get()->getResultArray();
            foreach($rooms_list as $room) {
                $rooms_idx = $room['rooms_idx'];
                unset($room['rooms_idx']);
                $room['g_idx'] = $new_room_idx;
                $room['goods_code'] = $new_product_idx;
                $room['reg_date'] = date("Y-m-d H:i:s");
                $new_id = $this->db->table('tbl_hotel_rooms')->insert($room);

                $beds_list = $this->db->table('tbl_room_beds')->where('rooms_idx', $room_idx)->get()->getResultArray();
                foreach($beds_list as $bed) {
                    $bed_idx = $bed['bed_idx'];
                    unset($bed['bed_idx']);
                    $bed['rooms_idx'] = $new_id;
                    $bed['reg_date'] = date("Y-m-d H:i:s");
                    $new_bed_idx = $this->db->table('tbl_room_beds')->insert($bed);

                    $room_price_list = $this->db->table('tbl_room_price')->where('product_idx', $product_idx)
                                                                                ->where('g_idx', $room_idx)
                                                                                ->where('rooms_idx', $rooms_idx)
                                                                                ->where('bed_idx', $bed_idx)
                                                                                ->orderBy('goods_date', "asc")
                                                                                ->get()->getResultArray();

                    foreach($room_price_list as $room_price) {
                        unset($room_price['idx']);
                        $room_price['product_idx'] = $new_product_idx;
                        $room_price['g_idx'] = $new_room_idx;
                        $room_price['rooms_idx'] = $new_id;
                        $room_price['bed_idx'] = $new_bed_idx;
                        $room_price['reg_date'] = date("Y-m-d H:i:s");
                        $this->db->table('tbl_room_price')->insert($room_price);
                    }
                }
            }

            array_push($_arr_room_list, $new_room_idx);
        }

        $list__room_list = implode('|', $_arr_room_list);

        $updateQuery = "UPDATE tbl_product_stay SET room_list = ? WHERE stay_idx = ?";
        $this->db->query($updateQuery, [$list__room_list, $stay_idx]);
    }
}
