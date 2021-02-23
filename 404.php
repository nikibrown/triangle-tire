<?php
/**
 * The template for 404 pages
 *
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
get_header();


    $img = get_bloginfo( 'template_url' ) .'/images/become-a-dealer-header.jpg';
    ?>

    <div class="interiorbanner expanded row">
        <div class="large-12">
            <img src="<?php echo $img; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="medium-12 columns">
            <h1>Page Not Found</h1>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns divider"><hr></div>
    </div>
    <div class="row">
        <div class="medium-12 columns">
            <p>Unfortunately we were unable to find what you're looking for.</p>
        </div>
    </div>
<?php
get_footer();