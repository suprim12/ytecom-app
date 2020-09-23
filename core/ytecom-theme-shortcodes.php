<?php

add_shortcode('ytecom_register_form', 'ytecom_register');
add_shortcode('ytecom_login_form', 'ytecom_login');

function ytecom_register(){

    // Logged in Check
    if(is_user_logged_in()){
        return '';
    }

    $url = get_template_directory_uri().'/template-parts/register-form-template.php';
    $formhtml = file_get_contents($url,true);
    $formhtml = str_replace(
    'NONCE_FIELD_PH',
    wp_nonce_field('ytecom_auth','_wpnonce', true, false), 
    $formhtml);
    return $formhtml;
}


function ytecom_login(){
    // Logged in Check
    if(is_user_logged_in()){
        return '';
    }
    $url = get_template_directory_uri().'/template-parts/login-form-template.php';
    $formhtml = file_get_contents($url,true);
    $formhtml = str_replace(
    'NONCE_FIELD_PH',
    wp_nonce_field('ytecom_auth','_wpnonce', true, false), 
    $formhtml);
    return $formhtml;
}


?>