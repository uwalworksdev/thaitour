<?php

namespace App\Libraries;

use Config\Database;

/******************
 * Db 클래스
 ******************/
class Db
{
    public $connect; //디비 컨넥트 인자
    public $conf;

    public function __construct($info = "")
    {
        $this->connect = Database::connect();
    }


    public function sqlConnect($host, $user, $passwd, $name, $charset = "utf8")
    {
        $connect = mysqli_connect($host, $user, $passwd, $name)
        or die(sprintf("Db 서버에 연결할 수 없습니다($user@$host) [%s] : %s", mysqli_connect_errno(), mysqli_connect_error()));
        mysqli_set_charset($connect, $charset);

        // DB 설정
        $sql = "SHOW VARIABLES WHERE Variable_name='max_allowed_packet'";
        $arr = $this->sqlSelect($sql, $connect);
        $cnt = count($arr);

        $this->conf = array();
        for ($i = 0; $i < $cnt; $i++) {
            $row = $arr[$i];
            $this->conf[$row['Variable_name']] = $row['Value'];
        }

        return $connect;
    }


    public function sqlFieldArr($table)
    {
        $arr = array();

        if (is_string($table)) { // 주어진 테이블의 필드명
            $sql = "SHOW COLUMNS FROM " . $table;
            $result = $this->sqlSelect($sql);
            $count = count($result);
            for ($i = 0; $i < $count; $i++) {
                $arr[] = $result[$i]['Field'];
            }
        } else if (is_array($table)) { // 주어진 배열의 필드명 (row)
            $arr = array_keys($table);

            // DB select 결과에는 0, r_a, 1, r_b, 2, r_c, ...식으로 들어있다.
            if ($arr[0] == "0" && $arr[2] == "1") {
                $tmp = array();
                $cnt = count($arr);

                for ($i = 0; $i < $cnt; $i += 2) {
                    $tmp[] = $arr[$i + 1];
                }
                $arr = $tmp;
            }
        }

        if (count($arr) > 0) {
            return $arr;
        } else {
            return false;
        }
    }


    public function escape_str($str)
    {
        return mysqli_real_escape_string($this->connect, $str);
    }



    // 입력값을 배열로 처리하여 안전한 쿼리 생성
    // 쿼리의 값 순서와 배열의 순서가 일치해야 한다.
    // 쿼리의 값 자리는 '%s' 로 처리한다.
    public function sqlGetQuery($query, $arr)
    {
        $args = array();
        $args[] = $query; // 첫번째 파라메터는 query

        $cnt = count($arr);
        for ($i = 0; $i < $cnt; $i++) {
            $args[] = $this->$arr[$i];
        }

        $query = call_user_func_array("sprintf", $args);
        return $query;
    }

    // Insert Query
    public function sqlInsertQuery($table, $arr)
    {
        $arr_field = array();
        $arr_value = array();
        foreach ($arr as $key => $value) {
            $arr_field[] = $key;
            $arr_value[] = $value;
        }

        if (count($arr_field) < 1) {
            return "";
        }

        $query = "INSERT INTO $table (";
        $query .= "`" . implode("`, `", $arr_field) . "`";
        $query .= ") VALUES (";
        // $query .= "'%s'" . str_repeat(", '%s'", count($arr_field) - 1);
        $query .= "'" . implode("', '", $arr_value) . "'";
        $query .= ")";

        // return $this->sqlGetQuery($query, $arr_value);
        return $query;
    }


    // Replace Query
    public function sqlReplaceQuery($table, $arr)
    {
        $arr_field = array();
        $arr_value = array();
        foreach ($arr as $key => $value) {
            $arr_field[] = $key;
            $arr_value[] = $value;
        }

        if (count($arr_field) < 1) {
            return "";
        }

        $query = "REPLACE INTO $table (";
        $query .= "`" . implode(", ", $arr_field) . "`";
        $query .= ") VALUES (";
        $query .= "'%s'" . str_repeat(", '%s'", count($arr_field) - 1);
        $query .= ")";

        return $this->sqlGetQuery($query, $arr_value);
    }

    // Update Query
    public function sqlUpdateQuery($table, $arr, $where, $extra = "")
    {
        $arr_field = array();
        $arr_value = array();
        foreach ($arr as $key => $value) {
            $arr_field[] = "`" . $key . "`='$value'";
            $arr_value[] = $value;
        }

        if (count($arr_field) < 1) {
            return "";
        }

        $query = "UPDATE $table SET ";
        $query .= $extra;
        $query .= implode(", ", $arr_field);
        $query .= $where;

        return $query;
    }

    //-- Db에 쿼리를 실행한다. (insert, update, delete)
    public function sqlQuery($query, $_connect = "")
    {
        if ($query == "") {
            return false;
        }

        // \r\n -> \n
        $query = str_replace("\r", "\n", $query);

        // 문자셋 변환 (UTF-8 -> EUC-KR)
        //$query = iconv("UTF-8", "euc-kr//IGNORE", $query);

        $query_len = strlen($query);
//		if ($this->conf['max_allowed_packet'] > 0 && $query_len > $this->conf['max_allowed_packet']) {
//			die("DB Error : 데이터 양이 너무 많습니다.");
//		}

        $result['result'] = $this->connect->query($query);
        if (!$result['result']) {
            echo "<br>sql - " . $query;
            exit;
        }
        $result['cnt'] = $this->connect->affectedRows() ?? $result['result']->getNumRows();

        return $result;
    }

    public function sqlSelectOne($query, $connect = "")
    {
        $re = $this->sqlQuery($query, $connect);
        if ($re['cnt'] > 0) {
            $re1 = $re['result']->getRowArray();
            return $re1;
        }
    }

    public function sqlSelect($query, $connect = "")
    {
        $re = $this->sqlQuery($query, $connect);
        $re1 = $re['result']->getResultArray();
        return $re1;
    }

    public function sqlSelectArray($query, $key, $val = "", $connect = "")
    {
        $re = $this->sqlSelect($query, $connect);
        $cnt = count($re);

        $arr = array();
        for ($i = 0; $i < $cnt; $i++) {
            $row = $re[$i];
            $arr[$row[$key]] = ($val != "") ? $row[$val] : $row;
        }
        return $arr;
    }

    public function sqlLastId($connect = "")
    {
        $row = $this->sqlSelectOne("SELECT LAST_INSERT_ID() id", $connect);
        return $row['id'];
    }

    public function error($connect = "")
    {
        if (!$connect) {
            $connect = $this->connect;
        }

        return mysqli_error($connect);
    }


}

?>