<?php

function ytecom_theme_support()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-background');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'comment-form'));
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
            'social' => __('Social Menu'),
            'top' => __('Top Menu'),
        )
    );
    // Woocommerce theme support
    add_theme_support('woocommerce');
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action('after_setup_theme', 'ytecom_theme_support');