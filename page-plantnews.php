<?php
/**
 *
 * Template Name: Plant News
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
        <div id="plantnewswrap" class="container-fluid">
        		<div id="plantnews" class="row example-centered">
        			<div class="col-md-12 example-title">
						<h3>Browse the latest news and site images as well as we work towards our September 2021 completion of Triangle's state-of-the-art, tire production facility in North Carolina.</h3>
					</div>
        		</div>
				<div id="plantnews" class="row">
					<div class="medium-12 large-8 columns">
						 <div class="row example-centered">
							  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
									<ul class="timeline timeline-centered">
										 <li class="timeline-item period">
											  <div class="timeline-info"></div>
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
											  		<p class="timeline-pretitle">ESTIMATED PLANT COMPLETION</p>
													<h2 class="timeline-title">SEPTEMBER 2021</h2>
											  </div>
										 </li>
										 <li class="timeline-item firstitem">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2019/04/april-24-thumb.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>04.24.19</p>
														   </div>
															<div class="gearheadtext">
																<h4></h4>
																<div class="reveal largerimages" id="largemodal24" data-reveal>
																	<img src="https://triangletireus.com/wp-content/uploads/2019/04/april-24-full.jpg">
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																</div>
																<a class="button"  data-open="largemodal24">View</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2019/04/april-20-thumb.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>04.20.19</p>
														   </div>
															<div class="gearheadtext">
																<h4></h4>
																<div class="reveal largerimages" id="largemodal20" data-reveal>
																	<img src="https://triangletireus.com/wp-content/uploads/2019/04/april-20-full.jpg">
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																</div>
																<a class="button"  data-open="largemodal20">View</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2019/04/new-thumb.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>04.03.19</p>
														   </div>
															<div class="gearheadtext">
																<h4>Site prep. in Edgecombe County is looking good!</h4>
																<div class="reveal largerimages" id="largemodal4" data-reveal>
																	<img src="https://triangletireus.com/wp-content/uploads/2019/04/Triangle-plant-site-April-3-2019.jpg">
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																</div>
																<a class="button"  data-open="largemodal4">View</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/12/site-prep-thumb.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>12.18.18</p>
														   </div>
															<div class="gearheadtext">
																<h4>Progress being made at the North Carolina site...</h4>
																<div class="reveal largerimages" id="largemodal4" data-reveal>
																	<img src="https://triangletireus.com/wp-content/uploads/2018/12/site-prep-large.jpg">
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																</div>
																<a class="button"  data-open="largemodal4">View</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/9-20-sitenotaffected.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>09.20.18</p>
														   </div>
															<div class="gearheadtext">
																<h4>Plant site not affected by Hurricane Florence</h4>
																<a href="https://www.moderntiredealer.com/news/731321/triangle-no-construction-delay-from-hurricane-florence" class="button">Read More</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/8-25-siteprep.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>08.25.18</p>
														   </div>
															<div class="gearheadtext">
																<h4>Aerial view showing tremendous progress on preparing....</h4>
																<a data-toggle="videomodal3" aria-controls="videomodal" aria-haspopup="true" tabindex="0"><img class="playicon" src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadsicon.png"></a>
																<div class="large reveal videomodalwrap" id="videomodal3" data-reveal>
																	<div class="flex-video widescreen vimeo">
																		<iframe width="1280" height="720" src="https://www.youtube.com/embed/hTuk1pDl9d0" frameborder="0" allowfullscreen></iframe>
																	</div>
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/81-heavyequipment.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>08.01.18</p>
														   </div>
															<div class="gearheadtext">
																<h4>Heavy equipment working away preparing...</h4>
																<a data-toggle="videomodal2" aria-controls="videomodal" aria-haspopup="true" tabindex="0"><img class="playicon" src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadsicon.png"></a>
																<div class="large reveal videomodalwrap" id="videomodal2" data-reveal>
																	<div class="flex-video widescreen vimeo">
																		<iframe width="1280" height="720" src="https://www.youtube.com/embed/-RGbZjMHkfk" frameborder="0" allowfullscreen></iframe>
																	</div>
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/7-16-siteprep.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>07.16.18</p>
														   </div>
															<div class="gearheadtext">
																<h4>Substantial progress on preparing the site in eastern...</h4>
																<div class="reveal largerimages" id="largemodal3" data-reveal>
																	<img src="https://triangletireus.com/wp-content/uploads/2018/11/7-16.jpg">
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																</div>
																<a class="button"  data-open="largemodal3">View</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/7-1-birdseye.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>07.01.18</p>
														   </div>
															<div class="gearheadtext">
																<h4>Bird’s eye view of heavy equipment in...</h4>
																<a data-toggle="videomodal1" aria-controls="videomodal" aria-haspopup="true" tabindex="0"><img class="playicon" src="https://triangletireus.com/wp-content/uploads/2018/10/Gearheadsicon.png"></a>
																<div class="large reveal videomodalwrap" id="videomodal1" data-reveal>
																	<div class="flex-video widescreen vimeo">
																		<iframe width="1280" height="720" src="https://www.youtube.com/embed/FMUxBxnYLF8" frameborder="0" allowfullscreen></iframe>
																	</div>
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																		<span aria-hidden="true">&times;</span>
																	</button>
																</div>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/6-19-siteprep.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>06.19.18</p>
														   </div>
															<div class="gearheadtext">
																<h4>Site preparation work well underway in Edgecombe County</h4>
																<div class="reveal largerimages" id="largemodal2" data-reveal>
																	<img src="https://triangletireus.com/wp-content/uploads/2018/11/6-19.jpg">
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																</div>
																<a class="button"  data-open="largemodal2">View</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/3-25-siteprep.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>03.25.18</p>
														   </div>
															<div class="gearheadtext" data-clearing>
																<h4>A green field awaiting its future as a world-class tire manufacturing facility</h4>
																<div class="reveal largerimages" id="largemodal1" data-reveal>
																	<img src="https://triangletireus.com/wp-content/uploads/2018/11/3-25.jpg">
																	<button class="close-button close-video" data-close aria-label="Close reveal" type="button">
																</div>
																<a class="button"  data-open="largemodal1">View</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
										 <li class="timeline-item">
											  <div class="timeline-marker"></div>
											  <div class="timeline-content">
													<div class="gearheadcontent">
														<img src="https://triangletireus.com/wp-content/uploads/2018/11/12-19-edgecombe.jpg">
														<div class="gearheadoverlay">
														   <div class="timelinedate">
														      <p>12.19.17</p>
														   </div>
															<div class="gearheadtext">
																<h4>Triangle announces decision to build consumer and...</h4>
																<a href="https://triangletireus.com/triangle-tire-to-build-plant-in-north-carolina" class="button">Read More</a>
															</div>
														</div>
													</div>
											  </div>
										 </li>
									</ul>
							  </div>
						 </div>
					</div>
					<div class="medium-12 large-4 columns">
						<a data-tweet-limit="5" data-theme="dark" data-link-color="#fff"  data-chrome="noheader nofooter noborders transparent" class="twitter-timeline" href="https://twitter.com/TriangleTireUSA?ref_src=twsrc%5Etfw">Tweets by TriangleTireUSA</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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