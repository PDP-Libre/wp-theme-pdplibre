<?php
/**
 * The header for our theme.
 *
 * Displays all of the head section.
 *
 * @package Nisarg
 */
?>
<!DOCTYPE html>

<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--
Ajout TIM 
-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-title" content="PDP libre" />
<meta name="description" content="Pour une facturation électronique accessible à tous">

<meta property="og:url" content="https://pdplibre.org">
<meta property="og:type" content="website">
<meta property="og:title" content="PDP Libre">
<meta property="og:description" content="https://pdplibre.org/og.png">
<meta property="og:image" content="Pour une facturation électronique accessible à tous">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="PDP Libre">
<meta name="twitter:description" content="">
<meta name="twitter:image" content="https://pdplibre.org/og.png">
<meta property="twitter:domain" content="pdplibre.org">
<meta property="twitter:url" content="https://pdplibre.org">

<meta itemprop="name" content="PDP Libre" />
<meta itemprop="url" content="https://pdplibre.org" />
<meta itemprop="thumbnailUrl" content="https://pdplibre.org/og.png" />

<link rel="icon" type="image/png" href="https://pdplibre.org/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="https://pdplibre.org/favicon.svg" />
<link rel="shortcut icon" href="https://pdplibre.org/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="https://pdplibre.org/apple-touch-icon.png" />
<link rel="manifest" href="https://pdplibre.org/site.webmanifest" />
<link rel="me" href="https://piaille.fr/@pdp_libre">

<!-- redirection pour la page contact vers page "merci" -->
<script>
	document.addEventListener( 'wpcf7mailsent', function(event) {
         location = 'https://pdplibre.org/merci/';}, false );
</script>
<!--
Fin ajout TIM 
-->
<?php wp_head(); ?>
</head>
<?php 
	$theme_skin = get_theme_mod( 'nisarg_skin_select', 'light' ); 
	$skin_words = explode('-', $theme_skin );
	$header_type = get_theme_mod( 'nisarg_header_type', 'h-title-tagline' );
	$add_class = '';
	//If an option is selected to hide site header then add space after top navbar
	if( 'none' === $header_type ) {
		$add_class =  'class='.'add-margin-bottom';
	}
?>
<body <?php body_class( $skin_words ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">
<header id="masthead"  <?php echo esc_attr( $add_class ); ?> role="banner">
	<nav id="site-navigation" class="main-navigation navbar-fixed-top navbar-left" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="container" id="navigation_menu">
			<div class="navbar-header">
				<?php if ( has_nav_menu( 'primary' ) ) { ?>
					<button type="button" class="menu-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				<?php } ?>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' )?></a>
			</div><!-- .navbar-header -->
			<?php if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location'    => 'primary',
					'container'         => 'div',
					'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
					'menu_class'        => 'primary-menu',
				) ); } ?>
		</div><!--#container-->
	</nav>
	<div id="cc_spacer"></div><!-- used to clear fixed navigation by the themes js -->

	<?php if( 'h-title-tagline' === $header_type ) {?>
	<div class="site-header">
		<div class="site-branding">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>
		</div><!--.site-branding-->
	</div><!--.site-header-->
	<?php } ?>

</header>
<div id="content" class="site-content">
