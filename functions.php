<?php
/*
 * This is the child theme for Twenty Twenty-Two theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles' );
function child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
/*
 * Your code goes below
 */
function load_scripts() {

	wp_enqueue_script('ajax', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), NULL, true);

	wp_localize_script('ajax' , 'wp_ajax',
		array('ajax_url' => admin_url('admin-ajax.php'))
		);

}
add_action( 'wp_enqueue_scripts', 'load_scripts');


// PHP Callback for AJAX request
add_action( 'wp_ajax_nopriv_filter', 'filter_ajax' );
add_action( 'wp_ajax_filter', 'filter_ajax' );

function filter_ajax() {


$category = $_POST['category'];

$args = array(
		'post_type' => 'post',
		'posts_per_page' => -1
		);

if(isset($category)) {
	$args['category__in'] = array($category);
}

		$query = new WP_Query($args);

		if($query->have_posts()) :
			while($query->have_posts()) : $query->the_post();
				the_title('<h2>', '</h2>');
				the_content('<p>', '</p>');
			endwhile;
		endif;
			wp_reset_postdata(); 


	die();
}
