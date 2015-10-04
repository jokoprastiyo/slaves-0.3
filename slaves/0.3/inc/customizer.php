<?php
/**
 * Slaves Theme Customizer
 *
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function slaves_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
 
	$wp_customize->remove_setting( 'display_header_text' );
	$wp_customize->remove_control( 'display_header_text' );
              $wp_customize->remove_section( 'color' );
              $wp_customize->remove_setting( 'header_textcolor' );
              $wp_customize->remove_control( 'header_textcolor' );
   
    /**
    * Textarea customize control class.
    */
if ( class_exists( 'WP_Customize_Control' ) ) :
    class Slaves_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
        public function render_content() {
    ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label ); ?></span>
                <textarea rows= "5" style="width:100%;"<?php $this->link(); ?>><?php echo esc_textarea($this->value() ); ?></textarea>
        </label>
        <?php
        }
    }
endif;
 
    /**
    * Text attribute customize control class.
    */
if ( class_exists( 'WP_Customize_Control' ) ) :
    class Slaves_Customize_Info_Control extends WP_Customize_Control {
        public $type = 'info';
        public function render_content() {
?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label ); ?></span>
            <span <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></span>
        </label>
    <?php
    }
}
endif;
 

/*----------------------------------------------------------------------------------------*/
/* Slaves Options. 
/*----------------------------------------------------------------------------------------*/
    $wp_customize->add_section('slaves_options', array(
        'title'    => __('Slaves Default Options', 'slaves'),
        'description' => '',
        'priority' => 1,
    ));
 
    // Column Layout
    $wp_customize->add_setting('slaves_column_option', array(
        'default'        => 2,
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'slaves_sanitize_column_layout',
    ));
    $wp_customize->add_control('column_layout', array(
        'label'      => __('Select Column Layout for the page of the home, archive, category, search & tag.', 'slaves'),
        'section'    => 'slaves_options',
        'settings'   => 'slaves_column_option',
        'type'       => 'radio',
        'choices'    => array(
            '1'         => 'Two column',
            '2'     => 'Three column',
        ),
        'priority'   => 1,
    ));
 
    // Display Favicon
    $wp_customize->add_setting('slaves_display_favicon_icon', array(
        'default' => 0,
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'slaves_sanitize_checkbox',
    ));
    $wp_customize->add_control('display_favicon_icon', array(
        'settings' => 'slaves_display_favicon_icon',
        'label'    => __('Do you want to display favicon?', 'slaves'),
        'section'  => 'slaves_options',
        'type'     => 'checkbox',
        'priority'   => 2,
    ));
 
    // Upload Favicon Icon
    $wp_customize->add_setting('slaves_upload_favicon_icon', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'upload_favicon_icon', array(
        'label'    => __('Upload Favicon:', 'slaves'),
        'section'  => 'slaves_options',
        'settings' => 'slaves_upload_favicon_icon',
        'priority'   => 3,
    )));
 
    // Welcome Message Title
    $wp_customize->add_setting('slaves_welcome_title', array(
        'default'        => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'slaves_sanitize_text_attribute',
    ));
    $wp_customize->add_control( new Slaves_Customize_Textarea_Control($wp_customize, 'welcome_title', array(
        'label'    => __('Input text of the title welcome message.', 'slaves'),
        'section'  => 'slaves_options',
        'settings' => 'slaves_welcome_title',
        'type'    => 'textarea',
        'priority'   => 4,
    )));
 
    // Welcome Message Text
    $wp_customize->add_setting('slaves_welcome_message',array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'   => 'slaves_sanitize_text_attribute',
    ) );
    $wp_customize ->add_control(new Slaves_Customize_Textarea_Control($wp_customize, 'welcome_message', array(
        'label' => __('Input of the welcome message.', 'slaves'),
        'section' => 'slaves_options',
        'settings' => 'slaves_welcome_message',
        'type' => 'textarea',
        'priority'   => 5,
    ) ) );
 
    // Display Posts Featured Images
    $wp_customize->add_setting('slaves_display_featured_images', array(
        'default' => 0,
        'capability' => 'edit_theme_options',
        'type'          => 'option',
        'transport'       => 'refresh',
        'sanitize_callback' => 'slaves_sanitize_checkbox',
    ));
    $wp_customize->add_control('display_featured_images', array(
        'settings' => 'slaves_display_featured_images',
        'label'    => __('Do You want to display posts featured images?', 'slaves'),
        'section'  => 'slaves_options',
        'type'     => 'checkbox',
        'priority'   => 6,
    ));
 
    // Display Footer Widget
    $wp_customize->add_setting('slaves_display_footer_widget', array(
        'default'     => 0,
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'transport'       => 'postMessage',
        'sanitize_callback'     => 'slaves_sanitize_checkbox',
    ));
    $wp_customize->add_control('display_footer_widget', array(
        'settings' => 'slaves_display_footer_widget',
        'label'    => __('Do You want to display Footer Widget?', 'slaves'),
        'section'  => 'slaves_options',
        'type'     => 'checkbox',
        'priority'   => 7,
    ));
 
}
add_action( 'customize_register', 'slaves_customize_register' );
 
/**
 * Sanitize the Column Layout value.
 */
function slaves_sanitize_column_layout( $column ) {

	if ( ! in_array( $column, array( '1', '2', '3' ) ) ) {

		$column = '2';
	}
	return $column;

}
 
/**
 * Sanitize the checkbox.
 */
function slaves_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return true;
	} else {
		return false;
	}
}
 
/**
 * Sanitize text attribute.
 */
function slaves_sanitize_text_attribute( $input ) {
     return wp_kses_post( force_balance_tags( $input ) );
}
 
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function slaves_customize_preview_js() {
	wp_enqueue_script( 'slaves_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'slaves_customize_preview_js' );
 
/**
 *  Registers script
 */
function slaves_registers() {
    wp_register_script( 'slaves_customizer_script', get_template_directory_uri() . '/inc/js/slaves.js', array('jquery'), '2015', true  );
    wp_enqueue_script( 'slaves_customizer_script' );
    wp_localize_script( 'slaves_customizer_script', 'slaves_buttons', array(
        'rate'        => __( 'Rate Slaves at Wordpress.org!', 'slaves' ),
        'doc'       => __( 'Get More Options, Upgrade to Slaves Pro!', 'slaves' ),
        'pro'       => __( esc_html( __('<img src="' . __( get_template_directory_uri() . '/images/btn_donate.gif', 'slaves' ) . '" alt="donate">', 'slaves') ), 'slaves' )
    ) );
}
add_action( 'customize_controls_enqueue_scripts', 'slaves_registers' );
