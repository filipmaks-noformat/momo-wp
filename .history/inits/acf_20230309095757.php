<?php 
/**
 * ACF
 *
 * @package nf_wp_theme
 */


	// ACF title change
	function my_layout_title($title, $field, $layout, $i) {
		if($value = get_sub_field('faq_title')) {
			return $value;
		} else {
			foreach($layout['sub_fields'] as $sub) {
				if($sub['name'] == 'faq_title') {
					$key = $sub['key'];
					if(array_key_exists($i, $field['value']) && $value = $field['value'][$i][$key])
						return $value;
				}
			}
		}
		return $title;
	}
	add_filter('acf/fields/flexible_content/layout_title', 'my_layout_title', 10, 4);


	/* OPTIONS PAGES
	if( function_exists('acf_add_options_page') ) {

		$parent = acf_add_options_page(array(
			'page_title' 	=> 'Theme Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		// add sub page
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Contact info',
			'menu_title' 	=> 'Contact info',
			'parent_slug' 	=> $parent['menu_slug'],
		));
		
	}*/