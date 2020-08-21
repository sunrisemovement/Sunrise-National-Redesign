if (
	/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
		navigator.userAgent
	)
) {
} else {
	jQuery(window).on("scroll", function (event) {
		var scrollValue = jQuery(window).scrollTop();
		if (scrollValue > 50) {
			jQuery(".bottom-menu").addClass("fixed-top");
			jQuery(".site-header").addClass("fixed-menu");
		} else {
			jQuery(".bottom-menu").removeClass("fixed-top");
			jQuery(".site-header").removeClass("fixed-menu");
		}
	});
}
