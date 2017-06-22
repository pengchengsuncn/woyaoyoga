<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['rowId'])){
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$qry = "
			UPDATE kwtbl_course_tbl SET
				kw_".$_GET['column']."_course = ".$_GET['courseId']."
			WHERE kw_course_tbl_id = ".$_GET['rowId']."
		";
		$status = "Y";
		$msg = "已成功更新课程表！";
		mysql_query($qry);
		mysql_close($conn);	
	}else{
		$status = "N";
		$msg = "丢失必要参数！";
	}
	echo '{"status":"'.$status.'","msg":"'.$msg.'"}';
?>