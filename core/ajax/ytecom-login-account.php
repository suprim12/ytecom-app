<?php


// SAME ONLY DIFF

add_action('wp_ajax_ytecom_login_account', 'ytecom_login_account_handler');
add_action('wp_ajax_nopriv_ytecom_login_account', 'ytecom_login_account_handler');


function ytecom_login_account_handler(){
    $output = ['status'=>1,'msg'=>''];
    $nonce = isset($_POST['_wpnonce']) ? $_POST['_wpnonce']:'';

    // Verify Nonce
    if(!wp_verify_nonce($nonce, 'ytecom_auth')){
     wp_send_json($output);
    }

    // CHECK IF EXIST
    if(!isset($_POST['username'],$_POST['password'])){
        wp_send_json($output);
    }
   
   
    // Sanitize Fields
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);


    // VALIDATION SERVER (NOT RECOMMENDED)
    if(!username_exists($username)){
        $output['msg']=  'Username is not registered.';
        wp_send_json($output);
    }


    // LOGIN USER
    $user_id = wp_signon([
        'user_login' => $username,
        'user_password' => $password,
        'remember' => true
    ],false);


     // Handle Wp Error
     if(is_wp_error($user_id)){
        wp_send_json($output);
    }

    // Notify
    wp_new_user_notification($user_id, null, 'both');

    // Success Res
    $output['status'] = 2;
    wp_send_json($output);

}