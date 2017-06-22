<div id="widget-chat-wrapper" class="widget-chat-absolute">

    <div class="widget-chat-container">
        <a href="javascript:void(0);">
            <div class="widget-chat"></div>
        </a>
    </div>

</div>

<div id="footer">
	<p>©2010-2014 瑜伽之光工作室 版权所有 地址：深圳市福田区共和世家小区会所&nbsp;&nbsp;&nbsp;&nbsp;技术支持 <a href="mailto:services@ladsoft.com">LadSoft</a></p>
</div>
<!-- end #footer -->

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate-1.9.0.min.js"></script>
<script type="text/javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/utils.js"></script>
<script type="text/javascript" src="js/jquery.slideshow.lite.js"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script>
<script type="text/javascript" src="js/qtip/jquery.qtip.min.js"></script>
<script type="text/javascript">
	$(window).load(function(){
		if ( $("#widget-chat-wrapper").length > 0 ){
			var shareWrap = jQuery("#widget-chat-wrapper");
			var originalShareTop = shareWrap.offset().top;
			var view = jQuery(window);
			view.bind("scroll resize", function(){
				var viewTop = view.scrollTop();
				if ((viewTop > originalShareTop) && !shareWrap.is(".widget-chat-fixed")) {
					shareWrap.removeClass("widget-chat-absolute").addClass("widget-chat-fixed");
				}
				else {
					if ((viewTop <= originalShareTop) && shareWrap.is(".widget-chat-fixed")) {
						shareWrap.removeClass("widget-chat-fixed").addClass("widget-chat-absolute");
					}
				}
			});
		};
	});
	
	
	function bookmark(url,title) {
		var ua = navigator.userAgent.toLowerCase();
		if(ua.indexOf("msie 8")>-1){
			external.AddToFavoritesBar(url,title,'');//IE8
		}else{
			try {
				window.external.addFavorite(url, title);
			} catch(e) {
				try {
					window.sidebar.addPanel(title, url, "");//firefox
				} catch(e) {
					alert("请使用Ctrl+D进行收藏");
				}
			}
		}
	}
</script>
</body>
</html>