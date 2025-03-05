<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomPriceModel extends Model
{
    protected $table         = 'tbl_room_price';
    protected $primaryKey    = ['idx']; // 키
    protected $allowedFields = [ 
									'idx',	
									'product_idx',	
									'g_idx',	
									'rooms_idx',
									'goods_date',	
									'dow',	
									'baht_thai',
									'goods_price1',	
									'goods_price2',
									'goods_price3',	
									'use_yn',	
									'reg_date',	
									'upd_date' 
							   ];

			
    public function bulkInsertOrUpdate($data)
    {
        if (!empty($data)) {
            $db      = \Config\Database::connect();
            $builder = $db->table($this->table);

            // ON DUPLICATE KEY UPDATE 쿼리 사용
            $sql    = "INSERT INTO tbl_room_price (g_idx, rooms_idx, o_sdate, o_edate, goods_price1, goods_price2, goods_price3) VALUES ";
            $values = [];
            $params = [];

            foreach ($data as $row) {
                $values[] = "(?, ?, ?, ?, ?, ?, ?)";
                $params[] = $row['g_idx'];
                $params[] = $row['rooms_idx'];
                $params[] = $row['o_sdate'];
                $params[] = $row['o_edate'];
                $params[] = $row['goods_price1'];
                $params[] = $row['goods_price2'];
                $params[] = $row['goods_price3'];
            }

            $sql .= implode(',', $values);
            $sql .= " ON DUPLICATE KEY UPDATE price = VALUES(price)";

            $builder->query($sql, $params);
        }
    }

}

?>