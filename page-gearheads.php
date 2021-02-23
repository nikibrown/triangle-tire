<?php
/**
 *
 * Template Name: Gearheads
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
        <div id="gearheadswrap" class="container-fluid">
				<div id="gearheads" class="row">
					<div class="medium-12 large-8 columns gearheadcontent">
						<div id="gearheadsinner" class="row">
							<div class="large-12">
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2019/10/10tipssmall.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>10 Tips for Avoiding the Dreaded Flat Tire on Your Trailer</h4>
											<a href="https://triangletireus.com/10-tips-for-avoiding-the-dreaded-flat-tire-on-your-trailer/" class="button">Read More</a>
										</div>
									</div>
								</div>
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2019/10/abcs_gearheads.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>The ABC’s of Low Rolling Resistance Commercial Truck Tires</h4>
											<a href="https://triangletireus.com/the-abcs-of-low-rolling-resistance-commercial-truck-tires/" class="button">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div id="gearheadsinner" class="row">
							<div class="large-12">
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2019/08/Gearheadimg-josh.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>At Any Angle, You Can Count on Triangle</h4>
											<a href="https://triangletireus.com/at-any-angle-you-can-count-on-triangle/" class="button">Read More</a>
										</div>
									</div>
								</div>
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2019/08/Gearheadimg-josh1.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>A Prius in Drifting. Say What?</h4>
											<a href="https://triangletireus.com/a-prius-in-drifting-say-what/" class="button">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="gearheadsinner" class="row">
							<div class="large-12">
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadimg.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>Eddy Gonzalez Grabs First Place in Team Tandem on Triangle Tires</h4>
											<a href="https://triangletireus.com/eddy-gonzalez-grabs-first-place-in-team-tandem-on-triangle-tires/" class="button">Read More</a>
										</div>
									</div>
								</div>
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/11/Gearheadimg2.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>Like my Sound System Noisy, Not my Car!</h4>
											<a href="https://triangletireus.com/like-my-sound-system-noisy-not-my-car/" class="button">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="gearheadsinner" class="row">
							<div class="large-12">
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/11/Gearheadimg3.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>Pro Am Drifting with Eddy Gonzalez</h4>
											<a data-toggle="videomodal1" aria-controls="videomodal" aria-haspopup="true" tabindex="0"><img class="playicon" src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadsicon.png"></a>
											<div class="large reveal videomodalwrap" id="videomodal1" data-reveal>
												<div class="flex-video widescreen vimeo">
													<iframe width="1280" height="720" src="https://www.youtube.com/embed/Nxb6S9bN5qA" frameborder="0" allowfullscreen></iframe>
												</div>
												<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/11/Gearheadimg4.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>Triangle Tires Perform Like No Other on the Track</h4>
											<a href="http://triangletireus.com/drifting-success-with-eddy-gonzalez/" class="button">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="gearheadsinner" class="row">
							<div class="large-12">
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/11/Gearheadimg5.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>This guy, Eddy Gonzalez, can really drive!</h4>
											<a data-toggle="videomodal2" aria-controls="videomodal" aria-haspopup="true" tabindex="0"><img class="playicon" src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadsicon.png"></a>
											<div class="large reveal videomodalwrap" id="videomodal2" data-reveal>
												<div class="flex-video widescreen vimeo">
													<iframe width="1280" height="720" src="https://www.youtube.com/embed/VZJbCYoaK2g" frameborder="0" allowfullscreen></iframe>
												</div>
												<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/11/Gearheadimg6.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>Drifting Success with Eddy Gonzalez</h4>
											<a href="https://triangletireus.com/drifting-success…th-eddy-gonzalez/" class="button">Read More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="gearheadsinner" class="row">
							<div class="large-12">
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/11/Gearheadimg7.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>Eddy Gonzalez "running" from the law</h4>
											<a data-toggle="videomodal3" aria-controls="videomodal" aria-haspopup="true" tabindex="0"><img class="playicon" src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadsicon.png"></a>
											<div class="large reveal videomodalwrap" id="videomodal3" data-reveal>
												<div class="flex-video widescreen vimeo">
													<iframe width="1280" height="720" src="https://www.youtube.com/embed/ZdJwNPtnDb8" frameborder="0" allowfullscreen></iframe>
												</div>
												<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>
									</div>
								</div>
								<div class="medium-6 large-6 columns gearheadcontent">
									<img src="https://triangletireus.com/wp-content/uploads/2018/11/eddy_image.jpg">
									<div class="gearheadoverlay">
										<div class="gearheadtext">
											<h4>How Eddy Gonzalez got into drifting</h4>
											<a data-toggle="videomodal4" aria-controls="videomodal" aria-haspopup="true" tabindex="0"><img class="playicon" src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadsicon.png"></a>
											<div class="large reveal videomodalwrap" id="videomodal4" data-reveal>
												<div class="flex-video widescreen vimeo">
													<iframe width="1280" height="720" src="https://www.youtube.com/embed/vvp5dfEcO30" frameborder="0" allowfullscreen></iframe>
												</div>
												<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="medium-12 large-4 columns">
						<a data-tweet-limit="4" data-chrome="noheader nofooter noborders transparent" class="twitter-timeline" href="https://twitter.com/TriangleTireUSA?ref_src=twsrc%5Etfw">Tweets by TriangleTireUSA</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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

get_footer();