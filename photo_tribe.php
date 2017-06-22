<?php
	$pageCode = "photoTribe";
	include_once("header.php");
?>
<div id="container">
<br />
	<div style="width:100%; margin:0 auto; text-align:center;">
		<p>请单击图片播放幻灯片</p>
		<img id="photo-tribe" src="images/phototribe/019.jpg" alt="点击图片查看更多" title="点击图片查看更多" style="cursor:pointer;">
	</div>
	<div style="display:none;">
		<?php
			$sQuery = "select kw_image_id,kw_image_path,kw_image_width,kw_image_height from kwtbl_images where kw_image_type='phototribe' ORDER BY kw_image_id DESC";
			$photoList = mysql_query($sQuery);
			while($row = mysql_fetch_array($photoList)){
				echo "<p><a class='group1' href='".$row['kw_image_path']."' title='".$row['kw_image_id']."'>Grouped Photo ".$row['kw_image_id']."</a></p>";
			}
			mysql_free_result($PhotoList);
			mysql_close($conn);
		?>
	</div>
<br />
</div>
<?php
	include_once("footer.php");
?>
<script>
	$(document).ready(function(){
		$(".group1").colorbox({
			rel: "group1",
			previous: "上一张",
			next: "下一张",
			close: "关闭",
			overlayClose: false,
			current: "",
			slideshow: true,
			slideshowStop: ""
		});
		$(".group1").click();
		$("#photo-tribe").click(function(){
			$(".group1").click();
		});
	});
</script>