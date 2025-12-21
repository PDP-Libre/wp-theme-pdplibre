<?php
/**
 * PDPLibre FSE
 *
 * @author Guillaume AGNIERAY
 * @author TIM
 * @package pdplibre-fse
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define('PDPLIBRE_FSE_VERSION', wp_get_theme()->get( 'Version' ));

/**
 * Enqueue CSS and JS
 */
if ( ! function_exists( 'pdplibre_fse_styles' ) ) {
    function pdplibre_fse_styles() {
        wp_register_style(
            'pdplibre-fse-style',
            get_stylesheet_uri(),
            [],
            PDPLIBRE_FSE_VERSION
        );
        wp_enqueue_style( 'pdplibre-fse-style' );
        wp_register_script(
            'pdplibre-fse-script',
            get_stylesheet_directory_uri() . '/js/script.js',
            ['jquery'],
            PDPLIBRE_FSE_VERSION,
            true
        );
        wp_enqueue_script('pdplibre-fse-script');
    }
}
add_action( 'wp_enqueue_scripts', 'pdplibre_fse_styles' );

/**
 * Head tag customizations
 */
 function pdplibre_fse_wp_head() {
    echo '<link rel="icon" type="image/svg+xml" href="/favicon.svg" />';
    echo '<link rel="shortcut icon" href="/favicon.ico" />';
    echo '<link rel="manifest" href="/site.webmanifest" />';
    echo '<link rel="me" href="https://piaille.fr/@pdp_libre" />';
}
add_action('wp_head', 'pdplibre_fse_wp_head');

/**
 * Add offset on scroll with Fast Smooth Scroll plugin
 */
function pdplibre_fse_get_custom_scroll_offset() {
    return 80;
}
add_filter( 'fast_smooth_scroll_offset', 'pdplibre_fse_get_custom_scroll_offset' );

/**
 * Ajouts "blocages" TIM
 */

// Disable core update emails
add_filter( 'auto_core_update_send_email', '__return_false' );
// Disable plugin update emails
add_filter( 'auto_plugin_update_send_email', '__return_false' );
// Disable theme update emails
add_filter( 'auto_theme_update_send_email', '__return_false' );

//blocage rest api https://example.com/wp-json/wp/v2/users
add_filter( 'rest_authentication_errors', function( $result ) {
    // sauf pour contact form
    $var = $_SERVER['REQUEST_URI'];
    $good = [
        "/wp-json/contact-form-7/v1/contact-forms/6/refill",
        "/wp-json/contact-form-7/v1/contact-forms/6/refill/",
        "/wp-json/contact-form-7/v1/contact-forms/6/feedback",
        "/wp-json/contact-form-7/v1/contact-forms/6/feedback/",
        "/wp-json/contact-form-7/v1/contact-forms/6/feedback/schema",
        "/wp-json/contact-form-7/v1/contact-forms/6/feedback/schema/"
    ];
    // Pas d'utilisateur connecté --> erreur
    if ( ! is_user_logged_in() ) {
        if (in_array($var, $good, TRUE) == false) {
            return new WP_Error(
                'rest_not_logged_in',
                __( 'You are not currently logged in.' ),
                array( 'status' => 401 )
            );
        }
    }
    // user connecté = ok
    return $result;
});

// enlever la version wp de head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');

// enlever la version wp dans rss
function pdplibre_fse_remove_version() {
    return '';
}
add_filter('the_generator', 'pdplibre_fse_remove_version');

// enlever la version wp dans scripts et styles
function pdplibre_fse_remove_version_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'pdplibre_fse_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'pdplibre_fse_remove_version_scripts_styles', 9999);

//masquer les erreurs de cnx
add_filter( 'login_errors', function( $errors ){ return 'Error'; } );

// limiter les logs action schedule à 1 jour (au lieu de 30)
function pdplibre_fse_action_scheduler_purge() {
    return DAY_IN_SECONDS;
};
add_filter( 'action_scheduler_retention_period', 'pdplibre_fse_action_scheduler_purge' );

/**
 * fin "blocages" TIM...
 */
