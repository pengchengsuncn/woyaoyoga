<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['orderId'])){
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$uQuery = "
			UPDATE kwtbl_order_main SET
				kw_order_status = ".$_GET['orderStatus']."
			WHERE kw_order_id = ".$_GET['orderId']."
		";
		$status = "Y";
		$msg = "已经成功更新预约状态！";
		mysql_query($uQuery);
		mysql_close($conn);
	}else{
		$status = "N";
		$msg = "丢失必要参数！";
	}
	echo '{"status":"'.$status.'","msg":"'.$msg.'"}';
?>