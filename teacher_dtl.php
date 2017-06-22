<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	if(isset($_GET['teacId'])){
		$pageCode = "add_teacher";
		include_once("admin_header.php");
		include_once("dbconn/kw_db_conn.php");
		include_once("dbconn/sql_key_words_clean_up.php");
		$sQuery = "
			SELECT *
			FROM kwtbl_teachers
			WHERE kw_teac_id = ".$_GET['teacId']."
		";
		$teacList = mysql_query($sQuery);
		$teac = mysql_fetch_array($teacList);
	}else{
		die("非法访问或丢失必要参数！");
	}
	
?>

<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<form id="teacher-info">
			<fieldset>
				<legend>教师信息</legend>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">姓名</label>
						<input type="text" name="teacName" placeholder="请输入教师姓名" value="<?php echo $teac['kw_teac_name']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="large-6 medium-6 small-12 columns">
						<label class="label">电话</label>
						<input type="text" name="teacPhone" placeholder="请输入教师电话号码" value="<?php echo $teac['kw_teac_phone']; ?>" />
					</div>
					<div class="large-6 medium-6 small-12 columns">
						<label class="label">手机</label>
						<input type="text" name="teacMobile" placeholder="请输入教师手机号码" value="<?php echo $teac['kw_teac_mobile']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">邮箱</label>
						<input type="text" name="teacEmail" placeholder="请输入教师邮箱地址" value="<?php echo $teac['kw_teac_email']; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">介绍</label>
						<textarea row="30" name="teacComments" rows="10" placeholder="请输入教师介绍"><?php echo $teac['kw_teac_comments']; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns text-center">
						<input type="hidden" name="teacId" value="<?php echo $_GET['teacId']; ?>" />
						<input type="submit" class="button" value="更新教师信息">
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
				teacName: {
					required: true,
					minlength: 2,
					maxlength: 20
				},
				teacPhone: {
					minlength: 7,
					maxlength: 20
				},
				teacMobile: {
					digits: true,
					minlength: 11,
					maxlength: 11
				},
				teacEmail: {
					email: true
				}
			},
			messages: {
				teacName: "教师姓名应在2-20个字符之间！",
				teacPhone: "电话应在7-20个字符之间！",
				teacMobile: "手机号码应是11个！",
				teacEmail: "电子邮箱格式不正确！"
			},
			submitHandler:function(form){
				$.getJSON("ajax_save_teacher.php", $(form).serialize(), function(rJSON, textStatus) {
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