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


function handle_size_reformat()
{
	$search_query = array();

	$mapping = [
		'offroad_tires' => 'of_size',
		'passenger_tires' => 'passenger_size',
		'truckbus_tires' => 'tb_size',
	];

	$search_query['post_type'] = array(
		'offroad_tires',
		'passenger_tires',
		'truckbus_tires',
	);
	$search_query['posts_per_page'] = -1;
	$search_query['post_status'] = 'publish';
	$search = new WP_Query( $search_query );

	if ( $search->have_posts() ) :
		while ( $search->have_posts() ) :
			$search->the_post();

			$meta = get_post_meta( get_the_ID(), '_type_data', true );
			$meta = $meta[0];
			
			$size = isset( $meta['_tiresize'] ) && !empty( $meta['_tiresize'] )
				? $meta['_tiresize']
				: false;

			if( $size !== false )
			{
				$term_exists = term_exists( $size, $mapping[get_post_type()] );
				if( !$term_exists )
				{
					$term_exists = wp_insert_term( $size, $mapping[get_post_type()] );
				}
				wp_set_post_terms( get_the_ID(), [ $term_exists['term_id'] ], $mapping[get_post_type()] );
			}

		endwhile;
	endif;
}

if( is_admin() )
{
	if( isset( $_REQUEST['reformat'] ) )
	{
		handle_size_reformat();
	}
}