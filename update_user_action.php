<?php
	include_once("dbconn/kw_db_conn.php");
	
	$uId = $_POST["uId"];
	
	session_start();
	if ($_SESSION["uId"] != 1){
		if($_SESSION["uId"] != $uId){
			die("非法访问！");
		}
	}
	
	$uName = $_POST["userName"];
	$uGender = $_POST["userGender"];
	$uPwd = $_POST["userPassword"];
	$uAge = $_POST["userAge"];
	$uMobile = $_POST["userMobile"];
	$uEmail = $_POST["userEmail"];

	$uQuery = "UPDATE kwtbl_users SET
		kw_user_name = '".$uName."',
		kw_user_gender = '".$uGender."',
		kw_user_password = '".$uPwd."',
		kw_user_age = '".$uAge."',
		kw_user_mobile = '".$uMobile."',
		kw_user_email = '".$uEmail."'
	WHERE kw_user_id = ".$uId."";
	
	if(mysql_affected_rows()){
		echo "succ";
	}
			
	mysql_query($uQuery);
	mysql_close($conn);
?>