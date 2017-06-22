<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	$pageCode = "chk_msg";
	include_once("admin_header.php");
	include_once("cust_substr.php");
	include_once("dbconn/kw_db_conn.php");
	$sQuery = "SELECT msg.*,ur.kw_user_name FROM kwtbl_messages msg INNER JOIN kwtbl_users ur ON msg.kw_user_id = ur.kw_user_id ORDER BY kw_message_approved_flag,kw_message_create_date";
	$messageList = mysql_query($sQuery);
?>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="panel">
			<h4 class="text-center">留言管理</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<table align="center" style="width:100%;">
			<tr>
				<th>序号</th>
				<th>姓名</th>
				<th>标题</th>
				<th>内容</th>
				<th>日期</th>
				<th>通过</th>
			</tr>
			<?php
				$rowNum = 0;
				while($row=mysql_fetch_array($messageList)){
					$rowNum = $rowNum + 1;
					if($rowNum % 2 <> 0){
						echo "<tr>";
					}else{
						echo "<tr class='odd_row_bg'>";
					}
					echo "<td>".$row['kw_message_id']."</td>";
					echo "<td>".$row['kw_user_name']."</td>";
					echo "<td>".$row['kw_message_title']."</td>";
					echo "<td>";
					if(strlen($row['kw_message_content']) > 30){
						echo "<span data-tooltip class='has-tip tip-top' title='".$row['kw_message_content']."'>".custsubstr($row['kw_message_content'],30)."</span>";
					}else{
						echo $row['kw_message_content'];
					}
					echo "</td>";
					echo "<td>".date('Y-m-d', $row['kw_message_create_date'])."</td>";
					if($row['kw_message_approved_flag'] == "N"){
						echo "<td align='center'><input type='checkbox' name='approvedStatus' value='".$row['kw_user_id']."-".$row['kw_message_id']."'></td>";
					}else{
						echo "<td align='center'><input type='checkbox' name='approvedStatus' value='".$row['kw_user_id']."-".$row['kw_message_id']."' checked></td>";
					}
				   	echo "</tr>";
				}
				mysql_free_result($messageList);
				mysql_close();
			?>
		</table>
	</div>
</div>

<?php
	include_once("admin_footer.php");
?>

<script type="text/javascript">
	$(function(){
		$("input[name='approvedStatus']").click(function(){
			var _userId = $(this).val().split("-")[0];
			var _messageId = $(this).val().split("-")[1];
			if($(this).attr("checked")){
				_approvedStatus = "Y";
			}else{
				_approvedStatus = "N";
			}
			$.ajax({
				type: "post",
				url: "ajax_check_message.php",
				contentType: "application/x-www-form-urlencoded;charset=utf-8",
				data: {"approvedStatus":_approvedStatus,"messageId":_messageId,"userId":_userId}
			})
		});
	})
</script>
