// JavaScript Document By Knewweb.com
$(function() {
	$("#menu>ul>li").not(".current_page").mouseover(function(){
		$(this).addClass("current_page");
	});
	$("#menu>ul>li").not(".current_page").mouseout(function(){
		$(this).removeClass("current_page");
	});
	
	$("#ads").slideshow({
	  	pauseSeconds: 4,
        height: 158,
		width:938
	});
	
	$("#regLink").click(function(){
		$.colorbox({
			href:"reg.php",
			innerWidth:"300px", 
			innerHeight:"180px",
			scrolling:false,
			inline:false,
			opacity:0.3,
			overlayClose:false,
			closeButton:true,
			close:"CLOSE",
			onClosed:function(){
				window.location.reload();	
			}
		});
	});
	
	$("#loginLink").click(function(){
		$.colorbox({
			href:"login.php",
			innerWidth:"300px", 
			innerHeight:"180px",
			scrolling:false,
			inline:false,
			opacity:0.3,
			overlayClose:false,
			closeButton:true,
			close:"CLOSE",
			onClosed:function(){
				window.location.reload();	
			}
		});
	});
	
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
	
	$(".widget-chat-container").click(function(){
		$.colorbox({
			href:"leave_message.php",
			innerWidth:"465px", 
			innerHeight:"300px",
			scrolling:false,
			inline:false,
			opacity:0.3,
			overlayClose:false,
			closeButton:true,
			close:"CLOSE",
			onClosed:function(){
				window.location.reload();	
			}
		});									   
	});
	
	$("#auto_photo").jCarouselLite({
		auto: 800,
		speed: 1000,
		visible: 5,
		mouseWheel: false
	});
	
	$("#auto_banner").jCarouselLite({
		auto: 2000,
		speed: 1000,
		visible: 1,
		mouseWheel: true,
		vertical: true
	});
	
	$("#message_list").jCarouselLite({
		auto: 800,
		speed: 2000,
		visible: 4,
		vertical: true
	});
	
});