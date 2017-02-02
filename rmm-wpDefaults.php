<?php
/*
Plugin Name: RMM - wp Defaults
Plugin URI:
Description: My preferred default plugins and WP Options.  Use with a clean install, install plugins for development then keep active until development is complete.
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


//Require Plugins using TGM Plugin Activation

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'rmm_wpDefaults_register_required_plugins' );
function rmm_wpDefaults_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name' => 'Advanced Custom Fields Pro', // The plugin name.
            'slug' => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
            'source' => 'https://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9NjI4MzV8dHlwZT1wZXJzb25hbHxkYXRlPTIwMTUtMDgtMjYgMjM6MTg6MzE=', // The plugin source.
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
            'external_url' => 'https://www.advancedcustomfields.com/my-account/', // If set, overrides default API URL and points to an external URL.
        ),

        array(
            'name' => 'acf-fancy-repeater-field',
            'slug' => 'acf-fancy-repeater-field',
            'source' => 'https://github.com/lucasstark/acf-fancy-repeater-field/archive/master.zip',
            'external_url' => 'https://github.com/lucasstark/acf-fancy-repeater-field',
            'force_activation'  => true,
        ),

        array(
            'name' => 'ACF Content Analysis for Yoast SEO',
            'slug' => 'acf-content-analysis-for-yoast-seo',
            'required' => false,
        ),

        array(
            'name' => 'Simple Page Ordering',
            'slug' => 'simple-page-ordering',
            'required' => false,
        ),

        array(
            'name' => 'Velvet Blues Update URLs',
            'slug' => 'velvet-blues-update-urls',
            'required' => false,
        ),
        array(
            'name' => 'WP Sync DB',
            'slug' => 'wp-sync-db',
            'source' => 'https://github.com/wp-sync-db/wp-sync-db/archive/master.zip',
            'external_url' => 'http://wp-sync-db.github.io/',
            'force_activation'  => true,
        ),
        array(
            'name' => 'Debug Bar',
            'slug' => 'debug-bar',
            'required' => false,
        ),

        array(
            'name' => 'Regenerate Thumbnails',
            'slug' => 'regenerate-thumbnails',
            'required' => false,
        ),

        array(
            'name' => 'User Switching',
            'slug' => 'user-switching',
            'required' => false,
        ),

        array(
            'name' => 'Query Monitor',
            'slug' => 'query-monitor',
            'required' => false,
        ),

        array(
            'name' => 'Monster Widget',
            'slug' => 'monster-widget',
            'required' => false,
            'external_url' => 'https://wordpress.org/plugins/monster-widget/',
        ),
    );


    $config = array(
        'id' => 'rmm-wpDefaults',                       // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                           // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins',              // Menu slug.
        'parent_slug' => 'plugins.php',                 // Parent menu slug.
        'capability' => 'manage_options',               // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,                          // Show admin notices or not.
        'dismissable' => false,                          // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => 'Uninstall Dev plugins and before launch',                            // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                        // Automatically activate plugins after installation or not.
        'message' => '',                                // Message to output right before the plugins table.


    );

    tgmpa( $plugins, $config );
}
?>