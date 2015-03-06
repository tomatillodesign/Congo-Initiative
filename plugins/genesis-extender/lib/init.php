<?php
/**
 * This is the initialization file for Genesis Extender,
 * defining constants, globaling database option arrays
 * and requiring other function files.
 *
 * @package Extender
 */

/**
 * Require files.
 */
require_once( GENEXT_PATH . 'lib/functions/genesis-extender-file-paths.php' );
require_once( GENEXT_PATH . 'lib/functions/genesis-extender-options.php' );

/**
 * Create a global to define whether or not the CSS Buidler Popup tool is active.
 */
$genesis_extender_css_builder_popup = false;

require_once( GENEXT_PATH . 'lib/functions/genesis-extender-add-styles.php' );
require_once( GENEXT_PATH . 'lib/functions/genesis-extender-functions.php' );
require_once( GENEXT_PATH . 'lib/functions/genesis-extender-fonts.php' );

if( is_admin() )
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-option-lists.php' );

if( !is_admin() && genesis_extender_get_custom_css( 'css_builder_popup_active' ) )
	add_action( 'init', 'genesis_extender_require_genesis_extender_options_lists');

function genesis_extender_require_genesis_extender_options_lists()
{
	if( current_user_can( 'administrator' ) )
		require_once( GENEXT_PATH . 'lib/functions/genesis-extender-option-lists.php' );
}

if( genesis_extender_get_custom_css( 'css_builder_popup_active' ) )
	add_action( 'init', 'genesis_extender_require_css_builder_popup');

function genesis_extender_require_css_builder_popup()
{
	if( current_user_can( 'administrator' ) )
		require_once( GENEXT_PATH . 'lib/admin/css-builder-popup.php' );
}

/**
 * Create globals and Require files only needed for admin.
 */
if( is_admin() )
{
	/**
	 * Create globals to define both the folder locations to be written to and their current writable state.
	 */
	$genesis_extender_folders = array( get_stylesheet_directory(), get_stylesheet_directory() . '/my-templates', genesis_extender_get_stylesheet_location( 'path', $root = true ), genesis_extender_get_stylesheet_location( 'path' ), genesis_extender_get_stylesheet_location( 'path' ) . 'images', genesis_extender_get_stylesheet_location( 'path' ) . 'adminthumbnails', genesis_extender_get_stylesheet_location( 'path' ) . 'tmp', genesis_extender_get_stylesheet_location( 'path' ) . 'tmp/images', genesis_extender_get_stylesheet_location( 'path' ) . 'tmp/images/adminthumbnails' );
	$genesis_extender_unwritable = false;

	foreach( $genesis_extender_folders as $genesis_extender_folder )
	{
		if( is_dir( $genesis_extender_folder ) && !is_writable( $genesis_extender_folder ) )
		{
			// Update $genesis_extender_unwritable global.
			$genesis_extender_unwritable = true;
		}
	}

	require_once( GENEXT_PATH . 'lib/admin/build-menu.php' );
	require_once( GENEXT_PATH . 'lib/admin/genesis-extender-settings.php' );
	require_once( GENEXT_PATH . 'lib/admin/genesis-extender-custom-options.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-user-meta.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-build-styles.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-write-files.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-image-uploader.php' );
	require_once( GENEXT_PATH . 'lib/update/genesis-extender-edd-updater.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-import-export.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-ez-structures.php' );
	require_once( GENEXT_PATH . 'lib/admin/metaboxes/genesis-extender-metaboxes.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-templates.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-labels.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-conditionals.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-widget-areas.php' );
	require_once( GENEXT_PATH . 'lib/functions/genesis-extender-hook-boxes.php' );
	require_once( GENEXT_PATH . 'lib/update/genesis-extender-update.php' );
}

//end lib/init.php