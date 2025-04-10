<?php
/**
 * Plugin Name: Redirect WP Author
 * Plugin URI: https://github.com/virtualox/redirect-wp-author
 * Description: Redirects author pages to the homepage with configurable redirect type (301 or 302).
 * Version: 1.1.0
 * Author: VirtualOx B.V.
 * Author URI: https://github.com/virtualox
 * Text Domain: redirect-wp-author
 * License: GNU General Public License v3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Define plugin constants
define( 'REDIRECT_WP_AUTHOR_VERSION', '1.1.0' );
define( 'REDIRECT_WP_AUTHOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'REDIRECT_WP_AUTHOR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load text domain for translations
add_action( 'plugins_loaded', 'redirect_wp_author_load_textdomain' );
function redirect_wp_author_load_textdomain() {
    load_plugin_textdomain(
        'redirect-wp-author',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages'
    );
}

// Helper function to determine current locale
function redirect_wp_author_get_locale() {
    $locale = determine_locale();
    return apply_filters( 'plugin_locale', $locale, 'redirect-wp-author' );
}

// Include the settings class
require_once REDIRECT_WP_AUTHOR_PLUGIN_DIR . 'includes/class-settings.php';

// Initialize settings
$redirect_wp_author_settings = new Redirect_WP_Author_Settings();

/**
 * Redirect to the home page for existing and non-existing author pages.
 */
add_action( 'template_redirect', 'redirect_wp_author_template_redirect', 1 );
function redirect_wp_author_template_redirect() {
    // Check for author query var or author archive page
    if ( isset( $_GET['author'] ) || is_author() ) {
        // Validate the request by checking the nonce if it exists (for admin users)
        if ( is_admin() && isset( $_GET['_wpnonce'] ) ) {
            $nonce = sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) );
            if ( ! wp_verify_nonce( $nonce, 'redirect_wp_author' ) ) {
                wp_die( esc_html__( 'Security check failed. Please try again.', 'redirect-wp-author' ) );
            }
        }

        // Get the redirect type from options (default to 301 if not set)
        $redirect_type = get_option( 'redirect_wp_author_redirect_type', 301 );

        wp_redirect( home_url(), intval( $redirect_type ) );
        exit;
    }
}

/**
 * Remove author links from admin area.
 */
add_filter( 'user_row_actions', 'redirect_wp_author_remove_user_row_actions', PHP_INT_MAX, 2 );
function redirect_wp_author_remove_user_row_actions( $actions ) {
    if ( isset( $actions['view'] ) ) {
        unset( $actions['view'] );
    }
    return $actions;
}

/**
 * Override author links in frontend.
 */
add_filter( 'author_link', 'redirect_wp_author_override_author_link', PHP_INT_MAX );
function redirect_wp_author_override_author_link() {
    return '#';
}

/**
 * Remove author posts links.
 */
add_filter( 'the_author_posts_link', '__return_empty_string', PHP_INT_MAX );

/**
 * Add settings link on plugin page.
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'redirect_wp_author_settings_link' );
function redirect_wp_author_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=redirect-wp-author">' . esc_html__( 'Settings', 'redirect-wp-author' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}