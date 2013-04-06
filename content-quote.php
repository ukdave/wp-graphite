<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><i class="icon-quote-left"></i> <?php the_title(); ?></h1>
		<?php else : ?>
			<h1 class="entry-title">
				<i class="icon-quote-left"></i> <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'graphite' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		<?php endif; // is_single() ?>
	</header>

	<div class="entry-content clearfix">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'graphite' ) ); ?>
	</div><!-- /.entry-content -->

	<footer class="entry-meta">
		<?php 
			$author = sprintf( '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
				esc_url( get_author_posts_url(get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'graphite' ), get_the_author() ) ),
				'<i class="icon-large icon-user"></i> ' . get_the_author()
			);
			$date = sprintf( '<a href="%1$s" title="' . __( 'View all posts from %2$s', 'graphite' ) . '" rel="bookmark"><i class="icon-large icon-time"></i> <time class="entry-date" datetime="%3$s">%4$s</time></a>',
				esc_url( get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ) ),
				esc_attr( get_the_date( 'F' ) ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
			$categories = get_the_category_list( ', ' );
			$tags = get_the_tag_list( '', ', ' );
		?>
		<ul class="meta">
			<li><i class="icon-large icon-comment"></i> <?php comments_popup_link( __( 'No comments', 'graphite' ), __( '1 Comment', 'graphite' ), __( '% Comments', 'graphite' ) ); ?></li>
			<li><?php echo $author; ?></li>
			<li><?php echo $date; ?></li>
			<?php if ( $categories ) : ?>
				<li><i class="icon-large icon-folder-close"></i> <?php echo $categories; ?></li>
			<?php endif; ?>
			<?php if ( $tags ) : ?>
				<li><i class="icon-large icon-tag"></i> <?php echo $tags; ?></li>
			<?php endif; ?>
			<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><i class="icon-large icon-bookmark"></i> <?php _e( 'Permalink', 'graphite' ); ?></a></li>
			<?php edit_post_link( '<i class="icon-large icon-pencil"></i> ' . __( 'Edit', 'graphite' ), '<li>', '</li>' ); ?>
		</ul>
	</footer><!-- /.entry-meta -->
</article><!-- /#post -->
