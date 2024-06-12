<?
	include $_SERVER['DOCUMENT_ROOT']."/include/lib.inc.php";

	$userid = $_GET['userid'];

	echo chk_member_id($userid);
?>