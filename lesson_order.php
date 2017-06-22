<?php
	$pageCode = "lessonOrder";
	include_once("header.php");
	include_once("dbconn/kw_db_conn.php");
	include_once("udf/get_order_date.php");
	$sQuery = "
		SELECT *
		FROM kwtbl_course_tbl
		ORDER BY kw_course_tbl_id ASC
	";
	$courseTblList = mysql_query($sQuery);
?>
<div id="container">
<br />
	<table class="lesson-order-tbl">
		<caption><h1>瑜伽之光课程表</h1></caption>
		<tr>
			<td colspan="8">
				<span>
					<ul>
						<li><strong>[电话预约]</strong> 上课的会员朋友们，请提前两小时预约课程。预约电话：15986795649 李老师</li>
						<li><strong>[网站预约]</strong> 上课的会员朋友们，请提前一天预定，在此页面单击课程名称，然后点击确认即可。</li>
					</ul>
				</span>
			</td>
		</tr>
		<tr>
			<th>时间</th>
			<th>星期一（<?php echo getOrderDate("mon"); ?>）</th>
			<th>星期二（<?php echo getOrderDate("tues"); ?>）</th>
			<th>星期三（<?php echo getOrderDate("wed"); ?>）</th>
			<th>星期四（<?php echo getOrderDate("thur"); ?>）</th>
			<th>星期五（<?php echo getOrderDate("fri"); ?>）</th>
			<th>星期六（<?php echo getOrderDate("sat"); ?>）</th>
			<th>星期日（<?php echo getOrderDate("sun"); ?>）</th>
		</tr>
		<?php
			while($row=mysql_fetch_array($courseTblList)){
				echo "<tr>";
				echo "<td>".$row['kw_course_time']."</td>";
				$qry = "
					SELECT kw_course_name
					FROM kwtbl_courses
					WHERE kw_course_id = ".$row['kw_mon_course']."
				";
				$courseList = mysql_query($qry);
				$course = mysql_fetch_array($courseList);
				echo "<td id='ordercourse-".$row['kw_course_tbl_id']."-mon-".$row['kw_mon_course']."' class='order-course-qtip' title='单击课程名预定'><a href='javascript:void(0);'>".$course['kw_course_name']."</a></td>";
				$qry = "
					SELECT kw_course_name
					FROM kwtbl_courses
					WHERE kw_course_id = ".$row['kw_tues_course']."
				";
				$courseList = mysql_query($qry);
				$course = mysql_fetch_array($courseList);
				echo "<td id='ordercourse-".$row['kw_course_tbl_id']."-tues-".$row['kw_tues_course']."' class='order-course-qtip' title='单击课程名预定'><a href='javascript:void(0);'>".$course['kw_course_name']."</a></td>";
				$qry = "
					SELECT kw_course_name
					FROM kwtbl_courses
					WHERE kw_course_id = ".$row['kw_wed_course']."
				";
				$courseList = mysql_query($qry);
				$course = mysql_fetch_array($courseList);
				echo "<td id='ordercourse-".$row['kw_course_tbl_id']."-wed-".$row['kw_wed_course']."' class='order-course-qtip' title='单击课程名预定'><a href='javascript:void(0);'>".$course['kw_course_name']."</a></td>";
				$qry = "
					SELECT kw_course_name
					FROM kwtbl_courses
					WHERE kw_course_id = ".$row['kw_thur_course']."
				";
				$courseList = mysql_query($qry);
				$course = mysql_fetch_array($courseList);
				echo "<td id='ordercourse-".$row['kw_course_tbl_id']."-thur-".$row['kw_thur_course']."' class='order-course-qtip' title='单击课程名预定'><a href='javascript:void(0);'>".$course['kw_course_name']."</a></td>";
				$qry = "
					SELECT kw_course_name
					FROM kwtbl_courses
					WHERE kw_course_id = ".$row['kw_fri_course']."
				";
				$courseList = mysql_query($qry);
				$course = mysql_fetch_array($courseList);
				echo "<td id='ordercourse-".$row['kw_course_tbl_id']."-fri-".$row['kw_fri_course']."' class='order-course-qtip' title='单击课程名预定'><a href='javascript:void(0);'>".$course['kw_course_name']."</a></td>";
				$qry = "
					SELECT kw_course_name
					FROM kwtbl_courses
					WHERE kw_course_id = ".$row['kw_sat_course']."
				";
				$courseList = mysql_query($qry);
				$course = mysql_fetch_array($courseList);
				echo "<td id='ordercourse-".$row['kw_course_tbl_id']."-sat-".$row['kw_sat_course']."' class='order-course-qtip' title='单击课程名预定'><a href='javascript:void(0);'>".$course['kw_course_name']."</a></td>";
				$qry = "
					SELECT kw_course_name
					FROM kwtbl_courses
					WHERE kw_course_id = ".$row['kw_sun_course']."
				";
				$courseList = mysql_query($qry);
				$course = mysql_fetch_array($courseList);
				echo "<td id='ordercourse-".$row['kw_course_tbl_id']."-sun-".$row['kw_sun_course']."' class='order-course-qtip' title='单击课程名预定'><a href='javascript:void(0);'>".$course['kw_course_name']."</a></td>";
				echo "</tr>";
			}
			mysql_free_result($courseList);
			mysql_free_result($courseTblList);
			mysql_close($conn);
		?>
	</table>
	<br />
</div>
<?php
	include_once("footer.php");
?>

<script type="text/javascript">
	$(document).ready(function() {
		$(".order-course-qtip").qtip({
			content: {attr: "title"},
			position: {my:'bottom center', at:'top center'},
			style: {classes: 'ui-tooltip-green ui-tooltip-shadow'}
		});

		$("td[id^='ordercourse-']").click(function() {
			if (confirm("是否确认预约当天课程?")) {
				var courseTblAttrArray = $(this).attr("id").split("-");
				var _data = {
					"rowId":courseTblAttrArray[1],
					"column":courseTblAttrArray[2],
					"courseId":courseTblAttrArray[3]
				}
				$.getJSON("ajax_order_course.php", _data, function(rJSON, textStatus) {
					alert(rJSON.msg);
					if(rJSON.status === "0"){
						$("#loginLink").click();
					}
					if(rJSON.status === "2"){
						window.location.href = 'user_center.php';
					}
				});
			}
			
		});
	});
</script>