<?php
/**
 * The template for displaying image attachments.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>
<?php get_header(); ?>

<div class="row">
	<div id="content" class="col-md-12" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
				<div class="image-metadata">
					<?php
						$metadata = wp_get_attachment_metadata();
						printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'graphite' ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_url( wp_get_attachment_url() ),
							$metadata['width'],
							$metadata['height'],
							esc_url( get_permalink( $post->post_parent ) ),
							esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
							get_the_title( $post->post_parent )
						);
					?>
					<nav id="image-navigation" class="navigation" role="navigation">
						<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'graphite' ) ); ?></span>
						<span class="next-image pull-right"><?php next_image_link( false, __( 'Next &rarr;', 'graphite' ) ); ?></span>
					</nav><!-- #image-navigation -->
				</div><!-- .image-metadata -->

				<div class="entry-content clearfix">

					<div class="entry-attachment">
						<div class="attachment">
<?php
/**
 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
 */
$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
foreach ( $attachments as $k => $attachment ) {
	if ( $attachment->ID == $post->ID ) {
		break;
	}
};

$k++;
// If there is more than 1 attachment in a gallery
if ( count( $attachments ) > 1 ) {
	if ( isset( $attachments[ $k ] ) ) {
		// get the URL of the next image attachment
		$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	} else {
		// or get the URL of the first image attachment
		$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	}
} else {
	// or, if there's only 1 image, get the URL of the image
	$next_attachment_url = wp_get_attachment_url();
}
?>
							<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
							echo wp_get_attachment_image( $post->ID, array( 960, 960 ) );
							?></a>

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
							<?php endif; ?>
						</div><!-- .attachment -->

					</div><!-- .entry-attachment -->

					<div class="entry-description">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'graphite' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-description -->

				</div><!-- .entry-content -->

				<footer class="entry-meta">
					<?php 
						$author = sprintf('<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							esc_attr( sprintf( __( 'View all posts by %s', 'graphite' ), get_the_author() ) ),
							'<i class="fa fa-large fa-user"></i> ' . get_the_author()
						);
						$date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><i class="fa fa-large fa-clock-o"></i> <time class="entry-date" datetime="%3$s">%4$s</time></a>',
							esc_url( get_permalink() ),
							esc_attr( get_the_time() ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() )
						);
					?>
					<ul class="meta">
						<li><i class="fa fa-large fa-comment"></i> <?php comments_popup_link( __( 'No comments', 'graphite' ), __( '1 Comment', 'graphite' ), __( '% Comments', 'graphite' ) ); ?></li>
						<li><?php echo $author; ?></li>
						<li><?php echo $date; ?></li>
						<?php edit_post_link('<i class="fa fa-large fa-pencil"></i> '. __( 'Edit', 'graphite' ), '<li>', '</li>'); ?>
					</ul>
				</footer><!-- /.entry-meta -->

			</article><!-- /#post -->

			<?php comments_template(); ?>

		<?php endwhile; // end of the loop. ?>

	</div><!-- /#content -->
</div><!-- /.row -->

<?php get_footer(); ?>
