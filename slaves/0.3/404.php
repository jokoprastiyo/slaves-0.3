<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Slaves
 */

get_header(); ?>


<div class="col-md-8">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found col-md-12">
				<header class="pages-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'slaves' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'slaves' ); ?></p>

					
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<div class="col-md-8">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>