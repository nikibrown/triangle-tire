<?php
/**
 *
 * Template Name: Cat Landing Page
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
        <div class="container-fluid curator">
				<div id="gearheads" class="row catlandingpage">
					<div class="medium-12 large-12 columns gearheadcontent">
						<div id="gearheadsinner" class="row">
							<div id="correct-message-wrap" class="large-6 columns">
								<div id="correct-message">
									<h1>CORRECT!</h1>
									<h2 style="color: #2d75b5;">Triangle is one of Caterpillar's <span style="color: #000;">Top 3</span> global Tire suppliers.</h2>
									<p style="color: #2d75b5;"><strong>YOU MAY ALSO BE SURPRISED TO LEARN:</strong></p>
									<ul>
										<li>Triangle is one of the top OTR tire producers worldwide.</li>
										<li>In addition to Caterpillar, we have OE relationships with Doosan, Hyundai, and many other global heavy equipment manufacturers.</li>
										<li>Triangle is one of a very few tire companies that manufactures a complete line of OTR tires, from bias to radial, from small up to 63" rim diameter."</li>
										<li>Triangle OTR tires are sold by many of America's top commercial tire dealers.</li>
									</ul>
								</div>
							</div>
							<div id="cat-scoop" class="large-6 columns">
								<div id="cat-scoop-message">
									<a href="/the-scoop"><img id="cat-get-scoop" src="https://triangletireus.com/wp-content/themes/triangle-new/images/cat-get-scoop.png"></a>
									<p>A mash-up of everything OTR pulled from all across the internet and social media, compacted in one place, and delivered to your inbox.</p>
 
									<p>It’s <span style="font-family: proxima-nova, sans-serif; font-weight: 800;">FREE</span>, and by registering you are automatically entered in a drawing to win one of two great prizes, a <strong>YETI Hopper Flip 18 Soft Cooler</strong> or a $75 Bass Pro Shops gift card.</p>
									<a href="/the-scoop"><img id="cat-cooler" src="https://triangletireus.com/wp-content/themes/triangle-new/images/cat-cooler.png"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
         </div>
		<div id="cat-tire-wrap" class="container-fluid">
			<div id="cat-tire-content" class="row">
				<div id="cat-tire-header" class="large-12 columns text-center">
					<h1>OUR OTR TIRE RADIAL LINE-UP INCLUDES:</h1>
				</div>
				<div class="large-6 cat-tire-columns columns">
					<a href="/offroad-tires/tb516"><img class="cat-tire" src="https://triangletireus.com/wp-content/themes/triangle-new/images/cat-tire1.png"></a>
					<a href="/offroad-tires/tb516"><h2>TB516 <span class="cat-tire-spec">(E-3, L-3)</span></h2></a>
					<p>A versatile performer for loaders, dozers and other equipment with a wide aggressive tread design, robust shoulder and an enhanced sidewall for durability</p>
				</div>
				<div class="large-6 cat-tire-columns columns">
					 <a href="/offroad-tires/tl538s"><img class="cat-tire" src="https://triangletireus.com/wp-content/themes/triangle-new/images/cat-tire2.png"></a>
					<a href="/offroad-tires/tl538s"><h2>TL538+ <span class="cat-tire-spec">(L-5)</span></h2></a>
					<p>Designed for difficult operating conditions with an aggressive open tread pattern for grip and traction, and a uniform groove depth for outstanding traction throughout tire life</p>
				</div>
			</div>
			<div id="cat-tire-content" class="row">
				<div class="large-6 cat-tire-columns columns">
					<a href="/offroad-tires/tb516"><img class="cat-tire" src="https://triangletireus.com/wp-content/themes/triangle-new/images/cat-tire3.png"></a>
					<a href="/offroad-tires/tb516"><h2>TB598 <span class="cat-tire-spec">(E-3, L-3)</span></h2></a>
					<p>Excellent traction for haulage applications with an aggressive self-cleaning tread pattern, and a unique compound for long tread life</p>
				</div>
				<div class="large-6 cat-tire-columns columns">
					 <a href="/offroad-tires/tl538s"><img class="cat-tire" src="https://triangletireus.com/wp-content/themes/triangle-new/images/cat-tire4.png"></a>
					<h2>TB599A <span class="cat-tire-spec">(E-4)</span></h2>
					<p>Long lasting for severe mine and quarry conditions with a deep tread, sturdy shoulder and sidewall for excellent traction and stability</p>
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
