<?php
	include_once("dbconn/kw_db_conn.php");
	$msgTitle = $_POST["msgTitle"];
	$msgContent = $_POST["msgContent"];
	session_start();
	if (isset($_SESSION["uId"])){
		$userId = $_SESSION["uId"];
	}else{
		$userId = 0;
	}
	$iQuery = "insert into kwtbl_messages (kw_user_id,kw_message_title,kw_message_content,kw_message_create_date) values ('".$userId."','".$msgTitle."','".$msgContent."','".date('Y-m-d H:i:s')."')";
	mysql_query($iQuery);
	mysql_close($conn);
?>
