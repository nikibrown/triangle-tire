<?php
/**
 * homepage.php
 * Provides custom metabox support for edition inner page data entry
 * Only shows on 'homepage' post_type
 *
 **/

$data = array(
    'has_archive' => false,
    'supports' => array( 'title', 'editor' )
);
$edition_pages = new Cuztom_Post_Type( 'Reviews', $data );