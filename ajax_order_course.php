<?php
	session_start();
	if ( ! isset($_SESSION["uId"])){
		$status = "0";
		$msg = "您还没有登陆，请先登录！";
	}else{
		if(isset($_GET['rowId'])){
			include_once("dbconn/kw_db_conn.php");
			include_once("dbconn/sql_key_words_clean_up.php");
			include_once("udf/get_order_date.php");

			/* 验证客户手机号码是否正确 */
			$sQuery = "
				SELECT kw_user_mobile FROM  kwtbl_users WHERE kw_user_id = ".$_SESSION["uId"]."
			";
			$userList = mysql_query($sQuery);
			$user = mysql_fetch_array($userList);
			if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$|185[0-9]{8}$/", $user['kw_user_mobile'])) {

				$orderDate = getOrderDate($_GET['column']);
				$sQuery = "
					SELECT 1
					FROM kwtbl_order_main
					WHERE kw_order_date = '".$orderDate."'
					AND kw_course_time = ".$_GET['rowId']."
					AND kw_course_id = ".$_GET['courseId']."
					AND kw_user_id = ".$_SESSION["uId"]."
				";
				$orderList = mysql_query($sQuery);
				$num = mysql_num_rows($orderList);
				if($num > 0){
					$status = "4";
					$msg = "温馨提示：您已预约过当天课程！";
				}else{
					$iQuery = "
						INSERT INTO kwtbl_order_main(
							kw_course_time,
							kw_user_id,
							kw_course_id,
							kw_order_weekday,
							kw_order_date,
							kw_order_status
						)VALUES(
							".$_GET['rowId'].",
							".$_SESSION["uId"].",
							".$_GET['courseId'].",
							'".$_GET['column']."',
							'".$orderDate."',
							0
						)
					";
					mysql_query($iQuery);
					$status = "3";
					$msg = "您已完成预约，希望您能准时参加！";
				}
			}else{
				$status = "2";
				$msg = "请先进入[个人资料]设置您的手机号码！";
			}

			mysql_free_result($userList);
			mysql_close($conn);	
		}else{
			$status = "1";
			$msg = "丢失必要参数！";
		}
	}
	echo '{"status":"'.$status.'","msg":"'.$msg.'"}';
?>