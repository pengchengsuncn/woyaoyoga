<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['courseName'])){
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$status = "Y";
		if($_GET['teacId'] == ""){
			$teacId = "NULL";
		}
		if(isset($_GET['courseId'])){
			$qry = "
				UPDATE kwtbl_courses SET
					kw_course_name = '".$_GET['courseName']."',
					kw_course_desc = '".$_GET['courseDesc']."',
					kw_teacher_id = ".$teacId."
				WHERE kw_course_id = ".$_GET['courseId']."
			";
			$msg = "已成功更新课程信息！";
		}else{
			$qry = "
				INSERT INTO kwtbl_courses (
					kw_course_name,
					kw_course_desc,
					kw_teacher_id
				) VALUES(
					'".$_GET['courseName']."',
					'".$_GET['courseDesc']."',
					".$teacId."
				)
			";
			$msg = "已成功添加新课程！";
		}
		mysql_query($qry);
		mysql_close($conn);	
	}else{
		$status = "N";
		$msg = "丢失必要参数！";
	}
	echo '{"status":"'.$status.'","msg":"'.$msg.'"}';
?>