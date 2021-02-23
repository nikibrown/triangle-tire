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
							<div class="large-6 scoopfirst columns hideloggedin hidemobile">
								<div id="scoopcontent">
									<?php echo do_shortcode('[ninja_form id=24]'); ?>
								</div>
							</div>
							<div class="large-6 scoopsecond columns hideloggedin hidemobile">
								<div id="scoopmessage">
									<a href="#modal-register" class="call-modal" title="" data-open="modal-register" aria-controls="modal-register" aria-haspopup="true" tabindex="0"><img id="scoop-registration" src="https://triangletireus.com/wp-content/themes/triangle-new/images/scoop-registration.png"></a><br><br>
									<a href="/scoop-drawing-rules/" class="smallGrayText" style="font-size: 14px; text-transform: uppercase; text-decoration: underline; color: #a09e9f;">Contest Rules</a>
									<section class="semantic-content reveal" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register" aria-hidden="true" data-reveal>
										<div class="modal-inner">
											<div class="modal-content">
												<a class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span>
												</a>
												<?php echo do_shortcode('[ninja_form id=23]'); ?>
											</div>
										</div>
									</section>
								</div>
							</div>
							<div class="large-6 scoopsecond columns hideloggedin hidedesktop">
								<div id="scoopmessage">
									<a href="#modal-register" class="call-modal" title="" data-open="modal-register" aria-controls="modal-register" aria-haspopup="true" tabindex="0"><img id="scoop-registration" src="https://triangletireus.com/wp-content/themes/triangle-new/images/scoop-registration.png"></a>
									<a href="/scoop-drawing-rules/" class="smallGrayText" style="font-size: 14px; text-transform: uppercase; text-decoration: underline; color: #a09e9f;">Contest Rules</a>
									<section class="semantic-content reveal" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register" aria-hidden="true" data-reveal>
										<div class="modal-inner">
											<div class="modal-content">
												<a class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span>
												</a>
												<?php echo do_shortcode('[ninja_form id=23]'); ?>
											</div>
										</div>
									</section>
								</div>
							</div>
							<div class="large-6 scoopfirst columns hideloggedin hidedesktop">
								<div id="scoopcontent">
									<?php echo do_shortcode('[ninja_form id=24]'); ?>
								</div>
							</div>
							<div class="large-12">
								<div class="hidenotloggedin">

									<div class="row js-first-prompt" style="display: none;">
										<div class="small-12 columns">
											<div class="callout callout-instruction dark">
												<p><span class="bold-span">Welcome to &quot;the Scoop,&quot;</span> a mash-up of everything OTR pulled from all across the internet and social media, compacted in one place.  Have some breaking news you'd like to share with the community? Post it using the hashtag <span class="bold-span">#theScoopOTR,</span> or email a link to <span class="bold-span">news@triangletiresus.com.</span>  Thanks so much for joining!</p>
												<button class="close-button js-close-prompt" aria-label="Dismiss alert" type="button" data-close>
													<span aria-hidden="true">&times;</span>
												</button>

											</div>
										</div>
									</div>

									<div class="row js-second-alert" style="display: none;">
										<div class="small-12 columns">
											<div class="callout callout-instruction dark">
												<p class="text-center">
													Break your news by using the hashtag <span class="bold-span">#theScoopOTR,</span> or email a link to <span class="bold-span">news@triangletiresus.com.</span>
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
