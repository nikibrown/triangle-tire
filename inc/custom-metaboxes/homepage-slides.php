<?php
/**
 * homepage-slides.php
 *
 * @version 1.0
 * @date 6/12/17 4:57 AM
 * @package triangle
 */
$data = array(
	'has_archive' => false,
	'supports' => array( 'title', 'thumbnail' )
);
$edition_pages = new Cuztom_Post_Type( 'Homepage Slides', $data );