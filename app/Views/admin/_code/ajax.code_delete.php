<?
	include $_SERVER[DOCUMENT_ROOT]."/include/lib.inc.php"; 

        $code_idx = $_POST['code_idx'];
		$sql      = " delete from tbl_code where code_idx='".$code_idx."'";
		$result   = mysqli_query($connect, $sql);
 

	if($result) {
       $msg = "삭제완료";
    } else{
       $msg = "삭제오류";
    }

    die("{\"message\":\"$msg\"}");
?>