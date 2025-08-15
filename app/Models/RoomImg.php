<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomImg extends Model
{
    protected $table = 'tbl_room_img';

    protected $primaryKey = 'i_idx';

    protected $allowedFields = [
        "room_idx", "ufile", "rfile", "onum", "m_date", "r_date"
    ];

    protected function initialize()
    {
    }

    public function getImg($room_idx)
    {
		return $this->where('room_idx', $room_idx)
                    ->where('ufile !=', '') // ufile이 공란이 아닌 경우
                    ->orderBy("onum", "asc")
                    ->orderBy("i_idx", "asc")
                    ->findAll();

        //return $this->where('room_idx', $room_idx)->orderBy("i_idx", "asc")->findAll();
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter($data, function ($key) use ($allowedFields, $data) {
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

    public function copyImage($room_idx, $new_room_idx)
    {
        $info = $this->where("room_idx", $room_idx)->get()->getResultArray();

        $data = [];

        foreach($info as $row) {
            unset($row['i_idx']);
            $row['room_idx'] = $new_room_idx;
            $row['r_date'] = date("Y-m-d H:i:s");
            $data[] = $row;
        }

        if (!empty($data)) {
            $this->insertBatch($data);
        }

    }
}