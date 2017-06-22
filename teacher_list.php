<?php
	include_once("check_session.php");
	include_once("check_permission.php");
	$pageCode = "teacher_list";
	include_once("admin_header.php");
	include_once("cust_substr.php");
	include_once("dbconn/kw_db_conn.php");
	$sQuery = "SELECT * FROM kwtbl_teachers";
	$teacherList = mysql_query($sQuery);
?>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<div class="panel">
			<h4 class="text-center">教师列表</h4>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 medium-12 small-12 columns">
		<table width="100%">
			<thead>
				<tr>
					<th class="text-center" width="70">
						姓名
					</th>
					<th class="text-center" width="150">
						电话
					</th>
					<th class="text-center" width="150">
						手机
					</th>
					<th class="text-center" width="250">
						邮箱
					</th>
					<th class="text-center">
						备注
					</th>
					<th class="text-center" width="80">
						操作
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($row=mysql_fetch_array($teacherList)){
						echo "<tr>";
						echo "<td>".$row['kw_teac_name']."</td>";
						echo "<td>".$row['kw_teac_phone']."</td>";
						echo "<td>".$row['kw_teac_mobile']."</td>";
						echo "<td>".$row['kw_teac_email']."</td>";
						
						echo "<td>";
						if(strlen($row['kw_teac_comments']) > 20){
							echo "<span data-tooltip class='has-tip tip-top' title='".$row['kw_teac_comments']."'>".custsubstr($row['kw_teac_comments'],20)."</span>";
						}else{
							echo $row['kw_teac_comments'];
						}
						echo "</td>";
						echo "<td class='text-center'><a href='teacher_dtl.php?teacId=".$row['kw_teac_id']."'><img src='images/edit.png' /></a>&nbsp;&nbsp;&nbsp;<a id='del-teac-".$row['kw_teac_id']."' href='javascript:void(0);'><img src='images/del.png' /></a></td>";
						echo "</tr>";
					}
					mysql_free_result($teacherList);
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
		$("a[id^='del-teac-']").click(function(){
			if (confirm("是否将此教师信息删除?")) {
				var teacId = $(this).attr("id").split("-")[2];
				$.getJSON("ajax_del_teacher.php", {"teacId": teacId}, function(rJSON, textStatus) {
					if(rJSON.status === "Y"){
						alert(rJSON.msg);
						$("#del-teac-" + teacId).closest("tr").fadeOut(1000, function() {
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