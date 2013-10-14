<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="author" content="" />

		<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>" />

		<!-- wp_head -->
    	<?php wp_head(); ?>
		<!-- /wp_head -->
	</head>

	<body <?php body_class(); ?>> 
		<div class="thepage">
			<div class="container">

				<header class="masthead" role="banner">
					<div class="brand clearfix">
						<div class="title">
							<?php $header_image = get_header_image();
							if ( ! empty( $header_image ) ) : ?>
								<img src="<?php echo esc_url( $header_image ); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
							<?php endif; ?>
							<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						</div>
						<div class="icons pull-right">
							<?php $options = get_option( 'graphite_theme_options' ); ?>
							<?php if ( $options['flickr_url'] ) : ?>
								<a class="flickrlink" href="<?php echo esc_url( $options['flickr_url'] ); ?>" target="_blank"><img alt="Flickr" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/flickr.png" width="24" height="24" /></a>
							<?php endif; ?>
							<?php if ( $options['github_url'] ) : ?>
								<a class="githublink" href="<?php echo esc_url( $options['github_url'] ); ?>" target="_blank"><img alt="GitHub" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/github.png" width="24" height="24" /></a>
							<?php endif; ?>
							<?php if ( $options['facebook_url'] ) : ?>
								<a class="facebooklink" href="<?php echo esc_url( $options['facebook_url'] ); ?>" target="_blank"><img alt="Facebook" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/facebook.png" width="24" height="24" /></a>
							<?php endif; ?>
							<?php if ( $options['linkedin_url'] ) : ?>
								<a class="linkedinlink" href="<?php echo esc_url( $options['linkedin_url'] ); ?>" target="_blank"><img alt="LinkedIn" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/linkedin.png" width="24" height="24" /></a>
							<?php endif; ?>
							<?php if ( $options['twitter_url'] ) : ?>
								<a class="twitterlink" href="<?php echo esc_url( $options['twitter_url'] ); ?>" target="_blank"><img alt="Twitter" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/twitter.png" width="24" height="24" /></a>
							<?php endif; ?>
							<?php if ( $options['show_feed'] ) : ?>
								<a class="rsslink" href="<?php esc_url( bloginfo( 'rss2_url' ) ); ?>" target="_blank"><img alt="RSS" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rss.png" width="24" height="24" /></a>
							<?php endif; ?>
						</div>
					</div><!-- /.brand -->
					<nav class="navbar navbar-inverse" role="navigation">
						<div class="navbar-inner">
							<div class="container">

								<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a>

								<!-- Everything you want hidden at 940px or less, place within here -->
								<div class="nav-collapse collapse">
									<?php 
										if ( has_nav_menu( 'primary' ) ) {
											wp_nav_menu( array( 
												'theme_location' => 'primary',
												'container'      => false, 
												'menu_class'     => 'nav', 
												'fallback_cb'    => '',
												'walker'         => new Graphite_Nav_Walker
											) );
										} else {
											echo '<ul class="nav"><li><a href="#">' . __( 'No menu assigned.', 'graphite' ) . '</a></li></ul>';
										}
									?>
									<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-search pull-right">
										<input type="text" name="s" placeholder="<?php _e( 'Search', 'graphite' ); ?>" class="search-query" />
									</form>
								</div>
							</div>
						</div>
					</nav><!-- /.navbar -->
				</header><!-- /.masthead -->
