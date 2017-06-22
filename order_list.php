﻿<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	$pageCode = "order_list";
	include_once("admin_header.php");
	include_once("dbconn/kw_db_conn.php");
	$sQuery = "
		SELECT
			a.kw_order_id, a.kw_order_date, a.kw_order_status,
			b.kw_user_name, b.kw_user_mobile,
			c.kw_course_name,
			d.kw_course_time			
		FROM kwtbl_order_main a
			INNER JOIN kwtbl_users b
				ON a.kw_user_id = b.kw_user_id
			INNER JOIN kwtbl_courses c
				ON a.kw_course_id = c.kw_course_id
			INNER JOIN kwtbl_course_tbl d
				ON a.kw_course_time = d.kw_course_tbl_id
		ORDER BY a.kw_order_date DESC

	";
	$orderList = mysql_query($sQuery);
?>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="panel">
			<h4 class="text-center">课程预约列表</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<table width="100%">
			<thead>
				<tr>
					<th class="text-center" width="100">
						姓名
					</th>
					<th class="text-center" width="100">
						手机
					</th>
					<th class="text-center">
						课程名称
					</th>
					<th class="text-center" width="100">
						上课日期
					</th>
					<th class="text-center" width="100">
						上课时间
					</th>
					<th class="text-center" width="100">
						预约状态
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($row = mysql_fetch_array($orderList)){
						echo "<tr>";
						echo "<td>".$row['kw_user_name']."</td>";
						echo "<td class='text-center'>".$row['kw_user_mobile']."</td>";
						echo "<td>".$row['kw_course_name']."</td>";
						echo "<td class='text-center'>".$row['kw_order_date']."</td>";
						echo "<td class='text-center'>".$row['kw_course_time']."</td>";
						switch ($row['kw_order_status']){
							case 1:
								echo "<td style='color:green;' class='text-center'>已完成</td>";
								break;
							case 2:
								echo "<td style='color:gray;' class='text-center'>已无效</td>";
								break;
							default:
								echo "<td class='text-center'>";
								echo "<select id='order-".$row['kw_order_id']."'>";
								echo "<option value='1'>完成</option>";
								echo "<option value='2'>无效</option>";
								echo "</select>";
								echo "</td>";
						}
						echo "</tr>";
					}
					mysql_free_result($orderList);
					mysql_close($conn);
				?>
			</tbody>
		</table>
	</div>
</div>

<?php
	include_once("admin_footer.php");
?>

<script>
	$(document).ready(function() {
		$("select[id^='order-']").change(function(){
			if (confirm("是否确认更新预约状态?")) {
				var orderId = $(this).attr("id").split("-")[1];
				var orderStatus = $(this).val();
				$.getJSON("ajax_order_status.php", {"orderId": orderId, "orderStatus": orderStatus}, function(rJSON, textStatus) {
					if(rJSON.status === "Y"){
						window.location.reload();
					}
					/* show error msg
						else{
							alert(rJSON.msg);
						}
					*/
				});
			}			
		});
	});
</script>