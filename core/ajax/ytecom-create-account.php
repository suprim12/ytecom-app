<?php


// ytecom_create_account - Important For ACTION

add_action('wp_ajax_ytecom_create_account', 'ytecom_create_account_handler');
add_action('wp_ajax_nopriv_ytecom_create_account', 'ytecom_create_account_handler');


function ytecom_create_account_handler(){
    $output = ['status'=>1,'msg'=>''];
    $nonce = isset($_POST['_wpnonce']) ? $_POST['_wpnonce']:'';

    // Verify Nonce
    if(!wp_verify_nonce($nonce, 'ytecom_auth')){
     wp_send_json($output);
    }

    // CHECK IF EXIST
    if(!isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['confirm_password'])){
        wp_send_json($output);
    }
   
   
    // Sanitize Fields
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_text_field($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $confirm_password = sanitize_text_field($_POST['confirm_password']);


    // VALIDATION SERVER
    if(username_exists($username)){
        $output['msg']=  'Username is taken.';
        wp_send_json($output);
    }

    if(email_exists($email)){
        $output['msg']=  'Email is taken.';
        wp_send_json($output);
    }
    if($password !== $confirm_password){
        $output['msg']=  'Password do not match.';
        wp_send_json($output);
    }

    // INSERT USER
     $user_id = wp_insert_user([
         'user_login'=> $username,
         'user_pass'=> $password,
         'user_email'=> $email
     ]);

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