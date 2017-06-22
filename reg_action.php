<?php
	include_once("dbconn/kw_db_conn.php");
	$userName = $_POST["userName"];
	$password = $_POST["userPassword"];
	$sQuery = "select * from kwtbl_users where kw_user_name = '".$userName."'";
	$userList = mysql_query($sQuery);
	$Num = mysql_num_rows($userList);
	if($Num > 0){
		echo "N";
	}else{
		$iQuery = "insert into kwtbl_users (kw_user_name,kw_user_password,kw_user_create_date) values ('".$userName."','".$password."','".date('Y-m-d H:i:s')."')";
		mysql_query($iQuery);
		$userId = mysql_insert_id();
		session_start();
		$_SESSION["uId"] = $userId;
		$_SESSION["uName"] = $userName;
		
		$iTrackStr = "insert into kwtbl_track_login (kw_user_id,kw_create_date,kw_source) values (".$userId.",'".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
		mysql_query($iTrackStr);
		
		echo "Y";
	}
	mysql_free_result($userList);
	mysql_close($conn);
?>
