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
		$('input#submit').addClass('btn');
		$('.widget_archive h3').prepend('<i class="icon-calendar"></i> ');
		$('.widget_categories h3').prepend('<i class="icon-folder-close"></i> ');
		$('.widget_links h3').prepend('<i class="icon-globe"></i> ');
		$('.widget_meta h3').prepend('<i class="icon-reorder"></i> ');
		$('.widget_recent_comments h3').prepend('<i class="icon-comment"></i> ');
		$('.widget_recent_entries h3').prepend('<i class="icon-book"></i> ');
		$('.widget_text h3').prepend('<i class="icon-info-sign"></i> ');
		$('.widget_twitter h3').prepend('<i class="icon-twitter"></i> ');
	};

	return pub;
}(jQuery));


jQuery(document).ready(function() {
	GraphiteTheme.init();
});
