<?php if ( get_option( 'slaves_display_featured_images' ) == 1 ) : ?>
    <div class="post-thumb">
        <ul class="content-thumb">
            <?php
               $args = array( 'posts_per_page' => '5' );
               $loop = new WP_Query( $args );
               if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

               $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
?>
    <li class="col-md-2 col-xs-4">
    
        <?php
            // If the slide has an associated URL, wrap image in an anchor element
        if ( $image[0] ) :
        ?>
        
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            
        <?php else : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <img src="<?php echo get_template_directory_uri() . '/images/default-image.png'; ?>" alt="<?php the_title_attribute(); ?>">
            </a>
        <?php endif; ?>
  
    </li>

        <?php endwhile; else : ?>
  
    <li>
        <p>Setup your slides on the admin area by using "set featured image" in the "posts or pages", we'll take care of the rest!</p>
    </li>

            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>