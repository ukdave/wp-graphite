<?php 
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>
<?php get_header(); ?>

<div class="row">
	<div id="content" class="<?php echo ( is_active_sidebar( 'right-sidebar' ) ? 'span9' : 'span12' ); ?>" role="main">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-below" class="navigation" role="navigation">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'graphite' ); ?></h3>
					<div class="nav-next pull-left"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer posts', 'graphite' ) ); ?></div>
					<div class="nav-previous pull-right"><?php next_posts_link( __( 'Older posts <span class="meta-nav">&rarr;</span>', 'graphite' ) ); ?></div>
				</nav>
			<?php endif; ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; // end have_posts() check ?>
	</div><!-- /#content -->

	<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
		<aside id="right-sidebar" class="span3">
			<?php get_sidebar(); ?>
		</aside><!-- /#right-sidebar -->
	<?php endif; ?>
</div><!-- /.row -->

<?php get_footer(); ?>
