<?php 
/**
 * The theme blocks file
 *
 * @package nf_wp_theme
 */
	
	
	/**
	 * Allow block types
	 */
	function my_allowed_block_types( $allowed_block_types) {
		
		return array(
			'core/block',
			'core/paragraph',
            'core/list',
            'core/list-item',
			'core/image',
			'core/heading',
			'core/media-text',
			'core/video',
			'core/cover',
			'core/group',
			'core/buttons',
			'core/columns',
			'core/shortcode',
			'acf/pageheader'
		);
	}
	add_filter( 'allowed_block_types', 'my_allowed_block_types');
	
	/**
	 * Reusable Blocks accessible in backend
	 *
	 * @link https://www.billerickson.net/reusable-blocks-accessible-in-wordpress-admin-area
	 */
	function be_reusable_blocks_admin_menu() {
		add_menu_page( 'Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
	}
	add_action( 'admin_menu', 'be_reusable_blocks_admin_menu' );

	
	/**
	 * Register ACF blocks
	 */
	function register_acf_block_types() {

		acf_register_block_type(array(
			'name'              => 'pageheader',
			'title'             => __('Page header'),
			'description'       => __('A custom page header block.'),
			'render_template'   => 'partials/blocks/page-header.php',
			'post_types' 		=> array('page'),
			'category'          => 'layout',
			'icon'              => 'align-center',
			'keywords'          => array( 'header', 'title' ),
			'supports' 			=> array(
				'align' => false,
				'anchor' => true,
				'multiple' => false,
			),
		));
		
		
	}

	// Check if function exists and hook into setup.
	if( function_exists('acf_register_block_type') ) {
		add_action('acf/init', 'register_acf_block_types');
	}