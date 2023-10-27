<?php
/**
 * Plugin Name: Redirect WP Author
 * Plugin URI: https://github.com/virtualox/redirect-wp-author
 * Description: Redirects author pages to the homepage.
 * Version: 1.0.0
 * Author: VirtualOx B.V.
 * Author URL: https://github.com/virtualox
 * Text Domain: redirect-wp-author
 * License: GNU General Public License v3.0
 * License URL: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit;

load_plugin_textdomain( 'redirect-wp-author', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

/* Redirect to the home page for existing and non-existing author pages. */
add_action( 'template_redirect',
	function() {
		if ( isset( $_GET['author'] ) || is_author() ) {
			// Using a 301 redirect by default as it's a permanent redirect. Change to 302 for a temporary redirect.
			wp_redirect( home_url(), 301 ); 
			exit;
		}
	}, 1 );

/* Remove author links. */
add_filter( 'user_row_actions',
	function( $actions ) {
		if ( isset( $actions['view'] ) )
			unset( $actions['view'] );
		return $actions;
	}, PHP_INT_MAX, 2 );
add_filter( 'author_link', function() { return '#'; }, PHP_INT_MAX );
add_filter( 'the_author_posts_link', '__return_empty_string', PHP_INT_MAX );
