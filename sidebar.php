<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Slaves
 */
?>
	
	<div id="secondary" class="secondary">
		<?php if ( ! dynamic_sidebar( 'main-sidebar' ) ) : ?>
<div id="widgets" class="widgets row" role="complementary">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		<?php endif; // end sidebar widget area ?>
</div>
	</div><!-- #secondary -->
