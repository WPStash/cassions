<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cassions
 */

get_header(); ?>

<div class="container">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="featured-posts">

				<?php if ( is_active_sidebar( 'home-1' ) ) { ?>
				<div class="home-sidebar home-sidebar-1">
					<?php dynamic_sidebar( 'home-1' ); ?>
				</div>
				<?php } ?>

				<?php if ( is_active_sidebar( 'home-2' ) ) { ?>
					<div class="home-sidebar home-sidebar-2">
						<?php dynamic_sidebar( 'home-2' ); ?>
					</div>
				<?php } ?>


				<?php if ( is_active_sidebar( 'home-3' ) ) { ?>
					<div class="home-sidebar home-sidebar-3">
						<?php dynamic_sidebar( 'home-3' ); ?>
					</div>
				<?php } ?>

				<?php if ( is_active_sidebar( 'home-4' ) ) { ?>
					<div class="home-sidebar home-sidebar-4">
						<?php dynamic_sidebar( 'home-4' ); ?>
					</div>
				<?php } ?>

            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

    <?php get_sidebar(); ?>

</div>
<?php
get_footer();
