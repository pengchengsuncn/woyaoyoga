<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['teacId'])){
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$dQuery = "
			DELETE FROM kwtbl_teachers
			WHERE kw_teac_id = ".$_GET['teacId']."
		";
		$status = "Y";
		$msg = "已成功删除教师信息！";
		mysql_query($dQuery);
		mysql_close($conn);
	}else{
		$status = "N";
		$msg = "丢失必要参数！";
	}
	echo '{"status":"'.$status.'","msg":"'.$msg.'"}';
?>