<?php
/**
 * Settings class for Redirect WP Author plugin.
 *
 * @package Redirect WP Author
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Redirect_WP_Author_Settings {

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    /**
     * Add settings page to the admin menu.
     */
    public function add_settings_page() {
        add_options_page(
            esc_html__( 'Redirect WP Author Settings', 'redirect-wp-author' ),
            esc_html__( 'Redirect WP Author', 'redirect-wp-author' ),
            'manage_options',
            'redirect-wp-author',
            array( $this, 'settings_page_content' )
        );
    }

    /**
     * Register settings.
     */
    public function register_settings() {
        // Register setting with separate sanitization callback instead of using the array argument
        register_setting(
            'redirect_wp_author_options',
            'redirect_wp_author_redirect_type',
            'intval'  // Use WordPress built-in sanitization function
        );

        // Add validation through a filter
        add_filter('pre_update_option_redirect_wp_author_redirect_type', array($this, 'validate_redirect_type'), 10, 2);

        add_settings_section(
            'redirect_wp_author_main_section',
            esc_html__( 'Redirect Settings', 'redirect-wp-author' ),
            array( $this, 'main_section_callback' ),
            'redirect-wp-author'
        );

        add_settings_field(
            'redirect_wp_author_redirect_type',
            esc_html__( 'Redirect Type', 'redirect-wp-author' ),
            array( $this, 'redirect_type_callback' ),
            'redirect-wp-author',
            'redirect_wp_author_main_section',
            array(
                'label_for' => 'redirect_wp_author_redirect_type',
                'class'     => 'redirect-wp-author-row',
            )
        );
    }

    /**
     * Validate the redirect type option before it's saved.
     *
     * @param mixed $new_value The new value that would be saved.
     * @param mixed $old_value The old option value.
     * @return int The validated value.
     */
    public function validate_redirect_type( $new_value, $old_value ) {
        // Ensure we have a clean integer
        $new_value = absint( $new_value );

        // Only allow specific valid redirect types
        $allowed_values = array( 301, 302 );

        if ( ! in_array( $new_value, $allowed_values, true ) ) {
            // Add a settings error if an invalid value was passed
            add_settings_error(
                'redirect_wp_author_redirect_type',
                'invalid_redirect_type',
                esc_html__( 'Invalid redirect type provided. Using default 301 redirect.', 'redirect-wp-author' ),
                'error'
            );
            return 301; // Default to 301 if invalid value
        }

        return $new_value;
    }

    /**
     * Main section description.
     */
    public function main_section_callback() {
        echo '<p>' . esc_html__( 'Configure the settings for the Redirect WP Author plugin.', 'redirect-wp-author' ) . '</p>';
    }

    /**
     * Redirect type field callback.
     *
     * @param array $args Field arguments.
     */
    public function redirect_type_callback( $args ) {
        $redirect_type = get_option( 'redirect_wp_author_redirect_type', 301 );
        $label_for = isset( $args['label_for'] ) ? $args['label_for'] : 'redirect_wp_author_redirect_type';
        ?>
        <select name="<?php echo esc_attr( $label_for ); ?>" id="<?php echo esc_attr( $label_for ); ?>">
            <option value="301" <?php selected( $redirect_type, 301 ); ?>><?php esc_html_e( '301 - Permanent Redirect', 'redirect-wp-author' ); ?></option>
            <option value="302" <?php selected( $redirect_type, 302 ); ?>><?php esc_html_e( '302 - Temporary Redirect', 'redirect-wp-author' ); ?></option>
        </select>
        <p class="description">
            <?php esc_html_e( '301 redirects are permanent and better for SEO. 302 redirects are temporary.', 'redirect-wp-author' ); ?>
        </p>
        <?php
    }

    /**
     * Settings page content.
     */
    public function settings_page_content() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'redirect_wp_author_options' );
                do_settings_sections( 'redirect-wp-author' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}