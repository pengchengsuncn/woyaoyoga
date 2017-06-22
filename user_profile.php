<?php
	include_once("check_session.php");
	$pageCode = "user_profile";
	include_once("admin_header.php");
	include_once("dbconn/kw_db_conn.php");
	include_once("dbconn/sql_key_words_clean_up.php");
	$uId = $_GET["uid"];
	//管理员可修改所有，个人只能修改自己的信息
	if ($_SESSION["uId"] != 1){
		if($_SESSION["uId"] != $uId){
			die("非法访问！");
		}
	}

	$sQuery = "SELECT * FROM  kwtbl_users WHERE kw_user_id = ".$uId."";
	$userList = mysql_query($sQuery);
	$user = mysql_fetch_array($userList);
?>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="panel">
			<h4 class="text-center">个人资料</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<form id="updateProfile" action="update_user_action.php" method="post">
			<?php
				echo "<label class='label'>用户名</label><input type='text' name='userName' value='".$user['kw_user_name']."' />";
				echo "<label class='label'>性别</label>";
				echo "<br />";
				echo "男";
				if($user['kw_user_gender'] == "female"){
					echo "<input type='radio' name='userGender' value='female' checked />";
				}else{
					echo "<input type='radio' name='userGender' value='female' />";
				}
				echo "女";
				if($user['kw_user_gender'] == "male"){
					echo "<input type='radio' name='userGender' value='male' checked />";
				}else{
					echo "<input type='radio' name='userGender' value='male' />";
				}
				echo "<br />";
				echo "<label class='label'>密码</label>";
				echo "<input type='password' name='userPassword' value='".$user['kw_user_password']."' />";
				echo "<label class='label'>年龄</label>";
				echo "<input type='text' name='userAge' value='".$user['kw_user_age']."'/>";
				echo "<label class='label'>手机</label>";
				echo "<input type='text' name='userMobile' value='".$user['kw_user_mobile']."'/>";
				echo "<label class='label'>邮箱</label>";
				echo "<input type='text' name='userEmail' value='".$user['kw_user_email']."'/>";
				echo "<input type='hidden' name='uId' value='".$uId."'/>";
				mysql_free_result($userList);
			?>
			<br /><br />
			<input type="submit" class="button" value="更新" />
		</form>
	</div>
</div>

<?php
	include_once("admin_footer.php");
?>
<script type="text/javascript">
	$( document ).ready( function (){
		
		//表单验证
		$("#updateProfile").validate({
			rules: {
				userName: {
					required: true,
					minlength: 2,
					maxlength: 25
				},
				userGender: {
					required: true
				},
				userPassword: {
					required: true,
					minlength: 6,
					maxlength: 16
				},
				userAge: {
					digits: true
				},
				userMobile: {
					digits: true
				},
				userEmail: {
					email:true
				}
				
			},
			messages: {
				userName: "会员名应在2-10个字符之间！",
				userGender: "请选择性别！",
				userPassword: "会员密码应在6-16个字符之间！",
				userAge: "请输入整数！",
				userMobile: "号码格式不对！",
				userEmail: "邮箱格式不正确！"
			},
			submitHandler:function(){ 
				$.post( "update_user_action.php", $("#updateProfile").serialize(), function( data ) {
					if(data == "succ"){
						alert("更新成功！");
					}
				});
			}
		});
	} );
	
</script>