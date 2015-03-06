<?php
/**
 * Register Custom Widget Areas.
 */

genesis_register_sidebar( array(
	'id' 			=>	'blog_cards',
	'name'			=>	__( 'Blog Cards', 'extender' ),
	'description' 	=>	__( 'Setup a special area above the main blog loop', 'extender' )
) );
