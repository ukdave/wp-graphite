<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>

<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'graphite' ); ?></h1>
	</header>

	<div class="entry-content">
		<p><?php _e( 'Sorry, what you are looking for isn\'t here.', 'graphite' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- /.entry-content -->
</article><!-- /#post-0 -->
