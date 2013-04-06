<?php
/**
 * The sidebar containing the footer widget area.
 *
 * If no active widgets in sidebar then just display a simple copyright notice.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>
<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
	<?php
		$mysidebars = wp_get_sidebars_widgets();
		$total_widgets = count( $mysidebars['footer-sidebar'] );
		$limit_allowed = 4;
	
		if ( $total_widgets > $limit_allowed ) {
			printf( __( 'This area only supports %1$d widgets, you currenty have %2$d.', 'graphite' ), $limit_allowed, $total_widgets );
    	} else {
			dynamic_sidebar( 'footer-sidebar' );
    	}
    ?>
<?php else : ?>
	<div class="span12">
		<p>&copy; <?php bloginfo( 'name' ); ?> <?php echo date( 'Y' ); ?></p>
		<p>Powered by <a href="http://wordpress.org">WordPress</a> and <a href="http://github.com/ukdave/wp-graphite">Graphite</a></p>
	</div>
<?php endif; ?>
