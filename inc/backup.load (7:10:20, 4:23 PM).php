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

require_once( dirname( __FILE__ ) .'/classThemeCustomize.php' );
require_once( dirname( __FILE__ ) .'/wp_bootstrap_navwalker.php' );
require_once( dirname( __FILE__ ) .'/wp-cuztom/cuztom.php' );

//Autoload any metabox files found in /custom-metaboxes
$files = glob( dirname( __FILE__ ). '/custom-metaboxes/*php' );
if( !empty( $files ) )
{
    foreach( $files as $file )
    {
        if( file_exists( $file ) )
        {
            require_once( $file );   
        }
    }   
}

# Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
add_theme_support( 'menus' );

# Register Navigation
register_nav_menus(
    array(
        'top_menu' => __( 'Top Bar', 'wpcustom' ),
        'footer_navigation' => __( 'Footer Navigation', 'wpcustom' )
    )
);