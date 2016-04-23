<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cassions
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php if ( is_active_sidebar( 'home-2' ) ) { ?>
		<div class="home-sidebar home-sidebar-2">
			<?php dynamic_sidebar( 'home-2' ); ?>
		</div>
	<?php } ?>
	
</aside><!-- #secondary -->
