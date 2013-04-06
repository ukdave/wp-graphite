<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?>

			</div> <!-- /container -->
		</div> <!-- /thepage -->

		<footer class="footer">
			<div id="footer-sidebar" class="container">
				<div class="row">
					<?php get_sidebar( 'footer' ); ?>
				</div>
			</div>
		</footer>

		<!-- wp_footer -->
		<?php wp_footer(); ?>
		<!-- /wp_footer -->

	</body>
</html>
