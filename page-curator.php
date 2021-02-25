<?php
/**
 *
 * Template Name: Curator
 *
 * @package WordPress
 * @subpackage wpcustom
*/
get_header();


    // Start the loop.
    while ( have_posts() ) : the_post();

        $img = featured_image( $post->ID, 'full');
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
        <div id="gearheadswrap" class="container-fluid curator">
				<div id="gearheads" class="row">
					<div class="medium-12 large-12 columns gearheadcontent">
						<div id="gearheadsinner" class="row scoopcolumns">
							<div class="large-12">
								<div class="">
									<section class="semantic-content reveal" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register" aria-hidden="true" data-reveal>
									<div class="modal-inner">
										<div class="modal-content">
											<a class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span>
											</a>
											<?php echo do_shortcode('[ninja_form id=23]'); ?>
											</div>
										</div>
									</section>
									<div class="row js-second-alert">
										<div class="small-12 columns">
											<div class="callout callout-instruction dark">
												<p class="text-center">
													Register here to receive weekly highlight emails on top OTR news.<br><a href="#modal-register" class="call-modal" title="" data-open="modal-register" aria-controls="modal-register" aria-haspopup="true" tabindex="0"><button class="button specialbutton" type="button">Register</button></a>
												</p>
											</div>
										</div>
									</div>

									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
        </div>
      	 <script src="<?php bloginfo( 'template_url' ); ?>/js/vendor/foundation.reveal.js"></script>
        <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

        // End the loop.
    endwhile;
    ?>

	<script type="text/javascript">
        jQuery(document).ready(function($){
                if(!localStorage.getItem( 'scoop_closed')) {
                    $('.js-first-prompt').show();
                } else {
                    $('.js-second-alert').show();
				}

                $(document.body).on('click', '.js-close-prompt', function(e) {
                    e.preventDefault();
                    localStorage.setItem('scoop_closed', true);
                    $('.js-first-prompt').remove();
                    $('.js-second-alert').show();
                })
        });
	</script>
<?php

get_footer();
