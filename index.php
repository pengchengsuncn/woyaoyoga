<?php
	$pageCode = "index";
	include_once("header.php");
?>

<div id="container">
	<div id="ads">
		<img src="images/ads/ads_01.jpg" alt='我“要”瑜伽' />
		<img src="images/ads/ads_02.jpg" alt="WoYaoYoga.com" />
		<img src="images/ads/ads_03.jpg" alt='我“要”瑜伽' />
		<img src="images/ads/ads_04.jpg" alt="瑜伽之光工作室" />
	</div>
	<div id="main_content">
		<div id="lesson">
			<p class="block_title"><img src="images/lesson.png" />热门课程</p>
			<div id="auto_banner">
				<ul>
					<li><a href="teacher_info.php"><img src='images/banner/new_teachers.jpg' alt='新老师，新课程，快来参加吧！'></a></li>
					<li><a href="wechat.php"><img src='images/banner/banner_wechat.jpg' alt='微信扫优惠！'></a></li>
					<li><a href="lesson_order.php"><img src='images/banner/banner_timetable.jpg' alt='课程表 精彩课程等着你参加！' width='688' height='163'></a></li>
				</ul>
			</div>
		</div>
		<?php
			$sQuery = "SELECT msg.*,ur.kw_user_name FROM kwtbl_messages msg INNER JOIN kwtbl_users ur ON msg.kw_user_id = ur.kw_user_id AND kw_message_approved_flag = 'Y' ORDER BY kw_message_approved_flag,kw_message_create_date limit 20";
			$messageList = mysql_query($sQuery);
		?>
		<div id="message">
			<p class="block_title"><img src="images/message.png" />客户留言</p>
			<div id="message_list">
				<ul>
					<?php
						$rowNum = 0;
						while($row=mysql_fetch_array($messageList)){
							$rowNum = $rowNum + 1;
							if($rowNum % 2 <> 0){
								echo "<li>";
							}else{
								echo "<li class='odd_row_bg'>";
							}
							echo "<span class='user_name'>".$row['kw_user_name']."：</span>";
							echo "<strong>".$row['kw_message_title']."</strong>";
							echo "<span class='create_date'>".$row['kw_message_create_date']."</span>";
							echo "<p>".$row['kw_message_content']."</p>";
							echo "</li>";
						}
						mysql_free_result($messageList);
					?>
				</ul>
			</div>
		</div>
	</div>
		
		<div id="sidebar">
			<div id="news">
				<p class="block_title"><img src="images/news.png" />最新动态</p>
				<div id="newslist">
					会员成功登录网站 积分+1<br />
					会员留言审核通过 积分+3<br />
					积分有什么用？<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&ndash;可以兑换奖品<br />
					&nbsp;&nbsp;&nbsp;&nbsp;&ndash;可兑换课程<br />
					敬请期待...
				</div>
			</div>
			<div id="contact">
				<p class="block_title"><img src="images/contact.png" />我要咨询</p>
				<table align="center">
					<tr>
						<td><img src="images/wechat.png" width="20" height="20" /></td>
						<td><img src="images/mobile.png" width="20" height="20" /></td>
					</tr>
					<tr>
						<td>anita570764610</td>
						<td>15986795649</td>
					</tr>
					<tr>
						<td><img src="images/qq.png" width="20" height="20" /></td>
						<td><img src="images/email.png" width="20" height="20" /></td>
					</tr>
					<tr>
						<td>1049160125</td>
						<td><a href="mailto:1049160125@qq.com">1049160125@qq.com</a></td>
					</tr>				
				</table>
			</div>
			<div id="ranking">
				<p class="block_title"><img src="images/ranking.png" />积分排行</p>
				<table>
					<?php
						$sQryPointsStr = "SELECT kw_user_name,kw_user_points
										  FROM kwtbl_users
										  ORDER BY kw_user_points DESC
										  LIMIT 3";
						$sQryPointsResult = mysql_query($sQryPointsStr);
						$rowNum = 0;
						while($row = mysql_fetch_array($sQryPointsResult)){
							$rowNum = $rowNum + 1;
							echo "<tr>";
							echo "<td>".$rowNum."</td>";
							echo "<td>".$row['kw_user_name']."</td>";
							echo "<td>".$row['kw_user_points']."</td>";
							echo "<tr>";
						}
						mysql_free_result($sQryPointsResult);
					?>
				</table>
				
			</div>
		<!-- end #sidebar -->
	</div>
	
	<?php
		$sQuery = "select kw_image_id,kw_image_path,kw_image_width,kw_image_height from kwtbl_images where kw_image_type='photo' ORDER BY kw_image_id DESC";
		$photoList = mysql_query($sQuery);
	?>
	
	<div id="photo" >
		<p class="block_title"><img src="images/photo.png" />学员风采</p>
		<div id="auto_photo">
			<ul>
				<?php
					while($row = mysql_fetch_array($photoList)){
						echo "<li><a href='photo_tribe.php'><img src='".$row['kw_image_path']."' alt='".$row['kw_image_id']."' width='".$row['kw_image_width']."' height='".$row['kw_image_height']."'></a></li>";
					}
					mysql_free_result($PhotoList);
					mysql_close($conn);
				?>
			</ul>
		</div>
	</div>
	<!-- end #photo -->
</div>
<?php
	include_once("footer.php");
?>