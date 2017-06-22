<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	$pageCode = "course_list";
	include_once("admin_header.php");
	include_once("cust_substr.php");
	include_once("dbconn/kw_db_conn.php");
	$sQuery = "
		SELECT
			a.kw_course_id, a.kw_course_name, a.kw_course_desc,
			IFNULL(b.kw_teac_name,'未定义') kw_teac_name
		FROM kwtbl_courses a
		LEFT OUTER JOIN kwtbl_teachers b
		ON a.kw_teacher_id = b.kw_teac_id
	";
	$courseList = mysql_query($sQuery);
?>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="panel">
			<h4 class="text-center">课程列表</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<table width="100%">
			<thead>
				<tr>
					<th class="text-center">
						名称
					</th>
					<th class="text-center" width="80">
						任课老师
					</th>
					<th class="text-center" width="300">
						介绍
					</th>
					<th class="text-center" width="80">
						操作
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($row=mysql_fetch_array($courseList)){
						echo "<tr>";
						echo "<td>".$row['kw_course_name']."</td>";
						if($row['kw_teac_name'] == "未定义"){
							echo "<td style='color:red;'>".$row['kw_teac_name']."</td>";
						}else{
							echo "<td>".$row['kw_teac_name']."</td>";
						}
						echo "<td>";
						if(strlen($row['kw_course_desc']) > 30){
							echo "<span data-tooltip class='has-tip tip-top' title='".$row['kw_course_desc']."'>".custsubstr($row['kw_course_desc'],30)."</span>";
						}else{
							echo $row['kw_course_desc'];
						}
						echo "</td>";
						echo "<td class='text-center'><a href='course_dtl.php?courseId=".$row['kw_course_id']."'><img src='images/edit.png' /></a>&nbsp;&nbsp;&nbsp;<a id='del-course-".$row['kw_course_id']."' href='javascript:void(0);'><img src='images/del.png' /></a></td>";
						echo "</tr>";
					}
					mysql_free_result($courseList);
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
		$("a[id^='del-course-']").click(function(){
			if (confirm("是否将此课程信息删除?")) {
				var courseId = $(this).attr("id").split("-")[2];
				$.getJSON("ajax_del_course.php", {"courseId": courseId}, function(rJSON, textStatus) {
					if(rJSON.status === "Y"){
						alert(rJSON.msg);
						$("#del-course-" + courseId).closest("tr").fadeOut(1000, function() {
							$(this).closest("tr").remove();
						});
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