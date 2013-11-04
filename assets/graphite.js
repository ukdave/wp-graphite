/*jslint sloppy: true, white: true, browser: true */
/*global jQuery: true */

/**
 * Graphite theme module.
 */
var GraphiteTheme = (function($) {
	var pub = {};

	/**
	 *
	 */
	function aPrivateFunction() {
		// do private stuff
	}

	/**
	 * Initialise.
	 */
	pub.init = function() {
		$('body').removeClass('preload');
		$('input#submit').addClass('btn').addClass('btn-default');
		$('.widget_archive h3').prepend('<i class="fa fa-calendar"></i> ');
		$('.widget_categories h3').prepend('<i class="fa fa-folder"></i> ');
		$('.widget_links h3').prepend('<i class="fa fa-globe"></i> ');
		$('.widget_meta h3').prepend('<i class="fa fa-reorder"></i> ');
		$('.widget_recent_comments h3').prepend('<i class="fa fa-comment"></i> ');
		$('.widget_recent_entries h3').prepend('<i class="fa fa-book"></i> ');
		$('.widget_text h3').prepend('<i class="fa fa-info-circle"></i> ');
		$('.widget_twitter h3').prepend('<i class="fa fa-twitter"></i> ');
	};

	return pub;
}(jQuery));


jQuery(document).ready(function() {
	GraphiteTheme.init();
});
