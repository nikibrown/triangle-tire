<?php
/**
 *
 * Template Name: Brand Bank
 * 
 * @package WordPress
 * @subpackage wpcustom
*/
get_header();
	
	 // Call the Tires
	 $args = array(
    'post_type' => array(
        'passenger_tires',
        'truckbus_tires',
        'offroad_tires'
    ),
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'meta_query'  => array(
        array(
            'key' => '_type_core_featured',
            'value' => 'yes'
        )
    )
	);
	$featured_tires = new WP_Query(  $args );

	//Passenger tires
	$args['post_type'] = 'passenger_tires';
	$args['posts_per_page'] = -1;
	unset( $args['meta_query'] );
	$all_passenger = new WP_Query(  $args );

	//Truck and bus tires
	$args['post_type'] = 'truckbus_tires';
	$args['posts_per_page'] = -1;
	unset( $args['meta_query'] );
	$truckbus = new WP_Query(  $args );

	//Offroad tires
	$args['post_type'] = 'offroad_tires';
	$args['posts_per_page'] = -1;
	unset( $args['meta_query'] );
	$offroad = new WP_Query(  $args );
	 
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
            <div class="interiorbanner ttnomargin expanded row">
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
        <div class="ttcontentcontainer">
        	<p class="accessmessage">Content is restricted to dealers only.</p>
				<?php echo do_shortcode( '[login_form]' ); ?>
				<div class="row registration-content">
					<div class="large-12">
						<p>Don't have an account?</p>
						<a href="/register" class="button">Register Here</a>
					</div>
				</div>
        		<div class="row tttitlerow brandcontent">
					<div class="large-12 columns">
					  <div class="row tttitlerow">
							<div class="large-12 columns">
								 <h1 class="ttsectiontitle">Logos</h1>
							</div>
					  </div>
					  <div class="row">
							<div class="large-12 columns divider"><hr></div>
					  </div>
					  <div class="row ttendsectionrow">
							<div class="large-6 columns">
								<?php if( get_field('logo') ): ?>
									<img src="<?php the_field('logo'); ?>" />
								<?php endif; ?>
								<p class="ttbrandtitle">Triangle Tire Logo Pack</p>
								<a class="ttbrandbutton" href="<?php the_field('logo_pack'); ?>" target="_blank">Download</a>
							</div>
							<div class="large-6 columns">
							</div>
						</div>
						
						<!-- Tire Images -->
						
						<div class="row tttitlerow">
							<div class="large-12 columns">
								<h1 class="ttsectiontitle">Tire Images</h1>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns divider">
								<hr />
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns">
								<p class="ttbrandtitle">Use the dropdown menus below to select the tire images you wish to download</p>
							</div>
						</div>
						<div class="row ttendsectionrow">
							<div class="large-4 columns">
								<div class="tiresearchwrap">
									<button class="button tirebutton" data-toggle="togglepassenger">PASSENGER / LIGHT TRUCK / SUV</button>
									<div class="callout" id="togglepassenger" data-toggler data-animate="fade-in fade-out" style="display:none;">
										<ul class="menu vertical listtwocol">
											<?php
											while ( $all_passenger->have_posts() ) : $all_passenger->the_post();
											$file = get_field('tire_photos');
											// vars
											$url = $file['url'];
												echo '<li><a href="'. $url .'">' . get_the_title( $post->ID ) . '</a></li>';
											endwhile;
											wp_reset_postdata();
											?>
										</ul>
									</div>
								</div>
							</div>
							<div class="large-4 columns">
								<div class="tiresearchwrap">
									<button class="button tirebutton" data-toggle="toggletruckbus">TRUCK &amp; BUS</button>
									<div class="callout" id="toggletruckbus" data-toggler data-animate="fade-in fade-out" style="display:none;">
										<ul class="menu vertical listtwocol">
											<?php
											while ( $truckbus->have_posts() ) : $truckbus->the_post();
											$file = get_field('tire_photos');
											// vars
											$url = $file['url'];
												if( get_field('tire_photos') ):
												echo '<li><a href="'. $url .'">' . get_the_title( $post->ID ) . '</a></li>';
												endif;
											endwhile;
											wp_reset_postdata();
											?>
										</ul>
									</div>
								</div>
							</div>
							<div class="large-4 columns">
								<div class="tiresearchwrap">
									<button class="button tirebutton" data-toggle="toggleoffroad">OFF-THE-ROAD</button>
									<div class="callout" id="toggleoffroad" data-toggler data-animate="fade-in fade-out" style="display:none;">
										<ul class="menu vertical listtwocol">
											<?php
											while ( $offroad->have_posts() ) : $offroad->the_post();
											$file = get_field('tire_photos');
											// vars
											$url = $file['url'];
												echo '<li><a href="'. $url .'">' . get_the_title( $post->ID ) . '</a></li>';
											endwhile;
											wp_reset_postdata();
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
						
						<!-- ST Radial -->
						
						<div class="row tttitlerow">
							<div class="large-12 columns">
								<h1 class="ttsectiontitle">ST Radial</h1>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns divider">
								<hr />
							</div>
						</div>
						<div class="row ttendsectionrow">
							<div class="large-4 columns">
								<a class="ttbrandbutton tiretread" href="/wp-content/themes/triangle-new/brandbank/TR653.zip" target="_blank">TR653</a>
							</div>
							<div class="large-4 columns">
								<a class="ttbrandbutton tiretread" href="/wp-content/themes/triangle-new/brandbank/TR656.zip" target="_blank">TR656</a>
							</div>
							<div class="large-4 columns">
								<a class="ttbrandbutton tiretread" href="/wp-content/themes/triangle-new/brandbank/TRT01S.zip" target="_blank">TRT01S</a>
							</div>
						</div>
						
						<!-- Product Guides -->
						
						<div class="row tttitlerow">
							<div class="large-12 columns ttflexcol">
								<h1 class="ttsectiontitle">Product Guides</h1> <span class="ttrequest">[To request printed collateral please contact your local sales representative]</span>
							</div>
						</div>
					  <div class="row">
							<div class="large-12 columns divider"><hr></div>
					  </div>
					  <div id="brochures" class="row brochurerow">
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2302" src="https://triangletireus.com/wp-content/uploads/2018/10/comtire-productguide.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Commercial Tires Product Guide</p>
               <a href="https://triangletireus.com/wp-content/uploads/2018/10/Triangle_Commercial_product-guide-2018.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
               <img class="alignnone size-medium wp-image-2305" src="https://triangletireus.com/wp-content/uploads/2018/10/otr-productguide.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">Off-the-Road Tires Product Guide</p>
               <a href="https://triangletireus.com/wp-content/uploads/2018/10/Triangle_OTR_product-guide.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns">
            	<img class="alignnone size-medium wp-image-2305" src="/wp-content/uploads/2020/04/Triangle_ST_Radial_CVR.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">ST Radials Product Guide</p>
               <a href="/wp-content/uploads/2020/06/Triangle_ST_radial-product-guide.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
         </div>
         <div class="row brochurerow secondrowsupport">
            <div class="large-4 columns">
            	<img class="alignnone size-medium wp-image-2308" src="/wp-content/uploads/2020/07/triangle-otr-global-brochure.jpg" alt="" width="232" height="300" />
               <p class="supporttitle">OTR Tires Product Catalog 2020</p>
               <a href="/wp-content/brochures/Triangle_OTR_Global Catalogue_2020.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
            </div>
            <div class="large-4 columns"></div>
            <div class="large-4 columns"></div>
         </div>
						<div class="row tttitlerow spacerrow">
							<div class="large-12 columns ttflexcol">
								<h1 class="ttsectiontitle">Product Pocket Guides</h1> <span class="ttrequest">[To request printed collateral please contact your local sales representative]</span>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns divider">
								<hr />
							</div>
						</div>
						<div class="row brochurerow">
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2303" src="https://triangletireus.com/wp-content/uploads/2018/10/comtirepocket.jpg" alt="" width="300" height="150" />
								<p class="supporttitle">Commercial Tires Pocket Guide</p>
								<a href="https://triangletireus.com/wp-content/uploads/2018/10/Triangle_Commercial_pocket-guide_2018.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2306" src="https://triangletireus.com/wp-content/uploads/2018/10/otrtirepocket.jpg" alt="" width="300" height="150" />
								<p class="supporttitle">Off-the-Road Tires Pocket Guide</p>
								<a href="https://triangletireus.com/wp-content/uploads/2018/10/Triangle_OTR_pocket-guide.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2306" src="https://triangletireus.com/wp-content/uploads/2018/10/uhptirepocket.jpg" alt="" width="300" height="150" />
								<p class="supporttitle">Triangle UHP Pocket Guide</p>
								<a href="https://triangletireus.com/wp-content/uploads/2018/10/Triangle_UHP_pocket-guide.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
						</div>
						<div class="row">
							<div class="medium-12 columns">
								<h1 class="headersections">Warranties</h1>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns divider">
								<hr />
							</div>
						</div>
						<div id="warranties" class="row brochurerow">
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2300" src="/wp-content/uploads/2020/05/Triangle_UHP_tires_warranty.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Passenger Tire Warranty</p>
								<a href="/wp-content/uploads/2020/05/Triangle_UHP_tires_warranty.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2297" src="/wp-content/uploads/2020/05/Triangle_ST_Radial_tires_warranty.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">ST Radial Tire Warranty</p>
								<a href="/wp-content/uploads/2020/05/Triangle_ST_Radial_tires_warranty.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2307" src="/wp-content/uploads/2020/05/Triangle_OTR_tires_warranty.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Off-the-road Tire Warranty</p>
								<a href="/wp-content/uploads/2020/05/Triangle_OTR_tires_warranty.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
						</div>
						<div class="row brochurerow secondrowsupport">
							<div class="large-4 columns">
								 <img class="alignnone size-medium wp-image-2299" src="/wp-content/uploads/2020/05/Triangle_Commercial_tires_warranty-1.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Truck &amp; Bus Tire Warranty</p>
								<a href="/wp-content/uploads/2020/05/Triangle_Commercial_tires_warranty.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
					
							</div>
							<div class="large-4 columns">
				  
							</div>
						</div>
					  <div class="row ">
							<div class="medium-12 columns">
								<h1 class="headersections">Product Sheets</h1>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns divider">
								<hr />
							</div>
						</div>
						<div class="row brochurerow">
							<div class="large-4 columns">
								 <img class="alignnone size-medium wp-image-2299" src="https://triangletireus.com/wp-content/uploads/2018/10/tr653productsheet.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Triangle TR653 Product Sheet</p>
								<a href="https://triangletireus.com/wp-content/uploads/2018/10/Triangle_TR653_product_sheet-1.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2299" src="https://triangletireus.com/wp-content/uploads/2018/10/trs02productsheet.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Triangle TRS02 Product Sheet</p>
								<a href="https://triangletireus.com/wp-content/uploads/2018/10/Triangle_TRS02_product_sheet-1.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
				  
							</div>
						</div>
						<div class="row">
							<div class="medium-12 columns">
								<h1 class="headersections">Brochures</h1>
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns divider">
								<hr />
							</div>
						</div>
						<div class="row brochurerow">
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2308" src="/wp-content/uploads/2019/02/triangle-corporate-brochure.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Triangle Corporate Brochure</p>
								<a href="/uploads/2018/10/Triangle_corporate_brochure.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2308" src="/wp-content/uploads/2020/05/Triangle_ST_warranty_card-1.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Specialty Trailer Tire Warranty Brochure</p>
								<a href="/wp-content/uploads/2020/05/Triangle_ST_warranty_card.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
							<div class="large-4 columns">
								<img class="alignnone size-medium wp-image-2308" src="/wp-content/uploads/2020/05/Triangle_TBR_warranty_card.jpg" alt="" width="232" height="300" />
								<p class="supporttitle">Truck &amp; Bus Tire Warrranty Brochure</p>
								<a href="/wp-content/uploads/2020/05/Triangle_TBR_warranty_card.pdf" target="_blank" rel="noopener"><button class="button warranties" type="button">DOWNLOAD</button></a>
							</div>
						</div>
					</div>
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