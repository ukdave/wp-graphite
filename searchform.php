<?php
/**
 * The template for displaying search forms.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<input type="text" name="s" placeholder="<?php _e( 'Search', 'graphite' ); ?>" class="form-control search-query" />
	</div>
</form>
