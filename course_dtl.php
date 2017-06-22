<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['courseId'])){
		$pageCode = "add_course";
		include_once("admin_header.php");
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$sQuery = "
			SELECT *
			FROM kwtbl_courses
			WHERE kw_course_id = ".$_GET['courseId']."
		";
		$courseList = mysql_query($sQuery);
		$course = mysql_fetch_array($courseList);

		$teacQuery = "
			SELECT kw_teac_id, kw_teac_name
			FROM kwtbl_teachers
		";
		$teacherList = mysql_query($teacQuery);
	}else{
		die("非法访问或丢失必要参数！");
	}
	
?>

<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<form id="teacher-info">
			<fieldset>
				<legend>课程信息</legend>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">名称</label>
						<input type="text" name="courseName" placeholder="请输入课程名称" value="<?php echo $course['kw_course_name']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">介绍</label>
						<textarea row="30" name="courseDesc" rows="10" placeholder="请输入课程介绍"><?php echo $course['kw_course_desc']; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">任课教师</label>
						<select name="teacId">
							<option value="">
								请选择
							</option>
							<?php
								while($row=mysql_fetch_array($teacherList)){
									if($row['kw_teac_id'] == $course['kw_teacher_id']){
										echo "<option value='".$row['kw_teac_id']."' selected >".$row['kw_teac_name']."</option>";
									}else{
										echo "<option value='".$row['kw_teac_id']."'>".$row['kw_teac_name']."</option>";
									}
								}
								mysql_free_result($courseList);
								mysql_free_result($teacherList);
								mysql_close($conn);
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns text-center">
						<input type="hidden" name="courseId" value="<?php echo $_GET['courseId']; ?>" />
						<input type="submit" class="button" value="更新课程信息">
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<?php
	include_once("admin_footer.php");
?>

<script>
	$(document).ready(function() {
		$("#teacher-info").validate({
			rules: {
				courseName: {
					required: true,
					minlength: 2,
					maxlength: 20
				}
			},
			messages: {
				courseName: "课程名称应在2-20个字符之间！"
			},
			submitHandler:function(form){
				$.getJSON("ajax_save_course.php", $(form).serialize(), function(rJSON, textStatus) {
					if(rJSON.status === "Y"){
						alert(rJSON.msg);
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