<?php
	function getOrderDate($weekDay){
		$currWeekDayNo = date("w");
		if($currWeekDayNo == 0){
			$currWeekDayNo = 7;
		}
		switch ($weekDay){
			case "mon":
				$orderWeekDayNo = 1;
				break;
			case "tues":
				$orderWeekDayNo = 2;
				break;
			case "wed":
				$orderWeekDayNo = 3;
				break;
			case "thur":
				$orderWeekDayNo = 4;
				break;
			case "fri":
				$orderWeekDayNo = 5;
				break;
			case "sat":
				$orderWeekDayNo = 6;
				break;
			default:
				$orderWeekDayNo = 7;
		}
		/* 预定这周的 */
		if($orderWeekDayNo > $currWeekDayNo){
			$diffDayNo = $orderWeekDayNo - $currWeekDayNo;
		}else{
			$diffDayNo = 7 - ($currWeekDayNo - $orderWeekDayNo);
		}
		$orderDate = date('Y-m-d', strtotime($diffDayNo . ' days'));
		return $orderDate;
	}
?>