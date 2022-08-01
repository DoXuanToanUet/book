<?php
// Add custom Theme Functions here
//active theme h
update_option( 'flatsome_wup_purchase_code', 'makhichhoatladay' );
update_option( 'flatsome_wup_supported_until', '01.01.2050' );
update_option( 'flatsome_wup_buyer', 'jhteam' );
add_action( 'init', 'hide_notice' );
function hide_notice() {
remove_action( 'admin_notices', 'flatsome_maintenance_admin_notice' );
}

//Remove noindex of woocommerce
add_action( 'init', 'remove_wc_page_noindex_by_thangdangblog_com' );
function remove_wc_page_noindex_by_thangdangblog_com(){
	remove_action( 'wp_head', 'wc_page_noindex' );
}

function add_theme_scripts()
{
    $version = '1.0';
    // wp_enqueue_style('devMainCss', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), $version, 'all');
    wp_enqueue_script('devMainJS', get_stylesheet_directory_uri() . '/main.js', array(), $version, true);

}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

require get_stylesheet_directory() . '/inc-td.php';

add_filter( 'rest_authentication_errors', function( $result ) {
    // If a previous authentication check was applied,
    // pass that result along without modification.
    if ( true === $result || is_wp_error( $result ) ) {
        return $result;
    }

    // No authentication has been performed yet.
    // Return an error if user is not logged in.
    if ( ! is_user_logged_in()  ) {
        return new WP_Error(
            'rest_not_logged_in',
            __( 'You are not currently logged in.' ),
            array( 'status' => 401 )
        );
    }

    // Our custom authentication check should have no effect
    // on logged-in requests
    return $result;
});