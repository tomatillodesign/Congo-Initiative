<?php
/**
 * Build and Hook-In Custom Widget Areas.
 */

/* Name: Blog Cards */

add_action( 'genesis_loop', 'genesis_extender_blog_cards_widget_area', 8 );
function genesis_extender_blog_cards_widget_area() {
	genesis_extender_blog_cards_widget_area_content();
}

function genesis_extender_blog_cards_widget_area_content() {
	genesis_widget_area( 'blog_cards', $args = array (
		'before'              => '<div id="blog_cards" class="widget-area genesis-extender-widget-area">',
		'after'               => '</div>',
		'before_sidebar_hook' => 'genesis_before_blog_cards_widget_area',
		'after_sidebar_hook'  => 'genesis_after_blog_cards_widget_area'
	) );
}
