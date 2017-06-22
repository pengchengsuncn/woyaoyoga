<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['teacName'])){
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$status = "Y";
		if(isset($_GET['teacId'])){
			$qry = "
				UPDATE kwtbl_teachers SET
					kw_teac_name = '".$_GET['teacName']."',
					kw_teac_phone = '".$_GET['teacPhone']."',
					kw_teac_mobile = '".$_GET['teacMobile']."',
					kw_teac_email = '".$_GET['teacEmail']."',
					kw_teac_comments = '".$_GET['teacComments']."'
				WHERE kw_teac_id = ".$_GET['teacId']."
			";
			$msg = "已成功更新教师信息！";
		}else{
			$qry = "
				INSERT INTO kwtbl_teachers (
					kw_teac_name,
					kw_teac_phone,
					kw_teac_mobile,
					kw_teac_email,
					kw_teac_comments,
					kw_teac_create_date
				) VALUES(
					'".$_GET['teacName']."',
					'".$_GET['teacPhone']."',
					'".$_GET['teacMobile']."',
					'".$_GET['teacEmail']."',
					'".$_GET['teacComments']."',
					'".date('Y-m-d H:i:s')."'
				)
			";
			$msg = "已成功添加新教师！";
		}
			
		mysql_query($qry);
		mysql_close($conn);	
	}else{
		$status = "N";
		$msg = "丢失必要参数！";
	}
	echo '{"status":"'.$status.'","msg":"'.$msg.'"}';
?>