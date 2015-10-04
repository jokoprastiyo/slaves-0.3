<?php
/**
 * @package Slaves
 */
?>

<?php
if ( get_option( 'slaves_column_option' ) == 2 ) :
	$home_post = 'col-md-6 col-sm-6 postbox';
else :
	$home_post = 'col-md-12 col-sm-12';
endif;
?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class($home_post); ?>>
 
<?php if ( get_option( 'slaves_column_option' ) == 2 ) : ?>
	<div class="colbox">
<?php else: ?>
	<div class="postsingle">
<?php endif; ?>
			
		<?php if( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		<?php else : ?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri() . '/images/default-image.png'; ?>" alt="sample-post-thumbnail"></a>
		<?php endif; ?>	
		
		<h2 class="postbox-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'slaves' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="postbox-entry"><?php the_excerpt(); ?></div>
	
	</div>
 
</article><!-- #post-## -->