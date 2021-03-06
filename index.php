<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Slaves
 */

get_header(); ?>

<?php if ( get_option( 'slaves_welcome_title' ) && get_option( 'slaves_welcome_message' ) ) : ?>
 
	<div class="col-md-12 intro-me">
		<h2> <?php echo get_option('slaves_welcome_title'); ?></h2>
		<p> <?php echo get_option('slaves_welcome_message'); ?> </p>
	</div>
<?php endif; ?>
 
<?php get_template_part( 'content', 'thumb' ); ?>
	
<div class="col-md-8">
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
			<div class="clearfix"></div>
			<div class="col-md-12">
			<?php slaves_pagination();?>
			</div>
		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
 
<div class="col-md-4">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>