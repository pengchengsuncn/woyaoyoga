<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Leave Message</title>
<script type="text/javascript">
	
	function validReg(){
		var msgStr = "";
		var _msgTitle = $.trim($("input[name='msg_title']").val());
		if(_msgTitle.length == 0){
			msgStr = "请输入留言标题！";
		}else{
			
				var _msgContent = $.trim($("textarea[name='msg_content']").val());
				if(_msgContent.length == 0){
					msgStr = "请输入留言内容！";
				}
		}
		
		if(msgStr != ""){
			$("#msgContainer").css("color","red");
			$("#msgContainer").html(msgStr);
		}else{
			$.ajax({
				type: "post",
				url: "leave_message_action.php",
				contentType: "application/x-www-form-urlencoded;charset=utf-8",
				data: {"msgTitle":_msgTitle,"msgContent":_msgContent},
				success:function(reStr){
					$("#msgContainer").css("color","green");
					$("#msgContainer").html("提交成功，感谢您的留言！");
					setTimeout("$.colorbox.close();",1500);
				}
			})
		}
	}
</script>
</head>

<body>

<p>&nbsp;<strong>请尽情留言吧 :)</strong></p>
<form action="" id="leave_message_form" method="post" accept-charset="utf-8">
	<table align="center">
		<tr>
			<td>标　题：</td>
			<td><input class="inputStyle" name="msg_title" maxlength="50" placeholder="请输入留言标题" type="text"></td>
		</tr>
		<tr>
			<td>内　容：</td>
			<td><textarea class="textareaStyle" name="msg_content" maxlength="1000" placeholder="请输入留言内容"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input value="提交" class="btn" onclick="validReg();" type="button"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><span id="msgContainer"></span></td>
		</tr>
	</table>
</form>

</body>
</html>
