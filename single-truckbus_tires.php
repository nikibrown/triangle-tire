<?php
/**
 * single-truckbus_tires.php
 *
 * @version 1.0
 * @date 6/10/17 10:42 PM
 * @package triangle
 */
get_header();

while ( have_posts() ) : the_post();

	$post_ID = $post->ID;
	require_once( __DIR__ . '/partials/tire-detail.php' );


endwhile;
get_footer();