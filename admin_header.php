<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>瑜伽之光-管理中心</title>
	<link rel="stylesheet" type="text/css" href="style/foundation.min.css" />
	<link rel="stylesheet" type="text/css" href="style/admin_base.css" />
</head>
<body>
<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1>
				<a href="user_center.php">
					瑜伽之光管理中心
				</a>
			</h1>
		</li>
		<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu"
		to just have icon alone -->
		<li class="toggle-topbar menu-icon">
			<a href="#">
				<span>
					菜单
				</span>
			</a>
		</li>
	</ul>
	<section class="top-bar-section">
		<ul>
			<?php if($_SESSION["uId"] == 1){ ?>
				<li<?php if($pageCode == "chk_msg"){ echo ' class="active"';} ?>>
					<a href="check_message.php">
						留言审核
					</a>
				</li>
				<li<?php if($pageCode == "user_manage"){ echo ' class="active"';} ?>>
					<a href="user_manage.php">
						会员管理
					</a>
				</li>
				<li<?php if($pageCode == "add_teacher"){ echo ' class="active"';} ?>>
					<a href="add_teacher.php">
						添加教师
					</a>
				</li>
				<li<?php if($pageCode == "teacher_list"){ echo ' class="active"';} ?>>
					<a href="teacher_list.php">
						查看教师
					</a>
				</li>
				<li<?php if($pageCode == "add_course"){ echo ' class="active"';} ?>>
					<a href="add_course.php">
						添加课程
					</a>
				</li>
				<li<?php if($pageCode == "course_list"){ echo ' class="active"';} ?>>
					<a href="course_list.php">
						查看课程
					</a>
				</li>
				<li<?php if($pageCode == "course_tbl"){ echo ' class="active"';} ?>>
					<a href="course_tbl_set.php">
						课表设置
					</a>
				</li>
				<li<?php if($pageCode == "order_list"){ echo ' class="active"';} ?>>
					<a href="order_list.php">
						预约管理
					</a>
				</li>
			<?php }else{ ?>
				<li<?php if($pageCode == "my_order_list"){ echo ' class="active"';} ?>>
					<a href="my_order_list.php">
						我的预约
					</a>
				</li>
			<?php } ?>
		</ul>
		<ul class="right">
			<li class="has-dropdown">
				<a href="user_profile.php?uid=<?php echo $_SESSION["uId"]; ?>">
					<img src="images/usr.png" />&nbsp;<?php echo $_SESSION["uName"]; ?>
				</a>
				<ul class="dropdown">
					<li>
						<a href="user_profile.php?uid=<?php echo $_SESSION["uId"]; ?>">
							<img src="images/edit.png" />&nbsp;个人资料
						</a>
					</li>
					<li>
						<a id="logoutLink" href="javascript:void(0);">
							<img src="images/del.png" />&nbsp;安全退出
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</section>
</nav>