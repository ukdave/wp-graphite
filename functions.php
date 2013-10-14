<?php
/**
 * Graphite functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * @package Graphite_Theme
 * @since Graphite 1.0.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 820;
}

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Graphite 1.0.0
 */
function graphite_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'right-sidebar' ) ) {
		global $content_width;
		$content_width = 1120;
	}
}
add_action( 'template_redirect', 'graphite_content_width' );


/**
 * Theme settings and customisation.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object
 * @return void
 *
 * @since Graphite 1.0.0
 */
function graphite_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'graphite_theme_options[flickr_url]', array(
		'default'     => '',
		'transport'   => 'refresh',
		'capability'  => 'edit_theme_options',
		'type'        => 'option'
	) );
	$wp_customize->add_setting( 'graphite_theme_options[github_url]', array(
		'default'     => '',
		'transport'   => 'refresh',
		'capability'  => 'edit_theme_options',
		'type'        => 'option'
	) );
	$wp_customize->add_setting( 'graphite_theme_options[facebook_url]', array(
		'default'     => '',
		'transport'   => 'refresh',
		'capability'  => 'edit_theme_options',
		'type'        => 'option'
	) );
	$wp_customize->add_setting( 'graphite_theme_options[linkedin_url]', array(
		'default'     => '',
		'transport'   => 'refresh',
		'capability'  => 'edit_theme_options',
		'type'        => 'option'
	) );
	$wp_customize->add_setting( 'graphite_theme_options[twitter_url]', array(
		'default'     => '',
		'transport'   => 'refresh',
		'capability'  => 'edit_theme_options',
		'type'        => 'option'
	) );
	$wp_customize->add_setting( 'graphite_theme_options[show_feed]', array(
		'default'     => 0,
		'transport'   => 'refresh',
		'capability'  => 'edit_theme_options',
		'type'        => 'option'
	) );

	$wp_customize->add_section( 'graphite_social_section', array(
		'title'      => __( 'Social', 'graphite' ),
		'priority'   => 1000,
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'flickr_url', array(
		'label'      => __( 'Flickr Photostream URL', 'graphite' ),
		'section'    => 'graphite_social_section',
		'settings'   => 'graphite_theme_options[flickr_url]',
		'prority'    => 30
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'github_url', array(
		'label'      => __( 'GitHub Profile URL', 'graphite' ),
		'section'    => 'graphite_social_section',
		'settings'   => 'graphite_theme_options[github_url]',
		'prority'    => 30
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_url', array(
		'label'      => __( 'Facebook Profile URL', 'graphite' ),
		'section'    => 'graphite_social_section',
		'settings'   => 'graphite_theme_options[facebook_url]',
		'prority'    => 10
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin_url', array(
		'label'      => __( 'LinkedIn Profile URL', 'graphite' ),
		'section'    => 'graphite_social_section',
		'settings'   => 'graphite_theme_options[linkedin_url]',
		'prority'    => 20
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_url', array(
		'label'      => __( 'Twitter Profile URL', 'graphite' ),
		'section'    => 'graphite_social_section',
		'settings'   => 'graphite_theme_options[twitter_url]',
		'prority'    => 30
	) ) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_feed', array(
		'label'      => __( 'Show RSS Feed', 'graphite' ),
		'section'    => 'graphite_social_section',
		'settings'   => 'graphite_theme_options[show_feed]',
		'type'       => 'checkbox',
		'prority'    => 40
	) ) );
}
add_action( 'customize_register', 'graphite_customize_register' );


/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Single or multiple authors.
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 *
 * @since Graphite 1.0.0
 */
function graphite_body_class( $classes ) {
	if ( ! is_active_sidebar( 'right-sidebar' ) || is_page_template( 'page-templates/full-width.php' ) ) {
		$classes[] = 'full-width';
	}

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
	}

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	$classes[] = 'preload';

	return $classes;
}
add_filter( 'body_class', 'graphite_body_class' );


/**
 * Sets up theme defaults and registers the various WordPress features that
 * this theem supports.
 *
 * @uses add_theme_support() To add support for automatic feed links.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses register_sidebar() To add support for widgets.
 *
 * @since Graphite 1.0.0
 */
function graphite_setup() {
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Makes Graphite available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Graphite, use a find and replace
	 * to change 'graphite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'graphite', get_template_directory() . '/languages' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'image', 'link', 'quote', 'status', 'video' ) );

	// Add custom header image support
	$args = array(
		'default-image'   => '',
		'width'           => 0,
		'height'          => 60,
		'max-width'       => 640,
		'flex-height'     => true,
		'flex-width'      => true,
		'random-default'  => false,
		'header-text'     => false,
	);
	add_theme_support( 'custom-header', $args );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'graphite' ) );

	// Register sidebars
	register_sidebar( array(
		'id' => 'right-sidebar',
		'name' => __( 'Right Sidebar', 'graphite' ),
		'before_widget' => '<div class="widget %2$s">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	) );
	register_sidebar( array(
		'id' => 'footer-sidebar',
		'name' => __( 'Footer Sidebar', 'graphite' ),
		'description' => __( 'Requires exactly 4 widgets', 'graphite' ),
		'before_widget' => '<div class="widget %2$s span3">',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	) );
}
add_action( 'after_setup_theme', 'graphite_setup' );


/**
 * Enqueues scripts and styles for front-end.
 *
 * Only changea to custom version of bootstrap are:
 *  * Reduce base font size from 14px to 12px.
 *  * Change the sansFontFamily from "'Helvetica Neue', Helvetica, Arial, sans-serif" to "'Open Sans','Helvetica Neue', Helvetica, Arial, sans-serif"
 *
 * @since Graphite 1.0.0
 */
function graphite_scripts_styles() {
	global $wp_scripts;

	// Enqueue stylesheets
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap-2.3.1-custom/css/bootstrap.min.css', array(), '2.3.1-custom') ;
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome-3.2.1/css/font-awesome.min.css', array(), '3.2.1' );

	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array(
		'family' => 'Open+Sans:400italic,700italic,400,700',
		'subset' => 'latin,latin-ext',
	);
	wp_enqueue_style( 'graphite-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );

	wp_enqueue_style( 'graphite', get_stylesheet_uri(), array( 'bootstrap', 'font-awesome', 'graphite-fonts' ), '1.1.0');

	// Enqueue scripts
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap-2.3.1-custom/js/bootstrap.min.js', array( 'jquery' ), '2.3.1-custom' );
	wp_enqueue_script( 'graphite', get_template_directory_uri() . '/assets/graphite.js', array( 'jquery' ), '1.1.0' );

	// Load html5shiv
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/html5shiv-3.6.2pre/html5shiv-printshiv.min.js', array(), '3.6.2pre' );
	$wp_scripts->add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'graphite_scripts_styles' );


/**
 * Walker for Bootstrap nav bars.
 *
 * @since Graphite 1.0.0
 */
class Graphite_Nav_Walker extends Walker_Nav_Menu
{
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	// add main/sub classes to li's and links
	function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			if ( $depth == 0 ) {
				$class_names = "dropdown ";
			} else {
				$class_names = "dropdown-submenu ";
			}
		}

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		// if the item has children add these two attributes to the anchor tag
		if ( ( $args->has_children ) && ( $depth == 0 ) ) {
			$attributes .= ' class="dropdown-toggle"';
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $args->link_after;
		
		// if the item has children add the caret just before closing the anchor tag
		if ( ( $args->has_children ) && ( $depth == 0 ) ) {
			$item_output .= '<b class="caret"></b></a>';
		} else {
			$item_output .= '</a>';
		}
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}


/**
 * Add Twitter Bootstrap's standard 'active' class name to the active nav link item.
 *
 * @since Graphite 1.0.0
 */
function add_active_class( $classes, $item ) {
	if ( ( $item->menu_item_parent == 0 ) && ( in_array('current-menu-item', $classes ) ) ) {
        $classes[] = 'active';
	}
    return $classes;
}
add_filter( 'nav_menu_css_class', 'add_active_class', 10, 2 );


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Graphite 1.0.0
 */
function graphite_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'graphite' ), '<span class="edit-link">', '</span>'); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard clearfix">
				<p class="pull-right">
					<?php edit_comment_link( __('Edit', 'graphite' ), '', ' |' ); ?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'graphite' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			
				</p>
				<?php
					echo get_avatar( $comment, 44 );
					printf('<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span class="label">' . __( 'Post author', 'graphite' ) . '</span>' : ''
					);
					printf('<time datetime="%1$s">%2$s</time>',
						get_comment_time( 'c' ),
						sprintf( __( '%1$s at %2$s', 'graphite' ) , get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ($comment->comment_approved == '0') : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'graphite' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
			</section><!-- .comment-content -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
