<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Slaves
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function slaves_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'slaves_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function slaves_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'slaves_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function slaves_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'slaves_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
if( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
  
	// filter function for wp_title
function semifolio_filter_wp_title( $old_title, $sep, $sep_location ){

	// add padding to the sep
    $ssep = ' ' . $sep . ' ';
     
	// find the type of index page this is
	if( is_category() ) $insert = $ssep . __('Category','slaves');
	elseif( is_tag() ) $insert = $ssep . __('Tag','slaves');
	elseif( is_author() ) $insert = $ssep . __('Author','slaves');
	elseif( is_year() || is_month() || is_day() ) $insert = $ssep . __('Archives','slaves');
	elseif( is_home() ) $insert = $ssep . bloginfo('description');
	else $insert = NULL;
     
	// get the page number we're on (index)
	if( get_query_var( 'paged' ) )
	$num = $ssep . __('Page ','slaves') . get_query_var( 'paged' );
     
	// get the page number we're on (multipage post)
	elseif( get_query_var( 'page' ) )
	$num = $ssep . __('Page ','slaves') . get_query_var( 'page' );
     
	// else
    else $num = NULL;
     
	// concoct and return new title
	return bloginfo( 'name' ) . $insert . $old_title . $num;
}
add_filter( 'wp_title', 'slaves_filter_wp_title', 10, 3 );
function slaves_rss_title($title) {

/* need to fix our add a | blog name to wp_title */
	$ft = str_replace(' | ','',$title);
	return str_replace(bloginfo('name'),'',$ft);
}
add_filter('get_wp_title_rss', 'slaves_rss_title',10,1);
  
	// Adding Title for site older than WordPress 4.1
function slaves_render_title() {

	?>
	<title><?php wp_title(); ?></title>
	<?php
	}
add_action( 'wp_head', 'slaves_render_title' );
 
endif;
	
/*-----------------------------------------------------------------------------------*/
/* Excerpt config
/*-----------------------------------------------------------------------------------*/

function slaves_excerptlength_themes($length) {
	return 20;
}
	
function slaves_excerptmore($more)
{
	return '... <div class="readmore"><a  rel="bookmark" href="' . get_permalink( get_the_ID() ) . '">Continue reading &raquo;</a></div>';
}
	add_filter('excerpt_length', 'slaves_excerptlength_themes');
	add_filter('excerpt_more', 'slaves_excerptmore');
	
/*-----------------------------------------------------------------------------------*/
/* Favicon image
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	
if ( ! function_exists( 'slaves_load_favicon' ) ) :
	
function slaves_load_favicon() {
	$favicon_icon = get_option( 'slaves_upload_favicon_icon' );
	if ( get_option( 'slaves_display_favicon_icon' ) == 1 ) :
	if ( ! get_option( 'slaves_upload_favicon_icon' ) ) {
	$favicon_icon = get_template_directory_uri() . '/images/favicon.ico';
	}
?>
		<link rel="shortcut icon" href="<?php echo $favicon_icon; ?>" type="image/x-icon" />
	<?php
	endif;
}
	
endif;
add_action('wp_head', 'slaves_load_favicon');
add_action('admin_head', 'slaves_load_favicon');

}