<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'enterprise', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'enterprise' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Enterprise Pro Theme', 'enterprise' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/enterprise/' );
define( 'CHILD_THEME_VERSION', '2.1.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'enterprise_load_scripts' );
function enterprise_load_scripts() {

	wp_enqueue_script( 'enterprise-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,300italic|Titillium+Web:600', array(), CHILD_THEME_VERSION );
	
}

//* Add new image sizes
add_image_size( 'featured-image', 358, 200, TRUE );
add_image_size( 'home-top', 750, 600, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 80,
	'width'           => 320,
) );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'enterprise-pro-black'	=> __( 'Enterprise Pro Black', 'enterprise' ),
	'enterprise-pro-green'	=> __( 'Enterprise Pro Green', 'enterprise' ),
	'enterprise-pro-orange'	=> __( 'Enterprise Pro Orange', 'enterprise' ),
	'enterprise-pro-red'    => __( 'Enterprise Pro Red', 'enterprise' ),
	'enterprise-pro-teal'	=> __( 'Enterprise Pro Teal', 'enterprise' ),
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer',
) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'enterprise_secondary_menu_args' );
function enterprise_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'enterprise_remove_comment_form_allowed_tags' );
function enterprise_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'enterprise' ),
	'description' => __( 'This is the top section of the homepage.', 'enterprise' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'enterprise' ),
	'description' => __( 'This is the bottom section of the homepage.', 'enterprise' ),
) );

//CLB Edits

/*
add_action('genesis_loop', 'clb_add_cards', 8);
	function clb_add_cards() {
		if ( is_page( 'news' ) ) {

		echo '<div class="home-bottom widget-area"><section id="featured-post-2" class="widget featured-content featuredpost"><div class="widget-wrap"><article class="post-66 post type-post status-publish format-standard has-post-thumbnail category-uncategorized entry" itemscope="itemscope" itemtype="http://schema.org/BlogPosting"><a href="http://localhost/congoinitiative/2015/creation-care-campus-conversations/" title="Creation Care: Campus Conversations" class="alignnone"><img width="358" height="200" src="http://localhost/congoinitiative/wp-content/uploads/2015/02/5-danist-soh-358x200.jpg" class="entry-image attachment-post" alt="5-danist-soh" itemprop="image" /></a><header class="entry-header"><h2 class="entry-title"><a href="http://localhost/congoinitiative/2015/creation-care-campus-conversations/">Creation Care: Campus Conversations</a></h2><p class="entry-meta"><time class="entry-time" itemprop="datePublished" datetime="2015-02-24T15:49:43+00:00">February 24, 2015</time> by <span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><span class="entry-author-name" itemprop="name">Chris Liu-Beers</span></span> </p></header><div class="entry-content"><p>Already a light in its corner of the Democratic Republic of Congo (DRC), Congo Initiative is positioned to set an example of ethical stewardship through caring for the created world. DRC boasts rich &#x02026; <a href="http://localhost/congoinitiative/2015/creation-care-campus-conversations/" class="more-link">Read More →</a></p></div></article></div></section>';
		echo '<section id="featured-post-3" class="widget featured-content featuredpost"><div class="widget-wrap"><article class="post-64 post type-post status-publish format-standard has-post-thumbnail category-uncategorized entry" itemscope="itemscope" itemtype="http://schema.org/BlogPosting"><a href="http://localhost/congoinitiative/2015/dr-david-kasali-awarded-2014-scholar-leader-of-the-year/" title="Dr. David Kasali Awarded 2014 Scholar Leader Of The Year" class="alignnone"><img width="358" height="200" src="http://localhost/congoinitiative/wp-content/uploads/2015/02/5-forrest-cavale-358x200.jpg" class="entry-image attachment-post" alt="5-forrest-cavale" itemprop="image" /></a><header class="entry-header"><h2 class="entry-title"><a href="http://localhost/congoinitiative/2015/dr-david-kasali-awarded-2014-scholar-leader-of-the-year/">Dr. David Kasali Awarded 2014 Scholar Leader Of The Year</a></h2><p class="entry-meta"><time class="entry-time" itemprop="datePublished" datetime="2015-02-24T15:14:08+00:00">February 24, 2015</time> by <span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><span class="entry-author-name" itemprop="name">Chris Liu-Beers</span></span> </p></header><div class="entry-content"><p>Germantown, WI – Congo Initiative Founder and President of the Université Chrétienne Bilingue du Congo (UCBC / Christian Bilingual University of Congo) Dr. David M. Kasali has been awarded Scholar &#x02026; <a href="http://localhost/congoinitiative/2015/dr-david-kasali-awarded-2014-scholar-leader-of-the-year/" class="more-link">Read More →</a></p></div></article></div></section>
<section id="featured-post-4" class="widget featured-content featuredpost"><div class="widget-wrap"><article class="post-55 post type-post status-publish format-standard has-post-thumbnail category-uncategorized entry" itemscope="itemscope" itemtype="http://schema.org/BlogPosting"><a href="http://localhost/congoinitiative/2015/womens-voices/" title="Women&#8217;s Voices" class="alignnone"><img width="358" height="200" src="http://localhost/congoinitiative/wp-content/uploads/2015/02/Joella-Mbiliki-358x200.jpg" class="entry-image attachment-post" alt="Joella Mbiliki" itemprop="image" /></a><header class="entry-header"><h2 class="entry-title"><a href="http://localhost/congoinitiative/2015/womens-voices/">Women&#8217;s Voices</a></h2><p class="entry-meta"><time class="entry-time" itemprop="datePublished" datetime="2015-02-24T14:57:07+00:00">February 24, 2015</time> by <span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><span class="entry-author-name" itemprop="name">Chris Liu-Beers</span></span> </p></header><div class="entry-content"><p>If you educate a man, you educate an individual. If you educate a woman, you educate a nation. (Dr. Kwegyir Aggrey)
It’s official! Women’s Voices is a formal entity at UCBC, complete with a &#x02026; <a href="http://localhost/congoinitiative/2015/womens-voices/" class="more-link">Read More →</a></p></div></article></div></section>';

		echo '</div>';		
		echo '<div style="margin-bottom: 10px;"> &nbsp; </div>';
/*
			get_sidebar('blog-cards');

		echo '<div class="home-bottom widget-area"><section id="featured-post-2" class="widget featured-content featuredpost"><div class="widget-wrap">';
		echo the_widget( 'WP_Widget_Meta', $instance, $args );
		echo '</div></article></div></section>'; 
		}
		// Returns true when 'about.php' is being used.
		else {
		// Returns false when 'about.php' is not being used.
		}
} /*
