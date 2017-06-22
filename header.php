<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="瑜伽之光工作室 woyaoyoga" />
<meta name="keywords" content="深圳 瑜伽之光 woyaoyoga 瑜伽 瑜伽之光工作室" />
<meta name="generator" content="woyaoyoga 瑜伽之光工作室" />
<title>欢迎光临瑜伽之光工作室</title>
<link rel="stylesheet" type="text/css" href="style/base.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style/slideshow.css" media="screen" />
<link rel="stylesheet" type="text/css" href="js/colorbox/colorbox.css" />
<link rel="stylesheet" type="text/css" href="js/qtip/jquery.qtip.css" />

</head>

<body>
<?php
	include_once("dbconn/kw_db_conn.php");
?>
<div id="header">
	<div id="logo">
		<h1>瑜伽之光工作室</h1>
		<p><em>WoYaoYoga.com</em>　在线预约课程功能即将开通，敬请关注 <a href="lesson_order.php">课程预约</a></p>
	</div>
	<!-- end #logo -->
	<div id="login">
		<?php
			session_start();
			if (isset($_SESSION["uId"])){
				echo "欢迎您 ".$_SESSION['uName']." ！<a id='user_welcome' href='user_center.php'>会员中心</a> | <a id='logoutLink' href='javascript:void(0);'>退出</a>";
			}else{
				echo "<a id='regLink' href='javascript:void(0);'>注册</a> | <a id='loginLink' href='javascript:void(0);'>登录</a> | <a href='javascript:bookmark(window.location,document.title)'>加入收藏</a>";
			}
		?>
		
	</div>
	<!-- end #logo -->
</div>
<!-- end #header -->

<div id="banner_wrapper">
	<div id="banner">
		<div id="menu">
			<ul>
				<li <?php if($pageCode == "index"){echo "class='current_page'";} ?>><a href="index.php">首页</a></li>
				<li <?php if($pageCode == "aboutUs"){echo "class='current_page'";} ?>><a href="about_us.php">关于我们</a></li>
				<li <?php if($pageCode == "lessonDesc"){echo "class='current_page'";} ?>><a href="lesson_desc.php">课程介绍</a></li>
				<li <?php if($pageCode == "lessonOrder"){echo "class='current_page'";} ?>><a href="lesson_order.php">课程预约</a></li>
				<li <?php if($pageCode == "teacherInfo"){echo "class='current_page'";} ?>><a href="teacher_info.php">师资力量</a></li>
				<li <?php if($pageCode == "yogaKnowledge"){echo "class='current_page'";} ?>><a href="yoga_knowledge.php">瑜伽小识</a></li>
				<li <?php if($pageCode == "photoTribe"){echo "class='current_page'";} ?>><a href="photo_tribe.php">学员风采</a></li>
			</ul>
		</div>
		<!-- end #menu -->
		<div id="search">
			<form method="get" action="">
				<fieldset>
				<input type="text" name="s" id="search-text" size="15" />
				<input type="submit" id="search-submit" value="查看" />
				</fieldset>
			</form>
		</div>
		<!-- end #search -->
	</div>
</div>