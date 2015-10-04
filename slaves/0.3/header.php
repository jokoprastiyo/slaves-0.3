<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Slaves
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#main"><?php _e( 'Skip to content', 'slaves' ); ?></a>
	
	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="container"> <div class="row"> 
			<div class="col-md-4 col-xs-12">
				<div class="site-branding">

	<?php if ( get_header_image() ) { ?>
				<a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo get_header_image(); ?>" alt="<?php echo esc_attr( bloginfo('name', 'display') ); ?>" title="<?php echo esc_attr( bloginfo('name', 'display') ); ?>" /></a>
	<?php } else { ?>
				<h1 class="site-title logo"><a id="blogname" href="<?php echo home_url(); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
	<?php } ?>

				</div>
		</div>
			
			<div class="col-md-8 col-xs-12">
			
			 <nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => '', 'menu_class' => 'main-nav' ) ); ?>
			 </nav><!-- #site-navigation -->
			</div>
		</div></div>
	</header><!-- #masthead -->
	
<div class="container">
	<div id="content" class="site-content row">
