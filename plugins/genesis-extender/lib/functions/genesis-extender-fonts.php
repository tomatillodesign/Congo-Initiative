<?php
/**
 * Builds the font option lists.
 *
 * @package Extender
 */

/**
 * Build the Genesis Extender font menu HTML.
 *
 * @since 1.0
 */
function genesis_extender_build_font_menu( $selected = '' )
{
	$genesis_extender_font_array = genesis_extender_font_array();
	
	foreach( $genesis_extender_font_array as $font_type => $fonts )
	{
		echo '<optgroup label="' . $font_type . ' -------">';
		foreach( $fonts as $font_slug => $font_data )
		{
			$option = '<option value="' . $font_data . '"';
				
			if( $font_data == $selected )
			{
				$option .= ' selected="selected"';
			}
			
			if( $font_type == 'Google Fonts' )
			{
				$gee = ' [G]';
			}
			
			if( !empty( $gee ) )
			{
				$option .= '>' . $font_slug . $gee . '</option>';
			}
			else
			{
				$option .= '>' . $font_slug . '</option>';
			}
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Create an array of Genesis Extender fonts.
 *
 * @since 1.0
 * @return an array of Genesis Extender fonts.
 */
function genesis_extender_font_array()
{
	$genesis_extender_font_array = array(
		"Standard Fonts" => array(
			"Arial" => "Arial, sans-serif",
			"Arial Black" => "'Arial Black', sans-serif",
			"Courier New" => "'Courier New', sans-serif",
			"Georgia" => "Georgia, serif",
			"Helvetica" => "Helvetica, sans-serif",
			"Impact" => "Impact, sans-serif",
			"Lucida Console" => "'Lucida Console', sans-serif",
			"Lucida Sans Unicode" => "'Lucida Sans Unicode', sans-serif",
			"Tahoma" => "Tahoma, sans-serif",
			"Times New Roman" => "'Times New Roman', serif",
			"Trebuchet MS" => "'Trebuchet MS', sans-serif",
			"Verdana" => "Verdana, sans-serif"
		)
	);
	
	return $genesis_extender_font_array;
}

//end lib/functions/genesis-extender-fonts.php