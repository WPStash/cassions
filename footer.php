<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cassions
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="footer-widgets">
				<div class="container">
					<?php
						if ( is_active_sidebar( 'footer' ) ) {
							dynamic_sidebar( 'footer' );
						}
					?>
				</div>
			</div>

			<div class="site-info">
				<div class="container">

					<div class="site-copyright">
						<?php printf( esc_html( 'All Site Contents &copy; Copyright 2016 Cassions WordPress. All Rights Reserved.', 'cassions' ) ) ?>
					</div>

					<div class="site-theme-by">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cassions' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'cassions' ), 'WordPress' ); ?></a>
						<span class="sep"> . </span>
						<?php printf( esc_html__( 'Theme by %2$s.', 'cassions' ), 'cassions', '<a href="https://wpstash.com" rel="designer">WPStash</a>' ); ?>
					</div>
				</div>
			</div><!-- .site-info -->

		</footer><!-- #colophon -->
	</div><!-- .site-pusher -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
