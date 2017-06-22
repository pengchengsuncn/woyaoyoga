<?php
	include_once("dbconn/kw_db_conn.php");
	include_once("dbconn/sql_key_words_clean_up.php");
	$userName = $_POST["userName"];
	$password = $_POST["userPassword"];
	$sQuery = "select * from kwtbl_users where kw_user_name = '".$userName."' and kw_user_password = '".$password."'";
	$userList = mysql_query($sQuery);
	$Num = mysql_num_rows($userList);
	if($Num > 0){
		$user = mysql_fetch_array($userList);
		session_start();
		$_SESSION["uId"] = $user['kw_user_id'];
		$_SESSION["uName"] = $user['kw_user_name'];
		
		//µÇÂ¼ËÍ1»ý·Ö£¬Ã¿ÌìÒ»´Î
		$sChkLoginStr = "SELECT * FROM kwtbl_track_login
						   WHERE DAY(kw_create_date) = DAY(NOW())
						   AND MONTH(kw_create_date) = MONTH(NOW())
						   AND YEAR(kw_create_date) = YEAR(NOW())
						   AND kw_user_id = ".$user['kw_user_id']."";
		$chkResult = mysql_query($sChkLoginStr);
		//¼ì²é½ñÌìÊÇ·ñÒÑ¾­µÇÂ¼¹ýÁË
		if (mysql_num_rows($chkResult) < 1) {
			$uUserPoints = "UPDATE kwtbl_users SET kw_user_points = (kw_user_points + 1)
							WHERE kw_user_id = ".$user['kw_user_id']."";
			mysql_query($uUserPoints);
		}
		mysql_free_result($chkResult);
		
		//¼ÇÂ¼µÇÂ¼
		$iTrackStr = "INSERT INTO kwtbl_track_login (kw_user_id,kw_create_date,kw_source)
					  VALUES (".$user['kw_user_id'].",'".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
		mysql_query($iTrackStr);
		
		echo "Y";
	}else{
		echo "N";
	}
	mysql_free_result($userList);
	mysql_close($conn);
?>
