<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Slaves
 */
?>

	</div><!-- #content -->
	
	<?php if ( get_option( 'slaves_display_footer_widget' ) == 1 ) : ?>

	<div id="prefooter" class="row">
			
			<?php if ( ! dynamic_sidebar('footer-widgets') ) :
			        dynamic_sidebar('footer-widgets'); ?>  
			<?php endif; ?>
				
	</div>

	<?php endif; ?>
	
	<div class="row">
	 
	<footer id="colophon" class="site-footer col-md-12" role="contentinfo">
		<div class="site-info">
			<div class="footer-info col-md-12 col-xs-12">
				Copyright &copy; <?php echo date('Y');?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a> - <?php bloginfo('description'); ?>.<p><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'slaves' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'slaves' ), 'WordPress' ); ?></a></p>
			</div>		
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
