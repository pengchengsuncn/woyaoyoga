<?php
	session_start();
	if ( ! isset($_SESSION["uId"])){
		echo "<script type='text/javascript'>";
		echo "window.location.href = 'index.php';";
		echo "</script>";
	}
?>