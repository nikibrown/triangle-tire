<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 * 
 * @package WordPress
 * @subpackage wpcustom
*/

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class WPCustomStart {
    
    public static $defaults = array(
        'logo' => '', 
        'favicon' => '', 
        'google_analytics' => '',
        'video_thumbnail' => '',
        'video_embed' => '',
    );
    
    /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
    * @since MyTheme 1.0
    */
    public static function register( $wp_customize )
    {
        /*LOGO*/
        $wp_customize->add_setting( 'project_logo', array(
            'default'    => self::$defaults['logo'],
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpcustom_logo', array(
            'label'    => __( 'Upload', 'wpcustom' ),
            'section'  => 'project_section_logo',
            'settings' => 'project_logo',
        ) ) );

        /* Favicon */
        $wp_customize->add_setting( 'project_favicon', array(
            'default'    => self::$defaults['favicon'],
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpcustom_favicon', array(
            'label'    => __( 'Upload favicon', 'wpcustom' ),
            'section'  => 'project_section_logo',
            'settings' => 'project_favicon',
        ) ) );
        
        //Google analytics key
        $wp_customize->add_setting( 'project_gaq', array(
            'default'    => self::$defaults['favicon'],
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcustom_analytics', array(
            'label'    => __( 'Enter Google Analytics Tracking ID', 'wpcustom' ),
            'section'  => 'project_section_analytics',
            'settings' => 'project_gaq', 
            'type' => 'text'
        ) ) );

        /*Video Thumbnail*/
        $wp_customize->add_setting( 'homepage_video', array(
            'default'    => self::$defaults['video_thumbnail'],
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpcustom_homepage_video', array(
            'label'    => __( 'Upload Video Thumbnail', 'wpcustom' ),
            'section'  => 'project_homepage_video',
            'settings' => 'homepage_video',
        ) ) );

        //Video embed
        $wp_customize->add_setting( 'homepage_video_embed', array(
            'default'    => self::$defaults['video_embed'],
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'wpcustom_homepage_embed', array(
            'label'    => __( 'Enter a YouTube or Vimeo Embed Code', 'wpcustom' ),
            'section'  => 'project_homepage_video',
            'settings' => 'homepage_video_embed',
            'type' => 'textarea'
        ) ) );


        //add section: logo
        $wp_customize->add_section( 'project_section_logo', array(
            'title'    => __( 'Logo & Favicon', 'wpcustom' ),
            'priority' => 0,
        ) );
        
        //add section: analytics
        $wp_customize->add_section( 'project_section_analytics', array(
            'title'    => __( 'Google Analytics', 'wpcustom' ),
            'priority' => 0,
        ) );

        //add section: analytics
        $wp_customize->add_section( 'project_homepage_video', array(
            'title'    => __( 'Homepage Video', 'wpcustom' ),
            'priority' => 0,
        ) );

        $wp_customize->get_setting( 'blogname' )->transport = 'refresh';
        $wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
        $wp_customize->get_setting( 'project_logo' )->transport = 'refresh';
        $wp_customize->get_setting( 'project_favicon' )->transport = 'refresh';
        $wp_customize->get_setting( 'project_gaq' )->transport = 'refresh';
        $wp_customize->get_setting( 'homepage_video' )->transport = 'refresh';
        $wp_customize->get_setting( 'homepage_video_embed' )->transport = 'refresh';
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'WPCustomStart' , 'register' ) );