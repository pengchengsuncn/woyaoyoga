<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	$pageCode = "course_tbl";
	include_once("admin_header.php");
	include_once("dbconn/kw_db_conn.php");
	$sQuery = "
		SELECT *
		FROM kwtbl_course_tbl
	";
	$courseQuery = "
		SELECT kw_course_id, kw_course_name
		FROM kwtbl_courses
	";
	$courseTblList = mysql_query($sQuery);
?>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="panel">
			<h4 class="text-center">选择以设置课表</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<table width="100%">
			<thead>
				<tr>
					<th class="text-center">
						时间
					</th>
					<th class="text-center">
						星期一
					</th>
					<th class="text-center">
						星期二
					</th>
					<th class="text-center">
						星期三
					</th>
					<th class="text-center">
						星期四
					</th>
					<th class="text-center">
						星期五
					</th>
					<th class="text-center">
						星期六
					</th>
					<th class="text-center">
						星期日
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($row=mysql_fetch_array($courseTblList)){
						echo "<tr>";
						echo "<td><input type='text' disabled='disabled' value='".$row['kw_course_time']."' /></td>";
						$courseList = mysql_query($courseQuery);
						echo "<td><select id='coursetbl-".$row['kw_course_tbl_id']."-mon'>";
						while($course=mysql_fetch_array($courseList)){
							if($row['kw_mon_course'] == $course['kw_course_id']){
								echo "<option value=".$course['kw_course_id']." selected >".$course['kw_course_name']."</option>";
							}else{
								echo "<option value=".$course['kw_course_id']." >".$course['kw_course_name']."</option>";
							}
						}
						echo "</select></td>";
						$courseList = mysql_query($courseQuery);
						echo "<td><select id='coursetbl-".$row['kw_course_tbl_id']."-tues'>";
						while($course=mysql_fetch_array($courseList)){
							if($row['kw_tues_course'] == $course['kw_course_id']){
								echo "<option value=".$course['kw_course_id']." selected >".$course['kw_course_name']."</option>";
							}else{
								echo "<option value=".$course['kw_course_id']." >".$course['kw_course_name']."</option>";
							}
						}
						echo "</select></td>";
						$courseList = mysql_query($courseQuery);
						echo "<td><select id='coursetbl-".$row['kw_course_tbl_id']."-wed'>";
						while($course=mysql_fetch_array($courseList)){
							if($row['kw_wed_course'] == $course['kw_course_id']){
								echo "<option value=".$course['kw_course_id']." selected >".$course['kw_course_name']."</option>";
							}else{
								echo "<option value=".$course['kw_course_id']." >".$course['kw_course_name']."</option>";
							}
						}
						echo "</select></td>";
						$courseList = mysql_query($courseQuery);
						echo "<td><select id='coursetbl-".$row['kw_course_tbl_id']."-thur'>";
						while($course=mysql_fetch_array($courseList)){
							if($row['kw_thur_course'] == $course['kw_course_id']){
								echo "<option value=".$course['kw_course_id']." selected >".$course['kw_course_name']."</option>";
							}else{
								echo "<option value=".$course['kw_course_id']." >".$course['kw_course_name']."</option>";
							}
						}
						echo "</select></td>";
						$courseList = mysql_query($courseQuery);
						echo "<td><select id='coursetbl-".$row['kw_course_tbl_id']."-fri'>";
						while($course=mysql_fetch_array($courseList)){
							if($row['kw_fri_course'] == $course['kw_course_id']){
								echo "<option value=".$course['kw_course_id']." selected >".$course['kw_course_name']."</option>";
							}else{
								echo "<option value=".$course['kw_course_id']." >".$course['kw_course_name']."</option>";
							}
						}
						echo "</select></td>";
						$courseList = mysql_query($courseQuery);
						echo "<td><select id='coursetbl-".$row['kw_course_tbl_id']."-sat'>";
						while($course=mysql_fetch_array($courseList)){
							if($row['kw_sat_course'] == $course['kw_course_id']){
								echo "<option value=".$course['kw_course_id']." selected >".$course['kw_course_name']."</option>";
							}else{
								echo "<option value=".$course['kw_course_id']." >".$course['kw_course_name']."</option>";
							}
						}
						echo "</select></td>";
						$courseList = mysql_query($courseQuery);
						echo "<td><select id='coursetbl-".$row['kw_course_tbl_id']."-sun'>";
						while($course=mysql_fetch_array($courseList)){
							if($row['kw_sun_course'] == $course['kw_course_id']){
								echo "<option value=".$course['kw_course_id']." selected >".$course['kw_course_name']."</option>";
							}else{
								echo "<option value=".$course['kw_course_id']." >".$course['kw_course_name']."</option>";
							}
						}
						echo "</select></td>";
						echo "</tr>";
					}
					mysql_free_result($courseList);
					mysql_free_result($courseTblList);
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
		$("select[id^='coursetbl-']").change(function(){
			var courseTblAttrArray = $(this).attr("id").split("-");
			var rowId = courseTblAttrArray[1];	
			var column = courseTblAttrArray[2];	
			var courseId = $(this).val();
			var _data = {
				"rowId":rowId,
				"column":column,
				"courseId":courseId
			}
			$.getJSON("ajax_set_course_tbl.php", _data, function(json, textStatus) {
				
			});
		});
	});
</script>