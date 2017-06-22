<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	$pageCode = "user_manage";
	include_once("admin_header.php");
	include_once("dbconn/kw_db_conn.php");
	$sQuery = "SELECT * FROM kwtbl_users ORDER BY kw_user_create_date DESC";
	$userList = mysql_query($sQuery);
?>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="panel">
			<h4 class="text-center">用户管理</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<table align="center" style='width:100%;'>
			<tr>
				<th>账号</th>
				<th>姓名</th>
				<th>密码</th>
				<th>性别</th>
				<th>年龄</th>
				<th>手机</th>
				<th>创建日期</th>
				<th>操作</th>
			</tr>
			<?php
				$rowNum = 0;
				while($row=mysql_fetch_array($userList)){
					$rowNum = $rowNum + 1;
					if($rowNum % 2 <> 0){
						echo "<tr>";
					}else{
						echo "<tr class='odd_row_bg'>";
					}
				   	echo "<td class='text-center'>".$row['kw_user_account']."</td>";
					echo "<td>".$row['kw_user_name']."</td>";
					echo "<td>".$row['kw_user_password']."</td>";
					echo "<td>".$row['kw_user_gender']."</td>";
					echo "<td>".$row['kw_user_age']."</td>";
					echo "<td>".$row['kw_user_mobile']."</td>";
					echo "<td class='text-center'>".date('Y-m-d', $row['kw_user_create_date'])."</td>";
					echo "<td class='text-center'><a href='user_profile.php?uid=".$row['kw_user_id']."'>修改</td>";
				   	echo "</tr>";
				}
				mysql_free_result($userList);
				mysql_close($conn);
			?>
		</table>
	</div>
</div>

<?php
	include_once("admin_footer.php");
?>