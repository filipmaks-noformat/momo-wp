<?php 
/**
 * Shortcodes
 *
 * @package nf_wp_theme
 */

// REMOVE EMPTY P TAG IN SHORTCODES
function shortcode_empty_paragraph_fix( $content ) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );
}
add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );


// BUTTON
function button_shortcode( $atts, $content = null ) {
	$btn = shortcode_atts( array(
		'class' => 'green'
	), $atts );
    $output = '<span class="button-outer btn-color-outer-' . esc_attr( $btn['class'] ) . '">' . $content . '</span>';
	return $output;
}
add_shortcode('button', 'button_shortcode');