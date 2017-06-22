<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	$pageCode = "add_teacher";
	include_once("admin_header.php");
?>

<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<form id="teacher-info">
			<fieldset>
				<legend>教师信息</legend>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">姓名</label>
						<input type="text" name="teacName" placeholder="请输入教师姓名" />
					</div>
				</div>
				<div class="row">
					<div class="large-6 medium-6 small-12 columns">
						<label class="label">电话</label>
						<input type="text" name="teacPhone" placeholder="请输入教师电话号码" />
					</div>
					<div class="large-6 medium-6 small-12 columns">
						<label class="label">手机</label>
						<input type="text" name="teacMobile" placeholder="请输入教师手机号码" />
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">邮箱</label>
						<input type="text" name="teacEmail" placeholder="请输入教师邮箱地址" />
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns">
						<label class="label">介绍</label>
						<textarea row="30" name="teacComments" rows="10" placeholder="请输入教师介绍"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="large-12 medium-12 small-12 columns text-center">
						<input type="submit" class="button" value="保存教师信息">
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
						if(window.confirm(rJSON.msg + "是否继续添加？")){
							window.location.reload();
						}else{
							window.location.href = "teacher_list.php";
						}
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