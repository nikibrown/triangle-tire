<?php
/**
 * The template for single entries
 *
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
get_header();


// Start the loop.
while ( have_posts() ) : the_post();

    $img = featured_image( $post->ID, 'full', get_bloginfo( 'template_url' ) .'/images/become-a-dealer-header.jpg');
    $gallery = get_post_gallery( $post->ID, false );
    //$gallery = array_unique( $gallery );
    $ids = explode( ",", $gallery['ids'] );
    $pics = array();
    if( !empty( $ids ) )
    {
        foreach( $ids as $id )
        {
            $pics[] = wp_get_attachment_url( $id );
        }
        $pics = array_unique( $pics );
    }
    $pics = array_filter( $pics );
    ?>

    <?php
    if( !empty( $img ) || !empty( $pics ) )
    {
        ?>
        <div class="interiorbanner expanded row">
            <div class="large-12">
                <?php
                if( !empty( $pics ) )
                {
                    echo '<div class="js-gallery" style="height: 300px; max-height: 300px; overflow: hidden;">';
                    foreach( $pics as $g )
                    {
                        echo '<img src="'. $g .'" />';
                    }
                    echo '</div>';
                }
                else
                {
                    echo '<img src="'.$img.'" />';
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="medium-12 columns">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns divider"><hr></div>
    </div>
    <div class="row">
        <div class="medium-12 columns">
           
          <?php the_content(); ?>
        </div>
    </div>
    <?php

    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

    // End the loop.
endwhile;

get_footer();