<?php
/*
Plugin Name: RMM - WordPress Initial Settings
Plugin URI:
Description: My preferred default configuration settings. See 'wp-admin/options.php' for more options.
Version: 1
Author: Ryan Mitchell
Author URI: http://rmitchellmedia.com
*/

function set_rmm_defaults()

{
    // Delete dummy post and comment.
    wp_delete_post(1, TRUE);
    wp_delete_post(2, TRUE);
    wp_delete_post(3, TRUE);
    wp_delete_comment(1);

  //Create Home Page
    wp_insert_post( array(
    'post_title'     => 'Home',
    'post_type'      => 'page',
    'post_name'      => 'home',
    'comment_status' => 'closed',
    'ping_status'    => 'closed',
    'post_content'   => '',
    'post_status'    => 'publish',
    'post_author'    => get_user_by( 'id', 1 )->user_id,
    'menu_order'     => 0,
    // Assign page template
    //'page_template'  => 'template-home.php'
) );

    wp_insert_post( array(
        'post_title'     => 'Blog',
        'post_type'      => 'page',
        'post_name'      => 'blog',
        'comment_status' => 'closed',
        'ping_status'    => 'closed',
        'post_content'   => '',
        'post_status'    => 'publish',
        'post_author'    => get_user_by( 'id', 1 )->user_id,
        'menu_order'     => 0,
        // Assign page template
        //'page_template'  => 'template-blog.php'
    ) );


    $o = array(
        'users_can_register'                        => 0,
        'time_format'                               => 'F j, Y',
        'date_format'                               => 'd.m.Y',
        'gmt_offset'                                => '-7',
        'uploads_use_yearmonth_folders'             => '',
        'show_on_front'                             => 'page',
        'page_for_posts'                            => '3',
        'page_on_front'                             => '2',
        'avatar_default'                            => 'gravatar_default',
        'avatar_rating'                             => 'G',
        'category_base'                             => '',
        'comment_max_links'                         => 0,
        'comments_per_page'                         => 0,
        'default_ping_status'                       => 'closed',
        'default_post_edit_rows'                    => 30,
        'links_updated_date_format'                 => 'j. F Y, H:i',
        'permalink_structure'                       => '/%category%/%postname%/',
        'rss_language'                              => 'de',
        'timezone_string'                           => 'Etc/GMT-1',
        'use_smilies'                               => 1,
        'admin_email'                               => 'webmin@rmitchellmedia.com',
    );

    foreach ( $o as $k => $v )
    {
        update_option($k, $v);
    }


    return;
}
register_activation_hook(__FILE__, 'set_rmm_defaults');




// CUSTOM MENU LINK FOR ALL SETTINGS - WILL ONLY APPEAR FOR ADMIN
function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'all_settings_link');



?>