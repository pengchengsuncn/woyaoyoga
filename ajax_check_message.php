<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	include_once("dbconn/kw_db_conn.php");
	$approvedStatus = $_POST["approvedStatus"];
	$messageId = $_POST["messageId"];
	$userId = $_POST["userId"];
	$uQuery = "UPDATE kwtbl_messages SET kw_message_approved_flag = '".$approvedStatus."'
			   WHERE kw_message_id = ".$messageId." AND kw_user_id = ".$userId."";
	
	//如果审核通过，累加3积分,否则减去3积分	   
	if($approvedStatus == "Y"){
		$uUserPoints = "UPDATE kwtbl_users SET kw_user_points = (kw_user_points + 3)
						WHERE kw_user_id = ".$userId."";
	}else{
		$uUserPoints = "UPDATE kwtbl_users SET kw_user_points = (kw_user_points - 3)
						WHERE kw_user_id = ".$userId."";
	}
	mysql_query($uUserPoints);
	mysql_query($uQuery);
	mysql_close($conn);
?>
