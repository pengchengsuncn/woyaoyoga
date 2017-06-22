<nav class="top-bar">
	<div class="text-center">
		<a href="javascript:void(0);">©2010-2014 瑜伽之光工作室 版权所有&nbsp;&nbsp;&nbsp;&nbsp;技术支持 <a href="mailto:services@ladsoft.com">LadSoft</a></a>
	</div>
</nav>

<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation.tooltip.js"></script>
<script src="js/jquery.validate-1.9.0.min.js"></script>
<script>
	$(document).foundation();
	$("#logoutLink").click(function(){
		$.ajax({
			type: "post",
			url: "logout.php",
			contentType: "application/x-www-form-urlencoded;charset=utf-8",
			success:function(){
				setTimeout("window.location.reload();",500);
			}
		})
	});
</script>

</body>
</html>