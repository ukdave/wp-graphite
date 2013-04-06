<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>
<?php get_header(); ?>

<div class="row">
	<div id="content" class="<?php echo ( is_active_sidebar( 'right-sidebar' ) ? 'span9' : 'span12' ); ?>" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; ?>
	</div><!-- /#content -->

	<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
		<aside id="right-sidebar" class="span3">
			<?php get_sidebar(); ?>
		</aside><!-- /#right-sidebar -->
	<?php endif; ?>
</div><!-- /.row -->

<?php get_footer(); ?>
