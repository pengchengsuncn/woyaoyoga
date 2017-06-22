<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登录</title>
<link rel="stylesheet" href="style/base.css" type="text/css" media="screen" />
<script type="text/javascript">
	
	function validReg(){
		var msgStr = "";
		var regN=/^[a-zA-Z\d\u4e00-\u9fa5]*$/;
		var _userName = $.trim($("input[name='userName']").val());
		if(_userName.length < 2 || _userName.length > 10){
			msgStr = "会员名应在2-10个字符之间！";
		}else{
			if(!regN.test(_userName)){
				msgStr = "会员名不少于2位数字或中英组合！";
			}else{
				var regP = /^[A-Za-z0-9]+$/;
				var _userPassword = $.trim($("input[name='userPassword']").val());
				if(_userPassword.length < 6 || _userPassword.length > 16){
					msgStr = "会员密码应在6-16个字符之间！";
				}else{
					if(!regP.test(_userPassword)){
						msgStr = "会员密码不少于6位数字和字母组合";
					}
				}
			}
		}
		
		if(msgStr != ""){
			$("#msgContainer").css("color","red");
			$("#msgContainer").html(msgStr);
		}else{
			$.ajax({
				type: "post",
				url: "login_action.php",
				contentType: "application/x-www-form-urlencoded;charset=utf-8",
				data: $("#login_form").serialize(),
				success:function(reStr){
					if($.trim(reStr) == "Y"){
						$("#msgContainer").css("color","green");
						$("#msgContainer").html("恭喜您登录成功！正在跳转到首页...");
						setTimeout("window.location.reload();",1500);
					}else{
						$("#msgContainer").css("color","red");
						$("#msgContainer").html("用户名或密码不正确！");
					}
				}
			})
		}
	}
</script>
</head>

<body>
	<p>欢迎登录！</p>
<form action="" id="login_form" method="post" accept-charset="utf-8">
	<table align="center">
		<tr>
			<td>会员名：</td>
			<td><input class="inputStyle" name="userName" maxlength="10" placeholder="不少于2位数字或中英组合" type="text"></td>
		</tr>
		<tr>
			<td>密　码：</td>
			<td><input class="inputStyle" name="userPassword" maxlength="16" placeholder="不少于6位数字和字母组合" type="password"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input value="登录" class="btn" onclick="validReg();" type="button"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><span id="msgContainer"></span></td>
		</tr>
	</table>
</form>
</body>
</html>
