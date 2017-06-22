<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['courseId'])){
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$dQuery = "
			DELETE FROM kwtbl_courses
			WHERE kw_course_id = ".$_GET['courseId']."
		";
		$status = "Y";
		$msg = "已成功删除课程信息！";
		mysql_query($dQuery);
		mysql_close($conn);
	}else{
		$status = "N";
		$msg = "丢失必要参数！";
	}
	echo '{"status":"'.$status.'","msg":"'.$msg.'"}';
?>