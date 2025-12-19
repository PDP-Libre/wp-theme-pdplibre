<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
 wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
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
$good = array(
"/wp-json/contact-form-7/v1/contact-forms/6/refill", 
"/wp-json/contact-form-7/v1/contact-forms/6/refill/", 
"/wp-json/contact-form-7/v1/contact-forms/6/feedback", 
"/wp-json/contact-form-7/v1/contact-forms/6/feedback/", 
"/wp-json/contact-form-7/v1/contact-forms/6/feedback/schema",
"/wp-json/contact-form-7/v1/contact-forms/6/feedback/schema/"
);
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
function wpt_remove_version() {
return ''; }
add_filter('the_generator', 'wpt_remove_version');


// enlever la version wp dans scripts et styles
function shapeSpace_remove_version_scripts_styles($src) {
        if (strpos($src, 'ver=')) {
                $src = remove_query_arg('ver', $src);
        }
        return $src;
}
add_filter('style_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);

//masquer les erreurs de cnx
add_filter( 'login_errors', function( $errors ){ return 'Error'; } );

// limiter les logs action schedule à 1 jour (au lieu de 30)
add_filter( 'action_scheduler_retention_period', 'wpb_action_scheduler_purge' );
function wpb_action_scheduler_purge() {
 return DAY_IN_SECONDS;
};
/**
 * fin "blocages" TIM... 
 */

/* Ajout d'une zone de widget*/
function footer_widgets_init() {
 
 register_sidebar( array(

 'name' => 'Nouvelle zone de widget',
 'id' => 'new-widget-area',
 'before_widget' => '<div class="nwa-widget">',
 'after_widget' => '</div>',
 'before_title' => '<h2 class="nwa-title">',
 'after_title' => '</h2>',
 ) );
}

add_action( 'widgets_init', 'footer_widgets_init' );

/* Icône pour le flux RSS */
function rss_add_site_image() {
    $logo_img = '/wp-content/uploads/2025/12/pdprss.png'; 
    echo '<image>';
	echo '<url>' . esc_url(home_url()) . esc_url($logo_img) . '</url>';
    echo '<title>' . get_bloginfo('name') . '</title>';
    echo '<link>' . esc_url(home_url()) . '</link>';
    echo '<width>32</width>';
	echo '<height>32</height>';
    echo '</image>';
}
add_action('rss2_head', 'rss_add_site_image');



?>