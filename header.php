<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cassions
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<div class="site-pusher">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'cassions' ); ?></a>
		<!-- begin .header-mobile-menu -->
		<nav class="st-menu st-effect-3" id="menu-3">

			<form class="header-search-form" role="search" method="get" action="<?php echo esc_url( site_url( '/' ) ); ?>">

				<input type="hidden" value="post" name="post_type" id="post_type" />

				<input type="text" id="s" name="s" placeholder="<?php _e('Search on this web...', 'gp'); ?>"/><button type="submit" id="searchsubmit" /><i class="fa fa-search"></i></button>

			</form>

			<?php wp_nav_menu( array('theme_location' => 'primary','echo' => true,'items_wrap' => '<ul>%3$s</ul>')); ?>

		</nav>
		<!-- end .header-mobile-menu -->
		<header id="masthead" class="site-header" role="banner" data-parallax="scroll" data-image-src="<?php header_image() ; ?>">
			<div class="site-header-wrap">

				<div class="header-topbar">
					<div class="container">

						<button type="button" data-effect="st-effect-3" class="header-top-mobile-menu-button mobile-menu-button"><i class="fa fa-bars"></i></button>

						<div class="top-time">
							<span><?php bloginfo('name'); ?> - <time><?php echo date('l, F jS, Y'); ?></time></span>
						</div>

						<!-- begin gp-top-icons-search -->
						<div class="topbar-icons-search">

							<div class="topbar-icons">
								<?php wp_nav_menu( array( 'theme_location' => 'social-menu' , 'container_class' => 'social-links', 'link_before' => '<span class="screen-reader-text">',  'link_after'   => '</span>'  ) ); ?>
							</div>

							<div class="topbar-search">

							</div>

						</div>
						<!-- end top-icons-search -->

					</div>
				</div>


				<div class="site-branding">
					<div class="container">
						<?php if ( has_custom_logo() ) : ?>
						<div class="site-logo">
							<?php cassions_the_custom_logo(); ?>
						</div>
						<?php endif; ?>


						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
					</div>
				</div><!-- .site-branding -->
			</div> <!-- .site-header-wrap -->
		</header><!-- #masthead -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		</nav><!-- #site-navigation -->

		<div id="content" class="site-content">
