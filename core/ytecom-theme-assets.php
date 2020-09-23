<?php
add_action('wp_enqueue_scripts', 'ytecom_theme_assets');

function ytecom_theme_assets(){
    wp_enqueue_style('Custom', get_template_directory_uri() . '/assets/css/style.css');

    wp_register_script('CustomJs', get_template_directory_uri() . '/assets/js/main.js', array(), true, true);

    wp_enqueue_script( 'CustomJs' );
    wp_localize_script('CustomJs', 'ytecom_obj', [
        'ajax_url'=>admin_url('admin-ajax.php'),
        'home_url'=>home_url('/'),
    ]);
}
