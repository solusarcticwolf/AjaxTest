<?php

function load_scripts() {
    // enqueue ajax script                                                                                          true = footer
    wp_enqueue_script('ajax', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0', true);
    wp_localize_script('ajax' , 'wp_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'load_scripts');